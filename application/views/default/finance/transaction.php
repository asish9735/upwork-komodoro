<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$currency=priceSymbol();
//print_r($list);
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
				<form action="" method="get">
				<div class="row">
					<div class="col-md-6">                    	
						<div class="input-with-icon-left">
		                    <i class="icon-feather-calendar"></i>
		                    <input type="text" name="searchdate" id="searchdate" class="form-control datepicker" value="<?php if($this->input->get('searchdate')){echo $this->input->get('searchdate');}?>">
						</div>						
					</div>
                    <div class="col-md-4">
                    	<button class="btn btn-site" name="search" value="1">Go</button>
                        &nbsp;
                        <button class="btn btn-site"  name="CSV" value="1">Download CSV</button>
                    </div>
				</div>
				</form>

				<div>
                
                </div>
            </div>
            </div>
			<div class="fun-facts-container">
				<div class="fun-fact" data-fun-fact-color="#37bf00">
                	<div class="fun-fact-icon"><img src="<?php echo IMAGE;?>wallet.png" alt="" /></div>
                    <div class="fun-fact-text ml-1">
                        <span>Current Balance</span>
                        <h4><?php echo $currency.priceFormat($current_balance);?></h4>
                    </div>
                </div>
                <div class="fun-fact" data-fun-fact-color="#37bf00">
                	<div class="fun-fact-icon"><img src="<?php echo IMAGE;?>credit-card.png" alt="" /></div>
                    <div class="fun-fact-text ml-1">
                        <span>Total Credit</span>
                        <h4> <?php echo $currency.priceFormat($total_credit);?></h4>
                    </div>
                </div>
                <div class="fun-fact" data-fun-fact-color="#f00">
                    <div class="fun-fact-icon"><img src="<?php echo IMAGE;?>debit-card.png" alt="" /></div>
                    <div class="fun-fact-text ml-1">
                        <span>Total Debit</span>
                        <h4> <?php echo $currency.priceFormat($total_debit);?></h4>
                    </div>
                </div>                
           </div>
            <div class="dashboard-box">
                <div class="headline">
                    <h3><i class="icon-feather-dollar-sign text-site"></i> Transaction Details</h3>
                </div>
                <div class="content">
                    <ul class="dashboard-box-list">
					<?php if($list){
					foreach($list as $k=>$row){
						$color="waitingcolor";
						$status_name='Pending';
						if($row['status']==1){
							$color="paid";
							$status_name='Success';
						}elseif($row['status']==2){
							$color="unpaid";
							$status_name='Rejected';
						}
					?>
					<li>
						<div class="invoice-list-item">
						<strong><?php //echo $row['name'];
						echo $row['description'];
						?></strong>
							<ul>
								
								<li><span class="<?php echo $color;?>"><?php echo $status_name;?></span>
							<?php if($row['admin_message']){?>
								<a href="<?php D(VZ);?>" data-tippy-placement="top" title="<?php echo $row['admin_message']; ?><?php if($row['admin_message_date']!='0000-00-00 00:00:00'){echo '<br>'.$row['admin_message_date'];} ?>"> <i class="icon-feather-info"></i> </a>	
							<?php }?>
								</li>
								<li>T<?php echo $row['wallet_transaction_id'];?></li>
								<li><b><?php if($row['Amount']>0){echo 'Credit';}else{echo 'Debit';}?>:</b> <?php echo $currency;?><?php echo priceFormat(abs($row['Amount']));?></li>
								<li><b>Date:</b> <?php echo $row['transaction_date'];?></li>
							</ul>
						</div>   
						<!-- Buttons -->
						<div class="buttons-to-right single-right-button always-visible" hidden>
							<a href="#" class="button">Button</a>
						</div>                         
                    </li>
					<?php						
					}
					}else{?>     
					<li><p>No record found</p></li>
					<?php }?>
                    </ul>
				</div>
			</div>
			<?php echo $links; ?> 
		</div>
	</div>
	<!-- Dashboard Content / End -->

</div>
<!-- Dashboard Container / End -->

<script type="text/javascript">
var SPINNER='<?php load_view('inc/spinner',array('size'=>30));?>';

var main=function(){
	
	$('.datepicker').daterangepicker({
    	"maxDate": "<?php echo date('Y/m/d');?>",
  		locale: {
            format: 'YYYY-MM-DD'
        },
		autoUpdateInput: false
	}, function(from_date, to_date) {
		$('.datepicker').val(from_date.format('YYYY-MM-DD')+' - '+to_date.format('YYYY-MM-DD'));
	});
}

</script>
