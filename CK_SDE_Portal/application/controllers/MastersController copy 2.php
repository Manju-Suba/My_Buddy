<?php	
defined('BASEPATH') OR exit('No direct script access allowed');	
use PhpOffice\PhpSpreadsheet\IOFactory;
class MastersController extends CI_Controller {	
	/**	
	 * Index Page for this controller.	
	 *	
	 * Maps to the following URL	
	 * 		http://example.com/index.php/welcome	
	 *	- or -	
	 * 		http://example.com/index.php/welcome/index	
	 *	- or -	
	 * Since this controller is set as the default controller in	
	 * config/routes.php, it's displayed at http://example.com/	
	 *	
	 * So any other public methods not prefixed with an underscore will	
	 * map to /index.php/welcome/<method_name>	
	 * @see https://codeigniter.com/user_guide/general/urls.html	
	 */	
	public function __construct()	
    {	
        parent::__construct();
        // $this->load->library('excel');
		$this->load->model('MastersModel', 'import');     	
    }	

	//beat bulk import
	public function beat_excel_upload(){
		$beat_upload_type= $this->input->post('beat_upload_type');
		$path = 'uploads/';
		require_once APPPATH . "/third_party/PHPExcel.php";
		$config['upload_path'] = $path;
		$config['allowed_types'] = 'xlsx|xls|csv';
		$config['remove_spaces'] = TRUE;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);   

		if (!$this->upload->do_upload('b_file')) {
			$error = array('error' => $this->upload->display_errors());
		} else {
			$data = array('upload_data' => $this->upload->data());
		}		

