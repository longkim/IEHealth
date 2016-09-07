<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}



	public function insert_update($data){
		return $this->db->insert('ie_update', $data);
	}
	
	public function getTask($id){
		$q =  $this->db->query('SELECT * FROM ie_tasks WHERE t_id='.$id);
		return $q;
	}
	//SELECT * FROM `ie_strategies` s INNER JOIN `ie_objectives` o ON s.o_id = o.o_id INNER JOIN `ie_priority` p ON p.p_id = o.p_id WHERE s.s_id = 4
	
	public function list_update($id){
		$q =  $this->db->query('SELECT * FROM ie_update u 
						INNER JOIN ie_tasks t ON t.t_id = u.t_id
						INNER JOIN ie_strategies s ON t.s_id= s.s_id 
						INNER JOIN ie_objectives o ON s.o_id = o.o_id
						INNER JOIN ie_priority p ON o.p_id = p.p_id
						WHERE u.t_id ='.$id.' and close = 0');

		if($q->num_rows() > 0 ){
			return $q;
		}
		return false;
		 
	}
	public function delete_update($id){
		$this->db->delete('ie_update', array('up_id' => $id)); 
		 
	}
	
	public function getUpdateByType($type,$sdate,$edate){
		$q =  $this->db->query('SELECT * FROM ie_update u 
						INNER JOIN ie_tasks t ON t.t_id = u.t_id
						INNER JOIN ie_strategies s ON t.s_id= s.s_id 
						INNER JOIN ie_objectives o ON s.o_id = o.o_id
						INNER JOIN ie_priority p ON o.p_id = p.p_id
						WHERE u.up_type=\''.$type.'\'
						AND u.create_date >= \''.$sdate.'\' and u.create_date <=\''.$edate.'\'');
		
		if($q->num_rows() > 0 ){
			return $q;
		}
		return false;
		
	}
	
	public function getNewsworthyUpdate($sdate,$edate){
		$q =  $this->db->query('SELECT * FROM ie_update u 
						INNER JOIN ie_tasks t ON t.t_id = u.t_id
						INNER JOIN ie_strategies s ON t.s_id= s.s_id 
						INNER JOIN ie_objectives o ON s.o_id = o.o_id
						INNER JOIN ie_priority p ON o.p_id = p.p_id
						WHERE u.worthy= 1
						AND u.create_date >= \''.$sdate.'\' and u.create_date <=\''.$edate.'\'');
		
		if($q->num_rows() > 0 ){
			return $q;
		}
		return false;
		
	}
	
	public function getNewsworthyUpdateInCSV($sdate,$edate){
		$this->load->dbutil();
		
		$q =  $this->db->query('SELECT 
						p.p_name as Priority_Name,
						o.o_name as Objective_Name,
						s.s_name as Strategy_Name,
						u.up_name as Update_Name,
						t.t_short_desc as Task_Name,
						t.t_owner as Task_Owner,
						t.t_member as Members,
						u.up_type as Update_Type,
						t.t_end_date as Due 
						FROM ie_update u 
						INNER JOIN ie_tasks t ON t.t_id = u.t_id
						INNER JOIN ie_strategies s ON t.s_id= s.s_id 
						INNER JOIN ie_objectives o ON s.o_id = o.o_id
						INNER JOIN ie_priority p ON o.p_id = p.p_id
						WHERE u.worthy= 1
						AND u.create_date >= \''.$sdate.'\' and u.create_date <=\''.$edate.'\'');
		
		if($q->num_rows() > 0 ){
			return $this->dbutil->csv_from_result($q);
		}
		return false;
		
	}
	
	public function getUpdateByTypeInCSV($type,$sdate,$edate){
		$this->load->dbutil();
		
		$q =  $this->db->query('SELECT 
						p.p_name as Priority_Name,
						o.o_name as Objective_Name,
						s.s_name as Strategy_Name,
						u.up_name as Update_Name,
						t.t_short_desc as Task_Name,
						t.t_owner as Task_Owner,
						t.t_member as Members,
						u.up_type as Update_Type,
						t.t_end_date as Due 
						FROM ie_update u 
						INNER JOIN ie_tasks t ON t.t_id = u.t_id
						INNER JOIN ie_strategies s ON t.s_id= s.s_id 
						INNER JOIN ie_objectives o ON s.o_id = o.o_id
						INNER JOIN ie_priority p ON o.p_id = p.p_id
						WHERE u.up_type=\''.$type.'\'
						AND u.create_date >= \''.$sdate.'\' and u.create_date <=\''.$edate.'\'');
		
		if($q->num_rows() > 0 ){
			return $this->dbutil->csv_from_result($q);
		}
		return false;
		
	}
	
	
	public function getUpdate($id){
		
		
		$this->db->select('*');
		$this->db->from('ie_update');
		$this->db->join('ie_tasks', 'ie_tasks.t_id = ie_update.t_id');
		$this->db->where('up_id',$id);
		
		$q = $this->db->get();
		if($q->num_rows() > 0 ){
			return $q;
		}
		return false;
	}
	
	public function update_update($id,$data){
		$this->db->where('up_id', $id);
		$this->db->update('ie_update', $data); 
	}
	
	
}


?>