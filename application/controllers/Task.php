<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {
	
	function __contruct(){
		parent::__contruct();	
		
	}
	
	public function taskByID($id = 0,$color= "FFFFFF"){
		$session_user = $this->session->userdata('username');
		if(!isset($session_user) || ($session_user==''))
		{
			$this->session->set_flashdata('msg',"Please login to continue");
			redirect('admin');
		}
		$this->load->model('Task_model');
 		$res = $this->Task_model->getTask($id);
 		if($res == false ){
 			$data['result'] = array();
 		}else{
 			$data['result'] = $res->result();
 		}
		$data['title'] = "Task Page";
		$data['color'] = $color;
		$this->load->view('header',$data);
		$this->load->view('task_by_id_view',$data);
	
	}
	
	public function index($id = 0,$color= "FFFFFF")
	{
		$session_user = $this->session->userdata('username');
		if(!isset($session_user) || ($session_user==''))
		{
			$this->session->set_flashdata('msg',"Please login to continue");
			redirect('admin');
		}
		$this->load->model('Task_model');
 		$res = $this->Task_model->list_task($id);
 		$obj = $this->Task_model->getStrategy($id);
 		if($res == false ){
 			$data['result'] = array();
 		}else{
 			$data['result'] = $res->result();
 		}
		$data['title'] = "Task Page";
		$data['strategy'] = $obj->result();
		$data['color'] = $color;
		$this->load->view('header',$data);
		$this->load->view('task_view',$data);
	}
	
	public function add($sid,$color= "FFFFFF"){
		$session_user = $this->session->userdata('username');
		if(!isset($session_user) || ($session_user==''))
		{
			$this->session->set_flashdata('msg',"Please login to continue");
			redirect('admin');
		}
		
		$this->load->model('Task_model');
 		$res = $this->Task_model->getUser();
		
		$data['title'] = "Add Task Page";
		$data['users'] = $res->result();
		$data['sid'] = $sid;
		$data['color'] = $color;
		$this->load->view('header',$data);
		$this->load->view('add_task_view',$data);
		
	}
	
	public function edit($sid,$color= "FFFFFF"){
		
		$this->load->model('Task_model');
		$res = $this->Task_model->getTask($sid);
		$users = $this->Task_model->getUser();
		if($res == false ){
 			$data['result'] = array();
 		}else{
 			$data['result'] = $res->result();
 		}
 		$data['title'] = "Edit Task Page";
 		$data['sid'] = $sid;
 		$data['color'] = $color;
 		$data['users'] = $users->result();
 		$this->load->view('header',$data);
		$this->load->view('edit_task_view');
	}
	
	public function update(){
		$errors = array();
	 	$this->form_validation->set_rules('tname', 'Task Name', 'trim|required|min_length[3]|max_length[150]');
        $this->form_validation->set_rules('sdesc', 'Description', 'trim|required|min_length[3]|max_length[150]');
        $this->form_validation->set_rules('member[]', 'Members', 'required');
        $this->form_validation->set_rules('sdate', 'Start Date', 'required');
        $this->form_validation->set_rules('edate', 'End Date', 'required');
        $this->form_validation->set_rules('linkid', 'Linked ID', 'is_natural_no_zero');
        
        $this->load->model('Task_model');
        
        if ($this->form_validation->run() != false){
        	 	
	        $members = $this->input->post("member[]");;
	        $inputMember = "";
	        if (count($members) == 1){
	        	$inputMember = $members[0];
	        }else{
	        	foreach ($members as $member){
	        	$inputMember .= $member.","; 
	        }
	        	$inputMember = substr($inputMember,0,-2);
	        }
         	date_default_timezone_set('Australia/Melbourne');
         	
        	//insert the user registration details into database
            $data = array(
                't_short_desc' => $this->input->post('tname'),
                't_desc' => $this->input->post('sdesc'),
            	't_status' => $this->input->post('status'),
            	't_owner' => $this->input->post('owner'),
            	't_member' => $inputMember,
            	't_link_id' => $this->input->post('linkid'),
            	't_start_date' => $this->input->post('sdate'),
            	't_end_date' => $this->input->post('edate'),
            	't_last_updated' => date('Y-m-d H:i:s'),
            	'reason' => $this->input->post('reason')
            );
            
	      	$this->load->model('Task_model');
 			$this->Task_model->update_task($this->input->post('tid'),$data);
 			
 			redirect('/task/index/'.$this->input->post('sid').'/'.$this->input->post('color'));
        
        }else{
        
        	$res = $this->Task_model->getTask($this->input->post('tid'));
			$users = $this->Task_model->getUser();
			if($res == false ){
	 			$data['result'] = array();
	 		}else{
	 			$data['result'] = $res->result();
	 		}
	 		$data['title'] = "Edit Task Page";
	 		$data['sid'] = $this->input->post('sid');
	 		$data['color'] = $this->input->post('color');
	 		$data['users'] = $users->result();
	 		$this->load->view('header',$data);
			$this->load->view('edit_task_view');
        	
        }
		
	}
	
	
	public function create(){
		$session_user = $this->session->userdata('username');
		if(!isset($session_user) || ($session_user==''))
		{
			$this->session->set_flashdata('msg',"Please login to continue");
			redirect('admin');
		}
		
		$this->load->model('Task_model');
		
		$errors = array();
	 	$this->form_validation->set_rules('tname', 'Task Name', 'trim|required|min_length[3]|max_length[150]');
        $this->form_validation->set_rules('sdesc', 'Description', 'trim|required|min_length[3]|max_length[150]');
        $this->form_validation->set_rules('member[]', 'Members', 'required');
        $this->form_validation->set_rules('sdate', 'Start Date', 'required');
        $this->form_validation->set_rules('edate', 'End Date', 'required');
        $this->form_validation->set_rules('linkid', 'Linked ID', 'is_natural_no_zero');
        
//		print_r ( $this->input->post('status'));exit();
         if( $this->form_validation->run() != false){
        	
	        $members = $this->input->post("member[]");;
	        $inputMember = "";
	        if (count($members) == 1){
	        	$inputMember = $members[0];
	        }else{
	        	foreach ($members as $member){
	        	$inputMember .= $member.","; 
	        }
	        	$inputMember = substr($inputMember,0,-2);
	        }
         	date_default_timezone_set('Australia/Melbourne');
         	
        	//insert the user registration details into database
            $data = array(
                't_short_desc' => $this->input->post('tname'),
                't_desc' => $this->input->post('sdesc'),
            	's_id' => $this->input->post('sid'),
            	't_status' => $this->input->post('status'),
            	't_owner' => $this->input->post('owner'),
            	't_member' => $inputMember,
            	't_link_id' => $this->input->post('linkid'),
            	't_start_date' => $this->input->post('sdate'),
            	't_end_date' => $this->input->post('edate'),
            	't_last_updated' => date('Y-m-d H:i:s'),
            	'reason' => $this->input->post('reason')
            );
            
	      	$this->load->model('Task_model');
 			$this->Task_model->insert_task($data);
 			
 			redirect('/task/index/'.$this->input->post('sid').'/'.$this->input->post('color'));
 			
         }else{
         	$res = $this->Task_model->getUser();
		
			$data['title'] = "Add Task Page";
			$data['users'] = $res->result();
			$data['sid'] = $this->input->post('sid');
			$data['color'] = $this->input->post('color');
			$this->load->view('header',$data);
			$this->load->view('add_task_view',$data);
         }
	
	
	}
	
	public function delete($id){
		$this->load->model('Task_model');
 		$this->Task_model->delete_task($id);
		
	}
	
	public function taskType($type){
		$session_user = $this->session->userdata('username');
		if(!isset($session_user) || ($session_user==''))
		{
			$this->session->set_flashdata('msg',"Please login to continue");
			redirect('admin');
		}
		$type = urldecode($type);
		$this->load->model('Task_model');
//		die($type);
		$res = $this->Task_model->list_task_By_Type($type);
		if($res !== false){
			$data['result'] = $res->result();
		}
		$data['title'] = "Task By Type";
		$data['type'] = $type;
		$this->load->view('header',$data);
		$this->load->view('task_type_view',$data);
		
	}
	

}