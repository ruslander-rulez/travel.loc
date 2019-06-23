<?php
namespace App\Domain\Menu;

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
class Menu extends Model
{
	use SoftDeletes;

   	const ENTITY_TABLE = "menu";

   	protected $casts = [
   		"dishes" => "array"
	];

   	protected $table = self::ENTITY_TABLE;

	protected $dates = ['deleted_at'];
}