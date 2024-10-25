<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Điều khoản hợp đồng</title>
        <link rel="stylesheet" type="text/css" href="{{asset('/backend/assets/images/favicon.ico')}}">
        <!-- App css -->
        <link rel="stylesheet" type="text/css" href="{{asset('/backend/assets/css/icons.min.css')}}">
        <link rel="stylesheet" type="text/css" id="light-style" href="{{asset('/backend/assets/css/app.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('/Frontend/HomeUser.css')}}">
          <meta name="csrf-token" content="{{ csrf_token() }}"> 
</head>
<body>
    <header>
        <nav class="navbar-custom topnav-navbar" >
           
                   <div class="container-fluid">
                            <!-- LOGO -->
                            <a href="{{url('/')}}" class="topnav-logo">
                                <span class="topnav-logo-lg">
                                    <img src="{{asset('/Image/logoweb.jpg')}}" alt="" height="50">
                                </span>  
                            </a>

              </div>
        </nav>    
    </header>

	   <form action="{{url('/doctor/Accept_doctor')}}" method="post" id="myform">
	      	@csrf
	   
	
	   <div class="container-fluid mt-3">
	   	 <div class="row">
	   	 	<div class="col-lg-2"></div>
	   	    <div class="col-lg-8">
	   	    	<div class="card">
	   	    		 <h2 class="d-flex align-items-center justify-content-center mt-2">ĐIỀU KHOẢN HỢP TÁC</h2>
	   	    		 <div class="card-body">
	   	    		 	<div class="row">
		   	    		 	<div class="col-lg-6">
		   	    		 	<h4>Người dùng đang đăng ký</h4>
		   	    		 	<h5>Họ và tên:<span class="badge badge-info-lighten">{{$infor->name}}</span></h5> 
		   	    		 	<h5>Địa chỉ:
		   	    		 	 <span class="badge badge-info-lighten">{{$infor->doctor->details_address}}, {{$infor->doctor->address}}</span></h5>
		   	    		 	<h5>Số điện thoại: <span class="badge badge-info-lighten">{{$infor->doctor->number_phone}}</span></h5>
		   	    		 	<h5>Email: <span class="badge badge-info-lighten">{{$infor->email}}</span></h5>
		   	    		 	

                       <div class="mb-2 row">
                        <div class="col-lg-7">
                        <label class="form-label" style="color: red">Vui lòng chọn chuyên khoa:</label>
                 <!--        <input type="text" class="form-control form-control-sm" data-toggle="input-mask" data-mask-format="000.000.000.000.000" 
                        data-reverse="true" maxlength="22">
 -->
                            <select id="inputState" class="form-select form-control-sm specialist" name="id_specialist" required>
                                <option value="0" selected>Chọn Chuyên khoa</option>
                                @foreach($specialistss as $key => $vid)
                                  <option value="{{$vid->id}}">{{$vid->specialist}}</option>
                                @endforeach
                            </select>
                         </div>
                        <div class="col-lg-5">
                          <label class="form-label">Chi phí khám bệnh:</label>
                          <input type="text" class="form-control form-control-sm price" name="price" value="0" data-toggle="input-mask" 
                          data-mask-format="000.000.000.000.000" required>
                        </div>
                       </div>

		   	    		 	</div>


		   	    		<div class="col-lg-6">
		   	    		 	<h4>Trang web đặt lịch hẹn</h4>
		   	    		<div class="mb-2 row">
						        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Tên Phòng khám</label>
						        <div class="col-sm-9">
						        <input type="text" name="name" value="Bác Sĩ {{$infor->name}}" class="form-control form-control-sm name" id="colFormLabelSm" placeholder="company name" required>
						        </div>
						    </div>

		   	    	  <div class="mb-2 row">
						        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm" >Số điện thoại</label>
						        <div class="col-sm-9">
						        <input type="text" name="phone" class="form-control form-control-sm phone" id="colFormLabelSm"  placeholder="(+84) 000-000-000" data-toggle="input-mask" value="{{$infor->doctor->number_phone}}" data-mask-format="0000-000-000" required>
                       <span class="font-13 text-muted">Vi "(+84) 000-000-000"</span>
						        </div>
						    </div>
		   	    		<div class="mb-2 row">
						        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Email</label>
						        <div class="col-sm-9">
						        <input type="email" name="email" value="{{$infor->email}}" class="form-control form-control-sm email" id="colFormLabelSm" placeholder="email" required>
						        </div>
						    </div>
						    <div class="mb-2 row">
						        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Địa chỉ</label>
						        <div class="col-sm-7">
						        <input type="text" name="address" value="{{$infor->doctor->details_address}}, {{$infor->doctor->address}}" class="form-control form-control-sm address_company address" id="colFormLabelSm" placeholder="col-form-label-sm" required>
						        </div>
						        <button type="button" class="col-sm-2 btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg">Thay đổi</button>
						    </div>
		   	    		 		

		   	    	</div>

            </div>
              <div class="row">

                  <div class="mb-3 position-relative">
                      <label class="form-label">Mô tả phòng khám của bạn</label>

                       <textarea style="resize: none" rows="2" class="form-control about_clinic" name="about_clinic"  
                       placeholder="" ></textarea>
          
                      
                </div>
              </div>

             <div class="row">

                  <div class="mb-3 position-relative">
                      <label class="form-label">Mô tả chi tiết các dịch vụ khám chữa bệnh của phòng khám</label>

                       <textarea style="resize: none" rows="8" class="form-control describe_service" name="describe_service"  
                       id="ckeditor111" placeholder="" required></textarea>
          
                      
                  </div>
              </div>



                        <div class="row">
                        	<h4>1. Mô tả hợp tác </h4>
                                <p>	1.1 Bác sĩ đồng ý cung cấp dịch vụ y tế chuyên môn, bao gồm việc khám bệnh, tư vấn và điều trị cho bệnh nhân thông qua trang web đặt lịch khám.</p>
                                <p>	1.2 Trang web đặt lịch khám đồng ý cung cấp nền tảng trực tuyến cho bác sĩ để quảng bá và quản lý lịch khám, bao gồm việc đặt lịch hẹn và gửi thông báo cho bệnh nhân.</p>

							

							
	                         <h4>2. Quyền và nghĩa vụ</h4>
          								<h5>2.1 Bác sĩ:</h5>
          								<p>Đảm bảo rằng thông tin cá nhân và chuyên môn của mình trên trang web đặt lịch khám luôn được cập nhật và chính xác.
          								Được phép từ chối hoặc hủy bỏ cuộc hẹn nếu không thể thực hiện. <br>
          							    Tuân thủ các quy định và quy tắc được đề ra bởi cơ quan y tế có thẩm quyền.</p>
                                            
          								
          								
          								<h5>2.2 Trang web đặt lịch khám:</h5>
          								
                                          <p>	Cung cấp giao diện dễ sử dụng và bảo mật cho bác sĩ quản lý lịch khám và thông tin bệnh nhân. <br>

          								Bảo mật thông tin bệnh nhân và tuân thủ quy định về bảo mật dữ liệu.</p>
          							

          					    <h4>3. Bảo mật thông tin</h4>
          					    <p>Cả bác sĩ và trang web đặt lịch khám cam kết bảo mật thông tin cá nhân và y tế của bệnh nhân theo quy định của pháp luật hiện hành và tuân thủ các quy tắc về bảo mật dữ liệu.</p>
          							

          					    <h4>4. Thanh toán</h4>	

          							<p>4.1 Bác sĩ và trang web đặt lịch khám sẽ đồng ý về mức phí và cách thức thanh toán dịch vụ theo thỏa thuận riêng.</p>

          						<h4>5. Thời hạn và chấm dứt</h4>	

          							<p>5.1 Hợp đồng này có hiệu lực từ ngày ký kết và tiếp tục trong thời gian không xác định.</p>
          							<p>5.2 Mỗi bên có quyền chấm dứt hợp đồng bằng văn bản và thông báo cho bên kia trước ít nhất 30 ngày.</p>



					

							
                        <h4>6. Luật áp dụng</h4>	
                        	<p>Hợp đồng này sẽ tuân thủ và được hiểu theo luật pháp của [Tên quốc gia hoặc khu vực] và mọi tranh chấp phát sinh từ hoặc liên quan đến Hợp đồng này sẽ thuộc thẩm quyền giải quyết của các tòa án có thẩm quyền tại [Địa điểm].</p>
					

									
                        <h4>6. Luật áp dụng</h4>	
                        	<p>	Cả hai bên xác nhận rằng họ đã đọc, hiểu và chấp nhận các điều khoản và điều kiện trong Hợp đồng này và cam kết thực hiện nghĩa vụ của mình theo đúng ý đồ của hợp đồng.</p>

                          

						  
                        </div>


                         <div class="d-flex align-items-center justify-content-center mt-2">
                          	<div class="form-check">
						        <input type="checkbox" class="form-check-input checkbox" id="customCheck1" required>
						        <label class="form-check-label" for="customCheck1">Bạn có chấp nhận các điều khoản trên không ?</label>

						    </div>
                          </div>
                          <div class="d-flex align-items-center justify-content-center mt-2">
                           <button type="button" class="btn btn-info btn_acept">chấp nhận</button>
                          </div>


	   	    		 </div>
	   	    	</div>
	   	    	
	   	    </div>

	   	 </div>
	   	
	   </div>

   </form>



