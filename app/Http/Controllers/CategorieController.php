<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategorieController extends Controller
{
    public function index()
    {
        return view('admin.categories.index', [
            'categories' => Categories::all(),
        ]);
    }

    public function store()
    {
        request()->validate([
            'name' => ['required']
        ]);

        Categories::create([
            'name' => Str::upper(request('name')),
        ]);

        return back();
    }

    public function edit(Categories $categorie)
    {

        return view('admin.categories.edit', [
            'categorie' => $categorie,
            'posts' => Categories::find($categorie->id)->posts,
        ]);
    }

    public function destroy(Categories $categorie)
    {
        $categorie->delete();

        session()->flash('categorie-deleted', 'Deleted Categorie ' . $categorie->name);

        return back();
    }

    public function update(Categories $categorie)
    {
        $inputs = request()->validate([
            'name' => 'required|max:255',
        ]);

        $categorie->name = Str::upper($inputs['name']);

        if ($categorie->isDirty('name')) {
            session()->flash('categorie-updated', 'Categorie Updated: ' . $categorie->name);
            $categorie->save();
        } else {
            session()->flash('categorie-updated', 'Nothing has been updated.');
        }

        return redirect()->route('categories.index');
    }
}
