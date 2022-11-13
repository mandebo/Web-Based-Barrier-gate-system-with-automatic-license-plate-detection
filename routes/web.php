<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('dashboard','App\Http\Controllers\HomeController@dash');
//    Route::get('/dashboard', function () {
//        return view('dashboard');
//    })->name('dashboard');
});

//Route::group(['middleware' => ['auth']], function() {
//    /**
//     * Logout Route
//     */
//    Route::get('/logouts', 'LogoutController@perform')->name('logout.perform');
//});

//Registration routes
Route::get('redirects','App\Http\Controllers\HomeController@index');
Route::get('logouts','App\Http\Controllers\LogoutController@perform');
Route::get('registration','App\Http\Controllers\HomeController@register');
Route::post('addlp','App\Http\Controllers\HomeController@addlp');
Route::post('deletelp/{car_id}','App\Http\Controllers\HomeController@deletelp');
Route::post('editlp/{car_id}','App\Http\Controllers\HomeController@editlp');
Route::post('fetchedit/{user_id}/{car_id}','App\Http\Controllers\HomeController@fetchedit');
Route::get('deletefetch/{car_id}','App\Http\Controllers\HomeController@deletefetch');




//Monitor routes
Route::get('monitor','App\Http\Controllers\MonitorController@index');

//Access report routes
Route::get('report','App\Http\Controllers\ReportController@index');
Route::post('dateprocess','App\Http\Controllers\ReportController@dateprocess');
Route::post('printpdf/{bg_id}','App\Http\Controllers\ReportController@printpdf');

//Announcement routes
Route::get('announcement-admin','App\Http\Controllers\AnnouncementController@index');
Route::post('publish-news','App\Http\Controllers\AnnouncementController@addnews');
Route::get('res_announcement','App\Http\Controllers\AnnouncementController@res_index');
Route::get('view_announcement/{announcement_id}','App\Http\Controllers\AnnouncementController@view_announcement');
Route::get('admin_view/{announcement_id}','App\Http\Controllers\AnnouncementController@adminview');

Route::get('edit_announcement/{announcement_id}','App\Http\Controllers\AnnouncementController@edit_announcement');
Route::post('save_annedit/{announcement_id}','App\Http\Controllers\AnnouncementController@save_news');
Route::post('anndelete/{announcement_id}','App\Http\Controllers\AnnouncementController@deleteann');
Route::get('anndeletefetch/{announcement_id}','App\Http\Controllers\AnnouncementController@deleteannfetch');
Route::get('archive','App\Http\Controllers\AnnouncementController@archive');


//history

Route::get('history','App\Http\Controllers\HistoryController@index');
Route::post('gethistory','App\Http\Controllers\HistoryController@gethistory');

//Resident info

Route::get('resident-info','App\Http\Controllers\UserInfo@index');
Route::get('resident-detail/{id}','App\Http\Controllers\UserInfo@profile');
Route::get('resident-profile','App\Http\Controllers\UserInfo@details');
Route::get('resident-find/{lp}','App\Http\Controllers\UserInfo@find');












