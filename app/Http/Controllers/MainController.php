<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\User;
use App\City;
use App\Store;
use App\Role;
use App\Valut;
use App\Salary;
use DB;
use Hash;
use Response;
use Breadcrumbs;

class MainController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
	    $this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index()
	{
	    return view('admin.main');
	}

	public function getServices()
	{
		return Service::select('id','title', 'description', 'url', 'icon')->get();
	}

	public function storeService(Request $request)
	{
		$data = ['status'=> true, 'msg'=> 'Service has been added.'];
		$serviceId = $request->id;

		if($serviceId == 'new') $service = new Service;
		else $service = Service::find($serviceId);

		$service->title = $request->title;
		$service->description = $request->description;
		$service->url = $request->url;
		$service->icon = $request->icon;
		$service->save();
	    return Response::json($data);
	}

	public function deleteService(Request $request)
	{
		$data = ['status'=> true, 'msg'=> 'Service has been deleted.'];
		$service = Service::find($request->id)->delete();
	    return Response::json($data);
	}

	public function getRoles()
	{
		return Role::all();
	}

	public function getCities(Request $request)
	{
		$title = $request->title;
		$status = $request->status;
		$cities = City::withCount('users', 'stores');
		if($title) $cities->where('title', 'like', '%'.$title.'%');
		if($status && $status >= 0) $cities->where('status', $status);

		return $cities->get();
	}

	public function storeCity(Request $request)
	{
		$data = ['status'=> true, 'msg'=> 'City has been added.'];
		$cityId = $request->id;

		if($cityId == 'new')
		{
			$city = new City;
			$city->title = $request->title;
			$city->status = $request->status;
		}
		else
		{
			$city = City::find($cityId);
			$city->title = $request->title;
			$city->status = $request->status;
		}

		$city->save();

	    return Response::json($data);
	}

	public function deleteCity(Request $request)
	{
		$data = ['status'=> true, 'msg'=> 'City has been deleted.'];
		$user = City::find($request->id)->delete();
	    return Response::json($data);
	}

	public function getEmployees(Request $request)
	{
		$name = $request->name;

		$employees = User::select(
						'*',
						DB::raw("date_format(created_at, '%Y-%m-%d') as created_date"),
						DB::raw("IF( status = 0, 'banned', 'active') as status_display")
					)
					->with(['services', 'role', 'currentSalary', 'stores']);

		if($name) $employees->where('name', 'like', '%'.$name.'%');

		return $employees->get();
	}

	public function userEditWindow(Request $request)
	{
		$data = ['new'=> false];
		$data['services'] = Service::get();
		$data['stores'] = Store::get();
		if($request->id != 'new')
			$data['user'] = User::with('services', 'currentSalary', 'role', 'city', 'stores')->find($request->id);
		else
		{
			$data['new'] = true;
			$data['user'] = new User;
		}

	    return view('admin.modals.user_edit', $data);
	}

	public function storeEmployee(Request $request)
	{
		$data = ['status'=> true, 'msg'=> 'User has been saved.'];

		$userId = $request->user_id;


		if($userId == 'new')
		{
			$user = new User;
		}
		else
		{
			$user = User::find($userId);
		}

		$user->name = $request->name;
		$user->role_id = $request->role_id;
		$user->login = $request->email;
		$user->email = $request->email;
		$user->city_id = $request->city_id;
		$user->birthday = $request->birthday;
		$user->address = $request->address;
		$user->password = Hash::make('default');
		$user->status = $request->status == 'on' ? 0 : 1;
		$user->save();

		$curSalary = $user->currentSalary;


		if(!$curSalary)
		{
			$salary = new Salary;
			$salary->user_id = $user->id;
			$salary->salary = $request->salary['salary'];
			$salary->add_percent = $request->salary['percent'];
			$salary->start_date = $request->salary['start_date'];
			$salary->valut_id = $request->salary['valut_id'];
			$salary->save();
		}
		else if ($curSalary->start_date != $request->salary['start_date'])
		{
			$curSalary->end_date = date('Y-m-d', strtotime($request->salary['start_date'].'-1 day'));
			$curSalary->updated_at = date('Y-m-d');
			$curSalary->save();

			$salary = new Salary;
			$salary->user_id = $user->id;
			$salary->salary = $request->salary['salary'];
			$salary->add_percent = $request->salary['percent'];
			$salary->start_date = $request->salary['start_date'];
			$salary->valut_id = $request->salary['valut_id'];
			$salary->save();
		}

		$user->services()->sync($request->services);
		$user->stores()->sync($request->stores);

	    return Response::json($data);
	}

	public function getStores(Request $request)
	{
		$title = $request->title;
		$cityId = $request->city_id;
		$stores = Store::withCount('users');
		if($title) $stores->where('title', 'like', '%'.$title.'%');
		if($cityId>1) $stores->where('city_id', $cityId);

		return $stores->get();
	}

	public function storeStore(Request $request)
	{
		$data = ['status'=> true, 'msg'=> 'Store has been added.'];
		$storeId = $request->id;

		if($storeId == 'new') $store = new Store;
		else $store = Store::find($storeId);

		$store->title = $request->title;
		$store->city_id = $request->city_id;
		$store->status = $request->status;
		$store->save();

		return Response::json($data);
	}

	public function deleteStore(Request $request)
	{
		return 0;
	}

	public function getValuts()
	{
		return Valut::all();
	}

	public function deleteUser(Request $request)
	{
		$data = ['status'=> true, 'msg'=> 'User has been deleted.'];
		$user = User::find($request->id)->delete();
	    return Response::json($data);
	}

	public function test()
	{
		$data = ['status'=> true, 'msg'=> 'TEST'];

		$user = new User;

		$user->name = '$request->name';
		$user->role_id = 1;
		$user->login = 'b.mail@mail.ru';
		$user->password = Hash::make('default');
		$user->email = 'b.mail@mail.ru';
		$user->city_id = 1;
		$user->birthday = date('Y-m-d');
		$user->address = '$request->address';
		$user->status = 1;
		$user->save();

		dd($user);
	    return Response::json($data);
	}
}
