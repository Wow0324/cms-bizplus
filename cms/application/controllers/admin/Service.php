<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends MY_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_service');
    }

	public function index()
	{
		$data['setting'] = $this->Model_common->get_setting_data();

		$data['service'] = $this->Model_service->show();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_service',$data);
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
			$slug = secure_data($this->input->post('slug', true));
			$short_description = secure_data($this->input->post('short_description', true));
			$description = $this->input->post('description', true);
			$lang_id = secure_data($this->input->post('lang_id', true));

			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('short_description', 'Short Description', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error .= validation_errors();
            }

            $path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];

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
				$next_id = $this->Model_service->get_auto_increment_id();
				foreach ($next_id as $row) {
		            $ai_id = $row['Auto_increment'];
		        }

		        if($slug == '') {
		    		$temp_string = strtolower($name);
		    		$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
		    	} else {
		    		$temp_string = strtolower($slug);
		    		$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
		    	}

		    	$tot_slug = $this->Model_service->slug_duplication_check($slug);
				if($tot_slug) {
					$slug = $slug.'-1';
				}

		        $final_name = 'service-'.$ai_id.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );

		        $form_data = array(
					'name'              => $name,
					'slug'              => $slug,
					'short_description' => $short_description,
					'description'       => $description,
					'photo'             => $final_name,
					'lang_id'           => $lang_id
	            );
	            $this->Model_service->add($form_data);

		        $success = 'Service is added successfully!';
		        $this->session->set_flashdata('success',$success);
				redirect(base_url().M_REWRITE.'admin/service');
		    } 
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().M_REWRITE.'admin/service/add');
		    }
            
        } else {
            
            $this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_service_add',$data);
			$this->load->view('admin/view_footer');
        }
		
	}


	public function edit($id)
	{
		
    	// If there is no service in this id, then redirect
    	$tot = $this->Model_service->service_check($id);
    	if(!$tot) {
    		redirect(base_url().M_REWRITE.'admin/service');
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
			$slug = secure_data($this->input->post('slug', true));
			$short_description = secure_data($this->input->post('short_description', true));
			$description = $this->input->post('description', true);
			$lang_id  = secure_data($this->input->post('lang_id', true));

			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('short_description', 'Short Description', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error .= validation_errors();
            }

            $path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];

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
		    	$data['service'] = $this->Model_service->getData($id);

		    	if($slug == '') {
		    		$temp_string = strtolower($name);
		    		$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
		    	} else {
		    		$temp_string = strtolower($slug);
		    		$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
		    	}

		    	$tot_slug = $this->Model_service->slug_duplication_check_edit($slug,$data['service']['slug']);
				if($tot_slug) {
					$slug = $slug.'-1';
				}

		    	if($path == '') {
		    		$form_data = array(
						'name'              => $name,
						'slug'              => $slug,
						'short_description' => $short_description,
						'description'       => $description,
						'lang_id'           => $lang_id
		            );
		            $this->Model_service->update($id,$form_data);
				}
				else {
					unlink('./public/uploads/'.$data['service']['photo']);

					$final_name = 'service-'.$id.'.'.$ext;
		        	move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );

		        	$form_data = array(
						'name'              => $name,
						'slug'              => $slug,
						'short_description' => $short_description,
						'description'       => $description,
						'photo'             => $final_name,
						'lang_id'           => $lang_id
		            );
		            $this->Model_service->update($id,$form_data);
				}
				$success = 'Service is updated successfully';
				$this->session->set_flashdata('success',$success);
				redirect(base_url().M_REWRITE.'admin/service');
		    }
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().M_REWRITE.'admin/service/edit/'.$id);
		    }
           
		} else {
			$data['service'] = $this->Model_service->getData($id);
	       	$this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_service_edit',$data);
			$this->load->view('admin/view_footer');
		}

	}


	public function delete($id) 
	{
		// If there is no service in this id, then redirect
    	$tot = $this->Model_service->service_check($id);
    	if(!$tot) {
    		redirect(base_url().M_REWRITE.'admin/service');
        	exit;
    	}

        $data['service'] = $this->Model_service->getData($id);
        if($data['service']) {
            unlink('./public/uploads/'.$data['service']['photo']);
        }

        $this->Model_service->delete($id);
        $success = 'Service is deleted successfully';
        $this->session->set_flashdata('success',$success);
        redirect(base_url().M_REWRITE.'admin/service');
    }

}