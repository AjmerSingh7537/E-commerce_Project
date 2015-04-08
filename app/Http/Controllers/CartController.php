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
        $this->calculateSubtotal();
        return view('cart', ['items' => $items]);
	}

    /**
     * The following method is used to get the cart items of the logged in user
     *
     * @return mixed
     */
    private function getUsersCartItems()
    {
        $items = Cart::join('cart_details', 'cart.id', '=', 'cart_details.cart_id')
            ->join('products', 'cart_details.product_id', '=', 'products.id')
            ->select('cart_details.product_id', 'products.product_name', 'products.price', 'cart_details.quantity_price', 'cart_details.quantity', 'products.image')
            ->where('user_id', Auth::id())
            ->get();
        $result = array();
        // The following foreach is used to reformat the array that I got from the above query
        foreach($items as $index => $item){
            $result[$index]['product_id'] = $item['product_id'];
            $result[$index]['product_name'] = $item['product_name'];
            $result[$index]['price'] = $item['price'];
            $result[$index]['quantity_price'] = $item['quantity_price'];
            $result[$index]['quantity'] = $item['quantity'];
            $result[$index]['image'] = $item['image'];
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
            $cart_id = Cart::where('user_id', Auth::id())->first();
            if(!empty($cart_id)) {
                $this->storeCartDetails($request->get('product_id'), $cart_id['id'], $product);
            }else{
                $user_cart_id = DB::table('cart')->insertGetId(['user_id' => Auth::id()]);
                $this->storeCartDetails($request->get('product_id'), $user_cart_id, $product);
            }
        }
        else
            $this->storeAnonymousCartDetails($product);
        return redirect()->route('show_cart');
	}

    /**
     * This function returns the index of the searched product if it already exists. Otherwise, false
     *
     * @param $product
     * @param $items
     * @return bool|int|string
     */
    private function getExistingProductIndex($product, $items){
        if(!empty($items)){
            foreach($items as $index => $item){
                if($item['product_id'] === $product->id){
                    return $index;
                }
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
        $asd = $this->getExistingProductIndex($product, $items);
        if($asd !== false){
            $items[$asd]['quantity'] += 1;
            $items[$asd]['quantity_price'] += $product->price;
            Session::put('items', $items);
        }else{
            Session::push('items', [
                'product_id' => $product->id,
                'image' => $product->image,
                'product_name' => $product->product_name,
                'description' => $product->description,
                'price' => $product->price,
                'quantity_price' => $product->price,
                'quantity' => 1
            ]);
        }
    }

    /**
     * This method is use to add products to the cart (database) of a logged in user
     *
     * @param $product_id
     * @param $cart_id
     * @param Products $product
     */
    private function storeCartDetails($product_id, $cart_id, Products $product)
    {
        $product_id_exits = DB::table('cart_details')->where('product_id', $product_id)->first();
        if(!empty($product_id_exits)){
            DB::table('cart_details')
                ->where('product_id', $product_id)
                ->update(
                    [
                        'quantity' => $product_id_exits->quantity + 1,
                        'quantity_price' => $product_id_exits->quantity_price + $product->price
                    ]);
        }else {
            DB::table('cart_details')->insert(
                [
                    'cart_id' => $cart_id,
                    'product_id' => $product_id,
                    'quantity' => 1,
                    'quantity_price' => $product->price
                ]
            );
        }
        $this->updateCartsTotalBalance($cart_id);
    }

    /**
     * This method is used to update the total balance of the cart inside the database (for user)
     *
     * @param $cart_id
     */
    private function updateCartsTotalBalance($cart_id)
    {
        DB::table('cart')
            ->where('id', $cart_id)
            ->update([
                'total_balance' => DB::table('cart_details')->where('cart_id', $cart_id)->sum('quantity_price'),
                'total_quantity' => DB::table('cart_details')->where('cart_id', $cart_id)->sum('quantity')
            ]);
    }

    /**
     * This method is used to calculate the subtotal of anonymous user's cart
     */
    private function calculateSubtotal()
    {
        $subtotal = 0;
        if(Auth::user()){
            $cart_id = Cart::where('user_id', Auth::id())->first();
            if(!empty($cart_id)) {
                $balance = Cart::where('id', $cart_id['id'])->first();
                $subtotal = $balance['total_balance'];
            }
        }else{
            if(Session::has('items'))
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
        if(Auth::user()){
            $cart_id = Cart::where('user_id', Auth::id())->first();
            DB::table('cart_details')->where('product_id', $id)->delete();
            $this->updateCartsTotalBalance($cart_id['id']);
        }else{
            $items = Session::get('items');
            unset($items[$id]);
            Session::put('items', $items);
            $this->calculateSubtotal();
        }
        return redirect()->route('show_cart');
	}

}
