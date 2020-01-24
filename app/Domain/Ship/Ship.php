<?php
namespace App\Domain\Ship;

use App\Domain\Book\Book;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Domain\Ship\Ship
 *
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property integer $id
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Domain\Book\Book[] $books
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Ship\Ship newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Ship\Ship newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Domain\Ship\Ship onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Ship\Ship query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Ship\Ship whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Ship\Ship whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Ship\Ship whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Ship\Ship whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Ship\Ship whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Domain\Ship\Ship withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Domain\Ship\Ship withoutTrashed()
 * @mixin \Eloquent
 */
class Ship extends Model
{
	use SoftDeletes;

   	const ENTITY_TABLE = "ship";

   	protected $table = self::ENTITY_TABLE;

	protected $dates = ['deleted_at'];

	public function books()
	{
		return $this->morphMany(Book::class, 'type');
	}
}