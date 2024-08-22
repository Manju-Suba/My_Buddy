<?php

class Fullcalendar_model extends CI_Model
{ 

    function fetch_all_event(){
        $user_mobile = $this->session->userdata('mobile');
        $user_role = $this->session->userdata('role');

        if($user_role == 'ASM' ){
            $this->db->select('sde_market_visit_report.*');
            $this->db->join('masters', 'masters.tso_number = sde_market_visit_report.created_by or masters.sm_number = sde_market_visit_report.created_by');
            $this->db->where('masters.asm_number', $user_mobile);
            $this->db->group_by('sde_market_visit_report.id');

        }elseif($user_role == 'ZSM' ){
            $this->db->select('sde_market_visit_report.*');
            $this->db->join('masters', 'masters.tso_number = sde_market_visit_report.created_by or masters.sm_number = sde_market_visit_report.created_by');
            $this->db->where('masters.zsm_number', $user_mobile);
            $this->db->group_by('sde_market_visit_report.id');

        }elseif($user_role == 'SM' || $user_role == 'TSO'){

            $this->db->select('*');
            $this->db->where('created_by =', $user_mobile);
            // $this->db->group_by('id');
        }else{
            $this->db->select('*');
            $this->db->group_by('id');

        }

        $records = $this->db->get('sde_market_visit_report');
        // return $records->result();
        return $records->result_array();
    }

    function insert_event($data)
    {
        $this->db->insert('sde_market_visit_report', $data);
    }

    function update_event($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('sde_market_visit_report', $data);
    }

    function delete_event($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('sde_market_visit_report');
    }

    function fetch_data($id){

        $user_mobile = $this->session->userdata('mobile');
        $user_role = $this->session->userdata('role');

        if($user_role == 'ASM' ){
            $this->db->join('masters', 'masters.tso_number = sde_market_visit_report.created_by or masters.sm_number = sde_market_visit_report.created_by');
            $this->db->where('masters.asm_number', $user_mobile);
            $this->db->where('sde_market_visit_report.id', $id);

        }else if($user_role == 'ZSM' ){
            $this->db->join('masters', 'masters.tso_number = sde_market_visit_report.created_by or masters.sm_number = sde_market_visit_report.created_by');
            $this->db->where('masters.zsm_number', $user_mobile);
            $this->db->where('sde_market_visit_report.id', $id);

        }else if($user_role == 'SM' || $user_role == 'TSO'){
            $this->db->where('created_by', $user_mobile);
            $this->db->where('id', $id);

        }else{
            $this->db->select();
            $this->db->where('id', $id);
        }
        
        $records = $this->db->get('sde_market_visit_report');
        return $records->result();
    }


    function fetch_filter_event($busi,$data){

        $user_mobile = $this->session->userdata('mobile');
        $user_role = $this->session->userdata('role');

        $this->db->select('sde_market_visit_report.*');

        if($user_role == 'ASM' ){
            $this->db->join('masters', 'masters.tso_number = sde_market_visit_report.created_by or masters.sm_number = sde_market_visit_report.created_by');
            $this->db->where('masters.asm_number', $user_mobile);
            $this->db->group_by('sde_market_visit_report.id');

            $this->db->join('users as u', 'sde_market_visit_report.created_by = u.mobile');

            if($busi !=""){
                $this->db->where('u.business', $busi);
            }

            if($data['tso_number'] !=""){
                $this->db->where('sde_market_visit_report.created_by', $data['tso_number']);
            }

            if($data['sm_number'] !=""){
                $this->db->where('sde_market_visit_report.created_by', $data['sm_number']);
            }

        }else if($user_role == 'ZSM' ){
            $this->db->join('masters', 'masters.tso_number = sde_market_visit_report.created_by or masters.sm_number = sde_market_visit_report.created_by');
            $this->db->where('masters.zsm_number', $user_mobile);
            $this->db->group_by('sde_market_visit_report.id');

            $this->db->join('users as u', 'sde_market_visit_report.created_by = u.mobile');

            if($busi !=""){
                $this->db->where('u.business', $busi);
            }
            if($data['asm_number'] !=""){
                $this->db->where('masters.asm_number', $data['asm_number']);
            }
            if($data['tso_number'] !=""){
                $this->db->where('sde_market_visit_report.created_by', $data['tso_number']);
            }
            if($data['sm_number'] !=""){
                $this->db->where('sde_market_visit_report.created_by', $data['sm_number']);
            }

        }else if($user_role == 'SM' || $user_role == 'TSO'){
            $this->db->where('created_on', $user_mobile);
            $this->db->group_by('id');
        }else{
            // $this->db->select();

            $this->db->join('masters', 'masters.tso_number = sde_market_visit_report.created_by or masters.sm_number = sde_market_visit_report.created_by');
            $this->db->group_by('sde_market_visit_report.id');
            $this->db->join('users as u', 'sde_market_visit_report.created_by = u.mobile');

            if($busi !=""){
                $this->db->where('u.business', $busi);
            }
            if($data['zsm_number'] !=""){
                $this->db->where('masters.zsm_number', $data['zsm_number']);
            }
            if($data['asm_number'] !=""){
                $this->db->where('masters.asm_number', $data['asm_number']);
            }
            if($data['tso_number'] !=""){
                $this->db->where('sde_market_visit_report.created_by', $data['tso_number']);
            }
            if($data['sm_number'] !=""){
                $this->db->where('sde_market_visit_report.created_by', $data['sm_number']);
            }
            $this->db->group_by('id');
        }

        $records = $this->db->get('sde_market_visit_report');
        // return $records->result();
        return $records->result_array();
    }


    public function get_rsm($rssm_id){
        $this->db->select('*');
        $this->db->where('ssfa_id', $rssm_id);
        $records = $this->db->get('osm_performance');
        return $records->result_array();
    }

	public function get_rssm($col,$rssm_id, $table){
        $this->db->select('*');
        $this->db->where($col, $rssm_id);
        $records = $this->db->get($table);
        return $records->result_array();
    }

}

?>
