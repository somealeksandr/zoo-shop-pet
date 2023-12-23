<?php

namespace App\Services\News\Handlers;

use App\DTO\News\NewsDTO;
use App\Models\News;
use App\Services\CaseHandler;
use Illuminate\Pagination\LengthAwarePaginator;

class Index implements CaseHandler
{
    public function __construct(private NewsDTO $newsDTO)
    {
    }

    public function handle(): LengthAwarePaginator
    {
        $query = News::query();

        if ($this->newsDTO->amount) {
            $query->orderBy('created_at', 'desc')->take($this->newsDTO->amount);
        }

        if (isset($this->newsDTO->categories)) {
            $query->whereIn('category_id', $this->newsDTO->categories);
        }

        return $query->paginate($this->newsDTO->per_page);
    }
}
