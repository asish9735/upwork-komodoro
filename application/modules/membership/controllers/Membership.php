<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Membership extends MX_Controller {
	private $data;
	function __construct()
	{
		$this->loggedUser=$this->session->userdata('loggedUser');
		$this->access_member_type='';
		if($this->loggedUser){
			$this->access_user_id=$this->loggedUser['LID'];	
			$this->access_member_type=$this->loggedUser['ACC_P_TYP'];
			$this->member_id=$this->loggedUser['MID'];
		}else{
			redirect(URL::get_link('loginURL').'?ref=membershipURL');
		}
		$this->data['curr_class'] = $this->router->fetch_class();
		$this->data['curr_method'] = $this->router->fetch_method();
		$this->load->model('membership_model');
		parent::__construct();
	}
	public function index()
	{
		if($this->access_member_type=='E'){
			redirect(URL::get_link('dashboardURL'));
		}
		$this->layout->set_js(array(
			'utils/helper.js',
			'bootbox_custom.js',
			'mycustom.js',
		));
		$this->layout->set_title('Membership');
		$this->layout->set_meta('author', 'Dev Sharma');
		$this->layout->set_meta('keywords', 'Freelancer Script, Freelancer, New Flance');
		$this->layout->set_meta('description', 'Freelancer Clone Script');
		$this->data['membership']=$this->membership_model->getMembership();
		$this->data['left_panel']=$this->layout->view('inc/freelancer-setting-left',$this->data,TRUE,TRUE);
		$this->layout->view('membership',$this->data);
	}
	public function select_membership($enc_membership_id='',$duration='')
	{
		if($this->access_member_type=='E'){
			redirect(URL::get_link('dashboardURL'));
		}
		$this->layout->set_js(array(
			'utils/helper.js',
			'bootbox_custom.js',
			'mycustom.js',
		));
		$this->layout->set_title('Membership');
		$this->layout->set_meta('author', 'Dev Sharma');
		$this->layout->set_meta('keywords', 'Freelancer Script, Freelancer, New Flance');
		$this->layout->set_meta('description', 'Freelancer Clone Script');
		$this->data['membership']=$this->membership_model->getMembershipDetails($enc_membership_id);
		$this->data['duration']=$duration;
		$this->data['left_panel']=$this->layout->view('inc/freelancer-setting-left',$this->data,TRUE,TRUE);
		$this->layout->view('selected-membership',$this->data);
	}
	public function processmembership($enc_membership_id='',$duration=''){
		checkrequestajax();
		$msg=array();
		$method=post('method');
		$okey=post('okey');
		$membership=$this->membership_model->getMembershipDetails($enc_membership_id);
		if($membership){
			if($method=='wallet'){
				$processing_fee=0;
				$total=$featured_fee+$processing_fee;
				$seller_details=getMemberDetails($this->member_id,array('main'=>1));
				$seller_wallet_id=$seller_details['member']->wallet_id;
				$seller_wallet_balance=$seller_details['member']->balance;
				$site_details=getWallet(get_option_value('SITE_PROFIT_WALLET'));
				$reciver_wallet_id=$site_details->wallet_id;
				$reciver_wallet_balance=$site_details->balance;
				//$issuer_relational_data=get_option_value('website_name');
				$recipient_relational_data=$seller_details['member']->member_name;
				if($seller_details && $seller_details['member']->balance>$total){
					$wallet_transaction_type_id=get_option_value('FEATURED_PAYMENT_WALLET');
					$current_datetime=date('Y-m-d H:i:s');
					$wallet_transaction_id=insertTable('wallet_transaction',array('wallet_transaction_type_id'=>$wallet_transaction_type_id,'status'=>1,'created_date'=>$current_datetime,'transaction_date'=>$current_datetime),TRUE);
					if($wallet_transaction_id){
						
						
						$insert_wallet_transaction_row=array('wallet_transaction_id'=>$wallet_transaction_id,'wallet_id'=>$seller_wallet_id,'debit'=>$total,'description_tkey'=>'PID','relational_data'=>$proposal_id);
						$insert_wallet_transaction_row['ref_data_cell']=json_encode(array(
								'FW'=>$seller_details['member']->member_name.' wallet',
								'TW'=>$site_details->title,
								'TP'=>'Featured_Payment',
								));
						insertTable('wallet_transaction_row',$insert_wallet_transaction_row);
						
						$insert_wallet_transaction_row=array('wallet_transaction_id'=>$wallet_transaction_id,'wallet_id'=>$reciver_wallet_id,'credit'=>$total,'description_tkey'=>'Transfer_from','relational_data'=>$recipient_relational_data);
						$insert_wallet_transaction_row['ref_data_cell']=json_encode(array(
								'FW'=>$seller_details['member']->member_name.' wallet',
								'TW'=>$site_details->title,
								'TP'=>'Featured_Payment',
								));
						insertTable('wallet_transaction_row',$insert_wallet_transaction_row);
						
						$seller_new_balance=displayamount($seller_wallet_balance,2)-displayamount($total,2);
						updateTable('wallet',array('balance'=>$seller_new_balance),array('wallet_id'=>$seller_wallet_id));
						wallet_balance_check($seller_wallet_id,array('transaction_id'=>$wallet_transaction_id));
						
						$new_balance=displayamount($reciver_wallet_balance,2)+displayamount($total,2);
						updateTable('wallet',array('balance'=>$new_balance),array('wallet_id'=>$reciver_wallet_id));
						wallet_balance_check($reciver_wallet_id,array('transaction_id'=>$wallet_transaction_id));
						
						$featured_end_date=date('Y-m-d H:i:s',strtotime('+'.$featured_duration.' days'));
						updateTable('proposal_settings',array('proposal_featured'=>1,'featured_end_date'=>$featured_end_date),array('proposal_id'=>$proposal_id));
						
						
						$RECEIVER_EMAIL=$seller_details['member']->member_email;
						$url=get_link('manageproposalURL');
						$template='featured';
						$data_parse=array(
						'SELLER_NAME'=>getUserName($seller_details['member']->member_id),
						'PROPOSAL_URL'=>$url,
						);
						SendMail('',$RECEIVER_EMAIL,$template,$data_parse);
						loadModel('notifications/notification_model');
						$notificationData=array(
						'sender_id'=>0,
						'receiver_id'=>$seller_details['member']->member_id,
						'template'=>'featured',
						'url'=>$this->config->item('manageproposalURL'),
						'content'=>json_encode(array('PID'=>$proposal_id)),
						);
						$this->notification_model->savenotification($notificationData);
						
							
						$msg['status'] = 'OK';
						$msg['redirect'] =get_link('manageproposalURL').'?ref=paymentsuccess';
					}else{
						$msg['status'] = 'FAIL';
						$msg['message'] = 'transaction error';
					}
				}else{
					$msg['status'] = 'FAIL';
					$msg['message'] = 'Insufficient fund';
				}					
					
					
				
			}
			elseif($method=='paypal'){
				$this->session->set_userdata('add_fund_amt',$okey);
				$msg['status'] = 'OK';
				$msg['redirect'] =get_link('PaypalCheckOut').'membership/'.$enc_membership_id.'-'.$duration;
			}
			elseif($method=='stripe'){
				$this->session->set_userdata('add_fund_amt',$okey);
				$msg['status'] = 'OK';
				$msg['redirect'] =get_link('StripeCheckOut').'membership/'.$enc_membership_id.'-'.$duration;
			}
		}
		else{
			$msg['status'] = 'FAIL';
			$msg['error'] = 'Invalid payment option';
		}
		
		unset($_POST);
		echo json_encode($msg);	
	}
	
}
