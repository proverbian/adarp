<?php

class Profile extends Eloquent {
	protected $table = 'adarp_profile';
	protected $fillable = array('value','uid','user_id');
	protected $primaryKey = 'user_id';

    public function usermeta() {
    	return $this->hasMany('Usermeta','user_id');
    }

    public function get_user_profile($id) 
    {
        $user = Users::find($id);
        $value['added_new_profile'] = false;
        
        if ($user->profile==NULL):
            Profile::create(array('user_id'=>$id)); //if user is empty. add!
            $value['added_new_profile'] = true;
        endif;

        foreach ($user->usermeta as $data) {
            $all[$data->key_id] = $data->value;
        }  

         $courses = DB::table('course')
                ->where('collcode','!=',7)
                ->get();

         $gs_src = DB::table('course') //gs
                ->where('collcode',7)
                ->get();
            
         $gs['def'] = 'None';
         foreach ($gs_src as $gs_) {
            $gs[$gs_->coursename] = $gs_->coursename;
         }

         $c['def'] = 'None';
         foreach ($courses as $course) {
            $c[$course->coursename] = $course->coursename;
         }

         $c['def'] = 'None';
         $doc_array = array('EDD','DPA');

         foreach ($gs_src as $gs_) {
            if (in_array($gs_->coursename,$doc_array)) {
                $pg[$gs_->coursename] = $gs_->coursename;
             }
         }

         $value['profile'] = $user->profile;
         $value['usermeta'] = $all;
         $value['gs'] = $gs;
         $value['pg'] = $pg;
         $value['courses'] = $c;
        
         return $value;        
    }

    public function post_user_profile($user_id)
    {
       
        $all = Input::all();

        $profile = Profile::where('user_id',$user_id)->first();
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


        $existing_key = Usermeta::where('user_id',$user_id)
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
                        'user_id'=>$user_id
                        );
                Usermeta::create($insert); //insert new records
            else: // existing user who updates profile
                if (in_array($key,$data)): //if posted keys existed in user keys from usermeta
                    
                    Usermeta::where('user_id',$user_id)
                        ->where('key_id',$key)
                        ->update(array('value'=>$u));   //update posted with matching keys
                else: //all unmatched keys which are new keys will be inserted with values
                //  if ($key != '_token' and $key != 'user_id'): //exclude user_id and _token from being inserted
                    $insert = array(
                        'key_id' => $key,
                        'value'=> $u,
                        'user_id'=>$user_id
                    );
                    Usermeta::create($insert); //insert new records
                //  endif;
                endif;
            endif;
        }

        return true;
    } //end post_user_profile
   
}

?>