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
		// print_r($this->db->last_query());die;
		$message = "success";
		return $message;
	}

	function get_table_user_list($table,$group_by,$order_by){

		$this->db->order_by($order_by, 'asc');  // or desc
		$this->db->group_by($group_by);
		$records = $this->db->get($table);
		//print_r($this->db->last_query());die;
		return $records->result();
		
	}

	function get_table_user_list_wc($table,$where,$group_by,$order_by){
		$this->db->where($where);
		$this->db->order_by($order_by, 'asc');  // or desc
		$this->db->group_by($group_by);
		$records = $this->db->get($table);
		// print_r($this->db->last_query());die;
		return $records->result();
		
	}

	function get_role_list_id($table,$select,$where,$group_by,$order_by){
		
		$this->db->select($select);
		$this->db->where($where);
		$this->db->order_by($order_by, 'asc');  // or desc
		$this->db->group_by($group_by);
		$records = $this->db->get($table);
		 // print_r($this->db->last_query());die;
		return $records->result();
		
	}

	function get_table_list($table,$where,$group_by,$order_by){

		$this->db->where($where);
		$this->db->order_by($order_by, 'asc');  // or desc
		$this->db->group_by($group_by);
		$records = $this->db->get($table);
		//print_r($this->db->last_query());die;
		return $records->result();
		
	}
	function verify_data($table,$where){
		$this->db->where($where);
		$records = $this->db->get($table);
		// print_r($this->db->last_query());die;
		return $records->result();
		// echo"<pre>";print_r($records);die;
	}

