<?php

namespace App\Http\Controllers\Admin;

use App\Models\GeneralSetting;
use Yaro\Jarboe\Table\Fields\Number;
use Yaro\Jarboe\Table\Filters\NumberFilter;

class GeneralSettingsController extends AbstractAdminTableController
{

    protected function init()
    {
        $this->setModel(GeneralSetting::class);
        $this->locales(config('localized-routes.supported-locales'));

        $this->addColumns([
            'id',
            'days_product_is_new',
        ]);

        $this->addTab('General', [
            Number::make('days_product_is_new', 'Днів товар залишатиметься новим')->filter(NumberFilter::make()),
        ]);
    }
}
