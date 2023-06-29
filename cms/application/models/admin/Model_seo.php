<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_seo extends CI_Model 
{
    public function show_seo()
    {
        $this->db->select('*');
        $this->db->from('tbl_seo');
        $this->db->where('id', 1);
        $query = $this->db->get();
        return $query->first_row('array');
    }

    public function update_seo($data)
    {
        $this->db->where('id',1);
        $this->db->update('tbl_seo',$data);
    }
}