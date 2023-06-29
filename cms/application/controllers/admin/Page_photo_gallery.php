<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_photo_gallery extends MY_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_page_photo_gallery');
    }

	public function index()
	{
		$data['setting'] = $this->Model_common->get_setting_data();
		$data['page_photo_gallery'] = $this->Model_page_photo_gallery->show();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_page_photo_gallery',$data);
		$this->load->view('admin/view_footer');
	}


	public function edit($id)
	{
		
    	$tot = $this->Model_page_photo_gallery->page_photo_gallery_check($id);
    	if(!$tot) {
    		redirect(base_url().M_REWRITE.'admin/page-photo-gallery');
        	exit;
    	}
       	
       	$data['setting'] = $this->Model_common->get_setting_data();
		$error = '';
		$success = '';


		if(isset($_POST['form1'])) 
		{

			$valid = 1;

			$photo_gallery_heading = secure_data($this->input->post('photo_gallery_heading', true));

			$this->form_validation->set_rules('photo_gallery_heading', 'Heading', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error .= validation_errors();
            }

		    if($valid == 1) 
		    {
	    		$form_data = array(
					'photo_gallery_heading' => $photo_gallery_heading
	            );
	            $this->Model_page_photo_gallery->update($id,$form_data);				
				
				$success = 'Photo Gallery Page information is updated successfully';
				$this->session->set_flashdata('success',$success);
				redirect(base_url().M_REWRITE.'admin/page-photo-gallery');
		    }
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().M_REWRITE.'admin/page-photo-gallery/edit'.$id);
		    }
           
		} else {
			$data['page_photo_gallery'] = $this->Model_page_photo_gallery->get_page_photo_gallery($id);
	       	$this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_page_photo_gallery_edit',$data);
			$this->load->view('admin/view_footer');
		}

	}

}