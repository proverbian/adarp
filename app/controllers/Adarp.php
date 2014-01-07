<?php

class Adarp extends Controller {

    public function we() 
    {
        return array('m'=>'Male','f'=>'Female');
    }

	protected function index() 
    {
		//return View::make('layout.master');
	}

    public function getDate() 
    {
        return date('Y-m-d H:i:s');
    }

  

 	protected function register_form() 
    {
    
        if (!Auth::check()) {

        foreach ($this->getParentKey() as $val) {          
            $keys = $this->getAvailableKeys($val->id);
            $val->value = $keys; 
            $arr[] = $val;
        }


       /* echo '<pre>';print_r($arr);
        echo '</pre>';
        die();
            $personalinfo = $this->getAvailableKeys(1);
            $coursegrad = $this->getAvailableKeys(2);
            $contactdetails = $this->getAvailableKeys(3);
            $business = $this->getAvailableKeys(4);

            $personal_dynamic_keys = array(
                    'coursegrad'=>$coursegrad,
                    'personalinfo'=>$personalinfo,
                    'contactdetails'=>$contactdetails,
                    'business'=>$business
            );
            */
            $personal_dynamic_keys = array(
                'array' => $arr
                );
            return View::make('register',$personal_dynamic_keys);
            
        }else{
            return Redirect::to('dashboard')->with('already_registered',true);
        }
 	}


 	protected function register_me() 
    {
 	
     	/*$rules = array(
                'fname' => 'required',
                'lname' => 'required',
                'dob' => 'required'
            );*/
        
        $req = DB::table('adarp_keys')->where('required','1')->get();
        
        // Every Required text fields will be added to this validation and will be added a required sign in the form
        foreach ($req as $re) {
            $rules[$re->id] = 'required';
        }

        $validator = Validator::make(Input::all(), $rules);
     
        if ($validator->fails())
        {
            // if validation fails redirect with error and old input value

            // Saving all the posted to session and assign to Inputbox to avoid data loss
            foreach(Input::get() as $key => $sess) {
                Session::put($key,$sess);
            }
            //Redirect to Registration form with session
            return Redirect::to('register')->with('register_errors',true);
            
        }
            $token = Session::get('_token');
          
            
            DB::table('adarp_users')->insert(array('username'=>Input::get('fname').Input::get('lname')));
            $last = DB::table('adarp_users')->orderBy('id','desc')->first();

            // Get the last ID
            $last_id = $last->id;
            
            $profile = new AdarpMod;
            $profile->user_id = $last_id;
            $profile->student_id = Input::get('fuid');
            $profile->first = Input::get('fname');
            $profile->middle = Input::get('middle');
            $profile->last = Input::get('lname');
            $profile->gender = Input::get('gender');
            $profile->status = Input::get('status');
            $profile->maiden = Input::get('maiden');
            $profile->dob = Input::get('dob');
           // $profile->updated_at = $time();
            //$profile->created_at = $time();
            $profile->save();


            //First Option - Instantiate Every Array
            /*
            foreach (Input::get() as $key => $data) {
                 if (is_numeric($key)) {
                    $apkey = new Usermeta;
                     echo $key . ' char <br>';
                     $apkey->user_id = $last_id;
                     $apkey->key_id = $key;
                     $apkey->value = $data;
                     $apkey->save();
                 }
            }
            */
            
            //End First Option

            // Second Option - Re array (maybe this is faster)
            foreach (Input::get() as $key => $data) {
                if (is_numeric($key)) {
                    $arr[$key]['user_id'] = $last_id;
                    $arr[$key]['key_id'] = $key;
                    $arr[$key]['value'] = $data;
                    $arr[$key]['updated_at'] = $this->getDate();
                    $arr[$key]['created_at'] = $this->getDate();
                }
            }

           /* echo '<pre>';
            print_r($arr);
            echo '</pre>';

            die();
        */  
            DB::table('adarp_usermeta')->insert($arr);
            return Redirect::to('success')->with('success');
        
            //End Second Option
    }

