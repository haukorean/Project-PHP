@extends('UserLayout')
@section('contents_user')
<div class=" card p-3 mt-2">
   <div class="d-flex justify-content-center">
     <img id="my_image" src="{{asset('/Image/Image_handbook/'.$handbook->user_auth->id.'/'.$handbook->image)}}" alt="my_image" class="img-fluid" style="width: 100%; height: 400px; object-fit: cover;" />
    </div>   
    <h3 class="page-title title">{{$handbook->title}}</h3>
    <p class="text-muted"><strong>Tác giả :</strong> <span class="ms-2 auth">{{$handbook->user_auth->name}}</span></p>
    <p class="text-muted"><strong>Thời gian:</strong> <span class="ms-2 time">{{$handbook->date}}</span></p>
    <input type="hidden" class="idpost" >

    <hr>
    <div id="content">
     {!!$handbook->content!!}
  </div>
	
</div>
	
@endsection