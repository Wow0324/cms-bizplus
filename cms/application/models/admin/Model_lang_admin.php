<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_lang_admin extends CI_Model {

    function get_auto_increment_id()
    {
        $sql = "SHOW TABLE STATUS LIKE 'tbl_lang'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    function show()
    {
        $sql = "SELECT * FROM tbl_lang ORDER BY lang_id ASC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function make_all_empty($data)
    {
        $this->db->update('tbl_lang',$data);
    }

    function add($data) {
        $this->db->insert('tbl_lang',$data);
        return $this->db->insert_id();
    }

    function add_detail($data) {
        $this->db->insert('tbl_lang_key',$data);
        return $this->db->insert_id();
    }

    function add_page_about($data) {
        $this->db->insert('tbl_page_about',$data);
        return $this->db->insert_id();
    }

    function add_page_service($data) {
        $this->db->insert('tbl_page_service',$data);
        return $this->db->insert_id();
    }

    function add_page_faq($data) {
        $this->db->insert('tbl_page_faq',$data);
        return $this->db->insert_id();
    }

    function add_page_photo_gallery($data) {
        $this->db->insert('tbl_page_photo_gallery',$data);
        return $this->db->insert_id();
    }

    function add_page_video_gallery($data) {
        $this->db->insert('tbl_page_video_gallery',$data);
        return $this->db->insert_id();
    }

    function add_page_term($data) {
        $this->db->insert('tbl_page_term',$data);
        return $this->db->insert_id();
    }

    function add_page_privacy($data) {
        $this->db->insert('tbl_page_privacy',$data);
        return $this->db->insert_id();
    }

    function add_page_team_member($data) {
        $this->db->insert('tbl_page_team_member',$data);
        return $this->db->insert_id();
    }

    function add_page_contact($data) {
        $this->db->insert('tbl_page_contact',$data);
        return $this->db->insert_id();
    }

    function add_page_blog($data) {
        $this->db->insert('tbl_page_blog',$data);
        return $this->db->insert_id();
    }

    function add_page_home($data) {
        $this->db->insert('tbl_page_home',$data);
        return $this->db->insert_id();
    }

    function add_page_shop($data) {
        $this->db->insert('tbl_page_shop',$data);
        return $this->db->insert_id();
    }

    function add_menu_lang($data) {
        $this->db->insert('tbl_menu_lang',$data);
        return $this->db->insert_id();
    }

    function update($id,$data) {
        $this->db->where('lang_id',$id);
        $this->db->update('tbl_lang',$data);
    }

    function delete($id)
    {
        $this->db->where('lang_id',$id);
        $this->db->delete('tbl_lang');
    }

    function delete_detail($id)
    {
        $this->db->where('lang_id',$id);
        $this->db->delete('tbl_lang_key');
    }

    function delete_page_about($id)
    {
        $this->db->where('lang_id',$id);
        $this->db->delete('tbl_page_about');
    }
    function delete_page_service($id)
    {
        $this->db->where('lang_id',$id);
        $this->db->delete('tbl_page_service');
    }
    function delete_page_faq($id)
    {
        $this->db->where('lang_id',$id);
        $this->db->delete('tbl_page_faq');
    }
    function delete_page_photo_gallery($id)
    {
        $this->db->where('lang_id',$id);
        $this->db->delete('tbl_page_photo_gallery');
    }
    function delete_page_video_gallery($id)
    {
        $this->db->where('lang_id',$id);
        $this->db->delete('tbl_page_video_gallery');
    }
    function delete_page_term($id)
    {
        $this->db->where('lang_id',$id);
        $this->db->delete('tbl_page_term');
    }
    function delete_page_privacy($id)
    {
        $this->db->where('lang_id',$id);
        $this->db->delete('tbl_page_privacy');
    }
    function delete_page_team_member($id)
    {
        $this->db->where('lang_id',$id);
        $this->db->delete('tbl_page_team_member');
    }
    function delete_page_contact($id)
    {
        $this->db->where('lang_id',$id);
        $this->db->delete('tbl_page_contact');
    }
    function delete_page_blog($id)
    {
        $this->db->where('lang_id',$id);
        $this->db->delete('tbl_page_blog');
    }
    function delete_page_home($id)
    {
        $this->db->where('lang_id',$id);
        $this->db->delete('tbl_page_home');
    }
    function delete_page_shop($id)
    {
        $this->db->where('lang_id',$id);
        $this->db->delete('tbl_page_shop');
    }
    function delete_menu_lang($id)
    {
        $this->db->where('lang_id',$id);
        $this->db->delete('tbl_menu_lang');
    }
    function delete_menu_parent($id)
    {
        $this->db->where('lang_id',$id);
        $this->db->delete('tbl_menu_parent');
    }
    function delete_menu_child($id)
    {
        $this->db->where('lang_id',$id);
        $this->db->delete('tbl_menu_child');
    }


    function getData($id)
    {
        $sql = 'SELECT * FROM tbl_lang WHERE lang_id=?';
        $query = $this->db->query($sql,array($id));
        return $query->first_row('array');
    }

    function lang_check($id)
    {
        $sql = 'SELECT * FROM tbl_lang WHERE lang_id=?';
        $query = $this->db->query($sql,array($id));
        return $query->first_row('array');
    }

    function detail($id) {
        $sql = "SELECT * FROM tbl_lang_key WHERE lang_id=?";
        $query = $this->db->query($sql,array($id));
        return $query->result_array();
    }

    function update_detail($id,$data) {
        $this->db->where('lang_key_id',$id);
        $this->db->update('tbl_lang_key',$data);
    }
    
}