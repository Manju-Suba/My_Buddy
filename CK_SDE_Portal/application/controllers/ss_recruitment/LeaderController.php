<?php	
defined('BASEPATH') OR exit('No direct script access allowed');	

class LeaderController extends CI_Controller {	
	
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
        $this->load->model('ss_recruitment/Asm_model', 'amodel');
        $this->load->model('ss_recruitment/Zsm_model', 'zmodel');

		if ( !$this->session->userdata('logged_in')){ 	
			redirect(tso_portal_base_url(), 'refresh');	
			// redirect('http://localhost/CK_TSO_Portal/');
				
        }	
        	
    }	

    public function va_verified_forms_ldr(){
		$this->load->view('ss_recruitment/LEADER/va_verified_forms_ldr');	
    }

    public function get_zsm_list(){

		$zsmlist_result = $this->cmodel->get_table_user_list('masters','zsm_number','zsm');

        echo json_encode($zsmlist_result);
    }

    public function get_tso_list(){

        $where_cond['zsm_number'] = $this->input->post('zsm_number');
        $where_cond['asm_number'] = $this->input->post('asm_number');

		$tsolist_result = $this->cmodel->get_table_user_list_wc('masters',$where_cond,'tso_number','tso');

        echo json_encode($tsolist_result);
	}
    

    public function ldr_verified_forms(){
		$this->load->view('ss_recruitment/LEADER/ldr_verified_forms');	
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

    public function ldr_future_prospect(){
		$this->load->view('ss_recruitment/LEADER/ldr_future_prospect');	
    }

    public function get_fprospect_forms(){
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
       // echo"<pre>";print_r($tsolist_result);die;
        if(count($tsolist_result) !=0){
            for ($i=0; $i < count($tsolist_result); $i++) { 
                array_push($postData_where_id,$tsolist_result[$i]->tso_number);
            }
        }
        
		// $postData_where['rrf.va_status'] = 'Verified';
		$postData_where['rrf.asm_status'] = 'Future Prospect';
		$postData_where['rrf.status'] = 1;

		$postData = $this->input->post();
        
        $get_asm_verified_forms_result = $this->amodel->get_fprospect_forms($postData,$postData_where,$postData_where_id);

        echo json_encode($get_asm_verified_forms_result);
    }

    public function ss_eform_ldr(){
		$this->load->view('ss_recruitment/LEADER/ss_eform_ldr');	
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
        
		// $postData_where['rrf.created_by'] = implode(",",$postData_where_id);
		$postData_where['rrf.status'] = 1;

		$postData = $this->input->post();
        
        $get_entered_ssforms_result = $this->zmodel->verify_data_ssforms($postData,$postData_where,$postData_where_id);

        echo json_encode($get_entered_ssforms_result);
	}

    public function ss_fform_ldr(){
		$this->load->view('ss_recruitment/LEADER/ss_fform_ldr');	
    }

    public function get_funnel_ssforms(){

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

		$postData_where['rrf.status'] = 0;

		$postData = $this->input->post();
        
        $get_funnel_ssforms_result = $this->zmodel->verify_data_ff_ssforms($postData,$postData_where,$postData_where_id);

        echo json_encode($get_funnel_ssforms_result);
	}

}

?>