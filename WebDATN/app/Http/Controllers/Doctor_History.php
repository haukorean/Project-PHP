<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\infor_patient;
use App\Models\infor_doctor;
use App\Models\company_doctor;
use App\Models\schedule;
use App\Models\User;
use App\Models\results_examination;
use App\Models\results_test;

class Doctor_History extends Controller
{
  
 public function history_medical_doctor(){
    $title_tag = "History Medical Doctor";
     return view('Doctor.history_doctor')->with('title_tag', $title_tag);
 }
 public function load_history_schedule(Request $request){
    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

   if($request->key == "filter"){
      $all_his = schedule::where('id_doctor', Auth::user()->id)->where('id_user',$request->value)->where('date', '<=' ,$now)
      ->orderBy('date', 'desc')->get()->unique('date');

   }else if($request->key == "search"){

   	  $all_his = schedule::where('id_doctor', Auth::user()->id)->where('date', '<=' ,$now)
   	   ->where('date', 'LIKE', '%'.$request->value.'%')
       //->orwhere('reason', 'LIKE', '%'.$request->value.'%')
       ->orderBy('date', 'desc')->get()->unique('date');

   }else{

      $all_his = schedule::where('id_doctor', Auth::user()->id)->where('date', '<=' ,$now)->orderBy('date', 'desc')->get()->unique('date');
 
   }
  
    $output ='';
     if($all_his->count() > 0){

          foreach($all_his as $his){
              $all_his_date = schedule::where('id_doctor', Auth::user()->id)->where('date', $his->date)->orderBy('time', 'asc')->get();
              $output.='<div class="item mb-3">
			          	<h4 class="header-title text-center"> -------- '.$his->date.' ---------</h4>';
			     foreach($all_his_date as $his_date){
			     	   $output.='   
		               
			            <div class="row border border-primary ms-2 me-2 mb-1">
		                  <div class="col-md-4 p-1 border-end">
		                    	<span class="d-flex justify-content-center btn btn-outline-success mt-1">'.$his_date->time.'</span>
		                    	<span class="d-flex justify-content-center">_________Patient_________</span>
				                 <div class="d-flex align-self-start">';
						          	   if($his_date->user_patient->patient->avt_user == 0){
      									     $output.= '<img  src="'.asset('/Image/avt_user.png').'" alt="user-image" class="d-flex align-self-start rounded me-2" width="48">';    
      									   }else{
      			                 $output.= ' <img  src="'.asset('/Image/avt_user/'.$his_date->id_user.'/'.$his_date->user_patient->patient->avt_user).'" alt="user-image" class="d-flex align-self-start rounded me-2" width="48">';     
      									   } 
      						        $output.='
		                    <div class="w-100 overflow-hidden">
		                        <h5 class="mt-1 mb-0">'.$his_date->user_patient->name.'</h5>
		                        <p class="mb-1 mt-1 text-muted">
		                        ';
      						       if($his_date->status == 1){
      									     $output.= '<span class="badge badge-success-lighten">Thành công</span>';    
      									   }else{
      			                  $output.= '<span class="badge badge-warning-lighten">Đã hết hạn</span>';    
      									   } 
      						        $output.='
				                        </p>
				                    </div>
				             
				                </div>
		                    </div>

		                    <div class="col-md-6 p-1">
		                    	<span class="text-muted"><strong>Lý do: <br></strong><span class="">'.$his_date->reason.'</span></span><br>

			                    <span class="text-muted"><strong>Ghi chú:</strong><span class="ms-2 me-4">'.$his_date->note.'</span> </span><br>';
			          	 	      if($his_date->insurance != null){
						               $output.= '<span class="text-muted"><strong>Bảo hiểm:</strong>
						               <span class="ms-2 me-4">'.$his_date->insurance.'</span></span>';     
						            }else{
                                       $output.= '<span class="text-muted"><strong>Bảo hiểm:</strong>
						               <span class="ms-2 me-4">No</span></span>';    
						            } 
			          	 $output.='
			                    
			          	 	    <span class="text-muted">
			          	 	    <strong>Dịch vụ:</strong><span class="ms-2 me-4">
			          	 	    ';
			          	 	      if($his_date->service != 0){
						               $output.= $his_date->service_doctor->name;     
						            }else{
                                       $output.= '(Mặc định)';    
						            } 
			          	 $output.='</span>
			                   </span>

		                    </div>

                    <div class="col-md-2 p-1">
                        ';
                           if($his_date->status == 1){
                             $output.= '<a href="'.url('/doctor/result_examination/'.$his->id).'" class="btn btn-sm btn-outline-primary float-end">Xem</a>';    
                           }else{
                              $output.= '<button data-id_schedule="'.$his_date->id.'" class="btn btn-sm btn-outline-danger float-end cancel_schedule">Hủy</button>';    
                           } 
                 $output.='
                    </div>
			            </div>
			          ';

			     }
			    $output.='</div>';

          }
     }else{
          $output.='<p class="text-center">Không có lịch!</p>';
     }
   
     echo $output;
 }

