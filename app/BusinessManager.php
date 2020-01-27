<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessManager extends Model
{
    protected $table = 'BusinessManager';

      public function ACT()
    {
       return $this->hasMany('App\ACT', 'bm_id');
        
    }
}
