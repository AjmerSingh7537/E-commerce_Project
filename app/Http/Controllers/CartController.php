<?php namespace App\Http\Controllers;

use App\Cart;
use App\Http\Requests\CartRequest;
use App\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Cart as SessionCart;

class CartController extends Controller {

    private $cart;
    private $session_cart;

    /**
     * Initializing cart
     *
     * @param Cart $cart
     * @param SessionCart $session_cart
     */
    public function __construct(Cart $cart, SessionCart $session_cart)
    {
        $this->cart = $cart;
        $this->session_cart = $session_cart;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
//        $items = Auth::user()->cart->cart_details()->join('products', 'products.id', '=', 'cart_details.product_id')->get();
//        print_r($this->convertToArray($items));
        if(Auth::user() && Auth::user()->type_id !== 2) {
            $cart_id = Cart::firstOrCreate(['user_id' => Auth::id()])->toArray();
            $result = Auth::user()->cart->cart_details()->join('products', 'products.id', '=', 'cart_details.product_id')->get();
            $items = $this->convertToArray($result);
        }
        else
            $items = $this->session_cart->content()->toArray();
        $this->calculateSubtotal();
        return view('cart', ['items' => $items]);
	}

    private function convertToArray($items)
    {
        $result = array();
        foreach($items as $item){
            $result[$item['product_id']]['name'] = $item['product_name'];
            $result[$item['product_id']]['price'] = $item['price'];
            $result[$item['product_id']]['qty'] = $item['cart_quantity'];
            $result[$item['product_id']]['subtotal'] = $item['quantity_price'];
            $result[$item['product_id']]['options'] = ['image' => $item['image'], 'description' => $item['description']];
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
            $cartObj = Cart::firstOrCreate(['user_id' => Auth::id()]);
            $this->storeCartDetails($cartObj, $product);
        }
        else
            $this->session_cart->add($product->id, $product->product_name, 1, $product->price, ['image' => $product->image, 'description' => $product->description]);
        return redirect()->route('show_cart');
	}

    /**
     * This method is use to add products to the cart (database) of a logged in user
     *
     * @param $cartObj
     * @param Products $product
     */
    private function storeCartDetails($cartObj, Products $product)
    {
        $product_id_exits = Auth::user()->cart->cart_details()->where('product_id', $product->id)->first();
        if(!empty($product_id_exits)){
            Auth::user()->cart->cart_details()->where('product_id', $product->id)
                ->update(
                    [
                        'cart_quantity' => $product_id_exits->cart_quantity + 1,
                        'quantity_price' => $product_id_exits->quantity_price + $product->price
                    ]);
        }else {
            DB::table('cart_details')->insert(
                [
                    'cart_id' => $cartObj->id,
                    'product_id' => $product->id,
                    'cart_quantity' => 1,
                    'quantity_price' => $product->price
                ]
            );
        }
        $this->updateCartsTotalBalance($cartObj->id);
    }

    /**
     * This method is used to update the total balance of the cart inside the database
     * (for logged in user)
     *
     * @param $cart_id
     */
    private function updateCartsTotalBalance($cart_id)
    {
        DB::table('cart')
            ->where('id', $cart_id)
            ->update([
                'total_balance' => DB::table('cart_details')->where('cart_id', $cart_id)->sum('quantity_price'),
                'total_quantity' => DB::table('cart_details')->where('cart_id', $cart_id)->sum('cart_quantity')
            ]);
    }

    /**
     * This method is used to calculate the subtotal of anonymous user's cart and logged in user's cart
     */
    private function calculateSubtotal()
    {
        if(Auth::user())
            $subtotal = Auth::user()->cart->total_balance;
        else
            $subtotal = $this->session_cart->total();
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
		//
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param CartRequest $request
     * @return Response
     * @throws \Gloudemans\Shoppingcart\Exceptions\ShoppingcartInvalidRowIDException
     */
	public function update($id, CartRequest $request)
	{
        $qty = $request->get('qty');
        $result['rowid'] = $id;
        if(Auth::user()){
            $product = Products::where('id', $id)->first();
            Auth::user()->cart->cart_details()->where('product_id', $id)
                ->update(
                    [
                        'cart_quantity' => $qty,
                        'quantity_price' => $qty * $product->price
                    ]);
            $this->updateCartsTotalBalance(Auth::user()->cart->id);
        }else {
            $this->session_cart->update($id, $qty);
            $sessionObj = $this->session_cart->get($id);
            $result['subtotal'] = $sessionObj['subtotal'];
        }
        if($request->ajax()) return $result;
        return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        if(Auth::user()){
            Auth::user()->cart->cart_details()->where('product_id', $id)->delete();
            $this->updateCartsTotalBalance(Auth::user()->cart->id);
        }
        else
            $this->session_cart->remove($id);
        return redirect()->route('show_cart');
	}

}
