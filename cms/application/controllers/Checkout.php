<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends MY_Controller {

	function __construct()
	{
        parent::__construct();
        $this->load->model('Model_common');
        $this->load->model('Model_checkout');
    }

	public function index()
	{
		if(!isset($_SESSION['cart_product_id'])) {
			redirect(base_url().M_REWRITE);	
			exit;
		}

		$data['setting'] = $this->Model_common->all_setting();
		$data['comment'] = $this->Model_common->all_comment();
		$data['social'] = $this->Model_common->all_social();
		$data['all_blogs'] = $this->Model_common->all_blogs();
		$data['all_countries'] = $this->Model_checkout->all_countries();
		$data['shipping_data'] = $this->Model_checkout->shipping_data();

		if(isset($_POST['coupon_apply']))
		{
			$coupon_code = $this->input->post('coupon_code', true);
			$today = date('Y-m-d');

			$valid = 1;

			$coupon_detail = $this->Model_checkout->coupon_detail($coupon_code);
			$tot1 = $this->Model_checkout->coupon_detail_total($coupon_code);

			if(!$tot1)
			{
				$valid = 0;
				$error = ERROR_COUPON_CODE_NOT_FOUND;
			}
			else
			{				
				$coupon_id = $coupon_detail['coupon_id'];
				$coupon_discount = $coupon_detail['coupon_discount'];
				$coupon_type = $coupon_detail['coupon_type'];

				if($coupon_detail['coupon_existing_use'] == $coupon_detail['coupon_maximum_use'])
				{
					$valid = 0;
					$error = ERROR_COUPON_CODE_MAX_USED;
				}
				elseif($today < $coupon_detail['coupon_start_date'])
				{
					$valid = 0;
					$error = ERROR_COUPON_DATE_NOT_COME;
				}
				elseif($today > $coupon_detail['coupon_end_date'])
				{
					$valid = 0;
					$error = ERROR_COUPON_DATE_EXPIRED;
				}
			}

			if($valid == 1)
			{
				if($coupon_type == 'Percentage')
				{
					$arr['coupon_amount'] = ($_SESSION['subtotal']*$coupon_discount)/100;
				}
				else
				{
					$arr['coupon_amount'] = $coupon_discount;
				}
				$_SESSION['coupon_code'] = $coupon_code;
				$_SESSION['coupon_amount'] = $arr['coupon_amount'];
				$_SESSION['coupon_id'] = $coupon_id;

				if(!isset($_SESSION['shipping_cost'])) {
					$temp1 = 0;
				} else {
					$temp1 = $_SESSION['shipping_cost'];
				}
				$final_price = ($_SESSION['subtotal']+$temp1)-$_SESSION['coupon_amount'];
				$arr['final_price'] = $final_price;

				$success = SUCCESS_COUPON_APPLIED;
				$this->session->set_flashdata('success',$success);
				redirect(base_url().M_REWRITE.'checkout');
			}
			else
			{
				$this->session->set_flashdata('error',$error);
				redirect(base_url().M_REWRITE.'checkout');
			}
		}

		elseif(isset($_POST['form_shipping']))
		{
			$shipping_id = $this->input->post('shipping_id', true);
			$shipping_detail = $this->Model_checkout->shipping_detail($shipping_id);
			
			$_SESSION['shipping_id'] = $shipping_id;
			$_SESSION['shipping_cost'] = $shipping_detail['shipping_cost'];

			$success = SUCCESS_SHIPPING_SELECTED;
			$this->session->set_flashdata('success',$success);
			redirect(base_url().M_REWRITE.'checkout');
		}

		elseif(isset($_POST['form_login_checkout']))
		{
			$valid = 1;

			$customer_email = $this->input->post('customer_email', true);
			$customer_password = $this->input->post('customer_password', true);

		    if($customer_password == '')
		    {
		    	$valid = 0;
		    	$error .= ERROR_EMPTY_PASSWORD.'<br>';
		    }

		    if($customer_email == '')
		    {
		    	$valid = 0;
		    	$error .= ERROR_EMPTY_EMAIL.'<br>';
		    }
		    else
		    {
		    	if(!filter_var($customer_email, FILTER_VALIDATE_EMAIL)) {
		    		$valid = 0;
		    		$error .= ERROR_VALID_EMAIL.'<br>';
		    	}
		    	else
		    	{
		    		$customer_detail = $this->Model_checkout->customer_detail($customer_email);
		    		$customer_detail_total = $this->Model_checkout->customer_detail_total($customer_email);
			        if(!$customer_detail_total)
			        {
			     		$valid = 0;
		    			$error .= ERROR_NOT_FOUND_EMAIL.'<br>';
			        }
			        else
			        {
			            $customer_status = $customer_detail['customer_status'];
			            $saved_password = $customer_detail['customer_password'];
				        
				        if($customer_status!='Active')
				        {
							$valid = 0;
		    				$error .= ERROR_CUSTOMER_INACTIVE.'<br>';
				        }
				        else
				        {
				        	if(!password_verify($customer_password,$saved_password))
				        	{
				        		$valid = 0;
		    					$error .= ERROR_PASSWORD.'<br>';
				        	}
				        }
			        }
		    	}
		    }

		    if($valid == 1)
		    {
		    	$array = array(
                    'customer_id' => $customer_detail['customer_id'],
                    'customer_name' => $customer_detail['customer_name'],
                    'customer_email' => $customer_detail['customer_email'],
                    'customer_phone' => $customer_detail['customer_phone'],
                    'customer_country' => $customer_detail['customer_country'],
                    'customer_address' => $customer_detail['customer_address'],
                    'customer_state' => $customer_detail['customer_state'],
                    'customer_city' => $customer_detail['customer_city'],
                    'customer_zip' => $customer_detail['customer_zip'],
                    'customer_password' => $customer_detail['customer_password'],
                    'customer_token' => $customer_detail['customer_token'],
                    'customer_status' => $customer_detail['customer_status']
                );
                $this->session->set_userdata($array);
				$success = SUCCESS_CUSTOMER_LOGIN;
				$this->session->set_flashdata('success',$success);
				redirect(base_url().M_REWRITE.'checkout');	
		    }
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().M_REWRITE.'checkout');
		    }
		}

		elseif(isset($_POST['form_continue_payment']))
		{
			$valid = 1;

			$billing_name = $this->input->post('billing_name', true);
			$billing_email = $this->input->post('billing_email', true);
			$billing_phone = $this->input->post('billing_phone', true);
			$billing_country = $this->input->post('billing_country', true);
			$billing_address = $this->input->post('billing_address', true);
			$billing_state = $this->input->post('billing_state', true);
			$billing_city = $this->input->post('billing_city', true);
			$billing_zip = $this->input->post('billing_zip', true);

			$order_note = $this->input->post('order_note', true);

			if($billing_name == '')
			{
				$valid = 0;
			}

			if($billing_email == '')
			{
				$valid = 0;
			}
			else
			{
				if(!filter_var($billing_email,FILTER_VALIDATE_EMAIL))
				{
					$valid = 0;
				}
			}

			if($billing_phone == '')
			{
				$valid = 0;
			}

			if($billing_country == '')
			{
				$valid = 0;
			}

			if($billing_address == '')
			{
				$valid = 0;
			}

			if($billing_state == '')
			{
				$valid = 0;
			}

			if($billing_city == '')
			{
				$valid = 0;
			}

			if($billing_zip == '')
			{
				$valid = 0;
			}

			if(isset($_POST['name_click_shipping_same_check']))
			{
				$shipping_name = $this->input->post('shipping_name', true);
				$shipping_email = $this->input->post('shipping_email', true);
				$shipping_phone = $this->input->post('shipping_phone', true);
				$shipping_country = $this->input->post('shipping_country', true);
				$shipping_address = $this->input->post('shipping_address', true);
				$shipping_state = $this->input->post('shipping_state', true);
				$shipping_city = $this->input->post('shipping_city', true);
				$shipping_zip = $this->input->post('shipping_zip', true);

				if($shipping_name == '')
				{
					$valid = 0;
				}

				if($shipping_email == '')
				{
					$valid = 0;
				}
				else
				{
					if(!filter_var($shipping_email,FILTER_VALIDATE_EMAIL))
					{
						$valid = 0;
					}
				}

				if($shipping_phone == '')
				{
					$valid = 0;
				}

				if($shipping_country == '')
				{
					$valid = 0;
				}

				if($shipping_address == '')
				{
					$valid = 0;
				}

				if($shipping_state == '')
				{
					$valid = 0;
				}

				if($shipping_city == '')
				{
					$valid = 0;
				}

				if($shipping_zip == '')
				{
					$valid = 0;
				}
			}


			if($valid == 1)
			{
				$_SESSION['billing_name'] = $billing_name;
				$_SESSION['billing_email'] = $billing_email;
				$_SESSION['billing_phone'] = $billing_phone;
				$_SESSION['billing_country'] = $billing_country;
				$_SESSION['billing_address'] = $billing_address;
				$_SESSION['billing_state'] = $billing_state;
				$_SESSION['billing_city'] = $billing_city;
				$_SESSION['billing_zip'] = $billing_zip;

				if(isset($_POST['name_click_shipping_same_check']))
				{
					$_SESSION['name_click_shipping_same_check'] = $this->input->post('name_click_shipping_same_check', true);
					$_SESSION['shipping_name'] = $shipping_name;
					$_SESSION['shipping_email'] = $shipping_email;
					$_SESSION['shipping_phone'] = $shipping_phone;
					$_SESSION['shipping_country'] = $shipping_country;
					$_SESSION['shipping_address'] = $shipping_address;
					$_SESSION['shipping_state'] = $shipping_state;
					$_SESSION['shipping_city'] = $shipping_city;
					$_SESSION['shipping_zip'] = $shipping_zip;
				}
				else
				{
					unset($_SESSION['name_click_shipping_same_check']);
					unset($_SESSION['shipping_name']);
					unset($_SESSION['shipping_email']);
					unset($_SESSION['shipping_phone']);
					unset($_SESSION['shipping_country']);
					unset($_SESSION['shipping_address']);
					unset($_SESSION['shipping_state']);
					unset($_SESSION['shipping_city']);
					unset($_SESSION['shipping_zip']);
				}

				$_SESSION['order_note'] = $order_note;

				redirect(base_url().M_REWRITE.'payment');
			}
			else
			{
				$error = ERROR_ALL_REQUIRED_FIELD;
				$this->session->set_flashdata('error',$error);
				redirect(base_url().M_REWRITE.'checkout');
			}
		}
		else
		{
			$this->load->view('view_header',$data);
			$this->load->view('view_checkout',$data);
			$this->load->view('view_footer',$data);
		}
	}
}