@extends('UserLayout')
@section('contents_user')
<div class="card p-2 mt-2">
  	<h4 class="header-title text-center">Tất cả các cẩm nang y tế</h4>
          <div class="d-flex justify-content-center align-items-center app-search" >
             <!--      <input type="hidden" name="_token" value="MY8bTdAATR7NSq3bK5nxSYHvqDJehaRKg9hrghWA"> -->
                  <div class="input-group" style="width: 40%">
                      <input type="text" class="form-control value_search" placeholder="Tìm kiếm..." id="top-search">
                      <span class="mdi mdi-magnify search-icon"></span>
                  </div>
        
         </div>

	<div class="row p-3 row_all">
		 @foreach($handbook as $book)
         <div class="col-lg-3">
         	     <a href="{{url('/user/details_handbook/'.$book->id)}}" >
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
	
<script type="text/javascript">
$(document).ready(function(){
    $( ".value_search" ).on("input", function() {
      var value = $('.value_search').val();
      var _token = $('input[name="_token"]').val();
      if(value==""){
         $('.row_search').hide();
         $('.row_all').show();
      }else{

        $.ajax({
          url:"{{url('/user/search_page_handbook')}}",
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