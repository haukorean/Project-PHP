@extends('UserLayout')
@section('contents_user')
<div class="card p-3 mt-1">
<div class="row">
	<div class="col-lg-2">
	    <img class="avatar-xl rounded-circle ms-3"
	     src="{{url('/Image/avt_user/'.$info_doctor->id.'/'.$info_doctor->doctor->avt_user)}}"
	     alt="Generic placeholder image">
	</div>
	<div class="col-lg-6">
		<input type="hidden" class="id_doctor" value="{{$info_doctor->id}}" p>
        <h2 class="mt-2">Bác Sĩ Chuyên Khoa || {{$info_doctor->name}}</h2>
               {{$info_doctor->company->about_us}}.
	</div>
	
</div>
  @if($info_doctor->company->status == 1)
	<div class="row mt-2">
		<div class="col-sm-3">
		<select class="form-select text-primary fw-bold" id="dateDropdown"></select>
		</div>
	</div>
  @endif


	<div class="row">
   @if($info_doctor->company->status == 1)
      <div class="col-lg-6 mt-1 border-end  border-top">
        <a class="text-danger fw-bold mt-1" > <i class="dripicons-calendar me-1"></i>TIME</a>

          <div class="button-list mt-1" id="load_time">

          </div>
      </div>
    @else
      <div class="col-lg-6 mt-1 border-end border-top">
       <h3 class="text-danger fw-bold mt-3 justify-content-center">Phòng khám tạm thời đóng cửa !
​</h3>
      </div>

    @endif


		<div class="col-lg-6 mt-1">
        <div class="pb-1">
  		    <h4 class="text-danger fw-bold mt-1">ĐỊA CHỈ PHÒNG KHÁM:</h4>
  		    <span class="fw-bold">{{$info_doctor->company->company_name}}</span><br>
          <span class="text-primary"><i class="dripicons-location"></i> {{$info_doctor->company->company_address}}</span>
        </div>

        <div class="mt-1 pb-1 row_ser">
           <span class="fw-bold mb-1">Các loại dịch vụ khác:</span>
            <div class="load_service_doctor">
             @foreach($all_ser as $ser)
               <div class="border p-1 item_ser">
                  <div class="form-check ">
                    <input type="radio" id="customRadio1" name="customRadio" class="form-check-input" value="{{$ser->id}}">
                    <label class="form-check-label" for="customRadio1">{{$ser->name}}</label>
                    <span class="form-check-label float-end">        
                    <span class="badge badge-success-lighten"> {{$ser->price}}.VND</span>
                    <span class="ms-1 action-icon btn_show_modal_ser" data-bs-toggle="modal" data-bs-target="#fill-info-modal">
                     <i class="mdi mdi-eye"></i></span> </span>
                  </div>

                  <div class="content_ser" style="display: none">
                        <div class="row">
                            <div class="col-md-3">
                               <img src="{{url('/Image/Image_service/'.$info_doctor->id.'/'.$ser->image)}}" alt="" height="100"> 
                            </div>
                            <div class="col-md-9">
                              <h5 class="fw-bold mt-1">{{$ser->name}}</h5>
                                <span class="fw-bold">{{$ser->service_medical->name}}</span><br>
                                <h5 class="header-title mt-1 border-top pt-2">Giá khám (Mặc định): 
                                  <span>{{$ser->price}}.VND</span></h5>
                            </div>
                          </div>
                           <div class="row p-2 border-top mt-1">
                            {!!$ser->describe!!} 
                          </div>             
                  </div>


              </div>


              @endforeach

           </div>
           
        </div> 

        
		    <h4 class="header-title mt-1 border-top pt-2">Giá khám (Mặc định): 
          <span class="text-success me-3">{{$info_doctor->company->price}}.VND</span> </h4>  
           <span class="text-danger fw-bold">Xem dịch vụ
          <span class="ms-1 action-icon"> <i class="mdi mdi-eye btn_show_ser"></i> <i class="mdi mdi-eye-off btn_hide_ser"></i></span></span>
		</div>


	</div>

	<hr>
	<div class="row p-3">

		{!!$info_doctor->company->service!!}
		
	</div>
	
