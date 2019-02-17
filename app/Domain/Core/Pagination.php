<?php
namespace App\Domain\Core;


class Pagination
{
    /**
     * @var int
     */
    private $page;
    /**
     * @var int
     */
    private $peerPage;

    /**
     * Pagination constructor.
     * @param int $page
     * @param int $peerPage
     */
    public function __construct($page = 1, $peerPage = 30)
    {
        $this->page = $page;
        $this->peerPage = $peerPage;
    }

    /**
     * @return int
     */
    public function page()
    {
        return $this->page;
    }

    /**
     * @param int $page
     */
    public function setPage(int $page)
    {
        $this->page = $page;
    }

    /**
     * @return int
     */
    public function peerPage()
    {
        return $this->peerPage;
    }

    /**
     * @param int $peerPage
     */
    public function setPeerPage(int $peerPage)
    {
        $this->peerPage = $peerPage;
    }

    public function offset()
    {
        return ($this->page - 1) * $this->peerPage;
    }
}