<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends MY_Controller {
	function __construct()
	{
        parent::__construct();
        $this->load->model('Model_common');
        $this->load->model('Model_blog');
    }

	public function index()
	{
		$data['setting'] = $this->Model_common->all_setting();
		$data['page_home'] = $this->Model_common->all_page_home();
		$data['page_blog'] = $this->Model_common->all_page_blog();
		$data['comment'] = $this->Model_common->all_comment();
		$data['social'] = $this->Model_common->all_social();
		$data['all_blogs'] = $this->Model_common->all_blogs();
		$data['all_categories'] = $this->Model_common->all_categories();

		$data['blogs'] = $this->Model_blog->all_blogs();
		
		$this->load->library('pagination');

		$config = array();
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">';
	    $config['full_tag_close']   = '</ul></nav></div>';
	    $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
	    $config['num_tag_close']    = '</span></li>';
	    $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
	    $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
	    $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
	    $config['next_tag_close']  = '<span aria-hidden="true"></span></span></li>';
	    $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
	    $config['prev_tag_close']  = '</span></li>';
	    $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
	    $config['first_tag_close'] = '</span></li>';
	    $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
	    $config['last_tag_close']  = '</span></li>';

        $config["base_url"] = base_url() . M_REWRITE. "blog/index";
        $config["total_rows"] = $this->Model_blog->get_total_blogs();
        $config['first_url'] = base_url() . M_REWRITE . 'blog';
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config);

        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['blog_fetched'] = $this->Model_blog->fetch_blog($config["per_page"], $offset);
        $data['links'] = $this->pagination->create_links();
		
		$this->load->view('view_header',$data);
		$this->load->view('view_blog',$data);
		$this->load->view('view_footer',$data);
	}

	public function view($slug=0)
	{
		if( !isset($slug) ) {
			redirect(base_url());
		}

		$tot = $this->Model_blog->blog_check($slug);
		if(!$tot) {
			redirect(base_url());
		}

		$data['setting'] = $this->Model_common->all_setting();
		$data['page_home'] = $this->Model_common->all_page_home();
		$data['page_blog'] = $this->Model_common->all_page_blog();
		$data['comment'] = $this->Model_common->all_comment();
		$data['social'] = $this->Model_common->all_social();
		$data['all_blogs'] = $this->Model_common->all_blogs();
		$data['all_categories'] = $this->Model_common->all_categories();

		$data['blogs'] = $this->Model_blog->all_blogs();
		$data['blog_detail'] = $this->Model_blog->blog_detail_with_category($slug);
		$data['category'] = $this->Model_blog->get_category_name_by_id($data['blog_detail']['category_id']);
		$data['category_name'] = $data['category']['category_name'];
		$data['slug'] = $slug;

		$data['categories'] = $this->Model_blog->all_categories();
		
		$this->load->view('view_header',$data);
		$this->load->view('view_blog_detail',$data);
		$this->load->view('view_footer',$data);

	}
}