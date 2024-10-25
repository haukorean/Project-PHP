<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\schedule;
use App\Models\results_examination;
use App\Models\company_doctor;
use App\Models\statistical;
use App\Models\specialist_doctor;
use App\Models\notifications;
use League\Csv\Reader;
use League\Csv\Writer;

class AdminController extends Controller
{
     public function index(){
     	$title_tag = "Thống kê";

     	$schedule = schedule::get()->count();
     	$User = User::get()->count();
     	$company_doctor = company_doctor::get()->count();
     	$truycap = statistical::where('stype', 1)->get()->count();
     	
	    return view('Admin.index')
	    ->with('schedule',$schedule)
	    ->with('User',$User)
	    ->with('company_doctor',$company_doctor)
	    ->with('truycap',$truycap)
	    ->with('title_tag', $title_tag);


	 }


	public function view_dataset_chatbot(){
       $title_tag = "Dữ liệu ChatBot";
	   $specialistss= specialist_doctor::orderBy('id','DESC')->get();
        // $data = $this->readcsv();
       // dd($data);
       return view('Admin.Manage_DataSet')  
       ->with('title_tag', $title_tag)
       // ->with('data', $data)
       ->with('specialistss', $specialistss);

	 }



	public function LoadDataSet(Request $request){

	   $pythonFilePath = public_path('/python/DatasetDT.csv');
		$csv = Reader::createFromPath($pythonFilePath, 'r');
	    $csv->setHeaderOffset(0); // Đặt vị trí của header (tiêu đề), ví dụ: dòng đầu tiên
	    
	    $records = $csv->getRecords(); // Lấy tất cả các bản ghi
	    
	    $collection = collect($records);
	    $reversed = $collection->reverse();

	    $output='';
	    if($request->status == 1){
		     foreach($reversed as $record){
	          if($record['ChuyenKhoa'] == "TuVan"){
	             $output.=' 
	                <tr id="item">
	                     	<td class="ID">'.$record['ID'].'</td>
	                        <td class="TrieuChung">'.$record['TrieuChung'].'</td>
	                        <td class="LoiKhuyen">'.$record['LoiKhuyen'].'</td>

	                        <td>
	                         <button type="button" data-bs-toggle="modal" data-bs-target="#centermodal1" 
	                         class="btn btn-xs btn-info btn-edit-rowdata1">Edit</button>

	                          <button class="btn btn-xs btn-danger btn-remove-service mt-2 delete_data1">Xóa</button>
	                        </td>
	                   </tr>'; 
			              
			   }
			}

	    }else{

            foreach($reversed as $record){
	          if($record['ChuyenKhoa'] != "TuVan"){
	             $output.=' <tr id="item">
	                     	<td class="ID">'.$record['ID'].'</td>
	                        <td class="TrieuChung">'.$record['TrieuChung'].'</td>
	                        <td class="ChuanDoan">'.$record['ChuanDoan'].'</td>
	                        <td class="ChuyenKhoa">'.$record['ChuyenKhoa'].'</td>
	                        <td class="LoiKhuyen">'.$record['LoiKhuyen'].'</td>

	                        <td>
	                         <button type="button" data-bs-toggle="modal" data-bs-target="#centermodal1" 
	                         class="btn btn-xs btn-info btn-edit-rowdata2">Edit</button>

	                          <button class="btn btn-xs btn-danger delete_data2 mt-2">Xóa</button>
	                        </td>
	                   </tr>'; 
			              
			   }
			}

	    }


	   echo $output;
	}

//////////////// Xau Ly Tab 1 ///////////////////////

	public function Add_Or_Update_Data1(Request $request){
        $status = $request->status;
        $ID = $request->ID;
        $CauHoi = $request->CauHoi;
        $CauTL = $request->CauTL;



        if($status == 1){
          $this->add_data_chatbot1($CauHoi, $CauTL);
        }else{
          $this->update_data_chatbot1($ID, $CauHoi, $CauTL);
        }

	}


