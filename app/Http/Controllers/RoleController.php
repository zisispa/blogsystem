<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    //
    public function index()
    {
        return view('admin.roles.index', [
            'roles' => Role::all(),
        ]);
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', [
            'role' => $role,
            'permissions' => Permission::all(),
        ]);
    }

    public function store()
    {
        request()->validate([
            'name' => ['required']
        ]);

        Role::create([
            'name' => Str::ucfirst(request('name')),
            'slug' => Str::of(Str::lower(request('name')))->slug('-'),
        ]);

        return back();
    }

    public function destroy(Role $role)
    {
        $role->delete();

        session()->flash('role-deleted', 'Deleted Role ' . $role->name);

        return back();
    }

    public function update(Role $role)
    {
        $inputs = request()->validate([
            'name' => 'required|max:255',
        ]);

        $role->name = Str::ucfirst($inputs['name']);
        $role->slug = Str::of(Str::lower($inputs['name']))->slug('-');

        if ($role->isDirty('name')) {
            session()->flash('role-updated', 'Role Updated: ' . $role->name);
            $role->save();
        } else {
            session()->flash('role-updated', 'Nothing has been updated.');
        }

        return redirect()->route('roles.index');
    }

    public function attach_permission(Role $role)
    {
        $role->permissions()->attach(request('permission'));

        return back();
    }

    public function detach_permission(Role $role)
    {
        $role->permissions()->detach(request('permission'));

        return back();
    }
}
