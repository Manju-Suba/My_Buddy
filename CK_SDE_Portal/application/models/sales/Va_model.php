<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Va_model extends CI_Model{

    function verify_data_rssmforms_va($postData,$postData_where,$postData_where_id){
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
		$this->db->where_in('rrf.created_by',$postData_where_id);


		$records = $this->db->get()->result();

		$totalRecords = $records[0]->allcount;

        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
        $this->db->from('rssm_recruitment_form rrf');
		$this->db->join('users as u', 'rrf.created_by = u.mobile');
		$this->db->where_in('rrf.created_by',$postData_where_id);

        $this->db->where($postData_where);
		
		if ($searchQuery != '') $this->db->where($searchQuery);
		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select('rrf.*,u.username as created_by');
		$this->db->from('rssm_recruitment_form rrf');
		$this->db->join('users as u', 'rrf.created_by = u.mobile');
		$this->db->where_in('rrf.created_by',$postData_where_id);

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
				$resume='';
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
            //     $va_status = '';
            // }

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


            $action_url2 = base_url()."index.php/RSSMController/edit_rssm_rec_form/".$record->auto_id;

			$action = '<button onclick="get_adtdetails_pop('."'".$record->auto_id."'".');" class="btn  btn-sm btn-success dt-btn-st" id="adtbtn"><i class="bx bx-comment-dots"></i></button>';

			$score 	= 	$record->exp_point + $record->edu_point + $record->age_point + 
						$record->tk_point + $record->ta_point + $record->fb_point;
			$action .= ' <a href="'.$action_url2.'"><button  class="btn  ml-1  btn-sm btn-info dt-btn-st" id="editBtn"><i class="bx bx-pencil"></i></button></a>';

			$action .= ' <button onclick="get_action_pop('."'".$record->auto_id."'".');" class="btn  btn-sm btn-danger dt-btn-st" id="actnbtn"><i class="bx bx-task"></i></button>';

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

}

?>