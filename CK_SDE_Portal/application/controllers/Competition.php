<?php	
defined('BASEPATH') OR exit('No direct script access allowed');	
class Competition extends CI_Controller {	
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

        $this->load->model('Common_model', 'cmodel');
        $this->load->model('Competition_model', 'ctmodel');

		if ( !$this->session->userdata('logged_in')){ 	
			redirect(tso_portal_base_url(), 'refresh');	
			// redirect('http://localhost/CK_TSO_Portal/');
				
        }	
        	
    }	
	public function competition_watch(){	
		$this->load->view('ck_competition_watch/competition_watch');	
	}	
	
	public function competition_watch_report(){	
		$this->load->view('ck_competition_watch/competition_watch_report');	
	}	
	
	
	public function add_competition_watch(){	
		$this->load->view('ck_competition_watch/add_competition_watch');	
	}	
	
	// public function competition_watch_report_asm(){	
	// 	$this->load->view('competition_watch_report_asm');	
	// }	

	public function addcwForm(){

		$files = $_FILES;

		if (isset( $_FILES["cw_file"] ) && !empty( $_FILES["cw_file"]["name"] ) ) {
        	$cpt = count(array_filter($_FILES['cw_file']['name']));

		}else{
			$cpt =0;
		}
		$cw_image='';

		if($cpt !=0){

			$number_of_files = sizeof($_FILES['cw_file']['tmp_name']);
            $files = $_FILES['cw_file'];
            $errors = array();

			for($i=0;$i<$number_of_files;$i++){
                if(sizeof($errors)==0){
					$this->load->library('upload');
                    $config['upload_path'] = './uploads/competion_watch';
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

			$cw_image=implode(",",$fileName);

			
		}

		$get_cur_auto_id = $this->cmodel->cur_auto_id('cw_form');
        $auto_id = "CWF".str_pad( ( $get_cur_auto_id+1 ), 5, 0, STR_PAD_LEFT);

		$cw_insight_category =  implode("|",$this->input->post('cw_insight_category'));

		$where_cond['auto_id'] = $auto_id;
		$where_cond['cw_date'] = $this->input->post('cw_date');
		$where_cond['cw_source'] = $this->input->post('cw_source');
		$where_cond['cw_insight_category'] = $cw_insight_category;
		$where_cond['cw_comment'] = $this->input->post('cw_comment');
		$where_cond['cw_filename'] = $cw_image;
		$where_cond['created_by'] = $this->session->userdata('mobile');

		$addform_result = $this->cmodel->data_add('cw_form',$where_cond);

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

	public function get_entered_cwforms(){
		$postData = $this->input->post();
        
        $get_entered_cwforms_result = $this->ctmodel->verify_data_cwforms($postData);

        echo json_encode($get_entered_cwforms_result);
	}

	public function get_entered_cwforms_report(){
		$where_cond_dt = array();

		if($this->session->userdata('role_type') =='LEADER' || $this->session->userdata('role_type') =='Division Head'){
			if($this->input->post('zsm_number') !='' && $this->input->post('asm_number') =='' && $this->input->post('tso_number') =='' && $this->input->post('sm_number') ==''){
				// echo "1";
				$where_cond['zsm_number'] = $this->input->post('zsm_number');
	
				$tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond,'tso_number','tso');
	
				$smlist_result = $this->cmodel->get_role_list_id('masters','sm_number',$where_cond,'sm_number','sm');
	
				if(count($tsolist_result) !=0){
					for ($i=0; $i < count($tsolist_result); $i++) { 
						array_push($where_cond_dt,$tsolist_result[$i]->tso_number);
					}
				}
				if(count($smlist_result) !=0){
					for ($i=0; $i < count($smlist_result); $i++) { 
	
						array_push($where_cond_dt,$smlist_result[$i]->sm_number);
					}
				}
				$type="where";
				
				
			}
			elseif ($this->input->post('asm_number') !='' && $this->input->post('zsm_number') !='' &&  $this->input->post('tso_number') =='' && $this->input->post('sm_number') =='') {
				// echo "2";
				$where_cond['asm_number'] = $this->input->post('asm_number');
	
				$tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond,'tso_number','tso');
	
				$smlist_result = $this->cmodel->get_role_list_id('masters','sm_number',$where_cond,'sm_number','sm');
				
				if(count($tsolist_result) !=0){
					for ($i=0; $i < count($tsolist_result); $i++) { 
						array_push($where_cond_dt,$tsolist_result[$i]->tso_number);
					}
				}
				if(count($smlist_result) !=0){
					for ($i=0; $i < count($smlist_result); $i++) { 
	
						array_push($where_cond_dt,$smlist_result[$i]->sm_number);
					}
				}
				
				$type="where";
				
	
			}
			elseif ($this->input->post('tso_number') !='' && $this->input->post('sm_number') =='') {
				// echo "3";
				$where_cond['tso_number'] = $this->input->post('tso_number');
				$tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond,'tso_number','tso');
	
				if(count($tsolist_result) !=0){
					for ($i=0; $i < count($tsolist_result); $i++) { 
						array_push($where_cond_dt,$tsolist_result[$i]->tso_number);
					}
				}
				
				$type="where";
				
			}
			elseif($this->input->post('sm_number') !='') {
				// echo "4";
				$where_cond_dt[] = $this->input->post('sm_number');
				$type="where";
	
			}
			else{
				$type="not_where";
			}
		}
		elseif($this->session->userdata('role_type') == 'ZSM'){
			$type="where";

			if($this->input->post('asm_number') !='' && $this->input->post('tso_number') =='' && $this->input->post('sm_number') ==''){
				$where_cond['asm_number'] = $this->input->post('asm_number');
	
				$tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond,'tso_number','tso');
	
				$smlist_result = $this->cmodel->get_role_list_id('masters','sm_number',$where_cond,'sm_number','sm');
	
				if(count($tsolist_result) !=0){
					for ($i=0; $i < count($tsolist_result); $i++) { 
						array_push($where_cond_dt,$tsolist_result[$i]->tso_number);
					}
				}
				if(count($smlist_result) !=0){
					for ($i=0; $i < count($smlist_result); $i++) { 
	
						array_push($where_cond_dt,$smlist_result[$i]->sm_number);
					}
				}
			}
			elseif ($this->input->post('tso_number') !='' && $this->input->post('sm_number') =='') {
				$where_cond['tso_number'] = $this->input->post('tso_number');
				$tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond,'tso_number','tso');
	
				if(count($tsolist_result) !=0){
					for ($i=0; $i < count($tsolist_result); $i++) { 
						array_push($where_cond_dt,$tsolist_result[$i]->tso_number);
					}
				}
			}
			elseif($this->input->post('sm_number') !='') {
				$where_cond_dt[] = $this->input->post('sm_number');
	
			}
			else{

				$where_cond['zsm_number'] = $this->session->userdata('mobile');
	
				$tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond,'tso_number','tso');
	
				$smlist_result = $this->cmodel->get_role_list_id('masters','sm_number',$where_cond,'sm_number','sm');
	
				if(count($tsolist_result) !=0){
					for ($i=0; $i < count($tsolist_result); $i++) { 
						array_push($where_cond_dt,$tsolist_result[$i]->tso_number);
					}
				}
				if(count($smlist_result) !=0){
					for ($i=0; $i < count($smlist_result); $i++) { 
	
						array_push($where_cond_dt,$smlist_result[$i]->sm_number);
					}
				}
			}
		}
		elseif($this->session->userdata('role_type') == 'ASM'){
			$type="where";

			if ($this->input->post('tso_number') !='' && $this->input->post('sm_number') =='') {
				$where_cond['tso_number'] = $this->input->post('tso_number');
				$tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond,'tso_number','tso');
	
				if(count($tsolist_result) !=0){
					for ($i=0; $i < count($tsolist_result); $i++) { 
						array_push($where_cond_dt,$tsolist_result[$i]->tso_number);
					}
				}
			}
			elseif($this->input->post('sm_number') !='') {
				$where_cond_dt[] = $this->input->post('sm_number');
	
			}
			else{
				$where_cond['asm_number'] = $this->session->userdata('mobile');
	
				$tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond,'tso_number','tso');
	
				$smlist_result = $this->cmodel->get_role_list_id('masters','sm_number',$where_cond,'sm_number','sm');
	
				if(count($tsolist_result) !=0){
					for ($i=0; $i < count($tsolist_result); $i++) { 
						array_push($where_cond_dt,$tsolist_result[$i]->tso_number);
					}
				}
				if(count($smlist_result) !=0){
					for ($i=0; $i < count($smlist_result); $i++) { 
	
						array_push($where_cond_dt,$smlist_result[$i]->sm_number);
					}
				}
			}
		}
		elseif($this->session->userdata('role_type') == 'TSO'){

			$type="where";

			if($this->input->post('sm_number') !='') {
				$where_cond_dt[] = $this->input->post('sm_number');
	
			}
			else{
				$where_cond_dt[] = $this->session->userdata('mobile');

			}
		}
		
		$postData = $this->input->post();
        
		$get_entered_cwforms_result = $this->ctmodel->verify_data_cwforms_report($postData,$where_cond_dt,$type);

		echo json_encode($get_entered_cwforms_result);
	}

	public function get_zsm_list(){
		
		if($this->session->userdata('role_type') =='Division Head'){
			$where_cond['division'] = $this->session->userdata('business');

			$zsmlist_result = $this->cmodel->get_table_user_list_wc('masters',$where_cond,'zsm_number','zsm');

		}else{
			$where_cond['division'] = $this->input->post('business');
			// $zsmlist_result = $this->cmodel->get_table_user_list1('masters','zsm_number','zsm');
			$zsmlist_result = $this->cmodel->get_table_user_list_wc('masters',$where_cond,'zsm_number','zsm');
		}
        

        echo json_encode($zsmlist_result);
	}

	public function get_asm_list(){

        $where_cond['zsm_number'] = $this->input->post('zsm_number');

		$asmlist_result = $this->cmodel->get_table_user_list_wc('masters',$where_cond,'asm_number','asm');

        echo json_encode($asmlist_result);
	}

	public function get_tso_list(){

        $where_cond['asm_number'] = $this->input->post('asm_number');

		$tsolist_result = $this->cmodel->get_table_user_list_wc('masters',$where_cond,'tso_number','tso');

        echo json_encode($tsolist_result);
	}

	public function get_sm_list(){

		$where_cond['tso_number'] = $this->input->post('tso_number');

		$smlist_result = $this->cmodel->get_table_user_list_wc('masters',$where_cond,'sm_number','sm');

        echo json_encode($smlist_result);
	}

	public function addSupervisorcomment(){

		$where_cond['supervisor_comment'] = $this->input->post('supervisor_comment');
		// $where_cond['weightage'] = $this->input->post('weightage');
		$where_cond['weightage'] = '';

		$auto_id = $this->input->post('edit_row_id');

		$editform_result = $this->cmodel->updates('cw_form',$where_cond, 'auto_id', $auto_id);

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
}	