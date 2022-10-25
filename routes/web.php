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
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//Route::group(['middleware' => ['auth']], function() {
//    /**
//     * Logout Route
//     */
//    Route::get('/logouts', 'LogoutController@perform')->name('logout.perform');
//});

Route::get('redirects','App\Http\Controllers\HomeController@index');
Route::get('logouts','App\Http\Controllers\LogoutController@perform');
Route::get('registration','App\Http\Controllers\HomeController@register');
Route::post('addlp','App\Http\Controllers\HomeController@addlp');
Route::get('deletelp/{car_id}','App\Http\Controllers\HomeController@deletelp');
Route::get('monitor','App\Http\Controllers\MonitorController@index');
Route::get('report','App\Http\Controllers\ReportController@index');
Route::post('dateprocess','App\Http\Controllers\ReportController@dateprocess');
Route::post('printpdf/{report_records}','App\Http\Controllers\ReportController@printpdf');
Route::get('announcement-admin','App\Http\Controllers\AnnouncementController@index');
Route::post('publish-news','App\Http\Controllers\AnnouncementController@addnews');






