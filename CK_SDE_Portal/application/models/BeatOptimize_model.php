<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BeatOptimize_model extends CI_Model{
	public function get_data($table,$sess_mob){

		$this->db->select();
		$this->db->where('mobile',$sess_mob);
		$details = $this->db->get($table);
		return $details->result();
	}

	public function get_data_tso_sde_details($table,$sess_mob){

		$this->db->select();
		$this->db->where('am_number',$sess_mob);
		// $this->db->where('asm_number',$sess_mob);
		$this->db->group_by('tso');
		$records = $this->db->get($table);
		
		return $records->result();
		
	}

	public function get_sde_list($table,$asm_number)
    {

		$this->db->select();
		$this->db->where('am_number',$asm_number);
		// $this->db->where('asm_number',$asm_number);
		$this->db->group_by('tso');
		$records = $this->db->get($table);
		
		return $records->result_array();
    }

	public function get_data_asm_details($table,$sess_mob){

		$this->db->select();
		$this->db->where('zm_number',$sess_mob);
		// $this->db->where('zsm_number',$sess_mob);
		// $this->db->group_by('asm');
		$this->db->group_by('am');
		$records = $this->db->get($table);
		
		return $records->result();
		
	}
    
	public function get_beat_dist_report($postData) {

		$response = array();
		//$show = $postData['status'];
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
			$search_arr[] = " (dist_cus_code like '%" . $searchValue . "%' or 
            cmp_cus_code like '%" . $searchValue . "%' or 
            outlet_name like '%" . $searchValue . "%' or 
            outlet_score like '%" . $searchValue . "%' ) ";
		}
		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

        //# Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('beat_optimization');
		$records = $this->db->get()->result();
		$totalRecords = $records[0]->allcount;

        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('beat_optimization');

		if ($searchQuery != '') $this->db->where($searchQuery);
		$records = $this->db->get()->result();
		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select('*');
		$this->db->from('beat_optimization');
		if ($searchQuery != '') $this->db->where($searchQuery);

		// $this->db->order_by('id', 'desc');  // or desc
		$this->db->limit($rowperpage, $start);
		$records = $this->db->get()->result();
		$data = array();

		foreach ($records as $record) {
			
			$data[] = array(
				"id" 						=> $record->id,
				"dist_name"             	=> $record->ss_name,
				"dist_cus_code"             => $record->dist_cus_code,
				"outlet_name"               => $record->outlet_name,
				"outlet_score"              => $record->outlet_score,
				"status"					=>'Completed',
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


    public function get_beat_optimize_report($postData,$postData_where) {

		$response = array();

		//$show = $postData['status'];
		$draw = $postData['draw'];
		$start = $postData['start'];
		$rowperpage = $postData['length']; // Rows display per page
		$columnIndex = $postData['order'][0]['column']; // Column index
		$columnName = $postData['columns'][$columnIndex]['data']; // Column name
		$columnSortOrder = $postData['order'][0]['dir']; // asc or desc
		$searchValue = $postData['search']['value']; // Search value

		$search_arr = array();
		$searchQuery = "";

		if ($postData_where != '') {
			$role_type = $postData_where['role_type'];
			if($role_type ==="TSO"){
				$sde_number = $postData_where['sde_number'];
			}elseif($role_type ==="ASM"){
				$sde_number = $postData_where['sde_number'];
				$asm_number = $postData_where['asm_number'];
			}elseif($role_type ==="ZSM"){

				$asm_number = $postData_where['asm_number'];
				$zsm_number = $postData_where['zsm_number'];
			}
			elseif($role_type ==="Division_Head"){
				$channel = $postData_where['channel'];
			}
			// $sde_name = $postData_where['sde_name'];
			// $asm_name = $postData_where['asm_name'];
		}

		if ($searchValue != '') {
			$search_arr[] = " (dist_master.dist_code like '%" . $searchValue . "%' or 
            dist_master.dist_name like '%" . $searchValue . "%' or 
            dist_master.tso like '%" . $searchValue . "%' or 
            dist_master.tso_number like '%" . $searchValue . "%' or 
            dist_master.am_number like '%" . $searchValue . "%' or 
            dist_master.zm like '%" . $searchValue . "%' or 
            dist_master.am like '%" . $searchValue . "%' ) ";
		}

		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

        //# Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('dist_master');
		// $this->db->join('beat_optimization', 'dist_master.tso_number = beat_optimization.sde_number');
		if ($postData_where != '') {
			if($role_type ==="TSO"){
				$this->db->where('dist_master.tso_number', $sde_number);
			}elseif($role_type ==="ASM"){
				if($sde_number !== ""){
					$this->db->where('dist_master.am_number', $asm_number);
					$this->db->where('dist_master.tso_number', $sde_number);
				}else{
					$this->db->where('dist_master.am_number', $asm_number);
				}
			}elseif($role_type ==="ZSM"){
				if($asm_number !== ""){
					$this->db->where('dist_master.zm_number', $zsm_number);
					$this->db->where('dist_master.am_number', $asm_number);
					if( $postData_where['sde_number'] !== ""){
						$this->db->where('dist_master.tso_number', $postData_where['sde_number']);
					}
				}else{
					$this->db->where('dist_master.zm_number', $zsm_number);
				}
			}elseif($role_type ==="Division_Head"){	
				
					$this->db->like('dist_master.channel', $channel);
			}
		}
		if ($searchQuery != '') $this->db->where($searchQuery);
		$this->db->group_by('dist_master.dist_code');
		$records = $this->db->get()->result();
		$totalRecords = count($records);
		
        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('dist_master');
		// $this->db->join('beat_optimization ', 'dist_master.tso_number = beat_optimization.sde_number');
		if ($postData_where != '') {
			if($role_type ==="TSO"){
				$this->db->where('dist_master.tso_number', $sde_number);
			}elseif($role_type ==="ASM"){
				if($sde_number !== ""){
					$this->db->where('dist_master.am_number', $asm_number);
					$this->db->where('dist_master.tso_number', $sde_number);
				}else{
					$this->db->where('dist_master.am_number', $asm_number);
				}
			}elseif($role_type ==="ZSM"){
				if($asm_number !== ""){
					$this->db->where('dist_master.zm_number', $zsm_number);
					$this->db->where('dist_master.am_number', $asm_number);
					if( $postData_where['sde_number'] !== ""){
						$this->db->where('dist_master.tso_number', $postData_where['sde_number']);
					}
				}else{
					$this->db->where('dist_master.zm_number', $zsm_number);
				}
			}elseif($role_type ==="Division_Head"){	
				
				$this->db->like('dist_master.channel', $channel);
		}
		}

		if ($searchQuery != '') $this->db->where($searchQuery);
		$this->db->group_by('dist_master.dist_code');

		$records = $this->db->get()->result();
		
		$totalRecordwithFilter = count($records);
		// $totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select('dist_master.*');
		$this->db->from('dist_master');
		// $this->db->join('beat_optimization ', 'dist_master.tso_number = beat_optimization.sde_number');
		if ($postData_where != '') {

			if($role_type ==="TSO"){
				$this->db->where('dist_master.tso_number', $sde_number);
			}elseif($role_type ==="ASM"){

				if($sde_number !== ""){
					$this->db->where('dist_master.am_number', $asm_number);
					$this->db->where('dist_master.tso_number', $sde_number);
				}else{
					$this->db->where('dist_master.am_number', $asm_number);
				}
			}elseif($role_type ==="ZSM"){
				if($asm_number !== ""){
					$this->db->where('dist_master.zm_number', $zsm_number);
					$this->db->where('dist_master.am_number', $asm_number);
					if( $postData_where['sde_number'] !== ""){
						$this->db->where('dist_master.tso_number', $postData_where['sde_number']);
					}
				}else{
					$this->db->where('dist_master.zm_number', $zsm_number);
				}
			}elseif($role_type ==="Division_Head"){	
				
				$this->db->like('dist_master.channel', $channel);
			}
		}
		if ($searchQuery != '') $this->db->where($searchQuery);
		$this->db->group_by('dist_master.dist_code');
		$this->db->order_by($columnName, $columnSortOrder);  // or desc
		$this->db->limit($rowperpage, $start);
		$records = $this->db->get()->result();
		$data = array();

		foreach ($records as $record) {

			if($record->tso_number != ""){
				$no_of_outlets = $this->db->select('*')->where('dist_cus_code',$record->dist_code)->count_all_results('beat_optimization');
			}
			
			if($record->dist_code != ""){

				$outlet_status = $this->db->select('*')->where('dist_cus_code',$record->dist_code)->count_all_results('beat_optimization');

				// $this->db->select('beat_optimization.*');
				// $this->db->join('dist_master', 'beat_optimization.sde_number = dist_master.tso_number');
				// $this->db->where('dist_master.dist_code','=','beat_optimization.dist_cus_code');
				// $quer = $this->db->where('dist_master.dist_code',$record->dist_code);
				// $dist_status = $quer->count_all_results('beat_optimization');

				if($outlet_status != 0){
					$status = '<p style="color:green;">Completed</p>';
				}else{
					$status = '<p style="color:red;">Pending</p>';
				}
			}

			$data[] = array(
				"id" 						=> $record->id,
				"dist_cus_code"             => $record->dist_code,
				"dist_name"             	=> $record->dist_name,
				"dist_type"             	=> $record->dist_type,
				"no_of_outlets"             => $no_of_outlets,
				"zm"                        => $record->zm,
				"am"                        => $record->am,
				"tso"              			=> $record->tso,
				"tso_number"              	=> $record->tso_number,
				// "salesman_name"             => $record->salesman_name,
				// "salesman_ssfa_id"          => $record->salesman_ssfa_id,
				"status"					=> $status,
			);
		}
		$response = array(
			"draw" => intval($draw),
			"iTotalRecords" => $totalRecords,
			"iTotalDisplayRecords" => $totalRecordwithFilter,
			"aaData" => $data
		);

		return $response;
	} 
	   
	public function get_pending_form_list($date){

		$created_by = $this->session->userdata('mobile');

        $this->db->select();
		$this->db->where('cast(created_on as Date) =' , $date);
		$this->db->where('created_by =' , $created_by);
        $this->db->order_by('id', 'desc');// or desc

        $records = $this->db->get('sde_market_visit_report');
        // return $records->result();
        return $records->result_array();
	}


	public function get_last_id($table){

		$created_by = $this->session->userdata('mobile');

		$this->db->select('*');
		$this->db->where('created_by =' , $created_by);  
		$this->db->order_by('id', 'desc');// or desc
		$lid = $this->db->get($table);
		return $lid->result_array();

	}
	public function get_beat_uploaded_sde($table){

		$this->db->select();
		$this->db->group_by('sde_number');
		$records = $this->db->get($table);
		
		return $records->result();
		
	}
	// public function get_beat_pending_sde($table,$sde_mob){

	// 	$this->db->select();
	// 	$this->db->where('role_type =' ,'TSO');
	// 	$this->db->where_not_in('mobile', $sde_mob); 
	// 	$records = $this->db->get($table);
		
	// 	return $records->result();
		
	// }

	public function get_beat_pending_sde($postData,$sde_mob){

		$response = array();

		//$show = $postData['status'];
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
			$search_arr[] = " (username like '%" . $searchValue . "%' or 
            user_id like '%" . $searchValue . "%' or 
            mobile like '%" . $searchValue . "%' ) ";
		}


		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

        //# Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('users');
		$this->db->where('role_type =' ,'TSO');
		$this->db->where_not_in('mobile', $sde_mob); 

		$records = $this->db->get()->result();

		$totalRecords = $records[0]->allcount;

		
        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('users');
		$this->db->where('role_type =' ,'TSO');
		$this->db->where_not_in('mobile', $sde_mob); 

		if ($searchQuery != '') $this->db->where($searchQuery);

		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('role_type =' ,'TSO');
		$this->db->where_not_in('mobile', $sde_mob); 
		if ($searchQuery != '') $this->db->where($searchQuery);

		// $this->db->order_by('id', 'desc');  // or desc
		$this->db->limit($rowperpage, $start);
		$records = $this->db->get()->result();

		$data = array();

		foreach ($records as $record) {
			
			$data[] = array(
				"id" => $record->id,
				"username"      => $record->username,
				"user_id"       => $record->user_id,
				"mobile"        => $record->mobile,
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
