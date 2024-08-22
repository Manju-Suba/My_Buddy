<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        //load the required libraries and helpers for login
        $this->load->helper('url');
        $this->load->library(['form_validation','session']);
        $this->load->database();
        
        //load the Login Model
        $this->load->model('LoginModel', 'login');
        $this->load->model('Common_model', 'cmodel');

    }

    public function doLogin() {
        //get the input fields from login form
        $login_mob_no = $this->input->post('login_mob_no');
        $login_pass = md5($this->input->post('login_pass'));
        
        $data = array(
            'mobile' => $login_mob_no,
            'password' => $login_pass,
            'status' => "1"
        );

        
        //send the log_user_id pass to query if the user is present or not
        $check_login = $this->login->checkLogin($data);
        // echo "<pre>";print_r($check_login);die;
        //if the result is query result is 1 then valid user
        if ($check_login) {
            //if yes then set the session 'loggin_in' as true
            $this->session->set_userdata('logged_in', TRUE);

            $this->session->set_userdata('val', $check_login);
            $this->session->set_userdata('mobile', $check_login['mobile']);
            $this->session->set_userdata('username', $check_login['username']);
            $this->session->set_userdata('user_pass', $this->input->post('login_pass'));
            $this->session->set_userdata('status', $check_login['status']);
            $this->session->set_userdata('role', $check_login['role']);
            $this->session->set_userdata('business', $check_login['business']);
            $this->session->set_userdata('role_type', $check_login['role_type']);
            $this->session->set_userdata('client_name', 'CK Competition Watch');

            if($this->session->role_type =='SM'){

                $result = array(
                    "logstatus" => "success",
                    "url" => "dashboard"
                );
                echo json_encode($result);


            }else if($this->session->role_type =='admin'){

                $result = array(
                    "logstatus" => "success",
                    "url" => "dashboard"
                );
                echo json_encode($result);
            }
            else if($this->session->role_type =='SI'){

                $result = array(
                    "logstatus" => "success",
                    "url" => "five_sec_scorecard"
                );
                echo json_encode($result);
            }
            else if($this->session->role_type =='RSSM'){

                $result = array(
                    "logstatus" => "success",
                    "url" => "kyc_update"
                );
                echo json_encode($result);
            }
            else if($this->session->role_type =='QC'){

                $result = array(
                    "logstatus" => "success",
                    "url" => "qc_verification"
                );
                echo json_encode($result);
            }
            else if($this->session->role_type =='RSSM_Head'){

                $result = array(
                    "logstatus" => "success",
                    "url" => "entered_forms"
                );
                echo json_encode($result);
            } else if( $this->session->role =='COMMERCIAL' ){
                
                $result = array(
                    "logstatus" => "success",
                    "url" => "pending_form_comercial?type=Pending"
                );
                echo json_encode($result);
            } else if( $this->session->role =='SAP' ){
                
                $result = array(
                    "logstatus" => "success",
                    "url" => "pending_form_sap?type=Pending"
                );
                echo json_encode($result);
            } 
            else{

                $result = array(
                    "logstatus" => "success",
                    "url" => "dashboard"
                );
                echo json_encode($result);
            }

        } else {
            $check_user = $this->login->checkuser($data);
            //if no then set the session 'logged_in' as false
            $this->session->set_userdata('logged_in', false);
            
            if(!$check_user){
                $result = array(
                    "logstatus" => "not_a_user"
                );
            }else{
                $result = array(
                    "logstatus" => "failed"
                );
            }
            //and redirect to login page with flashdata invalid msg
            
            // $result = array(
            //     "logstatus" => "failed"
            // );
            echo json_encode($result);

    
        }
    }

    public function updatelog(){

		$where_cond['mobile'] = $this->input->post('mobile_no');

		$addlog_result = $this->cmodel->data_add('tso_login_log',$where_cond);

        if($addlog_result){
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

    public function logout() {
        //unset the logged_in session and redirect to login page
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('mobile');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('username');
		$this->session->unset_userdata('status');
		$this->session->unset_userdata('id');
        redirect(base_url());
    }
}