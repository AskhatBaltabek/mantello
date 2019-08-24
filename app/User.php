<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name','role_id','login','email','city_id','birthday','address','salary','password','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
    ];

    protected $attributes = [
        'role_id' => 1,
        'city_id' => 1,
    ];

    public function services()
    {
        return $this->belongsToMany('App\Service', 'users_services');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    // public function roles()
    // {
    //     return $this->belongsToMany('App\Role', 'users_roles');
    // }

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function stores()
    {
        return $this->belongsToMany('App\Store', 'users_stores');
    }

    public function salaries()
    {
        return $this->hasMany('App\Salary');
    }

    public function currentSalary()
    {
        return $this->hasOne('App\Salary')->whereNull('end_date');
    }
}
