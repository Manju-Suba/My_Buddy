<?php	
defined('BASEPATH') OR exit('No direct script access allowed');	
class SSController extends CI_Controller {	
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

        $this->load->model('ss_recruitment/Common_model', 'cmodel');

		if ( !$this->session->userdata('logged_in')){ 	
			redirect(tso_portal_base_url(), 'refresh');	
			// redirect('http://localhost/CK_TSO_Portal/');
				
        }	
        	
    }	
    
	public function add_ss_rec_form(){	
		$this->load->view('ss_recruitment/SDE/add_ss_rec_form');	
	}	
	
	public function ss_entered_form(){	
		$this->load->view('ss_recruitment/SDE/ss_entered_form');	
	}	
	
	public function ss_funnel_form(){	
		$this->load->view('ss_recruitment/SDE/ss_funnel_form');	
	}	
	public function list_ss_key_form(){	
		$this->load->view('ss_recruitment/list_ss_key_form');	
	}	
	
	public function add_ss_key_form(){	
		$this->load->view('ss_recruitment/add_ss_key_form');	
	}	
	public function monthly_score_card_ss(){	
		$this->load->view('ss_recruitment/monthly_score_card_ss');	
	}
	
	
	public function get_state_list(){

		$where_cond['state_name !='] = '';

		$state_list_result = $this->cmodel->get_table_list('towns_details',$where_cond,'state_name','state_name');

        echo json_encode($state_list_result);
	}

	public function get_division_list(){

		$where_cond['district_name !='] = '';
		$where_cond['state_name'] = $this->input->post('state');

		$division_list_result = $this->cmodel->get_table_list('towns_details',$where_cond,'district_name','district_name');

        echo json_encode($division_list_result);
	}

	public function get_town_list(){

		$where_cond['town_name !='] = '';
		$where_cond['district_name'] = $this->input->post('division');

		$town_list_result = $this->cmodel->get_table_list('towns_details',$where_cond,'town_name','town_name');

        echo json_encode($town_list_result);
	}

	public function get_additional_details_list_new(){

		$current_rowid = $this->input->post('current_rowid');
		$where_cond_1['auto_id'] = $current_rowid;
		$form_list = $this->cmodel->verify_data('ss_recruitment_form',$where_cond_1);
		
		$where_cond_2['mobile'] = $form_list[0]->created_by;

		$business_info = $this->cmodel->verify_data('users',$where_cond_2);
		$where_cond['role_type'] = 'SS';
		$where_cond['business'] = $business_info[0]->business;
		//echo"<pre>";print_r($this->session->userdata('business'));die;
		$additional_details_list_result = $this->cmodel->verify_data('additional_info_recruit',$where_cond);

        echo json_encode($additional_details_list_result);
	}

	public function get_additional_details_list(){

		$where_cond['role_type'] = 'SS';
		$where_cond['business'] = $this->session->userdata('business');
		//echo"<pre>";print_r($this->session->userdata('business'));die;
		$additional_details_list_result = $this->cmodel->verify_data('additional_info_recruit',$where_cond);

        echo json_encode($additional_details_list_result);
	}

	public function get_additional_details_key_list(){

		$where_cond['role_type'] = 'KEY';
		$where_cond['business'] = 'SS_KEY';
		$additional_details_list_result = $this->cmodel->verify_data('additional_info_recruit',$where_cond);
		// print_r($this->db->last_query());die;
        echo json_encode($additional_details_list_result);
	}
	public function get_key_name_list(){

		$where_cond['rs_key_name !='] = '';

		$name_list_result = $this->cmodel->get_table_list('rs_keyperformance_name',$where_cond,'rs_key_name','id');
		// print_r($this->db->last_query());die;
        echo json_encode($name_list_result);
	}
	/*listing scorecard*/
	public function get_title_list(){

		// $postData_where['created_by'] = $this->session->mobile;
		$postData['key_name'] = $this->input->post('kay_name');
		// $postData['start_key_date'] = $this->input->post('startDate');
		$where_cond['role_type'] = 'RSKEY';
		$postData_where['status'] = 1;
		$filter_result = $this->cmodel->list_menu_forms($where_cond,$postData_where,$postData);
		// echo"<pre>";print_r($get_funnel_keyforms_result);die;

        echo json_encode($filter_result);
	}

	public function addSsForm(){
		
		$status = $this->input->post('save_status');
		$files = $_FILES;
		$resume='';

		if (isset( $_FILES["c_resume"] ) && !empty( $_FILES["c_resume"]["name"] ) ) {
            $files = $_FILES['c_resume'];
            $errors = array();
			
			if(sizeof($errors)==0){
				$this->load->library('upload');
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';

					$ext = pathinfo($files['name'], PATHINFO_EXTENSION);

					$_FILES['uploadedimage']['name'] = rand().".".$ext;
					$_FILES['uploadedimage']['type'] = $files['type'];
					$_FILES['uploadedimage']['tmp_name'] = $files['tmp_name'];
					$_FILES['uploadedimage']['error'] = $files['error'];
					$_FILES['uploadedimage']['size'] = $files['size'];
					$resume = $_FILES['uploadedimage']['name'];

					$this->upload->initialize($config);
					if ($this->upload->do_upload('uploadedimage')){
							
						$data['uploads'] = $this->upload->data();
					}
					else {
							$data['upload_errors'] = $this->upload->display_errors();
					}
			}

		}

		$get_cur_auto_id = $this->cmodel->cur_auto_id('ss_recruitment_form');
        $auto_id = "SSF".str_pad( ( $get_cur_auto_id+1 ), 5, 0, STR_PAD_LEFT);

		if(!empty($this->input->post('c_age_of_org'))){
			$get_c_age_of_org = explode(" | ",$this->input->post('c_age_of_org'));
			$c_age_of_org = $get_c_age_of_org[0];
			$c_age_of_org_point = $get_c_age_of_org[1];

			$where_cond['c_age_of_org'] = $c_age_of_org;
			$where_cond['c_age_of_org_point'] = $c_age_of_org_point;

		}
		
		if(!empty($this->input->post('c_comp_handled'))){
			$get_c_comp_handled = explode(" | ",$this->input->post('c_comp_handled'));
			$c_comp_handled = $get_c_comp_handled[0];
			$c_comp_handled_point = $get_c_comp_handled[1];
			
			$where_cond['c_comp_handled'] = $c_comp_handled;
			$where_cond['c_comp_handled_point'] = $c_comp_handled_point;

		}

		if(!empty($this->input->post('c_towns_serviced'))){
			$get_c_towns_serviced = explode(" | ",$this->input->post('c_towns_serviced'));
			$c_towns_serviced = $get_c_towns_serviced[0];
			$c_towns_serviced_point = $get_c_towns_serviced[1];
			$where_cond['c_towns_serviced'] = $c_towns_serviced;
			$where_cond['c_towns_serviced_point'] = $c_towns_serviced_point;

		}

		if(!empty($this->input->post('c_godown'))){
			$get_c_godown = explode(" | ",$this->input->post('c_godown'));
			$c_godown = $get_c_godown[0];
			$c_godown_point = $get_c_godown[1];
			$where_cond['c_godown'] = $c_godown;
			$where_cond['c_godown_point'] = $c_godown_point;
		}

		if(!empty($this->input->post('c_computer'))){
			$get_c_computer = explode(" | ",$this->input->post('c_computer'));
			$c_computer = $get_c_computer[0];
			$c_computer_point = $get_c_computer[1];
			$where_cond['c_computer'] = $c_computer;
			$where_cond['c_computer_point'] = $c_computer_point;
		}
		
		if(!empty($this->input->post('c_printer'))){
			$get_c_printer = explode(" | ",$this->input->post('c_printer'));
			$c_printer = $get_c_printer[0];
			$c_printer_point = $get_c_printer[1];

			$where_cond['c_printer'] = $c_printer;
			$where_cond['c_printer_point'] = $c_printer_point;
		}

		if(!empty($this->input->post('c_internet'))){
			$get_c_internet = explode(" | ",$this->input->post('c_internet'));
			$c_internet = $get_c_internet[0];
			$c_internet_point = $get_c_internet[1];

			$where_cond['c_internet'] = $c_internet;
			$where_cond['c_internet_point'] = $c_internet_point;
		}

		if(!empty($this->input->post('c_delivery_vehicle'))){
			$get_c_delivery_vehicle = explode(" | ",$this->input->post('c_delivery_vehicle'));
			$c_delivery_vehicle = $get_c_delivery_vehicle[0];
			$c_delivery_vehicle_point = $get_c_delivery_vehicle[1];
			$where_cond['c_delivery_vehicle'] = $c_delivery_vehicle;
			$where_cond['c_delivery_vehicle_point'] = $c_delivery_vehicle_point;
		}
		
		if(!empty($this->input->post('c_fut_inverstment'))){
			$get_c_fut_inverstment = explode(" | ",$this->input->post('c_fut_inverstment'));
			$c_fut_inverstment = $get_c_fut_inverstment[0];
			$c_fut_inverstment_point = $get_c_fut_inverstment[1];
			$where_cond['c_fut_inverstment'] = $c_fut_inverstment;
			$where_cond['c_fut_inverstment_point'] = $c_fut_inverstment_point;
		}
		
		if(!empty($this->input->post('c_prop_invol'))){
			$get_c_prop_invol = explode(" | ",$this->input->post('c_prop_invol'));
			$c_prop_invol = $get_c_prop_invol[0];
			$c_prop_invol_point = $get_c_prop_invol[1];
			
			$where_cond['c_prop_invol'] = $c_prop_invol;
			$where_cond['c_prop_invol_point'] = $c_prop_invol_point;
		}
		
		if(!empty($this->input->post('c_market_fb'))){
			$get_c_market_fb = explode(" | ",$this->input->post('c_market_fb'));
			$c_market_fb = $get_c_market_fb[0];
			$c_market_fb_point = $get_c_market_fb[1];

			$where_cond['c_market_fb'] = $c_market_fb;
			$where_cond['c_market_fb_point'] = $c_market_fb_point;
		}
		

		
		$where_cond['auto_id'] = $auto_id;
		$where_cond['c_name'] = $this->input->post('c_name');
		$where_cond['c_ex_ss_name'] = $this->input->post('c_ex_ss_name');
		$where_cond['c_mobile_no'] = $this->input->post('c_mobile_no');
		$where_cond['c_sname'] = $this->input->post('c_sname');
		$where_cond['c_gst_no'] = $this->input->post('c_gst_no');
		$where_cond['c_altmobile_no'] = $this->input->post('c_altmobile_no');
		$where_cond['c_address'] = $this->input->post('c_address');
		$where_cond['c_state'] = $this->input->post('c_state');
		$where_cond['c_division'] = $this->input->post('c_division');
		$where_cond['c_town'] = $this->input->post('c_town');
		$where_cond['c_resume'] = $resume;
		$where_cond['status'] = $status;
		$where_cond['va_status'] = 'Inprogress';
		$where_cond['asm_status'] = 'Inprogress';
		$where_cond['created_by'] = $this->session->userdata('mobile');

		$addform_result = $this->cmodel->data_add('ss_recruitment_form',$where_cond);

        if($addform_result){
            $result = array(
                "response" => "success",
            );
            echo json_encode($result);
        }
        else{
            $result = array(
                "response" => "failed",
            );
            echo json_encode($result);
        }
	}

	public function addssKeyForm(){

//echo "<pre>";print_r($this->session->userdata('mobile'));die;
		$get_cur_auto_id = $this->cmodel->cur_auto_id('ss_key_performance');
        $auto_id = "SSK".str_pad( ( $get_cur_auto_id+1 ), 5, 0, STR_PAD_LEFT);

	    if(!empty($this->input->post('key_stocks'))){
				$get_key_stocks = explode(" | ",$this->input->post('key_stocks'));
				$key_stocks = $get_key_stocks[0];
				$key_stocks_point = $get_key_stocks[1];

				$where_cond['key_stocks'] = $key_stocks;
				$where_cond['key_stocks_point'] = $key_stocks_point;

			}
		if(!empty($this->input->post('key_infra'))){
			$get_key_infra = explode(" | ",$this->input->post('key_infra'));
			$key_infra = $get_key_infra[0];
			$key_infra_point = $get_key_infra[1];

			$where_cond['key_infra'] = $key_infra;
			$where_cond['key_infra_point'] = $key_infra_point;

		}
		if(!empty($this->input->post('key_infra_delivery'))){
			$get_key_infra_delivery = explode(" | ",$this->input->post('key_infra_delivery'));
			$key_infra_delivery = $get_key_infra_delivery[0];
			$key_infra_delivery_point = $get_key_infra_delivery[1];

			$where_cond['key_infra_delivery'] = $key_infra_delivery;
			$where_cond['key_infra_delivery_point'] = $key_infra_delivery_point;

		}
		if(!empty($this->input->post('key_number'))){
			$get_key_number = explode(" | ",$this->input->post('key_number'));
			$key_number = $get_key_number[0];
			$key_number_point = $get_key_number[1];

			$where_cond['key_number'] = $key_number;
			$where_cond['key_number_point'] = $key_number_point;

		}
		if(!empty($this->input->post('key_order'))){
			$get_key_order = explode(" | ",$this->input->post('key_order'));
			$key_order = $get_key_order[0];
			$key_order_point = $get_key_order[1];

			$where_cond['key_order'] = $key_order;
			$where_cond['key_order_point'] = $key_order_point;

		}
		if(!empty($this->input->post('key_absenteeism'))){
			$get_key_absenteeism = explode(" | ",$this->input->post('key_absenteeism'));
			$key_absenteeism = $get_key_absenteeism[0];
			$key_absenteeism_point = $get_key_absenteeism[1];

			$where_cond['key_absenteeism'] = $key_absenteeism;
			$where_cond['key_absenteeism_point'] = $key_absenteeism_point;

		}
		if(!empty($this->input->post('key_absenteeism_actual'))){
			$get_key_absenteeism_actual = explode(" | ",$this->input->post('key_absenteeism_actual'));
			$key_absenteeism_actual = $get_key_absenteeism_actual[0];
			$key_absenteeism_actual_point = $get_key_absenteeism_actual[1];

			$where_cond['key_absenteeism_actual'] = $key_absenteeism_actual;
			$where_cond['key_absenteeism_actual_point'] = $key_absenteeism_actual_point;

		}
		if(!empty($this->input->post('key_npd'))){
			$get_key_npd = explode(" | ",$this->input->post('key_npd'));
			$key_npd = $get_key_npd[0];
			$key_npd_point = $get_key_npd[1];

			$where_cond['key_npd'] = $key_npd;
			$where_cond['key_npd_point'] = $key_npd_point;

		}
		if(!empty($this->input->post('key_financials'))){
			$get_key_financials = explode(" | ",$this->input->post('key_financials'));
			$key_financials = $get_key_financials[0];
			$key_financials_point = $get_key_financials[1];

			$where_cond['key_financials'] = $key_financials;
			$where_cond['key_financials_point'] = $key_financials_point;

		}
		if(!empty($this->input->post('key_infrastructure'))){
			$get_key_infrastructure = explode(" | ",$this->input->post('key_infrastructure'));
			$key_infrastructure = $get_key_infrastructure[0];
			$key_infrastructure_point = $get_key_infrastructure[1];

			$where_cond['key_infrastructure'] = $key_infrastructure;
			$where_cond['key_infrastructure_point'] = $key_infrastructure_point;

		}
		if(!empty($this->input->post('key_ssfa'))){
			$get_key_ssfa = explode(" | ",$this->input->post('key_ssfa'));
			$key_ssfa = $get_key_ssfa[0];
			$key_ssfa_point = $get_key_ssfa[1];

			$where_cond['key_ssfa'] = $key_ssfa;
			$where_cond['key_ssfa_point'] = $key_ssfa_point;

		}
		if(!empty($this->input->post('key_xdm'))){
			$get_key_xdm = explode(" | ",$this->input->post('key_xdm'));
			$key_xdm = $get_key_xdm[0];
			$key_xdm_point = $get_key_xdm[1];

			$where_cond['key_xdm'] = $key_xdm;
			$where_cond['key_xdm_point'] = $key_xdm_point;

		}
		if(!empty($this->input->post('key_issues_raised'))){
			$get_key_issues_raised = explode(" | ",$this->input->post('key_issues_raised'));
			$key_issues_raised = $get_key_issues_raised[0];
			$key_issues_raised_point = $get_key_issues_raised[1];

			$where_cond['key_issues_raised'] = $key_issues_raised;
			$where_cond['key_issues_raised_point'] = $key_issues_raised_point;

		}
		
		$a=$this->input->post('key_date');
		$split=explode('-',$a);
		// echo "<pre>";print_r($split);die;
		$strPickup = date('Y-m-d',strtotime($split[0]));
		$endPickup = date('Y-m-d',strtotime($split[1]));
		$where_cond['start_key_date']=$strPickup;
		$where_cond['end_key_date']=$endPickup;
		$where_cond['key_name'] = $this->input->post('key_name');
		$where_cond['auto_id'] = $auto_id;
		$where_cond['created_by'] = $this->session->userdata('mobile');

		$addform_result = $this->cmodel->data_add('ss_key_performance',$where_cond);
        if($addform_result){
            $result = array(
                "response" => "success",
            );
            echo json_encode($result);
        }
        else{
            $result = array(
                "response" => "failed",
            );
            echo json_encode($result);
        }
	}
	public function checkKeyDate(){

		$svalue['start_key_date']=$this->input->post('startDate');
		$svalue['key_name']=$this->input->post('key_name');
		$addform_result  = $this->cmodel->check_key_value('ss_key_performance',$svalue);
		// }

		foreach ($addform_result as $blog) {
        $count         = $blog->allcount; }

		// echo "<pre>";print_r($count);
          if($count >0 ){
            $result = array(
                "response" => "Failed",
            );
            echo json_encode($result);
        }
        else{
            $result = array(
                "response" => "success",
            );
            echo json_encode($result);
        }
	}

	public function get_entered_ssforms(){

		$postData_where['created_by'] = $this->session->mobile;
		$postData_where['status'] = 1;

		if($this->input->post('af_asm_status') !=''){
			$postData_where['asm_status'] = $this->input->post('af_asm_status');
		}
		if($this->input->post('af_va_status') !=''){
			$postData_where['va_status'] = $this->input->post('af_va_status');
		}

		$postData = $this->input->post();
        
        $get_entered_ssforms_result = $this->cmodel->verify_data_essforms($postData,$postData_where);

        echo json_encode($get_entered_ssforms_result);
	}

	public function get_funnel_ssforms(){

		$postData_where['created_by'] = $this->session->mobile;
		$postData_where['status'] = 0;

		$postData = $this->input->post();
        
        $get_funnel_sssmforms_result = $this->cmodel->verify_data_fssforms($postData,$postData_where);

        echo json_encode($get_funnel_sssmforms_result);
	}

	public function get_key_ssforms(){

		$postData_where= $this->session->mobile;
		// $postData_where['status'] = 0;

		$postData = $this->input->post();
        
        $get_funnel_keyforms_result = $this->cmodel->verify_data_keyssforms($postData,$postData_where);
        // echo"<pre>";print_r($get_funnel_keyforms_result);die;
        echo json_encode($get_funnel_keyforms_result);
	}
