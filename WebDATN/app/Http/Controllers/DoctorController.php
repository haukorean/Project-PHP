<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

use Carbon\Carbon;

use App\City;

use App\Models\infor_doctor;
use App\Models\company_doctor;
use App\Models\User;
use App\Models\schedule;
use App\Models\results_examination;
use App\Models\results_test;
use App\Models\statistical;
use App\Models\notifications;
use App\Models\remind;
use Mail;

class DoctorController extends Controller
{
 public function index(){
    $title_tag = "Trang chủ của bác sĩ";

    $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

    $lastWeekStart = Carbon::now('Asia/Ho_Chi_Minh')->subWeek()->endOfWeek()->subDays(6);
    $lastWeekEnd = Carbon::now('Asia/Ho_Chi_Minh')->subWeek()->endOfWeek();

    $thisWeekStart = Carbon::now('Asia/Ho_Chi_Minh')->endOfWeek()->subDays(6);
    $thisWeekEnd = Carbon::now('Asia/Ho_Chi_Minh')->endOfWeek();

    $countshedule = schedule::where('id_doctor', Auth::user()->id)->whereBetween('created_at',[$sub365days,$now])->orderBy('created_at','ASC')->get()->count();

    $count_patient = results_examination::join('schedule', 'schedule.id', '=', 'results_examination.id_schedule')
      ->select('schedule.id_doctor', 'schedule.id_user', 'schedule.date')->where('schedule.id_doctor', Auth::user()->id)
      ->orderBy('date', 'desc')->get()->unique('schedule.id_user');

    $costs_totals = results_examination::join('schedule', 'results_examination.id_schedule', '=', 'schedule.id')
      ->select('schedule.id_doctor', 'results_examination.date', 'results_examination.costs_totals')->where('schedule.id_doctor', Auth::user()->id)
      ->whereBetween('results_examination.date',[$sub365days, $now])->get()->sum('costs_totals');

    $access_time = statistical::where('id_doctor', Auth::user()->id)->where('stype', 0)->whereBetween('date',[$sub365days,$now])->get()->count();


    $costs_LastWeek = results_examination::join('schedule', 'results_examination.id_schedule', '=', 'schedule.id')
      ->select('schedule.id_doctor', 'results_examination.date', 'results_examination.costs_totals')->where('schedule.id_doctor', Auth::user()->id)
      ->whereBetween('results_examination.date',[$lastWeekStart->toDateString(), $lastWeekEnd->toDateString()])->get()->sum('costs_totals');

    $costs_CurrentWeek = results_examination::join('schedule', 'results_examination.id_schedule', '=', 'schedule.id')
      ->select('schedule.id_doctor', 'results_examination.date', 'results_examination.costs_totals')->where('schedule.id_doctor', Auth::user()->id)
      ->whereBetween('results_examination.date',[$thisWeekStart->toDateString(), $now])->get()->sum('costs_totals');




      $this->ThucHienGuiTB();

    return view('Doctor.index')
    ->with('countshedule', $countshedule)
    ->with('count_patient', $count_patient->count())
    ->with('costs_totals', $costs_totals)
    ->with('access_time', $access_time)
    ->with('costs_LastWeek', $costs_LastWeek)
    ->with('costs_CurrentWeek', $costs_CurrentWeek)
    ->with('title_tag', $title_tag);
 }

  public function ThucHienGuiTB(){
       $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
       $checkDTRemind = remind::where('id_user', Auth::user()->id)->get();
       if ($checkDTRemind->count() > 0) {
          $checkRemind = remind::where('id_user', Auth::user()->id)->first();
          if ($checkRemind->date == $now && $checkRemind->status==0) {
                $this->mailTomorow();
          }else if ($checkRemind->date != $now && $checkRemind->status==1){

                 $remind = remind::find($checkRemind->id);
                 $remind->date = $now;
                 $remind->status = 1;
                 $remind->save();

                 $this->mailTomorow();
         }
           # code...
       }else{

         $remind = new remind();
         $remind->id_user = Auth::user()->id;
         $remind->date = $now;
         $remind->status = 1;
         $remind->save();
         $this->mailTomorow();
       }

   }

  public function mailTomorow(){
   // Lấy mốc thời gian cho ngày mai ở múi giờ 'Asia/Ho_Chi_Minh'
    $ngayMai = Carbon::tomorrow('Asia/Ho_Chi_Minh');
    // Chuyển đổi thành chuỗi ngày
    $chuoiNgayMai = $ngayMai->toDateString();

    $shedule = schedule::where('id_doctor', Auth::user()->id)->where('date', $chuoiNgayMai)->get();

    if ($shedule->count() > 0) {
         foreach($shedule as $key => $val){ 
             $to_email = $val->user_patient->email;
             $to_name = "LHeathy-Eday";
             $to_mes = "Ngày mai ! Bạn Có một lịch hẹn khám bệnh tại: ". Auth::user()->company->company_name." \n - Vào lúc: ".$val->time." | ".$val->date ;
             Mail::send('Mail.MailAccount', ['to_mes' => $to_mes], function ($message) use ($to_email, $to_name, $to_mes) {
                $message->from('vdnphuc.19it6@vku.udn.vn', 'LHeathy-Eday');
                $message->to($to_email, $to_name,$to_mes);
                $message->subject('Nhắc nhỡ lịch hẹn khám bệnh');
            });   

       }
       
    }
   $checkRemind = remind::where('id_user', Auth::user()->id)->update(['status' => 1]);
  }


