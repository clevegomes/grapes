<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FlightDetails extends Model {

	protected $table = 'tr_booking';
    protected $fillable = ['pickup_from',
    'arr_flight_no',
    'arrival_dt',
    'arr_hr',
    'arr_min',
    'dropoff_to',
    'dept_flight_no',
    'departure_dt',
    'dept_hr',
    'dept_min'];

}
