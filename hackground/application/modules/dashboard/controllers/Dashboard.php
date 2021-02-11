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
		/* $this->data['active_orders_count'] = $this->dashboard->get_active_order_count();
		$this->data['support_request_count'] = $this->dashboard->get_support_request_count();
		$this->data['pending_approval_count'] = $this->dashboard->get_pending_approval_count();
		$this->data['pending__request_approval_count'] = $this->dashboard->get_request_pending_approval_count();
		$this->data['unread_notification_count'] = $this->dashboard->get_unread_notification_count();
		$this->data['withdrawn_request_count'] = $this->dashboard->get_withdrawn_count();
		$this->data['users_count'] = $this->dashboard->get_user_count(); */
		$this->data['main_title'] = 'Dashboard';
		//$this->data['second_title'] = 'Dashboard';
		//$this->data['title'] = 'Notification';
		
		$breadcrumb = array(
			array(
				'name' => 'Dashboard',
				'path' => '',
			),
		);
		$this->data['breadcrumb'] = breadcrumb($breadcrumb);
		$this->layout->view('dashboard_static', $this->data);
       
	}
	
	public function icons(){
		$this->layout->view('icons');
	}
	
	public function icons_ajax(){
		$this->load->view('icon_ajax');
	}

}


