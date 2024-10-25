 <div class="sidebarLeft_user" data-simplebar>
        <div class="card">
            <div class="card-body">
            <div class="dropdown float-end">
              <a href="{{url('/user/update_profile')}}" class="badge bg-danger">EDIT</a>
             </div>     

                <div class="d-flex align-self-start">

                      <img  src="{{ (Auth::user()->patient->avt_user == 0) ? asset('/Image/avt_user.png') :
                       asset('/Image/avt_user/'.Auth::user()->id.'/'.Auth::user()->patient->avt_user) }}" alt="user-image" 
                      class="d-flex align-self-start rounded me-2" width="48">
                                      
                
                    <div class="w-100 overflow-hidden">
                        <h5 class="mt-1 mb-0">{{Auth::user()->name}}</h5>
                        <p class="mb-1 mt-1 text-muted">....</p>
                    </div>
             
                </div>
             
                 <div class="text-start card border-info border">
                     <div class="p-1">
                       <p class="text-muted"><strong>Chiều Cao:</strong><span class="ms-2">{{Auth::user()->patient->height}}(Cm)</span> </p>
                       <p class="text-muted"> <strong>Cân Nặng:</strong> <span class="ms-2">{{Auth::user()->patient->weight}}(Kg)</span> </p>
                       <p class="text-muted"><strong>Nhóm Máu:</strong> 
                         {{Auth::user()->patient->blood_group}}
              
                      </p>
                    <!--    <p class="text-muted"><strong>Health condition:</strong> <span class="ms-2">Khoe</span></p>
                       <p class="text-muted"><strong>Recent diagnosis:</strong> <span class="ms-2">Khoe</span></p> -->
                     </div>

                </div>
                
                <div class="list-group list-group-flush mt-2">
                    <a href="{{url('/user')}}" class="list-group-item list-group-item-action border-0">
                      <i class="uil-home-alt me-1"></i>Trang chủ</a>
                    <a href="{{url('/user/handbook_user')}}" class="list-group-item list-group-item-action border-0">
                      <i class="uil-book-open me-1"></i>Cẩm Nang Y Tế</a>
                    <a href="{{url('/user/specialistDT_user/all')}}" class="list-group-item list-group-item-action border-0">
                      <i class="uil-medal me-1"></i>Chuyên Khoa</a>
                   <a href="{{url('/user/service_medical_user/all')}}" class="list-group-item list-group-item-action border-0">
                      <i class="uil-medkit me-1"></i>Dịch Vụ Y Tế</a>
                    <a href="{{url('/user/schedule_user')}}" class="list-group-item list-group-item-action border-0">
                      <i class="uil-schedule me-1"></i>Lịch Hẹn Của Tôi</a>
                    <a href="{{url('/user/history_medical_doctor')}}" class="list-group-item list-group-item-action border-0">
                      <i class="uil-heartbeat me-1"></i>Hồ Sơ Bệnh Án Của Tôi</a>
             <!--         <a href="" class="list-group-item list-group-item-action border-0">
                      <i class="uil-comment-alt-chart-lines me-1"></i>Chat</a>
                     <a href="" class="list-group-item list-group-item-action border-0">
                      <i class="uil-question-circle me-1"></i>Q&A</a> 
                  <a href="" class="list-group-item list-group-item-action border-0">
                      <i class="uil-bookmark-full me-1"></i>Saved</a> -->
                </div>
            </div>
        </div>
 </div>


<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
<div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">MENU</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
  <div class="offcanvas-body">
             <div class="">
                  <div class="card-body">
                      <div class="list-group list-group-flush">
                          <a href="{{url('/user')}}" 
                          class="list-group-item list-group-item-action y border-0">
                            <h4><i class="uil-home-alt me-1"></i>Trang chủ</h4> </a>

                          <a href="{{url('/user/handbook_user')}}" class="list-group-item list-group-item-action border-0">
                              <h4>  <i class="uil-book-open me-1"></i>Cẩm Nang Y Tế</h4></a>

                          <a href="{{url('/user/specialistDT_user/all')}}" class="list-group-item list-group-item-action border-0">
                              <h4><i class="uil-medal me-1"></i>Chuyên Khoa</h4></a>

                         <a href="{{url('/user/service_medical_user/all')}}" class="list-group-item list-group-item-action border-0">
                              <h4> <i class="uil-medkit me-1"></i>Dịch Vụ Y Tế</h4></a>


                          <a href="{{url('/user/schedule_user')}}" class="list-group-item list-group-item-action border-0">
                              <h4><i class="uil-schedule me-1"></i>Lịch Hẹn Của Tôi</h4></a>

                          <a href="{{url('/user/history_medical_doctor')}}" class="list-group-item list-group-item-action border-0">
                          <h4><i class="uil-heartbeat me-1"></i>Hồ Sơ Bệnh Án Của Tôi</h4></a>
                      </div>
                  </div>
               </div>                         
     </div>
 </div>