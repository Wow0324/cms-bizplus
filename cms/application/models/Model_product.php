<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_product extends CI_Model 
{
    public function product_check($slug)
    {
        $query = $this->db->query("SELECT * FROM tbl_product WHERE product_slug=?",[$slug]);
        return $query->num_rows();
    }

    public function product_detail($slug)
    {
        $query = $this->db->query("SELECT * 
                FROM tbl_product
                WHERE product_slug=?",
                [$slug]);
        return $query->first_row('array');
    }

    public function product_detail_by_id($id)
    {
        $query = $this->db->query("SELECT * FROM tbl_product WHERE product_id=?",[$id]);
        return $query->first_row('array');
    }
}