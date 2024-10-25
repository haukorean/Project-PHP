<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\UserBookingController;
use App\Http\Controllers\User_Schedule;
use App\Http\Controllers\User_Handbook;
use App\Http\Controllers\User_ServiceMedical;
use App\Http\Controllers\User_SpecialistDoctor;
use App\Http\Controllers\User_History;

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\Doctor_Schedule;
use App\Http\Controllers\Doctor_Handbook;
use App\Http\Controllers\Doctor_Service;
use App\Http\Controllers\Doctor_History;
use App\Http\Controllers\Doctor_Clinic;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin_Dotor_Controller;
use App\Http\Controllers\Admin_User_Controller;
use App\Http\Controllers\Admin_Specialist_Controller;
use App\Http\Controllers\Admin_Handbook;

use Illuminate\Support\Facades\File;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/

Route::get('/chatbot', function () {
    $jsonData = File::get(public_path('python/data.json'));
    $data = json_decode($jsonData, true);

    // dd($data);

    return view('chatbot', ['data' => $data]);
});

///////////////////////////// ckeditor /////////////////////////
Route::post('/uploads_ckeditor',[UserController::class, 'uploads_ckeditor']);
Route::get('/file_browser',[UserController::class, 'file_browser']);


Route::get('/',[AccountController::class, 'index']);
///////////////////////////  Login and register ///////////////////////////
Route::get('/LoginAdmin', function () {  return view('Account.PageLogin_Admin');});

Route::get('/Login-Page', function () {  return view('Account.PageLogin_User');});

Route::post('/save_login_page',[AccountController::class, 'save_login_page']);
Route::get('/logout',[AccountController::class, 'logout']);
Route::get('/logout-admin',[AccountController::class, 'logoutadmin']);

Route::get('/Check_email_unique',[AccountController::class, 'Check_email_unique']);

Route::get('/Register-doctor',[AccountController::class, 'PageRegister_doctor']);
Route::get('/Register-user',[AccountController::class, 'PageRegister_user']);

Route::post('/save_register_user_patient',[AccountController::class, 'save_register_user_patient']);
Route::post('/save_register_user_doctor',[AccountController::class, 'save_register_user_doctor']);


Route::post('/select-delivery-home',[AccountController::class, 'select_delivery_home']);

Route::get('/user_block', [AccountController::class, 'pageBlock']);


///////////////////////// User  //////////////////////////////////



Route::group(['middleware' => 'authLoginUser'], function() {

   Route::get('/user', [UserController::class, 'index']);

   Route::get('/user/chatbot-al', [UserController::class, 'chatbot']);

   Route::get('/user/search_doctor', [UserController::class, 'search_doctor']);
   
   Route::get('/user/load_notification_booking', [UserController::class, 'load_notification_booking']);
   Route::get('/user/delete_notification', [UserController::class, 'delete_notification']);

   Route::get('/user/reset_password', [UserController::class, 'reset_password']);
   Route::post('/user/save_reset_password', [UserController::class, 'save_reset_password']);
   Route::get('/user/update_profile', [UserController::class, 'update_profile']);
   Route::post('/user/save_update_profile', [UserController::class, 'save_update_profile']);

     ///////////////////////// Booking schedule ///////////////////////////

   Route::get('/user/details_doctor/{id_doctor}', [UserBookingController::class, 'details_doctor']);
   Route::get('/user/load_date', [UserBookingController::class, 'load_date']);
   Route::get('/user/load_time', [UserBookingController::class, 'load_time']);

   Route::post('/user/accept_booking', [UserBookingController::class, 'accept_booking']);

     ///////////////////////// Handbook  ///////////////////////////
    Route::get('/user/handbook_user', [User_Handbook::class, 'handbook_user']);
    Route::get('/user/details_handbook/{id}', [User_Handbook::class, 'details_handbook']);
    Route::get('/user/search_page_handbook', [User_Handbook::class, 'search_page_handbook']);
   
     ///////////////////////// Specialist ///////////////////////////
    Route::get('/user/specialistDT_user/{status}', [User_SpecialistDoctor::class, 'specialistDT_user']);
    Route::get('/user/load_doctor_city', [User_SpecialistDoctor::class, 'load_doctor_city']);


     ///////////////////////// Service medical ///////////////////////////
    Route::get('/user/service_medical_user/{status}', [User_ServiceMedical::class, 'service_medical_user']);

     ///////////////////////// Schedule ///////////////////////////

    Route::get('/user/schedule_user', [User_Schedule::class, 'schedule_user']);
    Route::get('/user/load_schedule_date', [User_Schedule::class, 'load_schedule_date']);
    Route::get('/user/view_schedule_user', [User_Schedule::class, 'view_schedule_user']);
    Route::get('/user/cancel_schedule', [User_Schedule::class, 'cancel_schedule']);

         ///////////////////////// History medical ///////////////////////////
    Route::get('/user/history_medical_doctor', [User_History::class, 'history_medical_doctor']);

    Route::get('/user/load_history_schedule', [User_History::class, 'load_history_schedule']);
    Route::get('/user/load_list_doctor', [User_History::class, 'load_list_doctor']);
    Route::get('/user/result_examination/{id_schedule}', [User_History::class, 'result_examination']);
    Route::get('/user/load_file_result_examination', [User_History::class, 'load_file_result_examination']);
   
  
});


