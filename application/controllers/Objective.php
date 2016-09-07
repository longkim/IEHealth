<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Objective extends CI_Controller {
	
	function __contruct(){
		parent::__contruct();	
		
	}
	
	public function index($id = 0)
	{
		$session_user = $this->session->userdata('username');
		if(!isset($session_user) || ($session_user==''))
		{
			$this->session->set_flashdata('msg',"Please login to continue");
			redirect('admin');
		}
		$this->load->model('Objective_model');
 		$res = $this->Objective_model->list_objective($id);
 		$priority = $this->Objective_model->getPriority($id);
 		if($res == false ){
 			$data['result'] = array();
 		}else{
 			$data['result'] = $res->result();
 		}
		$data['title'] = "Objectives Page";
		$data['priority'] = $priority->result();
		$this->load->view('header',$data);
		$this->load->view('objective_view',$data);
	}
	
	
	public function edit($oid){
		
		$this->load->model('Objective_model');
		$res = $this->Objective_model->getObjective($oid);
		if($res == false ){
 			$data['result'] = array();
 		}else{
 			$data['result'] = $res->result();
 		}
 		$data['title'] = "Add New Priority Page";
 		$data['oid'] = $oid;
 		$this->load->view('header',$data);
		$this->load->view('edit_objective_view');
	}
	
	public function add($pid){
		$data['title'] = "Add New Priority Page";
		$data['pid'] = $pid;
		$this->load->view('header',$data);
		$this->load->view('add_new_objective_view');
	}
	
	public function update($oid){
		$errors = array();
	 	$this->form_validation->set_rules('oname', 'Objective Name', 'trim|required|min_length[3]|max_length[150]');
        $this->form_validation->set_rules('odesc', 'Description', 'trim|required|min_length[3]');
       
        
        if( $this->form_validation->run() != false){
        	
        	
        	//insert the user registration details into database
            $data = array(
                'o_name' => $this->input->post('oname'),
                'o_description' => $this->input->post('odesc')
            );
            
	      	$this->load->model('Objective_model');
 			$this->Objective_model->update_objective($oid,$data);
 			$response['status'] = true;
 			header('Content-type: application/json');
    		EXIT (json_encode($response));
 			
		}else{
		
			
	        // Loop through $_POST and get the keys
	        foreach ($this->input->post() as $key => $value)
	        {
	            // Add the error message for this field
	            $errors[$key] = form_error($key);
	        }
	        $response['errors'] = array_filter($errors); // Some might be empty
	        $response['status'] = FALSE;
	        header('Content-type: application/json');
    		EXIT (json_encode($response));
    		
		}
		
	}
	
	
	public function create($pid)
	{
		
		$session_user = $this->session->userdata('username');
		if(!isset($session_user) || ($session_user==''))
		{
			$this->session->set_flashdata('msg',"Please login to continue");
			redirect('admin');
		}
	

		$errors = array();
		
	 	$this->form_validation->set_rules('oname', 'Objective Name', 'trim|required|min_length[3]|max_length[150]');
        $this->form_validation->set_rules('odesc', 'Description', 'trim|required|min_length[3]');
       
        
        if( $this->form_validation->run() != false){
        	
        	
        	//insert the user registration details into database
            $data = array(
                'o_name' => $this->input->post('oname'),
                'o_description' => $this->input->post('odesc'),
            	'p_id'=> $pid
            );
            
	      	$this->load->model('Objective_model');
 			$this->Objective_model->insert_objective($data);
 			$response['status'] = true;
 			header('Content-type: application/json');
    		EXIT (json_encode($response));
 			
//			if ($res == true){
//				$response['status'] = TRUE;
//				$response['errors'] = null;
//				
//			}else{
//				$response['status'] = FALSE;
//				$response['errors'] = null;
//			}
		}else{
		
			
	        // Loop through $_POST and get the keys
	        foreach ($this->input->post() as $key => $value)
	        {
	            // Add the error message for this field
	            $errors[$key] = form_error($key);
	        }
	        $response['errors'] = array_filter($errors); // Some might be empty
	        $response['status'] = FALSE;
	        header('Content-type: application/json');
    		EXIT (json_encode($response));
    		
		}
		
	}
	public function delete($id){
		$this->load->model('Objective_model');
 		$this->Objective_model->delete_objective($id);
		
	}
}
