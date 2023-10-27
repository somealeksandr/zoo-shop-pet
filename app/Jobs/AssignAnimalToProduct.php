<?php

namespace App\Jobs;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AssignAnimalToProduct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private Product $product, private ?int $categoryId)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $animal = $this->product->category?->first()->animal ?? null;

        if (!$animal) {
            $animal = Category::find($this->categoryId)->animal;
        }

        $this->product->animal()->sync($animal->id);
    }
}
