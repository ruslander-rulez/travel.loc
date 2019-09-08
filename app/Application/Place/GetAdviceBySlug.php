<?php


namespace App\Application\Place;

use ItDevgroup\CommandBus\Command;

class GetAdviceBySlug implements Command
{
    /**
     * @var string
     */
    private $slug;

    /**
     * GetAdviceBySlug constructor.
     * @param $slug
     */
    public function __construct($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function slug()
    {
        return $this->slug;
    }
}