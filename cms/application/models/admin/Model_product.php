<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_product extends CI_Model 
{
	function get_auto_increment_id()
    {
        $sql = "SHOW TABLE STATUS LIKE 'tbl_product'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function show()
    {
        $sql = "SELECT * 
                FROM tbl_product t1
                JOIN tbl_lang t2
                ON t1.lang_id = t2.lang_id
                ORDER BY product_id DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function add($data)
    {
        $this->db->insert('tbl_product',$data);
        return $this->db->insert_id();
    }

    function update($id,$data)
    {
        $this->db->where('product_id',$id);
        $this->db->update('tbl_product',$data);
    }

    function delete($id)
    {
        $this->db->where('product_id',$id);
        $this->db->delete('tbl_product');
    }

    function getData($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_product');
        $this->db->where('product_id', $id);
        $query = $this->db->get();
        return $query->first_row('array');
    }

    function product_check($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_product');
        $this->db->where('product_id', $id);
        $query = $this->db->get();
        return $query->first_row('array');
    }
    function slug_duplication_check($slug)
    {
        $sql = 'SELECT * FROM tbl_product WHERE product_slug=?';
        $query = $this->db->query($sql,array($slug));
        return $query->num_rows();
    }

    function slug_duplication_check_edit($slug,$slug2)
    {
        $sql = 'SELECT * FROM tbl_product WHERE product_slug=? AND product_slug!=?';
        $query = $this->db->query($sql,array($slug,$slug2));
        return $query->num_rows();
    }
}