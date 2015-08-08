<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', 'Auth\AuthController@getLogin');

Route::group(['middleware' => 'auth'], function()
{
Route::get('page/{page}/del', 'PagesController@del');
Route::get('cont/{cont}/del', 'ContainerController@del');
Route::get('group/{group}/del', 'GroupController@del');
Route::get('alloc/{alloc}/del', 'AllocationController@del');
Route::get('summary/{summary}/del', 'AllocationController@del');
Route::get('alloc/{group}/view','AllocationController@index');
Route::get('roomingList/{group}/view','RoomingListController@create');

//route to add
//Route::get('/roomingList/roomListAjax', function() {
 //   $adult_title = array('Mr'=>'Mr.','Mrs'=>'Mrs.');
 //   $kid_title = array('Master'=>'Master.');
 //   return  view('ajax.roomList',['room_config_id'=>$_GET['room_config_id'],'hotel_id'=>$_GET['hotel_id'],'room_type' => $_GET['room_type'],'adult_title'=>$adult_title,'kid_title'=>$kid_title,'no_room' => $_GET['no_room'],'no_adults' => $_GET['no_adults'],'no_child' => $_GET['no_child']]);

//});



Route::get('/roomingList/{group}/roomListAjax','RoomingListSearchController@createPaxDetails');
Route::get('/roomingList/{group}/roomConfigAjax','RoomConfigAjaxController@index');
Route::get('todoapp','TodoAppController@index');


Route::resource('page','PagesController');
Route::resource('group','GroupController');
Route::resource('alloc','AllocationController');
Route::resource('summary','SummaryController');
Route::resource('roomingList','RoomingListController');
Route::resource('cont','ContainerController');
Route::resource('todos','TodosController');
});


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
