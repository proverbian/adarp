<?php

class RegisterController extends BaseController {

	public function get_index()
	{
		return View::make('register.register2');

	}

	public function post_index() 
	{
		 $rules = array(
       'email'=> 'Required|Between:3,64|Email|unique:adarp_users'
     );
   
 	 $v =  Validator::make(Input::all(), $rules);


	if ($v->passes()) :
		$check = Users::where('username','=',Input::get('email'))
				//->where('activated','<>',1)
				->first();

		if (!$check) :
		$activation_code = hash('sha1',uniqid(Input::get('_token'), true));


		$users = new Users;
		$users->username = Input::get('email');
		$users->password = Hash::make(Input::get('email'));
		$users->activation_code = $activation_code;
		$users->save();

		$profile = new GetProfile;
		$profile->user_id = $users->id;
		$profile->first_name = Input::get('first_name');
		$profile->last_name = Input::get('last_name');
		$profile->save();

		return Redirect::to('notifications')
				->with('success_register',true);
		else:
		return Redirect::to('register')
				->with('email_exists',true);
		endif;
	else:
		return Redirect::to('notifications')
					->with('use_valid_email',true);
	endif;
	}


	public function get_verify($key)
	{

		dd($key);
		//var_dump(Session::all());
		$v = User::where('activation_code','=',$key)
		//->where('token','=',Session::get('_token')) //session from chrome and safari are different
		//->where('activated','',1)
		->first();

		//	echo '<pre>';print_r($v);echo '</pre>';
		//die();
		if (count($v)==1):
			$v->activated = 1;
			$v->save();
			
		//Login User: and prompt to change password:
		$user = User::find($v->id);
		Auth::login($user);

		//Session::put('change_pass',false);


		if (Session::get('change_pass') == false) {
			return View::make('profile.change_password');
		}else{
			echo  'we';
		}
			
		die();


		return Redirect::to('register/notifications')
			->with('success_validation',true);
		else:
		return Redirect::to('register/notifications')
			->with('validation_expired',true);

		endif;
		//expire, resend verification

	}

	public function get_notifications()
	{
		return View::make('layout.success');
	}

	public function get_login() 
	{
		return View::make('login');
	}

	public function success() 
	{
		Session::flush(); //Remove all saved data in Session
		return View::make('layout.success');
	}

	public function post_login()
	{
			
	$userdata = array(
		'username' => Input::get('username'),
		'password' => Input::get('password'),
		'activated' => 1
		);
	
		if (Auth::attempt($userdata)) {
			//die($userdata);
			return Redirect::to('dashboard');
		}else{
			return Redirect::to('login')
			->with('login_errors',true);
		}
	}

	public function logout() 
	{
		Auth::logout();
		return Redirect::to('login');
	}

	public function smverification()
	{
		$user = Users::whereRaw('activation_code is not NULL and activated is NULL and sent_at is null')
		->select('username','activation_code','id')
		->first();

		if ($user):
			$data = array(
						'detail' => 'Hi, Thanks for Registering, below is your confirmation link,
						 just click on and and change your password.',
						'activation_code' => $user->activation_code,
						'name' => 'Alumni Association');

			$email = $user->username;	
			Mail::send('emails.welcome', $data, function ($message) use ($email) 
			{ //text array('text'=>'emails.welcome.txt')
			    $message->subject('Confimation Link');
			    $message->to($email); // Recipient address
			});
			
				DB::table('adarp_users')
				->where('id',$user->id)	
				->update(array('sent_at'=>date('Y-m-d h:i:s')));	
				echo 'Mail sent to ' .$user->id. ' - ' .$user->username.'\n';
		endif;
	}
	

}

