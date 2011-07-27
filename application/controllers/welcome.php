<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->output->enable_profiler(TRUE);	
		//$this->load->helper('url');
		$this->load->library('parser');
		$this->benchmark->mark('load_start');
		$data = array();
		$data['vars'] = $this->uri->segment_array();
		if ($data['vars']==FALSE) {
			$data['vars'] = array('','page','1');
		}		
		$data['config'] = $this->config->load_controller_config($data['vars'][1]);
		$this->benchmark->mark('load_end');
		$this->benchmark->mark('parse_start');
		$this->parser->load('noimages/index', $data);
		$this->benchmark->mark('parse_end');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */