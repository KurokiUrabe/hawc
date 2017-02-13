<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class variable extends MY_Model {
	function __construct(){
		parent::__construct();
		$this->TABLE_NAME = 'variables';
		$this->PRI_INDEX = "{$this->TABLE_NAME}.id_var";
	}
	public function getVariablesSelect(){
		$this->db->select('id_var,name');
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