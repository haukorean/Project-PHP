@extends('AdminLayout')

@section('contents')

 <div class="card"> 
               <div class="app-search" style="width:30%; margin-top: 10px; margin-left: 20px">
                	<button type="button" data-bs-toggle="modal" data-bs-target="#centermodal"
					  	 class="btn btn-outline-info" onclick="btn_add()"><i class="uil-focus-add" ></i>Thêm Chuyên Khoa</button>
                
               </div>
            <div class="card-body">
             <table  class="table table-bordered table-centered mb-0">
                   <thead>
                    <tr>
                        <th></th>
                        <th>Hình Ảnh </th>
                        <th>Chuyên Khoa</th>
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
                <h4 class="modal-title" id="myCenterModalLabel">Thêm Chuyên Khoa</h4>
                <button type="button" id="btn-closessss" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
           <div class="modal-body">
            <form>
                  {{ csrf_field() }}

       
                <ul class="list-group list-group-flush">

                    <li class="list-group-item" >
                     <h5 class="modal-title" id="myCenterModalLabel">Hình ảnh:</h5>
                     <div style="margin-top: 5px; display: flex; justify-content: center">
                        <div for="images" class="row">       
                         <span class="drop-title col-sm-3">
                           <img id="uploadPreview11" src="{{asset('/Image/specialist.png')}}" alt="image" 
                           class="img-fluid img-thumbnail" width="80" height="80" /> 
                             </span>
                            <div class="col-sm-9">
                          <input type="file" accept="image/*" id="uploadImages"  name="file" class="myPhoto_store_rq" onchange="PreviewImage();" style="margin-top: 8px;">

                          </div>
                        </div>

                        <script type="text/javascript">

                                function PreviewImage() {
                                    var oFReader = new FileReader();
                                    oFReader.readAsDataURL(document.getElementById("uploadImages").files[0]);

                                    oFReader.onload = function (oFREvent) {
                                        document.getElementById("uploadPreview11").src = oFREvent.target.result;
                                    };
                                  };

                                </script>
                              </div>
                            

                            </li>
                            <li class="list-group-item">
                              <div class="mb-2 row">
                                    <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Tên Chuyên Khoa:</label>
                                    <div class="col-sm-9">
                                    <input required type="text"  name="name" class="form-control form-control-sm name_Specialist" id="name_Specialist"
                                    placeholder="Enter your name field...">
                                    </div>
                              </div>


                                <div class="mb-2 row">
                                    <label for="colFormLabelSm"  class="col-sm-3 col-form-label col-form-label-sm">Mô tả</label>
                                    <div class="col-sm-9">
                                    <textarea type="text" name="desc" rows="3" class="form-control form-control-sm desc_Specialist" id="desc_Specialist"
                                    placeholder="Enter specialist your field..."></textarea>
                                    </div>
                                </div>
                                
                            </li>
                            <li class="list-group-item">
                                   <div style="display: flex; justify-content: center; margin-top: 7px;"> 
                                    <input  type="hidden" value="0"  name="name" class="id_save" >
                                   <button type="button" onclick="save_add_specialist(0)" class="btn btn-outline-info add_Specialist">Thêm</button>
                                   <button type="button" onclick="save_add_specialist(1)"  class="btn btn-outline-info save_Specialist">Lưu</button>
                                   </div>
                            </li>
                         
                        </ul>

                 
                        </form>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript" charset="utf-8">

   $(document).ready(function(){
            load_specialist();
  
            });

  function btn_add(){
  	$('.add_Specialist').show();
    $('.save_Specialist').hide();
    $("#name_Specialist").val("");
    $("#desc_Specialist").val("");
     document.getElementById("uploadPreview11").src = "{{asset('/Image/specialist.png')}}";
  }

        function save_add_specialist(status){
                var id_save = $('.id_save').val();
                var imageInput = document.getElementById("uploadImages").files[0]
                var name_Specialist = $('.name_Specialist').val();
                var desc_Specialist = $('.desc_Specialist').val();
           

                var form_data = new FormData();

                form_data.append("file", imageInput);
                form_data.append("name_Specialist",name_Specialist);
                form_data.append("desc_Specialist",desc_Specialist);
                form_data.append("status",status);
                form_data.append("id_save",id_save);

              if(imageInput == null && status == 0){

                    $.NotificationApp.send("","Vui lòng chọn hình ảnh","top-right","rgba(0,0,0,0.2)","error")

              }else if(name_Specialist == "" || desc_Specialist == "" ){

                     $.NotificationApp.send("","Vui lòng nhập đầy đủ thông tin chuyên  khoa","top-right","rgba(0,0,0,0.2)","error")
              }else{
     
                
                $.ajax({
                    url:"{{url('/admin/add_or_save_Specialist')}}",
                    method:"POST",
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    data:form_data,
                    contentType:false,
                    cache:false,
                    processData:false,

                    success:function(data){
                     document.getElementById("name_Specialist").value ="";
                     document.getElementById("desc_Specialist").value ="";
                     $('.id_save').val(0);
                   
                     document.getElementById("btn-closessss").click();

                      if(status==0){
                          $.NotificationApp.send("","Thêm Chuyên gia thành công","top-right","rgba(0,0,0,0.2)","success")
                     }else{
                          $.NotificationApp.send("","Cập nhật Chuyên gia thành công","top-right","rgba(0,0,0,0.2)","success")
                     }
                   
              
                     // alert("add success !");
                     load_specialist();
                           
              }
           });
       
          }
        }



         function load_specialist(){
            $.ajax({
                url:"{{url('/admin/load_specialist')}}",
                method:"GET",
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(data){

                    $('#load_specialist').html(data);
                          
                }

            }); 
        }

        $(document).on('click','.btn-edit-specialist',function(){
            $('.add_Specialist').hide();
            $('.save_Specialist').show();
            var id = $(this).data('is_spe');

            var image = $(this).closest("#item").find(".image").val();
            var name = $(this).closest("#item").find("#name").text();
            var des = $(this).closest("#item").find("#des").text();
             $('#name_Specialist').val(name);
             $('#desc_Specialist').val(des);

             $('.id_save').val(id);
             document.getElementById("uploadPreview11").src =image;
            

        });

</script>    

@endsection