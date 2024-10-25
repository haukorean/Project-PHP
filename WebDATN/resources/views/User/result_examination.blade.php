@extends('UserLayout')
@section('contents_user')
<div class="card mt-2 p-2">
  <div class="row">

	<div class="col-lg-8 p-1">
		<input type="hidden" class="id_schedule" value="{{$result->schedule->id}}">
		<input type="hidden" class="id_result" value="{{$result->id}}">
	    <input type="hidden" class="id_user" value="{{$result->schedule->id_user}}">
	    <input type="hidden" class="price_default" value="{{$result->schedule->user_doctor->company->price}}">
	  <span class="fs-5 fw-bold mt-1 border p-2">
	 	Thời gian: <span class="text-danger ms-1 me-3">{{$result->schedule->time}}</span>|
	   <span class="text-primary ms-3">{{$result->schedule->date}}</span></span>
	   <span class="text-success fs-4 fw-bold mt-1 p-2">Kết quả kiểm tra</span>
    <div class="p-3">
  	
 
	   <div class="row">
		   	<div class="p-2 border">
		    <label class="ms-2 text-primary">Triệu chứng và mô tả bệnh</label>
		     <div>
		     	{{$result->symptom_describe}}
		     </div>
		    </div>
	   </div>

	    <div class="row mt-1">
		   	<div class="col-md-6 p-2 border">    
		    <label class="ms-2 text-primary">Chẩn đoán ban đầu</label>
		       <div>
		     	{{$result->initial_diagnosis}}
		     </div>
		    </div>

		   <div class="col-md-6 p-2 border">    
		    <label class="ms-2 text-primary">Chẩn đoán cuối</label>
		       <div>
		     	{{$result->final_diagnosis}}
		     </div>
		    </div>
	   </div>

	   	<div class="row mt-1">
		   	<div class="p-2 border">
		    <label class="ms-2 text-primary">Điều trị được đề xuất</label>
		       <div>
		     	{{$result->recommended_treatment}}
		     </div>s
		    </div>
	   </div>	

	  <div class="row mt-1">
		   <div class="p-2 border">
		    <label class="ms-2 text-primary">Đơn thuốc</label>
		       <div>
		     	{{$result->prescription}}
		     </div>
		    </div>

	   </div>

      <div class="row mt-1">
         <div class="p-2 border">
		    <label class="ms-2 text-primary">Lời Khuyên</label>
		     <div>
		     	{{$result->advice}}
		     </div>
		    </div>
	   </div>

	   <div class="row mt-1">
            <div class="col-md-3 ">
		       <label class="mt-1 text-primary">Chi phí phát sinh:</label>
	              <div class="border pt-2">
			     	<p class="text-center">{{$result->costs_incurred}}</p>
			     </div>
		    </div>
           
           @if($result->re_examination_schedule != 0)
		     <div class="col-md-5">
		     	<label class="mt-1 text-primary">Thời gian tái khám:</label>
             
             	<div class="div_date_time_re_book p-1 border mt-1">
                   <div class="row">
             	   <span class="time_span text-danger fs-5 fw-bold col-md-6 text-center border-end">{{$result->re_schedule->time}}</span>
             	   <span class="date_span text-success fs-5 fw-bold col-md-6 text-center">{{$result->re_schedule->date}}</span>
                   </div>
             	</div>
		    </div>
		    @endif
	   </div>

	   <div class="row mt-2 border-top">	  
	   	<ul class="nav nav-tabs nav-justified nav-bordered mb-3">

		    <li class="nav-item tab1">
		        <a href="#profile-b2" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
		            <i class="mdi mdi-account-circle d-md-none d-block"></i>
		            <span class="d-none d-md-block">Hình Ảnh X-Quang</span>
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
     	      	    <div class="col-md-4">
                     @if ($result->schedule->user_doctor->doctor->avt_user == 0)
                      <img  src="{{asset('/Image/avt_user.png')}}" alt="user-image"  class="ms-2 avatar-md"  height="50">
                      @else
              
                      <img class="ms-2 avatar-md" 
                      src="{{asset('/Image/avt_user/'.$result->schedule->user_doctor->id.'/'.$result->schedule->user_doctor->doctor->avt_user)}}" alt="Soeng Souy" height="50">
                      @endif
                    </div>

     	     	    <div class="col-md-8 ">
                        <h5 class="mt-1 mb-0 w-100 d-flex justify-content-start">{{$result->schedule->user_doctor->name}}</h5>
                        <p class="mb-1 mt-1 text-muted w-100 d-flex justify-content-start ">{{$result->schedule->user_patient->email}}</p>
                    </div>
                
                    
             
                </div>
             
                 <div class="text-start border-top border-bottom">
                     <div class="p-1">
                       <p class="text-muted"><strong>Kinh nghiệm hành Y:</strong><span class="ms-2 me-4">
                       	{{$result->schedule->user_doctor->doctor->work_experience}} (năm)</span></p>



                      <p class="text-muted"><strong>SDT :</strong> <span class="ms-2 me-4">{{$result->schedule->user_doctor->doctor->number_phone}}</span>
                       <strong>Tuổi :</strong> <span class="ms-2">{{$result->schedule->user_patient->patient->age}}</span></p>

                       <p class="text-muted"><strong>Địa chỉ :</strong> <span class="ms-2 me-4">
                       	{{$result->schedule->user_doctor->doctor->details_address}}, {{$result->schedule->user_doctor->doctor->address}}</span></p>
                     </div>

                </div>

               <div class="text-start border-top border-bottom">
                     <div class="p-1">
                       <p class="text-muted"><strong>Lý do:</strong><br>
                       	<span class="ms-2 me-4">{{$result->schedule->reason}}</span>
                       </p>


                       <p class="text-muted"><strong>Ghi Chú:</strong><br>
                       	<span class="ms-2 me-4">{{$result->schedule->note}}</span>
                       </p>


                     
                       @if($result->schedule->service != 0)
                        <p class="text-muted"><strong>Dịch Vụ:</strong> 
                       <span class="ms-2 me-4">{{$result->schedule->service_doctor->name}}</span></p>
                       @endif
                      	
                      <p class="text-muted"><strong>Bảo Hiểm:</strong> 
                      	<span class="ms-2 me-4">{{$result->schedule->insurance}}</span></p>
                     </div>
               
                      <h4 class="header-title mt-1 border-top pt-2">Giá Khám: 
			          <span class="text-success me-3">{{$result->schedule->user_doctor->company->price}}.VND</span></h4>

                </div>


             <div class="d-flex justify-content-center">
	           	 <a class=" btn btn-lg font-14 btn-primary mt-3" 
	               href="{{url('/user/history_medical_doctor')}}">Trở lại</a>
	           </div>

	    </div>



	</div>
</div>


<script type="text/javascript">
$(document).ready(function(){	

  ////////////////////////////////////////////////////////
$('.tab2').on('click', function() {
   load_file_result(1);
 });

load_file_result(0);

  function load_file_result(type) {
    var id_result = $('.id_result').val();
    var id_user = $('.id_user').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{url('/user/load_file_result_examination')}}",
            method:"GET",
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
           data:{id_result:id_result,id_user:id_user,
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


});

</script>



@endsection