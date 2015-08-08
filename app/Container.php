<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App;

class Container extends Model {


	protected $fillable = [
		'title',
		'description',
		'active'
	];

	protected $table = 'containers';

	public function page()
	{

		return $this->belongsToMany('App\Page')->withTimestamps();
	}


	public function getPagesAttribute(){

		return  $this->page->lists('id');
	}

	public function scopecontainerPages($query,$id)
	{
			return $this->belongsToMany('App\Page');
	}


	public function scopeactiveContainer($query)
	{

		$query->where('active','=',1);
	}

}
