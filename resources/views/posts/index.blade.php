@extends('layouts.app');

@section('content')

    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('posts.create') }}" class="btn btn-success">Add Post</a>
    </div>

    <div class="card card-default">
        <div class="card-header">
            Posts
        </div>


        <div class="cart-body">
            @if ($posts->count() > 0)
                <table class="table">
                    <thead>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->title }}</td>
                                <td>
                                    <img src="{{ asset('img/' . $post->image) }}" width="120px" height="120px"
                                        alt="{{ $post->image }}">
                                </td>
                                <td>
                                    <a href="{{ route('categories.edit', $post->category->id) }}">
                                        {{ $post->category->name }}
                                    </a>
                                </td>
                                @if ($post->trashed())
                                    <td>
                                        <form action="{{ route('restore-posts', $post->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-info text-white">Restore</button>
                                        </form>
                                    </td>
                                @else
                                    <td>
                                        <a href="{{ route('posts.edit', $post->id) }}"
                                            class="btn btn-info text-white">Edit</a>
                                    </td>
                                @endif

                                <td>
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            {{ $post->trashed() ? 'Delete' : 'Trash' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else

                <h4 class="text-center my-5">No Posts Yet...</h4>

            @endif
        </div>
    </div>

@endsection
