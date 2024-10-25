@extends('AdminLayout')
@section('contents')
<div class="card p-3 mt-2">

  	<ul class="nav nav-tabs nav-bordered mb-3">
      <li class="nav-item">
          <a href="#home-b1" data-bs-toggle="tab" aria-expanded="false" class="nav-link active tab_1">
              <i class="mdi mdi-home-variant d-md-none d-block"></i>
              <span class="d-none d-md-block">Dữ Liệu ChatBot</span>
          </a>
      </li>

     <li class="nav-item li_Data2">
          <a href="#home-bl" data-bs-toggle="tab" aria-expanded="true" class="nav-link tab_2">
              <i class="mdi mdi-home-variant d-md-none d-block"></i>
              <span class="d-none d-md-block">Dữ Liệu Bệnh Lý</span>
          </a>
      </li>
      <li class="nav-item li_Data3">
          <a href="#profile-b1" data-bs-toggle="tab" aria-expanded="true" class="nav-link tab_3" >
              <i class="mdi mdi-account-circle d-md-none d-block"></i>
              <span class="d-none d-md-block">Dữ liệu câu hỏi người dùng</span>
          </a>
      </li>
     
  </ul>

    <div class="tab-content">
      <div class="tab-pane show active" id="home-b1">
         	<button type="button" data-bs-toggle="modal" data-bs-target="#centermodal1"
					  	 class="btn btn-outline-info show_model1" ><i class="uil-focus-add" ></i>Thêm Dữ Liệu Câu Hỏi</button>
               <table class="table table-bordered border-primary table-centered mb-0 mt-2">
          	    <thead>
          	        <tr>
          	         <th>STT</th>
          	         <th>Câu hỏi</th>
                     <th>Câu trả lời</th>
                      <th></th>
          	        </tr>
          	    </thead>
          	    <tbody id="LoadDataCauHoi">
          	      	

          	    </tbody>
          	</table>
        </div>

        <div class="tab-pane" id="home-bl">
         <button type="button" data-bs-toggle="modal" data-bs-target="#centermodal1"
					  	 class="btn btn-outline-info show_model2" ><i class="uil-focus-add" ></i>Thêm Dữ Bệnh Lý</button>

		         <table class="table table-bordered border-primary table-centered mb-0 mt-2">
		            <thead>
		              <tr>
		              	  <th>STT</th>
		                  <th>Triệu Chứng</th>
		                  <th>Chuẩn Đoán</th>
		                  <th>Chuyên Khoa</th>
		                  <th>Lời Khuyên</th>
		                  <th></th>
		              </tr>
		          </thead>
		          <tbody id="LoadDataBenhLy">
		          
		            

		          </tbody>
		       </table>

        </div>



         <div class="tab-pane" id="profile-b1">
                 <h3 >Danh sách những từ khóa mà chatbot không thể trả lời</h3>

           <table class="table table-bordered border-primary table-centered mb-0 mt-2">
      	    <thead>
      	        <tr>
      	         <th>STT</th>
                 <th>Từ Khóa</th>
                 <th>Ngày Tạo</th>
      	         <th class="text-center"></th>
      	        </tr>
      	    </thead>
      	    <tbody id="LoadDataCH">
      	      

      	    </tbody>
      	</table>
    </div>
   
   </div>

