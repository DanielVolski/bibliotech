<?php

namespace App\Http\Filters;

use App\Models\User;

class UserQueryFilter extends AbstractQueryFilter {
    private const MAX_PER_PAGE = 20;

    public function __construct() {
        parent::__construct(User::query());

        $this->functionMapping = [
            'perPage' => 'perPage',
            'offset' => 'offset',
            'orderBy' => 'orderBy'
        ];
    }

    protected function perPage(int $perPage) {
        $this->query->limit(min($perPage, static::MAX_PER_PAGE));
    }

    protected function offset(int $offset) {
        $this->query->offset($offset);
    }

    protected function orderBy(string $orderBy) {
        $this->query->orderBy($orderBy);
    }
}