@extends('UserLayout')
@section('contents_user')

<div class="row" >
	<div class="col-lg-1"></div>

     <div class="col-lg-10">
	    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
	    <div class="carousel-inner" role="listbox" style="border-radius: 25px; height: 300px; margin-top: 10px; object-fit: cover">
	        <div class="carousel-item active">
	            <img class="d-block img-fluid inner-img" src="{{asset('/Image/slide/banner1.png')}}" alt="First slide">
	        </div>
	        <div class="carousel-item">
	            <img class="d-block img-fluid inner-img"  src="{{asset('/Image/slide/banner2.png')}}" alt="Second slide">
	        </div>
	        <div class="carousel-item">
	            <img class="d-block img-fluid inner-img"  src="{{asset('/Image/slide/banner3.png')}}" alt="Third slide">
	        </div>
	    </div>
	</div>

<!----------------------------------slide item service ------------------------------------->

   <div class="row mt-3 ">
    <div class="col-lg-12"> 
         <div class="slider-container-ser">
            <div class="slider-ser">
              @foreach($service as $key => $vid)         
               <div class="slider-item-ser me-2">
                   <a class="btn btn-outline-info " href="{{url('/user/service_medical_user/'.$vid->id)}}" style=""> <h4>{{$vid->name}}</h4></a>
               </div>
              @endforeach
 
             </div>
          </div>

           <div class="nav_slide_ser d-flex justify-content-center">
              <button class="btn-prev-ser btn_control prev border-info border"><i class="dripicons-chevron-left"></i></button>
              <button class="btn-next-ser btn_control next border-info border"><i class="dripicons-chevron-right"></i></button>
           </div>
      </div>
   </div>
   

<!----------------------------------slide item specialist ------------------------------------->

   <div class=" row">
      
      <div class="col-lg-12">
         <h2 class="float-start">Chuyên Khoa</h2>

         <a class="float-end" href="{{url('/user/specialistDT_user/all')}}"><h3> <span class="badge badge-info-lighten">Xem</span></h3></a>
      </div>        


       <div class="col-lg-12"> 
         <div class="slider-container">
            <div class="slider">
                @foreach($specialist as $key => $vid)
                    <div class="slider-item card-container card border-info border">
                          <a href="{{url('/user/specialistDT_user/'.$vid->id)}}">  
                            <div class="p-1">
                                <img src="{{asset('/Image/specialist/'.$vid->image)}}" class="card-img" alt="...">
                                <h4 class="user-select-none text-wrap text-info text-center mt-2">{{$vid->specialist}}</h4>
                             </div> 
                           </a>
              

                    </div>
                 @endforeach
 
             </div>
          </div>

           <div class="nav_slide">
              <button class="btn-prev btn_control prev border-info border"><i class="dripicons-chevron-left"></i></button>
              <button class="btn-next btn_control next border-info border"><i class="dripicons-chevron-right"></i></button>
           </div>
       </div>
   
  </div> 



<!----------------------------------slide item health facilities ------------------------------------>


   <div class=" row pt-2 ps-1 pe-1" style="background: #f1f7fd">

      <div class="col-lg-12">
              <h2 class="float-start">Bác sĩ xuất sắc</h2>
              <a class="float-end" href="{{url('/user/specialistDT_user/all')}}"><h3> <span class="badge badge-info-lighten">Xem</span></h3></a>
     </div>        


       <div class="col-lg-12"> 
         <div class="slider-container-dt">
            <div class="slider-dt">
              @foreach($list_doctor as $key => $vid)
           
                <div class="slider-item-dt card-container1 ">
                        <div class=""> 
                         <a href="{{url('/user/details_doctor/'.$vid->id)}}"> 
                          <div class="p-2">
                              <img src="{{asset('/Image/avt_user/'.$vid->id.'/'.$vid->doctor->avt_user)}}" 
                                class="img-fluid img-thumbnail rounded-circle" width="1000" alt="...">
                              <h4 class="user-select-none text-wrap text-info text-center mt-1">{{$vid->name}}</h4>
                              <p class="text-muted font-14 text-wrap text-center ">
                                 {{$vid->company->specialist->specialist}}
                              </p>
                          </div> 
                       </a>
                          </div>
                  </div>
                
               @endforeach
 
             </div>
          </div>

           <div class="nav_slide_dt">
              <button class="btn-prev-dt btn_control prev border-info border"><i class="dripicons-chevron-left"></i></button>
              <button class="btn-next-dt btn_control next border-info border"><i class="dripicons-chevron-right"></i></button>
           </div>
      </div>
   
   </div> 


   <!----------------------------------slide item handbook medical ------------------------------------->

   <div class="row mt-3">
      
      <div class="col-lg-12">
         <h2 class="float-start">Cẩm Nang Y Tế</h2>

         <a class="float-end" href="{{url('/user/handbook_user')}}"><h3> <span class="badge badge-info-lighten">Xem</span></h3></a>
      </div>        


       <div class="col-lg-12"> 
         <div class="slider-container-handbook">
            <div class="slider-handbook">
                @foreach($list_handbook as $key => $vid)
                    <div class="slider-item-handbook card-container card border-info border">
                          <a href="{{url('/user/details_handbook/'.$vid->id)}}">  
                            <div class="p-1">
                                <img src="{{asset('/Image/Image_handbook/'.$vid->id_doctor.'/'.$vid->image)}}" class="card-img" alt="...">
                                <div class="text-container">
                                   <h4 class="truncate-text user-select-none text-wrap text-info text-start mt-2">
                                    {{$vid->title}}</h4>
                                </div>
                             </div> 
                           </a>
              

                    </div>
                 @endforeach
 
             </div>
          </div>

           <div class="nav_slide_handbook">
              <button class="btn-prev-handbook btn_control prev border-info border"><i class="dripicons-chevron-left"></i></button>
              <button class="btn-next-handbook btn_control next border-info border"><i class="dripicons-chevron-right"></i></button>
           </div>
       </div>
   
  </div> 



   

   </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
  var slideCount = $('.slider-item-ser').length;
  var slideWidth_ser = $('.slider-item-ser').outerWidth(true);
  var slideContainerWidth = slideCount * slideWidth_ser;

  $('.slider-ser').css('width', slideContainerWidth);

  var currentPosition = 0;
  var slideOffset = slideWidth_ser+100; // Điều chỉnh khoảng cách di chuyển giữa các mục (items)
   
  // Xử lý sự kiện khi bấm nút "Next"
  $('.btn-next-ser').click(function() {
      // alert(slideWidth_ser)
    if (currentPosition > -(slideContainerWidth - slideOffset)) {
      currentPosition -= slideOffset;
      $('.slider-ser').css('transform', 'translateX(' + currentPosition + 'px)');
    }
  });

  // Xử lý sự kiện khi bấm nút "Previous"
  $('.btn-prev-ser').click(function() {
    if (currentPosition < 0) {
      currentPosition += slideOffset;
      $('.slider-ser').css('transform', 'translateX(' + currentPosition + 'px)');
    }
  });
});

  
</script>

