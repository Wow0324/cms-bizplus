<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends MY_Controller {

	function __construct()
	{
        parent::__construct();
        $this->load->model('Model_common');
        $this->load->model('Model_payment');
	    $this->load->library('paypal_lib');
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

		$this->load->view('view_header',$data);
		$this->load->view('view_payment',$data);
		$this->load->view('view_footer',$data);
	}

	public function stripe()
	{
		$data['setting'] = $this->Model_common->all_setting();

		$next_id = $this->Model_payment->get_auto_increment_id();
		foreach ($next_id as $row) {
            $ai_id = $row['Auto_increment'];
        }

		require './public/payment/stripe/lib/init.php';

		if (isset($_POST['payment']) && $_POST['payment'] == 'posted') {

		    \Stripe\Stripe::setApiKey($data['setting']['stripe_secret_key']);
		    try {
		        if (!isset($_POST['stripeToken']))
		            throw new Exception("The Stripe Token was not generated correctly");

				$card_number       = $this->input->post('card_number', true);
				$card_cvv          = $this->input->post('card_cvv', true);
				$card_expiry_month = $this->input->post('card_expiry_month', true);
				$card_expiry_year  = $this->input->post('card_expiry_year', true);
				$amount            = $this->input->post('amount', true);

		        $invoice_no = time();
		        $payment_date_time = date('Y-m-d H:i:s');
		        $order_no = uniqid();
		        $amount = floatval($amount);
		        $cents = floatval($amount * 100);
		        $currency = 'usd';

		        $response = \Stripe\Charge::create(array(
							"amount"      => $cents,
							"currency"    => $currency,
							"card"        => $_POST['stripeToken'],
							"description" => 'Stripe Payment'
		        ));
		        $responseJson = $response->jsonSerialize();

		        $transaction_id = $responseJson['balance_transaction'];
		        $transaction_status = $response->status;

		        $bal = \Stripe\BalanceTransaction::retrieve($responseJson['balance_transaction']);
		        $balJson = $bal->jsonSerialize();

		        $fee_amount  = $balJson['fee']/100;
		        $fee_amount = $this->Model_common->n_format($fee_amount,2);

		        $net_amount  = $balJson['net']/100;
		        $net_amount = $this->Model_common->n_format($net_amount,2);

				if(isset($_SESSION['customer_id']))
		        {
		            $c_id = $_SESSION['customer_id'];
		            $c_name = $_SESSION['customer_name'];
		            $c_email = $_SESSION['customer_email'];
		            $c_type = 'Returning Customer';
		        }
		        else
		        {
		            $c_id = 0;
		            $c_name = $_SESSION['billing_name'];
		            $c_email = $_SESSION['billing_email'];
		            $c_type = 'Guest';
		        }

		        if(isset($_SESSION['coupon_code'])) {
		            $coupon_amount = $_SESSION['coupon_amount'];
		            $coupon_code = $_SESSION['coupon_code'];
		        } else {
		            $coupon_amount = 0;
		            $coupon_code = '';
		        }

		        if(isset($_SESSION['shipping_cost'])) {
		            $shipping_cost = $_SESSION['shipping_cost'];
		        } else {
		            $shipping_cost = 0;
		        }

		        if(!isset($_SESSION['name_click_shipping_same_check'])) {
		            $s1 = $_SESSION['billing_name'];
		            $s2 = $_SESSION['billing_email'];
		            $s3 = $_SESSION['billing_phone'];
		            $s4 = $_SESSION['billing_country'];
		            $s5 = $_SESSION['billing_address'];
		            $s6 = $_SESSION['billing_state'];
		            $s7 = $_SESSION['billing_city'];
		            $s8 = $_SESSION['billing_zip'];
		        }
		        else
		        {
		            $s1 = $_SESSION['shipping_name'];
		            $s2 = $_SESSION['shipping_email'];
		            $s3 = $_SESSION['shipping_phone'];
		            $s4 = $_SESSION['shipping_country'];
		            $s5 = $_SESSION['shipping_address'];
		            $s6 = $_SESSION['shipping_state'];
		            $s7 = $_SESSION['shipping_city'];
		            $s8 = $_SESSION['shipping_zip'];
		        }

				$arr_data = array(
					'customer_id' => $c_id,
					'customer_name' => $c_name,
					'customer_email' => $c_email,
					'customer_type' => $c_type,
					'billing_name' => $_SESSION['billing_name'],
					'billing_email' => $_SESSION['billing_email'],
					'billing_phone' => $_SESSION['billing_phone'],
					'billing_country' => $_SESSION['billing_country'],
					'billing_address' => $_SESSION['billing_address'],
					'billing_state' => $_SESSION['billing_state'],
					'billing_city' => $_SESSION['billing_city'],
					'billing_zip' => $_SESSION['billing_zip'],
					'shipping_name' => $s1,
					'shipping_email' => $s2,
					'shipping_phone' => $s3,
					'shipping_country' => $s4,
					'shipping_address' => $s5,
					'shipping_state' => $s6,
					'shipping_city' => $s7,
					'shipping_zip' => $s8,
					'order_note' => $_SESSION['order_note'],
					'payment_date_time' => $payment_date_time,
					'txnid' => $transaction_id,
					'shipping_cost' => $shipping_cost,
					'coupon_code' => $coupon_code,
					'coupon_discount' => $coupon_amount,
					'paid_amount' => $_POST['amount'],
					'fee_amount' => $fee_amount,
					'net_amount' => $net_amount,
					'card_number' => $_POST['card_number'],
					'card_cvc' => $_POST['card_cvc'],
					'card_expiry_month' => $_POST['card_expiry_month'],
					'card_expiry_year' => $_POST['card_expiry_year'],
					'bank_information' => '',
					'payment_method' => 'Stripe',
					'payment_status' => 'Completed',
					'order_no' => $order_no
	            );
	            $this->Model_payment->order_add($arr_data);

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

		        $product_detail = '';
		        for($i=1;$i<=count($arr_cart_product_id);$i++)
		        {
		            // Getting product name and price from tbl_product
		            $p_detail = $this->Model_payment->p_detail($arr_cart_product_id[$i]);

	                $product_name = $p_detail['product_name'];
	                $product_current_price = $p_detail['product_current_price'];
	                $product_stock = $p_detail['product_stock'];
		            
		            // Inserting data into tbl_order_detail
		            $arr_data1 = array(
						'order_id' => $ai_id,
						'product_id' => $arr_cart_product_id[$i],
						'product_name' => $product_name,
						'product_price' => $product_current_price,
						'product_qty' => $arr_cart_product_qty[$i],
						'payment_status' => 'Completed',
						'order_no' => $order_no,
		            );
		            $this->Model_payment->order_detail_add($arr_data1);

		            $product_detail .= '
		            <b>Product #'.$i.'</b><br>
		            Product Name: '.$product_name.'<br>
		            Product Price: $'.$product_current_price.'<br>
		            Product Quantity: '.$arr_cart_product_qty[$i].'<br>
		            ';

		            // Update the stock
		            $final_quantity = $product_stock - $arr_cart_product_qty[$i];
		            $form_data = array(
						'product_stock' => $final_quantity
		            );
		            $this->Model_payment->update_stock($arr_cart_product_id[$i],$form_data);

		        }


		        // Update the tbl_coupon, because this time it is using one time.
		        if(isset($_SESSION['coupon_code']))
		        {
		        	$coupon_data = $this->Model_payment->coupon_data($_SESSION['coupon_code']);
	            
	                $coupon_maximum_use = $coupon_data['coupon_maximum_use'];
	                $coupon_existing_use = $coupon_data['coupon_existing_use'];

		            $coupon_existing_use = $coupon_existing_use + 1;

		            $form_data = array(
						'coupon_existing_use' => $coupon_existing_use
		            );
		            $this->Model_payment->update_coupon_use($_SESSION['coupon_code'],$form_data);
		        }

		        $payment_method = '
		        Payment Method: Stripe<br>
		        Card Number: '.$_POST['card_number'].'<br>
		        Card CVC: '.$_POST['card_cvc'].'<br>
		        Card Expiry Month: '.$_POST['card_expiry_month'].'<br>
		        Card Expiry Year: '.$_POST['card_expiry_year'];

		        $message = '
		        <p>Dear '.$c_name.',</p>
		        <p>Your order has been submitted successfully and we received the payment from you. After you process and ship the order, you will get all the products after a certain time period. 
		        </p>
		        <p><b>Payment Information:</b></p>
		        <p>
		        Order Number: '.$order_no.'<br>
				'.$payment_method.'<br>
				Payment Date & Time: '.$payment_date_time.'<br>
				Transaction Id: '.$transaction_id.'<br>
				Shipping Cost: $'.$shipping_cost.'<br>
				Coupon Code: '.$coupon_code.'<br>
				Coupon Discount: $'.$coupon_amount.'<br>
				Paid Amount: $'.$_POST['amount'].'<br>
				Payment Status: Completed
				</p>
				<p><b>Billing Details:</b></p>
				<p>
				Billing Name: '.$_SESSION['billing_name'].'<br>
				Billing Email: '.$_SESSION['billing_email'].'<br>
				Billing Phone: '.$_SESSION['billing_phone'].'<br>
				Billing Country: '.$_SESSION['billing_country'].'<br>
				Billing Address: '.$_SESSION['billing_address'].'<br>
				Billing State: '.$_SESSION['billing_state'].'<br>
				Billing City: '.$_SESSION['billing_city'].'<br>
				Billing Zip: '.$_SESSION['billing_zip'].'
				</p>
				<p><b>Shipping Details:</b></p>
				<p>
				Shipping Name: '.$s1.'<br>
				Shipping Email: '.$s2.'<br>
				Shipping Phone: '.$s3.'<br>
				Shipping Country: '.$s4.'<br>
				Shipping Address: '.$s5.'<br>
				Shipping State: '.$s6.'<br>
				Shipping City: '.$s7.'<br>
				Shipping Zip: '.$s8.'
				</p>
				<p><b>Products You Purchased: </b></p>
				<p>'.$product_detail.'</p>
				<p>Thank you!</p>';

				if($data['setting']['smtp_active'] == 'Yes') 
				{
                    if($data['setting']['smtp_secured'] == 'Yes') 
                    {
                        $config = array(
                            'protocol' => 'smtp',
                            'smtp_crypto' => 'ssl',
                            'smtp_host' => $data['setting']['smtp_host'],
                            'smtp_port' => $data['setting']['smtp_port'],
                            'smtp_user' => $data['setting']['smtp_username'],
                            'smtp_pass' => $data['setting']['smtp_password'],
                            'mailtype'  => 'html', 
                            'charset'   => 'utf-8'
                        );
                    }
                    else
                    {
                        $config = array(
                            'protocol' => 'smtp',
                            'smtp_crypto' => 'tls',
                            'smtp_host' => $data['setting']['smtp_host'],
                            'smtp_port' => $data['setting']['smtp_port'],
                            'smtp_user' => $data['setting']['smtp_username'],
                            'smtp_pass' => $data['setting']['smtp_password'],
                            'mailtype'  => 'html', 
                            'charset'   => 'utf-8'
                        );  
                    }
                    $this->load->library('email', $config);
                } else {
                    $this->load->library('email');
                }

                $this->email->reply_to($data['setting']['receive_email_to']);
                $this->email->from($data['setting']['send_email_from']);
                $this->email->to($c_email);

                $subject = 'Order Completed';
                $this->email->subject($subject);
                $this->email->message($msg);

                $this->email->set_mailtype("html");

                $this->email->send();

		        unset($_SESSION['cart_product_id']);
		        unset($_SESSION['cart_product_qty']);

		        unset($_SESSION['shipping_id']);
		        unset($_SESSION['shipping_cost']);

		        unset($_SESSION['coupon_id']);
		        unset($_SESSION['coupon_code']);
		        unset($_SESSION['coupon_amount']);

		        unset($_SESSION['billing_name']);
		        unset($_SESSION['billing_email']);
		        unset($_SESSION['billing_phone']);
		        unset($_SESSION['billing_country']);
		        unset($_SESSION['billing_address']);
		        unset($_SESSION['billing_state']);
		        unset($_SESSION['billing_city']);
		        unset($_SESSION['billing_zip']);

		        unset($_SESSION['name_click_shipping_same_check']);
		        unset($_SESSION['shipping_name']);
		        unset($_SESSION['shipping_email']);
		        unset($_SESSION['shipping_phone']);
		        unset($_SESSION['shipping_country']);
		        unset($_SESSION['shipping_address']);
		        unset($_SESSION['shipping_state']);
		        unset($_SESSION['shipping_city']);
		        unset($_SESSION['shipping_zip']);

		        unset($_SESSION['subtotal']);
		        unset($_SESSION['order_note']);


		        redirect(base_url().M_REWRITE.'payment/payment-success');

		    } catch (Exception $e) {
		        $error = $e->getMessage();
		        ?><script type="text/javascript">alert('Error: <?php echo  $error; ?>');</script><?php
		    }
		}
	}

	public function paypal()
	{
		$data['setting'] = $this->Model_common->all_setting();

		$next_id = $this->Model_payment->get_auto_increment_id();
		foreach ($next_id as $row) {
            $ai_id = $row['Auto_increment'];
        }

        $amount = $this->input->post('amount', true);

        $returnURL = base_url().M_REWRITE.'paypal/success'; //payment success url
        $cancelURL = base_url().M_REWRITE.'paypal/cancel'; //payment cancel url
        $notifyURL = base_url().M_REWRITE.'paypal/ipn'; //ipn url

        $invoice_no = time();
        $payment_date_time = date('Y-m-d H:i:s');
        $order_no = uniqid();
        $currency = 'usd';

        if(isset($_SESSION['customer_id']))
        {
            $c_id = $_SESSION['customer_id'];
            $c_name = $_SESSION['customer_name'];
            $c_email = $_SESSION['customer_email'];
            $c_type = 'Returning Customer';
        }
        else
        {
            $c_id = 0;
            $c_name = $_SESSION['billing_name'];
            $c_email = $_SESSION['billing_email'];
            $c_type = 'Guest';
        }

        if(isset($_SESSION['coupon_code'])) {
            $coupon_amount = $_SESSION['coupon_amount'];
            $coupon_code = $_SESSION['coupon_code'];
        } else {
            $coupon_amount = 0;
            $coupon_code = '';
        }

        if(isset($_SESSION['shipping_cost'])) {
            $shipping_cost = $_SESSION['shipping_cost'];
        } else {
            $shipping_cost = 0;
        }

        if(!isset($_SESSION['name_click_shipping_same_check'])) {
            $s1 = $_SESSION['billing_name'];
            $s2 = $_SESSION['billing_email'];
            $s3 = $_SESSION['billing_phone'];
            $s4 = $_SESSION['billing_country'];
            $s5 = $_SESSION['billing_address'];
            $s6 = $_SESSION['billing_state'];
            $s7 = $_SESSION['billing_city'];
            $s8 = $_SESSION['billing_zip'];
        }
        else
        {
            $s1 = $_SESSION['shipping_name'];
            $s2 = $_SESSION['shipping_email'];
            $s3 = $_SESSION['shipping_phone'];
            $s4 = $_SESSION['shipping_country'];
            $s5 = $_SESSION['shipping_address'];
            $s6 = $_SESSION['shipping_state'];
            $s7 = $_SESSION['shipping_city'];
            $s8 = $_SESSION['shipping_zip'];
        }

		$arr_data = array(
			'customer_id' => $c_id,
			'customer_name' => $c_name,
			'customer_email' => $c_email,
			'customer_type' => $c_type,
			'billing_name' => $_SESSION['billing_name'],
			'billing_email' => $_SESSION['billing_email'],
			'billing_phone' => $_SESSION['billing_phone'],
			'billing_country' => $_SESSION['billing_country'],
			'billing_address' => $_SESSION['billing_address'],
			'billing_state' => $_SESSION['billing_state'],
			'billing_city' => $_SESSION['billing_city'],
			'billing_zip' => $_SESSION['billing_zip'],
			'shipping_name' => $s1,
			'shipping_email' => $s2,
			'shipping_phone' => $s3,
			'shipping_country' => $s4,
			'shipping_address' => $s5,
			'shipping_state' => $s6,
			'shipping_city' => $s7,
			'shipping_zip' => $s8,
			'order_note' => $_SESSION['order_note'],
			'payment_date_time' => $payment_date_time,
			'txnid' => '',
			'shipping_cost' => $shipping_cost,
			'coupon_code' => $coupon_code,
			'coupon_discount' => $coupon_amount,
			'paid_amount' => $amount,
			'fee_amount' => '',
			'net_amount' => '',
			'card_number' => '',
			'card_cvc' => '',
			'card_expiry_month' => '',
			'card_expiry_year' => '',
			'bank_information' => '',
			'payment_method' => 'PayPal',
			'payment_status' => 'Pending',
			'order_no' => $order_no
        );
        $this->Model_payment->order_add($arr_data);

        $arr = array(
            'o_no' => $order_no,
            'amnt' => $amount,
            'payment_date_time' => $payment_date_time
        );
        $this->session->set_userdata($arr);



        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);
        $this->paypal_lib->add_field('item_name', 'All Items');
        $this->paypal_lib->add_field('item_number',  'Item Number');
        $this->paypal_lib->add_field('amount',  $amount);     
        
        $this->paypal_lib->paypal_auto_form();

	}

	public function payment_success()
	{
		$data['setting'] = $this->Model_common->all_setting();
		$data['comment'] = $this->Model_common->all_comment();
		$data['social'] = $this->Model_common->all_social();
		$data['all_blogs'] = $this->Model_common->all_blogs();

		$this->load->view('view_header',$data);
		$this->load->view('view_payment_success',$data);
		$this->load->view('view_footer',$data);
	}

	public function payment_cancel()
	{
		$data['setting'] = $this->Model_common->all_setting();
		$data['comment'] = $this->Model_common->all_comment();
		$data['social'] = $this->Model_common->all_social();
		$data['all_blogs'] = $this->Model_common->all_blogs();
		
		$this->load->view('view_header',$data);
		$this->load->view('view_payment_cancel',$data);
		$this->load->view('view_footer',$data);
	}


}