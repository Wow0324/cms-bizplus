
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_blog extends CI_Model 
{
	function get_auto_increment_id()
    {
        $sql = "SHOW TABLE STATUS LIKE 'tbl_blog'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function show() 
    {
        $sql = "SELECT * 
                FROM tbl_blog t1
                JOIN tbl_category t2
                ON t1.category_id = t2.category_id
                JOIN tbl_lang t3
                ON t1.lang_id = t3.lang_id
                ORDER BY t1.id DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function add($data) 
    {
        $this->db->insert('tbl_blog',$data);
        return $this->db->insert_id();
    }

    function update($id,$data) 
    {
        $this->db->where('id',$id);
        $this->db->update('tbl_blog',$data);
    }

    function delete($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('tbl_blog');
    }

    function getData($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_blog');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->first_row('array');
    }

    function get_category()
    {
        $this->db->select('*');
        $this->db->from('tbl_category');
        $this->db->order_by('category_name', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function blog_check($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_blog');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->first_row('array');
    }
    function slug_duplication_check($slug)
    {
        $sql = 'SELECT * FROM tbl_blog WHERE slug=?';
        $query = $this->db->query($sql,array($slug));
        return $query->num_rows();
    }

    function slug_duplication_check_edit($slug,$slug2)
    {
        $sql = 'SELECT * FROM tbl_blog WHERE slug=? AND slug!=?';
        $query = $this->db->query($sql,array($slug,$slug2));
        return $query->num_rows();
    }
}