</div>




 <div class="modal fade" id="centermodal1" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title TVmodel1" id="myCenterModalLabel">Thêm Dữ Liệu Câu Hỏi Tư Vấn</h4>
                <button type="button" id="btn-closessss" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
           <div class="modal-body">

                   <ul class="list-group list-group-flush list_model1">
   
                               <div class="mb-2 row">
                                    <label for="colFormLabelSm" class="col-sm-12 col-form-label col-form-label-sm">Các cụm từ Có thể xuất hiện trong câu hỏi:</label>
                                    <div class="col-sm-12">
                                
                                     <textarea type="text" name="CauHoi" rows="2" class="form-control form-control-sm " id="CauHoi" 
                                    placeholder="Các cụm từ có thể xuất hiện trong câu hỏi..."></textarea>
                                    </div>
                              </div>


                                <div class="mb-2 row">
                                    <label for="colFormLabelSm"  class="col-sm-12 col-form-label col-form-label-sm">Câu Trả Lời</label>
                                    <div class="col-sm-12">
                                    <textarea type="text" name="CauTL" rows="5" class="form-control form-control-sm " id="CauTL" 
                                    placeholder="Câu trả lời cho Cau hỏi..."></textarea>
                                    </div>
                                </div>
                                
                            </li>
                            <li class="list-group-item">
                                   <div style="display: flex; justify-content: center; margin-top: 7px;"> 
                                    <input  type="hidden" value="0"  name="name" class="ID" >
                                    <button type="submit"  class="btn btn-outline-info add_Data1">Thêm</button>
                                    <button type="button"  class="btn btn-outline-info save_Data1">Lưu</button> 
                                   </div>
                            </li>
                         
                        </ul>




               <ul class="list-group list-group-flush list_model2">

                            <li class="list-group-item">
                              <div class="mb-2 row">
                                    <label for="colFormLabelSm" class="col-sm-12 col-form-label col-form-label-sm">Nhập Triệu Chứng bệnh:</label>
                                    <div class="col-sm-12">
                                    <textarea type="text" name="desc" rows="3" class="form-control form-control-sm " id="TrieuChung" 
                                    placeholder="Các triệu chứng..."></textarea>
                                    </div>
                              </div>

                               <div class="mb-2 row">
                                    <label for="colFormLabelSm" class="col-sm-12 col-form-label col-form-label-sm">Chuẩn Đoán bệnh:</label>
                                    <div class="col-sm-12">
                                    <input required type="text"  name="name" class="form-control form-control-sm " id="ChuanDoan" 
                                    placeholder="Chuẩn đoán sơ bộ...">
                                    </div>
                              </div>


                               <div class="mb-2 row">
                                    <label for="colFormLabelSm" class="col-sm-12 col-form-label col-form-label-sm">Chuyên Khoa </label>
                                    <div class="col-sm-12">
                                       <select id="ChuyenKhoa" class="form-select form-control-sm "  required>
			                                <option selected>Chọn Chuyên khoa</option>
			                                @foreach($specialistss as $key => $vid)
			                                  <option value="{{$vid->id}}">{{$vid->specialist}}</option>
			                                @endforeach
			                            </select>
                                    </div>
                              </div>


                                <div class="mb-2 row">
                                    <label for="colFormLabelSm"  class="col-sm-12 col-form-label col-form-label-sm">Lời Khuyên</label>
                                    <div class="col-sm-12">
                                    <textarea type="text" name="desc" rows="3" class="form-control form-control-sm " id="LoiKhuyen" 
                                    placeholder="Lời khuyên..."></textarea>
                                    </div>
                                </div>
                                
                            </li>
                            <li class="list-group-item">
                                   <div style="display: flex; justify-content: center; margin-top: 7px;"> 
                                     <input  type="hidden" value="0"  name="name" class="ID" >
                                    <button type="submit"  class="btn btn-outline-info add_Data2">Thêm</button>
                                    <button type="button"  class="btn btn-outline-info save_Data2">Lưu</button> 
                                   </div>
                            </li>
                         
                 </ul>

                 
      

        </div>
    </div>
</div>


