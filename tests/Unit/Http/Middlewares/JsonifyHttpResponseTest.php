<?php

namespace Tests\Unit\Http\Middlewares;

use App\Http\Middleware\JsonifyHttpResponse;
use Tests\TestCase;

class JsonifyHttpResponseTest extends TestCase
{
    /** @test */
    public function it_should_return_a_response_jsonified()
    {

        // dd(request());//before

        $jsonifyHttpResponseResponse = new JsonifyHttpResponse;

        $jsonifyHttpResponseResponse->handle(request(), function ($response) {

            // dd($response);
            $this->assertEquals('application/json', $response->headers->get('accept'));
        }); //after

    }
}
