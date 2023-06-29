<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reset_password extends MY_Controller 
{

    function __construct() 
    {
        parent::__construct();
        $this->load->model('admin/Model_reset_password');
    }

    public function index($email=0,$token=0)
    {
        $tot = $this->Model_reset_password->check_url($email,$token);
        if(!$tot) {
            redirect(base_url().M_REWRITE.'admin');
            exit;
        }

        $error = '';
        $success = '';
        $data['setting'] = $this->Model_reset_password->get_setting_data();
        
        if(isset($_POST['form1'])) {

            $valid = 1;

            $new_password = secure_data($this->input->post('new_password', true));

            $this->form_validation->set_rules('new_password', 'Password', 'trim|required');
            $this->form_validation->set_rules('re_password', 'Retype Password', 'trim|required|matches[new_password]');

            if($this->form_validation->run() == FALSE) {
                $valid = 0;
                $error = validation_errors();
            }

            if($valid == 1) 
            {
                $pw = password_hash($new_password, PASSWORD_DEFAULT);
                $form_data = array(
                    'password' => $pw,
                    'token'    => ''
                );
                $this->Model_reset_password->update($email,$form_data);
                $success = 'Password is updated successfully!';
                $this->session->set_flashdata('success',$success);
                redirect(base_url().M_REWRITE.'admin/reset_password/success');
            }
            else
            {
                $this->session->set_flashdata('error',$error);
                $data['var1'] = $email;
                $data['var2'] = $token;
                $this->load->view('admin/view_reset_password',$data);
            }
        } else {
            $data['var1'] = $email;
            $data['var2'] = $token;
            $this->load->view('admin/view_reset_password',$data);
        }        
    }

    public function success() 
    {
        $data['setting'] = $this->Model_reset_password->get_setting_data();
        $this->load->view('admin/view_reset_password_success',$data);
    }
}
