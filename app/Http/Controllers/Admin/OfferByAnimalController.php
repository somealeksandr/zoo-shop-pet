<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Models\OfferByAnimal;
use Yaro\Jarboe\Table\Fields\Datetime;
use Yaro\Jarboe\Table\Fields\Select;
use Yaro\Jarboe\Table\Fields\Text;
use Yaro\Jarboe\Table\Fields\Wysiwyg;
use Yaro\Jarboe\Table\Filters\DateFilter;
use Yaro\Jarboe\Table\Filters\TextFilter;
use App\Jarboe\Fields\Image;

class OfferByAnimalController extends AbstractAdminTableController
{
    protected function init()
    {
        $this->setModel(OfferByAnimal::class);
        $this->locales(config('localized-routes.supported-locales'));

        $this->addColumns([
            'id',
            'offer_text',
            'offer_type',
            'image',
            'animal_id',
        ]);

        $this->addTab('General', [
            Wysiwyg::make('offer_text',)->translatable(),
            Text::make('offer_type')->translatable()->filter(TextFilter::make()),
            Image::make('image')->disk('offer-by-animals')->path('image'),

            Select::make('animal_id', 'Animal')
                ->relation('animal', 'title')
                ->default(request('animal_id'))
                ->type(Select::SELECT_2)
                ->col(6),
        ]);
    }
}
