<?php	
defined('BASEPATH') OR exit('No direct script access allowed');	

class SdeIncentive extends CI_Controller {	
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
        $this->load->model('Incentive_model', 'icmodel');

		if ( !$this->session->userdata('logged_in')){ 	
			redirect(tso_portal_base_url(), 'refresh');	
			// redirect('http://localhost/CK_TSO_Portal/');
				
        }	
        	
    }	
	 
	public function sde_incentive_urban(){	
		
		$role_type=$this->session->userdata('role_type');
		if($role_type =='ZSM' ){

			$sess_mob=$this->session->userdata('mobile');
			$user_details= $this->icmodel->get_data('users',$sess_mob);
			$user_id=$user_details[0]->user_id;

			$zsm_number=$sess_mob;
			$asm_details = $this->icmodel->get_data_asm_details('masters',$user_id,$zsm_number);
			
			$data['asm_details'] = $asm_details;

			$this->load->view('incentive/sde_incentive_urban',$data);	
		}elseif($role_type =='TSO'){

			$this->load->view('incentive/sde_incentive_urban_individual');	
		}elseif($role_type =='ASM'){
			$sess_mob=$this->session->userdata('mobile');
			$user_details= $this->icmodel->get_data('users',$sess_mob);
			$user_id=$user_details[0]->user_id;

			$asm_number=$sess_mob;

			$sde_details = $this->icmodel->get_data_tso_sde_details('masters',$sess_mob,$asm_number);

			$data['sde_details'] = $sde_details;

			$this->load->view('incentive/sde_incentive_urban_asm',$data);		
		}elseif($role_type =='VA' || $role_type =='LEADER'){
			$sess_mob=$this->session->userdata('mobile');
			
			$va_number=$sess_mob;


			
			$zsm_details = $this->icmodel->get_data_zsm_details('masters',$va_number);
			

			$data['zsm_details'] = $zsm_details;

			// $this->load->view('sde_incentive_urban_val',$data);	
			$this->load->view('incentive/sde_incentive_urban_val');	
		}
	} 


	public function get_sde_incentive_report(){
		$where_cond_dt = array();
		$role_type=$this->session->userdata('role_type');
		if($role_type =='ZSM' ){
			$sess_mob=$this->session->userdata('mobile');
			$type="where";
			$postData_where['jc_type'] = $this->input->post('jc_type');
			$postData_where['username'] = $this->input->post('session_user_name');
			$postData_where['asm_number'] = $this->input->post('asm_number');
			$postData_where['zsm_number'] =$sess_mob;
			
			$postData = $this->input->post();
			
			$get_sde_incetive_urban_result = $this->icmodel->verify_data_sde_incentive_report($postData,$postData_where,$type);
			

			echo json_encode($get_sde_incetive_urban_result);
		}elseif($role_type =='ASM' ){
			$sess_mob=$this->session->userdata('mobile');
			$type="where";
			$postData_where['jc_type'] = $this->input->post('jc_type');
		
			$postData_where['asm_number'] = $sess_mob;
			$postData_where['sde_number'] = $this->input->post('sde_number');

			$postData = $this->input->post();
			
			$get_sde_incetive_urban_result = $this->icmodel->verify_data_sde_incentive_report_asm($postData,$postData_where,$type);

			echo json_encode($get_sde_incetive_urban_result);
		}elseif($role_type =='VA' || $role_type =='LEADER'){
			$type="where";
			$sess_mob=$this->session->userdata('mobile');
			$va_number=$sess_mob;
			$zsm_details = $this->icmodel->get_data_zsm_details_('masters',$va_number);
		
		

			$postData_where['username'] = $this->input->post('session_user_name');
			$postData_where['jc_type'] = $this->input->post('jc_type');



			$postData = $this->input->post();

			$get_sde_incetive_urban_result = $this->icmodel->verify_data_sde_incentive_report_val($postData,$postData_where,$type);

			echo json_encode($get_sde_incetive_urban_result);
		}
	}
 
	public function get_sde_list(){ 
		$role_type=$this->session->userdata('role_type');
		$sess_mob=$this->session->userdata('mobile');

		if($role_type =='ZSM' ){
			$user_details= $this->icmodel->get_data('users',$sess_mob);
			$user_id=$user_details[0]->user_id;
			$zsm_number=$sess_mob;
			$asm_number = $this->input->post('asm_number');

		
			$data = $this->icmodel->get_sde_list('masters',$user_id,$zsm_number,$asm_number);
			
			echo json_encode($data);
		}elseif($role_type =='VA' ){
			$user_details= $this->icmodel->get_data('users',$sess_mob);
			$va_name=$user_details[0]->username;
			$zsm_name = $this->input->post('zsm_name');
			$asm_name = $this->input->post('asm_name');

		
			$data = $this->icmodel->get_sde_list_('masters',$sess_mob,$va_name,$zsm_name,$asm_name);
			
			echo json_encode($data);

		}
    }

	public function get_sde_details_view(){ 
		$sess_mob=$this->session->userdata('mobile');
		
		$zsm_number = $sess_mob;
		$asm_number = $this->input->post('asm_number');
		$sde_number = $this->input->post('sde_number');
		$jc_type = $this->input->post('jc_type');
		
        $data_sde_view = $this->icmodel->get_sde_individual_view('sde_incentive_urban',$zsm_number,$asm_number,$sde_number,$jc_type);
			
		if($data_sde_view !== Array()){

			$data['mandays_target'] = $data_sde_view[0]->mandays_target;
			$data['mandays_ach'] = $data_sde_view[0]->mandays_ach;
			$data['mandays_percentage'] = $data_sde_view[0]->mandays_percentage;
			$data['mandays_amount'] = $data_sde_view[0]->mandays_amount;

			$data['orange_salesman_target'] = $data_sde_view[0]->orange_salesman_target;
			$data['orange_salesman_ach'] = $data_sde_view[0]->orange_salesman_ach;
			$data['orange_salesman_percentage'] = $data_sde_view[0]->orange_salesman_percentage;
			$data['orange_salesman_amount'] = $data_sde_view[0]->orange_salesman_amount;

			$data['ck_super_star_target'] = $data_sde_view[0]->ck_super_star_target;
			$data['ck_super_star_ach'] = $data_sde_view[0]->ck_super_star_ach;
			$data['ck_super_star_percentage'] = $data_sde_view[0]->ck_super_star_percentage;
			$data['ck_super_star_amount'] = $data_sde_view[0]->ck_super_star_amount;

			$data['ck_elite_target'] = $data_sde_view[0]->ck_elite_target;
			$data['ck_elite_ach'] = $data_sde_view[0]->ck_elite_ach;
			$data['ck_elite_percentage'] = $data_sde_view[0]->ck_elite_percentage;
			$data['ck_elite_amount'] = $data_sde_view[0]->ck_elite_amount;

			$data['sec_value_target'] = $data_sde_view[0]->sec_value_target;
			$data['sec_value_ach'] = $data_sde_view[0]->sec_value_ach;
			$data['sec_value_percentage'] = $data_sde_view[0]->sec_value_percentage;
			$data['sec_value_amount'] = $data_sde_view[0]->sec_value_amount;

			$data['rising_star_outlet_target'] = $data_sde_view[0]->rising_star_outlet_target;
			$data['rising_star_outlet_ach'] = $data_sde_view[0]->rising_star_outlet_ach;
			$data['rising_star_outlet_percentage'] = $data_sde_view[0]->rising_star_outlet_percentage;
			$data['rising_star_outlet_amount'] = $data_sde_view[0]->rising_star_outlet_amount;
		}else{

			$data['mandays_target'] = 0;
			$data['mandays_ach'] = 0;
			$data['mandays_percentage'] =0 .'%';
			$data['mandays_amount'] = 0;

			$data['orange_salesman_target'] = 0;
			$data['orange_salesman_ach'] = 0;
			$data['orange_salesman_percentage'] =0 .'%';
			$data['orange_salesman_amount'] = 0;

			$data['ck_super_star_target'] = 0;
			$data['ck_super_star_ach'] = 0;
			$data['ck_super_star_percentage'] =0 .'%';
			$data['ck_super_star_amount'] = 0;

			$data['ck_elite_target'] = 0;
			$data['ck_elite_ach'] = 0;
			$data['ck_elite_percentage'] =0 .'%';
			$data['ck_elite_amount'] = 0;

			$data['sec_value_target'] = 0;
			$data['sec_value_ach'] = 0;
			$data['sec_value_percentage'] =0 .'%';
			$data['sec_value_amount'] = 0;

			$data['rising_star_outlet_target'] = 0;
			$data['rising_star_outlet_ach'] = 0;
			$data['rising_star_outlet_percentage'] =0 .'%';
			$data['rising_star_outlet_amount'] = 0;
		}
		
        echo json_encode($data);

    }

	public function get_sde_individual_details(){ 
		$sess_mob=$this->session->userdata('mobile');
	
		$sde_number = $sess_mob;
		$jc_type = $this->input->post('jc_type');

        $data_sde = $this->icmodel->get_sde_individual('sde_incentive_urban',$sde_number,$jc_type);
		

		if($data_sde !== Array()){

			$data['mandays_target'] = $data_sde[0]->mandays_target;
			$data['mandays_ach'] = $data_sde[0]->mandays_ach;
			$data['mandays_percentage'] = $data_sde[0]->mandays_percentage;
			$data['mandays_amount'] = $data_sde[0]->mandays_amount;

			$data['orange_salesman_target'] = $data_sde[0]->orange_salesman_target;
			$data['orange_salesman_ach'] = $data_sde[0]->orange_salesman_ach;
			$data['orange_salesman_percentage'] = $data_sde[0]->orange_salesman_percentage;
			$data['orange_salesman_amount'] = $data_sde[0]->orange_salesman_amount;

			$data['ck_super_star_target'] = $data_sde[0]->ck_super_star_target;
			$data['ck_super_star_ach'] = $data_sde[0]->ck_super_star_ach;
			$data['ck_super_star_percentage'] = $data_sde[0]->ck_super_star_percentage;
			$data['ck_super_star_amount'] = $data_sde[0]->ck_super_star_amount;

			$data['ck_elite_target'] = $data_sde[0]->ck_elite_target;
			$data['ck_elite_ach'] = $data_sde[0]->ck_elite_ach;
			$data['ck_elite_percentage'] = $data_sde[0]->ck_elite_percentage;
			$data['ck_elite_amount'] = $data_sde[0]->ck_elite_amount;

			$data['sec_value_target'] = $data_sde[0]->sec_value_target;
			$data['sec_value_ach'] = $data_sde[0]->sec_value_ach;
			$data['sec_value_percentage'] = $data_sde[0]->sec_value_percentage;
			$data['sec_value_amount'] = $data_sde[0]->sec_value_amount;

			$data['rising_star_outlet_target'] = $data_sde[0]->rising_star_outlet_target;
			$data['rising_star_outlet_ach'] = $data_sde[0]->rising_star_outlet_ach;
			$data['rising_star_outlet_percentage'] = $data_sde[0]->rising_star_outlet_percentage;
			$data['rising_star_outlet_amount'] = $data_sde[0]->rising_star_outlet_amount;
		}else{

			$data['mandays_target'] = 0;
			$data['mandays_ach'] = 0;
			$data['mandays_percentage'] =0 .'%';
			$data['mandays_amount'] = 0;

			$data['orange_salesman_target'] = 0;
			$data['orange_salesman_ach'] = 0;
			$data['orange_salesman_percentage'] = 0 .'%';
			$data['orange_salesman_amount'] = 0;

			$data['ck_super_star_target'] = 0;
			$data['ck_super_star_ach'] = 0;
			$data['ck_super_star_percentage'] = 0 .'%';
			$data['ck_super_star_amount'] = 0;

			$data['ck_elite_target'] = 0;
			$data['ck_elite_ach'] = 0;
			$data['ck_elite_percentage'] = 0 .'%';
			$data['ck_elite_amount'] = 0;

			$data['sec_value_target'] = 0;
			$data['sec_value_ach'] = 0;
			$data['sec_value_percentage'] = 0 .'%';
			$data['sec_value_amount'] = 0;

			$data['rising_star_outlet_target'] = 0;
			$data['rising_star_outlet_ach'] = 0;
			$data['rising_star_outlet_percentage'] = 0 .'%';
			$data['rising_star_outlet_amount'] = 0;
		}
		
        echo json_encode($data);

    }


	public function get_asm_list(){ 
		$sess_mob=$this->session->userdata('mobile');
		$user_details= $this->icmodel->get_data('users',$sess_mob);
		$va_name=$user_details[0]->username;
		$zsm_name = $this->input->post('zsm_name');

	
        $data = $this->icmodel->get_asm_list('masters',$sess_mob,$va_name,$zsm_name);
		
        echo json_encode($data);
    }


	public function sde_incentive_slub(){

		$this->load->view('incentive/sde_inc_slub');	
	}


	public function get_slub_datas(){
		$postData = $this->input->post();
		$data = $this->icmodel->get_slub_parameters($postData ,'sde_incentive_policy_urban');
		echo json_encode($data);

	}




}	
