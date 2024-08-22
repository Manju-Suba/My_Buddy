<?php	
defined('BASEPATH') OR exit('No direct script access allowed');	

use PHPMailer\PHPMailer\PHPMailer;

class ZSMController extends CI_Controller {	
	
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
        $this->load->model('sales/Zsm_model', 'zmodel');
        $this->load->model('sales/Asm_model', 'amodel');

		if ( !$this->session->userdata('logged_in')){ 	
			redirect(tso_portal_base_url(), 'refresh');	
			// redirect('http://localhost/CK_TSO_Portal/');
				
        }	
        	
    }	

    public function rssm_eform_zsm(){
		$this->load->view('salesman_onboarding/ZSM/rssm_eform_zsm');	
    }

    public function get_tso_list(){

        // $where_cond['zsm_number'] = $this->input->post('zsm_number');
        $where_cond['asm_number'] = $this->input->post('asm_number');

		$tsolist_result = $this->cmodel->get_table_user_list_wc('masters',$where_cond,'tso_number','tso');

        echo json_encode($tsolist_result);
	}

    public function get_asm_list(){

        $where_cond['zsm_number != '] = '';
        // $this->input->post('zsm_number');

		$asmlist_result = $this->cmodel->get_table_user_list_wc('masters',$where_cond,'asm_number','asm');

        echo json_encode($asmlist_result);
    }

    public function get_entered_rssmforms(){
        $postData_where_id =array();

        if( $this->input->post('tso_number') !=''){
            $postData_where['created_by'] = $this->input->post('tso_number');

        }
        if( $this->input->post('af_va_status') !=''){
            $postData_where['va_status'] = $this->input->post('af_va_status');
        }
        if( $this->input->post('af_asm_status') !=''){
            $postData_where['asm_status'] = $this->input->post('af_asm_status');
        }

        if( $this->input->post('tso_number') !=''){
            $where_cond['tso_number'] = $this->input->post('tso_number');
        }
        if( $this->input->post('asm_number') !=''){
            $where_cond['asm_number'] = $this->input->post('asm_number');
        }

        $where_cond['zsm_number'] = $this->input->post('zsm_number');

	
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

    public function rssm_fform_zsm(){
        $this->load->view('salesman_onboarding/ZSM/rssm_fform_zsm');
    }

    public function get_funnel_rssmforms(){

		$postData_where_id =array();

        if( $this->input->post('tso_number') !=''){
            $postData_where['created_by'] = $this->input->post('tso_number');

        }
        if( $this->input->post('asm_number') !=''){
            $where_cond['asm_number'] = $this->input->post('asm_number');
        }
        $where_cond['zsm_number'] = $this->input->post('zsm_number');
	
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

    public function va_verified_forms_zsm(){
        $this->load->view('salesman_onboarding/ZSM/va_verified_forms_zsm');
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
		$postData_where['rrf.asm_status !='] = 'Approved';
		$postData_where['rrf.status'] = 1;

		$postData = $this->input->post();
        
        $get_va_verified_forms_result = $this->amodel->get_va_verified_forms($postData,$postData_where,$postData_where_id);

        echo json_encode($get_va_verified_forms_result);
    }
    
    public function zsm_verified_forms(){
        $this->load->view('salesman_onboarding/ZSM/zsm_verified_forms');
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


    public function zsm_future_prospect(){
        $this->load->view('salesman_onboarding/ZSM/zsm_future_prospect');
    }


    //division Head

    public function revised_salary_approval(){
        $this->load->view('salesman_onboarding/Division_Head/revised_salary_approval');
    }

    public function approved_revised_salary(){
        $this->load->view('salesman_onboarding/Division_Head/approved_revised_salary');
    }

    public function rejected_revised_salary(){
        $this->load->view('salesman_onboarding/Division_Head/rejected_revised_salary');
    }

    public function get_salary_approval_forms(){
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
        
		$postData_where['rrf.asm_status'] = 'Approved';
		$postData_where['rrf.division_head_status'] = 'Inprogress';
		$postData_where['rrf.status'] = 1;

		$postData = $this->input->post();
        
        $get_asm_verified_forms_result = $this->zmodel->get_asm_approved_forms($postData,$postData_where,$postData_where_id);

        echo json_encode($get_asm_verified_forms_result);
    }

    public function approve_fee(){
        $where_cond['division_head_status'] = $this->input->post('divheadStatus');
        if( $this->input->post('divheadStatus') == 'Rejected'){
            $where_cond['divhead_remarks'] = $this->input->post('divhead_remarks');
        }
        $auto_id = $this->input->post('rowid');

        $where['auto_id'] = $auto_id;
        $get_salesman_details = $this->cmodel->verify_data('rssm_recruitment_form',$where);
        $data['get_salesman_details'] = $get_salesman_details;

        $where_check['tso_number'] = $get_salesman_details[0]->created_by;
        $userdata = $this->cmodel->verify_data('masters',$where_check);
        $data['userdata'] = $userdata;

        $editform_result = $this->cmodel->updates('rssm_recruitment_form',$where_cond, 'auto_id', $auto_id);
            
        if($editform_result){
            $this->send_mail($data);
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


    public function get_divhead_approved_forms(){
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
		$postData_where['rrf.asm_status'] = 'Approved';
		$postData_where['rrf.division_head_status'] = 'Approved';
		$postData_where['rrf.status'] = 1;
		$postData = $this->input->post();
        $get_asm_verified_forms_result = $this->zmodel->get_asm_approved_forms($postData,$postData_where,$postData_where_id);

        echo json_encode($get_asm_verified_forms_result);
    }


    public function get_divhead_rejected_forms(){
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
		$postData_where['rrf.asm_status'] = 'Approved';
		$postData_where['rrf.division_head_status'] = 'Rejected';
		$postData_where['rrf.status'] = 1;

		$postData = $this->input->post();
        
        $get_asm_verified_forms_result = $this->zmodel->get_asm_approved_forms($postData,$postData_where,$postData_where_id);

        echo json_encode($get_asm_verified_forms_result);
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
                        <h4>Requestor Name,</h4>
                        <p>".$data['userdata'][0]->tso."</p>
                        <br>
                        <h4>Best Regards,</h4>
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