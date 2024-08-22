<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class MastersModel extends CI_Model {
		public function __construct()
		{
			$this->load->database();
		}


		public function data_add($table, $val, $mobile)
		{
			$this->db->where('mobile',$mobile);
			$quer = $this->db->get('users')->row();

			if(empty($quer)){
				$this->db->insert($table, $val);
				$message = "success";
			}else{
				$message = "duplicate_entry";
			}
			
			return $message;
		}
		
		public function insert($data) {
			if($data){
				$res = $this->db->insert_batch('beat_mkt_master',$data);
				if($res){
					return TRUE;
				}else{
					return FALSE;
				}
			}
			else{
				return FALSE;
			}
		}

		public function update($data,$beat_code) {
			if($data){
				$i=0;
				foreach($data as $d){
					$data_arr=array(
						'beat_code' => $beat_code[$i]['beat_code'],
                        'beat_name' => $d['beat_name'],
                        'sm_mobile' => $d['sm_mobile'],
						'business'  => $d['business']
					);
					$this->db->where('beat_code',$beat_code[$i]['beat_code']);
					$res = $this->db->update('beat_mkt_master',$data_arr);
					$i++;
                }
				if($res){
					return TRUE;
				}else{
					return FALSE;
				}
			}
			else{
				return FALSE;
			}
		}

		public function beat_exists($beat_code)
		{
			$this->db->where('beat_code',$beat_code);
			$query = $this->db->get('beat_mkt_master');
			if ($query->num_rows() > 0){
				return true;
			}
			else{
				return false;
			}
		}

		public function delete_beat($beat_code) {
			$this->db->where('beat_code',$beat_code);
			$delete = $this->db->delete('beat_mkt_master');
		}

		public function get_beat_optimize() {
			$this->db->select('*');
			$this->db->from('beat_mkt_master');    
			$this->db->order_by('id', 'asc');
			$record = $this->db->get();
			$records = $record->result_array();
			// print_r($records);die;
			return $records;
		}
		public function delete_masters($id,$table) {
			$data = explode(",",$id);
			foreach ($data as $key => $value) {
				$this->db->where('id',$value);
				$delete = $this->db->delete($table);
			}
			if($delete){
				return 'success';
			}else{
				return 'failed';
			}
				
		}
		
		public function delete_mastersdata($business,$table){
			$this->db->where('division',$business);
			$delete = $this->db->delete($table);

			$this->db->where('business', $business);
			$this->db->where('role','!=', "Division Head");
			$getHoleData = $this->db->get('users')->result_array();
			
			if(!empty($getHoleData)){
				foreach($getHoleData as $k => $data){
					$busiVal = array();
					$busiVal = array(
						'username' => $data['username'],
						'mobile'   => $data['mobile'],
						'email'    => $data['email'],
						'role'     => $data['role'],
						'business' => $data['business']
					);
					$this->db->insert('delete_user_history', $busiVal);
				}
			}

			$this->db->where('business',$business);
			$this->db->where('role','!=', "Division Head");
			$delete = $this->db->delete('users');

			if($delete){
				return 'success';
			}else{
				return 'failed';
			}
		}

		public function delete_data($table){
			// $this->db->where('division',$business);
			$delete = $this->db->truncate($table);

			$this->db->where('business',$business);
			$this->db->where('role', "ZSM");
			$this->db->or_where('role', "TSO");
			$this->db->or_where('role', "SM");
			$this->db->or_where('role', "ASM");
			$getHoleData = $this->db->get('users')->result_array();
			if(!empty($getHoleData)){
				foreach($getHoleData as $k => $data){
					$busiVal = array();
					$busiVal = array(
						'username' => $data['username'],
						'mobile'   => $data['mobile'],
						'email'    => $data['email'],
						'role'     => $data['role'],
						'business' => $data['business']
					);
					$this->db->insert('delete_user_history', $busiVal);
				}
			}


			$this->db->where('business',$business);
			$this->db->where('role', "ZSM");
			$this->db->or_where('role  !=', "TSO");
			$this->db->where('role  !=', "SM");
			$this->db->where('role  !=', "ASM");
			$delete = $this->db->delete('users');

			if($delete){
				return 'success';
			}else{
				return 'failed';
			}
		}
		public function delete_user($id,$mobile){
			
			$sm_data = $this->db->where('sm_number',$mobile);
						$this->db->from('masters')->get();
			
			if($sm_data){
				$this->db->where('sm_number',$mobile);
				$delete = $this->db->delete('masters');
			}

			 $this->db->where('asm_number',$mobile);
			 $asm_data =$this->db->from('masters')->get();
			
			if($asm_data){
				// if($asm_data->num_rows() == 1){
					$this->db->where('asm_number',$mobile);
					$delete = $this->db->delete('masters');
				// }
				
			}

			 $this->db->where('tso_number',$mobile);
			 $sde_data =$this->db->from('masters')->get();
			
			if($sde_data){
				// if($sde_data->num_rows() == 1){
					$this->db->where('tso_number',$mobile);
					$delete = $this->db->delete('masters');
				// }
				
			}

			$this->db->where('zsm_number',$mobile);
			$zsm_data = $this->db->from('masters')->get();
			
			if($zsm_data){
				// if($zsm_data->num_rows() == 1){
					$this->db->where('zsm_number',$mobile);
					$delete = $this->db->delete('masters');
				// }
				
			}

			$this->db->where('id', $id);
			$getudata = $this->db->get('users')->row();

			$val = array(
				'username' => $getudata->username,
				'mobile'   => $getudata->mobile,
				'email'    => $getudata->email,
				'role'     => $getudata->role,
				'business' => $getudata->business
			);
			
			$this->db->insert('delete_user_history', $val);

			$this->db->where('id',$id);
			$delete = $this->db->delete('users');
			if($delete){
				return 'success';
			}else{
				return 'failed';
			}
		}

		
		public function delete_rsmastersdata($business,$table){
			$this->db->where('business',$business);
			$delete = $this->db->delete($table);

			if($delete){
				return 'success';
			}else{
				return 'failed';
			}
		}
		public function get_data($id){
			$this->db->where('id',$id);
			$data = $this->db->from('masters')->get();

			return $data->row();
		}
		public function get_user_data($users){
			$sm_data = $this->db->where('sm_number',$users->sm_number);
						$this->db->from('masters')->get();
			if($sm_data){
				$this->db->where('mobile', $users->sm_number);
				$getudata = $this->db->get('users')->row();
	
				$val = array(
					'username' => $getudata->username,
					'mobile'   => $getudata->mobile,
					'email'    => $getudata->email,
					'role'     => $getudata->role,
					'business' => $getudata->business
				);
				
				$this->db->insert('delete_user_history', $val);

				$this->db->where('mobile',$users->sm_number);
				$delete = $this->db->delete('users');
			}

			$this->db->where('asm_number',$users->asm_number);
			$asm_data =$this->db->from('masters')->get();
			if($asm_data){
				if($asm_data->num_rows() == 1){
					$this->db->where('mobile', $users->asm_number);
					$getasmudata = $this->db->get('users')->row();
		
					$val1 = array(
						'username' => $getasmudata->username,
						'mobile'   => $getasmudata->mobile,
						'email'    => $getasmudata->email,
						'role'     => $getasmudata->role,
						'business' => $getasmudata->business
					);
					$this->db->insert('delete_user_history', $val1);

					$this->db->where('mobile',$users->asm_number);
					$delete = $this->db->delete('users');
				}
				
			}

			 $this->db->where('tso_number',$users->tso_number);
			 $sde_data =$this->db->from('masters')->get();
			
			if($sde_data){
				if($sde_data->num_rows() == 1){
					$this->db->where('mobile', $users->tso_number);
					$gettsoudata = $this->db->get('users')->row();
		
					$val2 = array(
						'username' => $gettsoudata->username,
						'mobile'   => $gettsoudata->mobile,
						'email'    => $gettsoudata->email,
						'role'     => $gettsoudata->role,
						'business' => $gettsoudata->business
					);
					$this->db->insert('delete_user_history', $val2);

					$this->db->where('mobile',$users->tso_number);
					$delete = $this->db->delete('users');
				}
				
			}

			$this->db->where('zsm_number',$users->zsm_number);
			$zsm_data = $this->db->from('masters')->get();
			
			if($zsm_data){
				if($zsm_data->num_rows() == 1){
					$this->db->where('mobile', $users->zsm_number);
					$getzsmudata = $this->db->get('users')->row();
		
					$val3 = array(
						'username' => $getzsmudata->username,
						'mobile'   => $getzsmudata->mobile,
						'email'    => $getzsmudata->email,
						'role'     => $getzsmudata->role,
						'business' => $getzsmudata->business
					);
					$this->db->insert('delete_user_history', $val3);

					$this->db->where('mobile',$users->zsm_number);
					$delete = $this->db->delete('users');
				}
				
			}
			// $this->db->where('id',$id);
			// $delete = $this->db->delete('users');
			if($delete){
				return 'success';
			}else{
				return 'failed';
			}
		}
		public function insert_osm($data) {
			if($data){
				$res = $this->db->insert_batch('osm_performance',$data);
				if($res){
					return TRUE;
				}else{
					return FALSE;
				}
			}
			else{
				return FALSE;
			}
		}

		public function update_osm($data,$osm_data) {
			if($data){
				$i=0;
				foreach($data as $d){
					$data_arr=array(
						'ssfa_id' => $d['ssfa_id'],
                        'jc_type' => $d['jc_type'],
                        'fin_year' => $d['fin_year'],
                        'osm_name' => $d['osm_name'],
                        'sm_type' => $d['sm_type'],
                        'zsm' => $d['zsm'],
						'asm'  => $d['asm'],
						'sde'  => $d['sde'],
						'sde_id'  => $d['sde_id'],
						'bc_target'  => $d['bc_target'],
						'tlsd_target'  => $d['tlsd_target'],
						'eco_target'  => $d['eco_target'],
						'bc_achivement'  => $d['bc_achivement'],
						'tlsd_achivement'  => $d['tlsd_achivement'],
						'eco_achivement'  => $d['eco_achivement'],
						'bc_percentage'  => $d['bc_percentage'],
						'tlsd_percentage'  => $d['tlsd_percentage'],
						'eco_percentage'  => $d['eco_percentage'],
					);
					$this->db->where('ssfa_id',$osm_data[$i]['ssfa_id']);
					$this->db->where('jc_type',$osm_data[$i]['jc_type']);
					$this->db->where('fin_year',$osm_data[$i]['fin_year']);
					$res = $this->db->update('osm_performance',$data_arr);
					$i++;
                }
				if($res){
					return TRUE;
				}else{
					return FALSE;
				}
			}
			else{
				return FALSE;
			}
		}

		public function osm_exists($ssfa_id,$jc_type,$fin_year)
		{
			$this->db->where('ssfa_id',$ssfa_id);
			$this->db->where('jc_type',$jc_type);
			$this->db->where('fin_year',$fin_year);
			$query = $this->db->get('osm_performance');
			if ($query->num_rows() > 0){
				return true;
			}
			else{
				return false;
			}
		}

		public function delete_osm($ssfa_id,$jc_type,$fin_year) {
			$this->db->where('ssfa_id',$ssfa_id);
			$this->db->where('jc_type',$jc_type);
			$this->db->where('fin_year',$fin_year);
			$delete = $this->db->delete('osm_performance');
		}

		public function get_osm() {
			$this->db->select('*');
			$this->db->from('osm_performance');    
			$this->db->order_by('id', 'asc');
			$record = $this->db->get();
			$records = $record->result_array();
			return $records;
		}

		public function insert_rs($data) {
			if($data){
				$res = $this->db->insert_batch('rs_mkt_master',$data);
				if($res){
					return TRUE;
				}else{
					return FALSE;
				}
			}
			else{
				return FALSE;
			}
			
		}

		public function update_rs($data,$rs_code) {

			if($data){
				$i=0;
				foreach($data as $d){
					$data_arr=array(
						'rs_code' => $rs_code[$i]['rs_code'],
                        'rs_name' => $d['rs_name'],
                        'sm_mobile' => $d['sm_mobile'],
                        'tso_name' => $d['tso_name'],
                        'tso_mobile' => $d['tso_mobile'],
                        'status' => $d['status'],
						'business'  => $d['business'],
						'region' =>$d['region'],
						'state_name' => $d['state_name'],
						'district_name' => $d['district_name'],
						'town_name' => $d['town_name'],
						'town_code' => $d['town_code']
					);

					$this->db->where('rs_code',$rs_code[$i]['rs_code']);
					$this->db->where('sm_mobile',$rs_code[$i]['sm_mobile']);
					$res = $this->db->update('rs_mkt_master',$data_arr);
					$i++;

                }
				if($res){
					return TRUE;
				}else{
					return FALSE;
				}
			}
			else{
				return FALSE;
			}
		}

		public function rs_exists($rs_code,$sm_mobile)
		{
			$this->db->where('rs_code',$rs_code);
			$this->db->where('sm_mobile',$sm_mobile);
			$query = $this->db->get('rs_mkt_master');
			if ($query->num_rows() > 0){
				return true;
			}
			else{
				return false;
			}
		}

		public function check_sde_business($tso_mobile,$sm_mobile,$business)
		{
			$this->db->where('tso_number',$tso_mobile);
			$this->db->where('sm_number',$sm_mobile);
			$this->db->where('division',$business);
			$query = $this->db->get('masters');
			if ($query->num_rows() > 0){
				return true;
			}
			else{
				return false;
			}
		}
		public function check_sm_mapping($tso_mobile,$sm_mobile)
		{
			$this->db->where('tso_number',$tso_mobile);
			$this->db->where('sm_number',$sm_mobile);
			$query = $this->db->get('masters');
			if ($query->num_rows() > 0){
				return true;
			}
			else{
				return false;
			}
		}
		public function check_sde_exists($mobile,$col)
		{
			$this->db->where($col,$mobile);
			$query = $this->db->get('masters');
			if ($query->num_rows() > 0){
				return true;
			}
			else{
				return false;
			}
		}
		public function delete_rs($rs_code,$sm_mobile) {
			$this->db->where('rs_code',$rs_code);
			$this->db->where('sm_mobile',$sm_mobile);
			$delete = $this->db->delete('rs_mkt_master');
		}

		public function get_rs() {
			$this->db->select('*');
			$this->db->from('rs_mkt_master');    
			$this->db->order_by('id', 'asc');
			$record = $this->db->get();
			$records = $record->result_array();
			return $records;
		}

		public function get_rs_bydiv($where) {
			$this->db->select('*');
			$this->db->from('rs_mkt_master');
			$this->db->where('business',$where);    
			$this->db->order_by('id', 'asc');
			$record = $this->db->get();
			$records = $record->result_array();
			return $records;
		}

		public function insert_m($data) {
			if($data){
				$res = $this->db->insert_batch('masters',$data);
				if($res){
					return TRUE;
				}else{
					return FALSE;
				}
			}
			else{
				return TRUE;
			}			
		}

		public function update_m($data,$exist) {
			if($data){
				$i=0;
				foreach($data as $d){
					$data_arr=array(
						'sm_number' => $d['sm_number'],
                        'zsm_number' => $d['zsm_number'],
                        'asm_number' => $d['asm_number'],
                        'tso_number' => $d['tso_number'],
						'sm_email' => $d['sm_email'],
                        'zsm_email' => $d['zsm_email'],
                        'asm_email' => $d['asm_email'],
                        'sm_email' => $d['sm_email'],
                        'division' => $d['division'],
                        'region' => $d['region'],
						'asm'  => $d['asm'],
						'tso'  => $d['tso'],
						'sm'  => $d['sm'],
						'zsm'  => $d['zsm'],
						'va'  => $d['va'],
						'va_number'  => $d['va_number'],
						'si'  => $d['si'],
						'si_number'  => $d['si_number']
					);
					$this->db->where('zsm_number',$exist[$i]['zsm_number']);
					$this->db->where('asm_number',$exist[$i]['asm_number']);
					$this->db->where('tso_number',$exist[$i]['tso_number']);
					$this->db->where('sm_number',$exist[$i]['sm_number']);
					$res = $this->db->update('masters',$data_arr);
					$i++;
                }
				if($res){
					return TRUE;
				}else{
					return FALSE;
				}
			}
			else{
				return FALSE;
			}
		}

		public function update_m_bysm($data,$exist,$by) {
			// print_r($data);die;
			if($data){
				$i=0;
				foreach($data as $d){
					$data_arr=array(
						'sm_number' => $d['sm_number'],
                        'zsm_number' => $d['zsm_number'],
                        'asm_number' => $d['asm_number'],
                        'tso_number' => $d['tso_number'],

						'tso_email' => $d['tso_email'],
                        'zsm_email' => $d['zsm_email'],
                        'asm_email' => $d['asm_email'],
                        'sm_email' => $d['sm_email'],

                        'division' => $d['division'],
                        'region' => $d['region'],
						'asm'  => $d['asm'],
						'tso'  => $d['tso'],
						'sm'  => $d['sm'],
						'zsm'  => $d['zsm'],
						'va'  => $d['va'],
						'va_number'  => $d['va_number'],
						'si'  => $d['si'],
						'si_number'  => $d['si_number']
					);
					print_r($data_arr);
					if($by == 'sm'){
						$this->db->where('sm_number',$exist[$i]['sm_number']);
					}elseif ($by == 'asm') {
						# code...
						$this->db->where('sm_number',$exist[$i]['sm_number']);
						$this->db->where('asm_number',$exist[$i]['asm_number']);

					}elseif ($by == 'sde') {
						# code...
						$this->db->where('sm_number',$exist[$i]['sm_number']);
						$this->db->where('asm_number',$exist[$i]['asm_number']);
						$this->db->where('tso_number',$exist[$i]['sm_number']);


					}
					$res = $this->db->update('masters',$data_arr);
					if($res){
						print_r(4535345435435);
					}
					die;
					$i++;
                }
				if($res){
					return TRUE;
				}else{
					return FALSE;
				}
			}
			else{
				return FALSE;
			}
		}

		
		public function zsm_exist($zsm_mobile,$zsm_data,$type){
			// print_r($zsm_data);die;
			$this->db->where('mobile',$zsm_mobile);
			$query = $this->db->get('users');
			if ($query->num_rows() == 0){
				$this->db->insert('users',$zsm_data);
				return false;
			}
			else{
				$this->db->select('*');
				$this->db->from('users');
				$this->db->where('mobile',$zsm_mobile);
				$query1 = $this->db->get();
				$data = $query1->row();
				
				// if(strtolower($zsm_data['business']) != strtolower($data->business )){
				// 	return 'business_mismatch';
				// }else 
				
				if ($data->business != '' && $data->business != null) {
					$ex_business = [];
				
					if (!is_array($data->business)) {
						$decoded_business = json_decode($data->business, true); 
						if (is_array($decoded_business)) {
							$ex_business = $decoded_business;
						} else {
							$ex_business[] = $data->business;
						}
					} else {
						$ex_business = $data->business;
					}
				
				
					if (isset($zsm_data['business']) && !in_array($zsm_data['business'], $ex_business)) {
						$ex_business[] = strtoupper($zsm_data['business']); 
					}
				
					$updated_business = json_encode($ex_business);
				
					$this->db->where('mobile', $zsm_mobile);
					$this->db->update('users', array('business' => $updated_business));
				
					return 'business_updated';
				}				
				else 
				if(strtolower($zsm_data['role']) != strtolower($data->role)){
					return 'role_mismatch';
				}else{
					return false;
				}
			}
		}

		public function asm_exist($ssm_mobile,$asm_data,$type){
			$this->db->where('mobile',$ssm_mobile);
			$query = $this->db->get('users');
			if ($query->num_rows() == 0){
				$this->db->insert('users',$asm_data);
				return false;
			}
			else{
				$this->db->select('*');
				$this->db->from('users');
				$this->db->where('mobile',$ssm_mobile);
				$query1 = $this->db->get();
				$data = $query1->row();
				if($type != 'add'){
					// print_r(1);
					$this->db->where('mobile',$ssm_mobile);
					$this->db->set('business',$asm_data['business']);
					$this->db->update('users');
				}
				if(strtolower($asm_data['business']) != strtolower($data->business )){
					return 'business_mismatch';
				}else if(strtolower($asm_data['role']) != strtolower($data->role)){
					return 'role_mismatch';
				}else{
					return false;
				}
			}
		}

		public function tso_exist($tso_mobile,$tso_data,$type){
			$this->db->where('mobile',$tso_mobile);
			$query = $this->db->get('users');
			if ($query->num_rows() == 0){
				$this->db->insert('users',$tso_data);
				return false;
			}
			else{
				$this->db->select('*');
				$this->db->from('users');
				$this->db->where('mobile',$tso_mobile);
				$query1 = $this->db->get();
				$data = $query1->row();
				if($type != 'add'){
					$this->db->where('mobile',$tso_mobile);
					$this->db->set('business',$tso_data['business']);
					$this->db->update('users');
				}
				if(strtolower($tso_data['business']) != strtolower($data->business )){
					return 'business_mismatch';
				}else if(strtolower($tso_data['role']) != strtolower($data->role)){
				}else if(strtolower($tso_data['role']) != strtolower($data->role)){
					return 'role_mismatch';
				}else{
					return false;
				}
			}
		}

		public function sm_exist($sm_mobile,$sm_data,$type){
			$this->db->where('mobile',$sm_mobile);
			$query = $this->db->get('users');
			if ($query->num_rows() == 0){
				$this->db->insert('users',$sm_data);
				return false;
			}
			else{
				$this->db->select('*');
				$this->db->from('users');
				$this->db->where('mobile',$sm_mobile);
				$query1 = $this->db->get();
				$data = $query1->row();
				if($type != 'add'){
					$this->db->where('mobile',$sm_mobile);
					$this->db->set('business',$sm_data['business']);
					$this->db->update('users');
				}
				if(strtolower($sm_data['business']) != strtolower($data->business )){
					return 'business_mismatch';
				}else if(strtolower($sm_data['role']) != strtolower($data->role)){
					return 'role_mismatch';
				}else{
					return false;
				}
			}
		}

		public function m_exist($zsm_mobile,$asm_mobile,$tso_mobile,$sm_mobile)
		{
			$this->db->where('zsm_number',$zsm_mobile);
			$this->db->where('asm_number',$asm_mobile);
			$this->db->where('tso_number',$tso_mobile);
			$this->db->where('sm_number',$sm_mobile);
			$query = $this->db->get('masters');
			if ($query->num_rows() > 0){
				return true;
			}
			else{
				return false;
			}
		}

		public function sm_mapping_exist($sm_mobile){
			
			$this->db->where('sm_number',$sm_mobile);
			$query = $this->db->get('masters');
			if ($query->num_rows() > 0){
				return true;
			}
			else{
				return false;
			}
		}
		public function asm_mapping_exist($asm_mobile,$sde_number,$zsm_number){
			
			$this->db->where('zsm_number !=',$zsm_number);
			$this->db->where('asm_number',$asm_mobile);
			// $this->db->where('tso_number',$sde_number);
			$query = $this->db->get('masters');
			// print_r("query");
			// print_r($query);
			if ($query->num_rows() > 0){
				return true;
			}
			else{
				return false;
			}
		}

		public function sde_mapping_exist($sde_number,$sm_number,$asm_mobile){
			
			$this->db->where('asm_number !=',$asm_mobile);
			// $this->db->where('sm_number',$sm_number);
			$this->db->where('tso_number',$sde_number);
			$query = $this->db->get('masters');
			if ($query->num_rows() > 0){
				return true;
			}
			else{
				return false;
			}
		}

		public function delete_m($zsm_mobile,$asm_mobile,$tso_mobile,$sm_mobile) {
			$this->db->where('zsm_number',$zsm_mobile);
			$this->db->where('asm_number',$asm_mobile);
			$this->db->where('tso_number',$tso_mobile);
			$this->db->where('sm_number',$sm_mobile);
			$delete = $this->db->delete('masters');
		}

		public function get_masters() {
			$this->db->select('*');
			$this->db->from('masters');    
			$this->db->order_by('id', 'asc');
			$record = $this->db->get();
			$records = $record->result_array();
			return $records;
		}

		public function get_masters_bydiv($where) {
			$this->db->select('*');
			$this->db->from('masters');
			$this->db->where('division',$where);    
			$this->db->order_by('id', 'asc');
			$record = $this->db->get();
			$records = $record->result_array();
			return $records;
		}

		public function get_users() {
			$this->db->select('*');
			$this->db->from('users');    
			$this->db->order_by('id', 'asc');
			$record = $this->db->get();
			$records = $record->result_array();
			return $records;
		}

		//update users table
		public function update_user($id,$mobile,$username){
			$this->db->where('id',$id);
			$this->db->set('username',$username);
			$this->db->set('mobile',$mobile);
            $query = $this->db->update('users');
            if ($query){
                return true;
            }
            else{
                return false;
            }
		}

		// update beat master
		public function update_beat_masters($id,$mobile,$cur_mobile){
			$this->db->where('sm_mobile',$cur_mobile);
            $this->db->set('sm_mobile',$mobile);
            $query = $this->db->update('beat_mkt_master');
            if ($query){
                return true;
            }
            else{
                return false;
            }
		}

		//update osm performance
		public function update_osm_performance($mobile,$cur_mobile,$username){
            $this->db->where('ssfa_id',$cur_mobile);
            $this->db->set('ssfa_id',$mobile);
            $this->db->set('osm_name',$username);
            $query = $this->db->update('osm_performance');
            if ($query){
                return true;
            }
            else{
                return false;
            }
        }

		//update masters
		public function update_masters($id,$mobile,$cur_mobile,$username){
            $this->db->where('zsm_number',$cur_mobile);
            $zsm = $this->db->get('masters');
			if ($zsm->num_rows() > 0){
				$this->db->where('zsm_number',$cur_mobile);
                $this->db->set('zsm_number',$mobile);
                $this->db->set('zsm',$username);
                $zsm = $this->db->update('masters');
			}
			$this->db->where('asm_number', $cur_mobile);
			$asm = $this->db->get('masters');
			if ($asm->num_rows() > 0){
				$this->db->where('asm_number',$cur_mobile);
                $this->db->set('asm_number',$mobile);
                $this->db->set('asm',$username);
                $asm = $this->db->update('masters');
			}
			$this->db->where('tso_number',$cur_mobile);
			$tso = $this->db->get('masters');
			if ($tso->num_rows() > 0){
				$this->db->where('tso_number',$cur_mobile);
                $this->db->set('tso_number',$mobile);
                $this->db->set('tso',$username);
                $tso = $this->db->update('masters');
			}
			$this->db->where('sm_number',$cur_mobile);
			$sm = $this->db->get('masters');
			if ($sm->num_rows() > 0){
				$this->db->where('sm_number',$cur_mobile);
                $this->db->set('sm_number',$mobile);
                $this->db->set('sm',$username);
                $sm = $this->db->update('masters');
			}
			if ($zsm || $asm || $tso || $sm){
				return true;
			}
			else{
                return false;
            }
        }

		public function update_beat_optimize($mobile,$cur_mobile,$username){
			// print_r($username);die();

            $this->db->where('zm_number',$cur_mobile);
            $zsm = $this->db->get('beat_optimization');
			// print_r($zsm);die();
			if ($zsm->num_rows() > 0){
				$this->db->where('zm_number',$cur_mobile);
                $this->db->set('zm_number',$mobile);
                $this->db->set('zm',$username);
                $zsm = $this->db->update('beat_optimization');
			}
			$this->db->where('asm_number', $cur_mobile);
			$asm = $this->db->get('beat_optimization');
			if ($asm->num_rows() > 0){
				$this->db->where('asm_number',$cur_mobile);
                $this->db->set('asm_number',$mobile);
                $this->db->set('am',$username);
                $asm = $this->db->update('beat_optimization');
			}
			$this->db->where('sde_number',$cur_mobile);
			$sde = $this->db->get('beat_optimization');
			if ($sde->num_rows() > 0){
				$this->db->where('sde_number',$cur_mobile);
                $this->db->set('sde_number',$mobile);
                $this->db->set('sde_name',$username);
                $sde = $this->db->update('beat_optimization');
			}
			
			if ($zsm || $asm || $sde ){
				return true;
			}
			else{
                return false;
            }
        }

		public function update_cw_form($mobile,$cur_mobile){
			// print_r($cur_mobile);die();

			$this->db->where('created_by',$cur_mobile);
            $this->db->set('created_by',$mobile);
            $query = $this->db->update('cw_form');
            if ($query){
                return true;
            }
            else{
                return false;
            }
		}

		public function update_dist_masters($mobile,$cur_mobile,$username){
			// print_r($username);die();

            $this->db->where('zm_number',$cur_mobile);
            $zsm = $this->db->get('dist_master');
			// print_r($zsm);die();
			if ($zsm->num_rows() > 0){
				$this->db->where('zm_number',$cur_mobile);
                $this->db->set('zm_number',$mobile);
                $this->db->set('zm',$username);
                $zsm = $this->db->update('dist_master');
			}
			$this->db->where('am_number', $cur_mobile);
			$asm = $this->db->get('dist_master');
			if ($asm->num_rows() > 0){
				$this->db->where('am_number',$cur_mobile);
                $this->db->set('am_number',$mobile);
                $this->db->set('am',$username);
                $asm = $this->db->update('dist_master');
			}
			$this->db->where('tso_number',$cur_mobile);
			$tso = $this->db->get('dist_master');
			if ($tso->num_rows() > 0){
				$this->db->where('tso_number',$cur_mobile);
                $this->db->set('tso_number',$mobile);
                $this->db->set('tso',$username);
                $sde = $this->db->update('dist_master');
			}
			
			if ($zsm || $asm || $tso ){
				return true;
			}
			else{
                return false;
            }
        }

		//update rssm masters
		public function update_rssm_masters($mobile,$cur_mobile,$username){
            $this->db->where('rssm_id',$cur_mobile);
            $this->db->set('rssm_id',$mobile);
            $this->db->set('rssm_name',$username);
            $query = $this->db->update('rssm_mkt_master_copy');
			// print_r($query);die();
            if ($query){
                return true;
            }
            else{
                return false;
            }
        }

		public function update_rssm_recruitment_form($mobile,$cur_mobile,$username){
			// print_r($username);die();

            $this->db->where('created_by',$cur_mobile);
            $rssm = $this->db->get('rssm_recruitment_form');
			// print_r($zsm);die();
			if ($rssm->num_rows() > 0){
				$this->db->where('created_by',$cur_mobile);
                $this->db->set('created_by',$mobile);
                // $this->db->set('zm',$username);
                $rssm = $this->db->update('rssm_recruitment_form');
			}
			$this->db->where('mobile_no', $cur_mobile);
			$mob_num = $this->db->get('rssm_recruitment_form');
			if ($mob_num->num_rows() > 0){
				$this->db->where('mobile_no',$cur_mobile);
                $this->db->set('mobile_no',$mobile);
                $this->db->set('name',$username);
                $mob_num = $this->db->update('rssm_recruitment_form');
			}
			$this->db->where('alt_mobile_no',$cur_mobile);
			$alt_mob_num = $this->db->get('rssm_recruitment_form');
			if ($alt_mob_num->num_rows() > 0){
				$this->db->where('alt_mobile_no',$cur_mobile);
                $this->db->set('alt_mobile_no',$mobile);
                $this->db->set('name',$username);
                $alt_mob_num = $this->db->update('rssm_recruitment_form');
			}
			// print_r($alt_mob_num);
			if ($rssm || $mob_num || $alt_mob_num){
				return true;
			}
			else{
                return false;
            }
        }
		public function update_rssm_recruitment_form_vso($mobile,$cur_mobile,$username){
			

            $this->db->where('created_by',$cur_mobile);
            $rssm = $this->db->get('rssm_recruitment_form_vso');
			// print_r($zsm);die();
			if ($rssm->num_rows() > 0){
				$this->db->where('created_by',$cur_mobile);
                $this->db->set('created_by',$mobile);
                // $this->db->set('zm',$username);
                $rssm = $this->db->update('rssm_recruitment_form_vso');
			}
			$this->db->where('mobile_no', $cur_mobile);
			$mob_num = $this->db->get('rssm_recruitment_form_vso');
			if ($mob_num->num_rows() > 0){
				$this->db->where('mobile_no',$cur_mobile);
                $this->db->set('mobile_no',$mobile);
                $this->db->set('name',$username);
                $mob_num = $this->db->update('rssm_recruitment_form_vso');
			}
			$this->db->where('alt_mobile_no',$cur_mobile);
			$alt_mob_num = $this->db->get('rssm_recruitment_form_vso');
			if ($alt_mob_num->num_rows() > 0){
				$this->db->where('alt_mobile_no',$cur_mobile);
                $this->db->set('alt_mobile_no',$mobile);
                $this->db->set('name',$username);
                $alt_mob_num = $this->db->update('rssm_recruitment_form_vso');
			}
			
			if ($rssm || $mob_num || $alt_mob_num){
				return true;
			}
			else{
                return false;
            }
        }

		public function update_rs_key_performance($mobile,$cur_mobile){
			

            $this->db->where('created_by',$cur_mobile);
            $created_by = $this->db->get('rs_key_performance');
			// print_r($zsm);die();
			if ($created_by->num_rows() > 0){
				$this->db->where('created_by',$cur_mobile);
                $this->db->set('created_by',$mobile);
                // $this->db->set('zm',$username);
                $created_by = $this->db->update('rs_key_performance');
			}
			
			if ($created_by){
				return true;
			}
			else{
                return false;
            }
        }

		public function update_rs_mkt_master($username,$mobile,$cur_mobile){
			

            $this->db->where('sm_mobile',$cur_mobile);
            $sm_mobile = $this->db->get('rs_mkt_master');
			// print_r($zsm);die();
			if ($sm_mobile->num_rows() > 0){
				$this->db->where('sm_mobile',$cur_mobile);
                $this->db->set('sm_mobile',$mobile);
                // $this->db->set('zm',$username);
                $sm_mobile = $this->db->update('rs_mkt_master');
			}
			$this->db->where('tso_mobile', $cur_mobile);
			$tso_name = $this->db->get('rs_mkt_master');
			if ($tso_name->num_rows() > 0){
				$this->db->where('tso_mobile',$cur_mobile);
                $this->db->set('tso_mobile',$mobile);
                $this->db->set('tso_name',$username);
                $tso_name = $this->db->update('rs_mkt_master');
			}
			
			
			if ($sm_mobile || $tso_name ){
				return true;
			}
			else{
                return false;
            }
        }

		public function update_rs_recruitment_form($username,$mobile,$cur_mobile){
			

            $this->db->where('c_mobile_no',$cur_mobile);
            $c_mobile_no = $this->db->get('rs_recruitment_form');
			if ($c_mobile_no->num_rows() > 0){
				$this->db->where('c_mobile_no',$cur_mobile);
                $this->db->set('c_mobile_no',$mobile);
                $this->db->set('c_name',$username);
                $c_mobile_no = $this->db->update('rs_recruitment_form');
			}
			$this->db->where('created_by', $cur_mobile);
			$created_by = $this->db->get('rs_recruitment_form');
			if ($created_by->num_rows() > 0){
				$this->db->where('created_by',$cur_mobile);
                $this->db->set('created_by',$mobile);
                $created_by = $this->db->update('rs_recruitment_form');
			}
			
			
			if ($c_mobile_no || $created_by ){
				return true;
			}
			else{
                return false;
            }
        }

		public function update_rs_recruitment_form_vso($username,$mobile,$cur_mobile){
			

            $this->db->where('c_mobile_no',$cur_mobile);
            $c_mobile_no = $this->db->get('rs_recruitment_form_vso');
			if ($c_mobile_no->num_rows() > 0){
				$this->db->where('c_mobile_no',$cur_mobile);
                $this->db->set('c_mobile_no',$mobile);
                $this->db->set('c_name',$username);
                $c_mobile_no = $this->db->update('rs_recruitment_form_vso');
			}
			$this->db->where('created_by', $cur_mobile);
			$created_by = $this->db->get('rs_recruitment_form_vso');
			if ($created_by->num_rows() > 0){
				$this->db->where('created_by',$cur_mobile);
                $this->db->set('created_by',$mobile);
                $created_by = $this->db->update('rs_recruitment_form_vso');
			}
			
			
			if ($c_mobile_no || $created_by ){
				return true;
			}
			else{
                return false;
            }
        }

		public function update_sde_incentive_urban($username,$mobile,$cur_mobile){
			

            $this->db->where('asm_number',$cur_mobile);
            $asm_name = $this->db->get('sde_incentive_urban');
			if ($asm_name->num_rows() > 0){
				$this->db->where('asm_number',$cur_mobile);
                $this->db->set('asm_number',$mobile);
                $this->db->set('asm_name',$username);
                $asm_name = $this->db->update('sde_incentive_urban');
			}
			$this->db->where('zsm_number', $cur_mobile);
			$zm_name = $this->db->get('sde_incentive_urban');
			if ($zm_name->num_rows() > 0){
				$this->db->where('zsm_number',$cur_mobile);
                $this->db->set('zsm_number',$mobile);
                $this->db->set('zm_name',$username);
                $zm_name = $this->db->update('sde_incentive_urban');
			}
			$this->db->where('sde_number', $cur_mobile);
			$sde_name = $this->db->get('sde_incentive_urban');
			if ($sde_name->num_rows() > 0){
				$this->db->where('sde_number',$cur_mobile);
                $this->db->set('sde_number',$mobile);
                $this->db->set('sde_name',$username);
                $sde_name = $this->db->update('sde_incentive_urban');
			}
			
			
			if ($asm_name || $sde_name || $zm_name){
				return true;
			}
			else{
                return false;
            }
        }

		public function update_sde_market_visit_report($mobile,$cur_mobile){
			

            $this->db->where('rssm_mkt',$cur_mobile);
            $rssm_mkt = $this->db->get('sde_market_visit_report');
			if ($rssm_mkt->num_rows() > 0){
				$this->db->where('rssm_mkt',$cur_mobile);
                $this->db->set('rssm_mkt',$mobile);
                $rssm_mkt = $this->db->update('sde_market_visit_report');
			}
			$this->db->where('created_by', $cur_mobile);
			$zm_name = $this->db->get('sde_market_visit_report');
			if ($zm_name->num_rows() > 0){
				$this->db->where('created_by',$cur_mobile);
                $this->db->set('created_by',$mobile);
                $zm_name = $this->db->update('sde_market_visit_report');
			}
			
			if ($rssm_mkt || $sde_name ){
				return true;
			}
			else{
                return false;
            }
        }

		public function update_ss_recruitment_form($username,$mobile,$cur_mobile){
			

            $this->db->where('c_mobile_no',$cur_mobile);
            $c_mobile_no = $this->db->get('ss_recruitment_form');
			if ($c_mobile_no->num_rows() > 0){
				$this->db->where('c_mobile_no',$cur_mobile);
                $this->db->set('c_mobile_no',$mobile);
                $this->db->set('c_name',$username);
                $c_mobile_no = $this->db->update('ss_recruitment_form');
			}
			$this->db->where('created_by', $cur_mobile);
			$created_by = $this->db->get('ss_recruitment_form');
			if ($created_by->num_rows() > 0){
				$this->db->where('created_by',$cur_mobile);
                $this->db->set('created_by',$mobile);
                $created_by = $this->db->update('ss_recruitment_form');
			}
			
			
			if ($c_mobile_no || $created_by ){
				return true;
			}
			else{
                return false;
            }
        }

		public function update_ss_recruitment_form_vso($username,$mobile,$cur_mobile){
			

            $this->db->where('c_mobile_no',$cur_mobile);
            $c_mobile_no = $this->db->get('rs_recruitment_form_vso');
			if ($c_mobile_no->num_rows() > 0){
				$this->db->where('c_mobile_no',$cur_mobile);
                $this->db->set('c_mobile_no',$mobile);
                $this->db->set('c_name',$username);
                $c_mobile_no = $this->db->update('rs_recruitment_form_vso');
			}
			$this->db->where('created_by', $cur_mobile);
			$created_by = $this->db->get('rs_recruitment_form_vso');
			if ($created_by->num_rows() > 0){
				$this->db->where('created_by',$cur_mobile);
                $this->db->set('created_by',$mobile);
                $created_by = $this->db->update('rs_recruitment_form_vso');
			}
			
			
			if ($c_mobile_no || $created_by ){
				return true;
			}
			else{
                return false;
            }
        }

		public function update_distribution($username,$mobile,$cur_mobile){
			

            $this->db->where('approved_by',$cur_mobile);
            $approved_by = $this->db->get('distribution');
			if ($approved_by->num_rows() > 0){
				$this->db->where('approved_by',$cur_mobile);
                $this->db->set('approved_by',$mobile);
                $approved_by = $this->db->update('distribution');
			}
			$this->db->where('created_by', $cur_mobile);
			$created_by = $this->db->get('distribution');
			if ($created_by->num_rows() > 0){
				$this->db->where('created_by',$cur_mobile);
                $this->db->set('created_by',$mobile);
                $created_by = $this->db->update('distribution');
			}
			$this->db->where('mobile', $cur_mobile);
			$created_by = $this->db->get('distribution');
			if ($created_by->num_rows() > 0){
				$this->db->where('mobile',$cur_mobile);
                $this->db->set('mobile',$mobile);
                $this->db->set('name',$username);

                $created_by = $this->db->update('distribution');
			}
			
			
			if ($approved_by || $created_by ){
				return true;
			}
			else{
                return false;
            }
        }
		public function update_tso_login_log($username,$mobile,$cur_mobile){
			
			$this->db->where('mobile', $cur_mobile);
			$created_by = $this->db->get('tso_login_log');
			if ($created_by->num_rows() > 0){
				$this->db->where('mobile',$cur_mobile);
                $this->db->set('mobile',$mobile);
                $created_by = $this->db->update('tso_login_log');
			}
			
			
			if ($created_by ){
				// print_r($created_by->num_rows());
				// die();
				return true;
			}
			else{
// 				print_r($created_by->num_rows());
// die();
                return false;
            }
        }
		public function get_user_id($id) {

			$this->db->select('*');
			$this->db->from('users');    
			$this->db->where('id',$id);

			$record = $this->db->get();
			$records = $record->result_array();
		// print_r($records);die();

			return $records;
		}


		function get_table_user_list($table,$role){
			// $this->db->where($where);

			if($role == "ZSM"){
				$role_name = 'zsm';
				$role_number = 'zsm_number';
			}elseif($role == "ASM"){
				$role_name = 'asm';
				$role_number = 'asm_number';
			}elseif($role == "TSO"){
				$role_name = 'tso';
				$role_number = 'tso_number';
			}else{
				$role_name = 'sm';
				$role_number = 'sm_number';
			}
			$this->db->select($role_name . ', ' . $role_number .', division');
			$this->db->order_by($role_number, 'asc');  // or desc
			$this->db->group_by($role_number);
			$records = $this->db->get($table);
			return $records->result();
			
		}

		function get_touser_list($table,$role,$from_person) {

			$this->db->select('business');
			$this->db->where('mobile', $from_person);
			$query = $this->db->get($table);
			$get_business = $query->result();
			
			if(isset($get_business[0]->business) || $role == 'ZSM'){
				if($role != 'ZSM'){
					$this->db->select('username , mobile ');
					$this->db->where('business', $get_business[0]->business);
				}else{
					$this->db->select('username , mobile , business');
				}
				$this->db->where('role_type', $role);
				$this->db->where('mobile !=',$from_person);
				$this->db->order_by('mobile', 'asc');  // or desc
				$records = $this->db->get($table);
				return $records->result();
			}else{
				return array();
			}
		}
		
		public function funct_replacement($table, $role, $from_person, $to_person,$division) {
			
			// $this->db->select('email,username');
			// Query to get user details for $to_person
			$this->db->select('*');
			$this->db->where('mobile', $to_person);
			$query_to_person = $this->db->get('users');
			$to_person_details = $query_to_person->row(); // Assuming only one result expected

			// Query to get user details for $from_person
			$this->db->select('*');
			$this->db->where('mobile', $from_person);
			$query_from_person = $this->db->get('users');
			$from_person_details = $query_from_person->row(); // Assuming only one result expected

			// Check if business data exists for $to_person and process accordingly
			if ($to_person_details && $to_person_details->business != '' && $to_person_details->business != null) {
				$ex_business = [];

				if (!is_array($to_person_details->business)) {
					$decoded_business = json_decode($to_person_details->business, true);

					if (is_array($decoded_business)) {
						$ex_business = $decoded_business;
					} else {
						$ex_business = explode(',', $to_person_details->business);
					}
				} else {
					$ex_business = $to_person_details->business;
				}

				// Assuming $division is defined elsewhere in your code
				if (isset($division) && !in_array($division, $ex_business)) {
					$newbusiness = array_merge($ex_business, $division); // Merge existing with new division
				} else {
					$newbusiness = $ex_business;
				}

				$updated_business = json_encode(array_values(array_unique($newbusiness)));

				
				// Uncomment to update the business data for $to_person in the database
				$this->db->where('mobile', $to_person);
				$this->db->update('users', array('business' => $updated_business));
			}
			// Now you can use $to_person_details and $from_person_details as needed
			// Example usage:
			// if ($to_person_details) {
			// 	echo "To Person Details: <pre>" . print_r($to_person_details, true) . "</pre>";
			// }die;

			// if ($from_person_details) {
			// 	echo "From Person Details: <pre>" . print_r($from_person_details, true) . "</pre>";
			// }

			// Debugging: Print the last executed query
			// echo "Query for $to_person: " . $this->db->last_query() . "<br>";
			// echo "Query for $from_person: " . $this->db->last_query() . "<br>";
			// die;
			// print_r($data1);
			// print_r($from_person_details->business);
			// print_r($division);
			// Check if $from_person_details is valid and has business data
			// Check if $from_person_details is valid and has non-empty business data
			if ($from_person_details && $from_person_details->business != '' && $from_person_details->business != null) {
				$ex_business = [];

				// Parse existing business data into an array
				if (!is_array($from_person_details->business)) {
					// Decode JSON if the business data is in JSON format
					$decoded_business = json_decode($from_person_details->business, true);

					if (is_array($decoded_business)) {
						$ex_business = $decoded_business;
					} else {
						// Otherwise, split by comma if it's a comma-separated string
						$ex_business = explode(',', $from_person_details->business);
					}
				} else {
					// Use the existing array if the business data is already an array
					$ex_business = $from_person_details->business;
				}

				// Debugging: Print relevant information for troubleshooting
				// print_r($division); // Output the value of $division
				// print_r($ex_business); // Output the existing business array
				// print_r($division); // Output the existing business array
				// print_r(in_array($division, $ex_business)); // Check if $division is in $ex_business

				// Check if $division is set and exists in $ex_business
				if (isset($division)) {
					// Remove $division from $ex_business
					if($ex_business){
						$ex_business = array_diff($ex_business, $division);
					}else{
						$ex_business = $division;

					}
				}

				// Ensure uniqueness and encode back to JSON format
				$updated_business = json_encode(array_values(array_unique($ex_business)));

				// Debugging: Output the updated business data
				// print_r($updated_business);

				// Uncomment to update the business data for $from_person in the database
				$this->db->where('mobile', $from_person);
				$this->db->update('users', array('business' => $updated_business));
			}

			// Output $from_person_details for debugging
			// if ($from_person_details) {
			// 	echo "From Person Details: <pre>" . print_r($from_person_details, true) . "</pre>";
			// }



			// die;
			if($role == "ZSM"){
				$number_field = 'zsm_number';
				$name_field = 'zsm';
				$email_field = 'zsm_email';
			}elseif($role == "ASM"){
				$number_field = 'asm_number';
				$name_field = 'asm';
				$email_field = 'asm_email';
			}elseif($role == "TSO"){
				$number_field = 'tso_number';
				$name_field = 'tso';
				$email_field = 'tso_email';
			}elseif($role == "SM"){
				$number_field = 'sm_number';
				$name_field = 'sm';
				$email_field = 'sm_email';
			}

			// print_r($number_field);
			// exit;

			$data_arr = array(
				$number_field => $to_person,
				$name_field => $to_person_details->username,
				$email_field  => $to_person_details->email
			);
			if($role == "ZSM"){
				$this->db->where_in('division',  $division);
				$this->db->where($number_field, $from_person);
				$res = $this->db->update($table,$data_arr);

			}else{
				$this->db->where($number_field, $from_person);
				$res = $this->db->update($table,$data_arr);
			}
			

			if($res){
				return TRUE;
			}else{
				return FALSE;
			}

		}

		function get_div_list($table,$from_person,$role) {

			$this->db->select('business');
			$this->db->where('mobile', $from_person);
			$query = $this->db->get($table);
			$get_business = $query->result();
			$data = $query->row();
			if(count($get_business)){
				if (!is_array($data->business)) {
					$decoded_business = json_decode($data->business, true); 
					if (is_array($decoded_business)) {
						$ex_business = $decoded_business;
					} else {
						$ex_business[] = $data->business;
					}
				} else {
					$ex_business = $data->business;
				}
			// print_r($decoded_business);

			}else{
				$this->db->select('division');
				if($role == 'ZSM'){
					$this->db->where('zsm_number', $from_person);
				}else if($role == 'ASM'){
					$this->db->where('asm_number', $from_person);
				}else if($role == 'TSO'){
					$this->db->where('tso_number', $from_person);
				}
				$this->db->group_by('division');
				$query = $this->db->get('masters');
				$get_business = $query->result();
				$data = $query->row();
				if (!is_array($data->business)) {
					$decoded_business = json_decode($data->business, true); 
					if (is_array($decoded_business)) {
						$ex_business = $decoded_business;
					} else {
						$ex_business[] = $data->business;
					}
				} else {
					$ex_business = $data->business;
				}
			}
			// die;
			// json_decode($ex_business);
			return $ex_business;
		}

		function check_cluster_details($region,$state){
			// print_r($region);
			$this->db->where('cluster',$region);
			$query1 = $this->db->get('cluster_details');
			if ($query1->num_rows() == 0){
				// print_r($query1->num_rows());

				return 'cluster';
			}
			$this->db->where('cluster',$region);
			$this->db->where('state_name',$state);
			$query = $this->db->get('cluster_details');
			if ($query->num_rows() == 0){
				return 'state_name';
			}
		}

    }
?>
