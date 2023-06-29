<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_photo_gallery extends CI_Model 
{
    public function all_photo()
    {
    	$query = $this->db->query("SELECT * FROM tbl_photo WHERE lang_id=? ORDER BY photo_id ASC",[$_SESSION['sess_lang_id']]);
        return $query->result_array();
    }
}