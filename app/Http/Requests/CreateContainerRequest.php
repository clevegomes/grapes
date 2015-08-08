<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateContainerRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return (\Auth::user())?true:false;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'title'=>'required|min:3',
			'description'=>'required|min:3'
			//'pages'=>'required'
		];
	}

}
