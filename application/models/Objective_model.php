<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Objective_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}



	public function insert_objective($data){
		return $this->db->insert('ie_objectives', $data);
	}
	
	public function getPriority($id){
		$q =  $this->db->query('SELECT * FROM ie_priority WHERE p_id='.$id);
		return $q;
	}
	
	
	public function list_objective($id){
	
		$q = $this->db
				->where('p_id',$id)
				->get('ie_objectives');
		if($q->num_rows() > 0 ){
			return $q;
		}
		return false;
		 
	}
	public function delete_objective($id){
		$this->db->delete('ie_objectives', array('o_id' => $id)); 
		 
	}
	
	public function getObjective($id){
		$q = $this->db
				->where('o_id',$id)
				->get('ie_objectives');
		if($q->num_rows() > 0 ){
			return $q;
		}
		return false;
	}
	
	public function update_objective($id,$data){
		$this->db->where('o_id', $id);
		$this->db->update('ie_objectives', $data); 
	}

}


?>