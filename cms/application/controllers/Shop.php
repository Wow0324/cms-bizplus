<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends MY_Controller {

	function __construct()
	{
        parent::__construct();
        $this->load->model('Model_common');
        $this->load->model('Model_shop');
    }

	public function index()
	{
		$data['setting'] = $this->Model_common->all_setting();
		$data['page_shop'] = $this->Model_common->all_page_shop();
		$data['comment'] = $this->Model_common->all_comment();
		$data['social'] = $this->Model_common->all_social();
		$data['all_blogs'] = $this->Model_common->all_blogs();
		$data['products'] = $this->Model_shop->all_products();

		$this->load->view('view_header',$data);
		$this->load->view('view_shop',$data);
		$this->load->view('view_footer',$data);
	
	}
}