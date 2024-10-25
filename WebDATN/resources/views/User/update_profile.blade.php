@extends('UserLayout')
@section('contents_user')
<div class="row mt-1">
    <div class="col-lg-1"></div>
    <div class="card col-lg-10">
       <div class="card-body">
        <form action="{{url('/user/save_update_profile')}}" method="post" enctype="multipart/form-data">
                     @csrf
        
                  <div class="row">
                      <div class="col-lg-1"></div>
                      <div class="col-lg-3">
                            <div class="image-input d-flex align-items-center justify-content-center">
                          
                                <img src="{{ (Auth::user()->patient->avt_user == 0) ? asset('/Image/avt_user.png') :
                                asset('/Image/avt_user/'.Auth::user()->id.'/'.Auth::user()->patient->avt_user) }}" 
                                class="image-preview-up img-fluid avatar-xl rounded-circle" >

                              </div>

                              <div class="d-flex align-items-center justify-content-center mt-1">
                                <input type="file" name="file" accept="image/*" id="imageInput">
                                <label for="imageInput" class="image-button choose-image-update 
                                badge badge-outline-danger">Chọn Hình Ảnh Avatar</label>
                              </div>
                        </div>

                         <div class="col-lg-5">
                            <div class="mb-2 row">
                              <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Email</label>
                              <div class="col-sm-10">
                                <h4><span class="badge badge-info-lighten">{{Auth::user()->email}}</span></h4>
                              </div>
                          </div>

                          <div class="mb-2 row">
                              <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Tên</label>
                              <div class="col-sm-5">
                              <input type="text" name="first_name" value="{{Auth::user()->patient->firt_name}}" class="form-control form-control-sm name" id="colFormLabelSm" placeholder="Họ" required>
                              </div>
                              <div class="col-sm-5">
                              <input type="text" name="last_name" value="{{Auth::user()->patient->last_name}}" class="form-control form-control-sm name" id="colFormLabelSm" placeholder="Tên" required>
                              </div>
                          </div>

                          <div class="mb-2 row">
                              <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm" >SDT</label>
                              <div class="col-sm-10">
                              <input type="text" name="phone" class="form-control form-control-sm phone" id="colFormLabelSm"  placeholder="(+84) 000-000-000" data-toggle="input-mask" value="{{Auth::user()->patient->number_phone}}" data-mask-format="0000-000-000" required>
                                 <span class="font-13 text-muted">Vi "(+84) 000-000-000"</span>
                              </div>
                          </div>
                      

                         </div>  
                                
                       <div class="col-lg-3">
                        <a href="{{url('/user/reset_password')}}" type="button" class="btn btn-success btn-sm float-end" >
                        Thay Đổi Mật Khẩu</a>
                      </div> 
                   </div>
                         <div class="row mt-1" >
                                                                  
                                <div class="col-md-4">
                                  <div class="form-floating mb-3">
                                     <input min="1" type="number" class="form-control  height" name="height" value="{{Auth::user()->patient->height}}" id="floatingInput"  />
                                       <label for="floatingInput">Chiều cao(cm)</label>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-floating mb-3">
                                     <input min="1" type="number" class="form-control weight" name="weight" id="floatingInput"
                                      value="{{Auth::user()->patient->weight}}" />
                                      <label for="floatingInput">Cân nặng(kg)</label>
                                  </div>
                                  </div>
                             

                                <div class="col-md-4">
                                  <div class="form-floating">
                                    <select class="form-select blood_group" name="blood_group" id="floatingSelect" aria-label="Floating label select example">
                                        <option value="Unknown" selected>Unknown</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="AB">AB</option>
                                        <option value="O">O</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <label for="floatingSelect">Nhóm Máu</label>
                                  </div>
                                </div>
                             
                         </div> 

                        <div class="row">
                          <div>
                            <label class="form-label">Về bạn</label>
                            <p class="text-muted font-13">
                             Hãy mô tả điều gì đó về bản thân bạn
                            </p>
                            <textarea data-toggle="maxlength" class="form-control about_me" name="about_me" maxlength="225" rows="3" 
                                placeholder="Điều này về tôi có giới hạn 225 ký tự.">{{Auth::user()->patient->about_me}}</textarea>
                            </div>
                        </div> 


                        <div class="row mt-1">  
                            <label class="form-label">Địa chỉ</label>                            
                                <div class="col-lg-4">
                                  <div class="form-floating mt-1 mb-3">
                                     <input type="text" class="form-control" id="floatingInput" name="details_address" placeholder="" value="{{Auth::user()->patient->details_address}}"  required/>
                                         <label for="floatingInput">Địa chỉ chi tiết</label>
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-floating mt-1 mb-3">
                                     <input type="text" class="form-control address_user" id="floatingInput" name="address_user" placeholder="" value="{{Auth::user()->patient->address}}"  required/>
                                         <label for="floatingInput">Địa chỉ</label>
                                  </div>
                                </div>

                                <div class="col-lg-2">
                                   <button type="button" class=" mt-1 btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg">Thay đổi</button>
                                </div>
                            
                          </div>



                          <div class="row">                                             
                                <div class="col-md-5">
                                  <div class="mb-3">
                                    <label for="example-date" class="form-label">Ngày Sinh</label>
                                     <input class="form-control birth_day" value="{{Auth::user()->patient->birth_day}}" id="example-date" type="date" name="date" required>
                                 </div>
              
                                </div>
                                <div class="col-md-2">
                                  <label for="password" class="form-label">Tuổi</label>
                                  <div class="input-group input-group-merge">
                                      <input type="number" min="1" value="1" id="password" class="form-control age_user" name="age">
                          
                                  </div>
                            <!--      <small id="emailHelp" class="form-text text-muted">Recommended from 5 years of experience.</small> -->
                                </div>

                                <div class="col-md-3">
                                  <div class="mb-3">
                                      <label for="example-select" class="form-label">Giới Tính</label>
                                      <select class="form-select sex_user" name="sex" id="example-select">
                                          <option value="0" selected="">Nam</option>
                                          <option value="1">Nữ</option>
                                      
                                      </select>
                                  </div>
                                </div>
                          </div>

                     
                        <div class=" d-flex align-items-center justify-content-center mt-1 button-list">

                          <button type="submit" class="btn btn-primary" >Lưu Thay Đổi</button>
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
                            <label for="floatingSelect">Choose Thành Phố</label>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-floating">
                            <select class="form-select province" id="province" aria-label="Floating label select example">
                                <option value="0" selected>---Chọn quận huyện---</option>
                            
                            </select>
                            <label for="floatingSelect">Choose Quận/Huyện</label>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-floating">
                            <select class="form-select wards" id="wards" aria-label="Floating label select example">
                             <option value="0" selected>---Chọn xã phường---</option>
                            </select>
                            <label for="floatingSelect">Choose Xã/Phường</label>
                          </div>
                        </div>
                    <!--     <div class="form-floating mt-1 mb-3">
                             <input type="text" class="form-control details_address" id="floatingInput" placeholder="" />
                                  <label for="floatingInput">Details address</label>
                          </div> -->
                  </div>


            </div>

             <div class="modal-footer">
                <button type="button" id="close_chane" class="btn btn-light" data-bs-dismiss="modal">ĐÓNG</button>
                <button type="button" id="save_change" class="btn btn-primary">LƯU THAY ĐỔI</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




<script type="text/javascript">
    $('#imageInput').on('change', function() {
    $input = $(this);
    if($input.val().length > 0) {
      fileReader = new FileReader();
      fileReader.onload = function (data) {
      $('.image-preview-up').attr('src', data.target.result);
      }
      fileReader.readAsDataURL($input.prop('files')[0]);
      $('.image-button').css('display', 'none');
      $('.change-image').css('display', 'block');
    }
  });




  $('#save_change').on("click", function() {

    var optionSelected_city = $('#city').val();
    var optionSelected_province = $('#province').val();
    var optionSelected_wards = $('#wards').val();
    if(optionSelected_city == 0 || optionSelected_province == 0 || optionSelected_wards == 0){

          $.NotificationApp.send("","Vui lòng nhập địa chỉ phòng khám y tế","top-right","rgba(0,0,0,0.2)","error")

    }else{

      var cityxss = $('.city option:selected').text();
      var provincecsssx = $('.province option:selected').text();
      var wardsxxss = $('.wards option:selected').text();

      var address = wardsxxss +", " +provincecsssx +", "+ cityxss;
      $('.address_user').val(address);
  
      $('#close_chane').click();
    }
 
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


         });



   });
</script>


@endsection