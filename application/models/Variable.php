<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Variable extends MY_Model {
	function __construct(){
		parent::__construct();
		$this->TABLE_NAME = 'variable';
		$this->PRI_INDEX = "{$this->TABLE_NAME}.{$this->TABLE_NAME}ID";
	}
	public function getVariableSelect($search = '',$SELECT=NULL){
		if ($SELECT) {
			$this->db->select($SELECT);
		}else{
			$this->db->select("{$this->TABLE_NAME}ID,Name");
		}
		$this->db->like('VariableName', $search);
		$query = $this->db->get($this->TABLE_NAME);
		return $query->result();
	}


	public function getListVariables(){
		$this->db->select('*');
		$query = $this->db->get($this->TABLE_NAME);
			return $query->result();
		if($query->num_rows() > 0) {
		}else{
			return false;
		}
	}

	public function getVariablesName($search = ''){
		$search = str_replace(' ','',$search);
		$seachList = explode(",", $search);
		$size = sizeof($seachList);
		$this->db->select('VariableName');
		$this->db->like('VariableName', $seachList[$size-1] );
		$query = $this->db->get($this->TABLE_NAME);
			return $query->result();
		if($query->num_rows() > 0) {
		}else{
			return false;
		}
	}

	public function getAllDataFrom($VariableID){
		$query = $this->db->get($this->TABLE_NAME);
		$this->db->where('VariableID', $VariableID);
		return $query->result();
	}


}

/* End of file variable.php */
/* Location: ./application/models/variable.php */