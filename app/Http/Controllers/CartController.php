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
        if(Auth::user() && Auth::user()->type_id !== 2) {
            $cart_id = Cart::firstOrCreate(['user_id' => Auth::id()])->toArray();
            $items = Auth::user()->cart->cart_details()->join('products', 'products.id', '=', 'cart_details.product_id')->get()->toArray();
        }
        else
            $items = Session::get('items');
        $this->calculateSubtotal();
        return view('cart', ['items' => $items]);
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
            $this->storeAnonymousCartDetails($product);
        return redirect()->route('show_cart');
	}

    /**
     * This function returns the index of the searched product if it already exists. Otherwise, false
     * It is used for the anonymous user's cart
     *
     * @param $product
     * @param $items
     * @return bool|int|string
     */
    private function getExistingProductIndex($product, $items){
        if(!empty($items)){
            foreach($items as $index => $item){
                if($item['product_id'] === $product->id)
                    return $index;
            }
        }
        return false;
    }

    /**
     * This method is storing all the products inside the cart (session) for the anonymous user
     *
     * @param $product
     */
    private function storeAnonymousCartDetails($product)
    {
        $items = Session::get('items');
        $index = $this->getExistingProductIndex($product, $items);
        if($index !== false){
            $items[$index]['cart_quantity'] += 1;
            $items[$index]['quantity_price'] += $product->price;
            Session::put('items', $items);
        }else{
            Session::push('items', [
                'product_id' => $product->id,
                'image' => $product->image,
                'product_name' => $product->product_name,
                'description' => $product->description,
                'price' => $product->price,
                'quantity_price' => $product->price,
                'cart_quantity' => 1
            ]);
        }
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
     * This method is used to calculate the subtotal of anonymous user's cart
     */
    private function calculateSubtotal()
    {
        $subtotal = 0;
        if(Auth::user())
            $subtotal = Auth::user()->cart->total_balance;
        else{
            if(Session::get('items'))
                foreach(Session::get('items') as $item){
                    $subtotal += $item['quantity_price'];
                }
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
		//
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
        if(Auth::user()){
            Auth::user()->cart->cart_details()->where('product_id', $id)->delete();
            $this->updateCartsTotalBalance(Auth::user()->cart->id);
        }else{
            $items = Session::get('items');
            unset($items[$id]);
            Session::put('items', $items);
        }
        return redirect()->route('show_cart');
	}

}