</div>


<!======================================= modal infor ------------------------------------------ -->
<div id="fill-info-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fill-info-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-filled bg-info">
            <div class="modal-header">
                <h4 class="modal-title" id="fill-info-modalLabel">Chi tiết Dịch vụ</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body content_ser_modal">
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">ĐÓNG</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

  

<!======================================= modal boooking ------------------------------------------ -->

<div id="fill-primary-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fill-primary-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-top modal-dialog-scrollable" data-simplebar style="height: 100%">
        <div class="modal-content modal-filled bg-primary" >
	    <form  accept-charset="utf-8" id="myform">
        
            <div class="modal-header">
                <h4 class="modal-title" id="fill-primary-modalLabel">Thông tin lịch hẹn</h4>
                <button type="button" class="btn-close close_btn" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
                <h5 for="example-textarea" class="form-label text-center">{{$info_doctor->name}}</h5>
                <h6 class="time_book text-center"></h6>

            <div class="p-1">
                        <input type="hidden" class="time_book" name="time_book" value="">
                        <input type="hidden" class="id_doctor_modal" name="id_doctor_modal" value="{{$info_doctor->id}}">
                        <input type="hidden" class="date_book" name="date_book" value="">
        

	              <div class="">
	                <label for="example-textarea" class="form-label">Lý do khám bệnh</label>
	                <textarea name="reason" class="form-control reason" id="example-textarea" rows="2" placeholder="Plaese enter season for medical examination"></textarea>
	              </div>


	               <div class="mt-1">
	                <label for="example-textarea" class="form-label">Ghi chú của bệnh nhân</label>
	                <textarea class="form-control note" name="note" id="example-textarea" rows="1" placeholder="Patient notes"></textarea>
	              </div>

	              <div class="mt-1 form-check form-checkbox-danger">
	                <input type="checkbox" class="form-check-input checkbox_insu" id="customCheckcolor1">
	                <label class="form-check-label" for="customCheckcolor1">Bạn có sử dụng bảo hiểm (tư nhân)?</label>
	              </div>
	               <div class="mt-1 div_insurance">
	                <label for="example-textarea" class="form-label">Nhập công ty bảo hiểm của bạn</label>
	                <textarea class="form-control insurance" name="insurance" id="example-textarea" placeholder="Please enter your insurance company" rows="1" ></textarea>
	              </div>

                  <label for="example-textarea" class="form-label">Thanh toán sau tại cơ sở y tế</label>
	              <div class="row border border-primary p-1" style="background: #646464">
	           
	                <div class="row">  
		                <div class="col-lg-12">
			                 <span class="float-start">Giá khám:</span>
			                 <span class="float-end" > {{$info_doctor->company->price}}.VND</span>
		                </div>
	                </div>  

	                 <div class="row">  
		                <div class="col-lg-12">
			                 <span class="float-start">Phí đặt lịch:</span>
			                 <span class="float-end" > Miễn phí</span>
		                </div>
	                </div>

	                <hr>

	                <div class="row">  
		                <div class="col-lg-12">
			                 <span class="float-start">Giá:</span>
			                 <span class="float-end"> {{$info_doctor->company->price}}.VND</span>
		                </div>
	                </div>

	              </div>

                  <div class="row border border-primary p-1" style="background: #00008B">
	           
	                <div class="row">  
	                	<h4>Note</h4>
	                	<span class="">Thông tin bạn cung cấp sẽ được sử dụng làm hồ sơ bệnh án. Khi điền thông tin, vui lòng:</span>
	                	<span class=""> - Cập nhật chính xác thông tin cá nhân trong hồ sơ tài khoản của bạn</span>
                    <span class=""> - Xem xét và điền đầy đủ các thông tin liên quan đến việc khám bệnh tại cơ sở y tế</span>
		            
	                </div>

	              </div>

             </div>

        

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">ĐÓNG</button>
                <button type="button" class="btn btn-outline-light btn_acept_book">XÁC NHẬN</button>
            </div>

       </form>


        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
 $(document).ready(function(){
  
 $('.row_ser').hide();
 $('.btn_hide_ser').hide();
 $('.btn_show_ser').show();
   $('.btn_show_ser').on("click", function(){
      $('.row_ser').fadeIn();
      $('.btn_hide_ser').show();
      $('.btn_show_ser').hide();
   });

   $('.btn_hide_ser').on("click", function(){
      $('.row_ser').fadeOut();
      $('.btn_hide_ser').hide();
      $('.btn_show_ser').show();
   });

  $(document).on('click','.btn_show_modal_ser',function(){
     var content = $(this).closest(".item_ser").find(".content_ser").html();  
     $('.content_ser_modal').html(content);
   });
   

 });
