@extends('DoctorLayout')
@section('contents_doctor')
<div class="card mt-2 p-2">
  <div class="row">
	<div class="col-lg-8 p-1">
		<input type="hidden" class="id_schedule" value="{{$schedule->id}}">
	    <input type="hidden" class="id_user" value="{{$schedule->id_user}}">
	    <input type="hidden" class="price_default" value="{{$schedule->user_doctor->company->price}}">
	  <span class="fs-5 fw-bold mt-1 border p-2">
	 	 Thời gian: <span class="text-danger ms-1 me-3">{{$schedule->time}}</span>|
	   <span class="text-primary ms-3">{{$schedule->date}}</span></span>
	   <span class="text-success fs-4 fw-bold mt-1 p-2">Bắt đầu chẩn đoán kết quả khám bệnh</span>
    <div class="p-3">
  	
 
	   <div class="row">
		   	<div class="form-floating">
		    <textarea class="form-control symptoms" placeholder="Leave a comment here" id="floatingTextarea" style="height: 70px;"></textarea>
		    <label class="ms-2" for="floatingTextarea">Triệu chứng và mô tả bệnh</label>
		    </div>
	   </div>

	    <div class="row mt-1">
		   	<div class="form-floating col-md-6">
		    <textarea class="form-control Initial" placeholder="Leave a comment here" id="floatingTextarea" style="height: 60px;"></textarea>
		    <label class="ms-2" for="floatingTextarea">Chẩn đoán ban đầu</label>
		    </div>

		   <div class="form-floating col-md-6">
		    <textarea class="form-control final" placeholder="Leave a comment here" id="floatingTextarea" style="height: 60px;"></textarea>
		    <label class="ms-2" for="floatingTextarea">Chẩn đoán cuối</label>
		    </div>
	   </div>

	   	<div class="row mt-1">
		   	<div class="form-floating">
		    <textarea class="form-control recommended" placeholder="Leave a comment here" id="floatingTextarea" style="height: 60px;"></textarea>
		    <label class="ms-2" for="floatingTextarea">Điều trị được đề xuất</label>
		    </div>
	   </div>	

	  <div class="row mt-1">
		   	<div class="form-floating col-md-12">
		    <textarea class="form-control prescription" placeholder="Leave a comment here" id="floatingTextarea" style="height: 60px;"></textarea>
		    <label class="ms-2" for="floatingTextarea">Đơn thuốc</label>
		    </div>

	   </div>

      <div class="row mt-1">
         <div class="form-floating col-md-12">
		    <textarea class="form-control advice" placeholder="Leave a comment here" id="floatingTextarea" style="height: 60px;"></textarea>
		    <label class="ms-2" for="floatingTextarea">Khuyên bảo</label>
		    </div>
	   </div>

	   <div class="row mt-1">
            <div class="col-md-4">
		      <label class="mb-1">Chi phí phát sinh:</label>
              <input type="text" class="form-control costs PriceInput" name="price" value="0" data-toggle="input-mask" 
              data-mask-format="000.000.000.000.000" 
              data-reverse="true" maxlength="11" required>
		    </div>

		     <div class="col-md-3">
		     	
		     </div>

		     <div class="col-md-5">
		     	<label class="mt-1">Thời gian tái khám:</label>
                <button class="btn btn-lg font-14 btn-danger mt-1 btn_re_book" data-bs-toggle="modal" data-bs-target="#primary-header-modal">
             	<i class="mdi mdi-plus-circle-outline"></i>Schedule a follow-up appointment</button>

             	<div class="div_date_time_re_book p-1 border mt-1">
                   <div class="row">
             	   <span class="time_span text-danger fs-5 fw-bold col-md-6 text-center border-end">0</span>
             	   <span class="date_span text-success fs-5 fw-bold col-md-6 text-center">0</span>
                   </div>
                   <div class="d-flex justify-content-center">
                   	 <label class="badge bg-info mt-1" 
             		data-bs-toggle="modal" data-bs-target="#primary-header-modal">Thay Đổi</label>
                   </div>
    			  
             	</div>
		    </div>
	   </div>

	   <div class="row mt-2 border-top">	  
	   	<ul class="nav nav-tabs nav-justified nav-bordered mb-3">

		    <li class="nav-item tab1">
		        <a href="#profile-b2" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
		            <i class="mdi mdi-account-circle d-md-none d-block"></i>
		            <span class="d-none d-md-block">Hình ảnh X-Quang</span>
		        </a>
		    </li>
		    <li class="nav-item tab2">
		        <a href="#settings-b2" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
		            <i class="mdi mdi-settings-outline d-md-none d-block"></i>
		            <span class="d-none d-md-block">File Kết quả</span>
		        </a>
		    </li>
		</ul>

		<div class="tab-content">

		    <div class="tab-pane show active " id="profile-b2">
		     <div class="row border-bottom pb-2">
		     	<div class="d-flex align-items-center justify-content-center">
	                <input type="file" accept="image/*" id="imageInput">                
	                <label for="imageInput" class="image-button btn btn-outline-primary">
	                <i class='bx bxs-user-circle'></i> Choose hình ảnh</label>
	                <img src="" class="image-preview img-fluid img-thumbnail rounded-circle" >   
	             </div>
	              <div class="row mt-2">
			         <table class="table table-bordered border-primary table-centered mb-0">
					    <thead>
					        <tr>
					           <th>STT</th>
                      <th>Hình ảnh</th>
                      <th>Tên</th>
                      <th>Ngày tạo</th>
                      <th></th>
					        </tr>
					    </thead>
					    <tbody class="load_image">
					    </tbody>
					</table>
		         </div>

		     </div>
		      
		    </div>
		    <div class="tab-pane" id="settings-b2">
		    	  <div class="row border-bottom p-2">
		     	  <input type="file" id="example-fileinput" class="form-control">
		         </div>
		         <table class="table table-bordered border-primary table-centered mb-0">
				    <thead>
				        <tr>
				           <th>STT</th>
                    <th>Tên File</th>
                    <th>Ngày tạo</th>
                    <th></th>
				        </tr>
				    </thead>
				    <tbody class="load_file">
				    </tbody>
				</table>
		         
		  
		    </div>
		</div>
	   </div>




     </div>

  </div>
		
     <div class="col-lg-4 p-1 border-start">
     	      <div class="row">
     	     	    <div class="col-md-8 ">
                        <h5 class="mt-1 mb-0 w-100 d-flex justify-content-end">{{$schedule->user_patient->name}}</h5>
                        <p class="mb-1 mt-1 text-muted w-100 d-flex justify-content-end ">{{$schedule->user_patient->email}}</p>
                    </div>
                    <div class="col-md-4">
                     @if ($schedule->user_patient->patient->avt_user == 0)
                      <img  src="{{asset('/Image/avt_user.png')}}" alt="user-image"  class="ms-2 avatar-md"  height="50">
                      @else
              
                      <img class="ms-2 avatar-md" 
                      src="{{asset('/Image/avt_user/'.$schedule->user_patient->id.'/'.$schedule->user_patient->patient->avt_user)}}" alt="Soeng Souy" height="50">
                      @endif
                    </div>
                    
             
                </div>
             
                 <div class="text-start border-top border-bottom">
                     <div class="p-1">
                       <p class="text-muted"><strong>Chiều cao:</strong><span class="ms-2 me-4">{{$schedule->user_patient->patient->height}}(Cm)</span>
                       <strong>Cân nặng:</strong> <span class="ms-2">{{$schedule->user_patient->patient->weight}}(Kg)</span> </p>

                       <p class="text-muted"><strong>Blood group:</strong><span class="ms-2 me-2"> {{$schedule->user_patient->patient->blood_group}}</span> <strong>Ngày sinh :</strong> <span class="ms-2">{{$schedule->user_patient->patient->birth_day}}</span></p>

                      <p class="text-muted"><strong>SDT :</strong> <span class="ms-2 me-4">{{$schedule->user_patient->patient->number_phone}}</span>
                       <strong>Tuổi :</strong> <span class="ms-2">{{$schedule->user_patient->patient->age}}</span></p>

                       <p class="text-muted"><strong>Đia chỉ :</strong> <span class="ms-2 me-4">
                       	{{$schedule->user_patient->patient->details_address}}, {{$schedule->user_patient->patient->address}}</span></p>
                     </div>

                </div>

               <div class="text-start border-top border-bottom">
                     <div class="p-1">
                       <p class="text-muted"><strong>Lý Do:</strong><br>
                       	<span class="ms-2 me-4">{{$schedule->reason}}</span>
                       </p>


                       <p class="text-muted"><strong>Ghi Chú:</strong><br>
                       	<span class="ms-2 me-4">{{$schedule->note}}</span>
                       </p>

                      @if($schedule->service != 0)
                         <p class="text-muted"><strong>Dịch vụ:</strong> 
                        <span class="ms-2 me-4">{{$schedule->service_doctor->name}}</span></p>
                       @endif
                     
                      <p class="text-muted"><strong>Bảo hiểm:</strong> 
                      	<span class="ms-2 me-4">{{$schedule->insurance}}</span></p>
                     </div>
               
                    
                       @if($schedule->service != 0)
                         <h4 class="header-title mt-1 border-top pt-2">Chi phí khám bệnh (Dịch vụ): 
                       <span class="text-success me-3">{{$schedule->service_doctor->price}}.VND</span> </h4>
                       @else
                         <h4 class="header-title mt-1 border-top pt-2">>Chi phí khám bệnh (Mặt định): 
			                <span class="text-success me-3">{{$schedule->user_doctor->company->price}}.VND</span>  </h4>
                       @endif
                  

                </div>

	           <div class="d-flex justify-content-center">
	           	 <button class=" btn btn-lg font-14 btn-primary mt-3" 
	                id="save_result_examnination">Lưu kết quả khám bệnh</button>
	           </div>
                   
           

	    </div>

     </div>
	</div>
