<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fsscorecard_model extends CI_Model{

    
	public function get_sm_individual_data($table,$sess_mob,$rsp_name)
    {
		
		$this->db->select();
		$this->db->where('ssfa_id',$sess_mob);
		$this->db->where('name',$rsp_name);
		$records = $this->db->get($table);
		
		return $records->result();
    }	

	public function get_sm_user_data($table,$sess_mob)
    {
		
		$this->db->select();
		$this->db->where('mobile',$sess_mob);
		$records = $this->db->get($table);
		
		return $records->result();
    }	
}

?>
