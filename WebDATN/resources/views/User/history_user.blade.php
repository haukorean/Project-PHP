@extends('UserLayout')
@section('contents_user')
<div class="card mt-2">
 <div class="row">
	<div class="col-lg-8 p-2 border-end">
		    <h4 class="header-title text-center">Your medical history</h4>
	          <div class="d-flex justify-content-center align-items-center app-search" >
	             <!--      <input type="hidden" name="_token" value="MY8bTdAATR7NSq3bK5nxSYHvqDJehaRKg9hrghWA"> -->
	                  <div class="input-group" style="width: 40%">
	                      <input type="text" class="form-control value_search_schedule" placeholder="Tìm kiếm..." id="top-search">
	                      <span class="mdi mdi-magnify search-icon"></span>
	                  </div>
	        
	         </div>

	         <div class="load_history_schedule ms-2 mt-2">
	         	
	         </div>

			
	</div>

	<div class="col-lg-4 p-2">
		 <h4 class="header-title text-center">List of Doctor</h4>
	          <div class="d-flex justify-content-center align-items-center app-search" >
	             <!--      <input type="hidden" name="_token" value="MY8bTdAATR7NSq3bK5nxSYHvqDJehaRKg9hrghWA"> -->
	                  <div class="input-group" style="width: 70%">
	                      <input type="text" class="form-control value_search_user" placeholder="Tìm kiếm..." id="top-search">
	                      <span class="mdi mdi-magnify search-icon"></span>
	                  </div>
	        
	         </div>

	          <div class="load_list_patient mt-2">
	         	
	         </div>
			
	</div>
 </div>
</div>


<script type="text/javascript">
 $(document).ready(function(){

  load_history_schedule(0 , 0);
  function load_history_schedule(key, value){
        var _token = $('input[name="_token"]').val();
        $.ajax({
        url:"{{url('/user/load_history_schedule')}}",
        method:"GET",
         headers:{
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
        // dataType:"JSON",
        data:{key:key,value:value,_token:_token},
          success:function(data){
           $('.load_history_schedule').html(data);
          }
      });
    }

 $(document).on('click','.click_item_user', function(){
    var id = $(this).closest(".item").find(".id_user").val();  
    load_history_schedule("filter", id);     
  });

  $( ".value_search_schedule" ).on("input", function() {
    var val = $(".value_search_schedule").val();      
      if(val==""){
	    load_history_schedule(0 , 0);
	  }else{
	    load_history_schedule("search", val);   
	  } 
  });


///////////////////////////////////////////////////////////////////

  load_list_patient(0);
  function load_list_patient(value){
      var _token = $('input[name="_token"]').val();
        $.ajax({
        url:"{{url('/user/load_list_doctor')}}",
        method:"GET",
         headers:{
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
        // dataType:"JSON",
        data:{value:value,_token:_token},
          success:function(data){
           $('.load_list_patient').html(data);
          }
      });
    }

  $( ".value_search_user" ).on("input", function() {
     var val = $(".value_search_user").val();
	     if(val==""){
	     load_list_patient(0);
	     }else{
	     load_list_patient(val);     
	     } 
     
  });




  $(document).on('click','.cancel_schedule',function(){
    var id = $(this).data('id_schedule');
    var _token = $('input[name="_token"]').val();
      $.ajax({
          url:"{{url('/doctor/cancel_schedule')}}",
          method:"GET",
          // dataType:"JSON",
          headers:{
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
         data:{id:id, _token:_token},
          success:function(data){
          $('.btn-close').click();
            load_history_schedule(0 , 0);
          }

      }); 
  });



 });
</script>

@endsection