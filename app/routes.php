<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/',function()
{
	$posts = Posts::all();
	return View::make('news/news')
	->with('posts',$posts);
});



Route::get('daryl',function()
{
	return View::make('daryl');
});

Route::post('daryl-post',function()
{
	$data = Input::get('daryl');
	$res = User::where('username','=',$data)->first();

	return View::make('daryl')
	->with('result',$res)
	->with('posted',true);
});

Route::get('sample',function() 
{
	return View::make('sample');
});
Route::get('home', function()
{
	if (Auth::check()){
		return Redirect::to('/');
	}else{
		return Redirect::to('login');
	}
});

/*Route::get('/',function(){
	if (Auth::check()){
		return Redirect::to('dashboard');
	}else{
		return Redirect::to('login');
	}
});
*/

Route::get('dashboard',function()
{
	return View::make('user.dashboard');
});


// register - option 1 //adarp/register2
Route::get('register',function() {
	return View::make('register.register2');
});
Route::post('register',function() {
	$v = User::validate(Input::all());

	if ($v->passes()) :
		$check = User::where('username','=',Input::get('email'))
				//->where('activated','<>',1)
				->first();
		if (!$check) :
		$activation_code = hash('sha1',uniqid(Input::get('_token'), true));
			User::create(array(
				'username' => Input::get('email'),
				'password' => Hash::make(Input::get('email')),
				'activation_code' => $activation_code,
				'token'=> Input::get('_token')
				));	
			
			$data = array(
					'detail' => 'Hi, Thanks for Registering, below is your confirmation link, just click on and and change your password.',
					'activation_code' => $activation_code,
					'name' => 'Alumni Association');
				Mail::send('emails.welcome', $data, function($message)
			{
			 	//$message->from('shiloh@foundationu.com','Alumni Association');
			    $message->to('shiloh.impang@foundationu.com', 'Shiloh Impang')->subject('Welcome!');
			});

			return Redirect::to('notifications')
					->with('success_register',true);
			else:
			return Redirect::to('notifications')
					->with('email_exists',true);
			endif;
	else:
		return Redirect::to('notifications')
					->with('use_valid_email',true);
	endif;
 	
});

Route::get('notifications',function() {
	return View::make('layout.success');
});

Route::get('verify/{key}',function($key) {
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
	

	return Redirect::to('notifications')
		->with('success_validation',true);
	else:
	return Redirect::to('notifications')
		->with('validation_expired',true);

	endif;
	//expire, resend verification

	

	//show login

});


//end register

Route::get('registered','Adarp@registered');
Route::get('profile/view/{id}','Adarp@profileview');


//Login

Route::get('login',function() 
{
 return View::make('login');
});
Route::get('success',function() {
	Session::flush(); //Remove all saved data in Session
	return View::make('layout.success');
});

Route::post('login',function()
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
	
});
//End Login

//Logout
Route::get('logout',function()
{
	Auth::logout();
	return Redirect::to('login');
});


//Route::get('profile','Adarp@viewProfile');
//here

//Route::resource('photo','PhotoController');
//Profile

Route::get('getpro','Adarp@getProfileFields2');
//End Profile

Route::post('profile/edit',function() 
{
	$profile = array(
		'first'=>Input::get('fname'),
		'middle'=>Input::get('middle'),
		'last'=>Input::get('lname'),
		'gender'=>Input::get('gender'),
		'status'=>Input::get('status'),
		'dob'=>Input::get('dob'),
		'updated_at'=> date('y-m-d'),
		'created_at'=> date('y-m-d')
		);
	DB::table('adarp_profile')->insert($profile);
});

Route::get('mail',function(){
	$data = array(
		'detail' => 'Testing ra bert',
		'name' => 'Alumni Association');
	Mail::send('emails.welcome', $data, function($message)
{
 	$message->from('shiloh@foundationu.com','Alumni Association');
    $message->to('gilbert.salvoro@foundationu.com', 'Gilbert Patron Salvoro')->subject('Berto');
});
});

//Route::get('profile','Adarp@viewProfile');
Route::controller('profile','Profile'); //Redirects to RESTful Controller (maka save ug Route Line)
Route::get('profile/{id}','Adarp@viewProfile');
Route::get('profile/edit','Adarp@	');
Route::post('profile/edit','Adarp@updateProfile');
Route::get('profile/remove/{id}','Adarp@removeUser');
Route::controller('profile/settings','Profile');
//Admin

