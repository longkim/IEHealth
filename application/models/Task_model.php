<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}



	public function insert_task($data){
		return $this->db->insert('ie_tasks', $data);
	}
	
	public function getStrategy($id){
		$q =  $this->db->query('SELECT * FROM ie_strategies WHERE s_id='.$id);
		return $q;
	}
	//SELECT * FROM `ie_strategies` s INNER JOIN `ie_objectives` o ON s.o_id = o.o_id INNER JOIN `ie_priority` p ON p.p_id = o.p_id WHERE s.s_id = 4
	
	public function list_task($id){
		$q =  $this->db->query('SELECT * FROM ie_tasks t 
						INNER JOIN ie_strategies s ON t.s_id= s.s_id 
						INNER JOIN ie_objectives o ON s.o_id = o.o_id
						INNER JOIN ie_priority p ON o.p_id = p.p_id
						WHERE t.s_id ='.$id);

		if($q->num_rows() > 0 ){
			return $q;
		}
		return false;
		 
	}
	public function delete_task($id){
		$this->db->delete('ie_tasks', array('t_id' => $id)); 
		 
	}

	public function getTask($id){
		$q =  $this->db->query('SELECT * FROM ie_tasks t 
						INNER JOIN ie_strategies s ON t.s_id= s.s_id 
						INNER JOIN ie_objectives o ON s.o_id = o.o_id
						INNER JOIN ie_priority p ON o.p_id = p.p_id
						WHERE t.t_id ='.$id);
		if($q->num_rows() > 0 ){
			return $q;
		}
		return false;
	}
	
	public function list_task_By_Type($type){
			$q =  $this->db->query('SELECT * FROM ie_tasks t 
						INNER JOIN ie_strategies s ON t.s_id= s.s_id 
						INNER JOIN ie_objectives o ON s.o_id = o.o_id
						INNER JOIN ie_priority p ON o.p_id = p.p_id
						WHERE t.t_status =\''.$type.'\'');
		if($q->num_rows() > 0 ){
			return $q;
		}
		return false;
	}
	
	
	public function update_task($id,$data){
		$this->db->where('t_id', $id);
		$this->db->update('ie_tasks', $data); 
	}
	
	public function getUser(){
		return $this->db->get('ie_user');
	}
	
	public function getUserNotAdmin(){
		return $this->db->query('Select * from ie_user where u_id <> 9');
	}
	
	public function getTaskByUser($name,$sdate,$edate){
			$q =  $this->db->query('SELECT * FROM ie_tasks t 
						INNER JOIN ie_strategies s ON t.s_id= s.s_id 
						INNER JOIN ie_objectives o ON s.o_id = o.o_id
						INNER JOIN ie_priority p ON o.p_id = p.p_id
						WHERE t_owner=\''.ucfirst($name).'\'
						AND t_start_date >= \''.$sdate.'\' and t_start_date <=\''.$edate.'\'
						');
//select * from table where concat_ws(' ',first_name,last_name) like '%$search_term%';
		if($q->num_rows() > 0 ){
			return $q;
		}
		return false;
	}
	
	public function getTaskByStatus($status,$sdate,$edate){
			$q =  $this->db->query('SELECT * FROM ie_tasks t 
						INNER JOIN ie_strategies s ON t.s_id= s.s_id 
						INNER JOIN ie_objectives o ON s.o_id = o.o_id
						INNER JOIN ie_priority p ON o.p_id = p.p_id
						WHERE t.t_status=\''.$status.'\'
						AND t_start_date >= \''.$sdate.'\' and t_start_date <=\''.$edate.'\'
						');
		if($q->num_rows() > 0 ){
			return $q;
		}
		return false;
	}
	
	public function getTaskByPriority($pid,$sdate,$edate){
			$q =  $this->db->query('SELECT * FROM ie_priority p 
						INNER JOIN ie_objectives o ON p.p_id = o.p_id
						INNER JOIN ie_strategies s ON s.o_id= o.o_id 
						INNER JOIN ie_tasks t ON t.s_id = s.s_id
						WHERE p.p_id=\''.$pid.'\'
						AND t.t_start_date >= \''.$sdate.'\' and t.t_start_date <=\''.$edate.'\'
						');
		if($q->num_rows() > 0 ){
			return $q;
		}
		return false;
	}
	

	
	
	function getTaskByPriorityInCSV($pid,$sdate,$edate){
		$this->load->dbutil();
		
		$q =  $this->db->query('SELECT 
						p.p_name as Priority_Name,
						o.o_name as Objective_Name,
						s.s_name as Strategy_Name,
						t.t_short_desc as Task_Name,
						t.t_owner as Task_Owner,
						t.t_member as Members,
						t.t_status as Status,
						t.t_end_date as Due  FROM ie_priority p 
						INNER JOIN ie_objectives o ON p.p_id = o.p_id
						INNER JOIN ie_strategies s ON s.o_id= o.o_id 
						INNER JOIN ie_tasks t ON t.s_id = s.s_id
						WHERE p.p_id=\''.$pid.'\'
						AND t.t_start_date >= \''.$sdate.'\' and t.t_start_date <=\''.$edate.'\'
						');
		
		if($q->num_rows() > 0 ){
			return $this->dbutil->csv_from_result($q);
		}
		return false;
		
	}
	
	
	function getTaskByUserInCSV($name,$sdate,$edate){
		$this->load->dbutil();

		$q =  $this->db->query('SELECT 
					p.p_name as Priority_Name,
					o.o_name as Objective_Name,
					s.s_name as Strategy_Name,
					t.t_short_desc as Task_Name,
					t.t_owner as Task_Owner,
					t.t_member as Members,
					t.t_status as Status,
					t.t_end_date as Due 
					FROM ie_tasks t 
					INNER JOIN ie_strategies s ON t.s_id= s.s_id 
					INNER JOIN ie_objectives o ON s.o_id = o.o_id
					INNER JOIN ie_priority p ON o.p_id = p.p_id
					WHERE t_owner=\''.ucfirst($name).'\'
					AND t_start_date >= \''.$sdate.'\' and t_start_date <=\''.$edate.'\'
					');
		if($q->num_rows() > 0 ){
			return $this->dbutil->csv_from_result($q);
		}
		return false;
		
	}
	
	function getTaskByStatusInCSV($status,$sdate,$edate){
		$this->load->dbutil();

		$q =  $this->db->query('SELECT 
					p.p_name as Priority_Name,
					o.o_name as Objective_Name,
					s.s_name as Strategy_Name,
					t.t_short_desc as Task_Name,
					t.t_owner as Task_Owner,
					t.t_member as Members,
					t.t_status as Status,
					t.t_end_date as Due 
					FROM ie_tasks t 
					INNER JOIN ie_strategies s ON t.s_id= s.s_id 
					INNER JOIN ie_objectives o ON s.o_id = o.o_id
					INNER JOIN ie_priority p ON o.p_id = p.p_id
					WHERE t_status=\''.$status.'\'
					AND t_start_date >= \''.$sdate.'\' and t_start_date <=\''.$edate.'\'
					');
		if($q->num_rows() > 0 ){
			return $this->dbutil->csv_from_result($q);
		}
		return false;
		
	}
	
	
	
}


?>