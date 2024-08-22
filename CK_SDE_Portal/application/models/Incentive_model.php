<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Incentive_model extends CI_Model{

    public function get_data($table,$sess_mob){

		$this->db->select();
		$this->db->where('mobile',$sess_mob);
		$details = $this->db->get($table);
		return $details->result();
	}
	public function get_data_asm_details($table,$user_id,$zsm_number){

		$this->db->select();
		$this->db->where('user_id',$user_id);
		$this->db->where('zsm_number',$zsm_number);
		$this->db->group_by('asm');
		$records = $this->db->get($table);
		
		return $records->result();
	}
		// public function get_data_asm_details($table,$user_id,$zsm_number){

		// 	$this->db->select();
		// 	$this->db->where('user_id',$user_id);
		// 	$this->db->where('zsm',$zsm_name);
		// 	$this->db->where('zsm',$zsm_number);
		// 	$this->db->group_by('asm');
		// 	$records = $this->db->get($table);
			
		// 	return $records->result();
		// }

	public function get_data_zsm_details($table,$va_number){

		$this->db->select();
		$this->db->where('va_number',$va_number);
		$this->db->group_by('zsm');
		$records = $this->db->get($table);
		
		return $records->result();
	}

	public function get_data_zsm_details_($table,$va_number){

		$this->db->select();
		$this->db->where('va_number',$va_number);
		$this->db->group_by('zsm');
		$records = $this->db->get($table);
		
		return $records->result();
		
	}

	public function get_data_tso_sde_details($table,$asm_number){

		$this->db->select();
		$this->db->where('asm_number',$asm_number);
		$this->db->group_by('tso');
		$records = $this->db->get($table);
		
		return $records->result();
		
	}

	public function get_data_sde_details($table,$user_id,$zsm_name){

		$this->db->select();
		$this->db->where('user_id',$user_id);
		$this->db->where('zsm',$zsm_name);
		$this->db->group_by('asm');
		$records = $this->db->get($table);
		
		return $records->result();
	}

	public function get_sde_list($table,$user_id,$zsm_number,$asm_number)
    {

		$this->db->select();
		$this->db->where('user_id',$user_id);
		$this->db->where('zsm_number',$zsm_number);
		$this->db->where('asm_number',$asm_number);
		$this->db->group_by('tso');
		$records = $this->db->get($table);
		
		return $records->result_array();
    }

	public function get_sde_list_($table,$sess_mob,$va_name,$zsm_name,$asm_name)
    {

		$this->db->select();
		$this->db->where('va_number',$sess_mob);
		$this->db->where('va',$va_name);
		$this->db->where('zsm',$zsm_name);
		$this->db->where('asm',$asm_name);
		$this->db->group_by('tso');
		$records = $this->db->get($table);
		
		return $records->result_array();
    }

	public function get_asm_list($table,$sess_mob,$va_name,$zsm_name)
    {

		$this->db->select();
		$this->db->where('va_number',$sess_mob);
		$this->db->where('va',$va_name);
		$this->db->where('zsm',$zsm_name);
		$this->db->group_by('asm');
		$records = $this->db->get($table);
		
		return $records->result_array();
    }

	public function get_sde_individual($table,$sde_number,$jc_type)
    {

		$this->db->select();
		$this->db->where('sde_number',$sde_number);
		if($jc_type != ""){
			$this->db->where('jc_type',$jc_type);
		}else{
			$this->db->where('jc_type','JC07');
		}
		$records = $this->db->get($table);
		
		return $records->result();
    }

	public function get_sde_individual_view($table,$zsm_number,$asm_number,$sde_number,$jc_type)
    {
		
		$this->db->select();
		$this->db->where('zsm_number',$zsm_number);
		$this->db->where('asm_number',$asm_number);
		$this->db->where('sde_number',$sde_number);
		$this->db->where('jc_type',$jc_type);
		$records = $this->db->get($table);
		
		return $records->result();
    }
    public function verify_data_sde_incentive_report($postData,$postData_where,$type) {

		$response = array();

		//$show = $postData['status'];
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

		$jc_type_value1 = $postData_where['jc_type'];
		
		if($jc_type_value1 ===""){
			$jc_type_value="JC07";
		}elseif($jc_type_value1 !==""){
			$jc_type_value=$jc_type_value1;
		}

		// $jc_type_value = $postData_where['jc_type'];
		$zsm_number = $postData_where['zsm_number'];
		
		$username_value = $postData_where['username'];
		// $asm_name = $postData_where['asm_name'];
		$asm_number = $postData_where['asm_number'];
		
		if ($searchValue != '') {
			$search_arr[] = " (sde_incentive_urban.market like '%" . $searchValue . "%' or 
            sde_incentive_urban.mandays_target like '%" . $searchValue . "%' or 
            sde_incentive_urban.mandays_ach like '%" . $searchValue . "%' or 
            sde_incentive_urban.mandays_percentage like '%" . $searchValue . "%' or 
            sde_incentive_urban.mandays_amount like '%" . $searchValue . "%' or 
            sde_incentive_urban.mandays_exception_days like '%" . $searchValue . "%' or 
            sde_incentive_urban.orange_salesman_target like '%" . $searchValue . "%' or 
            sde_incentive_urban.orange_salesman_ach like '%" . $searchValue . "%' or 
            sde_incentive_urban.orange_salesman_percentage like '%" . $searchValue . "%' or 
            sde_incentive_urban.orange_salesman_amount like '%" . $searchValue . "%' or 
            sde_incentive_urban.ck_super_star_target like '%" . $searchValue . "%' or 
            sde_incentive_urban.ck_super_star_ach like '%" . $searchValue . "%' or 
            sde_incentive_urban.ck_super_star_percentage like '%" . $searchValue . "%' or 
            sde_incentive_urban.ck_super_star_amount like '%" . $searchValue . "%' or 
            sde_incentive_urban.ck_elite_target like '%" . $searchValue . "%' or 
            sde_incentive_urban.ck_elite_ach like '%" . $searchValue . "%' or 
            sde_incentive_urban.ck_elite_percentage like '%" . $searchValue . "%' or 
            sde_incentive_urban.ck_elite_amount like '%" . $searchValue . "%' or 
            sde_incentive_urban.sec_value_target like '%" . $searchValue . "%' or 
            sde_incentive_urban.sec_value_ach like '%" . $searchValue . "%' or 
            sde_incentive_urban.sec_value_percentage like '%" . $searchValue . "%' or 
            sde_incentive_urban.sec_value_amount like '%" . $searchValue . "%' or 
            sde_incentive_urban.rising_star_outlet_target like '%" . $searchValue . "%' or 
            sde_incentive_urban.rising_star_outlet_ach like '%" . $searchValue . "%' or 
            sde_incentive_urban.rising_star_outlet_percentage like '%" . $searchValue . "%' or 
            sde_incentive_urban.rising_star_outlet_amount like '%" . $searchValue . "%' or 
            sde_incentive_urban.total_amount like '%" . $searchValue . "%' or 
            sde_incentive_urban.pending_last_month like '%" . $searchValue . "%' or 
            sde_incentive_urban.final_amount like '%" . $searchValue . "%' or 
            sde_incentive_urban.remarks like'%" . $searchValue . "%' ) ";
		}


		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

        //# Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('sde_incentive_urban');
		$this->db->where('zsm_number', $zsm_number);

	
		if($jc_type_value ==="JC07"  && $asm_number ===""){
			$this->db->where('jc_type', $jc_type_value);
        }elseif($jc_type_value!=="JC07"  && $asm_number ===""){
			$this->db->where('jc_type', $jc_type_value);
        }elseif($jc_type_value ==="JC07" && $asm_number !==""){
			$this->db->where('jc_type', $jc_type_value);
			$this->db->where('asm_number', $asm_number);
		}elseif($jc_type_value !=="JC07" && $asm_number !==""){
			$this->db->where('jc_type', $jc_type_value);
			$this->db->where('asm_number', $asm_number);
		}
		$records = $this->db->get()->result();

		$totalRecords = $records[0]->allcount;

		
        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('sde_incentive_urban');
		$this->db->where('zsm_number', $zsm_number);

		if($jc_type_value ==="JC07"  && $asm_number ===""){
			$this->db->where('jc_type', $jc_type_value);
        }elseif($jc_type_value!=="JC07"  && $asm_number ===""){
			$this->db->where('jc_type', $jc_type_value);
        }elseif($jc_type_value ==="JC07" && $asm_number !==""){
			$this->db->where('jc_type', $jc_type_value);
			$this->db->where('asm_number', $asm_number);
		}elseif($jc_type_value !=="JC07" && $asm_number !==""){
			$this->db->where('jc_type', $jc_type_value);
			$this->db->where('asm_number', $asm_number);
		}
		if ($searchQuery != '') $this->db->where($searchQuery);

		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select('sde_incentive_urban.*');
		$this->db->from('sde_incentive_urban');
		$this->db->where('zsm_number', $zsm_number);

		if($jc_type_value ==="JC07"  && $asm_number ===""){
			$this->db->where('jc_type', $jc_type_value);
        }elseif($jc_type_value!=="JC07"  && $asm_number ===""){
			$this->db->where('jc_type', $jc_type_value);
        }elseif($jc_type_value ==="JC07" && $asm_number !==""){
			$this->db->where('jc_type', $jc_type_value);
			$this->db->where('asm_number', $asm_number);
		}elseif($jc_type_value !=="JC07" && $asm_number !==""){
			$this->db->where('jc_type', $jc_type_value);
			$this->db->where('asm_number', $asm_number);
		}
		if ($searchQuery != '') $this->db->where($searchQuery);

		$this->db->order_by('sde_incentive_urban.id', 'desc');  // or desc

		$this->db->limit($rowperpage, $start);

		$records = $this->db->get()->result();
		

		$data = array();

		foreach ($records as $record) {

			$str = $record->mandays_percentage ;
			$mandays =  preg_replace('/%/', '', $str); 

			if( $mandays  >= "90.00" && $mandays <= "99.00"){
				$mandays_per_color ='rgb(237 139 16 / 52%)';
			}elseif( $mandays >= "100.00"){
				$mandays_per_color ='rgb(0 128 0 / 32%)';
			}else{
				$mandays_per_color = '';
			}

			$str1 = $record->orange_salesman_percentage ;
			$orange_salesman =  preg_replace('/%/', '', $str1); 

			if( $orange_salesman  >= "90.00" && $orange_salesman <= "99.00"){
				$orange_salesman_per_color ='rgb(237 139 16 / 52%)';
			}elseif( $orange_salesman >= "100.00"){
				$orange_salesman_per_color ='rgb(0 128 0 / 32%)';
			}else{
				$orange_salesman_per_color = '';
			}

			$str2 = $record->ck_super_star_percentage ;
			$ck_super_star =  preg_replace('/%/', '', $str2); 

			if( $ck_super_star  >= "90.00" && $ck_super_star <= "99.00"){
				$ck_super_star_per_color ='rgb(237 139 16 / 52%)';
			}elseif( $ck_super_star >= "100.00"){
				$ck_super_star_per_color ='rgb(0 128 0 / 32%)';
			}else{
				$ck_super_star_per_color = '';
			}


			$str3 = $record->ck_elite_percentage ;
			$ck_elite =  preg_replace('/%/', '', $str3); 

			if( $ck_elite  >= "90.00" && $ck_elite <= "99.00"){
				$ck_elite_per_color ='rgb(237 139 16 / 52%)';
			}elseif( $ck_elite >= "100.00"){
				$ck_elite_per_color ='rgb(0 128 0 / 32%)';
			}else{
				$ck_elite_per_color = '';
			}


			$str4 = $record->sec_value_percentage ;
			$sec_value =  preg_replace('/%/', '', $str4); 

			if( $sec_value  >= "90.00" && $sec_value <= "99.00"){
				$sec_value_per_color ='rgb(237 139 16 / 52%)';
			}elseif( $sec_value >= "100.00"){
				$sec_value_per_color ='rgb(0 128 0 / 32%)';
			}else{
				$sec_value_per_color = '';
			}


			$str5 = $record->rising_star_outlet_percentage ;
			$rising_star_outlet =  preg_replace('/%/', '', $str5); 

			if( $rising_star_outlet  >= "90.00" && $rising_star_outlet <= "99.00"){
				$rising_star_outlet_per_color ='rgb(237 139 16 / 52%)';
			}elseif( $rising_star_outlet >= "100.00"){
				$rising_star_outlet_per_color ='rgb(0 128 0 / 32%)';
			}else{
				$rising_star_outlet_per_color = '';
			}
			



			$data[] = array(
				"id" => $record->id,
			
				"asm_name" => $record->asm_name,
				"sde_name" => $record->sde_name,
				"market" => $record->market,
				"mandays_target" => $record->mandays_target,
				"mandays_ach" => $record->mandays_ach,
				"mandays_percentage" => $record->mandays_percentage,
				"mandays_per_color" => $mandays_per_color,

				"mandays_amount" => $record->mandays_amount,
				"orange_salesman_target" => $record->orange_salesman_target,
				"orange_salesman_ach" => $record->orange_salesman_ach,
				"orange_salesman_percentage" => $record->orange_salesman_percentage,
				"orange_salesman_per_color" => $orange_salesman_per_color,

				"orange_salesman_amount" => $record->orange_salesman_amount,
				"ck_super_star_target" => $record->ck_super_star_target,
				"ck_super_star_ach" => $record->ck_super_star_ach,
				"ck_super_star_percentage" => $record->ck_super_star_percentage,
				"ck_super_star_per_color" => $ck_super_star_per_color,
				
				"ck_super_star_amount" => $record->ck_super_star_amount,
				"ck_elite_target" => $record->ck_elite_target,
				"ck_elite_ach" => $record->ck_elite_ach,
				"ck_elite_percentage" => $record->ck_elite_percentage,
				"ck_elite_per_color" => $ck_elite_per_color,

				"ck_elite_amount" => $record->ck_elite_amount,
				"sec_value_target" => $record->sec_value_target,
				"sec_value_ach" => $record->sec_value_ach,
				"sec_value_percentage" => $record->sec_value_percentage,
				"sec_value_per_color" => $sec_value_per_color,

				"sec_value_amount" => $record->sec_value_amount,
				"rising_star_outlet_target" => $record->rising_star_outlet_target,
				"rising_star_outlet_ach" => $record->rising_star_outlet_ach,
				"rising_star_outlet_percentage" => $record->rising_star_outlet_percentage,
				"rising_star_outlet_per_color" => $rising_star_outlet_per_color,
				
				"rising_star_outlet_amount" => $record->rising_star_outlet_amount,
				"total_amount" => $record->total_amount,
				"pending_last_month" => $record->pending_last_month,
				"final_amount" => $record->final_amount,
				"remarks" => $record->remarks,

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


	public function verify_data_sde_incentive_report_asm($postData,$postData_where,$type) {

		$response = array();

		//$show = $postData['status'];
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

		$jc_type_value1 = $postData_where['jc_type'];
		
		if($jc_type_value1 ===""){
			$jc_type_value="JC07";
		}elseif($jc_type_value1 !==""){
			$jc_type_value=$jc_type_value1;
		}

		// $jc_type_value = $postData_where['jc_type'];
		// $username_value = $postData_where['username'];
		// $sde_name = $postData_where['sde_name'];
		$asm_number = $postData_where['asm_number'];
		$sde_number = $postData_where['sde_number'];
		
		if ($searchValue != '') {
			$search_arr[] = " (sde_incentive_urban.market like '%" . $searchValue . "%' or 
            sde_incentive_urban.mandays_target like '%" . $searchValue . "%' or 
            sde_incentive_urban.mandays_ach like '%" . $searchValue . "%' or 
            sde_incentive_urban.mandays_percentage like '%" . $searchValue . "%' or 
            sde_incentive_urban.mandays_amount like '%" . $searchValue . "%' or 
            sde_incentive_urban.mandays_exception_days like '%" . $searchValue . "%' or 
            sde_incentive_urban.orange_salesman_target like '%" . $searchValue . "%' or 
            sde_incentive_urban.orange_salesman_ach like '%" . $searchValue . "%' or 
            sde_incentive_urban.orange_salesman_percentage like '%" . $searchValue . "%' or 
            sde_incentive_urban.orange_salesman_amount like '%" . $searchValue . "%' or 
            sde_incentive_urban.ck_super_star_target like '%" . $searchValue . "%' or 
            sde_incentive_urban.ck_super_star_ach like '%" . $searchValue . "%' or 
            sde_incentive_urban.ck_super_star_percentage like '%" . $searchValue . "%' or 
            sde_incentive_urban.ck_super_star_amount like '%" . $searchValue . "%' or 
            sde_incentive_urban.ck_elite_target like '%" . $searchValue . "%' or 
            sde_incentive_urban.ck_elite_ach like '%" . $searchValue . "%' or 
            sde_incentive_urban.ck_elite_percentage like '%" . $searchValue . "%' or 
            sde_incentive_urban.ck_elite_amount like '%" . $searchValue . "%' or 
            sde_incentive_urban.sec_value_target like '%" . $searchValue . "%' or 
            sde_incentive_urban.sec_value_ach like '%" . $searchValue . "%' or 
            sde_incentive_urban.sec_value_percentage like '%" . $searchValue . "%' or 
            sde_incentive_urban.sec_value_amount like '%" . $searchValue . "%' or 
            sde_incentive_urban.rising_star_outlet_target like '%" . $searchValue . "%' or 
            sde_incentive_urban.rising_star_outlet_ach like '%" . $searchValue . "%' or 
            sde_incentive_urban.rising_star_outlet_percentage like '%" . $searchValue . "%' or 
            sde_incentive_urban.rising_star_outlet_amount like '%" . $searchValue . "%' or 
            sde_incentive_urban.total_amount like '%" . $searchValue . "%' or 
            sde_incentive_urban.pending_last_month like '%" . $searchValue . "%' or 
            sde_incentive_urban.final_amount like '%" . $searchValue . "%' or 
            sde_incentive_urban.remarks like'%" . $searchValue . "%' ) ";
		}


		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

        //# Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('sde_incentive_urban');
		$this->db->where('asm_number', $asm_number);

	
		if($jc_type_value ==="JC07"  && $sde_number ===""){
			$this->db->where('jc_type', $jc_type_value);
        }elseif($jc_type_value!=="JC07"  && $sde_number ===""){
			$this->db->where('jc_type', $jc_type_value);
        }elseif($jc_type_value ==="JC07" && $sde_number !==""){
			$this->db->where('jc_type', $jc_type_value);
			$this->db->where('sde_number', $sde_number);
		}elseif($jc_type_value !=="JC07" && $sde_number !==""){
			$this->db->where('jc_type', $jc_type_value);
			$this->db->where('sde_number', $sde_number);
		}
		$records = $this->db->get()->result();

		$totalRecords = $records[0]->allcount;

		
        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('sde_incentive_urban');
		$this->db->where('asm_number', $asm_number);

		if($jc_type_value ==="JC07"  && $sde_number ===""){
			$this->db->where('jc_type', $jc_type_value);
        }elseif($jc_type_value!=="JC07"  && $sde_number ===""){
			$this->db->where('jc_type', $jc_type_value);
        }elseif($jc_type_value ==="JC07" && $sde_number !==""){
			$this->db->where('jc_type', $jc_type_value);
			$this->db->where('sde_number', $sde_number);
		}elseif($jc_type_value !=="JC07" && $sde_number !==""){
			$this->db->where('jc_type', $jc_type_value);
			$this->db->where('sde_number', $sde_number);
		}
		if ($searchQuery != '') $this->db->where($searchQuery);

		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select('sde_incentive_urban.*');
		$this->db->from('sde_incentive_urban');
		$this->db->where('asm_number', $asm_number);

		if($jc_type_value ==="JC07"  && $sde_number ===""){
			$this->db->where('jc_type', $jc_type_value);
        }elseif($jc_type_value!=="JC07"  && $sde_number ===""){
			$this->db->where('jc_type', $jc_type_value);
        }elseif($jc_type_value ==="JC07" && $sde_number !==""){
			$this->db->where('jc_type', $jc_type_value);
			$this->db->where('sde_number', $sde_number);
		}elseif($jc_type_value !=="JC07" && $sde_number !==""){
			$this->db->where('jc_type', $jc_type_value);
			$this->db->where('sde_number', $sde_number);
		}
		if ($searchQuery != '') $this->db->where($searchQuery);

		$this->db->order_by('sde_incentive_urban.id', 'desc');  // or desc
		$this->db->limit($rowperpage, $start);
		$records = $this->db->get()->result();


		if($jc_type_value ==="JC07"  && $sde_number ===""){
			foreach ($records as $record) {
				$mandper_val = $record->mandays_percentage;
				$org_sales_manper_val = $record->orange_salesman_percentage;
				$ck_spr_star_per_val = $record->ck_super_star_percentage;
				$ck_elite_per_val= $record->ck_elite_percentage;
				$sec_val_per_val = $record->sec_value_percentage;
				$rs_outlet_per_val = $record->rising_star_outlet_percentage;

				$mandper = (float) $mandper_val;
				$org_sales_manper = (float) $org_sales_manper_val;
				$ck_spr_star_per = (float) $ck_spr_star_per_val;
				$ck_elite_per = (float) $ck_elite_per_val;
				$sec_val_per = (float) $sec_val_per_val;
				$rs_outlet_per = (float) $rs_outlet_per_val;


				$sum_total_per= $mandper + $org_sales_manper + $ck_spr_star_per + $ck_elite_per + $sec_val_per + $rs_outlet_per ;
				
				$total_per = $sum_total_per/6;
				// $total = $total_per * 100;
				$total = round($total_per, 2);


				$myArr_per []=$total;
				$myArr_id []=$record->id;
				
			}
			$min_per =  min($myArr_per);
			$max_per =  max($myArr_per);
			
			$myArr_max_id=[];
			$myArr_min_id=[];
			
			for($i=0;$i < count($myArr_per);$i++){
				$value=$myArr_per[$i];
				if($value === $max_per ){
					array_push($myArr_max_id,$myArr_id[$i]);
				}

				if($value === $min_per ){
					array_push($myArr_min_id,$myArr_id[$i]);
				}
				
			}


			
		}
	
		$data = array();

		if($jc_type_value ==="JC07"  && $sde_number ===""){
			arsort($myArr_per);
		
			foreach($myArr_per as $x=>$x_value)
			{
				
				foreach ($records as $record) {
					if($myArr_id[$x] == $record->id){
						// print_r($record->id);
						if($jc_type_value ==="JC07"  && $sde_number ===""){
							$bg_color="";
							
							for($i=0;$i < count($myArr_max_id);$i++){
								$max_id=$myArr_max_id[$i];
								if($record->id === $max_id ){
									$bg_color.='green';
								}
								
							}
			
							for($i=0;$i < count($myArr_min_id);$i++){
								$min_id=$myArr_min_id[$i];
								if($record->id === $min_id ){
									$bg_color.='red';
								}
								
							}
			
							
						}else{
							$bg_color="";
						}
			
						$lowest_percentage='rgb(215 12 12 / 30%)';
						$highest_percentage ='rgb(0 128 0 / 32%)';
						$bg_color_value = $bg_color;
						$ck_elite_number = $record->ck_elite_ach;
						$ck_elite_ach  = number_format((float)$ck_elite_number, 3, '.', ''); 
			
			
			
						$total_target= $record->mandays_target + $record->orange_salesman_target + $record->ck_super_star_target + $record->ck_elite_target + $record->sec_value_target + $record->rising_star_outlet_target;
			
						$total_ach= $record->mandays_ach + $record->orange_salesman_ach + $record->ck_super_star_ach + $ck_elite_ach + $record->sec_value_ach + $record->rising_star_outlet_ach;
			
						$total_percentage = (float) $record->mandays_percentage + (float) $record->orange_salesman_percentage + (float) $record->ck_super_star_percentage + (float) $record->ck_elite_percentage + (float) $record->sec_value_percentage + (float) $record->rising_star_outlet_percentage;
			
						$total_amount= $record->mandays_amount + $record->orange_salesman_amount + $record->ck_super_star_amount + $record->ck_elite_amount + $record->sec_value_amount + $record->rising_star_outlet_amount;
			
			
						$html="<html><body><table>";
							$html.="<tr>";
								$html.="<th scope='col'></th>";
								$html.="<th scope='col'>Target</th>";
								$html.="<th scope='col'>ACH</th>";
								$html.="<th scope='col'>%</th>";
								$html.="<th scope='col'>Amount</th>";
							$html.="</tr>";
							$html.="<tr>";
								$html.="<th scope='row'>Mandays</th>";
								$html.="<td>$record->mandays_target</td>";
								$html.="<td>$record->mandays_ach</td>";
								$html.="<td>$record->mandays_percentage</td>";
								$html.="<td>$record->mandays_amount</td>";
							$html.="</tr>";
							$html.="<tr>";
								$html.="<th scope='row'>Orange SalesMan</th>";
								$html.="<td>$record->orange_salesman_target</td>";
								$html.="<td>$record->orange_salesman_ach</td>";
								$html.="<td>$record->orange_salesman_percentage</td>";
								$html.="<td>$record->orange_salesman_amount</td>";
							$html.="</tr>";
							$html.="<tr>";
								$html.="<th scope='row'>CK Super Star</th>";
								$html.="<td>$record->ck_super_star_target</td>";
								$html.="<td>$record->ck_super_star_ach</td>";
								$html.="<td>$record->ck_super_star_percentage</td>";
								$html.="<td>$record->ck_super_star_amount</td>";
							$html.="</tr>";
							$html.="<tr>";
								$html.="<th scope='row'>CK Elite | Kudumbam | Parivar</th>";
								$html.="<td>$record->ck_elite_target</td>";
								$html.="<td>$ck_elite_ach</td>";
								// $html.="<td>$record->ck_elite_ach</td>";
								$html.="<td>$record->ck_elite_percentage</td>";
								$html.="<td>$record->ck_elite_amount</td>";
							$html.="</tr>";
							$html.="<tr>";
								$html.="<th scope='row'>Sec. Value Target</th>";
								$html.="<td>$record->sec_value_target</td>";
								$html.="<td>$record->sec_value_ach</td>";
								$html.="<td>$record->sec_value_percentage</td>";
								$html.="<td>$record->sec_value_amount</td>";
							$html.="</tr>";
							$html.="<tr>";
								$html.="<th scope='row'>Rising Stars Outlet tgt vs ach count</th>";
								$html.="<td>$record->rising_star_outlet_target</td>";
								$html.="<td>$record->rising_star_outlet_ach</td>";
								$html.="<td>$record->rising_star_outlet_percentage</td>";
								$html.="<td>$record->rising_star_outlet_amount</td>";
							$html.="</tr>";
							$html.="<tr>";
								$html.="<th scope='row'>Total</th>";
								$html.="<td><b>$total_target</b></td>";
								$html.="<td><b>$total_ach</b></td>";
								$html.="<td><b>$total_percentage % </b></td>";
								$html.="<td><b>$total_amount</b></td>";
							$html.="</tr>";
						$html.="</table></body></html>";
			
						
			
						$data[] = array(
							"id" => $record->id,
							"bg_color_value" => $bg_color_value,
							"asm_name" => $record->asm_name,
							"sde_name" => $record->sde_name,
							"market" => $record->market,
							"incen_py_details" => $html,
							"lowest_percentage" => $lowest_percentage,
							"highest_percentage" => $highest_percentage,
							
						);	
					}
				}
			}

		}else{

			foreach ($records as $record) {
				
				$bg_color="";
				$bg_color_value = $bg_color;
				$ck_elite_number = $record->ck_elite_ach;
				$ck_elite_ach  = number_format((float)$ck_elite_number, 3, '.', ''); 



				$total_target= $record->mandays_target + $record->orange_salesman_target + $record->ck_super_star_target + $record->ck_elite_target + $record->sec_value_target + $record->rising_star_outlet_target;

				$total_ach= $record->mandays_ach + $record->orange_salesman_ach + $record->ck_super_star_ach + $ck_elite_ach + $record->sec_value_ach + $record->rising_star_outlet_ach;

				$total_percentage = (float) $record->mandays_percentage + (float) $record->orange_salesman_percentage + (float) $record->ck_super_star_percentage + (float) $record->ck_elite_percentage + (float) $record->sec_value_percentage + (float) $record->rising_star_outlet_percentage;

				$total_amount= $record->mandays_amount + $record->orange_salesman_amount + $record->ck_super_star_amount + $record->ck_elite_amount + $record->sec_value_amount + $record->rising_star_outlet_amount;


				$html="<html><body><table>";
					$html.="<tr>";
						$html.="<th scope='col'></th>";
						$html.="<th scope='col'>Target</th>";
						$html.="<th scope='col'>ACH</th>";
						$html.="<th scope='col'>%</th>";
						$html.="<th scope='col'>Amount</th>";
					$html.="</tr>";
					$html.="<tr>";
						$html.="<th scope='row'>Mandays</th>";
						$html.="<td>$record->mandays_target</td>";
						$html.="<td>$record->mandays_ach</td>";
						$html.="<td>$record->mandays_percentage</td>";
						$html.="<td>$record->mandays_amount</td>";
					$html.="</tr>";
					$html.="<tr>";
						$html.="<th scope='row'>Orange SalesMan</th>";
						$html.="<td>$record->orange_salesman_target</td>";
						$html.="<td>$record->orange_salesman_ach</td>";
						$html.="<td>$record->orange_salesman_percentage</td>";
						$html.="<td>$record->orange_salesman_amount</td>";
					$html.="</tr>";
					$html.="<tr>";
						$html.="<th scope='row'>CK Super Star</th>";
						$html.="<td>$record->ck_super_star_target</td>";
						$html.="<td>$record->ck_super_star_ach</td>";
						$html.="<td>$record->ck_super_star_percentage</td>";
						$html.="<td>$record->ck_super_star_amount</td>";
					$html.="</tr>";
					$html.="<tr>";
						$html.="<th scope='row'>CK Elite | Kudumbam | Parivar</th>";
						$html.="<td>$record->ck_elite_target</td>";
						$html.="<td>$ck_elite_ach</td>";
						$html.="<td>$record->ck_elite_percentage</td>";
						$html.="<td>$record->ck_elite_amount</td>";
					$html.="</tr>";
					$html.="<tr>";
						$html.="<th scope='row'>Sec. Value Target</th>";
						$html.="<td>$record->sec_value_target</td>";
						$html.="<td>$record->sec_value_ach</td>";
						$html.="<td>$record->sec_value_percentage</td>";
						$html.="<td>$record->sec_value_amount</td>";
					$html.="</tr>";
					$html.="<tr>";
						$html.="<th scope='row'>Rising Stars Outlet tgt vs ach count</th>";
						$html.="<td>$record->rising_star_outlet_target</td>";
						$html.="<td>$record->rising_star_outlet_ach</td>";
						$html.="<td>$record->rising_star_outlet_percentage</td>";
						$html.="<td>$record->rising_star_outlet_amount</td>";
					$html.="</tr>";
					$html.="<tr>";
						$html.="<th scope='row'>Total</th>";
						$html.="<td><b>$total_target</b></td>";
						$html.="<td><b>$total_ach</b></td>";
						$html.="<td><b>$total_percentage % </b></td>";
						$html.="<td><b>$total_amount</b></td>";
					$html.="</tr>";
				$html.="</table></body></html>";

				

				$data[] = array(
					"id" => $record->id,
					"bg_color_value" => $bg_color_value,
					"asm_name" => $record->asm_name,
					"sde_name" => $record->sde_name,
					"market" => $record->market,
					"incen_py_details" => $html,
					
				);


			}
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


	public function verify_data_sde_incentive_report_val($postData,$postData_where,$type) {

		$response = array();

		//$show = $postData['status'];
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

		$jc_type_value1 = $postData_where['jc_type'];
		
		if($jc_type_value1 ===""){
			$jc_type_value="JC07";
		}elseif($jc_type_value1 !==""){
			$jc_type_value=$jc_type_value1;
		}

	
		
		if ($searchValue != '') {
			$search_arr[] = " (sde_incentive_urban.market like '%" . $searchValue . "%' or 
            sde_incentive_urban.mandays_target like '%" . $searchValue . "%' or 
            sde_incentive_urban.mandays_ach like '%" . $searchValue . "%' or 
            sde_incentive_urban.mandays_percentage like '%" . $searchValue . "%' or 
            sde_incentive_urban.mandays_amount like '%" . $searchValue . "%' or 
            sde_incentive_urban.mandays_exception_days like '%" . $searchValue . "%' or 
            sde_incentive_urban.orange_salesman_target like '%" . $searchValue . "%' or 
            sde_incentive_urban.orange_salesman_ach like '%" . $searchValue . "%' or 
            sde_incentive_urban.orange_salesman_percentage like '%" . $searchValue . "%' or 
            sde_incentive_urban.orange_salesman_amount like '%" . $searchValue . "%' or 
            sde_incentive_urban.ck_super_star_target like '%" . $searchValue . "%' or 
            sde_incentive_urban.ck_super_star_ach like '%" . $searchValue . "%' or 
            sde_incentive_urban.ck_super_star_percentage like '%" . $searchValue . "%' or 
            sde_incentive_urban.ck_super_star_amount like '%" . $searchValue . "%' or 
            sde_incentive_urban.ck_elite_target like '%" . $searchValue . "%' or 
            sde_incentive_urban.ck_elite_ach like '%" . $searchValue . "%' or 
            sde_incentive_urban.ck_elite_percentage like '%" . $searchValue . "%' or 
            sde_incentive_urban.ck_elite_amount like '%" . $searchValue . "%' or 
            sde_incentive_urban.sec_value_target like '%" . $searchValue . "%' or 
            sde_incentive_urban.sec_value_ach like '%" . $searchValue . "%' or 
            sde_incentive_urban.sec_value_percentage like '%" . $searchValue . "%' or 
            sde_incentive_urban.sec_value_amount like '%" . $searchValue . "%' or 
            sde_incentive_urban.rising_star_outlet_target like '%" . $searchValue . "%' or 
            sde_incentive_urban.rising_star_outlet_ach like '%" . $searchValue . "%' or 
            sde_incentive_urban.rising_star_outlet_percentage like '%" . $searchValue . "%' or 
            sde_incentive_urban.rising_star_outlet_amount like '%" . $searchValue . "%' or 
            sde_incentive_urban.total_amount like '%" . $searchValue . "%' or 
            sde_incentive_urban.pending_last_month like '%" . $searchValue . "%' or 
            sde_incentive_urban.final_amount like '%" . $searchValue . "%' or 
            sde_incentive_urban.remarks like'%" . $searchValue . "%' ) ";
		}


		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

        //# Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('sde_incentive_urban');
		$this->db->where('jc_type', $jc_type_value);
		
	
		$records = $this->db->get()->result();

		$totalRecords = $records[0]->allcount;

		
        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('sde_incentive_urban');
		$this->db->where('jc_type', $jc_type_value);
		

	
		if ($searchQuery != '') $this->db->where($searchQuery);

		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select('sde_incentive_urban.*');
		$this->db->from('sde_incentive_urban');
		$this->db->where('jc_type', $jc_type_value);
	
	
		if ($searchQuery != '') $this->db->where($searchQuery);

		$this->db->order_by('sde_incentive_urban.id', 'desc');  // or desc

		$this->db->limit($rowperpage, $start);

		$records = $this->db->get()->result();
		

		$data = array();

		foreach ($records as $record) {

			$str = $record->mandays_percentage ;
			$mandays =  preg_replace('/%/', '', $str); 

			if( $mandays  >= "90.00" && $mandays <= "99.00"){
				$mandays_per_color ='rgb(237 139 16 / 52%)';
			}elseif( $mandays >= "100.00"){
				$mandays_per_color ='rgb(0 128 0 / 32%)';
			}else{
				$mandays_per_color = '';
			}

			$str1 = $record->orange_salesman_percentage ;
			$orange_salesman =  preg_replace('/%/', '', $str1); 

			if( $orange_salesman  >= "90.00" && $orange_salesman <= "99.00"){
				$orange_salesman_per_color ='rgb(237 139 16 / 52%)';
			}elseif( $orange_salesman >= "100.00"){
				$orange_salesman_per_color ='rgb(0 128 0 / 32%)';
			}else{
				$orange_salesman_per_color = '';
			}

			$str2 = $record->ck_super_star_percentage ;
			$ck_super_star =  preg_replace('/%/', '', $str2); 

			if( $ck_super_star  >= "90.00" && $ck_super_star <= "99.00"){
				$ck_super_star_per_color ='rgb(237 139 16 / 52%)';
			}elseif( $ck_super_star >= "100.00"){
				$ck_super_star_per_color ='rgb(0 128 0 / 32%)';
			}else{
				$ck_super_star_per_color = '';
			}


			$str3 = $record->ck_elite_percentage ;
			$ck_elite =  preg_replace('/%/', '', $str3); 

			if( $ck_elite  >= "90.00" && $ck_elite <= "99.00"){
				$ck_elite_per_color ='rgb(237 139 16 / 52%)';
			}elseif( $ck_elite >= "100.00"){
				$ck_elite_per_color ='rgb(0 128 0 / 32%)';
			}else{
				$ck_elite_per_color = '';
			}


			$str4 = $record->sec_value_percentage ;
			$sec_value =  preg_replace('/%/', '', $str4); 

			if( $sec_value  >= "90.00" && $sec_value <= "99.00"){
				$sec_value_per_color ='rgb(237 139 16 / 52%)';
			}elseif( $sec_value >= "100.00"){
				$sec_value_per_color ='rgb(0 128 0 / 32%)';
			}else{
				$sec_value_per_color = '';
			}


			$str5 = $record->rising_star_outlet_percentage ;
			$rising_star_outlet =  preg_replace('/%/', '', $str5); 

			if( $rising_star_outlet  >= "90.00" && $rising_star_outlet <= "99.00"){
				$rising_star_outlet_per_color ='rgb(237 139 16 / 52%)';
			}elseif( $rising_star_outlet >= "100.00"){
				$rising_star_outlet_per_color ='rgb(0 128 0 / 32%)';
			}else{
				$rising_star_outlet_per_color = '';
			}
			



			$data[] = array(
				"id" => $record->id,
				"zm_name" => $record->zm_name,
				"asm_name" => $record->asm_name,
				"sde_name" => $record->sde_name,
				"market" => $record->market,
				"mandays_target" => $record->mandays_target,
				"mandays_ach" => $record->mandays_ach,
				"mandays_percentage" => $record->mandays_percentage,
				"mandays_per_color" => $mandays_per_color,

				"mandays_amount" => $record->mandays_amount,
				"orange_salesman_target" => $record->orange_salesman_target,
				"orange_salesman_ach" => $record->orange_salesman_ach,
				"orange_salesman_percentage" => $record->orange_salesman_percentage,
				"orange_salesman_per_color" => $orange_salesman_per_color,

				"orange_salesman_amount" => $record->orange_salesman_amount,
				"ck_super_star_target" => $record->ck_super_star_target,
				"ck_super_star_ach" => $record->ck_super_star_ach,
				"ck_super_star_percentage" => $record->ck_super_star_percentage,
				"ck_super_star_per_color" => $ck_super_star_per_color,
				
				"ck_super_star_amount" => $record->ck_super_star_amount,
				"ck_elite_target" => $record->ck_elite_target,
				"ck_elite_ach" => $record->ck_elite_ach,
				"ck_elite_percentage" => $record->ck_elite_percentage,
				"ck_elite_per_color" => $ck_elite_per_color,

				"ck_elite_amount" => $record->ck_elite_amount,
				"sec_value_target" => $record->sec_value_target,
				"sec_value_ach" => $record->sec_value_ach,
				"sec_value_percentage" => $record->sec_value_percentage,
				"sec_value_per_color" => $sec_value_per_color,

				"sec_value_amount" => $record->sec_value_amount,
				"rising_star_outlet_target" => $record->rising_star_outlet_target,
				"rising_star_outlet_ach" => $record->rising_star_outlet_ach,
				"rising_star_outlet_percentage" => $record->rising_star_outlet_percentage,
				"rising_star_outlet_per_color" => $rising_star_outlet_per_color,
				
				"rising_star_outlet_amount" => $record->rising_star_outlet_amount,
				"total_amount" => $record->total_amount,
				"pending_last_month" => $record->pending_last_month,
				"final_amount" => $record->final_amount,
				"remarks" => $record->remarks,

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
	   

	// public function get_slub_parameters($table){
	// 	$this->db->select('*');
	// 	$result = $this->db->get($table);

	// 	return $result->result_array();
	// }
	

	public function get_slub_parameters($postData,$table) {

		$response = array();

		//$show = $postData['status'];
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
			$search_arr[] = " (key_performance_indicies like '%" . $searchValue . "%' or 
            slabs like '%" . $searchValue . "%' or 
            amount like '%" . $searchValue . "%' or 
            measurement like '%" . $searchValue . "%' ) ";
		}

		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

        //# Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from($table);
		$records = $this->db->get()->result();
		$totalRecords = $records[0]->allcount;
		
        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
		$this->db->from($table);

		if ($searchQuery != '') $this->db->where($searchQuery);
		$records = $this->db->get()->result();
		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select('*');
		$this->db->from($table);

		if ($searchQuery != '') $this->db->where($searchQuery);
		$this->db->order_by('id', 'asc');  // or desc
		$this->db->limit($rowperpage, $start);
		$records = $this->db->get()->result();

		$data = array();

		foreach ($records as $record) {
			
			$data[] = array(
				"id" => $record->id,
				"parameters" => $record->key_performance_indicies,
				"slabs" => $record->slabs,
				"amount" => $record->amount,
				"measurement" => $record->measurement,
				"remarks" => $record->remarks,
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
