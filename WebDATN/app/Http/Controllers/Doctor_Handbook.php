<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Models\infor_doctor;
use App\Models\company_doctor;
use App\Models\User;
use App\Models\handbook;

class Doctor_Handbook extends Controller
{
  public function handbook_doctor(){
     $title_tag = "handbook medical";
     $handbook = handbook::where('status', 1)->get();
     return view('Doctor.handbook_doctor')->with('handbook', $handbook)->with('title_tag', $title_tag);
  }

   public function details_handbook($id){
     $handbook = handbook::find($id);
     $title_tag = $handbook->title;
     return view('Doctor.details_handbook')->with('handbook', $handbook)->with('title_tag', $title_tag);
  }

   public function search_page_handbook(Request $request){
     $search_handbook= handbook::where("status", 1)
      ->where('title', 'LIKE', '%'.$request->value.'%')
      ->orwhere('content', 'LIKE', '%'.$request->value.'%')->get();
      $output ='';
        if($search_handbook->count()>0){      

         foreach($search_handbook as $key => $vid){        
             $output.='
               <div class="col-lg-3">
                 <a href="'.url('/doctor/details_handbook/'.$vid->id).'" >
                    <div class="card-container card border-info border">  
                      <div class="p-2">
                          <img src="'.asset('/Image/Image_handbook/'.$vid->id_doctor.'/'.$vid->image).'" class="card-img" alt="...">
                            <h4 class="truncate-text user-select-none text-wrap text-info text-start mt-2">'.$vid->title.'</h4>
                      </div> 
                     </div>
                  </a>

              </div>
                                                   
               ';
              }
  
        }else{ 
            $output.='
              
                 <h4 class="text-center mt-3">Không  có cẩm nang y tế nào !</h4>
              ';

        }
  
        echo $output;
  
  }

  public function create_new_handbook(){
     $title_tag = "Create new handbook medical";
     return view('Doctor.create_new_handbook')->with('title_tag', $title_tag);
  }

 public function remove_post_doctor(Request $request){
      $handbook = handbook::find($request->id);
      if($handbook->image !=null){      
           unlink('Image/Image_handbook/'.$handbook->id_doctor.'/'.$handbook->image);  
        }
      $handbook->delete();
  }


  public function save_create_handbook(Request $request){
      $currentDate = Carbon::now();
      $hand = new handbook();
      $hand->id_doctor = Auth::user()->id;
      $hand->title = $request->title;
      $hand->content = $request->describe;

      $hand->status = 0;
      $hand->date = $currentDate->format('d-m-Y');

      if($request->hasFile('imageInput')){
        $get_image = $request->imageInput;
        $get_name_image = rand(0,99). '_' .$get_image->getClientOriginalName();

        if (!is_dir(public_path('Image/Image_handbook/'.Auth::user()->id))) {
             mkdir(public_path('Image/Image_handbook/'.Auth::user()->id));
        }
        $path = public_path('Image/Image_handbook/'.Auth::user()->id.'/'.$get_name_image);
        Image::make($get_image->getRealPath())->resize(450, 250)->save($path);
       $hand->image = $get_name_image;
      }
      
      $hand->save();


	 return Redirect('/doctor/handbook_doctor');
  }

   public function load_my_handbook(Request $request){

   $handbook = handbook::where('id_doctor', Auth::user()->id)->get();

     $output ='';
     if($handbook->count() > 0){
          foreach($handbook as $hand){

          $output.=' <tr>
			            <td >
			               <img src="'.url('Image/Image_handbook/'.$hand->id_doctor.'/'.$hand->image).'" alt="table-user" class="me-2" height="200"/>		
			            </td>
			            <td>'.$hand->title.'</td>
			            <td>'.$hand->date.'</td>';

			            if($hand->status == 0){
                         $output.='<td><span class="badge badge-warning-lighten">Chờ phê duyệt</span></td>';
			            }else if($hand->status == 1){
                          $output.='<td><span class="badge badge-success-lighten">Thành công</span></td>';
			            }else{
                           $output.='<td><span class="badge badge-danger-lighten">Bài đăng không hợp lệ</span></td>';
			            }

			             $output.='
			            <td class="table-action text-center">
			                  <input type="hidden" class="idpost" value="'.$hand->id.'">
                        <input type="hidden" class="title" value="'.$hand->title.'">
                        <input type="hidden" class="date" value="'.$hand->date.'">
                        <input type="hidden" class="auth" value="'.$hand->user_auth->name.'">
                        <span class="content" style="display: none">'.$hand->content.'</span> 
                        <input type="hidden" class="status" value="'.$hand->status.'"> 


                    
                      <a class="action-icon btn_view_item" data-bs-toggle="modal"
                       data-bs-target="#bs-example-modal-lg"> <i class="mdi mdi-eye"></i></a>

                       <a class="action-icon btn_remove_item"> <i class="mdi mdi-delete"></i></a>
                   </td>
			        </tr>';          
          }
     }else{
          $output.='<h4 class="text-center mt-3">Không  có cẩm nang y tế nào !</h4>';
     }
   
     echo $output;
 }


  
}
