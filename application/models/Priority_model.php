<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Priority_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}



	public function insert_priority($data){
		return $this->db->insert('ie_priority', $data);
	}
	
	public function list_priority(){
		return $this->db->get('ie_priority');
		 
	}
	public function delete_priority($id){
		$this->db->delete('ie_priority', array('p_id' => $id)); 
		 
	}


}


?>