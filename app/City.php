<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
	public function users()
	{
		return $this->hasMany('App\User');
	}

	public function stores()
	{
		return $this->hasMany('App\Store');
	}
}
