<?php

namespace Tests\Unit\Http\Middlewares;

use App\Http\Middleware\InjectUserIdIfAuthenticated;
use App\Models\User;
use Auth;
use Tests\TestCase;

class InjectUserIdIfAuthenticatedTest extends TestCase
{
    /** @test */
    public function it_shouldnt_have_the_user_id_within_request_if_not_authenticated()
    {

        Auth::shouldReceive('check')->once()->andReturn(false);

        $injectUserIdIfAuthenticated = new InjectUserIdIfAuthenticated;

        $injectUserIdIfAuthenticated->handle(request(), function ($response) {
            // dd($response);
            // dd($response->user_id);// null
            $this->assertNull($response->user_id);
        });

    }

    /** @test */
    public function it_should_have_user_id_within_request_if_authenticated()
    {
        $user = factory(User::class)->make([
            'id' => 1,
        ]);

        // dd($user);

        Auth::shouldReceive('check')
            ->once()
            ->andReturn(true)
            ->shouldReceive('id')
            ->once()
            ->andReturn($user->id); // mock authentication

        $injectUserIdIfAuthenticated = new InjectUserIdIfAuthenticated;

        $injectUserIdIfAuthenticated->handle(request(), function ($response) use ($user) {
            $this->assertEquals($response->user_id, $user->id);
        });

    }

}
