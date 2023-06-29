<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_shop extends MY_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_page_shop');
    }

	public function index()
	{
		$data['setting'] = $this->Model_common->get_setting_data();
		$data['page_shop'] = $this->Model_page_shop->show();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_page_shop',$data);
		$this->load->view('admin/view_footer');
	}


	public function edit($id)
	{
		
    	$tot = $this->Model_page_shop->page_shop_check($id);
    	if(!$tot) {
    		redirect(base_url().M_REWRITE.'admin/page-shop');
        	exit;
    	}
       	
       	$data['setting'] = $this->Model_common->get_setting_data();
		$error = '';
		$success = '';


		if(isset($_POST['form1'])) 
		{

			$valid = 1;

			$shop_heading = secure_data($this->input->post('shop_heading', true));

			$this->form_validation->set_rules('shop_heading', 'Heading', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error .= validation_errors();
            }

		    if($valid == 1) 
		    {
	    		$form_data = array(
					'shop_heading' => $shop_heading
	            );
	            $this->Model_page_shop->update($id,$form_data);				
				
				$success = 'Shop Page information is updated successfully';
				$this->session->set_flashdata('success',$success);
				redirect(base_url().M_REWRITE.'admin/page-shop');
		    }
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().M_REWRITE.'admin/page-shop/edit'.$id);
		    }
           
		} else {
			$data['page_shop'] = $this->Model_page_shop->get_page_shop($id);
	       	$this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_page_shop_edit',$data);
			$this->load->view('admin/view_footer');
		}

	}

}