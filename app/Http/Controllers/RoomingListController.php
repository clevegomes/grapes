<?php namespace App\Http\Controllers;

use App\Booking;
use App\BookingGuestDetails;
use App\BookingRooms;
use App\FlightDetails;
use App\RoomConfig;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Grouphotel;
use App\RoomDetails;
use App\TempHotelResult;
use App\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class RoomingListController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
     public $groupId =0;

	public function index()
	{
		return view('roomingList.bookingSummary');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($group)
    {
        $this->groupId = $group->id;
        $hr = array();
        for($i=0;$i<=23;$i++){
            if($i<=9){
                $hr['0'.$i] ='0'.$i ;
            }else{
                $hr[$i] = $i ;
            }

        }
        $min = array();
        for($i=0;$i<=59;$i++){
            if($i<=9){
                $min['0'.$i] ='0'.$i ;
            }else{
                $min[$i] = $i ;
            }

        }

        $hotel =    DB::table('group_hotel as gp')->join('hotels as h','gp.hotel_id','=','h.hotel_id')->where('is_deleted','=',0)->where('agent_id','=',$this->groupId)->select('hotel_name','h.hotel_id')->lists('hotel_name','hotel_id');
        return view('roomingList.create',compact('hr','min','hotel'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Requests\CreateRoomListingRequest $request )
	{
       // $search_string = json_decode($request->search_string);
       // echo $search_string->{'2015-08-19_1'};
       // $rmObj = RoomDetails::where('search_string','=',$search_string->{'2015-08-19_1'})->select(DB::raw('UNCOMPRESS(room_details_serialized) as room_details_serialized' ))->select(DB::raw('UNCOMPRESS(cancel_penalties_serialized) as cancel_penalties_serialized' ))->first();


         // flush headers (if possible)
        //var_dump($rmObj->cancel_penalties_serialized);
        //$data = preg_replace('/!s:(\d+):"(.*?)"/', "'s:'.strlen('$2').':\"$2\";'", $rmObj->room_details_serialized);
        //var_dump(unserialize($data));

        $booking = new Booking();
        $gpObj = Grouphotel::where('agent_id','=',$request->group_id)->where('hotel_id','=',$request->hotel_id)->select('checkin_date','checkout_date')->first();

        //$booking =$booking->create($request->all());
        $booking->order_id = '0005'.time();
        $booking->hotel_id = $request->hotel_id;
        $booking->unique_cart_id = time();
        $booking->agent_id = $request->group_id;
        $checkInArr = explode('/',$gpObj->checkin_date);
        $checkOutArr = explode('/',$gpObj->checkout_date);
        $checkIn = Carbon::createFromDate($checkInArr[2],$checkInArr[1],$checkInArr[0]);
        $checkOut = Carbon::createFromDate($checkOutArr[2],$checkOutArr[1],$checkOutArr[0]);

        $tempResult = TempHotelResult::where('agent_id','=',$request->group_id)->where('hotel_id','=',$request->hotel_id)->where('room_config_id','=',$request->room_config_id)->select(DB::raw('UNCOMPRESS(hotel_json) as hotel_json'))->first();
       echo $tempResult->hotel_json;
        echo '<br/> ***************<br/>';
       $arr = json_decode($tempResult->hotel_json,true)  ;
        print_r($arr);
        die('end');
        $booking->check_out = $checkOut;
        $date1=date_create($checkIn);
        $date2=date_create($checkOut);
        $diff=date_diff($date1,$date2);
        $booking->no_of_nights = $diff->format("%d");

        $booking->no_of_rooms = $request->get('no_of_rooms');
        $booking->transaction_amount = 13223;
        $booking->hotelprice = 6322;
        $booking->payment_status = 0;
        $booking->booking_status = 3;

        $booking->save();
        $special_request = $request->get('special_request');
        $adult_title        = $request->get('adult_title');
        $adult_first_name   = $request->get('adult_first_name');
        $adult_last_name    = $request->get('adult_last_name');
        $kid_title        = $request->get('kid_title');
        $kid_first_name   = $request->get('kid_first_name');
        $kid_last_name    = $request->get('kid_last_name');
        $dob = $request->get('dob');

       //var_dump($booking);die();
        //$booking->save();
        for($roomCnt=1;$roomCnt<=$booking->no_of_rooms;$roomCnt++){
            //echo $roomCnt;

            $bookingRooms = new BookingRooms();
            $bookingRooms->booking_id = $booking->id;
            $bookingRooms->order_id = $booking->order_id;
            $bookingRooms->room_config_id = $request->room_config_id;

            $roomConfig = RoomConfig::where('room_config_id','=',$request->room_config_id)->select('room_id','bed_id','meal_id')->first();
           // print_r($roomConfig);
            $bookingRooms->room_id = $roomConfig->room_id;
            $bookingRooms->meal_id = $roomConfig->meal_id;
            $bookingRooms->bed_id = $roomConfig->bed_id;// $request->bed_type;
            $bookingRooms->adults = $request->no_adults;
            $bookingRooms->kids = $request->no_child;

            $bookingRooms->room_no = $roomCnt;
            $bookingRooms->booking_status = $booking->booking_status;
            $bookingRooms->specialPromotionId = $request->specialPromo;
            $sp_request = $special_request[$roomCnt];
            $bookingRooms->special_request = $sp_request;
            $bookingRooms->currval = 3.65;
            $can_policies = '';
            $individual_nightrate = '';
            $supplier_str = '';
            $std_rate = 0;
            $pax_rate = 0;
            $child_rate = 0;

            for($nightCnt=0;$nightCnt<$booking->no_of_nights;$nightCnt++) {
                $tomorrow = date('Y-m-d', strtotime($checkIn . "+" . $nightCnt . " days"));

               // echo $tomorrow;
                $search_string = json_decode($request->search_string);
                // echo $search_string->{'2015-08-19_1'};
                $rmObj = RoomDetails::where('search_string', '=', $search_string->{$tomorrow.'_'.$roomCnt})->select(DB::raw('UNCOMPRESS(room_details_serialized) as room_details_serialized'),DB::raw('UNCOMPRESS(cancel_penalties_serialized) as cancel_penalties_serialized'))->first();

                $roomDetails = $rmObj->room_details_serialized;
                $roomDetailsArr = json_decode($roomDetails,true);
                //print_r($roomDetailsArr);die();

                $supplier_str .= $roomDetailsArr[$tomorrow]['supplier'].',';
                $individual_nightrate .= $roomDetailsArr[$tomorrow]['stdprice'].'|'.$roomDetailsArr[$tomorrow]['thirdprice'].'|'.$roomDetailsArr[$tomorrow]['chldprice'].',';


                $canc_policy = $rmObj->cancel_penalties_serialized;
                $cancArr = json_decode($canc_policy,true);
                $canc_str ='';
                foreach($cancArr['CancelPenalty'] as $can){
                    $canc_str .= $can['PenaltyDescription']['!Name'].';';
                }
                $canc_str = substr($canc_str,0,-1);
                $can_policies .= $canc_str .',';
                $bookingRooms->search_string = $search_string->{$tomorrow.'_'.$roomCnt};
            }
            $can_policies = substr($can_policies,0,-1);
            $supplier_str = substr($supplier_str,0,-1);
            $individual_nightrate = substr($individual_nightrate,0,-1);
            $std_rate = $roomDetailsArr[$tomorrow]['stdprice'];
            $pax_rate = $roomDetailsArr[$tomorrow]['thirdprice'];
            $child_rate = $roomDetailsArr[$tomorrow]['chldprice'];
            $bookingRooms->nonights = $booking->no_of_nights;
            $bookingRooms->stdrate = $std_rate;
            $bookingRooms->paxrate = $pax_rate;
            $bookingRooms->chldrate = $child_rate;
            $bookingRooms->room_amt =  $std_rate+$pax_rate+$child_rate;
            $bookingRooms->individual_nightrate = $individual_nightrate;
            $bookingRooms->cancellation_policies = $can_policies;
            $bookingRooms->suppliers = $supplier_str ;
            $bookingRooms->save();

             for($adultCnt=1;$adultCnt<=$request->no_adults;$adultCnt++){
                $bookingGuestDetails = new BookingGuestDetails();
                $bookingGuestDetails->booking_id =   $booking->id;
                $bookingGuestDetails->order_id = $booking->order_id;
                $bookingGuestDetails->unique_cart_id = $booking->unique_cart_id;
                $bookingGuestDetails->booking_room_id = $bookingRooms->id;
                $bookingGuestDetails->title = $adult_title[$roomCnt.'_'.$adultCnt];
                $bookingGuestDetails->fname = $adult_first_name[$roomCnt.'_'.$adultCnt];
                $bookingGuestDetails->lname =  $adult_last_name[$roomCnt.'_'.$adultCnt];

                $bookingGuestDetails->save();
            }
            for($childCnt=1;$childCnt<=$request->no_child;$childCnt++){

                $bookingGuestDetails = new BookingGuestDetails();
                $bookingGuestDetails->booking_id =  $booking->id;
                $bookingGuestDetails->order_id = $booking->order_id;
                $bookingGuestDetails->unique_cart_id = $booking->unique_cart_id;
                $bookingGuestDetails->booking_room_id =$bookingRooms->id;
                $bookingGuestDetails->is_child = 'Y';
                $childDob = $dob[$roomCnt.'_'.$childCnt];
                $dob_arr = explode('/',$childDob);
                $childDob = $dob_arr[2].'-'.$dob_arr[1].'-'.$dob_arr[0];
                $bookingGuestDetails->child_dob = $childDob;

                $bookingGuestDetails->title =  $kid_title[$roomCnt.'_'.$childCnt];
                $bookingGuestDetails->fname = $kid_first_name[$roomCnt.'_'.$childCnt];
                $bookingGuestDetails->lname = $kid_last_name[$roomCnt.'_'.$childCnt];

                $bookingGuestDetails->save();
            }


        }
        $flightDetails = new FlightDetails();
        $flightDetails->order_id = $booking->order_id;
        $flightDetails->guest_title = $adult_title['1_1'];
        $flightDetails->guest_fname = $adult_first_name['1_1'];
        $flightDetails->guest_lname = $adult_last_name['1_1'];
        $flightDetails->pickup_from = $request->pickup_from;
        $flightDetails->dropoff_to = $request->dropoff_to;
        $arriv_arr = explode('/',$request->arrival_dt);
        $arr_dt = $arriv_arr[2].'-'.$arriv_arr[1].'-'.$arriv_arr[0];
        $flightDetails->arrival_dt = $arr_dt;
        $dept_arr = explode('/',$request->departure_dt);
        $dep_dt = $dept_arr[2].'-'.$dept_arr[1].'-'.$dept_arr[0];
        $flightDetails->departure_dt = $dep_dt;
        $flightDetails->arr_flight_no = $request->arr_flight_no;
        $flightDetails->dept_flight_no = $request->dept_flight_no;
        $arrival_time = $request->arr_hr.':'.$request->arr_min;
        $departure_time = $request->dept_hr.':'.$request->dept_min;
        $flightDetails->arrival_time = $arrival_time;
        $flightDetails->departure_time = $departure_time;
        $flightDetails->save();

		return redirect('roomingList');
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
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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
