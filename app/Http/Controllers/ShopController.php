<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Valut;
use App\Bag;
use View;
use Response;
use Session;

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


		$valuts = Valut::get();

		$this->middleware(function ($request, $next) {
			$productsInBag = Session::get('products');
			$subtotal = Session::get('subtotal');
			View::share('subtotal', $subtotal);
			View::share('productsInBag', $productsInBag);
			return $next($request);
		});

		View::share('valuts', $valuts);
		View::share('categories', $categories);
		View::share('newProducts', $newProducts);
	}

	public function index(Request $request)
	{
		$data = ['share'=> []];

		// dd($request);
		// $productsInBag = Session::get('products');
		// $subtotal = Session::get('subtotal');
		// View::share('productsInBag', $productsInBag);
		// View::share('subtotal', $subtotal);
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

	public function addToCart(Request $request)
	{
		$data = [];
		// $bag = new Bag;
		$quantity = $request->quantity;
		$product = Product::find($request->id);

		$product->sum = $product->price*$quantity;
		$product->qty = $quantity;

		$productsInBag = Session::get('products');

		$subtotal = $product->sum;
		if($productsInBag)
		{
			foreach ($productsInBag as $key=> &$prdct) {
				if($key == $product->id)
				{
					$product->qty += $prdct->qty;
					$product->sum += $prdct->sum;
				}

				$subtotal += $prdct->sum;
			}
		}

		Session::put('products.'.$product->id, $product);
		Session::put('subtotal', $subtotal);

		return Response::json($data);
	}

	public function getCartDetails()
	{
		$data = [];
		$data['productsInBag'] = Session::get('products');
		$data['subtotal'] = Session::get('subtotal');

		$data['cart_small'] = view('shop.shopping_cart_small', $data)->render();
		$data['cart'] = view('shop.shopping_cart', $data)->render();

		return Response::json($data);
	}

	public function updateCart(Request $request)
	{
		$productId = $request->id;
		$quantity = $request->quantity;

		if($productId == 'clear') {

			Session::flush();
			return route('Shop.Checkout');
		}

		$product = Session::get('products.'.$productId);

		if($quantity == 0) 
		{
			$sum = $product->sum*(-1);
			Session::forget('products.'.$productId);
		}
		else
		{
			$product->qty = $quantity;
			$product->sum = $quantity*$product->price;
			$sum = $product->sum;
			Session::put('products.'.$product->id, $product);
		}

		$subtotal = Session::get('subtotal')+$sum;
		Session::put('subtotal', $subtotal);

		return Response::json($product);
	}

	public function sendOrder(Request $request)
	{

	}

	public function checkout()
	{
		$data['products'] = Session::get('products');
		$data['subtotal'] = Session::get('subtotal');

		return view('shop.checkout', $data);
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
