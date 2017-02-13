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
		$data["variables"] = $this->variable->getListVariables();
		$this->load->view('index',$data);
	}
	public function getVariableSelect(){
		// $variableID = $this->input->post("variableID");
		// $this->variable->getVariableSelect($this->input->post());
	}
}
