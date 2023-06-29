<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shipping extends MY_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_shipping');
    }

	public function index()
	{
		$data['setting'] = $this->Model_common->get_setting_data();
		$data['shipping'] = $this->Model_shipping->show();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_shipping',$data);
		$this->load->view('admin/view_footer');
	}

	public function add()
	{
		$data['setting'] = $this->Model_common->get_setting_data();

		$error = '';
		$success = '';

		if(isset($_POST['form1'])) {

			$valid = 1;

			$shipping_name = secure_data($this->input->post('shipping_name', true));
			$shipping_text = secure_data($this->input->post('shipping_text', true));
			$shipping_cost = secure_data($this->input->post('shipping_cost', true));
			$shipping_order = secure_data($this->input->post('shipping_order', true));

			$this->form_validation->set_rules('shipping_name', 'Shipping Name', 'trim|required');
			$this->form_validation->set_rules('shipping_text', 'Shipping Text', 'trim|required');
			$this->form_validation->set_rules('shipping_cost', 'Shipping Cost', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error .= validation_errors();
            }

		    if($valid == 1) 
		    {
		        $form_data = array(
					'shipping_name'  => $shipping_name,
					'shipping_text'  => $shipping_text,
					'shipping_cost'  => $shipping_cost,
					'shipping_order' => $shipping_order
	            );
	            $this->Model_shipping->add($form_data);

		        $success = 'Shipping is added successfully!';
		        $this->session->set_flashdata('success',$success);
				redirect(base_url().M_REWRITE.'admin/shipping');
		    } 
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().M_REWRITE.'admin/shipping/add');
		    }
            
        } else {            
            $this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_shipping_add',$data);
			$this->load->view('admin/view_footer');
        }
		
	}


	public function edit($id)
	{
		
    	$tot = $this->Model_shipping->shipping_check($id);
    	if(!$tot) {
    		redirect(base_url().M_REWRITE.'admin/shipping');
        	exit;
    	}
       	
       	$data['setting'] = $this->Model_common->get_setting_data();
		$error = '';
		$success = '';


		if(isset($_POST['form1'])) 
		{

			$valid = 1;

			$shipping_name = secure_data($this->input->post('shipping_name', true));
			$shipping_text = secure_data($this->input->post('shipping_text', true));
			$shipping_cost = secure_data($this->input->post('shipping_cost', true));
			$shipping_order = secure_data($this->input->post('shipping_order', true));

			$this->form_validation->set_rules('shipping_name', 'Shipping Name', 'trim|required');
			$this->form_validation->set_rules('shipping_text', 'Shipping Text', 'trim|required');
			$this->form_validation->set_rules('shipping_cost', 'Shipping Cost', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error .= validation_errors();
            }

		    if($valid == 1) 
		    {
		    	$data['shipping'] = $this->Model_shipping->get_shipping($id);
		    	
	    		$form_data = array(
					'shipping_name'  => $shipping_name,
					'shipping_text'  => $shipping_text,
					'shipping_cost'  => $shipping_cost,
					'shipping_order' => $shipping_order
	            );
	            $this->Model_shipping->update($id,$form_data);
				
				
				$success = 'Shipping is updated successfully';
				$this->session->set_flashdata('success',$success);
				redirect(base_url().M_REWRITE.'admin/shipping');
		    }
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().M_REWRITE.'admin/shipping/edit'.$id);
		    }
           
		} else {
			$data['shipping'] = $this->Model_shipping->get_shipping($id);
	       	$this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_shipping_edit',$data);
			$this->load->view('admin/view_footer');
		}

	}


	public function delete($id) 
	{
    	$tot = $this->Model_shipping->shipping_check($id);
    	if(!$tot) {
    		redirect(base_url().M_REWRITE.'admin/shipping');
        	exit;
    	}

        $this->Model_shipping->delete($id);
        $success = 'Shipping is deleted successfully';
        $this->session->set_flashdata('success',$success);
        redirect(base_url().M_REWRITE.'admin/shipping');
    }

}