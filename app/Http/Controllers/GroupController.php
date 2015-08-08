<?php namespace App\Http\Controllers;

use App\Country;
use App\Group;
use App\Grouphotel;
use App\Hotel;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Region;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Monolog\Handler\NullHandlerTest;

class GroupController extends Controller {



	protected $user;

	function __construct()
	{
		$this->middleware('auth');

	}




	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{


		$region = Region::lists('region_name','region_id');
		$region[-1]= 'All';
		$i = 1;
		$groups = Group::all()->where('created_by','group sys')->where('is_deleted','=',0);
		return view('group.index',compact(['groups','region','i']));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		$group = new Group();
		$group->country = 'UAE';
		$group->region = -1;
		$group->status = 1;
		$region = Region::lists('region_name','region_id');
		$region[-1]= 'All';
		$country = Country::lists('short_name','iso3');
		$gp_hotel = null;

		$hotel = Hotel::where('status','=',1)->where('expiry_date','>=',time())->orderBy('hotel_name', 'asc')->lists('hotel_name','hotel_id');


		return view('group.create',compact('group','country','region','gp_hotel','hotel'));









	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Requests\CreateGroupRequest $request)
	{




		$group_obj = new Group();

		$group_obj->channel_id =  Config::get('constants.channel_POA');
		$group_obj->agent_system =  Config::get('constants.agent_system');
		$group_obj->firstname = $request->agent_fname;
		$group_obj->lastname = $request->agent_lname;
		$group_obj->username = $request->group_code;
		$group_obj->email = $request->email_id;
		$group_obj->company_name = $request->company_name;
		$group_obj->address = $request->agent_address;
		$group_obj->city = $request->agent_city;
		$group_obj->country = $request->country;
		$group_obj->phone = $request->contact_no;
		$group_obj->region = $request->region;
		$group_obj->createdon = time();
		$group_obj->status = $request->active;
		$group_obj->agent_type =  Config::get('constants.agent_type');
		$group_obj->expire_date = $request->date_cutout;
		$date_start_arr = explode('/',$request->date_start);


		$group_obj->gp_start_date = Carbon::createFromDate($date_start_arr[2],$date_start_arr[1],$date_start_arr[0]);

		$date_end_arr = explode('/',$request->date_end);
		$group_obj->gp_end_date =  Carbon::createFromDate($date_end_arr[2],$date_end_arr[1],$date_end_arr[0]);
		$group_obj->created_by = 'group sys';
		$group_obj->no_rooms = $request->no_rooms;


		$group_obj->save();

		foreach($request->hotels as $key => $hotel)
		{
			$hotel_obj[$key] = new Grouphotel();
			$hotel_obj[$key]->hotel_id = $hotel;
			$hotel_obj[$key]->checkin_date  = Carbon::createFromDate($date_start_arr[2],$date_start_arr[1],$date_start_arr[0]);
			$hotel_obj[$key]->checkout_date =  Carbon::createFromDate($date_end_arr[2],$date_end_arr[1],$date_end_arr[0]);
			$hotel_obj[$key]->agent_id = $group_obj->id;
			$hotel_obj[$key]->save();


		}

		return redirect('group');



	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Group $group)
	{

		$region = Region::lists('region_name','region_id');
		$region[-1]= 'All';
		$country = Country::lists('short_name','iso3');
		$gp_hotel_arry = Grouphotel::where('agent_id','=',$group->id)->where('is_deleted','=',0)->lists('hotel_id');

		foreach($gp_hotel_arry as $key => $val)
		{
			$gp_hotel[$key] = $val['hotel_id'];
		}

		$hotel = Hotel::where('status','=',1)->where('country','=','UAE')->where('expiry_date','>=',time())->orderBy('hotel_name', 'asc')->lists('hotel_name','hotel_id');


		return view('group.edit',compact('group','country','region','gp_hotel','hotel'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Group $group_obj,Requests\CreateGroupRequest $request)
	{






		$group_obj->channel_id =  Config::get('constants.channel_POA');
		$group_obj->agent_system =  Config::get('constants.agent_system');
		$group_obj->firstname = $request->agent_fname;
		$group_obj->lastname = $request->agent_lname;
		$group_obj->username = $request->group_code;
		$group_obj->email = $request->email_id;
		$group_obj->company_name = $request->company_name;
		$group_obj->address = $request->agent_address;
		$group_obj->city = $request->agent_city;
		$group_obj->country = $request->country;
		$group_obj->phone = $request->contact_no;
		$group_obj->region = $request->region;
		$group_obj->createdon = time();
		$group_obj->status = $request->active;
		$group_obj->agent_type =  Config::get('constants.agent_type');
		$group_obj->expire_date = $request->date_cutout;
		$date_start_arr = explode('/',$request->date_start);


		$group_obj->gp_start_date = Carbon::createFromDate($date_start_arr[2],$date_start_arr[1],$date_start_arr[0]);

		$date_end_arr = explode('/',$request->date_end);
		$group_obj->gp_end_date =  Carbon::createFromDate($date_end_arr[2],$date_end_arr[1],$date_end_arr[0]);
		$group_obj->created_by = 'group sys';
		$group_obj->no_rooms = $request->no_rooms;


		$group_obj->save();
		$gho  = Grouphotel::where('agent_id','=',$group_obj->id)->get();


		$pre_hotel_arry = array();
		foreach ($gho as $selgho)
		{

			$pre_hotel_arry[$selgho->hotel_id['hotel_id']] = $selgho;
			$selgho->deleted_at = Carbon::now();
			$selgho->is_deleted = 1;
			$selgho->save();
		}
		foreach($request->hotels as $key => $hotel)
		{


			if(array_key_exists($hotel,$pre_hotel_arry))
			{
				$pre_hotel_arry[$hotel]->deleted_at = null;
				$pre_hotel_arry[$hotel]->is_deleted = 0;
				$pre_hotel_arry[$hotel]->save();
			}
			else
			{
				$hotel_obj[$key] = new Grouphotel();
				$hotel_obj[$key]->hotel_id = $hotel;
				$hotel_obj[$key]->checkin_date  = Carbon::createFromDate($date_start_arr[2],$date_start_arr[1],$date_start_arr[0]);
				$hotel_obj[$key]->checkout_date =  Carbon::createFromDate($date_end_arr[2],$date_end_arr[1],$date_end_arr[0]);
				$hotel_obj[$key]->agent_id = $group_obj->id;
				$hotel_obj[$key]->save();
			}


		}

		return redirect('group');

	}


	public function del(Group $group){

		$gho  = Grouphotel::where('agent_id','=',$group->id)->get();

		foreach ($gho as $selgho)
		{

			$selgho->deleted_at = Carbon::now();
			$selgho->is_deleted = 1;
			$selgho->save();
		}
		$group->deleted_at = Carbon::now();
		$group->is_deleted = 1;
		$group->save();
		\Session::flash('flashmsg','Group deleted successfully');
		\Session::flash('flashstatus','success');
		return redirect('group');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Group $group)
	{

		$gho  = Grouphotel::where('agent_id','=',$group->id)->get();

		foreach ($gho as $selgho)
		{

			$selgho->deleted_at = Carbon::now();
			$selgho->is_deleted = 1;
			$selgho->save();
		}
		$group->deleted_at = Carbon::now();
		$group->is_deleted = 1;
		$group->save();
		\Session::flash('flashmsg','Group deleted successfully');
		\Session::flash('flashstatus','success');
		return redirect('group');
	}

}
