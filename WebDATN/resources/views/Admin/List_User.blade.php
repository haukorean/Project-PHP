@extends('AdminLayout')
@section('contents')


        <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
            <li class="nav-item" onclick="user(0)" >
                <a href="#home1" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0 active">
                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                    <span class="d-none d-md-block">Danh sách người dùng</span>
                </a>
            </li>

            <li class="nav-item" onclick="user(1)">
                <a href="#settings1" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                    <i class="mdi mdi-settings-outline d-md-none d-block"></i>
                    <span class="d-none d-md-block">Danh sách chặn</span>
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane show active" id="home1">
                       <div class="card"> 
                               <div class="app-search" style="width:30%; margin-top: 10px; margin-left: 20px">
                                  <div class="input-group">
                                        <input type="text" class="form-control input_searchxx_tab1" placeholder="Search..." id="top-search">
                                        <span class="mdi mdi-magnify search-icon"></span>
                                  </div>
                                
                               </div>
                            <div class="card-body">
                             <table  class="table table-bordered table-centered mb-0">
                                   <thead>
                                    <tr>
                                        <th></th>
                                        <th>SDT </th>
                                        <th>Email</th>
                                        <th>Ngày Tạo</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                 <tbody id="Load_list_user">

                                </tbody>
                            </table>
                        </div>
                    </div>

            </div>

            <div class="tab-pane" id="settings1">
                     <div class="card">
                            <div class="app-search" style="width:30%; margin-top: 10px; margin-left: 20px">
                                  <div class="input-group">
                                        <input type="text" class="form-control input_searchxx_tab2" placeholder="Search..." id="top-search">
                                        <span class="mdi mdi-magnify search-icon"></span>
                                  </div>
                                
                             </div>
                            <div class="card-body">
                            <table  class="table table-bordered table-centered mb-0">
                                   <thead>
                                    <tr>
                                       <th></th>
                                        <th>SDT </th>
                                        <th>Email</th>
                                        <th>Ngày Tạo</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                 <tbody id="Load_list_user_block">

                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>




        </div>
        


<!-- Info Header Modal -->

<!-- Info Header Modal -->
<div id="info-header-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="info-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-info">
                <h4 class="modal-title" id="info-header-modalLabel">Thông tin về người dùng</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
               <div class="row">
               <h4 class="font-13 text-uppercase">Về Người Dùng :</h4>
                <div class="col-lg-4">
                    <span id="image_user">
                  
                    </span>
                       <h4 class="mb-0 mt-2" id="nickname"></h4>
                     <p class="text-muted font-14" id="email_user" style="overflow-wrap: break-word;"></p>
                           
                                  
                </div>
                <div class="col-lg-8">
                     <p class="text-muted mb-2 font-13"><strong>Ngày Sinh :</strong> <span class="ms-2" id="birthday"></span></p>
                     <p class="text-muted mb-2 font-13"><strong>SDT :</strong><span class="ms-2" id="phone_user"></span></p>
                     <p class="text-muted mb-2 font-13"><strong>Giới  tính :</strong> <span class="ms-2" id="sex_user"></span></p>
                    <!--      <button class="btn btn-primary btn-sm mt-1"><i class="uil uil-envelope-add me-1"></i>Send Email</button> -->

                </div>
             </div>
             <div class="row">
             <p class="text-muted mb-2 font-13"><strong>Chiều cao :</strong> <span class="ms-2" id="height"></span>
                <strong>Cân nặng :</strong> <span class="ms-3" id="weight"></span></p>
             <p class="text-muted mb-2 font-13"><strong>Nhóm máu :</strong> <span class="ms-2" id="blood"></span></p>
             <p class="text-muted mb-2 font-13"><strong>Địa chỉ :</strong> <span class="ms-2" id="address"></span></p>
             <p class="text-muted mb-2 font-13"><strong>Về tôi :</strong> <span class="ms-2" id="about_me"></span></p>


             </div>

              
            </div>
            <div class="modal-footer">
                <input type="hidden" value="" id="id_dt">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal" id="close_modal">ĐÓNG</button>

                <button type="button" id="Block" class="btn btn-danger" onclick="accept_or_refuse_user(1)">CHẶN</button>
           
                <button type="button" id="Unblock" class="btn btn-info" onclick="accept_or_refuse_user(0)">MỞ CHẶN</button>
                <button type="button" id="Delete" class="btn btn-danger" onclick="accept_or_refuse_user(-1)">XÓA</button>
      
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript" charset="utf-8">
     $('#Block').show();
     $('#Unblock').hide();
     $('#Delete').hide();

    Load_list_user(0);
    var select_bt = 0;
 function user(status){
    if(status == 0){
     Load_list_user(status);
     select_bt = 0;

     $('#Block').show();
     $('#Unblock').hide();
     $('#Delete').hide();

    }else{
    Load_list_user(status);
    select_bt = 1;

     $('#Block').hide();
     $('#Unblock').show();
     $('#Delete').show();

    }


 }
 $('.input_searchxx_tab1').bind('input', function() {
    // Xử lý sự kiện khi người dùng nhập vào input
     var value = $(this).val();
     search_list_user(0, value);
  });

  $('.input_searchxx_tab2').bind('input', function() {
    // Xử lý sự kiện khi người dùng nhập vào input
     var value = $(this).val();
     search_list_user(1, value);
  });




    function search_list_user(status, value){
        var _token = $('input[name="_token"]').val();
         $.ajax({
                url:"{{url('admin/search_list_user')}}",
                method:"GET",
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
              data:{status:status,value:value, _token:_token},
                success:function(data){
                    if(status == 0){
                      $('#Load_list_user').html(data); 
                    }else{
                      $('#Load_list_user_block').html(data); 
                    }

                          
                }

        }); 
    }

    function Load_list_user(status){
        var _token = $('input[name="_token"]').val();
         $.ajax({
                url:"{{url('admin/Load_list_user')}}",
                method:"GET",
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
              data:{status:status, _token:_token},
                success:function(data){
                    if(status == 0){
                      $('#Load_list_user').html(data); 
                    }else{
                      $('#Load_list_user_block').html(data); 
                    }

                          
                }

        }); 
    }




  function view_infor_user(id){
    // alert(id)
        var _token = $('input[name="_token"]').val();
        $('#id_dt').val(id);
        $.ajax({
        url:"{{url('/admin/view_infor_user')}}",
        method:"GET",
        headers:{
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
        dataType:"JSON",
        data:{id:id, _token:_token},
          success:function(data){

            $('#image_user').html(data.image_user);
            $('#nickname').html(data.nickname);
            $('#email_user').html(data.email_user);
            $('#birthday').html(data.birthday);
            $('#phone_user').html(data.phone_user);
            if(data.sex == 0){
             $('#sex_user').html("Male");
            }else{
             $('#sex_user').html("Female");
            }


            $('#about_me').html(data.about_me);    
            $('#height').html(data.height);
            $('#weight').html(data.weight); 
            $('#blood').html(data.blood); 

            $('#address').html(data.address);



          }
      });
    }




    function accept_or_refuse_user(status){
        // alert(status)
        var id = $('#id_dt').val();
        var _token = $('input[name="_token"]').val();
         $.ajax({
                url:'{{url('admin/accept_or_refuse_user')}}',
                method:"GET",
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{id:id,status:status, _token:_token},
                success:function(data){
                    if(select_bt == 0){
                      Load_list_user(0);
                    }else{
                      Load_list_user(1);
                    }
                
                 $('#close_modal').click();
        

                }

        }); 
    }



</script>
@endsection