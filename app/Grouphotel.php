<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Grouphotel extends Model {

	//

	protected $table = 'group_hotel';

	public function group()
	{
		return $this->belongsTo('App\Group','agent_id','id');
	}


	public function getHotelIdAttribute($hotel_id){

		$hotelobj = Hotel::where('hotel_id','=',$hotel_id)->first();
		return array('hotel_id'=>$hotel_id,'hotel_name'=>$hotelobj->hotel_name);
	}
	
	public function getCheckinDateAttribute($date)
	{


		return Carbon::parse($date)->format('d/m/Y');

	}

	public function getCheckoutDateAttribute($date)
	{


		return Carbon::parse($date)->format('d/m/Y');

	}

}
