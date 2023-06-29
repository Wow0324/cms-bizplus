<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_term extends MY_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_page_term');
    }

	public function index()
	{
		$data['setting'] = $this->Model_common->get_setting_data();
		$data['page_term'] = $this->Model_page_term->show();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_page_term',$data);
		$this->load->view('admin/view_footer');
	}


	public function edit($id)
	{
		
    	$tot = $this->Model_page_term->page_term_check($id);
    	if(!$tot) {
    		redirect(base_url().M_REWRITE.'admin/page-term');
        	exit;
    	}
       	
       	$data['setting'] = $this->Model_common->get_setting_data();
		$error = '';
		$success = '';


		if(isset($_POST['form1'])) 
		{

			$valid = 1;

			$term_heading = secure_data($this->input->post('term_heading', true));
			$term_content = secure_data($this->input->post('term_content', true));

			$this->form_validation->set_rules('term_heading', 'Heading', 'trim|required');
			$this->form_validation->set_rules('term_content', 'Content', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error .= validation_errors();
            }

		    if($valid == 1) 
		    {
	    		$form_data = array(
					'term_heading' => $term_heading,
					'term_content' => $term_content
	            );
	            $this->Model_page_term->update($id,$form_data);				
				
				$success = 'Term Page information is updated successfully';
				$this->session->set_flashdata('success',$success);
				redirect(base_url().M_REWRITE.'admin/page-term');
		    }
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().M_REWRITE.'admin/page-term/edit'.$id);
		    }
           
		} else {
			$data['page_term'] = $this->Model_page_term->get_page_term($id);
	       	$this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_page_term_edit',$data);
			$this->load->view('admin/view_footer');
		}

	}

}