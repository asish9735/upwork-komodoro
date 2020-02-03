<?php defined('BASEPATH') OR exit('No direct script access allowed');
$currency=priceSymbol();
?>
<ul class="dashboard-box-list">
<?php if($invoiceData){
foreach($invoiceData as $l=>$invoice){
$invoice_url=get_link('InvoiceDetailsURL').'/'.md5($invoice->invoice_id);
?>
<li>
	<div class="job-listing width-adjustment">
		<div class="job-listing-details">
			<div class="job-listing-description">
				<h3 class="job-listing-title">
					<a href="<?php echo $invoice_url;?>" target="_blank"><?php echo make_invoice_number($invoice->invoice_number);?></a>
					<?php if($invoice->invoice_status==1){?>
					<span class="dashboard-status-button green">Paid</span>
					<?php }elseif($invoice->invoice_status==2){?>
					<span class="dashboard-status-button red">Rejected</span>
					<a href="<?php D(VZ);?>" data-tippy-placement="top" title="<?php echo $invoice->change_reason; ?>"> <i class="icon-feather-info"></i> </a>
					<?php }else{?>
					<span class="dashboard-status-button yellow">Pending</span>
					<?php }?>
				</h3>

				<div class="job-listing-footer">
					<ul>
						<li><b>Total:</b> <?php echo $currency.displayamount($invoice->total,2);?></li>
						<li><b>Date:</b> <?php echo $invoice->invoice_date;?></li>
					</ul>
				</div>
			</div>
		</div>
		<!-- Buttons -->
		<div class="buttons-to-right_ always-visible_">
			<?php if($member_id==$invoice->recipient_member_id && $invoice->invoice_status==0){?>
				<button class="btn btn-success btn-sm acceptbtn" data-sid="<?php echo md5($invoice->invoice_id);?>">Accept</button>&nbsp;
      			<button class="btn btn-danger btn-sm denybtn" data-sid="<?php echo md5($invoice->invoice_id);?>">Reject</button>
			<?php }?>
			<a href="<?php echo $invoice_url;?>" target="_blank" class="btn btn-sm btn-outline-site ico" data-tippy-placement="top" data-tippy="" title="View">
				<i class="icon-feather-eye"></i>
			</a>
		</div>
	</div>
</li>
<?php		
}
}else{?>
<li><p>No record</p></li>
<?php }?>
</ul>

<script>
$(document).ready(function(){
	$('.acceptbtn').click(function(){
		var buttonsection=$(this);
		var sid=$(this).data('sid');
		bootbox.confirm({
			title:'Invoice Accept Confimation',
			message: 'By accept, invoice will mark as paid and amount will transfer.',
			buttons: {
			'confirm': {
				label: 'Confirm',
				className: 'btn-site pull-right'
				},
			'cancel': {
				label: 'Cancel',
				className: 'btn-dark pull-left'
				}
			},
			callback: function (result) {
				if(result){
					var buttonval = buttonsection.html();
					buttonsection.html(SPINNER).attr('disabled','disabled');
					$.post( "<?php echo get_link('InvoiceActionAjaxURL');?>",{'action_type':'accept','sid':sid}, function( msg ) {
						if (msg['status'] == 'OK') {
							bootbox.alert({
								title:'Invoice Accepted',
								message: '<?php D(__('invoice_accept_success_message','Invoice accepted succesfully'));?>',
								buttons: {
								'ok': {
									label: 'Ok',
									className: 'btn-site pull-right'
									}
								},
								callback: function () {
									location.reload();
							    }
							});
						} else if (msg['status'] == 'FAIL') {
							if(msg['popup']){
								if(msg['popup']=='fund'){
									bootbox.alert({
										title: 'Insufficient funds',
										message: 'You do not have sufficient balance to approve. Please add fund <?php echo $currency;?>'+msg['amount_due']+' amount to your wallet.',
										size: 'small',
										buttons: {
											ok: {
												label: "Ok",
												className: 'btn-site pull-right'
											},
										},
										callback: function(result){
											window.open('<?php echo get_link('AddFundURL');?>?pre_amount='+msg['amount_due'],'_blank');
										}
									});
								}
							}else{
								bootbox.alert({
									title:'Invoice Accepted',
									message: '<?php D(__('invoice_accept_error_message',"Opps! . Please try again."));?>',
									buttons: {
									'ok': {
										label: 'Ok',
										className: 'btn-site pull-right'
										}
									},
									callback: function () {
										location.reload();
								    }
								});
							
							}
						}
						buttonsection.html(buttonval).removeAttr('disabled');
					},'JSON');
				}
			}
		});
	});
	$('.denybtn').click(function(){
		var sid=$(this).data('sid');
		$('#sid').val(sid);
		$('#action_invoice_modal').modal('show');
	});
	loadtooltip();
})	
</script>


