<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_newsletter extends CI_Model 
{
    public function total_subscriber_by_email($email)
    {
        $this->db->select('*');
        $this->db->from('tbl_subscriber');
        $this->db->where('subs_email', $email);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function add($data) {
        $this->db->insert('tbl_subscriber',$data);
        return $this->db->insert_id();
    }

    public function check_url($email,$hash) {
        $this->db->select('*');
        $this->db->from('tbl_subscriber');
        $this->db->where('subs_email', $email);
        $this->db->where('subs_hash', $hash);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function update($email,$hash,$data) {
        $this->db->where('subs_email',$email);
        $this->db->where('subs_hash',$hash);
        $this->db->update('tbl_subscriber',$data);
    }
}