    public function viewProfile2($id){
       $user =  Auth::user()->id;
        $users = AdarpMod::where('user_id',$user)->first(); //eloquent
        return View::make('layout.profile_edit',array('user'=>$users));
    }

    public function viewProfile($id=NULL) {
        if ($id == NULL) {
            $id = Auth::user()->id;
        }

        $users = Usermeta::where('user_id',$id)->get(); // eloquent
        foreach ($users as $key => $user) {
          // echo $user->key_id . '   ' .$user->value;
           $we = $this->getKeyName($user->key_id);
            if ($we) {
                $arr[$user->key_id]['type'] = $we->name;
                $arr[$user->key_id]['value'] = $user->value;
                
               // echo $we->name.' : '.$user->value. '<br>';
            }

       }
           return View::make('profile.profile')
                     ->with('value',$arr);
    
    }

    public function updateProfile() {
        $user =  Auth::user()->id;
        $profile = Adarpmod::where('user_id',$user)->first();
        $profile->first = Input::get('fname');
        $profile->middle = Input::get('middle');
        $profile->last = Input::get('lname');
        $profile->gender = Input::get('gender');
        $profile->status = Input::get('status');
        $profile->save();
        return Redirect::to('profile/edit')->with('success');
    }



    public function checkToken() {
        $_token = Session::get('_token');
    
        $token = DB::table('adarp_tokens')->where('token',$_token)->first();
        if (!$token) {
            $last = DB::table('adarp_profile')->select('user_id')->orderBy('user_id','desc')->first();
            $data = array(
                'user_id' => $last->user_id + 1,
                'token' => $_token
                );  
            return DB::table('adarp_tokens')->insert($data);
        }else{
            return $token;
        }

    }

    public function mailman() {
        // I'm creating an array with user's info but most likely you can use $user->email or pass $user object to closure later
        $user = array(
            'email'=>'myemail@mailserver.com',
            'name'=>'Laravelovich'
        );
         
        // the data that will be passed into the mail view blade template
        $data = array(
            'detail'=>'Your awesome detail here',
            'name'  => $user['name']
        );
         
        // use Mail::send function to send email passing the data and using the $user variable in the closure
        Mail::send('emails.welcome', $data, function($message) use ($user)
        {
          $message->from('admin@site.com', 'Site Admin');
          $message->to($user['email'], $user['name'])->subject('Welcome to My Laravel app!');
        });
    }

    public function registered() {
        $profile = AdarpMod::paginate(10);    
        return View::make('reports.users')
        ->with('profile',$profile);

    }

    public function profileview($id) {
        $profile = AdarpMod::where('user_id','=',$id)->first();
        $exprofile = DB::table('adarp_usermeta')->select('name','value')
        ->leftJoin('adarp_keys','adarp_keys.id','=','adarp_usermeta.key_id')
        ->where('adarp_usermeta.user_id',$id)->get();
        return View::make('profile.view')
        ->with('profile',$profile)
        ->with('extra',$exprofile);
    }

    public function removeUser($id) {
        Adarpmod::where('user_id','=',$id)->delete();
        DB::table('adarp_usermeta')->where('user_id',$id)->delete();
        return Redirect::to('success')->with('success_delete');
    }

    //Administration
    public function admin_dashboard() {
        return View::make('admin.dashboard');
    }

    public function manageFields() {
        $parent_cat = $this->getParentKey();    
        $parent[0] = '-- No Parent --';

        foreach ($parent_cat as $cat) {
            $parent[$cat->id] = $cat->name;   
        }
        return View::make('admin.manage_fields_add')
        ->with('parent',$parent);
    }

