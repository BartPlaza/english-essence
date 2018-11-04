<?php

namespace App\Scoping;

use Illuminate\Database\Eloquent\Builder;

class Scoper
{
    private $request;
    private $builder;

    public function __construct(Builder $builder)
    {
        $this->request = request();
        $this->builder = $builder;
    }

    public function apply(array $scopes): Builder
    {
        foreach ($this->limitScopes($scopes) as $key => $scope) {
            if($scope instanceof Scope){
                $scope->apply($this->builder, $this->request->get($key));
            }
        }
        return $this->builder;
    }

    private function limitScopes(array $scopes): array
    {
        return array_only(
            $scopes,
            array_keys($this->request->all())
        );
    }
}