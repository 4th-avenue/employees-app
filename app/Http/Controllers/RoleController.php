<?php

namespace App\Http\Controllers;

use App\Tables\Roles;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\RoleStoreRequest;
use ProtoneMedia\Splade\Facades\Splade;
use Spatie\Permission\Models\Permission;

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
        return view('admin.roles.create', [
            'permissions' => Permission::pluck('name', 'name')->toArray()
        ]);
    }

    public function store(RoleStoreRequest $request)
    {
        $role = Role::create($request->validated());
        $role->syncPermissions($request->permissions);
        Splade::toast('새 역할을 저장했습니다.')->autoDismiss(3);

        return redirect()->route('admin.roles.index');
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', [
            'role' => $role,
            'permissions' => Permission::pluck('name', 'id')->toArray()
        ]);
    }

    public function update(RoleStoreRequest $request, Role $role)
    {
        $permissionNames = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
        $role->update($request->validated());
        $role->syncPermissions($permissionNames);
        Splade::toast('역할을 수정했습니다.')->autoDismiss(3);

        return redirect()->route('admin.roles.index');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        Splade::toast('역할을 삭제했습니다.')->autoDismiss(3);

        return redirect()->back();
    }
}
