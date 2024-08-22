<?php	
defined('BASEPATH') OR exit('No direct script access allowed');	
class RSSMController extends CI_Controller {	
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

        $this->load->model('sales/Common_model', 'cmodel');

		if ( !$this->session->userdata('logged_in')){ 	
			redirect(tso_portal_base_url(), 'refresh');	
			// redirect('http://localhost/CK_TSO_Portal/');
				
        }	
        	
    }	

	public function add_rssm_rec_form(){	
		$this->load->view('salesman_onboarding/TSO/add_rssm_rec_form');	
	}	
	
	public function rssm_entered_form(){	
		$this->load->view('salesman_onboarding/TSO/rssm_entered_form');	
	}	
	
    public function rssm_funnel_form(){	
		$this->load->view('salesman_onboarding/TSO/rssm_funnel_form');	
	}
	public function fee_rejection_forms(){	
		$this->load->view('salesman_onboarding/TSO/rejected_salary');	
	}	

	public function edit_rssm_rec_form(){
		$this->load->view('salesman_onboarding/TSO/edit_rssm_rec_form');
	}
	
	public function rssm_rejected_form(){	
		$this->load->view('salesman_onboarding/TSO/rssm_rejected_form');	
	}

	public function edit_rssm_rejected_form(){
		$this->load->view('salesman_onboarding/TSO/edit_rejected_form');
	}

	public function get_sales_cat_list(){

		// $where_cond['state_name !='] = '';get_sales_cat_list
		$where_cond['status !='] = 0;

		$state_list_result = $this->cmodel->get_table_list('sales_category',$where_cond,'sales_category','sales_category');

        echo json_encode($state_list_result);
	}

	public function get_sales_cat_limit(){

		$where_cond['sales_category'] = $this->input->post('sales_cat');
		// $where_cond['status !='] = 0;

		$state_list_result = $this->cmodel->get_table_list('sales_category',$where_cond,'sales_category','sales_category');

        echo json_encode($state_list_result);
	}

	public function get_state_list(){

		$where_cond['state_name !='] = '';
		$where_cond['tso_mobile'] = $this->session->userdata('mobile');

		$state_list_result = $this->cmodel->get_table_list('rs_mkt_master',$where_cond,'state_name','state_name');

        echo json_encode($state_list_result);
	}

	public function get_division_list(){

		$where_cond['district_name !='] = '';
		$where_cond['state_name'] = $this->input->post('state');
		$where_cond['tso_mobile'] = $this->session->userdata('mobile');


		$division_list_result = $this->cmodel->get_table_list('rs_mkt_master',$where_cond,'district_name','district_name');

        echo json_encode($division_list_result);
	}

	public function get_town_list(){

		$where_cond['town_name !='] = '';
		$where_cond['city_name'] = $this->input->post('city');
		$where_cond['tso_mobile'] = $this->session->userdata('mobile');


		$town_list_result = $this->cmodel->get_table_list('rs_mkt_master',$where_cond,'town_name','town_name');

        echo json_encode($town_list_result);
	}

	public function get_additional_details_list(){
		
		$where_cond['role_type'] = 'RSSM';
		$where_cond['business'] = $this->session->userdata('business');

		$additional_details_list_result = $this->cmodel->verify_data('additional_info_recruit',$where_cond);

        echo json_encode($additional_details_list_result);
	}

	public function get_additional_details_list_new(){
		$current_rowid = $this->input->post('current_rowid');
		$where_cond_1['auto_id'] = $current_rowid;
		$form_list = $this->cmodel->verify_data('rssm_recruitment_form',$where_cond_1);
		
		$where_cond_2['mobile'] = $form_list[0]->created_by;

		$business_info = $this->cmodel->verify_data('users',$where_cond_2);

		$where_cond['role_type'] = 'RSSM';
		$where_cond['business'] = $business_info[0]->business;

		$additional_details_list_result = $this->cmodel->verify_data('additional_info_recruit',$where_cond);

        echo json_encode($additional_details_list_result);
	}

	public function addRssmForm(){
		// print_r(1);

		// print_r($this->input->post('div_head_status'));die;
		
		$status = $this->input->post('save_status');
		$files = $_FILES;
		$resume='';

		if (isset( $_FILES["c_resume"] ) && !empty( $_FILES["c_resume"]["name"] ) ) {
            $files = $_FILES['c_resume'];
            $errors = array();
			
			if(sizeof($errors)==0){
				$this->load->library('upload');
				$config['upload_path'] = './uploads/sales/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';

					$ext = pathinfo($files['name'], PATHINFO_EXTENSION);

					$_FILES['uploadedimage']['name'] = rand().".".$ext;
					$_FILES['uploadedimage']['type'] = $files['type'];
					$_FILES['uploadedimage']['tmp_name'] = $files['tmp_name'];
					$_FILES['uploadedimage']['error'] = $files['error'];
					$_FILES['uploadedimage']['size'] = $files['size'];
					$resume = $_FILES['uploadedimage']['name'];

					$this->upload->initialize($config);
					if ($this->upload->do_upload('uploadedimage')){
							
						$data['uploads'] = $this->upload->data();
					}
					else {
						$data['upload_errors'] = $this->upload->display_errors();
					}
			}

		}

		$get_cur_auto_id = $this->cmodel->cur_auto_id('rssm_recruitment_form');
        $auto_id = "RRF".str_pad( ( $get_cur_auto_id+1 ), 5, 0, STR_PAD_LEFT);
		if(!empty($_FILES['cheque_copy']['name'])){
            $config['upload_path'] = 'uploads/sales/cheque/';
            $config['allowed_types'] = '*';
			$config['max_size']     = '20000';
			$ext = pathinfo($_FILES['cheque_copy']['name'], PATHINFO_EXTENSION);
            $config['file_name'] = time().rand(1,100).'.'.$ext;
			// '_'.$_FILES['cheque_copy']['name'];

            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            if($this->upload->do_upload('cheque_copy')){
                $uploadData = $this->upload->data();
                $cheque = $uploadData['file_name'];
            }else{
				print_r($this->upload->display_errors());
                $cheque = '';
            }
        }else{
            $cheque = '';
        }

        if(!empty($_FILES['pan_copy']['name'])){
            $config['upload_path'] = 'uploads/sales/pan/';
            $config['allowed_types'] = '*';
			$config['max_size']     = '20000';
            // $config['allowed_types'] = 'jpg|jpeg|png|gif|jfif';
			$ext = pathinfo($_FILES['pan_copy']['name'], PATHINFO_EXTENSION);

            $config['file_name'] = time().rand(1,100).'.'.$ext;

            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('pan_copy')){
                $uploadData = $this->upload->data();
                $pan = $uploadData['file_name'];
            }else{
                $pan = '';
            }
        }else{
            $pan = '';
        }

        if(!empty($_FILES['aadhar_copy']['name'])){
            $config['upload_path'] = 'uploads/sales/aadhar/';
            $config['allowed_types'] = '*';
			$config['max_size']     = '20000';
			$ext = pathinfo($_FILES['aadhar_copy']['name'], PATHINFO_EXTENSION);

            $config['file_name'] = time().rand(1,100).'.'.$ext;
			// $_FILES['aadhar_copy']['name'];

            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('aadhar_copy')){
                $uploadData = $this->upload->data();
                $aadhar = $uploadData['file_name'];
            }else{
                $aadhar = '';
            }
        }else{
            $aadhar = '';
        }
		$aadhar_b = '';
		if(!empty($_FILES['aadhar_copy_b']['name'])){
            $config['upload_path'] = 'uploads/sales/aadhar_backview/';
            $config['allowed_types'] = '*';
			$config['max_size']     = '20000';
			$ext = pathinfo($_FILES['aadhar_copy_b']['name'], PATHINFO_EXTENSION);

            $config['file_name'] = time().rand(1,100).'.'.$ext;
			// $_FILES['aadhar_copy']['name'];

            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('aadhar_copy_b')){
                $uploadData = $this->upload->data();
                $aadhar_b = $uploadData['file_name'];
            }else{
                $aadhar_b = '';
            }
        }else{
            $aadhar_b = '';
        }
		if(!empty($_FILES['image_file']['name'])){
            $config['upload_path'] = 'uploads/sales/image/';
            $config['allowed_types'] = '*';
			$config['max_size']     = '20000';
            // $config['file_name'] = $_FILES['image_file']['name'];
			$ext = pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION);

			$config['file_name'] = time().rand(1,100).'.'.$ext;

            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('image_file')){
                $uploadData = $this->upload->data();
                $img_file = $uploadData['file_name'];
            }else{
                $img_file = '';
            }
        }else{
            $img_file = '';
        }

		if(!empty($this->input->post('c_experience'))){
			$get_experience = explode(" | ",$this->input->post('c_experience'));
			$experience = $get_experience[0];
			$exp_point = $get_experience[1];
			$where_cond['experience'] = $experience;
			$where_cond['exp_point'] = $exp_point;
		}
		if(!empty($this->input->post('c_education'))){
			$get_education = explode(" | ",$this->input->post('c_education'));
			$education = $get_education[0];
			$edu_point = $get_education[1];
			$where_cond['education'] = $education;
			$where_cond['edu_point'] = $edu_point;
		}
		if(!empty($this->input->post('c_age'))){
			$get_age = explode(" | ",$this->input->post('c_age'));
			$age = $get_age[0];
			$age_point = $get_age[1];
			$where_cond['age'] = $age;
			$where_cond['age_point'] = $age_point;
		}
		if(!empty($this->input->post('c_tknowledge'))){
			$get_tknowledge = explode(" | ",$this->input->post('c_tknowledge'));
			$tknowledge = $get_tknowledge[0];
			$tk_point = $get_tknowledge[1];
			$where_cond['terrain_knowledge'] = $tknowledge;
			$where_cond['tk_point'] = $tk_point;
		}
		if(!empty($this->input->post('c_tech_adaption'))){
			$get_tech_adaption = explode(" | ",$this->input->post('c_tech_adaption'));
			$tech_adaption = $get_tech_adaption[0];
			$ta_point = $get_tech_adaption[1];
			$where_cond['tech_adoption'] = $tech_adaption;
			$where_cond['ta_point'] = $ta_point;
		}
		if(!empty($this->input->post('c_familybg'))){
			$get_familybg = explode(" | ",$this->input->post('c_familybg'));
			$tech_familybg = $get_familybg[0];
			$fb_point = $get_familybg[1];
			$where_cond['family_bg'] = $tech_familybg;
			$where_cond['fb_point'] = $fb_point;
		}
		
		$where_cond['auto_id'] = $auto_id;
		$where_cond['name'] = $this->input->post('c_name');
		$where_cond['ex_rssm_name'] = $this->input->post('c_ex_rssm_name');
		$where_cond['mobile_no'] = $this->input->post('c_mobile_no');
		$where_cond['alt_mobile_no'] = $this->input->post('c_altmobile_no');
		$where_cond['address'] = $this->input->post('c_address');
		$where_cond['state'] = $this->input->post('state_name');
		$where_cond['division'] = $this->input->post('c_division');
		$where_cond['town'] = $this->input->post('c_town');
		$where_cond['resume'] = $resume;
		$where_cond['status'] = $status;
		// $where_cond['va_status'] = 'Verified';
		$where_cond['asm_status'] = 'Inprogress';
		$where_cond['created_by'] = $this->session->userdata('mobile');
		

        $where_cond['rs_code'] = $this->input->post('rs_code', TRUE);
        $where_cond['rs_name'] = $this->input->post('select_rs_name', TRUE);
        $where_cond['region'] = $this->input->post('region_name', TRUE);
        $where_cond['rs_state'] = $this->input->post('state_name', TRUE);
        $where_cond['rs_dist'] = $this->input->post('c_division', TRUE);
        $where_cond['rs_city'] = $this->input->post('c_city', TRUE);
        $where_cond['rs_town'] = $this->input->post('c_town', TRUE);
        $where_cond['rs_town_code'] = $this->input->post('town_code', TRUE);
       
        $where_cond['dob'] = $this->input->post('dob', TRUE);
        $where_cond['doj'] = $this->input->post('doj', TRUE);
        $where_cond['email'] = $this->input->post('email', TRUE);
        $where_cond['father_name'] = $this->input->post('f_name', TRUE);
        $where_cond['aadhar'] = $this->input->post('aadhar_num', TRUE);
        $where_cond['pan'] = $this->input->post('pan_num', TRUE);
        $where_cond['bank_name'] = $this->input->post('b_name', TRUE);
        $where_cond['ac_number'] = $this->input->post('ac_num', TRUE);
        $where_cond['ifsc_s_number'] = $this->input->post('ifsc_code', TRUE);
        $where_cond['branch_name'] = $this->input->post('branch_name', TRUE);
        $where_cond['division_head_status'] = $this->input->post('div_head_status', TRUE);
        $where_cond['service_fee'] = $this->input->post('service_fee', TRUE);
		// $where_cond['business_division'] = $this->input->post('division', TRUE);
		// $where_cond['ex_sales_category'] = $this->input->post('rssm_select_existing', TRUE);

        // if($_FILES)
        $where_cond['cheque'] = $cheque;
        $where_cond['aadhar_copy'] = $aadhar;
        $where_cond['aadhar_backview'] = $aadhar_b;

        $where_cond['pan_copy'] = $pan;
		$where_cond['img_file'] = $img_file;
        $where_cond['sales_type'] = $this->input->post('rssm_type_select', TRUE);
        $where_cond['sales_cat'] = $this->input->post('rssm_select', TRUE);
        $where_cond['ex_rssm_number'] = $this->input->post('ex_rssm_number', TRUE);
		$where_cond['ac_type'] = $this->input->post('ac_type', TRUE);
			if(isset($_POST['beat']) && is_array($_POST['beat']) ) {
				if($_POST['beat'] != ''){
					$sep_beat = implode(',', $_POST['beat']); 
				}else{
					$sep_beat = '';
				}
			}
		
		$where_cond['beat_name'] = $sep_beat;


		$addform_result = $this->cmodel->data_add('rssm_recruitment_form',$where_cond);

        if($addform_result){
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

	public function get_entered_rssmforms(){

		$postData_where['created_by'] = $this->session->mobile;
		$postData_where['status'] = 1;

		if($this->input->post('af_va_status') !=''){
			$postData_where['va_status'] = $this->input->post('af_va_status');
		}
		if($this->input->post('af_asm_status') !=''){
			$postData_where['asm_status'] = $this->input->post('af_asm_status');
		}
		
		$postData = $this->input->post();
        
        $get_entered_rssmforms_result = $this->cmodel->verify_data_erssmforms($postData,$postData_where);

        echo json_encode($get_entered_rssmforms_result);
	}

	public function get_funnel_rssmforms(){

		$postData_where['created_by'] = $this->session->mobile;
		$postData_where['status'] = 0;

		$postData = $this->input->post();
        
        $get_funnel_rssmforms_result = $this->cmodel->verify_data_frssmforms($postData,$postData_where);

        echo json_encode($get_funnel_rssmforms_result);
	}

	public function get_adtdetails_rssm(){

		$where_cond['auto_id'] = $this->input->post('table_row_id');

		$get_adtdetails_rssm_sde_result = $this->cmodel->verify_data_get('rssm_recruitment_form',$where_cond);
		
		$get_adtdetails_rssm_vso_result = $this->cmodel->verify_data('rssm_recruitment_form_vso',$where_cond);

		// $get_asm_name = $this->cmodel->get_name('rssm_recruitment_form',$where_cond,'name');
		if(count($get_adtdetails_rssm_vso_result) ==0){
			$vso_result = $get_adtdetails_rssm_sde_result;
		}else{
			$vso_result = $get_adtdetails_rssm_vso_result;
		}
		$result = array(
			"get_adtdetails_rssm_sde_result" => $get_adtdetails_rssm_sde_result,
			"get_adtdetails_rssm_vso_result" => $vso_result,
		);
		echo json_encode($result);

	}

	

	public function get_rssm_edit_form(){
		
		$where_cond['auto_id'] = $this->input->post('current_rowid');

		if($this->session->userdata('role') == 'VA'){
			$get_rssm_edit_form_result = $this->cmodel->verify_data('rssm_recruitment_form_vso',$where_cond);

			if(count($get_rssm_edit_form_result)==0){
				$get_rssm_edit_form_result = $this->cmodel->verify_data('rssm_recruitment_form',$where_cond);

			}
		}else{
			$get_rssm_edit_form_result = $this->cmodel->verify_data('rssm_recruitment_form',$where_cond);

		}

        echo json_encode($get_rssm_edit_form_result);
	}

	public function editRssmForm(){

		if($this->session->role =='VA'){
			// check record already exits
			$auto_id = $this->input->post('edit_row_id');

			$where_cond['auto_id'] = $auto_id;

			$get_rssm_edit_form_count_result = $this->cmodel->verify_data('rssm_recruitment_form_vso',$where_cond);
			
			if(count($get_rssm_edit_form_count_result) ==0){
				$status = $this->input->post('save_status');
				$files = $_FILES;
				$resume='';

				if (isset( $_FILES["c_resume"] ) && !empty( $_FILES["c_resume"]["name"] ) ) {
					$files = $_FILES['c_resume'];
					$errors = array();
					
					if(sizeof($errors)==0){
						$this->load->library('upload');
						$config['upload_path'] = './uploads/sales';
						$config['allowed_types'] = '*';
						$config['max_size']     = '20000';

							$ext = pathinfo($files['name'], PATHINFO_EXTENSION);

							$_FILES['uploadedimage']['name'] = rand().".".$ext;
							$_FILES['uploadedimage']['type'] = $files['type'];
							$_FILES['uploadedimage']['tmp_name'] = $files['tmp_name'];
							$_FILES['uploadedimage']['error'] = $files['error'];
							$_FILES['uploadedimage']['size'] = $files['size'];
							$resume = $_FILES['uploadedimage']['name'];

							$this->upload->initialize($config);
							if ($this->upload->do_upload('uploadedimage')){
									
								$data['uploads'] = $this->upload->data();
							}
							else {
									$data['upload_errors'] = $this->upload->display_errors();
							}
					}

				}

				if(!empty($this->input->post('c_experience'))){
					$get_experience = explode(" | ",$this->input->post('c_experience'));
					$experience = $get_experience[0];
					$exp_point = $get_experience[1];
					$where_cond['experience'] = $experience;
					$where_cond['exp_point'] = $exp_point;
				}
				if(!empty($this->input->post('c_education'))){
					$get_education = explode(" | ",$this->input->post('c_education'));
					$education = $get_education[0];
					$edu_point = $get_education[1];
					$where_cond['education'] = $education;
					$where_cond['edu_point'] = $edu_point;
				}
				if(!empty($this->input->post('c_age'))){
					$get_age = explode(" | ",$this->input->post('c_age'));
					$age = $get_age[0];
					$age_point = $get_age[1];
					$where_cond['age'] = $age;
					$where_cond['age_point'] = $age_point;
				}
				if(!empty($this->input->post('c_tknowledge'))){
					$get_tknowledge = explode(" | ",$this->input->post('c_tknowledge'));
					$tknowledge = $get_tknowledge[0];
					$tk_point = $get_tknowledge[1];
					$where_cond['terrain_knowledge'] = $tknowledge;
					$where_cond['tk_point'] = $tk_point;
				}
				if(!empty($this->input->post('c_tech_adaption'))){
					$get_tech_adaption = explode(" | ",$this->input->post('c_tech_adaption'));
					$tech_adaption = $get_tech_adaption[0];
					$ta_point = $get_tech_adaption[1];
					$where_cond['tech_adoption'] = $tech_adaption;
					$where_cond['ta_point'] = $ta_point;
				}
				if(!empty($this->input->post('c_familybg'))){
					$get_familybg = explode(" | ",$this->input->post('c_familybg'));
					$tech_familybg = $get_familybg[0];
					$fb_point = $get_familybg[1];
					$where_cond['family_bg'] = $tech_familybg;
					$where_cond['fb_point'] = $fb_point;
				}
				
				$where_cond['auto_id'] = $auto_id;
				$where_cond['name'] = $this->input->post('c_name');
				$where_cond['ex_rssm_name'] = $this->input->post('c_ex_rssm_name');
				$where_cond['mobile_no'] = $this->input->post('c_mobile_no');
				$where_cond['alt_mobile_no'] = $this->input->post('c_altmobile_no');
				$where_cond['address'] = $this->input->post('c_address');
				$where_cond['state'] = $this->input->post('state_name');
				$where_cond['division'] = $this->input->post('c_division');
				$where_cond['town'] = $this->input->post('c_town');
				$where_cond['resume'] = $resume;
				$where_cond['status'] = $status;
				// $where_cond['va_status'] = 'Inprogress';
				$where_cond['asm_status'] = 'Inprogress';
				$where_cond['created_by'] = $this->session->userdata('mobile');

				$addform_result = $this->cmodel->data_add('rssm_recruitment_form_vso',$where_cond);
				if($this->session->userdata('role') =='TSO' || $this->session->userdata('role') =='ASM' || $this->session->userdata('role') =='ZSM'){
					$url = 'RSSMController/rssm_entered_form';
				}
				elseif ($this->session->userdata('role') == 'VA') {
					$url = 'rssm_eform_va';
				}
				else{
					$url ='';
				}

				if($addform_result){
					$result = array(
						"response" => "success",
						"url" =>$url
					);
					echo json_encode($result);
				}
				else{
					$result = array(
						"response" => "failed",
						"url" =>$url

					);
					echo json_encode($result);
				}

			}else{
				
				$status = $this->input->post('save_status');
				$files = $_FILES;
				$resume='';

				if (isset( $_FILES["c_resume"] ) && !empty( $_FILES["c_resume"]["name"] ) ) {
					$files = $_FILES['c_resume'];
					$errors = array();
					
					if(sizeof($errors)==0){
						$this->load->library('upload');
						$config['upload_path'] = './uploads/sales/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';

							$ext = pathinfo($files['name'], PATHINFO_EXTENSION);

							$_FILES['uploadedimage']['name'] = rand().".".$ext;
							$_FILES['uploadedimage']['type'] = $files['type'];
							$_FILES['uploadedimage']['tmp_name'] = $files['tmp_name'];
							$_FILES['uploadedimage']['error'] = $files['error'];
							$_FILES['uploadedimage']['size'] = $files['size'];
							$resume = $_FILES['uploadedimage']['name'];

							$this->upload->initialize($config);
							if ($this->upload->do_upload('uploadedimage')){
									
								$data['uploads'] = $this->upload->data();
							}
							else {
									$data['upload_errors'] = $this->upload->display_errors();
							}
					}

				}
				
				$auto_id = $this->input->post('edit_row_id');

				if(!empty($this->input->post('c_experience'))){
					$get_experience = explode(" | ",$this->input->post('c_experience'));
					$experience = $get_experience[0];
					$exp_point = $get_experience[1];
					$where_cond['experience'] = $experience;
					$where_cond['exp_point'] = $exp_point;
				}
				if(!empty($this->input->post('c_education'))){
					$get_education = explode(" | ",$this->input->post('c_education'));
					$education = $get_education[0];
					$edu_point = $get_education[1];
					$where_cond['education'] = $education;
					$where_cond['edu_point'] = $edu_point;
				}
				if(!empty($this->input->post('c_age'))){
					$get_age = explode(" | ",$this->input->post('c_age'));
					$age = $get_age[0];
					$age_point = $get_age[1];
					$where_cond['age'] = $age;
					$where_cond['age_point'] = $age_point;
				}
				if(!empty($this->input->post('c_tknowledge'))){
					$get_tknowledge = explode(" | ",$this->input->post('c_tknowledge'));
					$tknowledge = $get_tknowledge[0];
					$tk_point = $get_tknowledge[1];
					$where_cond['terrain_knowledge'] = $tknowledge;
					$where_cond['tk_point'] = $tk_point;
				}
				if(!empty($this->input->post('c_tech_adaption'))){
					$get_tech_adaption = explode(" | ",$this->input->post('c_tech_adaption'));
					$tech_adaption = $get_tech_adaption[0];
					$ta_point = $get_tech_adaption[1];
					$where_cond['tech_adoption'] = $tech_adaption;
					$where_cond['ta_point'] = $ta_point;
				}
				if(!empty($this->input->post('c_familybg'))){
					$get_familybg = explode(" | ",$this->input->post('c_familybg'));
					$tech_familybg = $get_familybg[0];
					$fb_point = $get_familybg[1];
					$where_cond['family_bg'] = $tech_familybg;
					$where_cond['fb_point'] = $fb_point;
				}
				
				$where_cond['name'] = $this->input->post('c_name');
				$where_cond['ex_rssm_name'] = $this->input->post('c_ex_rssm_name');
				$where_cond['mobile_no'] = $this->input->post('c_mobile_no');
				$where_cond['alt_mobile_no'] = $this->input->post('c_altmobile_no');
				$where_cond['address'] = $this->input->post('c_address');
				$where_cond['state'] = $this->input->post('state_name');
				$where_cond['division'] = $this->input->post('c_division');
				$where_cond['town'] = $this->input->post('c_town');
				if($resume !=''){
					$where_cond['resume'] = $resume;
					
				}
				
				$where_cond['status'] = $status;

				// print_r($where_cond);

				$editform_result = $this->cmodel->updates('rssm_recruitment_form_vso',$where_cond, 'auto_id', $auto_id);

				if($this->session->userdata('role') =='TSO' || $this->session->userdata('role') =='ASM' || $this->session->userdata('role') =='ZSM'){
					$url = 'RSSMController/rssm_entered_form';
				}
				elseif ($this->session->userdata('role') == 'VA') {
					$url = 'rssm_eform_va';
				}
				else{
					$url ='';
				}
				if($editform_result){
					$result = array(
						"response" => "success",
						"url" => $url
					);
					echo json_encode($result);
				}
				else{
					$result = array(
						"response" => "failed",
						"url" => $url
					);
					echo json_encode($result);
				}
				
			}
			exit;
		}else{

			$status = $this->input->post('save_status');
			$files = $_FILES;
			$resume='';

			if (isset( $_FILES["c_resume"] ) && !empty( $_FILES["c_resume"]["name"] ) ) {
				$files = $_FILES['c_resume'];
				$errors = array();
				
				if(sizeof($errors)==0){
					$this->load->library('upload');
					$config['upload_path'] = './uploads/sales/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';

						$ext = pathinfo($files['name'], PATHINFO_EXTENSION);

						$_FILES['uploadedimage']['name'] = rand().".".$ext;
						$_FILES['uploadedimage']['type'] = $files['type'];
						$_FILES['uploadedimage']['tmp_name'] = $files['tmp_name'];
						$_FILES['uploadedimage']['error'] = $files['error'];
						$_FILES['uploadedimage']['size'] = $files['size'];
						$resume = $_FILES['uploadedimage']['name'];

						$this->upload->initialize($config);
						if ($this->upload->do_upload('uploadedimage')){
								
							$data['uploads'] = $this->upload->data();
						}
						else {
								$data['upload_errors'] = $this->upload->display_errors();
						}
				}

			}
			
			$auto_id = $this->input->post('edit_row_id');

			if(!empty($this->input->post('c_experience'))){
				$get_experience = explode(" | ",$this->input->post('c_experience'));
				$experience = $get_experience[0];
				$exp_point = $get_experience[1];
				$where_cond['experience'] = $experience;
				$where_cond['exp_point'] = $exp_point;
			}
			if(!empty($this->input->post('c_education'))){
				$get_education = explode(" | ",$this->input->post('c_education'));
				$education = $get_education[0];
				$edu_point = $get_education[1];
				$where_cond['education'] = $education;
				$where_cond['edu_point'] = $edu_point;
			}
			if(!empty($this->input->post('c_age'))){
				$get_age = explode(" | ",$this->input->post('c_age'));
				$age = $get_age[0];
				$age_point = $get_age[1];
				$where_cond['age'] = $age;
				$where_cond['age_point'] = $age_point;
			}
			if(!empty($this->input->post('c_tknowledge'))){
				$get_tknowledge = explode(" | ",$this->input->post('c_tknowledge'));
				$tknowledge = $get_tknowledge[0];
				$tk_point = $get_tknowledge[1];
				$where_cond['terrain_knowledge'] = $tknowledge;
				$where_cond['tk_point'] = $tk_point;
			}
			if(!empty($this->input->post('c_tech_adaption'))){
				$get_tech_adaption = explode(" | ",$this->input->post('c_tech_adaption'));
				$tech_adaption = $get_tech_adaption[0];
				$ta_point = $get_tech_adaption[1];
				$where_cond['tech_adoption'] = $tech_adaption;
				$where_cond['ta_point'] = $ta_point;
			}
			if(!empty($this->input->post('c_familybg'))){
				$get_familybg = explode(" | ",$this->input->post('c_familybg'));
				$tech_familybg = $get_familybg[0];
				$fb_point = $get_familybg[1];
				$where_cond['family_bg'] = $tech_familybg;
				$where_cond['fb_point'] = $fb_point;
			}

			// if(!empty($_FILES['cheque_copy']['name'])){
			// 	$config['upload_path'] = 'uploads/cheque/';
			// 	$config['allowed_types'] = 'jpg|jpeg|png|gif';
			// 	$config['file_name'] = $_FILES['cheque_copy']['name'];
	
			// 	$this->load->library('upload',$config);
			// 	$this->upload->initialize($config);
				
			// 	if($this->upload->do_upload('cheque_copy')){
			// 		$uploadData = $this->upload->data();
			// 		$cheque = $uploadData['file_name'];
			// 	}else{
			// 		$cheque = '';
			// 	}
			// }else{
			// 	$cheque = '';
			// }
	
			// if(!empty($_FILES['pan_copy']['name'])){
			// 	$config['upload_path'] = 'uploads/pan/';
			// 	$config['allowed_types'] = 'jpg|jpeg|png|gif';
			// 	$config['file_name'] = $_FILES['pan_copy']['name'];
	
			// 	$this->load->library('upload',$config);
			// 	$this->upload->initialize($config);
				
			// 	if($this->upload->do_upload('pan_copy')){
			// 		$uploadData = $this->upload->data();
			// 		$pan = $uploadData['file_name'];
			// 	}else{
			// 		$pan = '';
			// 	}
			// }else{
			// 	$pan = '';
			// }
	
			// if(!empty($_FILES['aadhar_copy']['name'])){
			// 	$config['upload_path'] = 'uploads/aadhar/';
			// 	$config['allowed_types'] = 'jpg|jpeg|png|gif';
			// 	$config['file_name'] = $_FILES['aadhar_copy']['name'];
	
			// 	$this->load->library('upload',$config);
			// 	$this->upload->initialize($config);
				
			// 	if($this->upload->do_upload('aadhar_copy')){
			// 		$uploadData = $this->upload->data();
			// 		$aadhar = $uploadData['file_name'];
			// 	}else{
			// 		$aadhar = '';
			// 	}
			// }else{
			// 	$aadhar = '';
			// }
	
			// if(!empty($_FILES['image_file']['name'])){
			// 	$config['upload_path'] = 'uploads/image/';
			// 	$config['allowed_types'] = 'jpg|jpeg|png|gif';
			// 	$config['file_name'] = $_FILES['image_file']['name'];
	
			// 	$this->load->library('upload',$config);
			// 	$this->upload->initialize($config);
				
			// 	if($this->upload->do_upload('image_file')){
			// 		$uploadData = $this->upload->data();
			// 		$img_file = $uploadData['file_name'];
			// 	}else{
			// 		$img_file = '';
			// 	}
			// }else{
			// 	$img_file = '';
			// }
			
			$where_cond['name'] = $this->input->post('c_name');
			$where_cond['ex_rssm_name'] = $this->input->post('c_ex_rssm_name');
			$where_cond['mobile_no'] = $this->input->post('c_mobile_no');
			$where_cond['alt_mobile_no'] = $this->input->post('c_altmobile_no');
			$where_cond['address'] = $this->input->post('c_address');
			$where_cond['state'] = $this->input->post('state_name');
			$where_cond['division'] = $this->input->post('c_division');
			$where_cond['town'] = $this->input->post('c_town');
			if($resume !=''){
				$where_cond['resume'] = $resume;
				
			}

			$where_cond['rs_code'] = $this->input->post('rs_code', TRUE);
        $where_cond['rs_name'] = $this->input->post('select_rs_name', TRUE);
        $where_cond['region'] = $this->input->post('region_name', TRUE);
        $where_cond['rs_state'] = $this->input->post('state_name', TRUE);
        $where_cond['rs_dist'] = $this->input->post('c_division', TRUE);
        $where_cond['rs_city'] = $this->input->post('c_city', TRUE);
        $where_cond['rs_town'] = $this->input->post('c_town', TRUE);
        $where_cond['rs_town_code'] = $this->input->post('town_code', TRUE);
       
        $where_cond['dob'] = $this->input->post('dob', TRUE);
        $where_cond['doj'] = $this->input->post('doj', TRUE);
        $where_cond['email'] = $this->input->post('email', TRUE);
        $where_cond['father_name'] = $this->input->post('f_name', TRUE);
        $where_cond['aadhar'] = $this->input->post('aadhar_num', TRUE);
        $where_cond['pan'] = $this->input->post('pan_num', TRUE);
        $where_cond['bank_name'] = $this->input->post('b_name', TRUE);
        $where_cond['ac_number'] = $this->input->post('ac_num', TRUE);
        $where_cond['ifsc_s_number'] = $this->input->post('ifsc_code', TRUE);
        $where_cond['branch_name'] = $this->input->post('branch_name', TRUE);
        // if($_FILES)
        // $where_cond['cheque'] = $cheque;
        // $where_cond['aadhar_copy'] = $aadhar;
        // $where_cond['pan_copy'] = $pan;

		// $where_cond['img_file'] = $img_file;

        $where_cond['sales_type'] = $this->input->post('rssm_type_select', TRUE);
        $where_cond['sales_cat'] = $this->input->post('rssm_select', TRUE);
        $where_cond['ex_rssm_number'] = $this->input->post('ex_rssm_number', TRUE);
		$where_cond['ac_type'] = $this->input->post('ac_type', TRUE);
		$where_cond['service_fee'] = $this->input->post('service_fee', TRUE);
		// $where_cond['business_division'] = $this->input->post('division', TRUE);
		// $where_cond['ex_sales_category'] = $this->input->post('rssm_select_existing', TRUE);

		if(isset($_POST['beat']) && is_array($_POST['beat'])) {
			$sep_beat = implode(',', $_POST['beat']); 
		}
	
		$where_cond['beat_name'] = $sep_beat;
			
			$where_cond['status'] = $status;

			// print_r($where_cond);

			$editform_result = $this->cmodel->updates('rssm_recruitment_form',$where_cond, 'auto_id', $auto_id);

			if($this->session->userdata('role') =='TSO' || $this->session->userdata('role') =='ASM' || $this->session->userdata('role') =='ZSM'){
				$url = 'RSSMController/rssm_entered_form';
			}
			elseif ($this->session->userdata('role') == 'VA') {
				$url = 'rssm_eform_va';
			}
			else{
				$url ='';
			}
			if($editform_result){
				$result = array(
					"response" => "success",
					"url" => $url
				);
				echo json_encode($result);
			}
			else{
				$result = array(
					"response" => "failed",
					"url" => $url
				);
				echo json_encode($result);
			}

		}
		
	}

	public function get_region_list(){
		// $where_cond['region !='] = '';
		$where_cond['tso_mobile'] = $this->session->userdata('mobile');
		$region_list_result = $this->cmodel->get_table_list('rs_mkt_master',$where_cond,'region','region');

        echo json_encode($region_list_result);
	}

    public function get_rsdetails(){
		$where_cond['rs_name'] = $this->input->post('rscode');
        $where_cond['tso_mobile'] = $this->session->mobile;
        $region_list_result = $this->cmodel->get_sde_name('rs_mkt_master',$where_cond,'name','id');

        echo json_encode($region_list_result);
    }

    public function get_town_code(){
		$where_cond['town_name'] = $this->input->post('town_name');
		$where_cond['tso_mobile'] = $this->session->userdata('mobile');

		$division_list_result = $this->cmodel->get_table_list('rs_mkt_master',$where_cond,'town_name','town_name');

        echo json_encode($division_list_result);
    }

	public function get_rs_code(){
        $where_cond['rs_code !='] = '';
		$where_cond['rs_name'] = $this->input->post('id');
        $where_cond['tso_mobile'] = $this->session->mobile;
		$division_list_result = $this->cmodel->get_table_list('rs_mkt_master',$where_cond,'rs_code','rs_name');

        echo json_encode($division_list_result);
    }
    public function get_city_list(){

		$where_cond['city_name !='] = '';
		$where_cond['district_name'] = $this->input->post('dist');

		$division_list_result = $this->cmodel->get_table_list('rs_mkt_master',$where_cond,'city_name','city_name');

        echo json_encode($division_list_result);
	}
	public function get_rs_list(){
        $where_cond['tso_mobile'] = $this->session->mobile;
        $where_cond['region'] = $this->input->post('mob_num');
		$where_cond['rs_name !='] = '';

		$division_list_result = $this->cmodel->get_table_list('rs_mkt_master',$where_cond,'rs_code','rs_name');

        echo json_encode($division_list_result);
	}

	// public function get_town_code(){
	// 	$where_cond['town_name'] = $this->input->post('town_name');
	// 	$division_list_result = $this->cmodel->get_table_list('test',$where_cond,'town_name','town_name');

    //     echo json_encode($division_list_result);


    // }

	
	
	public function get_rejected_rssmforms(){
		$postData_where['created_by'] = $this->session->mobile;
		$postData_where['status'] = 1;
		$postData_where['rssm_status'] = 'Rejected';

		$postData = $this->input->post();
        
        $get_funnel_rssmforms_result = $this->cmodel->verify_data_frssmforms($postData,$postData_where);

        echo json_encode($get_funnel_rssmforms_result);
	}

	

	public function re_editRssmForm(){

		$status = $this->input->post('save_status');
		$files = $_FILES;
		$resume='';

		if (isset( $_FILES["c_resume"] ) && !empty( $_FILES["c_resume"]["name"] ) ) {
			$files = $_FILES['c_resume'];
			$errors = array();
			
			if(sizeof($errors)==0){
				$this->load->library('upload');
				$config['upload_path'] = './uploads/sales/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';

					$ext = pathinfo($files['name'], PATHINFO_EXTENSION);

					$_FILES['uploadedimage']['name'] = rand().".".$ext;
					$_FILES['uploadedimage']['type'] = $files['type'];
					$_FILES['uploadedimage']['tmp_name'] = $files['tmp_name'];
					$_FILES['uploadedimage']['error'] = $files['error'];
					$_FILES['uploadedimage']['size'] = $files['size'];
					$resume = $_FILES['uploadedimage']['name'];

					$this->upload->initialize($config);
					if ($this->upload->do_upload('uploadedimage')){
							
						$data['uploads'] = $this->upload->data();
					}
					else {
							$data['upload_errors'] = $this->upload->display_errors();
					}
			}

		}
		
		$auto_id = $this->input->post('edit_row_id');

		if(!empty($this->input->post('c_experience'))){
			$get_experience = explode(" | ",$this->input->post('c_experience'));
			$experience = $get_experience[0];
			$exp_point = $get_experience[1];
			$where_cond['experience'] = $experience;
			$where_cond['exp_point'] = $exp_point;
		}
		if(!empty($this->input->post('c_education'))){
			$get_education = explode(" | ",$this->input->post('c_education'));
			$education = $get_education[0];
			$edu_point = $get_education[1];
			$where_cond['education'] = $education;
			$where_cond['edu_point'] = $edu_point;
		}
		if(!empty($this->input->post('c_age'))){
			$get_age = explode(" | ",$this->input->post('c_age'));
			$age = $get_age[0];
			$age_point = $get_age[1];
			$where_cond['age'] = $age;
			$where_cond['age_point'] = $age_point;
		}
		if(!empty($this->input->post('c_tknowledge'))){
			$get_tknowledge = explode(" | ",$this->input->post('c_tknowledge'));
			$tknowledge = $get_tknowledge[0];
			$tk_point = $get_tknowledge[1];
			$where_cond['terrain_knowledge'] = $tknowledge;
			$where_cond['tk_point'] = $tk_point;
		}
		if(!empty($this->input->post('c_tech_adaption'))){
			$get_tech_adaption = explode(" | ",$this->input->post('c_tech_adaption'));
			$tech_adaption = $get_tech_adaption[0];
			$ta_point = $get_tech_adaption[1];
			$where_cond['tech_adoption'] = $tech_adaption;
			$where_cond['ta_point'] = $ta_point;
		}
		if(!empty($this->input->post('c_familybg'))){
			$get_familybg = explode(" | ",$this->input->post('c_familybg'));
			$tech_familybg = $get_familybg[0];
			$fb_point = $get_familybg[1];
			$where_cond['family_bg'] = $tech_familybg;
			$where_cond['fb_point'] = $fb_point;
		}

		$cheque = '';
		if(!empty($_FILES['cheque_copy']['name'])){
			$config['upload_path'] = 'uploads/sales/cheque/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['file_name'] = time().'_'.$_FILES['cheque_copy']['name'];
			$ext = pathinfo($_FILES['cheque_copy']['name'], PATHINFO_EXTENSION);

			$config['file_name'] = time().rand(1,100).'.'.$ext;
			

			$this->load->library('upload',$config);
			$this->upload->initialize($config);
			
			if($this->upload->do_upload('cheque_copy')){
				$uploadData = $this->upload->data();
				$cheque = $uploadData['file_name'];
			}
		}
		
		$pan = '';
		if(!empty($_FILES['pan_copy']['name'])){
			$config['upload_path'] = 'uploads/sales/pan/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			// $config['file_name'] =time().'_'.$_FILES['pan_copy']['name'];

			$ext = pathinfo($_FILES['pan_copy']['name'], PATHINFO_EXTENSION);

			$config['file_name'] = time().rand(1,100).'.'.$ext;

			$this->load->library('upload',$config);
			$this->upload->initialize($config);
			
			if($this->upload->do_upload('pan_copy')){
				$uploadData = $this->upload->data();
				$pan = $uploadData['file_name'];
			}
		}

		$aadhar = '';
		if(!empty($_FILES['aadhar_copy']['name'])){
			$config['upload_path'] = 'uploads/sales/aadhar/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			// $config['file_name'] =time().'_'. $_FILES['aadhar_copy']['name'];

			$ext = pathinfo($_FILES['aadhar_copy']['name'], PATHINFO_EXTENSION);

			$config['file_name'] = time().rand(1,100).'.'.$ext;

			$this->load->library('upload',$config);
			$this->upload->initialize($config);
			
			if($this->upload->do_upload('aadhar_copy')){
				$uploadData = $this->upload->data();
				$aadhar = $uploadData['file_name'];
			}
		}

		$aadhar_b = '';
		if(!empty($_FILES['aadhar_copy_b']['name'])){
            $config['upload_path'] = 'uploads/sales/aadhar_backview/';
            $config['allowed_types'] = '*';
			$config['max_size']     = '20000';
			$ext = pathinfo($_FILES['aadhar_copy_b']['name'], PATHINFO_EXTENSION);

            $config['file_name'] = time().rand(1,100).'.'.$ext;
			// $_FILES['aadhar_copy']['name'];

            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('aadhar_copy_b')){
                $uploadData = $this->upload->data();
                $aadhar_b = $uploadData['file_name'];
            }else{
                $aadhar_b = '';
            }
        }else{
            $aadhar_b = '';
        }

		$img_file = '';
		if(!empty($_FILES['image_file']['name'])){
			$config['upload_path'] = 'uploads/sales/image/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';

			$ext = pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION);

			$config['file_name'] = time().rand(1,100).'.'.$ext;
			// $_FILES['image_file']['name'];
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
			
			if($this->upload->do_upload('image_file')){
				$uploadData = $this->upload->data();
				$img_file = $uploadData['file_name'];
			}
		}
		
		$where_cond['name'] = $this->input->post('c_name');
		$where_cond['ex_rssm_name'] = $this->input->post('c_ex_rssm_name');
		$where_cond['mobile_no'] = $this->input->post('c_mobile_no');
		$where_cond['alt_mobile_no'] = $this->input->post('c_altmobile_no');
		$where_cond['address'] = $this->input->post('c_address');
		$where_cond['state'] = $this->input->post('state_name');
		$where_cond['division'] = $this->input->post('c_division');
		$where_cond['town'] = $this->input->post('c_town');
		if($resume !=''){
			$where_cond['resume'] = $resume;
		}
		if($pan !=''){
			$where_cond['pan_copy'] = $pan;
		}
		if($aadhar !=''){
			$where_cond['aadhar_copy'] = $aadhar;
		}
		if($img_file !=''){
			$where_cond['img_file'] = $img_file;
		}
		if($cheque !=''){
			$where_cond['cheque'] = $cheque;
		}
		if($aadhar_b !=''){
			$where_cond['aadhar_backview'] = $aadhar_b;
		}
		$where_cond['rs_code'] = $this->input->post('rs_code', TRUE);
        $where_cond['rs_name'] = $this->input->post('select_rs_name', TRUE);
        $where_cond['region'] = $this->input->post('region_name', TRUE);
        $where_cond['rs_state'] = $this->input->post('state_name', TRUE);
        $where_cond['rs_dist'] = $this->input->post('c_division', TRUE);
        $where_cond['rs_city'] = $this->input->post('c_city', TRUE);
        $where_cond['rs_town'] = $this->input->post('c_town', TRUE);
        $where_cond['rs_town_code'] = $this->input->post('town_code', TRUE);
       
        $where_cond['dob'] = $this->input->post('dob', TRUE);
        $where_cond['doj'] = $this->input->post('doj', TRUE);
        $where_cond['email'] = $this->input->post('email', TRUE);
        $where_cond['father_name'] = $this->input->post('f_name', TRUE);
        $where_cond['aadhar'] = $this->input->post('aadhar_num', TRUE);
        $where_cond['pan'] = $this->input->post('pan_num', TRUE);
        $where_cond['bank_name'] = $this->input->post('b_name', TRUE);
        $where_cond['ac_number'] = $this->input->post('ac_num', TRUE);
        $where_cond['ifsc_s_number'] = $this->input->post('ifsc_code', TRUE);
        $where_cond['branch_name'] = $this->input->post('branch_name', TRUE);
        $where_cond['sales_type'] = $this->input->post('rssm_type_select', TRUE);
        $where_cond['sales_cat'] = $this->input->post('rssm_select', TRUE);
        $where_cond['ex_rssm_number'] = $this->input->post('ex_rssm_number', TRUE);
		$where_cond['ac_type'] = $this->input->post('ac_type', TRUE);
		$where_cond['service_fee'] = $this->input->post('service_fee', TRUE);
		// $where_cond['business_division'] = $this->input->post('division', TRUE);
		// $where_cond['ex_sales_category'] = $this->input->post('rssm_select_existing', TRUE);

		$where_cond['status'] = $status;
		if($status == '1'){
			$where_cond['rssm_status'] = '';
			$where_cond['asm_status'] = 'Inprogress';
		}
		if(isset($_POST['beat']) && is_array($_POST['beat'])) {
			$sep_beat = implode(',', $_POST['beat']); 
		}
	
		$where_cond['beat_name'] = $sep_beat;
		$editform_result = $this->cmodel->updates('rssm_recruitment_form',$where_cond, 'auto_id', $auto_id);

		if($this->session->userdata('role') =='TSO' || $this->session->userdata('role') =='ASM' || $this->session->userdata('role') =='ZSM'){
			$url = 'RSSMController/rssm_funnel_form';
		}
		elseif ($this->session->userdata('role') == 'VA') {
			$url = 'rssm_eform_va';
		}
		else{
			$url ='';
		}
		if($editform_result){
			$result = array(
				"response" => "success",
				"url" => $url
			);
			echo json_encode($result);
		}
		else{
			$result = array(
				"response" => "failed",
				"url" => $url
			);
			echo json_encode($result);
		}
		
	}

	public function get_divhead_rejected(){

		$postData_where['created_by'] = $this->session->mobile;
		$postData_where['division_head_status'] = 'Rejected';
		$postData = $this->input->post();
        
        $get_funnel_rssmforms_result = $this->cmodel->verify_data_frssmforms($postData,$postData_where);

        echo json_encode($get_funnel_rssmforms_result);
	}

	public function update_service_fee(){
		$auto_id = $this->input->post('auto_id');
		$where_cond['service_fee'] = $this->input->post('service_fee');
		$where_cond['asm_status'] = 'Inprogress';
		$where_cond['division_head_status'] = null;
		$editfee = $this->cmodel->updates('rssm_recruitment_form',$where_cond, 'auto_id', $auto_id);
		if($editfee){
			$result = array(
				"response" => "success",
			);
			echo json_encode($result);
		}

	}
	public function get_asm_future_prospect(){

		$postData_where['created_by'] = $this->session->mobile;
		$postData_where['status'] = 1;
		$postData_where['asm_status'] = 'Future Prospect';
		
		if($this->input->post('af_va_status') !=''){
			$postData_where['va_status'] = $this->input->post('af_va_status');
		}
		if($this->input->post('af_asm_status') !=''){
			$postData_where['asm_status'] = $this->input->post('af_asm_status');
		}
		
		$postData = $this->input->post();
        
        $get_entered_rssmforms_result = $this->cmodel->verify_data_erssmforms($postData,$postData_where);

        echo json_encode($get_entered_rssmforms_result);
	}

}	
