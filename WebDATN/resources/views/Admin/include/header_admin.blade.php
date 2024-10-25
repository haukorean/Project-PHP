    <header>
        <nav class="navbar-custom topnav-navbar">
           
                   <div class="container-fluid">
                            <!-- LOGO -->
                            <a href="{{url('/admin')}}" class="topnav-logo">
                                <span class="topnav-logo-lg">
                                    <img src="{{url('/Image/logoweb.jpg')}}" alt="" height="50">
                                </span>  
                            </a>

                     <ul class="list-unstyled topbar-menu float-end mb-0">

            


                            <li class="dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <i class="dripicons-bell noti-icon"></i>
                                    <span class="noti-icon-badge"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg">

                                    <!-- item-->
                                    <div class="dropdown-item noti-title">
                                        <h5 class="m-0">
                                            <span class="float-end">
                                                <a href="javascript: void(0);" class="text-dark">
                                                    <small>Clear All</small>
                                                </a>
                                            </span>Notification
                                        </h5>
                                    </div>

                                    <div style="max-height: 230px;" data-simplebar="">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-primary">
                                                <i class="mdi mdi-comment-account-outline"></i>
                                            </div>
                                            <p class="notify-details">Caleb Flakelar commented on Admin
                                                <small class="text-muted">1 min ago</small>
                                            </p>
                                        </a>


                                    </div>

                                    <!-- All-->
                                    <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                                        View All
                                    </a>

                                </div>
                            </li>

                            <li class="dropdown notification-list">

                                <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <span class="account-user-avatar"> 

                                     <img  src="{{url('/Image/avt_user.png')}}" alt="user-image" 
                                     class="img-fluid rounded-circle" width="80">
                                   

                                    </span>
                                    <span>
                                        <span class="account-user-name">{{Auth::user()->name}}</span>
                                        <span class="account-position">{{Auth::user()->email}}</span>
                                    </span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                    
                                    <!-- item-->
                                    <a href="{{url('/logout-admin')}}" class="dropdown-item notify-item">
                                        <i class="mdi mdi-logout me-1"></i>
                                        <span>Đăng Xuất</span>
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



              </div>
        </nav>    
    </header>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                 <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasExampleLabel">MENU</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                    <div class="offcanvas-body">
                               <div class="">
                                    <div class="card-body">
                                        <div class="list-group list-group-flush">
                                               <a href="{{url('/')}}" 
                                            class="list-group-item list-group-item-action y border-0">
                                              <h4><i class='uil uil-home-alt me-1'></i> For you</h4> </a>

                                            <a href="{{url('/PagesVideo')}}" class="list-group-item list-group-item-action border-0">
                                                <h4><i class='uil uil-video me-1'></i> Video</h4></a>

                                            <a href="{{url('/PageShopping')}}" class="list-group-item list-group-item-action border-0">
                                                <h4><i class='uil  uil-shop me-1'></i> Shopping</h4></a>

                                            <a href="{{url('/PagesExplore')}}" class="list-group-item list-group-item-action border-0">
                                                <h4><i class='uil uil-users-alt me-1'></i> Explore</h4></a>
                                        </div>
                                    </div>
                     </div>                         
           </div>
       </div>
