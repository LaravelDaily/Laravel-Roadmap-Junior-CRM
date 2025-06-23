<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $withDeleted = null;

        if (request('deleted') === 'true') {
            $withDeleted = true;
        }

        $users = User::query()
            ->when($withDeleted, function ($query) {
                return $query->onlyTrashed();
            })
            ->with('roles')
            ->paginate(20);

        return view('users.index', [
            'users' => $users,
            'withDeleted' => $withDeleted,
        ]);
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', [
            'roles' => $roles,
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());

        if ($request->has('terms_accepted')) {
            $user->terms_accepted_at = now();
            $user->save();
        }

        if ($request->has('role')) {
            $user->syncRoles($request->role);
        }

        return redirect()->route('users.index')->with('status', __('User created successfully'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $user->load('roles');

        return view('users.edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());

        if ($request->has('terms_accepted') && !$user->terms_accepted_at) {
            $user->terms_accepted_at = now();
            $user->save();
        }

        if ($request->has('role')) {
            $user->syncRoles($request->role);
        }

        return redirect()->route('users.index')->with('status', __('User updated successfully'));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('status', __('User deleted successfully'));
    }
}
