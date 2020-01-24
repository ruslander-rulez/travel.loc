<?php
namespace App\Domain\Book;

use App\Domain\Booking\Booking;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Domain\Book\Book
 *
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
 * @property bool $is_canceled
 * @property string|null $contact_phone
 * @property string|null $contact_email
 * @property array|null $group
 * @property int|null $booking_id
 * @property-read \App\Domain\Booking\Booking|null $booking
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Domain\Book\Book[] $type
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Book\Book newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Book\Book newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Domain\Book\Book onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Book\Book query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Book\Book whereBookingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Book\Book whereContactEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Book\Book whereContactPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Book\Book whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Book\Book whereDateOfEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Book\Book whereDateOfStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Book\Book whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Book\Book whereDriver($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Book\Book whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Book\Book whereGuide($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Book\Book whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Book\Book whereIsCanceled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Book\Book whereLeaderName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Book\Book whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Book\Book whereProgram($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Book\Book whereTotalTourists($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Book\Book whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Book\Book whereTypeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Book\Book whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Domain\Book\Book withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Domain\Book\Book withoutTrashed()
 * @mixin \Eloquent
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

	public function booking()
	{
		return $this->belongsTo(Booking::class, "booking_id", "id");
	}
}