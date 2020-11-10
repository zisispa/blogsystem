<x-admin-master>
    @section('content')
        <h1>Create Post</h1>

        <form method="post" action="{{ route('post.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title" aria-describedby=""
                    placeholder="Enter title">
            </div>
            <div class="form-group">
                <label for="file">File</label>
                <input type="file" name="post_image" class="form-control-file" id="post_image">
            </div>


            <div class="form-group">
                <textarea name="body" class="form-control" id="body" cols="30" rows="5"></textarea>
            </div>

            <div class="form-group">
                <label for="categorie">Categories</label>
                {{-- <div class="rounded bg-warning">
                    <p id="categories_bumb"></p>
                </div> --}}
                <select class="custom-select my-1 mr-sm-2" id="categorie" name="categorie">
                    <option selected>Choose categorie...</option>
                    @foreach ($categories as $categorie)
                        <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                    @endforeach
                </select>
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @endsection

    {{-- @section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('change', '#categorie', function() {
                var categorie_val = $(this).val();
                var categories_bumb = [];
                var categories_final = [];
                var parag = document.getElementById('categories_bumb');

                if (categorie_val > 0) {
                    categories_bumb.push(categorie_val);
                    parag.innerHTML += categories_bumb;
                }

            });
        });

    </script>
    @endsection --}}
</x-admin-master>
