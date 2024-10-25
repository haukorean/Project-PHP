@extends('DoctorLayout')
@section('contents_doctor')
<div class="card p-3 mt-2">

	<ul class="nav nav-tabs nav-bordered mb-3">
    <li class="nav-item">
        <a href="#home-b1" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
            <i class="mdi mdi-home-variant d-md-none d-block"></i>
            <span class="d-none d-md-block">Tất cả cẩm nang sức khỏe tại cộng đồng</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="#profile-b1" data-bs-toggle="tab" aria-expanded="true" class="nav-link ">
            <i class="mdi mdi-account-circle d-md-none d-block"></i>
            <span class="d-none d-md-block">Cẩm nang y tế của tôi</span>
        </a>
    </li>

</ul>

<div class="tab-content">
    <div class="tab-pane show active" id="home-b1">
        <h4 class="header-title text-center">Tất cả cẩm nang y tế</h4>
          <div class="d-flex justify-content-center align-items-center app-search" >
             <!--      <input type="hidden" name="_token" value="MY8bTdAATR7NSq3bK5nxSYHvqDJehaRKg9hrghWA"> -->
                  <div class="input-group" style="width: 40%">
                      <input type="text" class="form-control value_search" placeholder="Search..." id="top-search">
                      <span class="mdi mdi-magnify search-icon"></span>
                  </div>
        
         </div>

        <div class="row p-3 row_all">
           @foreach($handbook as $book)
               <div class="col-lg-3">
                     <a href="{{url('/doctor/details_handbook/'.$book->id)}}" >
                        <div class="card-container card border-info border">  
                          <div class="p-2">
                              <img src="{{asset('/Image/Image_handbook/'.$book->id_doctor.'/'.$book->image)}}" class="card-img" alt="...">
                                <h4 class="truncate-text user-select-none text-wrap text-info text-start mt-2">{{$book->title}}</h4>
                          </div> 
                         </div>
                      </a>
                  </div>
           @endforeach
        </div> 

       <div class="row p-3 row_search">

       </div> 

    </div>
    <div class="tab-pane" id="profile-b1">

     <a class="btn btn-lg font-16 btn-danger" href="{{url('/doctor/create_new_handbook')}}"> 
     <i class="mdi mdi-plus-circle-outline"></i>Create New Handbook Medical</a>
     <table class="table table-bordered border-primary table-centered mb-0 mt-2">
	    <thead>
	        <tr>
	            <th>Hình ảnh</th>
	            <th>Tiêu đề </th>
	            <th>Thời gian tạo</th>
	            <th>Trạng thái </th>
	            <th class="text-center"></th>
	        </tr>
	    </thead>
	    <tbody id="load_my_handbook">
        
  
	      

	    </tbody>
	</table>
    </div>
   
</div>
	
</div>

<div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" data-simplebar data-simplebar-primary>
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Chi tiết bài viết </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                   <img id="my_image" src="" alt="my_image" class="img-fluid" style="width: 100%; height: auto;" />
                </div>   
                <h3 class="page-title title"></h3>
                <p class="text-muted"><strong>Tác giả:</strong> <span class="ms-2 auth"></span></p>
                <p class="text-muted"><strong>thời gian:</strong> <span class="ms-2 time"></span></p>
                <input type="hidden" class="idpost" >

                <hr>
                <div id="content">
                  
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
 $(document).ready(function(){


  $(document).on('click','.btn_view_item', function(){
      var idpost = $(this).closest("td").find(".idpost").val();  
      var title = $(this).closest("td").find(".title").val();
      var date = $(this).closest("td").find(".date").val();    
      var auth = $(this).closest("td").find(".auth").val();
      var status = $(this).closest("td").find(".status").val();
      var content = $(this).closest("td").find(".content").html(); 

      $('.idpost').val(idpost);
      var image = $(this).closest("tr").find("img").attr('src'); 
      $('#my_image').attr('src',image);
      
      $('.title').text(title);
      $('.auth').text(auth);
      $('.time').html(date);
      $('#content').html(content);
      if(status == 1){
        $('.btn_approve').hide();
      }else{
        $('.btn_approve').show();
      }
         
  });

 /////////////////// Xoa bai viet ////////////////////////

  $(document).on('click','.btn_remove_item', function(){
    var id = $(this).closest("td").find(".idpost").val();  
    var _token = $('input[name="_token"]').val();
      if(confirm("Do you want to remove this post ?")) {
          $.ajax({
          url:"{{url('/doctor/remove_post_doctor')}}",
          method:"GET",
          headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },

          data:{id:id,_token:_token},
            success:function(data){
               load_my_handbook(0); 
            }
        });

     } 
       
  });





  load_my_handbook()
       function load_my_handbook(){
        var _token = $('input[name="_token"]').val();
        $.ajax({
        url:"{{url('/doctor/load_my_handbook')}}",
        method:"GET",
         headers:{
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
        // dataType:"JSON",
        data:{_token:_token},
          success:function(data){
            $('#load_my_handbook').html(data);
       
          }
      });
    }



////////////////////////////////////////////////

 $( ".value_search" ).on("input", function() {
      var value = $('.value_search').val();
      var _token = $('input[name="_token"]').val();
      if(value==""){
         $('.row_search').hide();
         $('.row_all').show();
      }else{

        $.ajax({
          url:"{{url('/doctor/search_page_handbook')}}",
          method:"GET",
          // dataType:"JSON",
          headers:{
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
         data:{value:value, _token:_token},
          success:function(data){
            $('.row_all').hide();
            $('.row_search').show();
            $('.row_search').html(data);
          }
        })
      }
      
    });

 });
 </script>


@endsection