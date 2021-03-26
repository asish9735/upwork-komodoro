<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dispute_model extends CI_Model{
	
	
	public function __construct(){
        return parent::__construct();
	}
	public function getDispute($srch=array(), $limit=0, $offset=20, $for_list=TRUE){
		$this->db->select('d.project_contract_dispute_id,d.contract_id,d.contract_milestone_id,p_c.contract_title,p.project_id,p.project_title,p.project_url,d.disputed_amount,d.dispute_date,d.dispute_status,c_m.milestone_title')
			->from('project_contract_dispute d')
			->join('project_contract as p_c','d.contract_id=p_c.contract_id','left')
			->join('project as p','p_c.project_id=p.project_id','left')
			->join('project_contract_milestone as c_m','d.contract_milestone_id=c_m.contract_milestone_id','left')
			;
			
		if($for_list){
			$result = $this->db->limit($offset, $limit)->order_by('d.project_contract_dispute_id', 'DESC')->get()->result_array();
		}else{
			$result = $this->db->get()->num_rows();
		}
		
		return $result;
	}
	
	
	
	
}


