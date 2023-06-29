<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_category extends CI_Model 
{
	function get_auto_increment_id()
    {
        $sql = "SHOW TABLE STATUS LIKE 'tbl_category'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function show() 
    {
        $sql = "SELECT * 
                FROM tbl_category t1
                JOIN tbl_lang t2
                ON t1.lang_id = t2.lang_id
                ORDER BY category_id ASC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function add($data) 
    {
        $this->db->insert('tbl_category',$data);
        return $this->db->insert_id();
    }

    function update($id,$data) 
    {
        $this->db->where('category_id',$id);
        $this->db->update('tbl_category',$data);
    }

    function delete($id)
    {
        $this->db->where('category_id',$id);
        $this->db->delete('tbl_category');
    }

    function get_category($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_category');
        $this->db->where('category_id', $id);
        $query = $this->db->get();
        return $query->first_row('array');
    }

    function category_check($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_category');
        $this->db->where('category_id', $id);
        $query = $this->db->get();
        return $query->first_row('array');
    }

    function check_post($id) 
    {
        $this->db->select('*');
        $this->db->from('tbl_blog');
        $this->db->where('category_id', $id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function slug_duplication_check($slug)
    {
        $sql = 'SELECT * FROM tbl_category WHERE category_slug=?';
        $query = $this->db->query($sql,array($slug));
        return $query->num_rows();
    }

    function slug_duplication_check_edit($slug,$slug2)
    {
        $sql = 'SELECT * FROM tbl_category WHERE category_slug=? AND category_slug!=?';
        $query = $this->db->query($sql,array($slug,$slug2));
        return $query->num_rows();
    }
   
}