<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Users extends Eloquent implements UserInterface, RemindableInterface {
	protected $table = 'adarp_users';
	protected $fillable = array('id','user_id');
	
	public function usermeta () {
		return $this->HasMany('Usermeta','user_id');
	}
	
	public function profile () {
		return $this->HasOne('Profile','user_id');
	}

	public static function validate($all,$rules) 
	{
		return Validator::make($all,$rules);	
	}

	public  function getActiveUsers () 
	{	
		return Users::where('activated',1)->select('id')->count();
	}

	//Auth::
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}
	public function getAuthPassword()
	{
		return $this->password;
	}
	public function getReminderEmail()
	{
		return $this->email;
	}
	
}