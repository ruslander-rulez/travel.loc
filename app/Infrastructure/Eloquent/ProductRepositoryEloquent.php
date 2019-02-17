<?php
namespace App\Infrastructure\Eloquent;

use App\Domain\Product\Product;
use App\Domain\Product\ProductRepository;
use App\Domain\Product\ProductFilter;
use App\Domain\Core\Pagination;
use App\Domain\Core\Sort;

class ProductRepositoryEloquent implements ProductRepository
{
    use Helper;

    /**
     * @var Product
     */
    private $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    /**
     * @param ProductFilter $filter
     * @param Pagination|null $pagination
     * @param Sort|null $sort
     * @return Product[]
     */
    public function all(ProductFilter $filter, ?Pagination $pagination = null, ?Sort $sort = null)
    {
        $qb =  $this->model->newModelQuery();
        $qb->with(["thumbnail", "made_in_ico", "gallery"]);

        if ($filter->showOnFront()) {
            $qb->where("show_on_front", $filter->showOnFront());
        }
        if ($filter->locale()) {
            $qb->where("locale", $filter->locale());
        }
        if ($filter->categoryId()) {
            $qb->where("category_id", $filter->categoryId());
        }
        if ($pagination) {
            $items =  $qb->forPage($pagination->page(), $pagination->peerPage())->get();
            $maxItems =  $qb->count();
            return [
                "items" => $items,
                "total" => $maxItems
            ];
        }
        return $qb->get()->all();
    }

    /**
     * @param Product $product
     * @param $gallery
     * @return array|void
     */
    public function syncGallery(Product $product, $gallery)
    {
        $product->gallery()->sync($gallery);
    }

    public function bySlug($slug)
    {
         return $this->model->newQuery()->where("slug", $slug)->firstOrFail();
    }

}