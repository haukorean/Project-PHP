<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\infor_patient;
use App\Models\infor_doctor;
use App\Models\company_doctor;
use App\Models\schedule;

class User_Schedule extends Controller
{
 public function schedule_user(){
    $title_tag = "Lịch trình của bạn";
     return view('User.schedule_user')->with('title_tag', $title_tag);
 }

 public function load_schedule_date(Request $request){
   $currentDate = Carbon::now('Asia/Ho_Chi_Minh');
   $date_current =  $currentDate->toDateString();

   $all_schedule = schedule::where('id_user', Auth::user()->id)->where('date', $request->date) ->orderBy('time', 'asc')->get();

     $output ='';
     if($all_schedule->count() > 0){

          foreach($all_schedule as $time){

            if($request->date < $date_current && $time->status==0){
              $output.='<button type="button" data-id_schedule="'.$time->id.'" class="btn btn-outline-warning mt-1 btn_view_schudule"
              data-bs-toggle="modal" data-bs-target="#top-modal">'.$time->time.'</button>';   

            }else if($time->status!=0){
              $output.='<button type="button" data-id_schedule="'.$time->id.'" class="btn btn-outline-success mt-1 btn_view_schudule"
              data-bs-toggle="modal" data-bs-target="#top-modal">'.$time->time.'</button>';   

            }else{

               $output.='<button type="button" data-id_schedule="'.$time->id.'" class="btn btn-outline-primary mt-1 btn_view_schudule"
              data-bs-toggle="modal" data-bs-target="#top-modal">'.$time->time.'</button>';     
            }       

          }
     }else{
          $output.='<button type="button" class="btn btn-outline-danger mt-1">Không có lịch</button>';
     }
   
     echo $output;
 }


 public function view_schedule_user(Request $request){

        $currentDate = Carbon::now();
        $date_current = $currentDate->toDateString();

        $doctor = schedule::find($request->id);

              
            // $output['id'] = $user->id;
            // $output['image_user'] = $user->avt_user;

            if($doctor->user_doctor->doctor->avt_user != 0){
             $output['image_user'] = '<img alt="image" 
             src="'.url('/Image/avt_user/'.$doctor->user_doctor->id.'/'.$doctor->user_doctor->doctor->avt_user).'"
             class="img-fluid avatar-md rounded-circle"/>';
            }else{
              $output['image_user'] = '<img alt="image" 
             src="'.url('/Image/avt_user.png').'"
             class="img-fluid avatar-md rounded-circle"/>';
            }

            if($doctor->date < $date_current && $doctor->status==0){

              $output['status']='<span class="badge badge-warning-lighten">Đã quá ngày</span>';
              $output['span_btn_click_accept']='
                  <a class="btn btn-danger cancel_schedule">Hủy</a>';      

            }else if($doctor->status!=0){
              $output['status']='<span class="badge badge-success-lighten">Hoàn Thành</span>';  
              $output['span_btn_click_accept']='
              <a href="'.url('/user/result_examination/'.$doctor->id).'" class="btn btn-info start_medical" >Kết quả </a>
              ';         

            }else{

               $output['status']='<span class="badge badge-primary-lighten">MỚi</span>';   
               $output['span_btn_click_accept']='
               <a class="btn btn-danger cancel_schedule">Hủy</a>
              ';        
            }        


            $output['nickname'] = $doctor->user_doctor->name;
            $output['email'] = $doctor->user_doctor->email;

            $output['Specialis'] = $doctor->user_doctor->company->specialist->specialist;

            $output['phone_user'] = $doctor->user_doctor->doctor->number_phone;
            $output['work_experience'] = $doctor->user_doctor->doctor->work_experience;
            $output['sex'] = $doctor->user_doctor->doctor->sex;

            $output['address'] = $doctor->user_doctor->doctor->details_address.', '.$doctor->user_doctor->doctor->address;

            $output['time'] = $doctor->time;
            $output['date'] = $doctor->date;

            $output['reason'] = $doctor->reason;
            $output['note'] = $doctor->note;
            $output['insurance'] = $doctor->insurance;

             if ($doctor->service !=0) {
              $output['package'] = $doctor->service_doctor->name;
            }else{
              $output['package'] = "(Mặt định)";
            }

        echo json_encode($output);     

   }

    public function cancel_schedule(Request $request){
       // schedule::where('id', $request->id)->update(['status' => 2]);
       schedule::where('id', $request->id)->delete();
       results_examination::where('re_examination_schedule', $request->id)->update(['re_examination_schedule' => 0]);
    }

}
