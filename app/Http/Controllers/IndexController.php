<?php

namespace Illuminate\Support\Facades;
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
	  public function index()
		 {
		 	    //echo("Роут работает!!");    

		 	    return view('test.index');

		 }

		  public function posts(Request $request) 
		 {		
		 	   $email = $request->input('email');
		 	   $password = $request->input('password');

		 	 

		 	   DB::table('test')->insert(
		 	   	array(
		 	   			'mail'=>$email,
		 	   			'password'=>$password
		 	   		 )
		 	   );

		 	   $Select = DB::table('test')->find(1);
		 	   $arraySelect = (array)$Select;
		 	   return view('index-selectfromDB',['password'=> $arraySelect["password"],
		 									     'email'=> $arraySelect["mail"]]);
		 											  

		 }
		 	public function GETCONT()
		 	{	$htmlFile = 'main.txt';
		 		$main = file_get_contents('http://www.liftingtoskies.info/stojakkakymolodogo/');
		 		dd($main);
		 		Storage::put('main.txt', $main);
		 	}

		 	

}
?>

