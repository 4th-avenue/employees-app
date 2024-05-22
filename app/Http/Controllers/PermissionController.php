<?php

namespace App\Http\Controllers;

use App\Tables\Permissions;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
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
        return view('admin.permissions.create', [
            'roles' => Role::pluck('name', 'name')->toArray()
        ]);
    }

    public function store(PermissionStoreRequest $request)
    {
        $permission = Permission::create($request->validated());
        $permission->syncRoles($request->roles);
        Splade::toast('새 권한을 저장했습니다.')->autoDismiss(3);

        return redirect()->route('admin.permissions.index');
    }

    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', [
            'permission' => $permission,
            'roles' => Role::pluck('name', 'id')->toArray()
        ]);
    }

    public function update(PermissionStoreRequest $request, Permission $permission)
    {
        $roleNames = Role::whereIn('id', $request->roles ?? [])->pluck('name')->toArray();
        $permission->update($request->validated());
        $permission->syncRoles($roleNames);
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
