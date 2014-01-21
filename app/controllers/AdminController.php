<?php

class AdminController extends BaseController {

	public function getIndex() {
		return View::make('admin.dashboard');
	}

	public function post_softdelete()
	{

		$id = substr(Input::get('id'),1);

			if (Input::get('type')=='suspend') 
			{
				DB::table('adarp_users')
				->where('id',$id)
				->update(array('suspended_at' => DB::raw('NOW()')));
			}elseif (Input::get('type')=='unsus'){
				DB::table('adarp_users')
				->where('id',$id)
				->update(array('suspended_at' => NULL));
			}elseif (Input::get('type')=='trash'){
				DB::table('adarp_users')
				->where('id',$id)
				->update(array('deleted_at' => DB::raw('NOW()')));
			}elseif (Input::get('type')=='recover'){
				DB::table('adarp_users')
				->where('id',$id)
				->update(array('deleted_at' => NULL));
			}

	}

	public function get_user($id,$action=NULL)
	{

		$user = Users::with('profile','usermeta')->first();

		dd($user->usermeta);
		
			
			dd();
		$profile = Profile::get_user_profile($id); //get profile in model
		
		if ($profile['added_new_profile']) {
			return Redirect::to('admin/user/'.$id);
		}

		if ($action=='edit') { //edit
			$page = 'edit';
		}else{
			$page = 'single_user'; //view user
		}

		return View::make('admin.'.$page)
	     ->with('profile',$profile['profile'])
	     ->with('usermeta',$profile['usermeta'])
	     ->with('gs',$profile['gs'])
	     ->with('pg',$profile['pg'])
	     ->with('admin_logged',Auth::user()->id)
	     ->with('courses',$profile['courses']);      
	}

	public function post_user($id) {
		$user_id = Input::get('user_id');
					
		$update_user = Profile::post_user_profile($user_id);

		if ($update_user):
			return Redirect::to('admin/user/'.$user_id)
			->with('sucess_profile_edit',true);
		endif;
	}

	public function get_users($id = NULL,$action=NULL) 
	{

		if (is_numeric($id)) { //if user profile is clicked3
			$prof = Profile::where('user_id',$id)->first();
					$usermeta = Usermeta::where('user_id',$id)->get();
					foreach ($usermeta as $meta) {
						$umeta[$meta->key_id] = $meta->value;
					}
		
			return View::make('admin.single_user') //make edit version
			->with('profile',$prof)
			->with('usermeta',$umeta)	
			->with('is_admin',true);
		}
				
		if ($action=='edit') {
			//$userOrders = Controller::call('Profile@getEdit');
			return App::make('Profile')->getEdit($id);
		}
		//default display 10 users

		$users = Users::with('profile')
			->take(10)
			->where('deleted_at',NULL)
			->select('id','username','suspended_at','deleted_at')
			->orderBy('id','desc')
			->get();
	
		
		return View::make('admin.users')
		//->with('id',$id)
		->with('users',$users);
	}

	public function post_users($action = NULL) 
	{	
		if (Input::get('search-user')) {
			$string = Input::get('search-user');
			$users = DB::table('adarp_users')
			->where('username','like','%'.$string.'%')
			->select('id','username','suspended_at','deleted_at')
			->orderBy('id','desc')
			->limit('50')
			->get();
		
		return View::make('admin.users')
		//->with('id',$id)
		->with('users',$users);
		}		

		if ($action == 'add')
		{
			$user = new User(); //add adarp_users
			$user->username = Input::get('username');
			$user->password = Hash::make(Input::get('password'));
			$user->activated = 1;
			$user->save();
				
			$profile = new Profile(); //add adarp_profile
			$profile->user_id =  $user->id;
			$profile->save();

			return Redirect::to('admin/users');
		}

	}
	
	public function get_reports() 
	{

		//$att = Reports::attendance();
		//$users = Homecoming::select('user_id')->get();

		//foreach ($users as $user)
		//{
		//	echo $user->profile->user_id;
		//}

		// dd(DB::getQueryLog());
		//echo $pro->user_id;
		//dd($pro);
		
		//$profilesearch  = Profile::where('value','like','Valencia%')->get();
	//	$metasearch = Usermeta::where('value','like','Valencia%')->with('profile')->get();


		return View::make('reports.reports');
		


		// select count(id) as school,value from adarp_usermeta where `key_id` = 'highschool' group by value order by school desc

		$cnt = Users::count();
		
	}

	public function get_report_search () 
	{
		
	}



	public function showWelcome()
	{
		return View::make('hello');
	}

}