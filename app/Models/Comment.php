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
    ];

    protected $dates = [
        'approved_at',
    ];

}
