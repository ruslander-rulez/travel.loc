<?php
namespace App\Infrastructure\Eloquent;

use App\Domain\Booking\Booking;
use App\Domain\Booking\BookingFilter;
use App\Domain\Booking\BookingRepository;
use App\Domain\Core\Pagination;
use App\Domain\Core\Sort;
use Illuminate\Database\Query\Builder;

class BookingRepositoryEloquent implements BookingRepository
{
    use Helper;

    /**
     * @var Booking
     */
    private $model;

    public function __construct(Booking $model)
    {
        $this->model = $model;
    }

	/**
	 * @param BookingFilter $bookingFilter
	 * @param Pagination|null $pagination
	 * @param Sort|null $sort
	 * @return Booking[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
	 */
    public function all(BookingFilter $bookingFilter, ?Pagination $pagination = null, ?Sort $sort = null)
    {
        $qb =  $this->model->newQuery();
		$qb->where(function ($query) use ($bookingFilter) {

			if ($bookingFilter->arrivalDateFrom()) {
				$query->where("arrival_date", ">=", $bookingFilter->arrivalDateFrom());
			}

			if ($bookingFilter->arrivalDateTo()) {
				$query->where("arrival_date", "<=", $bookingFilter->arrivalDateTo());
			}

			if ($bookingFilter->departureDateFrom()) {
				$query->where("departure_date", ">=", $bookingFilter->departureDateFrom());
			}

			if ($bookingFilter->departureDateTo()) {
				$query->where("departure_date", "<=", $bookingFilter->departureDateTo());
			}
        });
		if ($sort) {
			$qb->orderBy($sort->field(), $sort->direction());
		}
            $qb->with(["ship", "leader", "tourists"]);
        if ($pagination) {
            $maxItems =  $qb->count();
            $advices = $qb
                ->forPage($pagination->page(), $pagination->peerPage())
                ->get();

            return [
                "items" => $advices,
                "total" => $maxItems
            ];
        }
        $result = $qb->get();

        return $result;
    }
}