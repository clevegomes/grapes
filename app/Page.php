<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model {

	//

	protected $fillable = [
		'nav_title',
		'title',
		'slug',
		'body',
		'active'


	];

//	protected  $cont = ['container_id'];

	public function  getContainerIdAttribute()
	{


		return $this->container->lists('id');
	}

	function container()
	{
		return $this->belongsToMany('App\Container')->withTimestamps();
	}


}
