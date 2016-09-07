<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	function __contruct(){
		parent::__contruct();		
	}

	public function index()
	{
		$session_user = $this->session->userdata('username');
		if(!isset($session_user) || ($session_user==''))
		{
			$this->session->set_flashdata('msg',"Please login to continue");
			redirect('admin');
		}
		
		$this->load->model('Priority_model');
 		$res = $this->Priority_model->list_priority();
 		$data['result'] = $res->result();
		$data['title'] = "Home Page";
		$this->load->view('header',$data);
		$this->load->view('welcome_message',$data);
	}
}
