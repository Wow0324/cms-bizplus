<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends MY_Controller {
	function __construct()
	{
        parent::__construct();
        $this->load->model('Model_common');
        $this->load->model('Model_service');
    }

	public function index()
	{
		$data['setting'] = $this->Model_common->all_setting();
		$data['page_service'] = $this->Model_common->all_page_service();
		$data['comment'] = $this->Model_common->all_comment();
		$data['social'] = $this->Model_common->all_social();
		$data['all_blogs'] = $this->Model_common->all_blogs();

		$data['services'] = $this->Model_service->all_service();

		$this->load->view('view_header',$data);
		$this->load->view('view_service',$data);
		$this->load->view('view_footer',$data);
	}

	public function view($slug=0)
	{
		if( !isset($slug) ) {
			redirect(base_url());
		}

		$tot = $this->Model_service->service_check($slug);
		if(!$tot) {
			redirect(base_url());
		}

		$data['setting'] = $this->Model_common->all_setting();
		$data['page_service'] = $this->Model_common->all_page_service();
		$data['comment'] = $this->Model_common->all_comment();
		$data['social'] = $this->Model_common->all_social();
		$data['all_blogs'] = $this->Model_common->all_blogs();

		$data['services'] = $this->Model_service->all_service();
		$data['service'] = $this->Model_service->service_detail($slug);


		$data['slug'] = $slug;

		$this->load->view('view_header',$data);
		$this->load->view('view_service_detail',$data);
		$this->load->view('view_footer');
	}
}