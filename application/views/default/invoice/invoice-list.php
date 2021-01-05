<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$invoice_url=get_link('InvoiceURL');
?>
<!-- Dashboard Container -->
<div class="dashboard-container">
	<?php echo $left_panel;?>
	<!-- Dashboard Content -->
	<div class="dashboard-content-container" >
		<div class="dashboard-content-inner">

	        <ul class="nav nav-tabs mb-3">
		      <li class="nav-item"> <a class="nav-link <?php if($show=='all'){?>active<?php }?>" href="<?php echo $invoice_url;?>">All</a> </li>
		      <li class="nav-item"> <a class="nav-link <?php if($show=='pending'){?>active<?php }?>" href="<?php echo $invoice_url;?>?show=pending">Pending</a> </li>
		      <li class="nav-item"> <a class="nav-link <?php if($show=='completed'){?>active<?php }?>" href="<?php echo $invoice_url;?>?show=completed">Paid</a> </li>
		       <li class="nav-item"> <a class="nav-link <?php if($show=='rejected'){?>active<?php }?>" href="<?php echo $invoice_url;?>?show=rejected">Rejected</a> </li>
		       
		    </ul>
		    <div class="dashboard-box margin-top-0">
		     <section class=" workLogData"></section>
			 <div class="text-center" id="loader" style="display: none"><?php load_view('inc/spinner',array('size'=>30));?></div>
		    </div>
		    <div class="container text-center padding-bottom-40">
	            <button class="btn btn-primary" id="load_more" data-page = "0">Load more..</button>
	        </div>

		</div>
	</div>
</div>
<div id="action_invoice_modal" class="modal fade" tabindex="-1" role="dialog"  style="z-index: 10000"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document"> 
    <!-- Modal content-->
    <div class="modal-content mycustom-modal">
      <div class="modal-header">
        <button type="button" class="btn btn-dark pull-left" data-dismiss="modal">Cancel</button>
        <h4 class="modal-title">Reject Invoice</h4>
        <button type="button" class="btn btn-success pull-right" onclick="ActionInvoice(this)">Send</button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col">
            <form action="" method="post" accept-charset="utf-8" id="invoiceactionform" class="form-horizontal" role="form" name="invoiceactionform" onsubmit="return false;">
              <input type="hidden" name="sid" id="sid" value="0"/>
              <div class="form-group">
                <label><b>Reason</b></label>
                <textarea class="form-control" id="reason" name="reason"></textarea>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
var SPINNER='<?php load_view('inc/spinner',array('size'=>30));?>';
var getinvoice = function(from){
	$("#loader").show();
	$.ajax({
		url:"<?php D(get_link('GetInvoiceAJAXURL'))?>",
		type:'GET',
		dataType:'json',
		cache: false,
		data: {from:from,show:'<?php echo $show;?>','get_all_invoice':1},
		success: function(response) {
			var newpage= parseInt(from)+1;
			//console.log(newpage);
			if(response){
				$(".workLogData").append(response.list);
				$("#loader").hide();
				$('#load_more').data('page', newpage);
				if(response.total_page>=newpage){
					$('#load_more').show();
				}else{
					$('#load_more').hide();
				}
			}else{
				$("#loader").hide();
				$('#load_more').hide();
			}
		}
	});
};
var mainload=function(){
	$("#load_more").click(function(e){
		e.preventDefault();
		var page = $(this).data('page');
		console.log(page);
		getinvoice(page);
	});
	getinvoice(1);
}
</script>