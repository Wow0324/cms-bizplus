<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_photo extends CI_Model 
{

	function get_auto_increment_id()
    {
        $sql = "SHOW TABLE STATUS LIKE 'tbl_photo'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
	
    function show()
    {
        $sql = "SELECT * 
                FROM tbl_photo t1
                JOIN tbl_lang t2
                ON t1.lang_id = t2.lang_id
                ORDER BY photo_id ASC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function add($data)
    {
        $this->db->insert('tbl_photo',$data);
        return $this->db->insert_id();
    }

    function update($id,$data)
    {
        $this->db->where('photo_id',$id);
        $this->db->update('tbl_photo',$data);
    }

    function delete($id)
    {
        $this->db->where('photo_id',$id);
        $this->db->delete('tbl_photo');
    }

    function getData($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_photo');
        $this->db->where('photo_id', $id);
        $query = $this->db->get();
        return $query->first_row('array');
    }

    function photo_check($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_photo');
        $this->db->where('photo_id', $id);
        $query = $this->db->get();
        return $query->first_row('array');
    }
    
}