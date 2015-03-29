<?php namespace App\Http\Controllers;

use App\Categories;
use App\Http\Requests;
use App\Http\Requests\AddCategoryRequest;

class CategoriesController extends Controller {

    private $category;
    public function __construct(Categories $category)
    {
        $this->category = $category;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $categories = $this->category->get();
		return view('categories', ['categories' => $categories]);
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
	 * @return Response
	 */
	public function store(AddCategoryRequest $request)
	{
        $category_name = $request->input('category_name');
        $this->category->category_name = $category_name;
        $this->category->save();
        return redirect()->route('categories.index');
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
		$category = $this->category->where('id', $id);
        $category->delete();
        return redirect()->route('categories.index');
	}

}
