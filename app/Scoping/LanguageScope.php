<?php

namespace App\Scoping;


use Illuminate\Database\Eloquent\Builder;

class LanguageScope implements Scope
{
    public function apply(Builder $builder, $value): void
    {
        $builder->where('language', '=', $value);
    }
}