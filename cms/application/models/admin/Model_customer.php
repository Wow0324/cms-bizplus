<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_customer extends CI_Model 
{
	function get_auto_increment_id()
    {
        $sql = "SHOW TABLE STATUS LIKE 'tbl_customer'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function show() 
    {
        $this->db->select('*');
        $this->db->from('tbl_customer');
        $this->db->order_by('customer_id', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function delete($id)
    {
        $this->db->where('customer_id',$id);
        $this->db->delete('tbl_customer');
    }

    function customer_check($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_customer');
        $this->db->where('customer_id', $id);
        $query = $this->db->get();
        return $query->first_row('array');
    }

    function make_pending($id,$data) 
    {
        $this->db->where('customer_id',$id);
        $this->db->update('tbl_customer',$data);
    }

    function make_active($id,$data) 
    {
        $this->db->where('customer_id',$id);
        $this->db->update('tbl_customer',$data);
    }
}