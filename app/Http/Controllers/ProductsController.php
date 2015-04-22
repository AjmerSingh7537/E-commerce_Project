<?php namespace App\Http\Controllers;

use App\Categories;
use App\Http\Requests;
use App\Http\Requests\AddProductRequest;
use App\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller {

    private $product;

    /**
     * @param Products $product
     */
    public function __construct(Products $product)
    {
        $this->product = $product;
        $this->middleware('admin', ['only' => ['create', 'edit']]);
        $this->middleware('auth', ['except' => ['index', 'show', 'sortByCategory']]);
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('products', ['products' => $this->product->get(), 'categories' => $this->categoryList()]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('admin/products/add_product', ['categories' => $this->categoryList()]);
	}

    /**
     * Returns an array containing all the categories names
     *
     * @return array
     */
    private function categoryList()
    {
        $categories = array();
        $categories[0] = 'Select a category';
        foreach(Categories::all() as $category){
            $categories[$category->id] = $category->category_name;
        }
        return $categories;
    }

    /**
     * Returns the list of products(JSON) in a specific category
     *
     * @param Request $request
     * @return string
     */
    public function sortByCategory(Request $request)
    {
        $selectedCategory = $request->get('category');

        if($selectedCategory == "0") $products = Products::all()->toJson();
        else $products = Products::where('category_id', $selectedCategory)->get()->toJson();
        if($request->ajax()) return $products;
    }

    public function search()
    {
        //
    }

	/**
	 * Store a newly created resource in storage.
	 *
     * @param $request
	 * @return Response
	 */
	public function store(AddProductRequest $request)
	{
        $data = $request->all();
        $data['image'] = $this->imageModifier($request, $data);
        $this->sameValues($data, $this->product);
        return redirect('home'); //this is where all the products are listed for the admin
	}

    /**
     * Retrieve the input values and store them into the database
     *
     * @param $data
     * @param $product
     */
    private function sameValues($data, $product)
    {
        $product->category_id = $data['category_id'];
        $product->product_name = $data['product_name'];
        $product->description = $data['description'];
        $product->price = $data['price'];
        $product->slug = snake_case(trim(ucwords($data['slug'])));
        if((!empty($product->image)) && $product->image !== 'default.jpg'){
            unlink('img/products/' . $product->image);
        }
        $product->image = $data['image'];
        $product->save();
    }

    /**
     * Change the image name, move it to img/products, and return its new name
     *
     * @param $request
     * @param $data
     * @return string
     */
    private function imageModifier($request, $data)
    {
        if(empty($data['image'])){
            $filename = 'default.jpg';
        }else{
            $ext = $request->file('image')->getClientOriginalExtension();
            $filename = uniqid() . "." . $ext;
            $request->file('image')->move('img/products/', $filename);
        }
        return $filename;
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  $product
	 * @return Response
	 */
	public function show(Products $product)
	{
        $reviews = $product->reviews()->orderBy('created_at', 'dsc')->get();
        return view('product_details', ['product' => $product, 'reviews' => $reviews]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  $product
	 * @return Response
	 */
	public function edit(Products $product)
	{
        return view('admin/products/edit_product', ['product' => $product, 'categories' => $this->categoryList()]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  $product
     * @param $request
	 * @return Response
	 */
	public function update(Products $product, AddProductRequest $request)
	{
        $data = $request->all();
        $data['image'] = $this->imageModifier($request, $data);
        $this->sameValues($data, $product);
        return redirect('home'); //this is where all the products are listed for the admin
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  $product
	 * @return Response
	 */
	public function destroy(Products $product)
	{
        $filename = $product->image;
        $product->delete();
        if($filename !== 'default.jpg')
            unlink('img/products/' . $filename);
        return redirect()->back();
	}

}
