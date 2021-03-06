<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//dd($memberInfo,TRUE);
?>
<div id="dataStep-3" style="display: none">	
<div class="dashboard-box">
    <!-- Headline -->
    <div class="headline">
        <h4><?php echo __('postproposal_description','Description');?>  </h4>
    </div>
    <div class="content with-padding">    
            <div class="submit-field">
                <label class="form-label"><?php echo __('postproposal_description_about','Description about proposal');?></label>
                <textarea rows="4" class="form-control" name="description" id="description"><?php if($proposalData){echo $proposalData['proposal_additional']->proposal_description;}?></textarea>
                <span id="descriptionError" class="rerror"></span>

            </div>
        
                    
    </div>
</div>
<div class="dashboard-box">
	<!-- Headline -->
	<div class="headline">
            <h4><?php echo __('postproposal_screen_question','Screen Question & Answers');?>  <span class="text-muted">(<?php echo __('postproposal_optional','optional');?>)</span></h4>
        </div>
        <div class="content with-padding">
            <div class="submit-field">
                <label class="form-label"><?php echo __('postproposal_add_screen','Add Questions & Answers for Your Buyers.');?> </label>
                <div id="addQuestion_container">
                <?php if($proposalData && $proposalData['proposal_question']){
                		$question_previous=$proposalData['proposal_question'];
                		foreach($question_previous as $k=>$ques){
						?>	
                        <div class="question_sec mb-3">
                            <div class="submit-field">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="question[]" placeholder="Add a Question" value="<?php echo $ques->proposal_question;?>">
                                    
                                    <a href="<?php D(VZ);?>" class="btn text-danger" onclick="$(this).closest('.question_sec').remove()">
                                        <i class="icon-feather-x f20"></i>
                                    </a>
                                    
                                </div>
                            </div>
                            <div class="form-field">
                                <textarea rows="4" class="form-control" name="answer[]" placeholder="Answer"><?php echo ($ques->proposal_answer);?></textarea>
                            </div>
                        </div>
                		<?php
                		}
                	}?>
                
                
                
                </div>
                <span id="questionError" class="rerror"></span>
                <a href="javascript:void(0)" class="btn btn-outline-site" id="addQuestion"><i class="icon-feather-plus"></i> <?php echo __('postproposal_add','Add');?> </a>    
            </div>            
        </div>        
    </div>
    <button class="btn btn-outline-secondary backbtnproposal" data-step="3"><?php echo __('postproposal_back','Back');?></button>
	<button class="btn btn-site nextbtnproposal" data-step="3"><?php echo __('postproposal_next','Next');?></button>
</div>
