<?php

namespace App\Http\Controllers\Admin;

use App\Models\NewsCategory;
use Yaro\Jarboe\Table\Fields\Text;
use Yaro\Jarboe\Table\Fields\Textarea;
use Yaro\Jarboe\Table\Filters\TextFilter;

class CategoryNewsController extends AbstractAdminTableController
{
    protected function init()
    {
        $this->setModel(NewsCategory::class);
        $this->locales(config('localized-routes.supported-locales'));

        $this->addColumns([
            'id',
            'title',
        ]);

        $this->addTab('General', [
            Text::make('title')->translatable()->filter(TextFilter::make()),
            Textarea::make('description')->translatable(),
        ]);
    }
}
