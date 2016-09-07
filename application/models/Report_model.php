<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {

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
	
	public function getTotalUpdate($sdate,$edate){
	 	 $q = $this->db->query('SELECT * FROM ie_update u 
						INNER JOIN ie_tasks t ON t.t_id = u.t_id
						INNER JOIN ie_strategies s ON t.s_id= s.s_id 
						INNER JOIN ie_objectives o ON s.o_id = o.o_id
						INNER JOIN ie_priority p ON o.p_id = p.p_id
						where ceo_report = 1 and create_date >= \''.$sdate.'\' and create_date <=\''.$edate.'\'');
	 	 return $q;
	}
	//SELECT *, COUNT(*) as TotalStatus FROM ie_tasks where t_start_date >= '2016-04-30' and t_start_date <= '2016-06-02' GROUP BY t_status
	public function getTotalStatus($sdate,$edate){
		$q =  $this->db->query('SELECT
							   COUNT(CASE WHEN t_status = "Completed" THEN 1 END) AS Completed,
							   COUNT(CASE WHEN t_status = "Delayed" THEN 1 END) AS Delay,
							   COUNT(CASE WHEN t_status = "Never Started" THEN 1 END) AS Never_started,
							   COUNT(CASE WHEN t_status = "Not Started" THEN 1 END) AS Not_started,
							   COUNT(CASE WHEN t_status = "Open" THEN 1 END) AS Open
							   FROM
							   ie_tasks 
							   WHERE t_start_date >= \''.$sdate. '\'and t_start_date <=\''.$edate.'\'');	
		return $q;
	}
	
	public function getTotalWorthyNews(){
		$q =  $this->db->query('SELECT COUNT(*) as TotalNews FROM ie_update WHERE worthy = 1');
		return $q;
		
	}
	


}


?>