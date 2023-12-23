<?php

namespace App\Http\Controllers\Api\News;

use App\DTO\News\NewsDTO;
use App\Http\Controllers\AbstractApiController;
use App\Http\Requests\Api\News\NewsRequest;
use App\Models\News;
use App\Models\NewsCategory;
use App\Services\News\NewsService;
use Illuminate\Http\JsonResponse;

class NewsController extends AbstractApiController
{
    public function __construct(private NewsService $service)
    {
    }

    public function categories(): JsonResponse
    {
        $categories = NewsCategory::all();

        return $this->success($categories, 'News categories list.');
    }

    public function index(NewsRequest $request): JsonResponse
    {
        $news = $this->service->index(NewsDTO::fromArray($request->validated()));

        return $this->success($news, 'News list.');
    }

    public function show($slug): JsonResponse
    {
        $news = News::whereSlug($slug)->first();

        return $this->success($news, 'Single news.');
    }
}
