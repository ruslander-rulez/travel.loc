<?php
namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SettingController extends Controller
{
    public function index()
    {
        return view("dashboard.setting.index");
    }

    public function list(Request $request)
    {
    	$result = [
    		[
    			"key" => "imagesize.advice_list_homepage",
				"type" => "size",
				"value" => setting("imagesize.advice_list_homepage", "500X5000"),
				"title" => "Размер изображений советов на главной"
			],
    		[
    			"key" => "imagesize.advice_list",
				"type" => "size",
				"value" => setting("imagesize.advice_list", "500X5000"),
				"title" => "Размер изображений советов в списке"
			],
			[
    			"key" => "imagesize.advice_single",
				"type" => "size",
				"value" => setting("imagesize.advice_single", "500X5000"),
				"title" => "Размер изображения совета на страние совета"
			],
			[
    			"key" => "imagesize.product_list",
				"type" => "size",
				"value" => setting("imagesize.product_list", "500X5000"),
				"title" => "Размер изображений товара в списке"
			],
			[
    			"key" => "imagesize.product_single",
				"type" => "size",
				"value" => setting("imagesize.product_single", "500X5000"),
				"title" => "Размер основного изображения товара"
			],
			[
    			"key" => "imagesize.product_slide_small",
				"type" => "size",
				"value" => setting("imagesize.product_slide_small", "500X5000"),
				"title" => "Размер миниатюр слайдера товара"
			],
			[
    			"key" => "imagesize.product_slide_big",
				"type" => "size",
				"value" => setting("imagesize.product_slide_big", "500X5000"),
				"title" => "Размер полноформатных фото слайдера товара"
			],
			[
    			"key" => "imagesize.product_basket",
				"type" => "size",
				"value" => setting("imagesize.product_basket", "500X5000"),
				"title" => "Размер изображения товара в корзине"
			],
			[
    			"key" => "imagesize.category_single",
				"type" => "size",
				"value" => setting("imagesize.category_single", "500X5000"),
				"title" => "Размер изображения категории"
			],
			[
    			"key" => "imagesize.category_list",
				"type" => "size",
				"value" => setting("imagesize.category_list", "500X5000"),
				"title" => "Размер изображений категорий в списке"
			]
		];

        return new Response($result, Response::HTTP_OK, []);
    }

	/**
	 * @param Request $request
	 * @return Response
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function save(Request $request)
    {
        $this->validate( $request,  [
			"key" => "required",
            "value" => "required"
        ]);
		setting([$request->get("key") => $request->get("value")])
			->save();

        return new Response([], Response::HTTP_ACCEPTED);
    }
}