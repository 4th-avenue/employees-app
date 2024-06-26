<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Tables\Countries;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\Facades\Splade;
use App\Http\Requests\CountryStoreRequest;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Submit;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.countries.index', [
            'countries' => Countries::class
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryStoreRequest $request)
    {
        Country::create($request->validated());
        Splade::toast('새 Country를 저장했습니다.')->autoDismiss(3);

        return redirect()->route('admin.countries.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        $form = SpladeForm::make()
            ->action(route('admin.countries.update', $country))
            ->fields([
                Input::make('name')->label('Name'),
                Input::make('country_code')->label('Country code'),
                Submit::make()->label('Update'),
            ])
            ->fill($country)
            ->class('space-y-4')
            ->method('PUT');

        return view('admin.countries.edit', [
            'form' => $form,
            'country' => $country,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CountryStoreRequest $request, Country $country)
    {
        $country->update($request->validated());
        Splade::toast('Country 정보를 수정했습니다.')->autoDismiss(3);

        return redirect()->route('admin.countries.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        $country->delete();
        Splade::toast('Country 정보를 삭제했습니다.')->autoDismiss(3);

        return redirect()->back();
    }
}
