<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
	public function users()
	{
		return $this->belongsToMany('App\User', 'users_stores');
	}

	public function city()
	{
		return $this->belongsTo('App\City');
	}
}
