<?php	
defined('BASEPATH') OR exit('No direct script access allowed');	
class ASMController extends CI_Controller {	
	
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
        $this->load->model('Asm_model', 'amodel');

		if ( !$this->session->userdata('logged_in')){ 	
			redirect(tso_portal_base_url(), 'refresh');	
			// redirect('http://localhost/CK_TSO_Portal/');
				
        }	
        	
    }	

    public function rs_eform_asm(){
		$this->load->view('rsfunnel/ASM/rs_eform_asm');	
    }

    public function get_tso_list(){

        if($this->session->userdata('role') =='ASM'){
            $where_cond['asm_number'] = $this->input->post('asm_number');

        }else{
            $where_cond['zsm_number'] = $this->input->post('asm_number');

        }

		$tsolist_result = $this->cmodel->get_table_user_list_wc('masters',$where_cond,'tso_number','tso');

        echo json_encode($tsolist_result);
	}

    public function get_entered_rsforms(){
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

        $where_cond['asm_number'] = $this->input->post('asm_number');

	
		$tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond,'tso_number','tso');
        
        if(count($tsolist_result) !=0){
            for ($i=0; $i < count($tsolist_result); $i++) { 
                array_push($postData_where_id,$tsolist_result[$i]->tso_number);
            }
        }
        
		// $postData_where['rrf.created_by'] = implode(",",$postData_where_id);
		$postData_where['rrf.status'] = 1;

		$postData = $this->input->post();
        
        $get_entered_rssmforms_result = $this->amodel->verify_data_rsforms($postData,$postData_where,$postData_where_id);

        echo json_encode($get_entered_rssmforms_result);
	}

    public function rs_fform_asm(){
        $this->load->view('rsfunnel/ASM/rs_fform_asm');
    }

    public function get_funnel_rsforms(){

		$postData_where_id =array();

        if( $this->input->post('tso_number') !=''){
            $postData_where['created_by'] = $this->input->post('tso_number');

        }
        $where_cond['asm_number'] = $this->input->post('asm_number');
	
		$tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond,'tso_number','tso');
        
        if(count($tsolist_result) !=0){
            for ($i=0; $i < count($tsolist_result); $i++) { 
                array_push($postData_where_id,$tsolist_result[$i]->tso_number);
            }
        }

		$postData_where['rrf.status'] = 0;

		$postData = $this->input->post();
        
        $get_funnel_rssmforms_result = $this->amodel->verify_data_ff_rsforms($postData,$postData_where,$postData_where_id);

        echo json_encode($get_funnel_rssmforms_result);
	}

    public function process_asm_action(){

        $where_cond['asm_status'] = $this->input->post('asm_status');

        $auto_id = $this->input->post('auto_id');

       
        $editform_result = $this->cmodel->updates('rs_recruitment_form',$where_cond, 'auto_id', $auto_id);

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

    public function va_verified_forms(){
        $this->load->view('rsfunnel/ASM/va_verified_forms');
    }

    public function asm_verified_forms(){
        $this->load->view('rsfunnel/ASM/asm_verified_forms');
    }
    
    public function asm_future_prospect(){
        $this->load->view('rsfunnel/ASM/asm_future_prospect');
    }

    public function get_va_verified_forms(){

        $postData_where_id =array();

        if( $this->input->post('tso_number') !=''){
            $postData_where['created_by'] = $this->input->post('tso_number');

        }
       
        $where_cond['asm_number'] = $this->input->post('asm_number');

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
        
        if($this->session->userdata('role_type') =='ASM'){
            $where_cond['asm_number'] = $this->input->post('asm_number');
        }else{
            $where_cond['zsm_number'] = $this->input->post('asm_number');
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

    public function get_fprospect_forms(){
        $postData_where_id =array();

        if( $this->input->post('tso_number') !=''){
            $postData_where['created_by'] = $this->input->post('tso_number');

        }
		
        if($this->session->userdata('role_type') =='ASM'){
            $where_cond['asm_number'] = $this->input->post('asm_number');
        }else{
            $where_cond['zsm_number'] = $this->input->post('asm_number');
        }
	
		$tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond,'tso_number','tso');
        
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
   
}

?>