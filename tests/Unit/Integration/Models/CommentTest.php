<?php

namespace Tests\Unit\Integration\Models;

use App\Models\Comment;
use Tests\TestCase;

class CommentTest extends TestCase
{

    private $comment;

    public function setUp(): void
    {
        parent::setUp();

        factory(Comment::class, 3)->create();

        factory(Comment::class, 4)->state('approved')->create();

        $this->comment = new Comment;

    }

    /** @test */
    public function it_should_render_approved_comments_only()
    {
        $this->assertCount(4, $this->comment->approved()->get());

    }

    /** @test */
    public function it_should_render_disapproved_comments_only()
    {
        $this->assertCount(3, $this->comment->disapproved()->get());
    }
}
