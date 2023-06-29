<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_order extends CI_Model 
{
    function show() 
    {
        $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function delete($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('tbl_order');
    }

    function delete_detail($id)
    {
        $this->db->where('order_id',$id);
        $this->db->delete('tbl_order_detail');
    }

    function get_product($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_order_detail');
        $this->db->where('order_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    function order_check($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_order');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->first_row('array');
    }
}