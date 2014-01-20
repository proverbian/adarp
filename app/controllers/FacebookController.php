<?php
class FacebookController extends Controller {

	public function  get_loginfb() 
	{
		$facebook = new Facebook(Config::get('facebook'));
	    $params = array(
	        'redirect_uri' => url('facebook/loginfbcallback'),
	        'scope' => 'email',
	    );
	    return Redirect::to($facebook->getLoginUrl($params));

	}

	public function get_fblogin() 
	{
		if (Auth::check()) {
			$data = Auth::user();
		}
		return View::make('fb.login')->with('data',$data);
	}

	public function get_loginfbcallback()
	{

		
		$code = Input::get('code');
	    if (strlen($code) == 0) return Redirect::to('/')->with('message', 'There was an error communicating with Facebook');
	 
	    $facebook = new Facebook(Config::get('facebook'));
	    $uid = $facebook->getUser();
	 	$accessToken = $facebook->getAccessToken();
	 	$facebook->setAccessToken($accessToken);

	 
	    if ($uid == 0) return Redirect::to('/')->with('message', 'There was an error');
	 
	    $me = $facebook->api('/'.$uid); //this solveds the bug (access token bug)

	 	$user_check = Users::whereUid($uid)->first();
	 	$email_check = Users::where('username',$me['email'])->first();

	 	
	 	if (empty($user_check)) {
	 	

	 	if ($email_check) {
	 		return Redirect::to('login')->with('login_errors',true);
	 	}

	 		$user = new Users;
	 		$user->uid = $uid;
	 		$user->username = $me['email'];
	 		$user->activated = 1;
	 		
	 		$user->save();

	 		
	 		$last_id = $user->id; //get last ID

	 		$profile = new GetProfile;
	 		$profile->user_id = $last_id;
	 		$profile->name = $me['first_name']. ' '.$me['last_name'];
	 		$profile->first_name = $me['first_name'];
	 		$profile->last_name = $me['last_name'];
	 		$profile->email = $me['email'];
	 		$profile->photo = 'https://graph.facebook.com/'.$me['username'].'/picture?type=large'; 
	 		$profile->uid = $uid;
	 		//$profile->access_token = $facebook->getAccessToken();
	 		$profile->save();
	 	}

	 	$user = Users::whereUid($uid)->first();
	 	$user->access_token = $accessToken; //saves access_token
	 	$user->save();


	 	Auth::login($user);
	 	//echo '<script> window.close();</script>';

	 	return Redirect::to('/');

	}



}

?>