<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateRoomListingRequest extends Request {

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

        $rules= [

			'hotel_id'=>'required',
			'no_of_rooms'=>'required|numeric',
            'no_adults'=>'required|numeric',
            'no_child'=>'required|numeric',
            'arr_flight_no'=>'required|alpha_num',
            'dept_flight_no'=>'required|alpha_num',
            'arrival_dt'=>'required|date_format:d/m/Y',
            'departure_dt'=>'required|date_format:d/m/Y',
		];
        foreach($this->request->get('adult_first_name') as $key => $val)
        {
            $rules['adult_first_name.'.$key] = 'required|alpha_num';
        }
        foreach($this->request->get('adult_last_name') as $key => $val)
        {
            $rules['adult_last_name.'.$key] = 'required|alpha_num';
        }
        foreach($this->request->get('special_request') as $key => $val)
        {
            $rules['special_request.'.$key] = 'required';
        }
        foreach($this->request->get('dob') as $key => $val)
        {
            $rules['dob.'.$key] = 'required|date_format:d/m/Y';
        }
        return $rules;
	}

}
