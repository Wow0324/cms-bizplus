<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_comment extends CI_Model 
{
    function show() 
    {
        $this->db->select('*');
        $this->db->from('tbl_comment');
        $this->db->where('id', 1);
        $query = $this->db->get();
        return $query->first_row('array');
    }

    function update($data) 
    {
        $this->db->where('id',1);
        $this->db->update('tbl_comment',$data);
    }
    
}