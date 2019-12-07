<?php

namespace App\Http\Controllers;

use App\Events\UserWasRegistered;
use App\Http\Requests\UserRegisterFormRequest;
//use App\Mail\ActivationSent;
use App\Models\User;
use Illuminate\Support\Str;
use Mail;
/*
 * single method controller invokable
 */

class UserRegisterController extends Controller
{

    private $user;

    // toy can enhance that with user repository

    public function __construct(User $user)
    {
        $this->user = $user;

    }

    public function __invoke(UserRegisterFormRequest $request)
    {
        $user = $this->user->create(
            array_merge($request->validated(), [
                'password' => bcrypt($request->password)
            ])
        );


        // $token=str_random(32);
        $token=Str::random(32);

        // send email
        // fire event => queue email


//        Mail::to($user)->send(new ActivationSent($user,$token));// directly make the email and put it in queue
        // to enhance the previous

        event(new UserWasRegistered($user,$token));// here we make event to make email work

        return response(null,201);


    }
}
