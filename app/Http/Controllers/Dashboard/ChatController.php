<?php

namespace App\Http\Controllers\Dashboard;

use App\Domain\ChatMessage\ChatMessage;
use App\Domain\ChatMessageAttachment\ChatMessageAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChatController extends Controller
{
	public function index()
	{
		$subQuery = \DB::table("chat_messages")->selectRaw("MAX(id) as last_id_of_conversation, count(id) as countUnread")->groupBy("profile_id");
		$subQueryCount = \DB::table("chat_messages")->selectRaw("count(id) as countUnread, profile_id as prof_id")
			->where("is_read", false)
			->groupBy("profile_id");

		$conversations = ChatMessage::query()
			->joinSub($subQuery, "sub", "id", "last_id_of_conversation")
			->leftJoinSub($subQueryCount, "sub-count", "prof_id", "profile_id")
			->paginate();
		return view("dashboard.chat.index", compact("conversations"));
	}

	public function details($profileId, Request $request)
	{
		$messages = ChatMessage::query()
			->where("profile_id",$profileId)
			->orderBy("created_at", "DESC")
			->with(["attachments", "admin", "profile"])
			->get();

		ChatMessage::query()
			->where("profile_id",$profileId)
			->where("type", ChatMessage::TYPE_TO_ADMIN)
			->orderBy("created_at", "DESC")
			->update(["is_read" => true]);

		return view("dashboard.chat.details", compact("messages", "profileId"));
	}

	public function downloadFile($filename, Request $request)
	{
		$file = ChatMessageAttachment::query()->where("filename", $filename)->with("message")->firstOrFail();
		return \Storage::disk($file->storage)->download($file->filename, Str::ascii($file->origin_filename));
	}

	public function sendMessage($profileId, Request $request)
	{
		$this->validate($request, [
			"message" => "nullable|string|max:15000",
			"files" => "nullable|array",
			"files.*" => "required|file|max:20480"
		]);

		if (!$request->get("message") && !count($request->file("files",[]))) {
			return back();
		}
		$message = ChatMessage::create([
			"profile_id" => $profileId,
			"admin_id" => auth()->guard("dashboard")->user()->id,
			"is_read" => false,
			"type" => ChatMessage::TYPE_TO_PROFILE,
			"message" => $request->get("message")
		]);

		foreach ($request->file("files",[]) as $uploadedFile) {
			$path = \Storage::disk("chatMessage")->putFile("", $uploadedFile);
			$message->attachments()->create([
				"storage" => "chatMessage",
				"filename" => $path,
				"origin_filename" => $uploadedFile->getClientOriginalName(),
				"mime-type" => $uploadedFile->getClientMimeType(),
			]);
		}
		return redirect()->back();
	}
}
