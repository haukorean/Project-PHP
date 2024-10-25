@extends('DoctorLayout')
@section('contents_doctor')
<div class="card mt-2 p-2">
	<h3 class="page-title text-center">Quản lý dịch vụ y tế của Phòng khám</h3>
	<div class="row">
	<div class="col-lg-6 p-3 border-end">
	    <div class="image-input d-flex align-items-center justify-content-center">
	                  
	        <img src="{{ (Auth::user()->doctor->avt_user == 0) ? asset('/Image/avt_user.png') :
	        asset('/Image/avt_user/'.Auth::user()->id.'/'.Auth::user()->doctor->avt_user) }}" 
	        class="img-thumbnail">

        </div>
           <div class="ps-4 mt-1 pe-4">
        	  <span class="fw-bold">{{Auth::user()->company->company_name}}</span><br>
		            <span class="text-primary">Tên phòng khám: <i class="dripicons-location"></i> {{Auth::user()->company->company_address}}</span> <br>	            
				    <h4 class="header-title mt-1">Giá khám: <span class="text-success">
				    	{{Auth::user()->company->price}}.VND</span> (Default) </h4> 
              <input type="hidden" class="value_price_default" value="{{Auth::user()->company->price}}">

			<button type="button" class="mt-1 btn btn-success btn-sm btn_change_default" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg">Thay đổi dịch vụ</button>
			</div>
			 <hr>
			 <div class="content_ser">{!!Auth::user()->company->service!!}</div>
			 
        </div>
		 
	 <div class="col-lg-6 p-2">
		 <a class="btn btn-lg font-16 btn-danger btn_create" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg"> 
	     <i class="mdi mdi-plus-circle-outline"></i>Tạo dịch vụ Y tế mới</a>

		  <div class="accordion custom-accordion mt-2 load_service_doctor" id="custom-accordion-one">


		 </div>
	  </div>

	</div>
	
</div>
<!-- Small modal -->

