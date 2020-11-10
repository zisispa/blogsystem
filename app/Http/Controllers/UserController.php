<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('admin.users.profile', [
            'user' => $user,
            'roles' => Role::all(),
        ]);
    }

    public function create()
    {
        //$this->authorize('create', User::class);

        return view('admin.users.create');
    }

    // public function store(){
    //     //$this->authorize('create', Post::class);

    //     $inputs = request()->validate([
    //         'title' => 'required|min:8|max: 255',
    //         'post_image' => 'file',
    //         'body' => 'required'
    //     ]);

    //     if (request('post_image')) {
    //         $inputs['post_image'] = request('post_image')->store('images');
    //     }

    //     auth()->user()->posts()->create($inputs);

    //     $request->session()->flash('post-created-message', 'The post "' . $inputs['title'] . '" was created!');

    //     return redirect()->route('post.index');
    // }

    public function update(User $user)
    {

        $inputs = request()->validate([
            'username' => ['required', 'string', 'max:255', 'alpha_dash'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'avatar' => ['file'],
            // 'password' => ['min:6', 'max:255', 'confirmed']
        ]);

        if (request('avatar')) {
            $inputs['avatar'] = request('avatar')->store('images');
        }

        $user->update($inputs);

        return back();
    }

    public function attach(User $user)
    {

        $user->roles()->attach(request('role'));

        return back();
    }

    public function detach(User $user)
    {

        $user->roles()->detach(request('role'));

        return back();
    }

    public function destroy(User $user, Request $request)
    {
        $user->delete();

        $request->session()->flash('message', 'Post was Deleted');

        return back();
    }
}
