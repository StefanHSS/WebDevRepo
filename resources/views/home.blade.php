<x-home-master>
    @section('content')
        <!-- Title -->
    @foreach ($posts as $post)

      <h1 class="mt-4">{{$post->title}}</h1>
      <!-- Preview Image -->
      <div class="card">
          <div class="card-body">
              @if (!$post->post_image)
              <!-- Doesn't show placeholder currently if no image is available -->
                <img class="img-fluid rounded" src="http://placehold.it/900x300" alt="">
              @else
                <img src="{{$post->post_image}}" height="300px" width="600px" alt="">
              @endif
            <hr>

            <h4 class="card-title">
                {{Str::limit($post->body, 10)}}
            </h4>
            <p class="card-text">
                {{Str::limit($post->body, 10)}}
            </p>
            {{-- <a href="{{route('posts.show', $post->id)}}" class="btn btn-primary" role="button">Read more</a> --}}
            <div class="buttonContainer">
                <form action="{{route('posts.show', $post)}}" class="d-inline-block">
                    <button type="submit" class="btn btn-primary">Read more</button>
                </form>

                @if (Auth::user()->hasRole('Administrator'))
                    <form action="{{route('posts.delete', $post->id)}}" method="POST" class="d-inline-block float-right">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <span class="fa fa-trash"></span>
                            Delete post
                        </button>
                    </form>
                @endif
            </div>

          </div>
          <div class="card-footer text-muted">
            {{'Posted ' . $post->created_at->diffForHumans() . ' by '}}
            <a href="" class="d-inline-block">
                {{$post->user->firstName .' '. $post->user->lastName}}
            </a>
            <a class="nav-link d-inline-block float-right">
                <span class="fa fa-comments"></span>
                {{$post->comments()->count()}} Comments
            </a>
          </div>
      </div>
    @endforeach
      <br>
      <div class="d-flex">
        <div class="mx-auto">
            {{$posts->links()}}
          </div>
      </div>

    @endsection
</x-home-master>
