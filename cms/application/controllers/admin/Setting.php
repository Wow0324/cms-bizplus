<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends MY_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_setting');
    }
	public function index()
	{
		$error = '';
		$success = '';

		$data['setting'] = $this->Model_common->get_setting_data();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_setting',$data);
		$this->load->view('admin/view_footer');
		
	}
	public function update()
	{
		$error = '';
		$success = '';

		$data['setting'] = $this->Model_common->get_setting_data();

		if(isset($_POST['form_logo'])) {
			$valid = 1;
			$path = $_FILES['photo_logo']['name'];
		    $path_tmp = $_FILES['photo_logo']['tmp_name'];
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
		    	// removing the existing photo
		    	unlink('./public/uploads/'.$data['setting']['logo']);

		    	// updating the data
		    	$final_name = 'logo'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );
		    			        
				$form_data = array(
					'logo' => $final_name
	            );
	        	$this->Model_setting->update($form_data);

	        	$success = 'Logo is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().M_REWRITE.'admin/setting');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().M_REWRITE.'admin/setting');
		    }
		}


		if(isset($_POST['form_favicon'])) {
			$valid = 1;
			$path = $_FILES['photo_favicon']['name'];
		    $path_tmp = $_FILES['photo_favicon']['tmp_name'];
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
		    	// removing the existing photo
		    	unlink('./public/uploads/'.$data['setting']['favicon']);

		    	// updating the data
		    	$final_name = 'favicon'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );
		    			        
				$form_data = array(
					'favicon' => $final_name
	            );
	        	$this->Model_setting->update($form_data);

	        	$success = 'Favicon is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().M_REWRITE.'admin/setting');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().M_REWRITE.'admin/setting');
		    }
		}


		if(isset($_POST['form_top_bar'])) {

			$top_bar_email = secure_data($this->input->post('top_bar_email', true));
			$top_bar_phone = secure_data($this->input->post('top_bar_phone', true));

        	$form_data = array(
				'top_bar_email'    => $top_bar_email,
				'top_bar_phone'    => $top_bar_phone
            );
        	$this->Model_setting->update($form_data);   	
        	$success = 'Top Bar Setting is updated successfully!';
        	$this->session->set_flashdata('success',$success);
		    redirect(base_url().M_REWRITE.'admin/setting');
		}


		if(isset($_POST['form_footer_general'])) {

			$footer_recent_blog_item = secure_data($this->input->post('footer_recent_blog_item', true));

        	$form_data = array(
				'footer_recent_blog_item' => $footer_recent_blog_item
            );
        	$this->Model_setting->update($form_data);   	
        	$success = 'Footer General Setting is updated successfully!';
        	$this->session->set_flashdata('success',$success);
		    redirect(base_url().M_REWRITE.'admin/setting');
		}

		if(isset($_POST['form_footer_cta'])) {

			$cta_button_url = secure_data($this->input->post('cta_button_url', true));
			$cta_status = secure_data($this->input->post('cta_status', true));

        	$form_data = array(
				'cta_button_url' => $cta_button_url,
				'cta_status' => $cta_status
            );
        	$this->Model_setting->update($form_data);   	
        	$success = 'Footer Call to Action Setting is updated successfully!';
        	$this->session->set_flashdata('success',$success);
		    redirect(base_url().M_REWRITE.'admin/setting');
		}

		if(isset($_POST['form_footer_cta_background'])) {
			$valid = 1;
			$path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];
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
		    	// removing the existing photo
		    	unlink('./public/uploads/'.$data['page']['cta_background']);

		    	// updating the data
		    	$final_name = 'cta_background'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );
		    			        
				$form_data = array(
					'cta_background' => $final_name
	            );
	        	$this->Model_setting->update($form_data);

	        	$success = 'Call to Action Background photo is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().M_REWRITE.'admin/setting');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().M_REWRITE.'admin/setting');
		    }
		}


		if(isset($_POST['form_email'])) {

			$send_email_from  = secure_data($this->input->post('send_email_from', true));
			$receive_email_to = secure_data($this->input->post('receive_email_to', true));
			$smtp_active      = secure_data($this->input->post('smtp_active', true));
			$smtp_secured     = secure_data($this->input->post('smtp_secured', true));
			$smtp_host        = secure_data($this->input->post('smtp_host', true));
			$smtp_port        = secure_data($this->input->post('smtp_port', true));
			$smtp_username    = secure_data($this->input->post('smtp_username', true));
			$smtp_password    = secure_data($this->input->post('smtp_password', true));

        	$form_data = array(
				'send_email_from'  => $send_email_from,
				'receive_email_to' => $receive_email_to,
				'smtp_active'      => $smtp_active,
				'smtp_secured'     => $smtp_secured,
				'smtp_host'        => $smtp_host,
				'smtp_port'        => $smtp_port,
				'smtp_username'    => $smtp_username,
				'smtp_password'    => $smtp_password
            );
        	$this->Model_setting->update($form_data);   	
        	$success = 'Email Setting is updated successfully!';
        	$this->session->set_flashdata('success',$success);
		    redirect(base_url().M_REWRITE.'admin/setting');
		}

		if(isset($_POST['form_sidebar'])) {

			$sidebar_total_recent_blog  = secure_data($this->input->post('sidebar_total_recent_blog', true));
			
        	$form_data = array(
				'sidebar_total_recent_blog' => $sidebar_total_recent_blog
            );
        	$this->Model_setting->update($form_data);   	
        	$success = 'Sidebar Setting is updated successfully!';
        	$this->session->set_flashdata('success',$success);
		    redirect(base_url().M_REWRITE.'admin/setting');
		}

		if(isset($_POST['form_color'])) {

			$front_end_color  = secure_data($this->input->post('front_end_color', true));

        	$form_data = array(
				'front_end_color' => $front_end_color
            );
        	$this->Model_setting->update($form_data);   	
        	$success = 'Front End Color Setting is updated successfully!';
        	$this->session->set_flashdata('success',$success);
		    redirect(base_url().M_REWRITE.'admin/setting');
		}


		if(isset($_POST['form_payment'])) {

			$paypal_email  = secure_data($this->input->post('paypal_email', true));
			$stripe_public_key  = secure_data($this->input->post('stripe_public_key', true));
			$stripe_secret_key  = secure_data($this->input->post('stripe_secret_key', true));

        	$form_data = array(
				'paypal_email' => $paypal_email,
				'stripe_public_key' => $stripe_public_key,
				'stripe_secret_key' => $stripe_secret_key
            );
        	$this->Model_setting->update($form_data);   	
        	$success = 'Payment Setting is updated successfully!';
        	$this->session->set_flashdata('success',$success);
		    redirect(base_url().M_REWRITE.'admin/setting');
		}


		if(isset($_POST['form_other'])) {

			$website_name  = secure_data($this->input->post('website_name', true));

        	$form_data = array(
				'website_name' => $website_name
            );
        	$this->Model_setting->update($form_data);   	
        	$success = 'Other Setting is updated successfully!';
        	$this->session->set_flashdata('success',$success);
		    redirect(base_url().M_REWRITE.'admin/setting');
		}


		if(isset($_POST['form_banner_about'])) {
			$valid = 1;
			$path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];
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
		    	unlink('./public/uploads/'.$data['setting']['banner_about']);
		    	$final_name = 'banner_about'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );		    			        
				$form_data = array(
					'banner_about' => $final_name
	            );
	        	$this->Model_setting->update($form_data);
	        	$success = 'About Page Banner is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().M_REWRITE.'admin/setting');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().M_REWRITE.'admin/setting');
		    }
		}

		if(isset($_POST['form_banner_faq'])) {
			$valid = 1;
			$path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];
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
		    	unlink('./public/uploads/'.$data['setting']['banner_faq']);
		    	$final_name = 'banner_faq'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );		    			        
				$form_data = array(
					'banner_faq' => $final_name
	            );
	        	$this->Model_setting->update($form_data);
	        	$success = 'FAQ Page Banner is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().M_REWRITE.'admin/setting');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().M_REWRITE.'admin/setting');
		    }
		}


		if(isset($_POST['form_banner_service'])) {
			$valid = 1;
			$path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];
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
		    	unlink('./public/uploads/'.$data['setting']['banner_service']);
		    	$final_name = 'banner_service'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );		    			        
				$form_data = array(
					'banner_service' => $final_name
	            );
	        	$this->Model_setting->update($form_data);
	        	$success = 'Service Page Banner is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().M_REWRITE.'admin/setting');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().M_REWRITE.'admin/setting');
		    }
		}


		if(isset($_POST['form_banner_testimonial'])) {
			$valid = 1;
			$path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];
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
		    	unlink('./public/uploads/'.$data['setting']['banner_testimonial']);
		    	$final_name = 'banner_testimonial'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );		    			        
				$form_data = array(
					'banner_testimonial' => $final_name
	            );
	        	$this->Model_setting->update($form_data);
	        	$success = 'Testimonial Page Banner is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().M_REWRITE.'admin/setting');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().M_REWRITE.'admin/setting');
		    }
		}


		if(isset($_POST['form_banner_blog'])) {
			$valid = 1;
			$path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];
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
		    	unlink('./public/uploads/'.$data['setting']['banner_blog']);
		    	$final_name = 'banner_blog'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );		    			        
				$form_data = array(
					'banner_blog' => $final_name
	            );
	        	$this->Model_setting->update($form_data);
	        	$success = 'Blog Page Banner is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().M_REWRITE.'admin/setting');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().M_REWRITE.'admin/setting');
		    }
		}




		if(isset($_POST['form_banner_contact'])) {
			$valid = 1;
			$path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];
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
		    	unlink('./public/uploads/'.$data['setting']['banner_contact']);
		    	$final_name = 'banner_contact'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );		    			        
				$form_data = array(
					'banner_contact' => $final_name
	            );
	        	$this->Model_setting->update($form_data);
	        	$success = 'Contact Page Banner is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().M_REWRITE.'admin/setting');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().M_REWRITE.'admin/setting');
		    }
		}


		

		if(isset($_POST['form_banner_terms'])) {
			$valid = 1;
			$path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];
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
		    	unlink('./public/uploads/'.$data['setting']['banner_terms']);
		    	$final_name = 'banner_terms'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );		    			        
				$form_data = array(
					'banner_terms' => $final_name
	            );
	        	$this->Model_setting->update($form_data);
	        	$success = 'Terms and Conditions Page Banner is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().M_REWRITE.'admin/setting');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().M_REWRITE.'admin/setting');
		    }
		}

		if(isset($_POST['form_banner_privacy'])) {
			$valid = 1;
			$path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];
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
		    	unlink('./public/uploads/'.$data['setting']['banner_privacy']);
		    	$final_name = 'banner_privacy'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );		    			        
				$form_data = array(
					'banner_privacy' => $final_name
	            );
	        	$this->Model_setting->update($form_data);
	        	$success = 'Privacy Policy Page Banner is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().M_REWRITE.'admin/setting');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().M_REWRITE.'admin/setting');
		    }
		}

		

		if(isset($_POST['form_banner_team_member'])) {
			$valid = 1;
			$path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];
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
		    	unlink('./public/uploads/'.$data['setting']['banner_team_member']);
		    	$final_name = 'banner_team_member'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );		    			        
				$form_data = array(
					'banner_team_member' => $final_name
	            );
	        	$this->Model_setting->update($form_data);
	        	$success = 'Team Member Page Banner is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().M_REWRITE.'admin/setting');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().M_REWRITE.'admin/setting');
		    }
		}


				

		if(isset($_POST['form_banner_verify_subscriber'])) {
			$valid = 1;
			$path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];
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
		    	unlink('./public/uploads/'.$data['setting']['banner_verify_subscriber']);
		    	$final_name = 'banner_verify_subscriber'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );		    			        
				$form_data = array(
					'banner_verify_subscriber' => $final_name
	            );
	        	$this->Model_setting->update($form_data);
	        	$success = 'Verify Subscriber Page Banner is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().M_REWRITE.'admin/setting');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().M_REWRITE.'admin/setting');
		    }
		}


		
		if(isset($_POST['form_banner_photo_gallery'])) {
			$valid = 1;
			$path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];
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
		    	unlink('./public/uploads/'.$data['setting']['banner_photo_gallery']);
		    	$final_name = 'banner_photo_gallery'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );		    			        
				$form_data = array(
					'banner_photo_gallery' => $final_name
	            );
	        	$this->Model_setting->update($form_data);
	        	$success = 'Photo Gallery Page Banner is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().M_REWRITE.'admin/setting');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().M_REWRITE.'admin/setting');
		    }
		}


		if(isset($_POST['form_banner_video_gallery'])) {
			$valid = 1;
			$path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];
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
		    	unlink('./public/uploads/'.$data['setting']['banner_video_gallery']);
		    	$final_name = 'banner_video_gallery'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );		    			        
				$form_data = array(
					'banner_video_gallery' => $final_name
	            );
	        	$this->Model_setting->update($form_data);
	        	$success = 'Video Gallery Page Banner is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().M_REWRITE.'admin/setting');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().M_REWRITE.'admin/setting');
		    }
		}


		if(isset($_POST['form_banner_shop'])) {
			$valid = 1;
			$path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];
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
		    	unlink('./public/uploads/'.$data['setting']['banner_shop']);
		    	$final_name = 'banner_shop'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );		    			        
				$form_data = array(
					'banner_shop' => $final_name
	            );
	        	$this->Model_setting->update($form_data);
	        	$success = 'Shop Pages Banner is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().M_REWRITE.'admin/setting');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().M_REWRITE.'admin/setting');
		    }
		}


		if(isset($_POST['form_banner_customer_section'])) {
			$valid = 1;
			$path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];
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
		    	unlink('./public/uploads/'.$data['setting']['banner_customer_section']);
		    	$final_name = 'banner_customer_section'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );		    			        
				$form_data = array(
					'banner_customer_section' => $final_name
	            );
	        	$this->Model_setting->update($form_data);
	        	$success = 'Customer Section Pages Banner is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().M_REWRITE.'admin/setting');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().M_REWRITE.'admin/setting');
		    }
		}

		$data['setting'] = $this->Model_common->get_setting_data();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_setting',$data);
		$this->load->view('admin/view_footer');
	}
	
}
