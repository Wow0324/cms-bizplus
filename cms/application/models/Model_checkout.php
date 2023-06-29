<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_checkout extends CI_Model 
{
    public function all_countries()
    {
        $query = $this->db->query("SELECT * FROM tbl_country ORDER BY country_name ASC");
        return $query->result_array();
    }

    public function product_detail_by_id($id)
    {
        $query = $this->db->query("SELECT * FROM tbl_product WHERE product_id=?",[$id]);
        return $query->first_row('array');
    }

    public function shipping_data()
    {
        $query = $this->db->query("SELECT * FROM tbl_shipping ORDER BY shipping_order ASC");
        return $query->result_array();
    }

    public function coupon_detail($code)
    {
        $query = $this->db->query("SELECT * FROM tbl_coupon WHERE coupon_code=?",[$code]);
        return $query->first_row('array');
    }

    public function coupon_detail_total($code)
    {
        $query = $this->db->query("SELECT * FROM tbl_coupon WHERE coupon_code=?",[$code]);
        return $query->num_rows();
    }

    public function shipping_detail($id)
    {
        $query = $this->db->query("SELECT * FROM tbl_shipping WHERE shipping_id=?",[$id]);
        return $query->first_row('array');
    }

    public function customer_detail($email)
    {
        $query = $this->db->query("SELECT * FROM tbl_customer WHERE customer_email=?",[$email]);
        return $query->first_row('array');
    }

    public function customer_detail_total($email)
    {
        $query = $this->db->query("SELECT * FROM tbl_customer WHERE customer_email=?",[$email]);
        return $query->num_rows();
    }
}