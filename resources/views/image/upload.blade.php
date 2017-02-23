@include('base.header')
    <div class="page-wrapper">
      @include('base.sidebar')
      <div class="page-right">
        @include('base.top-nav')
        <div class="sub-menu clearfix">
          <div class="breadcrumb fl">
            <?php breadcrumb(); ?>
          </div>
        </div>
        <div class="main-body">
          <div class="form-holder table-form">
<!--             <form action="/image/uploadfile" class="dropzone" method="post">
              {{csrf_field()}}
                <div class="dz-message">

                </div>

                <div class="fallback">
                    <input name="file" type="file" multiple />
                </div>

                <div class="dropzone-previews" id="dropzonePreview"></div>

                <h4 style="text-align: center;color:#428bca;">Drop images in this area  <span class="glyphicon glyphicon-hand-down"></span></h4>
              <input name="did" value="" type="hidden" />
              <div class="btn-set">
                <a class="btn btn-submit" href="#">保存</a>
              </div>
            </form> -->
<button id="submit-all">Submit all files</button>
<form action="/image/uploadfile" class="dropzone" id="my-dropzone">
  {{csrf_field()}}
  <input name="did" value="" type="hidden" />
</form>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      (function($) {
        $(function() {
          Dropzone.options.myDropzone = {

            // Prevents Dropzone from uploading dropped files immediately
            autoProcessQueue: false,

            init: function() {
              var submitButton = document.querySelector("#submit-all")
                  myDropzone = this; // closure

              submitButton.addEventListener("click", function() {
                myDropzone.processQueue(); // Tell Dropzone to process all queued files.
              });

              // You might want to show the submit button only when 
              // files are dropped here:
              this.on("addedfile", function() {
                // Show submit button here and/or inform user to click it.
              });

            }
          };
        });
      })(jQuery)
    </script>
@include('base.footer')