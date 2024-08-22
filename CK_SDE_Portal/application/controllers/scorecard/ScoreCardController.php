<?php	
defined('BASEPATH') OR exit('No direct script access allowed');	

class ScoreCardController extends CI_Controller {	
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
		date_default_timezone_set('Asia/Kolkata');

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

        $this->load->model('Scorecard_model', 'scmodel');

		if ( !$this->session->userdata('logged_in')){ 	
			redirect(tso_portal_base_url(), 'refresh');	
			// redirect('http://localhost/CK_TSO_Portal/');
				
        }	
        	
    }	
	public function scorecard_tab(){	
		$this->load->view('scorecard/scorecard_tab');	
	}	
	
	public function hygienic_scorecard(){	
		$this->load->view('scorecard/hygienic_scorecard_report');	
	}	

	public function npd_scorecard(){	
		$this->load->view('scorecard/npd_scorecard_report');	
	}	

	public function get_rural_npd_details(){
		$type = 'Rural NPD';
		$postData = $this->input->post();
		$return_result = $this->scmodel->get_rural_npd_details($postData,$type);
		echo json_encode($return_result);
	}

}	
