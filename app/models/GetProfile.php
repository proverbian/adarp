<?php

class GetProfile extends Eloquent {
	protected $table = 'Adarp_profile';
	protected $fillable = 'value';
	  
	  
	   public function we() {
        return array('m'=>'Male','f'=>'Female');
    }



   
}

?>