/*action pop-up*/
	public function get_adtdetails_ss(){

		$where_cond['auto_id'] = $this->input->post('table_row_id');

		$get_adtdetails_ss_sde_result = $this->cmodel->verify_data('ss_recruitment_form',$where_cond);
        
		$get_adtdetails_ss_vso_result = $this->cmodel->verify_data('ss_recruitment_form_vso',$where_cond);

		if(count($get_adtdetails_ss_vso_result) ==0){
			$vso_result = $get_adtdetails_ss_sde_result;
		}else{
			$vso_result = $get_adtdetails_ss_vso_result;
		}
		$result = array(
			"get_adtdetails_ss_sde_result" => $get_adtdetails_ss_sde_result,
			"get_adtdetails_ss_vso_result" => $vso_result,
		);
		echo json_encode($result);

	}
	public function get_adtkeydetails_ss(){

		$where_cond['auto_id'] = $this->input->post('table_row_id');

		$get_adtkeydetails_ss_result = $this->cmodel->verify_data('ss_key_performance',$where_cond);
        echo json_encode($get_adtkeydetails_ss_result);
	}

	public function edit_ss_rec_form(){
		$this->load->view('ss_recruitment/SDE/edit_ss_rec_form');
	}
	public function edit_ss_key_form(){
		$this->load->view('ss_recruitment/edit_ss_key_form');
	}

	public function get_ss_edit_form(){
		
		$where_cond['auto_id'] = $this->input->post('current_rowid');

		if($this->session->userdata('role') == 'VA'){
			$get_ss_edit_form_result = $this->cmodel->verify_data('ss_recruitment_form_vso',$where_cond);

			if(count($get_ss_edit_form_result)==0){
				$get_ss_edit_form_result = $this->cmodel->verify_data('ss_recruitment_form',$where_cond);
				
			}
		}else{
			$get_ss_edit_form_result = $this->cmodel->verify_data('ss_recruitment_form',$where_cond);

		}

        echo json_encode($get_ss_edit_form_result);
	}
	public function get_ss_key_edit_form(){
		
		$where_cond['auto_id'] = $this->input->post('current_rowid');

		$get_ss_key_edit_form_result = $this->cmodel->verify_data('ss_key_performance',$where_cond);

        echo json_encode($get_ss_key_edit_form_result);
	}

	public function editSsForm(){

		if($this->session->role =='VA'){
			// check record already exits
			$auto_id = $this->input->post('edit_row_id');

			$where_cond['auto_id'] = $auto_id;

			$get_ss_edit_form_count_result = $this->cmodel->verify_data('ss_recruitment_form_vso',$where_cond);
			
			if(count($get_ss_edit_form_count_result) ==0){
				$status = $this->input->post('save_status');
				$files = $_FILES;
				$resume='';

				if (isset( $_FILES["c_resume"] ) && !empty( $_FILES["c_resume"]["name"] ) ) {
					$files = $_FILES['c_resume'];
					$errors = array();
					
					if(sizeof($errors)==0){
						$this->load->library('upload');
						$config['upload_path'] = './uploads/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';

							$ext = pathinfo($files['name'], PATHINFO_EXTENSION);

							$_FILES['uploadedimage']['name'] = rand().".".$ext;
							$_FILES['uploadedimage']['type'] = $files['type'];
							$_FILES['uploadedimage']['tmp_name'] = $files['tmp_name'];
							$_FILES['uploadedimage']['error'] = $files['error'];
							$_FILES['uploadedimage']['size'] = $files['size'];
							$resume = $_FILES['uploadedimage']['name'];

							$this->upload->initialize($config);
							if ($this->upload->do_upload('uploadedimage')){
									
								$data['uploads'] = $this->upload->data();
							}
							else {
									$data['upload_errors'] = $this->upload->display_errors();
							}
					}

				}

				if(!empty($this->input->post('c_age_of_org'))){
					$get_c_age_of_org = explode(" | ",$this->input->post('c_age_of_org'));
					$c_age_of_org = $get_c_age_of_org[0];
					$c_age_of_org_point = $get_c_age_of_org[1];

					$where_cond['c_age_of_org'] = $c_age_of_org;
					$where_cond['c_age_of_org_point'] = $c_age_of_org_point;

				}
				
				if(!empty($this->input->post('c_comp_handled'))){
					$get_c_comp_handled = explode(" | ",$this->input->post('c_comp_handled'));
					$c_comp_handled = $get_c_comp_handled[0];
					$c_comp_handled_point = $get_c_comp_handled[1];
					
					$where_cond['c_comp_handled'] = $c_comp_handled;
					$where_cond['c_comp_handled_point'] = $c_comp_handled_point;

				}

				if(!empty($this->input->post('c_towns_serviced'))){
					$get_c_towns_serviced = explode(" | ",$this->input->post('c_towns_serviced'));
					$c_towns_serviced = $get_c_towns_serviced[0];
					$c_towns_serviced_point = $get_c_towns_serviced[1];
					$where_cond['c_towns_serviced'] = $c_towns_serviced;
					$where_cond['c_towns_serviced_point'] = $c_towns_serviced_point;

				}

				if(!empty($this->input->post('c_godown'))){
					$get_c_godown = explode(" | ",$this->input->post('c_godown'));
					$c_godown = $get_c_godown[0];
					$c_godown_point = $get_c_godown[1];
					$where_cond['c_godown'] = $c_godown;
					$where_cond['c_godown_point'] = $c_godown_point;
				}

				if(!empty($this->input->post('c_computer'))){
					$get_c_computer = explode(" | ",$this->input->post('c_computer'));
					$c_computer = $get_c_computer[0];
					$c_computer_point = $get_c_computer[1];
					$where_cond['c_computer'] = $c_computer;
					$where_cond['c_computer_point'] = $c_computer_point;
				}
				
				if(!empty($this->input->post('c_printer'))){
					$get_c_printer = explode(" | ",$this->input->post('c_printer'));
					$c_printer = $get_c_printer[0];
					$c_printer_point = $get_c_printer[1];

					$where_cond['c_printer'] = $c_printer;
					$where_cond['c_printer_point'] = $c_printer_point;
				}

				if(!empty($this->input->post('c_internet'))){
					$get_c_internet = explode(" | ",$this->input->post('c_internet'));
					$c_internet = $get_c_internet[0];
					$c_internet_point = $get_c_internet[1];

					$where_cond['c_internet'] = $c_internet;
					$where_cond['c_internet_point'] = $c_internet_point;
				}

				if(!empty($this->input->post('c_delivery_vehicle'))){
					$get_c_delivery_vehicle = explode(" | ",$this->input->post('c_delivery_vehicle'));
					$c_delivery_vehicle = $get_c_delivery_vehicle[0];
					$c_delivery_vehicle_point = $get_c_delivery_vehicle[1];
					$where_cond['c_delivery_vehicle'] = $c_delivery_vehicle;
					$where_cond['c_delivery_vehicle_point'] = $c_delivery_vehicle_point;
				}
				
				if(!empty($this->input->post('c_fut_inverstment'))){
					$get_c_fut_inverstment = explode(" | ",$this->input->post('c_fut_inverstment'));
					$c_fut_inverstment = $get_c_fut_inverstment[0];
					$c_fut_inverstment_point = $get_c_fut_inverstment[1];
					$where_cond['c_fut_inverstment'] = $c_fut_inverstment;
					$where_cond['c_fut_inverstment_point'] = $c_fut_inverstment_point;
				}
				
				if(!empty($this->input->post('c_prop_invol'))){
					$get_c_prop_invol = explode(" | ",$this->input->post('c_prop_invol'));
					$c_prop_invol = $get_c_prop_invol[0];
					$c_prop_invol_point = $get_c_prop_invol[1];
					
					$where_cond['c_prop_invol'] = $c_prop_invol;
					$where_cond['c_prop_invol_point'] = $c_prop_invol_point;
				}
				
				if(!empty($this->input->post('c_market_fb'))){
					$get_c_market_fb = explode(" | ",$this->input->post('c_market_fb'));
					$c_market_fb = $get_c_market_fb[0];
					$c_market_fb_point = $get_c_market_fb[1];

					$where_cond['c_market_fb'] = $c_market_fb;
					$where_cond['c_market_fb_point'] = $c_market_fb_point;
				}
				

				
				$where_cond['auto_id'] = $auto_id;
				$where_cond['c_name'] = $this->input->post('c_name');
				$where_cond['c_ex_ss_name'] = $this->input->post('c_ex_ss_name');
				$where_cond['c_mobile_no'] = $this->input->post('c_mobile_no');
				$where_cond['c_sname'] = $this->input->post('c_sname');
				$where_cond['c_gst_no'] = $this->input->post('c_gst_no');
				$where_cond['c_altmobile_no'] = $this->input->post('c_altmobile_no');
				$where_cond['c_address'] = $this->input->post('c_address');
				$where_cond['c_state'] = $this->input->post('c_state');
				$where_cond['c_division'] = $this->input->post('c_division');
				$where_cond['c_town'] = $this->input->post('c_town');
				$where_cond['c_resume'] = $resume;
				$where_cond['status'] = $status;
				$where_cond['va_status'] = 'Inprogress';
				$where_cond['asm_status'] = 'Inprogress';
				$where_cond['created_by'] = $this->session->userdata('mobile');

				$addform_result = $this->cmodel->data_add('ss_recruitment_form_vso',$where_cond);

				if($this->session->userdata('role') =='TSO' || $this->session->userdata('role') =='ASM' || $this->session->userdata('role') =='ZSM'){
					$url = 'ss_funnel_form';
				}
				elseif ($this->session->userdata('role') == 'VA') {
					$url = 'ss_eform_va';
				}
				else{
					$url ='';
				}

				if($addform_result){
					$result = array(
						"response" => "success",
						"url" =>$url
					);
					echo json_encode($result);
				}
				else{
					$result = array(
						"response" => "failed",
						"url" =>$url

					);
					echo json_encode($result);
				}

			}else{
				$status = $this->input->post('save_status');
				$files = $_FILES;
				$resume='';
		
				if (isset( $_FILES["c_resume"] ) && !empty( $_FILES["c_resume"]["name"] ) ) {
					$files = $_FILES['c_resume'];
					$errors = array();
					
					if(sizeof($errors)==0){
						$this->load->library('upload');
						$config['upload_path'] = './uploads/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';
		
							$ext = pathinfo($files['name'], PATHINFO_EXTENSION);
		
							$_FILES['uploadedimage']['name'] = rand().".".$ext;
							$_FILES['uploadedimage']['type'] = $files['type'];
							$_FILES['uploadedimage']['tmp_name'] = $files['tmp_name'];
							$_FILES['uploadedimage']['error'] = $files['error'];
							$_FILES['uploadedimage']['size'] = $files['size'];
							$resume = $_FILES['uploadedimage']['name'];
		
							$this->upload->initialize($config);
							if ($this->upload->do_upload('uploadedimage')){
									
								$data['uploads'] = $this->upload->data();
							}
							else {
									$data['upload_errors'] = $this->upload->display_errors();
							}
					}
		
				}
				
				$auto_id = $this->input->post('edit_row_id');
		
				if(!empty($this->input->post('c_age_of_org'))){
					$get_c_age_of_org = explode(" | ",$this->input->post('c_age_of_org'));
					$c_age_of_org = $get_c_age_of_org[0];
					$c_age_of_org_point = $get_c_age_of_org[1];
		
					$where_cond['c_age_of_org'] = $c_age_of_org;
					$where_cond['c_age_of_org_point'] = $c_age_of_org_point;
				}
				if(!empty($this->input->post('c_comp_handled'))){
					$get_c_comp_handled = explode(" | ",$this->input->post('c_comp_handled'));
					$c_comp_handled = $get_c_comp_handled[0];
					$c_comp_handled_point = $get_c_comp_handled[1];
		
					$where_cond['c_comp_handled'] = $c_comp_handled;
					$where_cond['c_comp_handled_point'] = $c_comp_handled_point;
				}
				if(!empty($this->input->post('c_towns_serviced'))){
					$get_c_towns_serviced = explode(" | ",$this->input->post('c_towns_serviced'));
					$c_towns_serviced = $get_c_towns_serviced[0];
					$c_towns_serviced_point = $get_c_towns_serviced[1];
		
					$where_cond['c_towns_serviced'] = $c_towns_serviced;
					$where_cond['c_towns_serviced_point'] = $c_towns_serviced_point;
				}
				if(!empty($this->input->post('c_godown'))){
					$get_c_godown = explode(" | ",$this->input->post('c_godown'));
					$c_godown = $get_c_godown[0];
					$c_godown_point = $get_c_godown[1];
		
					$where_cond['c_godown'] = $c_godown;
					$where_cond['c_godown_point'] = $c_godown_point;
				}
				if(!empty($this->input->post('c_computer'))){
					$get_c_computer = explode(" | ",$this->input->post('c_computer'));
					$c_computer = $get_c_computer[0];
					$c_computer_point = $get_c_computer[1];
		
					$where_cond['c_computer'] = $c_computer;
					$where_cond['c_computer_point'] = $c_computer_point;
				}
				if(!empty($this->input->post('c_printer'))){
					$get_c_printer = explode(" | ",$this->input->post('c_printer'));
					$c_printer = $get_c_printer[0];
					$c_printer_point = $get_c_printer[1];
		
					$where_cond['c_printer'] = $c_printer;
					$where_cond['c_printer_point'] = $c_printer_point;
				}
				if(!empty($this->input->post('c_internet'))){
					$get_c_internet = explode(" | ",$this->input->post('c_internet'));
					$c_internet = $get_c_internet[0];
					$c_internet_point = $get_c_internet[1];
		
					$where_cond['c_internet'] = $c_internet;
					$where_cond['c_internet_point'] = $c_internet_point;
		
				}
				if(!empty($this->input->post('c_delivery_vehicle'))){
					$get_c_delivery_vehicle = explode(" | ",$this->input->post('c_delivery_vehicle'));
					$c_delivery_vehicle = $get_c_delivery_vehicle[0];
					$c_delivery_vehicle_point = $get_c_delivery_vehicle[1];
		
					$where_cond['c_delivery_vehicle'] = $c_delivery_vehicle;
					$where_cond['c_delivery_vehicle_point'] = $c_delivery_vehicle_point;
				}
				if(!empty($this->input->post('c_fut_inverstment'))){
					$get_c_fut_inverstment = explode(" | ",$this->input->post('c_fut_inverstment'));
					$c_fut_inverstment = $get_c_fut_inverstment[0];
					$c_fut_inverstment_point = $get_c_fut_inverstment[1];
		
					$where_cond['c_fut_inverstment'] = $c_fut_inverstment;
					$where_cond['c_fut_inverstment_point'] = $c_fut_inverstment_point;
				}
				if(!empty($this->input->post('c_prop_invol'))){
					$get_c_prop_invol = explode(" | ",$this->input->post('c_prop_invol'));
					$c_prop_invol = $get_c_prop_invol[0];
					$c_prop_invol_point = $get_c_prop_invol[1];
		
					$where_cond['c_prop_invol'] = $c_prop_invol;
					$where_cond['c_prop_invol_point'] = $c_prop_invol_point;
				}
				if(!empty($this->input->post('c_market_fb'))){
					$get_c_market_fb = explode(" | ",$this->input->post('c_market_fb'));
					$c_market_fb = $get_c_market_fb[0];
					$c_market_fb_point = $get_c_market_fb[1];
		
					$where_cond['c_market_fb'] = $c_market_fb;
					$where_cond['c_market_fb_point'] = $c_market_fb_point;
				}
				
				$where_cond['c_name'] = $this->input->post('c_name');
				$where_cond['c_mobile_no'] = $this->input->post('c_mobile_no');
				$where_cond['c_sname'] = $this->input->post('c_sname');
				$where_cond['c_gst_no'] = $this->input->post('c_gst_no');
				$where_cond['c_altmobile_no'] = $this->input->post('c_altmobile_no');
				$where_cond['c_address'] = $this->input->post('c_address');
				$where_cond['c_state'] = $this->input->post('c_state');
				$where_cond['c_division'] = $this->input->post('c_division');
				$where_cond['c_town'] = $this->input->post('c_town');
				if($resume !=''){
					$where_cond['c_resume'] = $resume;
					
				}
				$where_cond['status'] = $status;
		
				// print_r($where_cond);
		
				$editform_result = $this->cmodel->updates('ss_recruitment_form_vso',$where_cond, 'auto_id', $auto_id);
		
				if($this->session->userdata('role') =='TSO' || $this->session->userdata('role') =='ASM' || $this->session->userdata('role') =='ZSM'){
					$url = 'ss_funnel_form';
				}
				elseif ($this->session->userdata('role') == 'VA') {
					$url = 'ss_eform_va';
				}
				else{
					$url ='';
				}
				if($editform_result){
					$result = array(
						"response" => "success",
						"url" => $url
					);
					echo json_encode($result);
				}
				else{
					$result = array(
						"response" => "failed",
						"url" => $url
					);
					echo json_encode($result);
				}
			}
		}else{
			$status = $this->input->post('save_status');
			$files = $_FILES;
			$resume='';
	
			if (isset( $_FILES["c_resume"] ) && !empty( $_FILES["c_resume"]["name"] ) ) {
				$files = $_FILES['c_resume'];
				$errors = array();
				
				if(sizeof($errors)==0){
					$this->load->library('upload');
					$config['upload_path'] = './uploads/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';
	
						$ext = pathinfo($files['name'], PATHINFO_EXTENSION);
	
						$_FILES['uploadedimage']['name'] = rand().".".$ext;
						$_FILES['uploadedimage']['type'] = $files['type'];
						$_FILES['uploadedimage']['tmp_name'] = $files['tmp_name'];
						$_FILES['uploadedimage']['error'] = $files['error'];
						$_FILES['uploadedimage']['size'] = $files['size'];
						$resume = $_FILES['uploadedimage']['name'];
	
						$this->upload->initialize($config);
						if ($this->upload->do_upload('uploadedimage')){
								
							$data['uploads'] = $this->upload->data();
						}
						else {
								$data['upload_errors'] = $this->upload->display_errors();
						}
				}
	
			}
			
			$auto_id = $this->input->post('edit_row_id');
	
			if(!empty($this->input->post('c_age_of_org'))){
				$get_c_age_of_org = explode(" | ",$this->input->post('c_age_of_org'));
				$c_age_of_org = $get_c_age_of_org[0];
				$c_age_of_org_point = $get_c_age_of_org[1];
	
				$where_cond['c_age_of_org'] = $c_age_of_org;
				$where_cond['c_age_of_org_point'] = $c_age_of_org_point;
			}
			if(!empty($this->input->post('c_comp_handled'))){
				$get_c_comp_handled = explode(" | ",$this->input->post('c_comp_handled'));
				$c_comp_handled = $get_c_comp_handled[0];
				$c_comp_handled_point = $get_c_comp_handled[1];
	
				$where_cond['c_comp_handled'] = $c_comp_handled;
				$where_cond['c_comp_handled_point'] = $c_comp_handled_point;
			}
			if(!empty($this->input->post('c_towns_serviced'))){
				$get_c_towns_serviced = explode(" | ",$this->input->post('c_towns_serviced'));
				$c_towns_serviced = $get_c_towns_serviced[0];
				$c_towns_serviced_point = $get_c_towns_serviced[1];
	
				$where_cond['c_towns_serviced'] = $c_towns_serviced;
				$where_cond['c_towns_serviced_point'] = $c_towns_serviced_point;
			}
			if(!empty($this->input->post('c_godown'))){
				$get_c_godown = explode(" | ",$this->input->post('c_godown'));
				$c_godown = $get_c_godown[0];
				$c_godown_point = $get_c_godown[1];
	
				$where_cond['c_godown'] = $c_godown;
				$where_cond['c_godown_point'] = $c_godown_point;
			}
			if(!empty($this->input->post('c_computer'))){
				$get_c_computer = explode(" | ",$this->input->post('c_computer'));
				$c_computer = $get_c_computer[0];
				$c_computer_point = $get_c_computer[1];
	
				$where_cond['c_computer'] = $c_computer;
				$where_cond['c_computer_point'] = $c_computer_point;
			}
			if(!empty($this->input->post('c_printer'))){
				$get_c_printer = explode(" | ",$this->input->post('c_printer'));
				$c_printer = $get_c_printer[0];
				$c_printer_point = $get_c_printer[1];
	
				$where_cond['c_printer'] = $c_printer;
				$where_cond['c_printer_point'] = $c_printer_point;
			}
			if(!empty($this->input->post('c_internet'))){
				$get_c_internet = explode(" | ",$this->input->post('c_internet'));
				$c_internet = $get_c_internet[0];
				$c_internet_point = $get_c_internet[1];
	
				$where_cond['c_internet'] = $c_internet;
				$where_cond['c_internet_point'] = $c_internet_point;
	
			}
			if(!empty($this->input->post('c_delivery_vehicle'))){
				$get_c_delivery_vehicle = explode(" | ",$this->input->post('c_delivery_vehicle'));
				$c_delivery_vehicle = $get_c_delivery_vehicle[0];
				$c_delivery_vehicle_point = $get_c_delivery_vehicle[1];
	
				$where_cond['c_delivery_vehicle'] = $c_delivery_vehicle;
				$where_cond['c_delivery_vehicle_point'] = $c_delivery_vehicle_point;
			}
			if(!empty($this->input->post('c_fut_inverstment'))){
				$get_c_fut_inverstment = explode(" | ",$this->input->post('c_fut_inverstment'));
				$c_fut_inverstment = $get_c_fut_inverstment[0];
				$c_fut_inverstment_point = $get_c_fut_inverstment[1];
	
				$where_cond['c_fut_inverstment'] = $c_fut_inverstment;
				$where_cond['c_fut_inverstment_point'] = $c_fut_inverstment_point;
			}
			if(!empty($this->input->post('c_prop_invol'))){
				$get_c_prop_invol = explode(" | ",$this->input->post('c_prop_invol'));
				$c_prop_invol = $get_c_prop_invol[0];
				$c_prop_invol_point = $get_c_prop_invol[1];
	
				$where_cond['c_prop_invol'] = $c_prop_invol;
				$where_cond['c_prop_invol_point'] = $c_prop_invol_point;
			}
			if(!empty($this->input->post('c_market_fb'))){
				$get_c_market_fb = explode(" | ",$this->input->post('c_market_fb'));
				$c_market_fb = $get_c_market_fb[0];
				$c_market_fb_point = $get_c_market_fb[1];
	
				$where_cond['c_market_fb'] = $c_market_fb;
				$where_cond['c_market_fb_point'] = $c_market_fb_point;
			}
			
			$where_cond['c_name'] = $this->input->post('c_name');
			$where_cond['c_mobile_no'] = $this->input->post('c_mobile_no');
			$where_cond['c_sname'] = $this->input->post('c_sname');
			$where_cond['c_gst_no'] = $this->input->post('c_gst_no');
			$where_cond['c_altmobile_no'] = $this->input->post('c_altmobile_no');
			$where_cond['c_address'] = $this->input->post('c_address');
			$where_cond['c_state'] = $this->input->post('c_state');
			$where_cond['c_division'] = $this->input->post('c_division');
			$where_cond['c_town'] = $this->input->post('c_town');
			if($resume !=''){
				$where_cond['c_resume'] = $resume;
				
			}
			$where_cond['status'] = $status;
	
			// print_r($where_cond);
	
			$editform_result = $this->cmodel->updates('ss_recruitment_form',$where_cond, 'auto_id', $auto_id);
	
			if($editform_result){
				$result = array(
					"response" => "success",
					"url" => "ss_funnel_form"
				);
				echo json_encode($result);
			}
			else{
				$result = array(
					"response" => "failed",
					"url" => "ss_funnel_form"
				);
				echo json_encode($result);
			}
		}
		
	}

	public function editKeySsForm(){
		
        $auto_id = $this->input->post('edit_row_id');
// echo "string";print_r($auto_id);die;

		if(!empty($this->input->post('key_stocks'))){
				$get_key_stocks = explode(" | ",$this->input->post('key_stocks'));
				$key_stocks = $get_key_stocks[0];
				$key_stocks_point = $get_key_stocks[1];

				$where_cond['key_stocks'] = $key_stocks;
				$where_cond['key_stocks_point'] = $key_stocks_point;

			}
		if(!empty($this->input->post('key_infra'))){
			$get_key_infra = explode(" | ",$this->input->post('key_infra'));
			$key_infra = $get_key_infra[0];
			$key_infra_point = $get_key_infra[1];

			$where_cond['key_infra'] = $key_infra;
			$where_cond['key_infra_point'] = $key_infra_point;

		}
		if(!empty($this->input->post('key_infra_delivery'))){
			$get_key_infra_delivery = explode(" | ",$this->input->post('key_infra_delivery'));
			$key_infra_delivery = $get_key_infra_delivery[0];
			$key_infra_delivery_point = $get_key_infra_delivery[1];

			$where_cond['key_infra_delivery'] = $key_infra_delivery;
			$where_cond['key_infra_delivery_point'] = $key_infra_delivery_point;

		}
		if(!empty($this->input->post('key_number'))){
			$get_key_number = explode(" | ",$this->input->post('key_number'));
			$key_number = $get_key_number[0];
			$key_number_point = $get_key_number[1];

			$where_cond['key_number'] = $key_number;
			$where_cond['key_number_point'] = $key_number_point;

		}
		if(!empty($this->input->post('key_order'))){
			$get_key_order = explode(" | ",$this->input->post('key_order'));
			$key_order = $get_key_order[0];
			$key_order_point = $get_key_order[1];

			$where_cond['key_order'] = $key_order;
			$where_cond['key_order_point'] = $key_order_point;

		}
		if(!empty($this->input->post('key_absenteeism'))){
			$get_key_absenteeism = explode(" | ",$this->input->post('key_absenteeism'));
			$key_absenteeism = $get_key_absenteeism[0];
			$key_absenteeism_point = $get_key_absenteeism[1];

			$where_cond['key_absenteeism'] = $key_absenteeism;
			$where_cond['key_absenteeism_point'] = $key_absenteeism_point;

		}
		if(!empty($this->input->post('key_absenteeism_actual'))){
			$get_key_absenteeism_actual = explode(" | ",$this->input->post('key_absenteeism_actual'));
			$key_absenteeism_actual = $get_key_absenteeism_actual[0];
			$key_absenteeism_actual_point = $get_key_absenteeism_actual[1];

			$where_cond['key_absenteeism_actual'] = $key_absenteeism_actual;
			$where_cond['key_absenteeism_actual_point'] = $key_absenteeism_actual_point;

		}
		if(!empty($this->input->post('key_npd'))){
			$get_key_npd = explode(" | ",$this->input->post('key_npd'));
			$key_npd = $get_key_npd[0];
			$key_npd_point = $get_key_npd[1];

			$where_cond['key_npd'] = $key_npd;
			$where_cond['key_npd_point'] = $key_npd_point;

		}
		if(!empty($this->input->post('key_financials'))){
			$get_key_financials = explode(" | ",$this->input->post('key_financials'));
			$key_financials = $get_key_financials[0];
			$key_financials_point = $get_key_financials[1];

			$where_cond['key_financials'] = $key_financials;
			$where_cond['key_financials_point'] = $key_financials_point;

		}
		if(!empty($this->input->post('key_infrastructure'))){
			$get_key_infrastructure = explode(" | ",$this->input->post('key_infrastructure'));
			$key_infrastructure = $get_key_infrastructure[0];
			$key_infrastructure_point = $get_key_infrastructure[1];

			$where_cond['key_infrastructure'] = $key_infrastructure;
			$where_cond['key_infrastructure_point'] = $key_infrastructure_point;

		}
		if(!empty($this->input->post('key_ssfa'))){
			$get_key_ssfa = explode(" | ",$this->input->post('key_ssfa'));
			$key_ssfa = $get_key_ssfa[0];
			$key_ssfa_point = $get_key_ssfa[1];

			$where_cond['key_ssfa'] = $key_ssfa;
			$where_cond['key_ssfa_point'] = $key_ssfa_point;

		}
		if(!empty($this->input->post('key_xdm'))){
			$get_key_xdm = explode(" | ",$this->input->post('key_xdm'));
			$key_xdm = $get_key_xdm[0];
			$key_xdm_point = $get_key_xdm[1];

			$where_cond['key_xdm'] = $key_xdm;
			$where_cond['key_xdm_point'] = $key_xdm_point;

		}
		if(!empty($this->input->post('key_issues_raised'))){
			$get_key_issues_raised = explode(" | ",$this->input->post('key_issues_raised'));
			$key_issues_raised = $get_key_issues_raised[0];
			$key_issues_raised_point = $get_key_issues_raised[1];

			$where_cond['key_issues_raised'] = $key_issues_raised;
			$where_cond['key_issues_raised_point'] = $key_issues_raised_point;

		}
		// print_r($where_cond);die;

		$editform_result = $this->cmodel->updates('ss_key_performance',$where_cond, 'auto_id', $auto_id);

        if($editform_result){
            $result = array(
                "response" => "success",
                "url" => "list_ss_key_form"
            );
            echo json_encode($result);
        }
        else{
            $result = array(
                "response" => "failed",
                "url" => "SSController/list_ss_key_form"
            );
            echo json_encode($result);
        }
	}
}	
