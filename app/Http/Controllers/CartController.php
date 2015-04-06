<?php namespace App\Http\Controllers;

use App\Cart;
use App\Http\Requests;
use App\Http\Requests\CartRequest;
use App\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller {

    private $cart;

    /**
     * Initializing cart
     *
     * @param Cart $cart
     */
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        if(Auth::user() && Auth::user()->type_id !== 2)
            $items = $this->getUsersCartItems();
        else
            $items = Session::get('items');
        return view('cart', ['items' => $items]);
	}

    private function getUsersCartItems()
    {
        $items = DB::table('cart')
            ->join('cart_details', 'cart.id', '=', 'cart_details.cart_id')
            ->join('products', 'cart_details.product_id', '=', 'products.id')
            ->select('cart_details.product_id', 'products.product_name', 'cart_details.price', 'cart_details.quantity', 'products.image')
            ->get();
        $result = array();
        foreach ($items as $index => $item) {
            $result[$index]['product_id'] = $item->product_id;
            $result[$index]['product_name'] = $item->product_name;
            $result[$index]['price'] = $item->price;
            $result[$index]['quantity'] = $item->quantity;
            $result[$index]['image'] = $item->image;
        }
        return $result;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CartRequest $request
     * @param Products $product
     * @return Response
     */
	public function store(CartRequest $request, Products $product)
	{
        $product = $product->where('id', $request->get('product_id'))->first();
        if(Auth::user()){
            if(Session::has('cart_id')) {
                $this->storeCartDetails($request->get('product_id'), Session::get('cart_id'), $product);
            }
            else{
                $cart_id = Cart::where('user_id', Auth::id())->first();
                if(!empty($cart_id)) {
                    $this->storeCartDetails($request->get('product_id'), $cart_id['id'], $product);
                }else{
                    $user_cart_id = DB::table('cart')->insertGetId(['user_id' => Auth::id()]);
                    $this->storeCartDetails($request->get('product_id'), $user_cart_id, $product);
                }
            }
        }
        else{
            Session::push('items', [
                'product_id' => $product->id,
                'image' => $product->image,
                'product_name' => $product->product_name,
                'description' => $product->description,
                'price' => $product->price,
                'quantity' => 1
            ]);
            $this->calculateSubtotal();
        }
        return redirect()->route('show_cart');
	}

    private function storeCartDetails($product_id, $cart_id, Products $product)
    {
        $product_id_exits = DB::table('cart_details')->where('product_id', $product_id)->first();
        if(!empty($product_id_exits)){
            DB::table('cart_details')
                ->where('product_id', $product_id)
                ->update(
                    [
                        'quantity' => $product_id_exits->quantity + 1,
                        'price' => $product_id_exits->price + $product->price
                    ]);
        }else {
            DB::table('cart_details')->insert(
                [
                    'cart_id' => $cart_id,
                    'product_id' => $product_id,
                    'quantity' => 1,
                    'price' => $product->price
                ]
            );
        }
        DB::table('cart')
            ->where('id', $cart_id)
            ->update([
                'total_balance' => DB::table('cart_details')->sum('price'),
                'total_quantity' => DB::table('cart_details')->sum('quantity')
            ]);
        if(!Session::has('cart_id')){
            Session::put('cart_id', $cart_id);
        }
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
        unset($items[$id]);
        Session::put('items', $items);
        $this->calculateSubtotal();
        return redirect()->route('show_cart');
	}

}
