<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller {
   
   private $data;
   
	public function __construct(){
		$this->data['curr_controller'] = $this->router->fetch_class()."/";
		$this->data['curr_method'] = $this->router->fetch_method()."/";
		$this->load->model('dashboard_model', 'dashboard');
		parent::__construct();
		
		admin_log_check();
	}

	public function index(){
		$this->data['project_count'] = $this->dashboard->get_project_count();
		$this->data['contract_count'] = $this->dashboard->get_contract_count();
		$this->data['unread_notification_count'] = $this->dashboard->get_unread_notification_count();
		$this->data['withdrawn_request_count'] = $this->dashboard->get_withdrawn_count();
		$this->data['users_count'] = $this->dashboard->get_user_count();
		
		$this->data['statics']['project'] = $this->dashboard->project_statics();
		$this->data['statics']['member'] = $this->dashboard->member_statics();
		//get_print($this->data['statics']['member']);
		$this->layout->view('dashboard', $this->data);
       
	}
	
	public function icons(){
		$this->layout->view('icons');
	}
	
	public function icons_ajax(){
		$this->load->view('icon_ajax');
	}
	
	public function dashboard_static(){
		$this->layout->view('dashboard_static', $this->data);
	}

}


