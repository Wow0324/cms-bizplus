<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_blog extends MY_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_page_blog');
    }

	public function index()
	{
		$data['setting'] = $this->Model_common->get_setting_data();
		$data['page_blog'] = $this->Model_page_blog->show();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_page_blog',$data);
		$this->load->view('admin/view_footer');
	}


	public function edit($id)
	{
		
    	$tot = $this->Model_page_blog->page_blog_check($id);
    	if(!$tot) {
    		redirect(base_url().M_REWRITE.'admin/page-blog');
        	exit;
    	}
       	
       	$data['setting'] = $this->Model_common->get_setting_data();
		$error = '';
		$success = '';


		if(isset($_POST['form1'])) 
		{

			$valid = 1;

			$blog_heading = secure_data($this->input->post('blog_heading', true));

			$this->form_validation->set_rules('blog_heading', 'Heading', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error .= validation_errors();
            }

		    if($valid == 1) 
		    {
	    		$form_data = array(
					'blog_heading' => $blog_heading
	            );
	            $this->Model_page_blog->update($id,$form_data);				
				
				$success = 'Blog Page information is updated successfully';
				$this->session->set_flashdata('success',$success);
				redirect(base_url().M_REWRITE.'admin/page-blog');
		    }
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().M_REWRITE.'admin/page-blog/edit'.$id);
		    }
           
		} else {
			$data['page_blog'] = $this->Model_page_blog->get_page_blog($id);
	       	$this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_page_blog_edit',$data);
			$this->load->view('admin/view_footer');
		}

	}

}