<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {
	
	function __contruct(){
		parent::__contruct();
		
	}

	public function index()
	{
		$session_user = $this->session->userdata('username');
		$isAdmin = $this->session->userdata('admin');
		if(!isset($session_user) || ($session_user=='') || !isset($isAdmin) || $isAdmin !="1")
		{
			$this->session->set_flashdata('msg',"Please login to register !!");
			redirect('admin');
		}
		$this->load->model("Task_model");
		$res = $this->Task_model->getUserNotAdmin();
		$data['user'] = $res->result();
		$data['title']= "Register Page";
		$this->load->view('header',$data);
		$this->load->view('registration_view');
	}
}
?>