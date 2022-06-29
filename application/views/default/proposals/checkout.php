<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->currentlang=$this->config->config['language'];

$current_balance=$balance;
$sub_total=$CheckOutData['sub_total'];
$s_currency=CURRENCY;
$processing_fee=0;
$total = $processing_fee+$sub_total;
//dd($proposal_details,TRUE);
//dd($CheckOutData,TRUE);
$p=0;
$is_join_payment=0;
if($current_balance>0){
	$is_join_payment=1;
}
$proposal_image=UPLOAD_HTTP_PATH.'proposals-files/proposals-thumb/'.$proposal_details->proposal_image;
?>

<div class="container mt-5 mb-5">
  <div class="row">
    <div class="col-md-7">
      <div class="card payment-options mb-4">
        <div class="card-header">
          <h4><?php echo (__('cart_checkout_page_Available_Balance',"Available Shopping Balance"));?></h4>
        </div>
        <div class="card-body">
          <?php /*?><div class="row" hidden>
								<div class="col-1">
								<?php if($current_balance >=$sub_total){?>
									<input id="shopping-balance" type="radio" name="method" class="form-control radio-input" checked data-processing-fee-text="0" data-processing-fee="0" data-total="<?php echo ($sub_total);?>">
								<?php }?>
								</div>
							</div><?php */?>
          <p> <?php echo (__('cart_checkout_page_Personal_Balance',"Personal Balance"));?> : <span class="text-site h4"><?php echo ($s_currency); ?><?php echo ($current_balance); ?></span> </p>
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <div class="card checkout-details">
        <div class="card-header">
          <h4><?php echo (__('cart_checkout_page_Order_Summary',"Order Summary"));?> </h4>
        </div>
        <div class="card-body">
          <div class="row row-10">
            <div class="col-4 mb-3"> <img src="<?php echo $proposal_image; ?>" class="img-fluid rounded"> </div>
            <div class="col-8">
              <h5><?php echo $proposal_details->proposal_title; ?></h5>
              <p class="mb-0">Package : <?php echo $proposal_details->package->package_name;?></p>
              <p class="mb-0">Deliery Time : <?php echo $proposal_details->package->delivery_time;?> days</p>
            </div>
          </div>
          <p class="d-flex justify-content-between"><?php echo (__('cart_checkout_page_Proposal_Price',"Proposal's Price:"));?> <span><?php echo ($s_currency); ?><?php echo ($CheckOutData['proposal_price']); ?> </span></p>
          <p class="d-flex justify-content-between"><?php echo (__('cart_checkout_page_Proposal_Quantity',"Proposal's Quantity:"));?> <span><?php echo ($CheckOutData['qty']); ?></span></p>
          <p class="justify-content-between processing-fee d-none" ><?php echo (__('cart_checkout_page_Processing_Fee',"Processing Fee:"));?> <span><?php echo ($s_currency); ?>
            <ec><?php echo ($processing_fee); ?></ec>
            </span></p>
          <h5 class="d-flex justify-content-between mb-4"> <?php echo (__('cart_checkout_page_Proposal_Total_Remain',"Pay Total:"));?> <span class="total-price"><?php echo ($s_currency); ?><?php echo ($total); ?> </span> </h5>
          <?php if($current_balance >= $sub_total){ ?>
          <form action="" method="post" id="shopping-balance-form" class="checkoutForm" onsubmit="return processCheckout(this);return false;">
            <input type="hidden" name="method" value="wallet">
            <button class="btn btn-site btn-block saveBTN" type="submit" name="checkout_submit_order"> <?php echo (__('paymentmethod_page_Pay',"Pay"));?> </button>
          </form>
          <?php }else{?>
          <p class="alert alert-warning">You don't have sufficiant balance. click <a target="_blank" href="<?php echo get_link('AddFundURL')?>">here</a> to add fund.</p>
          <?php }?>
        </div>
      </div>
    </div>
  </div>
</div>
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
			url: "<?php echo (get_link('processCheckoutFormCheckAJAXURL'))?>",
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