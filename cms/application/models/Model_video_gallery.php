<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_video_gallery extends CI_Model 
{
    public function all_video()
    {
    	$query = $this->db->query("SELECT * FROM tbl_video WHERE lang_id=? ORDER BY video_id ASC",[$_SESSION['sess_lang_id']]);
        return $query->result_array();
    }
}