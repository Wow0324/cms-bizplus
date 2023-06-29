<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends MY_Controller {

	function __construct()
	{
        parent::__construct();
        $this->load->model('Model_common');
        $this->load->model('Model_cart');
    }

	public function index()
	{
		$data['setting'] = $this->Model_common->all_setting();
		$data['comment'] = $this->Model_common->all_comment();
		$data['social'] = $this->Model_common->all_social();
		$data['all_blogs'] = $this->Model_common->all_blogs();

		if(isset($_POST['form_cart']))
		{
			$product_id = $this->input->post('product_id', true);
			$product_qty = $this->input->post('product_qty', true);
			$product_name = $this->input->post('product_name', true);

			$i = 0;
			$all_products = $this->Model_cart->all_products();
		    foreach ($all_products as $row) {
		        $i++;
		        $table_product_id[$i] = $row['product_id'];
		        $table_product_stock[$i] = $row['product_stock'];
		    }

		    $arr1 = array();
		    $arr2 = array();
		    $arr3 = array();

		    $i=0;
		    foreach($product_id as $val) {
		        $i++;
		        $arr1[$i] = $val;
		    }
		    $i=0;
		    foreach($product_qty as $val) {
		        $i++;
		        $arr2[$i] = $val;
		    }
		    $i=0;
		    foreach($product_name as $val) {
		        $i++;
		        $arr3[$i] = $val;
		    }
		    
		    $allow_update = 1;
		    for($i=1;$i<=count($arr1);$i++) 
		    {
		        for($j=1;$j<=count($table_product_id);$j++) 
		        {
		            if($arr1[$i] == $table_product_id[$j]) 
		            {
		                $temp_index = $j;
		                break;
		            }
		        }
		        if($table_product_stock[$temp_index] < $arr2[$i]) 
		        {
		        	$allow_update = 0;
		            $error = '"'.$arr2[$i].'" items are not available for "'.$arr3[$i].'"';
		        } 
		        else 
		        {
		            $_SESSION['cart_product_qty'][$i] = $arr2[$i];
		        }
		    }
		    
		    
		    if($allow_update == 0)
		    {
		        $this->session->set_flashdata('error',$error);
		        redirect(base_url().M_REWRITE.'cart');
		        exit;
		    }
		    else
		    {
		    	$success = SUCCESS_UPDATE_CART;
		    	$this->session->set_flashdata('success',$success);
		        redirect(base_url().M_REWRITE.'cart');
		        exit;
		    }
		}
		else
		{
			$this->load->view('view_header',$data);
			$this->load->view('view_cart',$data);
			$this->load->view('view_footer',$data);
		}
	}

	public function delete($id)
	{
		
        $i=0;
		foreach($_SESSION['cart_product_id'] as $value) {
		    $i++;
		    $arr_cart_product_id[$i] = $value;
		}

		$i=0;
		foreach($_SESSION['cart_product_qty'] as $value) {
		    $i++;
		    $arr_cart_product_qty[$i] = $value;
		}

		unset($_SESSION['cart_product_id']);
		unset($_SESSION['cart_product_qty']);


		$k=1;
		for($i=1;$i<=count($arr_cart_product_id);$i++) 
		{
		    if($arr_cart_product_id[$i] == $id) 
		    {
		        continue;
		    }
		    else
		    {
		        $_SESSION['cart_product_id'][$k] = $arr_cart_product_id[$i];
		        $_SESSION['cart_product_qty'][$k] = $arr_cart_product_qty[$i];
		        $k++;
		    }
		}

		// Check if all items are removed from the cart. If yes, then remove all cart datas like shipping and coupon datas etc.
		if(count($_SESSION['cart_product_id']) == 0)
		{
		    
		    unset($_SESSION['shipping_id']);
		    unset($_SESSION['shipping_cost']);
		    unset($_SESSION['coupon_id']);
		    unset($_SESSION['coupon_code']);
		    unset($_SESSION['coupon_type']);
		    unset($_SESSION['coupon_discount']);

		    unset($_SESSION['guest']);
		    unset($_SESSION['returning_customer']);
		    unset($_SESSION['customer_id']);
		    unset($_SESSION['customer_type']);
		    unset($_SESSION['customer_name']);
		    unset($_SESSION['customer_email']);

		    unset($_SESSION['billing']);
		    unset($_SESSION['billing_name']);
		    unset($_SESSION['billing_email']);
		    unset($_SESSION['billing_phone']);
		    unset($_SESSION['billing_country']);
		    unset($_SESSION['billing_address']);
		    unset($_SESSION['billing_state']);
		    unset($_SESSION['billing_city']);
		    unset($_SESSION['billing_zip']);

		    unset($_SESSION['ship_different']);
		    unset($_SESSION['shipping_name']);
		    unset($_SESSION['shipping_email']);
		    unset($_SESSION['shipping_phone']);
		    unset($_SESSION['shipping_country']);
		    unset($_SESSION['shipping_address']);
		    unset($_SESSION['shipping_state']);
		    unset($_SESSION['shipping_city']);
		    unset($_SESSION['shipping_zip']);
		}

		$success = SUCCESS_DELETE_ITEM_FROM_CART;
        $this->session->set_flashdata('success',$success);
        redirect(base_url().M_REWRITE.'cart');

	}
}