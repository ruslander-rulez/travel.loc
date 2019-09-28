<?php
namespace App\Domain\Book;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property Carbon $date_of_start
 * @property Carbon $date_of_end
 * @property string $group_name
 * @property string $leader_name
 * @property string $total_tourists
 * @property string $driver
 * @property string $guide
 * @property string $notes
 * @property string $type_type
 * @property integer $type_id
 * @property array $program
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 */
class Book extends Model
{
	use SoftDeletes;

   	const ENTITY_TABLE = "book";

   	protected $table = self::ENTITY_TABLE;

	protected $dates = ['deleted_at', "date_of_start", "date_of_end"];

	protected $casts = [
		'program' => 'array',
		'group' => 'array',
		"is_canceled" => "boolean",
		'total_tourists' => 'array',
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\MorphTo
	 */
	public function type()
	{
		return $this->morphTo();
	}
}