<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Competition_model extends CI_Model{

    
	public function verify_data_cwforms($postData) {
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

		if ($searchValue != '') {
			$search_arr[] = " (cwf.cw_source like '%" . $searchValue . "%' or 
            cwf.cw_insight_category like '%" . $searchValue . "%' or 
            cwf.cw_comment like '%" . $searchValue . "%' or 
            u.username like'%" . $searchValue . "%' ) ";
		}

		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

        //# Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('cw_form as cwf');
		$this->db->join('users as u', 'cwf.created_by = u.mobile');
		$this->db->where('cwf.created_by', $created_by); 
		
		$records = $this->db->get()->result();

		$totalRecords = $records[0]->allcount;

		
        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('cw_form as cwf');
		$this->db->join('users as u', 'cwf.created_by = u.mobile');

		if ($searchQuery != '') $this->db->where($searchQuery);
		$this->db->where('cwf.created_by', $created_by); 

		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select('cwf.*,u.username as username');
		$this->db->from('cw_form as cwf');
		$this->db->join('users as u', 'cwf.created_by = u.mobile');

		if ($searchQuery != '') $this->db->where($searchQuery);
		$this->db->where('cwf.created_by', $created_by); 

		$this->db->order_by('cwf.id', 'desc');  // or desc

		$this->db->limit($rowperpage, $start);

		$records = $this->db->get()->result();

		$data = array();

		foreach ($records as $record) {
			
			$timedate1 = strtotime(date("Y-m-d", strtotime($record->created_on)));
			$created_on = date("d-m-Y", $timedate1);

			$timedate2 = strtotime(date("Y-m-d", strtotime($record->cw_date)));
			$cw_date = date("d-m-Y", $timedate2);

			$get_cw_insight_category = explode('|',$record->cw_insight_category);

			$cw_insight_category = '<ul>';
			foreach ($get_cw_insight_category as $key => $cic_value) {
				$cw_insight_category .= '<li>'.$cic_value.'</li>';
			}
			$cw_insight_category .= '</ul>';
			$cw_filename = '';

			if($record->cw_filename !=''){
				$get_cw_filename = explode(',',$record->cw_filename);
				$cw_filename .= '<div class="user-groups ml-auto">';
				foreach ($get_cw_filename as $key => $cf_value) {
					$action_url1 = base_url()."uploads/competion_watch/".$cf_value;
					$cw_filename .= '<img src="'.$action_url1.'" width="35" height="35" class="rounded-circle" alt="" onclick="show_pop_img();">';
				}
				$cw_filename .= '</div>';
			}
			


			

			$data[] = array(
				"id" => $record->id,
				"auto_id" => $record->auto_id,
				"cw_date" => $cw_date,
				"cw_source" => $record->cw_source,
				"cw_insight_category" => $cw_insight_category,
				"cw_comment" => $record->cw_comment,
				"cw_filename" => $cw_filename,
				"created_on" => $created_on,
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
	
    public function verify_data_cwforms_report($postData,$postWhere,$type) {

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

		if ($searchValue != '') {
			$search_arr[] = " (cwf.cw_source like '%" . $searchValue . "%' or 
            cwf.cw_insight_category like '%" . $searchValue . "%' or 
            cwf.cw_comment like '%" . $searchValue . "%' or 
            u.username like'%" . $searchValue . "%' ) ";
		}

		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

        //# Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('cw_form as cwf');
		$this->db->join('users as u', 'cwf.created_by = u.mobile');
		if($type == 'where'){
			$this->db->where_in('created_by',$postWhere);
		}

		$records = $this->db->get()->result();

		$totalRecords = $records[0]->allcount;

		
        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('cw_form as cwf');
		$this->db->join('users as u', 'cwf.created_by = u.mobile');
		if($type == 'where'){
			$this->db->where_in('created_by',$postWhere);
		}

		if ($searchQuery != '') $this->db->where($searchQuery);

		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select('cwf.*,u.username as username');
		$this->db->from('cw_form as cwf');
		$this->db->join('users as u', 'cwf.created_by = u.mobile');
		if($type == 'where'){
			$this->db->where_in('created_by',$postWhere);
		}

		if ($searchQuery != '') $this->db->where($searchQuery);

		$this->db->order_by('cwf.id', 'desc');  // or desc

		$this->db->limit($rowperpage, $start);

		$records = $this->db->get()->result();

		$data = array();

		foreach ($records as $record) {
			
			$timedate1 = strtotime(date("Y-m-d", strtotime($record->created_on)));
			$created_on = date("d-m-Y", $timedate1);

			$timedate2 = strtotime(date("Y-m-d", strtotime($record->cw_date)));
			$cw_date = date("d-m-Y", $timedate2);

			$get_cw_insight_category = explode('|',$record->cw_insight_category);

			$cw_insight_category = '<ul>';
			foreach ($get_cw_insight_category as $key => $cic_value) {
				$cw_insight_category .= '<li>'.$cic_value.'</li>';
			}
			$cw_insight_category .= '</ul>';
			$cw_filename = '';

			if($record->cw_filename !=''){
				$get_cw_filename = explode(',',$record->cw_filename);
				$cw_filename .= '<div class="user-groups ml-auto">';
				foreach ($get_cw_filename as $key => $cf_value) {
					$action_url1 = base_url()."uploads/competion_watch/".$cf_value;
					$cw_filename .= '<img src="'.$action_url1.'" width="35" height="35" class="rounded-circle" alt="" onclick="show_pop_img();">';
				}
				$cw_filename .= '</div>';
			}
			
			$action = '';

			if($this->session->userdata('role_type') =='ASM'){
				if($record->supervisor_comment !=''){
					$action .= '<button type="button" class="btn btn-light-secondary btn-sm m-1" disabled onclick="get_adtdetails_pop('."'".$record->auto_id."'".');" ><i class="bx bx-edit"></i>
					</button>';
				}else{
					$action .= '<button type="button" class="btn btn-light-secondary btn-sm m-1" onclick="get_adtdetails_pop('."'".$record->auto_id."'".');" ><i class="bx bx-edit"></i>
					</button>';
				}
				
			}
			
			$action .= ' <button type="button" class="btn btn-light-success btn-sm m-1" id="history_'.$record->auto_id.'" data-supervisor_comment="'.$record->supervisor_comment.'" data-weightage="'.$record->weightage.'" onclick="get_adtdetails_viewpop('."'".$record->auto_id."'".');" ><i class="bx bx-repeat"></i>
				</button>';

			$data[] = array(
				"id" => $record->id,
				"auto_id" => $record->auto_id,
				"cw_date" => $cw_date,
				"cw_source" => $record->cw_source,
				"cw_insight_category" => $cw_insight_category,
				"cw_comment" => $record->cw_comment,
				"cw_filename" => $cw_filename,
				"created_on" => $created_on,
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
	   
	
}

?>