<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Priority extends CI_Controller {
	
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
		$data['title'] = "Add New Priority Page";
		$this->load->view('header',$data);
		$this->load->view('add_new_priority_view');
	}

	public function create()
	{
		
		$session_user = $this->session->userdata('username');
		if(!isset($session_user) || ($session_user==''))
		{
			$this->session->set_flashdata('msg',"Please login to continue");
			redirect('admin');
		}
	

		$errors = array();
		
	 	$this->form_validation->set_rules('pname', 'Priority Name', 'trim|required|min_length[3]|max_length[150]|xss_clean');
        $this->form_validation->set_rules('pdesc', 'Description', 'trim|required|min_length[3]|xss_clean');
       
        
        if( $this->form_validation->run() != false){
        	
        	
        	//insert the user registration details into database
            $data = array(
                'p_name' => $this->input->post('pname'),
                'p_description' => $this->input->post('pdesc'),
            	'p_color' => $this->input->post('color')
            );
            
	      	$this->load->model('Priority_model');
 			$this->Priority_model->insert_priority($data);
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
		$this->load->model('Priority_model');
 		$this->Priority_model->delete_priority($id);
		
	}
}
