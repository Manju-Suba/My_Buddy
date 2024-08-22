<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leader_model extends CI_Model{


    public function get_rssm_rejected_forms($postData,$postData_where,$postData_where_id){
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
			division like '%" . $searchValue . "%' or 
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
		if(count($postData_where_id) !=0){
			$this->db->where_in('rrf.created_by',$postData_where_id);
		}
        $this->db->where($postData_where);
		
		if ($searchQuery != '') $this->db->where($searchQuery);
		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select('rrf.*,u.username as created_by');
		$this->db->from('rssm_recruitment_form rrf');
		$this->db->join('users as u', 'rrf.created_by = u.mobile');
		if(count($postData_where_id) !=0){
			$this->db->where_in('rrf.created_by',$postData_where_id);
		}
        $this->db->where($postData_where);

		if ($searchQuery != '') $this->db->where($searchQuery);
		$this->db->order_by('updated_on', 'desc');  // or desc

		$this->db->limit($rowperpage, $start);

		$records = $this->db->get()->result();
        // print_r($records);die();

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
				$rssm_content = 'Inprogress';
                $rssm_class ='badge-warning';
            }
            // print_r($record->rssm_remarks);
			// if($record->rssm_remarks == ""){
				$asm_status = '<span class="badge '.$asm_class.'">'.$get_asm_status.'</span><br>';
				// <b>RSSM : </b><span class="badge '.$rssm_class.'">'.$rssm_content.'</span>';
		
			// }else{
			// 	$asm_status = '<b>ASM : </b><span class="badge '.$asm_class.'">'.$get_asm_status.'</span><br>
			// 	<b>RSSM : </b><span class="badge '.$rssm_class.'">'.$rssm_content.'</span><br>
			// 	<b>RSSM Remarks: </b><span class="badge badge-danger">'.$record->rssm_remarks.'</span>';
		
			// }
			
            $rssm_status = '<span class="badge '.$rssm_class.'">'.$rssm_content.'</span>';
            $rssm_remarks ='';
			if($record->rssm_remarks != ""){
				$remark = $record->rssm_remarks;
				$rssm_remark= wordwrap($remark,80,"<br>\n");
            	$rssm_remarks = $rssm_remark;

            }

			// $this->db->select('*');
			
            // if($record->add_status == 'Added'){
			$action = '<button onclick="view_adddetails('."'".$record->auto_id."'".');" class="btn  btn-sm btn-success dt-btn-st" id="adtbtn"><i class="bx bx-comment-dots"></i></button>';

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

			$data[] = array(
				"id" => $record->id,
				"auto_id" => $record->auto_id,
				"name" => $record->name,
				"ex_rssm_name" => $record->ex_rssm_name,
				"mobile_no" => $record->mobile_no,
				"alt_mobile_no" => $record->alt_mobile_no,
				"address" => $record->address,
				"state" => $record->state,
				"division" => $record->division,
				"town" => $record->town,
				"resume" => $resume,
				"created_on" => $created_on,
				// "va_status" => $va_status,
				"asm_status" => $asm_status,
                "rssm_status"=> $rssm_status,
                "rssm_remarks"=> $rssm_remarks,
				"score" => $score,
				"vso_score" => $vso_score,
				"created_by" => $record->created_by,
				"action" => $action,
				"bank_name" => $record->bank_name,
				"account_no" => $record->ac_number,
				"branch_name" => $record->branch_name,
				"ifsc_code" => $record->ifsc_s_number, 
				"account_type" => $record->ac_type 

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


    public function verify_data_get($table,$where){
        $this->db->select('*');
        $this->db->from('rssm_recruitment_form as rr');
        $this->db->join('masters as m','m.tso_number = rr.created_by');
		$this->db->join('sales_category as sc','rr.sales_cat = sc.sales_category');
        $this->db->where($where);
        $records = $this->db->group_by('rr.auto_id')->get();
		
        return $records->result();
        
    }

	public function get_history($table,$where){
        $this->db->select('*');
        $this->db->from('service_fee_history as s_his');
        $this->db->join('sales_category as sc','sc.sales_category = s_his.sales_cat');
        $this->db->where($where);
        $records = $this->db->get();
        
        return $records->result();
        
    }
    	
}

?>