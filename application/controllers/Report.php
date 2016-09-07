<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
	
	function __contruct(){
		parent::__contruct();		
	}
	
	public function adhoc(){
		$session_user = $this->session->userdata('username');
		if(!isset($session_user) || ($session_user==''))
		{
			$this->session->set_flashdata('msg',"Please login to continue");
			redirect('admin');
		}
		
		$this->load->model('Task_model');
		$this->load->model('Priority_model');
 		$res = $this->Task_model->getUser();
		$plist = $this->Priority_model->list_priority();
		$data['user'] = $res->result();
		$data['plist'] = $plist->result();
		
		$owner = $this->input->post('owner');
		$sdate = $this->input->post('sdate');
		$edate = $this->input->post('edate');
		$status = $this->input->post('status');
		$update = $this->input->post('update');
		$priority = $this->input->post('priority');
		
//		$this->output->enable_profiler(TRUE);
			
		if(isset($sdate)&& isset($edate)){
			if($sdate != "" && $edate !=""){
				$data['sdate'] = $sdate;
				$data['edate'] = $edate;
				//This Part is for Owner
				if(isset($owner) && $owner !=""){
					$taskByOwner = $this->Task_model->getTaskByUser($owner,$sdate,$edate);
					if($taskByOwner !== false){
						$data['owner'] = $taskByOwner->result();
						$data['owners'] = $owner;
					}
				// This Part for task status	
				}else if(isset($status) && $status !=""){
					$taskByStatus = $this->Task_model->getTaskByStatus($status,$sdate,$edate);
					if($taskByStatus !== false){
						$data['status'] = $taskByStatus->result();
						$data['statuses'] = $status;
					}
				//This Part for priority
				}else if(isset($priority) && $priority !=""){
					$taskByPriority = $this->Task_model->getTaskByPriority($priority,$sdate,$edate);
					if($taskByPriority !== false){
						$data['priority'] = $taskByPriority->result();
						$data['priorities'] = $priority;
					}
				//This part for updates
				}else if(isset($update) && $update !=""){
					if($update != "news"){
						$this->load->model("Update_model");
						$updateType  =  $this->Update_model->getUpdateByType($update,$sdate,$edate);
						if($updateType !== false){
							$data['update'] = $updateType->result();
							$data['updates'] = $update;
						}
					}else{
						$this->load->model("Update_model");
						$updateType  =  $this->Update_model->getNewsworthyUpdate($sdate,$edate);
						if($updateType !== false){
							$data['update'] = $updateType->result();
							$data['updates'] = $update;
						}
					
					}
				}
				
								
				
				
			}else{
				$data['error'] = "Please select start date or end date!!";
			}
	}	
		$data['title'] = "Report Page";
		$this->load->view('header',$data);
		$this->load->view('adhoc_view',$data);
		
	}
	
	
	public function getCsvForUpdate(){
		
		$update = $this->input->get('update');
		$sdate = $this->input->get('sdate');
		$edate = $this->input->get('edate');
//		die($owner);
		$session_user = $this->session->userdata('username');
		if(!isset($session_user) || ($session_user==''))
		{
			$this->session->set_flashdata('msg',"Please login to continue");
			redirect('admin');
		}
		$this->load->model("Update_model");
		if($update != "news"){
			$updateByTypeInCSV = $this->Update_model->getUpdateByTypeInCSV($update,$sdate,$edate);
			$this->load->helper("download");
			date_default_timezone_set("Australia/Melbourne");
			force_download("Update_by_Type_Report_".date('d_F_Y_H_i_s').".csv",$updateByTypeInCSV);
		}else{
			$newsworthUpdateInCSV = $this->Update_model->getNewsworthyUpdateInCSV($sdate,$edate);
			$this->load->helper("download");
			date_default_timezone_set("Australia/Melbourne");
			force_download("Newsworthy_Updates_Report_".date('d_F_Y_H_i_s').".csv",$newsworthUpdateInCSV);
		}
	
	}
	
	
	public function getCsvForOwner(){
		
		$owner = $this->input->get('owner');
		$sdate = $this->input->get('sdate');
		$edate = $this->input->get('edate');
//		die($owner);
		$session_user = $this->session->userdata('username');
		if(!isset($session_user) || ($session_user==''))
		{
			$this->session->set_flashdata('msg',"Please login to continue");
			redirect('admin');
		}
		$this->load->model('Task_model');
		$taskByOwnerCSV = $this->Task_model->getTaskByUserInCSV($owner,$sdate,$edate);
		$this->load->helper("download");
		date_default_timezone_set("Australia/Melbourne");
		force_download("Owner_Report_".date('d_F_Y_H_i_s').".csv",$taskByOwnerCSV);
	
	}
	
	
	public function getCsvForStatus(){
		
		$status = $this->input->get('status');
		$sdate = $this->input->get('sdate');
		$edate = $this->input->get('edate');
		$session_user = $this->session->userdata('username');
		if(!isset($session_user) || ($session_user==''))
		{
			$this->session->set_flashdata('msg',"Please login to continue");
			redirect('admin');
		}
		$this->load->model('Task_model');
		$taskByStatusCSV = $this->Task_model->getTaskByStatusInCSV($status,$sdate,$edate);
		$this->load->helper("download");
		date_default_timezone_set("Australia/Melbourne");
		force_download("Task_Status_Report_".date('d_F_Y_H_i_s').".csv",$taskByStatusCSV);
	
	}
	
	public function getCsvForPriority(){
		
		$p = $this->input->get('priority');
		$sdate = $this->input->get('sdate');
		$edate = $this->input->get('edate');
		$session_user = $this->session->userdata('username');
		if(!isset($session_user) || ($session_user==''))
		{
			$this->session->set_flashdata('msg',"Please login to continue");
			redirect('admin');
		}
		$this->load->model('Task_model');
		$taskByPriorityCSV = $this->Task_model->getTaskByPriorityInCSV($p,$sdate,$edate);
		$this->load->helper("download");
		date_default_timezone_set("Australia/Melbourne");
		force_download("Priority_Report_".date('d_F_Y_H_i_s').".csv",$taskByPriorityCSV);
	
	}
	
	
	
	public function ceo()
	{
		$session_user = $this->session->userdata('username');
		if(!isset($session_user) || ($session_user==''))
		{
			$this->session->set_flashdata('msg',"Please login to continue");
			redirect('admin');
		}
		$sdate = $this->input->get('sdate');
		$edate = $this->input->get('edate');
		$report = $this->input->get('report');
		if(!isset($sdate) && !isset($edate)){

			$data['title'] = "Report Page";
			$this->load->view('header',$data);
			$this->load->view('ceo_report_view',$data);
		
		}else{
			$this->load->model("Report_model");
			$TotalStatus = $this->Report_model->getTotalStatus($sdate,$edate);
			$TotalUpdates = $this->Report_model->getTotalUpdate($sdate,$edate);
//			$this->output->enable_profiler(TRUE);

			$data['TotalStatus'] = $TotalStatus->first_row();
			$data['result'] = $TotalUpdates->result();
			$data['sdate'] = $sdate;
			$data['edate'] = $edate; 
			if(isset($report)){
				$data['report'] = $report;
			}
			if(!isset($report)){
				$data['title'] = "Report Page";
				$this->load->view('header',$data);
				$this->load->view('ceo_report_view',$data);
			}else{
				$data['title'] = "Report Page View";
				$this->load->view('header',$data);
				$this->load->view('ceo_report_view',$data);
			}
			    
		}
	}
}
