<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\RoomConfig;
use App\RoomPlan;
use App\BedPlan;
use App\MealPlan;

class RoomConfigAjaxController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function index()
    {
        $roomConfig = RoomConfig::where('hotel_id','=',$_GET['hotel_id'])->where('room_id','>','0')->where('bed_id','>','0')->where('meal_id','>','0')->where('standard_adults','>','0')->select('room_config_id','room_id','bed_id','meal_id','standard_adults','additional_adults','children','combitation_active')->get();

        $html = '<select id="room_config" name="room_config">';
        foreach($roomConfig as $rcObj){
            $roomType = RoomPlan::where('room_type_id','=',$rcObj->room_id)->where('room_type_name','<>','null')->select('room_type_name')->first();
            $bedType = BedPlan::where('bed_type_id','=',$rcObj->bed_id)->where('bed_type_name','!=','null')->select('bed_type_name')->first();
            $mealType = MealPlan::where('id','=',$rcObj->meal_id)->where('plan_name','!=','null')->select('plan_name')->first();
            $html .= '<option value="'.$rcObj->room_config_id.'$'.htmlspecialchars($roomType->room_type_name).'@'.$rcObj->standard_adults." ^ ".$rcObj->additional_adults." ^ ".$rcObj->combitation_active." ^ ".$rcObj->combitation_active.'#'.$rcObj->room_id." - ".$rcObj->bed_id." - ".$rcObj->meal_id.'">'.htmlspecialchars($roomType->room_type_name)." - ".htmlspecialchars($bedType->bed_type_name)." - ".htmlspecialchars($mealType->plan_name) .'</option>';
        }
        $html .= '</select>';
        return $html;


    }


    /**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
