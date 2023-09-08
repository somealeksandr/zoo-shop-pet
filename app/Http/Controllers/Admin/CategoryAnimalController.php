<?php

namespace App\Http\Controllers\Admin;

use App\Models\CategoryAnimal;
use Yaro\Jarboe\Table\Fields\Text;
use Yaro\Jarboe\Table\Fields\Textarea;
use Yaro\Jarboe\Table\Filters\TextFilter;
use App\Jarboe\Fields\Image;

class CategoryAnimalController extends AbstractAdminTableController
{

    protected function init()
    {
        $this->setModel(CategoryAnimal::class);
        $this->locales(config('localized-routes.supported-locales'));

        $this->addColumns([
            'id',
            'title',
            'description',
            'icon',
            'slug',
        ]);

        $this->addTab('General', [
            Text::make('title')->translatable()->filter(TextFilter::make()),
            Textarea::make('description')->translatable()->filter(TextFilter::make()),
            Text::make('slug')->filter(TextFilter::make()),
            Image::make('icon')->disk('category_animal')->path('icon'),
        ]);
    }
}
