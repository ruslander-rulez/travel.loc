<?php
namespace App\Application\Book;

use ItDevgroup\CommandBus\Command;

class GenerateProgramDocument implements Command
{
	private $bookId;

	/**
	 * GenerateBorderDocuments constructor.
	 * @param $bookId
	 */
	public function __construct($bookId)
	{
		$this->bookId = $bookId;
	}

	/**
	 * @return mixed
	 */
	public function bookId()
	{
		return $this->bookId;
	}
}