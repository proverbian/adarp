<?php

class Homecoming extends Eloquent {
	
	protected $table = 'adarp_homecoming';
	protected $fillable = array('_token','fname','mname','id','user_id');
	protected $primaryKey = 'user_id';

	public function profile () {
		return $this->HasOne('Profile','user_id')->select('user_id');
	}

	public function search_value($val)
	{
		return $this->BelongsTo('Users')->take(10);
	}


}

?>