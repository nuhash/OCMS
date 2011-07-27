<?php

class Page extends CI_Model
{
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		log_message("DEBUG","Page model loaded");
    }
	
	function load_current(array $data)
		{
			$CI =& get_instance();
			//$id = $CI->uri->segment(2);
			//print_r($data);
			$CI->db->select('title, content');
			$query = $CI->db->get_where('pages', array('id'=>$data[2]));
			//$array = $query->result_array();
			//print_r($array);
			return $query->result_array();
		}
		
}