<script type="text/javascript">
$(document).ready(function(){
  


   $('.show_model1').on("click", function(){
   	    
		    $('.save_Data1').hide();
		    $('.add_Data1').show();
		    $('.TVmodel1').text("Thêm Dữ Liệu Câu Hỏi Tư Vấn");


       $('.list_model1').show();
		   $('.list_model2').hide();
		   $('#CauHoi').val("");
		   $('#CauTL').val("");

	});


   $(document).on('click','.btn-edit-rowdata1',function(){
  
	    var ID = $(this).closest("tr").find(".ID").text();
	    var TrieuChung = $(this).closest("tr").find(".TrieuChung").text();
	    var LoiKhuyen = $(this).closest("tr").find(".LoiKhuyen").text();
	    $('#CauHoi').val(TrieuChung);
	    $('#CauTL').val(LoiKhuyen);
	    $('.ID').val(ID);

	    $('.list_model1').show();
		  $('.list_model2').hide();

	    $('.save_Data1').show();
	    $('.add_Data1').hide();
	    $('.TVmodel1').text("Cập Nhật Dữ Liệu Câu Hỏi Tư Vấn");

   });


	 $('.add_Data1').on("click", function(){
       Add_Or_Update_Data1(1)
	 });
	 $('.save_Data1').on("click", function(){
       Add_Or_Update_Data1(2)
	 });



	 function Add_Or_Update_Data1(status){
	 	    var ID = $('.ID').val();
		    var CauHoi = $('#CauHoi').val();
		    var CauTL = $('#CauTL').val();
	        var _token = $('input[name="_token"]').val();
	        if (CauHoi == "" || CauTL== "") {
            $.NotificationApp.send("","Không được để trốngs","top-right","rgba(0,0,0,0.2)","error");
	        }else{

	         $.ajax({
	                url:"{{url('admin/Add_Or_Update_Data1')}}",
	                method:"post",
	                headers:{
	                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                },
	              data:{status:status,ID:ID, CauHoi:CauHoi,CauTL:CauTL, _token:_token},
	                success:function(data){
	                     LoadDataSet(1)

	                    $('.btn-close').click();
	                }
	        }); 
	     }
	 }
	  


//////////////////// xu ly ben tab 2 ///////////////////////////


    $('.show_model2').on("click", function(){

		    $('.save_Data2').hide();
		    $('.add_Data2').show();
		    $('.TVmodel1').text("Thêm Dữ Liệu Câu Hỏi Bệnh Lý");


		   $('.list_model1').hide();
		   $('.list_model2').show();

		   $('#TrieuChung').val("");
		   $('#ChuanDoan').val("");
		   $('#LoiKhuyen').val("");
		   $('#ChuyenKhoa').val("");


	});

	 $(document).on('click','.btn-edit-rowdata2',function(){
  
	    var ID = $(this).closest("tr").find(".ID").text();
	    var TrieuChung = $(this).closest("tr").find(".TrieuChung").text();
	    var ChuanDoan = $(this).closest("tr").find(".ChuanDoan").text();
	    var ChuyenKhoa = $(this).closest("tr").find(".ChuyenKhoa").text();
	    var LoiKhuyen = $(this).closest("tr").find(".LoiKhuyen").text();
	 
	    $('#TrieuChung').val(TrieuChung);
	    $('#ChuanDoan').val(ChuanDoan);
	    $('#ChuyenKhoa').val(ChuyenKhoa);
	    $('#LoiKhuyen').val(LoiKhuyen);
	    $('.ID').val(ID);


      $('.list_model1').hide();
		  $('.list_model2').show();
	    $('.save_Data2').show();
	    $('.add_Data2').hide();
	    $('.TVmodel1').text("Cập Nhật Dữ Liệu Bệnh Lý");

   });



	 $('.add_Data2').on("click", function(){
        Add_Or_Update_Data2(1)
	 });
	 $('.save_Data2').on("click", function(){
        Add_Or_Update_Data2(2)
	 });

	 function Add_Or_Update_Data2(status){
	 	    var ID = $('.ID').val();
		    var TrieuChung = $('#TrieuChung').val();
		    var ChuanDoan = $('#ChuanDoan').val();
		    var ChuyenKhoa = $("#ChuyenKhoa option:selected").text();
		    var LoiKhuyen = $('#LoiKhuyen').val();
	        var _token = $('input[name="_token"]').val();
	         if (TrieuChung == "" || ChuanDoan=="" || ChuyenKhoa == "" || LoiKhuyen=="") {
            $.NotificationApp.send("","Không được để trống","top-right","rgba(0,0,0,0.2)","error");
	        }else{

	         $.ajax({
	                url:"{{url('admin/Add_Or_Update_Data2')}}",
	                method:"post",
	                headers:{
	                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                },
	              data:{status:status,ID:ID, 
	              	    TrieuChung:TrieuChung,
	              	    ChuanDoan:ChuanDoan, 
	              	    ChuyenKhoa:ChuyenKhoa,
	              	    LoiKhuyen:LoiKhuyen,_token:_token},
	                success:function(data){
	                     LoadDataSet(2)

	                    $('.btn-close').click();
	                }

	        }); 

	     }
	 }




///////////////////////////////////////////////////////

  $(document).on('click','.li_Data2',function(){
     LoadDataSet(2);
  });


  LoadDataSetCH();
   LoadDataSet(1);
	function LoadDataSet(status){

	 $.ajax({
	        url:"{{url('admin/LoadDataSet')}}",
	        method:"GET",
	        headers:{
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	      data:{status:status},
	        success:function(data){
	            if(status == 1){
	              $('#LoadDataCauHoi').html(data); 
	            }else{
	              $('#LoadDataBenhLy').html(data); 
	            }

	                  
	        }

	   }); 
	 }
////////////////////////////////////////
  $(document).on('click','.li_Data3',function(){
     LoadDataSetCH();
  });

   LoadDataSetCH();
  function LoadDataSetCH(){

   $.ajax({
          url:"{{url('admin/LoadDataSetCH')}}",
          method:"GET",
          headers:{
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        data:{status:status},
          success:function(data){
                $('#LoadDataCH').html(data); 
         
          }

     }); 
   }
/////////////////////////////////////////

  $(document).on('click','.delete_data1',function(){
   	 var ID = $(this).closest("tr").find(".ID").text();
	 delete_row_dataset(ID, 1);
  });

  $(document).on('click','.delete_data2',function(){
   	 var ID = $(this).closest("tr").find(".ID").text();
	 delete_row_dataset(ID, 2);
  });


  $(document).on('click','.delete_data3',function(){
     var ID = $(this).closest("tr").find(".ID").text();
     delete_row_dataset(ID, 3);
  });

  function delete_row_dataset(ID, status){
  	
	 $.ajax({
	        url:"{{url('admin/delete_row_dataset')}}",
	        method:"GET",
	        headers:{
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	      data:{status:status, ID:ID},
	        success:function(data){
                if(status == 1){

                  LoadDataSet(status)

                }else if(status == 2){

                  LoadDataSet(status)
                }else{

                 LoadDataSetCH();
                }



	                  
	        }

	   }); 
	 }

  

 }); 
</script>


@endsection