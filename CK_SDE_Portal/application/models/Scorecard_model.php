<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scorecard_model extends CI_Model{

	public function get_rural_npd_details($postData,$type) {
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
			$search_arr[] = " (scorecard_headers.header like '%" . $searchValue . "%' ) ";
		}

		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

		//# Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('scorecard_headers');
		$this->db->where('scorecard_headers.type', $type);
		$records = $this->db->get()->result();
		$totalRecords = $records[0]->allcount;
		
		//# Total number of record with filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('scorecard_headers');
		$this->db->where('scorecard_headers.type', $type);
		if ($searchQuery != '') $this->db->where($searchQuery);
		$records = $this->db->get()->result();
		$totalRecordwithFilter = $records[0]->allcount;

		//# Fetch records
		$this->db->select('scorecard_headers.*');
		$this->db->from('scorecard_headers');
		$this->db->where('scorecard_headers.type', $type);
		if ($searchQuery != '') $this->db->where($searchQuery);
		$this->db->limit($rowperpage, $start);
		$records = $this->db->get()->result();
		$data = array();

		foreach ($records as $record) {
		
			$data[] = array(
				"header" => $record->header,
				"day1_tar" => '',
				"day2_tar" => '',
				"day3_tar" => '',
				"day4_tar" => '',
				"day5_tar" => '',
				"day6_tar" => '',
				"day7_tar" => '',
				"day1_act" => '',
				"day2_act" => '',
				"day3_act" => '',
				"day4_act" => '',
				"day5_act" => '',
				"day6_act" => '',
				"day7_act" => '',
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
