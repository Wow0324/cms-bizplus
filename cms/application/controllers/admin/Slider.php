<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends MY_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_slider');
    }

	public function index()
	{
		$data['setting'] = $this->Model_common->get_setting_data();
		$data['slider'] = $this->Model_slider->show();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_slider',$data);
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

			$heading  = secure_data($this->input->post('heading', true));
			$content  = secure_data($this->input->post('content', true));
			$button_text  = secure_data($this->input->post('button_text', true));
			$button_url  = secure_data($this->input->post('button_url', true));
			$position  = secure_data($this->input->post('position', true));
			$lang_id  = secure_data($this->input->post('lang_id', true));

            $path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];

		    if($path!='') {
		        $ext = pathinfo( $path, PATHINFO_EXTENSION );
		        $file_name = basename( $path, '.' . $ext );
		        $ext_check = $this->Model_common->extension_check_photo($ext);
		        if($ext_check == FALSE) {
		            $valid = 0;
		            $error = 'You must have to upload jpg, jpeg, gif or png file for featured photo<br>';
		        }
		    } else {
		    	$valid = 0;
		        $error = 'You must have to select a photo for featured photo<br>';
		    }

		    if($valid == 1) {

				$next_id = $this->Model_slider->get_auto_increment_id();
				foreach ($next_id as $row) {
		            $ai_id = $row['Auto_increment'];
		        }

		        $final_name = 'slider-'.$ai_id.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );

		        $form_data = array(
					'photo'       => $final_name,
					'heading'     => $heading,
					'content'     => $content,
					'button_text' => $button_text,
					'button_url'  => $button_url,
					'position'    => $position,
					'lang_id'     => $lang_id
	            );
	            $this->Model_slider->add($form_data);

	            $success = 'Slider is added successfully!';
	            $this->session->set_flashdata('success',$success);
	            redirect(base_url().M_REWRITE.'admin/slider');
		    }
		    else {
		    	$this->session->set_flashdata('error',$error);
	            redirect(base_url().M_REWRITE.'admin/slider/add');
		    }
        } else {
            $this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_slider_add',$data);
			$this->load->view('admin/view_footer');
        }
		
	}


	public function edit($id)
	{
		
    	// If there is no slider in this id, then redirect
    	$tot = $this->Model_slider->slider_check($id);
    	if(!$tot) {
    		redirect(base_url().M_REWRITE.'admin/slider');
        	exit;
    	}
       	
       	$data['setting'] = $this->Model_common->get_setting_data();
       	$data['all_lang'] = $this->Model_common->all_lang();
		$error = '';
		$success = '';

		if(isset($_POST['form1'])) 
		{
			$valid = 1;

			$heading  = secure_data($this->input->post('heading', true));
			$content  = secure_data($this->input->post('content', true));
			$button_text  = secure_data($this->input->post('button_text', true));
			$button_url  = secure_data($this->input->post('button_url', true));
			$position  = secure_data($this->input->post('position', true));
			$lang_id  = secure_data($this->input->post('lang_id', true));

            $path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];

		    if($path!='') {
		        $ext = pathinfo( $path, PATHINFO_EXTENSION );
		        $file_name = basename( $path, '.' . $ext );
		        $ext_check = $this->Model_common->extension_check_photo($ext);
		        if($ext_check == FALSE) {
		            $valid = 0;
		            $error = 'You must have to upload jpg, jpeg, gif or png file for featured photo<br>';
		        }
		    }

		    if($valid == 1) 
		    {
		    	$data['slider'] = $this->Model_slider->getData($id);

		    	if($path == '') {
		    		$form_data = array(
						'heading'     => $heading,
						'content'     => $content,
						'button_text' => $button_text,
						'button_url'  => $button_url,
						'position'    => $position,
						'lang_id'     => $lang_id
		            );
		            $this->Model_slider->update($id,$form_data);
				}
				else {
					unlink('./public/uploads/'.$data['slider']['photo']);

					$final_name = 'slider-'.$id.'.'.$ext;
		        	move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );

		        	$form_data = array(
						'photo'       => $final_name,
						'heading'     => $heading,
						'content'     => $content,
						'button_text' => $button_text,
						'button_url'  => $button_url,
						'position'    => $position,
						'lang_id'     => $lang_id
		            );
		            $this->Model_slider->update($id,$form_data);
				}
				
				$success = 'Slider is uploaded successfully!';
	            $this->session->set_flashdata('success',$success);
	            redirect(base_url().M_REWRITE.'admin/slider');

		    } else {
				$this->session->set_flashdata('error',$error);
	            redirect(base_url().M_REWRITE.'admin/slider/edit/'.$id);
		    }
           
		} else {
			$data['slider'] = $this->Model_slider->getData($id);
	       	$this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_slider_edit',$data);
			$this->load->view('admin/view_footer');
		}

	}


	public function delete($id) 
	{
    	$tot = $this->Model_slider->slider_check($id);
    	if(!$tot) {
    		redirect(base_url().M_REWRITE.'admin/slider');
        	exit;
    	}

        $data['slider'] = $this->Model_slider->getData($id);
        if($data['slider']) {
            unlink('./public/uploads/'.$data['slider']['photo']);
        }

        $this->Model_slider->delete($id);
        $success = 'Slider is deleted successfully!';
        $this->session->set_flashdata('success',$success);
        redirect(base_url().M_REWRITE.'admin/slider');
    }

}