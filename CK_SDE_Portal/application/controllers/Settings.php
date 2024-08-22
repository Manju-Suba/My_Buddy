<?php	
defined('BASEPATH') OR exit('No direct script access allowed');	
class Settings extends CI_Controller {

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
			redirect(tso_portal_base_url(), 'refresh');	
			// redirect('http://localhost/CK_TSO_Portal/');
				
        }	
        	
    }	

public function get_entered_users_report(){
        
        $postData_where['from_date_filter'] = $this->input->post('from_date_filter');
        $postData_where['to_date_filter']= $this->input->post('to_date_filter');
        $postData_where['user_name_filter']= $this->input->post('user_name_filter');
        $postData_where['business_filter']= $this->input->post('business_filter');

	    $postData = $this->input->post();
        
		$get_entered_users_result = $this->cmodel->verify_data_users_report($postData, $postData_where);

		echo json_encode($get_entered_users_result);
}

public function get_user_name_list(){ 

        $data = $this->cmodel->get_user_name_list();

        echo json_encode($data);

    }

public function get_entered_users_report_count(){

    $postData_where['user_name_filter']= $this->input->post('user_name_filter');
    $postData_where['business_filter']= $this->input->post('business_filter');
    $postData_where['created_on_filter']= $this->input->post('created_on_filter');
    $postData = $this->input->post();
    
    $get_entered_users_result = $this->cmodel->verify_data_users_report_count($postData, $postData_where);

    echo json_encode($get_entered_users_result);
}

public function get_business_list(){ 

        $data = $this->cmodel->get_business_list();

        echo json_encode($data);

    }


}