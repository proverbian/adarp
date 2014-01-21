<?php

class Usermeta extends Eloquent {
	protected $table = 'adarp_usermeta';
	protected $fillable = array('key_id','user_id','value'); //important (Adarp Controller)
	protected $primaryKey = 'user_id';
		
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

	public function address()
	{
		return $this->BelongsTo('Users','user_id')->take(10)->select('id');
	}

		public function profile()
	{
		return $this->BelongsTo('Profile','user_id')->select('first_name','last_name','address');
	}

	public function getVal($val)
	{
		$nat = DB::select(DB::RAW("select count(id) as cnt,value from adarp_usermeta where `key_id` = '".$val."' and value != '' group by value order by cnt desc limit 10"));
		return $nat;		
	}

}

?>