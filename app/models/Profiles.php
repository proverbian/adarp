<?php
 
class Profiles extends Eloquent {
 
    public function user()
    {
        return $this->belongsTo('User');
    }
}

?>