@extends('layouts.app');

@section('content')

    {{-- <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('posts.create') }}" class="btn btn-success">Add Post</a>
    </div> --}}

    <div class="card card-default">
        <div class="card-header">
            Users
        </div>


        <div class="cart-body">
            @if ($users->count() > 0)
                <table class="table">
                    <thead>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <img width="40px" height="40px" style="border-radius: 50%"
                                        src="{{ Gravatar::src($user->image) }}" width="120px" height="120px"
                                        alt="{{ Gravatar::src($user->image) }}">
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    @if (!$user->isAdmin())
                                        <form action="{{ route('users.make-admin', $user->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-success btn-sm">Make Admin</button>
                                        </form>
                                    @endif
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
