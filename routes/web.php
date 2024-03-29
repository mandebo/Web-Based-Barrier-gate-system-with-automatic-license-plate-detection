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
    return view('auth.login');
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

//feedback route

Route::get('feedback','App\Http\Controllers\Feedback@index');
Route::post('add-feedback','App\Http\Controllers\Feedback@add');
Route::get('admin-feedback','App\Http\Controllers\Feedback@admin');
Route::get('adview/{id}/{user_id}','App\Http\Controllers\Feedback@adview');
Route::post('check/{id}','App\Http\Controllers\Feedback@check');
Route::post('respond/{id}','App\Http\Controllers\Feedback@respond');
Route::post('res-fb/{id}','App\Http\Controllers\Feedback@residentview');
Route::post('deletefb/{id}','App\Http\Controllers\Feedback@deletefb');
Route::get('pending','App\Http\Controllers\Feedback@pendpage');
Route::get('checking','App\Http\Controllers\Feedback@checkpage');
Route::get('fbdelete/{id}','App\Http\Controllers\Feedback@fbdelete');
Route::post('fbgone/{id}','App\Http\Controllers\Feedback@fbgone');



// Black list route
Route::get('blacklist','App\Http\Controllers\BlacklistController@index');
Route::post('addbl','App\Http\Controllers\BlacklistController@addbl');

//visitor

Route::get('visitor','App\Http\Controllers\VisitorController@index');
Route::post('addv','App\Http\Controllers\VisitorController@addv');



















