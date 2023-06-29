<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_team_member extends MY_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_page_team_member');
    }

	public function index()
	{
		$data['setting'] = $this->Model_common->get_setting_data();
		$data['page_team_member'] = $this->Model_page_team_member->show();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_page_team_member',$data);
		$this->load->view('admin/view_footer');
	}


	public function edit($id)
	{
		
    	$tot = $this->Model_page_team_member->page_team_member_check($id);
    	if(!$tot) {
    		redirect(base_url().M_REWRITE.'admin/page-team-member');
        	exit;
    	}
       	
       	$data['setting'] = $this->Model_common->get_setting_data();
		$error = '';
		$success = '';


		if(isset($_POST['form1'])) 
		{

			$valid = 1;

			$team_member_heading = secure_data($this->input->post('team_member_heading', true));

			$this->form_validation->set_rules('team_member_heading', 'Heading', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error .= validation_errors();
            }

		    if($valid == 1) 
		    {
	    		$form_data = array(
					'team_member_heading' => $team_member_heading
	            );
	            $this->Model_page_team_member->update($id,$form_data);				
				
				$success = 'Team Member Page information is updated successfully';
				$this->session->set_flashdata('success',$success);
				redirect(base_url().M_REWRITE.'admin/page-team-member');
		    }
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().M_REWRITE.'admin/page-team-member/edit'.$id);
		    }
           
		} else {
			$data['page_team_member'] = $this->Model_page_team_member->get_page_team_member($id);
	       	$this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_page_team_member_edit',$data);
			$this->load->view('admin/view_footer');
		}

	}

}