@extends('DoctorLayout')
@section('contents_doctor')
<div class="row mt-1">
    <div class="col-lg-1"></div>
    <div class="card col-lg-10">
       <div class="card-body">
            <h3 class="page-title text-center">Thông tin phòng khám</h3>
        <form action="{{url('/doctor/save_update_company')}}" method="post" enctype="multipart/form-data">
                     @csrf
                  <div class="row">
                      <div class="col-lg-2"></div>
                      <div class="col-lg-3">
                            <div class="image-input d-flex align-items-center justify-content-center">
                          
                                <img src="{{ (Auth::user()->doctor->avt_user == 0) ? asset('/Image/avt_user.png') :
                                asset('/Image/avt_user/'.Auth::user()->id.'/'.Auth::user()->doctor->avt_user) }}" 
                                class="img-thumbnail">

                              </div>

                             
                        </div>
                        <div class="col-lg-5">
                         <div class="mb-2 row">
                              <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Email</label>
                              <div class="col-sm-10">
                              <input type="text" name="email" value="{{Auth::user()->company->company_email}}" class="form-control form-control-sm name" id="colFormLabelSm" placeholder="name" required>
                              </div>
                              
                          </div>

                          <div class="mb-2 row">
                              <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Tên</label>
                              <div class="col-sm-10">
                              <input type="text" name="name" value="{{Auth::user()->company->company_name}}" class="form-control form-control-sm name" id="colFormLabelSm" placeholder="name" required>
                              </div>
                              
                          </div>

                          <div class="mb-2 row">
                              <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm" >SDT</label>
                              <div class="col-sm-10">
                              <input type="text" name="phone" class="form-control form-control-sm phone phoneNumberInput" id="colFormLabelSm"  placeholder="(+84) 000-000-000" maxlength="12" data-toggle="input-mask" value="{{Auth::user()->company->company_phone}}" data-mask-format="0000-000-000" required>
                                 <span class="font-13 text-muted">Vi "(+84) (000) 0000-000"</span>
                              </div>
                          </div>

                    <!--        <div class="mb-2 row">
                              <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm" >Fee</label>
                              <div class="col-sm-10">
                             <input type="text" class="form-control form-control-sm price" name="price" value="{{Auth::user()->company->price}}" data-toggle="input-mask" 
	                          data-mask-format="000.000.000.000.000" 
	                          data-reverse="true" maxlength="22" required>
                              </div>
                          </div> -->

                         </div>   
                        </div>
              <hr>



						<ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
						    <li class="nav-item">
						        <a href="#home1" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 active">
						            <i class="mdi mdi-home-variant d-md-none d-block"></i>
						            <span class="d-none d-md-block">Thông tin cơ bản</span>
						        </a>
						    </li>
						    <li class="nav-item">
						        <a href="#profile1" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0">
						            <i class="mdi mdi-table-settings d-md-none d-block"></i>
						            <span class="d-none d-md-block">Đặt thời gian làm việc</span>
						        </a>
						    </li>
						  
						</ul>

				<div class="tab-content">
						  <div class="tab-pane show active" id="home1">
                <div class="row">
                    <div class="col-md-8">
                         <label class="form-label">về phòng khám </label>
                          <p class="text-muted font-13 row">Hãy mô tả điều gì đó về phòng khám y tế</p>
                    </div>
						       
                    <div class="col-md-4"> 
                      <span class="btn float-end"><p class="text-black font-19 mt-1"><strong>Mở cửa  / Đóng cửa</strong>  
                         <span class="float-end ms-2">
                          @if(Auth::user()->company->status == 1 )
                            <input type="checkbox" class="checkbox_time" id="checkb1" checked data-switch="success" value=""/>
                          @else
                            <input type="checkbox" class="checkbox_time" id="checkb1" data-switch="success" value=""/>
                          @endif
                             
                              <label for="checkb1" data-on-label="Open" data-off-label="Close" class="mb-0 d-block"></label>
                          </span>
                         </p>
                        </span>
                         <input type="hidden" class="checkbox_status" name="checkbox_status" value="{{Auth::user()->company->status}}">
                      </div>
                  
                  
                    </div>
						       <div class="row mt-1" >
                      <div class="col-md-12">
                        <textarea data-toggle="maxlength" class="form-control about_me" name="about_us" maxlength="225" rows="4" 
                            placeholder="This about me has a limit of 225 chars.">{{Auth::user()->company->about_us}}</textarea>
                      </div>
                   
                     </div> 

                     <hr>

                     <div class="row mt-1">  
                          <label class="form-label">Địa chỉ  
                           <button type="button" class=" mt-1 btn btn-success btn-sm float-end" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg">Thay đổi </button>
                         </label>                            
                            
                          <div class="col-lg-12">
                                <div class="form-floating mt-1 mb-3">
                                   <input type="text" class="form-control address_company" id="floatingInput" name="address_company" placeholder="" value="{{Auth::user()->company->company_address}}"  required/>
                                       <label for="floatingInput">Địa chỉ</label>
                                </div>
                          </div>

                     </div>

                    <div class=" d-flex align-items-center justify-content-center mt-1 button-list">
                    <button type="submit" class="btn btn-primary" >Lưu thay đổi</button>
                 </div>
						  </div>

        					  <div class="tab-pane " id="profile1">
        						     <div class="row">
        						     	<div class="col-md-4 border-end ">

                             <label class="form-label">Đặt thời gian làm việc trong tuần</label>
                                  <p class="text-muted font-13">
                                   Bật/tắt các ngày bạn muốn làm việc trong tuần
                                  </p>

        						     		<table class="table table-centered mb-0">
        									    <tbody id="load_date_setting">
        									       
        									     
        									    </tbody>
        									</table>
        						     	</div>
        						     	<div class="col-md-8">
                               <label class="form-label">Đặt thời gian làm việc trong ngày</label>
                                  <p class="text-muted font-13">
                                   Bật/tắt các ngày bạn muốn làm việc trong ngày
                                  </p>
        						     		<div class="button-list load_time_setting">

                                                


        						     		</div>

        						     		 
        						     	</div>


        						     </div>
        						  </div>
        						   
        					</div>      
 
                </form>
                 </div> <!-- end card-body-->
             </div> <!-- end card-->

