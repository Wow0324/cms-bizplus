<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller {
	function __construct()
	{
        parent::__construct();
        $this->load->model('Model_common');
        $this->load->model('Model_category');
    }

	public function index($slug=0)
	{
		if( !isset($slug) ) {
			redirect(base_url());
		}

		$tot = $this->Model_category->category_check($slug);
		if(!$tot) {
			redirect(base_url());
		}


		$data['setting'] = $this->Model_common->all_setting();
		$data['page_home'] = $this->Model_common->all_page_home();
		$data['comment'] = $this->Model_common->all_comment();
		$data['social'] = $this->Model_common->all_social();
		$data['all_blogs'] = $this->Model_common->all_blogs();
		$data['all_categories'] = $this->Model_common->all_categories();
		
		$data['category'] = $this->Model_category->category_by_slug($slug);
		$data['blogs_by_category'] = $this->Model_category->all_blogs_by_category_id($data['category']['category_id']);

		$this->load->view('view_header',$data);
		$this->load->view('view_category',$data);
		$this->load->view('view_footer',$data);
	}
}