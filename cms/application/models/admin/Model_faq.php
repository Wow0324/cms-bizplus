<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_faq extends CI_Model 
{
	function get_auto_increment_id()
    {
        $sql = "SHOW TABLE STATUS LIKE 'tbl_faq'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
	
    function show() 
    {
        $sql = "SELECT * 
                FROM tbl_faq t1
                JOIN tbl_lang t2
                ON t1.lang_id = t2.lang_id
                ORDER BY faq_id ASC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function add($data) 
    {
        $this->db->insert('tbl_faq',$data);
        return $this->db->insert_id();
    }

    function update($id,$data) 
    {
        $this->db->where('faq_id',$id);
        $this->db->update('tbl_faq',$data);
    }

    function delete($id)
    {
        $this->db->where('faq_id',$id);
        $this->db->delete('tbl_faq');
    }

    function getData($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_faq');
        $this->db->where('faq_id', $id);
        $query = $this->db->get();
        return $query->first_row('array');
    }

    function faq_check($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_faq');
        $this->db->where('faq_id', $id);
        $query = $this->db->get();
        return $query->first_row('array');
    }

    function get_photo()
    {
        $this->db->select('*');
        $this->db->from('tbl_faq_photo');
        $this->db->where('id', 1);
        $query = $this->db->get();
        return $query->first_row('array');
    }
    
    function update_faq_photo($data) 
    {
        $this->db->where('id',1);
        $this->db->update('tbl_faq_photo',$data);
    }    
}