<x-admin-master>
    @section('content')
        <h1>All Posts</h1>

        @if (session('message'))
            <div class="alert alert-danger">{{ session('message') }}</div>
        @elseif(session('post-created-message'))
            <div class="alert alert-success">{{ session('post-created-message') }}</div>
        @elseif(session('post-updated-message'))
            <div class="alert alert-success">{{ session('post-updated-message') }}</div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Owner</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->user->name }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>
                                        <div><img height="70px" src="{{ $post->post_image }}" alt=""></div>
                                    </td>
                                    <td>{{ $post->created_at->diffForHumans() }}</td>
                                    <td>{{ $post->updated_at->diffForHumans() }}</td>
                                    <td>
                                        @can('view', $post)
                                            <form method="post" action="{{ route('post.destroy', $post->id) }}"
                                                enctype="multipart/form-data">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        @endcan
                                    </td>
                                    <td><a type="submit" class="btn btn-secondary"
                                            href="{{ route('post.edit', $post->id) }}">Edit</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="d-flex">
            <div class="mx-auto">
                {{ $posts->links() }}
            </div>
        </div>

    @endsection

    @section('scripts')

        <!-- Page level plugins -->
        <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

        <!-- Page level custom scripts -->
        {{-- <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
        --}}

    @endsection
</x-admin-master>