	public function add_data_chatbot1($CauHoi, $CauTL){

		$pythonFilePath = public_path('/python/DatasetDT.csv');


		$csv = Reader::createFromPath($pythonFilePath, 'r');
	    $csv->setHeaderOffset(0);
	    $records = $csv->getRecords();
	    $lastRow = null;
	    $lastRowId = 0;
       
	    foreach ($records as $record) {
	        $lastRow = $record;
	     }
	    if ($lastRow !== null) {
        $lastRowId = $lastRow['ID']; 
   		}

	
	    $data = [
	    	'ID' => $lastRowId + 1,
	        'TrieuChung' => $CauHoi,
	        'ChuanDoan' => "",
	        'ChuyenKhoa' => "TuVan",
	        'LoiKhuyen' => $CauTL
	    ];


		$writer = Writer::createFromPath($pythonFilePath, 'a+');
	    $writer->insertOne($data);
	    
	   return "Thanh Cong";
	}


	public function update_data_chatbot1($id, $CauHoi, $CauTL){

	  $pythonFilePath = public_path('/python/DatasetDT.csv');
	    $csv = Reader::createFromPath($pythonFilePath, 'r');
	    $csv->setHeaderOffset(0);
	     
	    $records = $csv->getRecords();
	    $allData = iterator_to_array($records);
	    
	   $indexToUpdate = null;
	    foreach ($allData as $index => $row) {
	        if ($row['ID'] == $id) {
	            $indexToUpdate = $index;
	            break;
	        }
	    }
		    
      if ($indexToUpdate !== null) {
      	
		        $allData[$indexToUpdate]['TrieuChung'] = $CauHoi;
		        $allData[$indexToUpdate]['ChuanDoan'] = "";
		        $allData[$indexToUpdate]['ChuyenKhoa'] = "TuVan";
		        $allData[$indexToUpdate]['LoiKhuyen'] = $CauTL;
		        
		        $csvs = Writer::createFromPath($pythonFilePath, 'w+');
		        $csvs->setOutputBOM(Reader::BOM_UTF8);
		        $csvs->insertOne($csv->getHeader());  // Tuỳ chọn, nếu bạn muốn sử dụng UTF-8
		        $csvs->insertAll($allData);
		        
		        return 'Data updated successfully.';
		    }
		    
		  return 'Data not found.';
	}




////////////////// Xu Ly Tab 2 ///////////////

	public function Add_Or_Update_Data2(Request $request){
        $status = $request->status;
        $ID = $request->ID;
        $TrieuChung = $request->TrieuChung;
        $ChuanDoan = $request->ChuanDoan;
        $ChuyenKhoa = $request->ChuyenKhoa;
        $LoiKhuyen = $request->LoiKhuyen;

        if($status == 1){
          $this->add_data_chatbot2($TrieuChung, $ChuanDoan,$ChuyenKhoa, $LoiKhuyen);
        }else{
          $this->update_data_chatbot2($ID, $TrieuChung, $ChuanDoan,$ChuyenKhoa, $LoiKhuyen);
        }
	}

	public function add_data_chatbot2($TrieuChung, $ChuanDoan,$ChuyenKhoa, $LoiKhuyen){

		$pythonFilePath = public_path('/python/DatasetDT.csv');

		$csv = Reader::createFromPath($pythonFilePath, 'r');
	    $csv->setHeaderOffset(0);
	    $records = $csv->getRecords();
	    $lastRow = null;
	    $lastRowId = 0;
       
	    foreach ($records as $record) {
	        $lastRow = $record;
	     }
	    if ($lastRow !== null) {
        $lastRowId = $lastRow['ID']; 
   		}

	
	    $data = [
	    	'ID' => $lastRowId + 1,
	        'TrieuChung' => $TrieuChung,
	        'ChuanDoan' => $ChuanDoan,
	        'ChuyenKhoa' => $ChuyenKhoa,
	        'LoiKhuyen' => $LoiKhuyen
	    ];


		$writer = Writer::createFromPath($pythonFilePath, 'a+');
	    $writer->insertOne($data);
	    
	   return "Thanh Cong";
	}



