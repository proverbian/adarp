<?php

class ProfileController extends Adarp { 
 /*
 This controller has a formatting
 getIndex - $_GET - Index()
 postEdit - $_POST - Edit()
 */
	public function getIndex() 
	{
	  	
	     $user = Users::find(Auth::user()->id);
	    
	     foreach ($user->usermeta as $data) {
			$all[$data->key_id] = $data->value;
		 }	

	     return View::make('user.profile')
	     ->with('usermeta',$all)
	     ->with('profile',$user->profile);
	}	


	public function getEdit() 
	{
		$id = Auth::user()->id;

		$profile = GetProfile::get_user_profile($id); //get profile in model
	     return View::make('user.edit')
	     ->with('profile',$profile['profile'])
	     ->with('usermeta',$profile['usermeta'])
	     ->with('gs',$profile['gs'])
	     ->with('pg',$profile['pg'])
	     ->with('courses',$profile['courses']);      
	}

	public function postEdit() { // Update Profile
		
		$user_id = Auth::user()->id;	
		$update_user = GetProfile::post_user_profile($user_id);

		
		if ($update_user):
			return Redirect::to('profile')
			->with('sucess_profile_edit',true);
		endif;
	}

	public function getVerify($key) 
	{
        echo $key;
    } 

    public function getEdsa()
    {
    	echo 'edsa';
    }

    public function getSetpassword() 
    {
    	return View::make('profile.chpass');
    	//return $this->getIndex();
    }

    public function postUpdatepass()
    {
    	
    	$to_validate =  array(
    		'password' => 'required|min:8|confirmed',
    		'old_password' => 'required|min:8'
	    	);
	    	//die(var_dump(Input::all()));
	    $data =	array( //title and header caption
	    	  	 	'title'=>'Adarp Settings',
	    	  	 	'header'=>'Adarp Settings'
    	  	 	);	
		$validator = Validator::make(Input::all(),$to_validate);
 			
 		$user = User::find(Input::get('user_id'));
 		
		if ($validator->fails()): // If Validator Fails - show errors
			$messages = $validator->messages(); //get msg error
			$msg =  $messages->first('password');
	
			Session::set('failed_changepass',true); //write a session- false
			Session::set('errors',$msg);
			return Redirect::to('profile/settings');
			//return View::make('user.settings')
    	  	// 	->with('msg',$msg)
    	  	// 	->with('data',$data);
		else:
			
			if (!Hash::check(Input::get('old_password'),$user->password)):
	 			return View::make('user.settings')
	 			->with('msg','Old Password not correct!')
	 			->with('data',$data);
 			endif;

			Session::set('success_changepass',true); //write session true
			
			$user = User::find(Input::get('user_id')); //get user id and query user info

			$user->password = Hash::make(Input::get('password')); //change password
			$user->save(); //save

			$data = $this->getProfileFields2();
			return View::make('profile.profile')
    	  	 ->with('newuser',true)
          	 ->with('value',$data);
		endif;
    	
    }
    public function postChangepass() {
    	$to_validate =  array(
    		'password' => 'required|min:8|confirmed'
	    	);


	    	//die(var_dump(Input::all()));
		$validator = Validator::make(Input::all('password'),$to_validate);
 
		if ($validator->fails()): // If Validator Fails - show errors
			$messages = $validator->messages(); //get msg error
			$msg =  $messages->first('password');

			Session::set('success_changepass',false); //write a session- false

			return View::make('user.change_password')
    	  	 	->with('msg',$msg);
		else:
			Session::set('success_changepass',true); //write session true
		
			$user = User::find(Input::get('user_id')); //get user id and query user info
			$user->password = Hash::make(Input::get('password')); //change password
			$user->save(); //save

			$data = $this->getProfileFields2();
			return View::make('profile.profile')
    	  	 ->with('newuser',true)
          	 ->with('value',$data);
		endif;
    	
    }

    public function getSettings() 
    {
    	$id = Auth::user()->id;
    	$checkpass = User::find($id);

    	if (empty($checkpass->password)) {
    		return View::make('user.nopass');
    	}

    	$data = array(
	    	'title' => 'Settings',
	    	'header' => 'Adarp - Settings'
	    	);
    	return View::make('user.settings')
    	//return View::make('change_password')
    	->with('data',$data);
    }
    
    public function postSetpass()
    {
    	$id = Auth::user()->id;
    	$setpass = User::find($id);	
    	$setpass->password = Hash::make(Input::get('password'));
    	$setpass->save();
    	return Redirect::to('profile/settings')
    	->with('success',true);
    }


}

?>