<?php

namespace App\Services\Product\Handlers\Internal;

use App\Services\CaseHandler;

class Sort implements CaseHandler
{
    public function __construct(protected $dto, protected $productsQuery)
    {
    }

    public function handle()
    {
        $sortOptions = [
            'cheap'     => ['price', 'asc'],
            'expensive' => ['price', 'desc'],
            'new'       => ['created_at', 'desc'],
            'old'       => ['created_at', 'asc'],
        ];

        if (isset($this->dto->sort) && isset($sortOptions[$this->dto->sort])) {
            [$column, $direction] = $sortOptions[$this->dto->sort];
            $this->productsQuery->orderBy($column, $direction);
        }

        return $this->productsQuery;
    }
}
