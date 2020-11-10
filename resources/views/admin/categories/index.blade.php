<x-admin-master>
    @section('content')

        <div class="row">
            <div class="col-sm-12">
                @if (session()->has('categorie-deleted'))
                    <div class="alert alert-danger">
                        {{ session('categorie-deleted') }}
                    </div>
                @else
                    @if (session()->has('categorie-updated'))
                        <div class="alert alert-success">
                            {{ session('categorie-updated') }}
                        </div>
                    @endif
                @endif


            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <h4>Create a Categorie</h4>
                <form method="post" action="{{ route('categories.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror " name="name" id="name">

                        <div>
                            @error('name')
                                <span>
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit">Create</button>
                    </div>
                </form>
            </div>

            <div class="col-sm-9">
                <h4>Categories Table</h4>

                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Created At</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $categorie)
                                        <tr>
                                            <td>{{ $categorie->id }}</td>
                                            <td><a
                                                    href="{{ route('categories.edit', $categorie->id) }}">{{ $categorie->name }}</a>
                                            </td>
                                            <td>{{ $categorie->created_at->diffForHumans() }}</td>
                                            <td>
                                                <form method="post"
                                                    action="{{ route('categories.destroy', $categorie->id) }}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

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
