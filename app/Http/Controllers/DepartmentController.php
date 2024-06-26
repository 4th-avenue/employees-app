<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Tables\Departments;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Submit;
use App\Http\Requests\DepartmentStoreRequest;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.departments.index', [
            'departments' => Departments::class
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $form = SpladeForm::make()
            ->action(route('admin.departments.store'))
            ->fields([
                Input::make('name')->label('Name'),
                Submit::make()->label('Save'),
            ])
            ->class('space-y-4');

        return view('admin.departments.create', [
            'form' => $form,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentStoreRequest $request)
    {
        Department::create($request->validated());
        Splade::toast('새 부서를 저장했습니다.')->autoDismiss(3);

        return redirect()->route('admin.departments.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        $form = SpladeForm::make()
            ->action(route('admin.departments.update', $department))
            ->fields([
                Input::make('name')->label('Name'),
                Submit::make()->label('Save'),
            ])
            ->fill($department)
            ->class('space-y-4')
            ->method('PUT');

        return view('admin.departments.edit', [
            'form' => $form,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentStoreRequest $request, Department $department)
    {
        $department->update($request->validated());
        Splade::toast('부서 정보를 수정했습니다.')->autoDismiss(3);

        return redirect()->route('admin.departments.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();
        Splade::toast('부서 정보를 삭제했습니다.')->autoDismiss(3);

        return redirect()->back();
    }
}
