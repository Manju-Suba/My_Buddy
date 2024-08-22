<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model{
    
	public function data_add($table, $val)
	{
		$this->db->insert($table, $val);
		$message = "success";
		return $message;
	}

    //used
	function get_some_data_list($table,$where,$group_by){
		$this->db->where($where);
		$this->db->group_by($group_by);
		$records = $this->db->get($table);
		return $records->result();
	}

	function get_rs_onboarding_data($postData,$role,$status,$otherStatus){
		$response = array();
		## Read value
		$draw = $postData['draw'];
		$start = $postData['start'];
		$rowperpage = $postData['length']; // Rows display per page
		$searchValue = $postData['search']['value']; // Search value
		
		## Search
		$search_arr = array();
		$searchQuery = "";

		if ($searchValue != '')
		{
			$search_arr[] = " (rs_type like '%" . $searchValue . "%'
			or appointment_reason like '%" . $searchValue ."%'
			or firm_title like '%" . $searchValue ."%'
			or ownership_status like '%" . $searchValue ."%'
			or gst_no like '%" . $searchValue ."%'
			) ";
		}

		if (count($search_arr) > 0)
		{
			$searchQuery = implode(" and ", $search_arr);
		}


		// ## Total number of records without filtering
		$this->db->select('rad.*');
		$this->db->from('rs_appointment_data as rad');
		if($role == "ASM"){
			$this->db->join('masters as m', 'rad.created_by = m.tso_number');
			$this->db->where('m.zsm_number',$this->session->userdata('mobile'));
		}
		if($role == "ZSM"){
			$this->db->join('masters as m', 'rad.created_by = m.tso_number');
			$this->db->where('rad.asm_status','Approved');
			$this->db->where('m.zsm_number',$this->session->userdata('mobile'));
		}
		if($role == "COMMERCIAL") {
			$this->db->where('zsm_status','Approved');
		}
		if ($role == "SAP") {
			$this->db->where('comercial_status','Approved');
		}
		$this->db->where($otherStatus, $status);
        $this->db->group_by('rad.id');
		$records = $this->db->get()->result();
		$totalRecords = count($records);


		$this->db->select('count(*) as allcount');
		$this->db->from('rs_appointment_data as rad');
		if($role == "ASM"){
			$this->db->join('masters as m', 'rad.created_by = m.tso_number');
			$this->db->where('m.zsm_number',$this->session->userdata('mobile'));
		}
		if($role == "ZSM"){
			$this->db->join('masters as m', 'rad.created_by = m.tso_number');
			$this->db->where('rad.asm_status','Approved');
			$this->db->where('m.zsm_number',$this->session->userdata('mobile'));
		}
		if($role == "COMMERCIAL") {
			$this->db->where('zsm_status','Approved');
		}
		if ($role == "SAP") {
			$this->db->where('comercial_status','Approved');
		}
		$this->db->where($otherStatus, $status);

		if ($searchQuery != '') {
			$this->db->where($searchQuery);
		}
        $this->db->group_by('rad.id');
		$records = $this->db->get()->result();
		// $totalRecordwithFilter =  $records[0]->allcount;
		$totalRecordwithFilter =  count($records);

		## Fetch records
		$this->db->select('rad.*');
		$this->db->from('rs_appointment_data rad');
		$this->db->where($otherStatus, $status);
		if($role == "ASM"){
			$this->db->join('masters as m', 'rad.created_by = m.tso_number');
			$this->db->where('m.asm_number',$this->session->userdata('mobile'));
		}
		if($role == "ZSM"){
			$this->db->join('masters as m', 'rad.created_by = m.tso_number');
			$this->db->where('rad.asm_status','Approved');
			$this->db->where('m.zsm_number',$this->session->userdata('mobile'));
		}
		if($role == "COMMERCIAL") {
			$this->db->where('zsm_status','Approved');
		}
		if ($role == "SAP") {
			$this->db->where('comercial_status','Approved');
		}


		if ($searchQuery != '') {
			$this->db->where($searchQuery);
		}
		$this->db->limit($rowperpage, $start);
        $this->db->group_by('rad.id');
		$records = $this->db->get()->result();
		// $totalRecordwithFilter =  count($records);
		// $totalRecords = count($records);

		$data = array();

		foreach ($records as $record){

			$get_asm_status = $record->asm_status;
			if($get_asm_status =='Rejected'){
				$asm_class = 'badge-danger';
			}elseif($get_asm_status =='Approved'){
				$asm_class = 'badge-success';
			}else{
                $asm_class ='badge-primary';
            }
			$get_zsm_status = $record->zsm_status;
			if($get_zsm_status =='Rejected'){
				$zsm_class = 'badge-danger';
			}elseif($get_zsm_status =='Approved'){
				$zsm_class = 'badge-success';
			}else{
                $zsm_class ='badge-primary';
            }

			$asm_status = '<b>ASM : </b><span class="badge '.$asm_class.'">'.$get_asm_status.'</span><br>
			<b>ZSM : </b><span class="badge '.$zsm_class.'">'.$get_zsm_status.'</span>';

			$action = '<a href="#" onclick="openApproveModel('.$record->id.')" title="Approve Or Reject"  class="btn btn-sm mb-2  mr-2  btn-success " ><i class="bx bx-comment-dots"></i></a>';
			$data[] = array(
				"rs_type" => $record->rs_type,
				"appointment_reason" => $record->appointment_reason,
				"existing_sap_rssscode" => $record->existing_sap_rssscode,
				"claims_collected" => $record->claims_collected,
				"noc_pending_claims" => $record->noc_pending_claims,
				"firm_title" => $record->firm_title,
				"gst_no" => $record->gst_no,
				"ownership_status" => $record->ownership_status,
				"overall_status" => $asm_status,
				"action" => $action,
			);
			
		}
		$response = array(
			"draw" => intval($draw) ,
			"iTotalRecords" => $totalRecords,
			"iTotalDisplayRecords" => $totalRecordwithFilter,
			"aaData" => $data
		);
		return $response;

	}

	function updateRsOnboardingData($type,$status,$id){
		$this->db->set($status, $type);
		$this->db->where('id', $id);
		$this->db->update('rs_appointment_data');
		return "success";
	}

	function get_entered_datas($postData){
		$response = array();
		## Read value
		$draw = $postData['draw'];
		$start = $postData['start'];
		$rowperpage = $postData['length']; // Rows display per page
		$searchValue = $postData['search']['value']; // Search value
		
		## Search
		$search_arr = array();
		$searchQuery = "";

		if ($searchValue != '')
		{
			$search_arr[] = " (rs_type like '%" . $searchValue . "%'
			or appointment_reason like '%" . $searchValue ."%'
			or existing_sap_rssscode like '%" . $searchValue ."%'
			or claims_collected like '%" . $searchValue ."%'
			or noc_pending_claims like '%" . $searchValue ."%'
			or firm_title like '%" . $searchValue ."%'
			or ownership_status like '%" . $searchValue ."%'
			) ";
		}

		if (count($search_arr) > 0){
			$searchQuery = implode(" and ", $search_arr);
		}

		## Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('rs_appointment_data');
		$records = $this->db->get()->result();
		$totalRecords = $records[0]->allcount;

		## Total number of records with filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('rs_appointment_data');
		if ($searchQuery != '') {
			$this->db->where($searchQuery);
		}
		$records = $this->db->get()->result();
		$totalRecordwithFilter =  $records[0]->allcount;

		## Fetch records
		$this->db->select('*');
		$this->db->from('rs_appointment_data');
		if ($searchQuery != '') {
			$this->db->where($searchQuery);
		}
		$this->db->limit($rowperpage, $start);
		$records = $this->db->get()->result();
		$data = array();

		foreach ($records as $record){
			$action = '<a href="#" onclick="openApproveModel('.$record->id.')" title="Approve Or Reject"  class="btn btn-sm mb-2  mr-2  btn-success " ><i class="bx bx-comment-dots"></i></a>';

			$get_asm_status = $record->asm_status;
			if($get_asm_status =='Rejected'){
				$asm_class = 'badge-danger';
			}elseif($get_asm_status =='Approved'){
				$asm_class = 'badge-success';
			}else{
                $asm_class ='badge-primary';
            }
			$get_zsm_status = $record->zsm_status;
			if($get_zsm_status =='Rejected'){
				$zsm_class = 'badge-danger';
			}elseif($get_zsm_status =='Approved'){
				$zsm_class = 'badge-success';
			}else{
                $zsm_class ='badge-primary';
            }

			$asm_status = '<b>ASM : </b><span class="badge '.$asm_class.'">'.$get_asm_status.'</span><br>
			<b>ZSM : </b><span class="badge '.$zsm_class.'">'.$get_zsm_status.'</span>';

			$data[] = array(
				"rs_type" => $record->rs_type,
				"appointment_reason" => $record->appointment_reason,
				"firm_title" => $record->firm_title,
				"ownership_status" => $record->ownership_status,
				"asm_status" => $asm_status,
				"action" => $action,
			);
		}

		$response = array(
			"draw" => intval($draw) ,
			"iTotalRecords" => $totalRecords,
			"iTotalDisplayRecords" => $totalRecordwithFilter,
			"aaData" => $data
		);
		return $response;
	}




	function viewRsOnboardingData($id){
		$this->db->select('*');
		$this->db->from('rs_appointment_data');
		$this->db->where('id', $id);
		$records = $this->db->get()->result();
		return $records;
	}

	// function get_asm_pending_datas($postData,$whereCond){
	// 	$response = array();
	// 	## Read value
	// 	$draw = $postData['draw'];
	// 	$start = $postData['start'];
	// 	$rowperpage = $postData['length']; // Rows display per page
	// 	$searchValue = $postData['search']['value']; // Search value
		
	// 	## Search
	// 	$search_arr = array();
	// 	$searchQuery = "";

	// 	if ($searchValue != '')
	// 	{
	// 		$search_arr[] = " (rs_type like '%" . $searchValue . "%'
	// 		or appointment_reason like '%" . $searchValue ."%'
	// 		or existing_sap_rssscode like '%" . $searchValue ."%'
	// 		or claims_collected like '%" . $searchValue ."%'
	// 		or noc_pending_claims like '%" . $searchValue ."%'
	// 		) ";
	// 	}

	// 	if (count($search_arr) > 0){
	// 		$searchQuery = implode(" and ", $search_arr);
	// 	}

	// 	## Total number of records without filtering
	// 	$this->db->select('count(*) as allcount');
	// 	$this->db->from('rs_appointment_data');
	// 	$this->db->where($whereCond);
	// 	$records = $this->db->get()->result();
	// 	$totalRecords = $records[0]->allcount;

	// 	## Total number of records with filtering
	// 	$this->db->select('count(*) as allcount');
	// 	$this->db->from('rs_appointment_data');
	// 	$this->db->where($whereCond);
	// 	if ($searchQuery != '') {
	// 		$this->db->where($searchQuery);
	// 	}
	// 	$records = $this->db->get()->result();
	// 	$totalRecordwithFilter =  $records[0]->allcount;

	// 	## Fetch records
	// 	$this->db->select('*');
	// 	$this->db->from('rs_appointment_data');
	// 	$this->db->where($whereCond);
	// 	if ($searchQuery != '') {
	// 		$this->db->where($searchQuery);
	// 	}
	// 	$this->db->limit($rowperpage, $start);
	// 	$records = $this->db->get()->result();
	// 	$data = array();

	// 	foreach ($records as $record){
	// 		$action = '<a href="#" onclick="openApproveModel('.$record->id.')" title="Approve Or Reject"  class="btn btn-sm mb-2  mr-2  btn-success " ><i class="bx bx-comment-dots"></i></a>';

	// 		$get_asm_status = $record->asm_status;
	// 		if($get_asm_status =='Rejected'){
	// 			$asm_class = 'badge-danger';
	// 		}elseif($get_asm_status =='Approved'){
	// 			$asm_class = 'badge-success';
	// 		}else{
    //             $asm_class ='badge-primary';
    //         }
	// 		$get_zsm_status = $record->zsm_status;
	// 		if($get_zsm_status =='Rejected'){
	// 			$zsm_class = 'badge-danger';
	// 		}elseif($get_zsm_status =='Approved'){
	// 			$zsm_class = 'badge-success';
	// 		}else{
    //             $zsm_class ='badge-primary';
    //         }

	// 		$asm_status = '<b>ZSM : </b><span class="badge '.$zsm_class.'">'.$get_zsm_status.'</span>';

	// 		$data[] = array(
	// 			"rs_type" => $record->rs_type,
	// 			"appointment_reason" => $record->appointment_reason,
	// 			"firm_title" => $record->firm_title,
	// 			"ownership_status" => $record->ownership_status,
	// 			"overall_status" => $asm_status,
	// 			"action" => $action,
	// 		);
	// 	}

	// 	$response = array(
	// 		"draw" => intval($draw) ,
	// 		"iTotalRecords" => $totalRecords,
	// 		"iTotalDisplayRecords" => $totalRecordwithFilter,
	// 		"aaData" => $data
	// 	);
	// 	return $response;
	// }


}
?>

