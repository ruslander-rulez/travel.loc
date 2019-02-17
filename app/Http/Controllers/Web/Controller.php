<?php

namespace App\Http\Controllers\Web;


use App\Application\Category\GetCategoryList;
use App\Domain\Category\CategoryFilter;
use App\Http\Controllers\AbstractController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Controller extends AbstractController
{
	use ValidatesRequests;

    protected $locale;
    /**
     * Controller constructor.
     * @param \ItDevgroup\CommandBus\CommandBus $dispatcher
     */
    public function __construct(\ItDevgroup\CommandBus\CommandBus $dispatcher)
    {
        parent::__construct($dispatcher);
        $this->setCurrentLocale();

        if (!in_array(request()->ip(), [ "176.105.24.6", "185.253.97.167", "178.150.90.128", "178.216.9.224", "127.0.0.1"])) {
            throw new NotFoundHttpException();
        }

		$categoryFilter = new CategoryFilter();
		$categoryFilter->setLocale($this->locale);
		$categories = $this->dispatch(new GetCategoryList($categoryFilter, null, null));
		view()->share("categories", $categories);
    }

    private function setCurrentLocale() {
        $host = explode(".", request()->getHttpHost());
        if (count($host) > 2){
            App::setLocale($host[0]);
        }
        $this->locale = App::getLocale();
    }
}