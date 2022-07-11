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
		  <li class="nav-item"> <a class="nav-link" href="<?php echo $contract_resolution_url;?>"><?php echo (__('order_details_page_Resolution_Center',"Resolution Center"));?></a> </li>
		  <?php }?>
          <li class="nav-item"> <a class="nav-link active" href="<?php echo $contract_term_url;?>"><?php echo __('contract_details_term','Terms & Settings');?></a> </li>
        </ul>
        <div class="row">
			<div class="col-xl-9 col-lg-8 col-12">
				<div class="card">
					<div class="card-header">
						<h4><?php echo __('contract_term_order_info','Order info');?></h4>
					</div>
					<div class="card-body">
						<?php
						if($contractDetails->order_status == ORDER_COMPLETED){
              if($is_buyer){
                ?>
              <div class="row mb-3">
                <div class="col-md-3"><h5><?php echo __('contract_details_feed_contarctor','Your Feedback to Contractor');?></h5></div>
                  <div class="col-md-9">
                  <?php if($orderDetails->buyer_review){ ?>
                    <div class="star-rating" data-rating="<?php echo $orderDetails->buyer_review->buyer_rating;?>"></div>
	               		<p><?php echo nl2br($orderDetails->buyer_review->buyer_review);?></p>
                  <?php }else{?>
                    <form method="post"  id="ratingForm" onsubmit="return performAction(this);return false;">
                      <input type="hidden" name="action" value="review_submit"/>
                      <div class="form-group">
                        <select name="rating" class="rating-select">
                          <option value="1" <?php if($orderDetails->buyer_review && $orderDetails->buyer_review->buyer_rating==1){echo ('selected');}?>>1</option>
                          <option value="2" <?php if($orderDetails->buyer_review && $orderDetails->buyer_review->buyer_rating==2){echo ('selected');}?>>2</option>
                          <option value="3" <?php if($orderDetails->buyer_review && $orderDetails->buyer_review->buyer_rating==3){echo ('selected');}?>>3</option>
                          <option value="4" <?php if($orderDetails->buyer_review && $orderDetails->buyer_review->buyer_rating==4){echo ('selected');}?>>4</option>
                          <option value="5" <?php if($orderDetails->buyer_review && $orderDetails->buyer_review->buyer_rating==5){echo ('selected');}?>>5</option>
                        </select>
                      </div>
                      <textarea name="review" class="form-control mb-3" rows="5" placeholder="<?php echo (__('order_details_page_Review_Rating_input',"What was your Experience?"));?>"><?php if($orderDetails->buyer_review){echo ($orderDetails->buyer_review->buyer_review);}?></textarea>
                      <button type="submit" name="buyer_review_submit" class="btn btn-site btn-sm mb-5 saveBTN">
                      <?php if($orderDetails->buyer_review){echo (__('order_details_page_Update_Review',"Update Review"));}else{echo (__('order_details_page_Submit_Review',"Submit Review"));}?>
                      </button>
                    </form> 
                    
                  <?php }?>
                  </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-3"><h5><?php echo __('contract_details_feed_you',"Contractor's Feedback to You");?></h5></div>
                  <div class="col-md-9">
                  <?php if($orderDetails->seller_review){ ?>
                    <div class="star-rating" data-rating="<?php echo $orderDetails->seller_review->seller_rating;?>"></div>
	               		<p><?php echo nl2br($orderDetails->seller_review->seller_review);?></p>
                  <?php }else{?>
                    <p><?php echo __('contract_term_no_review','No review yet.');?></p>
                  <?php }?>
                  </div>
              </div>
                <?php
              }else{
                ?>
                <div class="row mb-3">    
                  <div class="col-md-3"><h5><?php echo __('contract_details_feed_client','Your Feedback to Client');?></h5></div>
	                <div class="col-md-9">
	               		<?php 
                    if($orderDetails->seller_review){
                    ?>
						        <div class="star-rating" data-rating="<?php echo $orderDetails->seller_review->seller_rating;?>"></div>
	               		<p><?php echo nl2br($orderDetails->seller_review->seller_review);?></p>
                    <?php		
                    }else{
                    ?>
                    <form method="post" id="ratingForm" onsubmit="return performAction(this);return false;">
                      <input type="hidden" name="action" value="review_submit"/>
                      <div class="form-group">
                        <select name="rating" class="rating-select">
                          <option value="1" <?php if($orderDetails->seller_review && $orderDetails->seller_review->seller_rating==1){echo ('selected');}?>>1</option>
                          <option value="2" <?php if($orderDetails->seller_review && $orderDetails->seller_review->seller_rating==2){echo ('selected');}?>>2</option>
                          <option value="3" <?php if($orderDetails->seller_review && $orderDetails->seller_review->seller_rating==3){echo ('selected');}?>>3</option>
                          <option value="4" <?php if($orderDetails->seller_review && $orderDetails->seller_review->seller_rating==4){echo ('selected');}?>>4</option>
                          <option value="5" <?php if($orderDetails->seller_review && $orderDetails->seller_review->seller_rating==5){echo ('selected');}?>>5</option>
                        </select>
                      </div>
                      <textarea name="review" class="form-control mb-3" rows="5" placeholder="<?php echo (__('order_details_page_Review_Rating_input',"What was your Experience?"));?>"><?php if($orderDetails->seller_review){echo ($orderDetails->seller_review->seller_review);}?></textarea>
                      <button type="submit" name="seller_review_submit" class="btn btn-site btn-sm mb-5 saveBTN">
                      <?php if($orderDetails->seller_review){echo (__('order_details_page_Update_Review',"Update Review"));}else{echo (__('order_details_page_Submit_Review',"Submit Review"));}?>
                      </button>
                    </form>
                    <?php		
                      }
                    ?>
	                </div>
               </div>
               <div class="row mb-3">    
	                <div class="col-md-3"><h5><?php echo __('contract_details_client_you',"Client's Feedback to You");?></h5></div>
	                <div class="col-md-9">
                    <?php  
                    if($orderDetails->buyer_review){
                    ?>
                      <div class="star-rating" data-rating="<?php echo $orderDetails->buyer_review->buyer_rating;?>"></div>
                      <p><?php echo nl2br($orderDetails->buyer_review->buyer_review);?></p>
                    <?php 
                    }else{?>
                      <p><?php echo __('contract_term_no_review','No review yet.');?></p>
                    <?php }?>
	               </div>
	            </div>
                <?php
              }
						}
						?>
						<div class="row mb-3">
							<div class="col-md-3"><h5><?php echo __('contract_term_c_date','Contract Date');?></h5></div>
							<div class="col-md-9"><p><?php echo $contractDetails->order_date;?></p></div>
						</div>
						<h5><?php echo __('contract_term_d_work','Description of Work');?></h5>
               			<p><?php echo $contractDetails->proposal_title;?></p>
					</div>
					<div class="card-footer">
						<h5 class="mb-0"><?php echo (__('order_details_page_orderID_number',"Order #"));?><?php echo make_order_number($contractDetails->order_number); ?></h5>
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



<script>
var SPINNER='<?php load_view('inc/spinner',array('size'=>30));?>';

</script>


<script>
var SPINNER='<?php load_view('inc/spinner',array('size'=>30));?>';
var main=function(){
  $('.rating-select').barrating({
		theme: 'fontawesome-stars'
	});
}
function performAction(ev){
	var formID=$(ev).attr('id');
	var buttonsection=$('#'+formID).find('.saveBTN');
	var forminput=$('#'+formID).serialize();
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
            var message='<?php echo (__('popup_order_details_action_success',"Your request has been submitted successfully!"));?>';
            if(msg['message']){
              message=msg['message'];
            }
            bootbox.alert({
              title: 'Submit Review',
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
