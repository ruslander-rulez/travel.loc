<?php
namespace App\Domain\BackendUser;

use App\Domain\ChatMessage\ChatMessage;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Domain\BackendUser\BackendUser
 *
 * @property string $email
 * @property string $login
 * @property string $password
 * @property int $id
 * @property string $name
 * @property string|null $remember_token
 * @property string|null $reset_password_code
 * @property-read mixed $count_unread_messages
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Domain\ChatMessage\ChatMessage[] $messages
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\BackendUser\BackendUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\BackendUser\BackendUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\BackendUser\BackendUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\BackendUser\BackendUser whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\BackendUser\BackendUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\BackendUser\BackendUser whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\BackendUser\BackendUser wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\BackendUser\BackendUser whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\BackendUser\BackendUser whereResetPasswordCode($value)
 * @mixin \Eloquent
 */
class BackendUser extends Model implements AuthenticatableContract
{
    use Authenticatable;

	const ENTITY_TABLE = "backend_user";

	protected $table = self::ENTITY_TABLE;


	public function getCountUnreadMessagesAttribute() {
		return $this->messages()->where("type", ChatMessage::TYPE_TO_ADMIN)->where("is_read", false)->count();
	}

	public function messages() {
		return $this->hasMany(ChatMessage::class, "admin_id", "id");
	}
}