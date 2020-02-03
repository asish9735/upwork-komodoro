<?php
defined('BASEPATH') OR exit('No direct script access allowed');
get_print($proposaldetails,FALSE);
//get_print($projects,FALSE);
$is_hourly=$projects['project_settings']->is_hourly;
?>
<div class="modal-header">
<button type="button" class="btn btn-dark pull-left" data-dismiss="modal">Cancel</button>
	<h4 class="modal-title">Proposal Details</h4>
	<button type="button" class="btn btn-success pull-right">Save</button>
</div>
<div class="modal-body">
<?php if($is_hourly){?>
<label><b>Total price </b></label>

<?php }else{?>
<label><b>How do you want to be paid?</b></label>

<label><b>Total price of project : </b> <?php echo priceSymbol().priceFormat($proposaldetails['proposal']->bid_amount);?></label>

<label><b>Milestones</b></label>

<label><b>How long will this project take? : </b><?php echo getAllBidDuration($proposaldetails['proposal']->bid_duration);?></label>
<?php }?>
<label><b>Cover Letter</b></label>
<?php echo nl2br($proposaldetails['proposal']->bid_details);?>

<?php
			if($proposaldetails['project_question']){
			?>
			<label><b>Question</b></label>
			<?php
				foreach($proposaldetails['project_question'] as $k=>$val){
			?>
			<div class="form-group">
				<label><b><?php echo $k+1;?>. <?php echo $val->question_title;?></b></label>
				<?php echo $val->question_answer;?>
			</div>
			<?php		
				}
			}
			?>

<label><b>Attachments</b></label>


</div>
