<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zsm_model extends CI_Model{

    function verify_data_ssforms($postData,$postData_where,$postData_where_id){
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
			$search_arr[] = " (c_name like '%" . $searchValue . "%' or 
			c_mobile_no like '%" . $searchValue . "%' or 
			c_altmobile_no like '%" . $searchValue . "%' or 
			c_address like '%" . $searchValue . "%' or 
			c_state like '%" . $searchValue . "%' or 
			c_division like '%" . $searchValue . "%' or 
			c_town like '%" . $searchValue . "%' ) ";
		}

		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

        //# Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ss_recruitment_form rrf');
		$this->db->join('users as u', 'rrf.created_by = u.mobile');
        $this->db->where($postData_where);
		if(count($postData_where_id) !=0){
			$this->db->where_in('rrf.created_by',$postData_where_id);
		}

		$records = $this->db->get()->result();

		$totalRecords = $records[0]->allcount;

        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
        $this->db->from('ss_recruitment_form rrf');
		$this->db->join('users as u', 'rrf.created_by = u.mobile');
		if(count($postData_where_id) !=0){
			$this->db->where_in('rrf.created_by',$postData_where_id);
		}
        $this->db->where($postData_where);
		
		if ($searchQuery != '') $this->db->where($searchQuery);
		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select('rrf.*,u.username as created_by');
		$this->db->from('ss_recruitment_form rrf');
		$this->db->join('users as u', 'rrf.created_by = u.mobile');
		if(count($postData_where_id) !=0){
			$this->db->where_in('rrf.created_by',$postData_where_id);
		}
        $this->db->where($postData_where);

		if ($searchQuery != '') $this->db->where($searchQuery);
		$this->db->order_by('id', 'desc');  // or desc

		$this->db->limit($rowperpage, $start);

		$records = $this->db->get()->result();

		$data = array();

		foreach ($records as $record) {
			$timedate1 = strtotime(date("Y-m-d", strtotime($record->created_on)));
			$created_on = date("d-m-Y", $timedate1);
			
            $action_url1 = base_url()."uploads/".$record->c_resume;

			if($record->c_resume !=''){
				$resume = '<img src="'.$action_url1.'" onclick="show_pop_img()" class="user-img" alt="">';

			}else{
				$resume = '';
			}

			$get_va_status = $record->va_status;

			if($get_va_status =='Inprogress'){
				$va_status = '<span class="badge badge-warning">Inprogress</span>';
			}elseif($get_va_status =='Verified'){
				$va_status = '<span class="badge badge-success">Verified</span>';
			}
			elseif($get_va_status =='Not Verified'){
				$va_status = '<span class="badge badge-danger">Not Verified</span>';

			}else{
                $va_status = '';
            }

			$get_asm_status = $record->asm_status;

			if($get_asm_status =='Inprogress'){
				$asm_status = '<span class="badge badge-warning">Inprogress</span>';
			}elseif($get_asm_status =='Approved'){
				$asm_status = '<span class="badge badge-success">Approved</span>';
			}
			elseif($get_asm_status =='Future Prospect'){
				$asm_status = '<span class="badge badge-danger">Future Prospect</span>';

			}else{
                $asm_status ='';
            }


			$action = '<button onclick="get_adtdetails_pop('."'".$record->auto_id."'".');" class="btn  btn-sm btn-info dt-btn-st" id="adtbtn"><i class="bx bx-comment-dots"></i></button>';

			$score 	= 	$record->c_age_of_org_point + $record->c_comp_handled_point + $record->c_towns_serviced_point + 
						$record->c_godown_point + $record->c_computer_point + $record->c_printer_point+ $record->c_internet_point+ $record->c_delivery_vehicle_point+ $record->c_fut_inverstment_point+ $record->c_prop_invol_point+ $record->c_market_fb_point;

			// $action .= ' <button onclick="get_action_pop('."'".$record->auto_id."'".');" class="btn  btn-sm btn-danger dt-btn-st" id="actnbtn"><i class="bx bx-task"></i></button>';

			// get vso score
			$this->db->select('*');
			$this->db->from('ss_recruitment_form_vso');
			$this->db->where('auto_id',$record->auto_id);
			$this->db->order_by('id', 'desc');  // or desc
				
			$records_vso = $this->db->get()->result();

			if(count($records_vso) !=0){

				$vso_score 	= $records_vso[0]->c_age_of_org_point + $records_vso[0]->c_comp_handled_point + $records_vso[0]->c_towns_serviced_point + $records_vso[0]->c_godown_point + $records_vso[0]->c_computer_point + $records_vso[0]->c_printer_point + $records_vso[0]->c_internet_point + $records_vso[0]->c_delivery_vehicle_point + $records_vso[0]->c_fut_inverstment_point+ $records_vso[0]->c_prop_invol_point+ $records_vso[0]->c_market_fb_point;
			}else{
				$vso_score = $score;
			}

			$data[] = array(
				"id" => $record->id,
				"auto_id" => $record->auto_id,
				"name" => $record->c_name,
				"c_sname" => $record->c_sname,
				"c_gst_no" => $record->c_gst_no,
				"ex_ss_name" => $record->c_ex_ss_name,
				"mobile_no" => $record->c_mobile_no,
				"alt_mobile_no" => $record->c_altmobile_no,
				"address" => $record->c_address,
				"state" => $record->c_state,
				"division" => $record->c_division,
				"town" => $record->c_town,
				"resume" => $resume,
				"created_on" => $created_on,
				"va_status" => $va_status,
				"asm_status" => $asm_status,
				"score" => $score,
				"vso_score" => $vso_score,
				"created_by" => $record->created_by,
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

    function verify_data_ff_ssforms($postData,$postData_where,$postData_where_id){
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
			$search_arr[] = " (c_name like '%" . $searchValue . "%' or 
			c_mobile_no like '%" . $searchValue . "%' or 
			c_altmobile_no like '%" . $searchValue . "%' or 
			c_address like '%" . $searchValue . "%' or 
			c_state like '%" . $searchValue . "%' or 
			c_division like '%" . $searchValue . "%' or 
			c_town like '%" . $searchValue . "%' ) ";
		}

		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

        //# Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ss_recruitment_form rrf');
		$this->db->join('users as u', 'rrf.created_by = u.mobile');
        $this->db->where($postData_where);
		if(count($postData_where_id) !=0){
			$this->db->where_in('rrf.created_by',$postData_where_id);
		}
		$records = $this->db->get()->result();

		$totalRecords = $records[0]->allcount;

        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
        $this->db->from('ss_recruitment_form rrf');
		$this->db->join('users as u', 'rrf.created_by = u.mobile');
		if(count($postData_where_id) !=0){
			$this->db->where_in('rrf.created_by',$postData_where_id);
		}
        $this->db->where($postData_where);
		
		if ($searchQuery != '') $this->db->where($searchQuery);
		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select('rrf.*,u.username as created_by');
		$this->db->from('ss_recruitment_form rrf');
		$this->db->join('users as u', 'rrf.created_by = u.mobile');
		if(count($postData_where_id) !=0){
			$this->db->where_in('rrf.created_by',$postData_where_id);
		}
        $this->db->where($postData_where);

		if ($searchQuery != '') $this->db->where($searchQuery);
		$this->db->order_by('id', 'desc');  // or desc

		$this->db->limit($rowperpage, $start);

		$records = $this->db->get()->result();

		$data = array();

		foreach ($records as $record) {
			$timedate1 = strtotime(date("Y-m-d", strtotime($record->created_on)));
			$created_on = date("d-m-Y", $timedate1);
			
            $action_url1 = base_url()."uploads/".$record->c_resume;

			if($record->c_resume !=''){
				$resume = '<img src="'.$action_url1.'" onclick="show_pop_img()" class="user-img" alt="">';

			}else{
				$resume = '';
			}

			$get_va_status = $record->va_status;

			if($get_va_status =='Inprogress'){
				$va_status = '<span class="badge badge-warning">Inprogress</span>';
			}elseif($get_va_status =='Verified'){
				$va_status = '<span class="badge badge-success">Verified</span>';
			}
			elseif($get_va_status =='Not Verified'){
				$va_status = '<span class="badge badge-danger">Not Verified</span>';

			}else{
                $va_status = '';
            }

			$get_asm_status = $record->asm_status;

			if($get_asm_status =='Inprogress'){
				$asm_status = '<span class="badge badge-warning">Inprogress</span>';
			}elseif($get_asm_status =='Approved'){
				$asm_status = '<span class="badge badge-success">Approved</span>';
			}
			elseif($get_asm_status =='Future Prospect'){
				$asm_status = '<span class="badge badge-danger">Future Prospect</span>';

			}else{
                $asm_status ='';
            }


			$action = '<button onclick="get_adtdetails_pop('."'".$record->auto_id."'".');" class="btn  btn-sm btn-info dt-btn-st" id="adtbtn"><i class="bx bx-comment-dots"></i></button>';

			$score 	= 	$record->c_age_of_org_point + $record->c_comp_handled_point + $record->c_towns_serviced_point + 
						$record->c_godown_point + $record->c_computer_point + $record->c_printer_point+ $record->c_internet_point+ $record->c_delivery_vehicle_point+ $record->c_fut_inverstment_point+ $record->c_prop_invol_point+ $record->c_market_fb_point;

			// $action .= ' <button onclick="get_action_pop('."'".$record->auto_id."'".');" class="btn  btn-sm btn-danger dt-btn-st" id="actnbtn"><i class="bx bx-task"></i></button>';

			$data[] = array(
				"id" => $record->id,
				"auto_id" => $record->auto_id,
				"name" => $record->c_name,
				"c_sname" => $record->c_sname,
				"c_gst_no" => $record->c_gst_no,
				"ex_ss_name" => $record->c_ex_ss_name,
				"mobile_no" => $record->c_mobile_no,
				"alt_mobile_no" => $record->c_altmobile_no,
				"address" => $record->c_address,
				"state" => $record->c_state,
				"division" => $record->c_division,
				"town" => $record->c_town,
				"resume" => $resume,
				"created_on" => $created_on,
				"va_status" => $va_status,
				"asm_status" => $asm_status,
				"score" => $score,
				"created_by" => $record->created_by,
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
}

?>