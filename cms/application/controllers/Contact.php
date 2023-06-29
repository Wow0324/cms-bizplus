<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MY_Controller {
	function __construct()
	{
        parent::__construct();
        $this->load->model('Model_common');
        $this->load->model('Model_contact');
    }

	public function index()
	{
		$data['setting'] = $this->Model_common->all_setting();
		$data['page_contact'] = $this->Model_common->all_page_contact();
		$data['comment'] = $this->Model_common->all_comment();
		$data['social'] = $this->Model_common->all_social();
		$data['all_blogs'] = $this->Model_common->all_blogs();

		$data['testimonials'] = $this->Model_contact->all_testimonial();

		$this->load->view('view_header',$data);
		$this->load->view('view_contact',$data);
		$this->load->view('view_footer',$data);
	}

	public function send_email() 
	{

		$data['setting'] = $this->Model_common->all_setting();

		$error = '';

		if(isset($_POST['form_contact'])) {

			$valid = 1;

			$name = $this->input->post('name', true);
			$phone = $this->input->post('phone', true);
			$email = $this->input->post('email', true);
			$subject = $this->input->post('subject', true);
			$message = $this->input->post('message', true);
		
			if( empty($name) ) {
            	$valid = 0;
			    $error .= ERROR_EMPTY_NAME.'<br>';
            }

            if( empty($phone) ) {
            	$valid = 0;
			    $error .= ERROR_EMPTY_PHONE.'<br>';
            }

            if( empty($email) ) {
            	$valid = 0;
			    $error .= ERROR_EMPTY_EMAIL.'<br>';
            } else {
            	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            		$valid = 0;
			    	$error .= ERROR_VALID_EMAIL.'<br>';
            	}
            }

            if( empty($message) ) {
            	$valid = 0;
			    $error .= ERROR_EMPTY_MESSAGE.'<br>';
            }


		    if($valid == 1)
		    {
				$msg = '
            		<h3>'.SENDER_INFORMATION.'</h3>
					<b>'.NAME.'</b> '.$name.'<br><br>
					<b>'.PHONE_NUMBER.'</b> '.$phone.'<br><br>
					<b>'.EMAIL_ADDRESS.'</b> '.$email.'<br><br>
					<b>'.SUBJECT.'</b> '.$subject.'<br><br>
					<b>'.MESSAGE.'</b> '.$message.'
				';

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

				$this->email->from($data['setting']['send_email_from']);
				$this->email->to($data['setting']['receive_email_to']);
				$this->email->reply_to($email, $name);

				$this->email->subject(SUBJECT_CONTACT_PAGE);
				$this->email->message($msg);

				$this->email->send();

		        $success = SUCCESS_CONTACT_PAGE;
        		$this->session->set_flashdata('success',$success);

		    } 
		    else
		    {
        		$this->session->set_flashdata('error',$error);
		    }

			redirect(base_url().M_REWRITE.'contact');
            
        } else {
            
            redirect(base_url().M_REWRITE.'contact');
        }
	}
}