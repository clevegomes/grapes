<?php namespace App\Http\Controllers;

use App\Group;
use App\Grouphotel;
use App\Grouproom;
use App\Hotel;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\InventoryAllotment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Session\Session;

class AllocationController extends Controller {

	function __construct()
	{
		$this->middleware('auth');


	}



	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($group)
	{


		$grouphotels = Grouphotel::where('agent_id','=', $group->id)->where('is_deleted','=',0)->get();
		$group = Group::findorFail($grouphotels[0]->agent_id);
		$count=1;

		return view('alloc.index',compact('group','grouphotels','count'));
	}

/*
 * Available rooms , Allocated Rooms for each room type
 */
	public function get_hotelallocationdetails($ghotel_id,$groupid){

		$hotel_id = Grouphotel::findorFail($ghotel_id)->hotel_id['hotel_id'];


		$queryobj = DB::table('group_hotel as gp')->join('hotels','gp.hotel_id','=','hotels.hotel_id')->where('agent_id','=',$groupid)->where('is_deleted','=',0);
		$hotels_date = $queryobj->where('gp.hotel_id','=',$hotel_id)->select('checkin_date','checkout_date')->get();

		$hotel_details['checkin_date'] = Carbon::parse($hotels_date[0]->checkin_date)->format('d/m/Y');
		$hotel_details['checkout_date'] = Carbon::parse($hotels_date[0]->checkout_date)->format('d/m/Y');
		 $hotels_roomtype =$queryobj->join('room_config','hotels.hotel_id','=','room_config.hotel_id')->join('room_types','room_types.room_type_id','=','room_config.room_id')
			->where('room_types.room_type_name' ,'<>','default')
			->where('room_config_status','=',1)
			->groupBy('room_types.room_type_name')->select('room_types.room_type_id','room_types.room_type_name','gp.id')->get();

		$agentobj = Group::where('id','=',$groupid)->select('region','id')->first();


		foreach($hotels_roomtype as $hotels_roomtypeobj)
		{

			$region = $agentobj->region;
			$agentid = $agentobj->id;
			$room_type_id = $hotels_roomtypeobj->room_type_id;
			$allotmentquery = InventoryAllotment::where('inverntory_hotelid','=',$hotel_id)
				->where(function($qry) use ($region){
				$qry->where('inventory_regionid','=',$region);
				$qry->orwhere('inventory_regionid','=',-1);
				})
				->where(function($qry) use ($agentid){
					$qry->where('inventory_agentid','=',$agentid);
					$qry->orwhere('inventory_agentid','=',-1);
				})
			  ->where(function($qry) use ($room_type_id){
				$qry->where('inventory_roomtypeid','=',$room_type_id);
				$qry->orwhere('inventory_roomtypeid','=',-1);
		})
				->where('inventory_date','>=', Carbon::parse($hotels_date[0]->checkin_date)->format('Y-m-d') )
				->where('inventory_date','<=', Carbon::parse($hotels_date[0]->checkout_date)->format('Y-m-d') )
			    ->orderBy('inventory_regionid','desc')
			    ->orderBy('inventory_agentid','desc')
			    ->orderBy('inventory_roomtypeid','desc');


			$allotment = ($allotmentquery->count()>0)?$allotmentquery->max('inventory_rooms'):0;



			$roomtype[$hotels_roomtypeobj->room_type_id] = $hotels_roomtypeobj->room_type_name;
			$query = Grouproom::where('group_hotel_id','=',$hotels_roomtypeobj->id)->where('room_type_id','=',$hotels_roomtypeobj->room_type_id);
			if($query->count())
			{

				$grouproom = $query->first();
				$available_rooms[$hotels_roomtypeobj->room_type_id] = array("no_rooms"=>$grouproom->no_rooms,"available"=>$allotment,'name'=>$hotels_roomtypeobj->room_type_name);
			}
			else
				$available_rooms[$hotels_roomtypeobj->room_type_id] = array("no_rooms"=>0,"available"=>$allotment,'name'=>$hotels_roomtypeobj->room_type_name);





		}


		 return $available_rooms;

	}



	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{


	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Requests\CreateAllocation $request)
	{

		$errors =[];
		if($request->check_in >= $request->check_out)
		{
			$errors[] = "Checkout date must be greater than the checkin date";
		}
		foreach($request->get('room_allocate') as $key => $val)
		{
			if($val > $request->room_avail[$key])
			{
				$data = explode('_',$key);
				$room_typeobj = \DB::table('room_types')->where('room_type_id','=',$data[1])->select('room_type_name')->first();
				$errors[] = "The room allocation for $room_typeobj->room_type_name cannot be more than available rooms";

			}

		}
		if(sizeof($errors) > 0)
		{
			return redirect()->route('alloc.create')->withInput()->withErrors(['error' =>$errors]);
		}





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
	public function edit($ghotel_id)
	{




		$queryobj = DB::table('group_hotel as gp')->leftjoin('hotels','gp.hotel_id','=','hotels.hotel_id')->where('id','=',$ghotel_id)->where('is_deleted','=',0);
		$hotellist = $queryobj->select('gp.id','hotel_name','hotels.hotel_id','agent_id')->get('id','hotel_name','hotel_id','agent_id');


		foreach($hotellist as $key => $hotelobj)
		{
			$hotels[$hotelobj->hotel_id] = $hotelobj->hotel_name;
			$groupid = $hotelobj->agent_id;
		}

		$group = Group::findorFail($groupid);


		$room_types = $this->get_hotelallocationdetails($ghotel_id,$groupid);

		$selected_hotel = $ghotel_id;
		$grouphotel = Grouphotel::where('id','=',$hotellist[0]->id)->first();

		return view('alloc.edit',compact('grouphotel','hotels','checkin_date','checkout_date','room_types','selected_hotel','group'));


	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Requests\CreateAllocation $request,$id)
	{
		$errors =[];
		$groupid =  Grouphotel::where('id','=',$id)->lists('agent_id')[0];




		if($request->check_in >= $request->check_out)
		{
			$errors[] = "Checkout date must be greater than the checkin date";
		}
		foreach($request->get('room_allocate') as $key => $val)
		{
			if($val > $request->room_avail[$key])
			{
				$data = explode('_',$key);
				$room_typeobj = \DB::table('room_types')->where('room_type_id','=',$data[1])->select('room_type_name')->first();
				$errors[] = "The room allocation for $room_typeobj->room_type_name cannot be more than available rooms";

			}

		}
		if(sizeof($errors) > 0)
		{
			return redirect()->action('AllocationController@edit',$id)->withInput()->withErrors(['error' =>$errors]);
		}


		$groupobj = Grouphotel::where('agent_id','=',$groupid)->where('id','=',$id)->first();
		$date_start_arr = explode('/',$request->check_in);
		$groupobj->checkin_date = Carbon::createFromDate($date_start_arr[2],$date_start_arr[1],$date_start_arr[0]);
		$date_start_arr = explode('/',$request->check_out);
		$groupobj->checkout_date = Carbon::createFromDate($date_start_arr[2],$date_start_arr[1],$date_start_arr[0]);

		$groupobj->save();

		foreach($request->get('room_allocate') as $key => $val)
		{

			$fragments = explode('_',$key);
			$grouprmqry = Grouproom::where('group_hotel_id','=',$groupobj->id)->where('room_type_id','=',$fragments[1]);

			if($grouprmqry->count() ==0)
			{
				$grouprmobj = new Grouproom();
				$grouprmobj->group_hotel_id = $groupobj->id;
				$grouprmobj->room_type_id = $fragments[1];

			}
			else
			{
				$grouprmobj = $grouprmqry->first();
			}
			$grouprmobj->no_rooms = $val;
			$grouprmobj->save();

		}

		\Session::flash();


		return redirect("alloc/{$groupid}/view");

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
