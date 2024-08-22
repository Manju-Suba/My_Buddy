<?php	
defined('BASEPATH') OR exit('No direct script access allowed');	
class ZSMController extends CI_Controller {	
	
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
        $this->load->model('ss_recruitment/Zsm_model', 'zmodel');
        $this->load->model('ss_recruitment/Asm_model', 'amodel');

		if ( !$this->session->userdata('logged_in')){ 	
			redirect(tso_portal_base_url(), 'refresh');	
			// redirect('http://localhost/CK_TSO_Portal/');
				
        }	
        	
    }	

    public function ss_eform_zsm(){
		$this->load->view('ss_recruitment/ZSM/ss_eform_zsm');	
    }

    public function get_tso_list(){

         if($this->session->userdata('role') =='ZSM'){
            $where_cond['zsm_number'] = $this->input->post('zsm_number');

        }else{
            $where_cond['asm_number'] = $this->input->post('zsm_number');
        }

        $tsolist_result = $this->cmodel->get_table_user_list_wc('masters',$where_cond,'tso_number','tso');

        echo json_encode($tsolist_result);
	}

    public function get_asm_list(){

        $where_cond['zsm_number'] = $this->input->post('zsm_number');

		$asmlist_result = $this->cmodel->get_table_user_list_wc('masters',$where_cond,'asm_number','asm');

        echo json_encode($asmlist_result);
    }

    public function get_entered_ssforms(){
        $postData_where_id =array();

        if( $this->input->post('tso_number') !=''){
            $postData_where['created_by'] = $this->input->post('tso_number');

        }
        if( $this->input->post('af_va_status') !=''){
            $postData_where['va_status'] = $this->input->post('af_va_status');
        }
        if( $this->input->post('af_asm_status') !=''){
            $postData_where['asm_status'] = $this->input->post('af_asm_status');
        }

        $where_cond['zsm_number'] = $this->input->post('zsm_number');

	
		$tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond,'tso_number','tso');
        
        if(count($tsolist_result) !=0){
            for ($i=0; $i < count($tsolist_result); $i++) { 
                array_push($postData_where_id,$tsolist_result[$i]->tso_number);
            }
        }
        
		// $postData_where['rrf.created_by'] = implode(",",$postData_where_id);
		$postData_where['rrf.status'] = 1;

		$postData = $this->input->post();
        
        $get_entered_ssforms_result = $this->zmodel->verify_data_ssforms($postData,$postData_where,$postData_where_id);

        echo json_encode($get_entered_ssforms_result);
	}

    public function ss_fform_zsm(){
        $this->load->view('ss_recruitment/ZSM/ss_fform_zsm');
    }

    public function get_funnel_ssforms(){

		$postData_where_id =array();

        if( $this->input->post('tso_number') !=''){
            $postData_where['created_by'] = $this->input->post('tso_number');

        }
        $where_cond['zsm_number'] = $this->input->post('zsm_number');
	
		$tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond,'tso_number','tso');
        
        if(count($tsolist_result) !=0){
            for ($i=0; $i < count($tsolist_result); $i++) { 
                array_push($postData_where_id,$tsolist_result[$i]->tso_number);
            }
        }

		$postData_where['rrf.status'] = 0;

		$postData = $this->input->post();
        
        $get_funnel_ssforms_result = $this->zmodel->verify_data_ff_ssforms($postData,$postData_where,$postData_where_id);

        echo json_encode($get_funnel_ssforms_result);
	}

    public function va_verified_forms_zsm(){
        $this->load->view('ss_recruitment/ZSM/va_verified_forms_zsm');
    }
    public function get_va_verified_forms(){
        // echo $this->input->post('zsm_number');
        $postData_where_id =array();

        if( $this->input->post('tso_number') !=''){
            $postData_where['created_by'] = $this->input->post('tso_number');

        }
        if( $this->input->post('asm_number') !=''){
            $where_cond['asm_number'] = $this->input->post('asm_number');

        }else{
            $where_cond['zsm_number'] = $this->input->post('zsm_number');

        }

		$tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond,'tso_number','tso');
        
        if(count($tsolist_result) !=0){
            for ($i=0; $i < count($tsolist_result); $i++) { 
                array_push($postData_where_id,$tsolist_result[$i]->tso_number);
            }
        }
        
		$postData_where['rrf.va_status'] = 'Verified';
		$postData_where['rrf.asm_status !='] = 'Approved';
		$postData_where['rrf.status'] = 1;

		$postData = $this->input->post();
        
        $get_va_verified_forms_result = $this->amodel->get_va_verified_forms($postData,$postData_where,$postData_where_id);

        echo json_encode($get_va_verified_forms_result);
    }
    public function get_asm_verified_forms(){
        $postData_where_id =array();

        if( $this->input->post('tso_number') !=''){
            $postData_where['created_by'] = $this->input->post('tso_number');

        }
        
        if( $this->input->post('asm_number') !=''){
            $where_cond['asm_number'] = $this->input->post('asm_number');

        }else{
            $where_cond['zsm_number'] = $this->input->post('zsm_number');

        }

    
        $tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond,'tso_number','tso');
        
        if(count($tsolist_result) !=0){
            for ($i=0; $i < count($tsolist_result); $i++) { 
                array_push($postData_where_id,$tsolist_result[$i]->tso_number);
            }
        }
        
        // $postData_where['rrf.va_status'] = 'Verified';
        $postData_where['rrf.asm_status'] = 'Approved';
        $postData_where['rrf.status'] = 1;

        $postData = $this->input->post();
        
        $get_asm_verified_forms_result = $this->amodel->get_asm_approved_forms($postData,$postData_where,$postData_where_id);

        echo json_encode($get_asm_verified_forms_result);
    }
    
}

?>