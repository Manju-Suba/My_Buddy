<?php	
defined('BASEPATH') OR exit('No direct script access allowed');	

use PHPMailer\PHPMailer\PHPMailer;

class ASMController extends CI_Controller {	
	
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
        $this->load->model('sales/Asm_model', 'amodel');

		if ( !$this->session->userdata('logged_in')){ 	
			redirect(tso_portal_base_url(), 'refresh');	
			// redirect('http://localhost/CK_TSO_Portal/');
				
        }	
        	
    }	

    public function rssm_eform_asm(){
		$this->load->view('salesman_onboarding/ASM/rssm_eform_asm');	
    }

    public function get_tso_list(){

        if($this->session->userdata('role') =='ASM'){
            $where_cond['asm_number'] = $this->input->post('asm_number');

        }else{
            $where_cond['zsm_number'] = $this->input->post('asm_number');

        }

		$tsolist_result = $this->cmodel->get_table_user_list_wc('masters',$where_cond,'tso_number','tso');

        echo json_encode($tsolist_result);
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

        $where_cond['asm_number'] = $this->input->post('asm_number');

	
		$tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond,'tso_number','tso');
        
        if(count($tsolist_result) !=0){
            for ($i=0; $i < count($tsolist_result); $i++) { 
                array_push($postData_where_id,$tsolist_result[$i]->tso_number);
            }
        }
        
		// $postData_where['rrf.created_by'] = implode(",",$postData_where_id);
		$postData_where['rrf.status'] = 1;

		$postData = $this->input->post();
        
        $get_entered_rssmforms_result = $this->amodel->verify_data_rssmforms($postData,$postData_where,$postData_where_id);

        echo json_encode($get_entered_rssmforms_result);
	}

    public function rssm_fform_asm(){
        $this->load->view('salesman_onboarding/ASM/rssm_fform_asm');
    }

    public function get_funnel_rssmforms(){

		$postData_where_id =array();

        if( $this->input->post('tso_number') !=''){
            $postData_where['created_by'] = $this->input->post('tso_number');

        }
        $where_cond['asm_number'] = $this->input->post('asm_number');
	
		$tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond,'tso_number','tso');
        
        if(count($tsolist_result) !=0){
            for ($i=0; $i < count($tsolist_result); $i++) { 
                array_push($postData_where_id,$tsolist_result[$i]->tso_number);
            }
        }

		$postData_where['rrf.status'] = 0;

		$postData = $this->input->post();
        
        $get_funnel_rssmforms_result = $this->amodel->verify_data_ff_rssmforms($postData,$postData_where,$postData_where_id);

        echo json_encode($get_funnel_rssmforms_result);
	}

    public function process_asm_action(){
        $auto_id = $this->input->post('auto_id');

        $where['auto_id'] = $auto_id;
        $get_salesman_details = $this->cmodel->verify_data('rssm_recruitment_form',$where);
        $data['get_salesman_details'] = $get_salesman_details;



        $where_check['tso_number'] = $get_salesman_details[0]->created_by;
        $userdata = $this->cmodel->verify_data('masters',$where_check);
        $data['userdata'] = $userdata;

        $where_cond['asm_status'] = $this->input->post('asm_status');

        
        // if($get_salesman_details[0]->service_fee != '' && $get_salesman_details[0]->service_fee > 20000 && $get_salesman_details[0]->sales_cat =='DSE - Metro'){
        //     $where_cond['division_head_status'] = 'Inprogress';
           
        // }
        // if($get_salesman_details[0]->service_fee != '' && $get_salesman_details[0]->service_fee > 14000 && $get_salesman_details[0]->sales_cat =='DSE - Urban'){
        //     $where_cond['division_head_status'] = 'Inprogress';
           
        // }
        // if($get_salesman_details[0]->service_fee != '' && $get_salesman_details[0]->service_fee > 10000 && $get_salesman_details[0]->sales_cat =='DSE - LPS'){
        //     $where_cond['division_head_status'] = 'Inprogress';
           
        // }
        // if($get_salesman_details[0]->service_fee != '' && $get_salesman_details[0]->service_fee > 12000 && $get_salesman_details[0]->sales_cat =='Rural - RDSE' || $get_salesman_details[0]->sales_cat =='Rural - TRDSE'|| $get_salesman_details[0]->sales_cat =='Rural - DSE DAO'){
        //     $where_cond['division_head_status'] = 'Inprogress';
           
        // }
        $where_cond['asm_status'] = $this->input->post('asm_status');


        $editform_result = $this->cmodel->updates('rssm_recruitment_form',$where_cond, 'auto_id', $auto_id);
            
        if($editform_result){

            if($this->input->post('asm_status') == 'Approved'){

                // if( isset($where_cond['division_head_status']) ){
                if($get_salesman_details[0]->division_head_status == 'Inprogress'){
                    $user_division = $this->session->userdata('business');
                    $wherecheck['business'] = $user_division;
                    $wherecheck['role_type'] = "Division Head";

		            $division_head_data = $this->cmodel->get_table_user_list_wc('users',$wherecheck,'mobile','id');
                    $to_mail = $division_head_data[0]->email;
                    $this->send_mail($data,$to_mail);//send to division head team

                }else{
                    $to_mail = "manju.s@hepl.com";//rssmhiring@hepl.com//manju.s@hepl.com
                    $this->send_mail($data,$to_mail);//send to rssm hiring team
                }
            }
            
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

    public function va_verified_forms(){
        $this->load->view('salesman_onboarding/ASM/va_verified_forms');
    }

    public function asm_verified_forms(){
        $this->load->view('salesman_onboarding/ASM/asm_verified_forms');
    }
    
    public function asm_future_prospect(){
        $this->load->view('salesman_onboarding/ASM/asm_future_prospect');
    }

    public function get_va_verified_forms(){
// print_r(1);die;
        $postData_where_id =array();

        if( $this->input->post('tso_number') !=''){
            $postData_where['created_by'] = $this->input->post('tso_number');

        }
       
        $where_cond['asm_number'] = $this->input->post('asm_number');

		$tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond,'tso_number','tso');
        
        if(count($tsolist_result) !=0){
            for ($i=0; $i < count($tsolist_result); $i++) { 
                array_push($postData_where_id,$tsolist_result[$i]->tso_number);
            }
        }
        
		// $postData_where['rrf.va_status'] = 'Verified';
		$postData_where['rrf.asm_status'] = 'Inprogress';
		$postData_where['rrf.status'] = 1;

		$postData = $this->input->post();
        
        $get_va_verified_forms_result = $this->amodel->get_va_verified_forms($postData,$postData_where,$postData_where_id);

        echo json_encode($get_va_verified_forms_result);
    }

    public function get_asm_verified_forms(){
        $postData_where_id =array();

        if( $this->input->post('tso_number') !=''){
            $postData_where['created_by'] = $this->input->post('tso_number');

        }
        
        if($this->session->userdata('role_type') =='ASM'){
            $where_cond['asm_number'] = $this->input->post('asm_number');
        }else{
            $where_cond['zsm_number'] = $this->input->post('asm_number');
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

    public function get_fprospect_forms(){
        $postData_where_id =array();

        if( $this->input->post('tso_number') !=''){
            $postData_where['created_by'] = $this->input->post('tso_number');

        }
		
        if($this->session->userdata('role_type') =='ASM'){
            $where_cond['asm_number'] = $this->input->post('asm_number');
        }else{
            $where_cond['zsm_number'] = $this->input->post('asm_number');
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
   

    public function send_mail($data,$to_mail) {
        //Mail Code
        $from_address = "noreply@hepl.com";//Sender email
        $to_address = $to_mail;
        // $to_address = "manju.s@hepl.com";//rssmhiring@hepl.com//manju.s@hepl.com
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
                        <p>The onboarding request raised is approved by the ASM. Please find the following details of the salesman to be onboarded</p>
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