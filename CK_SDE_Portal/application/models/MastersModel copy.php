<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class MastersModel extends CI_Model {
		public function __construct()
		{
			$this->load->database();
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

			if($delete){
				return 'success';
			}else{
				return 'failed';
			}
		}

		public function delete_data($table){
			// $this->db->where('division',$business);
			$delete = $this->db->truncate($table);

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
                        'sm_number' => $d['sm_number'],
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

		public function zsm_exist($zsm_mobile,$zsm_data){
			$this->db->where('mobile',$zsm_mobile);
			$query = $this->db->get('users');
			if ($query->num_rows() == 0){
				$this->db->insert('users',$zsm_data);
				return true;
			}
			else{
				return false;
			}
		}

		public function asm_exist($ssm_mobile,$asm_data){
			$this->db->where('mobile',$ssm_mobile);
			$query = $this->db->get('users');
			if ($query->num_rows() == 0){
				$this->db->insert('users',$asm_data);
				return true;
			}
			else{
				return false;
			}
		}

		public function tso_exist($tso_mobile,$tso_data){
			$this->db->where('mobile',$tso_mobile);
			$query = $this->db->get('users');
			if ($query->num_rows() == 0){
				$this->db->insert('users',$tso_data);
				return true;
			}
			else{
				return false;
			}
		}

		public function sm_exist($sm_mobile,$sm_data){
			$this->db->where('mobile',$sm_mobile);
			$query = $this->db->get('users');
			if ($query->num_rows() == 0){
				$this->db->insert('users',$sm_data);
				return true;
			}
			else{
				return false;
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


    }
?>
