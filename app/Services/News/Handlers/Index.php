<?php

namespace App\Services\News\Handlers;

use App\DTO\News\NewsDTO;
use App\Models\News;
use App\Services\CaseHandler;

class Index implements CaseHandler
{
    public function __construct(private NewsDTO $newsDTO)
    {
    }

    public function handle()
    {
        if ($this->newsDTO->amount) {
            return News::query()->orderBy('created_at', 'desc')->take($this->newsDTO->amount)->get();
        }

        return News::query()->paginate($this->newsDTO->per_page);
    }
}
