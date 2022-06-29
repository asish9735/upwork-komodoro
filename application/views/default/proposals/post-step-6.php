<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//dd($memberInfo,TRUE);
?>

<div id="dataStep-6" style="display: none">
  <div class="dashboard-box margin-top-0"> 
    <!-- Headline -->
    <div class="headline">
      <h3><?php echo __('postproposal_review_post','Publich your service');?> </h3>
    </div>
    <div class="content with-padding">
        <div class="submit-field mb-0">
          <h5><b><?php echo __('postproposal_title','Title');?></b> <a href="javascript:void(0)" class="edit-proposal float-right btn btn-outline-secondary btn-circle" data-popup="1" data-tippy-placement="top" title="Edit title"><i class="icon-feather-edit-2"></i></a></h5>
          <label><?php echo __('postproposal_proposal_name','Name of your proposal');?></label>
          <p id="preview_title"></p>
          <label><?php echo __('postproposal_proposal_category','Project category');?></label>
          <p id="preview_category"></p>
          <label><?php echo __('postproposal_proposal_skills','Tags');?></label>
          <div class="task-tags" id="preview_skills"></div>
        </div>

    </div>
    <div class="dashboard-box-footer">
      <button class="btn btn-secondary backbtnproposal" data-step="6"><?php echo __('postproposal_back','Back');?></button>
      <button class="btn btn-site nextbtnproposal" data-step="6"><?php echo __('postproposal_post','Submit');?></button>
    </div>
  </div>
  <div class="dashboard-box" hidden> 
    <!-- Headline -->
    <div class="headline">
      <h4><b><?php echo __('postproposal_description','Description');?></b> <a href="javascript:void(0)" class="edit-proposal float-right btn btn-outline-secondary btn-circle" data-popup="2" data-tippy-placement="top" title="Edit Description"><i class="icon-feather-edit-2"></i></a></h4>
    </div>
    <div class="content with-padding">
      <div class="submit-field mb-0">        
        <label><?php echo __('postproposal_description','Description');?></label>
        <p id="preview_description"><?php echo __('postproposal_test_check','test check');?></p>
        <div id="preview_attachment_sec" style="display: none">
        <label><?php echo __('postproposal_attachment','Attachment');?></label>
        <p id="preview_attachment"></p>
        </div>
      </div>
    </div>
  </div>
  <div class="dashboard-box" hidden> 
    <!-- Headline -->
    <div class="headline">
    <h4><b><?php echo __('postproposal_details','Details');?></b> <a href="javascript:void(0)" class="edit-proposal float-right btn btn-outline-secondary btn-circle" data-popup="3" data-tippy-placement="top" title="Edit Details"><i class="icon-feather-edit-2"></i></a></h4>
    </div>
    <div class="content with-padding">
      <div class="submit-field">        
        <label><?php echo __('postproposal_proposal_type','Type of proposal');?></label>
        <p id="preview_proposalType"></p>
        <div id="preview_attachment_sec" style="display: none">
        <label><?php echo __('postproposal_attachment','Attachment');?></label>
        <p id="preview_attachment"></p>
        </div>
      </div>
      <div class="submit-field">
        <label><?php echo __('postproposal_screen_question','Screen question (optional)');?></label>
        <div id="preview_question_sec" style="display: none"></div>
      </div>
      <div class="submit-field mb-0">  
        <label><?php echo __('postproposal_cover_letter','Required cover letter');?></label>
        <p id="preview_is_cover_required"></p>
      </div>
    </div>
  </div>
  <div class="dashboard-box" hidden> 
    <!-- Headline -->
    <div class="headline">
    	<h4><b><?php echo __('postproposal_expertise','Expertise');?> </b> <a href="javascript:void(0)" class="edit-proposal float-right btn btn-outline-secondary btn-circle" data-popup="4" data-tippy-placement="top" title="Edit Expertise"><i class="icon-feather-edit-2"></i></a></h4>
    </div>
    <div class="content with-padding">
		<div class="task-tags" id="preview_skills"></div>
    </div>
  </div>
  <div class="dashboard-box" hidden> 
    <!-- Headline -->
    <div class="headline">
    	<h4><b><?php echo __('postproposal_visibility','Visibility');?> </b> <a href="javascript:void(0)" class="edit-proposal float-right btn btn-outline-secondary btn-circle" data-popup="5" data-tippy-placement="top" title="Edit Visibility"><i class="icon-feather-edit-2"></i></a></h4>
    </div>
    <div class="content with-padding padding-bottom-0">      
      <div class="row">
        <div class="col-xl-6">
            <div class="submit-field">        
                <label><?php echo __('postproposal_proposal_visibility','Project visibility');?></label>
                <p id="preview_proposalVisibility"></p>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="submit-field"> 
                <label><?php echo __('postproposal_freelancer_need','Freelancer need');?></label>
                <p id="preview_no_of_freelancer"></p>
      		</div>
        </div>
      </div>
    </div>
  </div>
  <div class="dashboard-box" hidden> 
    <!-- Headline -->
    <div class="headline">
    <h4><b><?php echo __('postproposal_budget','Budget');?> </b> <a href="javascript:void(0)" class="edit-proposal float-right btn btn-outline-secondary btn-circle" data-popup="6" data-tippy-placement="top" title="Edit Budget"><i class="icon-feather-edit-2"></i></a></h4>
    </div>
    <div class="content with-padding padding-bottom-0">      
      <div class="row">
        <div class="col-xl-6">
          <div class="submit-field">
            <label><?php echo __('postproposal_h_fixed_price','Hourly or Fixed price');?></label>
            <p id="preview_proposalPaymentType"></p>
          </div>
        </div>
        <div class="col-xl-6">
          <div class="submit-field">
            <label><?php echo __('postproposal_experience_level','Experience level');?></label>
            <p id="preview_experience_level"></p>
          </div>
        </div>
      </div>
      <div class="row hourly_proposal_display" style="display: none">
        <div class="col-xl-6">
          <div class="submit-field">
            <label><?php echo __('postproposal_proposal_duration','Project Duration');?></label>
            <p id="preview_hourly_duration"></p>
          </div>
        </div>
        <div class="col-xl-6">
          <div class="submit-field">
            <label><?php echo __('postproposal_proposal_time','Project Time');?></label>
            <p id="preview_hourly_duration_time"></p>
          </div>
        </div>
      </div>
    </div>
   
  </div>
</div>
