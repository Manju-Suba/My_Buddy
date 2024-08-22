<?php	
defined('BASEPATH') OR exit('No direct script access allowed');	
class RSController extends CI_Controller {	
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

		if ( !$this->session->userdata('logged_in')){ 	
			redirect(tso_portal_base_url(), 'refresh');	
			// redirect('http://localhost/CK_TSO_Portal/');
				
        }	
        	
    }	
    
	public function add_rs_rec_form(){	
		$this->load->view('rsfunnel/SDE/add_rs_rec_form');	
	}	
	
	public function rs_entered_form(){	
		$this->load->view('rsfunnel/SDE/rs_entered_form');	
	}

	public function rs_funnel_form(){	
		$this->load->view('rsfunnel/SDE/rs_funnel_form');	
	}
	public function list_rs_key_form(){	
		$this->load->view('rsfunnel/list_rs_key_form');	
	}
	public function monthly_score_card(){	
		$this->load->view('rsfunnel/monthly_score_card');	
	}	
	
	public function add_rs_key_form(){	
		$this->load->view('rsfunnel/add_rs_key_form');	
	}	
	
	public function edit_rs_key_form(){
		$this->load->view('rsfunnel/edit_rs_key_form');
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

	public function get_additional_details_list(){

		$where_cond['role_type'] = 'RS';
		$where_cond['business'] = $this->session->userdata('business');

		$additional_details_list_result = $this->cmodel->verify_data1('additional_info_recruit',$where_cond);

        echo json_encode($additional_details_list_result);
	}

	public function get_additional_details_list_new(){

		$current_rowid = $this->input->post('current_rowid');
		$where_cond_1['auto_id'] = $current_rowid;
		$form_list = $this->cmodel->verify_data1('rs_recruitment_form',$where_cond_1);
		
		$where_cond_2['mobile'] = $form_list[0]->created_by;

		$business_info = $this->cmodel->verify_data1('users',$where_cond_2);

		$where_cond['role_type'] = 'RS';
		$where_cond['business'] = $business_info[0]->business;

		$additional_details_list_result = $this->cmodel->verify_data1('additional_info_recruit',$where_cond);

        echo json_encode($additional_details_list_result);
	}

	public function get_additional_details_key_list(){
// print_r(1);die();
		$where_cond['role_type'] = 'RSKEY';
		$where_cond['business'] = 'RS_KEY';
		$additional_details_list_result = $this->cmodel->verify_data1('additional_info_recruit',$where_cond);
		// print_r($this->db->last_query());die;
        echo json_encode($additional_details_list_result);
	}
	public function get_key_name_list(){

		$where_cond['rs_key_name !='] = '';

		$name_list_result = $this->cmodel->get_table_list('rs_keyperformance_name',$where_cond,'rs_key_name','id');
		// print_r($this->db->last_query());die;
        echo json_encode($name_list_result);
	}

	public function get_rs_key_edit_form(){
		
		$where_cond['auto_id'] = $this->input->post('current_rowid');

		$get_rs_key_edit_form_result = $this->cmodel->verify_data1('rs_key_performance',$where_cond);
		/*print_r($this->db->last_query());die;*/
        echo json_encode($get_rs_key_edit_form_result);
	}
	public function get_key_rsforms(){

		$postData_where= $this->session->mobile;
		$postData = $this->input->post();
        // echo"list<pre>";print_r($postData);die;
        $get_funnel_keyforms_result = $this->cmodel->verify_data_keyrsforms($postData,$postData_where);
        echo json_encode($get_funnel_keyforms_result);
	}
/*listing scorecard*/
	public function get_title_list(){

		// $postData_where['created_by'] = $this->session->mobile;
		$postData['key_name'] = $this->input->post('kay_name');
		// $postData['start_key_date'] = $this->input->post('startDate');
		// echo"<pre>";print_r($postData);die;
		$where_cond['role_type'] = 'RSKEY';
		$postData_where['status'] = 1;
		$filter_result = $this->cmodel->list_menu_forms($where_cond,$postData_where,$postData);
		// echo"<pre>";print_r($get_funnel_keyforms_result);die;

        echo json_encode($filter_result);
	}

	public function addRsForm(){
		
		$status = $this->input->post('save_status');
		$files = $_FILES;
		$resume='';

		if (isset( $_FILES["c_resume"] ) && !empty( $_FILES["c_resume"]["name"] ) ) {
            $files = $_FILES['c_resume'];
            $errors = array();
			
			if(sizeof($errors)==0){
				$this->load->library('upload');
				$config['upload_path'] = './uploads/rsfunnel/';
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

		$get_cur_auto_id = $this->cmodel->cur_auto_id('rs_recruitment_form');
        $auto_id = "RSF".str_pad( ( $get_cur_auto_id+1 ), 5, 0, STR_PAD_LEFT);

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
		if(!empty($this->input->post('c_retail_serviced'))){
			$get_c_retail_serviced = explode(" | ",$this->input->post('c_retail_serviced'));
			$c_retail_serviced = $get_c_retail_serviced[0];
			$c_retail_serviced_point = $get_c_retail_serviced[1];
			$where_cond['c_retail_serviced'] = $c_retail_serviced;
			$where_cond['c_retail_serviced_point'] = $c_retail_serviced_point;

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
		$where_cond['c_ex_rs_name'] = $this->input->post('c_ex_rs_name');
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

		$addform_result = $this->cmodel->data_add('rs_recruitment_form',$where_cond);

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

	public function addrsKeyForm(){

//echo "<pre>";print_r($this->session->userdata('mobile'));die;
		$get_cur_auto_id = $this->cmodel->cur_auto_id('rs_key_performance');
        $auto_id = "RSK".str_pad( ( $get_cur_auto_id+1 ), 5, 0, STR_PAD_LEFT);

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
		if(!empty($this->input->post('key_ffabsenteeism'))){
			$get_key_ffabsenteeism = explode(" | ",$this->input->post('key_ffabsenteeism'));
			$key_ffabsenteeism = $get_key_ffabsenteeism[0];
			$key_ffabsenteeism_point = $get_key_ffabsenteeism[1];

			$where_cond['key_ffabsenteeism'] = $key_ffabsenteeism;
			$where_cond['key_ffabsenteeism_point'] = $key_ffabsenteeism_point;

		}
		if(!empty($this->input->post('key_ffabsenteeism_actual'))){
			$get_key_ffabsenteeism_actual = explode(" | ",$this->input->post('key_ffabsenteeism_actual'));
			$key_ffabsenteeism_actual = $get_key_ffabsenteeism_actual[0];
			$key_ffabsenteeism_actual_point = $get_key_ffabsenteeism_actual[1];

			$where_cond['key_ffabsenteeism_actual'] = $key_ffabsenteeism_actual;
			$where_cond['key_ffabsenteeism_actual_point'] = $key_ffabsenteeism_actual_point;

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
		// $prop = 'week-picker';

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
		$addform_result = $this->cmodel->data_add('rs_key_performance',$where_cond);
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
		// echo'<pre>';print_r($svalue);die;
		// if (!empty($svalue['start_key_date']) && !empty($svalue['key_name'] ) ) {
		$addform_result  = $this->cmodel->check_key_value('rs_key_performance',$svalue);
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

	public function get_entered_rsforms(){

		$postData_where['created_by'] = $this->session->mobile;
		$postData_where['status'] = 1;

		if($this->input->post('af_va_status') !=''){
			$postData_where['va_status'] = $this->input->post('af_va_status');
		}
		if($this->input->post('af_asm_status') !=''){
			$postData_where['asm_status'] = $this->input->post('af_asm_status');
		}
		
		$postData = $this->input->post();
        
        $get_entered_rsforms_result = $this->cmodel->verify_data_ersforms($postData,$postData_where);

        echo json_encode($get_entered_rsforms_result);
	}

	public function get_funnel_rsforms(){

		$postData_where['created_by'] = $this->session->mobile;
		$postData_where['status'] = 0;

		$postData = $this->input->post();
        
        $get_funnel_rssmforms_result = $this->cmodel->verify_data_frsforms($postData,$postData_where);

        echo json_encode($get_funnel_rssmforms_result);
	}

	public function get_adtdetails_rs(){

		$where_cond['auto_id'] = $this->input->post('table_row_id');

		$get_adtdetails_rs_sde_result = $this->cmodel->verify_data1('rs_recruitment_form',$where_cond);

		$get_adtdetails_rs_vso_result = $this->cmodel->verify_data1('rs_recruitment_form_vso',$where_cond);

		if(count($get_adtdetails_rs_vso_result) ==0){
			$vso_result = $get_adtdetails_rs_sde_result;
		}else{
			$vso_result = $get_adtdetails_rs_vso_result;
		}
		$result = array(
			"get_adtdetails_rs_sde_result" => $get_adtdetails_rs_sde_result,
			"get_adtdetails_rs_vso_result" => $vso_result,
		);

        echo json_encode($result);
	}

	public function edit_rs_rec_form(){
		$this->load->view('rsfunnel/SDE/edit_rs_rec_form');
	}

	public function get_rs_edit_form(){
		
		$where_cond['auto_id'] = $this->input->post('current_rowid');

		if($this->session->userdata('role') == 'VA'){
			$get_rs_edit_form_result = $this->cmodel->verify_data1('rs_recruitment_form_vso',$where_cond);

			if(count($get_rs_edit_form_result)==0){
				$get_rs_edit_form_result = $this->cmodel->verify_data1('rs_recruitment_form',$where_cond);
				
			}
		}else{
			$get_rs_edit_form_result = $this->cmodel->verify_data1('rs_recruitment_form',$where_cond);

		}

        echo json_encode($get_rs_edit_form_result);
	}
	public function get_adtkeydetails_rs(){

		$where_cond['auto_id'] = $this->input->post('table_row_id');

		$get_adtkeydetails_rs_result = $this->cmodel->verify_data1('rs_key_performance',$where_cond);
        echo json_encode($get_adtkeydetails_rs_result);
	}

	public function editRsForm(){

		if($this->session->role =='VA'){
			// check record already exits
			$auto_id = $this->input->post('edit_row_id');

			$where_cond['auto_id'] = $auto_id;

			$get_rs_edit_form_count_result = $this->cmodel->verify_data('rs_recruitment_form_vso',$where_cond);
			
			if(count($get_rs_edit_form_count_result) ==0){
				
				$status = $this->input->post('save_status');
				$files = $_FILES;
				$resume='';

				if (isset( $_FILES["c_resume"] ) && !empty( $_FILES["c_resume"]["name"] ) ) {
					$files = $_FILES['c_resume'];
					$errors = array();
					
					if(sizeof($errors)==0){
						$this->load->library('upload');
						$config['upload_path'] = './uploads/rsfunnel/';
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
				if(!empty($this->input->post('c_retail_serviced'))){
					$get_c_retail_serviced = explode(" | ",$this->input->post('c_retail_serviced'));
					$c_retail_serviced = $get_c_retail_serviced[0];
					$c_retail_serviced_point = $get_c_retail_serviced[1];
					$where_cond['c_retail_serviced'] = $c_retail_serviced;
					$where_cond['c_retail_serviced_point'] = $c_retail_serviced_point;

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
				$where_cond['c_ex_rs_name'] = $this->input->post('c_ex_rs_name');
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

				$addform_result = $this->cmodel->data_add('rs_recruitment_form_vso',$where_cond);

				if($this->session->userdata('role') =='TSO' || $this->session->userdata('role') =='ASM' || $this->session->userdata('role') =='ZSM'){
					$url = 'RSController/rs_funnel_form';
				}
				elseif ($this->session->userdata('role') == 'VA') {
					$url = 'rs_eform_va';
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
						$config['upload_path'] = './uploads/rsfunnel/';
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

				if(!empty($this->input->post('c_experience'))){
					$get_experience = explode(" | ",$this->input->post('c_experience'));
					$experience = $get_experience[0];
					$exp_point = $get_experience[1];
					$where_cond['experience'] = $experience;
					$where_cond['exp_point'] = $exp_point;
				}
				if(!empty($this->input->post('c_education'))){
					$get_education = explode(" | ",$this->input->post('c_education'));
					$education = $get_education[0];
					$edu_point = $get_education[1];
					$where_cond['education'] = $education;
					$where_cond['edu_point'] = $edu_point;
				}
				if(!empty($this->input->post('c_age'))){
					$get_age = explode(" | ",$this->input->post('c_age'));
					$age = $get_age[0];
					$age_point = $get_age[1];
					$where_cond['age'] = $age;
					$where_cond['age_point'] = $age_point;
				}
				if(!empty($this->input->post('c_tknowledge'))){
					$get_tknowledge = explode(" | ",$this->input->post('c_tknowledge'));
					$tknowledge = $get_tknowledge[0];
					$tk_point = $get_tknowledge[1];
					$where_cond['terrain_knowledge'] = $tknowledge;
					$where_cond['tk_point'] = $tk_point;
				}
				if(!empty($this->input->post('c_tech_adaption'))){
					$get_tech_adaption = explode(" | ",$this->input->post('c_tech_adaption'));
					$tech_adaption = $get_tech_adaption[0];
					$ta_point = $get_tech_adaption[1];
					$where_cond['tech_adoption'] = $tech_adaption;
					$where_cond['ta_point'] = $ta_point;
				}
				if(!empty($this->input->post('c_familybg'))){
					$get_familybg = explode(" | ",$this->input->post('c_familybg'));
					$tech_familybg = $get_familybg[0];
					$fb_point = $get_familybg[1];
					$where_cond['family_bg'] = $tech_familybg;
					$where_cond['fb_point'] = $fb_point;
				}
				
				$where_cond['name'] = $this->input->post('c_name');
				$where_cond['ex_rssm_name'] = $this->input->post('c_ex_rssm_name');
				$where_cond['mobile_no'] = $this->input->post('c_mobile_no');
				$where_cond['alt_mobile_no'] = $this->input->post('c_altmobile_no');
				$where_cond['address'] = $this->input->post('c_address');
				$where_cond['state'] = $this->input->post('c_state');
				$where_cond['division'] = $this->input->post('c_division');
				$where_cond['town'] = $this->input->post('c_town');
				if($resume !=''){
					$where_cond['resume'] = $resume;
					
				}
				
				$where_cond['status'] = $status;

				// print_r($where_cond);

				$editform_result = $this->cmodel->updates('rs_recruitment_form_vso',$where_cond, 'auto_id', $auto_id);

				if($this->session->userdata('role') =='TSO' || $this->session->userdata('role') =='ASM' || $this->session->userdata('role') =='ZSM'){
					$url = 'RSController/rs_funnel_form';
				}
				elseif ($this->session->userdata('role') == 'VA') {
					$url = 'rs_eform_va';
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
			exit;
		}else{

			$status = $this->input->post('save_status');
			$files = $_FILES;
			$resume='';

			if (isset( $_FILES["c_resume"] ) && !empty( $_FILES["c_resume"]["name"] ) ) {
				$files = $_FILES['c_resume'];
				$errors = array();
				
				if(sizeof($errors)==0){
					$this->load->library('upload');
					$config['upload_path'] = './uploads/rsfunnel/';
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
			if(!empty($this->input->post('c_retail_serviced'))){
				$get_c_retail_serviced = explode(" | ",$this->input->post('c_retail_serviced'));
				$c_retail_serviced = $get_c_retail_serviced[0];
				$c_retail_serviced_point = $get_c_retail_serviced[1];
				$where_cond['c_retail_serviced'] = $c_retail_serviced;
				$where_cond['c_retail_serviced_point'] = $c_retail_serviced_point;

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
			$where_cond['c_ex_rs_name'] = $this->input->post('c_ex_rs_name');
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

			$editform_result = $this->cmodel->updates('rs_recruitment_form',$where_cond, 'auto_id', $auto_id);

			if($editform_result){
				$result = array(
					"response" => "success",
					"url" => "RSController/rs_funnel_form"
				);
				echo json_encode($result);
			}
			else{
				$result = array(
					"response" => "failed",
					"url" => "RSController/rs_funnel_form"
				);
				echo json_encode($result);
			}

		}
	}
	public function editKeyRsForm(){
		
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
		if(!empty($this->input->post('key_ffabsenteeism'))){
			$get_key_ffabsenteeism = explode(" | ",$this->input->post('key_ffabsenteeism'));
			$key_ffabsenteeism = $get_key_ffabsenteeism[0];
			$key_ffabsenteeism_point = $get_key_ffabsenteeism[1];

			$where_cond['key_ffabsenteeism'] = $key_ffabsenteeism;
			$where_cond['key_ffabsenteeism_point'] = $key_ffabsenteeism_point;

		}
		if(!empty($this->input->post('key_ffabsenteeism_actual'))){
			$get_key_ffabsenteeism_actual = explode(" | ",$this->input->post('key_ffabsenteeism_actual'));
			$key_ffabsenteeism_actual = $get_key_ffabsenteeism_actual[0];
			$key_ffabsenteeism_actual_point = $get_key_ffabsenteeism_actual[1];

			$where_cond['key_ffabsenteeism_actual'] = $key_ffabsenteeism_actual;
			$where_cond['key_ffabsenteeism_actual_point'] = $key_ffabsenteeism_actual_point;

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

		$editform_result = $this->cmodel->updates('rs_key_performance',$where_cond, 'auto_id', $auto_id);

        if($editform_result){
            $result = array(
                "response" => "success",
                "url" => "list_rs_key_form"
            );
            echo json_encode($result);
        }
        else{
            $result = array(
                "response" => "failed",
                "url" => "rsfunnel/RSController/list_rs_key_form"
            );
            echo json_encode($result);
        }
	}
}	
