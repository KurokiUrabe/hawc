<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class QueryBuildier extends  CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->TABLE_NAME = 'recstats_hawcprod_v4r01_v1p26p00_rev20264_20150504';
		$this->PRI_INDEX = "{$this->TABLE_NAME}.id";
	}

	public function columns($database, $table)
	{
		$query = "SELECT COLUMN_NAME as name FROM INFORMATION_SCHEMA.COLUMNS
			WHERE table_name = '$table'
			AND table_schema = '$database'";
		$result = $this->db->query($query) or die ("Schema Query Failed");

		return $result->result();
	}
	public function tables($database='qmdb'){
		$query = "SELECT TABLE_NAME as name FROM INFORMATION_SCHEMA.TABLES WHERE table_schema = '$database' AND TABLE_NAME LIKE '%hawc%'";
		$result = $this->db->query($query) or die ("Schema Query Failed");
		return $result->result();
	}
	public function DescribefromTable($table_name = null){
		// print_r($this->db);
		$query = "SELECT column_name
		FROM 'information_schema.columns'
		AND table_name = 'hawconlinev8_0_1'";
		$result = $this->db->query($query);
		// $table_name = $table_name?$table_name:$this->TABLE_NAME;
		// $this->db->select('column_name as name ');
		// $this->db->where('table_schema', 'qmdb');
		// $this->db->where('table_name', $table_name);
		// $this->db->from('information_schema.columns');
		// //AND table_name = 'hawconlinev8_0_1' ;
		// $query = $this->db->get();
		return $result->result();
	}
	public function runQuery($sql = '', $limit = 1000){
		$sql = $sql;
		/*if ($limit!=null) {
			$sql = $sql ." LIMIT {$limit}";
		}*/
		// $query = $this->db->query("SELECT File_name FROM hawconlinev8_0_1 WHERE 1=1 and (-1<File_name<100) LIMIT 100");
		// echo $this->db->last_query();
		$query = $this->db->query( $sql );
		return $query->result();
	}

	function count_filtered($WHERES=null,$SEARCh = null){
			$this->get_datatables_query('COUNT(*) as rows',$WHERES,$SEARCh);
			$query = $this->db->get();
			return $query->row()->rows;
	}
	public function count_all($where=null){
			$this->db->from($this->TABLE_NAME);
			if ($where !== NULL) {
				if (is_array($where)) {
					foreach ($where as $field=>$value) {
						$this->db->where($field, $value);
					}
				} else {
					$this->db->where($this->PRI_INDEX, $where);
				}
			}
			return $this->db->count_all_results();
	}

	public function dataCSV($sql = ''){
		return  $this->db->query( $sql );
	}


	//paginacion
	function get_datatables($SELECT=null,$JOINS=null,$WHERES=[],$SEARCh=[]){
		$this->get_datatables_query($SELECT,$JOINS,$WHERES,$SEARCh);
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}


	private function get_datatables_query($select = '*', $from = '',  $wheres = '', $search=null){
		$sql = "{$select} FROM {$from} {$wheres}";

		$i = 0;
		$colums = $this->columns('QMDB',$form);
		foreach ($this->column_search as $item){ // loop column
			if($_POST['search']['value']) {// if datatable send POST for search
				if($i===0){ // first loop
						$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
						$this->db->like($item, $_POST['search']['value']);
				}
				else{
						$this->db->or_like($item, $_POST['search']['value']);
				}
				if(count($this->column_search) - 1 == $i) //last loop
						$this->db->group_end(); //close bracket
			}
			$i++;
		}
		$i = sizeof($search)-1;
		$open = false;
		if ($search) {
			foreach ($search as $key => $item) {
				if ($item['operator']=='or'&&!$open) {
					$open= true;
					$this->db->group_start();
					$this->db->like($item['clausula'], $item['valor']);
				}else if($item['operator']=='and'&&$open){
					$open=!$open;
					$this->db->group_end(); //close bracket
					$this->db->like($item['clausula'], $item['valor']);
				}else{
					$this->db->or_like($item['clausula'], $item['valor']);
				}

				// if ((!$open&&!isset($item['operator']))) {
				// 	$this->db->group_end(); //close bracket
				// }
				if ($i ===$key&&$open) {
					$this->db->group_end(); //close bracket
				}
			}
		}
		if ($this->joins) {
			foreach ($this->joins as $join) {
				$this->db->join($join['table'], $join['on'], $join['clausula']);
			}
		}else if($joins){
			foreach ($joins as $join) {
				$this->db->join($join['table'], $join['on'], $join['clausula']);
			}
		}else{

		}
		if ($this->wheres) {
			foreach ($this->wheres as $key => $where) {
				$this->db->where($where['clausula'], $where['valor']);
			}
		}else if($wheres){
			foreach ($wheres as $key => $where) {
				$this->db->where($where['clausula'], $where['valor']);
			}
		}else{

		}
		if(isset($_POST['order'])) {// here order processing
				$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($this->order)){
				$order = $this->order;
				$this->db->order_by(key($order), $order[key($order)]);
		}
	}
}

/* End of file hawc.php */
/* Location: ./application/models/hawc.php */