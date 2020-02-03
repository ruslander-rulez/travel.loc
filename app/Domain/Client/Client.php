<?php
namespace App\Domain\Client;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Domain\Client\Client
 *
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
 * @property string|null $notes
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Client\Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Client\Client newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Domain\Client\Client onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Client\Client query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Client\Client whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Client\Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Client\Client whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Client\Client whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Client\Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Client\Client whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Client\Client whereNationality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Client\Client wherePassport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Client\Client wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Client\Client whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Domain\Client\Client withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Domain\Client\Client withoutTrashed()
 * @mixin \Eloquent
 */
class Client extends Model
{
	use SoftDeletes;

   	const ENTITY_TABLE = "clients";

   	protected $table = self::ENTITY_TABLE;

	protected $dates = ['deleted_at', "birthday"];
}