<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Register Doctor</title>
    <!-- Vendor CSS Files --><!-- 
  <link href="{{asset('/Index/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"> -->
  <!-- Template Main CSS File -->
<!-- <link rel="stylesheet" type="text/css" href="{{asset('/backend/assets/images/favicon.ico')}}"> -->
  <link rel="stylesheet" type="text/css" href="{{asset('/backend/assets/css/icons.min.css')}}">
  <link href="{{asset('/Index/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" id="light-style" href="{{asset('/backend/assets/css/app.min.css')}}">
  <link href="{{asset('/Index/css/style_register.css')}}" rel="stylesheet">


  <link rel="stylesheet" href="{{asset('/backend/sweetalert2.min.css')}}">

  <meta name="csrf-token" content="{{ csrf_token() }}"> 
 <style type="text/css">
    #loader {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }
    
  </style>
</head>
<body>

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container">
        <div id="loader" class="d-flex justify-content-center align-items-center">
            <div class="spinner-border text-primary" role="status">
              <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <div class="row" id="main" style="display: none">

           <div class="col-lg-2">
           </div>
           <div class="col-lg-8 form1">
             <div class="card ">
               <div class="card-body">
                  <h2 class="d-flex align-items-center justify-content-center">
                            <span class="badge badge-success-lighten">Đăng ký bác sĩ</span></h2>
                                        <p class="text-muted font-14">Vui lòng điền đầy đủ thông tin cần thiết, chúng tôi sẽ xem xét hồ sơ của bạn để xem nó có phù hợp với vai trò bác sĩ hay không.
                                        </p>
                                         <div class="row">                                             
                                                <div class="col-md-6">
                                                  <div class="position-relative mb-3">
                                                        <label class="form-label" for="validationTooltip01">Họ</label>
                                                        <input type="text" class="form-control first_name" id="" maxlength="15" data-toggle="maxlength" placeholder="Họ" value="">
                                                     
                                                    </div>
                                                </div>
                                                 <div class="col-md-6">
                                                  <div class="position-relative mb-3">
                                                        <label class="form-label" for="validationTooltip01">Tên</label>
                                                        <input type="text" class="form-control last_name" id="" maxlength="15" data-toggle="maxlength" placeholder="Tên" value="" required="">
                                                      
                                                    </div>
                                                </div>
                                           </div>
                                                  
                                                    
                                           <div class="row">                                             
                                                <div class="col-md-6">
                                                  <div class="form-floating mb-3">
                                                     <input type="email" class="form-control email_address" id="floatingInput" placeholder="name@example.com" />
                                                          <label for="floatingInput">Địa chỉ email</label>
                                                  </div>
                                                   
                                                </div>
                                                 <div class="col-md-6">
                                                  <div class="form-floating mb-3">
                                                        <input type="text" class="form-control phone_acc" id="floatingPassword" data-toggle="input-mask" data-mask-format="0000-000-000">
                                                            <span class="font-13 text-muted">Vi "(+84) 000-000-000"</span>
                                                          <label for="floatingInput">SDT</label>
                                                  </div>
                                                </div>
                                           </div>

                                           <div class="row">                                             
                                                <div class="col-md-6">
                                                  <label for="password" class="form-label">Mật khẩu</label>
                                                  <div class="input-group input-group-merge">
                                                      <input type="password" id="password" class="form-control password_acc" placeholder="Nhập mật khẩu của bạn">
                                                      <div class="input-group-text" data-password="false">
                                                          <span class="password-eye"></span>
                                                      </div>
                                                  </div>
                                                     <small id="emailHelp" class="form-text text-muted">
                                                      <span id="span_pass">Độ dài của ký tự phải lớn hơn 6.</span></small>
                                                </div>
                                                 <div class="col-md-6">
                                                  <label for="password" class="form-label">Nhập Lại Mật khẩu</label>
                                                  <div class="input-group input-group-merge">
                                                      <input type="password" id="password" class="form-control password_confirm" placeholder="Nhập mật khẩu Xác nhận của bạn">
                                                      <div class="input-group-text" data-password="false">
                                                          <span class="password-eye"></span>
                                                      </div>
                                                  </div>
                                                  <small class="form-text text-muted"><span id="span_cf_pass"></span></small>
                                               </div>
                                          </div>

                                       <div class=" d-flex align-items-center justify-content-center mt-4">
                                           <button class="btn btn-primary btn_next_register" type="button">Tiếp Tục</button>
                                       </div>
                        </div>
                 </div>
           </div>

           <div class="col-lg-8 form2" style="display: none">
                  <div class="card">
                       <div class="card-body">
                                   <div class="row">
                                              <div class="image-input d-flex align-items-center justify-content-center">
                                                <input type="file" accept="image/*" id="imageInput">                
                                                <label for="imageInput" class="image-button btn btn-outline-primary">
                                                <i class='bx bxs-user-circle'></i> Chọn hình ảnh Avatar</label>
                                                <img src="" class="image-preview img-fluid img-thumbnail rounded-circle" >   
                                              </div>
                                               <span class="change-image">Chọn một hình ảnh khác</span>  
                                    </div>

                                     <div class="row mt-1">
                                       <label class="form-label">Hình ảnh CMND:</label>
                                          <div class="col-lg-6 mt-1">
                                             <div class="image-input1 d-flex align-items-center justify-content-center">
                                                  <input type="file" accept="image/*" id="imageInput1">
                                             <!--      <button type="button" class="btn btn-outline-primary image-button"><i class="uil-paypal"></i> PayPal</button> -->
                                                  <label for="imageInput1" class="image-button1 btn btn-outline-primary">
                                                    Mặt trươc 
                                                   <i class='mdi mdi-badge-account-horizontal-outline'></i></label>
                                                  <img src="" class="image-preview1 img-fluid img-thumbnail" >

                                                  
                                                </div>
                                                 <span class="change-image1">Chọn một hình ảnh khá</span>
                                          </div>
                                          <div class="col-lg-6 mt-1">
                                               <div class="image-input2 d-flex align-items-center justify-content-center">
                                                  <input type="file" accept="image/*" id="imageInput2">
                                             <!--      <button type="button" class="btn btn-outline-primary image-button"><i class="uil-paypal"></i> PayPal</button> -->
                                                  <label for="imageInput2" class="image-button2 btn btn-outline-primary">
                                                   Mặt sau
                                                   <i class='mdi mdi-badge-account-horizontal'></i> </label>
                                                  <img src="" class="image-preview2 img-fluid img-thumbnail" >

                                                  
                                                </div>
                                                 <span class="change-image2">Chọn một hình ảnh khá</span>
                                          </div>
                                              
                                          
                                        </div>


                                          <div class="row mt-1">                                             
                                              
                                             <div class="col-md-4">
                                                  <label for="password" class="form-label">Kinh nghiệm</label>
                                                  <div class="input-group input-group-merge">
                                                      <input type="number" min="0" value="1" id="password" class="form-control work_experience">
                                          
                                                  </div>
                                                 <small id="emailHelp" class="form-text text-muted">Được xuất bản từ 5 năm kinh nghiệm.</small>
                                                </div>

                                              <div class="col-md-3">
                                                   <div class="mb-3">
                                                    <label class="form-label">Giấy phép Bác sĩ:</label>
                                                    <input class="form-control" type="file"  accept=".doc, .docx, .pdf" id="inputGroupFile04">
                                                </div>
                                               </div>

                                              <div class="col-md-3">
                                                  <div class="mb-3">
                                                    <label for="example-date" class="form-label ">Ngày Sinh</label>
                                                     <input class="form-control birth_day" id="example-date" type="date" name="date">
                                               </div>
                              
                                                </div>
                                                <div class="col-md-2">
                                                  <div class="mb-3">
                                                      <label for="example-select" class="form-label sex_acc">Giới tính</label>
                                                      <select class="form-select sex_user" id="example-select">
                                                          <option value="0" selected="">Nam</option>
                                                          <option value="1">Nữ  </option>
                                                      
                                                      </select>
                                                  </div>
                                                </div>


                                              
                                          </div>

                                        <div class="row mt-1">
                                          <div>
                                            <label class="form-label">Về tôi:</label>
                                            <p class="text-muted font-13">
                                           Hãy mô tả điều gì đó về bản thân bạn
                                            </p>
                                            <textarea data-toggle="maxlength" class="form-control about_me" maxlength="225" rows="2" 
                                                placeholder="This about me has a limit of 225 chars."></textarea>
                                          </div>
                                       </div> 



                                       <div class="row">  
                                             <label class="form-label">Địa chỉ</label>                                           
                                                <div class="col-md-4">
                                                  <div class="form-floating">
                                                    <select class="form-select city" id="city" aria-label="Floating label select example">

                                                    <option value="0">--Chọn tỉnh thành phố--</option>
                                                    @foreach($city as $key => $ci)
                                                    <option class="optionck" value="{{$ci->matp}}">{{$ci->name}}</option>
                                                    @endforeach   
                                                    </select>
                                                    <label for="floatingSelect">Choose Thành Phố</label>
                                                  </div>
                                                </div>
                                                <div class="col-md-4">
                                                  <div class="form-floating">
                                                    <select class="form-select province" id="province" aria-label="Floating label select example">
                                                        <option value="0" selected>---Chọn quận huyện---</option>
                                                    
                                                    </select>
                                                    <label for="floatingSelect">Choose Quận / Huyện</label>
                                                  </div>
                                                </div>

                                                <div class="col-md-4">
                                                  <div class="form-floating">
                                                    <select class="form-select wards" id="wards" aria-label="Floating label select example">
                                                     <option value="0" selected>---Chọn xã phường---</option>
                                                    </select>
                                                    <label for="floatingSelect">Choose Xã / Phường</label>
                                                  </div>
                                                </div>
                                                <div class="form-floating mt-1 mb-3">
                                                     <input type="text" class="form-control details_address" id="floatingInput" placeholder="" />
                                                          <label for="floatingInput">Địa chỉ chi tiêt</label>
                                                  </div>
                                          </div>

                                       <div class=" d-flex align-items-center justify-content-center button-list">        
                                           <button class="btn btn-danger btn_Previous" type="button">Trước</button>
                                           <button class="btn btn-primary btn_add_save_register" type="button">Đăng ký</button>
                                       </div>
                                  
                 </div> <!-- end card-body-->
             </div> <!-- end card-->
           </div> <!-- end col-->


        </div>
    </div>
  </section><!-- End Hero -->
   <script src="{{asset('/backend/assets/js/vendor.min.js')}}"> </script>
   <script src="{{asset('/backend/assets/js/app.min.js')}}"> </script>

   <script src="{{asset('/backend/sweetalert2.all.min.js')}}"></script>



