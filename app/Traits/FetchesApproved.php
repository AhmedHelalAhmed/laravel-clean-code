<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * to prevent repetition of the code
 * do not repeat the code separate it and you can use it whenever you like
 * traits is the idea
 */
trait FetchesApproved
{
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
