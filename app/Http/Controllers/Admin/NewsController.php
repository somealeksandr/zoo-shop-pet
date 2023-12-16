<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use Yaro\Jarboe\Table\Fields\Datetime;
use Yaro\Jarboe\Table\Fields\Select;
use Yaro\Jarboe\Table\Fields\Text;
use Yaro\Jarboe\Table\Fields\Wysiwyg;
use Yaro\Jarboe\Table\Filters\DateFilter;
use Yaro\Jarboe\Table\Filters\TextFilter;
use App\Jarboe\Fields\Image;

class NewsController extends AbstractAdminTableController
{
    protected function init()
    {
        $this->setModel(News::class);
        $this->locales(config('localized-routes.supported-locales'));

        $this->addColumns([
            'id',
            'title',
            'image',
            'slug',
            'published_at',
            'reading_time_minutes',
        ]);

        $this->addTab('General', [
            Text::make('title')->translatable()->filter(TextFilter::make()),
            Wysiwyg::make('short_description',)->translatable(),
            Wysiwyg::make('content')->translatable(),
            Image::make('image')->disk('news')->path('image'),
            Text::make('slug')->filter(TextFilter::make()),
            Datetime::make('published_at'),
            Text::make('reading_time_minutes')->filter(TextFilter::make()),

            Select::make('category_id', 'Category news')
                ->relation('category', 'title')
                ->default(request('category_id'))
                ->type(Select::SELECT_2)
                ->col(6),
        ]);
    }
}