<div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">thay đổi địa chỉ</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
            
               <div class="row">  
                     <label class="form-label">Địa chỉ </label>                                           
                        <div class="col-md-4">
                          <div class="form-floating">
                            <select class="form-select city" id="city" aria-label="Floating label select example">

                            <option value="0">--Chọn tỉnh thành phố--</option>
                            @foreach($city as $key => $ci)
                            <option class="optionck" value="{{$ci->matp}}">{{$ci->name}}</option>
                            @endforeach   
                            </select>
                            <label for="floatingSelect">Choose City</label>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-floating">
                            <select class="form-select province" id="province" aria-label="Floating label select example">
                                <option value="0" selected>---Chọn quận huyện---</option>
                            
                            </select>
                            <label for="floatingSelect">Choose District</label>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-floating">
                            <select class="form-select wards" id="wards" aria-label="Floating label select example">
                             <option value="0" selected>---Chọn xã phường---</option>
                            </select>
                            <label for="floatingSelect">Choose Warsd</label>
                          </div>
                        </div>
                        <div class="form-floating mt-1 mb-3">
                             <input type="text" class="form-control details_address" id="floatingInput" placeholder="" />
                                  <label for="floatingInput">Details address</label>
                          </div>
                  </div>


            </div>

             <div class="modal-footer">
                <button type="button" id="close_chane" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                <button type="button" id="save_change" class="btn btn-primary">Lưu thay đổi </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

   <script src="{{asset('/backend/assets/js/vendor.min.js')}}"> </script>
   <script src="{{asset('/backend/assets/js/app.min.js')}}"> </script>

