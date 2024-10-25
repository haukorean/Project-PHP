<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\infor_doctor;
use App\Models\company_doctor;
use App\Models\User;
use App\Models\handbook;

class User_Handbook extends Controller
{
  public function handbook_user(){
    $title_tag = "Cẩm nang Y tế của người dùng";
      $handbook = handbook::where('status', 1)->get();
     return view('User.handbook_user')->with('handbook', $handbook)->with('title_tag', $title_tag);
  }


   public function details_handbook($id){
     $handbook = handbook::find($id);
     $title_tag = $handbook->title;
     return view('User.details_handbook')->with('handbook', $handbook)->with('title_tag', $title_tag);
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
                 <a href="'.url('/user/details_handbook/'.$vid->id).'" >
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
              
                 <h4 class="text-center mt-3">Không có cẩm nang y tế!</h4>
              ';

        }
  
        echo $output;
  
  }
}
