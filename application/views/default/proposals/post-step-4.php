<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//dd($memberInfo,TRUE);
?>
<div id="dataStep-4"  style="display: none">
		
    <div class="dashboard-box margin-top-0">
        <!-- Headline -->
        <div class="headline">
            <h3><?php echo __('postproposal_requirement','Requirements');?>  </h3>
        </div>
        <div class="content with-padding">    
            <div class="submit-field">
                <label><?php echo __('postproposal_requirement_about','Requirement about proposal');?></label>
                <textarea rows="4" class="form-control" name="requirement" id="requirement"><?php if($proposalData){echo $proposalData['proposal_additional']->buyer_instruction;}?></textarea>
                <span id="requirementError" class="rerror"></span>

            </div>

        </div>
        <div class="dashboard-box-footer">
            <button class="btn btn-secondary backbtnproposal" data-step="4"><?php echo __('postproposal_back','Back');?></button>
            <button class="btn btn-site nextbtnproposal" data-step="4"><?php echo __('postproposal_next','Next');?></button>
        </div>
    </div>
    
				
</div>