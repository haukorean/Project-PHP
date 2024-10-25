<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\Models\infor_patient;
use App\Models\infor_doctor;
use App\Models\User;
use Mail;

class Admin_Dotor_Controller extends Controller
{
   public function List_doctor_admin(){
    $title_tag = "Manage Doctor";
    $all_dt = User::where("role_user", 2)->where("status", 0)->get();
    return view('Admin.List_Doctor')->with('title_tag', $title_tag)->with('all_dt', $all_dt);
   }


   public function accept_or_refuse_doctor(Request $request){
   	if($request->status == -1){

   		 $users = User::find($request->id);
   		    File::deleteDirectory(public_path('Image/file_user/'.$users->id));
	        if($users->doctor->avt_user != 0){      
	           unlink('Image/avt_user/'.$users->id);  
	        }

        $to_email = $users->email;
        $to_name = "LHeathy-Eday";
        $to_mes = "Yêu cầu đăng ký phòng khám của bạn đã được chấp nhận.";
        Mail::send('Mail.MailAccount', ['to_mes' => $to_mes], function ($message) use ($to_email, $to_name, $to_mes) {
            $message->from('pthien.19it2@vku.udn.vn', 'LHeathy-Eday');
            $message->to($to_email, $to_name,$to_mes);
            $message->subject('Yêu cầu đăng ký phòng khám của bạn');
        });   

       $users->delete();

   	}else{

   	      User::where("id", $request->id)->update(['status' => $request->status]);
          $users = User::find($request->id);

          $to_email = $users->email;
          $to_name = "LHeathy-Eday";
          $to_mes = "Yêu cầu đăng ký phòng khám của bạn đã được chấp nhận.";
          Mail::send('Mail.MailAccount', ['to_mes' => $to_mes], function ($message) use ($to_email, $to_name, $to_mes) {
            $message->from('pthien.19it2@vku.udn.vn', 'LHeathy-Eday');
            $message->to($to_email, $to_name,$to_mes);
            $message->subject('Yêu cầu đăng ký phòng khám của bạn');
        });   

   	}
    
   }

    public function Load_list_new_doctor(Request $request){
    	if($request->status == 0){
         $all_dt = User::where("role_user", 2)->where("status", 0)->get();
    	}else if($request->status == 1){
         $all_dt = User::where("role_user", 2)->where("status", 1)->get();
    	}else{
         $all_dt = User::where("role_user", 2)->where("status", 2)->get();
    	}
        $output ='';
              if($all_dt->count()>0){
                 $i=0;
                    foreach($all_dt as $key => $vid){
                        $i++;
                            $output.='     
                             <tr>
                               <td>'.$vid->id.'</td>  
                                <td>'.$i.'</td>  
                                <td class="table-user">
                                     <img  src="'.url('/Image/avt_user/'.$vid->id.'/'.$vid->doctor->avt_user.'').'" alt="user-image" 
                                      class="me-2 rounded-circle" >
                                      <span class="text-body fw-semibold">'.$vid->name.'</span> 
                                 </td>
                                <td>'.$vid->doctor->number_phone.'</td>
                                <td>'.$vid->email.'</td>';
                                 if($vid->status==1){
                                  $output.='<td>'.$vid->company->specialist->specialist.'</td>';
              
                                  }

                         $output.='
                                <td>'.$vid->created_at.'</td>
                                <td>
                                <button type="button" class="btn btn-danger btn-sm"
                                 data-bs-toggle="modal" onclick="view_infor_doctor('.$vid->id.')" data-bs-target="#info-header-modal">Xem</button></td>
                            </tr>                       

                        ';
                    }
                    }else{ 
                    $output.='
                              <tr>
                                   <td colspan="4">Không tồn tại</td>
                                               
                              </tr>


                        ';

                }

         echo $output;
   }



    public function search_list_doctor(Request $request){
      if($request->status == 0){
         $all_dt = User::where("role_user", 2)->where("status", 0)->where('name', 'LIKE', '%'.$request->value.'%')->get();
      }else if($request->status == 1){
         $all_dt = User::where("role_user", 2)->where("status", 1)->where('name', 'LIKE', '%'.$request->value.'%')->get();
      }else{
         $all_dt = User::where("role_user", 2)->where("status", 2)->where('name', 'LIKE', '%'.$request->value.'%')->get();
      }
        $output ='';
              if($all_dt->count()>0){
                $i=0;
                    foreach($all_dt as $key => $vid){
                          $i++;
                            $output.='
                             <tr>
                                <td>'.$i.'</td>  
                                <td class="table-user">
                                     <img  src="'.url('/Image/avt_user/'.$vid->id.'/'.$vid->doctor->avt_user.'').'" alt="user-image" 
                                      class="me-2 rounded-circle" >
                                      <a href="" class="text-body fw-semibold">'.$vid->name.'</a> 
                                 </td>
                                <td>'.$vid->doctor->number_phone.'</td>
                                <td>'.$vid->email.'</td>
                                ';
                                 if($vid->status==1){
                                  $output.='<td>'.$vid->company->specialist->specialist.'</td>';
              
                                  }

                         $output.='
                                <td>'.$vid->created_at.'</td>
                                <td>
                                <button type="button" class="btn btn-danger btn-sm"
                                 data-bs-toggle="modal" onclick="view_infor_doctor('.$vid->id.')" data-bs-target="#info-header-modal">Xem</button></td>
                            </tr>                       

                        ';
                    }
                    }else{ 
                    $output.='
                              <tr>
                                   <td colspan="4">Không tồn tại</td>
                                               
                              </tr>


                        ';

                }

         echo $output;
   }

   public function view_infor_doctor(Request $request){

        $id = $request->id;
        $user = User::find($id);
              
	        // $output['id'] = $user->id;
	        // $output['image_user'] = $user->avt_user;

          $output['image_user'] = '<img alt="image" src="'.url('/Image/avt_user/'.$user->id.'/'.$user->doctor->avt_user).'"
          class="img-fluid avatar-md rounded-circle"/>';

	        $output['nickname'] = $user->name;
	        $output['email_user'] = $user->email;
	        $output['phone_user'] = $user->doctor->number_phone;


	        $output['birthday'] = $user->doctor->birth_day;
	        $output['sex'] = $user->doctor->sex;
	        $output['address'] = $user->doctor->details_address.', '.$user->doctor->address;
	        $output['work_experience'] = $user->doctor->work_experience;
	        $output['about_me'] = $user->doctor->about_me;


	        $output['cccd1'] = '<img alt="image" src="'.url('/Image/file_user/'.$user->id.'/'.$user->doctor->front_cccd).'"
	         class="img-fluid img-thumbnail"/>';

	        $output['cccd2'] = '<img alt="image" src="'.url('/Image/file_user/'.$user->id.'/'.$user->doctor->backside_cccd).'" 
	         class=" img-fluid img-thumbnail"/>';

	        $output['file_pdf'] = '<a href="'.url('/Image/file_user/'.$user->id.'/'.$user->doctor->file_physician).'" target="_blank" rel="noopener noreferrer" >PDF<a>';

      
      
        echo json_encode($output);     

   }
}
