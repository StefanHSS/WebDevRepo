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

          <form method="POST" action="{{route('posts.update', $post)}}" enctype="multipart/form-data" id="updateForm">
              @csrf

              <div class="form-group">
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Enter post title" value="{{$post->title}}">
                <span class="text-danger">
                    <strong id="title_error"></strong>
                </span>
            </div>

            <div class="form-group">
                <textarea name="body" id="body" class="form-control @error('body') is-invalid @enderror" rows="3" placeholder="Enter text here...">{{$post->body}}</textarea>
                <span class="text-danger">
                    <strong id="body_error"></strong>
                </span>
            </div>

            <div class="form-group">
                <label for="fileUpload">Upload file</label>
                <input type="file" name="file" id="file" class="form-control-file @error('file') is-invalid @enderror">
                <span class="text-danger">
                    <strong id="file_error"></strong>
                </span>
            </div>
            <button type="submit" class="btn btn-primary float-right" id="updateButton">Save</button>
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
        })
  </script>
  <script>
    $(document).ready(function () {
            $('#updateButton').click(function(e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // var $postData = {};
            // $postData.title = $("#title").val();
            // $postData.body = $("#body").val();
            // $postData.post_image = $("#file").val();
            var postData = new FormData($('#updateForm')[0]);


            $.ajax({
                url: $('#updateForm').attr('action'),
                type: 'POST',
                enctype: $('#updateForm').attr('enctype'),
                data:postData,
                processData: false,
                contentType: false,

                success: function(data) {
                    console.log(data);
                    if(data.code == 0)
                    {
                        $.each(data.error, function(key, value){
                            $('#'+key+'_error').append(value);
                        });
                    }
                    else
                    {
                        $(".modal-backdrop").remove();
                        $('#postEditModal').hide();
                        $('#success_edit').addClass('alert alert-success');
                        $('#success_edit').text(data.msg);
                        window.location = "http://127.0.0.1:8000/home";
                    }
                }
            });
        });
    });
  </script>

