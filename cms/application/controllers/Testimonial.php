<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonial extends MY_Controller {
	function __construct()
	{
        parent::__construct();
        $this->load->model('Model_common');
        $this->load->model('Model_testimonial');
    }

	public function index()
	{
		$data['setting'] = $this->Model_common->all_setting();
		$data['page_testimonial'] = $this->Model_common->all_page_testimonial();
		$data['comment'] = $this->Model_common->all_comment();
		$data['social'] = $this->Model_common->all_social();
		$data['all_blogs'] = $this->Model_common->all_blogs();

		$data['testimonials'] = $this->Model_testimonial->all_testimonial();

		$this->load->view('view_header',$data);
		$this->load->view('view_testimonial',$data);
		$this->load->view('view_footer',$data);
	}
}