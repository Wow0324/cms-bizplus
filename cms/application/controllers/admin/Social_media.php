<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Social_media extends MY_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_social_media');
    }

	public function index()
	{
       	
       	$data['setting'] = $this->Model_common->get_setting_data();
		$error = '';
		$success = '';

		if(isset($_POST['form1']))
		{

			$facebook    = secure_data($this->input->post('facebook', true));
			$twitter     = secure_data($this->input->post('twitter', true));
			$linkedin    = secure_data($this->input->post('linkedin', true));
			$googleplus  = secure_data($this->input->post('googleplus', true));
			$youtube     = secure_data($this->input->post('youtube', true));
			$instagram   = secure_data($this->input->post('instagram', true));
			$tumblr      = secure_data($this->input->post('tumblr', true));
			$flickr      = secure_data($this->input->post('flickr', true));
			$reddit      = secure_data($this->input->post('reddit', true));
			$snapchat    = secure_data($this->input->post('snapchat', true));
			$whatsapp    = secure_data($this->input->post('whatsapp', true));
			$quora       = secure_data($this->input->post('quora', true));
			$stumbleupon = secure_data($this->input->post('stumbleupon', true));
			$delicious   = secure_data($this->input->post('delicious', true));
			$digg        = secure_data($this->input->post('digg', true));

			$this->Model_social_media->update('Facebook',array('social_url'    => $facebook));
			$this->Model_social_media->update('Twitter',array('social_url'     => $twitter));
			$this->Model_social_media->update('LinkedIn',array('social_url'    => $linkedin));
			$this->Model_social_media->update('Google Plus',array('social_url' => $googleplus));
			$this->Model_social_media->update('Youtube',array('social_url'     => $youtube));
			$this->Model_social_media->update('Instagram',array('social_url'   => $instagram));
			$this->Model_social_media->update('Tumblr',array('social_url'      => $tumblr));
			$this->Model_social_media->update('Flickr',array('social_url'      => $flickr));
			$this->Model_social_media->update('Reddit',array('social_url'      => $reddit));
			$this->Model_social_media->update('Snapchat',array('social_url'    => $snapchat));
			$this->Model_social_media->update('WhatsApp',array('social_url'    => $whatsapp));
			$this->Model_social_media->update('Quora',array('social_url'       => $quora));
			$this->Model_social_media->update('StumbleUpon',array('social_url' => $stumbleupon));
			$this->Model_social_media->update('Delicious',array('social_url'   => $delicious));
			$this->Model_social_media->update('Digg',array('social_url'        => $digg));

		
			$success = 'Social Media is updated successfully';
		    
			$this->session->set_flashdata('success',$success);
			redirect(base_url().M_REWRITE.'admin/social_media');
           
		} else {
			$data['social'] = $this->Model_social_media->show();
	       	$this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_social_media',$data);
			$this->load->view('admin/view_footer');
		}

	}


}