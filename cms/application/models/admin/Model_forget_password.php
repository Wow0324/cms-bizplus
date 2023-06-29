<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_forget_password extends CI_Model 
{
    public function get_setting_data()
    {
        $this->db->select('*');
        $this->db->from('tbl_settings');
        $this->db->where('id', 1);
        $query = $this->db->get();
        return $query->first_row('array');
    }

    function check_email($email)
    {
        $this->db->select('*');
        $this->db->from('tbl_user');
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query->first_row('array');
    }

    function update($email,$data) {
        $this->db->where('email',$email);
        $this->db->update('tbl_user',$data);
    }
}