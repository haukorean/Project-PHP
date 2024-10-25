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
use App\Models\company_doctor;
use App\Models\User;
use App\Models\schedule;
use App\Models\date_mange;
use App\Models\time_manage;
class Doctor_Clinic extends Controller
{
   public function clinic_doctor(Request $request){
       $title_tag = "Phòng khám y tế";

        $city = City::orderby('matp','ASC')->get();
         return view('Doctor.clinic_doctor')
         ->with('title_tag', $title_tag)
         ->with('city',$city);
  }

  public function save_update_company(Request $request){

         $com = company_doctor::find(Auth::user()->company->id);
         $com->company_name = $request->name;
         $com->company_phone = $request->phone;
         $com->company_email = $request->email;
         $com->company_address = $request->address_company;
         $com->about_us = $request->about_us;
         $com->status = $request->checkbox_status;
         $com->save();

         return redirect('/doctor/clinic_doctor');
  }


   public function load_date_setting(){

   	$all_rank = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");

     $all_date_setting = date_mange::select('rank')->where('id_doctor', Auth::user()->id)->get();

     if($all_date_setting->count() > 0){
	     $output ='';
	    foreach($all_rank as $rank){
	     $date_setting = date_mange::select('rank')->where('id_doctor', Auth::user()->id)
	     ->where('rank', $rank)->get()->count();

	        if($date_setting > 0){
             $output.='<tr><td>'.$rank.'</td>
			         <td>
		                <div>
		                    <input class="checkbox_date" type="checkbox" id="'.$rank.'" data-switch="success" value="'.$rank.'"/>
		                    <label for="'.$rank.'" data-on-label="On" data-off-label="Off" class="mb-0 d-block"></label>
		                </div>
			         </td></tr>';
	        }else{

	        	$output.='<tr><td>'.$rank.'</td>
			         <td>
		                <div>
		                    <input class="checkbox_date" type="checkbox" id="'.$rank.'" checked data-switch="success" value="'.$rank.'"/>
		                    <label for="'.$rank.'" data-on-label="On" data-off-label="Off" class="mb-0 d-block"></label>
		                </div>
			         </td></tr>';

	        }
       	   
	     
	  }
 

     }else{
	     $output ='';
	     foreach($all_rank as $rank){
       	  $output.='<tr><td>'.$rank.'</td>
			         <td>
		                <div>
		                    <input class="checkbox_date"  type="checkbox" id="'.$rank.'" checked data-switch="success" value="'.$rank.'"/>
		                    <label for="'.$rank.'" data-on-label="On" data-off-label="Off" class="mb-0 d-block"></label>
		                </div>
			         </td></tr>';
	     }

     }
   

     echo $output;
 }
  public function update_day_setting(Request $request){
   	if($request->n == 0) {
       date_mange::where('id_doctor', Auth::user()->id)->where('rank', $request->valu)->delete();
   	}else{
   		 $date = new date_mange();
   		 $date->id_doctor = Auth::user()->id;
         $date->rank = $request->valu;
         $thuAb = substr($request->valu, 0, 3);
         $date->date = $thuAb;
         $date->save();
   	}

  }



  public function load_time_setting(){

   	$all_times = array("07:30 : 08:00", "08:00 : 08:30", "08:30 : 09:00", "09:00 : 09:30", 
	                   "09:30 : 10:00", "10:00 : 10:30", "10:30 : 11:00", "11:00 : 11:30",
	                   "13:30 : 14:00", "14:00 : 14:30", "14:30 : 15:00", "15:00 : 15:30",
	                   "15:30 : 16:00", "16:00 : 16:30", "16:30 : 17:00");
  
     $all_time_setting = time_manage::select('time')->where('id_doctor', Auth::user()->id)->get();

     if($all_time_setting->count() > 0){
	     $output ='';
	     $i=0;
	    foreach($all_times as $time){
	    	$i++;
	     $date_setting = time_manage::select('time')->where('id_doctor', Auth::user()->id)
	     ->where('time', $time)->get()->count();

	        if($date_setting > 0){
            $output.=' <span class="btn btn-dark"> 
                       	<p class="text-white font-19 mt-1"><strong>'.$time.'</strong>  
     					 <span class="float-end ms-2">
		                    <input type="checkbox" class="checkbox_time" id="'.$i.'" data-switch="success" value="'.$time.'"/>
		                    <label for="'.$i.'" data-on-label="On" data-off-label="Off" class="mb-0 d-block"></label>
		                 </span>
		     			 </p>
		     			</span>';
	        }else{

       	    $output.=' <span class="btn btn-dark"> 
                       	<p class="text-white font-19 mt-1"><strong>'.$time.'</strong>  
     					 <span class="float-end ms-2">
		                    <input type="checkbox" class="checkbox_time" id="'.$i.'" checked data-switch="success" value="'.$time.'"/>
		                    <label for="'.$i.'" data-on-label="On" data-off-label="Off" class="mb-0 d-block"></label>
		                 </span>
		     			 </p>
		     			</span>';

	        }
       	   
	     
	  }
 

     }else{
	     $output ='';
	     $i=0;
	     foreach($all_times as $time){
	     	$i++;
       	    $output.=' <span class="btn btn-dark"> 
                       	<p class="text-white font-19 mt-1"><strong>'.$time.'</strong>  
     					 <span class="float-end ms-2">
		                    <input type="checkbox" class="checkbox_time" id="'.$i.'" checked data-switch="success" value="'.$time.'"/>
		                    <label for="'.$i.'" data-on-label="On" data-off-label="Off" class="mb-0 d-block"></label>
		                 </span>
		     			 </p>
		     			</span>';
	     }

     }
     echo $output;
 }


  public function update_time_setting(Request $request){
   	if($request->n == 0) {
        time_manage::where('id_doctor', Auth::user()->id)->where('time', $request->valu)->delete();
   	}else{
   		 $time = new time_manage();
   		 $time->id_doctor = Auth::user()->id;
         $time->time = $request->valu;
         $time->save();
   	}

  }


}
