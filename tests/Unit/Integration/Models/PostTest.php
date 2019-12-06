<?php

namespace Tests\Unit\Integration\Models;

use App\Models\Post;
use Tests\TestCase;

class PostTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();

    }

    // setup
    /** @test */
    public function it_should_render_approved_posts_only()
    {

        factory(Post::class, 3)->create();

        factory(Post::class, 4)->state('approved')->create();

        $post = new Post;

        $this->assertCount(4, $post->approved()->get());

    }
    // teardown

    //setup
    /** @test */
    public function it_should_render_disapproved_posts_only()
    {

        factory(Post::class, 3)->create();

        factory(Post::class, 4)->state('approved')->create();

        $post = new Post;

        //$this->assertCount(3, $post->approved(false)->get());

        $this->assertCount(3, $post->disapproved()->get());

        //$this->assertCount(3, $post->disapproved()->recentlyCreated()->get());

    }
    //teardown
}
