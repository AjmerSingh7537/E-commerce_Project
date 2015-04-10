<?php namespace App\Http\Controllers;

use App\Http\Requests;

use App\Http\Requests\AddReviewRequest;
use App\Products;
use App\Reviews;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewsController extends Controller {

    private $reviews;

    public function __construct(Reviews $reviews)
    {
        $this->reviews = $reviews;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param AddReviewRequest $request
     * @return Response
     */
	public function store(AddReviewRequest $request)
	{
        $inputs = $request->all();
//        $product = Products::find('id', $inputs['product_id'])->first();
        $this->reviews->product_id = $inputs['product_id'];
        $this->reviews->user_id = Auth::id();
        $this->reviews->comment = $inputs['comment'];
        $this->reviews->ratings = $inputs['ratings'];
        $this->reviews->save();
        DB::table('products')->where('id', $inputs['product_id'])
            ->update([
                'rating_count' => DB::table('reviews')->where('product_id', $inputs['product_id'])->count(),
                'rating_cache' => DB::table('reviews')->where('product_id', $inputs['product_id'])->avg('ratings')
            ]);
        return redirect()->back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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
		//
	}

}
