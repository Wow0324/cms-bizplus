<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_cart extends CI_Model 
{
    public function all_products()
    {
        $query = $this->db->query("SELECT * FROM tbl_product");
        return $query->result_array();
    }

    public function product_detail_by_id($id)
    {
        $query = $this->db->query("SELECT * FROM tbl_product WHERE product_id=?",[$id]);
        return $query->first_row('array');
    }
}