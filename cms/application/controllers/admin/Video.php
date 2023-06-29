<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends MY_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_video');
    }

	public function index()
	{
		$data['setting'] = $this->Model_common->get_setting_data();

		$data['video'] = $this->Model_video->show();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_video',$data);
		$this->load->view('admin/view_footer');
	}

	public function add()
	{
		$data['setting'] = $this->Model_common->get_setting_data();
		$data['all_lang'] = $this->Model_common->all_lang();

		$error = '';
		$success = '';

		$video_type = secure_data($this->input->post('video_type', true));
		$video_code = secure_data($this->input->post('video_code', true));
		$video_caption = secure_data($this->input->post('video_caption', true));
		$lang_id  = secure_data($this->input->post('lang_id', true));

		if(isset($_POST['form1'])) {

			$valid = 1;

		    if($video_code == '') {
		        $valid = 0;
		        $error .= 'Video code can not be empty<br>';
		    }

		    if($video_caption == '') {
		        $valid = 0;
		        $error .= 'Video caption can not be empty<br>';
		    }

		    if($valid == 1) 
		    {
		        $form_data = array(
					'video_type' => $video_type,
					'video_code' => $video_code,
					'video_caption' => $video_caption,
					'lang_id' => $lang_id
	            );
	            $this->Model_video->add($form_data);

		        $success = 'Video is added successfully!';
		        $this->session->set_flashdata('success',$success);
				redirect(base_url().M_REWRITE.'admin/video');

		    } 
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().M_REWRITE.'admin/video/add');
		    }
            
        } else {            
            $this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_video_add',$data);
			$this->load->view('admin/view_footer');
        }
		
	}


	public function edit($id)
	{
    	// If there is no video in this id, then redirect
    	$tot = $this->Model_video->video_check($id);
    	if(!$tot) {
    		redirect(base_url().M_REWRITE.'admin/video');
        	exit;
    	}
       	
       	$data['setting'] = $this->Model_common->get_setting_data();
       	$data['all_lang'] = $this->Model_common->all_lang();
		$error = '';
		$success = '';

		$video_type = secure_data($this->input->post('video_type', true));
		$video_code = secure_data($this->input->post('video_code', true));
		$video_caption = secure_data($this->input->post('video_caption', true));
		$lang_id  = secure_data($this->input->post('lang_id', true));

		if(isset($_POST['form1'])) 
		{
			$data['video'] = $this->Model_video->getData($id);

			$valid = 1;

            if($video_code == '') {
		        $valid = 0;
		        $error .= 'Video code can not be empty<br>';
		    }

		    if($video_caption == '') {
		        $valid = 0;
		        $error .= 'Video caption can not be empty<br>';
		    }

		    if($valid == 1)
		    {
				$form_data = array(
					'video_type' => $video_type,
					'video_code' => $video_code,
					'video_caption' => $video_caption,
					'lang_id' => $lang_id
	            );
	            $this->Model_video->update($id,$form_data);

				$success = 'Video is updated successfully';
				$this->session->set_flashdata('success',$success);
				redirect(base_url().M_REWRITE.'admin/video');
		    }
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().M_REWRITE.'admin/video/edit'.$id);
		    }
           
		} else {
			$data['video'] = $this->Model_video->getData($id);
	       	$this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_video_edit',$data);
			$this->load->view('admin/view_footer');
		}

	}


	public function delete($id) 
	{
		// If there is no video in this id, then redirect
    	$tot = $this->Model_video->video_check($id);
    	if(!$tot) {
    		redirect(base_url().M_REWRITE.'admin/video');
        	exit;
    	}

        $this->Model_video->delete($id);
        $success = 'Video is deleted successfully';
		$this->session->set_flashdata('success',$success);
        redirect(base_url().M_REWRITE.'admin/video');
    }

}