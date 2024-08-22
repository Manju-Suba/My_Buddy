<?php	
defined('BASEPATH') OR exit('No direct script access allowed');	
class Tsocontroller extends CI_Controller {	
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
			redirect(base_url(), 'refresh');	
				
        }	
        	
    }	
	
	public function get_project_list(){

		$role_type = $this->session->userdata('role_type');
		$login_mob_no = $this->session->userdata('mobile');
		$login_pass = $this->session->userdata('user_pass');


		$where_cond['role_type'] = $role_type;
		$tso_role_details_result = $this->cmodel->verify_data($where_cond,'tso_role_details');

		if(count($tso_role_details_result) != 0){

			$get_str_project_details = $tso_role_details_result[0]->project_details;

			$arr_project_details = explode('|',$get_str_project_details);

			$data_array = array();
			foreach ($arr_project_details as $key => $pd_id) {

				$where_cond_pd['project_id'] = $pd_id;
				$tso_project_details_result = $this->cmodel->verify_data($where_cond_pd,'tso_project_details');

				$data['results'][] = array(
					'project_id' => $pd_id,
					'bootstrap_class' => $tso_project_details_result[0]->bootstrap_class,
					'project_name' => $tso_project_details_result[0]->project_name,
					'project_url' => $tso_project_details_result[0]->project_url
				);

			}
			$result = array(
				"logstatus" => "success",
				"pro_details" => $data['results'],
				"role_type" => $role_type,
				"login_mob_no" => $login_mob_no,
				"login_pass" => $login_pass
			);
			echo json_encode($result);
		}
		else{
			$result = array(
				"logstatus" => "failure",
				"pro_details" => "",
				"role_type" => $role_type,
				"login_mob_no" => $login_mob_no,
				"login_pass" => $login_pass
			);
			echo json_encode($result);

		}
	}

	public function updatePassword(){
        $new_password = $this->input->post('new_password');
        $confirm_password = $this->input->post('confirm_password');
        $mobile = $this->session->mobile;

        $data = array(
            'mobile' => $mobile,
            'password' => md5($this->input->post('confirm_password'))
        );

        $data = $this->cmodel->updatePassword($data);

        $result = array(
            "message" => "success",
            "url" => "../index.php/Login/logout",
        );
        echo json_encode($result);

    }
}	

