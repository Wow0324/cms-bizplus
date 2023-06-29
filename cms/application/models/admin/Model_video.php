<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_video extends CI_Model 
{

	function get_auto_increment_id()
    {
        $sql = "SHOW TABLE STATUS LIKE 'tbl_video'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
	
    function show()
    {
        $sql = "SELECT * 
                FROM tbl_video t1
                JOIN tbl_lang t2
                ON t1.lang_id = t2.lang_id
                ORDER BY video_id ASC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function add($data)
    {
        $this->db->insert('tbl_video',$data);
        return $this->db->insert_id();
    }

    function update($id,$data)
    {
        $this->db->where('video_id',$id);
        $this->db->update('tbl_video',$data);
    }

    function delete($id)
    {
        $this->db->where('video_id',$id);
        $this->db->delete('tbl_video');
    }

    function getData($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_video');
        $this->db->where('video_id', $id);
        $query = $this->db->get();
        return $query->first_row('array');
    }

    function video_check($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_video');
        $this->db->where('video_id', $id);
        $query = $this->db->get();
        return $query->first_row('array');
    }
    
}