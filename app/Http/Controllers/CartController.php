<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CartRequest;
use App\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('cart', ['items' => Session::get('items')]);
		//return "Product name: " . Session::get('product_name') . "\nDescription: " . Session::get('description') . "\nPrice: " . Session::get('price');
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
        //Session::forget('items');
        $product = $product->where('id', $request->get('product_id'))->first();
        if(Auth::user()){
            //
        }else{
            Session::push('items', [
                'image' => 'img/products/' . $product->image,
                'product_name' => $product->product_name,
                'description' => $product->description,
                'price' => $product->price,
                'quantity' => 1
            ]);
            $this->calculateSubtotal();
        }
        return redirect()->route('show_cart');
	}

    private function calculateSubtotal()
    {
        $subtotal = 0;
        foreach(Session::get('items') as $item){
            $subtotal += $item['price'] * $item['quantity'];
        }
        Session::put('subtotal', $subtotal);
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
        $items = Session::get('items');
        Session::forget('items');
//		Session::forget('items');
        return redirect()->route('show_cart');
	}

}
