<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\Models\infor_patient;
use App\Models\infor_doctor;
use App\Models\User;

class Admin_User_Controller extends Controller
{
   public function List_user_admin(){
    $title_tag = "Quản lý người dùng";
    $all_dt = User::where("role_user", 2)->where("status", 0)->get();
    return view('Admin.List_User')
    ->with('title_tag', $title_tag)
    ->with('all_dt', $all_dt);
   }

   public function accept_or_refuse_user(Request $request){

   	if($request->status == -1){
   		 $users = User::find($request->id);
         $users->delete();

   	}else{
      
   	    User::where("id", $request->id)->update(['status' => $request->status]);
   	}
    
   }

    public function Load_list_user(Request $request){
    	if($request->status == 0){
         $all_us = User::where("role_user", 3)->where("status", 0)->get();
    	}else{
         $all_us = User::where("role_user", 3)->where("status", 1)->get();
    	}
        $output ='';
              if($all_us->count()>0){
                    foreach($all_us as $key => $vid){
                        $output.='<tr>
                        <td class="table-user">';

                         if($vid->patient->avt_user != 0){
                          $output.='<img  src="'.url('/Image/avt_user/'.$vid->id.'/'.$vid->patient->avt_user.'').'" alt="user-image" 
                                      class="me-2 rounded-circle" >';
                         }else{
                          $output.='<img  src="'.url('/Image/avt_user.png').'" alt="user-image" 
                                      class="me-2 rounded-circle" >';
                         }
   
                            $output.='
                                 </td>
                                <td>'.$vid->patient->number_phone.'</td>
                                <td>'.$vid->email.'</td>
                                <td>'.$vid->created_at.'</td>
                                <td>
                                <button type="button" class="btn btn-danger btn-sm"
                                 data-bs-toggle="modal" onclick="view_infor_user('.$vid->id.')" data-bs-target="#info-header-modal">Xem</button></td>
                            </tr>                       

                        ';
                    }
                    }else{ 
                    $output.='
                              <tr>
                                   <td colspan="4">No item</td>
                                               
                              </tr>


                        ';

                }

         echo $output;
   }




   public function search_list_user(Request $request){
    	if($request->status == 0){
         $all_us = User::where("role_user", 3)->where("status", 0)->where('name', 'LIKE', '%'.$request->value.'%')->get();
    	}else{
         $all_us = User::where("role_user", 3)->where("status", 1)->where('name', 'LIKE', '%'.$request->value.'%')->get();
    	}
        $output ='';
              if($all_us->count()>0){
                    foreach($all_us as $key => $vid){
   
                            $output.='     
                             <tr>
                                <td class="table-user">
                                     <img  src="'.url('/Image/avt_user/'.$vid->id.'/'.$vid->patient->avt_user.'').'" alt="user-image" 
                                      class="me-2 rounded-circle" >
                                      <a href="" class="text-body fw-semibold">'.$vid->name.'</a> 
                                 </td>
                                <td>'.$vid->patient->number_phone.'</td>
                                <td>'.$vid->email.'</td>
                                <td>'.$vid->created_at.'</td>
                                <td>
                                <button type="button" class="btn btn-danger btn-sm"
                                 data-bs-toggle="modal" onclick="view_infor_user('.$vid->id.')" data-bs-target="#info-header-modal">Xem</button></td>
                            </tr>                       

                        ';
                    }
               }else{ 

                    $output.='
                              <tr>
                                   <td colspan="4">No item</td>
                                               
                              </tr>


                        ';

                }

         echo $output;
   }

   public function view_infor_user(Request $request){

        $id = $request->id;
        $user = User::find($id);

       if($user->patient->avt_user != 0){
          $output['image_user'] = '<img alt="image" src="'.url('/Image/avt_user/'.$user->id.'/'.$user->patient->avt_user).'"
          class="img-fluid avatar-md rounded-circle"/>';
         }else{
         $output['image_user'] = '<img alt="image" src="'.url('/Image/avt_user.png').'"
          class="img-fluid avatar-md rounded-circle"/>';
         }
        

	        $output['nickname'] = $user->name;
	        $output['email_user'] = $user->email;
	        $output['phone_user'] = $user->patient->number_phone;


	        $output['birthday'] = $user->patient->birth_day;
	        $output['sex'] = $user->patient->sex;
	        $output['address'] = $user->patient->details_address.', '.$user->patient->address;
	        $output['blood'] = $user->patient->blood_group;
	        $output['about_me'] = $user->patient->about_me;
	        $output['height'] = $user->patient->height;
	        $output['weight'] = $user->patient->weight;

	    

	     

      
        echo json_encode($output);     

   }
}
