<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="modal-header">
        <button type="button" class="btn btn-dark pull-left" data-dismiss="modal">Cancel</button>
        <h4 class="modal-title">Change availability</h4>
        <button type="button" class="btn btn-success pull-right" onclick="SaveAvailability(this)">Save</button>
      </div>
    <div class="modal-body">
	    <div class="row">
			<div class="col">
				<form action="" method="post" accept-charset="utf-8" id="availabilityform" class="form-horizontal" role="form" name="availabilityform" onsubmit="return false;">  
				<input  type="hidden" value="<?php echo $formtype;?>" id="formtype" name="formtype"/>
				
				<div class="row">
					<div class="col-xl-6">
						<div class="submit-field">
							<h5>I am currently</h5>
							<div class="account-type">
								<div>
									<input type="radio" name="is_available" id="is_available" class="account-type-radio" value="1" onclick="$('.for_available').show();$('.for_not_available').hide()" <?php if(!$memberInfo->not_available_until){echo 'checked';}?>>
									<label for="is_available" class="ripple-effect-dark"><i class="icon-material-outline-account-circle"></i> Available</label>
								</div>

								<div>
									<input type="radio" name="is_available" id="is_not_available" class="account-type-radio" value="0" onclick="$('.for_available').hide();$('.for_not_available').show()" <?php if($memberInfo->not_available_until){echo 'checked';}?>>
									<label for="is_not_available" class="ripple-effect-dark"><i class="icon-material-outline-business-center"></i> Not Available</label>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="for_available" <?php if($memberInfo->not_available_until){?> style="display:none" <?php }else{?>style="display:block"<?php }?>>
				<div class="form-group">
				<?php if($all_Duration){
					foreach($all_Duration as $key=>$keydata){
						?>
					<div class="radio">
	                  <input id="defaultInline<?php D($key);?>" name="available_per_week" value="<?php D($key);?>" type="radio" <?php if($memberInfo->available_per_week && $memberInfo->available_per_week==$key){echo 'checked';}?> >
	                  <label for="defaultInline<?php D($key);?>"><span class="radio-label"></span> <?php D($keydata['freelanceName']);?></label>
	                </div>
	                 <br>
	            <?php }
	            }
	            ?>
	            <span id="available_per_weekError" class="rerror"></span>
				</div>	
				</div>
				<div class="for_not_available" <?php if($memberInfo->not_available_until){?> style="display:block" <?php }else{?>style="display:none"<?php }?>>
					<div class="row">
						<div class="col-xl-6">
							<div class="submit-field">
								<h5>When do you expect to be ready for new work?</h5>
								<input type="text" class="form-control datepicker" value="<?php D($memberInfo->not_available_until);?>" name="not_available_until" id="not_available_until" placeholder="">
								<span id="not_available_untilError" class="rerror"></span>
							</div>
						</div>
       				</div>
				</div>
				
       			</form>
       		</div>
       	</div>
    </div>
<script>
$(document).ready(function(){
	$('.datepicker').datetimepicker({
		format: 'YYYY-MM-DD',
		minDate: "<?php echo date('Y-m-d');?>",
	});
})
</script>