<div class="modal fade" id="editCommentModal-{{$comment->id}}" tabindex="-1" role="dialog" aria-labelledby="editCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editCommentModal-{{$comment->id}}">New message</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form action="{{route('comments.edit', $comment)}}" method="post" enctype="multipart/form-data">
              @csrf
              @method('PUT')
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Author:</label>
              <input type="text" class="form-control" id="recipient_name" value="{{$comment->user->firstName . ' ' . $comment->user->lastName}}" disabled>
            </div>

            <div class="form-group">

              <input type="hidden" name="post_id" id="post_id" value="{{$post->id}}">
              <input type="hidden" name="comment_id" id="comment_id" value="{{$comment->id}}">
              <label for="message-text" class="col-form-label">Message:</label>
              <textarea class="form-control" id="content" name="content">{{$comment->content}}</textarea>

            </div>
            <button type="submit" class="btn btn-primary" id="ajaxReply">Save</button>
          </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
      $('#editCommentModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        })
  </script>
