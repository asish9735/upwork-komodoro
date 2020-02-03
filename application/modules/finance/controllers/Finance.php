<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Finance extends MX_Controller {
	private $lang;
	private $data;
    /**
     * Description: this used for check the user is exsts or not if exists then it redirect to this site
     * Paremete: username and password 
     */
    public function __construct() {
        $this->loggedUser=$this->session->userdata('loggedUser');
		$this->access_member_type='';
		if($this->loggedUser){
			$this->access_user_id=$this->loggedUser['LID'];	
			$this->access_member_type=$this->loggedUser['ACC_P_TYP'];
			$this->member_id=$this->loggedUser['MID'];
			$this->organization_id=$this->loggedUser['OID'];
		}else{
			$refer=uri_string();
			redirect(URL::get_link('loginURL').'?refer='.$refer);
		}
		$this->data['curr_class'] = $this->router->fetch_class();
		$this->data['curr_method'] = $this->router->fetch_method();
		$this->lang = get_active_lang();
        parent::__construct();
    }
	public function addfund()
	{
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
		
		$this->layout->view('add-fund', $this->data);
		
	}
	public function stripe()
	{
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
		
		$this->layout->view('stripe', $this->data);
		
	}
	public function transaction()
	{
		$this->layout->set_js(array(
			'utils/helper.js',
			'bootbox_custom.js',
			'mycustom.js',
			'moment-with-locales.js',
			'bootstrap-datetimepicker.min.js'
		));
		$this->layout->set_css(array(
			'bootstrap-datetimepicker.css'
		));
		if($this->access_member_type=='F'){
			$this->data['left_panel']=$this->layout->view('inc/freelancer-setting-left',$this->data,TRUE,TRUE);
		}else{
			$this->data['left_panel']=$this->layout->view('inc/client-setting-left',$this->data,TRUE,TRUE);
		}
		
		$this->layout->view('transaction', $this->data);
		
	}
	public function withdraw()
	{
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
		
		$this->layout->view('withdraw', $this->data);
		
	}
	public function processfund(){
		checkrequestajax();
		$i=0;
		$msg=array();
		$method=post('method');
		$okey=post('okey');
		$payfor=post('payfor');
		if($okey>0){
		if($payfor==1){
			if($method=='paypal'){
				$this->session->set_userdata('add_fund_amt',$okey);
				$msg['status'] = 'OK';
				$msg['redirect'] =get_link('PaypalCheckOut').'addfund';
			}
			elseif($method=='stripe'){
				$this->session->set_userdata('add_fund_amt',$okey);
				$msg['status'] = 'OK';
				$msg['redirect'] =get_link('StripeCheckOut').'addfund';
			}
			elseif($method=='telr'){
				$featured_fee=get_option_value('featured_fee');
				$feeCalculation=generateProcessingFee('telr',$featured_fee);
				$processing_fee=$feeCalculation['processing_fee'];
				$amount=$featured_fee+$processing_fee;
				$cart_desc='Feature payment';
				$cart_id=$proposal_id.'-'.time();
				$post_data = Array(
					'ivp_method'		=> 'create',
					'ivp_authkey'		=> get_option_value('telr_authentication_code'),
					'ivp_store'		=> get_option_value('telr_store_id'),
					'ivp_lang'		=> 'en',
					'ivp_cart'		=> $cart_id,
					'ivp_amount'		=> $amount,
					'ivp_currency'		=> trim(CurrencyCode()),
					'ivp_test'		=> get_option_value('telr_is_sandbox'),
					'ivp_desc'		=> trim($cart_desc),
					'return_auth'		=> 	get_link('TelrNotify').'featured/'.$proposal_id,
					'return_can'		=>  get_link('homeURL'),
					'return_decl'		=>  get_link('homeURL'),
					/*'ivp_update_url'	=>  get_link('TelrNotify').'featured/'.$proposal_id,*/
				);
			$curl_telr=curl_telr($post_data);
			if($curl_telr){
				if(isset($curl_telr['order'])) {
					$transansaction_data=array('payment_type'=>'TELR','content_key'=>$cart_id);
					$transansaction_data['request_value']=json_encode($post_data);
					insertTable('online_transaction_data',$transansaction_data);
		
					$jobj = $curl_telr['order'];
					$ref=$jobj['ref'];
					$this->session->set_userdata('Tref',$ref);
					$redirurl=$jobj['url'];
					$msg['status'] = 'OK';
					$msg['redirect'] =$redirurl;
				}else{
					$jobj = $returnData['error'];
					$msg['status'] = 'FAIL';
					$msg['error'] = $jobj['message'].' :: '.$jobj['note'];
				}
			}
			//print_r($post_data);
			//dd($curl_telr);	
				
			}
			elseif($method=='ngenius'){
				$featured_fee=get_option_value('featured_fee');
				$feeCalculation=generateProcessingFee('ngenius',$featured_fee);
				$processing_fee=$feeCalculation['processing_fee'];
				$amount=$featured_fee+$processing_fee;
				$cart_desc='Feature payment';
				$cart_id=$proposal_id.'-'.time();
				$post_data = array(
					'grant_type'		=> 'client_credentials',
				);
				$curl_ngenius=curl_ngenius($post_data,'token',$this->member_id);
				if($curl_ngenius){
					$access_token = $curl_ngenius['access_token'];
					if($access_token){
						$postData = array(); 
						$postData['action'] = 'SALE'; 
						$postData['amount'] =array();
						$postData['merchantAttributes '] =array();
						$postData['merchantAttributes']['redirectUrl'] = get_link('manageproposalURL').'?ref_p=paymentsuccess'; 
						$postData['merchantAttributes']['cancelUrl'] = get_link('homeURL'); 
						$postData['amount']['currencyCode'] = trim(CurrencyCode()); 
						$postData['amount']['value'] = round($amount*100); 
						$postData['token'] = $access_token; 
						$curl_ngenius_order=curl_ngenius($postData,'order',$this->member_id);
						if($curl_ngenius_order){
							//print_r($curl_ngenius_order);
							if($curl_ngenius_order['_links']['payment']['href']){
								$ref = $curl_ngenius_order['reference'];
								$transansaction_data=array('payment_type'=>'NGENIUS','content_key'=>$ref);
								unset($postData['token']);
								$postData['cart_id']=$cart_id;
								$postData['payment_type']='featured';
								$transansaction_data['request_value']=json_encode($postData);
								insertTable('online_transaction_data',$transansaction_data);
								
								
								//$this->session->set_userdata('Nref',$ref);
								$redirurl=$curl_ngenius_order['_links']['payment']['href'];
								$msg['status'] = 'OK';
								$msg['method'] = $method;
								$msg['redirect'] =$redirurl;
							}else{
								$jobj = $returnData['error'];
								$msg['status'] = 'FAIL';
								$msg['error'] = $jobj['message'].' :: '.$jobj['note'];
							}
						}
						
					}
				}
			}
		}else{
			$msg['status'] = 'FAIL';
			$msg['error'] = 'Invalid payment option';
		}
		}else{
			$msg['status'] = 'FAIL';
			$msg['error'] = 'Invalid amount';
		}
		unset($_POST);
		echo json_encode($msg);	
	}
   
	
	
	
}
