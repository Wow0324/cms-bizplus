<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller 
{

    function __construct() 
    {
        parent::__construct();
        $this->load->model('admin/Model_login');
    }

    public function index()
    {
        $error = '';

        $data['setting'] = $this->Model_login->get_setting_data();

        $logged_in_admin = $this->session->userdata('logged_in_admin');
        if($logged_in_admin)
        {
            redirect(base_url().M_REWRITE.'admin/dashboard');
        }

        if(isset($_POST['form1'])) {

            // Getting the form data
            $email = secure_data($this->input->post('email',true));
            $password = secure_data($this->input->post('password',true));

            // Checking the email address
            $r_data = $this->Model_login->check_email($email);

            if(!$r_data) {
                $error = 'Email address is wrong!';
                $this->session->set_flashdata('error',$error);
                redirect(base_url().M_REWRITE.'admin');
            }
            else 
            {
                $pw = $r_data['password'];
                if(password_verify($password,$pw))
                {
                    // When email and password both are correct
                    $array = array(
                        'id' => $r_data['id'],
                        'email' => $r_data['email'],
                        'password' => $r_data['password'],
                        'photo' => $r_data['photo'],
                        'role' => $r_data['role'],
                        'status' => $r_data['status'],
                        'logged_in_admin' => true
                    );
                    $this->session->set_userdata($array);
                    redirect(base_url().M_REWRITE.'admin/dashboard');
                }
                else
                {
                    $error = 'Password is wrong!';
                    $this->session->set_flashdata('error',$error);
                    redirect(base_url().M_REWRITE.'admin');                    
                }
            }
        }
        else 
        {
            $this->load->view('admin/view_login',$data);    
        }
        
    }

    function logout() {
        $this->session->sess_destroy();
        redirect(base_url().M_REWRITE.'admin');
    }
}
