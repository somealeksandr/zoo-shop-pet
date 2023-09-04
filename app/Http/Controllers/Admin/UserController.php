<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Yaro\Jarboe\Table\Fields\Number;
use Yaro\Jarboe\Table\Fields\Password;
use Yaro\Jarboe\Table\Fields\Text;
use Yaro\Jarboe\Table\Filters\TextFilter;

class UserController extends AbstractAdminTableController
{

    protected function init()
    {
        $this->setModel(User::class);

        $this->addColumns([
            'id',
            'name',
            'surname',
            'email',
            'phone_number',
        ]);

        $this->addTab('General', [
            Text::make('id', 'ID')->readonly()->filter(TextFilter::make())->width(10)->hideCreate(true),
            Text::make('email', 'E-mail')->filter(TextFilter::make()),
            Text::make('name', 'Name')->col(6)->filter(TextFilter::make()),
            Text::make('surname', 'Surname')->col(6)->filter(TextFilter::make()),
            Number::make('phone_number', 'Phone number')->col(6),

            Password::make('password'),
        ]);

        $this->order('created_at', 'desc');
    }
}
