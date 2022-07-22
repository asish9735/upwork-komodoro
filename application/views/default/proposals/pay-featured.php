<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->currentlang=$this->config->config['language'];
$featured_fee=get_setting('featured_fee');
$processing_fee=0;
$featured_duration=get_setting('featured_duration');
$current_balance=$balance;
$s_currency=CURRENCY;

$enable_bank =0;
$total = $processing_fee+$featured_fee;
$p=0;
$is_join_payment=0;
?>
<div id="featured-listing-modal" class="modal fade">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content mycustom-modal">
			<div class="modal-header">
				<h5 class="modal-title"> <?php echo (__('pay_featured_page_heading','Make Your Proposal/Service Featured'))?></h5>
				<button class="close" data-bs-dismiss="modal">
					<span>&times;</span>
				</button>
			</div>
		<div class="modal-body">
			<div class="order-details">
				<div class="request-div">
					<h4 class="mb-3">
						<b><?php echo (__('pay_featured_page_fee_info','FEATURE LISTING FEE & INFO:'))?></b> <span class=" pull-right d-none d-sm-block mb-3 font-weight-bold"><?php echo (CURRENCY); ?><?php echo ($featured_fee); ?></span>
					</h4>

					<p>
					<?php echo (__('pay_featured_page_fee_info_text_part_1',"You are about to pay a feature listing fee for your proposal/service. This will make this proposal/service feature on our \"Featured proposal/service\" spots. The fee is "))?>	
						<?php echo (CURRENCY); ?><?php echo ($featured_fee); ?> <?php echo (__('pay_featured_page_fee_info_text_part_2',"and the duration is"))?> <?php echo ($featured_duration); ?> <?php echo (__('pay_featured_page_fee_info_text_part_3',"Days. Please use any of the following payment methods below to complete payment."))?>

					</p>

					<h4><b><?php echo (__('pay_featured_page_SUMMARY','SUMMARY:'))?></b></h4>

					<p><b><?php echo (__('pay_featured_page_Proposal_Title','Proposal Title:'))?></b> <?php echo $proposal_details->proposal_title; ?></p>
					<p><b><?php echo (__('pay_featured_page_Feature_Duration','Listing Duration:'))?></b> <?php echo ($featured_duration); ?> <?php echo (__('pay_featured_page_Days','Days.'))?></p>

				</div>

			</div>

			<div class="payment-options-list">
			
			
			
				<p>
					<?php echo (__('cart_checkout_page_Personal_Balance',"Personal Balance"));?> :
					<span class="text-site h4"><?php echo ($s_currency); ?><?php echo ($current_balance); ?></span>
				</p>
                
                
				<?php if($current_balance >= $featured_fee){ ?>
				  
				<?php }else{?>
					<p class="alert alert-warning">You don't have sufficiant balance. click <a target="_blank" href="<?php echo base_url('myfinance')?>">here</a> to add fund.</p>
				<?php }?> 
                 
                
                
                
               
             
               

            
            </div>

		</div>

		<div class="modal-footer ">

            <button class="btn btn-secondary" data-bs-dismiss="modal"> Close </button>
			<?php if($current_balance >= $featured_fee){ ?>
				<form action="" method="post" id="shopping-balance-form" class="checkoutForm" onsubmit="return processCheckout(this);return false;">
					<input type="hidden" name="method" value="wallet">
					<button class="btn btn-site btn-block saveBTN" type="submit" name="checkout_submit_order">
						<?php echo (__('paymentmethod_page_Pay',"Pay"));?>
					</button>
				</form>      
				<?php }?>


        </div>

	</div>

</div>


</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#featured-listing-modal").modal("show");

});

</script>
<script>
var SPINNER='<span class="spinner-border spinner-border-sm"></span>';
function processCheckout(ev){
	var formID= $(ev).attr('id');
	var buttonsection=$('#'+formID).find('.saveBTN');
	var buttonval = buttonsection.html();
	buttonsection.html(SPINNER).attr('disabled','disabled');
	$.ajax({
			method: "POST",
			dataType: 'json',
			url: "<?php echo (get_link('processFeaturedFormCheckAJAXURL').'/'.$proposal_details->proposal_id)?>",
			data: $('#'+formID).serialize(),
			success: function(msg) {
				buttonsection.html(buttonval).removeAttr('disabled');
				if (msg['status'] == 'OK') {
					if(msg['method']=='wallet'){
						window.location.href=msg['redirect'];
					}
					
				} else if (msg['status'] == 'FAIL') {
					
				}
			}
		})
	
	return false;
}
</script>