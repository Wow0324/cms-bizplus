<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_product');
    }

	public function index()
	{
		$data['setting'] = $this->Model_common->get_setting_data();
		$data['product'] = $this->Model_product->show();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_product',$data);
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

			$product_name = secure_data($this->input->post('product_name', true));
			$product_slug = secure_data($this->input->post('product_slug', true));
			$product_old_price = secure_data($this->input->post('product_old_price', true));
			$product_current_price = secure_data($this->input->post('product_current_price', true));
			$product_stock = secure_data($this->input->post('product_stock', true));
			$product_content = $this->input->post('product_content', true);
			$product_content_short = $this->input->post('product_content_short', true);
			$product_return_policy = secure_data($this->input->post('product_return_policy', true));
			$product_order = secure_data($this->input->post('product_order', true));
			$meta_title = secure_data($this->input->post('meta_title', true));
			$meta_description = secure_data($this->input->post('meta_description', true));
			$lang_id  = secure_data($this->input->post('lang_id', true));

			$this->form_validation->set_rules('product_name', 'Name', 'trim|required');
			$this->form_validation->set_rules('product_current_price', 'Current Price', 'trim|required');
			$this->form_validation->set_rules('product_stock', 'Stock', 'trim|required');
			$this->form_validation->set_rules('product_content', 'Content', 'trim|required');
			$this->form_validation->set_rules('product_content_short', 'Short Content', 'trim|required');

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
				$next_id = $this->Model_product->get_auto_increment_id();
				foreach ($next_id as $row) {
		            $ai_id = $row['Auto_increment'];
		        }

		        if($product_slug == '') {
		    		$temp_string = strtolower($product_name);
		    		$product_slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
		    	} else {
		    		$temp_string = strtolower($product_slug);
		    		$product_slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
		    	}

		    	$tot_slug = $this->Model_product->slug_duplication_check($product_slug);
				if($tot_slug) {
					$product_slug = $product_slug.'-1';
				}

		        $final_name = 'product-'.$ai_id.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );

		        $form_data = array(
					'product_name'           => $product_name,
					'product_slug'           => $product_slug,
					'product_old_price'      => $product_old_price,
					'product_current_price'  => $product_current_price,
					'product_stock'          => $product_stock,
					'product_content'        => $product_content,
					'product_content_short'  => $product_content_short,
					'product_return_policy'  => $product_return_policy,
					'product_featured_photo' => $final_name,
					'product_order'          => $product_order,
					'meta_title'             => $meta_title,
					'meta_description'       => $meta_description,
					'lang_id'                => $lang_id
	            );
	            $this->Model_product->add($form_data);

		        $success = 'Product is added successfully!';
		        $this->session->set_flashdata('success',$success);
				redirect(base_url().M_REWRITE.'admin/product');
		    } 
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().M_REWRITE.'admin/product/add');
		    }
            
        } else {
            $this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_product_add',$data);
			$this->load->view('admin/view_footer');
        }
		
	}


	public function edit($id)
	{
		
    	$tot = $this->Model_product->product_check($id);
    	if(!$tot) {
    		redirect(base_url().M_REWRITE.'admin/product');
        	exit;
    	}
       	
       	$data['setting'] = $this->Model_common->get_setting_data();
       	$data['all_lang'] = $this->Model_common->all_lang();

		$error = '';
		$success = '';

		if(isset($_POST['form1'])) 
		{

			$valid = 1;

			$product_name = secure_data($this->input->post('product_name', true));
			$product_slug = secure_data($this->input->post('product_slug', true));
			$product_old_price = secure_data($this->input->post('product_old_price', true));
			$product_current_price = secure_data($this->input->post('product_current_price', true));
			$product_stock = secure_data($this->input->post('product_stock', true));
			$product_content = $this->input->post('product_content', true);
			$product_content_short = $this->input->post('product_content_short', true);
			$product_return_policy = secure_data($this->input->post('product_return_policy', true));
			$product_order = secure_data($this->input->post('product_order', true));
			$meta_title = secure_data($this->input->post('meta_title', true));
			$meta_description = secure_data($this->input->post('meta_description', true));
			$lang_id  = secure_data($this->input->post('lang_id', true));

			$this->form_validation->set_rules('product_name', 'Name', 'trim|required');
			$this->form_validation->set_rules('product_current_price', 'Current Price', 'trim|required');
			$this->form_validation->set_rules('product_stock', 'Stock', 'trim|required');
			$this->form_validation->set_rules('product_content', 'Content', 'trim|required');
			$this->form_validation->set_rules('product_content_short', 'Short Content', 'trim|required');

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
		    	$data['product'] = $this->Model_product->getData($id);

		    	if($product_slug == '') {
		    		$temp_string = strtolower($product_name);
		    		$product_slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
		    	} else {
		    		$temp_string = strtolower($product_slug);
		    		$product_slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
		    	}

		    	$tot_slug = $this->Model_product->slug_duplication_check_edit($product_slug,$data['product']['product_slug']);
				if($tot_slug) {
					$product_slug = $product_slug.'-1';
				}

		    	if($path == '') {
		    		$form_data = array(
						'product_name'           => $product_name,
						'product_slug'           => $product_slug,
						'product_old_price'      => $product_old_price,
						'product_current_price'  => $product_current_price,
						'product_stock'          => $product_stock,
						'product_content'        => $product_content,
						'product_content_short'  => $product_content_short,
						'product_return_policy'  => $product_return_policy,
						'product_order'          => $product_order,
						'meta_title'             => $meta_title,
						'meta_description'       => $meta_description,
						'lang_id'                => $lang_id
		            );
		            $this->Model_product->update($id,$form_data);
				}
				else {
					unlink('./public/uploads/'.$data['product']['product_featured_photo']);

					$final_name = 'product-'.$id.'.'.$ext;
		        	move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );

		        	$form_data = array(
						'product_name'           => $product_name,
						'product_slug'           => $product_slug,
						'product_old_price'      => $product_old_price,
						'product_current_price'  => $product_current_price,
						'product_stock'          => $product_stock,
						'product_content'        => $product_content,
						'product_content_short'  => $product_content_short,
						'product_return_policy'  => $product_return_policy,
						'product_featured_photo' => $final_name,
						'product_order'          => $product_order,
						'meta_title'             => $meta_title,
						'meta_description'       => $meta_description,
						'lang_id'                => $lang_id
		            );
		            $this->Model_product->update($id,$form_data);
				}

				$success = 'Product is updated successfully';
				$this->session->set_flashdata('success',$success);
				redirect(base_url().M_REWRITE.'admin/product');
		    }
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().M_REWRITE.'admin/product/edit/'.$id);
		    }
           
		} else {
			$data['product'] = $this->Model_product->getData($id);
            $this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_product_edit',$data);
			$this->load->view('admin/view_footer');
		}

	}


	public function delete($id) 
	{
    	$tot = $this->Model_product->product_check($id);
    	if(!$tot) {
    		redirect(base_url().M_REWRITE.'admin/product');
        	exit;
    	}

        $data['product'] = $this->Model_product->getData($id);
        if($data['product']) {
            unlink('./public/uploads/'.$data['product']['product_featured_photo']);
        }

        $this->Model_product->delete($id);
        $success = 'Product is deleted successfully';
		$this->session->set_flashdata('success',$success);
		redirect(base_url().M_REWRITE.'admin/product');
    }

 
}