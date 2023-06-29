<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends MY_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_blog');
    }

	public function index()
	{
		$data['setting'] = $this->Model_common->get_setting_data();
		$data['blogs'] = $this->Model_blog->show();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_blog',$data);
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

			$title = secure_data($this->input->post('title', true));
			$slug = secure_data($this->input->post('slug', true));
			$content_short = secure_data($this->input->post('content_short', true));
			$content = $this->input->post('content', true);
			$created_at = secure_data($this->input->post('created_at', true));
			$category_id = secure_data($this->input->post('category_id', true));
			$comment = secure_data($this->input->post('comment', true));
			$lang_id  = secure_data($this->input->post('lang_id', true));

			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('content_short', 'Short Content', 'trim|required');
			$this->form_validation->set_rules('content', 'Content', 'trim|required');
			$this->form_validation->set_rules('category_id', 'Category', 'trim|required');

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

		    $path1 = $_FILES['banner']['name'];
		    $path_tmp1 = $_FILES['banner']['tmp_name'];

		    if($path1!='') {
		        $ext1 = pathinfo( $path1, PATHINFO_EXTENSION );
		        $file_name = basename( $path1, '.' . $ext1 );
		        $ext_check1 = $this->Model_common->extension_check_photo($ext1);
		        if($ext_check1 == FALSE) {
		            $valid = 0;
		            $error .= 'You must have to upload jpg, jpeg, gif or png file for banner<br>';
		        }
		    } else {
		    	$valid = 0;
		        $error .= 'You must have to select a photo for banner<br>';
		    }

		    if($valid == 1) 
		    {
				$next_id = $this->Model_blog->get_auto_increment_id();
				foreach ($next_id as $row) {
		            $ai_id = $row['Auto_increment'];
		        }

		        if($slug == '') {
		    		$temp_string = strtolower($title);
		    		$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
		    	} else {
		    		$temp_string = strtolower($slug);
		    		$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
		    	}

		    	$tot_slug = $this->Model_blog->slug_duplication_check($slug);
				if($tot_slug) {
					$slug = $slug.'-1';
				}

		        $final_name = 'blog-'.$ai_id.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );

		        $final_name1 = 'blog-banner-'.$ai_id.'.'.$ext1;
		        move_uploaded_file( $path_tmp1, './public/uploads/'.$final_name1 );

		        $form_data = array(
					'title'         => $title,
					'slug'          => $slug,
					'content'       => $content,
					'content_short' => $content_short,
					'created_at'    => $created_at,
					'photo'         => $final_name,
					'banner'        => $final_name1,
					'category_id'   => $category_id,
					'comment'       => $comment,
					'lang_id'       => $lang_id
	            );
	            $this->Model_blog->add($form_data);

		        $success = 'Blog is added successfully!';
		        $this->session->set_flashdata('success',$success);
				redirect(base_url().M_REWRITE.'admin/blog');
		    } 
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().M_REWRITE.'admin/blog/add');
		    }
            
        } else {
            $data['all_category'] = $this->Model_blog->get_category();
            $this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_blog_add',$data);
			$this->load->view('admin/view_footer');
        }
		
	}


	public function edit($id)
	{
		
    	// If there is no post in this id, then redirect
    	$tot = $this->Model_blog->blog_check($id);
    	if(!$tot) {
    		redirect(base_url().M_REWRITE.'admin/blog');
        	exit;
    	}
       	
       	$data['setting'] = $this->Model_common->get_setting_data();
       	$data['all_lang'] = $this->Model_common->all_lang();
		$error = '';
		$success = '';

		if(isset($_POST['form1'])) 
		{

			$valid = 1;

			$title = secure_data($this->input->post('title', true));
			$slug = secure_data($this->input->post('slug', true));
			$content_short = secure_data($this->input->post('content_short', true));
			$content = $this->input->post('content', true);
			$created_at = secure_data($this->input->post('created_at', true));
			$category_id = secure_data($this->input->post('category_id', true));
			$comment = secure_data($this->input->post('comment', true));
			$lang_id  = secure_data($this->input->post('lang_id', true));

			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('content_short', 'Short Content', 'trim|required');
			$this->form_validation->set_rules('content', 'Content', 'trim|required');

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

		    $path1 = $_FILES['banner']['name'];
		    $path_tmp1 = $_FILES['banner']['tmp_name'];

		    if($path1!='') {
		        $ext1 = pathinfo( $path1, PATHINFO_EXTENSION );
		        $file_name1 = basename( $path1, '.' . $ext1 );
		        $ext_check1 = $this->Model_common->extension_check_photo($ext1);
		        if($ext_check1 == FALSE) {
		            $valid = 0;
		            $error .= 'You must have to upload jpg, jpeg, gif or png file for banner<br>';
		        }
		    }

		    if($valid == 1) 
		    {
		    	$data['blog'] = $this->Model_blog->getData($id);

		    	if($slug == '') {
		    		$temp_string = strtolower($title);
		    		$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
		    	} else {
		    		$temp_string = strtolower($slug);
		    		$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
		    	}

		    	$tot_slug = $this->Model_blog->slug_duplication_check_edit($slug,$data['blog']['slug']);
				if($tot_slug) {
					$slug = $slug.'-1';
				}

		    	if($path == '' && $path1 == '') {
		    		$form_data = array(
						'title'         => $title,
						'slug'          => $slug,
						'content'       => $content,
						'content_short' => $content_short,
						'created_at'    => $created_at,
						'category_id'   => $category_id,
						'comment'       => $comment,
						'lang_id'       => $lang_id
		            );
		            $this->Model_blog->update($id,$form_data);
				}
				if($path != '' && $path1 == '') {
					unlink('./public/uploads/'.$data['blog']['photo']);

					$final_name = 'blog-'.$id.'.'.$ext;
		        	move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );

		        	$form_data = array(
						'title'         => $title,
						'slug'          => $slug,
						'content'       => $content,
						'content_short' => $content_short,
						'created_at'    => $created_at,
						'photo'         => $final_name,
						'category_id'   => $category_id,
						'comment'       => $comment,
						'lang_id'       => $lang_id
		            );
		            $this->Model_blog->update($id,$form_data);
				}
				if($path == '' && $path1 != '') {
					unlink('./public/uploads/'.$data['blog']['banner']);

					$final_name1 = 'blog-banner-'.$id.'.'.$ext1;
		        	move_uploaded_file( $path_tmp1, './public/uploads/'.$final_name1 );

		        	$form_data = array(
						'title'         => $title,
						'slug'          => $slug,
						'content'       => $content,
						'content_short' => $content_short,
						'created_at'    => $created_at,
						'banner'        => $final_name1,
						'category_id'   => $category_id,
						'comment'       => $comment,
						'lang_id'       => $lang_id
		            );
		            $this->Model_blog->update($id,$form_data);
				}
				if($path != '' && $path1 != '') {

					unlink('./public/uploads/'.$data['blog']['photo']);
					unlink('./public/uploads/'.$data['blog']['banner']);

					$final_name = 'blog-'.$id.'.'.$ext;
		        	move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );

					$final_name1 = 'blog-banner-'.$id.'.'.$ext1;
		        	move_uploaded_file( $path_tmp1, './public/uploads/'.$final_name1 );

		        	$form_data = array(
						'title'         => $title,
						'slug'          => $slug,
						'content'       => $content,
						'content_short' => $content_short,
						'created_at'    => $created_at,
						'photo'         => $final_name,
						'banner'        => $final_name1,
						'category_id'   => $category_id,
						'comment'       => $comment,
						'lang_id'       => $lang_id
		            );
		            $this->Model_blog->update($id,$form_data);
				}

				$success = 'Blog is updated successfully';
				$this->session->set_flashdata('success',$success);
				redirect(base_url().M_REWRITE.'admin/blog');
		    }
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().M_REWRITE.'admin/blog/add');
		    }
           
		} else {
			$data['blog'] = $this->Model_blog->getData($id);
			$data['all_category'] = $this->Model_blog->get_category();
            $this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_blog_edit',$data);
			$this->load->view('admin/view_footer');
		}

	}


	public function delete($id) 
	{
    	$tot = $this->Model_blog->blog_check($id);
    	if(!$tot) {
    		redirect(base_url().M_REWRITE.'admin/blog');
        	exit;
    	}

        $data['blog'] = $this->Model_blog->getData($id);
        if($data['blog']) {
            unlink('./public/uploads/'.$data['blog']['photo']);
            unlink('./public/uploads/'.$data['blog']['banner']);
        }

        $this->Model_blog->delete($id);
        $success = 'Blog is deleted successfully';
		$this->session->set_flashdata('success',$success);
		redirect(base_url().M_REWRITE.'admin/blog');
    }

 
}