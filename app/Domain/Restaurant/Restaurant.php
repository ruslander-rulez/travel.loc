<?php
namespace App\Domain\Restaurant;

use App\Domain\Menu\Menu;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Domain\Restaurant\Restaurant
 *
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property integer $id
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Domain\Menu\Menu[] $menus
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Restaurant\Restaurant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Restaurant\Restaurant newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Domain\Restaurant\Restaurant onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Restaurant\Restaurant query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Restaurant\Restaurant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Restaurant\Restaurant whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Restaurant\Restaurant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Restaurant\Restaurant whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Restaurant\Restaurant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Domain\Restaurant\Restaurant withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Domain\Restaurant\Restaurant withoutTrashed()
 * @mixin \Eloquent
 */
class Restaurant extends Model
{
	use SoftDeletes;

   	const ENTITY_TABLE = "restaurant";

   	protected $table = self::ENTITY_TABLE;

	protected $dates = ['deleted_at'];

	public function menus()
	{
		return $this->hasMany(Menu::class, "restaurant_id", "id");
	}
}