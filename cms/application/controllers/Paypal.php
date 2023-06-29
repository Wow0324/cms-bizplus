<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paypal extends MY_Controller 
{
     function  __construct(){
        parent::__construct();
        $this->load->model('Model_common');
        $this->load->library('paypal_lib');
        $this->load->model('Model_payment');
     }
     
     function success() 
     {
        $data['setting'] = $this->Model_common->all_setting();

        $next_id = $this->Model_payment->get_auto_increment_id();
        foreach ($next_id as $row) {
            $ai_id = $row['Auto_increment'];
        }

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

        $o_no = $this->session->userdata('o_no');
        $payment_date_time = $this->session->userdata('payment_date_time');

        $o_detail = $this->Model_payment->order_id_by_order_no($o_no);


        $mc_gross = $_POST["mc_gross"];
        $mc_fee = $_POST["mc_fee"];
        $net = $mc_gross-$mc_fee;

        $form_data = array(
            'txnid' => $_POST["txn_id"],
            'payment_status' => 'Completed',
            'fee_amount' => $mc_fee,
            'net_amount' => $net
        );
        $this->Model_payment->update_payment_data($o_no,$form_data);


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
                'order_id' => $o_detail['id'],
                'product_id' => $arr_cart_product_id[$i],
                'product_name' => $product_name,
                'product_price' => $product_current_price,
                'product_qty' => $arr_cart_product_qty[$i],
                'payment_status' => 'Completed',
                'order_no' => $o_no,
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

        $message = '
        <p>Dear '.$c_name.',</p>
        <p>Your order has been submitted successfully and we received the payment from you. After you process and ship the order, you will get all the products after a certain time period. 
        </p>
        <p><b>Payment Information:</b></p>
        <p>
        Order Number: '.$o_no.'<br>
        Payment Method: PayPal<br>
        Payment Date & Time: '.$payment_date_time.'<br>
        Transaction Id: '.$_POST['txn_id'].'<br>
        Shipping Cost: $'.$shipping_cost.'<br>
        Coupon Code: '.$coupon_code.'<br>
        Coupon Discount: $'.$coupon_amount.'<br>
        Paid Amount: $'.$_SESSION['amnt'].'<br>
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
        $this->email->message($message);

        $this->email->set_mailtype("html");

        $this->email->send();

        $this->session->unset_userdata('o_no');
        $this->session->unset_userdata('amnt');

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
     }
     
    function cancel()
    {
        $o_no = $this->session->userdata('o_no');
        $this->Model_payment->delete_payment_data($o_no);

        $this->session->unset_userdata('o_no');
        $this->session->unset_userdata('amnt');

        redirect(base_url().M_REWRITE.'payment/payment-cancel');
    }
     
     function ipn()
     {
        $paypalInfo = $this->input->post();
        $data['user_id']        = $paypalInfo['custom'];
        $data['product_id']     = $paypalInfo["item_number"];
        $data['txn_id']         = $paypalInfo["txn_id"];
        $data['payment_gross']  = $paypalInfo["payment_gross"];
        $data['currency_code']  = $paypalInfo["mc_currency"];
        $data['payer_email']    = $paypalInfo["payer_email"];
        $data['payment_status'] = $paypalInfo["payment_status"];

        $paypalURL = $this->paypal_lib->paypal_url;        
        $result    = $this->paypal_lib->curlPost($paypalURL,$paypalInfo);
    }
}