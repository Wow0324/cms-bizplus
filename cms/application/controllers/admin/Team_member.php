<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team_member extends MY_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_team_member');
    }

	public function index()
	{
		$data['setting'] = $this->Model_common->get_setting_data();
		$data['team_member'] = $this->Model_team_member->show();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_team_member',$data);
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

			$team_member_name = secure_data($this->input->post('team_member_name', true));
			$team_member_slug = secure_data($this->input->post('team_member_slug', true));
			$team_member_designation = secure_data($this->input->post('team_member_designation', true));
			$team_member_detail = secure_data($this->input->post('team_member_detail', true));
			$team_member_facebook = secure_data($this->input->post('team_member_facebook', true));
			$team_member_twitter = secure_data($this->input->post('team_member_twitter', true));
			$team_member_linkedin = secure_data($this->input->post('team_member_linkedin', true));
			$team_member_youtube = secure_data($this->input->post('team_member_youtube', true));
			$team_member_google_plus = secure_data($this->input->post('team_member_google_plus', true));
			$team_member_instagram = secure_data($this->input->post('team_member_instagram', true));
			$team_member_flickr = secure_data($this->input->post('team_member_flickr', true));
			$team_member_phone = secure_data($this->input->post('team_member_phone', true));
			$team_member_email = secure_data($this->input->post('team_member_email', true));
			$team_member_website = secure_data($this->input->post('team_member_website', true));
			$lang_id  = secure_data($this->input->post('lang_id', true));

			$this->form_validation->set_rules('team_member_name', 'Name', 'trim|required');
			$this->form_validation->set_rules('team_member_designation', 'Designation', 'trim|required');
			

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error .= validation_errors();
            }

            $path = $_FILES['team_member_photo']['name'];
		    $path_tmp = $_FILES['team_member_photo']['tmp_name'];

		    if($path!='') {
		        $ext = pathinfo( $path, PATHINFO_EXTENSION );
		        $file_name = basename( $path, '.' . $ext );
		        $ext_check = $this->Model_common->extension_check_photo($ext);
		        if($ext_check == FALSE) {
		            $valid = 0;
		            $error .= 'You must have to upload jpg, jpeg, gif or png file for featured photo<br>';
		        }
		    } else {
		    	$valid = 0;
		        $error .= 'You must have to select a photo for featured photo<br>';
		    }


		    if($valid == 1) 
		    {
				$next_id = $this->Model_team_member->get_auto_increment_id();
				foreach ($next_id as $row) {
		            $ai_id = $row['Auto_increment'];
		        }

		        if($team_member_slug == '') {
		    		$temp_string = strtolower($team_member_name);
		    		$team_member_slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
		    	} else {
		    		$temp_string = strtolower($team_member_slug);
		    		$team_member_slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
		    	}

		    	$tot_slug = $this->Model_team_member->slug_duplication_check($team_member_slug);
				if($tot_slug) {
					$team_member_slug = $team_member_slug.'-1';
				}

		        $final_name = 'team-member-'.$ai_id.'.'.$ext;
				$source_image = $path_tmp;
				$destination = './public/uploads/'.$final_name;
				$new_width = 400;
			  	$new_height = 400;
			 	$quality = 100;
				$this->Model_common->image_handler($source_image,$destination,$new_width,$new_height,$quality);

		        $form_data = array(
					'team_member_name'        => $team_member_name,
					'team_member_slug'        => $team_member_slug,
					'team_member_designation' => $team_member_designation,
					'team_member_photo'       => $final_name,
					'team_member_detail'      => $team_member_detail,
					'team_member_facebook'    => $team_member_facebook,
					'team_member_twitter'     => $team_member_twitter,
					'team_member_linkedin'    => $team_member_linkedin,
					'team_member_youtube'     => $team_member_youtube,
					'team_member_google_plus' => $team_member_google_plus,
					'team_member_instagram'   => $team_member_instagram,
					'team_member_flickr'      => $team_member_flickr,
					'team_member_phone'       => $team_member_phone,
					'team_member_email'       => $team_member_email,
					'team_member_website'     => $team_member_website,
					'lang_id'                 => $lang_id
	            );
	            $this->Model_team_member->add($form_data);

		        $success = 'Team Member is added successfully!';
				$this->session->set_flashdata('success',$success);
		    	redirect(base_url().M_REWRITE.'admin/team-member');
		    } 
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().M_REWRITE.'admin/team-member/add');
		    }
            
        } else {
            $this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_team_member_add',$data);
			$this->load->view('admin/view_footer');
        }
		
	}


	public function edit($id)
	{
		
    	$tot = $this->Model_team_member->team_member_check($id);
    	if(!$tot) {
    		redirect(base_url().M_REWRITE.'admin/team-member');
        	exit;
    	}
       	
       	$data['setting'] = $this->Model_common->get_setting_data();
       	$data['all_lang'] = $this->Model_common->all_lang();
		$error = '';
		$success = '';


		if(isset($_POST['form1'])) 
		{

			$valid = 1;

			$team_member_name = secure_data($this->input->post('team_member_name', true));
			$team_member_slug = secure_data($this->input->post('team_member_slug', true));
			$team_member_designation = secure_data($this->input->post('team_member_designation', true));
			$team_member_detail = secure_data($this->input->post('team_member_detail', true));
			$team_member_facebook = secure_data($this->input->post('team_member_facebook', true));
			$team_member_twitter = secure_data($this->input->post('team_member_twitter', true));
			$team_member_linkedin = secure_data($this->input->post('team_member_linkedin', true));
			$team_member_youtube = secure_data($this->input->post('team_member_youtube', true));
			$team_member_google_plus = secure_data($this->input->post('team_member_google_plus', true));
			$team_member_instagram = secure_data($this->input->post('team_member_instagram', true));
			$team_member_flickr = secure_data($this->input->post('team_member_flickr', true));
			$team_member_phone = secure_data($this->input->post('team_member_phone', true));
			$team_member_email = secure_data($this->input->post('team_member_email', true));
			$team_member_website = secure_data($this->input->post('team_member_website', true));
			$lang_id  = secure_data($this->input->post('lang_id', true));

			$this->form_validation->set_rules('team_member_name', 'Name', 'trim|required');
			$this->form_validation->set_rules('team_member_designation', 'Designation', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error .= validation_errors();
            }

            $path = $_FILES['team_member_photo']['name'];
		    $path_tmp = $_FILES['team_member_photo']['tmp_name'];

		    if($path!='') {
		        $ext = pathinfo( $path, PATHINFO_EXTENSION );
		        $file_name = basename( $path, '.' . $ext );
		        $ext_check = $this->Model_common->extension_check_photo($ext);
		        if($ext_check == FALSE) {
		            $valid = 0;
		            $error .= 'You must have to upload jpg, jpeg, gif or png file for featured photo<br>';
		        }
		    }

		    if($valid == 1) 
		    {
		    	$data['team_member'] = $this->Model_team_member->get_team_member($id);

		    	if($team_member_slug == '') {
		    		$temp_string = strtolower($team_member_name);
		    		$team_member_slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
		    	} else {
		    		$temp_string = strtolower($team_member_slug);
		    		$team_member_slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
		    	}

		    	$tot_slug = $this->Model_team_member->slug_duplication_check_edit($team_member_slug,$data['team_member']['team_member_slug']);
				if($tot_slug) {
					$team_member_slug = $team_member_slug.'-1';
				}

		    	if($path == '') {
		    		$form_data = array(
						'team_member_name'        => $team_member_name,
						'team_member_slug'        => $team_member_slug,
						'team_member_designation' => $team_member_designation,
						'team_member_detail'      => $team_member_detail,
						'team_member_facebook'    => $team_member_facebook,
						'team_member_twitter'     => $team_member_twitter,
						'team_member_linkedin'    => $team_member_linkedin,
						'team_member_youtube'     => $team_member_youtube,
						'team_member_google_plus' => $team_member_google_plus,
						'team_member_instagram'   => $team_member_instagram,
						'team_member_flickr'      => $team_member_flickr,
						'team_member_phone'       => $team_member_phone,
						'team_member_email'       => $team_member_email,
						'team_member_website'     => $team_member_website,
						'lang_id'                 => $lang_id
		            );
		            $this->Model_team_member->update($id,$form_data);
		    	}
		    	else 
		    	{
		    		unlink('./public/uploads/'.$_POST['current_photo']);

					$final_name = 'team-member-'.$id.'.'.$ext;

					$source_image = $path_tmp;
					$destination = './public/uploads/'.$final_name;
					$new_width = 400;
				  	$new_height = 400;
				 	$quality = 100;
					$this->Model_common->image_handler($source_image,$destination,$new_width,$new_height,$quality);

		    		$form_data = array(
						'team_member_name'        => $team_member_name,
						'team_member_slug'        => $team_member_slug,
						'team_member_designation' => $team_member_designation,
						'team_member_photo'       => $final_name,
						'team_member_detail'      => $team_member_detail,
						'team_member_facebook'    => $team_member_facebook,
						'team_member_twitter'     => $team_member_twitter,
						'team_member_linkedin'    => $team_member_linkedin,
						'team_member_youtube'     => $team_member_youtube,
						'team_member_google_plus' => $team_member_google_plus,
						'team_member_instagram'   => $team_member_instagram,
						'team_member_flickr'      => $team_member_flickr,
						'team_member_phone'       => $team_member_phone,
						'team_member_email'       => $team_member_email,
						'team_member_website'     => $team_member_website,
						'lang_id'                 => $lang_id
		            );
		            $this->Model_team_member->update($id,$form_data);
		    	}

				$success = 'Team Member is updated successfully';
				$this->session->set_flashdata('success',$success);
				redirect(base_url().M_REWRITE.'admin/team-member');
		    }
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().M_REWRITE.'admin/team-member/edit/'.$id);
		    }           
		} else {
			$data['team_member'] = $this->Model_team_member->get_team_member($id);
            $this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_team_member_edit',$data);
			$this->load->view('admin/view_footer');
		}

	}


	public function delete($id) 
	{
    	$tot = $this->Model_team_member->team_member_check($id);
    	if(!$tot) {
    		redirect(base_url().M_REWRITE.'admin/team-member');
        	exit;
    	}

    	// Delete from tbl_team_member
        $data['team_member'] = $this->Model_team_member->get_team_member($id);
        if($data['team_member']) {
            unlink('./public/uploads/'.$data['team_member']['team_member_photo']);
        }
        $this->Model_team_member->delete($id);

        $success = 'Team Member is deleted successfully';
        $this->session->set_flashdata('success',$success);
    	redirect(base_url().M_REWRITE.'admin/team-member');
    }
 
}