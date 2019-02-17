<?php
namespace App\Domain\Booking;

use App\Domain\Core\Pagination;
use App\Domain\Core\RepositoryInterface;
use App\Domain\Core\Sort;
use Illuminate\Database\Eloquent\Model;

interface BookingRepository extends RepositoryInterface
{
	/**
	 * @param BookingFilter $bookingFilter
	 * @param Pagination|null $pagination
	 * @param Sort|null $sort
	 * @return Booking[]
	 */
    public function all(BookingFilter $bookingFilter, ?Pagination $pagination = null, ?Sort $sort = null);
}