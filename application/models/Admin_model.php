<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	public function verify_user($email,$password){
		$q = $this->db
		->where('u_email',$email)
		->where('u_password',sha1($password))
		->where('u_status',"0")
		->limit(1)
		->get('ie_user');

		if($q->num_rows() > 0 ){
			return $q->row();
		}
		//		echo "asas1111";die();
		return false;
	}

	public function insert_user($data){
		return $this->db->insert('ie_user', $data);
	}
	
	public function update_user($id,$data){
		$this->db->where('u_id', $id);
		$this->db->update('ie_user', $data); 
	}

	public function send_reset_password_email($email){
		
		$this->load->library('email');
	// get config data
		$from = $this->config->item('email_address', 'email');
		$from_name = $this->config->item('email_name', 'email');
		$to = 'kvlong88@gmail.com';
		$to_name = "To Name";
		// we load the email library and send a mail
		$this->load->library('email');
		$this->email->from('kvlong@localhost.com', $from_name);
		$this->email->to($to, $to_name);
		$this->email->subject('Email subject');
		$this->email->message('Testing the email class.');
		$this->email->send();
		//to debug we can use print_debugger()
		echo $this->email->print_debugger();
}


	}





?>