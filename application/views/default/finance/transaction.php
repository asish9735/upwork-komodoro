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
			<h3><i class="icon-material-outline-credit-card text-site"></i> Transaction</h3>
			</div>
			<div class="content with-padding">	
            	<label class="form-label">Select date for which you want your transaction history</label>
				<div class="row">
					<div class="col-md-4">                    	
						<div class="input-with-icon-left">
		                    <i class="icon-feather-calendar"></i>
		                    <input type="text" name="amount" id="amount" class="form-control datepicker">
						</div>						
					</div>
                    <div class="col-md-4">                    	
						<div class="input-with-icon-left">
		                    <i class="icon-feather-calendar"></i>
		                    <input type="text" name="amount" id="amount" class="form-control datepicker">
						</div>						
					</div>
                    <div class="col-md-4">
                    	<button class="btn btn-site">Go</button>
                        &nbsp;
                        <button class="btn btn-site">Download CSV</button>
                    </div>
				</div>
				<div>
                
                </div>
            </div>
            </div>
			<div class="fun-facts-container">
                <div class="fun-fact" data-fun-fact-color="#37bf00">
                	<div class="fun-fact-icon"><i class="icon-feather-credit-card"></i></div>
                    <div class="fun-fact-text">
                        <span>Total Debit</span>
                        <h4> 1773.00</h4>
                    </div>
                </div>
                <div class="fun-fact" data-fun-fact-color="#f00">
                    <div class="fun-fact-icon"><i class="icon-feather-credit-card"></i></div>
                    <div class="fun-fact-text">
                        <span>Total Credit</span>
                        <h4> 28045.00</h4>
                    </div>
                </div>                
           </div>
            <div class="dashboard-box">
                <div class="headline">
                    <h3><i class="icon-feather-dollar-sign text-site"></i> Transaction Details</h3>
                </div>
                <div class="content">
                    <ul class="dashboard-box-list">
                        <li>
                            <div class="invoice-list-item">
                            <strong>Commission deducted</strong>
                                <ul>
                                    <li><span class="paid">Success</span></li>
                                    <li><b>Credit:</b> <?php echo CURRENCY;?>100.00</li>
                                    <li><b>Debit:</b> <?php echo CURRENCY;?>20.00</li>
                                    <li><b>Date:</b> 03 Jan, 2019 03:11 PM</li>
                                </ul>
                            </div>   
                            <!-- Buttons -->
                            <div class="buttons-to-right single-right-button always-visible">
                                <a href="#" class="button">Button</a>
                            </div>                         
                        </li>
                        <li>
                            <div class="invoice-list-item">
                            <strong>Project payment received</strong>
                                <ul>
                                    <li><span class="unpaid">Reject</span></li>
                                    <li><b>Credit:</b> <?php echo CURRENCY;?>100.00</li>
                                    <li><b>Debit:</b> <?php echo CURRENCY;?>20.00</li>
                                    <li><b>Date:</b> 03 Jan, 2019 03:11 PM</li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <div class="invoice-list-item">
                            <strong>Bid Purchase</strong>
                                <ul>
                                    <li><span class="paid">Success</span></li>
                                    <li><b>Credit:</b> <?php echo CURRENCY;?>100.00</li>
                                    <li><b>Debit:</b> <?php echo CURRENCY;?>20.00</li>
                                    <li><b>Date:</b> 03 Jan, 2019 03:11 PM</li>
                                </ul>
                            </div>
                        </li>                        
                    </ul>
                </div>
            </div>
		</div>
	</div>
	<!-- Dashboard Content / End -->

</div>
<!-- Dashboard Container / End -->

<script type="text/javascript">
var SPINNER='<?php load_view('inc/spinner',array('size'=>30));?>';

var main=function(){
	$('.datepicker').datetimepicker({
		format: 'YYYY-MM-DD',
		maxDate: "<?php echo date('Y-m-d');?>"
	});
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