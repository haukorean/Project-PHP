<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Log In | Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta content="Coderthemes" name="author" />
        <!-- App favicon -->
        <link rel="stylesheet" type="text/css" href="{{asset('/backend/assets/images/favicon.ico')}}">

                <!-- App css -->
        <link rel="stylesheet" type="text/css" id="light-style" href="{{asset('/backend/assets/css/icons.min.css')}}">
        <link rel="stylesheet" type="text/css" d="light-style" href="{{asset('/backend/assets/css/app.min.css')}}">

    </head>

    <body class="authentication-bg pb-0" data-layout-config='{"darkMode":false}'>

        <div class="auth-fluid">
            <!--Auth fluid left content -->
            <div class="auth-fluid-form-box">
                <div class="align-items-center d-flex h-100">
                    <div class="card-body">

                        <!-- Logo -->
                        <div class="auth-brand text-center text-lg-start">
                            <a href="{{url('/')}}" class="logo-dark">
                                <img src="{{asset('/Image/logoweb.jpg')}}" alt="" height="50">
                            </a>
                            <a href="{{url('/')}}" class="logo-light">
                                <span>  <img src="{{asset('/Image/logoweb.jpg')}}" alt="" height="50"></span>
                            </a>
                        </div>

                        <!-- title-->
                 <h4 class="mt-0">Login Admin</h4>
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Error - </strong> {{$errors->first()}}
                    </div>
                @endif

                @if (\Session::has('message'))
                 <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                         <strong>Error - </strong>  {!! \Session::get('message') !!}
                       
                    </div>
                @endif
                        <!-- form -->
                   <form action="{{url('/save_login_page')}}" method="post">
                            @csrf
                         
                            <div class="mb-3">
                                <label for="emailaddress" class="form-label">Email</label>
                                <input class="form-control" type="email" name="email" id="emailaddress" required="" placeholder="Enter your email">
                            </div>
                             @error('email')
                             <span style="color: red;">{{ $message }}</span>
                             @enderror
                            <div class="mb-3">
                                <a href="pages-recoverpw-2.html" class="text-muted float-end"><small>Quên mật khẩu?</small></a>
                                <label for="password" class="form-label">Mật khẩu</label>
                                <input class="form-control" type="password" name="password" required="" id="password" placeholder="Enter your password">
                            </div>

                             @error('password')
                              <span style="color: red;">{{ $message }}</span>
                              @enderror 
                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" name="remembers" class="form-check-input" id="checkbox-signin">
                                    <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                </div>
                            </div>
                            <div class="d-grid mb-0 text-center">
                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-login"></i>Đăng nhập </button>
                            </div>

                        </form>

                    </div> <!-- end .card-body -->
                </div> <!-- end .align-items-center.d-flex.h-100-->
            </div>

            <div class="auth-fluid-right text-center">
                <div class="auth-user-testimonial">
                    <h2 class="mb-3">Chào mừng đến với quản trị viên!</h2>

                </div>
            </div>
        </div>
    <script src="{{asset('/backend/assets/js/vendor.min.js')}}"> </script>
    </body>

</html>