</div>


<!--------------------------------------- modal load date time  --------------------------------->

<div id="primary-header-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title" id="primary-header-modalLabel">Đặt lịch hẹn tái khám</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body ">
              <div class="row mt-2">
              	<div class="col-sm-2 "></div>
				<div class="col-sm-8 ">
				<select class="d-flex justify-content-center form-select text-primary fw-bold" id="dateDropdown"></select>
				</div>
		      </div>
	          <div class="row mt-1 border-top">
	            <div class="col-sm-1"></div>
                <div class="col-sm-10 ps-3">
                	<a class="text-danger fw-bold mt-1" > <i class="dripicons-calendar me-1"></i>Time</a>
                	<div class="button-list mt-1" id="load_time">

			         </div>
		        
                </div>
                  
	           
	          </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">DÓNG</button>
              <!--   <button type="button" class="btn btn-primary">Accept Booking</button> -->
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript"></script>



<script type="text/javascript">
$(document).ready(function(){

  const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 1500,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        })
 ////////////////////////////// save result /////////////////////////////////
  $('#save_result_examnination').on('click', function() {
     if($('.symptoms').val() == "" ){

      $.NotificationApp.send("","Vui lòng nhập Triệu chứng và mô tả bệnh","top-right","rgba(0,0,0,0.2)","error") 

    }else if($('.Initial').val() == ""  || $('.diagnosis').val() == ""){

      $.NotificationApp.send("","Vui lòng nhập Chẩn đoán ban đầu và Chẩn đoán cuối cùng","top-right","rgba(0,0,0,0.2)","error") 

    }else if($('.recommended').val() == ""){

      $.NotificationApp.send("","Vui lòng nhập Điều trị đề xuất","top-right","rgba(0,0,0,0.2)","error") 

    }else if($('.prescription').val() == "" || $('.advice').val() == ""){

      $.NotificationApp.send("","Vui lòng nhập đơn thuốc và tư vấn","top-right","rgba(0,0,0,0.2)","error") 

    }else{

      save_result_examnination();
    
    }
 });

    function save_result_examnination() {
        var symptoms = $('.symptoms').val();
        var Initial = $('.Initial').val();
        var final = $('.final').val();
        var recommended = $('.recommended').val();
        var prescription = $('.prescription').val();
        var advice = $('.advice').val();  
        var costs = $('.costs').val();
        var price_default = $('.price_default').val();

        var time_span = $('.time_span').text();
        var date_span = $('.date_span').text();

        var id_schedule = $('.id_schedule').val();

        var _token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{url('/doctor/save_result_examnination')}}",
            method:"POST",
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{symptoms:symptoms,Initial:Initial,
           	final:final,recommended:recommended,
           	prescription:prescription,advice:advice,
           	costs:costs,price_default:price_default,
           	time_span:time_span,date_span:date_span,
           	id_schedule:id_schedule,token:_token},
            success:function(data){ 

            	 Swal.fire({
	                    icon: 'success',
	                    title: "<h3 style='color:#00FF00'>Lưu kết quả thành công</h3>",
	                    width: 300,
	                    showConfirmButton: false,
	                    timer: 1200
	                  });

	            	 $(this).delay(1200).queue(function(){
	                  window.location.href = "{{URL::to('/doctor/schedule_doctor')}}"
	                });
              
            }

        }); 

    }













