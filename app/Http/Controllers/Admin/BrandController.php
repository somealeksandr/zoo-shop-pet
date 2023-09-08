<?php

namespace App\Http\Controllers\Admin;

use App\Jarboe\Fields\Image;
use App\Models\Brand;
use Yaro\Jarboe\Table\Fields\Text;
use Yaro\Jarboe\Table\Filters\TextFilter;

class BrandController extends AbstractAdminTableController
{
    protected function init()
    {
        $this->setModel(Brand::class);
        $this->locales(config('localized-routes.supported-locales'));

        $this->addColumns([
            'id',
            'title',
            'image',
            'slug',
        ]);

        $this->addTab('General', [
            Text::make('title')->translatable()->filter(TextFilter::make()),
            Text::make('description')->translatable(),
            Image::make('image')->disk('brands')->path('image'),
            Text::make('slug')->filter(TextFilter::make()),
        ]);
    }
}
