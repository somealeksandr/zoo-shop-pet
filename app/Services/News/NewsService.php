<?php

namespace App\Services\News;

use App\DTO\News\NewsDTO;
use App\Services\News\Handlers\Index;
use Illuminate\Pagination\LengthAwarePaginator;

class NewsService
{
    public function index(NewsDTO $newsDTO): LengthAwarePaginator
    {
        return (new Index($newsDTO))->handle();
    }
}
