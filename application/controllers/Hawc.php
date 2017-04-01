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
		$result = $this->hawc->runQuery($query);
		echo json_encode($result);
	}

	public function save(){
		$variableData = $this->input->post();
		$VariableID = $variableData['VariableID'];
		unset($variableData['VariableID']);
		if ($variableData['Type']==1) {
			$variableData['MinRange'] = strtotime($variableData['MinRange']);
			$variableData['MaxRange'] = strtotime($variableData['MaxRange']);

		print_r($variableData);
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
