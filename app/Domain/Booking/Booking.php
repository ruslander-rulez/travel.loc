<?php
namespace App\Domain\Booking;

use App\Domain\Client\Client;
use App\Domain\Ship\Ship;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property array $tourticket_settings
 * @property array $checklist
 * @property integer $id
 * @property string $color
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