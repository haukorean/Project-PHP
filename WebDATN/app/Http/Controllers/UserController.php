<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Session;

use App\City;
use App\Wards;
use App\Province;

use App\Models\infor_patient;
use App\Models\infor_doctor;
use App\Models\User;
use App\Models\specialist_doctor;
use App\Models\service_medical;
use App\Models\company_doctor;
use App\Models\handbook;
use App\Events\NotificationBooking;
use App\Models\notifications;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

use League\Csv\Reader;
use League\Csv\Writer;

class UserController extends Controller
{


public function chatbot(Request $request){
      $data  = $request->value;

      $pythonFilePath = public_path('/python/main.py');


      $process = new Process(['C:\Users\ADMIN\AppData\Local\Programs\Python\Python312\python.exe', $pythonFilePath, $data]);
      $process->run();


      if (!$process->isSuccessful()) {
        throw new ProcessFailedException($process);
      }

       $output_data = $process->getOutput();
    // Giải mã văn bản
       $decoded_text = base64_decode($output_data);

       if($decoded_text == "No"){
        $decoded_text=" Xin lỗi, Tôi không Xác định được thông tin bạn cung cấp, Vui lòng đến cơ sở y tế gần nhất để được tư vấn chính xác";
        $this->saveQuestion($data);
       }
       
       // dd($decoded_text);
      echo $decoded_text;
 }

 

  public function saveQuestion($CauHoi){
    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    $pythonFilePath = public_path('/python/DataCH.csv');

    $csv = Reader::createFromPath($pythonFilePath, 'r');
      $csv->setHeaderOffset(0);
      $records = $csv->getRecords();
      $lastRow = null;
      $lastRowId = 0;
       
      foreach ($records as $record) {
          $lastRow = $record;
       }
      if ($lastRow !== null) {
        $lastRowId = $lastRow['ID']; 
      }

  
      $data = [
          'ID' => $lastRowId + 1,
          'CauHoi' => $CauHoi,
          'Date' => $now,

      ];


    $writer = Writer::createFromPath($pythonFilePath, 'a+');
    $writer->insertOne($data);
      
     return "Thanh Cong";
  }



 public function search_doctor(Request $request){

   $resultSearch = User::join('company_doctor', 'company_doctor.id_user', 'users.id')
     ->select('users.*', 'company_doctor.company_name', 'company_doctor.id_specialist')
      ->where('users.name', 'LIKE', '%'.$request->vale_search.'%')
      ->orwhere('company_doctor.company_name', 'LIKE', '%'.$request->vale_search.'%')->limit(5)->get();

      if($resultSearch->count()>0){
          $output ='';      
       foreach($resultSearch as $key => $vid){        
           $chuyeKHoa = specialist_doctor::where('id', $vid->id_specialist)->first();
           $output.=' 
               <a href="'.url('/doctor/details_doctor/'.$vid->id).'" class="dropdown-item notify-item">
                    <div class="d-flex">
                        <img class="d-flex me-2 rounded-circle" src="'.asset('/Image/avt_user/'.$vid->id.'/'.$vid->doctor->avt_user).'" alt="Generic placeholder image" height="32">
                        <div class="w-100">
                            <h5 class="m-0 font-14">'.$vid->name.'</h5>
                            <span class="font-12 mb-0">'.$chuyeKHoa->specialist.'</span>
                        </div>
                    </div>
                </a>
                                                 
             ';
            }

      }else{ 
          $output.='<h4 class="text-center mt-3">Không tìm thấy !</h4>';

      }
  echo $output;
 }




  public function index(){
    $title_tag = "Trang chủ của người dùng";

    $service = service_medical::orderby('id','ASC')->get();
    $specialist = specialist_doctor::orderby('id','ASC')->get();
    $list_doctor = User::where('role_user', 2)->where('status', 1)->orderby('id','ASC')->get();
    $list_handbook = handbook::where('status', 1)->orderby('id','ASC')->get();
    
     return view('User.index')
     ->with('title_tag', $title_tag)
     ->with('service', $service)
     ->with('list_doctor', $list_doctor)
     ->with('list_handbook', $list_handbook)
     ->with('specialist', $specialist);
 }

 public function reset_password(){
    $title_tag = "Đặt lại mật khẩu";
     return view('User.reset_password')->with('title_tag', $title_tag);
 }

 public function save_reset_password(Request $request){
         $users = User::find(Auth::user()->id);
         $users->password = Hash::make($request->pass_new);
         $users->save();

     return redirect('/user/update_profile');
 }

  public function update_profile(Request $request){
        $title_tag = "Cập nhật hồ sơ người dùng";

        $city = City::orderby('matp','ASC')->get();
         return view('User.update_profile')
         ->with('title_tag', $title_tag)
         ->with('city',$city);
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
                   <a href="'.url('/user/history_medical_doctor').'" class="dropdown-item notify-item ">
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

  public function save_update_profile(Request $request){
         $users = User::find(Auth::user()->id);
         $users->name = $request->first_name ." ". $request->last_name;
         $users->save();


         $patient = infor_patient::find(Auth::user()->patient->id);
         $patient->firt_name = $request->first_name;
         $patient->last_name = $request->last_name;
         $patient->number_phone = $request->phone;
       
         if($request->hasFile('file')){
            $get_image = $request->file('file');
            $get_name_image = rand(0,99). '_' .$get_image->getClientOriginalName();

            if (!is_dir(public_path('Image/avt_user/'.$users->id))) {
                 mkdir(public_path('Image/avt_user/'.$users->id));
            }
            $path = public_path('Image/avt_user/'.$users->id.'/'.$get_name_image);
            Image::make($get_image->getRealPath())->fit(500, 500)->save($path);
           $patient->avt_user = $get_name_image;
         }

         $patient->address = $request->address_user;
         $patient->details_address = $request->details_address;
         $patient->birth_day = $request->date;
         $patient->sex = $request->sex;
         $patient->age = $request->age;
         $patient->height = $request->height;
         $patient->weight = $request->weight;
         $patient->blood_group = $request->blood_group;
         $patient->about_me = $request->about_me;

         $patient->save();

         return redirect('/user');
  }




    public function uploads_ckeditor(Request $request){
        if($request->hasFile('upload')) {

        $get_image= $request->file('upload');

        $get_name_image =rand(0,99). '_' .$get_image->getClientOriginalName();
        $path = public_path('uploads/ckeditor/'.$get_name_image);

        Image::make($get_image->getRealPath())->fit(400, 400)->save($path);

        $CKEditorFuncNum = $request->input('CKEditorFuncNum');
        $url = url('/uploads/ckeditor/'.$get_name_image); 
        $msg = 'Tải ảnh thành công'; 
        $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
        @header('Content-type: text/html; charset=utf-8'); 
        echo $response;

    }
}


   //     public function file_browser(Request $request){
   //      $paths = glob(public_path('uploads/ckeditor/*'));

   //      $fileNames = array();

   //      foreach($paths as $path){
   //          array_push($fileNames,basename($path));
   //      }
   //      $data = array(
   //          'fileNames' => $fileNames
   //      );
       
   //      return view('image.file_browser')->with($data);
   // }
   


}
