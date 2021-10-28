<x-admin-master>
    @section('title', 'Create Post')

    @section('content')
    @if (Session::has('message'))
        <div class="alert alert-success">
            {{Session::get('message')}}
        </div>
    @endif
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{route('posts.store')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <input type="text" class="form-control" name="title" placeholder="Enter post title" >
                        </div>

                        <div class="form-group">
                            <textarea name="body" id="body" class="form-control" rows="3" placeholder="Enter text here..."></textarea>
                        </div>

                        <div class="form-group">
                            <label for="fileUpload">Upload file</label>
                            <input type="file" name="file" id="file" class="form-control-file">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary mt-5">
                                Create Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
</x-admin-master>
