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
use Mail;


class AccountController extends Controller
{

   public function pageBlock(){
    return view('PageBlock');
  }

    public function index(){

      /////////////////////////////////////////////
    // $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    // $sta = new statistical();
    // $sta->id_user = 0;
    // $sta->id_doctor = 0;
    // $sta->id_schedule = 0;
    // $sta->stype = 1;
    // $sta->key_stype = "access_time_admin";
    // $sta->date =  $now;
    // $sta->save();
  /////////////////////////////////////////////////////
    return view('index');
  }

  public function PageRegister_doctor(){

      /////////////////////////////////////////////
    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        $city = City::orderby('matp','ASC')->get();

         return view('Account.PageRegister_Doctor')
         ->with('city',$city);
  }

  public function PageRegister_user(){
        $city = City::orderby('matp','ASC')->get();

         return view('Account.PageRegister_User')
         ->with('city',$city);
  }

  public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        return redirect('/Login-Page');
  }
   public function logoutadmin(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        return redirect('/admin');
  }
 


 public function save_login_page(Request $request){

       $data = $request->validate(
            [
                'email' => 'required|email|max:255',
                'password' => 'required|min:6'
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute độ dài tối đa :max',
                'email' => ':attribute dữ liệu nhập vào phải là email'
            ],
            [
                'email' => 'Email',
                'password' => 'Password'
            ]
        );

       $remember = false;
        if ($request->remembers) {
            $remember = true;
        }
        if(Auth::attempt($data, $remember)){

            if(Auth::user()->role_user == 1){
                 // Auth::logout();
                 // return redirect()->back()->withErrors(['msg' => 'Account No VerifyEmail.']);
                 return redirect('/admin'); 

            }else if(Auth::user()->role_user == 2){

                 if(Auth::user()->status == 1){

                     return redirect('/doctor'); 

                 }else if(Auth::user()->status == 11){

                     $city = City::orderby('matp','ASC')->get();
                     $infor = User::where("id", Auth::user()->id)->first();
                     $specialist = specialist_doctor::orderby('id','ASC')->get();
                     return view('Doctor.Contract.Contract_doctor')->with('infor',$infor)->with('city',$city)->with('specialistss',$specialist);
                 }else{
                     return view('Doctor.Contract.Awaiting_Approval');
                 }
  
            }else if(Auth::user()->role_user == 3){
                 if(Auth::user()->status == 0){
                    return redirect('/user');
                 }else{
                   return redirect('/user_block');
                 }

                 
            }
         
        }else{
            return redirect()->back()->with('message', 'Email hoặc mật khẩu sai. Vui lòng nhập lại');
        }

  }



  public function Check_email_unique(Request $request){
       
        $check = User::where("email", $request->email)->first();
        if($check){
          $output['key_check'] = 1;
          echo json_encode($output);
        }else{
          $output['key_check'] = 0;
          echo json_encode($output);
      }
  }




  public function save_register_user_patient(Request $request){

         $users = new User();
         $users->name = $request->first_name ." ". $request->last_name;
         $users->email = $request->email_address;
         $users->password = Hash::make($request->password_acc);
         $users->role_user = 3;
         $users->status = 0;

         // if($request->hasFile('file')){
         //    $get_image = $request->file('file');
         //    $get_name_image = rand(0,99). '_' .$get_image->getClientOriginalName();

         //    if (!is_dir(public_path('Image/avt_user/'.$users->id))) {
         //         mkdir(public_path('Image/avt_user/'.$users->id));
         //    }
         //    $path = public_path('Image/avt_user/'.$users->id.'/'.$get_name_image);
         //    Image::make($get_image->getRealPath())->fit(300, 300)->save($path);
         //     $users->avt_user = $get_name_image;
         // }else{

         //  $users->avt_user = 0;
         // }
 
         $users->save();


         $patient = new infor_patient();
         $patient->id_user = $users->id;
         $patient->firt_name = $request->first_name;
         $patient->last_name = $request->last_name;
         $patient->number_phone = $request->phone_acc;
         $patient->avt_user = 0;

         $patient->address = $request->address;
         $patient->details_address = $request->details_address;
         $patient->birth_day = $request->birth_day;
         $patient->sex = $request->sex_user;
         $patient->age = $request->age_user;
         $patient->height = $request->height;
         $patient->weight = $request->weight;
         $patient->blood_group = $request->blood_group;
         $patient->about_me = $request->about_me;

         $patient->save();     
  }


  public function save_register_user_doctor(Request $request){

         $users = new User();
         $users->name = $request->first_name ." ". $request->last_name;
         $users->email = $request->email_address;
         $users->password = Hash::make($request->password_acc);
         $users->role_user = 2;
         $users->status = 0;

         $users->save();


         $doctor = new infor_doctor();
         $doctor->id_user = $users->id;
         $doctor->firt_name = $request->first_name;
         $doctor->last_name = $request->last_name;
         $doctor->number_phone = $request->phone_acc;
         $doctor->avt_user = 0;

         $doctor->address = $request->address;
         $doctor->details_address = $request->details_address;
         $doctor->birth_day = $request->birth_day;
         $doctor->sex = $request->sex_user;

         $doctor->work_experience = $request->work_experience;
         $doctor->about_me = $request->about_me;


         if($request->hasFile('file_imageInput')){

            $get_image = $request->file('file_imageInput');
            $get_name_image = rand(0,99). '_' .$get_image->getClientOriginalName();

            if (!is_dir(public_path('Image/avt_user/'.$users->id))) {
                 mkdir(public_path('Image/avt_user/'.$users->id));
            }
            $path = public_path('Image/avt_user/'.$users->id.'/'.$get_name_image);
            Image::make($get_image->getRealPath())->fit(500, 500)->save($path);
            $doctor->avt_user = $get_name_image;
         }else{

            $doctor->avt_user = 0;
         }



          $get_image1 = $request->file('file_inputGroupFile04');
          $get_name_image1 = rand(0,99). '_' .$get_image1->getClientOriginalName();

          if (!is_dir(public_path('Image/file_user/'.$users->id))) {
               mkdir(public_path('Image/file_user/'.$users->id));
          }
          $path1 = public_path('Image/file_user/'.$users->id);
          $get_image1->move( $path1, $get_name_image1);
          $doctor->file_physician = $get_name_image1;


 
          $get_image2 = $request->file('file_imageInput1');
          $get_name_image2 = rand(0,99). '_' .$get_image2->getClientOriginalName();
          if (!is_dir(public_path('Image/file_user/'.$users->id))) {
               mkdir(public_path('Image/file_user/'.$users->id));
          }
          $path2 = public_path('Image/file_user/'.$users->id.'/'.$get_name_image2);
          Image::make($get_image2->getRealPath())->fit(200, 100)->save($path2);
          $doctor->front_cccd = $get_name_image2;


          $get_image3 = $request->file('file_imageInput2');
          $get_name_image3 = rand(0,99). '_' .$get_image3->getClientOriginalName();
          if (!is_dir(public_path('Image/file_user/'.$users->id))) {
               mkdir(public_path('Image/file_user/'.$users->id));
          }
          $path3 = public_path('Image/file_user/'.$users->id.'/'.$get_name_image3);
          Image::make($get_image3->getRealPath())->fit(200, 100)->save($path3);
          $doctor->backside_cccd = $get_name_image3;


          $doctor->save(); 
     
   
  }




   public function select_delivery_home(Request $request){
      $data = $request->all();
      if($data['action']){
        $output = '';
        // dd($data['ma_id']);
        if($data['action']=="city"){
          $select_province = Province::select('maqh','name','type', 'matp')
         ->where('matp', $data['ma_id'])->orderby('maqh','ASC')->get();
          $output.='<option value="0">---Chọn quận huyện---</option>';
          foreach($select_province as $key => $province){
            $output.='<option class="Province_op" value="'.$province->maqh.'">'.$province->name.'</option>';
          }

        }else{
          $select_wards = Wards::select('xaid','name','type', 'maqh')
         ->where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
          $output.='<option value="0" >---Chọn xã phường---</option>';
          foreach($select_wards as $key => $ward){
            $output.='<option class="Wards_op" value="'.$ward->xaid.'">'.$ward->name.'</option>';
          }
        }
        echo $output;
      }

    }

}
