<?php

namespace App\Domain\Core;

/**
 * Class Sort
 * @package App\Domain\Core
 */
class Sort
{
    /**
     * @var string
     */
    private $direction = "ASC";

    /**
     * @var string
     */
    private $field = "created_at";

    /**
     * @return string
     */
    public function field()
    {
        return $this->field;
    }

    /**
     * @param string $field
     */
    public function setField(string $field): void
    {
        $this->field = $field;
    }

    /**
     * @param string $direction
     */
    public function setDirection(string $direction): void
    {
        $this->direction = $direction;
    }

    /**
     * @return string
     */
    public function direction(): string
    {
        return $this->direction;
    }
}