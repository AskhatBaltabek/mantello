<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Size;
use Illuminate\Http\Request;
use Response;
use Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.goods');
    }

    public function getProducts(Request $request)
    {
        $products = new Product;
        return $products->get();
    }

    public function productWindow($id, Request $request)
    {
        $data = ['new'=> false];
        $productId = $request->id;

        if($productId != 'new')
        {
            $data['product'] = Product::find($productId);
        }
        else
        {
            $data['product'] = new Product;
            $data['new'] = true;
        }

        return view('admin.good', $data);
    }

    public function uploadGalleryImages(Request $request)
    {
        $data = ['msg'=> 'File(s) uploaded.'];
        $productId = $request->id;
        $file = $request->file;

        $product = Product::find($productId);
        $path = $product->getGalleryDir();

        Storage::makeDirectory($path, 0775, true);
        $f = Storage::put($path, $file);

        return Response::json($data);
    }

    public function getProductGallery(Request $request)
    {
                
    }

    public function getCategories(Request $request)
    {
        $categories = Category::with(['children'=>function($q){
            $q->with(['children'=>function($q2){
                $q2->with('children');
            }]);
        }])->where('parent_id', 0);
        return $categories->get();
    }

    public function storeCategory(Request $request)
    {
        $data = ['msg'=> 'Category stored.'];
        $catId = $request->id;

        if($catId == 'new')
        {
            $category = new Category;
        }
        else
        {
            $category = Category::find($catId);
        }

        $category->title = $request->title;
        $category->save();

        return Response::json($data);
    }

    public function getSizes(Request $request)
    {
        $sizes = Size::withCount('products');
        return $sizes->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
