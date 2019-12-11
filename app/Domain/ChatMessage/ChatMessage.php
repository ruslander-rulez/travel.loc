<?php
namespace App\Domain\ChatMessage;

use App\Domain\BackendUser\BackendUser;
use App\Domain\Profile\Profile;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
   	const ENTITY_TABLE = "chat_messages";


	const TYPE_TO_ADMIN = "to_admin";

	const TYPE_TO_PROFILE = "to_profile";

   	protected $table = self::ENTITY_TABLE;

	protected $dates = [];

	public function profile()
	{
		return $this->belongsTo(Profile::class, "profile_id", "id");
	}

	public function admin()
	{
		return $this->belongsTo(BackendUser::class, "admin_id", "id");
	}
}