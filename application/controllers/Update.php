<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update extends CI_Controller {
	
	function __contruct(){
		parent::__contruct();	
		
	}
	
	public function index($id = 0,$color= "FFFFFF")
	{
		$session_user = $this->session->userdata('username');
		if(!isset($session_user) || ($session_user==''))
		{
			$this->session->set_flashdata('msg',"Please login to continue");
			redirect('admin');
		}
		$this->load->model('Update_model');
 		$res = $this->Update_model->list_update($id);
 		$obj = $this->Update_model->getTask($id);
 		if($res == false ){
 			$data['result'] = array();
 		}else{
 			$data['result'] = $res->result();
 		}
		$data['title'] = "Update Page";
		$data['tasks'] = $obj->result();
		$data['color'] = $color;
		$this->load->view('header',$data);
		$this->load->view('update_view',$data);
	}
	
	public function add($sid,$color= "FFFFFF"){
		$session_user = $this->session->userdata('username');
		if(!isset($session_user) || ($session_user==''))
		{
			$this->session->set_flashdata('msg',"Please login to continue");
			redirect('admin');
		}
		
		$this->load->model('Task_model');
		
		$data['title'] = "Add Update Page";
		$data['sid'] = $sid;
		$data['color'] = $color;
		$this->load->view('header',$data);
		$this->load->view('add_update_view',$data);
		
	}
	
	public function edit($sid,$color= "FFFFFF"){
		
		$this->load->model('Update_model');
		$res = $this->Update_model->getUpdate($sid);
		if($res == false ){
 			$data['result'] = array();
 		}else{
 			$data['result'] = $res->result();
 		}
 		$data['title'] = "Edit Update Page";
 		$data['sid'] = $sid;
 		$data['color'] = $color;
 		$this->load->view('header',$data);
		$this->load->view('edit_update_view');
	}
	
	
	public function close($id){
		//insert the user registration details into database
        $data = array(
                'close' => 1,
                'close_date' => date('Y-m-d')
            );
            
        
      	$this->load->model('Update_model');
 		$this->Update_model->update_update($id,$data);
 		$response['status'] = true;
 		header('Content-type: application/json');
    	EXIT (json_encode($response));
	}
	
	
	
	public function updates(){
		$session_user = $this->session->userdata('username');
		if(!isset($session_user) || ($session_user==''))
		{
			$this->session->set_flashdata('msg',"Please login to continue");
			redirect('admin');
		}
		
		$this->load->model('Update_model');
		
		$errors = array();
	 	$this->form_validation->set_rules('uname', 'Update Name', 'trim|required|min_length[3]|max_length[150]');
        $this->form_validation->set_rules('sdesc', 'Description', 'trim|required|min_length[3]|max_length[150]');
	  
        //config upload parameter
       	$config['upload_path'] =  './uploads/';
		$config['allowed_types'] = 'gif|jpg|png|doc|xls|docx|pdf|doc|csv|sql|xlsx|xml|pptx';
		$config['max_size']	= '0';
		$config['max_width']  = '0';
		$config['max_height']  = '0';
		$this->load->library('upload', $config);
		//file upload is not compulsory
		$result = true;
		if ($_FILES && $_FILES['userfile']['name'] !== "") {
  			$result = $this->upload->do_upload();
		}
        if ($this->form_validation->run() != false && $result){
        	 	
         	  $worthy = 0;
		     $ceo = 0;
	     	if($this->input->post("worthy[]") != null ){
	         	$worthy = 1 ;
	         }
		  	if($this->input->post("ceo[]") != null ){
	         	$ceo = 1 ;
	        }
	       	$upload_data = $this->upload->data();
        	if($upload_data['file_name'] == ""){
	        	$data = array(
	                'up_name' => $this->input->post('uname'),
	                'up_desc' => $this->input->post('sdesc'),
	            	'up_type' => $this->input->post('type'),
	            	'worthy' => $worthy,
	            	'ceo_report' => $ceo
	            	);
        		
        	}else{
        		//insert the user registration details into database
	            $data = array(
	                'up_name' => $this->input->post('uname'),
	                'up_desc' => $this->input->post('sdesc'),
	            	'up_type' => $this->input->post('type'),
	            	'up_file' => $upload_data['file_name'],
	            	'worthy' => $worthy,
	            	'ceo_report' => $ceo
	            );
        	}
            
	      	$this->load->model('Update_model');
 			$this->Update_model->update_update($this->input->post('uid'),$data);
 			
 			redirect('/update/index/'.$this->input->post('sid').'/'.$this->input->post('color'));
        
        }else{

        	$res = $this->Update_model->getUpdate($this->input->post('uid'));
//			print_r($this->input->post('uid'));die();
			if($res == false ){
	 			$data['result'] = array();
	 		}else{
	 			$data['result'] = $res->result();
	 		}
	 		$data['error'] = array('error' => $this->upload->display_errors());
	 		$data['title'] = "Edit Task Page";
	 		$data['sid'] = $this->input->post('sid');
	 		$data['color'] = $this->input->post('color');
	 		$this->load->view('header',$data);
			$this->load->view('edit_update_view');
        	
        }
		
	}
	
	
	public function create(){
		$session_user = $this->session->userdata('username');
		if(!isset($session_user) || ($session_user==''))
		{
			$this->session->set_flashdata('msg',"Please login to continue");
			redirect('admin');
		}
		
		$this->load->model('Update_model');
		
		$errors = array();
	 	$this->form_validation->set_rules('uname', 'Update Name', 'trim|required|min_length[3]|max_length[150]');
        $this->form_validation->set_rules('sdesc', 'Description', 'trim|required|min_length[3]|max_length[150]');
        
        //config upload parameter
       	$config['upload_path'] =  './uploads/';
		$config['allowed_types'] = 'gif|jpg|png|doc|xls|docx|pdf|doc|csv|sql|xlsx|xml|pptx ';
		$config['max_size']	= '0';
		$config['max_width']  = '0';
		$config['max_height']  = '0';
		$this->load->library('upload', $config);
		//file upload is not compulsory
		$result = true;
		if ($_FILES && $_FILES['userfile']['name'] !== "") {
  			$result = $this->upload->do_upload();
		}
         if( $this->form_validation->run() != false && $result ){    	
	         $worthy = 0;
		     $ceo = 0;
	     	if($this->input->post("worthy[]") != null ){
	         	$worthy = 1 ;
	         }
		  	if($this->input->post("ceo[]") != null ){
	         	$ceo = 1 ;
	        }
	       	$upload_data = $this->upload->data();

        	//insert the user registration details into database
            $data = array(
                'up_name' => $this->input->post('uname'),
                'up_desc' => $this->input->post('sdesc'),
            	't_id' => $this->input->post('sid'),
            	'up_type' => $this->input->post('type'),
            	'up_file' => $upload_data['file_name'],
            	'worthy' => $worthy,
            	'ceo_report' => $ceo,
            	'create_date' => date('Y-m-d')
            );
            
	      	$this->load->model('Update_model');
 			$this->Update_model->insert_update($data);
 			
 			redirect('/update/index/'.$this->input->post('sid').'/'.$this->input->post('color'));
 			
         }else{
         	$data['error'] = array('error' => $this->upload->display_errors());
			$data['title'] = "Add Update Page";
			$data['sid'] = $this->input->post('sid');
			$data['color'] = $this->input->post('color');
			$this->load->view('header',$data);
			$this->load->view('add_update_view',$data);
         }
	
	
	}
	
	public function delete($id){
		$this->load->model('Update_model');
 		$this->Update_model->delete_update($id);
		
	}

}