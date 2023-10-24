<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Yaro\Jarboe\Table\Fields\Checkbox;
use Yaro\Jarboe\Table\Fields\Number;
use Yaro\Jarboe\Table\Fields\Select;
use Yaro\Jarboe\Table\Fields\Text;
use Yaro\Jarboe\Table\Fields\Textarea;
use Yaro\Jarboe\Table\Filters\CheckboxFilter;
use Yaro\Jarboe\Table\Filters\NumberFilter;
use Yaro\Jarboe\Table\Filters\TextFilter;
use App\Jarboe\Fields\Image;

class ProductController extends AbstractAdminTableController
{

    protected function init()
    {
        $this->setModel(Product::class);
        $this->locales(config('localized-routes.supported-locales'));

        $this->addColumns([
            'id',
            'title',
            'image',
            'slug',
            'price',
            'quantity',
            'promotional_price',
            'is_promotional',
            'quantity',
            'country_id',
            'brand_id',
        ]);

        $this->addTab('General', [
            Text::make('title')->translatable()->filter(TextFilter::make()),
            Textarea::make('description')->translatable(),
            Image::make('image')->disk('products')->path('image'),
            Text::make('slug')->filter(TextFilter::make()),
            Number::make('price')->filter(NumberFilter::make()),
            Text::make('quantity')->filter(TextFilter::make()),
            Number::make('promotional_price')->filter(TextFilter::make()),
            Checkbox::make('is_promotional')->filter(CheckboxFilter::make()),
            Select::make('country_id', 'Country')->relation('country', 'title')->default(request('country_id'))->type(Select::SELECT_2)->col(6),
            Select::make('brand_id', 'Brand')->relation('brand', 'title')->default(request('brand_id'))->type(Select::SELECT_2)->col(6),

            Select::make('subcategory_id', 'Subcategory')
                  ->relation('subcategory', 'title_option')
                  ->default(request('subcategory_id'))
                  ->type(Select::SELECT_2)
                  ->nullable()
                  ->col(6),

            Select::make('category_id', 'Category')
                ->relation('category', 'title_option')
                ->default(request('category_id'))
                ->type(Select::SELECT_2)
                ->nullable()
                ->col(6),
        ]);
    }
}
