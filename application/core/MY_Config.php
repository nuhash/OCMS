<?php
class MY_Config extends CI_Config {

	var $cc_config = array();
	var $cc_is_loaded = FALSE;
	var $cc_config_paths = array(APPPATH);
	
	function __construct()
		{
			parent::__construct();
		}
	
	function load_controller_config($file, $fail_gracefully=0)
		{
					$file = ($file == '') ? 'config' : str_replace(EXT, '', $file);
		$found = FALSE;

		foreach ($this->cc_config_paths as $path)
		{
			$check_locations = $file;

			$location = $check_locations;
				$file_path = $path.'controllers/config/'.$location.EXT;

			$found = file_exists($file_path);
	

			if ($found === FALSE)
			{
				if ($fail_gracefully === TRUE)
				{
					return FALSE;
				}
				show_error('The configuration file '.$file.EXT.' does not exist.');
			}

			include($file_path);

			if ( ! isset($config) OR ! is_array($config))
			{
				if ($fail_gracefully === TRUE)
				{
					return FALSE;
				}
				show_error('Your '.$file_path.' file does not appear to contain a valid configuration array.');
			}

			//$this->cc_config =$config;

			$this->cc_is_loaded = TRUE;
			
			$cc_is_loaded = TRUE;
			log_message('debug', 'Config file loaded: '.$file_path);
		}

		return $config;
		}
}
?>