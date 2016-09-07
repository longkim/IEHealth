<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}



	public function getTotalNewUpdate(){
		$q =  $this->db->query('SELECT COUNT(*) as NewUpdate FROM ie_update WHERE WEEKOFYEAR(create_date)=WEEKOFYEAR(NOW())');
		return $q;
	}
	
	public function getThisWeekUpdate(){
				$q =  $this->db->query('SELECT * FROM ie_update u 
								INNER JOIN ie_tasks t ON t.t_id = u.t_id
								INNER JOIN ie_strategies s ON t.s_id= s.s_id 
								INNER JOIN ie_objectives o ON s.o_id = o.o_id
								INNER JOIN ie_priority p ON o.p_id = p.p_id
								WHERE WEEKOFYEAR(u.create_date)=WEEKOFYEAR(NOW())');
		return $q;
	}
	
	public function getTotalUpdate(){
		$q =  $this->db->query('SELECT COUNT(*) as NewUpdate FROM ie_update');
		return $q;
	}
	
	public function getOverdueTasks(){
		$q =  $this->db->query('SELECT COUNT(*) as Total FROM ie_tasks Where t_end_date < date(now()) and t_status != "Completed"');
		return $q;
	}
	
	public function getCloseThisWeekTask(){
		$q =  $this->db->query('SELECT COUNT(*) as Total FROM ie_update Where WEEKOFYEAR(close_date) = WEEKOFYEAR(now())');
		return $q;
	}
	
	public function getTotalStatus(){
		$q =  $this->db->query('SELECT
			   COUNT(CASE WHEN t_status = "Completed" THEN 1 END) AS Completed,
			   COUNT(CASE WHEN t_status = "Delayed" THEN 1 END) AS Delay,
			   COUNT(CASE WHEN t_status = "Never Started" THEN 1 END) AS Never_started,
			   COUNT(CASE WHEN t_status = "Not Started" THEN 1 END) AS Not_started,
			   COUNT(CASE WHEN t_status = "Open" THEN 1 END) AS Open
			   FROM
			   ie_tasks');
		return $q;
	}
	
	public function getTotalWorthyNews(){
		$q =  $this->db->query('SELECT COUNT(*) as TotalNews FROM ie_update WHERE worthy = 1');
		return $q;
		
	}
	
	public function getNewsworthyUpdate($id){
		 $q = $this->db->query('SELECT * FROM ie_update u 
						INNER JOIN ie_tasks t ON t.t_id = u.t_id
						INNER JOIN ie_strategies s ON t.s_id= s.s_id 
						INNER JOIN ie_objectives o ON s.o_id = o.o_id
						INNER JOIN ie_priority p ON o.p_id = p.p_id
						INNER JOIN ie_user us ON t.t_owner like concat(us.u_name," ",us.u_last_name)
 						where u.up_id ='.$id);
	 	 return $q;
		
		
	}
	


}


?>
