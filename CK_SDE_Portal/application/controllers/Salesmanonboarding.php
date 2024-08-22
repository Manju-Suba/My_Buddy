<?php	
defined('BASEPATH') OR exit('No direct script access allowed');	
use PHPMailer\PHPMailer\PHPMailer;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Salesmanonboarding extends CI_Controller {	
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
    }	

    
    public function get_asm_verified_forms(){
        $postData_where_id =array();
		$postData_where['rrf.asm_status'] = 'Approved';
		$postData_where['rrf.rssm_status'] = '';
		// $postData_where['rrf.rssm_status !='] = 'Rejected';
		$postData_where['rrf.status'] = 1;
       
		$postData = $this->input->post();
        
        $get_asm_verified_forms_result = $this->cmodel->get_asm_approved_forms_rssm($postData,$postData_where,$postData_where_id);

        echo json_encode($get_asm_verified_forms_result);
    }

    public function get_rssm_verified_forms(){
        $postData_where_id =array();
		// $postData_where['rrf.rssm_status'] = 'Approved';
		// $postData_where['rrf.emp_code !='] = null;
		// $postData_where['rrf.ssfa_id'] = null;
        // $postData_where['rrf.emp_code !='] = '';
		// $postData_where['rrf.ssfa_id !='] = '';
		$postData_where['rrf.status'] = 1;
       
		$postData = $this->input->post();
        
        $get_asm_verified_forms_result = $this->cmodel->get_rssm_approved_forms_rssm($postData,$postData_where,$postData_where_id);

        echo json_encode($get_asm_verified_forms_result);
    }

    public function get_adtdetails_rssm(){

		$where_cond['auto_id'] = $this->input->post('table_row_id');

		$get_adtdetails_rssm_sde_result = $this->cmodel->verify_data_get('rssm_recruitment_form',$where_cond);
		
		$get_adtdetails_rssm_vso_result = $this->cmodel->verify_data('rssm_recruitment_form_vso',$where_cond);
		// print_r($get_adtdetails_rssm_sde_result);die();

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
    

    public function get_add_details(){
        
		$where_cond['auto_id'] = $this->input->post('rscode');
		$where_cond1['rssm_id'] = $this->input->post('rscode');

		$get_adtdetails_rssm_sde_result = $this->cmodel->verify_data_get('rssm_recruitment_form',$where_cond);
		
		$get_adtdetails_rssm_vso_result = $this->cmodel->verify_data1('rssm_recruitment_form_vso',$where_cond);
		$history = $this->cmodel->get_history('rssm_recruitment_form',$where_cond1);


		// print_r($get_adtdetails_rssm_sde_result);die();

		if(count($get_adtdetails_rssm_vso_result) ==0){
			$vso_result = $get_adtdetails_rssm_sde_result;
		}else{
			$vso_result = $get_adtdetails_rssm_vso_result;
		}
		$result = array(
			"get_adtdetails_rssm_sde_result" => $get_adtdetails_rssm_sde_result,
			"history" => $history,
		);
		echo json_encode($result);
       
    }
    public function get_details(){
        $where_cond['auto_id'] = $this->input->post('rscode');

        $details = $this->cmodel->get_table_list('rssm_recruitment_form',$where_cond,'auto_id','auto_id');
        echo json_encode($details);
    }

    public function process_rssm_action(){
        $where_cond['rssm_status'] = $this->input->post('rssm_status');
        $where_cond['emp_code'] = $this->input->post('emp_code');
        $where_cond['ssfa_id'] = $this->input->post('ssfa_id');
        $where_cond['by_rssm'] = $this->session->userdata('mobile'); 
        // print_r($where_cond);die;
        $auto_id = $this->input->post('rowid');
        $editform_result = $this->cmodel->updates('rssm_recruitment_form',$where_cond, 'auto_id', $auto_id);
            
        if($editform_result){
            $this->send_mail($this->input->post('rowid'));
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

    public function send_mail($auto_id) {

		$where_cond['auto_id'] = $auto_id;
        $data = $this->cmodel->verify_data_get('rssm_recruitment_form', $where_cond);
        $where['mobile'] = $data[0]->created_by;
        $userdata = $this->cmodel->verify_data1('users',$where);
        $get_email = $userdata;
        // print_r($get_email);die;
        if($get_email[0]->email != null && $get_email[0]->email != ''){
            $from_address = "noreply@hepl.com";
            $to_address = $get_email[0]->email;
            $subject = "New Salesman Verified";
            if( $data[0]->ssfa_id != null &&  $data[0]->emp_code != null){
                $body = "<html>
                    <style>
                        p{
                            padding:0px;
                            margin:0px;
                        }
                    </style>
                    <body>
                        <h4>Greetings, Onboarding Team</h4>
                        <p>The onboarding request raised has been approved by RSSM hiring team. Here is the Employee code and SSFA ID.</p>
                        <br>
                        <p>Name : ".$data[0]->name."</p>
                        <p>Mobile Number : ".$data[0]->mobile_no."</p>
                        <p>Salesman Type : ".$data[0]->sales_type."</p>
                        <p>Employee Code : ".$data[0]->emp_code."</p>
                        <p>SSFA ID : ".$data[0]->ssfa_id."</p>
                        <br>
                        <p>Thank you.</p>
                        <br>
                        <h4>Best Regards,</h4>
                        <p>RSSM Hiring Team</p>
                    </body>
                </html>";
            }else{
                $body = "<html>
                        <style>
                            p{
                                padding:0px;
                                margin:0px;
                            }
                        </style>
                        <body>
                            <h4>Greetings, Onboarding Team</h4>
                            <p>The onboarding request raised has been approved by RSSM hiring team. </p>
                            <br>
                            <p>Name : ".$data[0]->name."</p>
                            <p>Mobile Number : ".$data[0]->mobile_no."</p>
                            <p>Salesman Type : ".$data[0]->sales_type."</p>
                            <p>Employee Code : ".$data[0]->emp_code."</p>
                            <br>
                            SSFA ID will be shared later.
                            <br><br>
                            <p>Thank you.</p>
                            <br>
                            <h4>Best Regards,</h4>
                            <p>RSSM Hiring Team</p>
                        </body>
                    </html>";
            }
            

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

    public function reject_rssm_action(){
        $where_cond['rssm_status'] = 'Rejected';
        $where_cond['by_rssm'] = $this->session->userdata('mobile'); 
        $where_cond['rssm_remarks'] = $this->input->post('reason'); 

        $auto_id = $this->input->post('auto_id');
        $editform_result = $this->cmodel->updates('rssm_recruitment_form',$where_cond, 'auto_id', $auto_id);

        $data['rssm_requirement_form_id'] = $this->input->post('auto_id');
        $data['reject_reason'] = $this->input->post('reason'); 


        $insert_reject_reason = $this->cmodel->data_add('rssm_reject_reson',$data);
            
        if($editform_result){
            $this->send_rejected_mail($this->input->post('auto_id'));
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

    public function send_rejected_mail($auto_id) {

		$where_cond['auto_id'] = $auto_id;
        $data = $this->cmodel->verify_data_get('rssm_recruitment_form', $where_cond);
        $where['mobile'] = $data[0]->created_by;
        $userdata = $this->cmodel->verify_data1('users',$where);
        $get_email = $userdata;
        if($get_email[0]->email != null && $get_email[0]->email != ''){
            $from_address = "noreply@hepl.com";
            $to_address = $get_email[0]->email;
            $subject = "New Salesman Verified";
                $body = "<html>
                    <style>
                        p{
                            padding:0px;
                            margin:0px;
                        }
                    </style>
                    <body>
                        <h4>Greetings, Onboarding Team</h4>
                        <p>RSSM Team has rejected your Onboarding form.  Check the 'Rejected Form' tab, review the remarks for rejection, update, and resubmit the form.</p>
                        <p>Name : ".$data[0]->name."</p>
                        <p>Mobile Number : ".$data[0]->mobile_no."</p>
                        <p>Salesman Type : ".$data[0]->sales_type."</p>
                        <p>Remarks : ".$data[0]->rssm_remarks." </p>
                        <br>
                        <p>Thank you.</p>
                        <br>
                        <h4>Best Regards,</h4>
                        <p>RSSM Hiring Team</p>
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
    public function get_rssm_rejected_forms(){
        $postData_where_id =array();
		$postData_where['rrf.rssm_status'] = 'Rejected';
		$postData_where['rrf.status'] = 1;
		$postData = $this->input->post();
        $get_rejected_forms_result = $this->cmodel->get_asm_approved_forms_rssm($postData,$postData_where,$postData_where_id);

        echo json_encode($get_rejected_forms_result);
    }

    public function get_entered_rssmforms(){
        $postData_where_id =array();

        if( $this->input->post('tso_number') !=''){
            $postData_where['created_by'] = $this->input->post('tso_number');

        }
        if( $this->input->post('af_rssm_status') !=''){
            if($this->input->post('af_rssm_status') == "Pending"){
                $rssm_status = '';
            }else{
                $rssm_status = $this->input->post('af_rssm_status');

            }
            $postData_where['rssm_status'] = $rssm_status;
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
        
        $get_entered_rssmforms_result = $this->cmodel->get_entered_forms($postData,$postData_where,$postData_where_id);

        echo json_encode($get_entered_rssmforms_result);
	}

    public function get_asm_list(){

        $where_cond['zsm_number != '] = '';
        // $this->input->post('zsm_number');

		$asmlist_result = $this->cmodel->get_table_user_list_wc('masters',$where_cond,'asm_number','asm');

        echo json_encode($asmlist_result);
    }

    public function get_tso_list(){

        // $where_cond['zsm_number'] = $this->input->post('zsm_number');
        $where_cond['asm_number'] = $this->input->post('asm_number');

		$tsolist_result = $this->cmodel->get_table_user_list_wc('masters',$where_cond,'tso_number','tso');

        echo json_encode($tsolist_result);
	}

    public function download_beat_excel(){

        $where_cond['auto_id'] = $this->input->post('rowid');

		$results =  $this->cmodel->verify_data_get('rssm_recruitment_form',$where_cond);

        $objPHPExcel = new Spreadsheet();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('BEAT DATA');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'S.NO');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'RS Code');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'RS Name');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'RS Type');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Beat Name');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Beat Frequency');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Visit Day');


        $row = 2; 
        $i=1;

        foreach ($results as $result) {
            $beat_name = explode(',', $result->beat_name);
            $singleValue = $result->rs_name;
            foreach ($beat_name as $value) {
                $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $i);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $result->rs_code);
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $result->rs_name);
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, '');
                $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $value);
                $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, '');
                $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, '');
                $i++;
                $row++;
            }
        }

        
        $fileName = date('d_m_y').'Beat_Excel.xlsx';
       

        $writers = new Xlsx($objPHPExcel);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
		$writers->save($fileName);
		$var = $fileName;
		// return $var;
        echo json_encode(['file_url' => base_url($fileName)]);
	}
    public function get_verified_forms(){
        $postData_where_id =array();
		$postData_where['rrf.asm_status'] = 'Approved';
		$postData_where['rrf.rssm_status'] = 'Approved';
        $postData_where['rrf.ssfa_id'] = '';
		$postData_where['rrf.status'] = 1;
       
		$postData = $this->input->post();
        
        $get_asm_verified_forms_result = $this->cmodel->get_asm_approved_forms_rssm($postData,$postData_where,$postData_where_id);

        echo json_encode($get_asm_verified_forms_result);
    }

    public function get_servicefee_his(){
        $where_cond['rssm_id'] = $this->input->post('rscode');

		$get_adtdetails_rssm_sde_result = $this->cmodel->get_history('service_fee_history',$where_cond);

			echo json_encode($get_adtdetails_rssm_sde_result);

    }


    //QA Login Datas
    public function get_qc_verification_forms(){
        $postData_where_id =array();
		$postData_where['rrf.status'] = 1;
		$postData = $this->input->post();
        $get_asm_verified_forms_result = $this->cmodel->get_qc_verification_data($postData,$postData_where,$postData_where_id);
        echo json_encode($get_asm_verified_forms_result);
    }






}?>