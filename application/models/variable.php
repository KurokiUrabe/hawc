<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Variable extends MY_Model {
	function __construct(){
		parent::__construct();
		$this->TABLE_NAME = 'Variable';
		$this->PRI_INDEX = "{$this->TABLE_NAME}.{$this->TABLE_NAME}ID";
	}
	public function getVariableSelect($search = ''){
		$this->db->select("{$this->TABLE_NAME}ID,Name");
		$this->db->like('Name', $search);
		$query = $this->db->get($this->TABLE_NAME);
		return $query->result();
	}


	public function getListVariables(){
		$query = $this->db->get($this->TABLE_NAME);
		return $query->result();
	}

}

/* End of file variable.php */
/* Location: ./application/models/variable.php */