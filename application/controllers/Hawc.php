<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class hawc extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('QueryBuildier', 'hawc');
	}

	public function index(){
		// $data["colums_name"] = $this->hawc->columns('qmdb','recstats_hawcprod_v4r01_v1p26p00_rev20264_20150504' );
		$data["colums"] $this->
		$this->load->view('index',$data);
	}
}
