<?php

namespace App\Forms;

use App\Models\Country;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\AbstractForm;
use ProtoneMedia\Splade\FormBuilder\Text;
use ProtoneMedia\Splade\FormBuilder\Select;
use ProtoneMedia\Splade\FormBuilder\Submit;

class CreateStateForm extends AbstractForm
{
    public function configure(SpladeForm $form)
    {
        $form
            ->action(route('admin.states.store'))
            ->method('POST')
            ->class('space-y-4');
    }

    public function fields(): array
    {
        return [
            Select::make('country_id')
                ->label('Choose a country')
                ->options(Country::pluck('name', 'id')->toArray()),
            Text::make('name')
                ->label('Name'),
            Submit::make()
                ->label(__('Save')),
        ];
    }
}
