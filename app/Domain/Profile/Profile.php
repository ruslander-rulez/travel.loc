<?php

namespace App\Domain\Profile;

use App\Domain\ChatMessage\ChatMessage;
use App\Domain\Client\Client;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Domain\Profile\Profile
 *
 * @property int $id
 * @property int|null $client_id
 * @property string $email
 * @property string $name
 * @property string $password
 * @property string|null $remember_token
 * @property string|null $reset_password_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Domain\Client\Client|null $client
 * @property-read mixed $count_unread_messages
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Domain\ChatMessage\ChatMessage[] $messages
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Profile\Profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Profile\Profile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Profile\Profile query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Profile\Profile whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Profile\Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Profile\Profile whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Profile\Profile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Profile\Profile whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Profile\Profile wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Profile\Profile whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Profile\Profile whereResetPasswordCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Profile\Profile whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Profile extends Model implements AuthenticatableContract
{
	use \Illuminate\Auth\Authenticatable;

	const ENTITY_TABLE = "profiles";

	protected $table = self::ENTITY_TABLE;

	protected $fillable = ["email", "password", "name"];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function client()
	{
		return $this->belongsTo(Client::class, "client_id", "id");
	}

	public function messages() {
		return $this->hasMany(ChatMessage::class, "profile_id", "id");
	}

	public function getCountUnreadMessagesAttribute() {
		return $this->messages()->where("type", ChatMessage::TYPE_TO_PROFILE)->where("is_read", false)->count();
	}
}
