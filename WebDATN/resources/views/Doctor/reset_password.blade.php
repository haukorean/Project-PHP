@extends('DoctorLayout')
@section('contents_doctor')
<div class="row">
	  <div class="col-lg-3"></div>
	  <div class="col-lg-6">
	  	<div class="card p-4 mt-2">
        <form action="{{url('/doctor/save_reset_password')}}" method="post" enctype="multipart/form-data">
                     @csrf
	      <h3 class="page-title text-center">Đặt lại mật khẩu</h3>
		  	<div class="mb-3">
	            <label for="password" class="form-label">Mật khẩu hiện tại</label>
	            <div class="input-group input-group-merge">
	                <input type="password" id="password" class="form-control" name="pass_old" placeholder="Nhập hiện tại mật khẩu của bạn">
	                <div class="input-group-text" data-password="false">
	                    <span class="password-eye"></span>
	                </div>
	            </div>
	        </div>
	       	<div class="mb-3">
	            <label for="password1" class="form-label">Mật khẩu mới của bạn</label>
	            <div class="input-group input-group-merge">
	                <input type="password" id="password1" class="form-control" name="pass_new" placeholder="Nhập mật khẩu mới của bạn">
	                <div class="input-group-text" data-password="false">
	                    <span class="password-eye"></span>
	                </div>
	            </div>
	        </div>
	       	<div class="mb-3">
	            <label for="password2" class="form-label">Xác nhận lại mật khẩu mới của bạn</label>
	            <div class="input-group input-group-merge">
	                <input type="password" id="password2" class="form-control" name="pass_new_cf" placeholder="Nhập lại mật khẩu mới của bạn">
	                <div class="input-group-text" data-password="false">
	                    <span class="password-eye"></span>
	                </div>
	            </div>
	        </div>



	         <div class=" d-flex align-items-center justify-content-center mt-1 button-list">
                <button type="submit" class="btn btn-primary" >Lưu thay đổi</button>
              </div>
	     </div>
       </form>

      </div>
	
</div>
<script src="{{asset('/backend/assets/js/app.min.js')}}" async></script> 
@endsection