    public function manageField($option) {
        if ($option == 'add') {
            $data = array(
                'name' => Input::get('name'),
                'type' => Input::get('type'),
                'parent' => Input::get('parent') 
                );
            if (Input::has('active')) {
                 $data['active'] = Input::get('active');    
            }
            
             $conf_check = DB::table('adarp_keys')->select('name')
             ->where('name','=',Input::get('name'))
             ->where('parent','=',Input::get('parent'))
             ->get();

            if ($conf_check) { 
            return Redirect::to('admin/manage/fields')
                  ->with('error_dupe',true);
            }else{
                DB::table('adarp_keys')->insert($data);
                return Redirect::to('admin/manage/fields/add')
                ->with('success',true);
            }
             
        }
    }

    public function manage() {
        return View::make('admin.dashboard');
    }

    public function manage_fields() {
        $pkeys =  $keys = DB::table('adarp_keys')
        ->select('id','name')
        ->where('parent','=',0)
        ->orderBy('order','asc')
        ->get();

        return View::make('admin.manage_fields')
        ->with('pkeys',$pkeys);
    }

    public function getLastID() {
         $last = DB::table('adarp_users')->orderBy('id','desc')->first();
            // Get the last ID
        return $last->id;
    }

    //register r2
    public function r2 () {
    
        $key = $this->keyGen();
        $email = Input::get('email');

       $v = $this->validator($email);
        echo $email;
        if ($v->getMessages()->has('email')) {
            echo 'email';
        }else{
            
        }
       
       /* $data = array(
            'detail' => 'Please confirm your registration by clicking the link',
            'name' => 'Alumni Association',
            'key' => $key);
        Mail::send('emails.welcome', $data, function($message)
    {
        $message->from('shiloh@foundationu.com','Alumni Association');
        $message->to($email, $email)
        ->subject('Confirmation Link!');
    });

    */

    }

    public function validator($input) { 
       
    }


    public function keyGen() {
        $key = hash('sha1',uniqid(serialize($_SERVER), true));
        return $key;
    }



      //keys

    public function  getKeyName($id=NULL) 
    {
        if ($id==NULL) {
            return DB::table('adarp_keys')
            ->select('name','type','id','arr_val')
            ->first();
        }else{
            return DB::table('adarp_keys')
            ->select('name','type','id','arr_val')
            ->where('id',$id)
            ->first(); 
        }

       
    }

    public function getAvailableKeys($parent) 
    {
        $keys = DB::table('adarp_keys')
        ->leftJoin('adarp_keys_position','adarp_keys.id','=','adarp_keys_position.key_id')
        ->where('adarp_keys.parent','=',$parent)
        ->where('adarp_keys_position.position_id','!=','0')
        ->orderBy('adarp_keys_position.order','asc')
        //->where('active','=','1')
        ->get();
 
     foreach ($keys as $k => $key) { 
        if ($key->type=='select') { //This will be executed if type is "<select></select>"
             $keys_form = DB::table('adarp_keys_form')
            ->select('key','value')
            ->where('key_id',$key->key_id)->get();

            foreach ($keys_form as $form) {
                $keys[$k]->arr_val[$form->key] = $form->value; //Assign Array
            } 
        }
    }
        return $keys;
    }

    public function getParentKey() 
    {
        $keys = DB::table('adarp_keys')
        ->select('id','name')
        ->where('parent','=',0)
        ->where('active','=','1')
        ->orderBy('order','asc')
        ->get();
        return $keys;
    }

    //End Keys

