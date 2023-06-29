<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_customer extends CI_Model 
{
    function get_auto_increment_id()
    {
        $sql = "SHOW TABLE STATUS LIKE 'tbl_appointment'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

	function check_access($email) 
	{
        $where = array(
            'customer_email' => $email,
            'customer_status' => 'Active'
        );
		$this->db->select('*');
		$this->db->from('tbl_customer');
		$this->db->where($where);
		$query = $this->db->get();
		return $query->first_row('array');
    }

    function check_duplicate_email($email) 
    {
        $where = array(
            'customer_email' => $email
        );
        $this->db->select('*');
        $this->db->from('tbl_customer');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->first_row('array');
    }

    public function registration($data) {
        $this->db->insert('tbl_customer',$data);
        return $this->db->insert_id();
    }

    public function registration_confirm_check_url($email,$token) 
    {
        $this->db->select('*');
        $this->db->from('tbl_customer');
        $this->db->where('customer_email', $email);
        $this->db->where('customer_token', $token);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function registration_confirm_update($email,$token,$data) {
        $this->db->where('customer_email',$email);
        $this->db->where('customer_token',$token);
        $this->db->update('tbl_customer',$data);
    }

    public function customer_profile_edit($data,$id) {
        $this->db->where('customer_id',$id);
        $this->db->update('tbl_customer',$data);
    }

    function forget_password_check_email($email) 
    {
        $this->db->select('*');
        $this->db->from('tbl_customer');
        $this->db->where('customer_email', $email);
        $query = $this->db->get();
        return $query->first_row('array');
    }

    function forget_password_update($email,$data) 
    {
        $this->db->where('customer_email',$email);
        $this->db->update('tbl_customer',$data);
    }

    function reset_password_check_url($email,$token) 
    {
        $this->db->select('*');
        $this->db->from('tbl_customer');
        $this->db->where('customer_email', $email);
        $this->db->where('customer_token', $token);
        $query = $this->db->get();
        return $query->first_row('array');
    }

    function reset_password_update($email,$data) 
    {
        $this->db->where('customer_email',$email);
        $this->db->update('tbl_customer',$data);
    }

    function all_team_members()
    {
        $this->db->select('*');
        $this->db->from('tbl_team_member');
        $this->db->order_by('team_member_id', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function team_member_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_team_member');
        $this->db->where('team_member_id', $id);
        $query = $this->db->get();
        return $query->first_row('array');
    }

    function update_token($email,$data) {
        $this->db->where('customer_email',$email);
        $this->db->update('tbl_customer',$data);
    }

    public function all_country()
    {
        $query = $this->db->query("SELECT * FROM tbl_country ORDER BY country_name ASC");
        return $query->result_array();
    }

    public function all_orders()
    {
        $query = $this->db->query("SELECT * FROM tbl_order");
        return $query->result_array();
    }

    public function order_detail_by_order_id($id)
    {
        $query = $this->db->query("SELECT * FROM tbl_order_detail WHERE order_id=?",[$id]);
        return $query->result_array();
    }
}