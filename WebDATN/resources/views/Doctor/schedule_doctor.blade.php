@extends('DoctorLayout')
@section('contents_doctor')

 <div class="card p-3 mt-2">
 	<h4 class="header-title">Lịch trình gần đây của bạn</h4>
 	<div class="row">
 		<div class="col-lg-12">
 	  <button class="Year btn btn-primary float-end ms-2"></button>
	 	<div class="btn-group col-sm-2 float-end">
	 		<button class="fc-prev-button btn btn-primary" type="button">Prev</button>
	 		<button class="fc-next-button btn btn-primary" type="button">Next</button>
	 		
	 	</div>
 
	 	
      </div>
 	</div>
     <div class="row mt-1">
     	<h4 class="header-title date_today ms-2"></h4>
        <div class="col-sm-2 border-end">
     	<div class="border p-1 text-center"><a class="text-primary fw-bold">Hôm nay</a></div>
     	<input type="hidden" class="day_now" value="">
	    <div class="d-grid" id="load_schedule_today">
	   

        </div>
     	</div>

         <div class="col-lg-10 border-top">
         	<div class="row" id="calendar_schedule">

         		
         	</div>

         </div>
     
    </div>

 </div>





<div id="top-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-info">
                <h4 class="modal-title" id="info-header-modalLabel"> Thông tin lịch hẹn</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
               <input type="hidden" class="id_schedule" value="">
               <div class="row">
               <h4 class="font-13 text-uppercase">Bệnh nhân
                <span class="text-muted font-35 float-end" id="status_schedule"></h4>
                <div class="col-lg-4">
                    <span id="image_user" class="text-center">
                  
                    </span>
                     <h4 class="mb-0 mt-2" id="nickname"></h4>
                     <span class="text-muted font-10" id="email_user" style="overflow-wrap: break-word;"></span>
              <!--        <button class="btn btn-primary btn-sm mt-1"><i class="uil uil-envelope-add me-1"></i>Chat</button>       -->
                                  
                </div>
                <div class="col-lg-8">
                    <p class="text-muted mb-2 font-13">
                      <strong>Chiều cao:</strong><span class="ms-2" id="height"> </span>
                      <strong>Cân nặng:</strong><span class="ms-2" id="weight"> </span>    
                    </p>
                     <strong>Nhóm máu:</strong><span class="ms-2" id="blood"></span>

                    <p class="text-muted mb-2 font-14"><strong>SDT:</strong><span class="ms-2" id="phone_user"></span></p>
                    <p class="text-muted mb-2 font-14">
                      <strong>Tuổi:</strong> <span class="ms-2" id="age"></span>
                      <strong>Giớ tính :</strong> <span class="ms-2" id="sex_user"></span>
                    </p>
                     <p class="text-muted mb-2 font-14"><strong>Địa chỉ :</strong><span class="ms-2" id="address"></span></p>
                
                </div>
             </div>
             <hr>
             <div class="row">
            <p class="text-muted mb-2 font-16">
              <strong>Thời gian:</strong><span class="ms-2" id="time"></span>
              <strong class="ms-5">Ngày:</strong><span class="ms-2" id="date"></span>
            </p>
             <p class="text-muted mb-2 font-16"><strong>Lý do :</strong><span class="ms-2" id="reason"></span></p>
             <p class="text-muted mb-2 font-16"><strong>Ghi chú:</strong> <span class="ms-2" id="note"></span></p>
             <p class="text-muted mb-2 font-16"><strong>Bảo hiểm:</strong> <span class="ms-2" id="insurance"></span></p>
             <p class="text-muted mb-2 font-16"><strong>Dịch vụ:</strong> <span class="ms-2" id="package"></span></p>
         


             </div>

              
            </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-light" data-bs-dismiss="modal" id="close_modal">Đóng</button>

                <span  id="span_btn_click_accept">
                   
                </span>
             
           
      
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
 $(document).ready(function(){



 // $(document).on('click','.start_medical',function(){
 //     var id = $('.id_schedule').val();
 //    window.location.href = "{{url('/doctor/start_medical_examination')}}"+"/"+id;
 //  });


////////////////////////////////////////////////////////////////////////


  $(document).on('click','.btn_view_schudule',function(){
     var id = $(this).data('id_schedule');
     $('.id_schedule').val(id);
     
     view_schedule_doctor(id);
  });

    function view_schedule_doctor(id){
        var _token = $('input[name="_token"]').val();
        $.ajax({
        url:"{{url('/doctor/view_schedule_doctor')}}",
        method:"GET",
         headers:{
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
        dataType:"JSON",
        data:{id:id, _token:_token},
          success:function(data){
            $('#status_schedule').html(data.status);
            $('#image_user').html(data.image_user);
            $('#nickname').html(data.nickname);
            $('#email_user').html(data.email);

            $('#height').html(data.height+"(cm)");
            $('#weight').html(data.weight+"(kg)");
            $('#blood').html(data.blood);

            $('#age').html(data.age);
            $('#phone_user').html(data.phone_user);

            if(data.sex == 0){
             $('#sex_user').html("Male");
            }else{
             $('#sex_user').html("Female");
            }
            $('#address').html(data.address);

            $('#time').html(data.time);   
            $('#date').html(data.date); 


            $('#reason').html(data.reason);   
            $('#note').html(data.note); 
            $('#insurance').html(data.insurance);
            $('#package').html(data.package);
            $('#span_btn_click_accept').html(data.span_btn_click_accept);


          }
      });
    }

 var n = 1;

  $(document).on('click','.cancel_schedule',function(){
    var id = $('.id_schedule').val();
    var _token = $('input[name="_token"]').val();
      $.ajax({
          url:"{{url('/doctor/cancel_schedule')}}",
          method:"GET",
          // dataType:"JSON",
          headers:{
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
         data:{id:id, _token:_token},
          success:function(data){
          $('.btn-close').click();
            n = 1;
            populateCalendar(n);
          }

      }); 
  });
/////////////////////////////////////////////////////////////////////////////////////////////
  
   $('.fc-next-button').on("click", function(){
      n = n+6;
       populateCalendar(n);

   });
   $('.fc-prev-button').on("click", function(){
       n= n-6;
       populateCalendar(n);

   });
	  populateCalendar(1);

    function populateCalendar(n) {

      var dropdown = $('#calendar_schedule');
      dropdown.html(``);
      var currentDate = new Date();

      $('.date_today').text(currentDate.toDateString());
      $('.day_now').val(currentDate.toISOString().slice(0, 10));
      load_schedule_date(currentDate.toISOString().slice(0, 10));


      for (var i = 0; i < 6; i++) {
        var date = new Date();
        date.setDate((currentDate.getDate() + n) + i);
        const dateString = date.toDateString();
        // Tách chuỗi thành các thành phần riêng biệt
    		const parts = dateString.split(" ");
    		// Lấy ngày và tháng từ mảng thành phần
    		const Year = parts[3];
    		const day = parts[2];
    		const month = parts[1];
    		const Rank = parts[0];

		    // Tạo chuỗi chỉ với ngày và tháng
	    	const formattedDate = `${Rank} ${day} ${month}`;
        
        if(dateString  != currentDate.toDateString()){
          dropdown.append(`
              <div class="col-lg-2 border-end">
              <div class="border mt-1 p-1 text-center"><a class="text-primary fw-bold ">`+formattedDate+`</a></div>   
              <hr>

               <div class="d-grid" id="`+date.toISOString().slice(0, 10)+`">
              
              </div>

              </div>

            </div>
 

          `);

     
          load_schedule_date(date.toISOString().slice(0, 10));
         }
        $('.Year').text(Year);
     

       }
    }


   function load_schedule_date(date) {

    var _token = $('input[name="_token"]').val();

        $.ajax({
            url:"{{url('/doctor/load_schedule_date')}}",
            method:"get",
            // dataType:"JSON",
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
           data:{date:date, _token:_token},
            success:function(data){
            	if(date == $('.day_now').val()){
                    $('#load_schedule_today').html(data);
            	}else{
                    $('#'+date).html(data);
            	}

            }

        }); 

    }


}); 
</script>
@endsection