<script>
 $(window).on('load', function() {
      var displayTime = 100;

      $('#loader').fadeIn();
      $('#main').fadeOut();

      setTimeout(function() {
          $('#main').fadeIn();
           $('#loader').remove();
      }, displayTime);
    });
</script>   



<script type="text/javascript" charset="utf-8" async defer>

 //////////////////  Validation form /////////////////////
 


   $('.form1').show();
  $('.form2').hide();
  $('.btn_next_register').on( "click", function() {

       var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
       var email = $('.email_address').val();

        if($('.first_name').val() == "" || $('.last_name').val() == ""){

              $.NotificationApp.send("","Vui lòng nhập họ và tên","top-right","rgba(0,0,0,0.2)","error")
      
        }else if($('.email_address').val() == ""){

              $.NotificationApp.send("","Vui lòng nhập email ","top-right","rgba(0,0,0,0.2)","error") 

        }else if(!regex.test(email)){

              $.NotificationApp.send("","Email không hợp lệ","top-right","rgba(0,0,0,0.2)","error") 

        }else if($('.phone_acc').val() == ""){

              $.NotificationApp.send("","Vui lòng nhập số điện thoại","top-right","rgba(0,0,0,0.2)","error") 

        }else if($('.phone_acc').val().length < 10){

              $.NotificationApp.send("","Vui lòng nhập đầy đủ 10 số điện thoại ","top-right","rgba(0,0,0,0.2)","error") 

        }else if($('.password_acc').val() == ""){

              $.NotificationApp.send("","Xin vui lòng nhập mật khẩu","top-right","rgba(0,0,0,0.2)","error") 

        }else if($('.password_confirm').val() != $('.password_acc').val()){

              $.NotificationApp.send("","Vui lòng nhập xác nhận mật khẩu trùng khớp","top-right","rgba(0,0,0,0.2)","error") 

        }else{
 
              Check_email_unique($('.email_address').val());

        }

  });


   function Check_email_unique(email){ 
       var _token = $('input[name="_token"]').val();
        $.ajax({
            url : '{{url('/Check_email_unique')}}',
            method: 'GET',
            dataType:"JSON",
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }, 
            data:{email:email,_token:_token},
            success:function(data){
              // alert(data.key_check)
              if (data.key_check == 1) {
                $.NotificationApp.send("","Email này đã được sử dụng.","top-right","rgba(0,0,0,0.2)","error")               
                $('.email_address').css('border-color', 'red');
              }else{
                  $('.form1').hide();
                  $('.form2').show();
                  $('.email_address').css('border-color', '#06F211');
              }
              
             
            }
        });  

  } 


 $('.btn_Previous').on( "click", function() {
  $('.form1').show();
  $('.form2').hide();
 });



   $('.btn_add_save_register').on( "click", function() {

        var imageInput =  document.getElementById("imageInput").files[0];
        var imageInput1 =  document.getElementById("imageInput1").files[0];
        var imageInput2 =  document.getElementById("imageInput2").files[0];
        var File_Physician =  document.getElementById("inputGroupFile04").files[0];

        var optionSelected_city = $('#city').val();
        var optionSelected_province = $('#province').val();
        var optionSelected_wards = $('#wards').val();
       if(imageInput == null){
        
              $.NotificationApp.send("","Vui lòng chọn ảnh đại diện","top-right","rgba(0,0,0,0.2)","error")  
        }else if(imageInput1 == null ||imageInput2 == null){
        
              $.NotificationApp.send("","Vui lòng chọn hình ảnh đầy đủ","top-right","rgba(0,0,0,0.2)","error")  

        }else if(File_Physician == null ){
        
              $.NotificationApp.send("","Vui lòng chọn File Giấy phép bác sĩ","top-right","rgba(0,0,0,0.2)","error")  

        }else if($('.birth_day').val() == ""){
            
              $.NotificationApp.send("","Vui lòng nhập ngày sinh","top-right","rgba(0,0,0,0.2)","error") 


        }else if(optionSelected_city == 0 || optionSelected_province == 0 || optionSelected_wards == 0){

              $.NotificationApp.send("","Vui lòng nhập địa chỉ phòng khám y tế","top-right","rgba(0,0,0,0.2)","error")

        }else if($('.details_address').val() == ""){
            
              $.NotificationApp.send("","Vui lòng nhập chi tiết địa chỉ","top-right","rgba(0,0,0,0.2)","error")

        }else{
           save_register_doctor();
        }
     
       });


    $('.password_confirm').on('change', function () {
         var password_acc = $('.password_acc').val();
         var password_confirm = $('.password_confirm').val();
         
        if(password_acc != password_confirm){
            $('#span_cf_pass').html('Mật khẩu không khớp');
            $('#span_cf_pass').css('color', 'red');
        
        }else {
            $('#span_cf_pass').html('Mật khẩu đã khớp');
            $('#span_cf_pass').css('color', 'MediumSeaGreen');
        }
        
   });


    $('.password_acc').on('change', function () {
        var password_acc = $('.password_acc').val();
       if(password_acc.length < 6){

            $('#span_pass').html('Độ dài ký tự phải lớn hơn 6.');
            $('#span_pass').css('color', 'red');
        
        }else {
            $('#span_pass').html('Mật khẩu hợp lý');
            $('#span_pass').css('color', 'MediumSeaGreen');
        }
        
   });


   /////////// save register user  ////////////////
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

      function save_register_doctor(){   
          var email = $('.email_address').val();
          var password = $('.password_acc').val();

          var first_name = $('.first_name').val();
          var last_name = $('.last_name').val();
          var phone_acc = $('.phone_acc').val();

          var cityxss = $('.city option:selected').text();
          var provincecsssx = $('.province option:selected').text();
          var wardsxxss = $('.wards option:selected').text();

          var address = wardsxxss +", " +provincecsssx +", "+ cityxss;
          var details_address = $('.details_address').val();
          var birth_day = $('.birth_day').val();
          var sex = $('.sex_user').val();
          var work_experience = $('.work_experience').val();
          var about_me = $('.about_me').val();  




         var form_data = new FormData();
         form_data.append("email_address",email);
         form_data.append("password_acc",password);


         form_data.append("first_name",first_name);
         form_data.append("last_name",last_name);
         form_data.append("phone_acc",phone_acc);

         form_data.append("address",address);
         form_data.append("details_address",details_address);
         form_data.append("birth_day",birth_day);
         form_data.append("sex_user",sex);
         form_data.append("work_experience",work_experience);
       
         form_data.append("about_me",about_me);
         form_data.append("file_imageInput", document.getElementById("imageInput").files[0]);
         form_data.append("file_imageInput1", document.getElementById("imageInput1").files[0]);
         form_data.append("file_imageInput2", document.getElementById("imageInput2").files[0]);
         form_data.append("file_inputGroupFile04", document.getElementById("inputGroupFile04").files[0]);

            $.ajax({
            url:"{{url('/save_register_user_doctor')}}",
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
                    title: "<h3 style='color:#00FF00'>Đăng ký thành công</h3>",
                    width: 300,
                    showConfirmButton: false,
                    timer: 1200
                  });

                $(this).delay(1200).queue(function(){
                window.location.href = "{{URL::to('/Login-Page')}}"
                });
             
              
             }
           });

     }

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


         });



   });
