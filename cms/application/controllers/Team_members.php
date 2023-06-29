<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team_members extends MY_Controller {
	function __construct()
	{
        parent::__construct();
        $this->load->model('Model_common');
        $this->load->model('Model_team_member');
    }

	public function index()
	{
		$data['setting'] = $this->Model_common->all_setting();
		$data['page_team_member'] = $this->Model_common->all_page_team_member();
		$data['comment'] = $this->Model_common->all_comment();
		$data['social'] = $this->Model_common->all_social();
		$data['all_blogs'] = $this->Model_common->all_blogs();

		$data['team_members'] = $this->Model_team_member->all_team_member();
		
		$this->load->view('view_header',$data);
		$this->load->view('view_team_members',$data);
		$this->load->view('view_footer',$data);
	}	
}