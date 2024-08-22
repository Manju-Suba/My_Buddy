<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model{
    
	public function cur_auto_id($table)
	{
		$this->db->select('MAX(id) AS `maxid`');
		$records = $this->db->get($table);
		$query = $records->row();

		if ($query) {
			return $maxid = $query->maxid;
		}
	}

	public function data_add($table, $val)
	{
		$this->db->insert($table, $val);
		$message = "success";
		return $message;
	}

	function get_table_user_list($table,$group_by,$order_by){

		$this->db->order_by($order_by, 'asc');  // or desc
		$this->db->group_by($group_by);
		$records = $this->db->get($table);
		return $records->result();
		
	}

	function get_table_user_list_wc($table,$where,$group_by,$order_by){

		$this->db->where($where);
		$role = $this->session->userdata('role_type');
		if($role== "ZSM"){
			$this->db->where('zsm_number',$this->session->userdata('mobile'));
		}
		$this->db->order_by($order_by, 'asc');  // or desc
		$this->db->group_by($group_by);
		$records = $this->db->get($table);
		return $records->result();
		
	}

	function get_role_list_id($table,$select,$where,$group_by,$order_by){
		
		$this->db->select($select);
		$this->db->where($where);
		$this->db->order_by($order_by, 'asc');  // or desc
		$this->db->group_by($group_by);
		$records = $this->db->get($table);
		return $records->result();
		
	}

	function get_table_list($table,$where,$group_by,$order_by){

		$this->db->where($where);
		$this->db->order_by($order_by, 'asc');  // or desc
		$this->db->group_by($group_by);
		$records = $this->db->get($table);
		// print_r($where);
		return $records->result();
		
	}

	function verify_data($table,$where){
		$this->db->where($where);
		$records = $this->db->get($table);
		return $records->result();
	}

	function verify_data_wc($table_name,$order_by,$group_by){
		
		$this->db->order_by($order_by, 'asc');  // or desc
		$this->db->group_by($group_by);
		$records = $this->db->get($table_name);
		return $records->result();
	}

	function verify_data_erssmforms($postData,$postData_where){
		$response = array();
        //# Read value
		$draw = $postData['draw'];
		$start = $postData['start'];
		$rowperpage = $postData['length']; // Rows display per page
		$columnIndex = $postData['order'][0]['column']; // Column index
		$columnName = $postData['columns'][$columnIndex]['data']; // Column name
		$columnSortOrder = $postData['order'][0]['dir']; // asc or desc
		$searchValue = $postData['search']['value']; // Search value
        
		//# Search
		$search_arr = array();
		$searchQuery = "";

		if ($searchValue != '') {
			$search_arr[] = " (name like '%" . $searchValue . "%' or 
			mobile_no like '%" . $searchValue . "%' or 
			alt_mobile_no like '%" . $searchValue . "%' or 
			address like '%" . $searchValue . "%' or 
			rs_state like '%" . $searchValue . "%' or 
			rs_dist like '%" . $searchValue . "%' or 
			rs_town like '%" . $searchValue . "%' or 
			experience like '%" . $searchValue . "%' or 
			education like '%" . $searchValue . "%' or 
			age like '%" . $searchValue . "%' or 
			terrain_knowledge like '%" . $searchValue . "%' or 
			tech_adoption like '%" . $searchValue . "%' or 
            family_bg like'%" . $searchValue . "%' ) ";
		}

		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

        //# Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('rssm_recruitment_form');
        $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecords = $records[0]->allcount;

        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('rssm_recruitment_form');
        $this->db->where($postData_where);
		
		if ($searchQuery != '') $this->db->where($searchQuery);
		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select('*');
		$this->db->from('rssm_recruitment_form');
        $this->db->where($postData_where);

		if ($searchQuery != '') $this->db->where($searchQuery);
		$this->db->order_by('id', 'desc');  // or desc

		$this->db->limit($rowperpage, $start);

		$records = $this->db->get()->result();

		$data = array();

		foreach ($records as $record) {
			$timedate1 = strtotime(date("Y-m-d", strtotime($record->created_on)));
			$created_on = date("d-m-Y", $timedate1);
			
            $action_url1 = base_url()."uploads/sales/".$record->resume;
			if($record->resume !=''){

			$resume = '<a href="'.$action_url1.'" title="Preview CV" target="_blank"><button type="button" class="btn btn-outline-primary btn-sm"><i class="bx bx-download"></i></button></a>';
			}else{
				$resume ='-';
			}
			// $get_va_status = $record->va_status;

			// if($get_va_status =='Inprogress'){
			// 	$va_status = '<span class="badge badge-warning">Inprogress</span>';
			// }elseif($get_va_status =='Verified'){
			// 	$va_status = '<span class="badge badge-success">Verified</span>';
			// }
			// elseif($get_va_status =='Not Verified'){
			// 	$va_status = '<span class="badge badge-danger">Not Verified</span>';

			// }else{
			// 	$va_status ='';
			// }

			$get_asm_status = $record->asm_status;

			if($get_asm_status =='Inprogress'){
				$asm_status = '<b>ASM  :</b>  <span class="badge badge-warning">Inprogress</span>';
			}elseif($get_asm_status =='Approved'){
				$asm_status = '<b>ASM  :</b> <span class="badge badge-success">Approved</span>';
			}
			elseif($get_asm_status =='Future Prospect'){
				$asm_status = '<b>ASM  :</b> <span class="badge badge-danger">Future Prospect</span>';

			}else{
                $asm_status ='';
            }
			$rssm_status = $record->rssm_status;

			if($rssm_status =='Rejected'){
				$asm_status .= '<br><b>RSSM :</b> <span class="badge badge-danger mt-2">Rejected</span>';
			}elseif($rssm_status =='Approved'){
				$asm_status .= '<br><b>RSSM :</b> <span class="badge badge-success mt-2">Approved</span>';
			}else{
				if($get_asm_status =='Approved'){
               		$asm_status .='<br><b>RSSM :</b> <span class="badge badge-warning mt-2">Inprogress</span>';
				}else{
					$asm_status .="";
				}
            }

			$action = '<button onclick="get_adtdetails_pop('."'".$record->auto_id."'".');" class="btn  btn-sm btn-info dt-btn-st"><i class="bx bx-comment-dots"></i></button>';

			$score 	= 	$record->exp_point + $record->edu_point + $record->age_point + 
						$record->tk_point + $record->ta_point + $record->fb_point;

			// get vso score
			$this->db->select('*');
			$this->db->from('rssm_recruitment_form_vso');
			$this->db->where('auto_id',$record->auto_id);
			$this->db->order_by('id', 'desc');  // or desc
				
			$records_vso = $this->db->get()->result();

			
			if(count($records_vso) !=0){

				$vso_score 	= 	$records_vso[0]->exp_point + $records_vso[0]->edu_point + $records_vso[0]->age_point + 
						$records_vso[0]->tk_point + $records_vso[0]->ta_point + $records_vso[0]->fb_point;
			}else{
				$vso_score = $score;
			}

			$data[] = array(
				"id" => $record->id,
				"auto_id" => $record->auto_id,
				"name" => $record->name,
				"ex_rssm_name" =>$record->ex_rssm_name !="" ? $record->ex_rssm_name :'-',
				"mobile_no" => $record->mobile_no,
				"alt_mobile_no" => $record->alt_mobile_no,
				"address" => $record->address,
				"state" => $record->rs_state !="" ? $record->rs_state :'-',
				"division" => $record->rs_dist !="" ? $record->rs_dist : '-',
				"town" => $record->rs_town !="" ? $record->rs_town : '-' ,
				"resume" => $resume,
				"created_on" => $created_on,
				// "va_status" => $va_status,
				"asm_status" => $asm_status,
				"score" => $score,
				"vso_score" => $vso_score,
				"action" => $action 

			);
		}

        //# Response
		$response = array(
			"draw" => intval($draw),
			"iTotalRecords" => $totalRecords,
			"iTotalDisplayRecords" => $totalRecordwithFilter,
			"aaData" => $data
		);

		return $response;
	}

	function verify_data_frssmforms($postData,$postData_where){
		$response = array();
        //# Read value
		$draw = $postData['draw'];
		$start = $postData['start'];
		$rowperpage = $postData['length']; // Rows display per page
		$columnIndex = $postData['order'][0]['column']; // Column index
		$columnName = $postData['columns'][$columnIndex]['data']; // Column name
		$columnSortOrder = $postData['order'][0]['dir']; // asc or desc
		$searchValue = $postData['search']['value']; // Search value
        
		$search_arr = array();
		$searchQuery = "";

		if ($searchValue != '') {
			$search_arr[] = " (name like '%" . $searchValue . "%' or 
			mobile_no like '%" . $searchValue . "%' or 
			alt_mobile_no like '%" . $searchValue . "%' or 
			address like '%" . $searchValue . "%' or 
			rs_state like '%" . $searchValue . "%' or 
			rs_dist like '%" . $searchValue . "%' or 
			rs_town like '%" . $searchValue . "%' or 
			experience like '%" . $searchValue . "%' or 
			education like '%" . $searchValue . "%' or 
			age like '%" . $searchValue . "%' or 
			terrain_knowledge like '%" . $searchValue . "%' or 
			tech_adoption like '%" . $searchValue . "%' or 
            family_bg like'%" . $searchValue . "%' ) ";
		}

		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

		$this->db->select('count(*) as allcount');
		$this->db->from('rssm_recruitment_form');
        $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecords = $records[0]->allcount;

		$this->db->select('count(*) as allcount');
		$this->db->from('rssm_recruitment_form');
        $this->db->where($postData_where);
		
		if ($searchQuery != '') $this->db->where($searchQuery);
		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

		$this->db->select('*');
		$this->db->from('rssm_recruitment_form');
        $this->db->where($postData_where);

		if ($searchQuery != '') $this->db->where($searchQuery);
		$this->db->order_by('id', 'desc');  // or desc

		$this->db->limit($rowperpage, $start);

		$records = $this->db->get()->result();

		$data = array();

		foreach ($records as $record) {
			$timedate1 = strtotime(date("Y-m-d", strtotime($record->created_on)));
			$created_on = date("d-m-Y", $timedate1);
			
            $action_url1 = base_url()."uploads/sales/".$record->resume;

			if($record->rssm_status == "Rejected" && $record->status != 0){
				$action_url2 = base_url()."index.php/salesman_onboarding/RSSMController/edit_rssm_rejected_form/".$record->auto_id;
			}else{
            	$action_url2 = base_url()."index.php/salesman_onboarding/RSSMController/edit_rssm_rec_form/".$record->auto_id;
			}
			$action = '<button onclick="get_adtdetails_pop('."'".$record->auto_id."'".');" class="btn  btn-sm btn-info dt-btn-st" id="adtbtn"><i class="bx bx-comment-dots"></i></button>';
			if($record->division_head_status == 'Rejected'){
				$action .= '<button  class="btn  ml-1  btn-sm btn-dark dt-btn-st" onClick ="editServiceFee('."'".$record->auto_id."'".');" id="editBtn"><i class="bx bx-pencil"></i></button>';
			}else{
				$action .= '<a href="'.$action_url2.'" target="_self"><button  class="btn  ml-1 btn-sm btn-dark dt-btn-st" id="editBtn"><i class="bx bx-pencil"></i></button></a>';
			}

			$score 	= 	$record->exp_point + $record->edu_point + $record->age_point + 
						$record->tk_point + $record->ta_point + $record->fb_point;

			if($record->resume !=''){
				$resume = '<a href="'.$action_url1.'" title="Preview CV" target="_blank"><button type="button" class="btn btn-outline-primary btn-sm"><i class="bx bx-download"></i></button></a>';
			}else{
				$resume='-';
			}
			$remark = $record->rssm_remarks;

			if($remark != ""){
				$rssm_remark= wordwrap($remark,80,"<br>\n");
				$rssm_remarks = '<span style="color:red;">'.$rssm_remark.'</span>';
			}else{
				$rssm_remarks =  $record->rssm_remarks;
			}
			

			$data[] = array(
				"id" => $record->id,
				"auto_id" => $record->auto_id,
				"name" => $record->name,
				"ex_rssm_name" => $record->ex_rssm_name !="" ? $record->ex_rssm_name :'-',
				"mobile_no" => $record->mobile_no,
				"alt_mobile_no" => $record->alt_mobile_no,
				"address" => $record->address,
				"state" => $record->rs_state !="" ? $record->rs_state :'-',
				"division" => $record->rs_dist !="" ? $record->rs_dist : '-',
				"town" => $record->rs_town !="" ? $record->rs_town : '-' ,
				"resume" => $resume,
				"created_on" => $created_on,
				"score" => $score,
				"rssm_remarks" => $rssm_remarks,
				"action" => $action

			);
		}

        //# Response
		$response = array(
			"draw" => intval($draw),
			"iTotalRecords" => $totalRecords,
			"iTotalDisplayRecords" => $totalRecordwithFilter,
			"aaData" => $data
		);

		return $response;
	}

	public function updates($table, $data, $col, $id){
		$this->db->where($col, $id);
		$record = $this->db->update($table, $data);
	// print_r($record);

		$message = "success";
		return $message?true:false;
	}
	public function verify_data_get($table,$where){
		$this->db->select('*');
		$this->db->from('rssm_recruitment_form as rr');
		$this->db->join('masters as m','m.tso_number = rr.created_by');
		$this->db->join('sales_category as sc' , 'sc.sales_category = rr.sales_cat','left');
		$this->db->where($where);
		$records = $this->db->group_by('rr.auto_id')->get();
		// $records = $this->db
		// return $records->result();
		// print_r($records);die();
		// $records =
		return $records->result();
		
	}
	public function get_sde_name($table,$where,$group_by,$order_by){
		$this->db->select('*');
		$this->db->from('rs_mkt_master')->join('masters as m', 'rs_mkt_master.tso_mobile = m.tso_number');
		 $this->db->where($where);
		// $this->db->order_by($order_by, 'asc');  // or desc
		$this->db->group_by('m.tso_number');
		$records = $this->db->get();
		// print_r($records->result());die();
		// $records =
		return $records->result();
		
	}
}

