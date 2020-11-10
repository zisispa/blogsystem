<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Post;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    public function index()
    {
        $posts = auth()->user()->posts()->paginate(5);

        return view('admin.posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('blog-post', [
            'post' => $post,
            'categories' => Post::find($post->id)->categories
        ]);
    }

    public function create()
    {
        $this->authorize('create', Post::class);

        return view('admin.posts.create', [
            'categories' => Categories::all(),
        ]);
    }

    public function store(Request $request)
    {

        $post = new Post();
        $this->authorize('create', Post::class);

        $inputs = request()->validate([
            'title' => 'required|min:2|max: 255',
            'post_image' => 'file',
            'body' => 'required',
        ]);

        // if (request('post_image')) {
        //     $inputs['post_image'] = request('post_image')->store('images');
        //     //$request->post_image->move(public_path('images'), $imageName);
        // }

        $post->post_image = request('post_image')->store('images');
        $post->user_id = auth()->user()->id;
        $post->title = $inputs['title'];
        $post->body = $inputs['body'];
        $post->save();
        $post->categories()->attach($request->categorie);

        // auth()->user()->posts()->create($inputs);

        // $post->categories()->attach(request('categorie'));

        $request->session()->flash('post-created-message', 'The post "' . $inputs['title'] . '" was created!');

        return redirect()->route('post.index');

        // dd(request()->all());
    }

    public function edit(Post $post)
    {
        $this->authorize('view', $post);
        return view('admin.posts.edit', compact('post'));
    }

    public function destroy(Post $post, Request $request)
    {

        $this->authorize('delete', $post);

        $post->delete();

        $request->session()->flash('message', 'Post was Deleted');

        return back();
    }

    public function update(Post $post, Request $request)
    {
        $inputs = request()->validate([
            'title' => 'required|min:8|max:255',
            'post_image' => 'file',
            'body' => 'required'
        ]);


        if (request('post_image')) {
            $inputs['post_image'] = request('post_image')->store('images');
            $post->post_image = $inputs['post_image'];
        }

        $post->title = $inputs['title'];
        $post->body = $inputs['body'];

        $this->authorize('update', $post);

        $post->save();

        session()->flash('post-updated-message', 'Post with title was updated ' . $inputs['title']);

        return redirect()->route('post.index');
    }
}
