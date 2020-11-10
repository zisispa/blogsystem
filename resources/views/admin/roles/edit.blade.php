<x-admin-master>
    @section('content')
        <h2>Edit Role: {{ $role->name }}</h2>

        <div class="row">
            <div class="col-sm-6">
                <form method="post" action="{{ route('admin.role.update', $role) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid  @enderror" id="name"
                            value="{{ $role->name }}">

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        <br>
        <br>
        <br>
        <h4>Permissions Table</h4>
        <div class="row">
            <div class="col-sm-12">

                @if (!$permissions->isEmpty())

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Options</th>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Attach</th>
                                            <th>Detach</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permissions as $permission)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" @foreach ($role->permissions as $role_permission)
                                                    @if ($role_permission->slug == $permission->slug)
                                                        checked
                                                    @endif
                                        @endforeach
                                        >
                                        </td>
                                        <td>{{ $permission->id }}</td>
                                        <td>{{ $permission->name }}</td>
                                        <td>{{ $permission->slug }}</td>
                                        <td>
                                            <form action="{{ route('role.permission.attach', $role) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="permission" value="{{ $permission->id }}">
                                                <button type="submit" class="btn btn-primary" @if ($role->permissions->contains($permission))
                                                    disabled
                @endif>
                Attach
                </button>
                </form>
                </td>
                <td>
                    <form action="{{ route('role.permission.detach', $role) }}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="permission" value="{{ $permission->id }}">
                        <button type="submit" class="btn btn-danger" @if (!$role->permissions->contains($permission))
                            disabled
                            @endif
                            >Detach</button>
                    </form>
                </td>
                </tr>
                @endforeach
                </tbody>
                </table>
            </div>
        </div>
        </div>

        @endif

        </div>
        </div>

    @endsection
</x-admin-master>
