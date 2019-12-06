<?php

namespace App\Models;

use App\Traits\FetchesApproved;
use Illuminate\Database\Eloquent\Model;

// model name be singular and table be plural
class Post extends Model
{
    use FetchesApproved;

    protected $fillable = [
        'title',
        'body',
        'approved_at',
        'user_id',
    ];

    protected $dates = [
        'approved_at',
    ];

}
