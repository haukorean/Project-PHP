<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title_tag}}</title>

        <!-- App css -->
        <link rel="stylesheet" type="text/css" href="{{asset('/backend/assets/css/icons.min.css')}}">
        <link rel="stylesheet" type="text/css" id="light-style" href="{{asset('/backend/assets/css/app.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('/Frontend/AdminStyle.css')}}">

        <meta name="csrf-token" content="{{ csrf_token() }}"> 

         <script src="{{asset('/backend/assets/js/vendor.min.js')}}"> </script>  
         <script src="{{asset('/backend/assets/js/app.min.js')}}"></script>

        
        <link rel="stylesheet" href="{{asset('/backend/sweetalert2.min.css')}}">
        <script src="{{asset('/backend/sweetalert2.all.min.js')}}"></script>
        <style type="text/css" media="screen">
            #loader {
              height: 100vh;
              display: flex;
              justify-content: center;
              align-items: center;
            }         
        </style>
      
</head>
  <body>


       <div class="wrapper">
           @include('Admin.include.sidebar_left_admin')
          <div class="content-page">
                <div class="content">
                       @include('Admin.include.header_admin')
                      <div class="container-fluid layout_user" >
                       <!--    <div id="loader" class="d-flex justify-content-center align-items-center">
                              <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                              </div>
                          </div> -->
                          <div id="main">
                             @yield('contents')
                     
                          </div>
                       
                    </div>
                 
                </div>
                <!-- content -->
            </div>

    </div>
<!-- <script>
 $(window).on('load', function() {
      var displayTime = 100;
      $('#loader').fadeIn();
      $('#main').fadeOut();

      setTimeout(function() {
          $('#main').fadeIn();
           $('#loader').remove();
      }, displayTime);
    });
</script> -->
</body>
</html>
