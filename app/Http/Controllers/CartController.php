<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CartRequest;
use App\Products;
use Illuminate\Support\Facades\Session;

class CartController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return "Product name: " . Session::get('product_name') . "\nDescription: " . Session::get('description') . "\nPrice: " . Session::get('price');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
//	public function create()
//	{
//		//
//	}

    /**
     * Store a newly created resource in storage.
     *
     * @param CartRequest $request
     * @return Response
     */
	public function store(CartRequest $request, Products $product)
	{
        $product_id = $request->get('product_id');
        //echo $product_id;
        $product = $product->where('id', $product_id);
        print_r($product);
        //Session::put('product_name', $product->product_name);
        //Session::put('description', $product->description);
        //Session::put('price', $product->price);
        //return redirect()->route('show_cart');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
//	public function show($id)
//	{
//		//
//	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return "you are editing the following product " . $id;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
