<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_shop extends CI_Model 
{
    public function all_products()
    {
        $query = $this->db->query("SELECT * 
                        FROM tbl_product 
                        WHERE lang_id=? 
                        ORDER BY product_id ASC",
                        [$_SESSION['sess_lang_id']]);
        return $query->result_array();
    }
}