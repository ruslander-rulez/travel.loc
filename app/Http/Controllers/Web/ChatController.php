<?php

namespace App\Http\Controllers\Web;

use App\Domain\BackendUser\BackendUser;
use App\Domain\ChatMessage\ChatMessage;
use App\Domain\ChatMessageAttachment\ChatMessageAttachment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ChatController extends Controller
{
	public function index()
	{
		$messages = ChatMessage::query()
			->where("profile_id", auth()->user()->id)
			->orderBy("created_at", "DESC")
			->with("attachments")
			->get();

		$attachments = ChatMessageAttachment::query()
			->whereHas("message", function (Builder $builder) {
				$builder->where("profile_id", auth()->guard("web")->user()->id);
			})
			->with("message", "message.admin")
			->get();

		$countUnreadMessages = auth()->guard("web")->user()->count_unread_messages;

		auth()->guard("web")->user()->messages()->where("type", ChatMessage::TYPE_TO_PROFILE)->update(["is_read" => true]);

		return view("web.chat.index", compact("messages", "attachments", "countUnreadMessages"));
	}

	public function sendMessage(Request $request)
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
			"profile_id" => auth()->guard("web")->user()->id,
			"is_read" => false,
			"type" => ChatMessage::TYPE_TO_ADMIN,
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

	public function downloadFile($filename, Request $request)
	{
		$file = ChatMessageAttachment::query()->where("filename", $filename)->with("message")->firstOrFail();
		if (get_class(auth()->guard("web")->user()) === BackendUser::class) {
			return \Storage::disk($file->storage)->download($file->filename, $file->origin_filename);
		}

		if (auth()->guard("web")->user()->id !== $file->message->profile_id) {
			abort(404);
		}

		return \Storage::disk($file->storage)->download($file->filename, $file->origin_filename);
	}
}