//////////////////////////  Doctor  //////////////////////// 

Route::group(['middleware' => 'authLoginDoctor'], function() {

    Route::get('/doctor', [DoctorController::class, 'index']);

	
    Route::post('/doctor/load_static_chart', [DoctorController::class, 'load_static_chart']);
    Route::get('/doctor/load_count_schedule', [DoctorController::class, 'load_count_schedule']);
    Route::get('/doctor/load_notification_booking', [DoctorController::class, 'load_notification_booking']);
    Route::get('/doctor/delete_notification', [DoctorController::class, 'delete_notification']);

    Route::post('/doctor/Accept_doctor', [DoctorController::class, 'Accept_doctor']);
    Route::get('/doctor/update_profile', [DoctorController::class, 'update_profile']);
    Route::get('/doctor/reset_password', [DoctorController::class, 'reset_password']);
    Route::post('/doctor/save_reset_password', [DoctorController::class, 'save_reset_password']);
  
    Route::post('/doctor/save_update_profile', [DoctorController::class, 'save_update_profile']);


      ///////////////////////// Schedule ///////////////////////////

    Route::get('/doctor/schedule_doctor', [Doctor_Schedule::class, 'schedule_doctor']);
    Route::get('/doctor/load_schedule_date', [Doctor_Schedule::class, 'load_schedule_date']);
    Route::get('/doctor/view_schedule_doctor', [Doctor_Schedule::class, 'view_schedule_doctor']);

    Route::get('/doctor/cancel_schedule', [Doctor_Schedule::class, 'cancel_schedule']);
    Route::get('/doctor/start_medical_examination/{id_schedule}', [Doctor_Schedule::class, 'start_medical_examination']);

    Route::get('/doctor/load_date', [Doctor_Schedule::class, 'load_date']);
    Route::get('/doctor/load_time', [Doctor_Schedule::class, 'load_time']);

    Route::post('/doctor/upload_file_result', [Doctor_Schedule::class, 'upload_file_result']);
    Route::get('/doctor/load_file_result', [Doctor_Schedule::class, 'load_file_result']);
    Route::get('/doctor/remove_item_file', [Doctor_Schedule::class, 'remove_item_file']);
    Route::post('/doctor/save_result_examnination', [Doctor_Schedule::class, 'save_result_examnination']);  

      ////////////////////////// handboook /////////////////////////
    Route::get('/doctor/handbook_doctor', [Doctor_Handbook::class, 'handbook_doctor']);
    Route::get('/doctor/details_handbook/{id}', [Doctor_Handbook::class, 'details_handbook']);
    Route::get('/doctor/search_page_handbook', [Doctor_Handbook::class, 'search_page_handbook']);

    Route::get('/doctor/create_new_handbook', [Doctor_Handbook::class, 'create_new_handbook']);
    Route::post('/doctor/save_create_handbook', [Doctor_Handbook::class, 'save_create_handbook']);
    Route::get('/doctor/remove_post_doctor', [Doctor_Handbook::class, 'remove_post_doctor']);

    Route::get('/doctor/load_my_handbook', [Doctor_Handbook::class, 'load_my_handbook']);


      ///////////////////////// service ////////////////////////////
    Route::get('/doctor/service_doctor', [Doctor_Service::class, 'service_doctor']);
    Route::get('/doctor/load_service_doctor', [Doctor_Service::class, 'load_service_doctor']);
    Route::post('/doctor/save_create_orChange_service', [Doctor_Service::class, 'save_create_orChange_service']);
    Route::get('/doctor/remove_service_doctor', [Doctor_Service::class, 'remove_service_doctor']);


     ///////////////////////// History medical ///////////////////////////
    Route::get('/doctor/history_medical_doctor', [Doctor_History::class, 'history_medical_doctor']);

    Route::get('/doctor/load_history_schedule', [Doctor_History::class, 'load_history_schedule']);
    Route::get('/doctor/load_list_patient', [Doctor_History::class, 'load_list_patient']);
    Route::get('/doctor/result_examination/{id_schedule}', [Doctor_History::class, 'result_examination']);
    Route::get('/doctor/load_file_result_examination', [Doctor_History::class, 'load_file_result_examination']);
   

       ///////////////////////// Clinic ///////////////////////////

    Route::get('/doctor/clinic_doctor', [Doctor_Clinic::class, 'clinic_doctor']);
    Route::post('/doctor/save_update_company', [Doctor_Clinic::class, 'save_update_company']);

    Route::get('/doctor/load_date_setting', [Doctor_Clinic::class, 'load_date_setting']);
    Route::get('/doctor/update_day_setting', [Doctor_Clinic::class, 'update_day_setting']);

    Route::get('/doctor/load_time_setting', [Doctor_Clinic::class, 'load_time_setting']);
    Route::get('/doctor/update_time_setting', [Doctor_Clinic::class, 'update_time_setting']);

});