    public function getProfileFields($id = NULL) //This is used generally to display the Fields for Profile
    {
    
    if ($id == NULL) {
        $id = Auth::user()->id;
     }

    $users = Usermeta::where('user_id',$id)->get(); // eloquent

    if (count($users)==0) {
       $keys = $this->getKeyName(); 
       
    }

    
    foreach ($users as $key => $user) 
    {
        $key = $this->getKeyName($user->key_id);
      
        if ($key) 
        {
            $arr[$user->key_id]['name'] = $key->name;
            $arr[$user->key_id]['value'] = $user->value;
            $arr[$user->key_id]['type'] = $key->type;
            $arr[$user->key_id]['key_id'] = $key->id;
            $arr[$user->key_id]['arr_val'] = array($key->arr_val);
           
            if ($key->type=='select') 
            { //This will be executed if type is "<select></select>"
             $keys_form = DB::table('adarp_keys_form')
            ->select('key','value')
            ->where('key_id',$key->id)->get();
            if ($key->id == 14) :
            
            $keys_form = DB::table('adarp_provinces') //province
            ->select('id','province')
            ->get();

            foreach ($keys_form as $form) {
                 $arr[$user->key_id]['select_val'][$form->province] = $form->province; //Assign Array
            } 
            
            elseif($key->id == 13): //municipality
            
            $keys_form = DB::table('adarp_municipalities')
            ->select('id','municipality')
            ->get();

            foreach ($keys_form as $form) {
                 $arr[$user->key_id]['select_val'][$form->municipality] = $form->municipality; //Assign Array
            } 

            else:

             $keys_form = DB::table('adarp_keys_form')
            ->select('key','value')
            ->where('key_id',$key->id)->get();
            foreach ($keys_form as $form) {
                 $arr[$user->key_id]['select_val'][$form->value] = $form->value; //Assign Array
            } 

            endif;

           }

        }
    }
       return $arr;
    }

    public function getProfileFields2()
    {
        $user_id = Auth::user()->id; //get login id
        $parent = $this->getParentKey(); //get parent keys

            foreach ($parent as $pkey) :
                $keys = $this->getAvailableKeys($pkey->id); //get all child keys
               
                foreach ($keys as $k => $key) :
                    $meta = Usermeta::where('user_id',$user_id) //get value in each keys
                            ->where('key_id',$key->key_id)
                            ->select('value')
                            ->first();
                   // var_dump($meta['value']);
        
                 if ($key->type=='select') :
                  //This will be executed if type is "<select></select>"
                  $keys_form = DB::table('adarp_keys_form')
                 ->select('key','value')
                 ->where('key_id',$key->key_id)->get();
                  
                    if ($key->key_id == 14) :
                    
                        $keys_form = DB::table('adarp_provinces') //province
                        ->select('id','province')
                        ->get();

                        foreach ($keys_form as $form) {
                             $keys_arr[$pkey->name][$key->key_id]['select_val'][$form->province] = $form->province; //Assign Array
                        } 
                        
                    elseif($key->key_id == 13): //municipality
                    
                        $keys_form = DB::table('adarp_municipalities')
                        ->select('id','municipality')
                        ->get();

                        foreach ($keys_form as $form) {
                             $keys_arr[$pkey->name][$key->key_id]['select_val'][$form->municipality] = $form->municipality; //Assign Array
                        } 

                    else:

                         $keys_form = DB::table('adarp_keys_form')
                        ->select('key','value')
                        ->where('key_id',$key->key_id)->get();
                        foreach ($keys_form as $form) {
                             $keys_arr[$pkey->name][$key->key_id]['select_val'][$form->value] = $form->value; //Assign Array
                        } 

                    endif;
                  endif; //end key->type == select

                     $keys_arr[$pkey->name][$key->key_id]['key_id'] = $key->key_id;
                     $keys_arr[$pkey->name][$key->key_id]['key_name'] = $key->name; //re array to display to view
                     $keys_arr[$pkey->name][$key->key_id]['value'] = $meta['value'];
                     $keys_arr[$pkey->name][$key->key_id]['type'] = $key->type;
                     $keys_arr[$pkey->name][$key->key_id]['user_id'] = $user_id;
                     $keys_arr[$pkey->name][$key->key_id]['arr_val'] = array($key->arr_val);
         
                endforeach;
            endforeach;
           return $keys_arr;
 //end check
       
       /* echo '<pre>';
        print_r($keys_arr);
        echo '</pre>';
        */
    }




}

?>