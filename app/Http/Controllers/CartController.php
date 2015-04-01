<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CartRequest;
use Illuminate\Support\Facades\Session;

class CartController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return "you are adding the following item to the cart: " . Session::get('product_id');
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
	public function store(CartRequest $request)
	{
        Session::put('product_id', $request->get('product_id'));
        return redirect()->route('show_cart');
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
