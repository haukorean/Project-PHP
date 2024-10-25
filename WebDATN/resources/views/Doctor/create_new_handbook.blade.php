@extends('DoctorLayout')
@section('contents_doctor')

<!--<link href="{{asset('/backend/assets/css/vendor/quill.core.css')}}" rel="stylesheet" type="text/css"> -->
<!--  <link href="{{asset('/backend/assets/css/vendor/quill.snow.css')}}" rel="stylesheet" type="text/css"> -->


<div class="row">
	<div class="col-lg-2"></div>
	<div class="col-lg-8">
		
	<div class="card p-3 mt-2">  
		<h3 class="page-title text-center">Tạo cẩm nang y tế mới</h3>
		
            <div class="row mt-1">
                   <div class="image-input d-flex align-items-center justify-content-center">
                    <input type="file" accept="image/*" name="imageInput" id="imageInput" required>                
                    <label for="imageInput" class="image-button btn btn-outline-primary">
                    <i class='bx bxs-user-circle'></i>chọn hình ảnh bài viết</label>
                       <img src="" class="image-previews-handbook">   
                  </div>
                   <span class="change-image">chọn hình ảnh khác</span>  
            </div>

			<div class="form-floating mb-3 mt-2">
		        <input type="text" class="form-control title" id="floatingInput" name="tite" placeholder="....." required/>
		        <label for="floatingInput">Tiêu đề</label>
		   </div>

	      <div class="row">

              <div class="mb-3 position-relative">
                  <label class="form-label">Mô tả chi tiết nội dung bài viết về lời khuyên y tế của bạn</label>

                   <textarea style="resize: none" rows="10" class="form-control describe_service" name="describe_handbook"  
                   id="ckeditor_handbook" placeholder=""></textarea>
                 <!--  <div id="snow-editor" class="describe_service" style="height: 400px;">
                      
                       
                    </div> -->
                    <!-- end Snow-editor-->
                  
              </div>
          </div>

            <div class=" d-flex align-items-center justify-content-center mt-1 button-list">
                <button type="button" class="btn btn-primary btn_save_create" >Lưu</button>
             </div>
		
	</div>

	</div>
</div>
<!--   <script src="{{asset('/backend/assets/js/vendor/quill.min.js')}}"></script> -->
<!--   <script src="{{asset('/backend/assets/js/pages/demo.quilljs.js')}}"></script> -->
<script src="{{asset('/ckeditor/ckeditor.js')}}"></script>
  <script type="text/javascript">
    
  CKEDITOR.replace('ckeditor_handbook',{
  filebrowserImageUploadUrl : "{{ url('uploads_ckeditor?_token='.csrf_token()) }}",
  // filebrowserBrowseUrl : "{{ url('file-browser?_token='.csrf_token()) }}",
  filebrowserUploadMethod: 'form'

  });
 </script>

<script type="text/javascript">


    $('.btn_save_create').on("click", function(){

       var image = document.getElementById("imageInput").files[0];
       var title = $('.title').val();
        var describe_service = CKEDITOR.instances.ckeditor_handbook.getData();
       // var describe_service = quill.root.innerHTML;

       if(image == null){

         $.NotificationApp.send("","Vui lòng chọn hình ảnh ","top-right","rgba(0,0,0,0.2)","error");

       }else if(title == ""){

         $.NotificationApp.send("","Vui lòng nhập tiêu đề bài viết ","top-right","rgba(0,0,0,0.2)","error");

       }else if(describe_service == ""){

         $.NotificationApp.send("","Vui lòng nhập mô tả chi tiết nội dung bài viết về lời khuyên y tế của bạn","top-right","rgba(0,0,0,0.2)","error");
       }else{
           save_create_handbook();
          
       }

   });




     function save_create_handbook(){   
       var title = $('.title').val();
       var describe_service = CKEDITOR.instances.ckeditor_handbook.getData();
         var form_data = new FormData();

         form_data.append("title",title);
         form_data.append("describe",describe_service);
         form_data.append("imageInput", document.getElementById("imageInput").files[0]);
     

            $.ajax({
            url:"{{url('/doctor/save_create_handbook')}}",
            method:"POST",
            headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },  
             // dataType:"JSON",
             data:form_data,
             contentType:false,
             cache:false,
             processData:false,
              success:function(data){ 
               // alert("thanh coong");
                Swal.fire({
                    icon: 'success',
                    title: "<h3 style='color:#00FF00'>Tạo thành công</h3>",
                    width: 300,
                    showConfirmButton: false,
                    timer: 1200
                  });

                $(this).delay(1200).queue(function(){
                  window.location.href = "{{URL::to('/doctor/handbook_doctor')}}"
                });
             
              
             }
           });
}
</script>


<script type="text/javascript">
 $(document).ready(function(){
    
  $('#imageInput').on('change', function() {
    $input = $(this);
    if($input.val().length > 0) {
      fileReader = new FileReader();
 

      fileReader.onload = function (data) {
       
      $('.image-previews-handbook').attr('src', data.target.result);
      }
      fileReader.readAsDataURL($input.prop('files')[0]);
      $('.image-button').css('display', 'none');
      $('.image-previews-handbook').css('display', 'block');
      $('.change-image').css('display', 'block');
    }
  });
            
  $('.change-image').on('click', function() {
    $control = $(this);     
    $('#imageInput').val(''); 
    $preview = $('.image-previews-handbook');
    $preview.attr('src', '');
    $preview.css('display', 'none');
    $control.css('display', 'none');
    $('.image-button').css('display', 'block');
  });



  });
</script>


   <script type="text/javascript">



  </script>
@endsection