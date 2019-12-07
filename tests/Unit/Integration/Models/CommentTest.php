<?php

namespace Tests\Unit\Integration\Models;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class CommentTest extends TestCase
{

    private $comment;

    public function setUp(): void
    {
        parent::setUp();

//        factory(Comment::class, 3)->create();
//
//        factory(Comment::class, 4)->state('approved')->create();
//
//        $this->comment = new Comment;

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

    /** @test */
    public function it_should_associate_the_post_and_the_user_with_the_comment()
    {

        $user = factory(User::class)->create();

        $post = factory(Post::class)->create();


        // this way to avoid fillable and use clearer association
        // $comment = new Comment;

        $data = [
            'body' => 'hello'
        ];

        // $comment = new Comment($data);


        $comment = Comment::make($data);// another way

        $comment->body = 'hello';

        $comment->user()->associate($user); //clear

        $post->comments()->save($comment); //clear

        dd($comment);


        /*

        dd(Comment::forceCreate([

            'body'=>'hello',
            'user_id'=>$user->id,
            'post_id'=>$post->id,

        ]));

        */

        /*
           Comment::create(array_merage($request->validated(),[
               'user_id'=>$user->id,
               'post_id'=>$post->id
           ]));
       */
    }
}
