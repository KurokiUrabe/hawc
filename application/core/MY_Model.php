<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {
		protected $TABLE_NAME ;
		protected $SELECT ;
		protected $PRI_INDEX ;
		protected $parameters;
		/**
		 * [$joins array de joins]
		 * @var [array]
		 */
		protected $joins;
		/**
		 * [$select cadena de datos a seleccionar]
		 * @var [type]
		 */
		protected $wheres;

		protected $select;
		public function __construct($params_conf =  array())
		{
				$this->parameters = $params_conf;
				if ($this->parameters) {
						$this->TABLE_NAME = $this->parameters['table'];
						$this->PRI_INDEX = $this->parameters['primary_key'];
						$this->SELECT = '*';
				}
				/**
				 * [$this->joins ejemplo de uso
				 *$this->joins[] = array("table" => "cita", "on" => "cita.ID = ".$this->TABLE_NAME.".ID_cita", "clausula" => "");]
				 * @var array
				 */
				$this->joins = [];
				$this->wheres = [];
				$this->select  = '';
		}

	 /**
		* Retrieves record(s) from the database
		*
		* @param mixed $where Optional. Retrieves only the records matching given criteria, or all records if not given.
		*                      If associative array is given, it should fit field_name=>value pattern.
		*                      If string or is other type, value will be used to match against PRI_INDEX
		* @return mixed Single record if ID is given, or array of results
		*/
	 public function get($where = array(), $like = array()) {
				if ($this->select) {
						$this->db->select($this->select);
				} else {
					 $this->db->select('*');
				}

				if ($like) {
						$this->db->like($like);
				}

			 $this->db->from($this->TABLE_NAME);
			 if ($this->joins) {
						foreach ($this->joins as $join) {
								$this->db->join($join['table'], $join['on'], $join['clausula']);
						}
			 }
			 if ($where !== NULL) {
					 if (is_array($where)) {
							 foreach ($where as $field=>$value) {
									 $this->db->where($field, $value);
							 }
					 } else {
							 $this->db->where($this->PRI_INDEX, $where);
					 }
			 }
			 $result = $this->db->get()->result();
			 if ($result) {
					 if (is_array($where)) {
							 return $result;
					 } else {
							 return array_shift($result);
					 }
			 } else {
					 return false;
			 }
	 }




	public function getSomething($primary_id,$attr)
	{
		if($primary_id==null){
			return null;
		}
		$this->db->select($attr);
		$this->db->where($this->PRI_INDEX, $primary_id);
		$query =$this->db->get($this->TABLE_NAME);
		return $query->row();
	}



	 /**
		* Inserts new data into database
		*
		* @param Array $data Associative array with field_name=>value pattern to be inserted into database
		* @return mixed Inserted row ID, or false if error occured
		*/
	 public function insert(Array $data) {
			 if ($this->db->insert($this->TABLE_NAME, $data)) {
			 		$last=$this->db->last_query();
			 		$id=$this->db->insert_id();
					 return $id;
			 } else {
					 return false;
			 }
	 }

	 /**
		* Inserts new data into database
		*
		* @param Array $data Associative array with field_name=>value pattern to be inserted into database
		* @return mixed Inserted row ID, or false if error occured
		*/
	 public function insertm(Array $data) {
			 if ($this->db->insert_batch($this->TABLE_NAME, $data)) {
			 		$last=$this->db->last_query();
			 		$rows=$this->db->affected_rows();
					 return $rows;
			 } else {
					 return false;
			 }
	 }

	 /**
		* Updates selected record in the database
		*
		* @param Array $data Associative array field_name=>value to be updated
		* @param Array $where Optional. Associative array field_name=>value, for where condition. If specified, $id is not used
		* @return int Number of affected rows by the update query
		*/
	public function update(Array $data, $where = array()) {
		if (!is_array($where)) {
			$where = array($this->PRI_INDEX => $where);
		}
		$this->db->update($this->TABLE_NAME, $data, $where);
		$last=$this->db->last_query();
		$rows=$this->db->affected_rows();
		return $rows;
	 }

	 /**
		* Updates selected record in the database
		*
		* @param Array $data Associative array field_name=>value to be updated
		* @param Array $where Optional. is the where key by default is the same primary key
		* @return int Number of affected rows by the update query
		*/
	public function updatem(Array $data, $where = NULL) {
		if ($where === NULL) {
			$where = $this->PRI_INDEX;
		}
		$this->db->update_batch($this->TABLE_NAME, $data, $where);
		$last=$this->db->last_query();
		$rows=$this->db->affected_rows();
		return $rows;
	}

	 /**
		* Deletes specified record from the database
		*
		* @param Array $where Optional. Associative array field_name=>value, for where condition. If specified, $id is not used
		* @return int Number of rows affected by the delete query
		*/
	 public function delete($where = array()) {
			 if (!is_array($where)) {
					 $where = array($this->PRI_INDEX => $where);
			 }
			 $this->db->delete($this->TABLE_NAME, $where);
			 return $this->db->affected_rows();
	 }



		/**
		* Function get_datatable by Manuel Heredia, update by Rafael Rojas
		*
		* Funcion para optimizar la tablas de los formularios, obteniendo asi una carga mas rapida y segmentada.
		* Donde funciona los filtros y es autoadministrable en cada formulario.
		*
		* @param Array $data Associative array with field_name=>value pattern to be inserted into database
		* @return mixed Inserted row ID, or false if error occured
		*/

	private function _get_datatables_query($select = null,$joins = [], $wheres = []){
		if ($select !== null) {
			$select = $select===''?$this->SELECT:$select;
		}else{
			$select = '';
		}
		$this->db->select($select);
		$this->db->from($this->TABLE_NAME);
		$i = 0;
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
	function get_datatables($SELECT=null,$JOINS=null,$WHERES=NULL){
		$this->_get_datatables_query($SELECT,$JOINS,$WHERES);
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
	function count_filtered($WHERES=null){
			$this->_get_datatables_query('COUNT(*) as rows',NULL,$WHERES);
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
	public function updateFromTable($table='',Array $data, $where = array()){
		if ($table =='') {
			return false;
		}
		if ($data!=null) {
			 if (!is_array($where)) {
				 $where = array($this->PRI_INDEX => $where);
			 }
			 $this->db->update($table, $data, $where);
			 return $this->db->affected_rows();
		}
	}
	public function getFromTable($table='',$where= [],$select = '*'){
		if ($table != '') {
			$this->db->select($select);
			 if ($where !== NULL) {
					 if (is_array($where)) {
							 foreach ($where as $field=>$value) {
									 $this->db->where($field, $value);
							 }
					 } else {
							 $this->db->where($this->PRI_INDEX, $where);
					 }
			 }
			$query = $this->db->get($table);
			return $query->result();
		}
	}

	/**
	 * Función para llenar los elementos {select}
	 * @param  [$colunas] => Nombres de las columnas a mostrar
	 * @return [Array of Object] => Segun la consulta
	 * @author [Kuko] => refugio@canteradigital.mx
	 * [Creada] => 16/Enero/2017
	 */
	public function getSelect($colunas){
		$query=$this->db->select($colunas)
			->from($this->TABLE_NAME)
			->where($this->TABLE_NAME.'.lbaja', 1)
			->get();
			return $query->num_rows() > 0 ? $query->result() : 0;
	}

	public function exist($where = []){
		if($where !== NULL){
			if(is_array($where)){
				foreach ($where as $field => $value){
					$this->db->where($field, $value);
				}
			}else{
				$this->db->where($this->PRI_INDEX, $where);
			}
		}
		$query = $this->db->get($this->TABLE_NAME);
		return $query->row();
	}

}