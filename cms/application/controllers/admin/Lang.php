<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lang extends MY_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_lang_admin');
    }

	public function index()
	{
       	
       	$data['setting'] = $this->Model_common->get_setting_data();
		$error = '';
		$success = '';

		$data['lang'] = $this->Model_lang_admin->show();
       	$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_lang',$data);
		$this->load->view('admin/view_footer');
	}

	public function add()
	{
		$data['setting'] = $this->Model_common->get_setting_data();
		$error = '';
		$success = '';

		$next_id = $this->Model_lang_admin->get_auto_increment_id();
		foreach ($next_id as $row) {
            $ai_id = $row['Auto_increment'];
        }

        $lang_name = $this->input->post('lang_name', true);
		$lang_default = $this->input->post('lang_default', true);

		if($lang_default == 1)
		{
			$arr = array(
				'lang_default' => ''
			);
			$this->Model_lang_admin->make_all_empty($arr);
			$lang_default = 'Yes';
		}
		else
		{
			$lang_default = '';	
		}

		if(isset($_POST['form1']))
		{
			$valid = 1;

			$this->form_validation->set_rules('lang_name', 'Language Name', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error = validation_errors();
            }

            if($valid == 1)
		    {
		        $form_data = array(
					'lang_name' => $lang_name,
					'lang_default' => $lang_default
	            );
	            $this->Model_lang_admin->add($form_data);

	            $temp_arr = array(
	            	'HOME',
	            	'ABOUT',
	            	'FAQ',
	            	'SERVICE',
	            	'GALLERY',
	            	'BLOG',
	            	'CONTACT',
	            	'TEAM_MEMBERS',
	            	'SHOP',
	            	'PAGES',
	            	'CUSTOMER_DASHBOARD',
	            	'CUSTOMER_TYPE',
	            	'READ_MORE',
	            	'EMAIL_ADDRESS',
	            	'NAME',
	            	'FULL_NAME',
	            	'PHONE_NUMBER',
	            	'SUBJECT',
	            	'MESSAGE',
	            	'SEND_MESSAGE',
	            	'ADDRESS',
	            	'COUNTRY',
	            	'SELECT_COUNTRY',
	            	'STATE',
	            	'CITY',
	            	'ZIP',
	            	'CONTACT_FORM',
	            	'CATEGORY',
	            	'TERMS_AND_CONDIITIONS',
	            	'PRIVACY_POLICY',
	            	'SHARE_THIS_BLOG',
	            	'COMMENT',
	            	'DASHBOARD',
	            	'EDIT_PROFILE',
	            	'LOGOUT',
	            	'WELCOME_TO_DASHBOARD',
	            	'CUSTOMER_DETAIL',
	            	'SERIAL',
	            	'ORDER_DETAIL',
	            	'ORDER_HISTORY',
	            	'ORDER_NUMBER',
	            	'ORDER_NOTES',
	            	'STATUS',
	            	'BACK_TO_PREVIOUS',
	            	'INCOMING',
	            	'SUCCESS_EDIT_PROFILE',
	            	'UPDATE_PROFILE',
	            	'PASSWORD',
	            	'RETYPE_PASSWORD',
	            	'ERROR_PASSWORD',
	            	'ERROR_MATCH_PASSWORD',
	            	'CUSTOMER_LOGIN',
	            	'SUCCESS_CUSTOMER_LOGIN',
	            	'CUSTOMER_REGISTRATION',
	            	'CUSTOMER_RESET_PASSWORD',
	            	'LOGIN',
	            	'FORGET_PASSWORD',
	            	'REGISTRATION',
	            	'SUBMIT',
	            	'GO_TO_LOGIN_PAGE',
	            	'NEW_PASSWORD',
	            	'SUCCESS_CUSTOMER_REGISTRATION',
	            	'SUCCESS_SUBSCRIPTION',
	            	'SUCCESS_SUBSCRIPTION_EMAIL_CHECK',
	            	'SUCCESS_FORGET_PASSWORD',
	            	'ERROR_EMPTY_PASSWORD',
	            	'PASSWORD_RESET',
	            	'ERROR_EMPTY_NAME',
	            	'ERROR_EMPTY_PHONE',
	            	'ERROR_EMPTY_EMAIL',
	            	'ERROR_VALID_EMAIL',
	            	'ERROR_EXIST_EMAIL',
	            	'ERROR_NOT_FOUND_EMAIL',
	            	'ERROR_EMPTY_MESSAGE',
	            	'ERROR_EMPTY_ADDRESS',
	            	'ERROR_EMPTY_STATE',
	            	'ERROR_EMPTY_CITY',
	            	'ERROR_EMPTY_ZIP',
	            	'ERROR_CUSTOMER_LOGIN',
	            	'ERROR_CUSTOMER_INACTIVE',
	            	'ERROR_ALL_REQUIRED_FIELD',
	            	'SENDER_INFORMATION',
	            	'SUBJECT_CONTACT_PAGE',
	            	'SUCCESS_CONTACT_PAGE',
	            	'DAY',
	            	'DETAIL_INFORMATION',
	            	'MAKE_REGISTRATION',
	            	'ACTION',
	            	'VIEW_DETAIL',
	            	'CLOSE',
	            	'PAYMENT',
	            	'MAKE_PAYMENT',
	            	'SELECT_PAYMENT_METHOD',
	            	'PAY_NOW',
	            	'PAYPAL',
	            	'STRIPE',
	            	'CARD_NUMBER',
	            	'CARD_CVC_NO',
	            	'CARD_EXPIRY_MONTH',
	            	'CARD_EXPIRY_YEAR',
	            	'BANK_INFORMATION',
	            	'PAY_WITH_PAYPAL',
	            	'PAY_WITH_STRIPE',
	            	'SUCCESS_PAYMENT_PAGE',
	            	'CANCEL_PAYMENT_PAGE',
	            	'PAYMENT_DATE',
	            	'PAYMENT_DATE_TIME',
	            	'PAYMENT_METHOD',
	            	'TRANSACTION_ID',
	            	'PAID_AMOUNT',
	            	'PAYMENT_STATUS',
	            	'INVOICE_NO',
	            	'PHOTO_GALLERY',
	            	'VIDEO_GALLERY',
	            	'CART',
	            	'UPDATE_CART',
	            	'ADD_TO_CART',
	            	'SUCCESS_PRODUCT_ADD_CART',
	            	'ERROR_PRODUCT_EXIST_CART',
	            	'ERROR_PRODUCT_OUT_OF_STOCK',
	            	'SUCCESS_DELETE_ITEM_FROM_CART',
	            	'SUCCESS_UPDATE_CART',
	            	'CONTINUE_SHOPPING',
	            	'CONTINUE_TO_PAYMENT',
	            	'CHECKOUT',
	            	'COUPON',
	            	'HAVE_A_COUPON',
	            	'COUPON_CODE',
	            	'COUPON_DISCOUNT',
	            	'APPLY_COUPON',
	            	'ERROR_COUPON_CODE_NOT_FOUND',
	            	'ERROR_COUPON_CODE_MAX_USED',
	            	'ERROR_COUPON_DATE_NOT_COME',
	            	'ERROR_COUPON_DATE_EXPIRED',
	            	'SUCCESS_COUPON_APPLIED',
	            	'APPLY_SHIPPING',
	            	'SUCCESS_SHIPPING_SELECTED',
	            	'CART_EMPTY',
	            	'CART_DETAIL',
	            	'BILLING_INFORMATION',
	            	'SHIPPING_INFORMATION',
	            	'BILLING_AND_SHIPPING_INFORMATION',
	            	'PRODUCT_INFORMATION',
	            	'SHIP_TO_DIFFERENT',
	            	'SHIPPING_COST',
	            	'RETURNING_CUSTOMER_CLICK_LOGIN',
	            	'EXISTING_CUSTOMER',
	            	'STOCK_AVAILABLE',
	            	'MENU_HOME',
	            	'MENU_ABOUT',
	            	'MENU_SERVICE',
	            	'MENU_PAGES',
	            	'MENU_PHOTO_GALLERY',
	            	'MENU_VIDEO_GALLERY',
	            	'MENU_TEAM_MEMBERS',
	            	'MENU_FAQ',
	            	'MENU_SHOP',
	            	'MENU_BLOG',
	            	'MENU_CONTACT',
	            	'THUMBNAIL',
	            	'PRODUCT_NAME',
	            	'PRODUCT_PRICE',
	            	'UNIT_PRICE',
	            	'QUANTITY',
	            	'SUBTOTAL',
	            	'TOTAL',
	            	'ARE_YOU_SURE',
	            	'DESCRIPTION',
	            	'RETURN_POLICY',
	            	'FOOTER_COL_1_HEADING',
	            	'FOOTER_COL_2_HEADING',
	            	'FOOTER_COL_3_HEADING',
	            	'FOOTER_COL_4_HEADING',
	            	'FOOTER_COPYRIGHT',
	            	'FOOTER_NEWSLETTER_TEXT',
	            	'FOOTER_ADDRESS',
	            	'FOOTER_PHONE',
	            	'FOOTER_EMAIL',
	            	'CALL_TO_ACTION_TEXT',
	            	'CALL_TO_ACTION_BUTTON_TEXT',
	            	'SIDEBAR_BLOG_HEADING_CATEGORY',
	            	'SIDEBAR_BLOG_HEADING_RECENT_BLOG',
	            	'SIDEBAR_SERVICE_HEADING_SERVICES',
	            );
	            $temp_arr_value = array(
	            	'Home',
	            	'About',
	            	'FAQ',
	            	'Service',
	            	'Gallery',
	            	'Blog',
	            	'Contact',
	            	'Team Members',
	            	'Shop',
	            	'Pages',
	            	'Customer Dashboard',
	            	'Customer Type',
	            	'Read More',
	            	'Email Address',
	            	'Name',
	            	'Full Name',
	            	'Phone Number',
	            	'Subject',
	            	'Message',
	            	'Send Message',
	            	'Address',
	            	'Country',
	            	'Select Country',
	            	'State',
	            	'City',
	            	'Zip Code',
	            	'Contact Form',
	            	'Category',
	            	'Terms and Conditions',
	            	'Privacy Policy',
	            	'Share This Blog',
	            	'Comment',
	            	'Dashboard',
	            	'Edit Profile',
	            	'Logout',
	            	'Welcome to the Dashboard',
	            	'Customer Detail:',
	            	'Serial',
	            	'Oorder Detail',
	            	'Order History',
	            	'Order Number',
	            	'Order Notes',
	            	'Status',
	            	'Back to previous',
	            	'Incoming',
	            	'Profile Information is updated successfully!',
	            	'Update Profile',
	            	'Password',
	            	'Retype Password',
	            	'Password is wrong',
	            	'Passwords do not match!',
	            	'Customer Login',
	            	'Login is successful',
	            	'Customer Registration',
	            	'Customer Reset Password',
	            	'Login',
	            	'Forget Password?',
	            	'Registration',
	            	'Submit',
	            	'Go to login page',
	            	'New Password',
	            	'Customer Registration is successful. Please check your email to verify and confirm the registration.',
	            	'Your subscription is successful!',
	            	'Thank you for your interest to subscribe our newsletter! Please check your email address to finish the steps.',
	            	'Forget password request is sent successfully. Please check your email.',
	            	'Password can not be empty!',
	            	'Password Reset',
	            	'Name can not be empty!',
	            	'Phone Number can not be empty!',
	            	'Email Address can not be empty!',
	            	'Email Address is invalid!',
	            	'Email address already exists!',
	            	'Email address is not found in our system!',
	            	'Message can not be empty!',
	            	'Address can not be empty!',
	            	'State can not be empty!',
	            	'City can not be empty!',
	            	'Zip Code can not be empty!',
	            	'Email and/or Password Wrong',
	            	'Customer is not active',
	            	'',
	            	'Sender Information:',
	            	'Contact Form Email',
	            	'Thank you for sending the email. We will contact you shortly.',
	            	'Day',
	            	'Detail Information',
	            	'Make Registration',
	            	'Action',
	            	'View Detail',
	            	'Close',
	            	'Payment',
	            	'Make Payment',
	            	'Select Payment Method',
	            	'Pay Now',
	            	'PayPal',
	            	'Stripe',
	            	'Card Number',
	            	'Card CVC',
	            	'Card Expiry Month',
	            	'Card Expiry Year',
	            	'Bank Information',
	            	'Pay with PayPal',
	            	'Pay with Stripe',
	            	'Payment is Successful and appointment is confirmed.',
	            	'Payment is Cancelled. Try again or contact to the ...',
	            	'Payment Date',
	            	'Payment Date and Time',
	            	'Payment Method',
	            	'Transaction Id',
	            	'Paid Amount',
	            	'Payment Status',
	            	'Invoice No',
	            	'Photo Gallery',
	            	'Video Gallery',
	            	'Cart',
	            	'Update Cart',
	            	'Add to Cart',
	            	'Product is added to the cart successfully!',
	            	'This product is already added to the shopping cart.',
	            	'Sorry! There are not sufficient item(s) in the stock',
	            	'Item is deleted from the cart successfully!',
	            	'Cart is updated successfully!',
	            	'Continue Shopping',
	            	'Continue to Payment',
	            	'Checkout',
	            	'Coupon',
	            	'Have a Coupon',
	            	'Coupon Code',
	            	'Coupon Discount',
	            	'Apply Coupon',
	            	'Coupon code is not found',
	            	'Coupon is used maximum times already',
	            	'Coupon date does not come yet',
	            	'Coupon date is expired',
	            	'Coupon code is applied successfully!',
	            	'Apply Shipping',
	            	'Shipping method is selected successfully!',
	            	'Cart is empty',
	            	'Cart Details',
	            	'Billing Information',
	            	'Shipping Information',
	            	'Billing and Shipping Information',
	            	'Product Information',
	            	'Ship to a different address?',
	            	'Shipping Cost',
	            	'Returning Customer? Click here to login',
	            	'Existing Customer',
	            	'Stock Available: ',
	            	'Home',
	            	'About Us',
	            	'Service',
	            	'Pages',
	            	'Photo Gallery',
	            	'Video Gallery',
	            	'Team Members',
	            	'FAQ',
	            	'Shop',
	            	'Blog',
	            	'Contact Us',
	            	'Thumbnail',
	            	'Product Name',
	            	'Product Price',
	            	'Unit Price',
	            	'Quantity',
	            	'Subtotal',
	            	'Total',
	            	'Are you sure?',
	            	'Description',
	            	'Return Policy',
	            	'Newsletter',
	            	'Recent Posts',
	            	'Quick Links',
	            	'Address',
	            	'Copyright 2020, Company Name. All Rights Reserved.',
	            	'Detracto contentiones te est, brute ipsum consul an vis. Mea ei regione blandit ullamcorper, definiebas constituam vix ei.',
	            	'3153 Foley Street Miami, FL 33176',
	            	'Sales: 954-648-1802, Support: 963-612-1782',
	            	'sales@yourwebsite.com, support@yourwebsite.com',
	            	'Do you want to get high-quality service for your organization or business?',
	            	'Contact Us',
	            	'Categories',
	            	'Recent Posts',
	            	'All Services'
	            );

	            for($i=0;$i<count($temp_arr);$i++)
	            {
	            	$form_data = array(
	            		'lang_key' => $temp_arr[$i],
	            		'lang_value' => $temp_arr_value[$i],
	            		'lang_id' => $ai_id
		            );
		            $this->Model_lang_admin->add_detail($form_data);
	            }

	            // Adding Item in tbl_page_about
	            $form_data = array(
            		'about_heading' => 'About Heading',
            		'about_content' => 'About Content',
            		'lang_id' => $ai_id
	            );
	            $this->Model_lang_admin->add_page_about($form_data);

	            // Adding Item in tbl_page_service
	            $form_data = array(
            		'service_heading' => 'Service Heading',
            		'lang_id' => $ai_id
	            );
	            $this->Model_lang_admin->add_page_service($form_data);

	            // Adding Item in tbl_page_faq
	            $form_data = array(
            		'faq_heading' => 'FAQ Heading',
            		'lang_id' => $ai_id
	            );
	            $this->Model_lang_admin->add_page_faq($form_data);

	            // Adding Item in tbl_page_photo_gallery
	            $form_data = array(
            		'photo_gallery_heading' => 'Photo Gallery Heading',
            		'lang_id' => $ai_id
	            );
	            $this->Model_lang_admin->add_page_photo_gallery($form_data);

	            // Adding Item in tbl_page_video_gallery
	            $form_data = array(
            		'video_gallery_heading' => 'Video Gallery Heading',
            		'lang_id' => $ai_id
	            );
	            $this->Model_lang_admin->add_page_video_gallery($form_data);

	            // Adding Item in tbl_page_term
	            $form_data = array(
            		'term_heading' => 'Term and Conditions Heading',
            		'term_content' => 'Term and Conditions Content',
            		'lang_id' => $ai_id
	            );
	            $this->Model_lang_admin->add_page_term($form_data);

	            // Adding Item in tbl_page_privacy
	            $form_data = array(
            		'privacy_heading' => 'Privacy Policy Heading',
            		'privacy_content' => 'Privacy Policy Content',
            		'lang_id' => $ai_id
	            );
	            $this->Model_lang_admin->add_page_privacy($form_data);

	            // Adding Item in tbl_page_team_member
	            $form_data = array(
            		'team_member_heading' => 'Team Member Heading',
            		'lang_id' => $ai_id
	            );
	            $this->Model_lang_admin->add_page_team_member($form_data);


	            // Adding Item in tbl_page_contact
	            $form_data = array(
            		'contact_heading' => 'Contact Heading',
            		'contact_address' => 'Contact Address',
            		'contact_phone' => 'Contact Phone',
            		'contact_email' => 'Contact Email',
            		'lang_id' => $ai_id
	            );
	            $this->Model_lang_admin->add_page_contact($form_data);

	            // Adding Item in tbl_page_blog
	            $form_data = array(
            		'blog_heading' => 'Blog Heading',
            		'lang_id' => $ai_id
	            );
	            $this->Model_lang_admin->add_page_blog($form_data);


	            // Adding Item in tbl_page_home
	            $form_data = array(
            		'home_welcome_title' => 'Welcome Title',
            		'home_welcome_subtitle' => 'Welcome Subtitle',
            		'home_welcome_text' => 'Welcome Text',
            		'home_why_choose_title' => 'Why Choose Title',
            		'home_why_choose_subtitle' => 'Why Choose Subtitle',
            		'home_feature_title' => 'Feature Title',
            		'home_feature_subtitle' => 'Feature Subtitle',
            		'home_service_title' => 'Service Title',
            		'home_service_subtitle' => 'Service Subtitle',
            		'home_testimonial_title' => 'Testimonial Title',
            		'home_testimonial_subtitle' => 'Testimonial Subtitle',
            		'home_blog_title' => 'Blog Title',
            		'home_blog_subtitle' => 'Blog Subtitle',
            		'lang_id' => $ai_id
	            );
	            $this->Model_lang_admin->add_page_home($form_data);


	            // Adding Item in tbl_page_shop
	            $form_data = array(
            		'shop_heading' => 'Shop Heading',
            		'lang_id' => $ai_id
	            );
	            $this->Model_lang_admin->add_page_shop($form_data);


		        $success = 'Language is added successfully!';
		        $this->session->set_flashdata('success',$success);
				redirect(base_url().'admin/lang');		        
		    }
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().'admin/lang/add');
		    }

		}
		else
		{
			$this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_lang_add',$data);
			$this->load->view('admin/view_footer');	
		}
       	
	}

	public function edit($id)
	{
		$tot = $this->Model_lang_admin->lang_check($id);
    	if(!$tot) {
    		redirect(base_url().'admin/lang');
        	exit;
    	}

    	$data['setting'] = $this->Model_common->get_setting_data();
		$error = '';
		$success = '';

		$lang_name = $this->input->post('lang_name', true);
		$lang_default = $this->input->post('lang_default', true);

		if($lang_default == 1)
		{
			$arr = array(
				'lang_default' => ''
			);
			$this->Model_lang_admin->make_all_empty($arr);
			$lang_default = 'Yes';
		}
		else
		{
			$lang_default = '';
		}

		if(isset($_POST['form1'])) 
		{
			$valid = 1;

			$this->form_validation->set_rules('lang_name', 'Language Name', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error = validation_errors();
            }

            if($valid == 1)
            {
	    		$form_data = array(
					'lang_name'  => $lang_name,
					'lang_default' => $lang_default
	            );
	            $this->Model_lang_admin->update($id,$form_data);
				
				$success = 'Language is updated successfully';
				$this->session->set_flashdata('success',$success);
				redirect(base_url().'admin/lang');
            }
            else
            {
				$this->session->set_flashdata('error',$error);
				redirect(base_url().'admin/lang/add');
            }
		}
		else
		{
			$data['lang'] = $this->Model_lang_admin->getData($id);
			$this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_lang_edit',$data);
			$this->load->view('admin/view_footer');	
		}
	}

	public function delete($id)
	{
		$tot = $this->Model_lang_admin->lang_check($id);
    	if(!$tot) {
    		redirect(base_url().'admin/lang');
        	exit;
    	}

    	if($id == 1)
    	{
    		redirect(base_url().'admin/lang');
        	exit;	
    	}

        $this->Model_lang_admin->delete($id);
        $this->Model_lang_admin->delete_detail($id);

        $this->Model_lang_admin->delete_page_about($id);
        $this->Model_lang_admin->delete_page_service($id);
        $this->Model_lang_admin->delete_page_faq($id);
        $this->Model_lang_admin->delete_page_photo_gallery($id);
        $this->Model_lang_admin->delete_page_video_gallery($id);
        $this->Model_lang_admin->delete_page_term($id);
        $this->Model_lang_admin->delete_page_privacy($id);
        $this->Model_lang_admin->delete_page_team_member($id);
        $this->Model_lang_admin->delete_page_contact($id);
        $this->Model_lang_admin->delete_page_blog($id);
        $this->Model_lang_admin->delete_page_home($id);
        $this->Model_lang_admin->delete_page_shop($id);
        

        $success = 'Language is deleted successfully';
		$this->session->set_flashdata('success',$success);
		redirect(base_url().'admin/lang');
	}

	public function detail($id)
    {
    	$tot = $this->Model_lang_admin->lang_check($id);
    	if(!$tot) {
    		redirect(base_url().'admin/lang');
        	exit;
    	}

    	$data['setting'] = $this->Model_common->get_setting_data();
		$error = '';
		$success = '';

		if(isset($_POST['form1'])) 
		{
			foreach ($_POST['new_arr'] as $val) {
				$new_arr2[] = $val;
			}

			foreach ($_POST['new_arr1'] as $val) {
				$new_arr3[] = $val;
			}

			for($i=0;$i<count($new_arr2);$i++) {
							
				$form_data = array(
					'lang_value' => $new_arr2[$i]
	            );
	            $this->Model_lang_admin->update_detail($new_arr3[$i],$form_data);
			}

	    	$data['lang_detail'] = $this->Model_lang_admin->detail($_POST['id']);
			
			$success = 'Language detail is updated successfully';
			$this->session->set_flashdata('success',$success);
			redirect(base_url().'admin/lang/detail/'.$id);
		}
		else
		{
			$data['lang_detail'] = $this->Model_lang_admin->detail($id);
			$data['id'] = $id;
			$this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_lang_detail',$data);
			$this->load->view('admin/view_footer');	
		}
    }

}