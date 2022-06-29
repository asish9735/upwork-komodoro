<div class="dashboard-container">
<?php echo $left_panel;?>
<div class="dashboard-content-container">
    <div class="dashboard-content-inner">
    <?php
    if ($this->session->flashdata('succ_msg')) {
        ?>

    <div class="success alert-success alert text-center"><i class="icon-material-outline-check-circle"></i>&nbsp;<?php echo $this->session->flashdata('succ_msg'); ?></div>
    <?php 
    }
    if ($this->session->flashdata('error_msg')) {
        ?>

    <div class="success alert-danger alert text-center"><i class="icon-material-outline-check-circle"></i>&nbsp;<?php echo $this->session->flashdata('error_msg'); ?></div>
    <?php 
    }
    ?>
	  
      <div class="dashboard-box margin-top-0">
        <div class="headline">
            <h3><?php echo __('Order_list','Manage Orders');?></h3>
        </div>
		
        <div class="content">
            <ul class="dashboard-box-list">
            <?php /*?><table id="example" class="table" cellspacing="0" width="100%"></table><?php */?>          
				<?php 
                if($orders){
                    foreach($orders as $key=>$order){ ?>
                <li>
                    <!-- Job Listing -->
                    <div class="job-listing">
                        <!-- Job Listing Details -->
                        <div class="job-listing-details">
                            <!-- Details -->
                            <div class="job-listing-description">
                                <h4 class="job-listing-title"><a href="<?php echo get_link('OrderDetailsURL').md5($order['order_id']); ?>"><?php echo $order['proposal_title']; ?></a></h4>
    
                                <!-- Job Listing Footer -->              
                                <div class="job-listing-footer">
                                    <ul>
                                        <li><i class="icon-feather-hash"></i> <?php echo $order['order_id']; ?></li>
                                        <li>Price: <?php echo CURRENCY. $order['order_price']; ?>
                                        
                                        </li>                                     
                                        <li>Order Date: <?php echo (dateFormat($order['order_date'],'F d, Y')); ?></li>                                     
                                       
                                        <li><!--Status:-->                                       
                                            <?php
                                            switch($order['order_status']){
                                                case ORDER_PENDING : 
                                                echo '<span class="dashboard-status-button yellow">Pending</span>';
                                                break;
                                                case ORDER_DELIVERED : 
                                                    echo '<span class="dashboard-status-button green">Delivered</span>';
                                                break;
                                                case ORDER_CANCELLATION : 
                                                    echo '<span class="dashboard-status-button red">Cancellation requested</span>';
                                                break;
                                                case ORDER_CANCELLED : 
                                                    echo '<span class="dashboard-status-button red">Cancelled</span>';
                                                break;
                                                case ORDER_REVISION :
                                                echo '<span class="dashboard-status-button blue">Rivision</span>';
                                                break;
                                                case ORDER_PROCESSING:
                                                echo '<span class="dashboard-status-button blue">Processing</span>';
                                                break;
                                                case ORDER_COMPLETED:
                                                    echo '<span class="dashboard-status-button green">Completed</span>';
                                                break;
                                            }
                                            ?>					
                                        </li>                                 
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Buttons -->
                    <div class="buttons-to-right single-right-button always-visible">
                    <a href="<?php echo get_link('OrderDetailsURL').md5($order['order_id']); ?>" class="btn btn-sm btn-outline-site ico" title="View" data-tippy-placement="left"><i class="icon-feather-eye"></i></a>
                    </div>
                </li>
                <?php } 
} else {?>    
<li><p>No reord found</p></li>
<?php } ?>
        </ul>
	</div>           
</div>
<?php echo $links; ?>
    
  </div>
</div>
</div>
<div id="featured-proposal-modal"></div>
<script type="text/javascript">
var SPINNER='<span class="spinner-border spinner-border-sm"></span>';
function doAction(type,proposal_id,ev){
	if(type=='makefeature'){
		$.ajax({
		  	method: "POST",
		 	url: "<?php echo (base_url('proposals/pay_featured_listing'))?>",
		 	data: {proposal_id: proposal_id }
		}).done(function(data){
			$("#featured-proposal-modal").html(data);		
		});
		return false;
	}else{
        $(ev).html(SPINNER);
	var url="<?php echo (base_url('proposals/actionproposalCheckAjax'))?>";
    $.ajax({
        type: "POST",
        url: url,
        data:{action:type,rid:proposal_id},
        dataType: "json",
        cache: false,
        success: function(msg) {
            setTimeout(function(){
            if (msg['status'] == 'OK') {
                window.location.reload();
            }else{
                window.location.reload();
            }
            },1000);
        }
    })
}
}
</script>