<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coupon extends MY_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_coupon');
    }

	public function index()
	{
		$data['setting'] = $this->Model_common->get_setting_data();
		$data['coupon'] = $this->Model_coupon->show();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_coupon',$data);
		$this->load->view('admin/view_footer');
	}

	public function add()
	{
		$data['setting'] = $this->Model_common->get_setting_data();

		$error = '';
		$success = '';

		if(isset($_POST['form1'])) {

			$valid = 1;

			$coupon_code = secure_data($this->input->post('coupon_code', true));
			$coupon_type = secure_data($this->input->post('coupon_type', true));
			$coupon_discount = secure_data($this->input->post('coupon_discount', true));
			$coupon_maximum_use = secure_data($this->input->post('coupon_maximum_use', true));
			$coupon_start_date = secure_data($this->input->post('coupon_start_date', true));
			$coupon_end_date = secure_data($this->input->post('coupon_end_date', true));

			$this->form_validation->set_rules('coupon_code', 'Coupon Code', 'trim|required');
			$this->form_validation->set_rules('coupon_discount', 'Coupon Discount', 'trim|required');
			$this->form_validation->set_rules('coupon_maximum_use', 'Coupon Maximum Use', 'trim|required');
			$this->form_validation->set_rules('coupon_start_date', 'Coupon Start Date', 'trim|required');
			$this->form_validation->set_rules('coupon_end_date', 'Coupon End Date', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error .= validation_errors();
            }

		    if($valid == 1) 
		    {
		        $form_data = array(
					'coupon_code'         => $coupon_code,
					'coupon_type'         => $coupon_type,
					'coupon_discount'     => $coupon_discount,
					'coupon_maximum_use'  => $coupon_maximum_use,
					'coupon_existing_use' => 0,
					'coupon_start_date'   => $coupon_start_date,
					'coupon_end_date'     => $coupon_end_date
	            );
	            $this->Model_coupon->add($form_data);

		        $success = 'Coupon is added successfully!';
		        $this->session->set_flashdata('success',$success);
				redirect(base_url().M_REWRITE.'admin/coupon');
		    } 
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().M_REWRITE.'admin/coupon/add');
		    }
            
        } else {            
            $this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_coupon_add',$data);
			$this->load->view('admin/view_footer');
        }
		
	}


	public function edit($id)
	{
		
    	$tot = $this->Model_coupon->coupon_check($id);
    	if(!$tot) {
    		redirect(base_url().M_REWRITE.'admin/coupon');
        	exit;
    	}
       	
       	$data['setting'] = $this->Model_common->get_setting_data();
		$error = '';
		$success = '';


		if(isset($_POST['form1'])) 
		{

			$valid = 1;

			$coupon_code = secure_data($this->input->post('coupon_code', true));
			$coupon_type = secure_data($this->input->post('coupon_type', true));
			$coupon_discount = secure_data($this->input->post('coupon_discount', true));
			$coupon_maximum_use = secure_data($this->input->post('coupon_maximum_use', true));
			$coupon_start_date = secure_data($this->input->post('coupon_start_date', true));
			$coupon_end_date = secure_data($this->input->post('coupon_end_date', true));

			$this->form_validation->set_rules('coupon_code', 'Coupon Code', 'trim|required');
			$this->form_validation->set_rules('coupon_discount', 'Coupon Discount', 'trim|required');
			$this->form_validation->set_rules('coupon_maximum_use', 'Coupon Maximum Use', 'trim|required');
			$this->form_validation->set_rules('coupon_start_date', 'Coupon Start Date', 'trim|required');
			$this->form_validation->set_rules('coupon_end_date', 'Coupon End Date', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error .= validation_errors();
            }

		    if($valid == 1) 
		    {
		    	$data['coupon'] = $this->Model_coupon->get_coupon($id);
		    	
	    		$form_data = array(
					'coupon_code'        => $coupon_code,
					'coupon_type'        => $coupon_type,
					'coupon_discount'    => $coupon_discount,
					'coupon_maximum_use' => $coupon_maximum_use,
					'coupon_start_date'  => $coupon_start_date,
					'coupon_end_date'    => $coupon_end_date
	            );
	            $this->Model_coupon->update($id,$form_data);
								
				$success = 'Coupon is updated successfully';
				$this->session->set_flashdata('success',$success);
				redirect(base_url().M_REWRITE.'admin/coupon');
		    }
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().M_REWRITE.'admin/coupon/edit'.$id);
		    }
           
		} else {
			$data['coupon'] = $this->Model_coupon->get_coupon($id);
	       	$this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_coupon_edit',$data);
			$this->load->view('admin/view_footer');
		}

	}


	public function delete($id) 
	{
    	$tot = $this->Model_coupon->coupon_check($id);
    	if(!$tot) {
    		redirect(base_url().M_REWRITE.'admin/coupon');
        	exit;
    	}

        $this->Model_coupon->delete($id);
        $success = 'Coupon is deleted successfully';
        $this->session->set_flashdata('success',$success);
        redirect(base_url().M_REWRITE.'admin/coupon');
    }

}