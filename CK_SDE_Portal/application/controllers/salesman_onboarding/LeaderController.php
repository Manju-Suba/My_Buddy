<?php	
defined('BASEPATH') OR exit('No direct script access allowed');	

use PHPMailer\PHPMailer\PHPMailer;

class LeaderController extends CI_Controller {	
	
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
        $this->load->model('sales/Leader_model', 'lmodel');
        $this->load->model('sales/Asm_model', 'amodel');
        $this->load->model('sales/Zsm_model', 'zmodel');

		if ( !$this->session->userdata('logged_in')){ 	
			redirect(tso_portal_base_url(), 'refresh');	
			// redirect('http://localhost/CK_TSO_Portal/');
				
        }	
        	
    }	

    public function va_verified_forms_ldr(){
		$this->load->view('salesman_onboarding/LEADER/va_verified_forms_ldr');	
    }

    public function rssm_verified_ldr(){
        // $this->load->view('LEADER/rssm_approve_ldr');
		$this->load->view('salesman_onboarding/LEADER/rssm_approve_ldr');	

    }

    public function rssm_rejected_ldr(){
        // $this->load->view('LEADER/rssm_reject_ldr');
		$this->load->view('salesman_onboarding/LEADER/rssm_reject_ldr');	

    }

    public function get_zsm_list(){

		$zsmlist_result = $this->cmodel->get_table_user_list('masters','zsm_number','zsm');

        echo json_encode($zsmlist_result);
    }

    public function get_va_verified_forms(){
        // echo $this->input->post('zsm_number');
        $postData_where_id =array();

        if( $this->input->post('tso_number') !=''){
            $postData_where['created_by'] = $this->input->post('tso_number');

        }
        if( $this->input->post('asm_number') !=''){
            $where_cond['asm_number'] = $this->input->post('asm_number');

        }else{
            $where_cond['zsm_number'] = $this->input->post('zsm_number');

        }

		$tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond,'tso_number','tso');
        
        if(count($tsolist_result) !=0){
            for ($i=0; $i < count($tsolist_result); $i++) { 
                array_push($postData_where_id,$tsolist_result[$i]->tso_number);
            }
        }
        
		// $postData_where['rrf.va_status'] = 'Verified';
		$postData_where['rrf.asm_status'] = 'Inprogress ';
		// $postData_where['rrf.asm_status !='] = 'Future Prospect';
		$postData_where['rrf.status'] = 1;
		$postData = $this->input->post();
        
        $get_va_verified_forms_result = $this->amodel->get_va_verified_forms($postData,$postData_where,$postData_where_id);

        echo json_encode($get_va_verified_forms_result);
    }

    public function ldr_verified_forms(){
		$this->load->view('salesman_onboarding/LEADER/ldr_verified_forms');	
    }

    public function get_asm_verified_forms(){
        $postData_where_id =array();

        if( $this->input->post('tso_number') !=''){
            $postData_where['created_by'] = $this->input->post('tso_number');

        }
        
        if( $this->input->post('asm_number') !=''){
            $where_cond['asm_number'] = $this->input->post('asm_number');

        }else{
            $where_cond['zsm_number'] = $this->input->post('zsm_number');

        }
		$tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond,'tso_number','tso');
        
        if(count($tsolist_result) !=0){
            for ($i=0; $i < count($tsolist_result); $i++) { 
                array_push($postData_where_id,$tsolist_result[$i]->tso_number);
            }
        }
        
		// $postData_where['rrf.va_status'] = 'Verified';
		$postData_where['rrf.asm_status'] = 'Approved';
		$postData_where['rrf.status'] = 1;

		$postData = $this->input->post();
        
        $get_asm_verified_forms_result = $this->amodel->get_asm_approved_forms($postData,$postData_where,$postData_where_id);

        echo json_encode($get_asm_verified_forms_result);
    }

    public function ldr_future_prospect(){
		$this->load->view('salesman_onboarding/LEADER/ldr_future_prospect');	
    }

    public function get_fprospect_forms(){
        $postData_where_id =array();

        if( $this->input->post('tso_number') !=''){
            $postData_where['created_by'] = $this->input->post('tso_number');

        }
		
        if( $this->input->post('asm_number') !=''){

            $where_cond['asm_number'] = $this->input->post('asm_number');
        }else{
            $where_cond['zsm_number'] = $this->input->post('zsm_number');
        }
	
		$tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond,'tso_number','tso');
        
        if(count($tsolist_result) !=0){
            for ($i=0; $i < count($tsolist_result); $i++) { 
                array_push($postData_where_id,$tsolist_result[$i]->tso_number);
            }
        }
        
		// $postData_where['rrf.va_status'] = 'Verified';
		$postData_where['rrf.asm_status'] = 'Future Prospect';
		$postData_where['rrf.status'] = 1;

		$postData = $this->input->post();
        
        $get_asm_verified_forms_result = $this->amodel->get_fprospect_forms($postData,$postData_where,$postData_where_id);

        echo json_encode($get_asm_verified_forms_result);
    }

    public function rssm_eform_ldr(){
		$this->load->view('salesman_onboarding/LEADER/rssm_eform_ldr');	
    }

    public function get_entered_rssmforms(){
        $postData_where_id =array();

        if( $this->input->post('tso_number') !=''){
            $postData_where['created_by'] = $this->input->post('tso_number');

        }
        if( $this->input->post('af_rssm_status') !=''){
            $postData_where['rssm_status'] = $this->input->post('af_rssm_status');
        }
        if( $this->input->post('af_asm_status') !=''){
            $postData_where['asm_status'] = $this->input->post('af_asm_status');
        }

        if( $this->input->post('asm_number') !=''){

            $where_cond['asm_number'] = $this->input->post('asm_number');
        }else{
            $where_cond['zsm_number'] = $this->input->post('zsm_number');

        }
        
	
		$tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond,'tso_number','tso');
        
        if(count($tsolist_result) !=0){
            for ($i=0; $i < count($tsolist_result); $i++) { 
                array_push($postData_where_id,$tsolist_result[$i]->tso_number);
            }
        }
        
		// $postData_where['rrf.created_by'] = implode(",",$postData_where_id);
		$postData_where['rrf.status'] = 1;

		$postData = $this->input->post();
        
        $get_entered_rssmforms_result = $this->zmodel->verify_data_rssmforms($postData,$postData_where,$postData_where_id);

        echo json_encode($get_entered_rssmforms_result);
	}

    public function rssm_fform_ldr(){
		$this->load->view('salesman_onboarding/LEADER/rssm_fform_ldr');	
    }

    public function get_funnel_rssmforms(){

		$postData_where_id =array();

        if( $this->input->post('tso_number') !=''){
            $postData_where['created_by'] = $this->input->post('tso_number');

        }
        if( $this->input->post('asm_number') !=''){
            $where_cond['asm_number'] = $this->input->post('asm_number');
        }else{
            $where_cond['zsm_number'] = $this->input->post('zsm_number');

        }
	
		$tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond,'tso_number','tso');
        
        if(count($tsolist_result) !=0){
            for ($i=0; $i < count($tsolist_result); $i++) { 
                array_push($postData_where_id,$tsolist_result[$i]->tso_number);
            }
        }

		$postData_where['rrf.status'] = 0;

		$postData = $this->input->post();
        
        $get_funnel_rssmforms_result = $this->zmodel->verify_data_ff_rssmforms($postData,$postData_where,$postData_where_id);

        echo json_encode($get_funnel_rssmforms_result);
	}

    public function get_rssm_rejected_forms(){
        $postData_where_id =array();
		$postData_where['rrf.rssm_status'] = 'Rejected';
		$postData_where['rrf.status'] = 1;
		$postData = $this->input->post();
        $get_rejected_forms_result = $this->lmodel->get_rssm_rejected_forms($postData,$postData_where,$postData_where_id);

        echo json_encode($get_rejected_forms_result);
    }

    public function get_rssm_verified_forms(){
        $postData_where_id =array();
		$postData_where['rrf.rssm_status'] = 'Approved';
		$postData_where['rrf.status'] = 1;
       
		$postData = $this->input->post();
        
        $get_rssm_verified_forms_result = $this->lmodel->get_rssm_rejected_forms($postData,$postData_where,$postData_where_id);

        echo json_encode($get_rssm_verified_forms_result);
    }

    public function get_add_details(){
        
		$where_cond['auto_id'] = $this->input->post('rscode');
		$where_cond1['rssm_id'] = $this->input->post('rscode');


		$get_adtdetails_rssm_sde_result = $this->lmodel->verify_data_get('rssm_recruitment_form',$where_cond);
		$history = $this->lmodel->get_history('rssm_recruitment_form',$where_cond1);

		$result = array(
			"get_adtdetails_rssm_sde_result" => $get_adtdetails_rssm_sde_result,
			"history" => $history,
		);
		echo json_encode($result);
       
    }
    public function update_service_fee(){
		$auto_id = $this->input->post('rs_id');
        $where['auto_id'] = $auto_id;
        $get_salesman_details = $this->cmodel->verify_data('rssm_recruitment_form',$where);
        $dataa['get_salesman_details'] = $get_salesman_details;

        $where_check['tso_number'] = $get_salesman_details[0]->created_by;
        $userdata = $this->cmodel->verify_data('masters',$where_check);
        $dataa['userdata'] = $userdata;


		$where_cond['service_fee'] = $this->input->post('new_fee');
		$where_cond['division_head_status'] = $this->input->post('div_head_status');

		$editfee = $this->cmodel->updates('rssm_recruitment_form',$where_cond, 'auto_id', $auto_id);

		$data['revised_fee'] = $this->input->post('new_fee');
		$data['sde_service_fee'] = $this->input->post('given_fee');

		$data['sales_cat'] = $this->input->post('sales_category');
		$data['rssm_id'] = $this->input->post('rs_id');
    
		$save_his = $this->cmodel->data_add('service_fee_history',$data);

		if($editfee){
            $this->send_mail($dataa);
			$result = array(
				"response" => "success",
			);
			echo json_encode($result);
		}

	}

    public function get_servicefee_his(){
        $where_cond['rssm_id'] = $this->input->post('rscode');

		$get_adtdetails_rssm_sde_result = $this->lmodel->get_history('service_fee_history',$where_cond);

			echo json_encode($get_adtdetails_rssm_sde_result);

    }


    public function send_mail($data) {
        //Mail Code
        $from_address = "noreply@hepl.com";//Sender email
        $to_address = "manju.s@hepl.com";//rssmhiring@hepl.com//manju.s@hepl.com
        $subject = "New Salesman Onboarding Approved";
        $body = "<html>
                    <style>
                        p{
                            padding:0px;
                            margin:0px;
                        }
                    </style>
                    <body>
                        <h4>Greetings, Onboarding Team</h4>
                        <p>The onboarding request raised is approved by the Division Head. Please find the following details of the salesman to be onboarded</p>
                        <br>
                        <p>Name : ".$data['get_salesman_details'][0]->name."</p>
                        <p>Mobile Number : ".$data['get_salesman_details'][0]->mobile_no."</p>
                        <p>Salesman Type : ".$data['get_salesman_details'][0]->sales_type."</p>
                        <p>SDE Name : ".$data['userdata'][0]->tso."</p>
                        <p>ASM Name : ".$data['userdata'][0]->asm."</p>
                        <p>Date of Joining : ".$data['get_salesman_details'][0]->doj."</p>
                        <br>
                        <p>Please proceed with the onboarding process accordingly.</p>
                        <p>Thank you.</p>
                        <br>
                        <b>Requestor Name,</b>
                        <p>".$data['userdata'][0]->tso."</p>
                        <br>
                        <b>Best Regards,</b>
                        <p>My Buddy Team</p>
                    </body>
                </html>";

        $mailer = new PHPMailer(true);
        $mailer->isSMTP();
        $mailer->Host="smtp.office365.com";
        $mailer->SMTPAuth =true;
        $mailer->Username="noreply@hepl.com";
        $mailer->Password="Hepl@2021";
        $mailer->Port="587";
        $mailer->setFrom($from_address);
        $mailer->addAddress($to_address);
        $mailer->Subject=$subject;
        $mailer->isHTML(true);
        $mailer->Body=$body;
        $mailer->send();
        
    }




}
?>