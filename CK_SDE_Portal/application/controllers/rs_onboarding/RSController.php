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

        $this->load->model('rs_onboarding/Common_model', 'cmodel');

		if ( !$this->session->userdata('logged_in')){ 
			redirect(tso_portal_base_url(), 'refresh');	
        }
        	
    }

	public function rs_appointment_form(){	
		$this->load->view('rs_onboarding/TSO/rs_appointment_form');	
	}
	
	public function rs_entered_form(){	
		$this->load->view('rs_onboarding/TSO/rs_entered_form');	
	}


	public function get_rs_type_list(){
		$where_cond['status'] = 'Active';
		$rs_type_list_result = $this->cmodel->get_some_data_list('rs_type_master',$where_cond,'rs_type');
        echo json_encode($rs_type_list_result);
	}

	public function get_company_list(){
		$where_cond['status'] = 'Active';
		$company_list_result = $this->cmodel->get_some_data_list('companies',$where_cond,'cname');
        echo json_encode($company_list_result);
	}
	

	function upload_file($file_field_name, $upload_path, $allowed_types, $max_size) {
		// Check if the directory path exists, if not, create it
		if (!is_dir($upload_path)) {
			// Create the directory recursively
			if (!mkdir($upload_path, 0755, true)) {
				// Failed to create the directory
				return '';
			}
		}
	
		if (!empty($_FILES[$file_field_name]['name'])) {
			$config['upload_path'] = $upload_path;
			$config['allowed_types'] = $allowed_types;
			$config['max_size'] = $max_size;
			$ext = pathinfo($_FILES[$file_field_name]['name'], PATHINFO_EXTENSION);
			$config['file_name'] = time() . rand(1, 100) . '.' . $ext;
	
			$CI =& get_instance(); // Get the CodeIgniter instance
			$CI->load->library('upload', $config);
			$CI->upload->initialize($config);
	
			if ($CI->upload->do_upload($file_field_name)) {
				$uploadData = $CI->upload->data();
				return $uploadData['file_name'];
			} else {
				return '';
			}
		} else {
			return '';
		}
	}
	
	public function add_rs_details(){

		$gst_reg_file = $this->upload_file('gst_reg_file', 'uploads/rs_appointment/documents/', '*', '20000');
		$cheque_copy = $this->upload_file('cheque_copy', 'uploads/rs_appointment/cheque/', '*', '20000');
		$fssai_copy = $this->upload_file('fssai_copy', 'uploads/rs_appointment/fssai/', '*', '20000');
		$aadhar_copy = $this->upload_file('aadhar_copy', 'uploads/rs_appointment/aadhar/', '*', '20000');
		$aadhar_copy2 = $this->upload_file('aadhar_copy2', 'uploads/rs_appointment/aadhar/', '*', '20000');
		$pan_copy = $this->upload_file('pan_copy', 'uploads/rs_appointment/pan/', '*', '20000');
		$godown_pic = $this->upload_file('godown_pic', 'uploads/rs_appointment/godownpic/', '*', '20000');
		$godown_pic2 = $this->upload_file('godown_pic2', 'uploads/rs_appointment/godownpic/', '*', '20000');
		$office_main_gate = $this->upload_file('office_main_gate', 'uploads/rs_appointment/officegate/', '*', '20000');
		$owner_picture = $this->upload_file('owner_picture', 'uploads/rs_appointment/ownerpic/', '*', '20000');
		$delivery_van_pic = $this->upload_file('delivery_van_pic', 'uploads/rs_appointment/delivery_vanpic/', '*', '20000');
		$delivery_van_rc = $this->upload_file('delivery_van_rc', 'uploads/rs_appointment/delivery_van_rc/', '*', '20000');
		$invoice_copy = $this->upload_file('invoice_copy', 'uploads/rs_appointment/invoice_copy/', '*', '20000');
		$noc_pending_claims = $this->upload_file('noc_pending_claims', 'uploads/rs_appointment/claims_doc/', '*', '20000');

		//Basic details
		$where_cond['rs_type'] = $this->input->post('distri_type');
		$where_cond['appointment_reason'] = $this->input->post('reason_appoint');
		if($this->input->post('reason_appoint') != "Expansion"){
			$where_cond['existing_sap_rssscode	'] = $this->input->post('sap_sscode');
			$where_cond['claims_collected'] = $this->input->post('claims_collected');
			$where_cond['noc_pending_claims'] = $noc_pending_claims;
		}

		//Additional details
		$where_cond['firm_title'] = $this->input->post('firm_name');
		$where_cond['ownership_status'] = $this->input->post('ownership_status');
		$where_cond['gst_no'] = $this->input->post('gst_number');
		$where_cond['gst_copy'] = $gst_reg_file;

		$where_cond['fssai_no'] = $this->input->post('fssai_number');
		$where_cond['fssai_copy'] = $fssai_copy;
		$where_cond['contact_person_name'] = $this->input->post('contact_person_name');
		$where_cond['mobile_no'] = $this->input->post('mobile_no');
		$where_cond['email_id'] = $this->input->post('email_id');

		$where_cond['aadhar_no'] = $this->input->post('aadhar_num');
		$where_cond['aadhar_front_page'] = $aadhar_copy;
		$where_cond['aadhar_back_page'] = $aadhar_copy2;
		$where_cond['pan_no'] = $this->input->post('pan_number');
		$where_cond['pancard_copy'] = $pan_copy;
        $where_cond['address'] = $this->input->post('address', TRUE);
        $where_cond['alternate_address'] = $this->input->post('alternative_address', TRUE);

		//Bank details
        $where_cond['bank_name'] = $this->input->post('bank_name', TRUE);
        $where_cond['ac_holder_name'] = $this->input->post('ac_owner_name', TRUE);
        $where_cond['ac_number'] = $this->input->post('ac_num', TRUE);
        $where_cond['ac_type'] = $this->input->post('ac_type', TRUE);
        $where_cond['branch_name'] = $this->input->post('branch_name', TRUE);
        $where_cond['ifsc_code'] = $this->input->post('ifsc_code', TRUE);
        $where_cond['signatory_name'] = $this->input->post('signatory_name', TRUE);
        $where_cond['nach_limit'] = $this->input->post('nach_limit', TRUE);
        $where_cond['cancelled_cheque'] = $cheque_copy;

		//Financial details
        $where_cond['monthly_firm_turnover'] = $this->input->post('monthly_turnover', TRUE);
        $where_cond['total_investment'] = $this->input->post('total_investment', TRUE);
        $where_cond['own_investment_funds'] = $this->input->post('own_investment', TRUE);
        $where_cond['borrowed_funds'] = $this->input->post('borrowed_funds', TRUE);
        $where_cond['working_capital_ckpl'] = $this->input->post('working_capital', TRUE);

		//Current Infrastructure
		if(!empty($this->input->post('handled_company'))){
			$handled_company = implode(" , ",$this->input->post('handled_company'));
		}else{
			$handled_company = '';
		}
		
		$where_cond['company_handled'] = $handled_company;
		$where_cond['outlets_covered'] = $this->input->post('outlets_covered', TRUE);
		$where_cond['no_of_salesman_company_paid'] = $this->input->post('paid_salesman', TRUE);
		$where_cond['no_of_salesman_self'] = $this->input->post('dist_salesman', TRUE);
		$where_cond['no_of_delivery_units'] = $this->input->post('delivery_units', TRUE);
		$where_cond['godown_size'] = $this->input->post('godown_size', TRUE);
		$where_cond['godown_pic1'] = $godown_pic;
		$where_cond['godown_pic2'] = $godown_pic2;
		$where_cond['office_main_gate'] = $office_main_gate;
		$where_cond['owner_pic'] = $owner_picture;
		$where_cond['computer_billing'] = $this->input->post('computer_billing', TRUE);
		$where_cond['printer_compatible_csng_billing'] = $this->input->post('csng_billing', TRUE);
		
		$vehicle_types = $this->input->post('unit_type[]', TRUE);
		$post_data = [];
		foreach ($vehicle_types as $type) {

			if(!$this->input->post(strtolower(str_replace(' ', '', $type)))){
				$post_data[$type] = $this->input->post(strtolower(str_replace(' ', '', $type)));
			}else{
				$post_data[$type] = '1';
			}
		}
		// print_r($post_data);
		$serializedArray = json_encode($post_data);
		$where_cond['unit_type_with_count'] = $serializedArray;

		$where_cond['delivery_van_pic'] = $delivery_van_pic;
		$where_cond['delivery_van_rc'] = $delivery_van_rc;
		$where_cond['invoice_copy_exist_company'] = $invoice_copy;

		//Proposed Infrastructure
		$where_cond['approved_ff_count'] = $this->input->post('ff_count', TRUE);
		$where_cond['outlets_covered_for_cavinkare'] = $this->input->post('proposed_outlets_coverd', TRUE);
		$where_cond['expected_turnover_from_cavinkare_pyear'] = $this->input->post('yearly_turnover', TRUE);

		$where_cond['created_by'] = $this->session->userdata('mobile');
		$addform_result = $this->cmodel->data_add('rs_appointment_data',$where_cond);

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

	public function get_entered_rssmforms(){

		$postData_where['created_by'] = $this->session->mobile;
		$postData_where['status'] = 1;

		if($this->input->post('af_va_status') !=''){
			$postData_where['va_status'] = $this->input->post('af_va_status');
		}
		if($this->input->post('af_asm_status') !=''){
			$postData_where['asm_status'] = $this->input->post('af_asm_status');
		}
		
		$postData = $this->input->post();
        
        $get_entered_rssmforms_result = $this->cmodel->verify_data_erssmforms($postData,$postData_where);

        echo json_encode($get_entered_rssmforms_result);
	}

    public function get_rs_onboarding_data(){
        $postData = $this->input->post();
        $data = $this->cmodel->get_entered_datas($postData);
        echo json_encode($data);
    }

	public function get_bank_details(){
		$ifsc_code = $this->input->post('ifsc_code');
		$url = 'https://ifsc.razorpay.com/'.$ifsc_code;

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);

		// Check if response is received
		if ($response) {
			// Parse JSON response
			$bank_details = json_decode($response, true);
			$result = array(
                "response" => $bank_details,
            );
            echo json_encode($result);
			// Output bank details
			// print_r($bank_details);
		} else {
			// Handle error
			echo "Failed to fetch bank details";
		}
	}

}
