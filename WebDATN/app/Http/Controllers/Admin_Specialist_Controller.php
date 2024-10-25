<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\specialist_doctor;
use App\Models\service_medical;

class Admin_Specialist_Controller extends Controller
{
   public function List_Specialist_admin(){
   $title_tag = "Quản lý chuyên khoa";
	 return view('Admin.List_Specialist')->with('title_tag', $title_tag);
   }

	public function add_or_save_Specialist(Request $request){

	 $data = array(); 
	 $data = $request->all();
     if($request->status == 0){
	     $spe = new specialist_doctor();

		 $spe->specialist = $data['name_Specialist'];
		 $spe->describe = $data['desc_Specialist'];


	      $get_image = $request->file('file');

		  $get_name_image = rand(0,99). '_' .$get_image->getClientOriginalName();
		  $path = public_path('Image/specialist/'.$get_name_image);
		  Image::make($get_image->getRealPath())->fit(600, 500)->save($path);

		  $spe->image = $get_name_image;
		  $spe->save();

     }else{

	     $spe = specialist_doctor::find($request->id_save);
		 $spe->specialist = $data['name_Specialist'];
		 $spe->describe = $data['desc_Specialist'];
         

	      $get_image = $request->file('file');
	      if($get_image != null){
	      	  $get_name_image = rand(0,99). '_' .$get_image->getClientOriginalName();
			  $path = public_path('Image/specialist/'.$get_name_image);
			  Image::make($get_image->getRealPath())->fit(600, 500)->save($path);

			  $spe->image = $get_name_image;
	      }
		
		  $spe->save();
     }

	
      

	} 

	 public function load_specialist(Request $request){
      $load_spe= specialist_doctor::orderBy('id','DESC')->get();
      $load_spe_count = $load_spe->count();
      $output ='';
        if($load_spe_count>0){
            $i = 0;
            foreach($load_spe as $key => $vid){
                $i++;
                $output.='

                     <tr id="item">
                       <td>'.$i.'</td>
                        <td id="name">'.$vid->specialist.'</td>

                        <td id="des">'.$vid->describe.'</td>

                        <td>
                        <img src="'.url('/Image/specialist/'.$vid->image).'" class="img-thumbnail" width="80" height="80">
                        <input type="hidden" value="'.url('/Image/specialist/'.$vid->image).'" class="img-thumbnail image">
                        </td>

                       
                       <td>
                       <button type="button" data-is_spe="'.$vid->id.'" data-bs-toggle="modal" data-bs-target="#centermodal" 
                        class="btn btn-xs btn-danger btn-edit-specialist">Edit</button>
                
                       </td>
                     </tr>                                   
                ';
            }
        }else{ 
            $output.='
              <tr>
                 <td colspan="4">No Item</td>
              </tr> ';

        }
  
        echo $output;
      }


/////////////////////// service medical ////////////////////////////////////////////////////////////


 public function List_service_admin(){
   $title_tag = "Quản lý danh mục dịch vụ";
   return view('Admin.List_Service_medical')->with('title_tag', $title_tag);
   }

  public function add_or_save_service(Request $request){

   $data = array(); 
   $data = $request->all();
     if($request->status == 0){
      $spe = new service_medical();
     $spe->name = $data['name_service'];
     $spe->describe = $data['desc_service'];
     $spe->image = 0;
     $spe->save();

     }else{

       $spe = service_medical::find($request->id_save);
       $spe->name = $data['name_service'];
       $spe->describe = $data['desc_service'];
       $spe->image = 0;
       $spe->save();

     }

  
    
  } 

   public function load_service(Request $request){
      $load_spe= service_medical::orderBy('id','DESC')->get();
      $load_spe_count = $load_spe->count();
      $output ='';
        if($load_spe_count>0){
            $i = 0;
            foreach($load_spe as $key => $vid){
                $i++;
                $output.='

                     <tr id="item">
                       <td>'.$i.'</td>
                        <td id="name">'.$vid->name.'</td>

                        <td id="des">'.$vid->describe.'</td>

                  

                       
                       <td>
                       <button type="button" data-is_spe="'.$vid->id.'" data-bs-toggle="modal" data-bs-target="#centermodal" 
                        class="btn btn-xs btn-info btn-edit-service">Edit</button>

                        <button type="button" data-is_spe="'.$vid->id.'"
                        class="btn btn-xs btn-danger btn-remove-service">Xóa</button>
                
                       </td>
                     </tr>                                   
                ';
            }
        }else{ 
            $output.='
              <tr>
                 <td colspan="4">No Item</td>
              </tr> ';

        }
  
        echo $output;
      }
  public function remove_service(Request $request){
       $spe = service_medical::find($request->id);
       $spe->delete();
    
  } 



}
