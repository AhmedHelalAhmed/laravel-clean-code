<?php

use App\Logging\Logger;
use App\Logging\LoggerInterface;
use App\MessagingContuxtualBinding\Contracts\MessagingService as MessagingInterface;
use App\MessagingContuxtualBinding\Messaging as MessagingStrategy;
use App\MessagingTwoWays\AdHoc\MessagingService as AdHoc;
use App\MessagingTwoWays\Strategy\Messaging;
use App\MessagingTwoWays\Strategy\MessagingService as Strategy;
use App\Messaging\MessagingService;

/*
best practise for routes
1- nouns =>'/products'
2- plural
3- Don't use GET/HEAD Headers for changing state
- GET: index data or show specific data
- POST: create/store
- PUT/PATCH: update
- DELETE : delete
4- in case of nested relations
- who is the parent: product
Route::get('/products/{product}/orders') //index orders for passed product
Route::get('/products/{product}/orders/{order}') // for show order
or
Route::get('/orders/{order}')
depend on if you want product or not
5- filters:(should be in query string)
Route::get('/proucts')
http://localhost:8000/products?limit=5;
in controller
$this->products->latest()->limit(request('limit')??-1)->get()
6- response code in restful api
200 => ok (and there is content)
201 => created or acceptes
204 => (no content)resource updated or delete and resource does not return content
404 => not found
422 => validation error
500 => internal server error
304 => redirection
7- naming: for example : name('products.index') or name('products.is_active')
- name('products.orders.create')
- name('products.orders.index')
- name('products.orders.delete')
8- controller name should be singular
9- to approve a post and disapprove =>PostApprovalController => store() & destroy()
10- Route::resources([
'products.orders'=>'ProductOrdersController',
'products'=>'ProductController',
'orders'=>'OrderController'

]);
//======================================================//
Interface naming conventional
(name + interface) ex => loggerInterface, workableInterface => not corrected make name very generic
class => singlie responsablilty => FileLogger => specific not generic
//======================================================//

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

// contuxtual binding in laravel
// interface bind different class (types)
// one class to make interchange between different class using IOC
Route::get('/contuxtual-binding/{service}', function ($service) {

    app()
        ->when(MessagingStrategy::class)
        ->needs(MessagingInterface::class)
        ->give(function () use ($service) {

            $service = sprintf("App\\MessagingContuxtualBinding\\%sService", ucfirst($service));

            return new $service;

        });

    app(MessagingStrategy::class)->send();

});

Route::resource('products.orders', 'ProductOrdersController');

// use scopes for clearer queries
Route::get('/posts', function () {

    // return Post::where('approved', true)->latest()->get();

    // instead of approved column extra just use approved_at
    return Post::whereNOTNull('approved_at', true)->latest()->get();

});

/*
repeated code
or
redirection based on some condition
then think in middleware
clear cache
set section
merge the request with something

- code it once and used it more -
where middleware

controller and route

 */

/*
Route::get('/profile', 'whatevercontroller')->middleware('auth');

Route::group(['prefix' => 'premium', 'middleware' => ['auth', 'subscribe']], function () {

// authorized user can view premium content
});
 */

/*
types of events:

1- user based action
ex: user registered then i need to send email to him (user was registered)

2- programmer based action do not related with user

where:
- in controller but we use services or responsable
since controller is http layer (take request and send response)
then we but events in services or responsable
- do not fire events in Repository as it work for collection (and insert record recently)
- job or event:
job is order or command not based on action happened
job work with single action
event => more than one listener(stateless after event before event do not care)

- when to think of queue and jobs
when hit email when you register
do not make user wait until the email feedback return
just put it in queue and make the user check the email not to wait the response
encode for file for example
anything may take long time push it to queue
 */
