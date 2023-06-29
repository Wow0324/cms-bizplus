<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller
{
    function __construct ()
    {
        parent::__construct();
        if($this->config->item('mod_rewrite') == 'Off') {
			define('M_REWRITE', 'index.php/');
		} else {
			define('M_REWRITE', '');
		}

		$this->load->model('Model_lang');

	    if(!isset($_SESSION['sess_lang_id'])) {
	        $_SESSION['sess_lang_id'] = 1;
	    }

	    $detail_arr = array();
	    $detail_arr = $this->Model_lang->get_detail_by_language_id($_SESSION['sess_lang_id']);
	    foreach ($detail_arr as $row) {
	        define($row['lang_key'], $row['lang_value']);
	    }

    }
}