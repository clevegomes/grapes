<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model {
protected $table ='booking';
    protected $fillable = ['order_id',
        'customer_id',
        'agent_id',
        'unique_cart_id',
        'check_in',
        'check_out',
        'no_of_nights',
        'booking_status',
        'transaction_amount',
        'hotelprice',
        'payment_status',
        'hotel_id',
        'no_of_rooms',
        'remarks',
        'hotel_confirm_no',
       ];

	//

}
