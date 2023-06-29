<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_dashboard extends CI_Model 
{
	public function show_total_category()
	{
        $this->db->select('*');
        $this->db->from('tbl_category');
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function show_total_blog()
	{
        $this->db->select('*');
        $this->db->from('tbl_blog');
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function show_total_team_member()
    {
        $this->db->select('*');
        $this->db->from('tbl_team_member');
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function show_total_service()
    {
        $this->db->select('*');
        $this->db->from('tbl_service');
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function show_total_testimonial()
    {
        $this->db->select('*');
        $this->db->from('tbl_testimonial');
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function show_total_event()
    {
        $this->db->select('*');
        $this->db->from('tbl_event');
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function show_total_photo()
    {
        $this->db->select('*');
        $this->db->from('tbl_photo');
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function show_total_pricing_table()
    {
        $this->db->select('*');
        $this->db->from('tbl_pricing_table');
        $query = $this->db->get();
        return $query->num_rows();
    }
    
}