<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Why_choose extends MY_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_why_choose');
    }

	public function index()
	{
		$data['setting'] = $this->Model_common->get_setting_data();

		$data['why_choose'] = $this->Model_why_choose->show();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_why_choose',$data);
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

			$name = secure_data($this->input->post('name', true));
			$content = secure_data($this->input->post('content', true));
			$icon = secure_data($this->input->post('icon', true));
			$lang_id  = secure_data($this->input->post('lang_id', true));

			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('content', 'Content', 'trim|required');
			$this->form_validation->set_rules('icon', 'Icon', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error .= validation_errors();
            }

	    
		    if($valid == 1) 
		    {

		        $form_data = array(
					'name'    => $name,
					'content' => $content,
					'icon'    => $icon,
					'lang_id' => $lang_id
	            );
	            $this->Model_why_choose->add($form_data);

		        $success = 'Why Choose Us Section is added successfully!';
		        $this->session->set_flashdata('success',$success);
				redirect(base_url().M_REWRITE.'admin/why_choose');
		    } 
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().M_REWRITE.'admin/why_choose/add');
		    }
            
        } else {
            
            $this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_why_choose_add',$data);
			$this->load->view('admin/view_footer');
        }
		
	}


	public function edit($id)
	{
		
    	$tot = $this->Model_why_choose->why_choose_check($id);
    	if(!$tot) {
    		redirect(base_url().M_REWRITE.'admin/why_choose');
        	exit;
    	}
       	
       	$data['setting'] = $this->Model_common->get_setting_data();
       	$data['all_lang'] = $this->Model_common->all_lang();
		$error = '';
		$success = '';


		if(isset($_POST['form1'])) 
		{
			$valid = 1;

			$name = secure_data($this->input->post('name', true));
			$content = secure_data($this->input->post('content', true));
			$icon = secure_data($this->input->post('icon', true));
			$lang_id  = secure_data($this->input->post('lang_id', true));

			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('content', 'Content', 'trim|required');
			$this->form_validation->set_rules('icon', 'Icon', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error .= validation_errors();
            }

		    
		    if($valid == 1) 
		    {
		    	$data['why_choose'] = $this->Model_why_choose->getData($id);

	    		$form_data = array(
					'name'    => $name,
					'content' => $content,
					'icon'    => $icon,
					'lang_id' => $lang_id
	            );
	            $this->Model_why_choose->update($id,$form_data);
				
				$success = 'Why Choose Us Section is updated successfully';
				$this->session->set_flashdata('success',$success);
				redirect(base_url().M_REWRITE.'admin/why_choose');
		    }
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().M_REWRITE.'admin/why_choose/edit/'.$id);
		    }
           
		} else {
			$data['why_choose'] = $this->Model_why_choose->getData($id);
	       	$this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_why_choose_edit',$data);
			$this->load->view('admin/view_footer');
		}

	}


	public function delete($id) 
	{
    	$tot = $this->Model_why_choose->why_choose_check($id);
    	if(!$tot) {
    		redirect(base_url().M_REWRITE.'admin/why_choose');
        	exit;
    	}

        $this->Model_why_choose->delete($id);
        $success = 'Why Choose Us Section is deleted successfully';
        $this->session->set_flashdata('success',$success);
        redirect(base_url().M_REWRITE.'admin/why_choose');
    }

}