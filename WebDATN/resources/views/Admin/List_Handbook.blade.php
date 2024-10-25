@extends('AdminLayout')
@section('contents')

<div class="card p-3 mt-2">

  	<ul class="nav nav-tabs nav-bordered mb-3">
      <li class="nav-item">
          <a href="#home-b1" data-bs-toggle="tab" aria-expanded="false" class="nav-link active tab_1">
              <i class="mdi mdi-home-variant d-md-none d-block"></i>
              <span class="d-none d-md-block">Tất cả cẩm nang sức khỏe tại cộng đồng</span>
          </a>
      </li>
      <li class="nav-item">
          <a href="#profile-b1" data-bs-toggle="tab" aria-expanded="true" class="nav-link tab_2" >
              <i class="mdi mdi-account-circle d-md-none d-block"></i>
              <span class="d-none d-md-block">Cẩm nang y tế mới đang chờ phê duyệt</span>
          </a>
      </li>
     
  </ul>

    <div class="tab-content">
        <div class="tab-pane show active" id="home-b1">
           <a class="btn btn-lg font-16 btn-danger" href="{{url('/admin/create_new_handbook')}}"> 
          <i class="mdi mdi-plus-circle-outline"></i>Create new handbook medical</a>
         <table class="table table-bordered border-primary table-centered mb-0 mt-2">
            <thead>
              <tr>
                  <th>Hình ảnh</th>
                  <th>Tiêu đề</th>
                  <th>Ngày Tạo</th>
                  <th class="text-center"></th>
              </tr>
          </thead>
          <tbody id="load_all_handbook">
            

          </tbody>
       </table>

        </div>
        <div class="tab-pane" id="profile-b1">

               <table class="table table-bordered border-primary table-centered mb-0 mt-2">
          	    <thead>
          	        <tr>
          	         <th>Hình ảnh</th>
                     <th>Tiêu đề</th>
                     <th>Ngày Tạo</th>
          	         <th class="text-center"></th>
          	        </tr>
          	    </thead>
          	    <tbody id="load_awaiting_handbook">
          	      

          	    </tbody>
          	</table>
        </div>
       
   </div>

</div>

<div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" data-simplebar data-simplebar-primary>
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Chi tiết bài đăng</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                   <img id="my_image" src="" alt="my_image" class="img-fluid" style="width: 100%; height: auto;" />
                </div>   
                <h3 class="page-title title"></h3>
                <p class="text-muted"><strong>Tác Giả :</strong> <span class="ms-2 auth"></span></p>
                <p class="text-muted"><strong>Thời gian:</strong> <span class="ms-2 time"></span></p>
                <input type="hidden" class="idpost" >
                <button type="button" onclick="approve_or_refuse(1)" class="btn btn-primary btn_approve">Chấp thuận</button>
                <button type="button" onclick="approve_or_refuse(2)" class="btn btn-danger btn_refuse">Từ chối phê duyệt</button>
                <hr>
                <div id="content">
                  
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
 <script type="text/javascript">
  $(document).on('click','.btn_view_item', function(){
      var idpost = $(this).closest("td").find(".idpost").val();  
      var title = $(this).closest("td").find(".title").val();
      var date = $(this).closest("td").find(".date").val();    
      var auth = $(this).closest("td").find(".auth").val();
      var status = $(this).closest("td").find(".status").val();
      var content = $(this).closest("td").find(".content").html(); 

      $('.idpost').val(idpost);
      var image = $(this).closest("tr").find("img").attr('src'); 
      $('#my_image').attr('src',image);
      
      $('.title').text(title);
      $('.auth').text(auth);
      $('.time').html(date);
      $('#content').html(content);
      if(status == 1){
        $('.btn_approve').hide();
        $('.btn_refuse').hide();
      }else{
        $('.btn_approve').show();
        $('.btn_refuse').show();
      }
         
  });


 /////////////////// phe duyet va tu choi bai viet ////////////////////////


   function approve_or_refuse(status){
      var id = $('.idpost').val();
      var _token = $('input[name="_token"]').val();
          $.ajax({
          url:"{{url('/admin/approve_or_refuse_post_admin')}}",
          method:"GET",
           headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },

          data:{id:id,status:status,_token:_token},
            success:function(data){
               load_all_handbook(0); 
               load_all_handbook(1); 
              $('.btn-close').click();
            }
        });
    }

 /////////////////// Xoa bai viet ////////////////////////
  $(document).on('click','.btn_remove_item', function(){
    var id = $(this).closest("td").find(".idpost").val();  
    var _token = $('input[name="_token"]').val();
        $.ajax({
        url:"{{url('/admin/remove_post_admin')}}",
        method:"GET",
        headers:{
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

        data:{id:id,_token:_token},
          success:function(data){
             load_all_handbook(0); 
             load_all_handbook(1); 
          }
      });
         
  });


///////////////////////// load data //////////////
  $(document).on('click','.tab_1', function(){
  load_all_handbook(1);        
  });
   $(document).on('click','.tab_2', function(){
  load_all_handbook(0);        
  });
  load_all_handbook(1);
  load_all_handbook(0);
       function load_all_handbook(status){
        var _token = $('input[name="_token"]').val();
        $.ajax({
        url:"{{url('/admin/load_all_handbook')}}",
        method:"GET",
         headers:{
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
        // dataType:"JSON",
        data:{status:status,_token:_token},
          success:function(data){
            if(status ==1){
               $('#load_all_handbook').html(data);  
            }else{
               $('#load_awaiting_handbook').html(data);  
            }
           
          }
      });
    }

 </script>


@endsection