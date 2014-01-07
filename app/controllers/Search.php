<?php 

class Search extends Adarp {

	public function getDkeys() {
		$keys = DB::table('adarp_keys')
		->select('id','name')
		->where('active',1)
		->where('parent','<>',0)
		->get();

		foreach ($keys as $key) {
			$arr_key[$key->id] = $key->name; 
		}

		return $arr_key;
	}

	public function search_form() {
		$arr_key = $this->getDkeys();
		return View::make('reports.search')
		->with('dkeys',$arr_key);
	}	

	public function search_me () {
			
		 $q = Input::get('query');
		
		// Y U NO WORK!
		/*$result = DB::table('adarp_usermeta')
		->whereIn('user_id', function($query) {
			$query->from('adarp_usermeta')
			->where('value','LIKE','%'.$w.'%')
			->select('user_id');
		})->select('user_id','value','key_id')
		->whereIn('key_id',array(46,47,48,4,5,6,65))
		//->take()
		->get();
		*/

		$selnames = Input::get('selnames');

		$keys = implode(',',$selnames);



		//$keys  = "46,47,48,4,5,6,65";
		$result = DB::select("select user_id,key_id,value from adarp_usermeta where user_id in (select user_id from adarp_usermeta where value like '%".$q."%') and key_id in ($keys)");
		foreach ($result as $res) {
			$arr[$res->user_id][] = $res;
		}

		//echo '<pre>';
		//print_r($arr);
		//echo '</pre>';
		//var_dump($query);
		//$arr[$keys];

		//dd($array);
		if ($result):
			$dkeys = $this->getDkeys();
			foreach ($selnames as $key) {
				$key_arr[$key] = $this->getKeyName($key); 
			}
			return View::make('reports.search')
			->with('result',$arr)
			->with('keys',$key_arr)
			->with('dkeys',$dkeys);
		else:
			$arr_key = $this->getDkeys();
			return View::make('reports.search')
			->with('test','No Record Found!')
			->with('dkeys',$arr_key);
		endif;
	}

	
}

?>