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
            <form action="/image/uploadfile" class="dropzone">
              {{csrf_field()}}
              <input name="did" value="{{$_GET['did']}}" type="hidden" />
            </form>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      (function($) {
        $(function() {
          // Dropzone.options.myDropzone = {

          //   // Prevents Dropzone from uploading dropped files immediately
          //   autoProcessQueue: false,

          //   init: function() {
          //     var submitButton = document.querySelector("#submit-all")
          //         myDropzone = this; // closure

          //     submitButton.addEventListener("click", function() {
          //       myDropzone.processQueue(); // Tell Dropzone to process all queued files.
          //     });

          //     // You might want to show the submit button only when 
          //     // files are dropped here:
          //     this.on("addedfile", function() {
          //       // Show submit button here and/or inform user to click it.
          //     });

          //   }
          // };
          $('.dropzone').dropzone({
              dictDefaultMessage: '点击选择文件或拖拽文件到该区域上传'
          });
        });
      })(jQuery)
    </script>
@include('base.footer')