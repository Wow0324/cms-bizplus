<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video_gallery extends MY_Controller {

	function __construct() 
	{
        parent::__construct();
        $this->load->model('Model_common');
        $this->load->model('Model_video_gallery');
    }

	public function index()
	{
		$data['setting'] = $this->Model_common->all_setting();
		$data['page_video_gallery'] = $this->Model_common->all_page_video_gallery();
		$data['comment'] = $this->Model_common->all_comment();
		$data['social'] = $this->Model_common->all_social();
		$data['all_blogs'] = $this->Model_common->all_blogs();
		
		$data['video_gallery'] = $this->Model_video_gallery->all_video();

		$this->load->view('view_header',$data);
		$this->load->view('view_video_gallery',$data);
		$this->load->view('view_footer',$data);
	}
}
