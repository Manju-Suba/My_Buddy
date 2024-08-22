<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        //load the required libraries and helpers for login
        $this->load->helper('url');
        $this->load->library(['form_validation','session']);
        $this->load->database();
        
        //load the Login Model
        $this->load->model('LoginModel', 'login');

    }

    public function doLogin() {
        //get the input fields from login form
        $login_mob_no = $this->input->post('mobile');
        $login_pass = md5($this->input->post('pass'));
        
        $data = array(
            'mobile' => $login_mob_no,
            'password' => $login_pass,
            'status' => "1"
        );

        
        //send the log_user_id pass to query if the user is present or not
        $check_login = $this->login->checkLogin($data);

        //if the result is query result is 1 then valid user
        if ($check_login) {
            //if yes then set the session 'loggin_in' as true
            $this->session->set_userdata('logged_in', TRUE);

            $this->session->set_userdata('val', $check_login);
            $this->session->set_userdata('mobile', $check_login['mobile']);
            $this->session->set_userdata('username', $check_login['username']);
            $this->session->set_userdata('status', $check_login['status']);
            $this->session->set_userdata('role', $check_login['role']);
            // $this->session->set_userdata('role_type', $check_login['role_type']);
            $this->session->set_userdata('client_name', 'ScoreCard Deployment');

            if($this->session->role =='TSO' || $this->session->role =='SM' ){

                $result = array(
                    "logstatus" => "success",
                    "url" => "scorecard_report"
                );
                echo json_encode($result);

            }else if( $this->session->role =='ASM'){
                
                $result = array(
                    "logstatus" => "success",
                    "url" => "scorecard_report"
                );
                echo json_encode($result);
            }
            
            else{
                $result = array(
                    "logstatus" => "success", 
                    "url" => "scorecard_report"
                );
                echo json_encode($result);
            }

        } else {
            //if no then set the session 'logged_in' as false
            $this->session->set_userdata('logged_in', false);
            
            //and redirect to login page with flashdata invalid msg
            
            $result = array(
                "logstatus" => "failed"
            );
            echo json_encode($result);

    
        }
    }

    public function logout() {
        //unset the logged_in session and redirect to login page
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('mobile');
        $this->session->unset_userdata('role');
        // $this->session->unset_userdata('role_type');
        
        redirect(tso_portal_base_url());
        // redirect('http://localhost/CK_TSO_Portal/');
    }

    public function setsession(){
        $pro_id = $this->input->post('pro_id');
        $this->session->set_userdata('pro_id', $pro_id);
        $result = array(
            "logstatus" => "success"
        );
        echo json_encode($result);
    }
}