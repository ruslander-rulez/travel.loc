<?php
namespace App\Domain\Client;

use App\Domain\Core\Pagination;
use App\Domain\Core\RepositoryInterface;
use App\Domain\Core\Sort;

interface ClientRepository extends RepositoryInterface
{
	/**
	 * @param ClientFilter $clientFilter
	 * @param Pagination|null $pagination
	 * @param Sort|null $sort
	 * @return Client[]
	 */
    public function all(ClientFilter $clientFilter, ?Pagination $pagination = null, ?Sort $sort = null);
}