Route::get('admin','Adarp@admin_dashboard');
Route::get('admin/manage','Adarp@manage');
Route::get('admin/manage/fields','Adarp@manage_fields');
Route::post('admin/manage/fields/{any}','Adarp@manageField');
Route::get('admin/manage/fields/{any}','Adarp@manageFields');
Route::get('admin/news',function()
{
	$post = Posts::all();
	return View::make('news/news_title')
	->with('posts',$post);
});
Route::get('admin/news/{id}',function($id)
{
		$post = Posts::find($id);
	return View::make('newsadmin')
	->with('edit',true)
	->with('data',$post);
});

//Export

Route::get('export','Exporter@getRecords');


//Search

Route::get('search','Search@search_form');
Route::post('search','Search@search_me');




//racetets

Route::get('race',function() {
	return View::make('race');
});


Route::get('swift-mail',function() {
require_once 'swift/lib/swift_required.php';

$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl")
  ->setUsername('proverbian@gmail.com')
  ->setPassword('8t1lgsesbi');

$mailer = Swift_Mailer::newInstance($transport);

$message = Swift_Message::newInstance('Test Subject')
  ->setFrom(array('proverbian@gmail.com' => 'wewe'))
  ->setTo(array('proverbian@gmail.com'))
  ->setBody('This is a test mail.');

$result = $mailer->send($message);
});




Route::get('news/{id}',function($id)
{
	$post = Posts::find($id);
	return View::make('news_single')
	->with('post',$post);
});

Route::get('newsadmin',function()
{
	return View::make('newsadmin');
});

Route::post('savenews',function() 
{
	if (Input::get('type'=='insert')):
		$data = new Posts;
		$data->post = Input::get('editor1');
		$data->save();
	else:
		$data = Posts::find(Input::get('id'));
		$data->post = Input::get('editor1');
		$data->save();
	endif;
	return Redirect::to('news/'.Input::get('id'));
});

Route::get('news/edit/{id}',function($id) 
{
	
	$data = Posts::find($id);
	return View::make('newsadmin')
	->with('edit',true)
	->with('data',$data);

});


/*
* Home Coming 
*
*/

Route::get('homecoming',function()
{
	return View::make('homecoming.form');
});

Route::post('homecoming/register',function()
{
		//var_dump(Input::all());
		//$home =  Homecoming::create(Input::all());
		$home = new Homecoming;
		$home->fname = Input::get('fname');
		$home->mname = Input::get('mname');
		$home->lname = Input::get('lname');
		$home->user_id = Input::get('user_id');
		$home->address = Input::get('address');
		$home->contact = Input::get('contact');
		$home->save();

		return Redirect::to('homecoming')
				->with('attended',true)
				->with('detail',Input::all());
});

Route::get('homecoming/json',function() {
	$term = Input::get('term');

	$term_bol = preg_match('/\s/',$term);
	
	if ($term_bol==true) {

		$term = explode(' ',$term);

			
				$names = Usermeta::whereRaw("(`value` like '%viente%' and key_id ='48') or (`value` like '%edsa%' and key_id = '46')  and key_id in (46,47,48) group by user_id")->get();

	}else{
			$names = Usermeta::where('value','like','%'.$term.'%')
	->orWhere('value','like','%'.$term.'%')
	->whereIn('key_id',array('46','47','48')) //First,Middle,Last
	->OrderBy('value','desc')
	->get();

	}

	//echo '<pre>';print_r($names);echo '</pre>';
	//select * from adarp_usermeta where value like 'shiloh%';
//select * from adarp_usermeta where user_id = '27312' and key_id in (46,47,48);
	foreach ($names as $id) {
			$all = array();
		$data = Usermeta::where('user_id','=',$id->user_id)
		->whereIn('key_id',array('47','46','48'))->get();
		
		foreach ($data as $cred) {		
			$user[$cred->key_id] = $cred->value;	
		}
		$name = array();
		$name['value'] = $user[48]. ', '.$user[46].' '.$user[47];
		$name['fname'] = $user[46];
		$name['mname'] = $user[47];
		$name['lname'] = $user[48];
		$name['user_id'] = $id->user_id;
		


		$we[] = $name;
	}
	echo '<pre>';print_r($we);echo '</pre>';
	return $we;
	
});

//Closing
/*
Controller -  Closing.php
DB :: dot2
*/
Route::get('closing','Closing@index');
Route::get('closing/remedials','Closing@remedials');
Route::get('closing/clear_or','Closing@clear_or_num');
Route::get('closing/permits','Closing@clearPermits');