<script type="text/javascript">
  $(document).ready(function() {
  var slideCount = $('.slider-item').length;
  var slideWidth = $('.slider-item').outerWidth(true);
  var slideContainerWidth = slideCount * slideWidth;

  $('.slider').css('width', slideContainerWidth);

  var currentPosition = 0;
  var slideOffset = slideWidth+100; // Điều chỉnh khoảng cách di chuyển giữa các mục (items)

  // Xử lý sự kiện khi bấm nút "Next"
  $('.btn-next').click(function() {
    if (currentPosition > -(slideContainerWidth - slideOffset)) {
      currentPosition -= slideOffset;
      $('.slider').css('transform', 'translateX(' + currentPosition + 'px)');
    }
  });

  // Xử lý sự kiện khi bấm nút "Previous"
  $('.btn-prev').click(function() {
    if (currentPosition < 0) {
      currentPosition += slideOffset;
      $('.slider').css('transform', 'translateX(' + currentPosition + 'px)');
    }
  });
});

  
</script>


<script type="text/javascript">
  $(document).ready(function() {
  var slideCount = $('.slider-item-dt').length;
  var slideWidth_dt = $('.slider-item-dt').outerWidth(true);
  var slideContainerWidth = slideCount * slideWidth_dt;

  $('.slider-dt').css('width', slideContainerWidth);

  var currentPosition = 0;
  var slideOffset = slideWidth_dt+100; // Điều chỉnh khoảng cách di chuyển giữa các mục (items)

  // Xử lý sự kiện khi bấm nút "Next"
  $('.btn-next-dt').click(function() {

    if (currentPosition > -(slideContainerWidth - slideOffset)) {
      currentPosition -= slideOffset;
      $('.slider-dt').css('transform', 'translateX(' + currentPosition + 'px)');
    }
  });

  // Xử lý sự kiện khi bấm nút "Previous"
  $('.btn-prev-dt').click(function() {
    if (currentPosition < 0) {
      currentPosition += slideOffset;
      $('.slider-dt').css('transform', 'translateX(' + currentPosition + 'px)');
    }
  });
});

  
</script>


<script type="text/javascript">
  $(document).ready(function() {
  var slideCount = $('.slider-item-handbook').length;
  var slideWidth_dt = $('.slider-item-handbook').outerWidth(true);
  var slideContainerWidth = slideCount * slideWidth_dt;

  $('.slider-handbook').css('width', slideContainerWidth);

  var currentPosition = 0;
  var slideOffset = slideWidth_dt+100; // Điều chỉnh khoảng cách di chuyển giữa các mục (items)

  // Xử lý sự kiện khi bấm nút "Next"
  $('.btn-next-handbook').click(function() {

    if (currentPosition > -(slideContainerWidth - slideOffset)) {
      currentPosition -= slideOffset;
      $('.slider-handbook').css('transform', 'translateX(' + currentPosition + 'px)');
    }
  });

  // Xử lý sự kiện khi bấm nút "Previous"
  $('.btn-prev-handbook').click(function() {
    if (currentPosition < 0) {
      currentPosition += slideOffset;
      $('.slider-handbook').css('transform', 'translateX(' + currentPosition + 'px)');
    }
  });
});

  
</script>

<style type="text/css" media="screen">
  .inner-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
}
</style>

@endsection