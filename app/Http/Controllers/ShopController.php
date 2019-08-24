<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use View;

class ShopController extends Controller
{
	public function __construct()
	{
		$categories = Category::with(['children'=>function($q){
									$q->with(['children'=>function($q2) {
										$q2->with('children');
									}]);
								}])->where('parent_id', 0)->get();

		$newProducts = Product::where('is_new', 1)->get();

		View::share('categories', $categories);
		View::share('newProducts', $newProducts);
	}

	public function index()
	{
		$data = ['share'=> []];

		// $data['categories'] = 

		return view('shop.home');
	}

	public function shopGrid(Request $request)
	{
		$data = [];
		$categoryId = $request->c;
		$data['category'] = Category::with('products')->find($categoryId);

		return view('shop.shop_grid', $data);
	}

	public function productDetails(Request $request)
	{
		$data = [];
		$productId = $request->p;

		$data['product'] = Product::find($productId);

		return view('shop.product_details', $data);
	}

	public function about()
	{
		return view('shop.about');
	}

	public function contact()
	{
		return view('shop.contact');
	}
}
