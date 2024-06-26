<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Employee;
use App\Tables\Employees;
use App\Models\Department;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\FormBuilder\Date;
use ProtoneMedia\Splade\FormBuilder\Input;
use App\Http\Requests\EmployeeStoreRequest;
use ProtoneMedia\Splade\FormBuilder\Select;
use ProtoneMedia\Splade\FormBuilder\Submit;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.employees.index', [
            'employees' => Employees::class
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $form = SpladeForm::make()
            ->action(route('admin.employees.store'))
            ->fields([
                Input::make('first_name')->label('First Name'),
                Input::make('last_name')->label('Last Name'),
                Input::make('middle_name')->label('Middle Name'),
                Input::make('zip_code')->label('Zip Code'),
                Select::make('city_id')
                    ->label('Choose a City')
                    ->options(City::pluck('name', 'id')->toArray()),
                Select::make('department_id')
                    ->label('Choose a Department')
                    ->options(Department::pluck('name', 'id')->toArray()),
                Date::make('birth_date')->label('Birthdate'),
                Date::make('date_hired')->label('Date Hired'),
                Submit::make()->label('Save'),
            ])
            ->class('space-y-4');

        return view('admin.employees.create', [
            'form' => $form,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeStoreRequest $request)
    {
        $city = City::findOrFail($request->city_id);
        Employee::create(array_merge($request->validated(), [
            'country_id' => $city->state->country_id,
            'state_id' => $city->state_id,
        ]));
        Splade::toast('새 직원을 저장했습니다.')->autoDismiss(3);

        return redirect()->route('admin.employees.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $form = SpladeForm::make()
            ->action(route('admin.employees.update', $employee))
            ->fields([
                Input::make('first_name')->label('First Name'),
                Input::make('last_name')->label('Last Name'),
                Input::make('middle_name')->label('Middle Name'),
                Input::make('zip_code')->label('Zip Code'),
                Select::make('city_id')
                    ->label('Choose a City')
                    ->options(City::pluck('name', 'id')->toArray()),
                Select::make('department_id')
                    ->label('Choose a Department')
                    ->options(Department::pluck('name', 'id')->toArray()),
                Date::make('birth_date')->label('Birthdate'),
                Date::make('date_hired')->label('Date Hired'),
                Submit::make()->label('Save'),
            ])
            ->fill($employee)
            ->class('space-y-4')
            ->method('PUT');

        return view('admin.employees.edit', [
            'form' => $form,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeStoreRequest $request, Employee $employee)
    {
        $city = City::findOrFail($request->city_id);
        $employee->update(array_merge($request->validated(), [
            'country_id' => $city->state->country_id,
            'state_id' => $city->state_id,
        ]));
        Splade::toast('직원 정보를 수정했습니다.')->autoDismiss(3);

        return redirect()->route('admin.employees.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        Splade::toast('직원 정보를 삭제했습니다.')->autoDismiss(3);

        return redirect()->back();
    }
}
