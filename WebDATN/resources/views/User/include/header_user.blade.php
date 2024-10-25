    <header>
        <nav class="navbar-custom topnav-navbar" >
           
                   <div class="container-fluid">
                            <!-- LOGO -->
                            <a href="{{url('/user')}}" class="topnav-logo">
                                <span class="topnav-logo-lg">
                                    <img src="{{asset('/Image/logoweb.jpg')}}" alt="" height="50">
                                </span>  
                            </a>

                     <ul class="list-unstyled topbar-menu float-end mb-0">

                          <li class="dropdown notification-list d-lg-none">
                                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <i class="dripicons-search noti-icon"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                                    <form class="p-3">
                                        <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                    </form>
                                </div>
                            </li>



                            <li class="dropdown notification-list btn_load_notification">
                                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <i class="dripicons-bell noti-icon"></i>
                                    <span class="noti-icon-badge"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg">

                                      <!-- item-->
                                    <div class="dropdown-item noti-title">
                                            <span class="float-end" style="cursor: pointer;">
                                                <a class="text-dark btn-remove-notifia btn_delete_notification" >
                                                    <small>Xóa tất cả</small>
                                                </a>
                                            </span>
                                            Thông Báo 
                                        
                                    </div>

                                    <div style="max-height: 430px;" data-simplebar class="load_notification">
                                        <!-- item-->
                                    </div>

                                </div>
                            </li>

                            <li class="dropdown notification-list">

                                <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <span class="account-user-avatar"> 
                             
                                     <img  src="{{ (Auth::user()->patient->avt_user == 0) ? asset('/Image/avt_user.png') :
                                      asset('/Image/avt_user/'.Auth::user()->id.'/'.Auth::user()->patient->avt_user) }}" alt="user-image" 
                                     class="img-fluid rounded-circle" width="80">
                                  
                                      

                                    </span>
                                    <span>
                                        <span class="account-user-name">{{Auth::user()->name}}</span>
                                        <span class="account-position">{{Auth::user()->email}}</span>
                                    </span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                                    <!-- item-->
                                    <div class=" dropdown-header noti-title">
                                        <h6 class="text-overflow m-0">Chào mừng !</h6>
                                    </div>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="mdi mdi-account-circle me-1"></i>
                                        <span>Chỉnh sửa tài khoản</span>
                                    </a>

                                    <!-- item-->
                                    <a href="{{url('/logout')}}" class="dropdown-item notify-item">
                                        <i class="mdi mdi-logout me-1"></i>
                                        <span>Đăng xuất</span>
                                    </a>
                                </div>
                            </li>  
                       </ul>          
                      <a class="navbar-toggle" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample"
                      style="margin-right: 0px;margin-left: 0px;">
                                <div class="lines" >
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>

                         <div class="d-flex justify-content-center align-items-center">
                            <div class="app-search" style="width:45%;">
                                 <form method="POST">
                                    <div class="input-group">
                                        <input type="text" class="form-control input_searchxx" placeholder="Searchs..." id="top-search">
                                        <span class="mdi mdi-magnify search-icon"></span>
                                    </div>
                                </form>

                                <div class="dropdown-menu dropdown-menu-animated dropdown-lg" id="search-dropdown">
                                <!-- item-->
                             

                                 <div class="search-list" style="max-height: 450px;" data-simplebar="">

                                    

                                </div>
                            </div>
                           </div>
                     </div>


              </div>
        </nav>    
    </header>

<script type="text/javascript" charset="utf-8" async defer>
$(document).ready(function(){

 $( ".input_searchxx" ).on("input", function() {
        var vale_search = $( ".input_searchxx" ).val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
        url:"{{url('/user/search_doctor')}}",
        method:"GET",
         headers:{
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
        // dataType:"JSON",
        data:{vale_search:vale_search,_token:_token},
          success:function(data){
            $('.search-list').html(data);
            
          }
      });
   });
   





 $('.btn_load_notification').on("click", function(){
       load_notification();
   });
  load_notification();
       function load_notification(){
        var _token = $('input[name="_token"]').val();
        $.ajax({
        url:"{{url('/user/load_notification_booking')}}",
        method:"GET",
         headers:{
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
        // dataType:"JSON",
        data:{_token:_token},
          success:function(data){
            $('.load_notification').html(data);
            
          }
      });
    }

  $('.btn_delete_notification').on("click", function(){
       delete_notification();
   });

  function delete_notification(){
        var _token = $('input[name="_token"]').val();
        $.ajax({
        url:"{{url('/user/delete_notification')}}",
        method:"GET",
         headers:{
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
        // dataType:"JSON",
        data:{_token:_token},
          success:function(data){
            $.NotificationApp.send("","Xóa tất cả các thông báo thành công","top-right","#FF6347","success"); 
            
          }
      });
    }


  });

</script>
