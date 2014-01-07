<?php

class Usermeta extends Eloquent {
	protected $table = 'adarp_usermeta';
	protected $fillable = array('key_id','user_id','value'); //important (Adarp Controller)
		
	public static function get($val) {
		$user =  Usermeta::where('user_id',Auth::user()->id)
				->where('key_id',$val)
				->select('value')
				->get();
		foreach ($user as $data) {
			$all[$data->key_id] = $data->value;
		}

		return $all;
	}

	public function test() {
		return 'we';
	}
}

?>