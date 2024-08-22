<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Import_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}
	public function insert($data) {
		// $res = $this->db->insert_batch('import',$data);
		$res = $this->db->insert_batch('beat_optimization',$data);
		if($res){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function update($sess_mob,$data) {
		// print_r($sess_mob);die;
		$this->db->where('sde_number',$sess_mob);
		$delete = $this->db->delete('beat_optimization');
		$res = $this->db->insert_batch('beat_optimization',$data);
		if($res){
		return TRUE;
		}else{
		return FALSE;
	}
	}
}
?>
