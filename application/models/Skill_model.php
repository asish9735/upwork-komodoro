<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Skill_model extends CI_Model {
	
	var $ci;
	
    public function __construct() {
	   $this->ci =& get_instance();
        return parent::__construct();
    }
	
	public function getProjectSkill($project_id=''){
		$default_lang = get_active_lang();
		$this->ci->db->select("p_s.skill_id,s_n.skill_name")
				->from("project_skills p_s")
				->join("skill_names s_n", "s_n.skill_id=p_s.skill_id AND s_n.skill_lang='$default_lang'", "LEFT");
		
		$this->ci->db->where("p_s.project_id", $project_id);
		$result = $this->ci->db->get()->result_array();
		return $result;
	}
	
	public function getUserSkill($user_id=''){
		$default_lang = get_active_lang();
		$this->ci->db->select("m_s.skill_id,s_n.skill_name")
				->from("member_skills m_s")
				->join("skill_names s_n", "s_n.skill_id=m_s.skill_id AND s_n.skill_lang='$default_lang'", "LEFT");
		
		$this->ci->db->where("m_s.member_id", $user_id);
		$this->db->order_by("m_s.member_skills_order", "ASC");
		$result = $this->ci->db->get()->result_array();
		return $result;
	}
	
}
