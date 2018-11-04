<?php

namespace App\Scoping;


use Illuminate\Database\Eloquent\Builder;

class BodyScope implements Scope
{
    public function apply(Builder $builder, $value)
    {
        //return $builder;
        return $builder->where('body', 'like', '%' . $value . '%');
    }
}