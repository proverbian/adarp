<?php

class Exporter extends Adarp {
	public function getRecords() {
		//$ex = DB::connection('dot3')
		$data = DB::connection('alumni_registry')
		->table('profile')
		->where('imported','=',NULL)
		->take(10000)
		->get();
			
		foreach ($data as $val) {
			//$this->insertProfiles($val);
		}
	}


	public function insertProfiles($data) {

		$user_id = $this->getLastID() + 1;
		//$last_id = $last = DB::table('adarp_users')->orderBy('id','desc')->first();
		//$user_id = $last_id->id;
		//This must be changed. 

		/*$profile = new AdarpMod;
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
        $profile->save();*/


		$keys = array(
			'first_name'=>'46',
			'last_name'=>'48',
			'fu_num'=>'45',
			'middle_name'=>'47',
			'mother_maiden'=>'49',
			'gender'=>'61',
			'status'=>'62',
			'bmonth'=>'9997',
			'bday'=>'9999',
			'byear'=>'9999',
			'suffix'=>'3',
			'profession_id'=>'1',
			'phone'=>'4',
			'mobile'=>'5',
			'email'=>'6',
			'province_id'=>'14',
			'city_id'=>'13',
			'street'=>'12',
			'occupation'=>'63',
			'position'=>'9',
			'occ_phone'=>'7',
			'occ_fax'=>'64',
			'occ_address'=>'65'
			);
	
		//foreach ($data as $key => $val) {	

			$bday = $data->bmonth .'-'. $data->bday. '-'. $data->byear;
				
			foreach ($data as $k => $v) {

				if (array_key_exists($k,$keys)) {

					$prim = $keys[$k];
					$arr[$prim]['key_id'] = $prim;
					$prim = $keys[$k];
					if ($k == 'email') { //insert email as username
						if (strlen($v)>0) {
							$uname = $v;
						}else{
							$uname = $data->first_name.'.'.$data->last_name;
						}
						DB::table('adarp_users')->insert(array('username'=>$uname));
					}
				}else{
					continue;
				}


				$arr[$prim]['user_id'] = $user_id;
				$arr[$prim]['value'] = $v;

			}

			// Add Bday 
			$arr['67']['key_id'] = '67';
			$arr['67']['user_id'] = $user_id;
			$arr['67']['value'] = $bday;

			unset($arr[9999]); //remove byear
			unset($arr[9998]); //remove bday
			unset($arr[9997]); //remove bmonth
		//}

		/*echo '<pre>';
		print_r($arr);
		echo '</pre>';
		*/


		$data = DB::connection('alumni_registry')
		->table('profile')
		->where('id',$data->id)
		->update(array('imported'=>1));

		return DB::table('adarp_profile_keys')->insert($arr);
	}
}

?>