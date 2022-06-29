<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends MX_Controller {

	function __construct()
	{
		
			parent::__construct();
	}
	public function manage_orders($srch_param=array() , $limit=0 , $offset=40 , $for_list=TRUE){
		$this->db->select('o.order_id,o.order_date,o.delivery_time,o.order_active,o.order_status,p.proposal_id,p.proposal_title,p.proposal_image,o.order_price,o.payment_method,o.transaction_id')
		->from('orders o')
		->join('proposals as p','o.proposal_id=p.proposal_id','left')
		->join('proposal_settings as p_set','p.proposal_id=p_set.proposal_id','left');
		$this->db->where('o.order_status <>' , 0);
		if($srch_param){
			if(array_key_exists('member_id',$srch_param) && $srch_param['member_id']>0){
                $wh="(o.buyer_id='".$srch_param['member_id']."' or o.seller_id='".$srch_param['member_id']."')";
				$this->db->where($wh);
			}
			if(array_key_exists('status',$srch_param) && $srch_param['status']=='P'){
				$this->db->where_in('o.order_status',array(ORDER_PROCESSING,ORDER_REVISION,ORDER_CANCELLATION));
			}
		}
		if($for_list){
			$this->db->limit($offset , $limit);
			$this->db->order_by("o.order_id" , "DESC");
			$result = $this->db->get()->result_array();
		}else{
			$result = $this->db->get()->num_rows();
		}
		return $result;
	}


}
