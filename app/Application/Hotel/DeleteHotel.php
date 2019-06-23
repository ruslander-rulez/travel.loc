<?php

namespace App\Application\Hotel;

use ItDevgroup\CommandBus\Command;

class DeleteHotel implements Command
{
    private $id;

    /**
     * DeleteAdvice constructor.
     * @param $id
     */
    public function __construct($id)
    {

        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function id()
    {
        return $this->id;
    }
}