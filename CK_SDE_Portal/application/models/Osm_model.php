<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Osm_model extends CI_Model{
 

	public function osm_performance_report($postData,$postWhere,$type) {
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
		$jc_year_filter = $postData['jc_year_filter'];
		
		$user_mobile = $this->session->userdata('mobile');
		//# Search
		$search_arr = array();
		$searchQuery = "";

		if ($searchValue != '') {
			$search_arr[] = " ( 
            pc_raw.Billcuts_D__1 like '%" . $searchValue . "%' or 
            pc_raw.Productive_Calls_D__1 like '%" . $searchValue . "%' or 
            pc_raw.Productive_Calls_D__1 like '%" . $searchValue . "%' or 
            pc_raw.SM_NAME like '%" . $searchValue . "%' or 
            pc_raw.ZSM like '%" . $searchValue . "%' or 
            pc_raw.ASM like '%" . $searchValue . "%' or 
            pc_raw.TSO like '%" . $searchValue . "%' or 
            pc_raw.SM_Number like '%" . $searchValue . "%' or 
            pc_raw.TLSD_D__1 like '%" . $searchValue . "%' ) ";
		}

		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

		$month_numeric_ = array('01','02','03','04','05','06','07','08','09','10','11','12');
		$jc_ss = array('JC10','JC11','JC12','JC01','JC02','JC03','JC04','JC05','JC06','JC07','JC08','JC09');
		$get_jc_month = array_combine($month_numeric_,$jc_ss);

        //# Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('pc_raw');
		$this->db->join('osm_performance', 'pc_raw.SM_Number = osm_performance.ssfa_id');
		$this->db->group_by('pc_raw.SM_NAME');
		if($type == 'where'){
			$this->db->where_in('osm_performance.ssfa_id',$postWhere);
			// $this->db->where('pc_raw.Division', 'PC');
		}

		if($jc_year_filter !=""){
			$previous_year_ 	= substr($jc_year_filter, 0, 4);
			$jc_year__ 			= substr($jc_year_filter, -2);
			$sencu_year_ 	= substr($jc_year_filter, 0, 2);

			$get_nxt_year = $previous_year_+1;
			$this->db->where('pc_raw.REPORT_DATE >=', $previous_year_.'-04-01');
			$this->db->where('pc_raw.REPORT_DATE <=', $get_nxt_year.'-03-31');
		}else{

			$date=date_create(date('Y-m-d'));
			if (date_format($date,"m") >= 4) {
				$financial_year_m = date_format($date,"Y");
				$financial_year_p = date_format($date,"Y")+1;
			} else {
				$financial_year_m = date_format($date,"Y")-1;
				$financial_year_p = date_format($date,"Y");
			}
			$this->db->where('pc_raw.REPORT_DATE >=', $financial_year_m.'-04-01');
			$this->db->where('pc_raw.REPORT_DATE <=', $financial_year_p.'-03-31');
		}

		if($jc_type !=""){
			$this->db->where('pc_raw.JC', $jc_type);
			$this->db->group_by('pc_raw.SM_NAME');
		}else{
			$cur_month = date('m');
			$this->db->where('pc_raw.JC', $get_jc_month[$cur_month]);
			$this->db->group_by('pc_raw.SM_NAME');
		}

		$records = $this->db->get();
		$totalRecords = $records->num_rows();
		
        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('pc_raw');
		$this->db->join('osm_performance ', 'pc_raw.SM_Number = osm_performance.ssfa_id');
		if ($searchQuery != '') $this->db->where($searchQuery);
		$this->db->group_by('pc_raw.SM_NAME');
		if($type == 'where'){
			$this->db->where_in('osm_performance.ssfa_id',$postWhere);
			// $this->db->where('pc_raw.Division', 'PC');
		}
		if($jc_year_filter !=""){
			$previous_year_ 	= substr($jc_year_filter, 0, 4);
			$jc_year__ 			= substr($jc_year_filter, -2);
			$sencu_year_ 		= substr($jc_year_filter, 0, 2);

			$get_nxt_year = $previous_year_+1;
			$this->db->where('pc_raw.REPORT_DATE >=', $previous_year_.'-04-01');
			$this->db->where('pc_raw.REPORT_DATE <=', $get_nxt_year.'-03-31');
		}else{

			$date=date_create(date('Y-m-d'));
			if (date_format($date,"m") >= 4) {
				$financial_year_m = date_format($date,"Y");
				$financial_year_p = date_format($date,"Y")+1;
			} else {
				$financial_year_m = date_format($date,"Y")-1;
				$financial_year_p = date_format($date,"Y");
			}
			$this->db->where('pc_raw.REPORT_DATE >=', $financial_year_m.'-04-01');
			$this->db->where('pc_raw.REPORT_DATE <=', $financial_year_p.'-03-31');
		}
		if($jc_type !=""){
			$this->db->where('pc_raw.JC', $jc_type);
			$this->db->group_by('pc_raw.SM_NAME');
		}else{
			$cur_month = date('m');
			$this->db->where('pc_raw.JC', $get_jc_month[$cur_month]);
			$this->db->group_by('pc_raw.SM_NAME');
		}
		$records = $this->db->get();
		$totalRecordwithFilter = $records->num_rows();

        //# Fetch records
		$this->db->select('pc_raw.*');
		$this->db->from('pc_raw');
		$this->db->join('osm_performance ', 'pc_raw.SM_Number = osm_performance.ssfa_id');
		$this->db->group_by('pc_raw.SM_NAME');
		if($type == 'where'){
			$this->db->where_in('osm_performance.ssfa_id',$postWhere);
			// $this->db->where('pc_raw.Division', 'PC');
		}
		if($jc_year_filter !=""){
			$previous_year_ 	= substr($jc_year_filter, 0, 4);
			$jc_year__ 			= substr($jc_year_filter, -2);
			$sencu_year_ 	= substr($jc_year_filter, 0, 2);

			$get_nxt_year = $previous_year_+1;
			$this->db->where('pc_raw.REPORT_DATE >=', $previous_year_.'-04-01');
			$this->db->where('pc_raw.REPORT_DATE <=', $get_nxt_year.'-03-31');
		}else{

			$date=date_create(date('Y-m-d'));
			if (date_format($date,"m") >= 4) {
				$financial_year_m = date_format($date,"Y");
				$financial_year_p = date_format($date,"Y")+1;
			} else {
				$financial_year_m = date_format($date,"Y")-1;
				$financial_year_p = date_format($date,"Y");
			}
			$this->db->where('pc_raw.REPORT_DATE >=', $financial_year_m.'-04-01');
			$this->db->where('pc_raw.REPORT_DATE <=', $financial_year_p.'-03-31');
		}
		if($jc_type !=""){
			$this->db->where('pc_raw.JC', $jc_type);
			$this->db->group_by('pc_raw.SM_NAME');
		}else{
			$cur_month = date('m');
			$this->db->where('pc_raw.JC', $get_jc_month[$cur_month]);
			$this->db->group_by('pc_raw.SM_NAME');
		}
		
		if ($searchQuery != '') $this->db->where($searchQuery);
		if($columnName =="sde_name"){
			$this->db->order_by('TSO',$columnSortOrder);
		}elseif($columnName =="asm_name"){
			$this->db->order_by('ASM',$columnSortOrder);
		}
		$this->db->limit($rowperpage, $start);
		$records = $this->db->get()->result();

		$data = array();
		foreach ($records as $record) {
			
			// if($jc_type == ""){
			// 	// if($this->session->userdata('role_type') == 'TSO' || $jc_type == ""){

			// 	$Billcuts_D__1 = $record->Billcuts_D__1;
			// 	$Billcuts_D__1 = $record->Billcuts_D__1;
			// 	$TLSD_D__1 = $record->TLSD_D__1;
			// 	$productive_calls_sum = $record->Productive_Calls_D__1;
			// 	$eco = $record->overall_eco_Actual;

			// 	$productive_calls_per_day = ($productive_calls_sum % 1) ;//divide pend
			// 	$productivity_percentage = ($productive_calls_sum %100)* 1 ;

			// }else{
				$this->db->select('*');
				$pc_raw_jc1 = $this->db->where('ZSM_Number',$record->ZSM_Number)->where('SM_Number',$record->SM_Number)->where('JC',$record->JC)->get('pc_raw');
				$pc_raw_jc = $pc_raw_jc1->result();
				// $row_count = $pc_raw_jc1->num_rows();

				$pro_calls_sum = array();
				$Billcuts = array();
				$TLSD = array();
				$eco_ = array();
				$attendance_ = array();
				$calls_made = array();

				foreach($pc_raw_jc as $jc_row){
					$pro_calls_sum[] = $jc_row->Productive_Calls_D__1;
					$Billcuts[] = $jc_row->Billcuts_D__1;
					$TLSD[] = $jc_row->TLSD_D__1;
					$eco_ = $jc_row->overall_eco_Actual;
					$attendance_[] = $jc_row->Attendance;
					$calls_made[] = $jc_row->Outlets_Visited_D__1;

				}

				$productive_calls_sum = array_sum($pro_calls_sum);
				// $eco = array_sum($eco_);
				if (in_array("PRESENT", $attendance_)) {
					$att_ = array_count_values($attendance_);
					$attendance =  $att_['PRESENT'];
					$mandays_percent = (($attendance / 24)*100) ;
					$mandays_percentage = round($mandays_percent).'%';
				}else{
					$mandays_percentage = '0%';
					$attendance='0';
					$mandays_percent ='';
				}
				
				$calls_made_sum = array_sum($calls_made);
				$Billcuts_D__1 = array_sum($Billcuts);
				$TLSD_D__1 = array_sum($TLSD);

				try {
					$calls_made_per_day = round(intdiv($calls_made_sum, $attendance));
					$Billcuts_per_day = round(intdiv($Billcuts_D__1, $attendance));
					$TLSD_per_day = round(intdiv($TLSD_D__1, $attendance));

				} catch (DivisionByZeroError $e) {
					$calls_made_per_day = $calls_made_sum;
					$Billcuts_per_day = $calls_made_sum;
					$TLSD_per_day = $calls_made_sum;
				}

				if($calls_made_sum !='0'){
					$productivity_percentages = ($Billcuts_D__1 /$calls_made_sum)* 100 ;
					$productivity_percentage = round($productivity_percentages).'%' ;
				}else{
					$productivity_percentage = '0%' ;
				}

				// $productive_calls_per_day = round($productive_calls_sum / $attendance) ;//divide pend
				// if($calls_made_sum !='0'){
				// 	$productivity_percentages = ($productive_calls_sum /$calls_made_sum)* 100 ;
				// 	$productivity_percentage = round($productivity_percentages).'%' ;
				// }else{
				// 	$productivity_percentage = '0%' ;
				// }
			// }

			$data[] = array(
				"id" => $record->id,
				"asm_name" => $record->ASM,
				"sde_name" => $record->TSO,
				"osm_name" => $record->SM_NAME,
				"eco" => $eco_,
				"planned_man_days" => '24',
				"actual_man_days" => $attendance,
				"per_man_days" => $mandays_percentage,
				"calls_made_sum" => $calls_made_sum,
				"calls_made_per_day" => $calls_made_per_day,
				"productive_calls_sum" => $Billcuts_D__1,
				"productive_calls_per_day" => $Billcuts_per_day,
				"productivity_percentage" => $productivity_percentage,
				// "productive_calls_sum" => $productive_calls_sum,
				// "productive_calls_per_day" => $productive_calls_per_day,
				// "productivity_percentage" => $productivity_percentage,
				"total_bills_cut" => $Billcuts_D__1,
				"bills_per_day" => $Billcuts_per_day,
				"total_lines_sold" => $TLSD_D__1,
				"lines_sm_per_day" => $TLSD_per_day,
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



////calender part
	function fetch_all_event($data){
        $user_mobile = $this->session->userdata('mobile');
        $user_role = $this->session->userdata('role');

		$month_numeric_ = array('01','02','03','04','05','06','07','08','09','10','11','12');
		$jc_ss = array('JC10','JC11','JC12','JC01','JC02','JC03','JC04','JC05','JC06','JC07','JC08','JC09');
		$get_jc_month = array_combine($month_numeric_,$jc_ss);
		$cur_month = date('m');

		$dataa = $this->db->select('*')->order_by('id', 'desc')->limit(1)->get('osm_performance')->row();

        if($user_role == 'ASM' ){
            $this->db->select('pc_raw.*');
			$this->db->join('osm_performance', 'pc_raw.SM_Number = osm_performance.ssfa_id');
            // $this->db->where('pc_raw.Division', 'PC');
			$this->db->where('pc_raw.ASM_Number', $user_mobile);
			$this->db->where('osm_performance.jc_type', $dataa->jc_type);
            $this->db->group_by('pc_raw.id');

			if($data['tso_number'] !=""){
                $this->db->where('pc_raw.TSO_Number', $data['tso_number']);
            }
            if($data['sm_number'] !=""){
                $this->db->where('pc_raw.SM_Number', $data['sm_number']);
            }

        }elseif($user_role == 'ZSM' ){
            $this->db->select('pc_raw.*');
			$this->db->join('osm_performance', 'pc_raw.SM_Number = osm_performance.ssfa_id');
			// $this->db->where('pc_raw.Division', 'PC');
			$this->db->where('pc_raw.ZSM_Number', $user_mobile);
			$this->db->where('osm_performance.jc_type', $dataa->jc_type);
            $this->db->group_by('pc_raw.id');

			if($data['asm_number'] !=""){
                $this->db->where('pc_raw.ASM_Number', $data['asm_number']);
            }
            if($data['tso_number'] !=""){
                $this->db->where('pc_raw.TSO_Number', $data['tso_number']);
            }
            if($data['sm_number'] !=""){
                $this->db->where('pc_raw.SM_Number', $data['sm_number']);
            }

        }elseif($user_role == 'SM'){

            $this->db->select('*');
            $this->db->where('created_by =', $user_mobile);
            // $this->db->group_by('id');
        }elseif($user_role == 'TSO'){
			$this->db->select('pc_raw.*');
			$this->db->join('osm_performance', 'pc_raw.SM_Number = osm_performance.ssfa_id');
			$this->db->where_in('pc_raw.TSO_Number',$user_mobile);
			$this->db->where('osm_performance.jc_type', $dataa->jc_type);
			// $this->db->where('pc_raw.Division', 'PC');
			// $this->db->group_by('pc_raw.SM_Number'); 

			if($data['sm_number'] !=""){
                $this->db->where('pc_raw.SM_Number', $data['sm_number']);
            }
			
		}else{
            $this->db->select('*');
            $this->db->group_by('id');
        }
		$records = $this->db->get('pc_raw');
        // return $records->result();
		return $records->result_array();
    }


	function fetch_data($id){
        $user_mobile = $this->session->userdata('mobile');
        $user_role = $this->session->userdata('role');

        if($user_role == 'ASM' ){
            $this->db->where('id',$id);

        }else if($user_role == 'ZSM' ){
            $this->db->where('id',$id);

        }else if($user_role == 'SM' || $user_role == 'TSO'){
            $this->db->where('id', $id);

        }else{
            $this->db->select();
            $this->db->where('id', $id);
        }
        $records = $this->db->get('pc_raw');
        return $records->result();
    }
	

	public function get_weekly_current_jc($asm,$tso,$sm,$time){
		
		$a = 'JC';
		$user_mobile = $this->session->userdata('mobile');
		$user_role = $this->session->userdata('role_type');

		$data = $this->db->select('*')->order_by('id', 'desc')->limit(1)->get('pc_raw')->row();
		$dataa = $this->db->select('*')->order_by('id', 'desc')->limit(1)->get('osm_performance')->row();

		if($time == 'last'){
			$jc = $data->JC;

		}elseif($time == "before"){
			$jc_t = $data->JC;

			if($jc_t == "JC01"){
				$num_padded = 13;
				$jc = $a.$num_padded;
			}else{
				$jc_number = substr($jc_t, -2);
				$last_one_jc_number = $jc_number-1;
				$num_padded = sprintf("%02d", $last_one_jc_number);
				$jc = $a.$num_padded;
			}
			
			// $before_last_jc = $query->JC;
		}elseif($time == "two_before"){
			$jc_tt = $data->JC;

			if($jc_tt == "JC01"){
				$num_padded = 12;
				$jc = $a.$num_padded;
			}elseif($jc_tt == "JC02"){
				$jc = "JC13";
			}else{
				$jc_number = substr($jc_tt, -2);
				$last_one_jc_number = $jc_number-2;
				$num_padded = sprintf("%02d", $last_one_jc_number);
				$jc = $a.$num_padded;
			}

		}
		if($user_role == "ZSM" || $user_role == "LEADER" || $user_role == "MLEADER" ){

			$this->db->select('pc_raw.*');
			$this->db->from('pc_raw');
			$this->db->join('osm_performance', 'pc_raw.SM_Number = osm_performance.ssfa_id');
			if($user_role == "ZSM"){
				$this->db->where('pc_raw.ZSM_Number',$user_mobile);
			}
			// $this->db->where('osm_performance.jc_type', $dataa->jc_type);
			$this->db->where('pc_raw.JC',$jc);
			$this->db->where('pc_raw.Attendance','PRESENT');
			$this->db->group_by('pc_raw.SM_NAME');
	
			if($asm !=""){
				$this->db->where('pc_raw.ASM_Number',$asm);
				if($tso !=""){
					$this->db->where('pc_raw.TSO_Number',$tso);
					if($sm !=""){
						$this->db->where('pc_raw.SM_Number',$sm);
					}
				}
			}
				// $this->db->where('pc_raw.Division', 'PC');
			
		}elseif($user_role == "ASM"){
		
			$this->db->select('pc_raw.*');
			$this->db->from('pc_raw');
			$this->db->join('osm_performance', 'pc_raw.SM_Number = osm_performance.ssfa_id');
			$this->db->where('pc_raw.ASM_Number',$user_mobile);
			// $this->db->where('osm_performance.jc_type', $dataa->jc_type);
			$this->db->where('pc_raw.JC',$jc);
			$this->db->where('pc_raw.Attendance','PRESENT');
			$this->db->group_by('pc_raw.SM_NAME');
	
			if($tso !=""){
				$this->db->where('pc_raw.TSO_Number',$tso);
				if($sm !=""){
					$this->db->where('pc_raw.SM_Number',$sm);
				}
			}
			// $this->db->where('pc_raw.Division', 'PC');
		
		}elseif($user_role == "TSO"){

			$this->db->select('pc_raw.*');
			$this->db->from('pc_raw');
			$this->db->join('osm_performance', 'pc_raw.SM_Number = osm_performance.ssfa_id');
			$this->db->where('pc_raw.TSO_Number',$user_mobile);
			// $this->db->where('osm_performance.jc_type', $dataa->jc_type);
			$this->db->where('pc_raw.JC',$jc);
			$this->db->where('pc_raw.Attendance','PRESENT');
			$this->db->group_by('pc_raw.SM_NAME');
	
			if($sm !=""){
				$this->db->where('pc_raw.SM_Number',$sm);
			}
			// $this->db->where('pc_raw.Division', 'PC');
		}
		
		$records = $this->db->get();
		$res = $records->result();
		$count = $records->num_rows();
		// print_r($res);
		// exit;

		$data = array();
		foreach ($res as $record) {
			$mandays_wk1 = $this->db->select('*')->where('ASM',$record->ASM)->where('SM_NAME',$record->SM_NAME)->where('JC',$jc)->where('JC_Week','WK01')->get('pc_raw')->result();

			$mandays_wk2 = $this->db->select('*')->where('ASM',$record->ASM)->where('SM_NAME',$record->SM_NAME)->where('JC',$jc)->where('JC_Week','WK02')->get('pc_raw')->result();
			
			$mandays_wk3 = $this->db->select('*')->where('ASM',$record->ASM)->where('SM_NAME',$record->SM_NAME)->where('JC',$jc)->where('JC_Week','WK03')->get('pc_raw')->result();

			$mandays_wk4 = $this->db->select('*')->where('ASM',$record->ASM)->where('SM_NAME',$record->SM_NAME)->where('JC',$jc)->where('JC_Week','WK04')->get('pc_raw')->result();

			if( !empty($mandays_wk1)){

				$mandays_wk1_1 = array();
				$pro_calls_sum = array();
				$calls_made = array();

				foreach($mandays_wk1 as $mandays_wk1){
					$mandays_wk1_1[] = $mandays_wk1->Attendance;
					// $pro_calls_sum[] = $mandays_wk1->Productive_Calls_D__1;
					$pro_calls_sum[] = $mandays_wk1->Billcuts_D__1;
					$calls_made[] = $mandays_wk1->Outlets_Visited_D__1;
				}
				$calls_made_sum = array_sum($calls_made);
				$productive_calls_sum = array_sum($pro_calls_sum);

				if($calls_made_sum != "0"){
					$productivity_percentages = ($productive_calls_sum /$calls_made_sum)* 100 ;
					$productivity_percentage_wk1 = round($productivity_percentages).'%' ;
				}else{
					$productivity_percentage_wk1 = '0%';
				}

				if (in_array("PRESENT", $mandays_wk1_1)) {
					$att_ = array_count_values($mandays_wk1_1);
					$attendance =  $att_['PRESENT'];
	
					$mandays_percent = (($attendance / 6)*100) ;

					if( 100 < $mandays_percent){
						$mandays_percentage_wk1 = '100%';
					}else{
						$mandays_percentage_wk1 = round($mandays_percent).'%';
					}
				}else{
					$mandays_percentage_wk1 = '0%';
				}
				
			}else{
				$mandays_percentage_wk1 = '0%';
				$productivity_percentage_wk1 = '0%';
			}

			if( !empty($mandays_wk2)){
				$mandays_wk2_2 = array();
				$pro_calls_sum2 = array();
				$calls_made2 = array();

				foreach($mandays_wk2 as $mandays_wk2){
					$mandays_wk2_2[] = $mandays_wk2->Attendance;
					$pro_calls_sum2[] = $mandays_wk2->Billcuts_D__1;
					$calls_made2[] = $mandays_wk2->Outlets_Visited_D__1;
				}
				$calls_made_sum2 = array_sum($calls_made2);
				$productive_calls_sum2 = array_sum($pro_calls_sum2);

				if($calls_made_sum2 != "0"){
					$productivity_percentages2 = ($productive_calls_sum2 /$calls_made_sum2)* 100 ;
					$productivity_percentage_wk2 = round($productivity_percentages2).'%' ;
				}else{
					$productivity_percentage_wk2 = '0%';
				}

				if (in_array("PRESENT", $mandays_wk2_2)) {
					$att_2 = array_count_values($mandays_wk2_2);
					$attendance2 =  $att_2['PRESENT'];
					$mandays_percent2 = (($attendance2 / 6)*100) ;

					if( 100 < $mandays_percent2){
						$mandays_percentage_wk2 = '100%';
					}else{
						$mandays_percentage_wk2 = round($mandays_percent2).'%';
					}

				}else{
					$mandays_percentage_wk2 = '0%';
				}

			}else{
				$mandays_percentage_wk2 = '0%';
				$productivity_percentage_wk2 = '0%';
			}

			if( !empty($mandays_wk3)){
				$mandays_wk3_3 = array();
				$pro_calls_sum3 = array();
				$calls_made3 = array();

				foreach($mandays_wk3 as $mandays_wk3){
					$mandays_wk3_3[] = $mandays_wk3->Attendance;
					$pro_calls_sum3[] = $mandays_wk3->Billcuts_D__1;
					// $pro_calls_sum3[] = $mandays_wk3->Productive_Calls_D__1;
					$calls_made3[] = $mandays_wk3->Outlets_Visited_D__1;
				}
				$calls_made_sum3 = array_sum($calls_made3);
				$productive_calls_sum3 = array_sum($pro_calls_sum3);

				if($calls_made_sum3 != "0"){
					$productivity_percentages3 = ($productive_calls_sum3 /$calls_made_sum3)* 100 ;
					$productivity_percentage_wk3 = round($productivity_percentages3).'%' ;
				}else{
					$productivity_percentage_wk3 = '0%';
				}

				if (in_array("PRESENT", $mandays_wk3_3)) {
					$att_3 = array_count_values($mandays_wk3_3);
					$attendance3 =  $att_3['PRESENT'];
					$mandays_percent3 = (($attendance3 / 6)*100) ;

					if( 100 < $mandays_percent3){
						$mandays_percentage_wk3 = '100%';
					}else{
						$mandays_percentage_wk3 = round($mandays_percent3).'%';
					}

				}else{
					$mandays_percentage_wk3 = '0%';
				}

			}else{
				$mandays_percentage_wk3 = '0%';
				$productivity_percentage_wk3 = '0%';
			}

			if( !empty($mandays_wk4)){
				$mandays_wk4_4 = array();
				$pro_calls_sum4 = array();
				$calls_made4 = array();

				foreach($mandays_wk4 as $mandays_wk4){
					$mandays_wk4_4[] = $mandays_wk4->Attendance;
					$pro_calls_sum4[] = $mandays_wk4->Billcuts_D__1;
					$calls_made4[] = $mandays_wk4->Outlets_Visited_D__1;
				}
				$calls_made_sum4 = array_sum($calls_made4);
				$productive_calls_sum4 = array_sum($pro_calls_sum4);

				if($calls_made_sum4 != "0"){
					$productivity_percentages4 = ($productive_calls_sum4 /$calls_made_sum4)* 100 ;
					$productivity_percentage_wk4 = round($productivity_percentages4).'%' ;
				}else{
					$productivity_percentage_wk4 = '0%';
				}

				if (in_array("PRESENT", $mandays_wk4_4)) {
					$att_4 = array_count_values($mandays_wk4_4);
					$attendance4 =  $att_4['PRESENT'];
					$mandays_percent4 = (($attendance4 / 6)*100) ;

					if( 100 < $mandays_percent4){
						$mandays_percentage_wk4 = '100%';
					}else{
						$mandays_percentage_wk4 = round($mandays_percent4).'%';
					}

				}else{
					$mandays_percentage_wk4 = '0%';
				}
			}else{
				$mandays_percentage_wk4 = '0%';
				$productivity_percentage_wk4 = '0%';
			}

			$data[] = array(
				"id" => $record->id,
				"ASM_Name" 		=> $record->ASM,
				"SDE_Name" 		=> $record->TSO,
				"SM_Name" 		=> $record->SM_NAME,
				"mandays_wk1" 	=> $mandays_percentage_wk1,
				"mandays_wk2" 	=> $mandays_percentage_wk2,
				"mandays_wk3" 	=> $mandays_percentage_wk3,
				"mandays_wk4" 	=> $mandays_percentage_wk4,
				"productive_wk1" => $productivity_percentage_wk1,
				"productive_wk2" => $productivity_percentage_wk2,
				"productive_wk3" => $productivity_percentage_wk3,
				"productive_wk4" => $productivity_percentage_wk4,
			);
		}

		$response = array(
			"result" => $data,
			"last_jc" => $jc,
			"current_jc_count" => $count
		);
		return $response;
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



	
}

?>