function check_key_value($table,$svalue){

        $this->db->select('count(*) as allcount');
        $this->db->where($svalue);
        $records = $this->db->get($table);
         // echo "<pre>";print_r($query);die;
		return $records->result();
	}
	function verify_data_wc($table_name,$order_by,$group_by){
		
		$this->db->order_by($order_by, 'asc');  // or desc
		$this->db->group_by($group_by);
		$records = $this->db->get($table_name);
		return $records->result();
	}

	function verify_data_essforms($postData,$postData_where){
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
		$this->db->from('ss_recruitment_form');
        $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecords = $records[0]->allcount;

        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ss_recruitment_form');
        $this->db->where($postData_where);
		
		if ($searchQuery != '') $this->db->where($searchQuery);
		$records = $this->db->get()->result();

//print_r($this->db->last_query());
		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select('*');
		$this->db->from('ss_recruitment_form');
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
				$va_status ='';
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

			$action = '<button onclick="get_adtdetails_pop('."'".$record->auto_id."'".');" class="btn  btn-sm btn-success dt-btn-st" id="adtbtn"><i class="bx bx-comment-dots"></i></button>';

			$score 	= 	$record->c_age_of_org_point + $record->c_comp_handled_point + $record->c_towns_serviced_point +$record->c_godown_point + $record->c_computer_point + $record->c_printer_point+ $record->c_internet_point+ $record->c_delivery_vehicle_point+ $record->c_fut_inverstment_point+ $record->c_prop_invol_point+ $record->c_market_fb_point;

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
		// print_r($this->db->last_query());die;

		return $response;
	}

	function verify_data_fssforms($postData,$postData_where){
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
		$this->db->from('ss_recruitment_form');
        $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecords = $records[0]->allcount;

        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ss_recruitment_form');
        $this->db->where($postData_where);
		
		if ($searchQuery != '') $this->db->where($searchQuery);
		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select('*');
		$this->db->from('ss_recruitment_form');
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

            $action_url2 = base_url()."index.php/ss_recruitment/SSController/edit_ss_rec_form/".$record->auto_id;

			if($record->c_resume !=''){
				$resume = '<img src="'.$action_url1.'" onclick="show_pop_img()" class="user-img" alt="">';

			}else{
				$resume = '';
			}
			
			$action = '<button onclick="get_adtdetails_pop('."'".$record->auto_id."'".');" class="btn  btn-sm btn-info dt-btn-st" id="adtbtn"><i class="bx bx-comment-dots"></i></button>';
			
			$action .= ' <a href="'.$action_url2.'" target="_blank"><button  class="btn  ml-1 btn-sm btn-dark dt-btn-st" id="editBtn"><i class="bx bx-pencil"></i></button></a>';

			$score 	= 	$record->c_age_of_org_point + $record->c_comp_handled_point + $record->c_towns_serviced_point + 
						$record->c_godown_point + $record->c_computer_point + $record->c_printer_point+ $record->c_internet_point+ $record->c_delivery_vehicle_point+ $record->c_fut_inverstment_point+ $record->c_prop_invol_point+ $record->c_market_fb_point;


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

	function verify_data_keyssforms($postData,$postData_where){
		// echo "<pre>";print($postData_where);die;
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
			$search_arr[] = " (kn.rs_key_name like '%" . $searchValue . "%' or 
			created_by like '%" . $searchValue . "%' or 
			created_on like '%" . $searchValue . "%') ";
		}

		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

        //# Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ss_key_performance as a');
		$this->db->join('rs_keyperformance_name as kn','a.key_name=kn.id');
        	$this->db->where('a.created_by',$postData_where);

		$records = $this->db->get()->result();

		$totalRecords = $records[0]->allcount;

        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ss_key_performance as a');
		$this->db->join('rs_keyperformance_name as kn','a.key_name=kn.id');
        	$this->db->where('a.created_by',$postData_where);
		
		if ($searchQuery != '') $this->db->where($searchQuery);
		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select('*');
		$this->db->from('ss_key_performance as a');
		$this->db->join('rs_keyperformance_name as kn','a.key_name=kn.id');
        	$this->db->where('a.created_by',$postData_where);

		if ($searchQuery != '') $this->db->where($searchQuery);
		$this->db->order_by('a.id', 'desc');  // or desc

		$this->db->limit($rowperpage, $start);
		$records = $this->db->get()->result();
		// print_r($this->db->last_query());die;

		$data = array();

		foreach ($records as $record) {
			// echo "<pre>";print_r($record);die();
			$timedate1 = strtotime(date("Y-m-d", strtotime($record->created_on)));
			$created_on = date("d-m-Y", $timedate1);
            // $action_url1 = base_url()."uploads/".$record->c_resume;

            $action_url2 = base_url()."index.php/ss_recruitment/SSController/edit_ss_key_form/".$record->auto_id;

			$action = '<button onclick="get_adtkeydetails_pop('."'".$record->auto_id."'".');" class="btn  btn-sm btn-info dt-btn-st" id="adtbtn"><i class="bx bx-comment-dots"></i></button>';
			
			$action .= ' <a http-equiv = "refresh" href="'.$action_url2.'" target="_blank"><button  class="btn  ml-1 btn-sm btn-dark dt-btn-st" id="editBtn"><i class="bx bx-pencil"></i></button></a>';

			$score 	= $record->key_stocks_point + $record->key_infra_point + $record->key_infra_delivery_point + $record->key_number_point + $record->key_order_point + $record->key_absenteeism_point + $record->key_absenteeism_actual_point + $record->key_npd_point + $record->key_infrastructure_point + $record->key_financials_point + $record->key_ssfa_point + $record->key_xdm_point + $record->key_issues_raised_point;

			$data[] = array(
				"id" => $record->id,
				"rs_key_name" => $record->rs_key_name,
				"key_stocks" => $record->key_stocks,
				"key_infra" => $record->key_infra,
				"start_key_date" => $record->start_key_date." - ".$record->end_key_date,
				"key_number" => $record->key_number,
				"key_order" => $record->key_order,
				"created_on" => $created_on,
				"score" => $score,
				"action"=>$action,
				"created_by" => $record->created_by

			);
		}

        //# Response
		$response = array(
			"draw" => intval($draw),
			"iTotalRecords" => $totalRecords,
			"iTotalDisplayRecords" => $totalRecordwithFilter,
			"aaData" => $data
		);
		// echo "<pre>";print_r($response);die;
		return $response;
	}

	function list_menu_forms($where_cond,$postData_where,$postData){
	//# Total number of record with filtering
	// echo "<pre>";print_r($where_cond);die;
	$a=$postData['key_name'];
	$month = date('Y-m');
	// $b=$postData['start_key_date'];
				$this->db->select('');
				$this->db->from('ss_key_performance as rp');
				$this->db->join('rs_keyperformance_name as nm', 'rp.key_name = nm.id');
			        $this->db->where('rp.key_name',$a);
			        $this->db->like('rp.start_key_date', $month);
		       		$this->db->order_by("rp.start_key_date", "asc");
			        // $this->db->limit('4');
			        // $this->db->like('rp.start_key_date',$b);
				$records = $this->db->get()->result();
				// print_r($this->db->last_query());die;
				return $records;


	}

	public function updates($table, $data, $col, $id){
	// echo "string4";print_r($id);die;
	/*echo "string1";print_r($table);
	echo "string2";print_r($data);
	echo "string3";print_r($col);die;*/
		$this->db->where($col, $id);
		$this->db->update($table, $data);
		// print_r($this->db->last_query());die;
		$message = "success";
		return $message?true:false;
	}
}

