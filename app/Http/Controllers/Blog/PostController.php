<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show(Post $post)
    {
        return view('blog.show', [
            'post' => $post
        ]);
    }

    public function category(Category $category)
    {

        return view('blog.category', [
            'category' => $category,
            'posts' => $category->posts()->searched()->simplePaginate(4),
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }

    public function tag(Tag $tag)
    {

        return view('blog.tag', [
            'tag' => $tag,
            'posts' => $tag->posts()->searched()->simplePaginate(4),
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }
}
