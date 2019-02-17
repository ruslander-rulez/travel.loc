<?php
namespace App\Domain\Client;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property integer $id
 * @property string $name
 * @property string $nationality
 * @property Carbon $birthday
 * @property string $email
 * @property string $phone
 * @property string $passport
 */
class Client extends Model
{
	use SoftDeletes;

   	const ENTITY_TABLE = "clients";

   	protected $table = self::ENTITY_TABLE;

	protected $dates = ['deleted_at', "birthday"];
}