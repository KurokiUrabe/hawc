<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Variable extends MY_Model {
	function __construct(){
		parent::__construct();
		$this->TABLE_NAME = 'Variable';
		$this->PRI_INDEX = "{$this->TABLE_NAME}.{$this->TABLE_NAME}ID";
	}
	public function getVariableSelect($search = '',$where = []){
		$this->db->select("{$this->TABLE_NAME}ID,Name");
		$this->db->like("{$this->TABLE_NAME}.Name",$search);
		if ($where !== NULL) {
			if (is_array($where)) {
				foreach ($where as $field=>$value) {
						$this->db->where($field, $value);
				}
			} else {
					$this->db->where($this->PRI_INDEX, $where);
			}
		}
		$query = $this->db->get($this->TABLE_NAME);
		echo $this->db->last_query();
		return $query->result();
	}


	public function getListVariables(){

		$query = $this->db->get($this->TABLE_NAME);

		return $query->result();
	}

}

/* End of file variable.php */
/* Location: ./application/models/variable.php */