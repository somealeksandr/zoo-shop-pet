<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Yaro\Jarboe\Table\Fields\Select;
use Yaro\Jarboe\Table\Fields\Text;
use Yaro\Jarboe\Table\Fields\Textarea;
use Yaro\Jarboe\Table\Filters\TextFilter;

class CategoryController extends AbstractAdminTableController
{

    protected function init()
    {
        $this->setModel(Category::class);
        $this->locales(config('localized-routes.supported-locales'));

        $this->addColumns([
            'id',
            'title',
            'description',
            'slug',
            'animal_id',
        ]);

        $this->addTab('General', [
            Text::make('title')->translatable()->filter(TextFilter::make()),
            Textarea::make('description')->translatable()->filter(TextFilter::make()),
            Text::make('slug')->filter(TextFilter::make()),
            Select::make('animal_id', 'Animal')->relation('animal', 'title')->default(request('animal_id'))->type(Select::SELECT_2)->col(6)->nullable(),
        ]);
    }
}