////////////////////////////// Admin /////////////////////////////////////

Route::group(['middleware' => 'authLoginAdmin'], function() {

  Route::get('/admin',[AdminController::class, 'index']);
  Route::get('/admin/view_dataset_chatbot', [AdminController::class, 'view_dataset_chatbot']);


  Route::get('/admin/LoadDataSet', [AdminController::class, 'LoadDataSet']);
  Route::get('/admin/LoadDataSetCH', [AdminController::class, 'LoadDataSetCH']);

  Route::post('/admin/Add_Or_Update_Data1', [AdminController::class, 'Add_Or_Update_Data1']);
  Route::post('/admin/Add_Or_Update_Data2', [AdminController::class, 'Add_Or_Update_Data2']);
  Route::get('/admin/delete_row_dataset', [AdminController::class, 'delete_row_dataset']);


    ////////////////////////////// pecialist ///////////////////////////
	Route::get('/admin/list-specialist-admin',[Admin_Specialist_Controller::class, 'List_Specialist_admin']);
	Route::get('/admin/load_specialist',[Admin_Specialist_Controller::class, 'load_specialist']);
  Route::post('/admin/add_or_save_Specialist',[Admin_Specialist_Controller::class, 'add_or_save_Specialist']);

 ////////////////////////// service ///////////////////////////
  Route::get('/admin/list-service-admin',[Admin_Specialist_Controller::class, 'List_service_admin']);
	Route::get('/admin/load_service',[Admin_Specialist_Controller::class, 'load_service']);
  Route::post('/admin/add_or_save_service',[Admin_Specialist_Controller::class, 'add_or_save_service']);
  Route::get('/admin/remove_service',[Admin_Specialist_Controller::class, 'remove_service']);

 ///////////////////////// user ///////////////////////////////////////
	// Route::get('/admin/list-user-admin', function () {return view('Admin.List_User');});
  Route::get('/admin/list-user-admin',[Admin_User_Controller::class, 'List_user_admin']);
  Route::get('/admin/Load_list_user', [Admin_User_Controller::class, 'Load_list_user']);
  Route::get('/admin/view_infor_user', [Admin_User_Controller::class, 'view_infor_user']);

  Route::get('/admin/search_list_user', [Admin_User_Controller::class, 'search_list_user']);

  Route::get('/admin/accept_or_refuse_user', [Admin_User_Controller::class, 'accept_or_refuse_user']);

  /////////////////////////// doctor ////////////////////////////////////
	Route::get('/admin/list-doctor-admin',[Admin_Dotor_Controller::class, 'List_doctor_admin']);
	Route::get('/admin/Load_list_new_doctor', [Admin_Dotor_Controller::class, 'Load_list_new_doctor']);
	Route::get('/admin/view_infor_doctor', [Admin_Dotor_Controller::class, 'view_infor_doctor']);

  Route::get('/admin/search_list_doctor', [Admin_Dotor_Controller::class, 'search_list_doctor']);

	Route::get('/admin/accept_or_refuse_doctor', [Admin_Dotor_Controller::class, 'accept_or_refuse_doctor']);


  ///////////////////////// list-handbook-admin //////////////////////////////
  Route::get('/admin/list-handbook-admin', [Admin_Handbook::class, 'handbook_admin']);
  Route::get('/admin/load_all_handbook', [Admin_Handbook::class, 'load_all_handbook']);
  Route::get('/admin/approve_or_refuse_post_admin', [Admin_Handbook::class, 'approve_or_refuse_post_admin']);

  Route::get('/admin/create_new_handbook', [Admin_Handbook::class, 'create_new_handbook']);
  Route::post('/admin/save_create_handbook', [Admin_Handbook::class, 'save_create_handbook']);

  Route::get('/admin/remove_post_admin', [Admin_Handbook::class, 'remove_post_admin']);
  
  

});





