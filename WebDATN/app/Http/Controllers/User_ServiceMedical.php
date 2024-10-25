<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\service_medical;
use App\Models\service_doctor;

class User_ServiceMedical extends Controller
{
 public function service_medical_user($status){

   if($status == "all"){
     $title_tag = "Tất cả dịch vụ y tế";
     $status = $status;
     $service = service_doctor::paginate(10);
    }else{
      $service = service_doctor::where("id_service", $status)->paginate(10);
      $service_me = service_medical::find($status);
      $title_tag = "Dịch vụ => ".$service_me->name;
      $status = $status;
    }

     $all_service_me = service_medical::all();
     return view('User.service_user')
     ->with('all_service_me', $all_service_me)
     ->with('service', $service)
     ->with('title_tag', $title_tag)
     ->with('status', $status);
  }
}
