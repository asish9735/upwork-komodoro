<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Offers extends MX_Controller {
   
   private $data;
   
	public function __construct(){
		$this->data['curr_controller'] = $this->router->fetch_class()."/";
		$this->data['curr_method'] = $this->router->fetch_method()."/";
		$this->load->model('offer_model', 'offer');
		$this->data['table'] = 'project_contract';
		$this->data['primary_key'] = 'contract_id';
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
		$this->data['main_title'] = 'Application Offers';
		$this->data['second_title'] = 'All Offers List';
		$this->data['title'] = 'Offers';
		$breadcrumb = array(
			array(
				'name' => 'Offers',
				'path' => '',
			),
		);
		$this->data['breadcrumb'] = breadcrumb($breadcrumb);
		$this->data['list'] = $this->offer->getList($srch, $limit, $offset);
		$this->data['list_total'] = $this->offer->getList($srch, $limit, $offset, FALSE);
		
		$this->load->library('pagination');
		$config['base_url'] = base_url($this->data['curr_controller'].'list_record');
		$config['total_rows'] =$this->data['list_total'];
		$config['per_page'] = $offset;
		$config['page_query_string'] = TRUE;
		$config['reuse_query_string'] = TRUE;
		
		$this->pagination->initialize($config);
		
		$this->data['links'] = $this->pagination->create_links();
		$this->data['add_command'] = 'add';
		$this->data['edit_command'] = 'edit';
		$this->layout->view('list', $this->data);
       
	}
	
	public function contracts(){
		$srch = get();
		$curr_limit = get('per_page');
		$limit = !empty($curr_limit) ? $curr_limit : 0; 
		$offset = 20;
		$this->data['main_title'] = 'Contracts';
		$this->data['second_title'] = 'All Contracts List';
		$this->data['title'] = 'Contracts';
		$breadcrumb = array(
			array(
				'name' => 'Contracts',
				'path' => '',
			),
		);
		$this->data['breadcrumb'] = breadcrumb($breadcrumb);
		$srch['status'] = 1; // filter active offers/contracts
		$this->data['list'] = $this->offer->getList($srch, $limit, $offset);
		$this->data['list_total'] = $this->offer->getList($srch, $limit, $offset, FALSE);
		
		$this->load->library('pagination');
		$config['base_url'] = base_url($this->data['curr_controller'].'contracts');
		$config['total_rows'] =$this->data['list_total'];
		$config['per_page'] = $offset;
		$config['page_query_string'] = TRUE;
		$config['reuse_query_string'] = TRUE;
		
		$this->pagination->initialize($config);
		
		$this->data['links'] = $this->pagination->create_links();
		$this->data['add_command'] = 'add';
		$this->data['edit_command'] = 'edit';
		$this->layout->view('contracts', $this->data);
       
	}
	
	public function milestone(){
		$srch = get();
		$curr_limit = get('per_page');
		$limit = !empty($curr_limit) ? $curr_limit : 0; 
		$offset = 20;
		$this->data['main_title'] = 'Milestones';
		$this->data['second_title'] = 'All Milestones List';
		$this->data['title'] = 'Milestones';
		$breadcrumb = array(
			array(
				'name' => 'Milestones',
				'path' => '',
			),
		);
		$this->data['breadcrumb'] = breadcrumb($breadcrumb);
		
		$this->data['list'] = $this->offer->getMilestones($srch, $limit, $offset);
		$this->data['list_total'] = $this->offer->getMilestones($srch, $limit, $offset, FALSE);
		
		$this->load->library('pagination');
		$config['base_url'] = base_url($this->data['curr_controller'].'milestone');
		$config['total_rows'] =$this->data['list_total'];
		$config['per_page'] = $offset;
		$config['page_query_string'] = TRUE;
		$config['reuse_query_string'] = TRUE;
		
		$this->pagination->initialize($config);
		
		$this->data['links'] = $this->pagination->create_links();
		$this->data['add_command'] = null;
		$this->data['edit_command'] = null;
		$this->layout->view('milestone', $this->data);
       
	}
	
	public function load_ajax_page(){
		$page = get('page');
		$this->data['page'] = $page;
		if($page == 'add'){
			$this->data['title'] = 'Add Test Three';
			$this->data['form_action'] = base_url($this->data['curr_controller'].'add');
		}else if($page == 'edit'){
			$id = get('id');
			$this->data['ID']= $id;
			$this->data['form_action'] = base_url($this->data['curr_controller'].'edit');
			$this->data['detail'] = $this->offer->getDetail($id);
			$this->data['title'] = 'Edit Test Three';
		}
		$this->load->view('ajax_page', $this->data);
	}
	
	public function add(){
		if(post() && $this->input->is_ajax_request()){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'name', 'required|trim|max_length[100]');
			$this->form_validation->set_rules('status', 'status', '');
			if($this->form_validation->run()){
				$post = post();
				$insert = $this->offer->addRecord($post);
				if(post('add_more') && post('add_more') == '1'){
					$this->api->cmd('reset_form');
				}else{
					$this->api->cmd('reload');
				}
				
			}else{
				$errors = validation_errors_array();
				$this->api->set_error($errors);
			}
			
		}else{
			$this->api->set_error('invalid_request', 'Invalid Request');
		}
		
		$this->api->out();
	}
	
	public function edit(){
		if(post() && $this->input->is_ajax_request()){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'name', 'required|trim|max_length[100]');
			$this->form_validation->set_rules('status', 'status', '');
			$this->form_validation->set_rules('ID', 'id', 'required');
			if($this->form_validation->run()){
				$post = post();
				$ID = post('ID');
				unset($post['ID']);
				$update = $this->offer->updateRecord($post, $ID);
				$this->api->cmd('reload');
			}else{
				$errors = validation_errors_array();
				$this->api->set_error($errors);
			}
			
		}else{
			$this->api->set_error('invalid_request', 'Invalid Request');
		}
		
		$this->api->out();
	}
	
	public function change_status(){
		if(post() && $this->input->is_ajax_request()){
			
			$ID = post('ID');
			$sts = post('status');
			$action_type = post('action_type');
			
			if(is_array($ID)){
				$this->db->where_in($this->data['primary_key'], $ID)->update($this->data['table'], array('status' => $sts));
			}else{
				$upd['data'] = array('status' => $sts);
				$upd['where'] = array($this->data['primary_key'] => $ID);
				$upd['table'] = $this->data['table'];
				update($upd);
				
			}
			
			if($action_type == 'multiple'){
				$this->api->cmd('reload');
			}else{
				
				$html = '';
				if($sts == ACTIVE_STATUS){
					$html = '<a href="'.JS_VOID.'"  data-toggle="tooltip" title="Make inactive" onclick="changeStatus(0, '.$ID.', this)"><span class="badge badge-success">Active</span></a>';
				}else{
					$html = '<a href="'.JS_VOID.'" data-toggle="tooltip" title="Make active"  onclick="changeStatus(1, '.$ID.', this)"><span class="badge badge-danger">Inactive</span></a>';
				}
			
			
				$this->api->data('html', $html);
				$this->api->cmd('replace');
			}
			
			
		}else{
			$this->api->set_error('invalid_request', 'Invalid Request');
		}
		
		$this->api->out();
	}
	
	public function delete_record($id=''){
		$action_type = post('action_type');
		if($action_type == 'multiple'){
			$id = post('ID');
		}
		if($id){
			$this->offer->deleteRecord($id);
			$cmd = get('cmd');
			if($cmd && $cmd == 'remove'){
				if($id && is_array($id)){
					$this->db->where_in($this->data['primary_key'] ,  $id)->delete($this->data['table']);
				}else{
					$this->db->where($this->data['primary_key'] ,  $id)->delete($this->data['table']);
				}
				
			}
			$this->api->cmd('reload');
		}else{
			$this->api->set_error('invalid_request', 'Invalid Request');
		}
		$this->api->out();
	}
	
	public function offer_detail($contract_id_enc=''){
		
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
			
			
		$this->data['contractDetails'] = get_contract_details($contract_id_enc,array('data_from'=>'offer'));
		if($this->data['contractDetails']){
			$contract_id=$this->data['contractDetails']->contract_id;
			$project_id=$this->data['contractDetails']->project_id;
			$this->data['contractDetails']->milestone=getData(array(
				'select'=>'m.contract_milestone_id,m.milestone_title,m.milestone_amount,m.milestone_amount,m.milestone_due_date,m.is_approved,m.approved_date',
				'table'=>'project_contract_milestone m',
				'where'=>array('m.contract_id'=>$contract_id),
			));
			$owner=getProjectDetails($project_id,array('project_owner'));
			$this->data['contractDetails']->owner=$owner['project_owner'];
			$this->data['contractDetails']->contractor=getData(array(
				'select'=>'m.member_id,m.member_name',
				'table'=>'member m',
				'where'=>array('m.member_id'=>$this->data['contractDetails']->contractor_id),
				'single_row'=>true
			));
			
			$this->data['current_member']=0;
			$this->data['is_owner']=0;
			
		}else{
			redirect(get_link('dashboardURL'));
		}
		$this->layout->view('offer-details', $this->data);
		
	}
	
	/* contract detail section */
	
	/* fixed */
	public function contract_details($contract_id_enc=''){
		
		$this->data['main_title'] = 'Contract Detail';
		$this->data['second_title'] = 'Contract Detail';
		$this->data['title'] = 'Contract Detail';
		$breadcrumb = array(
			array(
				'name' => 'Contract',
				'path' => base_url('offers/contracts'),
			),
			
			array(
				'name' => 'Contract Detail',
				'path' => '',
			),
		);
		$this->data['breadcrumb'] = breadcrumb($breadcrumb);
			
		$this->load->model('offers/contract_model');	
		$this->data['contractDetails'] = get_contract_details($contract_id_enc,array('data_from'=>'contract_details'));
		if($this->data['contractDetails']){
			if($this->data['contractDetails']->contract_status!=1){
				
				redirect(base_url('offer/offer_detail/'.$contract_id_enc));
			}elseif($this->data['contractDetails']->is_hourly==1){
				//redirect(base_url('offer/contract_work/'.$contract_id_enc));
			}
			$contract_id=$this->data['contractDetails']->contract_id;
			$project_id=$this->data['contractDetails']->project_id;
			$this->data['contractDetails']->milestone=getData(array(
				'select'=>'m.contract_milestone_id,m.milestone_title,m.milestone_amount,m.milestone_amount,m.milestone_due_date,m.is_approved,m.approved_date',
				'table'=>'project_contract_milestone m',
				'where'=>array('m.contract_id'=>$contract_id),
			));
			$owner=getProjectDetails($project_id,array('project_owner'));
			$this->data['contractDetails']->owner=$owner['project_owner'];
			$this->data['contractDetails']->contractor=getData(array(
				'select'=>'m.member_id,m.member_name',
				'table'=>'member m',
				'where'=>array('m.member_id'=>$this->data['contractDetails']->contractor_id),
				'single_row'=>true
			));
			$this->data['contractDetails']->in_escrow=$this->contract_model->getEscrowAmount($project_id,$contract_id);
			$this->data['contractDetails']->milestone_paid=$this->contract_model->getMilestonePaid($project_id,$contract_id);
			$this->data['contractDetails']->balance_remain=$this->data['contractDetails']->contract_amount-$this->data['contractDetails']->milestone_paid;
			
			$this->data['is_owner']=0;
			$this->data['pending_contract']=$this->db->where('contract_id',$contract_id)->where('is_approved <>',1)->from('project_contract_milestone')->count_all_results();
			$this->data['reviews']=get_contract_view($contract_id,$owner['project_owner']->member_id);

			$this->layout->view('contract/contract-details', $this->data);
		}
		
	}
	
	public function message($contract_id_enc='')
	{
		if($this->loggedUser){
			$this->load->model('contract_model');
			$this->layout->set_js(array(
				'utils/helper.js',
				'bootbox_custom.js',
				'mycustom.js',
			));
			if($this->access_member_type=='F'){
				//$this->data['left_panel']=$this->layout->view('inc/freelancer-setting-left',$this->data,TRUE,TRUE);
			}else{
				//$this->data['left_panel']=$this->layout->view('inc/client-setting-left',$this->data,TRUE,TRUE);
			}
			$this->data['contractDetails'] = get_contract_details($contract_id_enc,array('data_from'=>'contract_message','member_id'=>$this->member_id));
			if($this->data['contractDetails']){
				if($this->data['contractDetails']->contract_status!=1){
					redirect(get_link('OfferDetails').'/'.$contract_id_enc);
				}
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
				
				
				$this->data['is_owner']=0;
				if($owner['project_owner']->member_id==$this->member_id){
					$this->data['is_owner']=1;
				}
			}else{
				redirect(get_link('dashboardURL'));
			}
			
			
			if($this->data['is_owner']){
				$receiver_id=$this->data['contractDetails']->contractor_id;
			}else{
				$receiver_id=$owner['project_owner']->member_id;
			}
			$member_ids=array($this->member_id,$receiver_id);
			/* Message section */
			$this->load->model('message/message_model');
			$selected_conversation_id=$this->message_model->getConversationID($project_id,$member_ids,1);
			$this->data['login_member'] = $this->message_model->getMessageUser($this->member_id);
			//$selected_conversation_id = 3;
			if($selected_conversation_id){
				$this->data['active_chat'] = $this->message_model->getConversationUserById($selected_conversation_id, $this->member_id);
			}else{
				$this->data['active_chat'] = null;
			}
			
			$this->layout->view('contract/contract-message', $this->data);
		}
	}
	
	public function contract_term($contract_id_enc=''){
		$this->data['main_title'] = 'Contract Term';
		$this->data['second_title'] = 'Contract Term';
		$this->data['title'] = 'Contract Term';
		$breadcrumb = array(
			array(
				'name' => 'Contract',
				'path' => base_url('offers/contracts'),
			),
			
			array(
				'name' => 'Contract Term',
				'path' => '',
			),
		);
		$this->data['breadcrumb'] = breadcrumb($breadcrumb);
		
	
			
		$this->data['contractDetails'] = get_contract_details($contract_id_enc,array('data_from'=>'contract_term'));
		if($this->data['contractDetails']){
			if($this->data['contractDetails']->contract_status!=1){
				redirect(base_url('offer/offer_detail/'.$contract_id_enc));
			}
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
			
			
			$this->data['is_owner']=0;
			$this->data['pending_contract']=$this->db->where('contract_id',$contract_id)->where('is_approved <>',1)->from('project_contract_milestone')->count_all_results();
			$this->data['reviews']=get_contract_view($contract_id,$owner['project_owner']->member_id);
			$this->layout->view('contract/contract-term', $this->data);
		}
		
	}
	
	/* hourly [workroom] */
	
}