</script>
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

  $('.btn_acept_book').on("click", function(){
     var reason = $('.reason').val();
     if(reason == ""){
       $.NotificationApp.send("","Vui lòng nhập lý do","top-right","rgba(0,0,0,0.2)","error");

     }else{

        save_booking();
     }
   });

 function save_booking() {
    var time_book = $('.time_book').val();
    var id_doctor_modal = $('.id_doctor_modal').val();
    var date_book = $('.date_book').val();
    var reason = $('.reason').val();
    var insurance = $('.insurance').val();
    var note = $('.note').val();

    var type = 0;
    if ($('input[name=customRadio]:checked').length > 0) {
    // Có radio nào đó đã được chọn
    var service = $('input[name=customRadio]:checked').val();
    } else {
    var service = 0;
    }
      
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{url('/user/accept_booking')}}",
            method:"POST",
            dataType:"JSON",
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
           data:{time_book:time_book,
           	id_doctor_modal:id_doctor_modal,
           	date_book:date_book,
           	reason:reason,
           	insurance:insurance,
           	type:type,
           	service:service,
            note:note, _token:_token},
            success:function(res){
      
	        	if(res.status == 0){
	        		
	        		Swal.fire({
	                    icon: 'error',
	                    title: "<h3 style='color:#DC143C'>Đặt lịch không thành công</h3>",
	                    text: "Xin lỗi, vui lòng chọn cuộc hẹn khác!",
	                    width: 500,
	                    showConfirmButton: false,
	                    timer: 1200
	                  });
		            load_time(); 
			        $('.reason').val("");
				    $('.insurance').val("");
				    $('.note').val("");
				   $('.close_btn').click(); 

	        	}else{

		           Swal.fire({
	                    icon: 'success',
	                    title: "<h3 style='color:#00FF00'>Đặt lịch thành công</h3>",
	                    width: 300,
	                    showConfirmButton: false,
	                    timer: 1200
	                  });
		           load_time(); 
			        $('.reason').val("");
				    $('.insurance').val("");
				    $('.note').val("");
				    $('.close_btn').click(); 
	        	}
              
            }

        }); 

    }


 $('.div_insurance').hide();
 $('.checkbox_insu').click(function(){
    if($(this).is(':checked')){
       $('.div_insurance').show();
    } else {
       $('.div_insurance').hide();
    }
});


//////////////////////////////////////////////////////////////////////

  load_date();
  function load_date() {
    var date = $('#dateDropdown').find(":selected").val();
    var id_doctor = $('.id_doctor').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{url('/user/load_date')}}",
            method:"GET",
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
           data:{id_doctor:id_doctor,date:date, _token:_token},
            success:function(data){
               // $('#load_time').html(data);  
                 $('#dateDropdown').html(data);  
                 $('#dateDropdown option:first').prop('selected', true);
    
                  load_time();
            }

        }); 

    } 


  $(document).on('change','#dateDropdown',function(){
	   load_time();
  });



  function load_time() {
     var date = $('#dateDropdown').find(":selected").val();
        var id_doctor = $('.id_doctor').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{url('/user/load_time')}}",
            method:"GET",
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
           data:{id_doctor:id_doctor,date:date, _token:_token},
            success:function(data){
               $('#load_time').html(data);              
            }

        }); 
  }
  $(document).on('click','.btn-outline-primary',function(){
         var time = $(this).data('time');
         var date = $('#dateDropdown').find(":selected").val();
         $('.time_book').val(time);
         $('.date_book').val(date);
         $('.time_book').html(date+`  |  `+ time);    
  });


});
</script>
@endsection