<?php

namespace App\Services\Product\Handlers;

use App\Models\Product;
use App\Services\CaseHandler;
use Illuminate\Support\Facades\Auth;

class ToggleFavorite implements CaseHandler
{
    public function __construct(private Product $product)
    {
    }

    public function handle(): void
    {
        $user = Auth::user();
        $user->favorites()->toggle($this->product->id);
    }
}
