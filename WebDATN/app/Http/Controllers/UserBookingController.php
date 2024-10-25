<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use App\Events\NotificationBooking;
use Illuminate\Support\Facades\Event;
use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Models\infor_patient;
use App\Models\infor_doctor;
use App\Models\User;
use App\Models\specialist_doctor;
use App\Models\service_medical;
use App\Models\company_doctor;
use App\Models\schedule;
use App\Models\service_doctor;

use App\Models\date_mange;
use App\Models\time_manage;
use App\Models\statistical;
use App\Models\notifications;



class UserBookingController extends Controller
{
  public function details_doctor($id_doctor){

  /////////////////////////////////////////////
    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    $sta = new statistical();
    $sta->id_user = Auth::user()->id;
    $sta->id_doctor = $id_doctor;
    $sta->id_schedule = 0;
    $sta->stype = 0;
    $sta->key_stype = "access_time";
    $sta->date =  $now;
    $sta->save();
  /////////////////////////////////////////////////////

    $info_doctor = User::where('id', $id_doctor)->first();
    $all_ser = service_doctor::where('id_company', $info_doctor->company->id)->get();
    $title_tag = $info_doctor->name;

     return view('User.Details_doctor')
     ->with('all_ser', $all_ser)
     ->with('info_doctor', $info_doctor)
     ->with('title_tag', $title_tag);
  ;
 }

 public function load_date(Request $request){
   $output='';
    $currentDate = Carbon::now('Asia/Ho_Chi_Minh');
    $date =  $currentDate->addDay()->toDateString();
    for ($i = 0; $i < 14; $i++) {
   
      $thu = $currentDate->format('l');
      $thuAb = substr($thu, 0, 3);
      $ngay = $currentDate->format('d'); 
      $thang = $currentDate->format('F');
     

      $days_setting = date_mange::select('id')->where('id_doctor', $request->id_doctor)->get();
    
      if($days_setting->count() > 0){
          $days_set = date_mange::select('date')->where('date', $thuAb)->where('id_doctor', $request->id_doctor)->get()->count();
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

     $all_schedule = schedule::select('time')->where('id_doctor', $request->id_doctor)->where('date', $request->date)->get();
     $data = [];
     foreach($all_schedule as $time){
          $data[] = $time->time;
	   }
	   $result = array_diff($times, $data);
     $i=0;
     $output ='';
     foreach($result as $time){ 
          $time_set = time_manage::select('time')->where('time', $time)->where('id_doctor', $request->id_doctor)->get()->count();
          if($time_set != 1){
          $output.='<button type="button" data-time="'.$time.'" class="btn btn-outline-primary"
          data-bs-toggle="modal" data-bs-target="#fill-primary-modal" value="'.$i++.'">'.$time.'</button>';
          }
       	 

     }

     echo $output;
 }

 public function accept_booking(Request $request){
         $code = random_int(100000, 999999);
         $all_schedule = schedule::where('id_doctor', $request->id_doctor_modal)
         ->where('date', $request->date_book)
         ->where('time', $request->time_book)->get();
         // dd($all_schedule->count());
         if($all_schedule->count() > 0){

	         // $output['check'] = 0;
	         // echo json_encode($output);
          return response()->json(['status' => 0]);
	       
         }else{
          
	         $schedule = new schedule();
	 	       $schedule->code = $code;
	 	       $schedule->id_doctor = $request->id_doctor_modal;
	         $schedule->id_user = Auth::user()->id;
	         $schedule->time = $request->time_book;
	         $schedule->date = $request->date_book;
	         $schedule->reason = $request->reason;
	         $schedule->note = $request->note;
	         $schedule->insurance =  $request->insurance;
	         $schedule->payment = 0;

           $schedule->type = $request->type;
           $schedule->service = $request->service;
           $schedule->status = 0;
           $now = Carbon::now('Asia/Ho_Chi_Minh');
           $schedule->created_at = $now->toDateString();
	         $schedule->save();

	         // $output['check'] = 1;
           $userId =  $request->id_doctor_modal;

           $message  = "Bạn vừa có 1 lịch hẹn mới";
           $arr=[];
           $arr['time'] = $request->time_book;
           $arr['date'] = $request->date_book;
           $arr['name'] =  Auth::user()->name;
           // dd($arr, $message, $userId);

           event(new NotificationBooking($userId, $message, $arr));


           $notifi= new notifications();
           $notifi->id_from = Auth::user()->id;
           $notifi->id_to = $request->id_doctor_modal;;
           $notifi->messege = "Bạn vừa có 1 lịch hẹn mới vào lúc: ".$request->time_book." Ngày ".$request->date_book;
           $notifi->time = $now;
           $notifi->status = 0;
           $notifi->save();

	         // echo json_encode($output); 
           return response()->json(['status' => 1]);

         }


 }

 
}
