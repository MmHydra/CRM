<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Test route

Route::get('/test', 'IndexController@index')->name('index');

Route::get('/test_view', function(){
	return view('test.index');
});

Route::post('/posts', 'IndexController@posts');

Route::get('/testBlade', function(){
	return view('BladeTestSecond');
});

Route::get('/getcontents', 'IndexController@GETCONT');



////////////////////////////////////////////////////////////////////////////


Route::group(['as' => 'API', 'namespace'=>'API'], function(){
	Route::get('/API', 'DataPanel@index');
	
	Route::post('/getADSs', 'DataPanel@getADSs');

	Route::resource('accounts', 'accountController');

    Route::get('/getAccountsFBtool', 'DataPanel@getAccountsFBtool');

});





