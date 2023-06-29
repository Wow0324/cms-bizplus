<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team_member extends MY_Controller {
	function __construct()
	{
        parent::__construct();
        $this->load->model('Model_common');
        $this->load->model('Model_team_member');
    }

    public function index()
	{
		redirect(base_url());
	}

	public function view($slug=0)
	{
		if( !isset($slug) ) {
			redirect(base_url());
		}

		$tot = $this->Model_team_member->team_member_check($slug);
		if(!$tot) {
			redirect(base_url());
		}

		$data['setting'] = $this->Model_common->all_setting();
		$data['page_team_member'] = $this->Model_common->all_page_team_member();
		$data['comment'] = $this->Model_common->all_comment();
		$data['social'] = $this->Model_common->all_social();
		$data['all_blogs'] = $this->Model_common->all_blogs();

		$data['team_members'] = $this->Model_team_member->all_team_member();
		$data['member'] = $this->Model_team_member->team_member_detail($slug);


		$data['slug'] = $slug;

		$this->load->view('view_header',$data);
		$this->load->view('view_team_member',$data);
		$this->load->view('view_footer');
	}
}