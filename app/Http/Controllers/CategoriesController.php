<?php namespace App\Http\Controllers;

use App\Categories;
use App\Http\Requests;
use App\Http\Requests\AddCategoryRequest;

class CategoriesController extends Controller {

    private $category;

    public function __construct(Categories $category)
    {
        $this->category = $category;
        $this->middleware('admin');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $categories = $this->category->get();
        return view('admin/categories/categories', ['categories' => $categories]);
	}

	/**
	 * Store a newly created resource in storage.
	 * @param $request
	 * @return Response
	 */
	public function store(AddCategoryRequest $request)
	{
        $category = new Categories($request->all());
        $category->save();
        return redirect()->route('categories');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->category->where('id', $id)->delete();
        return redirect()->route('categories');
	}

}
