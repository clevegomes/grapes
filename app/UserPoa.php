<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;


class UserPoa extends Model implements AuthenticatableContract {

	use Authenticatable;
	protected $table = 'admin';
	protected $primaryKey  = 'admin_id';
	public $timestamps = false;


}
