<x-admin-master>

    @section('content')
        <h1>All Users</h1>

        @if(session('message'))
            <div class="alert alert-danger">{{session('message')}}</div>
         @elseif(session('post-created-message'))
            <div class="alert alert-success">{{session('post-created-message')}}</div>
         @elseif(session('post-updated-message'))
            <div class="alert alert-success">{{session('post-updated-message')}}</div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Username</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Avatar</th>
                      <th>Registered At</th>
                      <th>Updated Profile At</th>
                      <th>Delete</th>
                      {{-- <th>Edit</th> --}}
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $user)
                    <tr>
                      <td>{{$user->id}}</td>
                      <td>{{$user->username}}</td>
                      <td><a href="{{route('user.profile.show', $user->id )}}">{{$user->name}}</a></td>
                      <td>{{$user->email}}</td>
                      <td><div><img height="70px" src="{{$user->avatar}}" alt=""></div></td>
                      <td>{{$user->created_at->diffForHumans()}}</td>
                      <td>{{$user->updated_at->diffForHumans()}}</td>
                      <td>
                      {{-- @can('view', $user) --}}
                        <form method="post" action="{{route('user.destroy', $user->id)}}" enctype="multipart/form-data">
                          @method('DELETE')
                          @csrf
                          <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        {{-- @endcan --}}
                      </td>
                      {{-- <td><a type="submit" class="btn btn-secondary" href="{{route('post.edit', $user->id)}}">Edit</a></td> --}}
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          {{-- <div class="d-flex">
            <div class="mx-auto">
            {{$posts->links()}}
            </div>
        </div> --}}

    @endsection

    @section('scripts')

          <!-- Page level plugins -->
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
        <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
        
    @endsection

</x-admin-master>