</script>


<script type="text/javascript" charset="utf-8" async defer>
  
  $('#imageInput').on('change', function() {
    $input = $(this);
    if($input.val().length > 0) {
      fileReader = new FileReader();
      fileReader.onload = function (data) {
      $('.image-preview').attr('src', data.target.result);
      }
      fileReader.readAsDataURL($input.prop('files')[0]);
      $('.image-button').css('display', 'none');
      $('.image-preview').css('display', 'block');
      $('.change-image').css('display', 'block');
    }
  });
            
  $('.change-image').on('click', function() {
    $control = $(this);     
    $('#imageInput').val(''); 
    $preview = $('.image-preview');
    $preview.attr('src', '');
    $preview.css('display', 'none');
    $control.css('display', 'none');
    $('.image-button').css('display', 'block');
  });



//////////////////////////////////////
   $('#imageInput1').on('change', function() {
    $input = $(this);
    if($input.val().length > 0) {
      fileReader = new FileReader();
      fileReader.onload = function (data) {
      $('.image-preview1').attr('src', data.target.result);
      }
      fileReader.readAsDataURL($input.prop('files')[0]);
      $('.image-button1').css('display', 'none');
      $('.image-preview1').css('display', 'block');
      $('.change-image1').css('display', 'block');
    }
  });
            
  $('.change-image1').on('click', function() {
    $control = $(this);     
    $('#imageInput1').val(''); 
    $preview = $('.image-preview1');
    $preview.attr('src', '');
    $preview.css('display', 'none');
    $control.css('display', 'none');
    $('.image-button1').css('display', 'block');
  });


//////////////////////////////////////////
 $('#imageInput2').on('change', function() {
    $input = $(this);
    if($input.val().length > 0) {
      fileReader = new FileReader();
      fileReader.onload = function (data) {
      $('.image-preview2').attr('src', data.target.result);
      }
      fileReader.readAsDataURL($input.prop('files')[0]);
      $('.image-button2').css('display', 'none');
      $('.image-preview2').css('display', 'block');
      $('.change-image2').css('display', 'block');
    }
  });
            
  $('.change-image2').on('click', function() {
    $control = $(this);     
    $('#imageInput2').val(''); 
    $preview = $('.image-preview2');
    $preview.attr('src', '');
    $preview.css('display', 'none');
    $control.css('display', 'none');
    $('.image-button2').css('display', 'block');
  });
</script>



</body>
</html>