		if(empty($error)){
			if (!empty($data['upload_data']['file_name'])) {
				$import_xls_file = $data['upload_data']['file_name'];
			} else {
				$import_xls_file = 0;
			}
			$inputFileName = $path . $import_xls_file;
			try {
				// $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
				// $objReader = PHPExcel_IOFactory::createReader($inputFileType);
				// $objPHPExcel = $objReader->load($inputFileName);
				// $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);   
				$fileExtension = pathinfo($inputFileName, PATHINFO_EXTENSION);
				$allDataInSheet = [];

				if (strtolower($fileExtension) === 'csv') {
					// $csvFile = $inputFileName;
					// if (($handle = fopen($csvFile, 'r')) !== false) {
					// 	$firstRow = true;
					// 	$rowNumber = 1; 
					// 	while (($row = fgetcsv($handle)) !== false) {
					// 		$rowWithTrimmedSpaces = [];
					// 		foreach ($row as $cellValue) {
					// 			$cellValue = preg_replace('/[^\x20-\x7E]/', '', $cellValue); // Replace non-printable ASCII characters
					// 			$cellValue = rtrim($cellValue);
					// 			$rowWithTrimmedSpaces[] = $cellValue;
					// 		}
					// 		$allDataInSheet[$rowNumber] = array_combine(range('A', 'E'), $rowWithTrimmedSpaces);
					// 		$rowNumber++; 
					// 	}
					// 	fclose($handle);
					// }
					$csvContent = file_get_contents($inputFileName);

					$lines = explode("\n", $csvContent);
					$originalArray = [];
					$delimiter = ',';

					foreach ($lines as $line) {
						$fields = str_getcsv($line, $delimiter);
						$cleanedFields = array_map('trim', $fields);
						$originalArray[] = $cleanedFields;
					}

					// Convert the original array to the desired format
					$allDataInst = array();
					foreach ($originalArray as $rowIndex => $row) {
						$convertedRow = array();
						foreach ($row as $columnIndex => $value) {
							// Convert column index to alphabetic character (A, B, C, ...)
							$column = chr(65 + $columnIndex);
							$convertedRow[$column] = preg_replace('/[^\x20-\x7E]/', '', $value);
						}
						$allDataInst[$rowIndex + 1] = $convertedRow;
					}

					function isNotEmptyArray($arr) {
						foreach ($arr as $value) {
							if (trim($value) !== '') {
								return true;
							}
						}
						return false;
					}
					
					$allDataInSheet = array_filter($allDataInst, 'isNotEmptyArray');
				} else {
					$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
					$objReader = PHPExcel_IOFactory::createReader($inputFileType);
					// $objPHPExcel = $objReader->load($inputFileName);
					$objPHPExcel = IOFactory::load($inputFileName);
					$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
				}
				$flag = true;
				$i=0;
				$errors = [];
				$inserdata = [];
				$value_exist = [];
				if($allDataInSheet[1]['B']=='business' && $allDataInSheet[1]['C'] == 'beat_name' && $allDataInSheet[1]['D'] == 'beat_code' && $allDataInSheet[1]['E'] == 'sm_mobile'){
					foreach ($allDataInSheet as $value) {
						if($flag){
							$flag =false;
							continue;
						}
						if($value['A'] !="" && $value['B'] !="" && $value['C'] !="" && $value['D'] !="" && $value['E'] !=""){
							if(strlen($value['E'])== 10 && is_numeric($value['E'])){
								$beat_code= $value['D'];
								$data=$this->import->beat_exists($beat_code);
								if($data==1){
									if($beat_upload_type == "add"){
										$value_exist[$i]['beat_code'] = $value['D'];
									    $errors[]=['Beat_Code' => $value['D'],'format'=>'already_exists'];
									}
									else{
										$value_exist[$i]['beat_code'] = $value['D'];
										$inserdata[$i]['business'] = $value['B'];
										$inserdata[$i]['beat_name'] = $value['C'];
										$inserdata[$i]['beat_code'] = $value['D'];
										$inserdata[$i]['sm_mobile'] = $value['E'];
                                    }
								}
								else{
									$inserdata[$i]['business'] = $value['B'];
								    $inserdata[$i]['beat_name'] = $value['C'];
									$inserdata[$i]['beat_code'] = $value['D'];
								    $inserdata[$i]['sm_mobile'] = $value['E'];
								}
								$i++;
							}
							else{
								$errors[]=['id'=>$value['A'],'format'=>'phno'];
								$inserdata += [];
							}
						}else{
							$errors[]=['id'=>$value['A'],'format'=>'empty'];
							$inserdata += [];
						}							
					} 
				}
				else{
					$response = array("logstatus" => "error_h");
					echo json_encode($response);
					exit;
				}	
				$input = array_map("unserialize", array_unique(array_map("serialize", $inserdata)));
				if($beat_upload_type === "add"){
					$result = $this->import->insert($input);
				}elseif($beat_upload_type === "over_write"){
					$result = $this->import->update($input,$value_exist);
				}
				if($result==1){
					$response = array("logstatus" => "success", "error" => $errors);
				}
				else{
					$response = array("logstatus" => "error", "error" => $errors);
				}
				echo json_encode($response);
							        
			} catch (Exception $e) {
				die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
				. '": ' .$e->getMessage());
			}
		}else{
			$response = array("logstatus" => "error_");
			echo json_encode($response);
		}
       
	}
    //fetch beat
	public function get_beat_optimize(){
		$get_beat_optimize = $this->import->get_beat_optimize();
		echo json_encode($get_beat_optimize);
	}

	public function delete_beat(){
		$beat_id= $this->input->post('beat_delete');
		$get_status = $this->import->delete_masters($beat_id,'beat_mkt_master');
		echo json_encode($get_status);
	}
	public function delete_osm(){
		$osm_id= $this->input->post('osm_delete');
		$get_delStatus = $this->import->delete_masters($osm_id,'osm_performance');
		echo json_encode($get_delStatus);
	}
	public function delete_rs(){
		$rs_id= $this->input->post('rs_delete');
		$get_status = $this->import->delete_masters($rs_id,'rs_mkt_master');
		echo json_encode($get_status);
	}
	public function delete_usersdata(){
		$id= $this->input->post('del_id');
		$mobile= $this->input->post('user_mobile');

		$get_status = $this->import->delete_user($id,$mobile);
		echo json_encode($get_status);
	}

	public function delete_mastersdata(){
		$business= $this->input->post('business');
		if($business == "All"){
			$get_status = $this->import->delete_data('masters');

		}else{
			$get_status = $this->import->delete_mastersdata($business,'masters');

		}
		echo json_encode($get_status);


	}

	public function delete_rs_mastersdata(){
		$business= $this->input->post('rsbusiness');
		if($business == "All"){
			$get_status = $this->import->delete_data('rs_mkt_master');

		}else{
			$get_status = $this->import->delete_rsmastersdata($business,'rs_mkt_master');

		}
		echo json_encode($get_status);


	}

	public function delete_single_mastersdata(){
		$id= $this->input->post('id');
		// print_r($id);die;
		$get_users = $this->import->get_data($id);
		// print_r($get_users);
		$get_users = $this->import->get_user_data($get_users);

		$get_status = $this->import->delete_masters($id,'masters');
		echo json_encode($get_status);


	}

	//osm bulk import 
    public function osm_excel_upload(){
		$beat_upload_type= $this->input->post('osm_upload_type');
		$path = 'uploads/';
		require_once APPPATH . "/third_party/PHPExcel.php";
		$config['upload_path'] = $path;
		$config['allowed_types'] = 'xlsx|xls|csv';
		$config['remove_spaces'] = TRUE;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);   

		if (!$this->upload->do_upload('osm_file')) {
			$error = array('error' => $this->upload->display_errors());
		} else {
			$data = array('upload_data' => $this->upload->data());
		}		

		if(empty($error)){
			if (!empty($data['upload_data']['file_name'])) {
				$import_xls_file = $data['upload_data']['file_name'];
			} else {
				$import_xls_file = 0;
			}
			$inputFileName = $path . $import_xls_file;
			try {
				// $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
				// $objReader = PHPExcel_IOFactory::createReader($inputFileType);
				// $objPHPExcel = $objReader->load($inputFileName);
				// $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);   

				$fileExtension = pathinfo($inputFileName, PATHINFO_EXTENSION);
				$allDataInSheet = [];

				if (strtolower($fileExtension) === 'csv') {
					// $csvFile = $inputFileName;
					// if (($handle = fopen($csvFile, 'r')) !== false) {
					// 	$firstRow = true;
					// 	$rowNumber = 1; 
					// 	while (($row = fgetcsv($handle)) !== false) {
					// 		$rowWithTrimmedSpaces = [];
					// 		foreach ($row as $cellValue) {
					// 			$cellValue = preg_replace('/[^\x20-\x7E]/', '', $cellValue); // Replace non-printable ASCII characters
					// 			$cellValue = rtrim($cellValue);
					// 			$rowWithTrimmedSpaces[] = $cellValue;
					// 		}
					// 		$allDataInSheet[$rowNumber] = array_combine(range('A', 'R'), $rowWithTrimmedSpaces);
					// 		$rowNumber++; 
					// 	}
					// 	fclose($handle);
					// }
					$csvContent = file_get_contents($inputFileName);

					$lines = explode("\n", $csvContent);
					$originalArray = [];
					$delimiter = ',';

					foreach ($lines as $line) {
						$fields = str_getcsv($line, $delimiter);
						$cleanedFields = array_map('trim', $fields);
						$originalArray[] = $cleanedFields;
					}

					// Convert the original array to the desired format
					$allDataInst = array();
					foreach ($originalArray as $rowIndex => $row) {
						$convertedRow = array();
						foreach ($row as $columnIndex => $value) {
							// Convert column index to alphabetic character (A, B, C, ...)
							$column = chr(65 + $columnIndex);
							$convertedRow[$column] = preg_replace('/[^\x20-\x7E]/', '', $value);
						}
						$allDataInst[$rowIndex + 1] = $convertedRow;
					}

					function isNotEmptyArray($arr) {
						foreach ($arr as $value) {
							if (trim($value) !== '') {
								return true;
							}
						}
						return false;
					}
					
					$allDataInSheet = array_filter($allDataInst, 'isNotEmptyArray');
				} else {
					$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
					$objReader = PHPExcel_IOFactory::createReader($inputFileType);
					// $objPHPExcel = $objReader->load($inputFileName);
					$objPHPExcel = IOFactory::load($inputFileName);
					$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
				}

				$flag = true;
				$i=0;
				$errors = [];	
				$value_exist = [];	
				$inserdata = [];	
				if($allDataInSheet[1]['B']=='osm_name' && $allDataInSheet[1]['C'] == 'ssfa_id' && $allDataInSheet[1]['D'] == 'sm_type' && $allDataInSheet[1]['E'] == 'zsm' && 
				$allDataInSheet[1]['F'] == 'asm' && $allDataInSheet[1]['G'] == 'sde' && $allDataInSheet[1]['H'] == 'sde_id' && $allDataInSheet[1]['I'] == 'jc_type' && 
				$allDataInSheet[1]['J'] == 'bc_target' && $allDataInSheet[1]['K'] == 'tlsd_target' && $allDataInSheet[1]['L'] == 'eco_target' && $allDataInSheet[1]['M'] == 'bc_achivement' 
				&& $allDataInSheet[1]['N'] == 'tlsd_achivement' && $allDataInSheet[1]['O'] == 'eco_achivement' && $allDataInSheet[1]['P'] == 'bc_percentage' && $allDataInSheet[1]['Q'] == 'tlsd_percentage' 
				&& $allDataInSheet[1]['R'] == 'eco_percentage'){		
					foreach ($allDataInSheet as $value) {					
						if($flag){
							$flag =false;
							continue;
						}
						if($value['A'] !="" && $value['B'] !="" && $value['C'] !="" && $value['D'] !="" && $value['E'] !="" && $value['F'] !="" && $value['G'] !="" && $value['H'] !="" && $value['I'] !="")					
						{
							if(strlen($value['C'])== 10 && is_numeric($value['C'])){
								$ssfa_id= $value['C'];
								$jc_type= $value['I'];
								$date = date("Y-m-d");
								$nextyear = date('Y', strtotime($date. ' + 1 years'));
								$fin_year=date("Y").'-'.$nextyear;
								$data=$this->import->osm_exists($ssfa_id,$jc_type,$fin_year);
								if($data==1){
									if($beat_upload_type == "add"){
										$value_exist[$i]['ssfa_id'] = $value['C'];
										$value_exist[$i]['jc_type'] = $value['I'];
										$value_exist[$i]['fin_year'] = $nextyear;
									    $errors[]=['ssfa_id' => $value['C'],'jc_type' => $value['I'],'fin_year' => $fin_year,'format'=>'already_exists'];
									}
									else{
										$value_exist[$i]['ssfa_id'] = $value['C'];
										$value_exist[$i]['jc_type'] = $value['I'];
										$value_exist[$i]['fin_year'] = $fin_year;
										$inserdata[$i]['osm_name'] = $value['B'];
										$inserdata[$i]['jc_type'] = $value['I'];
										$inserdata[$i]['ssfa_id'] = $value['C'];
										$inserdata[$i]['fin_year'] =$fin_year;
										$inserdata[$i]['sm_type'] = $value['D'];
										$inserdata[$i]['zsm'] = $value['E'];
										$inserdata[$i]['asm'] = $value['F'];
										$inserdata[$i]['sde'] = $value['G'];
										$inserdata[$i]['sde_id'] = $value['H'];
										$inserdata[$i]['bc_target'] = $value['J'];
										$inserdata[$i]['tlsd_target'] = $value['K'];
										$inserdata[$i]['eco_target'] = $value['L'];
										$inserdata[$i]['bc_achivement'] = $value['M'];
										$inserdata[$i]['tlsd_achivement'] = $value['N'];
										$inserdata[$i]['eco_achivement'] = $value['O'];
										$inserdata[$i]['bc_percentage'] = $value['P'];
										$inserdata[$i]['tlsd_percentage'] = $value['Q'];
										$inserdata[$i]['eco_percentage'] = $value['R'];	

									}
								}
								else{
									$inserdata[$i]['osm_name'] = $value['B'];
									$inserdata[$i]['jc_type'] = $value['I'];
									$inserdata[$i]['ssfa_id'] = $value['C'];
									$inserdata[$i]['fin_year'] =$fin_year;
									$inserdata[$i]['sm_type'] = $value['D'];
									$inserdata[$i]['zsm'] = $value['E'];
									$inserdata[$i]['asm'] = $value['F'];
									$inserdata[$i]['sde'] = $value['G'];
									$inserdata[$i]['sde_id'] = $value['H'];
									$inserdata[$i]['bc_target'] = $value['J'];
									$inserdata[$i]['tlsd_target'] = $value['K'];
									$inserdata[$i]['eco_target'] = $value['L'];
									$inserdata[$i]['bc_achivement'] = $value['M'];
									$inserdata[$i]['tlsd_achivement'] = $value['N'];
									$inserdata[$i]['eco_achivement'] = $value['O'];
									$inserdata[$i]['bc_percentage'] = $value['P'];
									$inserdata[$i]['tlsd_percentage'] = $value['Q'];
									$inserdata[$i]['eco_percentage'] = $value['R'];	
								}
														
								$i++;
							}
							else{
								$errors[]=['id'=>$value['A'],'format'=>'phno'];
								$inserdata += [];
							}
						}else{
							$errors[]=['id'=>$value['A'],'format'=>'empty'];
							$inserdata += [];
						}									
					}
			    }
				else{
					$response = array("logstatus" => "error_h");
					echo json_encode($response);
					exit;
				}	
				$input = array_map("unserialize", array_unique(array_map("serialize", $inserdata)));
				if($beat_upload_type === "add"){
					$result = $this->import->insert_osm($input);
				}elseif($beat_upload_type === "over_write"){
					$result = $this->import->update_osm($input,$value_exist);
				}
				if($result==1){
					$response = array("logstatus" => "success", "error"=>$errors);
				}
				else{
					$response = array("logstatus" => "error", "error" => $errors);
				}
				echo json_encode($response);
							        
			} catch (Exception $e) {
				die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
				. '": ' .$e->getMessage());
			}
		}else{
			$response = array("logstatus" => "error_");
			echo json_encode($response);
		}
       
	}

	//fetch osm
	public function get_osm(){
		$get_osm = $this->import->get_osm();
		echo json_encode($get_osm);
	}

	//rs bulk import
    public function rs_excel_upload(){
		$beat_upload_type= $this->input->post('rs_upload_type');
		$path = 'uploads/';
		require_once APPPATH . "/third_party/PHPExcel.php";
		$config['upload_path'] = $path;
		$config['allowed_types'] = 'xlsx|xls|csv';
		$config['remove_spaces'] = TRUE;
		$config['delimiter'] = "\t";
		$this->load->library('upload', $config);
		$this->upload->initialize($config);   

		if (!$this->upload->do_upload('rs_file')) {
			$error = array('error' => $this->upload->display_errors());
		} else {
			$data = array('upload_data' => $this->upload->data());
		}		

		if(empty($error)){
			if (!empty($data['upload_data']['file_name'])) {
				$import_xls_file = $data['upload_data']['file_name'];
			} else {
				$import_xls_file = 0;
			}
			$inputFileName = $path . $import_xls_file;
			try {

				$fileExtension = pathinfo($inputFileName, PATHINFO_EXTENSION);

				if($fileExtension == 'csv'){
					$csvContent = file_get_contents($inputFileName);

					$lines = explode("\n", $csvContent);
					$originalArray = [];
					$delimiter = ',';

					foreach ($lines as $line) {
						$fields = str_getcsv($line, $delimiter);
						$cleanedFields = array_map('trim', $fields);
						$originalArray[] = $cleanedFields;
					}

					// Convert the original array to the desired format
					$allDataInst = array();
					foreach ($originalArray as $rowIndex => $row) {
						$convertedRow = array();
						foreach ($row as $columnIndex => $value) {
							// Convert column index to alphabetic character (A, B, C, ...)
							$column = chr(65 + $columnIndex);
							$convertedRow[$column] = preg_replace('/[^\x20-\x7E]/', '', $value);
						}
						$allDataInst[$rowIndex + 1] = $convertedRow;
					}

					function isNotEmptyArray($arr) {
						foreach ($arr as $value) {
							if (trim($value) !== '') {
								return true;
							}
						}
						return false;
					}
					
					$allDataInSheet = array_filter($allDataInst, 'isNotEmptyArray');
					
					// $convertedArray now contains the desired format
				}else{
					$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
					$objReader = PHPExcel_IOFactory::createReader($inputFileType);
					// $objPHPExcel = $objReader->load($inputFileName);
					$objPHPExcel = IOFactory::load($inputFileName);
				
				    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true); 
				}

				$flag = true;
				$i=0;
				$errors = [];
				$inserdata = [];	
				$value_exist = [];
				// if($allDataInSheet[1]['B']=='business' && $allDataInSheet[1]['C'] == 'rs_name' && $allDataInSheet[1]['D'] == 'rs_code' && $allDataInSheet[1]['E'] == 'sm_mobile' && $allDataInSheet[1]['F'] == 'tso_name' && $allDataInSheet[1]['G'] == 'tso_mobile'){		
				if($allDataInSheet[1]['B']=='business' && $allDataInSheet[1]['I'] == 'rs_name' && $allDataInSheet[1]['J'] == 'rs_code' && $allDataInSheet[1]['K'] == 'sm_mobile' && $allDataInSheet[1]['L'] == 'tso_name' && $allDataInSheet[1]['M'] == 'tso_mobile'
				&&$allDataInSheet[1]['C']=='region' && $allDataInSheet[1]['D'] == 'state_name' && $allDataInSheet[1]['E'] == 'district_name' && $allDataInSheet[1]['F'] == 'city_name' && $allDataInSheet[1]['G'] == 'town_name' && $allDataInSheet[1]['H'] == 'town_code'){		

				    foreach ($allDataInSheet as $value) {							
						
						if($flag){
							$flag =false;
							continue;
						}
						
						if($value['A'] !="" && $value['B'] !="" && $value['C'] !="" && $value['D'] !="" && $value['E'] !="" && $value['F'] !="" && $value['G'] !=""&&
						$value['H'] !="" && $value['I'] !="" && $value['J'] !="" && $value['K'] !="" && $value['L'] !="" && $value['M'] !="")					
						{
							if(strlen($value['K'])== 10 && strlen($value['M'])== 10 && is_numeric($value['K']) && is_numeric($value['M'])){
								
								$rs_code= $value['J'];
								$sm_mobile= $value['K'];
								$data=$this->import->rs_exists($rs_code,$sm_mobile);
								if($data==1){
									if($beat_upload_type == "add"){
										$value_exist[$i]['rs_code'] = $value['J'];
										$value_exist[$i]['sm_mobile'] = $value['K'];
									    $errors[]=['RS_Code' => $value['J'],'sm_mobile' => $value['K'],'format'=>'already_exists'];
									}
									else{
										$value_exist[$i]['rs_code'] = $value['J'];
										$value_exist[$i]['sm_mobile'] = $value['K'];
										$inserdata[$i]['sm_mobile'] = $value['K'];
									$inserdata[$i]['rs_code'] = $value['J'];
									$inserdata[$i]['business'] = $value['B'];
									$inserdata[$i]['rs_name'] = $value['I'];
									$inserdata[$i]['tso_name'] = $value['L'];
									$inserdata[$i]['tso_mobile'] = $value['M'];
									$inserdata[$i]['status'] =1;
									$inserdata[$i]['state_name'] = $value['D'];
									$inserdata[$i]['district_name'] = $value['E'];
									$inserdata[$i]['city_name'] = $value['F'];
									$inserdata[$i]['town_name'] = $value['G'];
									$inserdata[$i]['town_code'] = $value['H'];
									$inserdata[$i]['region'] = $value['C'];
									}									
								}
								else{
									$inserdata[$i]['sm_mobile'] = $value['K'];
									$inserdata[$i]['rs_code'] = $value['J'];
									$inserdata[$i]['business'] = $value['B'];
									$inserdata[$i]['rs_name'] = $value['I'];
									$inserdata[$i]['tso_name'] = $value['L'];
									$inserdata[$i]['tso_mobile'] = $value['M'];
									$inserdata[$i]['status'] =1;
									$inserdata[$i]['state_name'] = $value['D'];
									$inserdata[$i]['district_name'] = $value['E'];
									$inserdata[$i]['city_name'] = $value['F'];
									$inserdata[$i]['town_name'] = $value['G'];
									$inserdata[$i]['town_code'] = $value['H'];
									$inserdata[$i]['region'] = $value['C'];

								}
								$i++;
							}
							else{
								$errors[]=['id'=>$value['A'],'format'=>'phno'];
								$inserdata += [];
							}
							
						}else{
							$errors[]=['id'=>$value['A'],'format'=>'empty'];
							$inserdata += [];
						}	
				    }							
				}
				else{
					$response = array("logstatus" => "error_h");
					echo json_encode($response);
					exit;
				}	


				$input = array_map("unserialize", array_unique(array_map("serialize", $inserdata)));
				if($beat_upload_type === "add"){
					$result = $this->import->insert_rs($input);
				}elseif($beat_upload_type === "over_write"){
					$result = $this->import->update_rs($input,$value_exist);
				}
				if($result==1){
					$response = array("logstatus" => "success", "error" => $errors);
				}
				else{
					$response = array("logstatus" => "error", "error" => $errors);
				}
				echo json_encode($response);
							        
			} catch (Exception $e) {
				die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
				. '": ' .$e->getMessage());
			}
		}else{
			$response = array("logstatus" => "error_");
			echo json_encode($response);
		}
       
	}

	//fetch rs
	public function get_rs(){
		// $get_rs = $this->import->get_rs();
		// echo json_encode($get_rs);
		if($this->input->post('division') == "" || $this->input->post('division') =='All'){
			$get_masters = $this->import->get_rs();

		}else{
			$division =$this->input->post('division');
			$get_masters = $this->import->get_rs_bydiv($division);

		}
		echo json_encode($get_masters);
	}

	//masters bulk import
    public function m_excel_upload(){

		$beat_upload_type= $this->input->post('m_upload_type');
		$path = 'uploads/';
		require_once APPPATH . "/third_party/PHPExcel.php";
		$config['upload_path'] = $path;
		$config['allowed_types'] = 'xlsx|xls|csv';
		$config['remove_spaces'] = TRUE;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);   

		if (!$this->upload->do_upload('m_file')) {
			$error = array('error' => $this->upload->display_errors());
		} else {
			$data = array('upload_data' => $this->upload->data());
		}		

		if(empty($error)){
			if (!empty($data['upload_data']['file_name'])) {
				$import_xls_file = $data['upload_data']['file_name'];
			} else {
				$import_xls_file = 0;
			}
			$inputFileName = $path . $import_xls_file;
			try {
				// $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
				$fileExtension = pathinfo($inputFileName, PATHINFO_EXTENSION);
				$allDataInSheet = [];

				if (strtolower($fileExtension) === 'csv') {

					// $csvFile = $inputFileName;
					// if (($handle = fopen($csvFile, 'r')) !== false) {
					// 	$firstRow = true;
					// 	$rowNumber = 1; 
					// 	while (($row = fgetcsv($handle)) !== false) {
					// 		$rowWithTrimmedSpaces = [];
					// 		foreach ($row as $cellValue) {
					// 			$cellValue = preg_replace('/[^\x20-\x7E]/', '', $cellValue); // Replace non-printable ASCII characters
					// 			$cellValue = rtrim($cellValue);
					// 			$rowWithTrimmedSpaces[] = $cellValue;
					// 		}
					// 		$allDataInSheet[$rowNumber] = array_combine(range('A', 'O'), $rowWithTrimmedSpaces);
					// 		$rowNumber++; 
					// 	}
					// 	fclose($handle);
					// }
					$csvContent = file_get_contents($inputFileName);

					$lines = explode("\n", $csvContent);
					$originalArray = [];
					$delimiter = ',';

					foreach ($lines as $line) {
						$fields = str_getcsv($line, $delimiter);
						$cleanedFields = array_map('trim', $fields);
						$originalArray[] = $cleanedFields;
					}

					// Convert the original array to the desired format
					$allDataInst = array();
					foreach ($originalArray as $rowIndex => $row) {
						$convertedRow = array();
						foreach ($row as $columnIndex => $value) {
							// Convert column index to alphabetic character (A, B, C, ...)
							$column = chr(65 + $columnIndex);
							$convertedRow[$column] = preg_replace('/[^\x20-\x7E]/', '', $value);
						}
						$allDataInst[$rowIndex + 1] = $convertedRow;
					}

					function isNotEmptyArray($arr) {
						foreach ($arr as $value) {
							if (trim($value) !== '') {
								return true;
							}
						}
						return false;
					}
					
					$allDataInSheet = array_filter($allDataInst, 'isNotEmptyArray');
				} else {

					$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
					$objReader = PHPExcel_IOFactory::createReader($inputFileType);
					// $objPHPExcel = $objReader->load($inputFileName);
					$objPHPExcel = IOFactory::load($inputFileName);

					$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);


				}
   
				$flag = true;
				$i=0;
				$errors = [];	
				$inserdata = [];
				$value_exist = [];	
				if($allDataInSheet[1]['B']=='division' && $allDataInSheet[1]['C'] == 'region' && $allDataInSheet[1]['D'] == 'zsm' && $allDataInSheet[1]['E'] == 'zsm_number' && $allDataInSheet[1]['F'] == 'zsm_email' && $allDataInSheet[1]['G'] == 'asm' && $allDataInSheet[1]['H'] == 'asm_number' && $allDataInSheet[1]['I'] == 'asm_email' && $allDataInSheet[1]['J'] == 'tso' && $allDataInSheet[1]['K'] == 'tso_number'  && $allDataInSheet[1]['L'] == 'tso_email' && $allDataInSheet[1]['M'] == 'sm' && $allDataInSheet[1]['N'] == 'sm_number'){			
				    foreach ($allDataInSheet as $value) {					
						if($flag){
							$flag =false;
							continue;
						}
						
						if($value['A'] !="" && $value['B'] !="" && $value['C'] !="" && $value['D'] !="" && $value['E'] !="" && $value['F'] !="" && $value['G'] !=""&& $value['H'] !="" && $value['I'] !='' && $value['J'] !="" && $value['K'] !='' && $value['L'] !="" && $value['M'] !=''&& $value['N'] !='' )					
						{	
							// if(strtoupper($value['B']) == 'AB URBAN' || strtoupper($value['B']) == 'PC URBAN' || strtoupper($value['B']) == 'FMCG RURAL'){

								if(strlen($value['E']) == 10  && strlen($value['H']) == 10  && strlen($value['K']) == 10  && strlen($value['N']) == 10   ){
									if(filter_var($value['F'], FILTER_VALIDATE_EMAIL) && filter_var($value['I'], FILTER_VALIDATE_EMAIL) &&filter_var($value['L'], FILTER_VALIDATE_EMAIL)){ //&&filter_var($value['O'], FILTER_VALIDATE_EMAIL)
										$password=md5("123456");
										$zsm_data=array("mobile"=>$value['E'],"username"=>$value['D'],"email"=>$value['F'],"password"=>$password,"role"=>'ZSM',"role_type"=>'ZSM',"status"=>1,"business"=>$value['B']);
										$asm_data=array("mobile"=>$value['H'],"username"=>$value['G'],"email"=>$value['I'],"password"=>$password,"role"=>'ASM',"role_type"=>'ASM',"status"=>1,"business"=>$value['B']);
										$tso_data=array("mobile"=>$value['K'],"username"=>$value['J'],"email"=>$value['L'],"password"=>$password,"role"=>'TSO',"role_type"=>'TSO',"status"=>1,"business"=>$value['B']);
										$sm_data=array("mobile"=>$value['N'],"username"=>$value['M'],"email"=>$value['O'],"password"=>$password,"role"=>'SM',"role_type"=>'SM',"status"=>1,"business"=>$value['B']);
										
										$zsm_user=$this->import->zsm_exist($value['E'],$zsm_data);
										$asm_user=$this->import->asm_exist($value['H'],$asm_data);
										$sm_user=$this->import->sm_exist($value['N'],$sm_data);
										$tso_user=$this->import->tso_exist($value['K'],$tso_data);
										$masters=$this->import->m_exist($value['E'],$value['H'],$value['K'],$value['N']);
										$sm_mapping_exists=$this->import->sm_mapping_exist($value['N']);

										if($zsm_user != 'business_mismatch' && $zsm_user != 'role_mismatch' && $asm_user != 'business_mismatch' && $asm_user != 'role_mismatch' && $sm_user != 'business_mismatch' && $sm_user != 'role_mismatch' && $tso_user != 'business_mismatch' && $tso_user != 'role_mismatch'){
										
											if($masters==1 || $sm_mapping_exists == 1){
												if($beat_upload_type == "add"){
													$value_exist[$i]['zsm_number'] = $value['E'];
													$value_exist[$i]['asm_number'] = $value['G'];
													$value_exist[$i]['sm_number']  = $value['K'];
													$value_exist[$i]['tso_number'] = $value['I'];
													$errors[]=['zsm_number' => $value['E'],'asm_number' => $value['H'],'sm_number' => $value['K'],'tso_number' => $value['N'],'format'=>'already_exists'];
												}else if ($sm_mapping_exists == 1 && $beat_upload_type == "over_write") {
													$value_exist[$i]['sm_number']  = $value['N'];
													$inserdata[$i]['zsm_number'] = $value['E'];
													$inserdata[$i]['asm_number'] = $value['H'];
													$inserdata[$i]['tso_number'] = $value['K'];
													$inserdata[$i]['sm_number']  = $value['N'];
													
													$inserdata[$i]['zsm_email'] = $value['F'];
													$inserdata[$i]['asm_email'] = $value['I'];
													$inserdata[$i]['tso_email'] = $value['L'];
													$inserdata[$i]['sm_email']  = $value['O'];

													$inserdata[$i]['division'] = $value['B'];
													$inserdata[$i]['region'] = $value['C'];
													$inserdata[$i]['asm'] = $value['G'];
													$inserdata[$i]['tso'] = $value['J'];
													$inserdata[$i]['sm'] = $value['M'];
													$inserdata[$i]['zsm'] = $value['D'];
													$inserdata[$i]['va'] ="VA";
													$inserdata[$i]['va_number'] ="VA01";
													$inserdata[$i]['si'] ="SI";
													$inserdata[$i]['si_number'] ="SI01";
												}else{
													$value_exist[$i]['zsm_number'] = $value['E'];
													$value_exist[$i]['asm_number'] = $value['H'];
													$value_exist[$i]['sm_number']  = $value['N'];
													$value_exist[$i]['tso_number'] = $value['K'];
													$inserdata[$i]['zsm_number'] = $value['E'];
													$inserdata[$i]['asm_number'] = $value['H'];
													$inserdata[$i]['tso_number'] = $value['K'];
													$inserdata[$i]['sm_number']  = $value['N'];

													$inserdata[$i]['zsm_email'] = $value['F'];
													$inserdata[$i]['asm_email'] = $value['I'];
													$inserdata[$i]['tso_email'] = $value['L'];
													$inserdata[$i]['sm_email']  = $value['O'];

													$inserdata[$i]['division'] = $value['B'];
													$inserdata[$i]['region'] = $value['C'];
													$inserdata[$i]['asm'] = $value['G'];
													$inserdata[$i]['tso'] = $value['J'];
													$inserdata[$i]['sm'] = $value['M'];
													$inserdata[$i]['zsm'] = $value['D'];
													$inserdata[$i]['va'] ="VA";
													$inserdata[$i]['va_number'] ="VA01";
													$inserdata[$i]['si'] ="SI";
													$inserdata[$i]['si_number'] ="SI01";
												}
											}
											else{
												$inserdata[$i]['zsm_number'] = $value['E'];
												$inserdata[$i]['asm_number'] = $value['H'];
												$inserdata[$i]['tso_number'] = $value['K'];
												$inserdata[$i]['sm_number']  = $value['N'];

												$inserdata[$i]['zsm_email'] = $value['F'];
												$inserdata[$i]['asm_email'] = $value['I'];
												$inserdata[$i]['tso_email'] = $value['L'];
												$inserdata[$i]['sm_email']  = $value['O'];

												$inserdata[$i]['division'] = $value['B'];
												$inserdata[$i]['region'] = $value['C'];
												$inserdata[$i]['asm'] = $value['G'];
												$inserdata[$i]['tso'] = $value['J'];
												$inserdata[$i]['sm'] = $value['M'];
												$inserdata[$i]['zsm'] = $value['D'];
												$inserdata[$i]['va'] ="VA";
												$inserdata[$i]['va_number'] ="VA01";
												$inserdata[$i]['si'] ="SI";
												$inserdata[$i]['si_number'] ="SI01";
											}
											$i++;
										}else{
											
											if($zsm_user == 'business_mismatch'){
												
												$errors[]=['id'=>$value['A'],'format'=>'business','role'=>'zsm'];
											}elseif ($zsm_user == 'role_mismatch') {
												$errors[]=['id'=>$value['A'],'format'=>'role','role'=>'zsm'];
											}

											if($asm_user == 'business_mismatch'){
												$errors[]=['id'=>$value['A'],'format'=>'business','role'=>'asm'];
											}elseif ($asm_user == 'role_mismatch') {
												$errors[]=['id'=>$value['A'],'format'=>'role','role'=>'asm'];
											}

											if($sm_user == 'business_mismatch'){
												$errors[]=['id'=>$value['A'],'format'=>'business','role'=>'sm'];
											}elseif ($sm_user == 'role_mismatch') {
												$errors[]=['id'=>$value['A'],'format'=>'role','role'=>'sm'];
											}

											if($tso_user == 'business_mismatch'){
												$errors[]=['id'=>$value['A'],'format'=>'business','role'=>'tso'];
											}elseif ($tso_user == 'role_mismatch') {
												$errors[]=['id'=>$value['A'],'format'=>'role','role'=>'tso'];
											}
										}
									}else{
										$errors[]=['id'=>$value['A'],'format'=>'email'];
										$inserdata += [];
									}
								}
								else{
									$errors[]=['id'=>$value['A'],'format'=>'phno'];
									$inserdata += [];
								}
							// }else{
							// 	$errors[]=['id'=>$value['A'],'format'=>'invalid_business'];
							// 	$inserdata += [];
							// }
							
						}else{

							$errors[]=['id'=>$value['A'],'format'=>'empty'];
							$inserdata += [];
						}	
				    }						
				}
				else{
					$response = array("logstatus" => "error_h");
					echo json_encode($response);
					exit;
				}
				$input = array_map("unserialize", array_unique(array_map("serialize", $inserdata)));
				if($beat_upload_type === "add"){
					$result = $this->import->insert_m($input);
				} else if ($sm_mapping_exists == 1 && $beat_upload_type == "over_write"){
					$result = $this->import->update_m_bysm($input,$value_exist);

				}else if($beat_upload_type === "over_write"){
					$result = $this->import->update_m($input,$value_exist);
				}
				if($result==1){
					$response = array("logstatus" => "success", "error" => $errors);
				}
				else{
					$response = array("logstatus" => "error", "error" => $errors);
				}
				echo json_encode($response);
							        
			} catch (Exception $e) {
				die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
				. '": ' .$e->getMessage());
			}
		}else{
			$response = array("logstatus" => "error_");
			echo json_encode($response);
		}
       
	}

	//fetch masters
	public function get_masters(){
		// print_r($this->input->post('division'));die;

		if($this->input->post('division') == "" || $this->input->post('division') =='All'){
			$get_masters = $this->import->get_masters();

		}else{
			$division =$this->input->post('division');
			$get_masters = $this->import->get_masters_bydiv($division);

		}
		echo json_encode($get_masters);
	}

	//fetch users
	public function get_users(){
		$get_users = $this->import->get_users();
		echo json_encode($get_users);
	}

	//update users
	public function update_user(){
		$mobile = $this->input->post('mobile');
		$cur_mobile = $this->input->post('cur_mobile');
		$username = $this->input->post('username');
		$id = $this->input->post('id');

		$update_user = $this->import->update_user($id, $mobile,$username);
		$update_masters = $this->import->update_masters($id, $mobile, $cur_mobile,$username);
		$update_beat_masters = $this->import->update_beat_masters($mobile, $cur_mobile,$username);
		$update_beat_optimize = $this->import->update_beat_optimize($mobile, $cur_mobile,$username);
		$update_cw_farm = $this->import->update_cw_form($mobile, $cur_mobile);
		$update_dist_masters = $this->import->update_dist_masters($mobile, $cur_mobile,$username);
		$update_osm_performance = $this->import->update_osm_performance($mobile, $cur_mobile, $username);
		$update_rssm_masters = $this->import->update_rssm_masters($mobile, $cur_mobile, $username);
		$update_rssm_recruitment_form = $this->import->update_rssm_recruitment_form($mobile, $cur_mobile, $username);
		$update_rssm_recruitment_form_vso = $this->import->update_rssm_recruitment_form_vso($mobile, $cur_mobile, $username);
		$update_rs_key_performance = $this->import->update_rs_key_performance($mobile, $cur_mobile);
		$update_rs_mkt_master = $this->import->update_rs_mkt_master($username,$mobile, $cur_mobile);
		$update_rs_recruitment_form = $this->import->update_rs_recruitment_form($username,$mobile, $cur_mobile);
		$update_rs_recruitment_form_vso = $this->import->update_rs_recruitment_form_vso($username,$mobile, $cur_mobile);
		$update_sde_incentive_urban = $this->import->update_sde_incentive_urban($username,$mobile, $cur_mobile);
		$update_sde_market_visit_report = $this->import->update_sde_market_visit_report($mobile, $cur_mobile);
		$update_ss_recruitment_form = $this->import->update_ss_recruitment_form($username,$mobile, $cur_mobile);
		$update_ss_recruitment_form_vso = $this->import->update_ss_recruitment_form_vso($username,$mobile, $cur_mobile);
		$update_distribution = $this->import->update_distribution($username,$mobile, $cur_mobile);
		$update_tso_login_log = $this->import->update_tso_login_log($username,$mobile, $cur_mobile);
		// $update_rssm_masters = $this->import->update_rssm_masters($mobile, $cur_mobile, $username);
		// $update_user = $this->import->update_user($mobile, $cur_mobile);
		// $update_user = $this->import->update_user($mobile, $cur_mobile);
		// $update_user = $this->import->update_user($mobile, $cur_mobile);
		// $update_user = $this->import->update_user($mobile, $cur_mobile);
		// $update_user = $this->import->update_user($mobile, $cur_mobile);
		// $update_user = $this->import->update_user($mobile, $cur_mobile);
		// $update_user = $this->import->update_user($mobile, $cur_mobile);
		// $update_user = $this->import->update_user($mobile, $cur_mobile);
		// $update_user = $this->import->update_user($mobile, $cur_mobile);
		if($update_user==1){
			$response = array("logstatus" => "success");
        }
		else{
            $response = array("logstatus" => "error");
        }
		echo json_encode($response);
	}
	public function get_user_id(){
		$id= $this->input->post('id');
		$get_user = $this->import->get_user_id($id);
		echo json_encode($get_user);
	}
	
}
       
