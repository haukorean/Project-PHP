@extends('AdminLayout')

@section('contents')

 <div class="card"> 
               <div class="app-search" style="width:30%; margin-top: 10px; margin-left: 20px">
                	<button type="button" data-bs-toggle="modal" data-bs-target="#centermodal"
					  	 class="btn btn-outline-info" onclick="btn_add()"><i class="uil-focus-add" ></i> Thêm dịch vụ mới</button>
                
               </div>
            <div class="card-body">
             <table  class="table table-bordered table-centered mb-0">
                   <thead>
                    <tr>
                        <th></th>
                        <th>Tên dịch vụ</th>
                        <th>Mô tả</th>
                        <th></th>
                    </tr>
                </thead>
                 <tbody id="load_specialist">

                </tbody>
            </table>
        </div>
    </div>


  <div class="modal fade" id="centermodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myCenterModalLabel">Thêm Dịch Vụ</h4>
                <button type="button" id="btn-closessss" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
           <div class="modal-body">
            <form>
                  {{ csrf_field() }}

       
                <ul class="list-group list-group-flush">

                            <li class="list-group-item">
                              <div class="mb-2 row">
                                    <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Tên dịch vụ:</label>
                                    <div class="col-sm-9">
                                    <input required type="text"  name="name" class="form-control form-control-sm name_service" id="name_service"
                                    placeholder="Enter your name service...">
                                    </div>
                              </div>


                                <div class="mb-2 row">
                                    <label for="colFormLabelSm"  class="col-sm-3 col-form-label col-form-label-sm">Mô tả dịch vụ</label>
                                    <div class="col-sm-9">
                                    <textarea type="text" name="desc" rows="3" class="form-control form-control-sm desc_service" id="desc_service"
                                    placeholder="Enter service your field..."></textarea>
                                    </div>
                                </div>
                                
                            </li>
                            <li class="list-group-item">
                                   <div style="display: flex; justify-content: center; margin-top: 7px;"> 
                                    <input  type="hidden" value="0"  name="name" class="id_save" >
                                   <button type="button" onclick="save_add_service(0)" class="btn btn-outline-info add_service">Thêm</button>
                                   <button type="button" onclick="save_add_service(1)"  class="btn btn-outline-info save_service">Lưu</button>
                                   </div>
                            </li>
                         
                        </ul>

                 
                        </form>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript" charset="utf-8">

   $(document).ready(function(){
            load_service();
  
            });

  function btn_add(){
  	$('.add_service').show();
    $('.save_service').hide();
    $("#name_service").val("");
    $("#desc_service").val("");
  }

        function save_add_service(status){
                var id_save = $('.id_save').val();
                // var imageInput = document.getElementById("uploadImages").files[0]
                var name_service = $('.name_service').val();
                var desc_service = $('.desc_service').val();
           

                var form_data = new FormData();

                // form_data.append("file", imageInput);
                form_data.append("name_service",name_service);
                form_data.append("desc_service",desc_service);
                form_data.append("status",status);
                form_data.append("id_save",id_save);

              if(name_service == "" || desc_service == "" ){

                     $.NotificationApp.send("","Vui lòng nhập đầy đủ thông tin dịch vụ","top-right","rgba(0,0,0,0.2)","error")
              }else{
     
                
                $.ajax({
                    url:"{{url('/admin/add_or_save_service')}}",
                    method:"POST",
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    data:form_data,
                    contentType:false,
                    cache:false,
                    processData:false,

                    success:function(data){
                     document.getElementById("name_service").value ="";
                     document.getElementById("desc_service").value ="";
        
                   
                     document.getElementById("btn-closessss").click();
                     if(status==0){
                          $.NotificationApp.send("","Thêm dịch vụ thành công","top-right","rgba(0,0,0,0.2)","success")
                     }else{
                         $.NotificationApp.send("","Cập nhật dịch vụ thành công","top-right","rgba(0,0,0,0.2)","success")
                     }
                   
              
                     // alert("add success !");
                     load_service();
                           
              }
           });
       
          }
        }



         function load_service(){
            $.ajax({
                url:"{{url('/admin/load_service')}}",
                method:"GET",
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(data){

                    $('#load_specialist').html(data);
                          
                }

            }); 
        }

        $(document).on('click','.btn-edit-service',function(){
            $('.add_service').hide();
            $('.save_service').show();
            var id = $(this).data('is_spe');

            var name = $(this).closest("#item").find("#name").text();
            var des = $(this).closest("#item").find("#des").text();
             $('#name_service').val(name);
             $('#desc_service').val(des);

             $('.id_save').val(id);
        });


      $(document).on('click','.btn-remove-service',function(){
        
       var id = $(this).data('is_spe');
       var _token = $('input[name="_token"]').val();
        if(confirm("Bạn có muốn xóa dịch vụ này không ?")) {
             $.ajax({
                url:"{{url('/admin/remove_service')}}",
                method:"GET",
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                 data: {id:id, _token:_token},
                success:function(data){
                    load_service()
                }

            }); 

        }       
      });


</script>    

@endsection