<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {
	protected $table = 'adarp_users';
    
    protected $softDelete = true;
    protected $fillable = array('username','id', 'password','activation_code','token'); //set fields to activate here


    public function usermeta() 
    {
    	return $this->hasMany('Usermeta','user_id');
    }


	public  function verify($key) {
		//return $query->where('id','=','27276');
	}
		
	
	//take note : all these function below are required for UserInterFace and RemindableInterface	

		public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	

}

?>