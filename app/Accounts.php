<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    protected $table = 'Accounts';

     public function owners()
    {
       return $this->belongsTo('App\Owners', 'acc_owner');
        
    }

    public function BusinessManager()
    {
       return $this->hasMany('App\BusinessManager', 'acc_id');
        
    }

    public function proxyes()
    {
       return $this->belongsTo('App\Proxy', 'acc_proxy_id');
        
    }
}

