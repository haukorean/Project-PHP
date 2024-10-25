@extends('UserLayout')
@section('contents_user')
<div class="row">
	<div class="col-lg-9">
		<div class="card p-2 mt-2">
			  	<h4 class="header-title text-center">{{$title_tag}}</h4>
			 
				<div class="row p-3">
					 @foreach($service as $ser)
			         <div class="col-lg-4">
			         	     <a href="{{url('/user/details_doctor/'.$ser->company->user->id)}}" >
			                   <div class="card-container card border-info border">  
			                    <div class="p-2">
			                        <img src="{{asset('/Image/Image_service/'.$ser->company->user->id.'/'.$ser->image)}}" class="card-img" alt="...">
			                        <h4 class="truncate-text user-select-none text-wrap text-info text-start mt-2">{{$ser->name}}</h4>
			                    </div> 
			                   </div>
			                </a>
			            </div>
					 @endforeach
				</div> 
          </div>
	</div>



   <div class="col-lg-3">
		<div class="card mt-2">
			     <div class="row"> 
					<div class="list-group">
					    <a class="list-group-item list-group-item-action active">Loại Dịch vụ Y tế</a>
					     <a href="{{url('/user/service_medical_user/all')}}" class="list-group-item list-group-item-action">Tất cả</a>
					    @foreach($all_service_me as $ser)
			              <a href="{{url('/user/service_medical_user/'.$ser->id)}}" class="list-group-item list-group-item-action">
			              	{{$ser->name}}</a>
				    	 @endforeach
					 
					   
				  </div>
					
				</div> 
          </div>
	</div>
</div>


	
@endsection