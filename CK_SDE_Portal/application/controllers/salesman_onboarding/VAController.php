<?php	
defined('BASEPATH') OR exit('No direct script access allowed');	
class VAController extends CI_Controller {	
	
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

        $this->load->model('sales/Common_model', 'cmodel');
        $this->load->model('sales/Va_model', 'vmodel');

		if ( !$this->session->userdata('logged_in')){ 	
			redirect(tso_portal_base_url(), 'refresh');	
			// redirect('http://localhost/CK_TSO_Portal/');
				
        }	
        	
    }	

    public function rssm_eform_va(){
        $this->load->view('salesman_onboarding/VA/rssm_eform_va');
    }

    public function get_tso_list_va(){

        $where_cond['division'] = $this->input->post('business');
        $where_cond['va_number'] = $this->input->post('va_number');

		$tsolist_result = $this->cmodel->get_table_user_list_wc('masters',$where_cond,'tso_number','tso');

        echo json_encode($tsolist_result);
    }

    public function get_entered_rssmforms_va(){
        $postData_where_id =array();

        if( $this->input->post('tso_number') !=''){
            $postData_where['created_by'] = $this->input->post('tso_number');
        }
        if( $this->input->post('af_business_list') !=''){
            $postData_where['u.business'] = $this->input->post('af_business_list');
        }
        if( $this->input->post('af_va_status') !=''){
            $postData_where['va_status'] = $this->input->post('af_va_status');
        }
        if( $this->input->post('af_asm_status') !=''){
            $postData_where['asm_status'] = $this->input->post('af_asm_status');
        }

        $where_cond['va_number'] = $this->input->post('va_number');
	
		$tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond,'tso_number','tso');
        
        if(count($tsolist_result) !=0){
            for ($i=0; $i < count($tsolist_result); $i++) { 
                array_push($postData_where_id,$tsolist_result[$i]->tso_number);
            }
        }
        
		$postData_where['rrf.status'] = 1;

		$postData = $this->input->post();
        
        $get_entered_rssmforms_result = $this->vmodel->verify_data_rssmforms_va($postData,$postData_where,$postData_where_id);

        echo json_encode($get_entered_rssmforms_result);
	}

    public function process_va_action(){

        $where_cond['va_status'] = $this->input->post('get_va_action');

        $auto_id = $this->input->post('auto_id');

       
        $editform_result = $this->cmodel->updates('rssm_recruitment_form',$where_cond, 'auto_id', $auto_id);

        if($editform_result){
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


}

?>