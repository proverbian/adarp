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
	return View::make('layout.default')
	->with('posts',$posts);
});

Route::get('home', function()
{
	if (Auth::check()){
		return Redirect::to('/');
	}else{
		return Redirect::to('login');
	}
});


Route::get('dashboard',function()
{
	return View::make('user.dashboard');
});


// register - option 1 //adarp/register2
Route::get('register',function() {
	return View::make('register.register2');
});
Route::post('register',function() {
	
	 $rules = array(
       'email'=> 'Required|Between:3,64|Email|unique:adarp_users'
     );
   
 	 $v =  Validator::make(Input::all(), $rules);

	if ($v->passes()) :
		//$check = User::where('username','=',Input::get('email'))
				//->where('activated','<>',1)
		//		->first();

		//dd($check);
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
			return Redirect::to('register')
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

Route::get('admin',function() 
{
	if (Auth::check()){
		if (Auth::user()->user_type==1) {
			return View::make('admin.dashboard');
		}else{
			return Redirect::to('/');
		}
	}else{
		return Redirect::to('login');
	}
});
Route::get('admin/users',function() {
	$users = User::take(10)
			->orderBy('id','desc')
			->get();

	return View::make('admin.users')
	->with('id',$id)
	->with('users',$users);
});


Route::post('admin/users/add',function()
{
	$user = new User();
	$user->username = Input::get('username');
	$user->password = Hash::make(Input::get('password'));
	$user->activated = 1;
	$user->save();

	return Redirect::to('admin/users');
});

Route::get('admin/users/{id}',function($id) 
{	
	$prof = GetProfile::where('user_id',$id)->first();
	$usermeta = Usermeta::where('user_id',$id)->get();
	foreach ($usermeta as $meta) {
		$umeta[$meta->key_id] = $meta->value;
	}


	return View::make('admin.single_user')
	->with('profile',$prof)
	->with('usermeta',$umeta);	
});

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
*  Start Home Coming 
*
*/

Route::get('homecoming/attendance/{year}',function($year)
{
	if (!Auth::check()) {
		return Redirect::to('homecoming/login');
	}

	$attendees = DB::table('adarp_homecoming')
			->leftJoin('adarp_profile','adarp_homecoming.user_id','=','adarp_profile.user_id')
			->where('adarp_homecoming.created_at','like',$year.'%')
			->where('adarp_profile.user_id','!=','')
			->orderBy('adarp_homecoming.created_at','desc')
			->select('adarp_profile.user_id','last_name','first_name',
			'adarp_homecoming.created_at','middle_name')
			->paginate(15);

	/*$attendees = DB::table('adarp_homecoming')->select('user_id','created_at')->get();
	foreach ($attendees as $att) {
		$all[] = DB::table('adarp_profile')
		->select('user_id')
		->where('user_id',$att->user_id)
		->first();

	}

		dd($all);*/
	return View::make('homecoming/attendance')
	->with('date',$year)
	->with('attendees',$attendees);
});

Route::post('homecoming/user/update',function()
{


	$profile = GetProfile::where('user_id',Input::get('user_id'))->first();
	$profile->first_name = Input::get('first_name');
	$profile->middle_name = Input::get('middle_name');
	$profile->last_name = Input::get('last_name');
	$profile->address = Input::get('address');
	$profile->email = Input::get('email');
	$profile->status = Input::get('status');
	$profile->dob = Input::get('dob');
	$profile->course = Input::get('course');
	$getcol = DB::table('course')->where('coursename',Input::get('course'))->first();
	$profile->college = $getcol->college;
	$profile->collcode = $getcol->collcode;
	$profile->updated_by = Auth::user()->username;
	$profile->save();

	//unset(Input::get('first_name'));
	$exclude = array('first_name','last_name','middle_name','address','email','status','_token','user_id');

	foreach (Input::all() as $key => $input) { // Next time transfer this to a controller or model
		if (!in_array($key,$exclude)) {
			$check = Usermeta::where('key_id',$key)
			->where('user_id',Input::get('user_id'))
			->first();
	
			if (empty($check)) { // No Record Found , Add new
				$ins = new Usermeta;
				$ins->key_id = $key;
				$ins->value = $input;
				$ins->user_id = Input::get('user_id');
				$ins->save();
			}else{ // Attribute Exists ( update value )	
				$up = Usermeta::whereUser_id(Input::get('user_id'))
				->whereKey_id($key)
				->update(array('value'=>$input));
			}
			echo $key . ' -  '. $input;
		}
	}
	
	//$usermeta = Usermeta::where()

	return Redirect::to('homecoming/user/login/'.$profile->user_id)->with('updated',true);

});

Route::get('homecoming/ct',function()
{
	return View::make('homecoming.ct');
});

Route::post('homecoming/ct',function()
{

	// requires php5
	//dd($_POST['img']);
	///dd($_POST['user_id']);
	define('UPLOAD_DIR', 'images/');

	$img_id = uniqid();
	$img = $_POST['img'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$file = UPLOAD_DIR . $img_id . '.png';
	$success = file_put_contents($file, $data);

	$update = GetProfile::where('user_id',$_POST['user_id'])->first();
	$update->pic = $img_id . '.png';
	$update->save();

	//print $success ? $file : 'Unable to save the file.';
	
});


Route::get('homecoming/user/login/{id}',function($id)
{
	$profile = DB::table('adarp_profile')
			->where('user_id',$id)
			->first();

	$usermeta = DB::table('adarp_usermeta')
	->where('user_id',$id)->get();

	foreach ($usermeta as $userm) {
		$user_all[$userm->key_id] = $userm->value;
	}

	$courses = DB::table('course')->get();


	return View::make('homecoming/user_update')
	->with('profile',$profile)
	->with('usermeta',$user_all)
	->with('courses',$courses)
	->with('updated',Session::get('updated'));
});

Route::get('homecoming/newuser',function() 
{	
	return View::make('homecoming.newuser');
});

Route::post('homecoming/newuser',function() 
{
	if (!Auth::check()) {
		return Redirect::to('homecoming/login');
	}
	//dd(Input::all());
	$search = GetProfile::where('first_name',Input::get('first_name'))
	->where('last_name',Input::get('last_name'))
	->ORwhereRaw("email = '".Input::get('email')."' and email != ''")
	->first();

	if (empty($search)) {

		$user = new User;
		$user->username = Input::get('email');
		$user->email =  Input::get('email');
		$user->origin = 'homecoming';
		$user->password = Hash::make(Input::get('password'));
		$user->save();

		//for student database
		$pro = new GetProfile;
		$pro->user_id = $user->id;
		$pro->first_name =  Input::get('first_name');
		$pro->middle_name = Input::get('middle_name');
		$pro->last_name = Input::get('last_name');
		$pro->gender = $user->gender;
		$pro->dob = $user->dob;
		$pro->save();
		}else{
			return Redirect::to('homecoming/newuser')->with('dupe',true);
		}

	return Redirect::to('homecoming/newuser')->with('create_user_success',true);
});


Route::get('homecoming/user/{id}',function($id)
{
	$profile = DB::table('adarp_profile')
			->where('user_id',$id)
			->first();
	
	$attended = DB::table('adarp_homecoming')
			->where('user_id',$id)
			->where('created_at','like',date('Y').'%')
			->first();

	$usermeta = DB::table('adarp_usermeta')
	->where('user_id',$id)->get();

	foreach ($usermeta as $userm) {
		$user_all[$userm->key_id] = $userm->value;
	}
	
	if ($attended) {
		$att = true;
	}else{
		$att = false;
	}		

	 //live (uncomment this!)

	if (empty($profile->pic)) {	 	
		$fileUrl = "http://server1.foundationu.com/student_logs/photo/".$profile->student_id.".JPG";
		$AgetHeaders = @get_headers($fileUrl);
		if (preg_match("|200|", $AgetHeaders[0])) {
			$image = 'http://server1.foundationu.com/student_logs/photo/'.$profile->student_id.'.JPG';
		} else {
			$image = '/img/blank_image.jpeg';
		}
	}else{
		$image = '/images/'.$profile->pic;
	}



	//$image = '/img/blank_image.jpeg';

	return View::make('homecoming/user')
	->with('profile',$profile)
	->with('usermeta',$user_all)
	->with('image',$image)
	->with('attended',$att);
});

Route::get('homecoming/report/statistics',function() 
{

	if (!Auth::check()) {
		return Redirect::to('homecoming/login');
	}
	
	$home = DB::table('adarp_homecoming')
	->leftjoin('adarp_profile','adarp_homecoming.user_id','=','adarp_profile.user_id')
	->select('first_name','last_name','gender','status','college','collcode','course','dob')
	->where('adarp_homecoming.created_at','like','2013%')->get();


	$colleges = DB::table('course')
		->groupBy('college')->get();
	
		$col_list = array('SCS'=>'CCS','ACS'=>'CBA');

	foreach ($colleges as $col) {
		if (array_key_exists($col->college,$col_list)) {
			$college_name = $col_list[$col->college];
		}else{
			$college_name = $col->college;
		}
		$col_arr[$col->collcode] = array('college'=>$college_name);
	}

	$stat_gender = array();
	$stat_dob = array();


	foreach ($home as $data) { //re assign courses
		$diff = abs(strtotime(date('y-m-d')) - strtotime($data->dob));
		$col_arr[intval($data->collcode)][] = $data;	//college intval() - to convert 04 to 4

		//unset($col_arr['SCS']);
		unset($col_arr[9]);
		$stat_gender[$data->gender][] = $data; //gender

		

		//printf("%d years, %d months, %d days\n", $years, $months, $days);
			if (!empty($data->dob)) {
				$years = floor($diff / (365*60*60*24));
				//$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
				//$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

				if ($years<18) {
					$stat_dob['18 below'][] =  $data; //age
				}elseif ($years>18 and $years<=30){
					$stat_dob['18-30'][] =  $data; //age
				}elseif ($years>30 and $years<=40){
					$stat_dob['30-40'][] =  $data; //age
				}elseif ($years>40 and $years<=60){
					$stat_dob['40-60'][] =  $data; //age
				}else{
					$stat_dob['Above 60'][] =  $data; //age
				}
			}
	}

	arsort($col_arr);

	/*
	echo '<pre>';
	print_r($col_arr);
	echo '</pre>';
	*/

	return View::make('homecoming.statistics')
		->with('colleges',$col_arr)
		->with('stat_gender',$stat_gender)
		->with('age_filter',$stat_dob);
	
	/*ini_set('max_execution_time' ,0); 
	ini_set('set_memory_limit', -1);

	$profile = DB::table('adarp_profile')
	->where('collcode','=',NULL)
	->select('id','student_id','course')
	->get();
	foreach ($profile as $pro) {
		$getCol = DB::connection('dot2')->table('course')
		->select('college','collcode')
		->where('coursename',$pro->course)
		->first();
		$pr = GetProfile::find($pro->id);
		$pr->collcode = $getCol->collcode;
		$pr->college = $getCol->college;
		$pr->save();	
	}

	dd('done!');
	*/
});

Route::get('homecoming/report/courses',function()
{
	//$count = DB::table(DB::raw("SELECT count(a.user_id),b.course from adarp_homecoming a left join adarp_profile b on a.user_id = b.user_id where a.created_at like '%2013%' and course is not NULL group by course order by count(a.user_id) desc"));
	$rec = DB::table('adarp_homecoming as a')
			->leftJoin('adarp_profile as b','a.user_id','=','b.user_id')
			->where('a.created_at','like','2013%')
			->where('course','!=','NULL')
			//->groupBy('course')
			//->orderBy('cnt','desc')
			->get();
	foreach ($rec as $data) {
		$all[$data->course][] = $data;
	}

	return View::make('homecoming.courses')
			->with('data',$all);
});

Route::get('homecoming/report/earlybird',function()
{
	//$count = DB::table(DB::raw("SELECT b.first_name,b.last_name,b.user_id,b.course,b.address,a.created_at from adarp_homecoming a left join adarp_profile b on b.user_id = a.user_id where a.created_at like '2013%' order by a.created_at desc"));

	$early = DB::table('adarp_homecoming')
			->leftJoin('adarp_profile','adarp_homecoming.user_id','=','adarp_profile.user_id')
			->select('adarp_profile.first_name','adarp_profile.last_name','adarp_profile.user_id',
			'adarp_profile.course','adarp_profile.address','adarp_homecoming.created_at','adarp_profile.pic')
			->where('adarp_homecoming.created_at','like','2013%')
			->orderby('adarp_homecoming.created_at','asc')
			->first();

	$usermeta = DB::table('adarp_usermeta')
	->where('user_id',$early->user_id)->get();

	foreach ($usermeta as $userm) {
		$user_all[$userm->key_id] = $userm->value;
	}

	if (empty($early->pic)) {
		$image = '/img/blank_image.jpeg';
	}else{
		$image = '/images/'. $early->pic;
	}
	return View::make('homecoming.early_birds')
	->with('image',$image)
	->with('usermeta',$user_all)
	->with('bird',$early);
});

Route::get('homecoming/raffle',function() {
	return View::make('homecoming.raffle_blank');
});

Route::post('homecoming/raffle',function() {
 
	$raffle = DB::table('adarp_homecoming')
		->select('user_id')
		->orderBy(DB::raw('RAND()'))
		->where('created_at','like',date('Y').'%')
		->take(1)
		->first();
	$user = GetProfile::where('user_id',$raffle->user_id)->first();

	$usermeta = DB::table('adarp_usermeta')
	->where('user_id',$raffle->user_id)->get();

	foreach ($usermeta as $userm) {
		$user_all[$userm->key_id] = $userm->value;
	}

	return View::make('homecoming.raffle')
	->with('winner',$user)
	->with('usermeta',$user_all);

		//dd($raffle);
});

Route::get('homecoming',function()
{
	if (Auth::check()) {
		return View::make('homecoming.form');
	}else{
		return Redirect::to('homecoming/login');
	}
});

Route::post('homecoming/login',function()
{
	$array = array(
		'username'=>Input::get('username'),
		'password'=>Input::get('password')
		);
	$auth = Auth::attempt($array);
	
	$user = User::find(Auth::user()->id);
	if ($auth) {
		Auth::login($user);	
	} 
	//dd($auth);
	return Redirect::to('homecoming');
});

Route::get('homecoming/logout',function()
{
	Auth::logout();
	return Redirect::to('homecoming/login');
});

Route::get('homecoming/login',function() 
{
	return View::make('homecoming.login');
});


Route::get('checker',function() {
	dd('done script!');
	$ff = DB::table('adarp_homecoming')->groupBy('user_id')->get();
	foreach ($ff as $f) {
		$ch = DB::table('adarp_homecoming')->where('user_id',$f->user_id)->get();
		if (count($ch)==2) {
			DB::table('adarp_homecoming')->where('id',$f->id)->delete();

		}
	}
});

Route::post('homecoming/register/new',function()
{
	//dd(Input::get('user_id'));
	$user_id  = Input::get('user_id');

	$data = array(
				'user_id'=>$user_id,
				'created_at'=>new DateTime);

	$reg = DB::table('adarp_homecoming')
			->insert($data);

	return Redirect::to('homecoming/user/'.$user_id);
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

	//$search = GetProfile::whereRaw("first_name like '%".$term."%' or middle_name like '%".$term."%' or last_name like '%".$term."%'")
	//->get();

	$search = DB::table('adarp_profile')
	->whereRaw("first_name like '%".$term."%' or middle_name like '%".$term."%' or last_name like '%".$term."%' or user_id like '%".$term."%' or student_id like '%".$term."%'")
	->orderBy('last_name','first_name','desc')
	->get();

	foreach ($search as $single) {
		$val['value'] = ucfirst(strtolower($single->last_name)) .', '. ucfirst(strtolower($single->first_name)) . ' '. ucfirst(strtolower(substr($single->middle_name,0,1))).'.';
		$val['user_id'] = $single->user_id;

		$all[] = $val;
	}
		return $all;
	
	
});

/*
*  End Home Coming 
*
*/


Route::get('fblogin',function() 
{
	if (Auth::check()) {
		$data = Auth::user();
	}
	return View::make('fb.login')
		->with('data',$data);
});

Route::get('login/fb', function() {
    $facebook = new Facebook(Config::get('facebook'));
    $params = array(
        'redirect_uri' => url('/login/fb/callback'),
        'scope' => 'email',
    );
    return Redirect::to($facebook->getLoginUrl($params));
});

Route::get('login/fb/callback', function() {
    $code = Input::get('code');
    if (strlen($code) == 0) return Redirect::to('/')->with('message', 'There was an error communicating with Facebook');
 
    $facebook = new Facebook(Config::get('facebook'));
    $uid = $facebook->getUser();
 	$accessToken = $facebook->getAccessToken();
 	$facebook->setAccessToken($accessToken);

 
    if ($uid == 0) return Redirect::to('/')->with('message', 'There was an error');
 
    $me = $facebook->api('/'.$uid); //this solveds the bug (access token bug)
 
 	$profile = GetProfile::whereUid($uid)->first();

 	if (empty($profile)) {
 	

 		$user = new User;
 		$user->uid = $uid;
 		$user->username = $me['first_name'].'.'.$me['last_name'];
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



 	//dd($uid);

 	$user = User::whereUid($uid)->first();
 	$user->access_token = $accessToken; //saves access_token
 	$user->save();
 	Auth::login($user);
 	//echo '<script> window.close();</script>';

 	return Redirect::to('/');

});


Route::get('migratefromreg',function() {
dd('maintenance');
	//student database
	/*$grads = DB::connection('dot2')->table('student')
	->select('fu_num as student_id','first as first_name','middle as middle_name','last as last_name','emailadd as email_address','course',
			'graduatedate as graduate_date','address','sex as gender','status','b_date as dob','spouse','nationality','cred_pre_school1 as elementary','cred_pre_school2 as highschool','cred_school1_year as elementary_year','cred_school2_year as highschool_year',
			'cred_grad_course1','cred_grad_course2','cred_course1_school','cred_course2_school','cred_course1_year','cred_course2_year',
			'GraduateDate','SO_Number','Province','schl_code')
	->whereRaw("first is not null and middle is not null and last is not null  and GraduateDate != ''")
	->get();
*/

	$grads = DB::connection('alumni_registrar')
	->table('alumni')
	->select('row_id','first as first_name','middle as middle_name','last as last_name','b_date as dob','course_grad','year_grad',
			'fu_num as student_id','homeaddress as street_brgy','city as city_town','province as state_province','country',
			'postalcode as postal_code',
			'com_name as company_name','com_address as company_addr','com_city','com_province','com_country','hometelnum as tel_no',
			'mobilenum as mobile_no','emailaddress as email_address','url')
	->whereRaw('(first is not NULL and middle is not null and last is not null and imported is null)')
	//->take(20000)
	->get();

	/*$queries = DB::getQueryLog();
	dd($queries);
	*/
	foreach ($grads as $user) {
	
		$checker = GetProfile::where('last_name',$user->last_name)
		->where('first_name',$user->first_name)
		->where('middle_name',$user->middle_name)
		->first();

		if (empty($checker)) {

			$users = new User;
			$users->username = strtolower($user->first_name).'.'.strtolower($user->last_name);
			$users->email = $user->email_address;
			$users->origin = 'reg_alum';
			$users->save();

			//for student database
			$pro = new GetProfile;
			$pro->user_id = $users->id;
			$pro->student_id = $user->student_id;
			$pro->first_name = $user->first_name;
			$pro->middle_name = $user->middle_name;
			$pro->last_name = $user->last_name;
			$pro->address = $user->address;
			$pro->course = $user->course_grad; //course
			$pro->gender = $user->gender;
			$pro->status = $user->status;
			$pro->dob = $user->dob;
			$pro->save();

			/*$umeta = new Usermeta;
			$umeta->user_id = $users->id;
			$umeta->key_id = 'graduate_date';
			$umeta->value = $user->graduate_date;
			$umeta->save();
			*/

			//Exclude this fields because they already exists in adarp_profile
			$exclude = array('row_id','first_name','middle_name','last_name','gender','status','address','course','student_id','email_address');

			foreach ($user as $key => $u) {
				if (!in_array($key,$exclude)) {
					$umeta = new Usermeta;
					$umeta->user_id = $users->id;
					$umeta->key_id = $key;
					$umeta->value = $u;
					$umeta->save();
				} //end if
			
			} //end foreach
		
		}else{
			DB::connection('alumni_registrar')
			->table('alumni')
			->where('row_id',$user->row_id)
			->update(array('imported'=>1));
			
			echo 'already exists '. $user->first_name . ' '.$user->last_name.' '.$user->middle_name .$user->row_id.'<br>';

		}//End IF checker
		
	}

	echo 'done';
	//return false;
	//dd($alum);

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
