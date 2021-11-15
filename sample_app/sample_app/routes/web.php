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

//急にRout::get does not exist.と出たので以下のメソッドを呼び出すことに
// use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/others', function(){
    return 'ここはothersです';
});

Route::get('/practice', 'SampleController@practice');

Route::get('/view_sample', function () {
    return view('sample');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/sample_action', 'SampleController@sample_action');

Route::get('/message_sample', 'SampleController@message_sample');

Route::get('/message_practice', 'SampleController@message_practice');

Route::get('/blade_example', 'SampleController@blade_example');

Route::get('/messages', 'MessagesContoller@index');

Route::post('/messages', 'MessagesContoller@create');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
