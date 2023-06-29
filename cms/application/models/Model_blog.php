
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_blog extends CI_Model 
{
    public function all_blogs()
    {
        $query = $this->db->query("SELECT * 
                            FROM tbl_blog t1
                            JOIN tbl_category t2
                            ON t1.category_id = t2.category_id
                            WHERE t1.lang_id=?
                            ORDER BY t1.id ASC",
                            [$_SESSION['sess_lang_id']]
                        );
        return $query->result_array();
    }

    public function get_total_blogs() 
    {
        $this->db->select('*');
        $this->db->from('tbl_blog');
        $this->db->where('lang_id', $_SESSION['sess_lang_id']);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function fetch_blog($limit, $start) 
    {
        $this->db->select('*');
        $this->db->from('tbl_blog');
        $this->db->join('tbl_category', 'tbl_blog.category_id = tbl_category.category_id');
        $this->db->limit($limit, $start);
        $this->db->where('tbl_blog.lang_id', $_SESSION['sess_lang_id']);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();

        if($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function all_categories()
    {
        $query = $this->db->query("SELECT * FROM tbl_category WHERE lang_id=? ORDER BY category_name ASC",[$_SESSION['sess_lang_id']]);
        return $query->result_array();
    }

    public function blog_check($slug)
    {
        $this->db->select('*');
        $this->db->from('tbl_blog');
        $this->db->where('slug', $slug);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function blog_detail($slug)
    {
        $this->db->select('*');
        $this->db->from('tbl_blog');
        $this->db->where('slug', $slug);
        $query = $this->db->get();
        return $query->first_row('array');
    }

    public function blog_detail_with_category($slug)
    {
        $this->db->select('*');
        $this->db->from('tbl_blog');
        $this->db->join('tbl_category', 'tbl_blog.category_id = tbl_category.category_id');
        $this->db->where('slug', $slug);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->first_row('array');
    }

    public function get_category_name_by_id($cat_id) 
    {
        $this->db->select('*');
        $this->db->from('tbl_category');
        $this->db->where('category_id', $cat_id);
        $query = $this->db->get();
        return $query->first_row('array');
    }

    public function s_data()
    {
        $query = $this->db->query("SELECT * FROM tbl_page_blog WHERE lang_id=?",[$_SESSION['sess_lang_id']]);
        return $query->first_row('array');
    }
}