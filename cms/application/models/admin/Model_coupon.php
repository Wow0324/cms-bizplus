<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_coupon extends CI_Model 
{
	function get_auto_increment_id()
    {
        $sql = "SHOW TABLE STATUS LIKE 'tbl_coupon'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function show() 
    {
        $this->db->select('*');
        $this->db->from('tbl_coupon');
        $this->db->order_by('coupon_id', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function add($data) 
    {
        $this->db->insert('tbl_coupon',$data);
        return $this->db->insert_id();
    }

    function update($id,$data) 
    {
        $this->db->where('coupon_id',$id);
        $this->db->update('tbl_coupon',$data);
    }

    function delete($id)
    {
        $this->db->where('coupon_id',$id);
        $this->db->delete('tbl_coupon');
    }

    function get_coupon($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_coupon');
        $this->db->where('coupon_id', $id);
        $query = $this->db->get();
        return $query->first_row('array');
    }

    function coupon_check($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_coupon');
        $this->db->where('coupon_id', $id);
        $query = $this->db->get();
        return $query->first_row('array');
    }

}