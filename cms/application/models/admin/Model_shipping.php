<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_shipping extends CI_Model 
{
	function get_auto_increment_id()
    {
        $sql = "SHOW TABLE STATUS LIKE 'tbl_shipping'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function show() 
    {
        $this->db->select('*');
        $this->db->from('tbl_shipping');
        $this->db->order_by('shipping_id', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function add($data) 
    {
        $this->db->insert('tbl_shipping',$data);
        return $this->db->insert_id();
    }

    function update($id,$data) 
    {
        $this->db->where('shipping_id',$id);
        $this->db->update('tbl_shipping',$data);
    }

    function delete($id)
    {
        $this->db->where('shipping_id',$id);
        $this->db->delete('tbl_shipping');
    }

    function get_shipping($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_shipping');
        $this->db->where('shipping_id', $id);
        $query = $this->db->get();
        return $query->first_row('array');
    }

    function shipping_check($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_shipping');
        $this->db->where('shipping_id', $id);
        $query = $this->db->get();
        return $query->first_row('array');
    }

}