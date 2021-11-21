<!-- Comments Form -->
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {

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
                                $(".commentsSection").append(
                                    '<div class="media mb-4">\
                                        <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt=""/>\
                                        <div class="media-body">\
                                        <h5 class="mt-0">'+ {{$post.firstName}} + " " + {{$post.lastName}}'</h5>\
                                            '$postData.content'\
                                            <hr>\
                                            <a href="">Edit</a>\
                                            <a href="" class="mx-3">Delete</a>\
                                        </div>\
                                    </div>'
                            );
                }
            });
        });
    });
</script>
