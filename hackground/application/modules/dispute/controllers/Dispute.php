<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dispute extends MX_Controller {
   
   private $data;
   
	public function __construct(){
		$this->data['curr_controller'] = $this->router->fetch_class()."/";
		$this->data['curr_method'] = $this->router->fetch_method()."/";
		$this->load->model('dispute_model', 'dispute');
		
		parent::__construct();
		
		admin_log_check();
	}
	public function index(){
		redirect(base_url($this->data['curr_controller'].'list_record'));
	}
	public function list_record(){
		$srch = get();
		$curr_limit = get('per_page');
		$limit = !empty($curr_limit) ? $curr_limit : 0; 
		$offset = 20;
		$this->data['main_title'] = 'Dispute Management';
		$this->data['second_title'] = 'All Dispute List';
		$this->data['title'] = 'Dispute';
		$breadcrumb = array(
			array(
				'name' => 'Dispute',
				'path' => '',
			),
		);
		$this->data['breadcrumb'] = breadcrumb($breadcrumb);
		$this->data['list'] = $this->dispute->getDispute($srch, $limit, $offset);
		$this->data['list_total'] = $this->dispute->getDispute($srch, $limit, $offset, FALSE);
		
		$this->load->library('pagination');
		$config['base_url'] = base_url($this->data['curr_controller'].'list_record');
		$config['total_rows'] =$this->data['list_total'];
		$config['per_page'] = $offset;
		$config['page_query_string'] = TRUE;
		$config['reuse_query_string'] = TRUE;
		
		$this->pagination->initialize($config);
		
		$this->data['links'] = $this->pagination->create_links();
		$this->data['add_command'] = null;
		$this->data['edit_command'] = null;
		/* get_print($this->data['list']); */
		$this->layout->view('list', $this->data);
		
	}
	public function details($contract_milestone_id=''){
		
		$this->data['main_title'] = 'Offer';
		$this->data['second_title'] = 'Offer';
		$this->data['title'] = 'Offer';
		$breadcrumb = array(
			array(
				'name' => 'Offers',
				'path' => base_url('offers/list_record'),
			),
			
			array(
				'name' => 'Offer Detail',
				'path' => '',
			),
		);
		$this->data['breadcrumb'] = breadcrumb($breadcrumb);
		$this->data['contractDetails'] = getData(array(
			'select'=>'p.project_id,p.project_url,c.contract_id,c.contract_title,o.member_id as owner_id,c.contractor_id,m.contract_milestone_id,m.milestone_title,m.milestone_amount,m.is_approved,m.milestone_due_date,m.approved_date,m.is_escrow,d.project_contract_dispute_id,d.dispute_status,d.project_contract_dispute_id,d.dispute_date,d.commission_amount,d.owner_amount,d.contractor_amount',
			'table'=>'project_contract_milestone m',
			'join'=>array(
				array('table'=>'project_contract c', 'on'=>'m.contract_id=c.contract_id', 'position'=>'left'),
				array('table'=>'project p', 'on'=>'c.project_id=p.project_id', 'position'=>'left'),
				array('table'=>'project_owner o', 'on'=>'p.project_id=o.project_id', 'position'=>'left'),
				array('table'=>'project_contract_dispute as d','on'=>'m.contract_milestone_id=d.contract_milestone_id','position'=>'left'),
			),
			'where'=>array('m.contract_milestone_id'=>$contract_milestone_id,'c.contract_status'=>1,'d.project_contract_dispute_id >'=>0),
			'single_row'=>TRUE
			));
			if($this->data['contractDetails']){
				$this->data['site_fee_percent']=getSiteCommissionFee($this->data['contractDetails']->contractor_id);
				$this->data['site_fee_amount']= displayamount(($this->data['contractDetails']->milestone_amount*$this->data['site_fee_percent'])/100,2);
				$this->data['remain_amount']=displayamount($this->data['contractDetails']->milestone_amount,2)-displayamount($this->data['site_fee_amount'],2);
				$contract_dispute_id=$this->data['contractDetails']->project_contract_dispute_id;
				$contract_milestone_id=$this->data['contractDetails']->contract_milestone_id;
				$contract_id=$this->data['contractDetails']->contract_id;
				$project_id=$this->data['contractDetails']->project_id;
				
				
				$owner=getProjectDetails($project_id,array('project_owner'));
				$this->data['contractDetails']->owner=$owner['project_owner'];
				$this->data['contractDetails']->contractor=getData(array(
					'select'=>'m.member_id,m.member_name',
					'table'=>'member m',
					'where'=>array('m.member_id'=>$this->data['contractDetails']->contractor_id),
					'single_row'=>true
				));
				
				$this->data['contractDetails']->owner->statistics=getData(array(
					'select'=>'m_s.avg_rating,m_s.no_of_reviews,m_s.total_spent',
					'table'=>'member_statistics as m_s',
					'where'=>array('m_s.member_id'=>$owner['project_owner']->member_id),
					'single_row'=>TRUE
				));
				
				$this->data['contractDetails']->contractor=getData(array(
					'select'=>'m.member_id,m.member_name,mb.member_heading,ms.avg_rating',
					'table'=>'member m',
					'join'=>array(
						array('table'=>'member_basic as mb','on'=>'m.member_id=mb.member_id','position'=>'left'),
						array('table'=>'member_statistics as ms','on'=>'m.member_id=ms.member_id','position'=>'left')
					),
					'where'=>array('m.member_id'=>$this->data['contractDetails']->contractor_id),
					'single_row'=>true
				));	
				
				$this->data['is_owner']=1;
				$is_valid=FALSE;
				
				
				$this->data['contractDetails']->submission=getData(array(
					'select'=>'s.submission_id,s.contract_milestone_id,s.submission_description,s.submission_attachment,s.submission_date,s.is_approved,s.commission_amount,s.owner_amount,s.contractor_amount,s.submitted_by as sender_id,m.member_name as sender_name',
					'table'=>'project_contract_dispute_submission s',
					'join'=>array(
						array('table'=>'member as m','on'=>'m.member_id=s.submitted_by','position'=>'left'),
					),
					'where'=>array('s.contract_milestone_id'=>$contract_milestone_id,'s.project_contract_dispute_id'=>$contract_dispute_id),
					'order'=>array(array('s.submission_id','desc'))
				));
				
				
			}
		$this->layout->view('dispute-details', $this->data);
	}
	public function message($contract_milestone_id=''){
		
		$this->data['main_title'] = 'Offer';
		$this->data['second_title'] = 'Offer';
		$this->data['title'] = 'Offer';
		$breadcrumb = array(
			array(
				'name' => 'Offers',
				'path' => base_url('offers/list_record'),
			),
			
			array(
				'name' => 'Offer Detail',
				'path' => '',
			),
		);
		$this->data['breadcrumb'] = breadcrumb($breadcrumb);
		$this->data['contractDetails'] = getData(array(
			'select'=>'p.project_id,p.project_url,c.contract_id,c.contract_title,o.member_id as owner_id,c.contractor_id,m.contract_milestone_id,m.milestone_title,m.milestone_amount,m.is_approved,m.milestone_due_date,m.approved_date,m.is_escrow,d.project_contract_dispute_id,d.dispute_status,d.project_contract_dispute_id,d.dispute_date,d.commission_amount,d.owner_amount,d.contractor_amount',
			'table'=>'project_contract_milestone m',
			'join'=>array(
				array('table'=>'project_contract c', 'on'=>'m.contract_id=c.contract_id', 'position'=>'left'),
				array('table'=>'project p', 'on'=>'c.project_id=p.project_id', 'position'=>'left'),
				array('table'=>'project_owner o', 'on'=>'p.project_id=o.project_id', 'position'=>'left'),
				array('table'=>'project_contract_dispute as d','on'=>'m.contract_milestone_id=d.contract_milestone_id','position'=>'left'),
			),
			'where'=>array('m.contract_milestone_id'=>$contract_milestone_id,'c.contract_status'=>1,'d.project_contract_dispute_id >'=>0),
			'single_row'=>TRUE
			));
			if($this->data['contractDetails']){
				$this->data['is_owner']=true;
				$freelancer_id=$this->data['contractDetails']->contractor_id;
				$owner_id=$this->data['contractDetails']->owner_id;
				$project_id=$this->data['contractDetails']->project_id;
				$member_ids=array($freelancer_id,$owner_id);
				$this->load->model('message/message_model','message');
				$this->data['conversation_details']=new stdClass();
				$room_id=$this->message->getConversationID($project_id,$member_ids,1);
				$this->data['conversation_details']->conversations_id=$room_id;
				$this->data['conversation_details']->group=$this->db->select('m.member_name,r.user_id')->from('conversations_room as r')->join('member as m','r.user_id=m.member_id','left')->where('r.conversations_id',$room_id)->get()->result();
				if(!$this->data['conversation_details']->group){
					show_404(); return;
				}
				$this->data['conversation_details']->conversations=$this->message->getMessageChatList($room_id);
				
		
				
				
			}
		$this->layout->view('dispute-message', $this->data);
	}
	
	
	
	
	
	
}





