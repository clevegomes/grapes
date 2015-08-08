<?php
/**
 * Created by PhpStorm.
 * User: Developer1
 * Date: 22/07/2015
 * Time: 4:35 PM
 */

namespace App;




class AuthenticateUser {


	private  $auth;
	function __construct( )
	{

	}

	public function execute($credentials)
	{

		$user = User::where('username','=',$credentials->username)
			->where('password','=',md5($credentials->password))
			->first();

	}
}