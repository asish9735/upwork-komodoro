<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends MX_Controller {
	
	private $data;
	function __construct(){
		$this->loggedUser=$this->session->userdata('loggedUser');
		$this->access_member_type='';
		if($this->loggedUser){
			$this->access_user_id=$this->loggedUser['LID'];	
			$this->access_member_type=$this->loggedUser['ACC_P_TYP'];
			$this->member_id=$this->loggedUser['MID'];
			$this->organization_id=$this->loggedUser['OID'];
		}else{
			redirect(URL::get_link('loginURL').'?ref=dashboardURL');
		}
		$this->data['curr_class'] = $this->router->fetch_class();
		$this->data['curr_method'] = $this->router->fetch_method();
		parent::__construct();
	}
	
	public function index(){
		$this->layout->set_js(array(
			'utils/helper.js',
			'bootbox_custom.js',
			'mycustom.js',
		));
		
		if($this->access_member_type=='F'){
			$this->data['left_panel']=$this->layout->view('inc/freelancer-setting-left',$this->data,TRUE,TRUE);
		}else{
			
			$this->data['left_panel']=$this->layout->view('inc/client-setting-left',$this->data,TRUE,TRUE);
		}
		
		
		//$this->layout->view('message', $this->data);
	}
	
	public function notification_list_htm(){
		$data=array();
		$get = get();

		$limit = !empty($get['per_page']) ? $get['per_page'] : 0;
		$offset = 10;
		$next_limit = $limit + $offset;
		
		$data['notification_list'] = $this->notification_model->getNotificationList($this->member_id,$limit, $offset);
		$data['notification_list_count'] = $this->notification_model->getNotificationList($this->member_id,'','', FALSE);
		$json['notification_list'] = $data['notification_list'];
		$json['notification_list_count'] = $data['notification_list_count'];
		
		if($data['notification_list_count'] > $next_limit){
			$json['next'] = base_url('notification/notification_list_htm?per_page='.$next_limit);
		}else{
			$json['next'] = null;
		}
		$json['html'] = $this->layout->view('notification_list_htm',$data, TRUE, TRUE);
		
		$json['status'] = 1;
		$this->_reset_seen_notification($this->member_id);
		echo json_encode($json);
	}
	
	private function _reset_seen_notification(){
		$member_id = $this->member_id;
		$this->notification_model->notify_unset($member_id);
	}
	
	public function seen(){
		$ID = get('id');
		$link = get('link');
		$this->db->where('notification_id', $ID)->update('member_notifications', array('read_status' => 1));
		if($link){
			$next = base_url(urldecode($link));
		}else{
			$next = base_url();
		}
		redirect($next);
	}
	
}
