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
            <a href="{{route('posts.show', $post->id)}}" class="btn btn-primary" role="button">Read more</a>
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
