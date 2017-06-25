<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hawc extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('QueryBuildier', 'hawc');
		$this->load->model('Variable', 'variable');
	}

	public function index(){
		$data["colums_name"] = $this->hawc->columns('qmdb','recstats_hawcprod_v4r01_v1p26p00_rev20264_20150504' );
		$data["tables"] =  $this->hawc->tables('QMDB');
		$data["variables"] = $this->variable->getListVariables();
		$this->load->view('index',$data);
	}

	public function variables(){
		$data["variables"] = $this->variable->getListVariables();
		$this->load->view('index_Variables',$data);
	}

	public function getVariableSelect(){
		$search = $this->input->post("search");
		$variables = $this->variable->getVariableSelect($search,'*');
		$length = count($variables);
		$jsonVariable = array( );
		echo json_encode(array("correct"=>$variables!=null,"variables"=>$variables));
	}
	public function getVariableName(){
		$json = $this->variable->getVariablesName($this->input->post('searchStr'));
		echo json_encode($json);
	}
	public function insertVariable(){
		$VariableID = $this->variable->insert($this->input->post());
		echo json_encode(array("correct"=>$VariableID>0,"VariableID"=>$VariableID));
	}

	public function getAllDataFrom(){
		$VariableID = $this->variable->getAllDataFrom($this->input->post('VariableID'));
		echo json_encode(array("correct"=>$VariableID>0,"VariableID"=>$VariableID));
	}

	public function runQuery(){
		$selector = $this->input->post("selector");
		$from = $this->input->post("from");
		$where = $this->input->post("where");
		$extras = $this->input->post("extras");

		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$limit = $limit!=null?" LIMIT {$limit}":'LIMIT 10';
		$start = $start!=null?" OFFSET {$start}":'';
		$query = "SELECT {$selector} FROM {$from} {$where} {$extras} {$limit} {$start}";
		$result = $this->hawc->runQuery($query);
		echo json_encode($result);
	}

	public function runQueryDatatable(){
		$selector = $this->input->post("selector");
		$from = $this->input->post("from");
		$where = $this->input->post("where");
		$extras = $this->input->post("extras");

		$query = $this->input->post("query");
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$limit = $limit!=null&&$limit>0?" LIMIT {$limit}":'';
		$start = $start!=null&&$start>0?" OFFSET {$start}":'';

		$query = "SELECT {$selector} FROM {$from} {$where} {$extras} {$limit} {$start}";
		$result = $this->hawc->runQuery($query );

		$no = 0;
		foreach ($result as $variable) {
			$no++;
			$row = array();
			foreach ($variable as &$value) {
				$row[] = $value;
			}
			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->db->query("SELECT COUNT(*) AS TOTAL FROM {$from}")->row()->TOTAL,
						"recordsFiltered" => $this->db->query("SELECT COUNT(*) AS TOTAL FROM {$from} {$where}")->row()->TOTAL,
						"data" => $data,
						"sql" => $query
				);
		// $clientes =  $this->clm->jsonClientes($PERMISO);
		// echo $this->db->last_query();
		echo json_encode($output);
	}

	public function getCSV(){
		$selector = $this->input->post("selector");
		$from = $this->input->post("from");
		$where = $this->input->post("where");
		$extras = $this->input->post("extras");
		$fileName = "hawc_".date("Ymd_His").".csv";
		$OriginalfileName = $fileName;
		$csv = realpath(dirname(__FILE__)). '/../../assets/uploads/csv/';
		$fileName = $csv . $fileName;
		// $fileName = str_replace('\\', '/', $fileName);
		// $sql = "{$selector} INTO OUTFILE '{$fileName}' FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\n' {$from} {$where} {$extras}";
		$sql = "SELECT COUNT(*) AS total {$from} {$where} {$extras}";
		// echo $fileName;
		// echo $sql;
		// echo realpath(dirname(__FILE__));
		// $user = posix_getpwuid(posix_geteuid());
		// var_dump($user);
		/*	$sed = "s/\\t/','/g;s/^/'/;s/$/'/;s/\n//g";
		echo $sed;
		echo "mysql -uhawc_user -porizaba! -hhawcmon.umd.edu QMDB -B -e '{$sql};' | sed '{$sed}' > mysql_exported_table.csv";
		exec("mysql -uhawc_user -porizaba! -hhawcmon.umd.edu QMDB -B -e '{$sql};' | sed '{$sed}' > /home/kurabe/mysql_exported_table.csv",$resss,$retrive);
		print_r($retrive);*/

		// $this->hawc->dataCSV($sql);
		// echo $this->db->last_query();

		$count = $this->db->query("SELECT COUNT(*) AS total {$from} {$where} {$extras}")->row()->total;
		// $this->hawc->runQuery($count)->total;
		$this->db->save_queries = false;
		// echo $count;
		$result = array( );
		$cremento = 5000;
		$fp = fopen($fileName, 'w') or die("Unable to open file!");
		for ($LIMIT= $count>$cremento?$cremento:$count,$OFFSET=0; $OFFSET <= $count ; $OFFSET+=$cremento) {
			$query = "{$selector} {$from} {$where} {$extras} LIMIT {$LIMIT} OFFSET {$OFFSET}";
			// $result = null;
			// $query = "SELECT COUNT(*) as rows {$from} {$where}  {$extras} LIMIT {$LIMIT} OFFSET {$OFFSET}";
			// $result = $this->hawc->runQuery($query);
			$result = $this->db->query($query);
			// echo $this->db->last_query() ."\n";
			// $memory = memory_get_usage();
			// $num_rows = $result->num_rows();
			// $num_rows = 0;
			// $num_rows = $result->row();
			// echo "start cycle {$memory} {$num_rows}\n";

			while ($row = $result->unbuffered_row()){
				$val = get_object_vars($row);
				fputcsv($fp, $val);
				$line = null;
				$val = null;
			}
			// echo "LIMIT $LIMIT\n";
			// echo "OFFSET $OFFSET\n";
			$result->free_result();
			$result = null;
			$this->db->flush_cache();
			gc_collect_cycles();
			$memory = memory_get_usage();
			// echo "end cycle {$memory}\n";
		}
		fclose($fp);
		echo $OriginalfileName ;
	}

	public function download($fileName=null){
		if ($fileName) {
			$csv = realpath(dirname(__FILE__)). '/../../assets/uploads/csv/';
			$fileName = $csv . $fileName;
			header("Content-type: text/csv");
			header("Content-Disposition: attachment; filename='hawcQuery.csv'");
			header("Pragma: no-cache");
			header("Expires: 0");
			header('Content-Length: ' . filesize($fileName));
			readfile($fileName);
			unlink($fileName );
		}else{
			echo "error";
		}
 	} 

	public function del_file(){
		$nameFile = $this->input->post("nameFile");
		$this->load->helper("file");
		print_r(explode("/",$nameFile));
		delete_files($nameFile);
	}
	public function save(){
		$variableData = $this->input->post();
		$VariableID = $variableData['VariableID'];
		unset($variableData['VariableID']);
		echo "Type {$variableData['Type']}";
		if ($variableData['Type']==1) {
			$variableData['MinRange'] = strtotime($variableData['MinRange']);
			$variableData['MaxRange'] = strtotime($variableData['MaxRange']);

		}
		$isOK = $this->variable->update($variableData,$VariableID);

		if ($isOK&&$isOK>0) {
			echo json_encode( array(
				"correct"=>$isOK>0,
				"msj"=>'Se guardo correctamente',
				"mas"=>$variableData
				));
		}else{
			echo "jola";
		}
	}
}
