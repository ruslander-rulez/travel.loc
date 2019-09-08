<?php
namespace App\Domain\Book;

use App\Domain\Core\Pagination;
use App\Domain\Core\RepositoryInterface;
use App\Domain\Core\Sort;
use Illuminate\Database\Eloquent\Model;

interface BookRepository extends RepositoryInterface
{
	/**
	 * @param BookFilter $bookingFilter
	 * @param Pagination|null $pagination
	 * @param Sort|null $sort
	 * @return Book[]
	 */
    public function all(BookFilter $bookingFilter, ?Pagination $pagination = null, ?Sort $sort = null);
}