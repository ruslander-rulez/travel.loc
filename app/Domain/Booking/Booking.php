<?php
namespace App\Domain\Booking;

use App\Domain\Client\Client;
use App\Domain\Ship\Ship;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Domain\Booking\Booking
 *
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property array $tourticket_settings
 * @property array $checklist
 * @property integer $id
 * @property string $color
 * @property int $ship_id
 * @property int|null $leader_id
 * @property string|null $group_name
 * @property string|null $additional_info
 * @property int $evening_program
 * @property string $arrival_date
 * @property string $departure_date
 * @property-read \App\Domain\Client\Client|null $leader
 * @property-read \App\Domain\Ship\Ship $ship
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Domain\Client\Client[] $tourists
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Booking\Booking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Booking\Booking newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Domain\Booking\Booking onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Booking\Booking query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Booking\Booking whereAdditionalInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Booking\Booking whereArrivalDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Booking\Booking whereChecklist($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Booking\Booking whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Booking\Booking whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Booking\Booking whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Booking\Booking whereDepartureDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Booking\Booking whereEveningProgram($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Booking\Booking whereGroupName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Booking\Booking whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Booking\Booking whereLeaderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Booking\Booking whereShipId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Booking\Booking whereTourticketSettings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Booking\Booking whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Domain\Booking\Booking withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Domain\Booking\Booking withoutTrashed()
 * @mixin \Eloquent
 */
class Booking extends Model
{
	use SoftDeletes;

   	const ENTITY_TABLE = "booking";

   	protected $table = self::ENTITY_TABLE;

	protected $dates = ['deleted_at'];

	protected $casts = [
		'tourticket_settings' => 'array',
		'checklist' => 'array'
	];

	public function ship()
	{
		return $this->belongsTo(Ship::class);
	}
	public function leader()
	{
		return $this->belongsTo(Client::class);
	}

	public function tourists()
	{
		return $this->belongsToMany(
			Client::class,
			"booking_clients",
			"booking_id",
			"client_id"
		);
	}
}