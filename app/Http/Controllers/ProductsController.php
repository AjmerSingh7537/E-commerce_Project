<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\AddProductRequest;
use App\Products;
use DB;

class ProductsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $products = DB::table('products')->get();
		return view('products', ['products' => $products]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('add_product');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(AddProductRequest $request, Products $products)
	{
        $data = $request->all();
        $ext = $request->file('image')->getClientOriginalExtension();
        $filename = uniqid() . "." . $ext;
        $request->file('image')->move('img/products/', $filename);
        $products->product_name = $data['product_name'];
        $products->description = $data['description'];
        $products->price = $data['price'];
        $products->image = $filename;
        $products->slug = $data['slug'];
        $products->save();
        return redirect()->route('products_path');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$product = DB::table('products')->find($id);
        return view('product_details', ['product' => $product]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$product = DB::table('products')->find($id);
        return view('edit_product', ['product' => $product]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Products $pro, AddProductRequest $req)
	{
        //dd(\Request::get('product_name'));
//        $pro = $this->pro->find($id);
//        $pro->product_name = $req->input('product_name');
//        $pro->save();
        //$pro->update($req->input());
        //$product = DB::table('products')->find($id);
        //return redirect('products');
        return $id;
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
