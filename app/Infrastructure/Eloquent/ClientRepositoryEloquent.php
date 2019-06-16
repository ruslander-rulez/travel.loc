<?php
namespace App\Infrastructure\Eloquent;

use App\Domain\Client\Client;
use App\Domain\Client\ClientFilter;
use App\Domain\Client\ClientRepository;
use App\Domain\Core\Pagination;
use App\Domain\Core\Sort;
use Illuminate\Database\Query\Builder;

class ClientRepositoryEloquent implements ClientRepository
{
    use Helper;

    /**
     * @var Client
     */
    private $model;

    public function __construct(Client $model)
    {
        $this->model = $model;
    }

    /**
     * @param ClientFilter $clientFilter
     * @param Pagination|null $pagination
     * @param Sort|null $sort
     * @return Client[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all(ClientFilter $clientFilter, ?Pagination $pagination = null, ?Sort $sort = null)
    {
        $qb =  $this->model->newQuery();
		$qb->where(function ($query) use ($clientFilter) {
			if ($clientFilter->search()) {
				/** @var Builder $query */
				$query->where(function ($query) use ($clientFilter) {
					/** @var Builder $query */
					$query->where("passport", "like", "%{$clientFilter->search()}%");
					$query->orWhere("email", "like", "%{$clientFilter->search()}%");
					$query->orWhere("name", "like", "%{$clientFilter->search()}%");
				});
			}
        });
          //  $qb->with("relationName");
        if ($pagination) {
            $maxItems =  $qb->count();
            $clients = $qb
                ->forPage($pagination->page(), $pagination->peerPage())
                ->get();

            return [
                "items" => $clients,
                "total" => $maxItems
            ];
        }
        $result = $qb->get();

        return $result;
    }
}