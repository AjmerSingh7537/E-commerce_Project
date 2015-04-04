<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddProductRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'category_id' => 'required|not_in:0',
			'product_name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'slug' => 'required|unique:products',
		];
	}

}
