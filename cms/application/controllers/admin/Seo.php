<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seo extends MY_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_seo');
    }
	public function index()
	{
		$error = '';
		$success = '';

		$data['setting'] = $this->Model_common->get_setting_data();
		$data['seo'] = $this->Model_seo->show_seo();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_seo',$data);
		$this->load->view('admin/view_footer');
		
	}
	public function update()
	{
		$error = '';
		$success = '';

		if(isset($_POST['form_seo'])) {

			$title = secure_data($this->input->post('title', true));
			$keyword = secure_data($this->input->post('keyword', true));
			$description = secure_data($this->input->post('description', true));

        	$form_data = array(
				'title'       => $title,
				'keyword'     => $keyword,
				'description' => $description
            );
        	$this->Model_seo->update_seo($form_data);
        	$success = 'SEO information is updated successfully!';
        	$this->session->set_flashdata('success',$success);
		    redirect(base_url().M_REWRITE.'admin/seo');
		}

	}
	
}
