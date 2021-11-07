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
Route::get('/event', function () {
    return view('event.index');
});
Route::get('/event', 'App\Http\Controllers\EventController@index')->name('event.index');
Route::post('/event', 'App\Http\Controllers\EventController@add_event')->name('event.add');
Route::post('/ticket', 'App\Http\Controllers\EventController@add_ticket')->name('ticket.add');