<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proposals_model extends MX_Controller {
	private $lang;
	function __construct()
	{
			$this->lang = get_active_lang();
			parent::__construct();
	}
	public function manage_proposal($srch_param=array() , $limit=0 , $offset=40 , $for_list=TRUE){
		$this->db->select('ps.proposal_status,ps.proposal_title,ps.proposal_url,ps.proposal_seller_id,ps.display_price,ps.proposal_id,ps.proposal_image,p_set.proposal_featured,p_set.featured_end_date,ps.admin_reason')
		->from('proposals as ps')
		->join('proposal_settings as p_set','ps.proposal_id=p_set.proposal_id','left');
		$this->db->where('ps.proposal_status <>' , PROPOSAL_DELETED);
		if($srch_param){
			if(array_key_exists('member_id',$srch_param) && $srch_param['member_id']>0){
				$this->db->where('ps.proposal_seller_id' , $srch_param['member_id']);
			}
		}
		$this->db->group_by("ps.proposal_id");
		if($for_list){
			$this->db->limit($offset , $limit);
			$this->db->order_by("ps.proposal_id" , "DESC");
			$result = $this->db->get()->result_array();
			if($result){
				foreach($result as $k => $v){
					$row=$v;
					$result[$k] = $row;
				}
			}
		}else{
			$result = $this->db->get()->num_rows();
		}
		
		return $result;

	}
	public function list_proposal($srch_param=array() , $limit=0 , $offset=40 , $for_list=TRUE){
		if($srch_param){
			$proposal_in=array(0);
			if(array_key_exists('other_viewer',$srch_param) && $srch_param['other_viewer']==1){
				$other_users=$this->db->select('member_id')->where('proposal_id',$srch_param['not_proposal_id'])->from('proposal_view_log')->group_by('member_id')->limit(100)->get()->result();
				$selected_users=array();
				if($other_users){
					foreach($other_users as $u=>$user){
						$selected_users[]=$user->member_id;
					}
					$selected_proposals=$this->db->select('proposal_id')->where_in('member_id',$selected_users)->from('proposal_view_log')->group_by('proposal_id')->limit(10)->get()->result();
					if($selected_proposals){
						foreach($selected_proposals as $P=>$proposal_row){
							$proposal_in[]=$proposal_row->proposal_id;
						}
					}
				}
			}
		}
		
		$this->db->select('AVG(b.buyer_rating) as avg_review,m.member_name,mb.member_heading,ps.proposal_title,ps.proposal_seller_id,ps.display_price,ps.proposal_id,ps.proposal_image,p_set.proposal_featured,p_set.featured_end_date,ps.proposal_url')
		->from('proposals as ps')
		->join('buyer_reviews as b','ps.proposal_id=b.proposal_id','left')
		->join('proposal_settings as p_set','ps.proposal_id=p_set.proposal_id','left')
		->join('member as m','ps.proposal_seller_id=m.member_id','left')
		->join('member_basic as mb','m.member_id=mb.member_id','left')
		->join('proposal_category as pc','ps.proposal_id=pc.proposal_id','left')
		->join('proposal_skills as psk','(ps.proposal_id=psk.proposal_id and psk.proposal_skill_status=1)','left');
		$this->db->where('ps.proposal_status' , PROPOSAL_ACTIVE);
		if($srch_param){
			if(array_key_exists('category_id',$srch_param) && $srch_param['category_id']>0){
				$this->db->where('pc.category_id' , $srch_param['category_id']);
			}
			if(array_key_exists('sub_catgory_id',$srch_param) && $srch_param['sub_catgory_id']){
				$this->db->where_in('pc.category_subchild_id' , $srch_param['sub_catgory_id']);
			}
			if(array_key_exists('term',$srch_param) && !empty($srch_param['term'])){
				$term = $srch_param['term'];
				$term = addslashes($term);
				$this->db->where("(ps.proposal_title LIKE '%{$term}%' OR ps.proposal_short_info LIKE '%{$term}%')");
			}
			if(array_key_exists('not_proposal_id',$srch_param) && $srch_param['not_proposal_id']>0){
				$this->db->where('ps.proposal_id <>' , $srch_param['not_proposal_id']);
			}
			if(array_key_exists('is_featured',$srch_param) && $srch_param['is_featured']){
				$this->db->where('p_set.proposal_featured' , 1);
				$this->db->where('p_set.featured_end_date >=' , date('Y-m-d H:i:s'));
			}
			if(array_key_exists('member_id',$srch_param) && $srch_param['member_id']>0){
				$this->db->where('ps.proposal_seller_id' , $srch_param['member_id']);
			}
			if(array_key_exists('other_viewer',$srch_param) && $srch_param['other_viewer']==1){
				$this->db->where_in('ps.proposal_id' , $proposal_in);
			}
			if(array_key_exists('byskillsid',$srch_param) && $srch_param['byskillsid']){
				$this->db->where_in('psk.skill_id' , $srch_param['byskillsid']);
			}

		}
		$this->db->group_by("ps.proposal_id");
		if($for_list){
			$this->db->limit($offset , $limit);
			$this->db->order_by("p_set.proposal_featured" , "DESC");
			if($srch_param){
				
				if(array_key_exists('sort_by',$srch_param) && $srch_param['sort_by']=='popular'){
					$this->db->order_by("avg_review" , "DESC");
				}
				elseif(array_key_exists('sort_by',$srch_param) && $srch_param['sort_by']=='latest'){
					//$this->db->order_by("p.id" , "DESC");
				}
				elseif(array_key_exists('sort_by',$srch_param) && $srch_param['sort_by']=='price_low_to_high'){
					$this->db->order_by("ps.display_price" , "ASC");
				}
				elseif(array_key_exists('sort_by',$srch_param) && $srch_param['sort_by']=='price_high_to_low'){
					$this->db->order_by("ps.display_price" , "DESC");
				}
				
			}
			$this->db->order_by("ps.proposal_id" , "DESC");

			$result = $this->db->get()->result_array();
			//echo $this->db->last_query();
			if($result){
				foreach($result as $k => $v){
					$row=$v;
					//$tags=getGigDetails($v['proposal_id'],array('proposal_skills'));
					//$row['tags']=$tags['proposal_skills'];
					$result[$k] = $row;
				}
			}
			
			
		}else{
			$result = $this->db->get()->num_rows();
		}
		
		return $result;
	}
	public function processOrder($data=array()){
		$this->db->insert('orders', $data);
		$order_id = $this->db->insert_id();
		return $order_id;
	}

}
