<?php

use App\Messaging\MessagingService;

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
    // strategy design pattern and polymorphism
    // using => adhoc polymorphism

    $service = sprintf("App\\Messaging\\%sService", ucfirst($service));

    if (is_a($service, MessagingService::class, true)) {

        $service = new $service;

        $service->send();

    }

    throw new Exception("Invalid service");

});