<script src="{{asset('/ckeditor/ckeditor.js')}}"></script>
  <script type="text/javascript">

  CKEDITOR.replace('ckeditor111',{

  filebrowserImageUploadUrl : "{{ url('uploads_ckeditor?_token='.csrf_token()) }}",
  // filebrowserBrowseUrl : "{{ url('file-browser?_token='.csrf_token()) }}",
  filebrowserUploadMethod: 'form',


  });
 </script>

<script type="text/javascript" charset="utf-8" async defer>

    $('.btn_acept').on("click", function(){

       var name = $('.name').val();
       var email = $('.email').val();
       var phone = $('.phone').val();
       var addess = $('.addess').val();
       var price = $('.price').val();
        var specialist = $('.specialist').val();
       var checkbox = $('.checkbox').val();
       var about_clinic = $('.about_clinic').val();
       var des = CKEDITOR.instances.ckeditor111.getData();
       if(name == "" || email == "" ||phone == "" ||addess == ""){

         $.NotificationApp.send("","Vui lòng nhập đầy đủ thông tin phòng khám","top-right","rgba(0,0,0,0.2)","error");

       }else if(price == ""){

         $.NotificationApp.send("","Vui lòng nhập chi phí khám bệnh","top-right","rgba(0,0,0,0.2)","error");

       }else if(specialist == 0){

         $.NotificationApp.send("","Vui lòng chọn chuyên khoa của phòng khám ","top-right","rgba(0,0,0,0.2)","error");

       }else if(about_clinic == ""){

         $.NotificationApp.send("","Vui lòng nhập mô tả khám của bạn","top-right","rgba(0,0,0,0.2)","error");

       }else if(des == ""){

         $.NotificationApp.send("","Vui lòng tham gia dịch vụ khám chữa bệnh của phòng khám ","top-right","rgba(0,0,0,0.2)","error");

        }else if(!$('.checkbox').is(":checked")){

         $.NotificationApp.send("","Vui lòng kiểm tra chấp nhận hợp đồng","top-right","rgba(0,0,0,0.2)","error");

       }else{

          $('form#myform').submit();
       }

   });

   $('#save_change').on("click", function() {

        var optionSelected_city = $('#city').val();
        var optionSelected_province = $('#province').val();
        var optionSelected_wards = $('#wards').val();
        if(optionSelected_city == 0 || optionSelected_province == 0 || optionSelected_wards == 0){

              $.NotificationApp.send("","Vui lòng nhập địa chỉ phòng khám","top-right","rgba(0,0,0,0.2)","error")

        }else if($('.details_address').val() == ""){
            
              $.NotificationApp.send("","Vui lòng nhập chi tiết địa chỉ","top-right","rgba(0,0,0,0.2)","error")

        }else{

          var cityxss = $('.city option:selected').text();
          var provincecsssx = $('.province option:selected').text();
          var wardsxxss = $('.wards option:selected').text();

          var address = wardsxxss +", " +provincecsssx +", "+ cityxss;
          var details_address = $('.details_address').val();
          $('.address_company').val(details_address+", "+ address);
          $('.details_address').val("");
          $('#close_chane').click();
        }
     
       });


</script>

<script type="text/javascript" charset="utf-8" async defer>

    $(document).ready(function(){

         $('#city').change(function(){ 
            var action = $(this).attr('id');
            var ma_id = $(this).val();
         
            var _token = $('input[name="_token"]').val();
           
            $.ajax({
                url : '{{url('/select-delivery-home')}}',
                method: 'POST',
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }, 
                data:{action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                   $('#province').html(data); 
                 
                }
            });  


            $('.address_xx').addClass('badge badge-info-lighten');
             var city = $('#city').find(":selected").text();
            $('.cityxss').html(`<i class="dripicons-location"></i>`+ city)
        });

         $('#province').change(function(){ 
            

            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
                
            $.ajax({
                url : '{{url('/select-delivery-home')}}',
                method: 'POST',
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }, 
                data:{action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                   $('#wards').html(data); 


                   
                }
            });

         var province = $('#province').find(":selected").text();
            $('.provincecsssx').text(", " + province)  

         });

         $('#wards').on('change',function(){
            var wards = $('#wards').find(":selected").text();
            $('.wardsxxss').text(", " +wards)  

        });


   });
</script>

	
</body>
</html>