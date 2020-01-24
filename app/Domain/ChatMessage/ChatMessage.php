<?php
namespace App\Domain\ChatMessage;

use App\Domain\BackendUser\BackendUser;
use App\Domain\ChatMessageAttachment\ChatMessageAttachment;
use App\Domain\Profile\Profile;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Domain\ChatMessage\ChatMessage
 *
 * @property int $id
 * @property int $profile_id
 * @property int $admin_id
 * @property int $is_read
 * @property string $type
 * @property string $message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Domain\BackendUser\BackendUser $admin
 * @property-read \App\Domain\Profile\Profile $profile
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\ChatMessage\ChatMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\ChatMessage\ChatMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\ChatMessage\ChatMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\ChatMessage\ChatMessage whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\ChatMessage\ChatMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\ChatMessage\ChatMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\ChatMessage\ChatMessage whereIsRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\ChatMessage\ChatMessage whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\ChatMessage\ChatMessage whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\ChatMessage\ChatMessage whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\ChatMessage\ChatMessage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ChatMessage extends Model
{
   	const ENTITY_TABLE = "chat_messages";


	const TYPE_TO_ADMIN = "to_admin";

	const TYPE_TO_PROFILE = "to_profile";

   	protected $table = self::ENTITY_TABLE;

	protected $dates = [];
	protected $casts = [
		"profile_id" => "integer"
	];

	protected $fillable = ["profile_id", "is_read", "admin_id", "type", "message"];

	public function profile()
	{
		return $this->belongsTo(Profile::class, "profile_id", "id");
	}

	public function admin()
	{
		return $this->belongsTo(BackendUser::class, "admin_id", "id");
	}

	public function attachments()
	{
		return $this->hasMany(ChatMessageAttachment::class, "chat_message_id", "id");
	}
}