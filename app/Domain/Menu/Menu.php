<?php
namespace App\Domain\Menu;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Domain\Menu\Menu
 *
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property integer $id
 * @property string $name
 * @property int $restaurant_id
 * @property array|null $dishes
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Menu\Menu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Menu\Menu newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Domain\Menu\Menu onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Menu\Menu query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Menu\Menu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Menu\Menu whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Menu\Menu whereDishes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Menu\Menu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Menu\Menu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Menu\Menu whereRestaurantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Menu\Menu whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Domain\Menu\Menu withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Domain\Menu\Menu withoutTrashed()
 * @mixin \Eloquent
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