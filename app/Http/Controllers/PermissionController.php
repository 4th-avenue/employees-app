<?php

namespace App\Http\Controllers;

use App\Tables\Permissions;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\Facades\Splade;
use Spatie\Permission\Models\Permission;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Submit;
use App\Http\Requests\PermissionStoreRequest;

class PermissionController extends Controller
{
    public function index()
    {
        return view('admin.permissions.index', [
            'permissions' => Permissions::class
        ]);
    }

    public function create()
    {
        $form = SpladeForm::make()
            ->action(route('admin.permissions.store'))
            ->fields([
                Input::make('name')->label('Name'),
                Submit::make()->label('Save'),
            ])
            ->class('space-y-4');

        return view('admin.permissions.create', [
            'form' => $form,
        ]);
    }

    public function store(PermissionStoreRequest $request)
    {
        Permission::create($request->validated());
        Splade::toast('새 권한을 저장했습니다.')->autoDismiss(3);

        return redirect()->route('admin.permissions.index');
    }

    public function edit(Permission $permission)
    {
        $form = SpladeForm::make()
            ->action(route('admin.permissions.update', $permission))
            ->fields([
                Input::make('name')->label('Name'),
                Submit::make()->label('Save'),
            ])
            ->fill($permission)
            ->class('space-y-4')
            ->method('PUT');

        return view('admin.permissions.edit', [
            'form' => $form,
        ]);
    }

    public function update(PermissionStoreRequest $request, Permission $permission)
    {
        $permission->update($request->validated());
        Splade::toast('권한을 수정했습니다.')->autoDismiss(3);

        return redirect()->route('admin.permissions.index');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        Splade::toast('권한을 삭제했습니다.')->autoDismiss(3);

        return redirect()->back();
    }
}
