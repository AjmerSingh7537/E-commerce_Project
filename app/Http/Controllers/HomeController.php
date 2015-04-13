<?php namespace App\Http\Controllers;

use App\Cart;
use App\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use DB;

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

    /**
     * Create a new controller instance.
     *
     */
	public function __construct()
	{
		$this->middleware('auth');
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
        if(Session::has('items') && Auth::user()->type_id === 1){
            $items = Session::get('items');
            $cart_id = Cart::firstOrCreate(['user_id' => Auth::id()])->toArray();
            $this->storeCart($items, $cart_id['id']);
            Session::forget('items');
        }
        return view('home');
	}

    private function storeCart($items, $cart_id)
    {
        foreach($items as $item){
            $product_id_exits = Auth::user()->cart->cart_details()->where('product_id', $item['product_id'])->first();
            if(!empty($product_id_exits)){
                Auth::user()->cart->cart_details()->where('product_id', $item['product_id'])
                    ->update(
                        [
                            'cart_quantity' => $product_id_exits->cart_quantity + $item['cart_quantity'],
                            'quantity_price' => $product_id_exits->quantity_price + $item['quantity_price']
                        ]);
            }else{
                DB::table('cart_details')->insert([
                    'cart_id' => $cart_id,
                    'product_id' => $item['product_id'],
                    'cart_quantity' => $item['cart_quantity'],
                    'quantity_price' => $item['quantity_price']
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
