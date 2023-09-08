<?php

namespace App\Http\Controllers\Admin;

use App\Models\CategoryAnimal;
use App\Models\SubcategoryAnimal;
use Yaro\Jarboe\Table\Fields\Select;
use Yaro\Jarboe\Table\Fields\Text;
use Yaro\Jarboe\Table\Fields\Textarea;
use Yaro\Jarboe\Table\Filters\TextFilter;
use App\Jarboe\Fields\Image;

class SubcategoryAnimalController extends AbstractAdminTableController
{

    protected function init()
    {
        $this->setModel(SubcategoryAnimal::class);
        $this->locales(config('localized-routes.supported-locales'));

        $this->addColumns([
            'id',
            'title',
            'description',
            'slug',
            'category_animal_id',
        ]);

        $this->addTab('General', [
            Text::make('title')->translatable()->filter(TextFilter::make()),
            Textarea::make('description')->translatable()->filter(TextFilter::make()),
            Text::make('slug')->filter(TextFilter::make()),
            Select::make('category_animal_id', 'Category Animal')->relation('categoryAnimal', 'title')->default(request('category_animal_id'))->type(Select::SELECT_2)->col(6),
        ]);
    }
}
