<?php

namespace App\Domain\Core;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
	/**
	 * @param int $id
	 *
	 * @return Model|null
	 */
	public function byId($id);

	/**
	 * @param Model $advice
	 */
	public function store(Model $advice);

	/**
	 * @param Model $advice
	 */
	public function delete(Model $advice);
}