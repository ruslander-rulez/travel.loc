<?php
namespace App\Domain\BackendUser;

use App\Domain\ChatMessage\ChatMessage;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $email
 * @property string $login
 * @property string $password
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