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
Route::get('/push',function (){
   return view('push');
});
Route::get('/send-push',function (){
   event(new eventTrigger());
});

Route::group(['namespace'=>'Index','middleware'=>'web'],function ()
{
    Route::get('logout',function (){
       Auth::logout();
       return redirect('/');
    });
    Route::get('login','AuthController@getLogin');
    Route::post('login','AuthController@postLogin');

});

Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>'admin'],function ()
{
    Route::get('/','AdminController@index');
    Route::resource('user','UserController');
    Route::resource('status','StatusController');
    Route::resource('type','TypeController');
    Route::resource('task','TaskController');
    Route::post('task/finish/{id}','TaskController@singleTaskFinish');
});

Route::group(['prefix'=>'developer','namespace'=>'Developer','middleware'=>'developer'],function ()
{
    Route::get('/','DeveloperController@index');
    Route::get('task','TaskController@getTasks');
    Route::get('task/{id}','TaskController@singleTask');
    Route::post('task/start/{id}','TaskController@singleStartTask');
    Route::post('task/stopped/{id}','TaskController@singleStoppedTask');

});