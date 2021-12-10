<div class="modal fade" id="postEditModal" tabindex="-1" role="dialog" aria-labelledby="postEditModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="postEditModal">Edit post</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form method="POST" action="{{route('posts.update', $post)}}" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="form-group">
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Enter post title" value="{{$post->title}}">
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <textarea name="body" id="body" class="form-control @error('body') is-invalid @enderror" rows="3" placeholder="Enter text here...">{{$post->body}}</textarea>
                @error('body')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="fileUpload">Upload file</label>
                <input type="file" name="file" id="file" class="form-control-file @error('file') is-invalid @enderror">
                @error('file')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary float-right">Save</button>
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
      $('#postEditModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            // var recipient = button.data('whatever') // Extract info from data-* attributes
            // // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            // var modal = $(this)
            // modal.find('.modal-title').text('New message to ' + recipient)
            // modal.find('.modal-body input').val(recipient)
        })
  </script>
  <!-- Check to see how to get validation in modals working-->
  @if (count($errors) > 0)
  <script type="text/javascript">
      $(document).ready(function() {
          $('#postEditModal').modal('show');
      });
  </script>
@endif

