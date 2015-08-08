<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingRooms extends Model {

    protected $table = 'booking_rooms';
	protected $fillable = ['room_type',
        'meal_type',
        'bed_type',
        'no_adults',
        'no_child',
        'special_request_1',
        'special_request_2',
        'special_request_3',
        'special_request_4',
        'special_request_5',
        'special_request_6',
        'special_request_7',
        'special_request_8',
        'special_request_9',
        'special_request_10'
    ];

}
