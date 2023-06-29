<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_home extends CI_Model 
{
    public function all_slider()
    {
        $query = $this->db->query("SELECT * FROM tbl_slider WHERE lang_id=? ORDER BY id ASC",[$_SESSION['sess_lang_id']]);
        return $query->result_array();
    }
    public function all_service()
    {
        $query = $this->db->query("SELECT * FROM tbl_service WHERE lang_id=? ORDER BY id ASC",[$_SESSION['sess_lang_id']]);
        return $query->result_array();
    }
    public function all_why_choose()
    {
        $query = $this->db->query("SELECT * FROM tbl_why_choose WHERE lang_id=? ORDER BY id ASC",[$_SESSION['sess_lang_id']]);
        return $query->result_array();
    }
    public function all_team_member()
    {
        $query = $this->db->query("SELECT * FROM tbl_team_member WHERE lang_id=? ORDER BY team_member_id ASC",[$_SESSION['sess_lang_id']]);
        return $query->result_array();
    }
    public function all_testimonial()
    {
        $query = $this->db->query("SELECT * FROM tbl_testimonial WHERE lang_id=? ORDER BY id ASC",[$_SESSION['sess_lang_id']]);
        return $query->result_array();
    }
    public function all_dynamic_page()
    {
        $query = $this->db->query("SELECT * FROM tbl_page_dynamic WHERE lang_id=? ORDER BY id ASC",[$_SESSION['sess_lang_id']]);
        return $query->result_array();
    }
}