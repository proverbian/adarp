<?php

class Profile extends Adarp { 
 /*
 This controller has a formatting
 getIndex - $_GET - Index()
 postEdit - $_POST - Edit()
 */
	public function getIndex() 
	{
		if (Auth::check()):
			//$data = $this->getProfileFields2();

		$usermeta = Usermeta::where('user_id',Auth::user()->id)
						->get();
		
		foreach ($usermeta as $data) {
			$all[$data->key_id] = $data->value;
		}		
						
		$profile = GetProfile::where('user_id',Auth::user()->id)
						->first();			
	           return View::make('user.profile')
	           ->with('profile',$profile)
	           ->with('usermeta',$all);
	     else:
        	return Redirect::to('login');
        endif;
	  
	}	

	public function getEdit() 
	{
		if (Auth::check()):
		$data = $this->getProfileFields2();
		$usermeta = Usermeta::where('user_id',Auth::user()->id)
						->get();
		
		foreach ($usermeta as $data) {
			$all[$data->key_id] = $data->value;
		}		

		$profile = GetProfile::where('user_id',Auth::user()->id)
						->first();	

           return View::make('user.edit')
           ->with('profile',$profile)
           ->with('usermeta',$all);
        else:
        	return Redirect::to('login');
        endif;
	}

	public function postEdit() { // Update Profile
		$all = Input::all();	

		// Profile
			$id = GetProfile::where('user_id',Auth::user()->id)->first();
			$profile = GetProfile::find($id->id);
			$profile->first_name = Input::get('first_name');
			$profile->middle_name = Input::get('middle_name');
			$profile->last_name = Input::get('last_name');
			$profile->gender = Input::get('gender');
			$profile->status = Input::get('status');
			$profile->maiden = Input::get('maiden');
			$profile->dob = Input::get('dob');
			$profile->profession = Input::get('profession');
			$profile->save();
		//end Profile

		//die();
		unset($all['_token']);
		unset($all['user_id']);
		unset($all['first_name']);
		unset($all['middle_name']);
		unset($all['last_name']);
		unset($all['gender']);
		unset($all['status']);
		unset($all['maiden']);
		unset($all['dob']);
		unset($all['profession']);


		$existing_key = Usermeta::where('user_id',Auth::user()->id)
						->select('key_id')
						->get();
		if (count($existing_key)>0):
		$newuser = false;	
			foreach ($existing_key as $val) { //re-array keys
				$data[] = $val->key_id;
			}
		else:
		$newuser = true;
		endif;
		
		
		foreach ($all as $key => $u) { //update
			
			if ($newuser == true): //if new user , insert new records
				$insert = array(
						'key_id' => $key,
						'value'=> $u,
						'user_id'=>Auth::user()->id
						);
				Usermeta::create($insert); //insert new records
			else: // existing user who updates profile
				if (in_array($key,$data)): //if posted keys existed in user keys from usermeta
					
					Usermeta::where('user_id',Auth::user()->id)
						->where('key_id',$key)
						->update(array('value'=>$u));	//update posted with matching keys
				else: //all unmatched keys which are new keys will be inserted with values
				//	if ($key != '_token' and $key != 'user_id'): //exclude user_id and _token from being inserted
					$insert = array(
						'key_id' => $key,
						'value'=> $u,
						'user_id'=>Auth::user()->id
					);
					Usermeta::create($insert); //insert new records
				//	endif;
				endif;
			endif;


		}

		return Redirect::to('profile')
		->with('sucess_profile_edit',true);
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
    	$data = array(
	    	'title' => 'Settings',
	    	'header' => 'Adarp - Settings'
	    	);
    	return View::make('user.settings')
    	//return View::make('change_password')
    	->with('data',$data);
    }
    


}

?>