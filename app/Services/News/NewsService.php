<?php

namespace App\Services\News;

use App\DTO\News\NewsDTO;
use App\Services\News\Handlers\Index;

class NewsService
{
    public function index(NewsDTO $newsDTO)
    {
        return (new Index($newsDTO))->handle();
    }
}
