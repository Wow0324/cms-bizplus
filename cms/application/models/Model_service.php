<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_service extends CI_Model 
{
    public function all_service()
    {
        $query = $this->db->query("SELECT * FROM tbl_service WHERE lang_id=? ORDER BY id ASC",[$_SESSION['sess_lang_id']]);
        return $query->result_array();
    }

    public function service_check($slug) 
    {
        $this->db->select('*');
        $this->db->from('tbl_service');
        $this->db->where('slug', $slug);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function service_detail($slug) {
        $this->db->select('*');
        $this->db->from('tbl_service');
        $this->db->where('slug', $slug);
        $query = $this->db->get();
        return $query->first_row('array');
    }

    public function s_data()
    {
        $query = $this->db->query("SELECT * FROM tbl_page_service WHERE lang_id=?",[$_SESSION['sess_lang_id']]);
        return $query->first_row('array');
    }
}