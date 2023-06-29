<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_lang extends CI_Model 
{
    public function get_default_language_id()
    {
        $this->db->select('*');
        $this->db->from('tbl_lang');
        $this->db->where('lang_default', 'Yes');
        $query = $this->db->get();
        return $query->first_row('array');
    }

    public function get_detail_by_language_id($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_lang_key');
        $this->db->where('lang_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function show_all_language() 
    {
        $this->db->select('*');
        $this->db->from('tbl_lang');
        $query = $this->db->get();
        return $query->result_array();
    }

}