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

      <h2 class="d-flex align-items-center justify-content-center mt-4">Đơn đăng ký của bạn đang chờ phê duyệt. làm ơn cho !</h2>

	    <h3 class="d-flex align-items-center justify-content-center mt-2">Chúng tôi sẽ phản hồi qua email của bạn trong thời gian sớm nhất</h3>


	
</body>
</html>