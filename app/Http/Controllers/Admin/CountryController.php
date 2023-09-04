<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use Yaro\Jarboe\Table\Fields\Text;
use Yaro\Jarboe\Table\Filters\TextFilter;

class CountryController extends AbstractAdminTableController
{

    protected function init()
    {
        $this->setModel(Country::class);
        $this->locales(config('localized-routes.supported-locales'));

        $this->addColumns([
            'id',
            'title',
            'slug',
            'code',
        ]);

        $this->addTab('General', [
            Text::make('title')->translatable()->filter(TextFilter::make()),
            Text::make('slug')->filter(TextFilter::make()),
            Text::make('code')->filter(TextFilter::make()),
        ]);
    }
}
