<?php

use App\Logging\Logger;
use App\Logging\LoggerInterface;
use App\MessagingTwoWays\AdHoc\MessagingService as AdHoc;
use App\MessagingTwoWays\Strategy\Messaging;
use App\MessagingTwoWays\Strategy\MessagingService as Strategy;
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

Route::get('/logging/{type}', function ($type) {

    $type = sprintf("App\\Logging\\%sLogger", ucfirst($type));

    if (is_a($type, LoggerInterface::class, true)) {

        $logger = new Logger(new $type);

        $logger->log();
    }

    throw new Exception("Invalid logging");

});

Route::get('/adhoc/{service}', function ($service) {

    $service = sprintf("App\\MessagingTwoWays\\AdHoc\\%sService", ucfirst($service));

    if (is_a($service, AdHoc::class, true)) {

        $service = new $service;

        $service->send();

    }

    throw new Exception("Invalid service");

});

Route::get('/strategy/{service}', function ($service) {

    $service = sprintf("App\\MessagingTwoWays\\Strategy\\%sService", ucfirst($service));

    if (is_a($service, Strategy::class, true)) {

        $service = new Messaging(new $service);

        $service->send();
    }

    throw new Exception("Invalid service");

});
