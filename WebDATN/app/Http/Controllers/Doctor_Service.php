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
use App\Models\service_medical;
use App\Models\service_doctor;


class Doctor_Service extends Controller
{
  public function service_doctor(){
     $title_tag = "Dịch vụ y tế";

     $all_ser = service_medical::all();
     return view('Doctor.service_doctor')->with('all_ser', $all_ser)->with('title_tag', $title_tag);
  }

  public function save_create_orChange_service(Request $request){

  	// dd($request->name_ser);
     if($request->status == 0){
	      $hand = new service_doctor();
	      $hand->id_service = $request->type_service;
	      $hand->id_company = Auth::user()->company->id;
	      $hand->name = $request->name_ser;
	      $hand->describe = $request->describe;
          $hand->price = $request->price;

	      if($request->hasFile('imageInput')){
	        $get_image = $request->imageInput;
	        $get_name_image = rand(0,99). '_' .$get_image->getClientOriginalName();

	        if (!is_dir(public_path('Image/Image_service/'.Auth::user()->id))) {
	             mkdir(public_path('Image/Image_service/'.Auth::user()->id));
	        }
	        $path = public_path('Image/Image_service/'.Auth::user()->id.'/'.$get_name_image);
	        Image::make($get_image->getRealPath())->fit(500, 500)->save($path);
	       $hand->image = $get_name_image;
	      }else{
	      	$hand->image = 0;
	      }
	      $hand->save();

     }else if($request->status == 1){

          $hand = service_doctor::find($request->id_ser);
          $hand->id_service = $request->type_service;
	      $hand->id_company = Auth::user()->company->id;
	      $hand->name = $request->name_ser;
	      $hand->describe = $request->describe;
	      $hand->price = $request->price;

	      if($request->hasFile('imageInput')){
	        $get_image = $request->imageInput;
	        $get_name_image = rand(0,99). '_' .$get_image->getClientOriginalName();

	        if (!is_dir(public_path('Image/Image_service/'.Auth::user()->id))) {
	             mkdir(public_path('Image/Image_service/'.Auth::user()->id));
	        }
	        $path = public_path('Image/Image_service/'.Auth::user()->id.'/'.$get_name_image);
	        Image::make($get_image->getRealPath())->fit(500, 500)->save($path);
	       $hand->image = $get_name_image;
	      }

	      $hand->save();

     }else{

     	  $com = company_doctor::find(Auth::user()->company->id);
	      $com->service = $request->describe;
	      $com->price = $request->price_update;
	      $com->save();
     }
     

  }
  public function load_service_doctor(Request $request){

   $service_doctor = service_doctor::where('id_company', Auth::user()->company->id)->orderby('id', 'DESC')->get();

     $output ='';

     if($service_doctor->count() > 0){
     	  $i=0;
          foreach($service_doctor as $ser){
          	$i++;
            $output.='<div class="card mb-0 boder-top"><hr>
                     <input type="hidden" class="id_ser" value="'.$ser->id.'">
                     <input type="hidden" class="price" value="'.$ser->price.'">
                     <input type="hidden" class="title" value="'.$ser->name.'">
                     <input type="hidden" class="des_ser" value="'.$ser->describe.'">
			        <div class="card-header " id="Four'.$i.'s">
			            <div class="row m-0">
			            	
			              <div class="col-md-2">
			            	    <img src="'.url('Image/Image_service/'.$ser->company->user->id.'/'.$ser->image).'" alt="image" class="img-fluid " height="60">
			               </div>
			            	<div class="col-md-6">
			            	   <h6 class="header-title d-block py-1 title">
			                    '.$ser->name.'
			                   </h6>
			                   <span> '.$ser->service_medical->name.'</span>
			               </div>
                           <div class="col-md-4">
			                 <h6 class="header-title mt-1 float-end"><span class="text-success">
				    	        '.$ser->price.' VND</span>
				    	    
				    	    </h6>
                         
				    	  
				    	   </div>
			            </div>
                          <hr>
			             <div class="row boder-top">
			                <a class="col-md-1 action-icon btn_update" data-bs-toggle="collapse" href="#seFour'.$i.'"  
			                aria-expanded="true" aria-controls="seFour'.$i.'"><i class="mdi mdi-arrow-down-drop-circle"></i></a>

                            <a class="col-md-1 action-icon btn_update" data-bs-toggle="modal" 
                            	 data-bs-target="#bs-example-modal-lg"> <i class="mdi mdi-pencil"></i></a>

                             <a class="col-md-1 action-icon btn_remove"> <i class="mdi mdi-delete"></i></a>
                         </div> 
			          
			        </div>
			            
			        <div id="seFour'.$i.'" class="collapse"
			            aria-labelledby="Four'.$i.'"
			            data-bs-parent="#custom-accordion-one">
			            <div class="card-body" >'.$ser->describe.' </div>
			        </div>

			         
			    </div>';          
          }
     }else{
          $output.='Không có dịch vụ y tế nào khác';
     }
   
     echo $output;
 }

 public function remove_service_doctor(Request $request){
      $ser = service_doctor::find($request->id);
      if($ser->image != 0 ){      
           unlink('Image/Image_service/'.$ser->company->user->id.'/'.$ser->image);  
        }
      $ser->delete();
  }



}
