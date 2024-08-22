<?php	
defined('BASEPATH') OR exit('No direct script access allowed');	

class BeatOptimizationController extends CI_Controller {	
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
        $this->load->helper(array(	
            'form',	
            'html',	
            'file',	
            'url'	
        ));	
        $this->load->library('session');	
        $this->load->library('form_validation');	
        $this->load->library('javascript');	
        $this->load->library('email');	
		$this->load->library('excel');
        $this->load->model('Common_model', 'cmodel');
        $this->load->model('BeatOptimize_model', 'bomodel');
		$this->load->model('Import_model', 'import');
		if ( !$this->session->userdata('logged_in')){ 	
			redirect(tso_portal_base_url(), 'refresh');	
			// redirect('http://localhost/CK_TSO_Portal/');
				
        }	
        	
    }	

	public function get_sde_list(){ 
		$role_type=$this->session->userdata('role_type');

		if($role_type =='ZSM' ){
			$asm_number = $this->input->post('asm_number');
			$data = $this->bomodel->get_sde_list('dist_master',$asm_number);
			echo json_encode($data);
		}
    }
	
	public function beat_optimize_report(){	
		$role_type=$this->session->userdata('role_type');
		if($role_type =='ZSM'){
			$sess_mob=$this->session->userdata('mobile');
			$user_details= $this->bomodel->get_data('users',$sess_mob);
			$user_id=$user_details[0]->user_id;
			$asm_name=$user_details[0]->username;
			
			$asm_details = $this->bomodel->get_data_asm_details('dist_master',$sess_mob);
			$data['asm_details'] = $asm_details;
			// $sde_details = $this->bomodel->get_data_tso_sde_details('masters',$sess_mob,$asm_name);
			// $data['sde_details'] = $sde_details;

			$this->load->view('beat_optimize/beat_optimize_report',$data);	

		}elseif($role_type =='ASM'){
			$sess_mob=$this->session->userdata('mobile');
			$user_details= $this->bomodel->get_data('users',$sess_mob);
			$user_id=$user_details[0]->user_id;
			$asm_name=$user_details[0]->username;
			
			$sde_details = $this->bomodel->get_data_tso_sde_details('dist_master',$sess_mob,$asm_name);
			$data['sde_details'] = $sde_details;

			$this->load->view('beat_optimize/beat_optimize_report',$data);		
		}elseif($role_type =='LEADER' || $role_type =='MLEADER'){
			$this->load->view('beat_optimize/beat_optimize_view');	
		}else{
			$this->load->view('beat_optimize/beat_optimize_report');	
		}
		// $this->load->view('beat_optimize/beat_optimize_report');	
	}	
	
	public function get_beat_optimize_report(){

		// $postData = $this->input->post();
        
		// $get_beat_optimize_result = $this->bomodel->get_beat_optimize_report($postData);

		// echo json_encode($get_beat_optimize_result);

		$role_type=$this->session->userdata('role_type');
		if($role_type =='TSO' ){
			$sess_mob=$this->session->userdata('mobile');

			// $user_details= $this->bomodel->get_data('users',$sess_mob);
			// $sde_name=$user_details[0]->username;
			// $sde_number=$sess_mob;

			$postData_where['role_type'] = $role_type;
			$postData_where['sde_number'] = $sess_mob;
			 

			$postData = $this->input->post();
        
			$get_beat_optimize_result = $this->bomodel->get_beat_optimize_report($postData,$postData_where);
	
			// print_r($get_beat_optimize_result);
			// exit;

			echo json_encode($get_beat_optimize_result);

		}elseif($role_type =='ASM' ){

			$sess_mob=$this->session->userdata('mobile');

			$user_details= $this->bomodel->get_data('users',$sess_mob);
			$asm_name=$user_details[0]->username;
			$asm_number=$user_details[0]->username;

			$postData_where['role_type'] = $role_type;
			$postData_where['asm_name'] = $asm_name;
			$postData_where['asm_number'] = $sess_mob;
			// $postData_where['sde_name'] = $this->input->post('sde_name');
			$postData_where['sde_number'] = $this->input->post('sde_number');
			

			$postData = $this->input->post();
        
			$get_beat_optimize_result = $this->bomodel->get_beat_optimize_report($postData,$postData_where);
	
			echo json_encode($get_beat_optimize_result);

		}elseif($role_type =='ZSM' ){

			$sess_mob=$this->session->userdata('mobile');

			$user_details= $this->bomodel->get_data('users',$sess_mob);
			$zsm_name=$user_details[0]->username;

			$postData_where['role_type'] = $role_type;
			// $postData_where['zsm_name'] = $zsm_name;
			$postData_where['zsm_number'] = $sess_mob;
			// $postData_where['sde_name'] = $this->input->post('sde_name');

			if($this->input->post('asm_number') !=""){
				$postData_where['asm_number'] = $this->input->post('asm_number');
			}else{
				$postData_where['asm_number'] = '';
			}
			if($this->input->post('sde_number') !=""){
				$postData_where['sde_number'] = $this->input->post('sde_number');
			}else{
				$postData_where['sde_number'] = '';
			}

			$postData = $this->input->post();
        
			$get_beat_optimize_result = $this->bomodel->get_beat_optimize_report($postData,$postData_where);
	
			echo json_encode($get_beat_optimize_result);

		}elseif($role_type =='SM' ){
			$sess_mob=$this->session->userdata('mobile');

			$user_details= $this->bomodel->get_data('users',$sess_mob);
			$salesman_name=$user_details[0]->username;
			$salesman_ssfa_id=$sess_mob;

			$postData_where['role_type'] = $role_type;
			$postData_where['salesman_name'] = $salesman_name;
			$postData_where['salesman_ssfa_id'] = $salesman_ssfa_id;
			
			$postData = $this->input->post();
			$get_beat_optimize_result = $this->bomodel->get_beat_optimize_report($postData,$postData_where);
	
			echo json_encode($get_beat_optimize_result);
		}elseif($role_type =='Division_Head' ){
			$business=$this->session->userdata('business');
			$role_type=$this->session->userdata('role_type');

			// $user_details= $this->bomodel->get_data('users',$sess_mob);
			// $salesman_name=$user_details[0]->username;
			// $salesman_ssfa_id=$sess_mob;

			$postData_where['channel'] = $business;
			$postData_where['role_type'] = $role_type;

			// $postData_where['salesman_name'] = $salesman_name;
			// $postData_where['salesman_ssfa_id'] = $salesman_ssfa_id;
			
			$postData = $this->input->post();
			$get_beat_optimize_result = $this->bomodel->get_beat_optimize_report($postData,$postData_where);
	
			echo json_encode($get_beat_optimize_result);
		}else{
			$postData_where="";

			$postData = $this->input->post();
			$get_beat_optimize_result = $this->bomodel->get_beat_optimize_report($postData,$postData_where);
	
			echo json_encode($get_beat_optimize_result);
		}
	}


	public function beat_excel_upload(){
		$beat_upload_type= $this->input->post('beat_upload_type');
		$m_file = $this->input->post('m_file');
	
			$path = 'uploads/beat_optimize/';
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
				$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
				$objReader = PHPExcel_IOFactory::createReader($inputFileType);
				$objPHPExcel = $objReader->load($inputFileName);
				$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

				// print_r($allDataInSheet);
				// exit();    
				$flag = true;
				$i=0;
				foreach ($allDataInSheet as $value) {
					if($flag){
						$flag =false;
						continue;
					}

					if($value['A'] !="" && $value['B'] !="" && $value['C'] !="" && $value['D'] !="" && $value['E'] !="" && $value['F']!="" && $value['G'] !="" && $value['H'] !="" && $value['I'] !="" && $value['J'] !="" && $value['K'] !="" && $value['L'] !="" && $value['M'] !="" && $value['N'] !="" && $value['O'] !="" && $value['P'] !="" && $value['Q'] !="" && $value['R'] !="" && $value['S'] !="" && $value['T'] !="" && $value['U'] !="" && $value['V'] !="" && $value['W'] !="'" && $value['X'] !="" && $value['Y'] !=""){

						$inserdata[$i]['dist_cus_code'] = $value['A'];
						$inserdata[$i]['ss_name'] = $value['B'];
						$inserdata[$i]['cmp_cus_code'] = $value['C'];
						$inserdata[$i]['outlet_name'] = $value['D'];
						$inserdata[$i]['old_route_code'] = $value['E'];
						$inserdata[$i]['new_route_code'] = $value['F'];
						$inserdata[$i]['new_suggestive_route_code'] = $value['G'];
						$inserdata[$i]['new_suggestive_route_name'] = $value['H'];
						$inserdata[$i]['outlet_must_visit'] = $value['I'];
						$inserdata[$i]['beat_frequency'] = $value['J'];
						$inserdata[$i]['outlet_score'] = $value['K'];
						$inserdata[$i]['zm'] = $value['L'];
						$inserdata[$i]['zm_number'] = $value['M'];
						$inserdata[$i]['am'] = $value['N'];
						$inserdata[$i]['asm_number'] = $value['O'];
						$inserdata[$i]['sde_emp_code'] = $value['P'];
						$inserdata[$i]['sde_name'] = $value['Q'];
						$inserdata[$i]['sde_number'] = $value['R'];
						$inserdata[$i]['salesman_name'] = $value['S'];
						$inserdata[$i]['salesman_ssfa_id'] = $value['T'];
						$inserdata[$i]['new_route_code2'] = $value['U'];
						$inserdata[$i]['new_beat_name'] = $value['V'];
						$inserdata[$i]['final_beat_frequency'] = $value['W'];
						$inserdata[$i]['visit_day'] = $value['X'];
						$inserdata[$i]['comments'] = $value['Y'];
						$i++;

					}else{
						$response = array(
							"logstatus" => "error",
						); 

						echo json_encode($response);
						return false; 
					}
					
				} 
				// print_r($inserdata);
				// exit();   
				
				if($beat_upload_type === "add"){
					// print_r('add');
					$result = $this->import->insert($inserdata); 
					$response = array(
						"logstatus" => "success",
					);  

				}elseif($beat_upload_type === "over_write"){
					// print_r('over_write');
					$sess_mob=$this->session->userdata('mobile');
					$result = $this->import->update($sess_mob,$inserdata);  

					$response = array(
						"logstatus" => "success_",
					); 
				}
			
				echo json_encode($response);
			        
			} catch (Exception $e) {
				die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
				. '": ' .$e->getMessage());
			}
		}else{
			echo json_encode($result);
		}
       
	}


	public function get_beat_pending_user(){

		$role_type=$this->session->userdata('role_type');
		if($role_type =='LEADER' || $role_type =='MLEADER'){
			$sess_mob=$this->session->userdata('mobile');

			$beat_uploaded_sde = $this->bomodel->get_beat_uploaded_sde('beat_optimization');
			$sde_mob=[];
				if(count($beat_uploaded_sde) !=0){
					for ($i=0; $i < count($beat_uploaded_sde); $i++) { 
						array_push($sde_mob,$beat_uploaded_sde[$i]->sde_number);
					}
				}

			$postData = $this->input->post();
			$get_beat_optimize_result = $this->bomodel->get_beat_pending_sde($postData,$sde_mob);
	
			echo json_encode($get_beat_optimize_result);
		}
	}

	

	public function beat_report(){
		$role_type=$this->session->userdata('role_type');
			
		if($role_type =='ZSM'){
			$sess_mob=$this->session->userdata('mobile');
			
			// $asm_details = $this->bomodel->get_data_asm_details('masters',$sess_mob);
			$asm_details = $this->bomodel->get_data_asm_details('dist_master',$sess_mob);
			$data['asm_details'] = $asm_details;
			// print_r($asm_details);die();
			$this->load->view('beat_optimize/beat_report_view',$data);

		}elseif($role_type =='ASM'){
			$sess_mob=$this->session->userdata('mobile');
			$sde_details = $this->bomodel->get_data_tso_sde_details('dist_master',$sess_mob);

			$data['sde_details'] = $sde_details;

			$this->load->view('beat_optimize/beat_report_view',$data);		
		}elseif($role_type =='LEADER' || $role_type =='MLEADER'){
			$this->load->view('beat_optimize/beat_report_view');	
		}else{
			$this->load->view('beat_optimize/beat_report_view');	
		}
	}
	
	public function get_beat_dist_report()
	{
		$postData = $this->input->post();
		$get_beat_optimize_result = $this->bomodel->get_beat_dist_report($postData);
		echo json_encode($get_beat_optimize_result);
	}
	

}	
