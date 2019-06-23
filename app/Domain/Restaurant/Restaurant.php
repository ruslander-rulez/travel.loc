<?php
namespace App\Domain\Restaurant;

use App\Domain\Menu\Menu;
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