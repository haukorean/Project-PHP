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

use App\Models\date_mange;
use App\Models\time_manage;

use App\Models\results_examination;
use App\Models\results_test;
use App\Models\notifications;
use App\Events\NotificationBooking;

class Doctor_Schedule extends Controller
{
    
 public function schedule_doctor(){
    $title_tag = "Schedule of doctor";
    return view('Doctor.schedule_doctor')->with('title_tag', $title_tag);
 }

 public function load_schedule_date(Request $request){
   $currentDate = Carbon::now('Asia/Ho_Chi_Minh');
   $date_current =  $currentDate->toDateString();

   $all_schedule = schedule::where('id_doctor', Auth::user()->id)->where('date', $request->date) ->orderBy('time', 'asc')->get();

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


 public function view_schedule_doctor(Request $request){
        $currentDate = Carbon::now('Asia/Ho_Chi_Minh');
        $date_current =  $currentDate->toDateString();
        
        $id = $request->id;
        $user = schedule::find($request->id);
              
            if($user->date < $date_current && $user->status==0){

              $output['status']='<span class="badge badge-warning-lighten">Has expired</span>';
              $output['span_btn_click_accept']='
                  <a class="btn btn-danger cancel_schedule">Hủy bỏ</a>';      

            }else if($user->status!=0){
              $output['status']='<span class="badge badge-success-lighten">Thành công</span>';  
              $output['span_btn_click_accept']='
                  <a href="'.url('/doctor/result_examination/'.$user->id).'" class="btn btn-info start_medical" >Kiểm tra kết quả</a>
              ';         

            }else{

               $output['status']='<span class="badge badge-primary-lighten">New</span>';   
               $output['span_btn_click_accept']='
                <a class="btn btn-danger cancel_schedule">Hủy bỏ</a>
                <a href="'.url('/doctor/start_medical_examination/'.$user->id).'" class="btn btn-info start_medical" >bắt đầu khám bệnh</a>
              ';        
            }       


            if($user->user_patient->patient->avt_user != 0){
             $output['image_user'] = '<img alt="image" 
             src="'.asset('/Image/avt_user/'.$user->user_patient->id.'/'.$user->user_patient->patient->avt_user).'"
             class="img-fluid avatar-md rounded-circle"/>';
            }else{
              $output['image_user'] = '<img alt="image" 
             src="'.asset('/Image/avt_user.png').'"
             class="img-fluid avatar-md rounded-circle"/>';
            }

            $output['nickname'] = $user->user_patient->name;
            $output['email'] = $user->user_patient->email;

            $output['height'] = $user->user_patient->patient->height;
            $output['weight'] = $user->user_patient->patient->weight;
            $output['blood'] = $user->user_patient->patient->blood_group;

            $output['phone_user'] = $user->user_patient->patient->number_phone;
            $output['age'] = $user->user_patient->patient->age;
            $output['sex'] = $user->user_patient->patient->sex;

            $output['address'] = $user->user_patient->patient->details_address.', '.$user->user_patient->patient->address;

            $output['time'] = $user->time;
            $output['date'] = $user->date;

            $output['reason'] = $user->reason;
            $output['note'] = $user->note;
            $output['insurance'] = $user->insurance;
            if ($user->service !=0) {
              $output['package'] = $user->service_doctor->name;
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


    public function start_medical_examination($id_schedule){

       $schedule = schedule::where('id',$id_schedule)->first();
       $title_tag = "Lịch trình của ".$schedule->user_patient->name;

      return view('Doctor.start_medical_examination')
      ->with('schedule', $schedule)
      ->with('title_tag', $title_tag);
     }


   public function load_date(Request $request){
    $output='';
    $currentDate = Carbon::now('Asia/Ho_Chi_Minh');
    $currentDate->addDay()->toDateString();

    $date =  $currentDate->addDay()->format('d-m-Y');
    for ($i = 0; $i < 14; $i++) {
   
      $thu = $currentDate->format('l');
      $thuAb = substr($thu, 0, 3);
      $ngay = $currentDate->format('d'); 
      $thang = $currentDate->format('F');
     

      $days_setting = date_mange::select('id')->where('id_doctor', Auth::user()->id)->get();
    
      if($days_setting->count() > 0){
          $days_set = date_mange::select('date')->where('date', $thuAb)->where('id_doctor', Auth::user()->id)->get()->count();
          if($days_set != 1){
            $output.='<option class="" value="'.$date.'">'.$thuAb.' - '.$ngay.' - '.$thang.'</option>';
          }   

      }else{
             $output.='<option class="" value="'.$date.'">'.$thuAb.' - '.$ngay.' - '.$thang.'</option>';
      }
    $date =  $currentDate->addDay()->toDateString();
   
  }

     echo $output;
 }

   public function load_time(Request $request){

    $times = array("07:30 : 08:00", "08:00 : 08:30", "08:30 : 09:00", "09:00 : 09:30", 
                   "09:30 : 10:00", "10:00 : 10:30", "10:30 : 11:00", "11:00 : 11:30",
                   "13:30 : 14:00", "14:00 : 14:30", "14:30 : 15:00", "15:00 : 15:30",
                   "15:30 : 16:00", "16:00 : 16:30", "16:30 : 17:00");

     $all_schedule = schedule::select('time')->where('id_doctor', Auth::user()->id)->where('date', $request->date)->get();
     $data = [];
     foreach($all_schedule as $time){
          $data[] = $time->time;
     }
     $result = array_diff($times, $data);
     $i=0;
     $output ='';
     foreach($result as $time){ 
          $time_set = time_manage::select('time')->where('time', $time)->where('id_doctor',Auth::user()->id)->get()->count();
          if($time_set != 1){
          $output.='<button type="button" data-time="'.$time.'"class="btn btn-outline-primary btn_choose_times" value="'.$i++.'">'.$time.'</button>';
          }
         

     }

     echo $output;
 }


  /////////////////////////////////////////////////////////////////////////////////////////////////

  public function upload_file_result(Request $request){
          $currentDate = Carbon::now('Asia/Ho_Chi_Minh');
          $file = new results_test();
          $file->id_result = $request->id_schedule;
      
            if($request->type == 0){
              $get_image = $request->file('file');
              $name_file = $get_image->getClientOriginalName();
              $get_name_image = rand(0,99). '_' .$get_image->getClientOriginalName();
              if (!is_dir(public_path('Image/result_examination/'.$request->id_user))) {
                   mkdir(public_path('Image/result_examination/'.$request->id_user));
              }

              $path = public_path('Image/result_examination/'.$request->id_user.'/'.$get_name_image);
              Image::make($get_image->getRealPath())->save($path);
              $file->name = $name_file;
              $file->type = 0;
              $file->file = $get_name_image;
            }else{
              $get_image = $request->file('file');
              $get_name_image = rand(0,99). '_' .$get_image->getClientOriginalName();
              $name_file = $get_image->getClientOriginalName();
              if (!is_dir(public_path('Image/result_examination/'.$request->id_user))) {
                   mkdir(public_path('Image/result_examination/'.$request->id_user));
              }
              $path = public_path('Image/result_examination/'.$request->id_user);
              $get_image->move( $path, $get_name_image);
              $file->name = $name_file;
              $file->type = 1;
              $file->file = $get_name_image;
            }

           $file->created_at = $currentDate;
           $file->save();
   
  }

 public function load_file_result(Request $request){
    if($request->type==0){
        $results_test = results_test::where('id_result', $request->id_schedule)
        ->where('type', 0)->orderBy('id', 'asc')->get();
    }else{
        $results_test = results_test::where('id_result', $request->id_schedule)
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
                          <input type="hidden" class="id_f "value="'.$result->id.'">
                           <a href="'.url('/Image/result_examination/'.$request->id_user.'/'.$result->file).'" target="_blank" rel="noopener noreferrer" class="action-icon btn_show_file"><i class="mdi mdi-eye "></i></a>
                          <a class="action-icon btn_remove_item"><i class="mdi mdi-delete"></i></a>
                          </td>
                        </tr>';   
            }else{
            
              $output.='<tr>
                         <td>'.$i.'</td>
                          <td>'.$result->name.'</td>
                          <td>'.$date_cre.'</td>
                          <td>
                          <input type="hidden" class="id_f "value="'.$result->id.'">
                            <a href="'.url('/Image/result_examination/'.$request->id_user.'/'.$result->file).'" target="_blank" rel="noopener noreferrer" class="action-icon btn_show_file"><i class="mdi mdi-eye "></i></a>
                          <a class="action-icon btn_remove_item"><i class="mdi mdi-delete"></i></a>
                          </td>

                        </tr>';   

              }
         }
     }else{
          $output.='<td colspan="4" class="text-center" >Trống</td>';
     }
   
     echo $output;
 }

   public function remove_item_file(Request $request){
      $results_test = results_test::find($request->id);
      if($results_test->file !=null){      
           unlink('Image/result_examination/'.$request->id_user.'/'.$results_test->file);    
      }
      $results_test->delete();
  }


  

  public function save_result_examnination(Request $request){
     $currentDate = Carbon::now('Asia/Ho_Chi_Minh');
     $infor_schedule = schedule::find($request->id_schedule);
     $code = random_int(100000, 999999);

      if($request->time_span != 0 && $request->date_span != 0){
       $schedule = new schedule();
       $schedule->code = $code;
       $schedule->id_doctor = Auth::user()->id;
       $schedule->id_user = $infor_schedule->id_user;
       $schedule->time = $request->time_span;
       $schedule->date = $request->date_span;
       $schedule->reason = $infor_schedule->reason;
       $schedule->note = "re-examination";
       $schedule->insurance =  $infor_schedule->insurance;
       $schedule->payment = 0;
       $schedule->type = $infor_schedule->type;
       $schedule->service = $infor_schedule->service;
       $schedule->status = 0;
       $schedule->save();

      }
    
     $spe = new results_examination();
     $spe->id_schedule = $request->id_schedule;
     $spe->symptom_describe = $request->symptoms;
     $spe->initial_diagnosis = $request->Initial;
     $spe->final_diagnosis = $request->final;
     $spe->recommended_treatment = $request->recommended;
     $spe->prescription = $request->prescription;
     $spe->advice = $request->advice;
     $spe->costs_incurred = $request->costs;
     if($request->costs == 0){
     $spe->costs_totals = $request->price_default;
     }else{
      $spe->costs_totals = $request->costs + $request->price_default;
     }
    
      if($request->time_span != 0 && $request->date_span != 0){
        $spe->re_examination_schedule = $schedule->id;
      }else{
        $spe->re_examination_schedule = 0;
      }

     $spe->date = $currentDate->toDateString();
     $spe->status = 0;
     $spe->created_at = $currentDate->toDateString();
     $spe->save();

     $now = Carbon::now('Asia/Ho_Chi_Minh');
     $notifi= new notifications();
     $notifi->id_from = Auth::user()->id;
     $notifi->id_to = $infor_schedule->id_user;
     $notifi->messege = "Kết quả khám bệnh của bạn tại bác sĩ ".Auth::user()->name." đã có ";
     $notifi->time = $now;
     $notifi->status = 1;
     $notifi->save();

     $userId =  $infor_schedule->id_user;
     $message  = "Kết quả khám đã có";
     $arr=[];
     $arr['time'] = $infor_schedule->time;
     $arr['date'] = $infor_schedule->date;
     $arr['name'] ="";
     // dd($arr, $message, $userId);

     event(new NotificationBooking($userId, $message, $arr));

     results_test::where('id_result', $request->id_schedule)->update(['id_result' => $spe->id]);
     schedule::where('id', $request->id_schedule)->update(['status' => 1]);
  } 

}
