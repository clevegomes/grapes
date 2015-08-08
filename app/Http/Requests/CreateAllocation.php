<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateAllocation extends Request {

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
		$rules=  [
			'check_in'=>'required|date_format:d/m/Y|after:tomorrow',
			'check_out'=>'required|date_format:d/m/Y|after:tomorrow',
			'select_hotel' => 'required',
		];




		foreach($this->request->get('room_allocate') as $key => $val)
		{
			$rules['room_allocate.'.$key] = 'required|numeric|min:0';
		}


	  //	dd($rules);
		return $rules;
	}


	public function messages()
	{

		$messages = [];
		foreach($this->request->get('room_allocate') as $key => $val)
		{
			$data = explode('_',$key);
			$room_typeobj = \DB::table('room_types')->where('room_type_id','=',$data[1])->select('room_type_name')->first();
			$messages['room_allocate.'.$key.'.required'] = "The room allocation for $room_typeobj->room_type_name is required";
			$messages['room_allocate.'.$key.'.numeric'] = "The room allocation for $room_typeobj->room_type_name must be numeric";
			$messages['room_allocate.'.$key.'.min'] = "The room allocation for $room_typeobj->room_type_name must be a positive number";



		}


		return $messages;
	}

}
