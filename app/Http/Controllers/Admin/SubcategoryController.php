<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subcategory;
use Yaro\Jarboe\Table\Fields\Select;
use Yaro\Jarboe\Table\Fields\Text;
use Yaro\Jarboe\Table\Fields\Textarea;
use Yaro\Jarboe\Table\Filters\TextFilter;

class SubcategoryController extends AbstractAdminTableController
{

    protected function init()
    {
        $this->setModel(Subcategory::class);
        $this->locales(config('localized-routes.supported-locales'));

        $this->addColumns([
            'id',
            'title',
            'description',
            'slug',
            'category_id',
        ]);

        $this->addTab('General', [
            Text::make('title')->translatable()->filter(TextFilter::make()),
            Textarea::make('description')->translatable()->filter(TextFilter::make()),
            Text::make('slug')->filter(TextFilter::make()),
            Select::make('category_id', 'Category')->relation('category', 'title')->default(request('category_id'))->type(Select::SELECT_2)->col(6),
        ]);
    }
}
