<?php

class Posts extends Eloquent {
	protected $table = 'adarp_posts';
	protected $fillable = array('testing');

public static function testing() {
	return 'we';
}

}



?>