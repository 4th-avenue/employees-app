<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Tables\Users;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\UserStoreRequest;
use ProtoneMedia\Splade\Facades\Splade;
use App\Http\Requests\UserUpdateRequest;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.users.index', [
            'users' => Users::class
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create', [
            'permissions' => Permission::pluck('name', 'name')->toArray(),
            'roles' => Role::pluck('name', 'name')->toArray(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        $user = User::create($request->validated());
        $user->syncRoles($request->roles);
        $user->syncPermissions($request->permissions);
        Splade::toast('User 정보를 저장했습니다.')->autoDismiss(3);

        return redirect()->route('admin.users.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'permissions' => Permission::pluck('name', 'id')->toArray(),
            'roles' => Role::pluck('name', 'id')->toArray(),
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $roleNames = Role::whereIn('id', $request->roles ?? [])->pluck('name')->toArray();
        $permissionNames = Permission::whereIn('id', $request->permissions ?? [])->pluck('name')->toArray();
        $user->update($request->validated());
        $user->syncRoles($roleNames);
        $user->syncPermissions($permissionNames);
        Splade::toast('User 정보를 수정했습니다.')->autoDismiss(3);

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        Splade::toast('User 정보를 삭제했습니다.')->autoDismiss(3);

        return redirect()->back();
    }
}
