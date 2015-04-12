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
        $data = $request->all();
        $product = Products::whereSlug($data['product_slug'])->first();
        $review = new Reviews($data);
        $review->user()->associate(Auth::user());
        $review->product()->associate($product);
        $review->save();
        $this->updateRatingCount($product);
        return redirect()->back();
	}

    private function updateRatingCount($product)
    {
        DB::table('products')->where('id', $product->id)
            ->update([
                'rating_count' => DB::table('reviews')->where('product_id', $product->id)->count(),
                'rating_cache' => DB::table('reviews')->where('product_id', $product->id)->avg('ratings')
            ]);
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
