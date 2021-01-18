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
$ProjectDetailsURL=get_link('myProjectDetailsURL')."/".$contractDetails->project_url;
$offer_details_url=get_link('OfferDetails').'/'.md5($contractDetails->contract_id);
$application_link=get_link('viewapplicationURLAJAX')."/".$contractDetails->project_id.'/'.$contractDetails->bid_id;
?>
<section class="section">
<div class="container">
        <h1 class="display-4"><?php echo $contractDetails->contract_title;?></h1>
        <ul class="nav nav-tabs mb-3">
          <li class="nav-item"> <a class="nav-link" href="<?php echo $contract_details_url;?>">Milestones & Earnings</a> </li>
          <li class="nav-item"> <a class="nav-link" href="<?php echo $contract_message_url;?>">Messages & Files</a> </li>
          <li class="nav-item"> <a class="nav-link active" href="<?php echo $contract_term_url;?>">Terms & Settings</a> </li>
        </ul>
        <div class="row">
          <div class="col-lg-9">
			 <div class="card mb-4">
              <div class="card-header">
                <h4>Contract info</h4>
              </div>
               <div class="card-body">
                <div class="row">
                 <?php if($pending_contract==0){?>
	               <?php if($is_owner){?>
	               <div class="col-sm-6"><h5>Your Feedback to Contractor</h5></div>
	               <div class="col-sm-6">
	              		<?php if($reviews){
	              			if($reviews['review_by_me']){
						?>
						<div class="star-rating" data-rating="<?php echo $reviews['review_by_me']->average_review;?>"></div>
	               		<p><?php echo nl2br($reviews['review_by_me']->review_comments);?></p>
						<?php		
							}else{
						?>
						<button class="btn btn-site btn-sm mb-5 SubmitReview">Submit Review</button>
						<?php		
							}
	              		}?>
	               </div>
	                <div class="col-sm-6"><h5>Contractor's Feedback to You</h5></div>
	               <div class="col-sm-6">
	               <?php if($reviews){
	              			if($reviews['review_to_me']){
	              				if($reviews['review_by_me']){
						?>
						<div class="star-rating" data-rating="<?php echo $reviews['review_to_me']->average_review;?>"></div>
	               		<p><?php echo nl2br($reviews['review_to_me']->review_comments);?></p>
	               			<?php }else{?>
	               			<p>After submit review you will able to see client review.</p>
						<?php	
								}
							}else{
						?>
						<p>No review yet.</p>
						<?php		
							}
	              	}else{?>
	              		<p>No review yet.</p>
	              	<?php }?>
	               		
	               </div>
	               <?php }else{?>
	               <div class="col-sm-6"><h5>Your Feedback to Client</h5></div>
	               <div class="col-sm-6">
	               		<?php if($reviews){
	              			if($reviews['review_by_me']){
						?>
						<div class="star-rating" data-rating="<?php echo $reviews['review_by_me']->average_review;?>"></div>
	               		<p><?php echo nl2br($reviews['review_by_me']->review_comments);?></p>
						<?php		
							}else{
						?>
						<button class="btn btn-site btn-sm mb-5 SubmitReview">Submit Review</button>
						<?php		
							}
	              		}?>
	               </div>
	                <div class="col-sm-6"><h5>Client's Feedback to You</h5></div>
	               <div class="col-sm-6">
	               	<?php if($reviews){
	              			if($reviews['review_to_me']){
	              				if($reviews['review_by_me']){
						?>
						<div class="star-rating" data-rating="<?php echo $reviews['review_to_me']->average_review;?>"></div>
	               		<p><?php echo nl2br($reviews['review_to_me']->review_comments);?></p>
	               			<?php }else{?>
	               			<p>After submit review you will able to see client review. </p>
						<?php	
								}
							}else{
						?>
						<p>No review yet.</p>
						<?php		
							}
	              	}else{?>
	              		<p>No review yet.</p>
	              	<?php }?>
	               </div>
	               <?php }?>
	               <?php }?>
	               <div class="col-sm-6"><h5>Contract Date</h5></div>
	               <div class="col-sm-6"><p><?php echo $contractDetails->contract_date;?></p></div>
	               
	               <div class="col-sm-12">
	               <h5>Description of Work</h5>
	               	<p><?php echo nl2br($contractDetails->contract_details);?></p>
	               </div>
	            </div>
               </div>
               <div class="card-footer">
               	<h5 class="mb-0">Contract ID: <?php echo $contractDetails->contract_id;?></h5>
               </div>
            </div>
            
          </div>
			
          <div class="col-lg-3">          
            <div class="card text-center mx-auto">
              <div class="card-body">
              	<span class="avatar-logo mb-3"><img src="<?php echo $logo;?>" alt="<?php echo $name;?>" class="rounded-circle" height="96" width="96"></span>
                <h5 class="card-title mb-0"><?php echo $name;?></h5>
                <!-- <p class="text-muted mb-0">Senior Developer</p>
            	<div class="star-rating mb-2" data-rating="<?php echo round($memberInfo->avg_rating,1);?>"></div>
                 --><a href="<?php echo $offer_details_url;?>" target="_blank" class="btn btn-outline-success btn-block">View Offer <!--<i class="icon-feather-external-link"></i>--></a>
                <?php if($contractDetails->bid_id){?>
                <a href="<?php echo $application_link;?>" target="_blank" class="btn btn-site btn-block">Original Proposal</a>
                <?php }?>
                <a href="<?php echo $ProjectDetailsURL;?>" target="_blank" class="btn btn-web btn-block">Original Job Posting</a>

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
var main=function(){
	$('.SubmitReview').click(function(){
		window.location.href="<?php echo get_link('ReviewURL')?>/"+c_id;
	});
}
</script>