//////////////////////////////////// upload file /////////////////////////////

$('#imageInput').on('change', function() {
    $input = $(this);
    if($input.val().length > 0) {
      fileReader = new FileReader();
      fileReader.onload = function (data) {
      $('.image-preview').attr('src', data.target.result);
      }
      fileReader.readAsDataURL($input.prop('files')[0]);
      upload_file(0);
    }
 });
$('#example-fileinput').on('change', function() {
     upload_file(1);
 });

 function upload_file(type) {
 	var id_schedule = $('.id_schedule').val();
    var id_user = $('.id_user').val();
    if(type==0){
         var form_data = new FormData();
         form_data.append("id_schedule",id_schedule);
         form_data.append("id_user",id_user);
         form_data.append("type",type);
         form_data.append("file", document.getElementById("imageInput").files[0]);
    }else{
         var form_data = new FormData();
         form_data.append("id_schedule",id_schedule);
         form_data.append("id_user",id_user);
         form_data.append("type",type);
         form_data.append("file", document.getElementById("example-fileinput").files[0]);
    }
 
        $.ajax({
            url:"{{url('/doctor/upload_file_result')}}",
            method:"POST",
            headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },  
             data:form_data,
             contentType:false,
             cache:false,
             processData:false,
             success:function(data){ 
	         	if(type == 0){
	         		 Swal.fire({
	                    icon: 'success',
	                    title: "<h3 style='color:#00FF00'>Tải lên thành công</h3>",
	                    width: 300,
	                    showConfirmButton: false,
	                    timer: 1200
	                  });
	         		load_file_result(0)
	         		$('.image-preview').attr('src','');
	         	}else{
	         		 Swal.fire({
	                    icon: 'success',
	                    title: "<h3 style='color:#00FF00'>Tải lên thành công</h3>",
	                    width: 300,
	                    showConfirmButton: false,
	                    timer: 1200
	                  });
	         		load_file_result(1)
	         		$('#example-fileinput').val("");
	         	}
	         }
       });

 }
