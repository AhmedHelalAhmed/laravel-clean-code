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

// O in S.O.L.I.D principles
// Open/Closed principle
// this not closed for modification=> if we need to add new service
// if we need to add new service => this not closed for modification
Route::get('/messaging/{service}', function ($service) {
    if ($service == 'nexmo') {
        // process
        dd('nexmo');
    } elseif ($service == 'twilio') {
        // process
        dd('twilio');
    } elseif ($service == 'messagebird') {
        dd('messagebird');
    }
});