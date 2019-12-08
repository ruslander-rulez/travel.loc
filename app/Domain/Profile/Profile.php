<?php

namespace App\Domain\Profile;

use App\Domain\Client\Client;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;

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
}
