<?php

namespace App\Application\Restaurant;

use ItDevgroup\CommandBus\Command;

class DeleteRestaurant implements Command
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