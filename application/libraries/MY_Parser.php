<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Parser extends CI_Parser
{
	var $CI;
	function load($template, $data, $return = FALSE)
		{
			$this->CI =& get_instance();
			
			//$i=0;
			$keyint=0;
			$keys = array_keys($data['config']);
			foreach($data['config'] as $config)
				{
					
					log_message("DEBUG", "foreach");
					if(!is_array($config))
						{
							log_message("DEBUG", "continue");
							continue;
						}
					else
						{
							$i = 0;	
							foreach($config as $block)
							{
							log_message("DEBUG", "switch");
							switch ($block['type'])
								{
								case "text":
									log_message("DEBUG", "text");
									break;
								case "dynamic":
									log_message("DEBUG", "dynamic");
									$class = explode("::", $block['function']);
									$this->CI->load->model($class[0]);
									$array = call_user_func_array(__NAMESPACE__.'\\'.$block['function'], $data);
									array_splice($data['config'][$keys[$keyint]], $i, 1, $array);
									break;
									
								}
								$i++;
								
							}
							 
						}
						$keyint++;
						//print_r($data);
				}	
			log_message("DEBUG", "parse");
			$this->parse($template, $data['config'], $return);
		}
}
