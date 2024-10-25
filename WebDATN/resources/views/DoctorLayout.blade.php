<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="{{asset('/backend/assets/css/icons.min.css')}}">
    <link rel="stylesheet" type="text/css" id="light-style" href="{{asset('/backend/assets/css/app.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/Frontend/HomeUser.css')}}">
    <link rel="stylesheet" href="{{asset('/backend/sweetalert2.min.css')}}">

    <title>{{$title_tag}}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <script src="{{asset('/backend/assets/js/vendor.min.js')}}"></script>  
    <script src="{{asset('/backend/assets/js/app.min.js')}}"></script>

   <script src="{{asset('/backend/sweetalert2.all.min.js')}}"></script> 
 
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
         <!-- Scripts -->
    


    <script>
      Pusher.logToConsole = true;
      var pusher = new Pusher('604a7d0330f3d7bd2d2b', {
        cluster: 'ap1'
      });
      var iduser = {{Auth::user()->id}};
      var channel = pusher.subscribe('notificationbook.'+ iduser);
      channel.bind('my-event', function(data) {
        var toast = `<div class="p-1">
                    <span class="header-title fw-bold">Bạn vừa có 1 lịch hẹn mới !</span>
                       <hr>
                     <span class="fw-bold p-1">
                     Lúc:<span>`+data.schedule.time+`</span>|
                     <span>`+data.schedule.date+`</span></span> 
                    </div>`
       
        $.NotificationApp.send("",toast,"top-right","#FF6347","infor"); 
      });


    </script>
       
</head>

<body>
      <div class="wrapper">
         @include('Doctor.include.header_doctor')
          <div class="content-page">
                <div class="content">
                       @include('Doctor.include.sidebar_left_doctor')
                      <div class="container-fluid layout_user" >
                        <!--   <div id="loader" class="d-flex justify-content-center align-items-center">
                              <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                              </div>
                          </div> -->
                          <div id="main">
                             @yield('contents_doctor')
                     
                          </div>
                       
                    </div>
                 
                </div>
                <!-- content -->
            </div>

    </div>



 @stack('javascript')
<script src="{{asset('/backend/assets/js/MyJS.js')}}" async></script>
<!-- <script type="text/javascript" >
 $(document).ready(function(){
  $(window).on('load', function() {
      $('#main').hide();
      var displayTime = 100;
      setTimeout(function() {
          $('#main').fadeIn();
          $('#loader').remove();
      }, displayTime);
    });

  });
</script>   -->

</body>
</html>

