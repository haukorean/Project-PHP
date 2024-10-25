<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\City;

use App\Models\infor_doctor;
use App\Models\company_doctor;
use App\Models\User;
use App\Models\schedule;
use App\Models\specialist_doctor;

class User_SpecialistDoctor extends Controller
{
   public function specialistDT_user($status){

    $city = City::orderby('matp','ASC')->get();
    if($status == "all"){
     $title_tag = "Tất cả bác sĩ chuyên khoa";
     $status = $status;
     $doctor = User::where("role_user", 2)->where("status", 1)->get();
    }else{

	     $all_doctor = User::where("role_user", 2)->where("status", 1)->get();
	     $data=[];
	     foreach($all_doctor as $dtor){
  	     	if($dtor->company->specialist->id == $status){
  	          $data[] = $dtor->id;
  	     	}
	     }
	    $doctor = User::where("id", $data)->get();
      $spe = specialist_doctor::find($status);
      $title_tag = "Chuyên khoa => ".$spe->specialist;
      $status = $status;
    }

    $specialist_doctor = specialist_doctor::all();

     return view('User.specicalistDoctor_user')
     ->with('city', $city)
     ->with('specialist_doctor', $specialist_doctor)
     ->with('doctor', $doctor)
     ->with('title_tag', $title_tag)
     ->with('status', $status);
  }





  public function load_doctor_city(Request $request){
      $all_doctor = User::where("role_user", 2)->where("status", 1)
      ->join('infor_doctor', 'users.id', '=', 'infor_doctor.id_user')
      ->select('users.*', 'infor_doctor.address')->where('infor_doctor.address', 'LIKE', '%'.$request->text.'%')->get();
      $output ='';
        if($all_doctor->count()>0){      
           if($request->status == "all"){  
				        $doctor = $all_doctor;
           }else{
              $data=[];
  			       foreach($all_doctor as $dtor){
  			        if($dtor->company->specialist->id == $request->status){
  			          $data[] = $dtor->id;
  			      }
  				}
				  $doctor = User::where("id", $data)->get();

             }
		     foreach($doctor as $key => $vid){	      
	                $output.='
	                   <div class="col-lg-12 mt-1">
			                   <div class="card-container card border-info border">  
			                    <div class="row p-1">
                                  <div class="col-md-4">
	                                   <img src="'.url('/Image/avt_user/'.$vid->id.'/'.$vid->doctor->avt_user).'" alt="user-image" 
	                                     class="card-img" >
                                  </div>
			                      <div class="col-md-8">
				                        <h4 class="user-select-none text-wrap text-info  mt-1">'.$vid->name.'</h4>
				                        <p class="user-select-none text-wrap">'.$vid->company->specialist->specialist.'</p>
				                        <span class="fw-bold">'.$vid->company->company_name.'</span><br>
                                        <span class="text-primary"><i class="dripicons-location"></i> '.$vid->company->company_address.'</span>

                                        <hr>
						                <h5 class="header-title pt-2">Giá Khám (Mặt định): 
		                                <span>'.$vid->company->price.'.VND</span></h5>
		                              
				                        <a href="'.url('/user/details_doctor/'.$vid->id).'" class="btn btn-primary float-end float-bottom me-3">Đặt lịch</a>
			                      </div>

			                    </div> 
			                   </div>
			      

			            </div>
	                                                 
	                ';
	            }
  
        }else{ 
            $output.='
              
                 <h4 class="text-center mt-3">Không tồn tại !</h4>
              ';

        }
  
        echo $output;
      }
}
