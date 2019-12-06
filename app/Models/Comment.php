<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = [
        'body',
        'approved_at',
    ];

    protected $dates = [
        'approved_at',
    ];

    /*
    public function scopeApproved(Builder $builder, $approved = true)
    {
    if (!$approved) {
    return $builder->whereNull('approved_at');
    }
    return $builder->whereNotNull('approved_at');
    }
     */
    public function scopeApproved(Builder $builder)
    {

        return $builder->whereNotNull('approved_at');
    }

    public function scopeDisapproved(Builder $builder)
    {
        return $builder->whereNull('approved_at');

    }

    public function scopeRecentlyCreated(Builder $builder)
    {
        return $builder->latest();

    }
}