<div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                 <h4 class="modal-title title_model" id="myLargeModalLabel">Tạo mới Dịch vụ y tế của phòng khám</h4> 
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>

            <div class="modal-body">
		             
		           <div class="row mt-1 row1">
		                   <div class="image-input d-flex align-items-center justify-content-center">
		                    <input type="file" accept="image/*" name="imageInput" id="imageInput" required>                
		                    <label for="imageInput" class="image-button btn btn-outline-primary">
		                    <i class='bx bxs-user-circle'></i>Chọn dịch vụ hình ảnh</label>
		                       <img src="" class="image-previews">   
		                  </div>
		                   <span class="change-image">Chọn hình ảnh dịch vụ</span>  
		            </div>
		            <div class="row row2">
		            	  <div class="col-md-12">
  	            		   <div class="form-floating mb-3 mt-2">
  						          <input type="text" class="form-control name_ser" id="floatingInput" name="tite" maxlength="45" 
  						           placeholder="....." required/>
  						          <label for="floatingInput">Tiêu đề</label>
  						         </div>
		            	  </div>

		                <div class="col-md-6">
	            		        <label class="form-label">Phí dịch vụ y tế:</label>
                          <input type="text" class="form-control price_create PriceInput" name="price" value="0" data-toggle="input-mask" 
                          data-mask-format="000.000.000.000.000" 
                          data-reverse="true" maxlength="11" required>
		               	</div>

                     <div class="col-md-6">
                          <label class="form-label">Loại dịch vụ:</label>
                            <select class="form-select type_service" id="example-select" name="type_service">
                              @foreach($all_ser as $ser)
                                <option value="{{$ser->id}}">{{$ser->name}}</option>
                               @endforeach
                            </select>
                    </div>
		            </div>
                
               <div class="row row3">
                  <div class="col-md-3">
                    <label class="form-label">Loại dịch vụ:</label>
                          <input type="text" class="form-control price_update PriceInput" name="price" value="0" data-toggle="input-mask" 
                          data-mask-format="000.000.000.000.000" 
                          data-reverse="true" maxlength="11" required>
                  </div>
              </div>

			       <div class="row mt-1">
		              <div class="mb-3 position-relative">
		                  <label class="form-label">Mô tả chi tiết các dịch vụ khám chữa bệnh của phòng khám</label>

		                   <textarea style="resize: none" rows="10" class="form-control describe_service" name="describe_handbook"  
		                   id="ckeditor_service" placeholder=""></textarea>
		                  
		              </div>
		          </div>

		          <div class=" d-flex align-items-center justify-content-center mt-1 button-list">
		          	    <input type="hidden" class="id_ser" value="0">
		          	    <button type="button" class="btn btn-primary btn_save_create" >Lưu Tạo</button>
		                <button type="button" class="btn btn-primary btn_save_change" >Lưu Thay Đổi</button>
		                <button type="button" class="btn btn-primary btn_save_change_default" >Lưu Thay Đổi</button>
		          </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
 $(document).ready(function(){


    $('.btn_save_create').on("click", function(){

       var image = document.getElementById("imageInput").files[0];
       var name_ser = $('.name_ser').val();
       var price = $('.price_create').val();
       var describe_service = CKEDITOR.instances.ckeditor_service.getData();
       var image = document.getElementById("imageInput").files[0];
       // var describe_service = quill.root.innerHTML;
       // alert(price)
        if(image == null){

         $.NotificationApp.send("","Vui lòng chọn hình ảnh dịch vụ ","top-right","rgba(0,0,0,0.2)","error");

        }else if(name_ser == ""){

         $.NotificationApp.send("","Vui lòng nhập tên dịch vụ ","top-right","rgba(0,0,0,0.2)","error");

        }else if(price == "" || price == 0){

         $.NotificationApp.send("","Vui lòng nhập phí dịch vụ","top-right","rgba(0,0,0,0.2)","error");

        }else if(describe_service == ""){

         $.NotificationApp.send("","Vui lòng nhập mô tả chi tiết nội dung bài viết về lời khuyên y tế của bạn","top-right","rgba(0,0,0,0.2)","error");
       }else{
           save_create_orChange_service(0);
          
       }

   });

   $('.btn_save_change').on("click", function(){
       save_create_orChange_service(1)
   });
   $(document).on('click','.btn_save_change_default', function(){
 	   save_create_orChange_service(2);
  });

    function save_create_orChange_service(status){  
       var id_ser = $('.id_ser').val(); 
       var name_ser = $('.name_ser').val();
       var price = $('.price_create').val();
       var price_update = $('.price_update').val();
       var type_service = $('.type_service').find(":selected").val();
       var describe_service = CKEDITOR.instances.ckeditor_service.getData();
         var form_data = new FormData();
         form_data.append("id_ser",id_ser);
         form_data.append("name_ser",name_ser);
         form_data.append("price",price);  
         form_data.append("price_update",price_update);
         form_data.append("describe",describe_service);
         form_data.append("type_service",type_service);
         form_data.append("imageInput", document.getElementById("imageInput").files[0]);
         form_data.append("status",status);
            $.ajax({
            url:"{{url('/doctor/save_create_orChange_service')}}",
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

           $('.btn-close').click();
      		 $('#imageInput').val(''); 
			     $preview = $('.image-previews');
		    	 $preview.attr('src', '');
        	 $('.name_ser').val("");
           $('.price_create').val(0);
              CKEDITOR.instances.ckeditor_service.setData("");
             
              if(status == 0){
              	 $.NotificationApp.send("","Tạo ra dịch vụ y tế mới thành công","top-right","rgba(0,0,0,0.2)","success");
              }else if(status == 1){
                 $.NotificationApp.send("","Thay đổi dịch vụ y tế thành công","top-right","rgba(0,0,0,0.2)","success");
              }else{          
                  window.location.href = "{{URL::to('/doctor/service_doctor')}}"
              }
             
              load_service_doctor();

              
             }
         });
    }
  load_service_doctor();

   function load_service_doctor(){   
           var _token = $('input[name="_token"]').val();
           
            $.ajax({
                url : "{{url('/doctor/load_service_doctor')}}",
                method: 'GET',
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }, 
                data:{_token:_token},
                success:function(data){
                
                     $('.load_service_doctor').html(data); 
                 
                }
        });  
    }


  $(document).on('click','.btn_remove', function(){
    var id = $(this).closest(".card").find(".id_ser").val();
    var _token = $('input[name="_token"]').val();
    if(confirm("Do you want to remove this service ?")) {
          $.ajax({
          url:"{{url('/doctor/remove_service_doctor')}}",
          method:"GET",
          headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },

          data:{id:id,_token:_token},
            success:function(data){
               load_service_doctor(); 
            }
        });

     } 
   });
     
  $(document).on('click','.btn_change_default', function(){
  	
  	 $('.title_model').text("Thay đổi dịch vụ khám chữa bệnh của phòng khám");
 	   $('.row1').hide();
 	   $('.row2').hide();
     $('.row3').show();
 	   $('.btn_save_create').hide();
     $('.btn_save_change').hide();
     $('.btn_save_change_default').show();
     var des = $('.content_ser').html();
     var value_price_default = $('.value_price_default').val();
     $('.price_update').val(value_price_default);
     CKEDITOR.instances.ckeditor_service.setData(des);
  });

  $(document).on('click','.btn_create', function(){

  	 $('.title_model').text("Tạo mới Dịch vụ y tế của phòng khám");
     $('.row1').show();
     $('.row2').show();
     $('.row3').hide();
   	 $('.btn_save_change_default').hide();
     $('.btn_save_change').hide();
     $('.btn_save_create').show();

     $('.name_ser').val("");
     $('.price_create').val(0);
     CKEDITOR.instances.ckeditor_service.setData("");

   });
  $(document).on('click','.btn_update', function(){

  	 $('.title_model').text("Thay đổi dịch vụ khám chữa bệnh của phòng khám");
     $('.btn_save_change_default').hide();
     $('.btn_save_create').hide();
     $('.btn_save_change').show();

     var id_ser = $(this).closest(".card").find(".id_ser").val();
     var title = $(this).closest(".card").find(".title").val();
     var price = $(this).closest(".card").find(".price").val();
     var des = $(this).closest(".card").find(".des_ser").val();

     $('.change-image').click();
     $('.id_ser').val(id_ser);
	   $('.name_ser').val(title);
     $('.price_create').val(price);
     CKEDITOR.instances.ckeditor_service.setData(des);
     
   });




 });
</script>

<script src="{{asset('/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
 $(document).ready(function(){
  
      CKEDITOR.replace('ckeditor_service',{
      filebrowserImageUploadUrl : "{{ url('uploads_ckeditor?_token='.csrf_token()) }}",
      // filebrowserBrowseUrl : "{{ url('file-browser?_token='.csrf_token()) }}",
      filebrowserUploadMethod: 'form'

      });
  });
 </script>
<script type="text/javascript">
 $(document).ready(function(){
    
  $('#imageInput').on('change', function() {
    $input = $(this);
    if($input.val().length > 0) {
      fileReader = new FileReader();
      fileReader.onload = function (data) {
      $('.image-previews').attr('src', data.target.result);
      }
      fileReader.readAsDataURL($input.prop('files')[0]);
      $('.image-button').css('display', 'none');
      $('.image-previews').css('display', 'block');
      $('.change-image').css('display', 'block');
    }
  });
            
  $('.change-image').on('click', function() {
    $control = $(this);     
    $('#imageInput').val(''); 
    $preview = $('.image-previews');
    $preview.attr('src', '');
    $preview.css('display', 'none');
    $control.css('display', 'none');
    $('.image-button').css('display', 'block');
  });

 });
</script>


@endsection