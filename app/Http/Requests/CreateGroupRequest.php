<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateGroupRequest extends Request {

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
			'group_code'=>'required|alpha_num|max:8|min:2',
			'company_name'=>'required|min:2|max:25',
			'hotels'=>'required',
			'agent_fname'=>'required|min:2|max:25',
			'agent_lname'=>'required|min:2|max:25',
			'agent_address'=>'required|min:10|max:100',
			'agent_city'=>'required|min:2|max:25',
			'contact_no'=>'required|min:2|max:10',
			'email_id'=>'required|email',
			'date_start'=>'required|date_format:d/m/Y|after:tomorrow',
			'date_end'=>'required|date_format:d/m/Y|after:tomorrow',
			'date_cutout'=>'required|date_format:d/m/Y|after:tomorrow',
			'no_rooms'=>'required|numeric'

		];
	}

}
