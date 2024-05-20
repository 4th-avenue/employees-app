<?php

namespace App\Http\Controllers;

use App\Tables\Roles;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use ProtoneMedia\Splade\SpladeForm;
use App\Http\Requests\RoleStoreRequest;
use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Submit;

class RoleController extends Controller
{
    public function index()
    {
        return view('admin.roles.index', [
            'roles' => Roles::class
        ]);
    }

    public function create()
    {
        $form = SpladeForm::make()
            ->action(route('admin.roles.store'))
            ->fields([
                Input::make('name')->label('Name'),
                Submit::make()->label('Save'),
            ])
            ->class('space-y-4');

        return view('admin.roles.create', [
            'form' => $form,
        ]);
    }

    public function store(RoleStoreRequest $request)
    {
        Role::create($request->validated());
        Splade::toast('새 역할을 저장했습니다.')->autoDismiss(3);

        return redirect()->route('admin.roles.index');
    }
}
