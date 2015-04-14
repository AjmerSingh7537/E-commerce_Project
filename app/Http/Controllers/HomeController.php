<?php namespace App\Http\Controllers;

use App\Cart;
use App\Products;
use Illuminate\Support\Facades\Auth;
use DB;
use Gloudemans\Shoppingcart\Cart as SessionCart;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

    private $session_cart;

    /**
     * Create a new controller instance.
     * @param SessionCart $session_cart
     */
	public function __construct(SessionCart $session_cart)
	{
		$this->middleware('auth');
        $this->session_cart = $session_cart;
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        if(Auth::user() && Auth::user()->type_id === 2)
		    return view('admin/products/products', ['products' => Products::all()]);
        $cart_id = Cart::firstOrCreate(['user_id' => Auth::id()])->toArray();
        $this->storeCart($this->session_cart->content()->toArray(), $cart_id['id']);
        $this->session_cart->destroy();
        return view('home');
	}

    private function storeCart($items, $cart_id)
    {
        foreach($items as $index => $item){
            $product_id_exits = Auth::user()->cart->cart_details()->where('product_id', $item['id'])->first();
            if (!empty($product_id_exits)) {
                Auth::user()->cart->cart_details()->where('product_id', $item['id'])
                    ->update(
                        [
                            'cart_quantity' => $product_id_exits->cart_quantity + $item['qty'],
                            'quantity_price' => $product_id_exits->quantity_price + $item['subtotal']
                        ]);
            }
            else {
                DB::table('cart_details')->insert([
                    'cart_id' => $cart_id,
                    'product_id' => $item['id'],
                    'cart_quantity' => $item['qty'],
                    'quantity_price' => $item['subtotal']
                ]);
            }
        }
        // the following code will be removed soon
        DB::table('cart')
            ->where('id', $cart_id)
            ->update([
                'total_balance' => DB::table('cart_details')->where('cart_id', $cart_id)->sum('quantity_price'),
                'total_quantity' => DB::table('cart_details')->where('cart_id', $cart_id)->sum('cart_quantity')
            ]);
    }
}
