<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forget_password extends MY_Controller 
{

    function __construct() 
    {
        parent::__construct();
        $this->load->model('admin/Model_forget_password');
    }

    public function index()
    {
        $error = '';
        $success = '';

        $data['setting'] = $this->Model_forget_password->get_setting_data();

        if(isset($_POST['form1'])) {

            $valid = 1;

            $email = $this->input->post('email', true);

            $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');

            if($this->form_validation->run() == FALSE) {
                $valid = 0;
                $error .= validation_errors();
            } else {
                $tot = $this->Model_forget_password->check_email($email);
                if(!$tot) {
                    $valid = 0;
                    $error .= 'You email address is not found in our system.<br>';
                }    
            }
             

            if($valid == 1) {

                $token = hash('sha256',time());

                // Update Database
                $form_data = array(
                    'token' => $token
                );
                $this->Model_forget_password->update($email,$form_data);
                
                // Send Email
                $msg = '<p>To reset your password, please <a href="'.base_url().M_REWRITE.'admin/reset-password/index/'.$email.'/'.$token.'">click here</a> and enter a new password';
                
                $this->load->library('email', $config);

                $this->email->from($data['setting']['send_email_from']);
                $this->email->to($email);

                $subject = 'Password Reset';

                $this->email->subject($subject);
                $this->email->message($msg);

                $this->email->set_mailtype("html");

                $this->email->send();

                $success = 'An email is sent to your email address. Please follow instruction in there.';
                $this->session->set_flashdata('success',$success);
				redirect(base_url().M_REWRITE.'admin/forget_password');
            } else {
                $this->session->set_flashdata('error',$error);
				redirect(base_url().M_REWRITE.'admin/forget_password');
            }            
        } else {
            $this->load->view('admin/view_forget_password',$data);    
        }
        
    }
}
