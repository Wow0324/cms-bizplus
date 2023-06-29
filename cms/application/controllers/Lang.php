<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lang extends CI_Controller {

	function __construct()
	{
        parent::__construct();
        $this->load->model('Model_common');
        $this->load->model('Model_lang');
    }

	public function index()
	{
		redirect(base_url());
	}

	public function change()
	{
		$lang_change_id = $this->input->post('lang_change_id', true);
        $_SESSION['sess_lang_id'] = $lang_change_id;
        redirect($this->agent->referrer());
	}
}