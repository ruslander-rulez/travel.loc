<?php
namespace App\Domain\Place;

use App\Domain\Book\Book;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Domain\Place\Place
 *
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property integer $id
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Domain\Book\Book[] $books
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Place\Place newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Place\Place newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Place\Place query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Place\Place whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Place\Place whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Place\Place whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Place\Place whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Place extends Model
{
   	const ENTITY_TABLE = "place";

   	protected $table = self::ENTITY_TABLE;

	protected $dates = ['deleted_at'];

	public function books()
	{
		return $this->morphMany(Book::class, 'type');
	}
}