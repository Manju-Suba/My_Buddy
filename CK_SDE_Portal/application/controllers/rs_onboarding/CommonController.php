<?php	
defined('BASEPATH') OR exit('No direct script access allowed');	
class CommonController extends CI_Controller {	
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
    
	public function asm_pending_form(){	
		$this->load->view('rs_onboarding/ASM/asm_pending_form');
	}
    
    public function asm_approved_form(){	
		$this->load->view('rs_onboarding/ASM/asm_approved_form');
	}

    public function asm_future_prospect(){	 
		$this->load->view('rs_onboarding/ASM/asm_future_prospect');
	}

    public function get_onboarding_data(){
        $postData = $this->input->post();
        $role = $this->session->userdata('role_type');
        $status = $this->input->post('status');
        $otherStatus = $this->input->post('status_field');
        // $otherStatus = "asm_status";
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

    public function zsm_pending_form(){	
		$this->load->view('rs_onboarding/ZSM/zsm_pending_form');
	}
    
    public function zsm_approved_form(){	
		$this->load->view('rs_onboarding/ZSM/zsm_approved_forms');
	}

    public function zsm_future_prospect(){	
		$this->load->view('rs_onboarding/ZSM/zsm_rejected_forms');
	}

}
?>