</div>



<div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Thay đổi địa chỉ</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
            
               <div class="row">  
                     <label class="form-label">Địa chỉ</label>                                           
                        <div class="col-md-4">
                          <div class="form-floating">
                            <select class="form-select city" id="city" aria-label="Floating label select example">

                            <option value="0">--Chọn tỉnh thành phố--</option>
                            @foreach($city as $key => $ci)
                            <option class="optionck" value="{{$ci->matp}}">{{$ci->name}}</option>
                            @endforeach   
                            </select>
                            <label for="floatingSelect">Choose City</label>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-floating">
                            <select class="form-select province" id="province" aria-label="Floating label select example">
                                <option value="0" selected>---Chọn quận huyện---</option>
                            
                            </select>
                            <label for="floatingSelect">Choose Quận </label>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-floating">
                            <select class="form-select wards" id="wards" aria-label="Floating label select example">
                             <option value="0" selected>---Chọn xã phường---</option>
                            </select>
                            <label for="floatingSelect">Choose Huyện</label>
                          </div>
                        </div>
                        <div class="form-floating mt-1 mb-3">
                             <input type="text" class="form-control details_address" id="floatingInput" placeholder="" />
                                  <label for="floatingInput">Chi tiết đĩa chỉ</label>
                          </div>
                  </div>


            </div>

             <div class="modal-footer">
                <button type="button" id="close_chane" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                <button type="button" id="save_change" class="btn btn-primary">Lưu</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
 $(document).ready(function(){
  // jQuery methods go here...


$(document).on('change','#checkb1',function(){
  // var valu = $(this).closest("span").find(".checkbox_status").val();  
    if(this.checked) {
      $(".checkbox_status").val(1); 
    }else{
      $(".checkbox_status").val(0); 
    }  
});



load_date_setting();
function load_date_setting() {
  var _token = $('input[name="_token"]').val();
    $.ajax({
        url:"{{url('/doctor/load_date_setting')}}",
        method:"GET",
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       data:{_token:_token},
        success:function(data){
           $('#load_date_setting').html(data);
        	
        }

    }); 

}

$(document).on('change','.checkbox_date',function(){
  var valu = $(this).closest("td").find(".checkbox_date").val();  
    if(this.checked) {
      update_day_setting(0, valu);
    }else{
      update_day_setting(1, valu);
    }  
});

function update_day_setting(n, valu) {
   var _token = $('input[name="_token"]').val();
    $.ajax({
        url:"{{url('/doctor/update_day_setting')}}",
        method:"GET",
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       data:{valu:valu,n:n,_token:_token},
        success:function(data){
        }

    }); 

}

///////////////////////////////////////////////////////////////


load_time_setting();

function load_time_setting() {
  var _token = $('input[name="_token"]').val();
    $.ajax({
        url:"{{url('/doctor/load_time_setting')}}",
        method:"GET",
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       data:{_token:_token},
        success:function(data){
           $('.load_time_setting').html(data);       	
        }

    }); 

}
$(document).on('change','.checkbox_time',function(){
  var valu = $(this).closest("span").find(".checkbox_time").val();  
    if(this.checked) {
      update_time_setting(0, valu);
    }else{
      update_time_setting(1, valu);
    }  
});

function update_time_setting(n, valu) {
   var _token = $('input[name="_token"]').val();
    $.ajax({
        url:"{{url('/doctor/update_time_setting')}}",
        method:"GET",
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       data:{valu:valu,n:n,_token:_token},
        success:function(data){
        }

    }); 

}




  $('#save_change').on("click", function() {

    var optionSelected_city = $('#city').val();
    var optionSelected_province = $('#province').val();
    var optionSelected_wards = $('#wards').val();
    if(optionSelected_city == 0 || optionSelected_province == 0 || optionSelected_wards == 0){

          $.NotificationApp.send("","Vui lòng nhập địa chỉ phòng khám","top-right","rgba(0,0,0,0.2)","error")

    }else if($('.details_address').val() == ""){
            
           $.NotificationApp.send("","Vui lòng nhập chi tiết địa chỉ","top-right","rgba(0,0,0,0.2)","error")
    }else{

      var cityxss = $('.city option:selected').text();
      var provincecsssx = $('.province option:selected').text();
      var wardsxxss = $('.wards option:selected').text();

      var address = wardsxxss +", " +provincecsssx +", "+ cityxss;
      var details_address = $('.details_address').val();
       $('.address_company').val(details_address+", "+ address);
      $('#close_chane').click();
    }
 
   });


});
</script>


<script type="text/javascript" charset="utf-8" async defer>

    $(document).ready(function(){

         $('#city').change(function(){ 
            var action = $(this).attr('id');
            var ma_id = $(this).val();
         
            var _token = $('input[name="_token"]').val();
           
            $.ajax({
                url : '{{url('/select-delivery-home')}}',
                method: 'POST',
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }, 
                data:{action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                   $('#province').html(data); 
                 
                }
            });  


            $('.address_xx').addClass('badge badge-info-lighten');
             var city = $('#city').find(":selected").text();
            $('.cityxss').html(`<i class="dripicons-location"></i>`+ city)
        });

         $('#province').change(function(){ 
            
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
                
            $.ajax({
                url : '{{url('/select-delivery-home')}}',
                method: 'POST',
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }, 
                data:{action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                   $('#wards').html(data); 
                   
                }
            });

         var province = $('#province').find(":selected").text();
            $('.provincecsssx').text(", " + province)  

         });

         $('#wards').on('change',function(){
            var wards = $('#wards').find(":selected").text();
            $('.wardsxxss').text(", " +wards)  

        });


   });
</script>


@endsection