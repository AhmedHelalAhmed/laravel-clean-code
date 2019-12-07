<?php

namespace App\Models;

use App\Traits\FetchesApproved;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    use FetchesApproved;

    protected $fillable = [

        'body',
        'approved_at',
        'user_id',
        'post_id'


    ];

    protected $dates = [

        'approved_at',

    ];


    public function user()
    {

        return $this->belongsTo(User::class);
    }


    public function post()
    {

        return $this->belongsTo(Post::class);

    }

}
