<?php

namespace Tests\Feature;

use Tests\TestCase;

class PostControllerTest extends TestCase
{

    /** @test */
    public function it_should_return_a_redirection_if_validation_fails()
    {
        $this->post('/api/posts', [
            'title' => 'hello',
        ])->assertStatus(422)->assertJsonValidationErrors([
            'body',
        ]);

    }

}
