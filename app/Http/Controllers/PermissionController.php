<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    //
    public function index()
    {
        return view('admin.permissions.index', [
            'permissions' => Permission::all(),
        ]);
    }

    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', [
            'permission' => $permission
        ]);
    }

    public function store()
    {
        request()->validate([
            'name' => ['required']
        ]);

        Permission::create([
            'name' => Str::ucfirst(request('name')),
            'slug' => Str::of(Str::lower(request('name')))->slug('-'),
        ]);

        return back();
    }

    public function destroy(Permission $permission)
    {

        $permission->delete();

        session()->flash('permission-deleted', 'Deleted Permission ' . $permission->name);

        return back();
    }

    public function update(Permission $permission)
    {
        $inputs = request()->validate([
            'name' => 'required|max:255',
        ]);

        $permission->name = Str::ucfirst($inputs['name']);
        $permission->slug = Str::of(Str::lower($inputs['name']))->slug('-');

        if ($permission->isDirty('name')) {
            session()->flash('permission-updated', 'Permission Updated: ' . $permission->name);
            $permission->save();
        } else {
            session()->flash('permission-updated', 'Nothing has been updated.');
        }

        return redirect()->route('permissions.index');
    }
}
