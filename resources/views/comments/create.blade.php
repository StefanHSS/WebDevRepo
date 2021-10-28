<!-- Comments Form -->
<div class="card my-4">
    <h5 class="card-header">Leave a Comment:</h5>
    <div class="card-body">
    <form method="POST" action="{{route('comments.create')}}" enctype="multipart/form-data">
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
            // console.log("Hellooo!!!");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content');
                }
            });

            $.ajax({

                url: "{{route('comments.create')}}",
                type: "POST",
                data: {
                        content: $("#content").val(),
                        post: $(this).data('post_id')
                      },
                beforeSend:function(){
                $(this).html('Saving...').addClass('disabled');
                },
                success: function(result) {
                    $(this).html('Save').removeClass('disabled');
                    jQuery('.alert').show();
                    jQuery('.alert').html(result.success);
                }
            });
        });
    });
</script>
