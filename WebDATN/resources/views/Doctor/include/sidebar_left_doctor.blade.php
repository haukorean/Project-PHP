 <div class="sidebarLeft" data-simplebar>
        <div class="card">
            <div class="card-body">
            <div class="dropdown float-end">
              <a href="{{url('/doctor/update_profile')}}" class="badge bg-danger">Sửa</a>
             </div>     

                <div class="d-flex align-self-start">
                  <img  src="{{ (Auth::user()->doctor->avt_user == 0) ? asset('/Image/avt_user.png') :
                       asset('/Image/avt_user/'.Auth::user()->id.'/'.Auth::user()->doctor->avt_user) }}" alt="user-image" 
                      class="d-flex align-self-start rounded me-2" width="48">         
                
                    <div class="w-100 overflow-hidden">
                        <h5 class="mt-1 mb-0">{{Auth::user()->name}}</h5>
                        <p class="mb-1 mt-1 text-muted">....</p>
                    </div>
             
                </div>
             
                 <div class="text-start card border-info border">
      
                     <div class="p-1">
                       <p class="text-muted"><strong>Lịch Trình Hôm Nay:</strong>
                        <span class="ms-2 badge badge-outline-danger float-end today">0</span></p>
                       <p class="text-muted"> <strong>Lịch Trình Sắp Tới:</strong>
                        <span class="ms-2 badge badge-outline-danger float-end upcomming">0</span></p>  
                       <p class="text-muted"><strong>Lịch Trình Lỡ Hẹn:</strong> 
                        <span class="ms-2 badge badge-outline-danger float-end missed">0</span></p>
                       <p class="text-muted"><strong>Số Lần Khám Bệnh:</strong>
                        <span class="ms-2 badge badge-outline-danger float-end total">0</span></p>
                     
                     </div>
                </div>
                
                <div class="list-group list-group-flush mt-2">
                    <a href="{{url('/doctor')}}" class="list-group-item list-group-item-action border-0">
                      <i class=" uil-chart-line me-1"></i>Thống Kê</a>
                    <a href="{{url('/doctor/schedule_doctor')}}" class="list-group-item list-group-item-action border-0">
                      <i class="uil-schedule me-1"></i>Lịch Trình </a>
                    <a href="{{url('/doctor/handbook_doctor')}}" class="list-group-item list-group-item-action border-0">
                      <i class="uil-book-open me-1"></i>Cẩm Nang</a>
                
                    <a href="{{url('/doctor/service_doctor')}}" class="list-group-item list-group-item-action border-0">
                      <i class="uil-medkit me-1"></i>Dịch Vụ Phòng Khám</a>
                      
                    <a href="{{url('/doctor/history_medical_doctor')}}" class="list-group-item list-group-item-action border-0">
                      <i class="uil-history me-1"></i>Lịch Sử Khám Bệnh</a>

                  <!--    <a href="" class="list-group-item list-group-item-action border-0">
                      <i class="uil uil-comment-alt-chart-lines me-1"></i>Chat</a> -->
                  <!--    <a href="" class="list-group-item list-group-item-action border-0">
                      <i class="uil-question-circle me-1"></i>Q&A</a> -->
                     <a href="{{url('/doctor/clinic_doctor')}}" class="list-group-item list-group-item-action border-0">
                      <i class="uil-medical-drip me-1"></i>Cài Đặt Phòng Khám</a>
                    
                </div>
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
                          <a href="{{url('/doctor')}}" 
                          class="list-group-item list-group-item-action y border-0">
                            <h4> <i class=" uil-chart-line me-1"></i>Thống Kê</h4> </a>

                          <a href="{{url('/doctor/schedule_doctor')}}" class="list-group-item list-group-item-action border-0">
                              <h4> <i class="uil-schedule me-1"></i>Lịch Trình</h4></a>

                          <a href="{{url('/doctor/handbook_doctor')}}" class="list-group-item list-group-item-action border-0">
                              <h4><i class="uil-book-open me-1"></i>Cẩm Nang</h4></a>

                          <a href="{{url('/doctor/service_doctor')}}" class="list-group-item list-group-item-action border-0">
                              <h4> <i class="uil-medkit me-1"></i>Dịch Vụ Phòng Khám</h4></a>

                          <a href="{{url('/doctor/history_medical_doctor')}}" class="list-group-item list-group-item-action border-0">
                              <h4><i class="uil-history me-1"></i>Lịch Sử Khám Bệnh</h4></a>

                          <a href="{{url('/doctor/clinic_doctor')}}" class="list-group-item list-group-item-action border-0">
                          <h4> <i class="uil-medical-drip me-1"></i>Cài Đặt Phòng Khám</h4></a>
                      </div>
                  </div>
               </div>                         
     </div>
 </div>
<script type="text/javascript" charset="utf-8" async defer>
 $(document).ready(function(){

  load_count_schedule()
       function load_count_schedule(){
        var _token = $('input[name="_token"]').val();
        $.ajax({
        url:"{{url('/doctor/load_count_schedule')}}",
        method:"GET",
         headers:{
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
        dataType:"JSON",
        data:{_token:_token},
          success:function(data){

            $('.today').html(data.today);
            $('.upcomming').html(data.upcomming);
            $('.missed').html(data.missed);
            $('.total').html(data.total);
          }
      });
    }
  });
 </script>  
     