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

	//sde market visit
	public function get_data($table){
		$this->db->select();
		$records = $this->db->get($table);
		return $records->result();

	}

	public function get_data_rs($table,$group_by){

		$mobile = $this->session->userdata('mobile');

		if( $this->session->userdata('role') == 'TSO'){
			$this->db->where('tso_mobile',$mobile);
		}elseif($this->session->userdata('role') == 'SM'){
			$this->db->where('sm_mobile',$mobile);
		}
		$this->db->select();
		$this->db->group_by($group_by);
		$records = $this->db->get($table);
		return $records->result();
	}


	public function get_data_beat($table ,$condition){
		$mobile = $this->session->userdata('mobile');

		if( $this->session->userdata('role') == 'TSO'){
			$this->db->where_in('sm_mobile',$condition);
			// $this->db->where('tso_mobile',$mobile);
		}elseif($this->session->userdata('role') == 'SM'){
			$this->db->where('sm_mobile',$mobile);
		}
		$this->db->select();
		$records = $this->db->get($table);
		return $records->result();
	}

	public function get_data_rssm($table ,$condition){
		$mobile = $this->session->userdata('mobile');

		if( $this->session->userdata('role') == 'TSO'){
			$this->db->where_in('ssfa_id',$condition);
			// $this->db->where('tso_mobile',$mobile);
		}elseif($this->session->userdata('role') == 'SM'){
			$this->db->where('sm_mobile',$mobile);
		}
		$this->db->select();
		$records = $this->db->get($table);
		return $records->result();
	}

	public function get_data_users($table ,$condition){
		$mobile = $this->session->userdata('mobile');

		if( $this->session->userdata('role') == 'TSO'){
			$this->db->where_in('mobile',$condition);
			// $this->db->where('tso_mobile',$mobile);
		}elseif($this->session->userdata('role') == 'SM'){
			$this->db->where('sm_mobile',$mobile);
		}
		$this->db->select();
		$this->db->where('role','SM');
		$records = $this->db->get($table);
		return $records->result();
	}

	public function get_sde_report_data($table ,$id){
		$this->db->select();
		$this->db->where('id',$id);
		$records = $this->db->get($table);
		return $records->result();
	}

	function get_table_user_list($table,$where,$group_by,$order_by){

		$this->db->where($where);
		$this->db->order_by($order_by, 'asc');  // or desc
		$this->db->group_by($group_by);
		$records = $this->db->get($table);
		return $records->result();
		
	}

	public function get_sde_report_img_coldata($table , $col1, $col_val ,$col2){
		$this->db->select($col2);
		$this->db->where($col1 ,$col_val);
		$records = $this->db->get($table);
		return $records->result();
	}

	function get_business_user_list($table,$group_by){

		$this->db->group_by($group_by);
		$this->db->where('business !=',null);
		$this->db->where('business !=',"");
		$records = $this->db->get($table);
		return $records->result();
		
	}

	function get_business_user_list_m($table,$group_by){
		$role = $this->session->userdata('role_type');
		// print_r($role);
		// print_r($this->session->userdata('mobile'));
		if($role== "ZSM"){
			$this->db->where('zsm_number',$this->session->userdata('mobile'));
		}
		$this->db->group_by($group_by);
		$this->db->where('division !=',null);
		$this->db->where('division !=',"");
		$records = $this->db->get($table);
		return $records->result();
		
	}
	
	public function get_OSM($sm_number,$table){

		$data = $this->db->select('*')->order_by('id', 'desc')->limit(1)->get($table)->row();

		$records = $this->db->where('jc_type', $data->jc_type);
		$records = $this->db->where_in('ssfa_id',$sm_number);
		$records = $this->db->get($table);
		return $records->result();
	}


	public function get_without_OSM($sm,$table,$where,$group_by,$order_by){

		$this->db->where($where);
		$this->db->where_in('sm_number',$sm);
		$this->db->order_by($order_by, 'asc');  // or desc
		$this->db->group_by($group_by);
		$records = $this->db->get($table);
		return $records->result();
	}

	public function get_without_OSM_rs($sm,$table,$group_by,$order_by){

		$this->db->where_in('sm_number',$sm);
		$this->db->order_by($order_by, 'asc');  // or desc
		$this->db->group_by($group_by);
		$records = $this->db->get($table);
		return $records->result();
	}

	public function delete_image($table,$id,$data){
		$this->db->where('id', $id);
		$this->db->update($table, $data);
        return true;
	}

	//sde market visit end
	public function data_add($table, $val)
	{
		$this->db->insert($table, $val);
		$message = "success";
		return $message;
	}

	function verify_data($array, $table)
	{
		$this->db->where($array);
		$records = $this->db->get($table);
		return $records->result();
	}

	function verify_data1( $table ,$array)
	{
		$this->db->where($array);
		$records = $this->db->get($table);
		return $records->result();
	}

	public function verify_data2($table ,$array){
		$this->db2->where($array);
		$records = $this->db2->get($table);
		return $records->result();
	}

	function get_outlet( $table ,$array)
	{
        
		$this->db2->select('outlet_code, outlet_name');
		$this->db2->where($array);
		$this->db2->group_by('outlet_code');
		$records = $this->db2->get($table);
		return $records->result();
	}

	function updatePassword($data){
		// update all row as approved
		$this->db->set('password', $data['password']); 
		$this->db->where('mobile', $data['mobile']);
		$this->db->update('users');

   }

   public function verify_data_users_report($postData,$postData_where) {

		$response = array();

		//$show = $postData['status'];
		$draw = $postData['draw'];
		$start = $postData['start'];
		$rowperpage = $postData['length']; // Rows display per page
		$columnIndex = $postData['order'][0]['column']; // Column index
		$columnName = $postData['columns'][$columnIndex]['data']; // Column name
		$columnSortOrder = $postData['order'][0]['dir']; // asc or desc
		$searchValue = $postData['search']['value']; // Search value
        
		$created_by = $this->session->userdata('mobile');
		//# Search
		$search_arr = array();
		$searchQuery = "";
		$from_date = $postData_where['from_date_filter'];
		$to_date = $postData_where['to_date_filter'];
		$user_name_filter = $postData_where['user_name_filter'];
		$business_filter = $postData_where['business_filter'];


		if ($searchValue != '') {
			$search_arr[] = " (u.username like '%" . $searchValue . "%' or 
            u.mobile like '%" . $searchValue . "%' or 
            u.role like '%" . $searchValue . "%' or 
            u.business like'%" . $searchValue . "%' ) ";
		}

		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

        //# Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('users as u');
		$this->db->join('tso_login_log as tll', 'tll.mobile = u.mobile');
		if($from_date!=="" && $to_date!=="" && $user_name_filter!="" && $business_filter!=""){
            $this->db->where('DATE(login_time) >=', $from_date);
            $this->db->where('DATE(login_time) <=', $to_date);
        	$this->db->where('u.username', $user_name_filter);
        	$this->db->where('u.business', $business_filter);
        }elseif($from_date!=="" && $to_date!=="" && $user_name_filter!=""){
            $this->db->where('DATE(login_time) >=', $from_date);
            $this->db->where('DATE(login_time) <=', $to_date);
        	$this->db->where('u.username', $user_name_filter);
        }elseif($from_date!=="" && $to_date!=="" && $business_filter!=""){
            $this->db->where('DATE(login_time) >=', $from_date);
            $this->db->where('DATE(login_time) <=', $to_date);
        	$this->db->where('u.business', $business_filter);
        }elseif($from_date!=="" && $to_date!==""){
            $this->db->where('DATE(login_time) >=', $from_date);
            $this->db->where('DATE(login_time) <=', $to_date);
        }elseif($user_name_filter!="" && $business_filter!=""){
        	$this->db->where('u.username', $user_name_filter);
        	$this->db->where('u.business', $business_filter);
        }elseif($from_date!="" && $business_filter!=""){
            $this->db->where('DATE(login_time)', $from_date);
            $this->db->where('u.business', $business_filter);
        }elseif($to_date!="" && $business_filter!=""){
            $this->db->where('DATE(login_time)', $to_date);
            $this->db->where('u.username', $business_filter);
        }elseif($from_date!="" && $user_name_filter!=""){
            $this->db->where('DATE(login_time)', $from_date);
            $this->db->where('u.username', $user_name_filter);
        }elseif($to_date!="" && $user_name_filter!=""){
            $this->db->where('DATE(login_time)', $to_date);
            $this->db->where('u.business', $user_name_filter);
        }elseif($from_date!=""){
            $this->db->where('DATE(login_time)', $from_date);
        }elseif($to_date!=""){
            $this->db->where('DATE(login_time)', $to_date);
        }elseif($user_name_filter!=""){
        	$this->db->where('u.username', $user_name_filter);
        }elseif($business_filter!=""){
        	$this->db->where('u.business', $business_filter);
        }

		$this->db->where('tll.mobile !=','AD001');		

		$records = $this->db->get()->result();

		$totalRecords = $records[0]->allcount;
		
        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('users as u');
		$this->db->join('tso_login_log as tll', 'tll.mobile = u.mobile');
		if($from_date!=="" && $to_date!=="" && $user_name_filter!="" && $business_filter!=""){
            $this->db->where('DATE(login_time) >=', $from_date);
            $this->db->where('DATE(login_time) <=', $to_date);
        	$this->db->where('u.username', $user_name_filter);
        	$this->db->where('u.business', $business_filter);
        }elseif($from_date!=="" && $to_date!=="" && $user_name_filter!=""){
            $this->db->where('DATE(login_time) >=', $from_date);
            $this->db->where('DATE(login_time) <=', $to_date);
        	$this->db->where('u.username', $user_name_filter);
        }elseif($from_date!=="" && $to_date!=="" && $business_filter!=""){
            $this->db->where('DATE(login_time) >=', $from_date);
            $this->db->where('DATE(login_time) <=', $to_date);
        	$this->db->where('u.business', $business_filter);
        }elseif($from_date!=="" && $to_date!==""){
            $this->db->where('DATE(login_time) >=', $from_date);
            $this->db->where('DATE(login_time) <=', $to_date);
        }elseif($user_name_filter!="" && $business_filter!=""){
        	$this->db->where('u.username', $user_name_filter);
        	$this->db->where('u.business', $business_filter);
        }elseif($from_date!="" && $business_filter!=""){
            $this->db->where('DATE(login_time)', $from_date);
            $this->db->where('u.business', $business_filter);
        }elseif($to_date!="" && $business_filter!=""){
            $this->db->where('DATE(login_time)', $to_date);
            $this->db->where('u.username', $business_filter);
        }elseif($from_date!="" && $user_name_filter!=""){
            $this->db->where('DATE(login_time)', $from_date);
            $this->db->where('u.username', $user_name_filter);
        }elseif($to_date!="" && $user_name_filter!=""){
            $this->db->where('DATE(login_time)', $to_date);
            $this->db->where('u.business', $user_name_filter);
        }elseif($from_date!=""){
            $this->db->where('DATE(login_time)', $from_date);
        }elseif($to_date!=""){
            $this->db->where('DATE(login_time)', $to_date);
        }elseif($user_name_filter!=""){
        	$this->db->where('u.username', $user_name_filter);
        }elseif($business_filter!=""){
        	$this->db->where('u.business', $business_filter);
        }

		if ($searchQuery != '') $this->db->where($searchQuery);
		$this->db->where('tll.mobile !=','AD001');		

		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select('*');
		$this->db->from('users as u');
		$this->db->join('tso_login_log as tll', 'tll.mobile = u.mobile');
		if($from_date!=="" && $to_date!=="" && $user_name_filter!="" && $business_filter!=""){
            $this->db->where('DATE(login_time) >=', $from_date);
            $this->db->where('DATE(login_time) <=', $to_date);
        	$this->db->where('u.username', $user_name_filter);
        	$this->db->where('u.business', $business_filter);
        }elseif($from_date!=="" && $to_date!=="" && $user_name_filter!=""){
            $this->db->where('DATE(login_time) >=', $from_date);
            $this->db->where('DATE(login_time) <=', $to_date);
        	$this->db->where('u.username', $user_name_filter);
        }elseif($from_date!=="" && $to_date!=="" && $business_filter!=""){
            $this->db->where('DATE(login_time) >=', $from_date);
            $this->db->where('DATE(login_time) <=', $to_date);
        	$this->db->where('u.business', $business_filter);
        }elseif($from_date!=="" && $to_date!==""){
            $this->db->where('DATE(login_time) >=', $from_date);
            $this->db->where('DATE(login_time) <=', $to_date);
        }elseif($user_name_filter!="" && $business_filter!=""){
        	$this->db->where('u.username', $user_name_filter);
        	$this->db->where('u.business', $business_filter);
        }elseif($from_date!="" && $business_filter!=""){
            $this->db->where('DATE(login_time)', $from_date);
            $this->db->where('u.business', $business_filter);
        }elseif($to_date!="" && $business_filter!=""){
            $this->db->where('DATE(login_time)', $to_date);
            $this->db->where('u.username', $business_filter);
        }elseif($from_date!="" && $user_name_filter!=""){
            $this->db->where('DATE(login_time)', $from_date);
            $this->db->where('u.username', $user_name_filter);
        }elseif($to_date!="" && $user_name_filter!=""){
            $this->db->where('DATE(login_time)', $to_date);
            $this->db->where('u.business', $user_name_filter);
        }elseif($from_date!=""){
            $this->db->where('DATE(login_time)', $from_date);
        }elseif($to_date!=""){
            $this->db->where('DATE(login_time)', $to_date);
        }elseif($user_name_filter!=""){
        	$this->db->where('u.username', $user_name_filter);
        }elseif($business_filter!=""){
        	$this->db->where('u.business', $business_filter);
        }

		if ($searchQuery != '') $this->db->where($searchQuery);
		$this->db->where('tll.mobile !=','AD001');		

		$this->db->order_by('u.id', 'desc');  // or desc

		$this->db->limit($rowperpage, $start);

		// echo '<pre>';print_r($this->db->last_query());die();
		$records = $this->db->get()->result();

		$data = array();

		foreach ($records as $record) {
			
			// $timedate1 = strtotime(date("Y-m-d", strtotime($record->created_on)));
			// $created_on = date("d-m-Y", $timedate1);

			$data[] = array(
				"id" => $record->id,
				"username" => $record->username,
				"mobile" => $record->mobile,
				"role" => $record->role,
				"business" => $record->business,
				"login_time" => $record->login_time,
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

	public function get_user_name_list()
    {

        $this->db->select('*');
        $this->db->from('users');   
        $this->db->group_by('username');    
        $this->db->order_by('username', 'asc');
        $record = $this->db->get();
        // echo '<pre>';print_r($record);die();
        $records = $record->result_array();

        return $records;

    }

    public function verify_data_users_report_count($postData,$postData_where) {

		$response = array();

		//$show = $postData['status'];
		$draw = $postData['draw'];
		$start = $postData['start'];
		$rowperpage = $postData['length']; // Rows display per page
		$columnIndex = $postData['order'][0]['column']; // Column index
		$columnName = $postData['columns'][$columnIndex]['data']; // Column name
		$columnSortOrder = $postData['order'][0]['dir']; // asc or desc
		$searchValue = $postData['search']['value']; // Search value
        
		$created_by = $this->session->userdata('mobile');
		//# Search
		$search_arr = array();
		$searchQuery = "";
		
		$user_name_filter = $postData_where['user_name_filter'];
		$business_filter = $postData_where['business_filter'];
		$created_on_filter = $postData_where['created_on_filter'];
		// echo '</pre>';print_r($created_on_filter);die();

		if ($searchValue != '') {
			$search_arr[] = " (u.username like '%" . $searchValue . "%' or 
            u.mobile like '%" . $searchValue . "%' ) ";
		}

		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

        //# Total number of records without filtering
		$this->db->select('*');
		$this->db->distinct();
		$this->db->from('users');
		$this->db->where('mobile !=','AD001');	
		// $this->db->group_by('mobile');	

		$records = $this->db->get()->result();
		if ($records =="") {
			$totalRecords = $records[0]->allcount;
		}else{
			$totalRecords ="";
		}


        //# Total number of record with filtering
		$this->db->select('count(*) as allcount, u.username as username, u.mobile as mobile, u.id as id, u.business as business');
		$this->db->distinct();
		$this->db->from('users as u');
		
		if($user_name_filter!=""){
        	$this->db->where('u.username', $user_name_filter);
        }
        if($business_filter!=""){
        	$this->db->where('u.business', $business_filter);
        }

		if ($searchQuery != '') $this->db->where($searchQuery);
		$this->db->where('u.mobile !=','AD001');
		// $this->db->group_by('u.mobile');		

		$records = $this->db->get()->result();
		// echo '</pre>';print_r($this->db->lastquery());die();

		foreach ($records as $mobile_value) {
			// echo '</pre>';print_r($mobile_value);die();

            $test=$mobile_value->mobile;

        $this->db->select('COUNT(created_by)as count1');
		$this->db->from('rssm_recruitment_form');
		$this->db->where('created_by',$mobile_value->mobile);
		if($created_on_filter!=""){
        	$this->db->where('DATE(created_on)', $created_on_filter);
        }
		$records_ese1 = $this->db->get()->result();

		$this->db->select('COUNT(created_by)as count2');
		$this->db->from('rs_recruitment_form');
		$this->db->where('created_by',$mobile_value->mobile);
		$records_ese2 = $this->db->get()->result();

        $this->db->select('COUNT(created_by)as count3');
		$this->db->from('ss_recruitment_form');
		$this->db->where('created_by',$mobile_value->mobile);
		$records_ese3 = $this->db->get()->result();


		$final_info[]=array('count1'=>$records_ese1[0]->count1,'count2'=>$records_ese2[0]->count2,'username'=>$mobile_value->username,'business'=>$mobile_value->business,'count3'=>$records_ese3[0]->count3,'mobile'=>$mobile_value->mobile,'id'=>$mobile_value->id);
		}

		if ($records =="") {
			$totalRecordwithFilter = $records[0]->allcount;
		}else{
			$totalRecordwithFilter ="";
		}
		

        //# Fetch records
		$this->db->select('*');
		$this->db->distinct();
		$this->db->from('users as u');
		if($user_name_filter!=""){
        	$this->db->where('u.username', $user_name_filter);
        }
        if($business_filter!=""){
        	$this->db->where('u.business', $business_filter);
        }
		if ($searchQuery != '') $this->db->where($searchQuery);
		$this->db->where('u.mobile !=','AD001');	
		$this->db->group_by('u.mobile');	

		$records_ese = $this->db->get()->result();


		foreach ($records_ese as $mobile_value) {

            $test=$mobile_value->mobile;

        $this->db->select('COUNT(created_by)as count1');
		$this->db->from('rssm_recruitment_form');
		$this->db->where('created_by',$mobile_value->mobile);
		if($created_on_filter!=""){
        	$this->db->where('DATE(created_on)', $created_on_filter);
        }
		$records_ese1 = $this->db->get()->result();
		// echo '</pre>';print_r($this->db->last_query());die();

		$this->db->select('COUNT(created_by)as count2');
		$this->db->from('rs_recruitment_form');
		$this->db->where('created_by',$mobile_value->mobile);
		if($created_on_filter!=""){
        	$this->db->where('DATE(created_on)', $created_on_filter);
        }
		$records_ese2 = $this->db->get()->result();

        $this->db->select('COUNT(created_by)as count3');
		$this->db->from('ss_recruitment_form');
		$this->db->where('created_by',$mobile_value->mobile);
		if($created_on_filter!=""){
        	$this->db->where('DATE(created_on)', $created_on_filter);
        }
		$records_ese3 = $this->db->get()->result();

		$final_info[]=array('count1'=>$records_ese1[0]->count1,'count2'=>$records_ese2[0]->count2,'username'=>$mobile_value->username,'business'=>$mobile_value->business,'count3'=>$records_ese3[0]->count3,'mobile'=>$mobile_value->mobile,'id'=>$mobile_value->id);
		}

		$data = array();

		foreach ($final_info as $record) {

		// echo '<pre>';print_r($record['count3']);die();
			
			// $timedate1 = strtotime(date("Y-m-d", strtotime($record->created_on)));
			// $created_on = date("d-m-Y", $timedate1);

			$data[] = array(
				"id" => $record['id'],
				"created_by" => $record['mobile'],
				"username" => $record['username'],	
				"business" => $record['business'],	
				"rssm_counts" => $record['count1'],
				"rs_counts" => $record['count2'],
				"ss_counts" => $record['count3']
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

	public function get_business_list()
    {

        $this->db->select('*');
        $this->db->from('masters');   
        $this->db->where('division!=', '');
        $this->db->group_by('division');    
        $this->db->order_by('division', 'asc');
        $record = $this->db->get();
        // echo '<pre>';print_r($record);die();
        $records = $record->result_array();

        return $records;
	}
		public function get_table_list($table,$where,$group_by,$order_by){

			$this->db->where($where);
			$this->db->order_by($order_by, 'asc');
			$records = $this->db->group_by($group_by)->get($table); 
			// print_r($records);die();
			 // or desc
			
			// $records = $this->db->get($table);
			return $records->result();
			
		}
		
	
    
	public function get_asm_approved_forms($postData,$postData_where,$postData_where_id){
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
			state like '%" . $searchValue . "%' or 
			rrf.division like '%" . $searchValue . "%' or 
			town like '%" . $searchValue . "%' or 
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
		$this->db->from('rssm_recruitment_form rrf');
		$this->db->join('users as u', 'rrf.created_by = u.mobile');
		// $this->db->join('masters as m', 'rrf.created_by = m.tso_number');
        $this->db->where($postData_where);
		if(count($postData_where_id) !=0){
			$this->db->where_in('rrf.created_by',$postData_where_id);
		}

		$records = $this->db->get()->result();


		$totalRecords = $records[0]->allcount;

        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
        $this->db->from('rssm_recruitment_form rrf');
		$this->db->join('users as u', 'rrf.created_by = u.mobile');
		// $this->db->join('masters as m', 'rrf.created_by = m.tso_number');

		if(count($postData_where_id) !=0){
			$this->db->where_in('rrf.created_by',$postData_where_id);
		}
        $this->db->where($postData_where);
		
		if ($searchQuery != '') $this->db->where($searchQuery);
		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select('rrf.*,m.*,u.*,u.username as created_by , rrf.email as rrf_email');
		$this->db->from('rssm_recruitment_form rrf');
		$this->db->join('users as u', 'rrf.created_by = u.mobile');
		$this->db->join('masters as m', 'rrf.created_by = m.tso_number');
        $this->db->group_by('rrf.auto_id');
		if(count($postData_where_id) !=0){
			$this->db->where_in('rrf.created_by',$postData_where_id);
		}
        $this->db->where($postData_where);

		if ($searchQuery != '') $this->db->where($searchQuery);
		$this->db->order_by('updated_on', 'desc');  // or desc

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
				$resume = '';
			}

			$get_asm_status = $record->asm_status;
			if($get_asm_status =='Inprogress'){
				$asm_class = 'badge-warning';
			}elseif($get_asm_status =='Approved'){
				$asm_class = 'badge-success';
			}elseif($get_asm_status =='Future Prospect'){
				$asm_class = 'badge-danger';
			}else{
                $asm_class ='badge-primary';
            }

			$get_rssm_status = $record->rssm_status;
			if($get_rssm_status =='Rejected'){
				$rssm_content = 'Rejected';
				$rssm_class = 'badge-danger';
			}elseif($get_rssm_status =='Approved'){
				$rssm_content = 'Approved';
				$rssm_class = 'badge-success';
			}else{
				$rssm_content = 'Pending';
                $rssm_class ='badge-primary';
            }

			if($record->rssm_remarks == ""){
				$asm_status = '<b>ASM : </b><span class="badge '.$asm_class.'">'.$get_asm_status.'</span><br>
				<b>RSSM : </b><span class="badge '.$rssm_class.'">'.$rssm_content.'</span>';
		
			}else{
				$remark = $record->rssm_remarks;
				$rssm_remark= wordwrap($remark,80,"<br>\n");
				$asm_status = '<b>ASM : </b><span class="badge '.$asm_class.'">'.$get_asm_status.'</span><br>
				<b>RSSM : </b><span class="badge '.$rssm_class.'">'.$rssm_content.'</span><br>
				<span style="display:flex"><b>RSSM Remarks: </b><span class="badge badge-danger">'.$rssm_remark.'</span></span>';
		
			}
			


			// $this->db->select('*');
			
            // if($record->add_status == 'Added'){
			$action = '<button onclick="view_adddetails('."'".$record->auto_id."'".');" class="btn m-1 btn-sm btn-primary dt-btn-st" id="adtbtn"><i class="fa fa-eye"></i></button>';
			if($record->auto_id == 'New SalesMan'){
				$action .= '<button onclick="download_excel('."'".$record->auto_id."'".');" class="btn m-1 btn-sm btn-primary dt-btn-st" id="adtbtn"><i class="fa fa-download"></i></button>';
			// }else{
			// 	$action .= '<button  class="btn m-1 btn-sm btn-primary dt-btn-st" id="adtbtn"><i class="fa fa-download" disabled></i></button>';

			}

			// }else{
			// 	$action = '<button onclick="get_adtdetails_pop('."'".$record->auto_id."'".');" class="btn  btn-sm btn-success dt-btn-st" id="adtbtn"><i class="bx bx-comment-dots"></i></button>';

			// }
			$score 	= 	$record->exp_point + $record->edu_point + $record->age_point + 
						$record->tk_point + $record->ta_point + $record->fb_point;

			// $action .= ' <button onclick="get_action_pop('."'".$record->auto_id."'".');" class="btn  btn-sm btn-danger dt-btn-st" id="actnbtn"><i class="bx bx-task"></i></button>';
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

			$date_of_joining = strtotime(date("Y-m-d", strtotime($record->doj)));
			$doj = date("d-m-Y", $date_of_joining);

			$date_of_birth = strtotime(date("Y-m-d", strtotime($record->dob)));
			$dob = date("d-m-Y", $date_of_birth);

			if($record->service_fee == ''){
				$service_fee = '-';
			}else{
				$service_fee = $record->service_fee ;
			}

			if($record->role == 'TSO'){
				$role = 'SDE';
			}else{
				$role= $record->role;
			}

			$data[] = array(
				"id" => $record->id,
				"auto_id" => $record->auto_id,
				"name" => $record->name,
				"ex_rssm_name" => $record->ex_rssm_name,
				"mobile_no" => $record->mobile_no,
				"alt_mobile_no" => $record->alt_mobile_no,
				"address" => $record->address,
				"state" => $record->rs_state,
				"division" => $record->rs_dist,
				"town" => $record->town,
				"resume" => $resume,
				"created_on" => $created_on,
				"city" => $record->rs_city,
				"town_code" => $record->rs_town_code ,


				"asm_status" => $asm_status,
				"score" => $score,
				"vso_score" => $vso_score,
				"created_by" => $record->created_by,
				"action" => $action,
				"bank_name" => $record->bank_name,
				"account_no" => $record->ac_number,
				"branch_name" => $record->branch_name,
				"ifsc_code" => $record->ifsc_s_number, 
				"account_type" => $record->ac_type ,

				"whatsapp_no" => $record->alt_mobile_no ,
				"experience" => $record->experience ,
				"education" => $record->education ,
				"age" => $record->age ,
				"terrain_knowledge" => $record->terrain_knowledge ,
				"tech_adoption" => $record->tech_adoption ,
				"family_bg" => $record->family_bg ,
				"sales_cat" => $record->sales_cat ,
				"sales_type" => $record->sales_type ,
				"ex_rssm_number" => $record->ex_rssm_number ,
				"branch_name" => $record->branch_name ,
				"bank_name" => $record->bank_name ,
				"ac_number" => $record->ac_number ,
				"ifsc_s_number" => $record->ifsc_s_number ,
				"aadhar" => $record->aadhar ,
				"pan" => $record->pan ,
				"region" => $record->region ,
				"rs_code" => $record->rs_code ,
				"rs_name" => $record->rs_name ,
				'asm_name'=>$record->asm,
				"dob" => $dob ,
				"doj" => $doj ,
				"father_name" => $record->father_name ,
				"email" => $record->rrf_email ,
				"service_fee" => $service_fee,
				"business_division" => $record->business,
				"sde" => $record->tso,
				"sde_mobile" => $record->tso_number,
				"asm_mobile" => $record->asm_number,
				"zsm" => $record->zsm,
				"zsm_mobile" => $record->zsm_number,
				"zsm_email" => $record->zsm_email,
				"asm_email" => $record->asm_email,
				"ssfa_id" => $record->ssfa_id,
				"emp_code" => $record->emp_code,
				"role"  => $role,
				"rstype"  => '',
				"fftype"  => '',


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


	function get_role_list_id($table,$select,$where,$group_by,$order_by){
		
		$this->db->select($select);
		$this->db->where($where);
		$this->db->order_by($order_by, 'asc');  // or desc
		$this->db->group_by($group_by);
		$records = $this->db->get($table);
		return $records->result();
		
	}


	function get_role_list_idd($table,$select,$where,$group_by){
		
		$this->db->select($select);
		$this->db->where_in($group_by,$where);
		$this->db->group_by($group_by);
		$records = $this->db->get($table);
		return $records->result();
		
	}

	public function get_rs_details($table,$where,$group_by,$order_by){
		$this->db->select('*');
		$this->db->from("rssm_recruitment_form as rrf");
		$this->db->join('masters as ma','rrf.created_by = ma.tso_number');
		$this->db->join('towns_details as td','rrf.town = td.town_name');
		$this->db->where($where);
		$records = $this->db->group_by('ma.tso_number')
		->get();
		return $records->result();
		
	}

	public function get_sde_name($table,$where,$group_by,$order_by){
		$this->db->select('*');
		$this->db->from('test')->join('masters as m', 'test.tso_mobile = m.tso_number');
		 $this->db->where($where);
		// $this->db->order_by($order_by, 'asc');  // or desc
		$this->db->group_by('m.tso_number');
		$records = $this->db->get();
		// print_r($records->result());die();
		// $records =
		return $records->result();
		
	}

	function insert_data($table, $data) {
		// echo '<pre>';print_r($data["form_id"]);die();
		// $form_id=$data["form_id"];
		$this->db->insert($table, $data);
		
	   return 'success';
	


}

// function verify_data($table,$where){
// 	$this->db->where($where);
// 	$records = $this->db->get($table);
// 	return $records->result();
// }

function get_add_details($table, $cond){
	$this->db->select('*');
	$this->db->from('rs_add_details as ad');
	$details = $this->db->where($cond)->join("rssm_recruitment_form as rrf",'rrf.auto_id = ad.rs_req_id')->join('masters as m','rrf.created_by = m.tso_number')->get();
	// print_r($details->result());die();
	return $details->result();
}

public function get_history($table,$where){
	$this->db->select('*');
	$this->db->from('service_fee_history as s_his');
	$this->db->join('sales_category as sc','sc.sales_category = s_his.sales_cat');
	$this->db->where($where);
	$records = $this->db->get();
	
	return $records->result();
	
}

function update_rs($table,$data,$cond){

	$this->db->set($data);
	$this->db->where($cond);
	$set = $this->db->update($table);
	return 'success';
}

public function updates($table, $data, $col, $id){
	$this->db->where($col, $id);
	$this->db->update($table, $data);
	$message = "success";
	return $message?true:false;
}
public function verify_data_get($table,$where){
	$this->db->select('rr.*,m.*,u.username as created_by_name,u.role_type as created_by_role');
	$this->db->from('rssm_recruitment_form as rr');
	$this->db->join('masters as m','m.tso_number = rr.created_by','left');
	$this->db->join('users as u', 'rr.created_by = u.mobile','left');
	$this->db->where($where);
	$records = $this->db->group_by('rr.auto_id')->get();
	// $records = $this->db
	// return $records->result();
	// print_r($records);die();
	// $records =
	return $records->result();
	
}


public function get_entered_forms($postData,$postData_where,$postData_where_id){
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
		state like '%" . $searchValue . "%' or 
		rrf.division like '%" . $searchValue . "%' or 
		town like '%" . $searchValue . "%' or 
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
	$this->db->from('rssm_recruitment_form rrf');
	$this->db->join('users as u', 'rrf.created_by = u.mobile');
	$this->db->join('masters as m', 'rrf.created_by = m.tso_number');
	$this->db->where($postData_where);
	if(count($postData_where_id) !=0){
		$this->db->where_in('rrf.created_by',$postData_where_id);
	}

	$records = $this->db->get()->result();


	$totalRecords = $records[0]->allcount;

	//# Total number of record with filtering
	$this->db->select('count(*) as allcount');
	$this->db->from('rssm_recruitment_form rrf');
	$this->db->join('users as u', 'rrf.created_by = u.mobile');
	$this->db->join('masters as m', 'rrf.created_by = m.tso_number');

	if(count($postData_where_id) !=0){
		$this->db->where_in('rrf.created_by',$postData_where_id);
	}
	$this->db->where($postData_where);
	
	if ($searchQuery != '') $this->db->where($searchQuery);
	$records = $this->db->get()->result();

	$totalRecordwithFilter = $records[0]->allcount;

	//# Fetch records
	$this->db->select('rrf.*,m.*,u.*,u.username as created_by , rrf.email as rrf_email');
	$this->db->from('rssm_recruitment_form rrf');
	$this->db->join('users as u', 'rrf.created_by = u.mobile');
	$this->db->join('masters as m', 'rrf.created_by = m.tso_number');
	$this->db->group_by('rrf.auto_id');
	if(count($postData_where_id) !=0){
		$this->db->where_in('rrf.created_by',$postData_where_id);
	}
	$this->db->where($postData_where);

	if ($searchQuery != '') $this->db->where($searchQuery);
	$this->db->order_by('updated_on', 'desc');  // or desc

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
			$resume = '';
		}

		$get_asm_status = $record->asm_status;
		if($get_asm_status =='Inprogress'){
			$asm_class = 'badge-warning';
		}elseif($get_asm_status =='Approved'){
			$asm_class = 'badge-success';
		}elseif($get_asm_status =='Future Prospect'){
			$asm_class = 'badge-danger';
		}else{
			$asm_class ='badge-primary';
		}

		$get_rssm_status = $record->rssm_status;
		if($get_rssm_status =='Rejected'){
			$rssm_content = 'Rejected';
			$rssm_class = 'badge-danger';
		}elseif($get_rssm_status =='Approved'){
			$rssm_content = 'Approved';
			$rssm_class = 'badge-success';
		}else{
			$rssm_content = 'Pending';
			$rssm_class ='badge-primary';
		}

		// if($record->rssm_remarks == ""){
		// 	$asm_status = '<b>ASM : </b><span class="badge '.$asm_class.'">'.$get_asm_status.'</span><br>
		// 	<b>RSSM : </b><span class="badge '.$rssm_class.'">'.$rssm_content.'</span>';
	
		// }else{
		// 	$asm_status = '<b>ASM : </b><span class="badge '.$asm_class.'">'.$get_asm_status.'</span><br>
		// 	<b>RSSM : </b><span class="badge '.$rssm_class.'">'.$rssm_content.'</span><br>
		// 	<b>RSSM Remarks: </b><span class="badge badge-danger">'.$record->rssm_remarks.'</span>';
	
		// }
		
		$asm_status = '<span class="badge '.$asm_class.'">'.$get_asm_status.'</span><br>';
		$rssm_status ='	<span class="badge '.$rssm_class.'">'.$rssm_content.'</span>';
		// $this->db->select('*');
		
		// if($record->add_status == 'Added'){
		$action = '<button onclick="view_adddetails('."'".$record->auto_id."'".');" class="btn  btn-sm btn-primary dt-btn-st" id="adtbtn"><i class="fa fa-eye"></i></button>';

		// }else{
		// 	$action = '<button onclick="get_adtdetails_pop('."'".$record->auto_id."'".');" class="btn  btn-sm btn-success dt-btn-st" id="adtbtn"><i class="bx bx-comment-dots"></i></button>';

		// }
		$score 	= 	$record->exp_point + $record->edu_point + $record->age_point + 
					$record->tk_point + $record->ta_point + $record->fb_point;

		// $action .= ' <button onclick="get_action_pop('."'".$record->auto_id."'".');" class="btn  btn-sm btn-danger dt-btn-st" id="actnbtn"><i class="bx bx-task"></i></button>';
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

		$date_of_joining = strtotime(date("Y-m-d", strtotime($record->doj)));
		$doj = date("d-m-Y", $date_of_joining);

		$date_of_birth = strtotime(date("Y-m-d", strtotime($record->dob)));
		$dob = date("d-m-Y", $date_of_birth);

		if($record->service_fee == ''){
			$service_fee = '-';
		}else{
			$service_fee = $record->service_fee ;
		}
		if($record->role == 'TSO'){
			$role = 'SDE';
		}else{
			$role= $record->role;
		}
		$data[] = array(
			"id" => $record->id,
			"auto_id" => $record->auto_id,
			"name" => $record->name,
			"ex_rssm_name" => $record->ex_rssm_name,
			"mobile_no" => $record->mobile_no,
			"alt_mobile_no" => $record->alt_mobile_no,
			"address" => $record->address,
			"state" => $record->rs_state,
			"division" => $record->rs_dist,
			"town" => $record->town,
			"resume" => $resume,
			"created_on" => $created_on,
			"city" => $record->rs_city,
			"town_code" => $record->rs_town_code ,


			// "va_status" => $va_status,
			"business_division" => $record->business,
			"asm_status" => $asm_status,
			"score" => $score,
			"vso_score" => $vso_score,
			"created_by" => $record->created_by,
			"action" => $action,
			"bank_name" => $record->bank_name,
			"account_no" => $record->ac_number,
			"branch_name" => $record->branch_name,
			"ifsc_code" => $record->ifsc_s_number, 
			"account_type" => $record->ac_type ,
			"whatsapp_no" => $record->alt_mobile_no ,
			"experience" => $record->experience ,
			"education" => $record->education ,
			"age" => $record->age ,
			"terrain_knowledge" => $record->terrain_knowledge ,
			"tech_adoption" => $record->tech_adoption ,
			"family_bg" => $record->family_bg ,
			"sales_cat" => $record->sales_cat ,
			"sales_type" => $record->sales_type ,
			"ex_rssm_number" => $record->ex_rssm_number ,
			"branch_name" => $record->branch_name ,
			"bank_name" => $record->bank_name ,
			"ac_number" => $record->ac_number ,
			"ifsc_s_number" => $record->ifsc_s_number ,
			"aadhar" => $record->aadhar ,
			"pan" => $record->pan ,
			"region" => $record->region ,
			"rs_code" => $record->rs_code ,
			"rs_name" => $record->rs_name ,
			'asm_name'=>$record->asm,
			"dob" => $dob ,
			"doj" => $doj ,
			"father_name" => $record->father_name ,
			"email" => $record->rrf_email ,
			"service_fee" => $service_fee,
			"rssm_status" => $rssm_status,

			"service_fee" => $service_fee,
			"business_division" => $record->business,
			"sde" => $record->tso,
			"sde_mobile" => $record->tso_number,
			"asm_mobile" => $record->asm_number,
			"zsm" => $record->zsm,
			"zsm_mobile" => $record->zsm_number,
			"zsm_email" => $record->zsm_email,
			"asm_email" => $record->asm_email,
			"ssfa_id" => $record->ssfa_id,
			"emp_code" => $record->emp_code,
			"role"  => $role,
			"rstype"  => '',
			"fftype"  => '',

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

function get_table_user_list_wc($table,$where,$group_by,$order_by){

	$this->db->where($where);
	$role = $this->session->userdata('role_type');
	// print_r($this->session->userdata('mobile'));
	if($role== "ZSM"){
		$this->db->where('zsm_number',$this->session->userdata('mobile'));
	}
	$this->db->order_by($order_by, 'asc');  // or desc
	$this->db->group_by($group_by);
	$records = $this->db->get($table);
	return $records->result();
	
}

function verify_data_wc($table_name,$order_by,$group_by){
		
	$this->db->order_by($order_by, 'asc');  // or desc
	$this->db->group_by($group_by);
	$records = $this->db->get($table_name);
	return $records->result();
}

function check_key_value($table,$svalue){

	$this->db->select('count(*) as allcount');
	$this->db->where($svalue);
	$records = $this->db->get($table);
	 // echo "<pre>";print_r($query);die;
	return $records->result();
}

function verify_data_ersforms($postData,$postData_where){
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
		c_sname like '%" . $searchValue . "%' or 
		c_gst_no like '%" . $searchValue . "%' or 
		c_altmobile_no like '%" . $searchValue . "%' or 
		c_address like '%" . $searchValue . "%' or 
		c_state like '%" . $searchValue . "%' or 
		c_division like '%" . $searchValue . "%' or 
		c_town like '%" . $searchValue . "%' or 
		c_age_of_org like '%" . $searchValue . "%' or 
		c_comp_handled like '%" . $searchValue . "%' or 
		c_retail_serviced like '%" . $searchValue . "%' or 
		c_godown like '%" . $searchValue . "%' or 
		c_computer like '%" . $searchValue . "%' or 
		c_printer like '%" . $searchValue . "%' or 
		c_internet like '%" . $searchValue . "%' or 
		c_delivery_vehicle like '%" . $searchValue . "%' or 
		c_fut_inverstment like '%" . $searchValue . "%' or 
		c_prop_invol like '%" . $searchValue . "%' or 
		c_market_fb like'%" . $searchValue . "%'  ) ";
	}

	if (count($search_arr) > 0) {
		$searchQuery = implode(" and ", $search_arr);
	}

	//# Total number of records without filtering
	$this->db->select('count(*) as allcount');
	$this->db->from('rs_recruitment_form');
	$this->db->where($postData_where);

	$records = $this->db->get()->result();

	$totalRecords = $records[0]->allcount;

	//# Total number of record with filtering
	$this->db->select('count(*) as allcount');
	$this->db->from('rs_recruitment_form');
	$this->db->where($postData_where);
	
	if ($searchQuery != '') $this->db->where($searchQuery);
	$records = $this->db->get()->result();

	$totalRecordwithFilter = $records[0]->allcount;

	//# Fetch records
	$this->db->select('*');
	$this->db->from('rs_recruitment_form');
	$this->db->where($postData_where);

	if ($searchQuery != '') $this->db->where($searchQuery);
	$this->db->order_by('id', 'desc');  // or desc

	$this->db->limit($rowperpage, $start);

	$records = $this->db->get()->result();

	$data = array();

	foreach ($records as $record) {
		$timedate1 = strtotime(date("Y-m-d", strtotime($record->created_on)));
		$created_on = date("d-m-Y", $timedate1);
		
		$action_url1 = base_url()."uploads/rsfunnel/".$record->c_resume;

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

		$score = $record->c_age_of_org_point + $record->c_comp_handled_point + $record->c_retail_serviced_point + 
		$record->c_godown_point + $record->c_computer_point + $record->c_printer_point + $record->c_internet_point + 
		$record->c_delivery_vehicle_point + $record->c_fut_inverstment_point + $record->c_prop_invol_point + $record->c_market_fb_point;

		// get vso score
		$this->db->select('*');
		$this->db->from('rs_recruitment_form_vso');
		$this->db->where('auto_id',$record->auto_id);
		$this->db->order_by('id', 'desc');  // or desc
			
		$records_vso = $this->db->get()->result();

		if(count($records_vso) !=0){

			$vso_score 	= $records_vso[0]->c_age_of_org_point + $records_vso[0]->c_comp_handled_point + $records_vso[0]->c_retail_serviced_point + 
			$records_vso[0]->c_godown_point + $records_vso[0]->c_computer_point + $records_vso[0]->c_printer_point + $records_vso[0]->c_internet_point + 
			$records_vso[0]->c_delivery_vehicle_point + $records_vso[0]->c_fut_inverstment_point + $records_vso[0]->c_prop_invol_point + $records_vso[0]->c_market_fb_point;
		}else{
			$vso_score = $score;
		}

		$data[] = array(
			"id" => $record->id,
			"auto_id" => $record->auto_id,
			"name" => $record->c_name,
			"ex_rs_name" => $record->c_ex_rs_name,
			"mobile_no" => $record->c_mobile_no,
			"alt_mobile_no" => $record->c_altmobile_no,
			"address" => $record->c_address,
			"c_sname" => $record->c_sname,
			"c_gst_no" => $record->c_gst_no,
			"state" => $record->c_state,
			"division" => $record->c_division,
			"town" => $record->c_town,
			"resume" => $resume,
			"created_on" => $created_on,
			"va_status" => $va_status,
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

function verify_data_frsforms($postData,$postData_where){
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
		c_sname like '%" . $searchValue . "%' or 
		c_gst_no like '%" . $searchValue . "%' or 
		c_altmobile_no like '%" . $searchValue . "%' or 
		c_address like '%" . $searchValue . "%' or 
		c_state like '%" . $searchValue . "%' or 
		c_division like '%" . $searchValue . "%' or 
		c_town like '%" . $searchValue . "%' or 
		c_age_of_org like '%" . $searchValue . "%' or 
		c_comp_handled like '%" . $searchValue . "%' or 
		c_retail_serviced like '%" . $searchValue . "%' or 
		c_godown like '%" . $searchValue . "%' or 
		c_computer like '%" . $searchValue . "%' or 
		c_printer like '%" . $searchValue . "%' or 
		c_internet like '%" . $searchValue . "%' or 
		c_delivery_vehicle like '%" . $searchValue . "%' or 
		c_fut_inverstment like '%" . $searchValue . "%' or 
		c_prop_invol like '%" . $searchValue . "%' or 
		c_market_fb like'%" . $searchValue . "%'  ) ";
	}

	if (count($search_arr) > 0) {
		$searchQuery = implode(" and ", $search_arr);
	}

	//# Total number of records without filtering
	$this->db->select('count(*) as allcount');
	$this->db->from('rs_recruitment_form');
	$this->db->where($postData_where);

	$records = $this->db->get()->result();

	$totalRecords = $records[0]->allcount;

	//# Total number of record with filtering
	$this->db->select('count(*) as allcount');
	$this->db->from('rs_recruitment_form');
	$this->db->where($postData_where);
	
	if ($searchQuery != '') $this->db->where($searchQuery);
	$records = $this->db->get()->result();

	$totalRecordwithFilter = $records[0]->allcount;

	//# Fetch records
	$this->db->select('*');
	$this->db->from('rs_recruitment_form');
	$this->db->where($postData_where);

	if ($searchQuery != '') $this->db->where($searchQuery);
	$this->db->order_by('id', 'desc');  // or desc

	$this->db->limit($rowperpage, $start);

	$records = $this->db->get()->result();

	$data = array();

	foreach ($records as $record) {
		$timedate1 = strtotime(date("Y-m-d", strtotime($record->created_on)));
		$created_on = date("d-m-Y", $timedate1);
		
		$action_url1 = base_url()."uploads/rsfunnel/".$record->c_resume;

		$action_url2 = base_url()."index.php/rsfunnel/RSController/edit_rs_rec_form/".$record->auto_id;

		if($record->c_resume !=''){
			$resume = '<img src="'.$action_url1.'" onclick="show_pop_img()" class="user-img" alt="">';

		}else{
			$resume = '';
		}
		$action = '<button onclick="get_adtdetails_pop('."'".$record->auto_id."'".');" class="btn  btn-sm btn-info dt-btn-st" id="adtbtn"><i class="bx bx-comment-dots"></i></button>';
		
		$action .= ' <a href="'.$action_url2.'" target="_blank"><button  class="btn ml-1 btn-sm btn-dark dt-btn-st" id="editBtn"><i class="bx bx-pencil"></i></button></a>';

		$score = $record->c_age_of_org_point + $record->c_comp_handled_point + $record->c_retail_serviced_point + 
		$record->c_godown_point + $record->c_computer_point + $record->c_printer_point + $record->c_internet_point + 
		$record->c_delivery_vehicle_point + $record->c_fut_inverstment_point + $record->c_prop_invol_point + $record->c_market_fb_point;

		$data[] = array(
			"id" => $record->id,
			"auto_id" => $record->auto_id,
			"name" => $record->c_name,
			"ex_rs_name" => $record->c_ex_rs_name,
			"mobile_no" => $record->c_mobile_no,
			"alt_mobile_no" => $record->c_altmobile_no,
			"address" => $record->c_address,
			"c_sname" => $record->c_sname,
			"c_gst_no" => $record->c_gst_no,
			"state" => $record->c_state,
			"division" => $record->c_division,
			"town" => $record->c_town,
			"resume" => $resume,
			"created_on" => $created_on,
			"score" => $score,
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

function verify_data_keyrsforms($postData,$postData_where){
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
	$this->db->from('rs_key_performance as a');
	$this->db->join('rs_keyperformance_name as kn','a.key_name=kn.id');
	$this->db->where('a.created_by',$postData_where);

	$records = $this->db->get()->result();

	$totalRecords = $records[0]->allcount;

	//# Total number of record with filtering
	$this->db->select('count(*) as allcount');
	$this->db->from('rs_key_performance as a');
	$this->db->join('rs_keyperformance_name as kn','a.key_name=kn.id');
	$this->db->where('a.created_by',$postData_where);
	
	if ($searchQuery != '') $this->db->where($searchQuery);
	$records = $this->db->get()->result();

	$totalRecordwithFilter = $records[0]->allcount;

	//# Fetch records
	$this->db->select('*');
	$this->db->from('rs_key_performance as a');
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

		$action_url2 = base_url()."index.php/rsfunnel/RSController/edit_rs_key_form/".$record->auto_id;

		// $resume = '<a href="'.$action_url1.'" title="Preview CV" target="_blank"><button type="button" class="btn btn-outline-primary btn-sm"><i class="bx bx-download"></i></button></a>';
		$action = '<button onclick="get_adtkeydetails_pop('."'".$record->auto_id."'".');" class="btn  btn-sm btn-info dt-btn-st" id="adtbtn"><i class="bx bx-comment-dots"></i></button>';
		
		$action .= ' <a http-equiv = "refresh" href="'.$action_url2.'" target="_blank"><button  class="btn  ml-1 btn-sm btn-dark dt-btn-st" id="editBtn"><i class="bx bx-pencil"></i></button></a>';

		$score 	= 	$record->key_stocks_point + $record->key_infra_point + $record->key_infra_delivery_point + $record->key_number_point + $record->key_order_point + $record->key_ffabsenteeism_point + $record->key_ffabsenteeism_actual_point + $record->key_npd_point + $record->key_infrastructure_point + $record->key_financials_point + $record->key_ssfa_point + $record->key_xdm_point + $record->key_issues_raised_point;


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
	$a=$postData['key_name'];
	$month = date('Y-m');
	// echo "<pre>";print_r($month);die;
	// $b=$postData['start_key_date'];
			$this->db->select('');
			$this->db->from('rs_key_performance as rp');
			$this->db->join('rs_keyperformance_name as nm', 'rp.key_name = nm.id');
			$this->db->where('rp.key_name',$a);
			$this->db->like('rp.start_key_date', $month);
			$this->db->order_by("rp.start_key_date", "asc");
			$records = $this->db->get()->result();
			// print_r($this->db->last_query());die;
			return $records;
}

	function get_table_user_list1($table,$group_by,$order_by){

		$this->db->order_by($order_by, 'asc');  // or desc
		$this->db->group_by($group_by);
		$records = $this->db->get($table);
		return $records->result();
		
	}
	public function get_asm_approved_forms_rssm($postData,$postData_where,$postData_where_id){
		$response = array();
        //# Read value
		$draw = $postData['draw'];
		$start = $postData['start'];
		$rowperpage = $postData['length']; // Rows display per page
		$columnIndex = $postData['order'][0]['column']; // Column index
		$columnName = $postData['columns'][$columnIndex]['data']; // Column name
		$columnSortOrder = $postData['order'][0]['dir']; // asc or desc
		$searchValue = $postData['search']['value']; // Search value
		// print_r($postData_where);die;
        
		//# Search
		$search_arr = array();
		$searchQuery = "";

		if ($searchValue != '') {
			$search_arr[] = " (name like '%" . $searchValue . "%' or 
			mobile_no like '%" . $searchValue . "%' or 
			alt_mobile_no like '%" . $searchValue . "%' or 
			address like '%" . $searchValue . "%' or 
			state like '%" . $searchValue . "%' or 
			rrf.division like '%" . $searchValue . "%' or 
			town like '%" . $searchValue . "%' or 
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
		// $this->db->select('count(*) as allcount');
		$this->db->select('rrf.*,m.*,u.*,u.username as created_by');
		$this->db->from('rssm_recruitment_form rrf');
		$this->db->join('users as u', 'rrf.created_by = u.mobile');
		$this->db->join('masters as m', 'rrf.created_by = m.tso_number');
		$this->db->where("(rrf.division_head_status = 'Approved' OR rrf.division_head_status IS NULL OR rrf.division_head_status = '')");
        $this->db->group_by('rrf.auto_id');
		if(count($postData_where_id) !=0){
			$this->db->where_in('rrf.created_by',$postData_where_id);
		}
		$this->db->where($postData_where);
		
		if ($searchQuery != '') $this->db->where($searchQuery);
		$records = $this->db->get()->result();
		// $sql = $this->db->last_query();
		// echo count($records);
		$totalRecords = count($records); // Default value if no records are found

			// if (!empty($records)) {
			// 	$totalRecords = $records[0]->allcount;
			// }

        //# Total number of record with filtering
		// $this->db->select('count(*) as allcount');
		$this->db->select('rrf.*,m.*,u.*,u.username as created_by');
        $this->db->from('rssm_recruitment_form rrf');
		$this->db->join('users as u', 'rrf.created_by = u.mobile');
		$this->db->join('masters as m', 'rrf.created_by = m.tso_number');
		$this->db->where("(rrf.division_head_status = 'Approved' OR rrf.division_head_status IS NULL OR rrf.division_head_status = '')");
        $this->db->group_by('rrf.auto_id');

		if(count($postData_where_id) !=0){
			$this->db->where_in('rrf.created_by',$postData_where_id);
		}
        $this->db->where($postData_where);
		
		if ($searchQuery != '') $this->db->where($searchQuery);
		$records = $this->db->get()->result();


		// $totalRecordwithFilter = $records[0]->allcount;
		$totalRecordwithFilter = count($records); // Default value if no records are found

		// if (!empty($records)) {
		// 	$totalRecordwithFilter = $records[0]->allcount;
		// }

        //# Fetch records
		$this->db->select('rrf.*,m.*,u.*,u.username as created_by, rrf.email as rrf_email');
		$this->db->from('rssm_recruitment_form rrf');
		$this->db->join('users as u', 'rrf.created_by = u.mobile');
		$this->db->join('masters as m', 'rrf.created_by = m.tso_number');
		$this->db->where("(rrf.division_head_status = 'Approved' OR rrf.division_head_status IS NULL OR rrf.division_head_status = '')");
        $this->db->group_by('rrf.auto_id');
		if(count($postData_where_id) !=0){
			$this->db->where_in('rrf.created_by',$postData_where_id);
		}
        $this->db->where($postData_where);

		if ($searchQuery != '') $this->db->where($searchQuery);
		$this->db->order_by('updated_on', 'desc');  // or desc

		$this->db->limit($rowperpage, $start);

		$records = $this->db->get()->result();


		$data = array();
		// echo "<pre>";print_r($records);
		foreach ($records as $record) {
			$timedate1 = strtotime(date("Y-m-d", strtotime($record->created_on)));
			$created_on = date("d-m-Y", $timedate1);
			
            $action_url1 = base_url()."uploads/sales/".$record->resume;

			if($record->resume !=''){
				$resume = '<a href="'.$action_url1.'" title="Preview CV" target="_blank"><button type="button" class="btn btn-outline-primary btn-sm"><i class="bx bx-download"></i></button></a>';

			}else{
				$resume = '';
			}

			$get_asm_status = $record->asm_status;
			if($get_asm_status =='Inprogress'){
				$asm_class = 'badge-warning';
			}elseif($get_asm_status =='Approved'){
				$asm_class = 'badge-success';
			}elseif($get_asm_status =='Future Prospect'){
				$asm_class = 'badge-danger';
			}else{
                $asm_class ='badge-primary';
            }

			$get_rssm_status = $record->rssm_status;
			if($get_rssm_status =='Rejected'){
				$rssm_content = 'Rejected';
				$rssm_class = 'badge-danger';
			}elseif($get_rssm_status =='Approved'){
				$rssm_content = 'Approved';
				$rssm_class = 'badge-success';
			}else{
				$rssm_content = 'Pending';
                $rssm_class ='badge-primary';
            }

			if($record->rssm_remarks == ""){
				$asm_status = '<b>ASM : </b><span class="badge '.$asm_class.'">'.$get_asm_status.'</span><br>
				<b>RSSM : </b><span class="badge '.$rssm_class.'">'.$rssm_content.'</span>';
		
			}else{
				$remark = $record->rssm_remarks;
				$rssm_remark= wordwrap($remark,80,"<br>\n");
				$asm_status = '<b>ASM : </b><span class="badge '.$asm_class.'">'.$get_asm_status.'</span><br>
				<b>RSSM : </b><span class="badge '.$rssm_class.'">'.$rssm_content.'</span><br>
				<span style="display:flex"><b>RSSM Remarks: </b><span class="badge badge-danger">'.$rssm_remark.'</span></span>';
		
			}
			


			// $this->db->select('*');
			
            // if($record->add_status == 'Added'){
			$action = '<button onclick="view_adddetails('."'".$record->auto_id."'".');" class="btn m-1 btn-sm btn-primary dt-btn-st" id="adtbtn"><i class="fa fa-eye"></i></button>';
			if($record->rssm_status == 'Approved' && $record->ssfa_id == '' ){
				$action .= '<button onclick="add_ssfa_id('."'".$record->auto_id."'".');" class="btn m-1 btn-sm btn-secondary dt-btn-st" id="adtbtn"><i class="fa fa-edit"></i></button>';
			}
			if($record->sales_type == 'New SalesMan'){
				$action .= '<button onclick="download_excel('."'".$record->auto_id."'".');" class="btn m-1 btn-sm btn-primary dt-btn-st" id="adtbtn"><i class="fa fa-download"></i></button>';
			// }else{
			// 	$action .= '<button  class="btn m-1 btn-sm btn-primary dt-btn-st" id="adtbtn"><i class="fa fa-download" disabled></i></button>';

			}

			// }else{

			// }
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

			$date_of_joining = strtotime(date("Y-m-d", strtotime($record->doj)));
			$doj = date("d-m-Y", $date_of_joining);

			$date_of_birth = strtotime(date("Y-m-d", strtotime($record->dob)));
			$dob = date("d-m-Y", $date_of_birth);

			if($record->service_fee == ''){
				$service_fee = '-';
			}else{
				$service_fee = $record->service_fee ;
			}

			if($record->role == 'TSO'){
				$role = 'SDE';
			}else{
				$role= $record->role;
			}

			$data[] = array(
				"id" => $record->id,
				"auto_id" => $record->auto_id,
				"name" => $record->name,
				"ex_rssm_name" => $record->ex_rssm_name,
				"mobile_no" => $record->mobile_no,
				"alt_mobile_no" => $record->alt_mobile_no,
				"address" => $record->address,
				"state" => $record->rs_state,
				"division" => $record->rs_dist,
				"town" => $record->town,
				"resume" => $resume,
				"created_on" => $created_on,
				"city" => $record->rs_city,
				"town_code" => $record->rs_town_code ,


				"asm_status" => $asm_status,
				"score" => $score,
				"vso_score" => $vso_score,
				"created_by" => $record->created_by,
				"action" => $action,
				"bank_name" => $record->bank_name,
				"account_no" => $record->ac_number,
				"branch_name" => $record->branch_name,
				"ifsc_code" => $record->ifsc_s_number, 
				"account_type" => $record->ac_type ,

				"whatsapp_no" => $record->alt_mobile_no ,
				"experience" => $record->experience ,
				"education" => $record->education ,
				"age" => $record->age ,
				"terrain_knowledge" => $record->terrain_knowledge ,
				"tech_adoption" => $record->tech_adoption ,
				"family_bg" => $record->family_bg ,
				"sales_cat" => $record->sales_cat ,
				"sales_type" => $record->sales_type ,
				"ex_rssm_number" => $record->ex_rssm_number ,
				"branch_name" => $record->branch_name ,
				"bank_name" => $record->bank_name ,
				"ac_number" => $record->ac_number ,
				"ifsc_s_number" => $record->ifsc_s_number ,
				"aadhar" => $record->aadhar ,
				"pan" => $record->pan ,
				"region" => $record->region ,
				"rs_code" => $record->rs_code ,
				"rs_name" => $record->rs_name ,
				'asm_name'=>$record->asm,
				"dob" => $dob ,
				"doj" => $doj ,
				"father_name" => $record->father_name ,
				"email" => $record->rrf_email ,
				"service_fee" => $service_fee,
				"business_division" => $record->business,
				"sde" => $record->tso,
				"sde_mobile" => $record->tso_number,
				"asm_mobile" => $record->asm_number,
				"zsm" => $record->zsm,
				"zsm_mobile" => $record->zsm_number,
				"zsm_email" => $record->zsm_email,
				"asm_email" => $record->asm_email,
				"ssfa_id" => $record->ssfa_id,
				"emp_code" => $record->emp_code,
				"role"  => $role,
				"rstype"  => '',
				"fftype"  => '',


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

	public function get_rssm_approved_forms_rssm($postData,$postData_where,$postData_where_id){
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
			state like '%" . $searchValue . "%' or 
			rrf.division like '%" . $searchValue . "%' or 
			town like '%" . $searchValue . "%' or 
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
		// $this->db->select('count(*) as allcount');
		$this->db->select('rrf.*,m.*,u.*,u.username as created_by');
		$this->db->from('rssm_recruitment_form rrf');
		$this->db->join('users as u', 'rrf.created_by = u.mobile','left');
		$this->db->where("rrf.rssm_status = 'Approved'");
		$this->db->where("(rrf.ssfa_id != '' OR rrf.emp_code IS NULL)");
		// $this->db->where("rrf.ssfa_id = ''");
		// $this->db->or_where("rrf.emp_code = null");
        $this->db->group_by('rrf.auto_id');

		$this->db->join('masters as m', 'rrf.created_by = m.tso_number','left');
        $this->db->where($postData_where);
		if(count($postData_where_id) !=0){
			$this->db->where_in('rrf.created_by',$postData_where_id);
		}

		$records = $this->db->get()->result();


		// $totalRecords = $records[0]->allcount;
		$totalRecords = count($records);

        //# Total number of record with filtering
		// $this->db->select('count(*) as allcount');
		$this->db->select('rrf.*,m.*,u.*,u.username as created_by');
        $this->db->from('rssm_recruitment_form rrf');
		$this->db->join('users as u', 'rrf.created_by = u.mobile','left');
		$this->db->where("(rrf.rssm_status = 'Approved')");
		$this->db->where("(rrf.ssfa_id != '' OR rrf.emp_code IS NULL)");
		$this->db->join('masters as m', 'rrf.created_by = m.tso_number','left');
        $this->db->group_by('rrf.auto_id');

		if(count($postData_where_id) !=0){
			$this->db->where_in('rrf.created_by',$postData_where_id);
		}
        $this->db->where($postData_where);
		
		if ($searchQuery != '') $this->db->where($searchQuery);
		$records = $this->db->get()->result();

		// $totalRecordwithFilter = $records[0]->allcount;
		$totalRecordwithFilter = count($records);

        //# Fetch records
		$this->db->select('rrf.*,m.*,u.*,u.username as created_by,u.mobile as createdBy_mobile, rrf.email as rrf_email');
		$this->db->from('rssm_recruitment_form rrf');
		$this->db->join('users as u', 'rrf.created_by = u.mobile','left');
		$this->db->join('masters as m', 'rrf.created_by = m.tso_number','left');
		// $this->db->where("(rrf.division_head_status = 'Approved' OR rrf.division_head_status IS NULL)");
		$this->db->where("(rrf.ssfa_id != '' OR rrf.emp_code IS NULL)");
		$this->db->where("(rrf.rssm_status = 'Approved')");

        $this->db->group_by('rrf.auto_id');
		if(count($postData_where_id) !=0){
			$this->db->where_in('rrf.created_by',$postData_where_id);
		}
        $this->db->where($postData_where);

		if ($searchQuery != '') $this->db->where($searchQuery);
		$this->db->order_by('updated_on', 'desc');  // or desc

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
				$resume = '';
			}

			$get_asm_status = $record->asm_status;
			if($get_asm_status =='Inprogress'){
				$asm_class = 'badge-warning';
			}elseif($get_asm_status =='Approved'){
				$asm_class = 'badge-success';
			}elseif($get_asm_status =='Future Prospect'){
				$asm_class = 'badge-danger';
			}else{
                $asm_class ='badge-primary';
            }

			$get_rssm_status = $record->rssm_status;
			if($get_rssm_status =='Rejected'){
				$rssm_content = 'Rejected';
				$rssm_class = 'badge-danger';
			}elseif($get_rssm_status =='Approved'){
				$rssm_content = 'Approved';
				$rssm_class = 'badge-success';
			}else{
				$rssm_content = 'Pending';
                $rssm_class ='badge-primary';
            }

			if($record->rssm_remarks == ""){
				$asm_status = '<b>ASM : </b><span class="badge '.$asm_class.'">'.$get_asm_status.'</span><br>
				<b>RSSM : </b><span class="badge '.$rssm_class.'">'.$rssm_content.'</span>';
		
			}else{
				$remark = $record->rssm_remarks;
				$rssm_remark= wordwrap($remark,80,"<br>\n");
				$asm_status = '<b>ASM : </b><span class="badge '.$asm_class.'">'.$get_asm_status.'</span><br>
				<b>RSSM : </b><span class="badge '.$rssm_class.'">'.$rssm_content.'</span><br>
				<span style="display:flex"><b>RSSM Remarks: </b><span class="badge badge-danger">'.$rssm_remark.'</span></span>';
		
			}
			
			$action = '<button onclick="view_adddetails('."'".$record->auto_id."'".');" class="btn m-1 btn-sm btn-primary dt-btn-st" id="adtbtn"><i class="fa fa-eye"></i></button>';
			// if( $record->rssm_status == 'Approved' && $record->ssfa_id == '' ){
			// 	$action .= '<button onclick="add_ssfa_id('."'".$record->auto_id."'".');" class="btn m-1 btn-sm btn-secondary dt-btn-st" id="adtbtn"><i class="fa fa-edit"></i></button>';
			// }
			if($record->sales_type == 'New SalesMan'){
				$action .= '<button onclick="download_excel('."'".$record->auto_id."'".');" class="btn m-1 btn-sm btn-primary dt-btn-st" id="adtbtn"><i class="fa fa-download"></i></button>';
			}

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

			$date_of_joining = strtotime(date("Y-m-d", strtotime($record->doj)));
			$doj = date("d-m-Y", $date_of_joining);

			$date_of_birth = strtotime(date("Y-m-d", strtotime($record->dob)));
			$dob = date("d-m-Y", $date_of_birth);

			if($record->service_fee == ''){
				$service_fee = '-';
			}else{
				$service_fee = $record->service_fee ;
			}

			if($record->role == 'TSO'){
				$role = 'SDE';
			}else{
				$role= $record->role;
			}

			$data[] = array(
				"id" => $record->id,
				"auto_id" => $record->auto_id,
				"name" => $record->name,
				"ex_rssm_name" => $record->ex_rssm_name,
				"mobile_no" => $record->mobile_no,
				"alt_mobile_no" => $record->alt_mobile_no,
				"address" => $record->address,
				"state" => $record->rs_state,
				"division" => $record->rs_dist,
				"town" => $record->town,
				"resume" => $resume,
				"created_on" => $created_on,
				"city" => $record->rs_city,
				"town_code" => $record->rs_town_code ,


				"asm_status" => $asm_status,
				"score" => $score,
				"vso_score" => $vso_score,
				"created_by" => $record->created_by,
				"action" => $action,
				"bank_name" => $record->bank_name,
				"account_no" => $record->ac_number,
				"branch_name" => $record->branch_name,
				"ifsc_code" => $record->ifsc_s_number, 
				"account_type" => $record->ac_type ,

				"whatsapp_no" => $record->alt_mobile_no ,
				"experience" => $record->experience ,
				"education" => $record->education ,
				"age" => $record->age ,
				"terrain_knowledge" => $record->terrain_knowledge ,
				"tech_adoption" => $record->tech_adoption ,
				"family_bg" => $record->family_bg ,
				"sales_cat" => $record->sales_cat ,
				"sales_type" => $record->sales_type ,
				"ex_rssm_number" => $record->ex_rssm_number ,
				"branch_name" => $record->branch_name ,
				"bank_name" => $record->bank_name ,
				"ac_number" => $record->ac_number ,
				"ifsc_s_number" => $record->ifsc_s_number ,
				"aadhar" => $record->aadhar ,
				"pan" => $record->pan ,
				"region" => $record->region ,
				"rs_code" => $record->rs_code ,
				"rs_name" => $record->rs_name ,
				'asm_name'=>$record->asm,
				"dob" => $dob ,
				"doj" => $doj ,
				"father_name" => $record->father_name ,
				"email" => $record->rrf_email ,
				"service_fee" => $service_fee,
				"business_division" => $record->business,
				"sde" => $record->tso,
				"sde_mobile" => $record->tso_number,
				"asm_mobile" => $record->asm_number,
				"zsm" => $record->zsm,
				"zsm_mobile" => $record->zsm_number,
				"zsm_email" => $record->zsm_email,
				"asm_email" => $record->asm_email,
				"ssfa_id" => $record->ssfa_id,
				"emp_code" => $record->emp_code,
				"role"  => $role,
				"rstype"  => '',
				"fftype"  => '',
				"createdBy_mobile" => $record->createdBy_mobile,


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


	public function get_qc_verification_data($postData,$postData_where,$postData_where_id){
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
			state like '%" . $searchValue . "%' or 
			rrf.division like '%" . $searchValue . "%' or 
			town like '%" . $searchValue . "%' or 
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
		$this->db->from('rssm_recruitment_form rrf');
		$this->db->join('users as u', 'rrf.created_by = u.mobile');
		$this->db->where("rrf.rssm_status = 'Approved'");
		$this->db->where("(rrf.ssfa_id != '' OR rrf.emp_code IS NULL)");
        $this->db->where($postData_where);
		if(count($postData_where_id) !=0){
			$this->db->where_in('rrf.created_by',$postData_where_id);
		}
		$records = $this->db->get()->result();
		$totalRecords = $records[0]->allcount;


        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
        $this->db->from('rssm_recruitment_form rrf');
		$this->db->join('users as u', 'rrf.created_by = u.mobile');
		$this->db->where("(rrf.rssm_status = 'Approved')");
		$this->db->where("(rrf.ssfa_id != '' OR rrf.emp_code IS NULL)");
		// $this->db->join('masters as m', 'rrf.created_by = m.tso_number');
		if(count($postData_where_id) !=0){
			$this->db->where_in('rrf.created_by',$postData_where_id);
		}
        $this->db->where($postData_where);
		
		if ($searchQuery != '') $this->db->where($searchQuery);
		$records = $this->db->get()->result();
		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select('rrf.*,u.*,u.username as created_by');
		$this->db->from('rssm_recruitment_form rrf');
		$this->db->join('users as u', 'rrf.created_by = u.mobile');
		// $this->db->join('masters as m', 'rrf.created_by = m.tso_number');
		// $this->db->where("(rrf.division_head_status = 'Approved' OR rrf.division_head_status IS NULL)");
		$this->db->where("(rrf.ssfa_id != '' OR rrf.emp_code IS NULL)");
		$this->db->where("(rrf.rssm_status = 'Approved')");

        $this->db->group_by('rrf.auto_id');
		if(count($postData_where_id) !=0){
			$this->db->where_in('rrf.created_by',$postData_where_id);
		}
        $this->db->where($postData_where);
		if ($searchQuery != '') $this->db->where($searchQuery);
		$this->db->order_by('updated_on', 'desc');  // or desc
		$this->db->limit($rowperpage, $start);
		$records = $this->db->get()->result();

		$data = array();

		foreach ($records as $record) {
			$timedate1 = strtotime(date("Y-m-d", strtotime($record->created_on)));
			$created_on = date("d-m-Y", $timedate1);
			
			$action = '<button onclick="view_adddetails('."'".$record->auto_id."'".');" class="btn m-1 btn-sm btn-primary dt-btn-st" id="adtbtn"><i class="fa fa-eye"></i></button>';
			
			// $date_of_joining = strtotime(date("Y-m-d", strtotime($record->doj)));
			// $doj = date("d-m-Y", $date_of_joining);

			// $date_of_birth = strtotime(date("Y-m-d", strtotime($record->dob)));
			// $dob = date("d-m-Y", $date_of_birth);

			$get_asm_status = $record->asm_status;
			if($get_asm_status =='Inprogress'){
				$asm_class = 'badge-warning';
			}elseif($get_asm_status =='Approved'){
				$asm_class = 'badge-success';
			}elseif($get_asm_status =='Future Prospect'){
				$asm_class = 'badge-danger';
			}else{
                $asm_class ='badge-primary';
            }

			$get_rssm_status = $record->rssm_status;
			if($get_rssm_status =='Rejected'){
				$rssm_content = 'Rejected';
				$rssm_class = 'badge-danger';
			}elseif($get_rssm_status =='Approved'){
				$rssm_content = 'Approved';
				$rssm_class = 'badge-success';
			}else{
				$rssm_content = 'Pending';
                $rssm_class ='badge-primary';
            }

			if($record->rssm_remarks == ""){
				$asm_status = '<b>ASM : </b><span class="badge '.$asm_class.'">'.$get_asm_status.'</span><br>
				<b>RSSM : </b><span class="badge '.$rssm_class.'">'.$rssm_content.'</span>';
		
			}else{
				$remark = $record->rssm_remarks;
				$rssm_remark= wordwrap($remark,80,"<br>\n");
				$asm_status = '<b>ASM : </b><span class="badge '.$asm_class.'">'.$get_asm_status.'</span><br>
				<b>RSSM : </b><span class="badge '.$rssm_class.'">'.$rssm_content.'</span><br>
				<span style="display:flex"><b>RSSM Remarks: </b><span class="badge badge-danger">'.$rssm_remark.'</span></span>';
		
			}


			$data[] = array(
				"id" => $record->id,
				// "auto_id" => $record->auto_id,
				// "business_division" => $record->business,
				// "location" => $record->town,
				// "state" => $record->rs_state,
				// "region" => $record->region ,
				"name" => $record->name,
				"mobile_no" => $record->mobile_no,
				"asm_status" => $asm_status,
				"created_on" => $created_on,
				// "dob" => $dob ,
				// "father_name" => $record->father_name ,
				// "doj" => $doj ,
				// "pan" => $record->pan ,
				// "aadhar" => $record->aadhar ,
				// "account_no" => $record->ac_number,
				// "ifsc_code" => $record->ifsc_s_number, 
				// "branch_name" => $record->branch_name,
				// "request_received_date" => $created_on,
				// "emp_id" => $record->emp_code,
				// "ssfa_id" => $record->ssfa_id,
				"action" => $action,

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
}



//upload fie mode ******