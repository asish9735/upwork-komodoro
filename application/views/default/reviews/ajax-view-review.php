<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="modal-header">
       
        <h4 class="modal-title">Review Details</h4> 
        <button type="button" class="btn btn-dark pull-left" data-dismiss="modal">Ok</button>
      </div>
    <div class="modal-body">
	    <div class="row">
			<div class="col">
            <p class="mb-2"><b>Contract Title:</b> <?php echo $contractDetails->contract_title;?></p>
            <?php if($is_owner){?>
              <p><b>Contractor:</b> <?php echo $contractDetails->contractor->member_name;?></p>
              <?php }else{?>
              <p><b>Client:</b> <?php echo ($contractDetails->owner->organization_name ? $contractDetails->owner->organization_name:$contractDetails->owner->member_name);?></p>
              <?php }?>
             
             <div class="row">
             <?php 
            if($reviews){
                if($show_client_review && $review_by_client){
                    //print_r($review_by_client);
            ?>
<div class="col-sm-6">
            <h5>Feedback by Client</h5>
                <div class="">
                <div class=" row">
                	<div class="col-auto">
                    <div class="star-rating" data-rating="<?php echo $review_by_client->for_skills;?>"></div>
                	</div>
                	<div class="col-auto small">Skills</div>
                </div>
                <div class=" row">
                	<div class="col-auto">
                    <div class="star-rating" data-rating="<?php echo $review_by_client->for_quality;?>"></div>
                	</div>
                	<div class="col-auto small">Quality</div>
                </div>
                <div class=" row">
                	<div class="col-auto">
                    <div class="star-rating" data-rating="<?php echo $review_by_client->for_availability;?>"></div>
                	</div>
                	<div class="col-auto small">Availability</div>
                </div>
                <div class=" row">
                	<div class="col-auto">
                    <div class="star-rating" data-rating="<?php echo $review_by_client->for_deadlines;?>"></div>
                	</div>
                	<div class="col-auto small">Deadlines</div>
                </div>
                <div class=" row">
                	<div class="col-auto">
                    <div class="star-rating" data-rating="<?php echo $review_by_client->for_communication;?>"></div>
                	</div>
                	<div class="col-auto small">Communication</div>
                </div>
                <div class=" row">
                	<div class="col-auto">
                    <div class="star-rating" data-rating="<?php echo $review_by_client->for_cooperation;?>"></div>
                	</div>
                	<div class="col-auto small">Cooperation</div>
                </div>
                <div class="mt-2">
                <p><sup class="icon-line-awesome-quote-left"></sup><?php echo nl2br($review_by_client->review_comments);?><sub class="icon-line-awesome-quote-right"></sub></p>
                <small class="float-right text-muted">- <?php echo dateFormat($review_by_client->review_date,'M d, Y');?></small>
                </div>
                
                
                	
                </div>
 </div>
            <?php
                }   
                if($show_freelancer_review && $review_by_freelancer){
?>
<div class="col-sm-6">
                <h5>Feedback by Contractor</h5>
                <div class="">
                <div class=" row">
                	<div class="col-auto">
                    <div class="star-rating" data-rating="<?php echo $review_by_freelancer->for_skills;?>"></div>
                	</div>
                	<div class="col-auto small">Skills</div>
                </div>
                <div class=" row">
                	<div class="col-auto">
                    <div class="star-rating" data-rating="<?php echo $review_by_freelancer->for_quality;?>"></div>
                	</div>
                	<div class="col-auto small">Quality Of Requirements</div>
                </div>
                <div class=" row">
                	<div class="col-auto">
                    <div class="star-rating" data-rating="<?php echo $review_by_freelancer->for_availability;?>"></div>
                	</div>
                	<div class="col-auto small">Availability</div>
                </div>
                <div class=" row">
                	<div class="col-auto">
                    <div class="star-rating" data-rating="<?php echo $review_by_freelancer->for_deadlines;?>"></div>
                	</div>
                	<div class="col-auto small">Set Reasonable Deadlines</div>
                </div>
                <div class=" row">
                	<div class="col-auto">
                    <div class="star-rating" data-rating="<?php echo $review_by_freelancer->for_communication;?>"></div>
                	</div>
                	<div class="col-auto small">Communication</div>
                </div>
                <div class=" row">
                	<div class="col-auto">
                    <div class="star-rating" data-rating="<?php echo $review_by_freelancer->for_cooperation;?>"></div>
                	</div>
                	<div class="col-auto small">Cooperation</div>
                </div>
                <div class="mt-2">
                <p><sup class="icon-line-awesome-quote-left"></sup><?php echo nl2br($review_by_freelancer->review_comments);?><sub class="icon-line-awesome-quote-right"></sub></p>
                <small class="float-right text-muted">- <?php echo dateFormat($review_by_freelancer->review_date,'M d, Y');?></small>
                </div>
                	
                </div>
 </div>
<?php
                }  
            ?>

             <?php }?>
             </div>


       		</div>
       	</div>
    </div>