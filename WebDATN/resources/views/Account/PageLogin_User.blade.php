<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
     <link rel="stylesheet" type="text/css" href="{{asset('/Index/css/PageLogin_User.css')}}">
     <link rel="stylesheet" type="text/css" id="light-style" href="{{asset('/backend/assets/css/app.min.css')}}">
    <title>Đăng nhập</title>
  </head>
  <body>
    <div class="containerxx">
      <div class="forms-container">
        <div class="signin-signup">
   <form action="{{url('/save_login_page')}}" method="post">
            @csrf
            <h2 class="title">Đăng nhập</h2>
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
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="email" name="email" placeholder="Username" required />

                 @error('email')
                 <span style="color: red;">{{ $message }}</span>
                 @enderror
            </div>

            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" placeholder="Password" required/>

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
         
           <button type="submit" class="btn btn-primary btn-rounded">Đăng nhập</button>
            <a href="{{url('/Register-user')}}">
           Bạn có thể tạo một tài khoản mới tại đây!
            </a>

            <p class="social-text">Hoặc Đăng nhập bằng </p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>

        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h2>Mới ở đây à ?</h3>
            <h4>
             Bạn có thể hợp tác với chúng tôi để tạo phòng khám mới trên website
            </h4>
            <a href="{{url('/Register-doctor')}}" >
     
              <span class="badge badge-outline-dark">Nhấp chuột vào đây để đăng ký !</span>
            </a>
    

         
          
          </div>
          <img src="{{asset('/Image/login_image.png')}}" class="image" alt="" />
        </div>
       
      </div>
    </div>




   <script src="{{asset('/backend/assets/js/vendor.min.js')}}"> </script>

  </body>
</html>