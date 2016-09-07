<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
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

		$this->load->model('Dashboard_model');
 		$newUpdate = $this->Dashboard_model->getTotalNewUpdate();
 		$TotalUpdate = $this->Dashboard_model->getTotalUpdate(); 
 		$TotalStatus = $this->Dashboard_model->getTotalStatus();
		$TotalWorthyNews = $this->Dashboard_model->getTotalWorthyNews();
		$UpdateThisWeek = $this->Dashboard_model->getThisWeekUpdate();
		$OverdueTasks = $this->Dashboard_model->getOverdueTasks();
		$CloseThisWeekTasks = $this->Dashboard_model->getCloseThisWeekTask();
		
		$data['UpdateThisWeek'] = $UpdateThisWeek->result();
 		$data['NewUpdate'] = $newUpdate->first_row()->NewUpdate;
 		$data['TotalUpdate'] = $TotalUpdate->first_row()->NewUpdate;
 		$data['TotalWorthyNews'] = $TotalWorthyNews->first_row()->TotalNews;
 		$data['OverdueTasks'] = $OverdueTasks->first_row()->Total;
 		$data['CloseThisWeekTasks'] = $CloseThisWeekTasks->first_row()->Total;
 		$data['TotalStatus'] = $TotalStatus->first_row();
 		
		$data['title'] = "Dash Board ";
		$this->load->view('header',$data);
		$this->load->view('dashboard_view',$data);
	}
	
	function sendmail($id){
		
		$session_user = $this->session->userdata('username');
		if(!isset($session_user) || ($session_user==''))
		{
			$this->session->set_flashdata('msg',"Please login to continue");
			redirect('admin');
		}
		$this->form_validation->set_rules('cemail','Email Address','required|valid_email');
		$this->form_validation->set_rules('content','Content','required');
		$this->form_validation->set_rules('cname','Comms Name','required');
		$this->form_validation->set_rules('subject','Subject','required');
		
		if($this->form_validation->run() != false){
			
			$this->load->model("Dashboard_model");
			$result = $this->Dashboard_model->getNewsworthyUpdate($this->input->post("uid"));
			
			$this->load->library('email');
	
			$this->email->from('admin@vinkim.com', 'Admin');
			$this->email->to($this->input->post('cemail')); 
			$this->email->subject($this->input->post('subject'));
//			print_r($result->first_row());die();
			$content  = "<html><body>";
			$content .= "<h5>Hi ".$this->input->post('cname').",</h5>";
			$content .= "<h5>".$this->input->post('content')."</h5>";
			$content .= "<ul>";
			$content .= "<li> Update Title: ".$result->first_row()->up_name;
			$content .= "</li>";
			$content .= "<li> Description: ".$result->first_row()->up_desc;
			$content .= "</li> ";
			$content .= "<li>For further information contact ".$result->first_row()->u_name." ".$result->first_row()->u_last_name;
			$content .= " on ".$result->first_row()->u_email;
			$content .= "</li>";
			$content .= "</ul>";
			$content .= "<h5>If you have any other queries please contact us on health.promotion@iehealth.org.au.</h5>";
			$content .= "<h5>Cheers,</h5>";
			$content .= "</body></html>";
			
//			print_r($content);die();
			$this->email->message($content);	
			
			$this->email->send();

			redirect('dashboard');
			
		}		
			$data['title'] = "Send Mail";
			$data['uid'] = $id;
			$this->load->view('header',$data);
			$this->load->view('sendmail_view',$data);
			

	}
}
