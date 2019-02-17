<?php
namespace App\Domain\Attachment;

use App\Domain\Ship\Ship;
use App\Domain\Product\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property integer $id
 * @property string $path
 */
class Attachment extends Model
{
    const ENTITY_TABLE = "attachment";

    protected $table = self::ENTITY_TABLE;

    public function advices()
    {
        return $this->belongsTo(Ship::class, "attachment_id");
    }

    public function productGallery()
    {
        $this->belongsToMany(Product::class, "attachment_product");
    }
}