<?php
namespace App\Infrastructure\Eloquent;

use App\Domain\Book\Book;
use App\Domain\Book\BookFilter;
use App\Domain\Book\BookRepository;
use App\Domain\Client\Client;
use App\Domain\Client\ClientFilter;
use App\Domain\Client\ClientRepository;
use App\Domain\Core\Pagination;
use App\Domain\Core\Sort;

class BookRepositoryEloquent implements BookRepository
{
    use Helper;

    /**
     * @var Book
     */
    private $model;

    public function __construct(Book $model)
    {
        $this->model = $model;
    }

	/**
	 * @param BookFilter $bookFilter
	 * @param Pagination|null $pagination
	 * @param Sort|null $sort
	 * @return Client[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
	 */
    public function all(BookFilter $bookFilter, ?Pagination $pagination = null, ?Sort $sort = null)
    {
        $qb =  $this->model->newQuery();
		$qb->where(function ($query) use ($bookFilter) {

			if ($bookFilter->dateOfStart()) {
				$query->where("date_of_start", ">=", $bookFilter->dateOfStart());
			}
		});
		if ($sort) {
			$qb->orderBy($sort->field(), $sort->direction());
		}
            $qb->with("type");
        if ($pagination) {
            $maxItems =  $qb->count();
            $books = $qb
                ->forPage($pagination->page(), $pagination->peerPage())
                ->get();

            return [
                "items" => $books,
                "total" => $maxItems
            ];
        }
        $result = $qb->get();

        return $result;
    }
}