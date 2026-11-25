<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

abstract class AbstractQueryFilter {
    protected array $functionMapping = [];

    public function __construct(
        protected Builder $query
    ) {}

    public function apply(array $filters): Builder {
        foreach ($filters as $filterName => $filterValue) {
            if (isset($this->functionMapping[$filterName])) {
                $funcName = $this->functionMapping[$filterName];
                $this->$funcName($filterValue);
            }
        }

        return $this->query;
    }
}