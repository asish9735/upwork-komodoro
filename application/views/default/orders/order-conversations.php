<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$seller_user_name=$orderDetails->seller->member_name;
$buyer_user_name=$orderDetails->buyer->member_name;
if($orderconversations){
	foreach($orderconversations as $k=>$conversation){
		if($conversation->sender_id==$orderDetails->seller_id){
			$sender_user_name=$seller_user_name;
		}elseif($conversation->sender_id==$orderDetails->buyer_id){
			$sender_user_name=$buyer_user_name;
		}else{
			$sender_user_name='';
		}
		if($conversation->status == "message"){ 
?>
	<div class="d-flex mb-3 <?php echo (($conversation->sender_id==$loggedUserID? 'message-div-hover':' message-div'))?>">
		<img src="<?php echo (getMemberLogo($conversation->sender_id)); ?>" width="50" height="50" class="message-image">	
		<div class="flex-grow-1 ms-3">
        <h5 class="seller-buyer-name"><?php /*echo ($conversation->member_name);*/ echo ($sender_user_name);?></h5>
        <span class="chat-date"> 
			<i class="icon-feather-calendar"></i> <?php echo (date('H:i ',strtotime($conversation->date)).dateFormat($conversation->date,'F d, Y')); ?> 
            <?php /* if($loggedUserID!= $conversation->sender_id){ ?>
            | <a href="javascript:void(0)" data-toggle="modal" data-target="#report-modal" class="text-muted"><i class="fa fa-flag"></i> <?php echo (__('order_conversation_page_Report',"Report"));?></a> 
            <?php } */ ?>
            </span>
		<p class="message-desc">
			<?php echo ($conversation->message); ?>
			<?php if(!empty($conversation->file)){ ?>
				<a target="_blank" href="<?php echo (UPLOAD_HTTP_PATH.'orders-files/'.$conversation->file)?>" class="d-block mt-2 ms-1" download>
					<i class="icon-feather-download"></i> <?php echo $conversation->file; ?>
				</a>
				
			<?php }?>
		</p>
        </div>
	</div>
<?php	
		}
		elseif($conversation->status == "delivered"){	
		$order_complete_time = new DateTime($orderDetails->complete_time);
		$remain = $order_complete_time->diff(new DateTime());
		if($remain->d < 1){ $remain->d = 1; }
?>
	<div class="card card-alert">
		<div class="card-body">
		<h5 class="text-center"><i class="fa fa-archive"></i> <?php echo (__('order_conversation_page_Order_Delivered',"Order Delivered"));?></h5>
		  <?php /* if($orderDetails->seller_id == $loggedUserID){ ?>
		  <p class="text-center font-weight-bold pb-0"><?php echo (__('order_conversation_page_The_buyer_has',"The buyer has"));?> <?php echo $remain->d; ?> <?php echo (__('order_conversation_page_days_to_complete',"day(s) to complete/respond to this order, otherwise it will be automatically marked as completed."));?></p>
		  <?php } else { ?>
		   <p class="text-center font-weight-bold pb-0"><?php echo (__('order_conversation_page_You_have',"You have"));?> <?php echo $remain->d; ?> <?php echo (__('order_conversation_page_days_to_complete',"day(s) to complete/respond to this order, otherwise it will be automatically marked as completed."));?></p>
		  <?php } */ ?>
          <div class="d-flex mb-3 <?php echo (($conversation->sender_id==$loggedUserID? 'message-div-hover':' message-div'))?>"><!--- message-div Starts --->
		<img src="<?php echo (getMemberLogo($conversation->sender_id)); ?>" width="48" height="48" class="message-image">
        <div class="flex-grow-1 ms-3">
	    <h5 class="seller-buyer-name"><?php /*echo ($conversation->member_name);*/ echo ($sender_user_name);?></h5>
            <span class="chat-date"><i class="icon-feather-calendar"></i> <?php echo (date('H:i ',strtotime($conversation->date)).dateFormat($conversation->date,'F d, Y')); ?></span>
		
		<p class="message-desc">
			<?php echo ($conversation->message); ?>
			<?php if(!empty($conversation->file)){ ?>
				<a target="_blank" href="<?php echo (UPLOAD_HTTP_PATH.'orders-files/'.$conversation->file)?>" class="d-block mt-2 ms-1" download>
					<i class="icon-feather-download"></i> <?php echo $conversation->file; ?>
				</a>
			<?php }?>
		</p>
        </div>
	</div><!--- message-div Ends --->
		</div>
	</div>
	
	<?php
			if($orderDetails->order_status ==ORDER_DELIVERED){
				if($orderDetails->buyer_id==$loggedUserID){
	?>
	<center class="pb-4 mt-4"><!-- mb-4 mt-4 Starts --->
		<form method="post" id="reportrequestForm" onsubmit="return performAction(this);return false;">
		    <input type="hidden" name="action" value="complete"/>
			<button name="complete" type="submit" class="btn btn-success saveBTN">
				<?php echo (__('order_conversation_page_Accept_Review_Order',"Accept & Review Order"));?>
			</button>
			&nbsp;&nbsp;&nbsp;
			<button type="button" data-toggle="modal" data-target="#revision-request-modal" class="btn btn-success">
				<?php echo (__('order_conversation_page_Request_A_Revison',"Request A Revison"));?>
			</button>
		</form>
		<?php 
		if(isset($_POST['complete'])){
		  //require_once("orderIncludes/orderComplete.php");
		}
		?>
	</center><!-- mb-4 mt-4 Ends --->
	<?php		
				}
			}
		
		}
		elseif($conversation->status == "revision"){
	?>
	<div class="card card-alert mb-4">
	   <div class="card-body">
	   	<h5 class="text-center">
	   		<i class="fa fa-pencil-square-o"></i> <?php echo (__('order_conversation_page_Revison_Requested_By',"Revison Requested By"));?> <?php /*echo ($conversation->member_name);*/ echo ($sender_user_name); ?> 
	   	</h5>
        <div class="d-flex mb-3 <?php echo (($conversation->sender_id==$loggedUserID? 'message-div-hover':' message-div'))?>"><!--- message-div Starts --->
		<img src="<?php echo (getMemberLogo($conversation->sender_id)); ?>" width="48" height="48" class="message-image">
	    <div class="flex-grow-1 ms-3">
        <h5 class="seller-buyer-name"><?php /*echo ($conversation->member_name);*/ echo ($sender_user_name);?></h5>
		<span class="chat-date"><i class="icon-feather-calendar"></i> <?php echo (date('H:i ',strtotime($conversation->date)).dateFormat($conversation->date,'F d, Y')); ?></span>
		
		<p class="message-desc">
			<?php echo ($conversation->message); ?>
			<?php if(!empty($conversation->file)){ ?>
				<a target="_blank" href="<?php echo (UPLOAD_HTTP_PATH.'orders-files/'.$conversation->file)?>" class="d-block mt-2 ms-1" download>
					<i class="icon-feather-download"></i> <?php echo $conversation->file; ?>
				</a>				
			<?php }?>
		</p>
        </div>
	</div>
	   </div>
	</div>
	
	<?php			
		}
		elseif($conversation->status == "cancellation_request"){
	?>
	<div class="card card-alert">
    	<div class="card-header">
    		<h5 class="text-center text-danger">
	   		<i class="icon-feather-x-circle"></i> <?php echo (__('order_conversation_page_Cancellation_Requested_By',"Cancellation Requested By"));?> <?php /*echo ($conversation->member_name);*/ echo ($sender_user_name); ?> 
	   	</h5></div>
		<div class="card-body">
           <div class="d-flex mb-3 <?php echo (($conversation->sender_id==$loggedUserID? 'message-div-hover':' message-div'))?>"><!--- message-div Starts --->
            <img src="<?php echo (getMemberLogo($conversation->sender_id)); ?>" width="50" height="50" class="message-image">
            <div class="flex-grow-1 ms-3">
            <h5 class="seller-buyer-name"><?php /*echo ($conversation->member_name);*/ echo ($sender_user_name); ?> </h5>
                <span class="chat-date"><i class="icon-feather-calendar"></i> <?php echo (date('H:i ',strtotime($conversation->date)).dateFormat($conversation->date,'F d, Y')); ?>
            	</span>
            
            <p class="message-desc">
                <?php echo ($conversation->message); ?>
                <?php if(!empty($conversation->file)){ ?>
                    <a target="_blank" href="<?php echo (UPLOAD_HTTP_PATH.'orders-files/'.$conversation->file)?>" class="d-block mt-2 ms-1" download>
                        <i class="icon-feather-download"></i> <?php echo $conversation->file; ?>
                    </a>
                    
                <?php }?>
            </p>
            
            <?php if($conversation->sender_id != $loggedUserID){?>
            <form class="mb-2"  method="post" id="reportrequestForm" >
                <center>
                    <button name="accept_request" id="accept_request" type="button" class="btn btn-success btn-sm" onclick="return performAction(this);return false;"><?php echo (__('order_conversation_page_Accept_Request',"Accept Request"));?></button> &nbsp;
                    <button name="decline_request" id="decline_request" type="button" class="btn btn-danger btn-sm" onclick="return performAction(this);return false;"><?php echo (__('order_conversation_page_Decline_Request',"Decline Request"));?></button>
               </center>
            </form>
            <?php }?>
            </div>
        </div>	
	   </div>
	</div>
	
	<?php		
		}
		elseif($conversation->status == "decline_cancellation_request"){
	?>
	<div class="card card-alert">
		<div class="card-header">
	   	<h5 class="text-center mb-0 text-danger">
	   		<i class="icon-feather-x-circle"></i> <?php echo (__('order_conversation_page_Cancellation_Request_Declined_By',"Cancellation Request Declined By"));?> <?php /*echo ($conversation->member_name);*/ echo ($sender_user_name); ?>
	   	</h5>
        </div>
        <div class="card-body">
        <div class="d-flex mb-3 <?php echo (($conversation->sender_id==$loggedUserID? 'message-div-hover':' message-div'))?>"><!--- message-div Starts --->
		<img src="<?php echo (getMemberLogo($conversation->sender_id)); ?>" width="50" height="50" class="message-image">
        <div class="flex-grow-1 ms-3">
	    <h5 class="seller-buyer-name"><?php /*echo ($conversation->member_name);*/ echo ($sender_user_name); ?> </h5>
            <span class="chat-date"><i class="icon-feather-calendar"></i> <?php echo (date('H:i ',strtotime($conversation->date)).dateFormat($conversation->date,'F d, Y')); ?></span>
		
		<p class="message-desc">
			<?php echo ($conversation->message); ?>
			<?php if(!empty($conversation->file)){ ?>
				<a target="_blank" href="<?php echo (UPLOAD_HTTP_PATH.'orders-files/'.$conversation->file)?>" class="d-block mt-2 ms-1" download>
					<i class="icon-feather-download"></i> <?php echo $conversation->file; ?>
				</a>
				
			<?php }?>
		</p>
        </div>
		</div>
	   </div>
	</div>
	
	<div class="order-status-message"><!--- order-status-message Starts --->
		<h5 class="text-danger">
			<i class="icon-feather-x-circle"></i> <?php echo (__('order_conversation_page_Cancellation_Request_Declined_By',"Cancellation Request Declined By"));?> <?php echo (($conversation->sender_id==$orderDetails->seller_id ? __('order_conversation_page_Buyer','Buyer'):__('order_conversation_page_Freelancer','Freelancer'))); ?>
		</h5>
	</div>
	
	<?php		
		}
		elseif($conversation->status == "accept_cancellation_request"){
	?>
	<div class="card card-alert">
    	<div class="card-header">
	   		<h5 class="text-center mb-0 text-danger">
            <i class="icon-feather-x-circle"></i> <?php echo (__('order_conversation_page_Cancellation_Request_By',"Cancellation Request By"));?> <?php /*echo ($conversation->member_name);*/ echo ($sender_user_name); ?>
	   	</h5>
        </div>
        <div class="card-body">
            <div class="d-flex mb-3 <?php echo (($conversation->sender_id==$loggedUserID? 'message-div-hover':' message-div'))?>"><!--- message-div Starts --->
            <img src="<?php echo (getMemberLogo($conversation->sender_id)); ?>" width="50" height="50" class="message-image">
            <div class="flex-grow-1 ms-3">
            <h5 class="seller-buyer-name"><?php /*echo ($conversation->member_name);*/ echo ($sender_user_name); ?></h5>
                <span class="chat-date"><i class="icon-feather-calendar"></i> <?php echo (date('H:i ',strtotime($conversation->date)).dateFormat($conversation->date,'F d, Y')); ?></span>
            
            <p class="message-desc">
                <?php echo ($conversation->message); ?>
                <?php if(!empty($conversation->file)){ ?>
                    <a target="_blank" href="<?php echo (UPLOAD_HTTP_PATH.'orders-files/'.$conversation->file)?>" class="d-block mt-2 ms-1" download>
                        <i class="icon-feather-download"></i> <?php echo $conversation->file; ?>
                    </a>
                    
                <?php }?>
            </p>
            </div>
            
        	</div>
	    </div>
	</div>
	
	<?php if($orderDetails->seller_id == $loggedUserID){ ?>
	<div class="order-status-message"><!-- order-status-message Starts --->
		<h5 class="text-danger"><i class="icon-feather-x-circle"></i> <?php echo (__('order_conversation_page_Order_Cancelled_By_Mutual_Agreement',"Order Cancelled By Mutual Agreement."));?> </h5>
		<p>
			<?php echo (__('order_conversation_page_Order_Cancelled_By_Mutual_Agreement_info_seller',"Order Was Cancelled By A Mutual Agreement Between You and Your Buyer. <br>Funds have been refunded to buyer's account."));?>
		</p>
	</div><!-- order-status-message Ends --->
	<?php }else{ ?>
	<div class="order-status-message"><!-- order-status-message Starts --->
		<h5 class="text-danger"><i class="icon-feather-x-circle"></i> <?php echo (__('order_conversation_page_Order_Cancelled_By_Mutual_Agreement',"Order Cancelled By Mutual Agreement."));?> </h5>
		<p>
			<?php echo (__('order_conversation_page_Order_Cancelled_By_Mutual_Agreement_info_buyer',"Order was cancelled by a mutual agreement between you and your freelancer.<br>The order funds have been refunded to your Shopping Balance."));?>
		</p>
	</div><!-- order-status-message Ends --->
	<?php 
		}
	}
	elseif($conversation->status == "cancelled_by_customer_support"){
	if($orderDetails->seller_id == $loggedUserID){ ?>
	<div class="order-status-message"><!-- order-status-message Starts --->
		<h5 class="text-danger"><i class="icon-feather-x-circle"></i> <?php echo (__('order_conversation_page_Order_Cancelled_By_Admin',"Order Cancelled By Admin."));?> </h5>
		<p>
			<?php echo (__('order_conversation_page_Order_payment_refunded',"Payment For This Order Was Refunded To Buyer's Shopping Balance."));?> <br>
			<?php echo (__('order_conversation_page_Order_payment_refunded_Further_Assistance',"For Any Further Assistance, Please Contact Our"));?> <a target="_blank" href="<?php echo (get_link('CustomerSupportURL'))?>" class="link"> <?php echo (__('order_conversation_page_Customer_Support',"Customer Support."));?></a>
		</p>
	</div><!-- order-status-message Ends --->
	<?php }else{ ?>
	<div class="order-status-message"><!-- order-status-message Starts --->
		<h5 class="text-danger"><i class="icon-feather-x-circle"></i> <?php echo (__('order_conversation_page_Order_Cancelled_By_Customer_Support',"Order Cancelled By Customer Support."));?> </h5>
		<p>
			<?php echo (__('order_conversation_page_Payment_refunded_to_your',"Payment For This Order Has Been Refunded To Your"));?>
			<a href="<?php echo (get_link('revenueURL'))?>" class="link"> <?php echo (__('order_conversation_page_Shopping_balance',"Shopping balance."));?> </a>
		</p>
	</div><!-- order-status-message Ends --->
		<?php 
			} 
		}
	}
}
?>