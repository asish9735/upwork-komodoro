<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$currency=priceSymbol();
$enable_paypal=get_setting('enable_paypal');
$payfor=1;
$p=0;
$sub_total=0;
?>
<!-- Dashboard Container -->
<div class="dashboard-container">
	<?php echo $left_panel;?>
	<!-- Dashboard Sidebar / End -->
	<!-- Dashboard Content
	================================================== -->
	<div class="dashboard-content-container">
		<div class="dashboard-content-inner" >		
			<!--<div class="dashboard-headline">
				<h3>My Favourite</h3>				
			</div>-->
            <div class="dashboard-box mt-0 mb-4">
			<div class="headline">
			<h3><i class="icon-material-outline-credit-card text-site"></i> Amount</h3>
			</div>
			<div class="content with-padding">	
				<div class="row">
					<div class="col-md-4">
						<div class="input-with-icon-left">
		                    <i><?php echo $currency;?></i>
		                    <input type="text" name="amount" id="amount" class="form-control text-right" placeholder="0" onkeyup="updateTotal('add_fund')" onkeypress="return isNumberKey(event)">
						</div>
						<p><b>Processing Fee:</b> <ec class="processingFeeText">0</ec></p>
					</div>
				</div>
				
            </div>
            </div>
			<div class="dashboard-box mt-0 mb-4">
			<div class="headline">
			<h3><i class="icon-material-outline-credit-card text-site"></i> <?php D(__('cart_checkout_page_Payment_Options',"Payment Options"));?></h3>
			</div>
			<div class="content with-padding">	
             <div class="btn-group btn-group-toggle pricing-group" data-toggle="buttons">                        
            <?php if($enable_paypal == 1){
            	$feeCalculation=generateProcessingFee('paypal',$sub_total);
            $p++;
            ?>            
            <label for="paypal" class="btn btn-outline-black">
            <input type="radio" name="method" id="paypal" data-processing-fee-text="<?php D($feeCalculation['processing_fee_text'])?>" data-processing-fee="<?php D($feeCalculation['processing_fee'])?>" data-total="<?php D($feeCalculation['total_amount']);?>">
            <?php D(__('paymentmethod_page_Pay_By_Paypal',"Pay With Paypal"));?>
            <img src="<?php D(IMAGE)?>paypal.png">
            </label>
            <?php } ?>
            </div>
            
            </div>
            </div>
			<?php if($enable_paypal ==1){ ?>
			<form action="" class="checkoutForm" method="post" id="paypal-form" onsubmit="return processCheckout(this);return false;">
				<input type="hidden" name="method" value="paypal">
				<input type="hidden" name="payfor" value="<?php D($payfor)?>">
				<button type="submit" name="paypal" class="btn btn-site saveBTN"><?php D(__('paymentmethod_page_Pay_With_Paypal',"Pay With Paypal"));?> </button>
			</form>
			<?php } ?>		

		</div>
	</div>
	<!-- Dashboard Content / End -->

</div>
<!-- Dashboard Container / End -->
<script type="text/javascript">
var SPINNER='<?php load_view('inc/spinner',array('size'=>30));?>';

var main=function(){
$('input[name="method"]').click(function(){
	var id=$(this).attr('id');
	var amount=$(this).data('total');
	var fee=$(this).data('processing-fee');
	var feetext=$(this).data('processing-fee-text');
	$('.checkoutForm').hide();
	if(id=='shopping-balance'){
		$('.processing-fee').hide();
	}else{
		$('.processing-fee').show();
	}
	$('.processing-fee ec').html(fee);
	$('.total-price').html('<?php echo $currency; ?>'+amount);
	$('.processingFeeText').html(feetext);
	$('#'+id+'-form').show();
})

$('input[name="method"]:first').click();	
}
function processCheckout(ev){
	var formID= $(ev).attr('id');
	var buttonsection=$('#'+formID).find('.saveBTN');
	var buttonval = buttonsection.html();
	buttonsection.html(SPINNER).attr('disabled','disabled');
	$.ajax({
			method: "POST",
			dataType: 'json',
			url: "<?php if($payfor==1){D(get_link('processAddFundFormCheckAJAXURL'));}?>",
			data: $('#'+formID).serialize()+'&'+$.param({ 'okey': $('input[name="amount"]').val() }),
			success: function(msg) {
				buttonsection.html(buttonval).removeAttr('disabled');
				clearErrors();
				if (msg['status'] == 'OK') {
					if(msg['method']=='wallet' || msg['method']=='bank'){
						
					}else{
						 window.location.href=msg['redirect'];
					}
				} else if (msg['status'] == 'FAIL') {
					bootbox.alert({
						title:'Add Fund',
						message: msg['error'],
						buttons: {
						'ok': {
							label: 'Ok',
							className: 'btn-site pull-right'
							}
						}
					});
				}
			}
		})
	
	return false;
}
function updateTotal(){
	var amount=$('#amount').val();
	if(isNaN(amount)){
		amount=0;
	}
	$('#amount').val(amount);
}
</script>
<?php if(($this->input->get('refer') && $this->input->get('refer')=='paymentsuccess') || ($this->input->get('ref_p') && $this->input->get('ref_p')=='paymentsuccess')){?>
<script>
var mainload=function(){
	bootbox.alert({
		title: '<?php D(__('popup_manageproposal_Payment_Success',"Payment Success"));?>',
		message: 'Payment Successfull',
		size: 'small',
		buttons: {
			ok: {
				label: "Ok",
				className: 'btn-site pull-right'
			},
		},
		callback: function(result){
			window.location.href='<?php D(get_link('AddFundURL'));?>';
		}

	});
}
</script>
<?php }elseif(($this->input->get('refer') && $this->input->get('refer')=='paymenterror') || ($this->input->get('ref_p') && $this->input->get('ref_p')=='paymenterror')){?>
<script>
var mainload=function(){
	bootbox.alert({
		title: '<?php D(__('popup_manageproposal_Payment_Error',"Payment Error"));?>',
		message: 'Payment failed',
		size: 'small',
		buttons: {
			ok: {
				label: "Ok",
				className: 'btn-site pull-right'
			},
		},
		callback: function(result){
			window.location.href='<?php D(get_link('AddFundURL'));?>';
		}

	});
}
</script>
<?php }?>