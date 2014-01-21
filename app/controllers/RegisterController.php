<?php

class RegisterController extends BaseController {

	public function get_index()
	{
		return View::make('register.register2');

	}

	public function post_index() 
	{
		 $rules = array(
     	  'email'=> 'Required|Between:3,64|Email|unique:adarp_users',
     	  'email_confirmation'=> 'Required'
   		  );
 
 	 $v =  Users::validate(Input::all(), $rules);
 	 if (Input::get('email') != Input::get('email_confirmation')) {
 	 	return Redirect::to('register')->with('email_not_same',true); 	 		
 	 }

	if ($v->passes()) :
		$check = Users::where('username','=',Input::get('email'))
				//->where('activated','<>',1)
				->first();

		if (!$check) :
		$activation_code = hash('sha1',uniqid(Input::get('_token'), true));


		$users = new Users;
		$users->username = Input::get('email');
		$users->password = Hash::make(Input::get('password'));
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
		return Redirect::to('register')
					->with('use_valid_email',true);
	endif;
	}


	public function get_verify($key)
	{

		
		//var_dump(Session::all());
		$v = Users::where('activation_code','=',$key)
		//->where('token','=',Session::get('_token')) //session from chrome and safari are different
		//->where('activated','',1)
		->first();
		
		//	echo '<pre>';print_r($v);echo '</pre>';
		//die();
		if ($v):
		$v->activated = 1;
		$v->save();
			
		//Login User: and prompt to change password:
		
		Auth::login($v);

		//Session::put('change_pass',false);


		if (!Auth::user()->password) {
			return View::make('profile.change_password');
		}
			
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
		Session::flush();
			
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

	public function post_setpass() 
	{
			
		$rules = array(
				'password'  =>'Required|AlphaNum|Between:4,8|Confirmed',
				'password_confirmation'=>'Required|AlphaNum|Between:4,8'
		);	
		$validator = Users::validate(Input::all(),$rules);
	
		if ($validator->passes()) {
			$user = Users::find(Input::get('user_id'));
			$user->password = Hash::make(Input::get('password'));
			$user->save();
			return Redirect::to('/');
		}else{

			return Redirect::to('/')->withErrors($validator->getMessageBag());
			//dd($error);
		}
	}
	

}

