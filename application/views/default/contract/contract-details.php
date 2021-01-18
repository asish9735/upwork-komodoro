<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$currency=priceSymbol();
//get_print($contractDetails,FALSE);
if($is_owner){
	$logo=getMemberLogo($contractDetails->contractor->member_id);
	$name=$contractDetails->contractor->member_name;
}else{
	$logo=getCompanyLogo($contractDetails->owner->organization_id);
	if($contractDetails->owner->organization_name){
		$name=$contractDetails->owner->organization_name;
	}else{
		$name=$contractDetails->owner->member_name;
	}
}
$new_contract_url=get_link('HireProjectURL')."/".md5($contractDetails->project_id)."/".md5($contractDetails->contractor_id);
$contract_details_url=get_link('ContractDetails').'/'.md5($contractDetails->contract_id);
$contract_message_url=get_link('ContractMessage').'/'.md5($contractDetails->contract_id);
$contract_term_url=get_link('ContractTerm').'/'.md5($contractDetails->contract_id);
$endcontract_url=get_link('ReviewURL').'/'.md5($contractDetails->contract_id);
$make_dispute_url=get_link('MakeDisputeURL').'/'.md5($contractDetails->contract_id);
?>

<section class="section">
  <div class="container">
    <h1 class="display-4"><?php echo $contractDetails->contract_title;?></h1>
    <ul class="nav nav-tabs mb-3">
      <li class="nav-item"> <a class="nav-link active" href="<?php echo $contract_details_url;?>">Milestones & Earnings</a> </li>
      <li class="nav-item"> <a class="nav-link" href="<?php echo $contract_message_url;?>">Messages & Files</a> </li>
      <li class="nav-item"> <a class="nav-link" href="<?php echo $contract_term_url;?>">Terms & Settings</a> </li>
    </ul>
    <div class="row">
      <div class="col-lg-9">
        <div class="panel mb-4">
          <div class="panel-body">
            <ul class="totalList mb-0">
              <li><b>Budget</b> <span> <?php echo $currency.$contractDetails->contract_amount;?></span> </li>
              <li><b>In Escrow</b> <span><?php echo $currency.$contractDetails->in_escrow;?></span> </li>
              <li><b>Milestones Paid</b><span><?php echo $currency.$contractDetails->milestone_paid;?></span></li>
              <?php if($not_started_contract){?>
              <li><b>Not Started</b><span><?php echo $currency.$contractDetails->not_started;?></span></li>
              <?php }?>
              <?php if($contractDetails->disputed){?>
              <li><b>Total Disputed</b><span><?php echo $currency.$contractDetails->disputed;?></span></li>
			  <li><b>Refunded</b> <span><?php echo $currency.$contractDetails->refund_earn;?></span> </li>
              <?php }?>
              <li><b>Remaining</b> <span><?php echo $currency.$contractDetails->balance_remain;?></span> </li>
              <?php if($is_owner){?>
              <li><b>Spent</b> <span><?php echo $currency.$contractDetails->earning;?></span> </li>
              <?php }else{?>
              <li><b>Total Earning</b> <span><?php echo $currency.$contractDetails->earning;?></span> </li>
              <?php }?>
            </ul>
          </div>
        </div>
        <?php
        if($not_started_contract){
			?>
		<p class="alert alert-warning text-center"><?php echo $not_started_contract;?> milestone not started.</p>	
			<?php
		}
        ?>
        <?php
        if($contractDetails->disputed_milestone){
		?>
		<div class="panel mb-4">
          <div class="panel-header relative">
            <h4>Disputed (<?php echo count($contractDetails->disputed_milestone);?>)</h4>
          </div>
          <div class="panel-body" >
            <ul class="list-group">
              <?php if($contractDetails->disputed_milestone){
					foreach($contractDetails->disputed_milestone as $m=>$milestone){
						//print_r($milestone);
				?>
				<li class="list-group-item w-100 d-flex align-self-center">
              <span class="number"><?php echo $m+1;?>.</span>
              <div class="milestone-item"> <b><?php echo ucfirst($milestone->milestone_title);?></b><br>
                <b>Amount:</b> <?php echo $milestone->milestone_amount;?> <br>
                <b>Date:</b> <?php echo $milestone->dispute_date;?> <br>
                <?php if($milestone->dispute_status==1){?>
                <b>Status:</b> <span class="badge badge-success">Resolved</span>
                <?php
                }else{
                ?><b>Status:</b> <span class="badge badge-warning">Pending</span>
                <?php }?> 
                </div>
             
              <div class="ml-auto align-self-center">
              <a href="<?php echo get_link('DisputeDetails').'/'.md5($milestone->contract_milestone_id);?>" class="btn btn-site btn-sm">View</a>
              </div>
              
              </li>
              <?php		
					}
					}
					?>
            </ul>
          </div>
        </div>
		<?php	
		}
        ?>
        <?php
        if(!$pending_contract){
		?>
		<div class="panel mb-4">
			<div class="panel-header relative">
            <h4>End Contract</h4>
          </div>
          <div class="panel-body">
          <?php
          if($contractDetails->is_contract_ended){
		  	?>
		  <p>Contract Ended on <?php echo $contractDetails->contract_end_date;?></p>	
		  	<?php
		  }
		 // get_print($reviews);
          if($reviews){
			  if($reviews['review_by_me'] && $reviews['review_to_me']){
			  ?>
			  <div class="col-sm-6"><h5>
			  <?php if($is_owner){?>
			  	Your Feedback to Contractor
			  <?php }else{?>
			   Your Feedback to Client
			  <?php }?>
			  </h5></div>
			  <div class="col-sm-6"><div class="star-rating" data-rating="<?php echo $reviews['review_by_me']->average_review;?>"></div></div>
			  <div class="col-sm-6"><h5>
			  <?php if($is_owner){?>
			  	Contractor's Feedback to You
			  <?php }else{?>
			  Client's Feedback to You
			  <?php }?>
			  </h5></div>
			  <div class="col-sm-6"><div class="star-rating" data-rating="<?php echo $reviews['review_to_me']->average_review;?>"></div></div>
			  <?php	
			  }elseif($reviews['review_by_me'] && !$reviews['review_to_me']){
			  	?>
			  <div class="col-sm-6"><h5>Your Feedback</h5></div>
			  <div class="col-sm-6"><div class="star-rating" data-rating="<?php echo $reviews['review_by_me']->average_review;?>"></div></div>
			  <p>Client not send feedback yet.</p>
			  <?php
			  	
			  }elseif(!$reviews['review_by_me']){
			  ?>
			 <a href="<?php echo $endcontract_url;?>" class="btn btn-site">Send Feedback</a>
			  <?php
			  }	
		  }else{
		  ?>
		  <a href="<?php echo $endcontract_url;?>" class="btn btn-site">End Contract Now</a>
		  <?php	
		  }
          ?>
          </div>
        </div>
		<?php	
		}
        ?>
        <div class="panel mb-4">
          <div class="panel-header relative">
            <h4>Milestone (<?php echo count($contractDetails->milestone);?>) <a href="javascript:void(0)" onclick="showMilestone()" class="toggleUD milestoneToggle"><i class="icon-feather-chevron-down"></i></a></h4>
          </div>
          <div class="panel-body" id="milestone" style="display:none">
            <ul class="list-group">
              <?php if($contractDetails->milestone){
					foreach($contractDetails->milestone as $m=>$milestone){
				?>
				<li class="list-group-item w-100 d-flex align-self-center">
              <a href="<?php echo get_link('MilestoneDetails').'/'.md5($milestone->contract_milestone_id);?>" class="text-dark"> <span class="number"><?php echo $m+1;?>.</span>
              <div class="milestone-item"> <b><?php echo ucfirst($milestone->milestone_title);?></b><br>
                <b>Budget:</b> <?php echo $milestone->milestone_amount;?> <br>
                <?php if($milestone->is_approved){?>
                <b>Completed:</b><?php echo $milestone->approved_date;}else{?><b>Due Date:</b> <?php echo $milestone->milestone_due_date; }?> </div>
              </a>
              <div class="ml-auto align-self-center">
              <?php 
              if(!$contractDetails->is_contract_ended){
              if($is_owner && $milestone->is_approved!=1){
	              	if(!$milestone->is_escrow){
					?>
						<button type="button" class="btn btn-warning btn-sm startWork" data-mid="<?php echo md5($milestone->contract_milestone_id);?>">Initiate</button>
					<?php	
					}
              	?>
              
              <?php }
              }
              ?>
              <a href="<?php echo get_link('MilestoneDetails').'/'.md5($milestone->contract_milestone_id);?>" class="btn btn-site btn-sm">View</a>
              </div>
              
              </li>
              <?php		
					}
					}
					?>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card text-center mx-auto">
          <div class="card-body">
            <span class="avatar-logo mb-3"><img src="<?php echo $logo;?>" alt="<?php echo $name;?>" class="rounded-circle" height="96" width="96"></span>
            <h5 class="card-title mb-0"><?php echo $name;?></h5>
          <!--   <p class="text-muted mb-0">Senior Developer</p>
            <div class="star-rating" data-rating="<?php echo round($memberInfo->avg_rating,1);?>"></div> -->
            <?php if($is_owner){?>
            <a href="<?php echo $new_contract_url;?>" class="btn btn-success btn-block mt-2">
            <icon class="icon-material-outline-add"></icon>
            New Contract</a> <!--<a href="<?php echo VZ;?>" class="btn btn-site btn-block add_fund_escrow">
            <icon class="icon-material-outline-add"></icon>
            Add Fund</a>-->
            <?php if($pending_contract){?>
            <a href="<?php echo $make_dispute_url;?>" class="btn btn-danger btn-block">
            <icon class="icon-line-awesome-warning"></icon>
            Make Dispute</a>
            <?php }?>
            <?php }?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php if($is_owner){?>

<?php }?>
<script>
var SPINNER='<?php load_view('inc/spinner',array('size'=>30));?>';
var c_id="<?php echo md5($contractDetails->contract_id)?>";
function showMilestone(){ 
    $('#milestone').toggle();
	$(".milestoneToggle").toggleClass('active');
}
</script>
<?php if($is_owner){?>
<script>
var main=function(){
	$('.add_fund_escrow').click(function(){
		$('#add_fund_modal').modal('show');
	});
	$('.startWork').click(function(){
		var buttonsection=$(this);
		var mid=$(this).data('mid');
		bootbox.confirm({
			title:'Work Start Confimation',
			message: 'By confirm, the work will be mark as start and milestone payment will be add in escrow.',
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
					buttonsection.attr('disabled','disabled');
					var buttonval = buttonsection.html();
					buttonsection.html(SPINNER).attr('disabled','disabled');
					$.post( "<?php echo get_link('workStartAjaxURL');?>",{'mid':mid}, function( msg ) {
						if (msg['status'] == 'OK') {
							bootbox.alert({
								title:'Work Started',
								message: '<?php D(__('work_start_success_message','Work started and amount added to escrow'));?>',
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
									title:'Work Started',
									message: '<?php D(__('work_error_message',"Opps! . Please try again."));?>',
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
}
</script>
<?php }?>
