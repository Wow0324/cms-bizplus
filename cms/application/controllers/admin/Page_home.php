<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_home extends MY_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_page_home');
    }

	public function index()
	{
		$data['setting'] = $this->Model_common->get_setting_data();
		$data['page_home'] = $this->Model_page_home->show();
		$data['page_home_lang_independent'] = $this->Model_page_home->all_page_home_lang_independent();

		if(isset($_POST['form_home_welcome']))
		{
			$home_welcome_video = secure_data($this->input->post('home_welcome_video', true));
			$home_welcome_status = secure_data($this->input->post('home_welcome_status', true));

        	$form_data = array(
				'home_welcome_video'  => $home_welcome_video,
				'home_welcome_status' => $home_welcome_status
            );
        	$this->Model_page_home->update_home_lang_independent($form_data);
        	$success = 'Home page welcome information is updated successfully!';
        	$this->session->set_flashdata('success',$success);
		    redirect(base_url().M_REWRITE.'admin/page-home');
		}
		elseif(isset($_POST['form_home_why_choose']))
		{
			$home_why_choose_status = secure_data($this->input->post('home_why_choose_status', true));
        	$form_data = array(
				'home_why_choose_status' => $home_why_choose_status
            );
        	$this->Model_page_home->update_home_lang_independent($form_data);
        	$success = 'Home page why choose us information is updated successfully!';
        	$this->session->set_flashdata('success',$success);
		    redirect(base_url().M_REWRITE.'admin/page-home');
		}
		elseif(isset($_POST['form_home_feature']))
		{
			$home_feature_status = secure_data($this->input->post('home_feature_status', true));
        	$form_data = array(
				'home_feature_status' => $home_feature_status
            );
        	$this->Model_page_home->update_home_lang_independent($form_data);
        	$success = 'Home page feature information is updated successfully!';
        	$this->session->set_flashdata('success',$success);
		    redirect(base_url().M_REWRITE.'admin/page-home');
		}
		elseif(isset($_POST['form_home_service']))
		{
			$home_service_status = secure_data($this->input->post('home_service_status', true));
        	$form_data = array(
				'home_service_status' => $home_service_status
            );
        	$this->Model_page_home->update_home_lang_independent($form_data);
        	$success = 'Home page service information is updated successfully!';
        	$this->session->set_flashdata('success',$success);
		    redirect(base_url().M_REWRITE.'admin/page-home');
		}
		elseif(isset($_POST['form_home_testimonial']))
		{
			$home_testimonial_status = secure_data($this->input->post('home_testimonial_status', true));
        	$form_data = array(
				'home_testimonial_status' => $home_testimonial_status
            );
        	$this->Model_page_home->update_home_lang_independent($form_data);
        	$success = 'Home page testimonial information is updated successfully!';
        	$this->session->set_flashdata('success',$success);
		    redirect(base_url().M_REWRITE.'admin/page-home');
		}
		elseif(isset($_POST['form_home_testimonial_photo']))
		{
			$valid = 1;
			$path = $_FILES['home_testimonial_photo']['name'];
		    $path_tmp = $_FILES['home_testimonial_photo']['tmp_name'];
		    if($path!='') {
		        $ext = pathinfo( $path, PATHINFO_EXTENSION );
		        $file_name = basename( $path, '.' . $ext );
		        $ext_check = $this->Model_common->extension_check_photo($ext);
		        if($ext_check == FALSE) {
		            $valid = 0;
		            $error = 'You must have to upload jpg, jpeg, gif or png file<br>';
		        }
		    } else {
		    	$valid = 0;
		        $error = 'You must have to select a photo<br>';
		    }
		    if($valid == 1) {
		    	unlink('./public/uploads/'.$data['page']['home_testimonial_photo']);
		    	$final_name = 'home_testimonial_photo'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );
		    			        
				$form_data = array(
					'home_testimonial_photo' => $final_name
	            );
	        	$this->Model_page_home->update_home_lang_independent($form_data);

	        	$success = 'Home page testimonial photo is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().M_REWRITE.'admin/page-home');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().M_REWRITE.'admin/page-home');
		    }
		}
		elseif(isset($_POST['form_home_blog']))
		{
			$home_blog_item = secure_data($this->input->post('home_blog_item', true));
			$home_blog_status = secure_data($this->input->post('home_blog_status', true));
        	$form_data = array(
				'home_blog_item'   => $home_blog_item,
				'home_blog_status' => $home_blog_status
            );
        	$this->Model_page_home->update_home_lang_independent($form_data);
        	$success = 'Home page blog information is updated successfully!';
        	$this->session->set_flashdata('success',$success);
		    redirect(base_url().M_REWRITE.'admin/page-home');
		}
		else
		{
			$this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_page_home',$data);
			$this->load->view('admin/view_footer');	
		}
	}


	public function edit($id)
	{
    	$tot = $this->Model_page_home->page_home_check($id);
    	if(!$tot) {
    		redirect(base_url().M_REWRITE.'admin/page-home');
        	exit;
    	}
       	
       	$data['setting'] = $this->Model_common->get_setting_data();
		$error = '';
		$success = '';

		if(isset($_POST['form1'])) 
		{
			$home_welcome_title = secure_data($this->input->post('home_welcome_title', true));
			$home_welcome_subtitle = secure_data($this->input->post('home_welcome_subtitle', true));
			$home_welcome_text = secure_data($this->input->post('home_welcome_text', true));
			$home_why_choose_title = secure_data($this->input->post('home_why_choose_title', true));
			$home_why_choose_subtitle = secure_data($this->input->post('home_why_choose_subtitle', true));
			$home_feature_title = secure_data($this->input->post('home_feature_title', true));
			$home_feature_subtitle = secure_data($this->input->post('home_feature_subtitle', true));
			$home_service_title = secure_data($this->input->post('home_service_title', true));
			$home_service_subtitle = secure_data($this->input->post('home_service_subtitle', true));
			$home_testimonial_title = secure_data($this->input->post('home_testimonial_title', true));
			$home_testimonial_subtitle = secure_data($this->input->post('home_testimonial_subtitle', true));
			$home_blog_title = secure_data($this->input->post('home_blog_title', true));
			$home_blog_subtitle = secure_data($this->input->post('home_blog_subtitle', true));

    		$form_data = array(
				'home_welcome_title'        => $home_welcome_title,
				'home_welcome_subtitle'     => $home_welcome_subtitle,
				'home_welcome_text'         => $home_welcome_text,
				'home_why_choose_title'     => $home_why_choose_title,
				'home_why_choose_subtitle'  => $home_why_choose_subtitle,
				'home_feature_title'        => $home_feature_title,
				'home_feature_subtitle'     => $home_feature_subtitle,
				'home_service_title'        => $home_service_title,
				'home_service_subtitle'     => $home_service_subtitle,
				'home_testimonial_title'    => $home_testimonial_title,
				'home_testimonial_subtitle' => $home_testimonial_subtitle,
				'home_blog_title'           => $home_blog_title,
				'home_blog_subtitle'        => $home_blog_subtitle
            );
            $this->Model_page_home->update($id,$form_data);				
			
			$success = 'Home Page information is updated successfully';
			$this->session->set_flashdata('success',$success);
			redirect(base_url().M_REWRITE.'admin/page-home');
		       
		}
		else
		{
			$data['page_home'] = $this->Model_page_home->get_page_home($id);
	       	$this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_page_home_edit',$data);
			$this->load->view('admin/view_footer');
		}
	}
}