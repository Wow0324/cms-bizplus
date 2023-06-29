<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_payment extends CI_Model 
{
    function get_auto_increment_id()
    {
        $sql = "SHOW TABLE STATUS LIKE 'tbl_order'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function order_add($data) 
    {
        $this->db->insert('tbl_order',$data);
        return $this->db->insert_id();
    }

    function order_detail_add($data) 
    {
        $this->db->insert('tbl_order_detail',$data);
        return $this->db->insert_id();
    }

    function update_stock($stock_quantity,$data) 
    {
        $this->db->where('product_stock',$stock_quantity);
        $this->db->update('tbl_product',$data);
    }

    public function p_detail($id)
    {
        $query = $this->db->query("SELECT * FROM tbl_product WHERE product_id=?",[$id]);
        return $query->first_row('array');
    }

    public function coupon_data($code)
    {
        $query = $this->db->query("SELECT * FROM tbl_coupon WHERE coupon_code=?",[$code]);
        return $query->first_row('array');
    }

    function update_coupon_use($code,$data) 
    {
        $this->db->where('coupon_code',$code);
        $this->db->update('tbl_coupon',$data);
    }

    function update_payment_data($order_no,$data) 
    {
        $this->db->where('order_no',$order_no);
        $this->db->update('tbl_order',$data);
    }

    function delete_payment_data($order_no)
    {
        $this->db->where('order_no',$order_no);
        $this->db->delete('tbl_order');
    }
    function delete_payment_data1($order_no)
    {
        $this->db->where('order_no',$order_no);
        $this->db->delete('tbl_order_detail');
    }

    function order_id_by_order_no($o_no)
    {
        $query = $this->db->query("SELECT * FROM tbl_order WHERE order_no=?",[$o_no]);
        return $query->first_row('array');
    }
}