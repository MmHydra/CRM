<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{

    protected $table = 'Accounts';
    protected $fillable = ['account_name', 'token_fb','updated_at'];
	public $timestamps = false;
    

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

    public static function getDataForSpend()
    {

         return Accounts::select('id', 'token_fb', 'updated_at', 'acc_proxy_id', 'user_agent')->with(['proxyes' => function($q) {$q->select(
             ['id', 'ip', 'port','login', 'password', 'proxy_type']);
             }])->where(['status_id' => '1', 'BillingInUse' => '1'])->get();
  
    }

    public static function updateDateSpend($validIDs, $updateDate)
    {   
        
            Accounts::whereIn('id', $validIDs)->update([
                            'updated_at' => $updateDate,
                            ]);
    }

    public static function updateStatus($IDs, $status){

            Accounts::whereIn('id', $IDs)->update([
                'status_id' => $status,
            ]);

    }
}




