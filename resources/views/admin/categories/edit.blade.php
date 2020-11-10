<x-admin-master>
    @section('content')
        <h2>Edit Role: {{ $categorie->name }}</h2>

        <div class="row">
            <div class="col-sm-6">
                <form method="post" action="{{ route('categories.update', $categorie) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid  @enderror" id="name"
                            value="{{ $categorie->name }}">

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
        <h4>Post Categories Table</h4>
        <div class="row">
            <div class="col-sm-12">

                {{-- @if (!$permissions->isEmpty())
                    --}}

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            {{-- <th>Options</th>
                                            --}}
                                            <th>Id</th>
                                            <th>Title</th>
                                            <th>Body</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($posts as $post)
                                            <tr>
                                                <td>{{ $post->id }}</td>
                                                <td>{{ $post->title }}</td>
                                                <td>{{ $post->body }}</td>
                                                <td>{{ $post->created_at->diffForHumans() }}</td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{--
                @endif --}}

            </div>
        </div>

    @endsection
</x-admin-master>
