<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Strategy extends CI_Controller {
	
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
		$this->load->model('Strategy_model');
 		$res = $this->Strategy_model->list_strategy($id);
 		$obj = $this->Strategy_model->getObjective($id);
 		if($res == false ){
 			$data['result'] = array();
 		}else{
 			$data['result'] = $res->result();
 		}
		$data['title'] = "Strategies Page";
		$data['objective'] = $obj->result();
		$data['color'] = $color;
		$this->load->view('header',$data);
		$this->load->view('strategy_view',$data);
	}
	
	public function edit($tid){
		
		$this->load->model('Strategy_model');
		$res = $this->Strategy_model->getStrategy($tid);
		if($res == false ){
 			$data['result'] = array();
 		}else{
 			$data['result'] = $res->result();
 		}
 		$data['title'] = "Add New Priority Page";
 		$data['tid'] = $tid;
 		$this->load->view('header',$data);
		$this->load->view('edit_strategy_view');
	}
	
	public function add($oid){
		$data['title'] = "Add New Priority Page";
		$data['oid'] = $oid;
		$this->load->view('header',$data);
		$this->load->view('add_new_strategy_view');
	}
	
	public function update($oid){
		$errors = array();
	 	$this->form_validation->set_rules('oname', 'Objective Name', 'trim|required|min_length[3]|max_length[150]');
        $this->form_validation->set_rules('odesc', 'Description', 'trim|required|min_length[3]');
       
        
        if( $this->form_validation->run() != false){
        	
        	
        	//insert the user registration details into database
            $data = array(
                's_name' => $this->input->post('oname'),
                's_description' => $this->input->post('odesc')
            );
            
	      	$this->load->model('Strategy_model');
 			$this->Strategy_model->update_strategy($oid,$data);
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
	
	
	public function create($oid)
	{
		
		$session_user = $this->session->userdata('username');
		if(!isset($session_user) || ($session_user==''))
		{
			$this->session->set_flashdata('msg',"Please login to continue");
			redirect('admin');
		}
	

		$errors = array();
		
	 	$this->form_validation->set_rules('sname', 'Strategy Name', 'trim|required|min_length[3]|max_length[150]');
        $this->form_validation->set_rules('sdesc', 'Description', 'trim|required|min_length[3]');
       
        
        if( $this->form_validation->run() != false){
        	
        	
        	//insert the user registration details into database
            $data = array(
                's_name' => $this->input->post('sname'),
                's_description' => $this->input->post('sdesc'),
            	'o_id'=> $oid
            );
            
	      	$this->load->model('Strategy_model');
 			$this->Strategy_model->insert_strategy($data);
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
		$this->load->model('Strategy_model');
 		$this->Strategy_model->delete_strategy($id);
		
	}
}
