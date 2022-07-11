<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends MX_Controller {
	private $data;
	function __construct()
	{
		$this->loggedUser=$this->session->userdata('loggedUser');
		$this->access_member_type='C';
		if($this->loggedUser){
			$this->access_member_id=$this->loggedUser['LID'];	
			$this->access_member_type=$this->loggedUser['ACC_P_TYP'];
			$this->member_id=$this->loggedUser['MID'];
			$this->organization_id=$this->loggedUser['OID'];
		}elseif($this->router->fetch_method()=='invoice'){
			redirect(get_link('OrderInvoiceURL'));
		}elseif($this->router->fetch_method()=='manage'){
			redirect(get_link('OrderListURL'));
		}elseif($this->router->fetch_method()=='order_details'){
			
		}else{
			redirect(get_link('loginURL'));
		}
		$this->load->model('order_model');
		$this->data['curr_class'] = $this->router->fetch_class();
		$this->data['curr_method'] = $this->router->fetch_method();
		$this->lang = get_active_lang();
			parent::__construct();
	}
	public function manage(){
		if($this->access_member_type=='F'){
			$this->data['left_panel']=$this->layout->view('inc/freelancer-setting-left',$this->data,TRUE,TRUE);
		}else{
			$this->data['left_panel']=$this->layout->view('inc/client-setting-left',$this->data,TRUE,TRUE);
		}
        $this->load->library('pagination');
        $this->data['srch_url'] = uri_string();
        $this->data['srch_param'] = $this->data['srch_string'] = $this->input->get();

        $this->data['offset'] = 20;
        $this->data['limit'] = !empty($this->data['srch_param']['per_page']) ? $this->data['srch_param']['per_page'] : 0;
        $this->data['srch_string'] = !empty($this->data['srch_string']) ? $this->data['srch_string'] : array();
        $this->data['srch_param']['member_id'] =$this->member_id;
        unset($this->data['srch_string']['per_page']);
        unset($this->data['srch_string']['total']);
    
        $this->data['orders'] = $this->order_model->manage_orders($this->data['srch_param'] , $this->data['limit'] , $this->data['offset']);
        $this->data['total_orders'] = $this->order_model->manage_orders($this->data['srch_param'] , $this->data['limit'] , $this->data['offset'] , FALSE);
        
       
    
        $config['base_url'] = get_link('OrderListURL').'?total=10';
            
        $config['base_url'] .= !empty($this->data['srch_string']) ? '&'.http_build_query($this->data['srch_string']) : '';
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->data['total_orders'];
        $config['per_page'] = $this->data['offset'];
        
        $config['full_tag_open'] = '<div class="pagination-container margin-top-60 margin-bottom-60"><nav class="pagination"><ul>';
		$config['full_tag_close'] = '</ul></nav></div>';
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="waves-effect">';
		$config['first_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li class="waves-effect">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li><a class='current-page' href='javascript:void(0)'>";
		$config['cur_tag_close'] = '</a></li>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = "<li class='last waves-effect'>";
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = '<i class="icon-material-outline-keyboard-arrow-right"></i>';
		$config['next_tag_open'] = '<li class="waves-effect">';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '<i class="icon-material-outline-keyboard-arrow-left"></i>';
		$config['prev_tag_open'] = '<li class="waves-effect">';
		$config['prev_tag_close'] = '</li>'; 
        $this->pagination->initialize($config);
        $this->data['links'] = $this->pagination->create_links();
        $this->layout->view('manage-orders',$this->data);

	}  
	
	
	public function order_details($enc_order_id){
		if(!$this->loggedUser){
			redirect(URL::get_link('loginURL').'?ref='.$this->config->item('OrderDetailsURL')."/".$enc_order_id);
		}
		$this->layout->set_js(array('mycustom.js','jquery.barrating.min.js','bootbox_custom.js'));
		$this->layout->set_css(array('fontawesome-stars.css'));
		$this->data['loggedUser']=$this->loggedUser;
		$arr=array(
			'select'=>'o.order_id,o.order_number,o.delivery_time,o.order_date,o.delivery_date,o.seller_id,o.buyer_id,o.proposal_id,o.order_price,o.order_qty,o.order_fee,o.order_active,o.complete_time,o.order_status,o.payment_method,o.transaction_id,p.proposal_image,p.proposal_title,p.proposal_url,pkg.package_name,p_a.buyer_instruction',
			'table'=>'orders as o',
			'join'=>array(
				array('table'=>'proposals as p','on'=>'o.proposal_id=p.proposal_id','position'=>'left'),
				array('table'=>'proposal_additional as p_a','on'=>'o.proposal_id=p_a.proposal_id','position'=>'left'),
				array('table'=>'proposal_packages as pkg','on'=>'(o.proposal_id=pkg.proposal_id and o.package_id=pkg.package_id)','position'=>'left'),
			),
			'where'=>array('md5(o.order_id)'=>$enc_order_id),
			'single_row'=>TRUE
		);
		$this->data['orderDetails']=getData($arr);
		if($this->data['orderDetails'] && ($this->data['orderDetails']->seller_id==$this->member_id || $this->data['orderDetails']->buyer_id==$this->member_id)){
			$this->data['loggedInUserId']=$this->member_id;
			$order_id=$this->data['orderDetails']->order_id;
			$this->data['orderDetails']->buyer=getData(array(
				'select'=>'m.member_id,m.member_name',
				'table'=>'member as m',
				'where'=>array('m.member_id'=>$this->data['orderDetails']->buyer_id),
				'single_row'=>TRUE
			));
			$this->data['orderDetails']->seller=getData(array(
				'select'=>'m.member_id,m.member_name',
				'table'=>'member as m',
				'where'=>array('m.member_id'=>$this->data['orderDetails']->seller_id),
				'single_row'=>TRUE
			));
			if($this->data['orderDetails']->order_status == ORDER_COMPLETED){
				$this->data['orderDetails']->seller_review=getData(array(
					'select'=>'r.seller_rating,r.seller_review,r.review_date',
					'table'=>'seller_reviews as r',
					'where'=>array('r.order_id'=>$order_id),
					'single_row'=>TRUE
				));
				$this->data['orderDetails']->buyer_review=getData(array(
					'select'=>'r.buyer_rating,r.buyer_review,r.review_date',
					'table'=>'buyer_reviews as r',
					'where'=>array('r.order_id'=>$order_id),
					'single_row'=>TRUE
				));
			}
			
		}else{
			redirect(get_link('homeURL'));
		}
		$this->layout->view('order-details', $this->data);
		
	}
	public function order_resolution_center($enc_order_id){
		if(!$this->loggedUser){
			redirect(URL::get_link('loginURL').'?ref='.$this->config->item('OrderDetailsURL')."/".$enc_order_id);
		}
		$this->layout->set_js(array('mycustom.js','jquery.barrating.min.js','bootbox_custom.js'));
		$this->layout->set_css(array('fontawesome-stars.css'));
		$this->data['loggedUser']=$this->loggedUser;
		$arr=array(
			'select'=>'o.order_id,o.order_number,o.delivery_time,o.order_date,o.delivery_date,o.seller_id,o.buyer_id,o.proposal_id,o.order_price,o.order_qty,o.order_fee,o.order_active,o.complete_time,o.order_status,o.payment_method,o.transaction_id,p.proposal_image,p.proposal_title,p.proposal_url,pkg.package_name,p_a.buyer_instruction',
			'table'=>'orders as o',
			'join'=>array(
				array('table'=>'proposals as p','on'=>'o.proposal_id=p.proposal_id','position'=>'left'),
				array('table'=>'proposal_additional as p_a','on'=>'o.proposal_id=p_a.proposal_id','position'=>'left'),
				array('table'=>'proposal_packages as pkg','on'=>'(o.proposal_id=pkg.proposal_id and o.package_id=pkg.package_id)','position'=>'left'),
			),
			'where'=>array('md5(o.order_id)'=>$enc_order_id),
			'single_row'=>TRUE
		);
		$this->data['orderDetails']=getData($arr);
		if($this->data['orderDetails'] && ($this->data['orderDetails']->seller_id==$this->member_id || $this->data['orderDetails']->buyer_id==$this->member_id)){
			$this->data['is_buyer']=0;
			if($this->data['orderDetails']->buyer_id==$this->member_id){
				$this->data['is_buyer']=1;
			}
			$this->data['loggedInUserId']=$this->member_id;
			$this->data['contractDetails']=$this->data['orderDetails'];
			$this->data['contractDetails']->buyer=getData(array(
				'select'=>'m.member_id,m.member_name,mb.member_heading,ms.avg_rating',
				'table'=>'member m',
				'join'=>array(
					array('table'=>'member_basic as mb','on'=>'m.member_id=mb.member_id','position'=>'left'),
					array('table'=>'member_statistics as ms','on'=>'m.member_id=ms.member_id','position'=>'left')
				),
				'where'=>array('m.member_id'=>$this->data['contractDetails']->buyer_id),
				'single_row'=>true
			));
			$organization_id=getField('organization_id', 'organization', 'member_id', $this->data['contractDetails']->buyer_id);
			$this->data['contractDetails']->buyer->organization_id=$organization_id;
			if($organization_id){
				$this->data['contractDetails']->buyer->organization_name=getField('organization_name', 'organization', 'organization_id', $organization_id);
			}

			$this->data['contractDetails']->seller=getData(array(
				'select'=>'m.member_id,m.member_name,mb.member_heading,ms.avg_rating',
				'table'=>'member m',
				'join'=>array(
					array('table'=>'member_basic as mb','on'=>'m.member_id=mb.member_id','position'=>'left'),
					array('table'=>'member_statistics as ms','on'=>'m.member_id=ms.member_id','position'=>'left')
				),
				'where'=>array('m.member_id'=>$this->data['contractDetails']->seller_id),
				'single_row'=>true
			));
			
			
			
			
		}else{
			redirect(get_link('homeURL'));
		}
		$this->layout->view('order-resolution-center', $this->data);
		
	}
	public function order_message($enc_order_id){
		if(!$this->loggedUser){
			redirect(URL::get_link('loginURL').'?ref='.$this->config->item('OrderDetailsURL')."/".$enc_order_id);
			exit;
		}
		$this->layout->set_js(array(
			'jquery.nicescroll.min.js',
			'utils/helper.js',
			'bootbox_custom.js',
			'mycustom.js',
		));
	
		$arr=array(
			'select'=>'o.order_id,o.order_number,o.delivery_time,o.order_date,o.delivery_date,o.seller_id,o.buyer_id,o.proposal_id,o.order_price,o.order_qty,o.order_fee,o.order_active,o.complete_time,o.order_status,o.payment_method,o.transaction_id,p.proposal_image,p.proposal_title,p.proposal_url,pkg.package_name,p_a.buyer_instruction',
			'table'=>'orders as o',
			'join'=>array(
				array('table'=>'proposals as p','on'=>'o.proposal_id=p.proposal_id','position'=>'left'),
				array('table'=>'proposal_additional as p_a','on'=>'o.proposal_id=p_a.proposal_id','position'=>'left'),
				array('table'=>'proposal_packages as pkg','on'=>'(o.proposal_id=pkg.proposal_id and o.package_id=pkg.package_id)','position'=>'left'),
			),
			'where'=>array('md5(o.order_id)'=>$enc_order_id),
			'single_row'=>TRUE
		);
		$this->data['orderDetails']=getData($arr);
		if($this->data['orderDetails'] && ($this->data['orderDetails']->seller_id==$this->member_id || $this->data['orderDetails']->buyer_id==$this->member_id)){

			$member_ids=array($this->data['orderDetails']->buyer_id,$this->data['orderDetails']->seller_id);
			/* Message section */
			$this->load->model('message/message_model');
			$selected_conversation_id=$this->message_model->getConversationIDProposal($this->data['orderDetails']->proposal_id,$member_ids,1);
			$this->data['login_member'] = $this->message_model->getMessageUser($this->member_id);
			//$selected_conversation_id = 3;
			if($selected_conversation_id){
				$this->data['active_chat'] = $this->message_model->getConversationUserById($selected_conversation_id, $this->member_id);
			}else{
				$this->data['active_chat'] = null;
			}
			$this->data['is_buyer']=0;
			if($this->data['orderDetails']->buyer_id==$this->member_id){
				$this->data['is_buyer']=1;
			}



			$this->data['contractDetails']=$this->data['orderDetails'];
			$this->data['contractDetails']->buyer=getData(array(
				'select'=>'m.member_id,m.member_name,mb.member_heading,ms.avg_rating',
				'table'=>'member m',
				'join'=>array(
					array('table'=>'member_basic as mb','on'=>'m.member_id=mb.member_id','position'=>'left'),
					array('table'=>'member_statistics as ms','on'=>'m.member_id=ms.member_id','position'=>'left')
				),
				'where'=>array('m.member_id'=>$this->data['contractDetails']->buyer_id),
				'single_row'=>true
			));
			$organization_id=getField('organization_id', 'organization', 'member_id', $this->data['contractDetails']->buyer_id);
			$this->data['contractDetails']->buyer->organization_id=$organization_id;
			if($organization_id){
				$this->data['contractDetails']->buyer->organization_name=getField('organization_name', 'organization', 'organization_id', $organization_id);
			}

			$this->data['contractDetails']->seller=getData(array(
				'select'=>'m.member_id,m.member_name,mb.member_heading,ms.avg_rating',
				'table'=>'member m',
				'join'=>array(
					array('table'=>'member_basic as mb','on'=>'m.member_id=mb.member_id','position'=>'left'),
					array('table'=>'member_statistics as ms','on'=>'m.member_id=ms.member_id','position'=>'left')
				),
				'where'=>array('m.member_id'=>$this->data['contractDetails']->seller_id),
				'single_row'=>true
			));
		}else{
			redirect(get_link('homeURL'));
		}
		$this->layout->view('order-message', $this->data);
		
	}
	public function order_term($enc_order_id){
		if(!$this->loggedUser){
			redirect(URL::get_link('loginURL').'?ref='.$this->config->item('OrderDetailsURL')."/".$enc_order_id);
		}
		$this->layout->set_js(array('mycustom.js','jquery.barrating.min.js','bootbox_custom.js'));
		$this->layout->set_css(array('fontawesome-stars.css'));
		$this->data['loggedUser']=$this->loggedUser;
		$arr=array(
			'select'=>'o.order_id,o.order_number,o.delivery_time,o.order_date,o.delivery_date,o.seller_id,o.buyer_id,o.proposal_id,o.order_price,o.order_qty,o.order_fee,o.order_active,o.complete_time,o.order_status,o.payment_method,o.transaction_id,p.proposal_image,p.proposal_title,p.proposal_url,pkg.package_name,p_a.buyer_instruction',
			'table'=>'orders as o',
			'join'=>array(
				array('table'=>'proposals as p','on'=>'o.proposal_id=p.proposal_id','position'=>'left'),
				array('table'=>'proposal_additional as p_a','on'=>'o.proposal_id=p_a.proposal_id','position'=>'left'),
				array('table'=>'proposal_packages as pkg','on'=>'(o.proposal_id=pkg.proposal_id and o.package_id=pkg.package_id)','position'=>'left'),
			),
			'where'=>array('md5(o.order_id)'=>$enc_order_id),
			'single_row'=>TRUE
		);
		$this->data['orderDetails']=getData($arr);
		if($this->data['orderDetails'] && ($this->data['orderDetails']->seller_id==$this->member_id || $this->data['orderDetails']->buyer_id==$this->member_id)){
			$this->data['is_buyer']=0;
			if($this->data['orderDetails']->buyer_id==$this->member_id){
				$this->data['is_buyer']=1;
			}
			$this->data['loggedInUserId']=$this->member_id;
			$this->data['contractDetails']=$this->data['orderDetails'];
			$this->data['contractDetails']->buyer=getData(array(
				'select'=>'m.member_id,m.member_name,mb.member_heading,ms.avg_rating',
				'table'=>'member m',
				'join'=>array(
					array('table'=>'member_basic as mb','on'=>'m.member_id=mb.member_id','position'=>'left'),
					array('table'=>'member_statistics as ms','on'=>'m.member_id=ms.member_id','position'=>'left')
				),
				'where'=>array('m.member_id'=>$this->data['contractDetails']->buyer_id),
				'single_row'=>true
			));
			$organization_id=getField('organization_id', 'organization', 'member_id', $this->data['contractDetails']->buyer_id);
			$this->data['contractDetails']->buyer->organization_id=$organization_id;
			if($organization_id){
				$this->data['contractDetails']->buyer->organization_name=getField('organization_name', 'organization', 'organization_id', $organization_id);
			}

			$this->data['contractDetails']->seller=getData(array(
				'select'=>'m.member_id,m.member_name,mb.member_heading,ms.avg_rating',
				'table'=>'member m',
				'join'=>array(
					array('table'=>'member_basic as mb','on'=>'m.member_id=mb.member_id','position'=>'left'),
					array('table'=>'member_statistics as ms','on'=>'m.member_id=ms.member_id','position'=>'left')
				),
				'where'=>array('m.member_id'=>$this->data['contractDetails']->seller_id),
				'single_row'=>true
			));
			$order_id=$this->data['orderDetails']->order_id;
			if($this->data['contractDetails']->order_status == ORDER_COMPLETED){
				$this->data['contractDetails']->seller_review=getData(array(
					'select'=>'r.seller_rating,r.seller_review,r.review_date',
					'table'=>'seller_reviews as r',
					'where'=>array('r.order_id'=>$order_id),
					'single_row'=>TRUE
				));
				$this->data['contractDetails']->buyer_review=getData(array(
					'select'=>'r.buyer_rating,r.buyer_review,r.review_date',
					'table'=>'buyer_reviews as r',
					'where'=>array('r.order_id'=>$order_id),
					'single_row'=>TRUE
				));
			}
			
			
			
		}else{
			redirect(get_link('homeURL'));
		}
		$this->layout->view('order-term', $this->data);
		
	}
	public function load_conversation(){
		checkrequestajax();
		$orderid=post('order_id');
		$this->data['orderDetails']=$orderdetails=getData(array(
				'select'=>'o.order_id,o.seller_id,o.buyer_id,o.order_status,o.complete_time',
				'table'=>'orders as o',
				'where'=>array('o.order_id'=>$orderid),
				'single_row'=>TRUE
			));
		if($orderdetails){
			$this->data['loggedUserID']=$this->member_id;
			$order_id=$orderdetails->order_id;
			if(in_array($this->member_id,array($orderdetails->seller_id,$orderdetails->buyer_id))){
				
				$this->data['orderDetails']->buyer=getData(array(
					'select'=>'m.member_id,m.member_name',
					'table'=>'member as m',
					'where'=>array('m.member_id'=>$this->data['orderDetails']->buyer_id),
					'single_row'=>TRUE
				));
				$this->data['orderDetails']->seller=getData(array(
					'select'=>'m.member_id,m.member_name',
					'table'=>'member as m',
					'where'=>array('m.member_id'=>$this->data['orderDetails']->seller_id),
					'single_row'=>TRUE
				));
				$this->data['orderconversations']=getData(array(
					'select'=>'o.sender_id,o.message,o.file,o.date,o.reason,o.type as status,m.member_name',
					'table'=>'orders_conversations as o',
					'join'=>array(
						array('table'=>'member as m','on'=>'o.sender_id=m.member_id','position'=>'left'),
					),
					'where'=>array('o.order_id'=>$order_id),
				));
				
				$this->layout->view('order-conversations', $this->data,true);
			}
		}
	}
	public function uploadattachment(){
		$config['upload_path']          = TMP_UPLOAD_PATH;
		$allowed = array('jpeg','jpg','gif','png','tif','avi','mpeg','mpg','mov','rm','3gp','flv','mp4', 'zip','rar','mp3','wav','pdf','docx','doc','txt','xls','xlsx');
		$config['allowed_types']        = implode('|',$allowed);
		$config['max_size']             = 1024*50;
		$config['file_name']            = md5($this->member_id.'-'.time());
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('fileinput'))
		{
			$msg['status']='FAIL';
			$msg['error']= $this->upload->display_errors();
		}
		else
		{
			$msg['status']='OK';
			$upload_data=$this->upload->data();
			$msg['upload_response']=array('file_name'=>$upload_data['file_name'],'original_name'=>$upload_data['client_name']);
		}
		echo json_encode($msg);
	}
	public function sendmessage(){
		$this->load->library('form_validation');
		checkrequestajax();
		$i=0;
		$msg=array();
		if($this->input->post()){
			$this->form_validation->set_rules('orderid', __('orders_form_orderid','orderid'), 'required|trim|xss_clean|numeric');
			$this->form_validation->set_rules('messagebox', __('orders_form_messagebox','message'), 'required|trim|xss_clean');
			if ($this->form_validation->run() == FALSE){
				$error=validation_errors_array();
				if($error){
					foreach($error as $key=>$val){
						$msg['status'] = 'FAIL';
		    			$msg['errors'][$i]['id'] = $key;
						$msg['errors'][$i]['message'] = $val;
		   				$i++;
					}
				}
			}else{
				$orderid=post('orderid');
				$orderdetails=getData(array(
						'select'=>'o.order_id,o.seller_id,o.buyer_id,o.order_status',
						'table'=>'orders as o',
						'where'=>array('o.order_id'=>$orderid),
						'single_row'=>TRUE
					));
				if($orderdetails){
					$order_id=$orderdetails->order_id;
					if(in_array($this->member_id,array($orderdetails->seller_id,$orderdetails->buyer_id))){
						
					}else{
						$msg['status'] = 'FAIL';
		    			$msg['errors'][$i]['id'] = 'orderid';
						$msg['errors'][$i]['message'] = 'Error in request';
		   				$i++;
					}
				}else{
					$msg['status'] = 'FAIL';
	    			$msg['errors'][$i]['id'] = 'orderid';
					$msg['errors'][$i]['message'] = 'invalid in request';
	   				$i++;
				}
				if($i==0){
					if($this->member_id==$orderdetails->buyer_id){
						if($orderdetails->order_status==ORDER_PENDING){
							updateTable('orders',array('order_status'=>ORDER_PROCESSING),array('order_id'=>$order_id));
							$msg['redirect'] = get_link('OrderDetailsURL').md5($order_id);
						}
						$receiver_id = $orderdetails->seller_id;
					}else{
						$receiver_id = $orderdetails->buyer_id;
					}
					$conversations=array(
						'order_id'=>$order_id,
						'sender_id'=>$this->member_id,
						'message'=>post('messagebox'),
						/*'file'=>post('message'),*/
						'date'=>date('Y-m-d H:i:s'),
						'reason'=>'',
						'type'=>'message',
					);
					if($this->input->post('attachment')){
						$attachment=post('attachment');
						$file_data=json_decode($attachment);
						if($file_data){
							if($file_data->file_name && file_exists(TMP_UPLOAD_PATH.$file_data->file_name)){
								rename(TMP_UPLOAD_PATH.$file_data->file_name, UPLOAD_PATH."orders-files/".$file_data->file_name);	
								$conversations['file']=$file_data->file_name;
							}
						}
					}
					$conversations_id=insert_record('orders_conversations',$conversations,TRUE);
					if($conversations_id){
						$template='order_message';
						$this->notification_model->log(
							$template, // template key
							array('OID'=>$order_id), // template data
							$this->config->item('OrderDetailsURL').md5($order_id), // link (without base_url)
							$receiver_id, // notification to,
							$this->member_id // notification_from
						);
					}
					$msg['status'] = 'OK';
				}
			}
			
		}
		unset($_POST);
		echo json_encode($msg);
	}
	public function saveAction($orderid){
		checkrequestajax();
		$this->load->library('form_validation');
		$i=0;
		$msg=array();
		if($this->input->post()){
			$action=post('action');
			$orderdetails=getData(array(
						'select'=>'o.order_id,o.seller_id,o.buyer_id,o.order_status,o.order_price,o.proposal_id',
						'table'=>'orders as o',
						'where'=>array('o.order_id'=>$orderid),
						'single_row'=>TRUE
					));
			if($orderdetails){
				$order_id=$orderdetails->order_id;
				if(in_array($this->member_id,array($orderdetails->seller_id,$orderdetails->buyer_id))){
					if($action=='submit_delivered'){
						$this->form_validation->set_rules('delivered_message', __('orders_form_delivered_message','message'), 'required|trim|xss_clean');
						if ($this->form_validation->run() == FALSE){
							$error=validation_errors_array();
							if($error){
								foreach($error as $key=>$val){
									$msg['status'] = 'FAIL';
					    			$msg['errors'][$i]['id'] = $key;
									$msg['errors'][$i]['message'] = $val;
					   				$i++;
								}
							}
						}else{
							if($i==0){
								$conversations=array(
									'order_id'=>$order_id,
									'sender_id'=>$this->member_id,
									'message'=>post('delivered_message'),
									'date'=>date('Y-m-d H:i:s'),
									'reason'=>'',
									'type'=>'delivered',
								);
								if($this->input->post('attachment')){
									$attachment=post('attachment');
									$file_data=json_decode($attachment);
									if($file_data){
										if($file_data->file_name && file_exists(TMP_UPLOAD_PATH.$file_data->file_name)){
											rename(TMP_UPLOAD_PATH.$file_data->file_name, UPLOAD_PATH."orders-files/".$file_data->file_name);	
											$conversations['file']=$file_data->file_name;
										}
									}
								}
								$conversations_id=insert_record('orders_conversations',$conversations,TRUE);
								if($conversations_id){
									updateTable('orders_conversations',array('type'=>'message'),array('order_id'=>$order_id,'type'=>'delivered','c_id <>'=>$conversations_id));
									//$order_auto_complete =get_setting('order_auto_complete');
									$order_auto_complete =0;
          							$complete_time = date("Y-m-d H:i:s",strtotime(" + $order_auto_complete days"));
									updateTable('orders',array('order_status'=>ORDER_DELIVERED,'complete_time'=>$complete_time),array('order_id'=>$order_id,'order_status <>'=>ORDER_CANCELLED,'order_status <>'=>ORDER_COMPLETED));
									$seller_details=getData(array(
										'select'=>'m.member_id,m.member_name,m.member_email',
										'table'=>'member as m',
										'where'=>array('m.member_id'=>$orderdetails->seller_id),
										'single_row'=>TRUE
									));
									$buyer_details=getData(array(
										'select'=>'m.member_id,m.member_name,m.member_email',
										'table'=>'member as m',
										'where'=>array('m.member_id'=>$orderdetails->buyer_id),
										'single_row'=>TRUE
									));
									$RECEIVER_EMAIL=$buyer_details->member_email;
									$url=get_link('OrderDetailsURL').md5($order_id);
									$template='order-delivered';
									$this->data_parse=array(
									'BUYER_NAME'=>$buyer_details->member_name,
									'SELLER_NAME'=>$seller_details->member_name,
									'MESSAGE'=>$conversations['message'],
									'ORDER_DETAILS_URL'=>$url,
									);
									SendMail($RECEIVER_EMAIL,$template,$this->data_parse);
									
									$this->notification_model->log(
										$template, // template key
										array('OID'=>$order_id), // template data
										$this->config->item('OrderDetailsURL').md5($order_id), // link (without base_url)
										$orderdetails->buyer_id, // notification to,
										$this->member_id // notification_from
									);

									
								}
								$msg['status'] = 'OK';
								$msg['redirect'] = get_link('OrderDetailsURL').md5($order_id);
							}
						}
					}
					elseif($action=='submit_revison'){
						$this->form_validation->set_rules('revison_message', __('orders_form_revison_message','message'), 'required|trim|xss_clean');
						if ($this->form_validation->run() == FALSE){
							$error=validation_errors_array();
							if($error){
								foreach($error as $key=>$val){
									$msg['status'] = 'FAIL';
					    			$msg['errors'][$i]['id'] = $key;
									$msg['errors'][$i]['message'] = $val;
					   				$i++;
								}
							}
						}else{
							if($i==0){
								$conversations=array(
									'order_id'=>$order_id,
									'sender_id'=>$this->member_id,
									'message'=>post('revison_message'),
									'date'=>date('Y-m-d H:i:s'),
									'reason'=>'',
									'type'=>'revision',
								);
								if($this->input->post('attachment')){
									$attachment=post('attachment');
									$file_data=json_decode($attachment);
									if($file_data){
										if($file_data->file_name && file_exists(TMP_UPLOAD_PATH.$file_data->file_name)){
											rename(TMP_UPLOAD_PATH.$file_data->file_name, UPLOAD_PATH."orders-files/".$file_data->file_name);	
											$conversations['file']=$file_data->file_name;
										}
									}
								}
								$conversations_id=insert_record('orders_conversations',$conversations,TRUE);
								if($conversations_id){
									updateTable('orders_conversations',array('type'=>'message'),array('order_id'=>$order_id,'type'=>'delivered','c_id <>'=>$conversations_id));
									updateTable('orders',array('order_status'=>ORDER_REVISION),array('order_id'=>$order_id,'order_status <>'=>ORDER_CANCELLED,'order_status <>'=>ORDER_COMPLETED));
									$seller_details=getData(array(
										'select'=>'m.member_id,m.member_name,m.member_email',
										'table'=>'member as m',
										'where'=>array('m.member_id'=>$orderdetails->seller_id),
										'single_row'=>TRUE
									));
									$buyer_details=getData(array(
										'select'=>'m.member_id,m.member_name,m.member_email',
										'table'=>'member as m',
										'where'=>array('m.member_id'=>$orderdetails->buyer_id),
										'single_row'=>TRUE
									));
									$RECEIVER_EMAIL=$seller_details->member_email;
									$url=get_link('OrderDetailsURL').md5($order_id);
									$template='revision-requested';
									$this->data_parse=array(
									'BUYER_NAME'=>$buyer_details->member_name,
									'SELLER_NAME'=>$seller_details->member_name,
									'MESSAGE'=>$conversations['message'],
									'ORDER_DETAILS_URL'=>$url,
									);
									SendMail($RECEIVER_EMAIL,$template,$this->data_parse);
									$this->notification_model->log(
										$template, // template key
										array('OID'=>$order_id), // template data
										$this->config->item('OrderDetailsURL').md5($order_id), // link (without base_url)
										$orderdetails->seller_id, // notification to,
										$this->member_id // notification_from
									);
								
								}
								$msg['status'] = 'OK';
								$msg['redirect'] = get_link('OrderDetailsURL').md5($order_id);
							}
						}
					}	
					elseif($action=='submit_report'){
						$this->form_validation->set_rules('additional_information', __('orders_form_additional_information','message'), 'required|trim|xss_clean');
						$this->form_validation->set_rules('reason', __('orders_form_reason','reason'), 'required|trim|xss_clean');
						if ($this->form_validation->run() == FALSE){
							$error=validation_errors_array();
							if($error){
								foreach($error as $key=>$val){
									$msg['status'] = 'FAIL';
					    			$msg['errors'][$i]['id'] = $key;
									$msg['errors'][$i]['message'] = $val;
					   				$i++;
								}
							}
						}else{
							if($i==0){
								$reports=array(
									'reporter_id'=>$this->member_id,
									'content_id'=>$order_id,
									'content_type'=>'order',
									'reason'=>post('reason'),
									'additional_information'=>post('additional_information'),
								);
								$reports_id=insert_record('reports',$reports,TRUE);
								if($reports_id){
									$msg['message'] = 'Your Report Has Been Successfully Submited';
								}
								$msg['status'] = 'OK';
								$msg['redirect'] = get_link('OrderDetailsURL').md5($order_id);
							}
						}
					}	
					elseif($action=='submit_cancellation_request'){
						$this->form_validation->set_rules('cancellation_message', __('orders_form_cancellation_message','message'), 'required|trim|xss_clean');
						$this->form_validation->set_rules('cancellation_reason', __('orders_form_cancellation_reason','message'), 'trim|xss_clean');
						if ($this->form_validation->run() == FALSE){
							$error=validation_errors_array();
							if($error){
								foreach($error as $key=>$val){
									$msg['status'] = 'FAIL';
					    			$msg['errors'][$i]['id'] = $key;
									$msg['errors'][$i]['message'] = $val;
					   				$i++;
								}
							}
						}else{
							if($i==0){
								$conversations=array(
									'order_id'=>$order_id,
									'sender_id'=>$this->member_id,
									'message'=>post('cancellation_message'),
									'date'=>date('Y-m-d H:i:s'),
									'reason'=>post('cancellation_reason'),
									'type'=>'cancellation_request',
								);
								$conversations_id=insert_record('orders_conversations',$conversations,TRUE);
								if($conversations_id){
									updateTable('orders',array('order_status'=>ORDER_CANCELLATION),array('order_id'=>$order_id,'order_status <>'=>ORDER_CANCELLED,'order_status <>'=>ORDER_COMPLETED));
									
									if($this->member_id==$orderdetails->seller_id){
										$receiver_id=$orderdetails->buyer_id;
									}else{
										$receiver_id=$orderdetails->seller_id;
									}
									$template='cancellation-request';
									$this->notification_model->log(
										$template, // template key
										array('OID'=>$order_id), // template data
										$this->config->item('OrderDetailsURL').md5($order_id), // link (without base_url)
										$receiver_id, // notification to,
										$this->member_id // notification_from
									);
								}
								$msg['status'] = 'OK';
								$msg['redirect'] = get_link('OrderDetailsURL').md5($order_id);
							}
						}
					}
					elseif($action=='decline_request'){
						updateTable('orders_conversations',array('type'=>'decline_cancellation_request'),array('order_id'=>$order_id,'type'=>'cancellation_request'));
						updateTable('orders',array('order_status'=>ORDER_PROCESSING),array('order_id'=>$order_id,'order_status <>'=>ORDER_CANCELLED,'order_status <>'=>ORDER_COMPLETED));
						
						if($this->member_id==$orderdetails->seller_id){
							$receiver_id=$orderdetails->buyer_id;
						}else{
							$receiver_id=$orderdetails->seller_id;
						}
						$template='decline-cancellation-request';
						$this->notification_model->log(
							$template, // template key
							array('OID'=>$order_id), // template data
							$this->config->item('OrderDetailsURL').md5($order_id), // link (without base_url)
							$receiver_id, // notification to,
							$this->member_id // notification_from
						);
						
						$msg['status'] = 'OK';
						$msg['redirect'] = get_link('OrderDetailsURL').md5($order_id);
					}
					elseif($action=='accept_request'){
						if($orderdetails->order_status==ORDER_CANCELLATION){
							
							updateTable('orders_conversations',array('type'=>'accept_cancellation_request'),array('order_id'=>$order_id,'type'=>'cancellation_request'));
							$update=updateTable('orders',array('order_status'=>ORDER_CANCELLED,'order_active'=>0),array('order_id'=>$order_id,'order_status'=>ORDER_CANCELLATION));
							if($update && $orderdetails->order_status!=ORDER_CANCELLED){
								$total=$orderdetails->order_price;
								$buyer_details=getWalletMember($orderdetails->buyer_id);
								$buyer_wallet_id=$buyer_details->wallet_id;
								$buyer_wallet_balance=$buyer_details->balance;
								$site_details=getWallet(get_setting('SITE_MAIN_WALLET'));
								$sender_wallet_id=$site_details->wallet_id;
								$sender_wallet_balance=$site_details->balance;

								$reciver_wallet_id=$buyer_wallet_id;
								$reciver_wallet_balance=$buyer_wallet_balance;
								$issuer_relational_data=$buyer_details->name;
								$recipient_relational_data=get_setting('website_name');
								
								$wallet_transaction_type_id=get_setting('ORDER_PAYMENT_REFUND');
								$current_datetime=date('Y-m-d H:i:s');
								$wallet_transaction_id=insert_record('wallet_transaction',array('wallet_transaction_type_id'=>$wallet_transaction_type_id,'status'=>1,'created_date'=>$current_datetime,'transaction_date'=>$current_datetime),TRUE);
								if($wallet_transaction_id){
									
									insert_record('orders_transaction',array('order_id'=>$order_id,'transaction_id'=>$wallet_transaction_id));
									
									$insert_wallet_transaction_row=array('wallet_transaction_id'=>$wallet_transaction_id,'wallet_id'=>$sender_wallet_id,'debit'=>$total,'description_tkey'=>'OrderID','relational_data'=>$order_id);
									$insert_wallet_transaction_row['ref_data_cell']=json_encode(array(
									'FW'=>$site_details->title,
									'TW'=>$buyer_details->name.' wallet',
									'TP'=>'Order_Payment_Refund',
									));
									insert_record('wallet_transaction_row',$insert_wallet_transaction_row);
									
									$sender_new_balance=displayamount($sender_wallet_balance,2)-displayamount($total,2);
									updateTable('wallet',array('balance'=>$sender_new_balance),array('wallet_id'=>$sender_wallet_id));
									wallet_balance_check($sender_wallet_id,array('transaction_id'=>$wallet_transaction_id));
									
									$insert_wallet_transaction_row=array('wallet_transaction_id'=>$wallet_transaction_id,'wallet_id'=>$reciver_wallet_id,'credit'=>$total,'description_tkey'=>'Transfer_from','relational_data'=>$recipient_relational_data);
									$insert_wallet_transaction_row['ref_data_cell']=json_encode(array(
									'FW'=>$site_details->title,
									'TW'=>$buyer_details->name.' wallet',
									'TP'=>'Order_Payment_Refund',
									));
									insert_record('wallet_transaction_row',$insert_wallet_transaction_row);	
									
									$reciver_new_balance=displayamount($reciver_wallet_balance,2)+displayamount($total,2);
									wallet_balance_check($reciver_wallet_id,array('transaction_id'=>$wallet_transaction_id));
									
									if($this->member_id==$orderdetails->seller_id){
										$receiver_id=$orderdetails->buyer_id;
									}else{
										$receiver_id=$orderdetails->seller_id;
									}
									$seller_details=getData(array(
										'select'=>'m.member_id,m.member_name,m.member_email',
										'table'=>'member as m',
										'where'=>array('m.member_id'=>$orderdetails->seller_id),
										'single_row'=>TRUE
									));
									
									
									$RECEIVER_EMAIL=$seller_details->member_email;
									$url=get_link('OrderDetailsURL').md5($order_id);
									$template='order-cancelled-to-seller';
									$this->data_parse=array(
									'SELLER_NAME'=>$seller_details->member_name,
									'ORDER_DETAILS_URL'=>$url,
									);
									SendMail($RECEIVER_EMAIL,$template,$this->data_parse);
									
									$RECEIVER_EMAIL=$buyer_details->member_email;
									$template='order-cancelled-to-buyer';
									$this->data_parse=array(
									'BUYER_NAME'=>$buyer_details->member_name,
									'ORDER_DETAILS_URL'=>$url,
									);
									SendMail($RECEIVER_EMAIL,$template,$this->data_parse);
									
									
									$this->notification_model->log(
										$template, // template key
										array('OID'=>$order_id), // template data
										$this->config->item('OrderDetailsURL').md5($order_id), // link (without base_url)
										$receiver_id, // notification to,
										$this->member_id // notification_from
									);

									$msg['status'] = 'OK';
									$msg['redirect'] = get_link('OrderDetailsURL').md5($order_id);
								}
							}else{
								$msg['status'] = 'OK';
								$msg['redirect'] = get_link('OrderDetailsURL').md5($order_id);
							}
						}
					}
					elseif($action=='complete'){
						if($orderdetails->buyer_id==$this->member_id){
							updateTable('orders_conversations',array('type'=>'message'),array('order_id'=>$order_id,'type'=>'delivered'));
							$currentStatus=getFieldData('order_status','orders','order_id',$order_id);
							$update=updateTable('orders',array('order_status'=>ORDER_COMPLETED,'order_active'=>0),array('order_id'=>$order_id,'order_status'=>ORDER_DELIVERED));
							if($update && $currentStatus!=ORDER_COMPLETED){

								$site_details=getWallet(get_setting('SITE_MAIN_WALLET'));
								$sender_wallet_id=$site_details->wallet_id;
								$sender_wallet_balance=$site_details->balance;

								$profit_wallet_details=getWallet(get_setting('SITE_PROFIT_WALLET'));
								$profit_wallet_id=$profit_wallet_details->wallet_id;
								$profit_wallet_balance=$profit_wallet_details->balance;

								$recipient_relational_data=get_setting('website_name');
								$seller_details=getWalletMember($orderdetails->seller_id);
								$seller_wallet_id=$seller_details->wallet_id;
								$seller_wallet_balance=$seller_details->balance;


								
								$total=$orderdetails->order_price;
								$comission_percentage=getSiteCommissionFee($orderdetails->seller_id);
                            	$commission=($comission_percentage / 100 ) * $total;

								$wallet_transaction_type_id=get_setting('ORDER_REVENUE_TO_SELLER');
								$current_datetime=date('Y-m-d H:i:s');
								$wallet_transaction_id=insert_record('wallet_transaction',array('wallet_transaction_type_id'=>$wallet_transaction_type_id,'status'=>1,'created_date'=>$current_datetime,'transaction_date'=>$current_datetime),TRUE);
								if($wallet_transaction_id){
									insert_record('orders_transaction',array('order_id'=>$order_id,'transaction_id'=>$wallet_transaction_id));
									
									$insert_wallet_transaction_row=array('wallet_transaction_id'=>$wallet_transaction_id,'wallet_id'=>$sender_wallet_id,'debit'=>$total,'description_tkey'=>'OrderID','relational_data'=>$order_id);
									$insert_wallet_transaction_row['ref_data_cell']=json_encode(array(
												'FW'=>$site_details->title,
												'TW'=>$seller_details->name.' wallet',
												'TP'=>'Revenue',
												));
									insert_record('wallet_transaction_row',$insert_wallet_transaction_row);
									
									$insert_wallet_transaction_row=array('wallet_transaction_id'=>$wallet_transaction_id,'wallet_id'=>$seller_wallet_id,'credit'=>$total,'description_tkey'=>'Transfer_from','relational_data'=>$recipient_relational_data);
									$insert_wallet_transaction_row['ref_data_cell']=json_encode(array(
												'FW'=>$site_details->title,
												'TW'=>$seller_details->name.' wallet',
												'TP'=>'Revenue',
												));
									insert_record('wallet_transaction_row',$insert_wallet_transaction_row);
									
									$sender_wallet_balance=displayamount($sender_wallet_balance,2)-displayamount($total,2);
									updateTable('wallet',array('balance'=>$sender_wallet_balance),array('wallet_id'=>$sender_wallet_id));
									wallet_balance_check($sende_wallet_id,array('transaction_id'=>$wallet_transaction_id));
									
									$seller_new_balance=displayamount($seller_wallet_balance,2)+displayamount($total,2);
									updateTable('wallet',array('balance'=>$seller_new_balance),array('wallet_id'=>$seller_wallet_id));
									wallet_balance_check($seller_wallet_id,array('transaction_id'=>$wallet_transaction_id));
									
									$current_datetime=date('Y-m-d H:i:s');
									$wallet_transaction_type_id=get_setting('ORDER_SITE_COMMISSION');
									$wallet_transaction_id=insert_record('wallet_transaction',array('wallet_transaction_type_id'=>$wallet_transaction_type_id,'status'=>1,'created_date'=>$current_datetime,'transaction_date'=>$current_datetime),TRUE);
									if($wallet_transaction_id){
										$insert_wallet_transaction_row=array('wallet_transaction_id'=>$wallet_transaction_id,'wallet_id'=>$seller_wallet_id,'debit'=>$commission,'description_tkey'=>'Commission','relational_data'=>$order_id);
										$insert_wallet_transaction_row['ref_data_cell']=json_encode(array(
												'FW'=>$seller_details->name.' wallet',
												'TW'=>$profit_wallet_details->title,
												'TP'=>'Commission',
												));
										insert_record('wallet_transaction_row',$insert_wallet_transaction_row);
										
										$insert_wallet_transaction_row=array('wallet_transaction_id'=>$wallet_transaction_id,'wallet_id'=>$profit_wallet_id,'credit'=>$commission,'description_tkey'=>'Commission','relational_data'=>$order_id);
										$insert_wallet_transaction_row['ref_data_cell']=json_encode(array(
												'FW'=>$seller_details->name.' wallet',
												'TW'=>$profit_wallet_details->title,
												'TP'=>'Commission',
												));
										insert_record('wallet_transaction_row',$insert_wallet_transaction_row);
										
										$profit_wallet_balance=displayamount($profit_wallet_balance,2)+displayamount($commission,2);
										updateTable('wallet',array('balance'=>$profit_wallet_balance),array('wallet_id'=>$profit_wallet_id));
										wallet_balance_check($profit_wallet_id,array('transaction_id'=>$wallet_transaction_id));
										
										$seller_new_balance=displayamount($seller_new_balance,2)-displayamount($commission,2);
										updateTable('wallet',array('balance'=>$seller_new_balance),array('wallet_id'=>$seller_wallet_id));
										wallet_balance_check($seller_wallet_id,array('transaction_id'=>$wallet_transaction_id));
									

									}

								}
								$template='order_completed';
								$this->notification_model->log(
									$template, // template key
									array('OID'=>$order_id), // template data
									$this->config->item('OrderDetailsURL').md5($order_id), // link (without base_url)
									$orderdetails->seller_id, // notification to,
									$orderdetails->buyer_id // notification_from
								);

								$msg['status'] = 'OK';
								$msg['redirect'] = get_link('OrderDetailsURL').md5($order_id);

							}

						}
					}
					elseif($action=='review_submit'){
						$this->form_validation->set_rules('review', __('orders_form_review','review'), 'required|trim|xss_clean');
						$this->form_validation->set_rules('rating', __('orders_form_rating','rating'), 'required|trim|xss_clean|numeric|less_than_equal_to[5]');
						if ($this->form_validation->run() == FALSE){
							$error=validation_errors_array();
							if($error){
								foreach($error as $key=>$val){
									$msg['status'] = 'FAIL';
					    			$msg['errors'][$i]['id'] = $key;
									$msg['errors'][$i]['message'] = $val;
					   				$i++;
								}
							}
						}else{
							if($i==0){
								
								if($orderdetails->seller_id==$this->member_id){
									$review=array(
									'order_id'=>$order_id,
									'review_seller_id'=>$this->member_id,
									'seller_rating'=>post('rating'),
									'seller_review'=>post('review'),
									'review_date'=>date('Y-m-d H:i:s'),
									);
									$check=$this->db->where(array('order_id'=>$order_id))->from('seller_reviews')->count_all_results();
									if($check){
										$template="seller-order-review-update";
										updateTable('seller_reviews',$review,array('order_id'=>$order_id));
									}else{
										$template="seller-order-review";
										insert_record('seller_reviews',$review);
									}
									$this->notification_model->log(
										$template, // template key
										array('OID'=>$order_id), // template data
										$this->config->item('OrderDetailsURL').md5($order_id), // link (without base_url)
										$orderdetails->buyer_id, // notification to,
										$this->member_id // notification_from
									);
							
								}elseif($orderdetails->buyer_id==$this->member_id){
									$review=array(
									'order_id'=>$order_id,
									'proposal_id'=>$orderdetails->proposal_id,
									'review_buyer_id'=>$this->member_id,
									'buyer_rating'=>post('rating'),
									'buyer_review'=>post('review'),
									'review_seller_id'=>$orderdetails->seller_id,
									'review_date'=>date('Y-m-d H:i:s'),
									);
									$check=$this->db->where(array('order_id'=>$order_id))->from('buyer_reviews')->count_all_results();
									if($check){
										$template="buyer-order-review-update";
										updateTable('buyer_reviews',$review,array('order_id'=>$order_id));
									}else{
										$template="buyer-order-review";
										insert_record('buyer_reviews',$review);
									}
									$this->notification_model->log(
										$template, // template key
										array('OID'=>$order_id), // template data
										$this->config->item('OrderDetailsURL').md5($order_id), // link (without base_url)
										$orderdetails->seller_id, // notification to,
										$this->member_id // notification_from
									);
								}
								$msg['message'] ='Review submitted successfully!';
								if($check){
									$msg['message'] ='Review updated successfully!';
								}
								$msg['status'] = 'OK';
								$msg['redirect'] = get_link('OrderDetailsURL').md5($order_id);
							}
						}
					}	
				}	
			}
		}
	unset($_POST);
	echo json_encode($msg);
	}
	
	
	
	
	public function invoice($order_id_md5='',$token=''){
		$order_id_md5 = substr($order_id_md5, 0, -4);
		$arr=array(
			'select'=>'o.order_id,o.order_number,o.order_duration,o.order_date,o.order_time,o.order_description,o.seller_id,o.buyer_id,o.proposal_id,o.order_price,o.order_qty,o.order_fee,o.order_active,o.complete_time,o.order_status,o.payment_method,o.transaction_id,p.proposal_image,p.proposal_title,p.proposal_title_ar,p.proposal_url,p_a.buyer_instruction',
			'table'=>'orders as o',
			'join'=>array(
			array('table'=>'proposals as p','on'=>'o.proposal_id=p.proposal_id','position'=>'left'),
			array('table'=>'proposal_additional as p_a','on'=>'o.proposal_id=p_a.proposal_id','position'=>'left'),
			),
			'where'=>array('md5(o.order_id)'=>$order_id_md5),
			'single_row'=>TRUE
		);
		$this->data['orderDetails']=getData($arr);
		if($this->data['orderDetails']){
			$order_id=$this->data['orderDetails']->order_id;
			$this->data['orderDetails']->extra=getData(array(
				'select'=>'o.name,o.price',
				'table'=>'orders_extras as o',
				'where'=>array('o.order_id'=>$order_id),
			));
			$this->data['orderDetails']->buyer=getMemberDetails($this->data['orderDetails']->buyer_id,array('main'=>1,'member_address'=>1));
			$this->data['orderDetails']->seller=getMemberDetails($this->data['orderDetails']->seller_id,array('main'=>1,'member_address'=>1));
		}
		$verify_token=md5('FVRR'.'-'.date("Y-m-d").'-'.$order_id);
    if ($this->member_id == $this->data['orderDetails']->buyer_id || $this->member_id == $this->data['orderDetails']->seller_id || $token==$verify_token) {
		  $this->data['download'] = FALSE;
		  $this->load->view('pdf_html2', $this->data);
    }
	}
}
?>