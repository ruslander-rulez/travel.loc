<?php
namespace App\Domain\Client;

class ClientFilter
{
	/**
	 * @var string
	 */
	private $search;

	/**
	 * @return string
	 */
	public function search(): ?string
	{
		return $this->search;
	}

	/**
	 * @param string $search
	 */
	public function setSearch(?string $search): void
	{
		$this->search = $search;
	}
}
