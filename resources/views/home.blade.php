<x-home-master>
    @section('content')
        <!-- Title -->
    @foreach ($posts as $post)

      <h1 class="mt-4">{{$post->title}}</h1>
      <!-- Preview Image -->
      <div class="card">
          <div class="card-body">
              @if (!$post->post_image)
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

                <form action="{{route('posts.delete', $post->id)}}" method="POST" class="d-inline-block float-right">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <span class="fa fa-trash"></span>
                        Delete post
                    </button>
                </form>
            </div>

          </div>
          <div class="card-footer text-muted">
            {{'Posted ' . $post->created_at->diffForHumans() . ' by '}}
            <a href="">
                {{$post->user->firstName .' '. $post->user->lastName}}
            </a>
          </div>
      </div>
    @endforeach


    @endsection
</x-home-master>
