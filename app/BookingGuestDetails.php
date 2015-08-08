<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingGuestDetails extends Model {

    protected $table = 'booking_guest_details';
	protected $fillable = ['adult_title_1_1',
                            'adult_first_name_1_1',
                            'adult_last_name_1_1',
                            'kid_title_1_1',
                            'kid_first_name_1_1',
                            'kid_last_name_1_1',
                            'dob_1_1',
                            'adult_title_1_2',
                            'adult_first_name_1_2',
                            'adult_last_name_1_2',
                            'kid_title_1_2',
                            'kid_first_name_1_2',
                            'kid_last_name_1_2',
                            'dob_1_2',
                            'adult_title_1_3',
                            'adult_first_name_1_3',
                            'adult_last_name_1_3',
                            'kid_title_1_3',
                            'kid_first_name_1_3',
                            'kid_last_name_1_3',
                            'dob_1_3',
                            'adult_title_1_4',
                            'adult_first_name_1_4',
                            'adult_last_name_1_4',
                            'kid_title_1_4',
                            'kid_first_name_1_4',
                            'kid_last_name_1_4',
                            'dob_1_4',
                            'adult_title_1_5',
                            'adult_first_name_1_5',
                            'adult_last_name_1_5',
                            'kid_title_1_5',
                            'kid_first_name_1_5',
                            'kid_last_name_1_5',
                            'dob_1_5',
        'adult_title_2_1',
        'adult_first_name_2_1',
        'adult_last_name_2_1',
        'kid_title_2_1',
        'kid_first_name_2_1',
        'kid_last_name_2_1',
        'dob_2_1',
        'adult_title_2_2',
        'adult_first_name_2_2',
        'adult_last_name_2_2',
        'kid_title_2_2',
        'kid_first_name_2_2',
        'kid_last_name_2_2',
        'dob_2_2',
        'adult_title_2_3',
        'adult_first_name_2_3',
        'adult_last_name_2_3',
        'kid_title_2_3',
        'kid_first_name_2_3',
        'kid_last_name_2_3',
        'dob_2_3',
        'adult_title_2_4',
        'adult_first_name_2_4',
        'adult_last_name_2_4',
        'kid_title_2_4',
        'kid_first_name_2_4',
        'kid_last_name_2_4',
        'dob_2_4',
        'adult_title_2_5',
        'adult_first_name_2_5',
        'adult_last_name_2_5',
        'kid_title_2_5',
        'kid_first_name_2_5',
        'kid_last_name_2_5',
        'dob_2_5',
        'adult_title_3_1',
        'adult_first_name_3_1',
        'adult_last_name_3_1',
        'kid_title_3_1',
        'kid_first_name_3_1',
        'kid_last_name_3_1',
        'dob_3_1',
        'adult_title_3_2',
        'adult_first_name_3_2',
        'adult_last_name_3_2',
        'kid_title_3_2',
        'kid_first_name_3_2',
        'kid_last_name_3_2',
        'dob_3_2',
        'adult_title_3_3',
        'adult_first_name_3_3',
        'adult_last_name_3_3',
        'kid_title_3_3',
        'kid_first_name_3_3',
        'kid_last_name_3_3',
        'dob_3_3',
        'adult_title_3_4',
        'adult_first_name_3_4',
        'adult_last_name_3_4',
        'kid_title_3_4',
        'kid_first_name_3_4',
        'kid_last_name_3_4',
        'dob_3_4',
        'adult_title_3_5',
        'adult_first_name_3_5',
        'adult_last_name_3_5',
        'kid_title_3_5',
        'kid_first_name_3_5',
        'kid_last_name_3_5',
        'dob_3_5',
        'adult_title_4_1',
        'adult_first_name_4_1',
        'adult_last_name_4_1',
        'kid_title_4_1',
        'kid_first_name_4_1',
        'kid_last_name_4_1',
        'dob_4_1',
        'adult_title_4_2',
        'adult_first_name_4_2',
        'adult_last_name_4_2',
        'kid_title_4_2',
        'kid_first_name_4_2',
        'kid_last_name_4_2',
        'dob_4_2',
        'adult_title_4_3',
        'adult_first_name_4_3',
        'adult_last_name_4_3',
        'kid_title_4_3',
        'kid_first_name_4_3',
        'kid_last_name_4_3',
        'dob_4_3',
        'adult_title_4_4',
        'adult_first_name_4_4',
        'adult_last_name_4_4',
        'kid_title_4_4',
        'kid_first_name_4_4',
        'kid_last_name_4_4',
        'dob_4_4',
        'adult_title_4_5',
        'adult_first_name_4_5',
        'adult_last_name_4_5',
        'kid_title_4_5',
        'kid_first_name_4_5',
        'kid_last_name_4_5',
        'dob_4_5',
        'adult_title_5_1',
        'adult_first_name_5_1',
        'adult_last_name_5_1',
        'kid_title_5_1',
        'kid_first_name_5_1',
        'kid_last_name_5_1',
        'dob_5_1',
        'adult_title_5_2',
        'adult_first_name_5_2',
        'adult_last_name_5_2',
        'kid_title_5_2',
        'kid_first_name_5_2',
        'kid_last_name_5_2',
        'dob_5_2',
        'adult_title_5_3',
        'adult_first_name_5_3',
        'adult_last_name_5_3',
        'kid_title_5_3',
        'kid_first_name_5_3',
        'kid_last_name_5_3',
        'dob_5_3',
        'adult_title_5_4',
        'adult_first_name_5_4',
        'adult_last_name_5_4',
        'kid_title_5_4',
        'kid_first_name_5_4',
        'kid_last_name_5_4',
        'dob_5_4',
        'adult_title_5_5',
        'adult_first_name_5_5',
        'adult_last_name_5_5',
        'kid_title_5_5',
        'kid_first_name_5_5',
        'kid_last_name_5_5',
        'dob_5_5'];

}