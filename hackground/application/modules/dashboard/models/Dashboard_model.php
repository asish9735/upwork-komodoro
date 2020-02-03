<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model{
	
	public function __construct(){
        return parent::__construct();
	}
	
	public function get_active_order_count(){
		return $this->db->where('order_active', 1)->count_all_results('orders');
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
	
	public function get_pending_approval_count(){
		return $this->db->where('proposal_status', PROPOSAL_PENDING)->count_all_results('proposals');
	}
	public function get_request_pending_approval_count(){
		return $this->db->where('request_status', REQUEST_PENDING)->count_all_results('buyer_requests');
	}
	
	public function get_user_count(){
		return $this->db->count_all_results('member');
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


