<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// model name be singular and table be plural
class Post extends Model
{
    protected $fillable = [
        'title',
        'body',
        'approved_at',
        'user_id',
    ];

    protected $dates = [
        'approved_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // camel case
    public function approvedComments()
    {
        return $this->hasMany(Comment::class)->whereNotNull('approved_at');
    }

}
