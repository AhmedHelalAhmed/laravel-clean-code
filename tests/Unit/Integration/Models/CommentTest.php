<?php

namespace Tests\Unit\Integration\Models;

use App\Models\Comment;
use Tests\TestCase;

class CommentTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();

    }

    // setup
    /** @test */
    public function it_should_render_approved_comments_only()
    {

        factory(Comment::class, 3)->create();

        factory(Comment::class, 4)->state('approved')->create();

        $comment = new Comment;

        $this->assertCount(4, $comment->approved()->get());

    }
    // teardown

    //setup
    /** @test */
    public function it_should_render_disapproved_comments_only()
    {

        factory(Comment::class, 3)->create();

        factory(Comment::class, 4)->state('approved')->create();

        $comment = new Comment;

        //$this->assertCount(3, $comment->approved(false)->get());

        $this->assertCount(3, $comment->disapproved()->get());

        //$this->assertCount(3, $comment->disapproved()->recentlyCreated()->get());

    }
    //teardown
}
