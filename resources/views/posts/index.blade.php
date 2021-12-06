<x-home-master>
    @if (Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
    @else
        <div class="alert alert-danger">{{Session::get('failure')}}</div>
    @endif
    @section('content')

    <!-- Title -->
    <h1 class="mt-4">{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
      by
      <a href="#">{{$post->user->firstName . ' ' . $post->user->lastName}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p>
        Posted {{$post->created_at->diffForHumans()}}
    </p>

    <hr>

    <!-- Preview Image -->
    <img class="img-fluid rounded" src={{$post->post_image}} height=300px width=600px alt="">

    <hr>

    <!-- Post Content -->
    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus, vero, obcaecati, aut, error quam sapiente nemo saepe quibusdam sit excepturi nam quia corporis eligendi eos magni recusandae laborum minus inventore?</p>

    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, tenetur natus doloremque laborum quos iste ipsum rerum obcaecati impedit odit illo dolorum ab tempora nihil dicta earum fugiat. Temporibus, voluptatibus.</p>

    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, doloribus, dolorem iusto blanditiis unde eius illum consequuntur neque dicta incidunt ullam ea hic porro optio ratione repellat perspiciatis. Enim, iure!</p>

    <blockquote class="blockquote">
      <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
      <footer class="blockquote-footer">Someone famous in
        <cite title="Source Title">Source Title</cite>
      </footer>
    </blockquote>

    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, nostrum, aliquid, animi, ut quas placeat totam sunt tempora commodi nihil ullam alias modi dicta saepe minima ab quo voluptatem obcaecati?</p>

    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dolor quis. Sunt, ut, explicabo, aliquam tenetur ratione tempore quidem voluptates cupiditate voluptas illo saepe quaerat numquam recusandae? Qui, necessitatibus, est!</p>

    <hr>
      {{-- @include('comments.create') --}}
    <!-- Just added -->
      <div class="card my-4">
        <h5 class="card-header">Leave a Comment:</h5>
        <div class="card-body">
        <form>
            @csrf

            <div class="form-group">
                <input type="hidden" name="post_id" id="post_id" value="{{$post->id}}">
                <textarea class="form-control" rows="3" name="content" id="content"></textarea>
            </div>

            <button type="submit" class="btn btn-primary" id="ajax_button">Submit</button>

        </form>
        </div>
    </div>
    <!-- Just added -->

    <!-- commentSection div added so that if Post has no comments, 1st comment posted will appear.-->
    <div class="commentsSection">
        @foreach ($comments as $comment)
                <!-- Single Comment -->
                <div class="media mb-4">
                    @if ($comment->user->avatar)
                        <img class="d-flex mr-3 rounded-circle" src="{{$comment->user->avatar->avatar}}" width="50" height="50" alt=""/>
                    @else
                        <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt=""/>
                    @endif
                    {{-- <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt=""/> --}}
                    <div class="media-body">
                    <h5 class="mt-0">{{$comment->user->firstName . " " . $comment->user->lastName}}</h5>
                        {{$comment->content}}
                        <div class="text-muted float-right">
                            {{'Updated '. $comment->updated_at->diffForHumans()}}
                        </div>
                        <hr>

                        <a href="" class="mx-3" data-toggle="modal" data-target="#exampleModal">Reply</a>
                        @if (Auth::user()->can('update', $comment))
                            <a href="" data-toggle="modal" data-target="#editCommentModal-{{$comment->id}}">Edit</a>
                            <a href="" class="mx-3">Delete</a>
                        @endif
                    </div>
                </div>

                <!-- Comment replies needs finishing as currently is not working.
                        For each comment, we want to append its respective reply/ies-->
                @if ($comment->replies->count() != 0)
                    @foreach ($comment->replies as $reply)
                    <div class="media mt-4">
                        <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt=""/>
                        <div class="media-body">
                        <h5 class="mt-0">{{$reply->user->firstName . " " . $reply->user->lastName}}</h5>
                            {{$reply->content}}
                            <hr>
                            <a href="" class="mx-3" data-toggle="modal" data-target="#exampleModal">Reply</a>
                            <a href="" data-toggle="modal" data-target="#editCommentModal">Edit</a>
                            <a href="" class="mx-3">Delete</a>
                        </div>
                    </div>
                    @endforeach
                @endif
                @include('posts.postModals.reply')
                @include('comments.editModal')
        @endforeach
    </div>


      <!-- Comment with nested comments -->
      <div class="media mb-4">
        <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
        <div class="media-body">
          <h5 class="mt-0">Commenter Name</h5>
          Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.

          <div class="media mt-4">
            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
            <div class="media-body">
              <h5 class="mt-0">Commenter Name</h5>
              Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
            </div>
          </div>

          <div class="media mt-4">
            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
            <div class="media-body">
              <h5 class="mt-0">Commenter Name</h5>
              Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
            </div>
          </div>

        </div>
      </div>

    @endsection
</x-home-master>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function () {

        $('#ajax_button').click(function(e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var $postData = {};
            $postData.content = $("#content").val();
            $postData.post = $("#post_id").val();

            $.ajax({

                url: "{{route('comments.create')}}",
                type: 'POST',
                enctype: 'multipart/form-data',
                data: $postData,
                success: function(result) {
                    console.log(result);
                                $(".commentsSection").prepend(
                                    '<div class="media mb-4">\
                                        <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt=""/>\
                                        <div class="media-body">\
                                        <h5 class="mt-0">'+ result.user.firstName + ' ' + result.user.lastName +'</h5>\
                                            ' + result.content +'\
                                            <hr>\
                                            <a href="" class="mx-3" data-toggle="modal" data-target="#exampleModal">Reply</a>\
                                            <a href="" data-toggle="modal" data-target="#editCommentModal">Edit</a>\
                                            <a href="" class="mx-3">Delete</a>\
                                        </div>\
                                    </div>');
                                $("#content").val('');
                }
            });
        });

    });
</script>
