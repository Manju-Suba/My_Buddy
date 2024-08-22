<?php

class LoginModel extends CI_Model {

    public function checkLogin($data) {
        
        //query the table 'users' and get the result count
        $this->db->select("*");
        $this->db->where('mobile', $data['mobile']);
        $this->db->where('password', $data['password']);
        $query = $this->db->get('users')->row_array();

        return $query;
    }

    public function checkuser($data) {
        
        //query the table 'users' and get the result count
        $this->db->select("*");
        $this->db->where('mobile', $data['mobile']);
        // $this->db->where('password', $data['password']);
        $query = $this->db->get('users')->row_array();

        return $query;
    }

    
}