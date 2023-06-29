<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_contact extends CI_Model 
{
    public function all_testimonial()
    {
        $this->db->select('*');
        $this->db->from('tbl_testimonial');
        $this->db->order_by('id', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }
}