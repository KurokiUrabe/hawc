<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class variable extends CI_Model {
	function __construct(){
		parent::__construct();
	}
	public function getVariablesSelect($value=''){
		$this->db->select('field1, field2');
	}
}

/* End of file variable.php */
/* Location: ./application/models/variable.php */