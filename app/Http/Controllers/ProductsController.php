<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Exception;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $products= Product::all();
        return view('products.index', ['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProductRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductRequest $request)
    {
        try{
            DB::beginTransaction();
            $product = Product::create(['title'=>$request->input('title'),'description'=>$request->input('description'),'quantity'=>array_sum(array_column($request->input('variation'),'quantity')),'base_price'=>$request->input('base_price')]);
            //For one to many
            $product->variations()->createMany($request->input('variation'));
            //For many to many
            // $product->variations()->sync($request->input('variation'));
            DB::commit();
        }catch(Exception $ex){
            info($ex->getMessage());
            DB::rollBack();
        }

        return to_route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show',['product'=>$product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product  $product
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Product $product)
    {
        // $product = Product::findOrFail($id);
        return view('products.edit',['product'=>$product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProductRequest  $request
     * @param  Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProductRequest $request, Product $product)
    {
		$product->title = $request->input('title');
		$product->description = $request->input('description');
		$product->quantity = $request->input('quantity');
		$product->base_price = $request->input('base_price');
        $product->save();

        return to_route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return to_route('product.index');
    }
}
