<?php if($page == 'view'){ ?>
<div class="modal-header">	
	<h5 class="modal-title"><?php echo $title;?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	  <span aria-hidden="true">&times;</span>
    </button>
</div>
    <div class="modal-body">
	    <div class="row">
			<div class="col">
            <p class="mb-2"><b>Project Title:</b> <?php echo $contractDetails->project_title;?> <a href="<?php echo base_url('proposal/list_record')?>?project_id=<?php echo $contractDetails->project_id;?>" target="_blank"><i class="icon-feather-external-link"></i></a></p>
            <p class="mb-2"><b>Contract Title:</b> <?php echo $contractDetails->contract_title;?> <a href="<?php echo base_url('offers/contracts')?>?contract_id=<?php echo $contractDetails->contract_id;?>" target="_blank"><i class="icon-feather-external-link"></i></a></p>
             <div class="row">
             <?php 
            if($reviews){
              //print_r($reviews);
              if($reviews['review_'.$ID]){
               $review_by_client=$reviews['review_'.$ID];
              ?>
            <div class="col-sm-12">
              <h5>Feedback by <?php echo $review_by_client->member_name;?></h5>
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
                  <small class="float-right text-muted">- <?php echo format_date_time($review_by_client->review_date,'M d, Y');?></small>
                  </div>  
                </div>
            </div>

            <?php
              }
              foreach($reviews as $rv=>$review_by_client){
                if($rv=='review_'.$ID){
                  continue;
                }
              ?>
            <div class="col-sm-12">
              <h5>Feedback by <?php echo $review_by_client->member_name;?></h5>
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
                    <small class="float-right text-muted">- <?php echo format_date_time($review_by_client->review_date,'M d, Y');?></small>
                  </div> 
              </div>
            </div>
              <?php
              }
            }
?>
             </div>


       		</div>
       	</div>
    </div>

<script>

init_plugin();
starRating('#ajaxModal .star-rating');

</script>
<?php } ?>
