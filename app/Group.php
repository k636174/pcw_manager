<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    public function hosts(){
        return $this->belongsToMany('App\Host');
    }
}
