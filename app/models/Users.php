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
		return $this->HasOne('GetProfile','user_id');
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