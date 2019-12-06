<?php

namespace Tests\Unit\Integration\Models;

use App\Models\Post;
use Tests\TestCase;

class PostTest extends TestCase
{
    private $post;

    public function setUp(): void
    {
        parent::setUp();

        factory(Post::class, 3)->create();

        factory(Post::class, 4)->state('approved')->create();

        $this->post = new Post;

    }

    /** @test */
    public function it_should_render_approved_posts_only()
    {

        $this->assertCount(4, $this->post->approved()->get());

    }

    /** @test */
    public function it_should_render_disapproved_posts_only()
    {
        $this->assertCount(3, $this->post->disapproved()->get());

    }
}
