<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_team_member extends CI_Model 
{
	function get_auto_increment_id()
    {
        $sql = "SHOW TABLE STATUS LIKE 'tbl_team_member'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function show()
    {
        $sql = "SELECT * 
                FROM tbl_team_member t1
                JOIN tbl_lang t2
                ON t1.lang_id = t2.lang_id
                ORDER BY team_member_id ASC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function show_asc_by_name()
    {
        $this->db->select('*');
        $this->db->from('tbl_team_member');
        $this->db->order_by('team_member_name', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function add($data) 
    {
        $this->db->insert('tbl_team_member',$data);
        return $this->db->insert_id();
    }

    function update($id,$data) 
    {
        $this->db->where('team_member_id',$id);
        $this->db->update('tbl_team_member',$data);
    }

    function delete($id)
    {
        $this->db->where('team_member_id',$id);
        $this->db->delete('tbl_team_member');
    }

    function get_team_member($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_team_member');
        $this->db->where('team_member_id', $id);
        $query = $this->db->get();
        return $query->first_row('array');
    }   

    function team_member_check($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_team_member');
        $this->db->where('team_member_id', $id);
        $query = $this->db->get();
        return $query->first_row('array');
    }
    
    function slug_duplication_check($slug)
    {
        $sql = 'SELECT * FROM tbl_team_member WHERE team_member_slug=?';
        $query = $this->db->query($sql,array($slug));
        return $query->num_rows();
    }

    function slug_duplication_check_edit($slug,$slug2)
    {
        $sql = 'SELECT * FROM tbl_team_member WHERE team_member_slug=? AND team_member_slug!=?';
        $query = $this->db->query($sql,array($slug,$slug2));
        return $query->num_rows();
    }
}