<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New message</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form>
              @csrf
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Recipient:</label>
              <input type="text" class="form-control" id="recipient_name" value="{{$comment->user->firstName . ' ' . $comment->user->lastName}}" disabled>
            </div>

            <div class="form-group">

              <input type="hidden" name="post_id" id="post_id" value="{{$post->id}}">
              <input type="hidden" name="comment_id" id="comment_id" value="{{$comment->id}}">
              <label for="message-text" class="col-form-label">Message:</label>
              <textarea class="form-control" id="reply" name="reply"></textarea>

            </div>
          </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="ajaxReply">Send reply</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
      $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            // var recipient = button.data('whatever') // Extract info from data-* attributes
            // // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            // var modal = $(this)
            // modal.find('.modal-title').text('New message to ' + recipient)
            // modal.find('.modal-body input').val(recipient)
        })
  </script>

  <script>
      $(document).ready(function() {

        $('#ajaxReply').click(function(e) {
            e.preventDefault();
            // console.log($("#content").val());
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var $replyData = {};
            $replyData.content = $("#reply").val();
            $replyData.post = $("#post_id").val();
            $replyData.comment = $("#comment_id").val();

            $.ajax({

                url: "{{route('comments.replies')}}",
                type: 'POST',
                enctype: 'multipart/form-data',
                data: $replyData,
                success: function(result) {
                    console.log(result);

                    $(".commentsSection").prepend(
                                    '<div class="media mt-4">\
                                        <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt=""/>\
                                        <div class="media-body">\
                                        <h5 class="mt-0">'+ result.user.firstName + ' ' + result.user.lastName +'</h5>\
                                            ' + result.content +'\
                                            <hr>\
                                            <a href="">Edit</a>\
                                            <a href="" class="mx-3">Delete</a>\
                                        </div>\
                                    </div>');
                                $("#content").val('');
                }
            });
        });
      });
  </script>
