<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MY_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_order');
    }

	public function index()
	{
		$data['setting'] = $this->Model_common->get_setting_data();
		$data['order'] = $this->Model_order->show();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_order',$data);
		$this->load->view('admin/view_footer');
	}

	public function delete($id)
	{
    	$tot = $this->Model_order->order_check($id);
    	if(!$tot) {
    		redirect(base_url().M_REWRITE.'admin/order');
        	exit;
    	}

        $this->Model_order->delete($id);
        $this->Model_order->delete_detail($id);

        $success = 'Order is deleted successfully';
		$this->session->set_flashdata('success',$success);
		redirect(base_url().M_REWRITE.'admin/order');
    }    

}