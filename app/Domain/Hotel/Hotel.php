<?php
namespace App\Domain\Hotel;

use App\Domain\Book\Book;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Domain\Hotel\Hotel
 *
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property integer $id
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Domain\Book\Book[] $books
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Hotel\Hotel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Hotel\Hotel newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Domain\Hotel\Hotel onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Hotel\Hotel query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Hotel\Hotel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Hotel\Hotel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Hotel\Hotel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Hotel\Hotel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Hotel\Hotel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Domain\Hotel\Hotel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Domain\Hotel\Hotel withoutTrashed()
 * @mixin \Eloquent
 */
class Hotel extends Model
{
	use SoftDeletes;

   	const ENTITY_TABLE = "hotel";

   	protected $table = self::ENTITY_TABLE;

	protected $dates = ['deleted_at'];

	public function books()
	{
		return $this->morphMany(Book::class, 'type');
	}
}