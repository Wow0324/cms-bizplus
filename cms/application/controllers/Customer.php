<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends MY_Controller {

	function __construct()
	{
        parent::__construct();
        $this->load->model('Model_common');
        $this->load->model('Model_customer');
    }

	public function index()
	{
		redirect(base_url());
	}

	public function dashboard() {
		$data['setting'] = $this->Model_common->all_setting();
		$data['comment'] = $this->Model_common->all_comment();
		$data['social'] = $this->Model_common->all_social();
		$data['all_blogs'] = $this->Model_common->all_blogs();

		$this->load->view('view_header',$data);
		$this->load->view('view_customer_dashboard',$data);
		$this->load->view('view_footer',$data);
	}

	public function login() {

		$error = '';
		$success = '';

		$data['setting'] = $this->Model_common->all_setting();
		$data['comment'] = $this->Model_common->all_comment();
		$data['social'] = $this->Model_common->all_social();
		$data['all_blogs'] = $this->Model_common->all_blogs();

		if(isset($_POST['form_login'])) 
		{

			$chk1 = 0;

			$customer_email = secure_data($this->input->post('customer_email',true));
            $customer_password = secure_data($this->input->post('customer_password',true));

            $chk = $this->Model_customer->check_access($customer_email);
            if(password_verify($customer_password,$chk['customer_password']))
            {
            	$chk1 = 1;
            }

            if($chk1 == 0)
            {
				$error = ERROR_CUSTOMER_LOGIN;
                $this->session->set_flashdata('error',$error);
                redirect(base_url().M_REWRITE.'customer/login');
            }
            else
            {
            	$array = array(
					'customer_id'       => $chk['customer_id'],
					'customer_name'     => $chk['customer_name'],
					'customer_email'    => $chk['customer_email'],
					'customer_phone'    => $chk['customer_phone'],
					'customer_country'  => $chk['customer_country'],
					'customer_address'  => $chk['customer_address'],
					'customer_state'    => $chk['customer_state'],
					'customer_city'     => $chk['customer_city'],
					'customer_zip'      => $chk['customer_zip'],
					'customer_password' => $chk['customer_password'],
					'customer_token'    => $chk['customer_token'],
					'customer_status'   => $chk['customer_status']
                );
                $this->session->set_userdata($array);
                redirect(base_url().M_REWRITE.'customer/dashboard');
            }

		} else {
			$this->load->view('view_header',$data);
			$this->load->view('view_customer_login',$data);
			$this->load->view('view_footer',$data);	
		}		
	}


	public function registration() {
		$error = '';
		$success = '';

		$data['setting'] = $this->Model_common->all_setting();
		$data['comment'] = $this->Model_common->all_comment();
		$data['social'] = $this->Model_common->all_social();
		$data['all_blogs'] = $this->Model_common->all_blogs();

		if(isset($_POST['form_registration'])) {

			$valid = 1;

			$customer_name = secure_data($this->input->post('customer_name', true));
			$customer_phone = secure_data($this->input->post('customer_phone', true));
			$customer_email = secure_data($this->input->post('customer_email', true));
			$customer_password = secure_data($this->input->post('customer_password', true));
			$customer_re_password = secure_data($this->input->post('customer_re_password', true));

			if( empty($customer_name) ) {
            	$valid = 0;
			    $error .= ERROR_EMPTY_NAME.'<br>';
            }

            if( empty($customer_phone) ) {
            	$valid = 0;
			    $error .= ERROR_EMPTY_PHONE.'<br>';
            }

			if( empty($customer_email) ) {
            	$valid = 0;
			    $error .= ERROR_EMPTY_EMAIL.'<br>';
            } else {
            	if (!filter_var($customer_email, FILTER_VALIDATE_EMAIL)) {
            		$valid = 0;
			    	$error .= ERROR_VALID_EMAIL.'<br>';
            	}
            }

            if( empty($customer_password) || empty($customer_re_password) ) {
		    	$valid = 0;
		        $error .= ERROR_EMPTY_PASSWORD.'<br>';
		    }			
			else {
		        if($customer_password != $customer_re_password) {
			    	$valid = 0;
			        $error .= ERROR_MATCH_PASSWORD.'<br>';
		    	}
		    }
			
            $chk = $this->Model_customer->check_duplicate_email($customer_email);
            if($chk) {
            	$valid = 0;
            	$error .= ERROR_EXIST_EMAIL.'<br>';
            }

            if($valid == 1)
		    {
		    	$token = hash('sha256',time());
		    	$pw = password_hash($customer_password, PASSWORD_DEFAULT);

		    	$form_data = array(
					'customer_name'     => $customer_name,
					'customer_email'    => $customer_email,
					'customer_phone'    => $customer_phone,
					'customer_password' => $pw,
					'customer_token'    => $token,
					'customer_status'   => 'Pending'
	            );
	            $this->Model_customer->registration($form_data);

	            $verify_link = base_url().M_REWRITE.'customer/registration_verify/'.$customer_email.'/'.$token;

		    	$msg = 'Thank you for signing up! <br><br>
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.<br><br>
Please click this link to activate your account:<br>
<a href="'.$verify_link.'">'.$verify_link.'</a>';

            	$this->load->library('email');

				$this->email->from($data['setting']['send_email_from']);
				$this->email->to($customer_email);

				$this->email->subject('Registration Confirmation');
				$this->email->message($msg);

				$this->email->set_mailtype("html");

				$this->email->send();

				$success = SUCCESS_CUSTOMER_REGISTRATION;
        		$this->session->set_flashdata('success',$success);
		    }
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
		    }

		    redirect($this->agent->referrer());

		} else {
			$this->load->view('view_header',$data);
			$this->load->view('view_customer_registration',$data);
			$this->load->view('view_footer',$data);	
		}
	}

	public function registration_verify($email=0,$token=0)
    {
        $tot = $this->Model_customer->registration_confirm_check_url($email,$token);
        if(!$tot) {
            redirect(base_url());
            exit;
        }

        $error = '';
        $success = '';
        
        $data['setting'] = $this->Model_common->all_setting();
		$data['comment'] = $this->Model_common->all_comment();
		$data['social'] = $this->Model_common->all_social();
		$data['all_blogs'] = $this->Model_common->all_blogs();

		$form_data = array(
			'customer_token' => '',
			'customer_status' => 'Active'
        );
        $this->Model_customer->registration_confirm_update($email,$token,$form_data);
        
        $this->load->view('view_header',$data);
		$this->load->view('view_thankyou_registration',$data);
		$this->load->view('view_footer',$data);        
    }

	public function profile_edit() {

		$error = '';
		$success = '';

		$data['setting'] = $this->Model_common->all_setting();
		$data['comment'] = $this->Model_common->all_comment();
		$data['social'] = $this->Model_common->all_social();
		$data['all_blogs'] = $this->Model_common->all_blogs();
		$data['all_country'] = $this->Model_customer->all_country();

		if (isset($_POST['form1'])) 
		{
			$valid = 1;

			$customer_name = secure_data($this->input->post('customer_name', true));
			$customer_phone = secure_data($this->input->post('customer_phone', true));
			$customer_country = secure_data($this->input->post('customer_country', true));
			$customer_address = secure_data($this->input->post('customer_address', true));
			$customer_state = secure_data($this->input->post('customer_state', true));
			$customer_city = secure_data($this->input->post('customer_city', true));
			$customer_zip = secure_data($this->input->post('customer_zip', true));
			$customer_password = secure_data($this->input->post('customer_password', true));
			$customer_re_password = secure_data($this->input->post('customer_re_password', true));

            if( empty($customer_name) ) {
            	$valid = 0;
			    $error .= ERROR_EMPTY_NAME.'<br>';
            }

            if( empty($customer_phone) ) {
            	$valid = 0;
			    $error .= ERROR_EMPTY_PHONE.'<br>';
            }

            if( empty($customer_country) ) {
            	$valid = 0;
			    $error .= 'You must have to select a country'.'<br>';
            }

            if( empty($customer_address) ) {
            	$valid = 0;
			    $error .= ERROR_EMPTY_ADDRESS.'<br>';
            }

            if( empty($customer_state) ) {
            	$valid = 0;
			    $error .= ERROR_EMPTY_STATE.'<br>';
            }

            if( empty($customer_city) ) {
            	$valid = 0;
			    $error .= ERROR_EMPTY_CITY.'<br>';
            }

            if( empty($customer_zip) ) {
            	$valid = 0;
			    $error .= ERROR_EMPTY_ZIP.'<br>';
            }

            if( !(empty($customer_password) && empty($customer_re_password)) ) {
		        if($customer_password != $customer_re_password) {
			    	$valid = 0;
			        $error .= ERROR_MATCH_PASSWORD.'<br>';
		    	}
		    }

		    if($valid == 1)
		    {
		    	if( !(empty($customer_password) && empty($customer_re_password)) ) {
		    		$pw = password_hash($customer_password, PASSWORD_DEFAULT);
		    		$form_data = array(
						'customer_name'     => $customer_name,
						'customer_phone'    => $customer_phone,
						'customer_country'   => $customer_country,
						'customer_address'  => $customer_address,
						'customer_state'  => $customer_state,
						'customer_city'  => $customer_city,
						'customer_zip'  => $customer_zip,
						'customer_password' => $pw
		            );
		    	} else {
		    		$form_data = array(
						'customer_name'     => $customer_name,
						'customer_phone'    => $customer_phone,
						'customer_country'   => $customer_country,
						'customer_address'  => $customer_address,
						'customer_state'  => $customer_state,
						'customer_city'  => $customer_city,
						'customer_zip'  => $customer_zip
		            );
		    	}

		    	$this->Model_customer->customer_profile_edit($form_data,$this->session->userdata('customer_id'));
	        	$success = SUCCESS_EDIT_PROFILE;
        		$this->session->set_flashdata('success',$success);

        		$this->session->set_userdata($form_data);

        		redirect(base_url().M_REWRITE.'customer/profile_edit');
		    }
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().M_REWRITE.'customer/profile_edit');
		    }
		}
		else
		{
			$this->load->view('view_header',$data);
			$this->load->view('view_customer_profile_edit',$data);
			$this->load->view('view_footer',$data);	
		}		
	}



	function logout() {
        $this->session->sess_destroy();
        redirect(base_url().M_REWRITE.'customer/login');
    }


    public function forget_password()
    {
        $error = '';
        $success = '';

        $data['setting'] = $this->Model_common->all_setting();
		$data['comment'] = $this->Model_common->all_comment();
		$data['social'] = $this->Model_common->all_social();
		$data['all_blogs'] = $this->Model_common->all_blogs();

        if(isset($_POST['form1'])) {

            $valid = 1;

            $customer_email = secure_data($this->input->post('customer_email',true));

            if( empty($customer_email) ) {
            	$valid = 0;
			    $error .= ERROR_EMPTY_EMAIL.'<br>';
            } else {
            	if (!filter_var($customer_email, FILTER_VALIDATE_EMAIL)) {
            		$valid = 0;
			    	$error .= ERROR_VALID_EMAIL.'<br>';
            	} else {
            		$tot = $this->Model_customer->forget_password_check_email($customer_email);
	                if(!$tot) {
	                    $valid = 0;
	                    $error .= ERROR_NOT_FOUND_EMAIL.'<br>';
	                }
            	}
            }
            

            if($valid == 1) {

                $customer_token = hash('sha256',time());

                // Update Database
                $form_data = array(
                    'customer_token' => $customer_token
                );
                $this->Model_customer->update_token($customer_email,$form_data);
                
                // Send Email
                $msg = '<p>To reset your password, please <a href="'.base_url().M_REWRITE.'customer/reset-password/'.$customer_email.'/'.$customer_token.'">click here</a> and enter a new password';
                
                $this->load->library('email');

                $this->email->from($data['setting']['send_email_from']);
                $this->email->to($customer_email);

                $subject = PASSWORD_RESET;

                $this->email->subject($subject);
                $this->email->message($msg);

                $this->email->set_mailtype("html");

                $this->email->send();

                $success = SUCCESS_FORGET_PASSWORD;
                $this->session->set_flashdata('success',$success);
				redirect(base_url().M_REWRITE.'customer/forget-password');
            } else {
                $this->session->set_flashdata('error',$error);
				redirect(base_url().M_REWRITE.'customer/forget-password');
            }            
        } else {
            $this->load->view('view_header',$data);
			$this->load->view('view_customer_forget_password',$data);
			$this->load->view('view_footer',$data);
        }
        
    }



    public function reset_password($email=0,$token=0)
    {
        $tot = $this->Model_customer->reset_password_check_url($email,$token);
        if(!$tot) {
            redirect(base_url());
            exit;
        }

        $error = '';
        $success = '';
        
        $data['setting'] = $this->Model_common->all_setting();
		$data['comment'] = $this->Model_common->all_comment();
		$data['social'] = $this->Model_common->all_social();
		$data['all_blogs'] = $this->Model_common->all_blogs();
        
        if(isset($_POST['form1'])) {

            $valid = 1;

            $new_password = secure_data($this->input->post('new_password',true));
            $re_password = secure_data($this->input->post('re_password',true));

            if( empty($new_password) || empty($re_password) ) {
		    	$valid = 0;
		        $error .= MESSAGE_ERROR_EMPTY_PASSWORD.'<br>';
		    }			
			else {
		        if($new_password != $re_password) {
			    	$valid = 0;
			        $error .= MESSAGE_ERROR_MATCH_PASSWORD.'<br>';
		    	}
		    }


            if($valid == 1)
            {
            	$pw = password_hash($new_password, PASSWORD_DEFAULT);
                $form_data = array(
                    'customer_password' => $pw,
                    'customer_token'    => ''
                );
                $this->Model_customer->reset_password_update($email,$form_data);
                $success = MESSAGE_SUCCESS_CUSTOMER_RESET_PASSWORD;
                $this->session->set_flashdata('success',$success);
                redirect(base_url().M_REWRITE.'customer/reset_password_success');
            }
            else
            {
                $this->session->set_flashdata('error',$error);
                $data['var1'] = $email;
                $data['var2'] = $token;
                $this->load->view('view_header',$data);
                $this->load->view('view_reset_password',$data);
                $this->load->view('view_footer',$data);
            }
        } else {
            $data['var1'] = $email;
            $data['var2'] = $token;
            $this->load->view('view_header',$data);
            $this->load->view('view_reset_password',$data);
            $this->load->view('view_footer',$data);
        }        
    }

    public function reset_password_success() 
    {
        $data['setting'] = $this->Model_common->all_setting();
		$data['comment'] = $this->Model_common->all_comment();
		$data['social'] = $this->Model_common->all_social();
		$data['all_blogs'] = $this->Model_common->all_blogs();

        $this->load->view('view_header',$data);
        $this->load->view('view_reset_password_success',$data);
        $this->load->view('view_footer',$data);
    }

    public function orders()
    {
    	$data['setting'] = $this->Model_common->all_setting();
		$data['comment'] = $this->Model_common->all_comment();
		$data['social'] = $this->Model_common->all_social();
		$data['all_blogs'] = $this->Model_common->all_blogs();
		$data['orders'] = $this->Model_customer->all_orders();

        $this->load->view('view_header',$data);
        $this->load->view('view_customer_order_history',$data);
        $this->load->view('view_footer',$data);
    }

}