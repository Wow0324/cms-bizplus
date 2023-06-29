<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends MY_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_customer');
    }

	public function index()
	{
		$data['setting'] = $this->Model_common->get_setting_data();
		$data['customer'] = $this->Model_customer->show();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_customer',$data);
		$this->load->view('admin/view_footer');
	}

	public function delete($id) 
	{
    	$tot = $this->Model_customer->customer_check($id);
    	if(!$tot) {
    		redirect(base_url().M_REWRITE.'admin/customer');
        	exit;
    	}
    	
        $this->Model_customer->delete($id);

        $success = 'Customer is deleted successfully';
        $this->session->set_flashdata('success',$success);
    	redirect(base_url().M_REWRITE.'admin/customer');
    }

    public function make_pending($id)
    {
        $tot = $this->Model_customer->customer_check($id);
        if(!$tot) {
            redirect(base_url().M_REWRITE.'admin/customer');
            exit;
        }

        $form_data = array(
            'customer_status' => 'Pending'
        );
        $this->Model_customer->make_pending($id,$form_data);

        $success = 'Status is changed successfully';
        $this->session->set_flashdata('success',$success);
        redirect(base_url().M_REWRITE.'admin/customer');
    }

    public function make_active($id)
    {
        $tot = $this->Model_customer->customer_check($id);
        if(!$tot) {
            redirect(base_url().M_REWRITE.'admin/customer');
            exit;
        }

        $form_data = array(
            'customer_status' => 'Active'
        );
        $this->Model_customer->make_active($id,$form_data);

        $success = 'Status is changed successfully';
        $this->session->set_flashdata('success',$success);
        redirect(base_url().M_REWRITE.'admin/customer');
    }
}