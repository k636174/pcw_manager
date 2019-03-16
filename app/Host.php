<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Host extends Model
{
    //
    public function groups(){
        return $this->belongsToMany('App\Group');
    }

    public function host_ips(){
        return $this->hasOne('App\HostIp');
    }

    public function host_status(){
        return $this->hasOne('App\HostStatus');
    }
}
