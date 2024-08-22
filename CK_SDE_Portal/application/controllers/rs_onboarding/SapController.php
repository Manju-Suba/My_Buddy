<?php	
defined('BASEPATH') OR exit('No direct script access allowed');	
class SapController extends CI_Controller {	

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

    public function pending_form(){
		$this->load->view('rs_onboarding/SAP/pending_form');
	}

    public function get_rs_onboarding_data(){
        $postData = $this->input->post();
        $role = $this->session->userdata('role_type');
        $status = $this->input->post('status');
        $otherStatus = "sap_status";
        $data = $this->cmodel->get_rs_onboarding_data($postData,$role,$status,$otherStatus);
        echo json_encode($data);
    }

    public function updateRsOnboardingData(){
        $type = $this->input->post('type');
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $data = $this->cmodel->updateRsOnboardingData($type,$status,$id);
        echo json_encode($data);
    }

    public function viewRsOnboardingData(){
        $id = $this->input->post('id');
        $data = $this->cmodel->viewRsOnboardingData($id);
        echo json_encode($data);
    }

}

?>