<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!isset($_SESSION['sess_lang_id'])) {
    $_SESSION['sess_lang_id'] = 1;
}

class Model_common extends CI_Model 
{
    public function all_setting()
    {
        $this->db->select('*');
        $this->db->from('tbl_settings');
        $this->db->where('id', 1);
        $query = $this->db->get();
        return $query->first_row('array');
    }
    public function all_seo()
    {
        $this->db->select('*');
        $this->db->from('tbl_seo');
        $this->db->where('id', 1);
        $query = $this->db->get();
        return $query->first_row('array');
    }
    public function all_page_home()
    {
        $this->db->select('*');
        $this->db->from('tbl_page_home');
         $this->db->where('lang_id', $_SESSION['sess_lang_id']);
        $query = $this->db->get();
        return $query->first_row('array');
    }
    public function all_page_home_lang_independent()
    {
        $this->db->select('*');
        $this->db->from('tbl_page_home_lang_independent');
         $this->db->where('id', 1);
        $query = $this->db->get();
        return $query->first_row('array');
    }
    public function all_page_about()
    {
        $this->db->select('*');
        $this->db->from('tbl_page_about');
        $this->db->where('lang_id', $_SESSION['sess_lang_id']);
        $query = $this->db->get();
        return $query->first_row('array');
    }
    public function all_page_faq()
    {
        $this->db->select('*');
        $this->db->from('tbl_page_faq');
        $this->db->where('lang_id', $_SESSION['sess_lang_id']);
        $query = $this->db->get();
        return $query->first_row('array');
    }
    public function all_page_service()
    {
        $this->db->select('*');
        $this->db->from('tbl_page_service');
        $this->db->where('lang_id', $_SESSION['sess_lang_id']);
        $query = $this->db->get();
        return $query->first_row('array');
    }
    public function all_page_photo_gallery()
    {
        $this->db->select('*');
        $this->db->from('tbl_page_photo_gallery');
        $this->db->where('lang_id', $_SESSION['sess_lang_id']);
        $query = $this->db->get();
        return $query->first_row('array');
    }
    public function all_page_video_gallery()
    {
        $this->db->select('*');
        $this->db->from('tbl_page_video_gallery');
        $this->db->where('lang_id', $_SESSION['sess_lang_id']);
        $query = $this->db->get();
        return $query->first_row('array');
    }
    public function all_page_blog()
    {
        $this->db->select('*');
        $this->db->from('tbl_page_blog');
        $this->db->where('lang_id', $_SESSION['sess_lang_id']);
        $query = $this->db->get();
        return $query->first_row('array');
    }
    public function all_page_contact()
    {
        $this->db->select('*');
        $this->db->from('tbl_page_contact');
        $this->db->where('lang_id', $_SESSION['sess_lang_id']);
        $query = $this->db->get();
        return $query->first_row('array');
    }
    public function all_page_term()
    {
        $this->db->select('*');
        $this->db->from('tbl_page_term');
        $this->db->where('lang_id', $_SESSION['sess_lang_id']);
        $query = $this->db->get();
        return $query->first_row('array');
    }
    public function all_page_privacy()
    {
        $this->db->select('*');
        $this->db->from('tbl_page_privacy');
        $this->db->where('lang_id', $_SESSION['sess_lang_id']);
        $query = $this->db->get();
        return $query->first_row('array');
    }
    public function all_page_team_member()
    {
        $this->db->select('*');
        $this->db->from('tbl_page_team_member');
        $this->db->where('lang_id', $_SESSION['sess_lang_id']);
        $query = $this->db->get();
        return $query->first_row('array');
    }
    public function all_page_shop()
    {
        $this->db->select('*');
        $this->db->from('tbl_page_shop');
        $this->db->where('lang_id', $_SESSION['sess_lang_id']);
        $query = $this->db->get();
        return $query->first_row('array');
    }
    public function all_comment()
    {
        $this->db->select('*');
        $this->db->from('tbl_comment');
        $this->db->where('id', 1);
        $query = $this->db->get();
        return $query->first_row('array');
    }
    public function all_social()
    {
        $this->db->select('*');
        $this->db->from('tbl_social');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function all_blogs()
    {
        $this->db->select('*');
        $this->db->from('tbl_blog');
        $this->db->where('lang_id', $_SESSION['sess_lang_id']);
        $this->db->order_by('id', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function all_blogs_category()
    {
        $this->db->select('*');
        $this->db->from('tbl_blog');
        $this->db->join('tbl_category', 'tbl_blog.category_id = tbl_category.category_id');
        $this->db->where('tbl_blog.lang_id', $_SESSION['sess_lang_id']);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function all_categories()
    {
        $query = $this->db->query("SELECT * FROM tbl_category WHERE lang_id=? ORDER BY category_name ASC",[$_SESSION['sess_lang_id']]);
        return $query->result_array();
    }
    public function extension_check_photo($ext) {
        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' && $ext!='JPG' && $ext!='PNG' && $ext!='JPEG' && $ext!='GIF' ) {
            return false;
        } else {
            return true;
        }
    }
    public function get_language_data()
    {
        $this->db->select('*');
        $this->db->from('tbl_lang');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function n_format($number,$how_many_digits_after_point)
    {
        return number_format((float)$number, $how_many_digits_after_point, '.', '');
    }
}