	public function update_data_chatbot2($id, $TrieuChung, $ChuanDoan,$ChuyenKhoa, $LoiKhuyen){

	   $pythonFilePath = public_path('/python/DatasetDT.csv');
	    $csv = Reader::createFromPath($pythonFilePath, 'r');
	    $csv->setHeaderOffset(0);
	     

	    $records = $csv->getRecords();
	    $allData = iterator_to_array($records);

	    $indexToUpdate = null;
	    foreach ($allData as $index => $row) {
	        if ($row['ID'] == $id) {
	            $indexToUpdate = $index;
	            break;
	        }
	    }
		    
      if ($indexToUpdate !== null) {

		        $allData[$indexToUpdate]['TrieuChung'] = $TrieuChung;
		        $allData[$indexToUpdate]['ChuanDoan'] = $ChuanDoan;
		        $allData[$indexToUpdate]['ChuyenKhoa'] = $ChuyenKhoa;
		        $allData[$indexToUpdate]['LoiKhuyen'] = $LoiKhuyen;
		        
		        $csvs = Writer::createFromPath($pythonFilePath, 'w+');
		        $csvs->setOutputBOM(Reader::BOM_UTF8);
		        $csvs->insertOne($csv->getHeader());  // Tuỳ chọn, nếu bạn muốn sử dụng UTF-8
		        $csvs->insertAll($allData);
		        
		        return 'Data updated successfully.';
		    }
		    
		  return 'Data not found.';
	}






	public function delete_row_dataset(Request $request)
	{
		 $id = $request->ID;
		 $pythonFilePath = public_path('/python/DatasetDT.csv');
		if($request->status == 3){
		 $pythonFilePath = public_path('/python/DataCH.csv');
		}


	    $csv = Reader::createFromPath($pythonFilePath, 'r');
	    $csv->setHeaderOffset(0);
	     

	    $records = $csv->getRecords();
	    $allData = iterator_to_array($records);

		$indexToDelete = null;
	    foreach ($allData as $index => $row) {
	        if ($row['ID'] == $id) {
	            $indexToDelete = $index;
	            break;
	        }
	    }
		    
      if ($indexToDelete !== null) {
          unset($allData[$indexToDelete]);

	        $csvs = Writer::createFromPath($pythonFilePath, 'w+');
	        $csvs->insertOne($csv->getHeader()); // Ghi lại header (hàng đầu tiên)
	        $csvs->insertAll($allData);
	        
	     return 'Thanh Cong';
	    }
		    
	  return 'That bai';
	}

	///////////////////////////////////



	public function LoadDataSetCH(Request $request){

	   $pythonFilePath = public_path('/python/DataCH.csv');
		$csv = Reader::createFromPath($pythonFilePath, 'r');
	    $csv->setHeaderOffset(0); // Đặt vị trí của header (tiêu đề), ví dụ: dòng đầu tiên
	    
	    $records = $csv->getRecords(); // Lấy tất cả các bản ghi
	    
	    $collection = collect($records);
	    $reversed = $collection->reverse();

	    $output='';
	     foreach($reversed as $record){
             $output.=' 
                <tr id="item">
                     	<td class="ID">'.$record['ID'].'</td>
                        <td class="CauHoi">'.$record['CauHoi'].'</td>
                        <td class="Date">'.$record['Date'].'</td>

                        <td>
                          <button class="btn btn-xs btn-danger btn-remove-service mt-2 delete_data3">Xóa</button>
                        </td>
                   </tr>'; 
		              
		   }
		



	   echo $output;
	}


}
