<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$currency=priceSymbol();
//get_print($orderDetails,FALSE);
$profile_url='';
if($is_buyer){
	$logo=getMemberLogo($contractDetails->seller->member_id);
	$name=$contractDetails->seller->member_name;
	$profile_url="href='".get_link('viewprofileURL').'/'.$contractDetails->seller->member_id."' target='_blank'";
}else{
	$logo=getCompanyLogo($contractDetails->buyer->organization_id);
	if($contractDetails->buyer->organization_name){
		$name=$contractDetails->buyer->organization_name;
	}else{
		$name=$contractDetails->buyer->member_name;
	}
}
$contract_details_url=get_link('OrderDetailsURL').md5($contractDetails->order_id);
$contract_message_url=get_link('OrderMessageURL').md5($contractDetails->order_id);
$contract_resolution_url=get_link('OrderResolutionCenterURL').md5($contractDetails->order_id);
$contract_term_url=get_link('OrderTermURL').md5($contractDetails->order_id);
?>
<script src="<?php echo JS;?>vue.js"></script>
<script src="<?php echo JS;?>vue-infinite-loading.js"></script>
<script type="text/javascript" src="<?php echo JS;?>moment-with-locales.js"></script>

<section class="section">
<div class="container">
        <h1><?php echo $contractDetails->proposal_title;?></h1>
        <ul class="nav nav-tabs mb-3">
          <li class="nav-item"> <a class="nav-link" href="<?php echo $contract_details_url;?>"><?php echo (__('order_details_page_Order_Activity',"Order Activity"));?></a> </li>
          <li class="nav-item"> <a class="nav-link active" href="<?php echo $contract_message_url;?>"><?php echo __('contract_details_mesage','Messages & Files');?></a> </li>
		  <?php if($contractDetails->order_status == ORDER_PENDING or $contractDetails->order_status == ORDER_PROCESSING or $contractDetails->order_status == ORDER_DELIVERED or $contractDetails->order_status == ORDER_REVISION){ ?>
		  <li class="nav-item"> <a class="nav-link" href="<?php echo $contract_resolution_url;?>"><?php echo (__('order_details_page_Resolution_Center',"Resolution Center"));?></a> </li>
		  <?php }?>
		  <li class="nav-item"> <a class="nav-link" href="<?php echo $contract_term_url;?>"><?php echo __('contract_details_term','Terms & Settings');?></a> </li>
        </ul>
        <div class="row">
			<div class="col-xl-9 col-lg-8 col-12">
				<div class="messages-container margin-top-0">
					<div class="messages-container-inner" id="message-app">
					
						<!-- Message Content -->
						<div class="message-content">
							<div v-if="active_chat">
								<active-chat-header :active_chat="active_chat"></active-chat-header>
								<active-chat-body :active_chat="active_chat" :login_user="login_user" v-on:update-message="updateMessage" :new_message_received="lastMessageReceived" v-on:new-attachment="updateAttachment"></active-chat-body>
							</div>
							<div v-else>
								<h3><?php echo __('contract_message_chat','Select chat');?></h3>
							</div>
						</div>
						<!-- Message Content -->
						<div class="attachmentFile">
							<div class="messages-headline"><h4><?php echo __('contract_message_attachment','Attachments');?></h4><p class="mb-0"><?php echo __('contract_message_all_files','All Files');?></p></div>
							<div v-if="active_chat" class="attachScrollbar" data-simplebar>
								<conversation-attachment :active_chat="active_chat" :refresh_attachment="refresh_attachment"></conversation-attachment>
							</div>
							<div v-else>
								<h3><?php echo __('contract_message_chat','Select chat');?></h3>
							</div>
						</div>
					</div>
			</div>
				
          </div>
          <div class="col-xl-3 col-lg-4 col-12">
            <div class="card text-center mt-4 mt-lg-0">
                <div class="card-body">
				<a <?php echo $profile_url;?>>
                <img src="<?php echo $logo;?>" alt="<?php echo $name;?>" class="rounded-circle mb-3" height="96" width="96">                    
                <h4><?php echo $name;?></h4>
				</a>
                <?php if($is_buyer){?>
            	<p class="text-muted mb-2 text-ellipsis-1"><?php D($contractDetails->seller->member_heading);?></p>
            	<div class="star-rating" data-rating="<?php echo round($contractDetails->seller->avg_rating,1);?>"></div> 
            <?php }else{ ?>
             	<div class="star-rating" data-rating="<?php echo round($contractDetails->buyer->avg_rating,1);?>"></div>
            <?php }?>
                </div>                    
            </div>
           </div>                          
        </div>
      </div>
</section>      

<?php $this->layout->view('message/message-template', '', TRUE); ?>



<script>
var SPINNER='<?php load_view('inc/spinner',array('size'=>30));?>';
var c_id="<?php echo md5($contractDetails->order_id)?>";

</script>


<script>
var main = function(){
	/**
	active_chat : {
	avatar:  {String} user logo,
	name: {String} name,
	message: {String} message,
	time: {Number} time in milliseconds,
	online_status: {Boolean} true|false,
},
	*/
	
	var login_user = <?php echo !empty($login_member) ? json_encode($login_member) : 'null'; ?>;
	var App = new Vue({
		el: '#message-app',
		data: {
			active_chat: <?php echo $active_chat ? json_encode($active_chat) : 'null'; ?>,
			login_user: login_user,
			lastMessage: new Date().getTime(),
			lastMessageReceived: new Date().getTime(),
			refresh_attachment: null,
		},
		methods: {
			setActiveChat: function(d){
				this.active_chat = d;
			},
			updateMessage: function(){
				this.lastMessage = new Date().getTime();
			},
			updateLastSeenMsg: function(last_seen_msg){
				this.active_chat.last_seen_msg = last_seen_msg;
			},
			updateAttachment: function(attachment){
				this.refresh_attachment = attachment;
			}
		}
	});
	
	AppService.on('new_message', function(data){
		if(data > 0){
			App.lastMessageReceived = new Date().getTime();
		}
	});
	
	AppService.on('msg_seen_update', function(data){
		if(data.last_message_id != 'undefined'){
			if(App.active_chat && data.conversations_id == App.active_chat.conversations_id){
				App.updateLastSeenMsg(data.last_message_id);
				$.post('<?php echo base_url('message/reset_msg_seen')?>');
				App.updateMessage();
			}
		}
	});
	
	
	
};

</script>
