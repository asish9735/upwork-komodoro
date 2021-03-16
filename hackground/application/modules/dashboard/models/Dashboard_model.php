<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model{
	
	public function __construct(){
        return parent::__construct();
	}
	
	public function get_project_count(){
		return $this->db->count_all_results('project');
	}
	
	public function get_support_request_count(){
		return 0;
	}
	public function get_unread_notification_count(){
		return $this->db->where('read_status', 0)->count_all_results('admin_notifications');
	}
	public function get_withdrawn_count(){
		$wallet_transaction_type_id=get_setting('WITHDRAW');
		return $this->db->where('wallet_transaction_type_id', $wallet_transaction_type_id)->where('status', 0)->count_all_results('wallet_transaction');
	}
	
	public function get_contract_count(){
		return $this->db->where('contract_status', 1)->count_all_results('project_contract');
	}
	
	public function get_user_count(){
		return $this->db->count_all_results('member');
	}
	
	public function project_statics(){
		$date = date('Y-m-d');
		$records = array();
		for($i=0; $i <= 12; $i++){
			$date_key = date('m', strtotime("-$i month"));
			$date_year = date('Y', strtotime("-$i month"));
			$res1 = $this->db->where("MONTH(project_posted_date) = $date_key and YEAR(project_posted_date) = $date_year")->count_all_results('project');
			$records[] = array(
				'item1' => $res1,
				'y' => date('Y-m', strtotime("-$i month")),
			);
		}
		
		return $records;
	}
	
	public function member_statics(){
		$date = date('Y-m-d');
		$records = array();
		for($i=0; $i <= 12; $i++){
			$date_key = date('m', strtotime("-$i month"));
			$date_year = date('Y', strtotime("-$i month"));
			$res1 = $this->db->where("MONTH(member_register_date) = $date_key and YEAR(member_register_date) = $date_year and is_employer=1")->count_all_results('member');
			$res2 = $this->db->where("MONTH(member_register_date) = $date_key and YEAR(member_register_date) = $date_year and is_employer=0")->count_all_results('member');
			$records[] = array(
				'item1' => $res1,
				'item2' => $res2,
				'y' => date('Y-m', strtotime("-$i month")),
			);
		}
		
		return $records;
	}
	
	
	
	/* public function getWorkRecords(){
		$date = date('Y-m-d');
		$records = array();
		for($i=0; $i <= 30; $i++){
			$date_key = date('Y-m-d', strtotime("-$i days"));
			$res1 = $this->db->where("DATE(posted_datetime) = DATE('$date_key') ")->count_all_results('works');
			$res2 = $this->db->where("DATE(datetime) = DATE('$date_key') ")->count_all_results('works_bids');
			$records[] = array(
				'date' => $date_key,
				'total_work' => $res1,
				'total_bids' => $res2,
			);
		}
		
		return $records;
	} */
	

}


