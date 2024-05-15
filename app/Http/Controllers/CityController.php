<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use App\Tables\Cities;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeForm;
use App\Http\Requests\CityStoreRequest;
use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Select;
use ProtoneMedia\Splade\FormBuilder\Submit;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.cities.index', [
            'cities' => Cities::class
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $form = SpladeForm::make()
            ->action(route('admin.cities.store'))
            ->fields([
                Input::make('name')->label('Name'),
                Select::make('state_id')
                    ->label('Choose a State')
                    ->options(State::pluck('name', 'id')->toArray()),
                Submit::make()->label('Save'),
            ])
            ->class('space-y-4');

        return view('admin.cities.create', [
            'form' => $form,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityStoreRequest $request)
    {
        City::create($request->validated());
        Splade::toast('새 City를 저장했습니다.')->autoDismiss(3);

        return redirect()->route('admin.cities.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        $form = SpladeForm::make()
            ->action(route('admin.cities.update', $city))
            ->fields([
                Input::make('name')->label('Name'),
                Select::make('state_id')
                    ->label('Choose a State')
                    ->options(State::pluck('name', 'id')->toArray()),
                Submit::make()->label('Update'),
            ])
            ->fill($city)
            ->class('space-y-4')
            ->method('PUT');

        return view('admin.cities.edit', [
            'form' => $form,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityStoreRequest $request, City $city)
    {
        $city->update($request->validated());
        Splade::toast('City 정보를 수정했습니다.')->autoDismiss(3);

        return redirect()->route('admin.cities.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        $city->delete();
        Splade::toast('City 정보를 삭제했습니다.')->autoDismiss(3);

        return redirect()->back();
    }
}
