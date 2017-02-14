<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hawc extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('QueryBuildier', 'hawc');
		$this->load->model('Variable', 'variable');

	}

	public function index(){
		$data["colums_name"] = $this->hawc->columns('qmdb','recstats_hawcprod_v4r01_v1p26p00_rev20264_20150504' );
		$data["variables"] = $this->variable->getListVariables();
		$this->load->view('index',$data);
	}
	public function getVariableSelect(){
		$search = $this->input->post("search");
		$variables = $this->variable->getVariableSelect($search);
		$this->responseJson(["correct"=>$variables!=null,"variables"=>$variables]);
	}

	public function insertVariable(){
		$VariableID = $this->variable->insert($this->input->post());
		$this->responseJson(["correct"=>$VariableID>0,"VariableID"=>$VariableID]);
	}
}
