<?php

namespace App\Scoping;


use Illuminate\Database\Eloquent\Builder;

interface Scope
{
    public function apply(Builder $builder, $value);
}