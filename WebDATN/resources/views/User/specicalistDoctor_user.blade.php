@extends('UserLayout')
@section('contents_user')
<div class="row">
	<div class="col-lg-9">
		<div class="card p-2 mt-2">
			<input type="hidden" class="id_status" value="{{$status}}">
			  	<h4 class="header-title text-center">{{$title_tag}}</h4>
			 
				  <div class="row p-2">
					 <div class="form-floating col-lg-12">
	                    <select class="form-select city" id="city" aria-label="Floating label select example">
	                    <option value="0">--Chọn tỉnh thành phố-----</option>
	                    @foreach($city as $key => $ci)
	                    <option class="optionck" value="{{$ci->matp}}">{{$ci->name}}</option>
	                    @endforeach   
	                    </select>
	                    <label for="floatingSelect">Choose Thành Phố</label>
                     </div>
                   </div>
                  <div class="row p-2 load_doctor">
					 @foreach($doctor as $dt)
			           <div class="col-lg-12 mt-1">
			                   <div class="card-container card border-info border">  
			                    <div class="row p-1">
                                  <div class="col-md-4">
	                                   <img  src="{{ ($dt->doctor->avt_user == 0) ? asset('/Image/avt_user.png') :
	                                      asset('/Image/avt_user/'.$dt->id.'/'.$dt->doctor->avt_user) }}" alt="user-image" 
	                                     class="card-img" >
                                  </div>
			                      <div class="col-md-8">
				                        <h4 class="user-select-none text-wrap text-info  mt-1">{{$dt->name}}</h4>
				                        <p class="user-select-none text-wrap">{{$dt->company->specialist->specialist}}</p>
				                        <span class="fw-bold">{{$dt->company->company_name}}</span><br>
                                        <span class="text-primary"><i class="dripicons-location"></i> {{$dt->company->company_address}}</span>

                                        <hr>
						                <h5 class="header-title pt-2">Giá khám (Mặc định): 
		                                <span>{{$dt->company->price}}.VND</span></h5>
		                              
				                        <a href="{{url('/user/details_doctor/'.$dt->id)}}"  class="btn btn-primary float-end float-bottom me-3">Đặt Lịch</a>
			                      </div>

			                    </div> 
			                   </div>
			          

			            </div>
					 @endforeach
	
				</div> 


          </div>
	</div>



   <div class="col-lg-3">
		<div class="card mt-2">
			     <div class="row"> 
					<div class="list-group">
					    <a class="list-group-item list-group-item-action active">Specialist </a>
					    <a href="{{url('/user/specialistDT_user/all')}}" class="list-group-item list-group-item-action">All</a>
					    @foreach($specialist_doctor as $spe)
			              <a href="{{url('/user/specialistDT_user/'.$spe->id)}}" class="list-group-item list-group-item-action">
			              	{{$spe->specialist}}
			              </a>

				    	@endforeach
					 
					   
				  </div>
					
				</div> 
          </div>
	</div>
</div>


<script type="text/javascript" charset="utf-8" async defer>

    $(document).ready(function(){

         $('#city').change(function(){ 
            var status = $('.id_status').val();
            var text = $('#city').find(":selected").text();
      
            var _token = $('input[name="_token"]').val();
           
            $.ajax({
                url : "{{url('/user/load_doctor_city')}}",
                method: 'GET',
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }, 
                data:{status:status,text:text,_token:_token},
                success:function(data){
                   $('.load_doctor').html(data); 
                 
                }
            });          
        });



   });
</script>


@endsection