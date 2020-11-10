<x-admin-master>
    @section('content')

        <div class="row">
            <div class="col-sm-12">
                @if (session()->has('permission-deleted'))
                    <div class="alert alert-danger">
                        {{ session('permission-deleted') }}
                    </div>
                @else
                    @if (session()->has('permission-updated'))
                        <div class="alert alert-success">
                            {{ session('permission-updated') }}
                        </div>
                    @endif
                @endif


            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <h4>Create a Permission</h4>
                <form method="post" action="{{ route('permissions.store') }}">
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
                <h4>Permissions Table</h4>

                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $permission)
                                        <tr>
                                            <td>{{ $permission->id }}</td>
                                            <td><a
                                                    href="{{ route('permissions.edit', $permission->id) }}">{{ $permission->name }}</a>
                                            </td>
                                            <td>{{ $permission->slug }}</td>
                                            <td>
                                                <form method="post"
                                                    action="{{ route('permissions.destroy', $permission->id) }}">
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
</x-admin-master>
