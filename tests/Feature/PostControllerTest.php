<?php

namespace Tests\Feature;

use App\Models\User;
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

    /** @test */
    public function it_should_create_the_post_with_user_id_associated_automatically_through_middleware()
    {
        $this->actingAs(factory(User::class)->create());
        $this->post('/api/posts', [
            'title' => 'hello',
            'body' => 'hello',
        ])->assertStatus(201);

        $this->assertDatabaseHas('posts', [
            'user_id' => auth()->id(),
            'title' => 'hello',
            'body' => 'hello',
        ]);

    }

}
