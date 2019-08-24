<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	return [
	        [
	        	'name' => 'Балтабек Асхат',
		        'login' => 'baskhat1',
		        'email' => 'i.b.1aseke@gmail.com',
		        'city_id' => 1,
		        'birthday' => '1995-05-12',
		        'address' => '-',
		        'salary' => '50000',
		        'status' => '1',
		        'password' => 'admin', // password
	        ]
	    ];
    }
}
