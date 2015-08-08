<?php namespace App\Http\Controllers;


use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Grouphotel;
use App\TempHotelResult;
use App\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class RoomingListSearchController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
*/


    public function index()
	{

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
    {
    }

	private function get_results($post_arry = array())
	{




		$curly = curl_init();
		//http://192.168.2.123/poa/com/be/trunk/public_html/Search/index?supplier=poa&poa_agent_id=711&check_in_dt=01/09/2015&check_out_dt=30/09/2015&conv_currency=USD&conv_currency_symbol=$&pageNumber=1&hotel_id=158&perPage=500&rooms=1&room_config=2176&arr_adults[1]=1&arr_children[1]=1&search_country=UAE&child_dob[1][1]=01/09/2006


		curl_setopt($curly, CURLOPT_URL,Config::get('constants.URL').'/Search/index');
		curl_setopt($curly, CURLOPT_HEADER, 0);

		curl_setopt($curly, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curly, CURLOPT_TIMEOUT, 120);
		curl_setopt($curly, CURLOPT_POST, true);

		curl_setopt($curly, CURLOPT_POSTFIELDS, http_build_query($post_arry));

		$webpage = curl_exec($curly);
		$status = curl_getinfo($curly,CURLINFO_HTTP_CODE);
		curl_close($curly);

		return $webpage;

	}


    public function createPaxDetails($group)
    {
        $groupId = $group->id;
       // dd($groupId);
        $adult_title = array('Mr'=>'Mr.','Mrs'=>'Mrs.');
        $kid_title = array('Master'=>'Master.');
        $room_config_id = $_GET['room_config_id'] ;
        $hotel_id = $_GET['hotel_id'];
        $room_type = $_GET['room_type'];
        $no_room =  $_GET['no_room'];
        $no_adults = $_GET['no_adults'];
        $no_child = $_GET['no_child'];
        $gpObj = Grouphotel::where('agent_id','=',$groupId)->where('hotel_id','=',$hotel_id)->select('checkin_date','checkout_date')->first();
        $checkInArr = explode('/',$gpObj->checkin_date);
        $checkOutArr = explode('/',$gpObj->checkout_date);
        $checkIn = $checkInArr[2]."-".$checkInArr[1]."-".$checkInArr[0];
        $checkOut =$checkOutArr[2]."-".$checkOutArr[1]."-".$checkOutArr[0];




	    $post_arry['poa_agent_id']= $groupId;
	    $post_arry['check_in_dt']= $gpObj->checkin_date;
	    $post_arry['check_out_dt']= $gpObj->checkout_date;
	    $post_arry['conv_currency']=  Config::get('constants.CUR');
	    $post_arry['conv_currency_symbol']= Config::get('constant.CURFORMAT');
	    $post_arry['pageNumber']= '1';
	    $post_arry['hotel_id']= $hotel_id;
	    $post_arry['perPage']= Config::get('constants.PERPAGE');
	    $post_arry['rooms']= '1';
	    $post_arry['room_config']= $_GET['room_config_id'];
	    $post_arry['arr_adults'][1]= '1';
	    $post_arry['arr_children'][1]= '1';
	    $post_arry['search_country']= 'UAE';
	    $post_arry['child_dob'][1][1]= '01/09/2006';


	    $data = $this->get_results($post_arry);
	    $detailsArray = json_decode($data, true);




//        $detailsArray = json_decode(file_get_contents('c:/hotels-results-03.json'), true);
      //  print_r($detailsArray) ;
        $totalRoomPrice = 0;
        $specialPromoString ="";

        if(count($detailsArray['hotels'][$hotel_id]) > 0) {
            $spl_array =array();
            //$searchStringArray = array();
            foreach ($detailsArray['hotels'][$hotel_id] as $r => $search_record) {

                foreach ($search_record as $rm => $search_record1) {
                    if ($search_record1['room_config_id'] == $room_config_id) {
                        DB::table('group_hotel_results')->where('room_config_id', $room_config_id)->delete();
                        $tempResult = new TempHotelResult();
                        $totalRoomPrice = $search_record1['totalprice'];
                        $tempResult->hotel_id = $hotel_id;
                        $tempResult->agent_id = $groupId;
                        $tempResult->room_config_id = $room_config_id;
                        //print_r($search_record1);
                        $hotel_json = addslashes(json_encode($search_record1));
                         $tempResult->hotel_json =DB::raw('COMPRESS(\''.$hotel_json.'\')');
                        $tempResult->save();

                        $promo_arr_rate_cnt = count($search_record1["promo"]);
                        if(is_array($search_record1["promo"]) && $promo_arr_rate_cnt >= 1)
                        {

                            for($a = 1; $a <= $promo_arr_rate_cnt; $a++)
                            {
                                $arr_spl_promos = $search_record1["promo"][$a];
                                foreach($arr_spl_promos as $brk_date => $supp_details) {
                                  $spl_array[$supp_details['spl_id']]=$supp_details['spl_name'];

                                }
                            }
                        }
                           /* foreach ($search_record1['nightprice']  as $rm =>$record) {
                                $searchStringArray[$rm."_".$r] = $record['search_string'];
                            } */

                    }
                }
            }
            $spl_array = array_unique($spl_array);
            /***************************************************/

           // echo $specialPromoString;
            //echo $totalRoomPrice;
            //print_r( $searchStringArray);
        }
       // die();


        return view('ajax.roomList',compact('groupId','room_config_id','adult_title','kid_title','room_type','no_room','no_adults','no_child','totalRoomPrice','spl_array'));//,'searchStringArray'
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Requests\CreateRoomListingRequest $request )
	{


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
