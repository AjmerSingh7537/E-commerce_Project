<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\AddProductRequest;
use App\Products;

class ProductsController extends Controller {

    private $product;

    /**
     * @param Products $product
     */
    public function __construct(Products $product)
    {
        $this->product = $product;
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $products = $this->product->get();
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
     * @param $request
	 * @return Response
	 */
	public function store(AddProductRequest $request)
	{
        $data = $request->all();
        $data['image'] = $this->imageModifier($request, $data);
        $this->sameValues($data, $this->product);
        return redirect()->route('products_path');
	}

    private function sameValues($data, $product)
    {
        $product->product_name = $data['product_name'];
        $product->description = $data['description'];
        $product->price = $data['price'];
        $product->slug = $data['slug'];
        if((!empty($product->image)) && $product->image !== 'default.jpg'){
            unlink('img/products/' . $product->image);
        }
        $product->image = $data['image'];
        $product->save();
    }

    private function imageModifier($request, $data)
    {
        if(empty($data['image'])){
            $filename = 'default.jpg';
        }else{
            $ext = $request->file('image')->getClientOriginalExtension();
            $filename = uniqid() . "." . $ext;
            $request->file('image')->move('img/products/', $filename);
        }
        return $filename;
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  $product
	 * @return Response
	 */
	public function show(Products $product)
	{
        return view('product_details', ['product' => $product]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  $product
	 * @return Response
	 */
	public function edit(Products $product)
	{
        return view('edit_product', ['product' => $product]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  $product
     * @param $request
	 * @return Response
	 */
	public function update(Products $product, AddProductRequest $request)
	{
        $data = $request->all();
        $data['image'] = $this->imageModifier($request, $data);
        $this->sameValues($data, $product);
        return redirect()->route('products_path');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  $product
	 * @return Response
	 */
	public function destroy(Products $product)
	{
        $filename = $product->image;
        $product->delete();
        if($filename !== 'default.jpg'){
            unlink('img/products/' . $filename);
        }
        return redirect()->route('products_path');
	}

}
