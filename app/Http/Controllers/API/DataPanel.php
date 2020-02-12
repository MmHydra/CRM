<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Accounts;
use App\Owners;
use App\BusinessManager;

class DataPanel extends Controller
{
    public function index()
		 {
		 	  	$array_Data_Accounts = array();
		 	  	
		 		
		 		 $Data_Accounts = Accounts::all()->load('owners')->load('BusinessManager');
		 		
		 		
		 		 $Data_Owners = Owners::all();

		 		 

		 		 return view('API.Accounts')->with(['Data_Owners' => $Data_Owners,
		 											'array_Data_Accounts' => $Data_Accounts]);
		 																		

		 }
	Public function getADSs(request $request)
		 {	
		 	//$test = ['Andrey1', 'Andrey2', 'Andrey3'];
		 	//$request->acc_name

		 	$responce = Accounts::whereIn('account_name', $request->acc_name)->with(['BusinessManager' => function($q) {
														    $q->select(['acc_name', 'acc_id','id']);
															},'BusinessManager.ACT' => function($q) {$q->select('act_id', 'bm_id'); }])->get();
		 	
			return response()->json($responce);

		 }
}
