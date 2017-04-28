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
		$jsonVariable = [];
		echo json_encode(["correct"=>$variables!=null,"variables"=>$variables]);
	}
	public function getVariableName(){
		$json = $this->variable->getVariablesName($this->input->post('searchStr'));
		echo json_encode($json);
	}
	public function insertVariable(){
		$VariableID = $this->variable->insert($this->input->post());
		echo json_encode(["correct"=>$VariableID>0,"VariableID"=>$VariableID]);
	}

	public function getAllDataFrom(){
		$VariableID = $this->variable->getAllDataFrom($this->input->post('VariableID'));
		echo json_encode(["correct"=>$VariableID>0,"VariableID"=>$VariableID]);
	}

	public function runQuery(){
		$query = $this->input->post("query");
		$result = $this->hawc->runQuery($query,1000);
		echo json_encode($result);
	}

/*	public function runQueryDatatable(){
		$query = $this->input->post("query");
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$query = "{$query} LIMIT {$limit} OFFSET {$start}";
		$result = $this->hawc->runQuery($query);

		foreach ($list as $cliente) {
			$no++;
			$row = array();
	// var $column_search = array('nombre','telefono','phone','email','movil'); //set column field database for datatable searchable
			$row[] = $no;
			$row[] = $cliente->nombre;
			$row[] = "Tel : ".$cliente->telefono."<br>Cel : ".$cliente->celular;
			$row[] = $cliente->email;
			$row[] = $cliente->first_name." ".$cliente->last_name;
			$row[] = $this->restrinctionMenu($cliente->id_cliente);


			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->hawc->,
						// "recordsFiltered" => $this->hawc->($wheres),
						"data" => $data,
						"sql" => $sql
				);
		// $clientes =  $this->clm->jsonClientes($PERMISO);
		// echo $this->db->last_query();
		echo json_encode($output);
	}*/

	public function getCSV(){
		$selector = $this->input->post("selector");
		$from = $this->input->post("from");
		$where = $this->input->post("where");
		$extras = $this->input->post("extras");
		$fileName = date("Y-m-d_His").".csv";
		$download = '../assets/uploads/csv/'.$fileName ;
		$pathFile = "./assets/uploads/csv/";
		$csv = realpath($pathFile);
		// $csv = realpath(dirname(__FILE__)). '/../../assets/uploads/csv/';
		$fileName = $csv .'\\'. $fileName;
		$fileName = str_replace('\\', '/', $fileName);
		$sql = "{$selector} INTO OUTFILE '{$fileName}' FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\n' {$from} {$where} {$extras}";
		$this->hawc->dataCSV($sql);
		echo site_url('') . $download ;
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
		if ($variableData['Type']==1) {
			$variableData['MinRange'] = strtotime($variableData['MinRange']);
			$variableData['MaxRange'] = strtotime($variableData['MaxRange']);

		}
		$isOK = $this->variable->update($variableData,$VariableID);

		if ($isOK&&$isOK>0) {
			echo json_encode([
				"correct"=>$isOK>0,
				"msj"=>'Se guardo correctamente',
				"mas"=>$variableData
				]);
		}else{
			echo "jola";
		}
	}
}