  public function load_static_chart(){

    $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
    $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
    // $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
 //////////////////////////////////////////////////////////////// thang truoc
    $countshedule = schedule::where('id_doctor', Auth::user()->id)->whereBetween('date',[$dau_thangtruoc, $now])
    ->orderBy('date','ASC')->get();
   if($countshedule->count() >0){
         foreach($countshedule as $key => $val){
             $chart_data[] = array(
                    'perChedule' =>$val->date,
                    'Schedule' => schedule::where('id_doctor', Auth::user()->id)->where('date', $val->date)->get()->count(),
                    // 'TotalCosts' => results_examination::where('date', $val->date)->get()->sum('costs_totals')  
                );
            }

      echo $data = json_encode($chart_data);
    }else{
    $chart_data[] = array(
                    'perChedule' =>0,
                    'Schedule' => 0,
                );
      echo $data = json_encode($chart_data);
    }

 
 }

public function delete_notification(){
  notifications::where('id_to', Auth::user()->id)->delete();
}
public function load_notification_booking(){
 $noti =  notifications::where('id_to', Auth::user()->id)->orderby('time', "desc")->get();
 $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
 $output ='';
   if($noti->count() >0){
      foreach($noti as $noti){ 
        // Tính khoảng cách thời gian
         $timeDiff = Carbon::parse($noti->time)->diff(Carbon::parse($now));
         $times = 0;

               // dd($timeDiff->format('%i')); 
        if($timeDiff->format('%i') == 0) {

         $times = $timeDiff->format('%s')." Giây trước";

        }else if ($timeDiff->format('%i') > 0) {

         $times = $timeDiff->format('%i')." Phút trước";

        }else  if ($timeDiff->format('%i') > 60){

         $times = $timeDiff->format('%h')."Giờ trước";

        }else{
         $times = $timeDiff->format('%d')." Ngày trước";
        }
         
      $output.=' <div class="border-top mt-1">
                 <a href="'.url('/doctor/schedule_doctor').'" class="dropdown-item notify-item ">
                    <div class="notify-icon bg-primary">
                        <i class="mdi mdi-comment-account-outline"></i>
                    </div>
                    <div class="">
                     <span class="text-wrap">'.$noti->messege.'</span>
                    </div>
                    <small class="text-muted float-end">'.$times.' </small>                       
                   </a> 
                </div>'
                ;
       }

    }else{
     $output.='<p class="text-center">Không có thông báo mới !</p>';

    }
  echo $output;
}


 public function load_count_schedule(){

        $date_now = Carbon::now('Asia/Ho_Chi_Minh');

        $today = schedule::where('id_doctor', Auth::user()->id)->where('date', $date_now->toDateString())->get()->count();
        $upcomming = schedule::where('id_doctor', Auth::user()->id)->where('date','>=', $date_now->toDateString())->where('status', 0)->get()->count();
        $missed = schedule::where('id_doctor', Auth::user()->id)->where('date','<',$date_now->toDateString())->where('status', 0)->get()->count();
        $total = schedule::where('id_doctor', Auth::user()->id)->where('status', 1)->get()->count();
            $output['today'] = $today;
            $output['upcomming'] = $upcomming;
            $output['missed'] = $missed;
            $output['total'] = $total;

        echo json_encode($output);    
   
 }


 public function Accept_doctor(Request $request){

 	     $company = new company_doctor();
         $company->id_user = Auth::user()->id;
         $company->id_specialist = $request->id_specialist;
         $company->company_name = $request->name;
         $company->company_phone = $request->phone;
         $company->company_email = $request->email;
         $company->company_address =  $request->address;
         $company->price = $request->price;
         $company->service = $request->describe_service;
         $company->about_us = $request->about_clinic;
         $company->status = 1;
         $company->save();
         User::where("id", Auth::user()->id)->update(['status' => 1]);

        return redirect('/doctor'); 
 }

 public function reset_password(){
    $title_tag = "Đặt lại mật khẩu";
     return view('Doctor.reset_password')->with('title_tag', $title_tag);
 }

public function save_reset_password(Request $request){
         $users = User::find(Auth::user()->id);
         $users->password = Hash::make($request->pass_new);
         $users->save();

     return redirect('/doctor/update_profile');
 }

 public function update_profile(Request $request){
        $title_tag = "Cập nhật hồ sơ bác sĩ";

        $city = City::orderby('matp','ASC')->get();
         return view('Doctor.update_profile')
         ->with('title_tag', $title_tag)
         ->with('city',$city);
  }


  public function save_update_profile(Request $request){

         $users = User::find(Auth::user()->id);
         $users->name = $request->first_name ." ". $request->last_name;
         $users->save();


         $doctor = infor_doctor::find(Auth::user()->doctor->id);
         $doctor->firt_name = $request->first_name;
         $doctor->last_name = $request->last_name;
         $doctor->number_phone = $request->phone;
    
        if($request->hasFile('file')){
           $get_image = $request->file('file');
            $get_name_image = rand(0,99). '_' .$get_image->getClientOriginalName();

            if (!is_dir(public_path('Image/avt_user/'.$users->id))) {
                 mkdir(public_path('Image/avt_user/'.$users->id));
            }
            $path = public_path('Image/avt_user/'.$users->id.'/'.$get_name_image);
            Image::make($get_image->getRealPath())->fit(500, 500)->save($path);
           $doctor->avt_user = $get_name_image;

         }

         $doctor->address = $request->address_user;
         $doctor->details_address = $request->details_address;
         $doctor->birth_day = $request->date;
         $doctor->sex = $request->sex;
         $doctor->work_experience = $request->work_experience;
         $doctor->about_me = $request->about_me;

         $doctor->save();

         return redirect('doctor');
  }

}
