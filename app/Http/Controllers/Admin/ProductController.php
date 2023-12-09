<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\AssignAnimalToProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Yaro\Jarboe\Exceptions\PermissionDenied;
use Yaro\Jarboe\Table\Fields\AbstractField;
use Yaro\Jarboe\Table\Fields\Checkbox;
use Yaro\Jarboe\Table\Fields\Number;
use Yaro\Jarboe\Table\Fields\Select;
use Yaro\Jarboe\Table\Fields\Text;
use Yaro\Jarboe\Table\Fields\Textarea;
use Yaro\Jarboe\Table\Filters\CheckboxFilter;
use Yaro\Jarboe\Table\Filters\NumberFilter;
use Yaro\Jarboe\Table\Filters\SelectFilter;
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
            'slug',
            'price',
//            'quantity',
//            'promotional_price',
            'is_promotional',
            'category_id',
            'subcategory_id',
            'country_id',
            'brand_id',
        ]);

        $this->addTab('General', [
            Text::make('title')->translatable()->filter(TextFilter::make()),
            Textarea::make('short_description')->translatable(),
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
                  ->col(6)
                  ->filter(SelectFilter::make()),

            Select::make('category_id', 'Category')
                ->relation('category', 'title_option')
                ->default(request('category_id'))
                ->type(Select::SELECT_2)
                ->col(6)
                ->filter(SelectFilter::make()),
        ]);
    }

    public function handleStore(Request $request)
    {
        $this->beforeInit();
        $this->init();
        $this->bound();

        if (!$this->crud()->actions()->isAllowed('create')) {
            throw new PermissionDenied();
        }

        if (!$this->can('store')) {
            throw UnauthorizedException::forPermissions(['store']);
        }

        $fields = $this->crud()->getFieldsWithoutMarkup();

        $inputs = [];
        /** @var AbstractField $field */
        foreach ($fields as $field) {
            if ($field->belongsToArray()) {
                $inputs += [$field->name() => $request->input($field->getDotPatternName())];
            }
        }
        $request->replace(
            $request->all() + $inputs
        );


        $data = [];
        $additional = [];
        /** @var AbstractField $field */
        foreach ($fields as $field) {
            if ($field->hidden('create') || $field->shouldSkip($request)) {
                continue;
            }

            if ($field->belongsToArray()) {
                $additional[$field->getAncestorName()][$field->getDescendantName()] = $field->value($request);
                continue;
            }

            $data += [$field->name() => $field->value($request)];
        }

        $data = $data + $additional;

        $model = $this->crud()->repo()->store($data);

        dispatch_sync(new AssignAnimalToProduct($model, $data['category_id']));

        /** @var AbstractField $field */
        foreach ($fields as $field) {
            $field->afterStore($model, $request);
        }

        $this->idEntity = $model->getKey();

        return redirect($this->crud()->listUrl());
    }

    public function handleUpdate(Request $request, $id)
    {
        $this->beforeInit();
        $this->init();
        $this->bound();

        if (!$this->can('update')) {
            throw UnauthorizedException::forPermissions(['update']);
        }

        $model = $this->crud()->repo()->find($id);
        if (!$this->crud()->actions()->isAllowed('edit', $model)) {
            throw new PermissionDenied();
        }

        $fields = $this->crud()->getFieldsWithoutMarkup();

        $inputs = [];
        /** @var AbstractField $field */
        foreach ($fields as $field) {
            if ($field->belongsToArray()) {
                $inputs += [$field->name() => $request->input($field->getDotPatternName())];
            }
        }
        $request->replace(
            $request->all() + $inputs
        );

        $data = [];
        $additional = [];
        /** @var AbstractField $field */
        foreach ($fields as $field) {
            if ($field->hidden('edit') || $field->isReadonly() || $field->shouldSkip($request)) {
                continue;
            }

            $field->beforeUpdate($model);

            if ($field->belongsToArray()) {
                $additional[$field->getAncestorName()][$field->getDescendantName()] = $field->value($request);
                continue;
            }

            $data += [$field->name() => $field->value($request)];
        }

        $data = $data + $additional;

        $model = $this->crud()->repo()->update($id, $data);

        dispatch_sync(new AssignAnimalToProduct($model, $data['category_id']));

        /** @var AbstractField $field */
        foreach ($fields as $field) {
            $field->afterUpdate($model, $request);
        }
        $this->idEntity = $model->getKey();

        return redirect($this->crud()->listUrl());
    }

    public function handleDelete($request, $id)
    {
        $this->beforeInit();
        $this->init();
        $this->bound();

        $model = $this->crud()->repo()->find($id);

        $model->category()->detach();
        $model->subcategory()->detach();
        $model->animal()->detach();

        if (!$this->crud()->actions()->isAllowed('delete', $model)) {
            throw new PermissionDenied();
        }

        if (!$this->can('delete')) {
            throw UnauthorizedException::forPermissions(['delete']);
        }

        $this->idEntity = $model->getKey();

        if ($this->crud()->repo()->delete($id)) {
            $type = 'hidden';
            try {
                $this->crud()->repo()->find($id);
            } catch (\Exception $e) {
                $type = 'removed';
            }

            return response()->json([
                'type' => $type,
                'message' => __('jarboe::common.list.delete_success_message', ['id' => $id]),
            ]);
        }

        return response()->json([
            'message' => __('jarboe::common.list.delete_failed_message', ['id' => $id]),
        ], 422);
    }
}
