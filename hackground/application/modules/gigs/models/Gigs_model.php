<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gigs_model extends CI_Model{
	
	private $table , $primary_key;
	
	public function __construct(){
		$this->table = 'proposals';
		$this->primary_key = 'proposal_id';
        return parent::__construct();
	}
	
	public function getList($srch=array(), $limit=0, $offset=20, $for_list=TRUE){
		$this->db->select('p.*,m.member_name,s.proposal_featured,s.featured_end_date')
			->from($this->table . ' p')
			->join('member m', 'm.member_id=p.proposal_seller_id', 'LEFT')
			->join('proposal_category c', 'c.proposal_id=p.proposal_id', 'LEFT')
			->join('proposal_settings s', 's.proposal_id=p.proposal_id', 'LEFT');
		
		if(!empty($srch['show']) && $srch['show'] == 'trash'){
			$this->db->where('p.proposal_status', PROPOSAL_DELETED);	
		}else{
			$this->db->where('p.proposal_status <>', PROPOSAL_DELETED);	
		}
		
		if(!empty($srch['term'])){
			$this->db->like('p.proposal_title', $srch['term']);
		}
		
		if(!empty($srch['delivery_time'])){
			$this->db->where('p.delivery_time', $srch['delivery_time']);
		}
		
		/* if(!empty($srch['seller_level'])){
			$this->db->where('s.level_id', $srch['seller_level']);
		} */
		
		if(!empty($srch['category'])){
			$this->db->where('c.category_id', $srch['category']);
		}
		
		if(!empty($srch['status'])){
			if($srch['status'] == 'featured'){
				$this->db->where('s.proposal_featured', 1);
			}else{
				$this->db->where('p.proposal_status', $srch['status']);
			}
		}
		if(!empty($srch['seller_id'])){
			$this->db->where('p.proposal_seller_id', $srch['seller_id']);
		}
		
		$this->db->group_by('p.proposal_id');
		
		if($for_list){
			$result = $this->db->limit($offset, $limit)->order_by('p.'.$this->primary_key, 'DESC')->get()->result_array();
		}else{
			$result = $this->db->get()->num_rows();
		}
		
		return $result;
	}
	public function updateRecord($data=array(), $id=''){
		$structure = array(
			'proposal_title' => !empty($data['proposal_title']) ? $data['proposal_title'] : '',
		);
		$ins['data'] = $structure;
		$ins['table'] = $this->table;
		$ins['where'] = array($this->primary_key => $id);
		update($ins);
		$ins=array();
		$structure = array(
			'category_id' => !empty($data['category_id']) ? $data['category_id'] : '0',
			'category_subchild_id' => !empty($data['category_subchild_id']) ? $data['category_subchild_id'] : '0',
		);
		$ins['data'] = $structure;
		$ins['table'] = 'proposal_category';
		$ins['where'] = array($this->primary_key => $id);
		return  update($ins);
	}
	public function getListCSV($srch=array()){
		$this->db->select('p.*,m.member_name,s.proposal_featured,s.featured_end_date,cn.name as category_name,csn.name as sub_category')
			->from($this->table . ' p')
			->join('member m', 'm.member_id=p.proposal_seller_id', 'LEFT')
			->join('proposal_category c', 'c.proposal_id=p.proposal_id', 'LEFT')
			->join('proposal_settings s', 's.proposal_id=p.proposal_id', 'LEFT')
			->join('category_names cn', "(c.category_id=cn.category_id  and cn.lang='en')", 'LEFT')
			->join('category_subchild_names csn', "(c.category_subchild_id=csn.category_subchild_id and csn.lang='en')", 'LEFT');
		
		if(!empty($srch['show']) && $srch['show'] == 'trash'){
			$this->db->where('p.proposal_status', PROPOSAL_DELETED);	
		}else{
			$this->db->where('p.proposal_status <>', PROPOSAL_DELETED);	
		}
		
		if(!empty($srch['term'])){
			$this->db->like('p.proposal_title', $srch['term']);
		}
		
		if(!empty($srch['delivery_time'])){
			$this->db->where('p.delivery_time', $srch['delivery_time']);
		}
		
		/* if(!empty($srch['seller_level'])){
			$this->db->where('s.level_id', $srch['seller_level']);
		} */
		
		if(!empty($srch['category'])){
			$this->db->where('c.category_id', $srch['category']);
		}
		
		if(!empty($srch['status'])){
			if($srch['status'] == 'featured'){
				$this->db->where('s.proposal_featured', 1);
			}else{
				$this->db->where('p.proposal_status', $srch['status']);
			}
		}
		
		
		$this->db->group_by('p.proposal_id');
		
		
		$result = $this->db->order_by('p.'.$this->primary_key, 'DESC')->get()->result_array();
		
		return $result;
	}
	
	public function deleteRecord($id=''){
		if($id && is_array($id)){
			return $this->db->where_in($this->primary_key, $id)->update($this->table, array('status' => DELETE_STATUS));
		}else{
			$ins['data'] = array('status' => DELETE_STATUS);
			$ins['table'] = $this->table;
			$ins['where'] = array($this->primary_key => $id);
			return  update($ins);
		}
		
	}
	
	public function getDetail($id=''){
		$result = $this->db->where('p.'.$this->primary_key, $id)->from($this->table .' as p')->join('proposal_category c', 'c.proposal_id=p.proposal_id', 'LEFT')->get()->row_array();
		return $result;
	}
	
	
	public function get_active_proposal(){
		$this->db->select('p.*')
			->from($this->table . ' p');
			
		
		$this->db->where('p.proposal_status', PROPOSAL_ACTIVE);	
		
		$result = $this->db->order_by($this->primary_key, 'DESC')->get()->result_array();
		
		return $result;
	}
	
	public function getReferralList($srch=array(), $limit=0, $offset=20, $for_list=TRUE){
		$this->db->select('p_r.*,s.member_name as seller,r.member_name as referrer,b.member_name as buyer,p.proposal_title as proposal')
			->from('proposals_referrals p_r')
			->join('member s', 's.member_id=p_r.seller_id', 'LEFT')
			->join('member r', 'r.member_id=p_r.referrer_id', 'LEFT')
			->join('member b', 'b.member_id=p_r.buyer_id', 'LEFT')
			->join('proposals p', 'p.proposal_id=p_r.proposal_id', 'LEFT');
		
		if(!empty($srch['show']) && $srch['show'] == 'trash'){
			$this->db->where('p_r.status', PROPOSAL_DELETED);	
		}else{
			$this->db->where('p_r.status <>', PROPOSAL_DELETED);	
		}
		
		/* if(!empty($srch['term'])){
			$this->db->like('p.proposal_title', $srch['term']);
		}
		 */
		 
		if($for_list){
			$result = $this->db->limit($offset, $limit)->order_by('p_r.referral_id', 'DESC')->get()->result_array();
		}else{
			$result = $this->db->get()->num_rows();
		}
		
		return $result;
	
	}
	public function get_all_sub_category($category_id=''){
		$admin_default_lang = admin_default_lang();
		$this->db->select('*')
			->from('category_subchild a')
			->join('category_subchild_names b', 'a.category_subchild_id=b.category_subchild_id');
			
		
		$this->db->where('a.category_subchild_status', ACTIVE_STATUS);	
		$this->db->where('a.category_id', $category_id);	
		$this->db->where('b.lang', $admin_default_lang);	
		$result = $this->db->get()->result_array();
		return $result;
	}
	public function getProposalDetails($proposal_id){
		$admin_default_lang = admin_default_lang();
		$data=array();
		$this->db->select('p.proposal_id,p.proposal_title,p.proposal_title_ar,p.proposal_url,p.delivery_time,p.proposal_price,p.display_price,p.proposal_date,p.proposal_status,p.proposal_image,p.proposal_seller_id')
		->from('proposals as p');
		$this->db->where('p.proposal_id',$proposal_id);	
		$data = $this->db->get()->row_array();

		$this->db->select('c.category_id,c.category_key,c_n.name as category_name,s_c.category_subchild_id,s_c.category_subchild_key,sc_n.name as category_subchild_name')
		->from('proposal_category as p_c')
		->join('category as c','p_c.category_id=c.category_id','left')
		->join('category_names as c_n',"(c.category_id=c_n.category_id and c_n.lang='".$admin_default_lang."')",'left')
		->join('category_subchild as s_c','p_c.category_subchild_id=s_c.category_subchild_id','left')
		->join('category_subchild_names as sc_n',"(s_c.category_subchild_id=sc_n.category_subchild_id and sc_n.lang='".$admin_default_lang."')",'left');
		$this->db->where('p_c.proposal_id',$proposal_id);		
		$proposal_category = $this->db->get()->row_array();
		$data['project_category']=$proposal_category;


		$this->db->select('p_a.proposal_video,p_a.proposal_description,p_a.buyer_instruction,p_a.proposal_description_ar,p_a.buyer_instruction_ar')
		->from('proposal_additional as p_a');
		$this->db->where(array('p_a.proposal_id'=>$proposal_id));
		$proposal_additional=$this->db->get()->row_array();
		$data['proposal_additional']=$proposal_additional;

		$this->db->select('p_t.tag_name,p_t.lang')->from('proposal_tags as p_t');
		$this->db->where(array('p_t.proposal_id'=>$proposal_id));
		$proposal_tags=$this->db->get()->result_array();
		$data['proposal_tags']=$proposal_tags;

		$this->db->select('p_s.proposal_referral_code,p_s.proposal_enable_referrals,p_s.proposal_referral_money,p_s.proposal_featured')
		->from('proposal_settings as p_s');
		$this->db->where(array('p_s.proposal_id'=>$proposal_id));
		$proposal_settings=$this->db->get()->row_array();
		$data['proposal_settings']=$proposal_settings;

		$this->db->select('f.file_id,f.original_name,f.server_name,f.file_ext')
		->from('proposal_files as p_f')
		->join('files as f','p_f.file_id=f.file_id','left');
		$this->db->where(array('p_f.proposal_id'=>$proposal_id));
		$proposal_files=$this->db->get()->result_array();
		$data['proposal_files']=$proposal_files;

		$this->db->select('p.package_id,p.package_name,p.price,p.description,p.description_ar,p.revisions,p.delivery_time')
		->from('proposal_packages as p');
		$this->db->where(array('p.proposal_id'=>$proposal_id));
		$proposal_packages=$this->db->get()->result();
		$data['proposal_packages']=$proposal_packages;

		$this->db->select('p.id,p.name,p.price')
		->from('proposal_extras as p');
		$this->db->where(array('p.proposal_id'=>$proposal_id));
		$proposal_extras=$this->db->get()->result();
		$data['proposal_extras']=$proposal_extras;

		return $data;
		
	}
	function getdeliverytimes($time=''){
		$admin_default_lang = admin_default_lang();
		$this->db->select('d.delivery_id,d_n.delivery_title,d_n.delivery_proposal_title')
		->from('delivery_times as d')
		->join('delivery_times_names as d_n',"d.deliverid=d_n.deliverid and d_n.lang='".$admin_default_lang."'",'left');
		$this->db->where(array('d.status'=>1));
		$this->db->order_by('d.display_order','asc');
		$this->db->order_by('d.delivery_id','asc');
		if($time){
			$this->db->where('d.delivery_id',$time);
			$deliverytimes=$this->db->get()->row_array();
		}else{
			$deliverytimes=$this->db->get()->result_array();
		}
		return $deliverytimes;
			
	}
	
}


