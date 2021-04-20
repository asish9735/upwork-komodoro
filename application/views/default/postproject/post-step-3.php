<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//dd($memberInfo,TRUE);
?>
<div id="dataStep-3"  style="display: none">
		
    <div class="dashboard-box margin-top-0">
        <!-- Headline -->
        <div class="headline">
            <h3><?php echo __('postproject_details','Details');?>  </h3>
        </div>
        <div class="content with-padding">
            <div class="submit-field myradio mb-0">
                <label><?php echo __('postproject_what_type_project','What type of project you have ?');?></label>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <?php if($all_projectType){
                    foreach($all_projectType as $key=>$keydata){
                    ?>
                    <label class="btn <?php if($projectData && $projectData['project_settings']->project_type_code==$key){echo 'active';}?>">
                        <input type="radio" name="projectType" id="defaultInline<?php D($key);?>" autocomplete="off"  value="<?php D($key);?>" <?php if($projectData && $projectData['project_settings']->project_type_code==$key){echo 'checked';}?>>
                        <i class="icon-material-<?php D($key);?>"></i><br>
                        <?php D($keydata['name']);?>
                    </label>
                <?php
                    }
                }
                ?>
                </div>
                <div class="clearfix"></div>
                <span id="projectTypeError" class="rerror"></span>

            </div>
        </div>
    </div>
				
				
    <div class="dashboard-box">
        <!-- Headline -->
        <div class="headline">
            <h3><?php echo __('postproject_screen_question','Screen Question (optional)');?> </h3>
        </div>
        <div class="content with-padding">
            <div class="submit-field mb-0">
                <label><?php echo __('postproject_add_screen','Add screen question / require a cover letter');?> </label>
                <div id="addQuestion_container">
                <?php if($projectData && $projectData['project_question']){
                		$question_previous=$projectData['project_question'];
                		foreach($question_previous as $k=>$ques){
						?>	
						<div class="question_sec input-group margin-bottom-10">
			                <input type="text" class="form-control input-text with-border" name="pre_question[<?php echo $ques->question_id;?>]" placeholder="Enter question" value="<?php echo $ques->question_title;?>">
			                <div class="input-group-append">
			                	<a href="<?php D(VZ);?>" class="btn text-danger" onclick="$(this).closest('.question_sec').remove()"><i class="icon-feather-x f20"></i></a>
			                </div>
		                </div>
                		<?php
                		}
                	}?>
                
                
                
                </div>
                <span id="questionError" class="rerror"></span>
                <a href="javascript:void(0)" class="btn btn-outline-success" id="addQuestion"><?php echo __('postproject_add','+ Add');?> </a>    
            </div>

            <div class="mt-3" id="is_cover_required_display" style="display: none">
                <div class="checkbox">
                    <input type="checkbox" name="is_cover_required" id="is_cover_required" value="1" checked>
                    <label for="is_cover_required"><span class="checkbox-icon"></span><?php echo __('postproject_cover_letter','Required cover letter');?> </label>
                </div>
            </div>
            
        </div>
        <div class="dashboard-box-footer">
            <button class="btn btn-secondary backbtnproject" data-step="3"><?php echo __('postproject_back','Back');?></button>
            <button class="btn btn-site nextbtnproject" data-step="3"><?php echo __('postproject_next','Next');?></button>
        </div>
    </div>
				
</div>