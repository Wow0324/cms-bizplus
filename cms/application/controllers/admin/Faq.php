<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends MY_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_faq');
    }

	public function index()
	{
		$data['setting'] = $this->Model_common->get_setting_data();
		$data['faq'] = $this->Model_faq->show();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_faq',$data);
		$this->load->view('admin/view_footer');
	}

	public function add()
	{
		$data['setting'] = $this->Model_common->get_setting_data();
		$data['all_lang'] = $this->Model_common->all_lang();

		$error = '';
		$success = '';

		if(isset($_POST['form1'])) {

			$valid = 1;

			$faq_title = secure_data($this->input->post('faq_title', true));
			$faq_content = $this->input->post('faq_content', true);
			$lang_id  = secure_data($this->input->post('lang_id', true));

			$this->form_validation->set_rules('faq_title', 'FAQ title', 'trim|required');
			$this->form_validation->set_rules('faq_content', 'FAQ content', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error = validation_errors();
            }

	   		if($valid == 1)
		    {				
		        $form_data = array(
					'faq_title'   => $faq_title,
					'faq_content' => $faq_content,
					'lang_id'     => $lang_id
	            );
	            $this->Model_faq->add($form_data);

		        $success = 'FAQ is added successfully!';
		        $this->session->set_flashdata('success',$success);
				redirect(base_url().M_REWRITE.'admin/faq');		        
		    }
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().M_REWRITE.'admin/faq/add');
		    }
            
        } else {
            $this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_faq_add',$data);
			$this->load->view('admin/view_footer');
        }
		
	}


	public function edit($id)
	{
		
    	// If there is no FAQ in this id, then redirect
    	$tot = $this->Model_faq->faq_check($id);
    	if(!$tot) {
    		redirect(base_url().M_REWRITE.'admin/faq');
        	exit;
    	}
       	
       	$data['setting'] = $this->Model_common->get_setting_data();
       	$data['all_lang'] = $this->Model_common->all_lang();

		$error = '';
		$success = '';


		if(isset($_POST['form1'])) 
		{

			$valid = 1;

			$faq_title = secure_data($this->input->post('faq_title', true));
			$faq_content = $this->input->post('faq_content', true);
			$lang_id  = secure_data($this->input->post('lang_id', true));

			$this->form_validation->set_rules('faq_title', 'FAQ title', 'trim|required');
			$this->form_validation->set_rules('faq_content', 'FAQ content', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error = validation_errors();
            }
            
		    if($valid == 1) 
		    {
		    	$data['faq'] = $this->Model_faq->getData($id);

	    		$form_data = array(
					'faq_title'   => $faq_title,
					'faq_content' => $faq_content,
					'lang_id'     => $lang_id
	            );
	            $this->Model_faq->update($id,$form_data);
				
				$success = 'FAQ is updated successfully';
				$this->session->set_flashdata('success',$success);
				redirect(base_url().M_REWRITE.'admin/faq');
		    }
		    else 
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().M_REWRITE.'admin/faq/add');
		    }

          
		} else {
			$data['faq'] = $this->Model_faq->getData($id);
	       	$this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_faq_edit',$data);
			$this->load->view('admin/view_footer');
		}

	}

	public function delete($id) 
	{
		// If there is no FAQ in this id, then redirect
    	$tot = $this->Model_faq->faq_check($id);
    	if(!$tot) {
    		redirect(base_url().M_REWRITE.'admin/faq');
        	exit;
    	}

        $this->Model_faq->delete($id);
        $success = 'FAQ is deleted successfully';
		$this->session->set_flashdata('success',$success);
		redirect(base_url().M_REWRITE.'admin/faq');
    }    

}