$('.tab2').on('click', function() {
   load_file_result(1);
 });

load_file_result(0);

  function load_file_result(type) {
    var id_schedule = $('.id_schedule').val();
    var id_user = $('.id_user').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{url('/doctor/load_file_result')}}",
            method:"GET",
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
           data:{id_schedule:id_schedule,id_user:id_user,
           	type:type, _token:_token},
            success:function(data){
              if(type == 0){
                 $('.load_image').html(data);  
              }else{
                 $('.load_file').html(data);  
              }
           }
 
        }); 

    }

 $(document).on('click','.btn_remove_item',function(){
       var id = $(this).closest("tr").find(".id_f").val();
       var id_user = $('.id_user').val();
       var _token = $('input[name="_token"]').val();
        if(confirm("Do you want to remove file this ?")) {
             $.ajax({
                url:"{{url('/doctor/remove_item_file')}}",
                method:"GET",
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                 data: {id:id,id_user:id_user, _token:_token},
                success:function(data){
                  load_file_result(0);
                  load_file_result(1);
                }

            }); 

        }       
});


////////////////////////////////////////////////////

$('.div_date_time_re_book').hide();
$('.btn_re_book').show();

$(document).on('change','#dateDropdown',function(){
	 load_time();
});

$(document).on('click','.btn_choose_times',function(){
     var time = $(this).data('time');
     var date = $('#dateDropdown').find(":selected").val();
     $('.time_span').text(time);
     $('.date_span').text(date);
     $('.div_date_time_re_book').show();
     $('.btn_re_book').hide();

     $('.btn-close').click();

});



//////////////////////////////////////////////////
 load_date();
  function load_date() {
    var date = $('#dateDropdown').find(":selected").val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{url('/doctor/load_date')}}",
            method:"GET",
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
           data:{date:date, _token:_token},
            success:function(data){
               // $('#load_time').html(data);  
                 $('#dateDropdown').html(data);  

                        
            }

        }); 

    }

  $(document).on('change','#dateDropdown',function(){
	 load_time();
  });
  load_time();
  function load_time() {
    var date = $('#dateDropdown').find(":selected").val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{url('/doctor/load_time')}}",
            method:"GET",
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
           data:{date:date, _token:_token},
            success:function(data){
               $('#load_time').html(data);  
                        
            }

        }); 

    }




//////////////////////////
 });

</script>

@endsection