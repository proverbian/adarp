<?php


class Reports extends Eloquent  {
	protected $table = 'adarp_homecoming';
	protected $fillable = array('id','user_id');

	public static function attendance($date)
	{	
		return Reports::where('created_at','like',$date.'%')->get();
	}

}