<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_category extends CI_Model 
{
    public function all_blogs_by_category_id($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_blog');
        $this->db->where('category_id', $id);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function category_by_slug($slug)
    {
        $this->db->select('*');
        $this->db->from('tbl_category');
        $this->db->where('category_slug', $slug);
        $query = $this->db->get();
        return $query->first_row('array');
    }

    public function category_check($slug) 
    {
        $this->db->select('*');
        $this->db->from('tbl_category');
        $this->db->where('category_slug', $slug);
        $query = $this->db->get();
        return $query->num_rows();
    }
}