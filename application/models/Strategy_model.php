<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Strategy_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}



	public function insert_strategy($data){
		return $this->db->insert('ie_strategies', $data);
	}
	
	public function getObjective($id){
		$q =  $this->db->query('SELECT * FROM ie_objectives WHERE o_id='.$id);
		return $q;
	}
	
	
	public function list_strategy($id){
	
		$q = $this->db
				->where('o_id',$id)
				->get('ie_strategies');
		if($q->num_rows() > 0 ){
			return $q;
		}
		return false;
		 
	}
	public function delete_strategy($id){
		$this->db->delete('ie_strategies', array('s_id' => $id)); 
		 
	}

	public function getStrategy($id){
		$q = $this->db
				->where('s_id',$id)
				->get('ie_strategies');
		if($q->num_rows() > 0 ){
			return $q;
		}
		return false;
	}
	
	public function update_strategy($id,$data){
		$this->db->where('s_id', $id);
		$this->db->update('ie_strategies', $data); 
	}
	
}


?>