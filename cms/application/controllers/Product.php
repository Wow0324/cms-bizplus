<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

	function __construct()
	{
        parent::__construct();
        $this->load->model('Model_common');
        $this->load->model('Model_product');
    }

	public function view($slug)
	{
		$tot = $this->Model_product->product_check($slug);
    	if(!$tot) {
    		redirect(base_url());
        	exit;
    	}

    	$data['setting'] = $this->Model_common->all_setting();
		$data['comment'] = $this->Model_common->all_comment();
		$data['social'] = $this->Model_common->all_social();
		$data['all_blogs'] = $this->Model_common->all_blogs();
    	$data['product_detail'] = $this->Model_product->product_detail($slug);

		$this->load->view('view_header',$data);
		$this->load->view('view_product',$data);
		$this->load->view('view_footer',$data);
	}

	function add_to_cart()
	{
		if(isset($_POST['form_add_to_cart']))
		{
			$product_id = $this->input->post('product_id', true);
			$product_slug = $this->input->post('product_slug', true);
			$product_current_price = $this->input->post('product_current_price', true);
			$product_name = $this->input->post('product_name', true);
			$product_featured_photo = $this->input->post('product_featured_photo', true);
			$product_qty = $this->input->post('product_qty', true);

			$product_detail = $this->Model_product->product_detail_by_id($product_id);
			
			if($product_qty > $product_detail['product_stock'])
			{
				$error = ERROR_PRODUCT_OUT_OF_STOCK;
		        $this->session->set_flashdata('error',$error);
		        redirect(base_url().M_REWRITE.'product/view/'.$product_slug);
			    exit;
			}
			else
			{
				if(isset($_SESSION['cart_product_id']))
			    {
			        $arr_cart_product_id = array();
			        $arr_cart_product_qty = array();

			        $i=0;
			        foreach($_SESSION['cart_product_id'] as $value) 
			        {
			            $i++;
			            $arr_cart_product_id[$i] = $value;
			        }

			        $i=0;
			        foreach($_SESSION['cart_product_qty'] as $value) 
			        {
			            $i++;
			            $arr_cart_product_qty[$i] = $value;
			        }

			        if(in_array($product_id,$arr_cart_product_id))
			        {
			           	$error = ERROR_PRODUCT_EXIST_CART;
		        		$this->session->set_flashdata('error',$error);
			        	redirect(base_url().M_REWRITE.'product/view/'.$product_slug);
			    		exit;
			        }
			        else 
			        {
			            $i=0;
			            foreach($_SESSION['cart_product_id'] as $key => $res) 
			            {
			                $i++;
			            }
			            $new_key = $i+1;          

			            $_SESSION['cart_product_id'][$new_key] = $product_id;
			            $_SESSION['cart_product_qty'][$new_key] = $product_qty;

			            $success = SUCCESS_PRODUCT_ADD_CART;
		        		$this->session->set_flashdata('success',$success);
			            redirect(base_url().M_REWRITE.'product/view/'.$product_slug);
			        	exit;
			        }
			        
			    }
			    else
			    {
			        $_SESSION['cart_product_id'][1] = $product_id;
			        $_SESSION['cart_product_qty'][1] = $product_qty;

			        $success = SUCCESS_PRODUCT_ADD_CART;
		        	$this->session->set_flashdata('success',$success);
			        redirect(base_url().M_REWRITE.'product/view/'.$product_slug);
			    	exit;
			    }
			}
		}
		else
		{
			redirect(base_url());
		    exit;
		}
	}
}