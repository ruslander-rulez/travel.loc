<?php
namespace App\Domain\Place;

use App\Domain\Book\Book;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property integer $id
 * @property string $name
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