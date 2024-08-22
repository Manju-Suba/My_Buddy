<?php	
defined('BASEPATH') OR exit('No direct script access allowed');	
class FivesecScorecard extends CI_Controller {	
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
        $this->load->model('Fsscorecard_model', 'fssmodel');

		if ( !$this->session->userdata('logged_in')){ 	
			redirect(tso_portal_base_url(), 'refresh');	
				
        }	
        	
    }	
	public function five_sec_scorecard(){
		$sess_mob=$this->session->userdata('mobile');
		$role_type=$this->session->userdata('role_type');

		if($role_type =='SM' ){
			$sm_details= $this->fssmodel->get_sm_user_data('users',$sess_mob);
			$sm_type=$sm_details[0]->sm_type;

			$data['sm_type'] = $sm_type;

			$this->load->view('fivesec_scorecard/five_sec_scorecard',$data);	
		}else{
			$this->load->view('fivesec_scorecard/5c_scorecard_report');	
		}
		// $this->load->view('fivesec_scorecard/five_sec_scorecard');	
	}


	public function get_sm(){
		$where_cond['tso_number'] = $this->input->post('tso_number');

		$smlist_result = $this->cmodel->get_table_user_list_wc('masters',$where_cond,'sm_number','sm');

        echo json_encode($smlist_result);
	}

	public function get_business_list(){

        $businesslist_result = $this->cmodel->get_business_user_list('users','business');
        echo json_encode($businesslist_result);
    }

	public function get_zsm_list(){
        $where_cond['division'] = $this->input->post('business');
		$asmlist_result = $this->cmodel->get_table_user_list_wc('masters',$where_cond,'zsm_number','zsm');
        echo json_encode($asmlist_result);
    }

	function view_list()
	{
		$this->load->view('dashboard');
	}

	public function get_individual_rsp_data(){	
		$sess_mob=$this->session->userdata('mobile');
	
		$rsp_name = $this->input->post('session_user_name');

		$sm_details= $this->fssmodel->get_sm_user_data('users',$sess_mob);
		$sm_type=$sm_details[0]->sm_type;
			
		
        $data_sm_view = $this->fssmodel->get_sm_individual_data('five_sec_score_details',$sess_mob,$rsp_name);
			
		if($data_sm_view !== Array()){
			$data['ssfa_id'] = $data_sm_view[0]->ssfa_id;
			if($sm_type ==="RSP"){
				$data['man_days_norms'] = $data_sm_view[0]->man_days_norms_6hrs_25outlet;
			}elseif($sm_type ==="SDO"){
				$data['man_days_norms'] = $data_sm_view[0]->man_days_norms_6hrs_30outlet;
			}elseif($sm_type ==="RSSM"){
				$data['man_days_norms'] = $data_sm_view[0]->man_days_norms_7hrs_40outlet;
			}


			$data['approved_salary'] = $data_sm_view[0]->approved_salary;
			$data['month'] = $data_sm_view[0]->month;
			$data['total_days'] = $data_sm_view[0]->total_days;
			$data['app_usage'] = $data_sm_view[0]->app_usage;
			$data['exception_days'] = $data_sm_view[0]->exception_days;
			$data['total_days_worked'] = $data_sm_view[0]->holidays + $data_sm_view[0]->actual_days;
			$data['conveyance'] = $data_sm_view[0]->conveyance;
			$data['incentive'] = $data_sm_view[0]->incentive;
			$data['pending_salary'] = $data_sm_view[0]->pending_salary;
			$data['final_amount'] = $data_sm_view[0]->final_amount;
		}else{
			$data['ssfa_id'] = "--";
			$data['man_days_norms'] = 0;
			$data['approved_salary'] = 0;
			$data['month'] = '--';
			$data['total_days'] = 0;
			$data['app_usage'] = 0;
			$data['exception_days'] = 0;
			$data['total_days_worked'] = 0;
			$data['conveyance'] = 0;
			$data['incentive'] = 0;
			$data['pending_salary'] = 0;
			$data['final_amount'] = 0;
		}
		
		
		echo json_encode($data);
	}	
	
	
}	
