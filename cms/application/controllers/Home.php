<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	function __construct()
	{
        parent::__construct();
        $this->load->model('Model_common');
        $this->load->model('Model_home');
    }

	public function index()
	{
		if(!isset($_SESSION['sess_lang_id'])) {
			$_SESSION['sess_lang_id'] = 1;
		}

		$data['setting'] = $this->Model_common->all_setting();
		$data['page_home'] = $this->Model_common->all_page_home();
		$data['page_home_lang_independent'] = $this->Model_common->all_page_home_lang_independent();
		$data['comment'] = $this->Model_common->all_comment();
		$data['social'] = $this->Model_common->all_social();
		$data['all_blogs'] = $this->Model_common->all_blogs();
		$data['all_blogs_category'] = $this->Model_common->all_blogs_category();

		$data['sliders'] = $this->Model_home->all_slider();
		$data['services'] = $this->Model_home->all_service();
		$data['why_choose'] = $this->Model_home->all_why_choose();
		$data['team_members'] = $this->Model_home->all_team_member();
		$data['testimonials'] = $this->Model_home->all_testimonial();

		$this->load->view('view_header',$data);
		$this->load->view('view_home',$data);
		$this->load->view('view_footer',$data);
	}
}