 public function load_list_patient(Request $request){
   $currentDate = Carbon::now('Asia/Ho_Chi_Minh');
   $date_current =  $currentDate->toDateString();

   $all_id_pa = results_examination::join('schedule', 'schedule.id', '=', 'results_examination.id_schedule')
      ->select('schedule.id_doctor', 'schedule.id_user', 'schedule.date')->where('schedule.id_doctor', Auth::user()->id)
      ->orderBy('date', 'desc')->get()->unique('id_user');

	 $data=[];
	  foreach($all_id_pa as $id){
	  	     $data[] = $id->id_user;
	  }
     if($request->value != 0){
       $all_patient = User::where("id", $data)->where('name', 'LIKE', '%'.$request->value.'%')->get();
	 }else{
        $all_patient = User::where("id", $data)->get();
	 }
	
     $output ='';
     if($all_patient->count() > 0){
          foreach($all_patient as $pa){
          	   $count_schedule = schedule::where('id_doctor', Auth::user()->id)->where('id_user', $pa->id)->where('status', 1)->get()->count();
               $output.='<div class="item mb-1 click_item_user">
                  <input type="hidden" class="id_user" value="'.$pa->id.'">
	          	  <div class="border border-success ms-2 me-2 p-1">    
		                 <div class="d-flex align-self-start">';
				          if($pa->patient->avt_user == 0){
							  $output.= '<img src="'.asset('/Image/avt_user.png').'" alt="user-image" class="d-flex align-self-start rounded me-2" width="48">';    
						  }else{
	                          $output.= '<img src="'.asset('/Image/avt_user/'.$pa->id.'/'.$pa->patient->avt_user).'" alt="user-image" class="d-flex align-self-start rounded me-2" width="48">';     
						  } 
				        $output.='
		                    <div class="w-100 overflow-hidden">
		                        <h5 class="mt-1 mb-0">'.$pa->name.'</h5>
		                         <p class="mt-1 mb-0">Phone: '.$pa->patient->number_phone.' 
		                         <span class="mb-1 mt-1 badge badge-outline-danger float-end">'.$count_schedule.'</span></p>
		                       
		                    </div>
                          </div>

	              </div>
	          </div>';     
              
          }
     }else{
          $output.='<p class="text-center">Không có bệnh nhân!</p>';
     }
   
     echo $output;
 }

  public function result_examination($id_schedule){
    $title_tag = "Kết quả khám bệnh";

     $result = results_examination::where('id_schedule', $id_schedule)->first();

     return view('Doctor.result_examination')
     ->with('result', $result)->with('title_tag', $title_tag);
 }



 /////////////////////////////////////////////////////////////////////////////////////////////////

 public function load_file_result_examination(Request $request){
   $currentDate = Carbon::now('Asia/Ho_Chi_Minh');
   $date_current =  $currentDate->toDateString();
    if($request->type==0){
        $results_test = results_test::where('id_result', $request->id_result)
        ->where('type', 0)->orderBy('id', 'asc')->get();
    }else{
        $results_test = results_test::where('id_result', $request->id_result)
        ->where('type', 1)->orderBy('id', 'asc')->get();
    }
     $output ='';
     if($results_test->count() > 0){
          $i=0;
          foreach($results_test as $result){
            $date_cre = $result->created_at;
              $i++;
            if($request->type==0){
             
              $output.='<tr>
                          <td>'.$i.'</td>
                          <td>
                          <img src="'.url('/Image/result_examination/'.$request->id_user.'/'.$result->file).'" class="img-thumbnail" width="60" height="60">
                          </td>
                          <td>'.$result->name.'</td>
                          <td>'.$date_cre.'</td>
                          <td> 
                          <a href="'.url('/Image/result_examination/'.$request->id_user.'/'.$result->file).'" target="_blank" rel="noopener noreferrer" class="action-icon btn_show_file"><i class="mdi mdi-eye "></i></a>
                          </td>
                        </tr>';   
            }else{
            
              $output.='<tr>
                         <td>'.$i.'</td>
                          <td>'.$result->name.'</td>
                          <td>'.$date_cre.'</td>
                          <td>
                       
                          <a href="'.url('/Image/result_examination/'.$request->id_user.'/'.$result->file).'" target="_blank" rel="noopener noreferrer" class="action-icon btn_show_file"><i class="mdi mdi-eye "></i></a>
                          </td>

                        </tr>';   

              }
         }
     }else{
          $output.='<td colspan="4" class="text-center" >Không có mục</td>';
     }
   
     echo $output;
 }

}
