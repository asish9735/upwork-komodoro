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


<section class="section">
<div class="container">
        <h1><?php echo $contractDetails->proposal_title;?></h1>
        <ul class="nav nav-tabs mb-3">
          <li class="nav-item"> <a class="nav-link" href="<?php echo $contract_details_url;?>"><?php echo (__('order_details_page_Order_Activity',"Order Activity"));?></a> </li>
          <li class="nav-item"> <a class="nav-link" href="<?php echo $contract_message_url;?>"><?php echo __('contract_details_mesage','Messages & Files');?></a> </li>
          <?php if($contractDetails->order_status == ORDER_PENDING or $contractDetails->order_status == ORDER_PROCESSING or $contractDetails->order_status == ORDER_DELIVERED or $contractDetails->order_status == ORDER_REVISION){ ?>
		  <li class="nav-item"> <a class="nav-link active" href="<?php echo $contract_resolution_url;?>"><?php echo (__('order_details_page_Resolution_Center',"Resolution Center"));?></a> </li>
		  <?php }?>
          <li class="nav-item"> <a class="nav-link" href="<?php echo $contract_term_url;?>"><?php echo __('contract_details_term','Terms & Settings');?></a> </li>
        </ul>
        <div class="row">
			<div class="col-xl-9 col-lg-8 col-12">
				<div class="card">
            		<div class="card-header"><h4><?php echo (__('order_details_page_Order_Cancellation_Request',"Order Cancellation Request"));?></h4></div>
					<div class="card-body">                      
						<form method="post" id="resolutionForm" onsubmit="return performAction(this);return false;">
							<input type="hidden" name="action" value="submit_cancellation_request"/>
							<div class="form-group">
								<label>Desciption</label>
								<textarea name="cancellation_message" id="cancellation_message" placeholder="<?php echo (__('order_details_page_Order_Cancellation_Request_input',"Please be as detailed as possible..."));?>" rows="5" class="form-control" ></textarea>
							</div>
							<div class="form-group">
								<label> <?php echo (__('order_details_page_Cancellation_Request_Reason',"Cancellation Request Reason"));?> </label>
								<select name="cancellation_reason" class="form-control" id="cancellation_reason">
								<option class="hidden"> <?php echo (__('order_details_page_Select_Cancellation_Reason',"Select Cancellation Reason"));?> </option>
								<?php if($orderDetails->seller_id == $loggedInUserId){ ?>
								<option> <?php echo (__('order_details_page_Cancellation_Reason_option_seller_1',"Buyer is not responding."));?> </option>
								<option> <?php echo (__('order_details_page_Cancellation_Reason_option_seller_2',"Buyer is extremely rude."));?> </option>
								<option> <?php echo (__('order_details_page_Cancellation_Reason_option_seller_3',"Buyer requested that I cancel this order."));?></option>
								<option> <?php echo (__('order_details_page_Cancellation_Reason_option_seller_4',"Buyer expects more than what this gig can offer."));?></option>
								<?php }elseif($orderDetails->buyer_id == $loggedInUserId){ ?>
								<option> <?php echo (__('order_details_page_Cancellation_Reason_option_buyer_1',"Freelancer is not responding."));?> </option>
								<option> <?php echo (__('order_details_page_Cancellation_Reason_option_buyer_2',"Freelancer is extremely rude."));?> </option>
								<option> <?php echo (__('order_details_page_Cancellation_Reason_option_buyer_3',"Order does meet requirements."));?> </option>
								<option> <?php echo (__('order_details_page_Cancellation_Reason_option_buyer_4',"Freelancer asked me to cancel."));?> </option>
								<option> <?php echo (__('order_details_page_Cancellation_Reason_option_buyer_5',"Freelancer cannot do required task."));?> </option>
								<?php }  ?>
								</select>
							</div>
							<button type="submit" name="submit_cancellation_request" class="btn btn-site float-right saveBTN"><?php echo (__('order_details_page_Submit',"Submit"));?></button>
                		</form>
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

	
	
};
function performAction(ev){
	var formID=$(ev).attr('id');
	if(formID=='accept_request' || formID=='decline_request'){
		var forminput='action='+formID;
		var buttonsection=$('#'+formID);
	}else{
		var modal=$(ev).closest('.modal');
		var buttonsection=$('#'+formID).find('.saveBTN');
		var forminput=$('#'+formID).serialize();
	}
	var buttonval = buttonsection.html();
	buttonsection.html(SPINNER).attr('disabled','disabled');
	$.ajax({
        type: "POST",
        url: "<?php echo (get_link('OrdersaveActionURLAJAX'))?>/<?php echo ($orderDetails->order_id)?>",
        data:forminput,
        dataType: "json",
        cache: false,
        success: function(msg) {
          buttonsection.html(buttonval).removeAttr('disabled');
          clearErrors();
          if (msg['status'] == 'OK') {
            $(modal).modal('hide');
            var message='<?php echo (__('popup_order_details_action_success',"Your request has been submitted successfully!"));?>';
            if(msg['message']){
              message=msg['message'];
            }
            bootbox.alert({
              title: 'Operation Response',
              message: message,
              size: 'small',
              buttons: {
                ok: {
                  label: "Ok",
                  className: 'btn-site pull-right'
                },
              },
              callback: function () {
                  window.location.href=msg['redirect'];
                }
            })
          } else if (msg['status'] == 'FAIL') {
            registerFormPostResponse(formID,msg['errors']);
          }
        }
	})
	
	return false;
}
</script>
