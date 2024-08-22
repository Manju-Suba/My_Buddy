<?php	
defined('BASEPATH') OR exit('No direct script access allowed');	

class SdeMarket extends CI_Controller {	
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
		date_default_timezone_set('Asia/Kolkata');

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

        $this->load->model('Common_model', 'cmodel');
        $this->load->model('Market_model', 'mtmodel');

		if ( !$this->session->userdata('logged_in')){ 	
			redirect(tso_portal_base_url(), 'refresh');	
			// redirect('http://localhost/CK_TSO_Portal/');
				
        }	
        	
    }	
	
	public function sde_market_report(){	
		
		if($this->session->userdata('role') == "TSO"){

			$where_cond_tso['TSO_Number'] = $this->session->userdata('mobile');
			$smlist_result = $this->cmodel->get_role_list_id('masters','sm_number',$where_cond_tso,'sm_number','sm');
			
			$where_cond = array();
			if(count($smlist_result) !=0){
				for ($i=0; $i < count($smlist_result); $i++) { 
					array_push($where_cond, $smlist_result[$i]->sm_number);
				}
			}
			
			$data['get_sde_under_osm_count'] = $this->mtmodel->get_sde_under_osm_count('osm_performance',$where_cond,'ssfa_id');

			$osmlist_result = $this->cmodel->get_role_list_idd('osm_performance','ssfa_id',$where_cond,'ssfa_id');

			$where_cond2 = array();
			if(count($osmlist_result) !=0){
				for ($i=0; $i < count($osmlist_result); $i++) { 
					array_push($where_cond2, $osmlist_result[$i]->ssfa_id);
				}
			}

			$data['get_sde_under_osm_count_mv'] = $this->mtmodel->get_sde_under_osm_count('sde_market_visit_report',$where_cond,'created_by');

			$this->load->view('market_visit/sde_market_report' ,$data);	

		}elseif($this->session->userdata('role') == "SM"){
			$this->load->view('market_visit/sde_market_report');	
		}
		
	}	

	public function market_report(){	
		$this->load->view('market_visit/market_report');	
	}	
	
	 
	public function add_sde_market(){	
		//-------rs mkt -----------
		$rs_mkt = $this->cmodel->get_data_rs('rs_mkt_master','rs_code');
		$data['rs_mkt'] = $rs_mkt;

		$this->load->view('market_visit/add_sde_market',$data);	
	}	
	
	public function get_sde_report_edit(){
		$id = $this->input->post('id');
		$data['row'] = $this->cmodel->get_sde_report_data('sde_market_visit_report' ,$id);

		if($this->session->userdata('role') == 'TSO'){

			$where_cond_rs['rs_code'] = $data['row'][0]->rs_mkt;
			$data['smlist_result'] = $this->cmodel->get_table_user_list_wc('rs_mkt_master',$where_cond_rs,'sm_mobile','sm_mobile');

			$sm_mobile = array();
			foreach($data['smlist_result'] as $each_row){
				$sm_mobile[] = $each_row->sm_mobile;
			}

			$data['get_osm_list'] = $this->cmodel->get_OSM(array_filter($sm_mobile),'osm_performance');
			

			if( !empty($data['get_osm_list']) ){
				foreach($data['get_osm_list'] as $_row){
					$ssfa_id[] = $_row->ssfa_id;
				}
		
				function compare_objects($obj_a, $obj_b) {
					return $obj_a - $obj_b;
				}
				$diff1 = array_udiff(array_filter($sm_mobile), $ssfa_id, 'compare_objects');
		
				if(!empty($diff1)){
					$diff = $diff1;
					$data['get_without_OSM'] = $this->cmodel->get_without_OSM_rs($diff,'masters','sm_number','sm');
				}else{
					$data['get_without_OSM'] = '';
				}

			}else{
				$data['get_without_OSM'] = $this->cmodel->get_without_OSM_rs($sm_mobile,'masters','sm_number','sm');
			}
			
			// $data['rssm_'] = $this->cmodel->get_data('rssm_mkt_master_copy');
		}else{

			$sm_number[] = $this->session->userdata('mobile');
			$where_cond_['sm_number'] = $this->session->userdata('mobile');

			$data['get_osm_list'] = $this->cmodel->get_OSM(array_filter($sm_number),'osm_performance');

			if ( !($data['get_osm_list'])) {
				$data['get_without_OSM'] = $this->cmodel->get_table_user_list_wc('masters',$where_cond_,'sm_number','sm');
			}else{
				$data['get_without_OSM'] = '';
			}
			
		}
		$data['beat_'] = $this->cmodel->get_data('beat_mkt_master');

		$data['rs_'] = $this->cmodel->get_data_rs('rs_mkt_master','rs_code');
		$data['smlist_result'] = $this->cmodel->get_data_rs('rs_mkt_master','rs_code');

		echo json_encode($data);   
	}

	public function addsdeForm(){

		$files = $_FILES;

		if (isset( $_FILES["m_file"] ) && !empty( $_FILES["m_file"]["name"] ) ) {
        	$cpt = count(array_filter($_FILES['m_file']['name']));

		}else{
			$cpt =0;
		}
		$m_image='';

		if($cpt !=0){

			$number_of_files = sizeof($_FILES['m_file']['tmp_name']);
            $files = $_FILES['m_file'];
            $errors = array();

			for($i=0;$i<$number_of_files;$i++){
                if(sizeof($errors)==0){
					$this->load->library('upload');
                    $config['upload_path'] = './uploads/market_visit/sde_files/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';

                    for ($i = 0; $i < $number_of_files; $i++) {
                        $ext = pathinfo($files['name'][$i], PATHINFO_EXTENSION);

						$_FILES['uploadedimage']['name'] = rand().".".$ext;
                        $_FILES['uploadedimage']['type'] = $files['type'][$i];
                        $_FILES['uploadedimage']['tmp_name'] = $files['tmp_name'][$i];
                        $_FILES['uploadedimage']['error'] = $files['error'][$i];
                        $_FILES['uploadedimage']['size'] = $files['size'][$i];
                        $fileName[] = $_FILES['uploadedimage']['name'];

                        $this->upload->initialize($config);
                        if ($this->upload->do_upload('uploadedimage')){
                                
							$data['uploads'][$i] = $this->upload->data();
                        }
                        else {
                                $data['upload_errors'][$i] = $this->upload->display_errors();
                        }
                    }
				}
			}
			$m_image=implode(",",$fileName);
		}

		//RSSM Image Upload (Morning)
		
		$rssm_image='';
		if(!empty($_FILES['rssm_file']['name'])){
                
			$config['upload_path'] = APPPATH . '../uploads/market_visit/rssm_files';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size']     = '20000';
			$config['file_name'] = $_FILES['rssm_file']['name'];
			  
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			if($this->upload->do_upload('rssm_file')){
				$imageData = $this->upload->data();
				$fileName2 = $imageData['file_name'];
			}else{
				$imageData['upload_errors'] = $this->upload->display_errors();
			}
			$rssm_image = $fileName2;
		}


		//RSSM Image Upload (Evening )
		
		$rssm_eve_image='';
		if(!empty($_FILES['rssm_eve_file']['name'])){
                
			$config['upload_path'] = APPPATH . '../uploads/market_visit/rssm_eve_files';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size']     = '20000';
			$config['file_name'] = $_FILES['rssm_eve_file']['name'];
			  
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			if($this->upload->do_upload('rssm_eve_file')){
				$imageData2 = $this->upload->data();
				$fileName3 = $imageData2['file_name'];
			}else{
				$imageData2['upload_errors'] = $this->upload->display_errors();
			}
			$rssm_eve_image = $fileName3;
		}

		$get_cur_auto_id = $this->cmodel->cur_auto_id('sde_market_visit_report');
        $auto_id = "SDE".str_pad( ( $get_cur_auto_id+1 ), 5, 0, STR_PAD_LEFT);

		$where_cond['auto_id'] = $auto_id ;
		$where_cond['rssm_mkt'] = $this->input->post('rssm_mkt');
		$where_cond['beat_mkt'] = $this->input->post('beat_mkt');
		$where_cond['rs_mkt'] = $this->input->post('rs_mkt');
		$where_cond['total_calls_made'] = $this->input->post('total_calls');
		$where_cond['value'] = $this->input->post('value');
		$where_cond['billut'] = $this->input->post('billut');
		$where_cond['tlsd'] = $this->input->post('tlsd');
		$where_cond['feedback'] = $this->input->post('m_fdb');
		$where_cond['rssm_morn_file'] = $rssm_image;
		$where_cond['rssm_eve_file'] = $rssm_eve_image;
		$where_cond['image'] = $m_image;
		$where_cond['created_by'] = $this->session->userdata('mobile');
		
		$where_cond['created_on'] = date('Y-m-d H:i:s');
		$where_cond['updated_on'] = date('Y-m-d H:i:s');

		$addform_result = $this->cmodel->data_add('sde_market_visit_report',$where_cond);

        if($addform_result){
            $result = array(
                "logstatus" => "success",
            );
            echo json_encode($result);
        }
        else{
            $result = array(
                "logstatus" => "failed",
            );
            echo json_encode($result);
        }
	}	
	
	public function delete_image(){
		$id = $this->input->post('id');
		$value = $this->input->post('pass');

		if($value == 'morn_img'){
			$column = 'rssm_morn_file';

			$imag = $this->cmodel->get_sde_report_img_coldata('sde_market_visit_report' ,'id',$id , $column);
			$get_img = $imag[0]->rssm_morn_file;
			unlink(APPPATH . '../uploads/market_visit/rssm_files/'.$get_img);
		}else{
			$column = 'rssm_eve_file';

			$imag = $this->cmodel->get_sde_report_img_coldata('sde_market_visit_report' ,'id',$id , $column);
			$get_img = $imag[0]->rssm_eve_file;
			unlink(APPPATH . '../uploads/market_visit/rssm_eve_files/'.$get_img);
		}
		
		$data[$column] = "";
		$addform_result = $this->cmodel->delete_image('sde_market_visit_report',$id,$data);
		
		$result = array(
			"res" => "success", 
		);
		echo json_encode($result);
	}

	public function get_entered_market_visit_report(){
		$type="where";
		$where_cond = $this->session->userdata('mobile');
		$postData = $this->input->post();
		$get_entered_cwforms_result = $this->mtmodel->verify_data_market_visit_report($postData,$where_cond,$type);
		echo json_encode($get_entered_cwforms_result);
	}

	public function update_sdeform(){

		// $this->form_validation->set_rules('edit_rssm_file','edit_rssm_file' ,'required');

		//RSSM Image Upload (Evening )

		$rssm_eve_image='';
		if(!empty($_FILES['edit_rssm_eve_file']['name'])){
				
			$config['upload_path'] = APPPATH . '../uploads/market_visit/rssm_eve_files';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size']     = '20000';
			$config['file_name'] = $_FILES['edit_rssm_eve_file']['name'];
				
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			if($this->upload->do_upload('edit_rssm_eve_file')){
				$imageData2 = $this->upload->data();
				$fileName2 = $imageData2['file_name'];
			}else{
				$imageData2['upload_errors'] = $this->upload->display_errors();
			}
			$rssm_eve_image = $fileName2;
		}

		$id = $this->input->post('edit_id');
		if($rssm_eve_image != ""){
			$where_cond['rssm_eve_file'] = $rssm_eve_image;
		}
		$where_cond['feedback'] 		= $this->input->post('edit_feedback');
		
		$where_cond['total_calls_made'] = $this->input->post('edit_total_calls');
		$where_cond['value'] 			= $this->input->post('edit_value');
		$where_cond['billut'] 			= $this->input->post('edit_billut');
		$where_cond['tlsd'] 			= $this->input->post('edit_tlsd');
		$where_cond['updated_on'] 		= date('Y-m-d H:i:s');

		$editform_result = $this->cmodel->updates('sde_market_visit_report',$where_cond, 'id', $id);

		if($editform_result){
            $result = array(
                "logstatus" => "success",
            );
            echo json_encode($result);
        }
        else{
            $result = array(
                "logstatus" => "failed",
            );
            echo json_encode($result);
        }

	}

	public function get_business_list(){

        // $businesslist_result = $this->cmodel->get_business_user_list('users','business');
        $businesslist_result = $this->cmodel->get_business_user_list_m('masters','division');
        echo json_encode($businesslist_result);
    }

	public function get_zsm_list(){

        $where_cond['division'] = $this->input->post('business_value');
        // echo '<pre>';print_r($this->input->post('business_value'));die();

		$zsmlist_result = $this->cmodel->get_table_user_list('masters',$where_cond,'zsm_number','zsm');

        echo json_encode($zsmlist_result);
	}

	public function get_asm_list(){

        $where_cond['zsm_number'] = $this->input->post('zsm_number');
        $where_cond['division'] = $this->input->post('business');

		$asmlist_result = $this->cmodel->get_table_user_list_wc('masters',$where_cond,'asm_number','asm');

        echo json_encode($asmlist_result);
	}

	public function get_tso_list(){

        $where_cond['asm_number'] = $this->input->post('asm_number');
        // $where_cond['zsm_number'] = $this->input->post('zsm_number');

		$tsolist_result = $this->cmodel->get_table_user_list_wc('masters',$where_cond,'tso_number','tso');

        echo json_encode($tsolist_result);
	}

	public function get_sm_list(){

		if($this->input->post('asm_number') !="" ){
			$where_cond['asm_number'] = $this->input->post('asm_number');
		}else{
			$where_cond['tso_number'] = $this->input->post('tso_number');

		}
		$smlist_result = $this->cmodel->get_table_user_list_wc('masters',$where_cond,'sm_number','sm');

        echo json_encode($smlist_result);
	}



	public function get_pending_form(){
		$d = $this->input->post('s');
		// $date = date("Y-m-d", strtotime($d));
		// 	$get_pending_list = $this->mtmodel->get_pending_form_list($date);

		$get_ldate = $this->mtmodel->get_last_id('sde_market_visit_report'); 

		if( !empty($get_ldate) ){

			$dddd = $get_ldate[0]['created_on'];
			$date = date("Y-m-d", strtotime($dddd));

			$get_pending_list = $this->mtmodel->get_pending_form_list($date);

			$total_calls_made = $get_pending_list[0]['total_calls_made'];
			$value = $get_pending_list[0]['value'];
			$billut = $get_pending_list[0]['billut'];
			$tlsd = $get_pending_list[0]['tlsd'];

			$even_img = $get_pending_list[0]['rssm_eve_file'];
			$id = $get_pending_list[0]['id'];

			if($even_img == "" || $total_calls_made == "" || $value == "" || $billut =="" || $tlsd ==""){
				$result = array(
					"response" => "error", "id" => $id,
				);
			}else{
				$result = array(
					"response" => "success",
				);
			}

		}else{

			$result = array(
				"response" => "success",
			);
		}

		echo json_encode($result);
	}

	public function OSM_view()
	{
		$where_cond_tso['TSO_Number'] = $this->session->userdata('mobile');
		$smlist_result = $this->cmodel->get_role_list_id('masters','sm_number',$where_cond_tso,'sm_number','sm');
		
		$where_cond = array();
		if(count($smlist_result) !=0){
			for ($i=0; $i < count($smlist_result); $i++) { 
				array_push($where_cond, $smlist_result[$i]->sm_number);
			}
		}
		
		$data['get_sde_under_osm__'] = $this->mtmodel->get_sde_under_osm__('osm_performance',$where_cond,'ssfa_id');

		$this->load->view('market_visit/osm_under_sde',$data);
	}
	
	public function get_osm_details_under_sde()
	{
		$postData = $this->input->post();

		if($this->input->post('osm_number') !='') {
			$where_cond[] = $this->input->post('osm_number');

		}else{
			$where_cond_tso['TSO_Number'] = $this->session->userdata('mobile');
			$smlist_result = $this->cmodel->get_role_list_id('masters','sm_number',$where_cond_tso,'sm_number','sm');
			$where_cond = array();

			if(count($smlist_result) !=0){
				for ($i=0; $i < count($smlist_result); $i++) { 
					array_push($where_cond, $smlist_result[$i]->sm_number);
				}
			}
		}
		
		$osmlist_result = $this->cmodel->get_role_list_idd('osm_performance','ssfa_id',$where_cond,'ssfa_id');

		// if( empty($osmlist_result) ){
		// 	$get_sde_under_osm_ = '';
		// 	echo json_encode($get_sde_under_osm_);
		// }else{
			$where_cond2 = array();
			if(count($osmlist_result) !=0){
				for ($i=0; $i < count($osmlist_result); $i++) { 
					array_push($where_cond2, $osmlist_result[$i]->ssfa_id);
				}
			}
	
			$get_sde_under_osm_ = $this->mtmodel->get_osm_under_sde_details($postData,$where_cond2);
		// print_r($smlist_result);die();

			echo json_encode($get_sde_under_osm_);
		// }
		
	}


	public function get_osm_mv_details($mobil)
	{
		$postData = $this->input->post();

		$osm_mv_report = $this->mtmodel->get_osm_mv_report($postData,$mobil);
		
		// $osm_mv_report = $this->mtmodel->get_particular_osm_mv_report('sde_market_visit_report','created_by',$mobile);

		echo json_encode($osm_mv_report);
	}

	public function view_more($mobile)
	{
		$data['mobile'] = $mobile;
		$this->load->view('market_visit/osm_mv_report_file', $data);
	}

	
	public function get_sm_rssm_list(){

		$rs_val = $this->input->post('rs_val'); 

		if($this->session->userdata('role') == 'TSO'){
			$where_cond_rs['rs_code'] = $this->input->post('rs_val');
			$data['smlist_result'] = $this->cmodel->get_table_user_list_wc('rs_mkt_master',$where_cond_rs,'sm_mobile','sm_mobile');

			$sm_mobile = array();
			foreach($data['smlist_result'] as $each_row){
				$sm_mobile[] = $each_row->sm_mobile;
			}
			$data['get_osm_list'] = $this->cmodel->get_OSM(array_filter($sm_mobile),'osm_performance');

			if( !empty($data['get_osm_list']) ){
				foreach($data['get_osm_list'] as $_row){
					$ssfa_id[] = $_row->ssfa_id;
				}
		
				function compare_objects($obj_a, $obj_b) {
					return $obj_a - $obj_b;
				}
				$diff1 = array_udiff(array_filter($sm_mobile), $ssfa_id, 'compare_objects');
				// $diff1 = array_diff($ssfa_id,$sm_mobile);
				if(!empty($diff1)){
					$diff = $diff1;
					$data['get_without_OSM'] = $this->cmodel->get_without_OSM_rs($diff,'masters','sm_number','sm');
				}else{
					$data['get_without_OSM'] = '';
				}
			}else{
				$data['get_without_OSM'] = $this->cmodel->get_without_OSM_rs($sm_mobile,'masters','sm_number','sm');
			}
		}else{
			$sm_number[] = $this->session->userdata('mobile');
			$where_cond_['sm_number'] = $this->session->userdata('mobile');

			$data['get_osm_list'] = $this->cmodel->get_OSM(array_filter($sm_number),'osm_performance');

			if ( !($data['get_osm_list'])) {
				$data['get_without_OSM'] = $this->cmodel->get_table_user_list_wc('masters',$where_cond_,'sm_number','sm');
			}else{
				$data['get_without_OSM'] = '';
			}
		}
		
		echo json_encode($data);
	}
	

	public function get_rssm_beatlist()
	{
		$rssm_number['sm_mobile'] = $this->input->post('rssm_number'); 

		$data['beat_mkt'] = $this->cmodel->get_table_user_list('beat_mkt_master',$rssm_number,'beat_name','beat_name');
		echo json_encode($data);
	}



	// public function get_sm_rssm_list(){

	// 	$rs_val = $this->input->post('rs_val'); 

	// 	if($this->session->userdata('role') == 'TSO'){
	// 		$where_cond_tso['tso_number'] = $this->session->userdata('mobile');
	// 		$data['smlist_result'] = $this->cmodel->get_table_user_list_wc('masters',$where_cond_tso,'sm_number','sm');
			
	// 		$sm_number = array();
	// 		foreach($data['smlist_result'] as $each_row){
	// 			$sm_number[] = $each_row->sm_number;
	// 		}
	
	// 		$data['get_osm_list'] = $this->cmodel->get_OSM(array_filter($sm_number),'osm_performance');
	// 		foreach($data['get_osm_list'] as $_row){
	// 			$ssfa_id[] = $_row->ssfa_id;
	// 		}
	
	// 		function compare_objects($obj_a, $obj_b) {
	// 			return $obj_a - $obj_b;
	// 		}
	// 		$diff = array_udiff(array_filter($sm_number), $ssfa_id, 'compare_objects');
	// 		$data['get_without_OSM'] = $this->cmodel->get_without_OSM($diff,'masters',$where_cond_tso,'sm_number','sm');
	
	// 	}else{
	// 		$sm_number[] = $this->session->userdata('mobile');
	// 		$where_cond_['sm_number'] = $this->session->userdata('mobile');

	// 		$data['get_osm_list'] = $this->cmodel->get_OSM(array_filter($sm_number),'osm_performance');

	// 		if ( !($data['get_osm_list'])) {
	// 			$data['get_without_OSM'] = $this->cmodel->get_table_user_list_wc('masters',$where_cond_,'sm_number','sm');
	// 		}else{
	// 			$data['get_without_OSM'] = '';
	// 		}
	// 	}
	// 	echo json_encode($data);
	// }


}	
