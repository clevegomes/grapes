<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Group extends Model {

	//


	protected  $table = 'agents';
	protected $fillable = ['group_name',
	'group_code',
	'company_name',
	'agent_fname',
	'agent_lname',
	'agent_address',
	'agent_city',
    'active',
    'region',
	'contact_no',
	'email_id',
	'country',
	'region',
	'hotels',
	'date_start',
	'date_end',
	'date_cutout',
	'no_rooms'];




	public function getGpStartDateAttribute($date)
	{

		return Carbon::parse($date)->format('d/m/Y');

	}


	public function getGpEndDateAttribute($date){


		return Carbon::parse($date)->format('d/m/Y');
	}

	public function getExpireDateAttribute($date)
	{

		return $date;

	}

	public function hotel()
	{
		return $this->hasMany('App\Hotel','agent_id','id');
	}
}
