<?php

namespace App\Model\Helper;

use Resta\Support\Str;
use Illuminate\Database\Eloquent\Builder;

trait Scope
{
    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeActive(Builder $builder)
    {
        return $builder->where('status',1);
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopePagination($query)
    {
        return $query
            ->paginate(static::paginationForRequest())
            ->withPath(Str::removeCharacterFromUri('page'))
            ->toArray();
    }

    /**
     * This is the method that allows the user to request pagination.
     *
     * @return mixed|null
     */
    public static function paginationForRequest()
    {
        return (is_numeric($limit = get('limit')) && $limit<100 )
            ? $limit : config('app.pagination');
    }
}
