<?php	
defined('BASEPATH') OR exit('No direct script access allowed');	

class OutletController extends CI_Controller {	

  public function __construct()	{	
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

    $this->db2 = $this->load->database('second_db', TRUE);

    $this->load->model('Common_model', 'cmodel');

		if ( !$this->session->userdata('logged_in')){ 	
			redirect(tso_portal_base_url(), 'refresh');	
    }	
        	
  }	

  public function view_outlet(){
  $this->load->view('Outlet/outlet_performance');	
  }

    public function view_outlet_chart(){
		$this->load->view('Outlet/outlet_performance_chart');	
    }

    public function get_details(){
        if( $this->session->userdata('role') != 'TSO'){
            $where['outlet_code'] = $this->input->post('outlet');
            $where['sde_mobilenumber'] = $this->input->post('sde_number');
        }else{
            $where['outlet_code'] = $this->input->post('outlet');
            $where['sde_mobilenumber'] = $this->session->userdata('mobile');
        }

        $data = $this->cmodel->verify_data2('my_buddy_outlets',$where);
        
		echo json_encode($data);

    }

    public function get_outlet(){
       
        $where['sde_mobilenumber'] = $this->input->post('sde_number');
        

        $data = $this->cmodel->get_outlet('my_buddy_outlets',$where);
      
			echo json_encode($data);

    }

    public function get_tso_list(){

        // $where_cond['zsm_number'] = $this->input->post('zsm_number');
        $where_cond['asm_number'] = $this->input->post('asm_number');

		$tsolist_result = $this->cmodel->get_table_user_list_wc('masters',$where_cond,'tso_number','tso');

        echo json_encode($tsolist_result);
	}

    public function get_asm_list(){
        $where_cond['zsm_number != '] = '';
        $where_cond['zsm_number'] = $this->input->post('zsm_number');
        $where_cond['division'] = $this->input->post('business');
        // print_r($where_cond);

		$asmlist_result = $this->cmodel->get_table_user_list_wc('masters',$where_cond,'asm_number','asm');
        echo json_encode($asmlist_result);
    }

    public function get_zsm_list(){
        if($this->session->userdata('role') == 'Division Head'){
            $where_cond['division'] = $this->session->userdata('business');
        }else{
            $where_cond['division'] = $this->input->post('business');
        }
        $where_cond['zsm_number != '] = '';
        // $where_cond['zsm_number'] = $this->input->post('zsm_number');

		$asmlist_result = $this->cmodel->get_table_user_list_wc('masters',$where_cond,'zsm_number','zsm');
        echo json_encode($asmlist_result);
    }



}