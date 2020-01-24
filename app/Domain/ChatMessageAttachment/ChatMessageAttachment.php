<?php
namespace App\Domain\ChatMessageAttachment;

use App\Domain\BackendUser\BackendUser;
use App\Domain\ChatMessage\ChatMessage;
use App\Domain\Profile\Profile;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Domain\ChatMessageAttachment\ChatMessageAttachment
 *
 * @property int $id
 * @property string $origin_filename
 * @property string $filename
 * @property string $mime-type
 * @property string $storage
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\ChatMessageAttachment\ChatMessageAttachment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\ChatMessageAttachment\ChatMessageAttachment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\ChatMessageAttachment\ChatMessageAttachment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\ChatMessageAttachment\ChatMessageAttachment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\ChatMessageAttachment\ChatMessageAttachment whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\ChatMessageAttachment\ChatMessageAttachment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\ChatMessageAttachment\ChatMessageAttachment whereMimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\ChatMessageAttachment\ChatMessageAttachment whereOriginFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\ChatMessageAttachment\ChatMessageAttachment whereStorage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\ChatMessageAttachment\ChatMessageAttachment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ChatMessageAttachment extends Model
{
   	const ENTITY_TABLE = "chat_message_attachments";

   	protected $fillable = ["storage", "filename", "origin_filename", "mime-type"];

   	protected $table = self::ENTITY_TABLE;

   	public function message()
	{
		return $this->belongsTo(ChatMessage::class, "chat_message_id", "id");
	}
}