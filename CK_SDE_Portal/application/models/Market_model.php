<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Market_model extends CI_Model{

    
    public function verify_data_market_visit_report($postData,$postWhere,$type) {

		$response = array();

		//$show = $postData['status'];
		$draw = $postData['draw'];
		$start = $postData['start'];
		$rowperpage = $postData['length']; // Rows display per page
		$columnIndex = $postData['order'][0]['column']; // Column index
		$columnName = $postData['columns'][$columnIndex]['data']; // Column name
		$columnSortOrder = $postData['order'][0]['dir']; // asc or desc
		$searchValue = $postData['search']['value']; // Search value

		$from_date = $postData['from_date'];
		$created_by = $this->session->userdata('mobile');
		//# Search
		$search_arr = array();
		$searchQuery = "";

		if ($searchValue != '') {
			$search_arr[] = " (sde_market_visit_report.rssm_mkt like '%" . $searchValue . "%' or 
            sde_market_visit_report.beat_mkt like '%" . $searchValue . "%' or 
            sde_market_visit_report.rs_mkt like '%" . $searchValue . "%' or 
            sde_market_visit_report.feedback like '%" . $searchValue . "%' or 
            u.username like'%" . $searchValue . "%' ) ";
		}

		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

        //# Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('sde_market_visit_report');
		$this->db->join('users as u', 'sde_market_visit_report.created_by = u.mobile');
		if($type == 'where'){
			$this->db->where_in('sde_market_visit_report.created_by',$postWhere);
		}

		if($from_date!=="" ){
			$this->db->where('cast(sde_market_visit_report.created_on as Date) =' , $from_date);
        }

		$records = $this->db->get()->result();
		$totalRecords = $records[0]->allcount;
		
        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('sde_market_visit_report');
		$this->db->join('users as u', 'sde_market_visit_report.created_by = u.mobile');
		if($type == 'where'){
			$this->db->where_in('sde_market_visit_report.created_by',$postWhere);
		}

		if($from_date !=="" ){
			$this->db->where('cast(sde_market_visit_report.created_on as Date) =' , $from_date);
        }

		if ($searchQuery != '') $this->db->where($searchQuery);

		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select('sde_market_visit_report.*,u.username as username,u.business as business');
		$this->db->from('sde_market_visit_report');
		$this->db->join('users as u', 'sde_market_visit_report.created_by = u.mobile');
		if($type == 'where'){
			$this->db->where_in('sde_market_visit_report.created_by',$postWhere);
		}

		if($from_date !=="" ){
            $this->db->where('cast(sde_market_visit_report.created_on as Date) =' , $from_date);
        }

		if ($searchQuery != '') $this->db->where($searchQuery);
		$this->db->order_by('sde_market_visit_report.id', 'desc');  // or desc
		$this->db->limit($rowperpage, $start);
		$records = $this->db->get()->result();
		$data = array();

		foreach ($records as $record) {
			
			$timedate1 = strtotime(date("Y-m-d", strtotime($record->created_on)));
			$created_on = date("d-m-Y", $timedate1);
			
			if($record->rssm_eve_file !=''){
				$timedate2 = strtotime(date("Y-m-d", strtotime($record->updated_on)));
				$updated_on = date("d-m-Y", $timedate2);
			}else{
				$updated_on = '';
			}

			$sde_filename = '';
			if($record->image !=''){
				$get_sde_filename = explode(',',$record->image);
				$sde_filename .= '<div class="user-groups ml-auto">';
				foreach ($get_sde_filename as $key => $m_value) {
					$action_url1 = base_url()."uploads/sde_files/".$m_value;
					$sde_filename .= '<img src="'.$action_url1.'" width="35" height="35" class="rounded-circle" alt="" onclick="show_pop_img();">';
				}
				$sde_filename .= '</div>';
			}

			$rssm_morn_filename = '';
			if($record->rssm_morn_file !=''){
				$action_url1 = base_url()."uploads/rssm_files/".$record->rssm_morn_file;

				$rssm_morn_filename .= '<div class=" ml-auto">';
				$rssm_morn_filename .= '<img src="'.$action_url1.'" width="55" height="55" class="" alt="" onclick="show_pop_img();">';
				$rssm_morn_filename .= '</div>';
			}

			$rssm_eve_filename = '';
			if($record->rssm_eve_file !=''){
				$action_url2 = base_url()."uploads/rssm_eve_files/".$record->rssm_eve_file;

				$rssm_eve_filename .= '<div class=" ml-auto">';
				$rssm_eve_filename .= '<img src="'.$action_url2.'" width="55" height="55" class="" alt="" onclick="show_pop_img();">';
				$rssm_eve_filename .= '</div>';
			}
			
			if($record->rssm_mkt !=""){
				$query = $this->db->select('*')->where('mobile',$record->rssm_mkt)->get('users');
				if( $query->num_rows() > 0 ){
					$qq =  $query->result_array();
					$rssm_name = $qq[0]['username'];
				}else{
					$rssm_name = '';
				}
			}

			if($record->rs_mkt !=""){
				$qn = $this->db->select('*')->where('rs_code',$record->rs_mkt)->limit(1)->get('rs_mkt_master');
				if( $qn->num_rows() > 0 ){
					$qq =  $qn->result_array();
					$rs_name = $qq[0]['rs_name'];
				}else{
					$rs_name = '';
				}
			}
			
			$action = ' <button type="button" class="btn btn-light-success btn-sm m-1" id="history_'.$record->id.'" onclick="get_adtdetails_viewpop('."'".$record->id."'".');" ><i class="bx bx-edit"></i>
				</button>';

			$data[] = array(
				"id" => $record->id,
				"m_rssm" => $rssm_name,
				"m_beat" => $record->beat_mkt,
				"m_rs" => $rs_name,
				"total_calls_made" => $record->total_calls_made,
				"value" => $record->value,
				"billut" => $record->billut,
				"tlsd" => $record->tlsd,
				"m_feedback" => $record->feedback,
				"m_image" => $sde_filename,
				"rssm_morn_image" => $rssm_morn_filename,
				"rssm_eve_image" => $rssm_eve_filename,
				"created_on" => $created_on,
				"end_date" => $updated_on,
				"action" => $action,
				"created_by" => $record->username,

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
	
	public function get_sde_under_osm_count($table,$postWhere,$col){
		$this->db->select('*');
		$this->db->where_in($col,$postWhere);
		$this->db->group_by($col);
		$records = $this->db->get($table);
		$result = $records->num_rows();
		return $result;
	}
	

	public function get_osm_under_sde_details($postData,$postWhere) {
			// print_r($postWhere);die();
		
			
			$user_mobile = $this->session->userdata('mobile');
			$response = array();
	
			//$show = $postData['status'];
			$draw = $postData['draw'];
			$start = $postData['start'];
			$rowperpage = $postData['length']; // Rows display per page
			$columnIndex = $postData['order'][0]['column']; // Column index
			$columnName = $postData['columns'][$columnIndex]['data']; // Column name
			$columnSortOrder = $postData['order'][0]['dir']; // asc or desc
			$searchValue = $postData['search']['value']; // Search value
			
			$jc_type = $postData['jc_type'];
			$jc_year_filter = $postData['jc_type_year'];
			//# Search
			$search_arr = array();
			$searchQuery = "";
	
			if ($searchValue != '') {
				$search_arr[] = " ( u.username like'%" . $searchValue . "%' ) ";
			}
	
			if (count($search_arr) > 0) {
				$searchQuery = implode(" and ", $search_arr);
			}
	
			$jc_ss = array('JC10','JC11','JC12','JC01','JC02','JC03','JC04','JC05','JC06','JC07','JC08','JC09');
			$month_numeric_ = array('01','02','03','04','05','06','07','08','09','10','11','12');
			$get_jc_month = array_combine($jc_ss,$month_numeric_);

		if(count($postWhere) != 0){
	
	
			//# Total number of records without filtering
			$this->db->select('count(*) as allcount');
			$this->db->from('sde_market_visit_report');
			$this->db->join('users as u', 'sde_market_visit_report.created_by = u.mobile');
			// $this->db->join('osm_performance ', 'sde_market_visit_report.created_by = osm_performance.ssfa_id');
			$this->db->where_in('sde_market_visit_report.created_by',$postWhere);
			// $this->db->group_by('sde_market_visit_report.created_by');
			if($jc_year_filter !=""){
				$previous_year_ 	= substr($jc_year_filter, 0, 4);
				$jc_year__ 			= substr($jc_year_filter, -2);
				$sencu_year_ 	= substr($jc_year_filter, 0, 2);
	
				$get_nxt_year = $previous_year_+1;
				$this->db->where('sde_market_visit_report.created_on >=', $previous_year_.'-04-01');
				$this->db->where('sde_market_visit_report.created_on <=', $get_nxt_year.'-03-31');
	
				// $this->db->where('MONTH(sde_market_visit_report.created_on)',$jc_year_filter);
				// $this->db->where('YEAR(sde_market_visit_report.created_on)',$jc_year_filter);
			}else{

				$date=date_create(date('Y-m-d'));
				if (date_format($date,"m") >= 4) {
					// $financial_year = (date_format($date,"Y")) . '-' . (date_format($date,"y")+1);
					$financial_year_m = date_format($date,"Y");
					$financial_year_p = date_format($date,"Y")+1;
				} else {
					// $financial_year = (date_format($date,"Y")-1) . '-' . date_format($date,"y");
					$financial_year_m = date_format($date,"Y")-1;
					$financial_year_p = date_format($date,"Y");
				}
				$this->db->where('sde_market_visit_report.created_on >=', $financial_year_m.'-04-01');
				$this->db->where('sde_market_visit_report.created_on <=', $financial_year_p.'-03-31');
	
				// $year = date('Y');
				// $this->db->where('YEAR(sde_market_visit_report.created_on)',$year);
			}
			// print_r($jc_type);
			// print_r($get_jc_month[$jc_type]);die;
	
			if($jc_type != ""){
				$this->db->where('MONTH(sde_market_visit_report.created_on)', $get_jc_month[$jc_type]);
			}else{
				$month = date('m');
				$this->db->where('MONTH(sde_market_visit_report.created_on)',$month);
			}
			print_r($this->db->last_query()); die;
	
			$records = $this->db->get()->result();


			$totalRecords = $records[0]->allcount;
	
			// $records = $this->db->get();
			// $totalRecords = $records->num_rows();
			
			//# Total number of record with filtering
			$this->db->select('count(*) as allcount');
			$this->db->from('sde_market_visit_report');
			$this->db->join('users as u', 'sde_market_visit_report.created_by = u.mobile');
			$this->db->where_in('sde_market_visit_report.created_by',$postWhere);
			// $this->db->group_by('sde_market_visit_report.created_by');

			if($jc_year_filter !=""){
				$previous_year_ 	= substr($jc_year_filter, 0, 4);
				$jc_year__ 			= substr($jc_year_filter, -2);
				$sencu_year_ 	= substr($jc_year_filter, 0, 2);
	
				$get_nxt_year = $previous_year_+1;
				$this->db->where('sde_market_visit_report.created_on >=', $previous_year_.'-04-01');
				$this->db->where('sde_market_visit_report.created_on <=', $get_nxt_year.'-03-31');
	
				// $this->db->where('MONTH(sde_market_visit_report.created_on)',$jc_year_filter);
				// $this->db->where('YEAR(sde_market_visit_report.created_on)',$jc_year_filter);
			}else{
				$date=date_create(date('Y-m-d'));
				if (date_format($date,"m") >= 4) {
					// $financial_year = (date_format($date,"Y")) . '-' . (date_format($date,"y")+1);
					$financial_year_m = date_format($date,"Y");
					$financial_year_p = date_format($date,"Y")+1;
				} else {
					// $financial_year = (date_format($date,"Y")-1) . '-' . date_format($date,"y");
					$financial_year_m = date_format($date,"Y")-1;
					$financial_year_p = date_format($date,"Y");
				}
				$this->db->where('sde_market_visit_report.created_on >=', $financial_year_m.'-04-01');
				$this->db->where('sde_market_visit_report.created_on <=', $financial_year_p.'-03-31');
			
	
				// $year = date('Y');
				// $this->db->where('YEAR(sde_market_visit_report.created_on)',$year);
			}
	
			if($jc_type != ""){
				$this->db->where('MONTH(sde_market_visit_report.created_on)',$get_jc_month[$jc_type]);
			}else{
				$month = date('m');
				$this->db->where('MONTH(sde_market_visit_report.created_on)',$month);
			}
	
			if ($searchQuery != '') $this->db->where($searchQuery);
			$records = $this->db->get()->result();
			$totalRecordwithFilter = $records[0]->allcount;
	
			// $records = $this->db->get();
			// $totalRecordwithFilter = $records->num_rows();
	
			//# Fetch records
			$this->db->select('sde_market_visit_report.*,u.username as username');
			$this->db->from('sde_market_visit_report');
			$this->db->join('users as u', 'sde_market_visit_report.created_by = u.mobile');
			$this->db->where_in('sde_market_visit_report.created_by',$postWhere);
			// $this->db->group_by('sde_market_visit_report.created_by');
			
			if($jc_year_filter !=""){
				$previous_year_ 	= substr($jc_year_filter, 0, 4);
				$jc_year__ 			= substr($jc_year_filter, -2);
				$sencu_year_ 	= substr($jc_year_filter, 0, 2);
	
				$get_nxt_year = $previous_year_+1;
				$this->db->where('sde_market_visit_report.created_on >=', $previous_year_.'-04-01');
				$this->db->where('sde_market_visit_report.created_on <=', $get_nxt_year.'-03-31');
	
				// $this->db->where('MONTH(sde_market_visit_report.created_on)',$jc_year_filter);
				// $this->db->where('YEAR(sde_market_visit_report.created_on)',$jc_year_filter);
			}else{
				$date=date_create(date('Y-m-d'));
				if (date_format($date,"m") >= 4) {
					// $financial_year = (date_format($date,"Y")) . '-' . (date_format($date,"y")+1);
					$financial_year_m = date_format($date,"Y");
					$financial_year_p = date_format($date,"Y")+1;
				} else {
					// $financial_year = (date_format($date,"Y")-1) . '-' . date_format($date,"y");
					$financial_year_m = date_format($date,"Y")-1;
					$financial_year_p = date_format($date,"Y");
				}
				$this->db->where('sde_market_visit_report.created_on >=', $financial_year_m.'-04-01');
				$this->db->where('sde_market_visit_report.created_on <=', $financial_year_p.'-03-31');
			
	
				// $year = date('Y');
				// $this->db->where('YEAR(sde_market_visit_report.created_on)',$year);
			}
	
			if($jc_type != ""){
				$this->db->where('MONTH(sde_market_visit_report.created_on)',$get_jc_month[$jc_type]);
			}else{
				$month = date('m');
				$this->db->where('MONTH(sde_market_visit_report.created_on)',$month);
			}
			if ($searchQuery != '') $this->db->where($searchQuery);
	
			$this->db->order_by('sde_market_visit_report.id', 'desc');  // or desc
			$this->db->limit($rowperpage, $start);
			$records = $this->db->get()->result();
	
			// print_r($records);
			// exit;
	
			$data = array();
	
			foreach ($records as $record) {
	
				// april to march 
				$month_numeric = array('01','02','03','04','05','06','07','08','09','10','11','12');
				$jc_s = array('JC10','JC11','JC12','JC01','JC02','JC03','JC04','JC05','JC06','JC07','JC08','JC09');
				$get_jc = array_combine($month_numeric,$jc_s);
	
				if($jc_year_filter !=""){
					if($jc_type != ""){
						$jc = $jc_type;
					}
				}else{
					$cur_month = date('m');
					$jc = $get_jc[$cur_month];
				}
				$count = $this->db->select('*')->where('created_by',$record->created_by)->get('sde_market_visit_report')->num_rows();
	
	
				$edit_url= base_url()."index.php/SdeMarket/view_more/".$record->created_by;
				$action = '<a class="btn btn-light-info btn-sm m-1" title="Edit" target="_blank" href='.$edit_url.'>
								<i class="bx bx-show"></i>
							</a>';
	
				// $action = ' <button type="button" target="_blank" class="btn btn-light-info btn-sm m-1" id="history_'.$record->id.'" onclick="get_adtdetails_viewpop('."'".$record->id."'".');" ><i class="bx bx-show"></i>
				// 	</button>';
	
				$data[] = array(
					"id" => $record->id,
					"osm" => $record->username,
					"jc" => $jc,
					"count" => $count,
					"action" => $action,
				);
			}
			//# Response
			$response = array(
				"draw" => intval($draw),
				"iTotalRecords" => $totalRecords,
				"iTotalDisplayRecords" => $totalRecordwithFilter,
				"aaData" => $data
			);
	
			
		} else{
			$response = array(
				"draw" => $draw,
				"iTotalRecords" => 0,
				"iTotalDisplayRecords" => 0,
				"aaData" => []
			);
		}
	
		return $response;
	// 	$user_mobile = $this->session->userdata('mobile');
	// 	$response = array();

	// 	//$show = $postData['status'];
	// 	$draw = $postData['draw'];
	// 	$start = $postData['start'];
	// 	$rowperpage = $postData['length']; // Rows display per page
	// 	$columnIndex = $postData['order'][0]['column']; // Column index
	// 	$columnName = $postData['columns'][$columnIndex]['data']; // Column name
	// 	$columnSortOrder = $postData['order'][0]['dir']; // asc or desc
	// 	$searchValue = $postData['search']['value']; // Search value
		
	// 	$jc_type = $postData['jc_type'];
	// 	$jc_year_filter = $postData['jc_type_year'];
	// 	//# Search
	// 	$search_arr = array();
	// 	$searchQuery = "";

	// 	if ($searchValue != '') {
	// 		$search_arr[] = " ( u.username like'%" . $searchValue . "%' ) ";
	// 	}

	// 	if (count($search_arr) > 0) {
	// 		$searchQuery = implode(" and ", $search_arr);
	// 	}

	// 	$jc_ss = array('JC10','JC11','JC12','JC01','JC02','JC03','JC04','JC05','JC06','JC07','JC08','JC09');
	// 	$month_numeric_ = array('01','02','03','04','05','06','07','08','09','10','11','12');
	// 	$get_jc_month = array_combine($jc_ss,$month_numeric_);


    //     //# Total number of records without filtering
	// 	$this->db->select('count(*) as allcount');
	// 	$this->db->from('sde_market_visit_report');
	// 	$this->db->join('users as u', 'sde_market_visit_report.created_by = u.mobile');
	// 	// $this->db->join('osm_performance ', 'sde_market_visit_report.created_by = osm_performance.ssfa_id');
	// 	$this->db->where_in('sde_market_visit_report.created_by',$postWhere);
	// 	// $this->db->group_by('sde_market_visit_report.created_by');
		
	// 	if($jc_year_filter !=""){
	// 		$previous_year_ 	= substr($jc_year_filter, 0, 4);
	// 		$jc_year__ 			= substr($jc_year_filter, -2);
	// 		$sencu_year_ 	= substr($jc_year_filter, 0, 2);

	// 		$get_nxt_year = $previous_year_+1;
	// 		$this->db->where('sde_market_visit_report.created_on >=', $previous_year_.'-04-01');
	// 		$this->db->where('sde_market_visit_report.created_on <=', $get_nxt_year.'-03-31');

	// 		// $this->db->where('MONTH(sde_market_visit_report.created_on)',$jc_year_filter);
	// 		// $this->db->where('YEAR(sde_market_visit_report.created_on)',$jc_year_filter);
	// 	}else{
	// 		$date=date_create(date('Y-m-d'));
	// 		if (date_format($date,"m") >= 4) {
	// 			// $financial_year = (date_format($date,"Y")) . '-' . (date_format($date,"y")+1);
	// 			$financial_year_m = date_format($date,"Y");
	// 			$financial_year_p = date_format($date,"Y")+1;
	// 		} else {
	// 			// $financial_year = (date_format($date,"Y")-1) . '-' . date_format($date,"y");
	// 			$financial_year_m = date_format($date,"Y")-1;
	// 			$financial_year_p = date_format($date,"Y");
	// 		}
	// 		$this->db->where('sde_market_visit_report.created_on >=', $financial_year_m.'-04-01');
	// 		$this->db->where('sde_market_visit_report.created_on <=', $financial_year_p.'-03-31');

	// 		// $year = date('Y');
	// 		// $this->db->where('YEAR(sde_market_visit_report.created_on)',$year);
	// 	}

	// 	if($jc_type != ""){
	// 		$this->db->where('MONTH(sde_market_visit_report.created_on)',$get_jc_month[$jc_type]);
	// 	}else{
	// 		$month = date('m');
	// 		$this->db->where('MONTH(sde_market_visit_report.created_on)',$month);
	// 	}

	// 	$records = $this->db->get()->result();
	// 	$totalRecords = $records[0]->allcount;

	// 	// $records = $this->db->get();
	// 	// $totalRecords = $records->num_rows();
		
    //     //# Total number of record with filtering
	// 	$this->db->select('count(*) as allcount');
	// 	$this->db->from('sde_market_visit_report');
	// 	$this->db->join('users as u', 'sde_market_visit_report.created_by = u.mobile');
	// 	$this->db->where_in('sde_market_visit_report.created_by',$postWhere);
	// 	// $this->db->group_by('sde_market_visit_report.created_by');

	// 	if($jc_year_filter !=""){
	// 		$previous_year_ 	= substr($jc_year_filter, 0, 4);
	// 		$jc_year__ 			= substr($jc_year_filter, -2);
	// 		$sencu_year_ 	= substr($jc_year_filter, 0, 2);

	// 		$get_nxt_year = $previous_year_+1;
	// 		$this->db->where('sde_market_visit_report.created_on >=', $previous_year_.'-04-01');
	// 		$this->db->where('sde_market_visit_report.created_on <=', $get_nxt_year.'-03-31');

	// 		// $this->db->where('MONTH(sde_market_visit_report.created_on)',$jc_year_filter);
	// 		// $this->db->where('YEAR(sde_market_visit_report.created_on)',$jc_year_filter);
	// 	}else{
	// 		$date=date_create(date('Y-m-d'));
	// 		if (date_format($date,"m") >= 4) {
	// 			// $financial_year = (date_format($date,"Y")) . '-' . (date_format($date,"y")+1);
	// 			$financial_year_m = date_format($date,"Y");
	// 			$financial_year_p = date_format($date,"Y")+1;
	// 		} else {
	// 			// $financial_year = (date_format($date,"Y")-1) . '-' . date_format($date,"y");
	// 			$financial_year_m = date_format($date,"Y")-1;
	// 			$financial_year_p = date_format($date,"Y");
	// 		}
	// 		$this->db->where('sde_market_visit_report.created_on >=', $financial_year_m.'-04-01');
	// 		$this->db->where('sde_market_visit_report.created_on <=', $financial_year_p.'-03-31');
		

	// 		// $year = date('Y');
	// 		// $this->db->where('YEAR(sde_market_visit_report.created_on)',$year);
	// 	}

	// 	if($jc_type != ""){
	// 		$this->db->where('MONTH(sde_market_visit_report.created_on)',$get_jc_month[$jc_type]);
	// 	}else{
	// 		$month = date('m');
	// 		$this->db->where('MONTH(sde_market_visit_report.created_on)',$month);
	// 	}

	// 	if ($searchQuery != '') $this->db->where($searchQuery);
	// 	$records = $this->db->get()->result();
	// 	$totalRecordwithFilter = $records[0]->allcount;

	// 	// $records = $this->db->get();
	// 	// $totalRecordwithFilter = $records->num_rows();

    //     //# Fetch records
	// 	$this->db->select('sde_market_visit_report.*,u.username as username');
	// 	$this->db->from('sde_market_visit_report');
	// 	$this->db->join('users as u', 'sde_market_visit_report.created_by = u.mobile');
	// 	$this->db->where_in('sde_market_visit_report.created_by',$postWhere);
	// 	// $this->db->group_by('sde_market_visit_report.created_by');
		
	// 	if($jc_year_filter !=""){
	// 		$previous_year_ 	= substr($jc_year_filter, 0, 4);
	// 		$jc_year__ 			= substr($jc_year_filter, -2);
	// 		$sencu_year_ 	= substr($jc_year_filter, 0, 2);

	// 		$get_nxt_year = $previous_year_+1;
	// 		$this->db->where('sde_market_visit_report.created_on >=', $previous_year_.'-04-01');
	// 		$this->db->where('sde_market_visit_report.created_on <=', $get_nxt_year.'-03-31');

	// 		// $this->db->where('MONTH(sde_market_visit_report.created_on)',$jc_year_filter);
	// 		// $this->db->where('YEAR(sde_market_visit_report.created_on)',$jc_year_filter);
	// 	}else{
	// 		$date=date_create(date('Y-m-d'));
	// 		if (date_format($date,"m") >= 4) {
	// 			// $financial_year = (date_format($date,"Y")) . '-' . (date_format($date,"y")+1);
	// 			$financial_year_m = date_format($date,"Y");
	// 			$financial_year_p = date_format($date,"Y")+1;
	// 		} else {
	// 			// $financial_year = (date_format($date,"Y")-1) . '-' . date_format($date,"y");
	// 			$financial_year_m = date_format($date,"Y")-1;
	// 			$financial_year_p = date_format($date,"Y");
	// 		}
	// 		$this->db->where('sde_market_visit_report.created_on >=', $financial_year_m.'-04-01');
	// 		$this->db->where('sde_market_visit_report.created_on <=', $financial_year_p.'-03-31');
		

	// 		// $year = date('Y');
	// 		// $this->db->where('YEAR(sde_market_visit_report.created_on)',$year);
	// 	}

	// 	if($jc_type != ""){
	// 		$this->db->where('MONTH(sde_market_visit_report.created_on)',$get_jc_month[$jc_type]);
	// 	}else{
	// 		$month = date('m');
	// 		$this->db->where('MONTH(sde_market_visit_report.created_on)',$month);
	// 	}
	// 	if ($searchQuery != '') $this->db->where($searchQuery);

	// 	$this->db->order_by('sde_market_visit_report.id', 'desc');  // or desc
	// 	$this->db->limit($rowperpage, $start);
	// 	$records = $this->db->get()->result();

	// 	// print_r($records);
	// 	// exit;

	// 	$data = array();

	// 	foreach ($records as $record) {

	// 		// april to march 
	// 		$month_numeric = array('01','02','03','04','05','06','07','08','09','10','11','12');
	// 		$jc_s = array('JC10','JC11','JC12','JC01','JC02','JC03','JC04','JC05','JC06','JC07','JC08','JC09');
	// 		$get_jc = array_combine($month_numeric,$jc_s);

	// 		if($jc_year_filter !=""){
	// 			if($jc_type != ""){
	// 				$jc = $jc_type;
	// 			}
	// 		}else{
	// 			$cur_month = date('m');
	// 			$jc = $get_jc[$cur_month];
	// 		}
	// 		$count = $this->db->select('*')->where('created_by',$record->created_by)->get('sde_market_visit_report')->num_rows();


	// 		$edit_url= base_url()."index.php/SdeMarket/view_more/".$record->created_by;
    //         $action = '<a class="btn btn-light-info btn-sm m-1" title="Edit" target="_blank" href='.$edit_url.'>
    //                         <i class="bx bx-show"></i>
    //                     </a>';

	// 		// $action = ' <button type="button" target="_blank" class="btn btn-light-info btn-sm m-1" id="history_'.$record->id.'" onclick="get_adtdetails_viewpop('."'".$record->id."'".');" ><i class="bx bx-show"></i>
	// 		// 	</button>';

	// 		$data[] = array(
	// 			"id" => $record->id,
	// 			"osm" => $record->username,
	// 			"jc" => $jc,
	// 			"count" => $count,
	// 			"action" => $action,
	// 		);
	// 	}
    //     //# Response
	// 	$response = array(
	// 		"draw" => intval($draw),
	// 		"iTotalRecords" => $totalRecords,
	// 		"iTotalDisplayRecords" => $totalRecordwithFilter,
	// 		"aaData" => $data
	// 	);

	// 	return $response;
	} 


	public function get_particular_osm_mv_report($table,$col,$mobile)
	{
		$this->db->select($table.'.*,users.username as rssm_name, rs_mkt_master.rs_name');
		$this->db->join('users', 'sde_market_visit_report.rssm_mkt = users.mobile');
		$this->db->join('rs_mkt_master', 'sde_market_visit_report.rs_mkt = rs_mkt_master.rs_code');
		$this->db->where($col,$mobile);
		$this->db->limit(1);
		$records = $this->db->get($table);
		return $records->result_array();

		// $this->db->select($table.'.*,rssm_master.rssm_name as rssm_name');
		// $this->db->join('rssm_mkt_master_copy as rssm_master', 'sde_market_visit_report.rssm_mkt = rssm_master.rssm_id');
		// $this->db->where($table.'.'.$col,$mobile);
		// $records = $this->db->get($table);
		// return $records->result_array();
	}

	
	public function get_sde_under_osm__($table,$postWhere,$col){

		$data = $this->db->select('*')->order_by('id', 'desc')->limit(1)->get($table)->row();

		$this->db->select('*');
		$this->db->where('jc_type', $data->jc_type);
		$this->db->where_in($col,$postWhere);
		$records = $this->db->get($table);
		return $records->result_array();
	}




	public function get_osm_mv_report($postData,$mobil) {
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
			$search_arr[] = " (sde_market_visit_report.rssm_mkt like '%" . $searchValue . "%' or 
			sde_market_visit_report.beat_mkt like '%" . $searchValue . "%' or 
			sde_market_visit_report.rs_mkt like '%" . $searchValue . "%' or
			u.username like'%" . $searchValue . "%' ) ";
		}

		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

		//# Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('sde_market_visit_report');
		$this->db->join('users as u', 'sde_market_visit_report.created_by = u.mobile');
		$this->db->where('sde_market_visit_report.created_by', $mobil);

		$records = $this->db->get()->result();
		$totalRecords = $records[0]->allcount;
		
		//# Total number of record with filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('sde_market_visit_report');
		$this->db->join('users as u', 'sde_market_visit_report.created_by = u.mobile');
		$this->db->where('sde_market_visit_report.created_by', $mobil);

		if ($searchQuery != '') $this->db->where($searchQuery);

		$records = $this->db->get()->result();
		$totalRecordwithFilter = $records[0]->allcount;

		//# Fetch records
		$this->db->select('sde_market_visit_report.*');
		$this->db->from('sde_market_visit_report');
		$this->db->join('users as u', 'sde_market_visit_report.created_by = u.mobile');
		$this->db->where('sde_market_visit_report.created_by', $mobil);

		if ($searchQuery != '') $this->db->where($searchQuery);
		$this->db->limit($rowperpage, $start);
		$records = $this->db->get()->result();
		$data = array();

		foreach ($records as $record) {
			
			$timedate1 = strtotime(date("Y-m-d", strtotime($record->created_on)));
			$created_on = date("d-m-Y", $timedate1);
			
			if($record->rssm_eve_file !=''){
				$timedate2 = strtotime(date("Y-m-d", strtotime($record->updated_on)));
				$updated_on = date("d-m-Y", $timedate2);
			}else{
				$updated_on = '';
			}

			$rssm_morn_filename = '';
			if($record->rssm_morn_file !=''){
				$action_url1 = base_url()."uploads/rssm_files/".$record->rssm_morn_file;

				$rssm_morn_filename .= '<div class=" ml-auto">';
				$rssm_morn_filename .= '<img src="'.$action_url1.'" width="55" height="55" class="" alt="" onclick="show_pop_img();">';
				$rssm_morn_filename .= '</div>';
			}

			$rssm_eve_filename = '';
			if($record->rssm_eve_file !=''){
				$action_url2 = base_url()."uploads/rssm_eve_files/".$record->rssm_eve_file;

				$rssm_eve_filename .= '<div class=" ml-auto">';
				$rssm_eve_filename .= '<img src="'.$action_url2.'" width="55" height="55" class="" alt="" onclick="show_pop_img();">';
				$rssm_eve_filename .= '</div>';
			}
			
			if($record->rssm_mkt !=""){
				$query = $this->db->select('*')->where('mobile',$record->rssm_mkt)->get('users');
				if( $query->num_rows() > 0 ){
					$qq =  $query->result_array();
					$rssm_name = $qq[0]['username'];
				}else{
					$rssm_name = '';
				}
			}

			if($record->rs_mkt !=""){
				$qn = $this->db->select('*')->where('rs_code',$record->rs_mkt)->limit(1)->get('rs_mkt_master');
				if( $qn->num_rows() > 0 ){
					$qq =  $qn->result_array();
					$rs_name = $qq[0]['rs_name'];
				}else{
					$rs_name = '';
				}
			}

			$data[] = array(
				"m_rssm" => $rssm_name,
				"m_beat" => $record->beat_mkt,
				"m_rs" => $rs_name,
				"total_calls_made" => $record->total_calls_made,
				"value" => $record->value,
				"billut" => $record->billut,
				"tlsd" => $record->tlsd,
				"rssm_morn_image" => $rssm_morn_filename,
				"rssm_eve_image" => $rssm_eve_filename,
				"created_date" => $created_on,
				"updated_date" => $updated_on,

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
