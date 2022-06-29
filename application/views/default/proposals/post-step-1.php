<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//dd($memberInfo,TRUE);
?>
<div id="dataStep-1" style="display: nones">
				<!-- Dashboard Box -->
                <div class="dashboard-box margin-top-0">
                    <!-- Headline -->
                    <div class="headline">
                        <h3> <?php echo __('postproposal_title','Title');?> </h3>
                    </div>
                    <div class="content with-padding">
                        <label><?php echo __('postproposal_proposal_name','Name of your service');?></label>
                        <input type="text"  class="form-control" name="title" id="title" value="<?php if($proposalData){echo $proposalData['proposal']->proposal_title;}?>">
                        <span id="titleError" class="rerror"></span>
                    </div>
                </div>
				
					
                <div class="dashboard-box">
						<!-- Headline -->
						<div class="headline">
							<h3><?php echo __('postproposal_category','Category');?></h3>
						</div>
						<div class="content with-padding">
                            <div class="submit-field remove_arrow_select">
                                <select name="category" id="category" data-size="4" class="selectpicker browser-default" title="Category" data-live-search="true">
                                <?php
                                if($all_category){
                                    foreach($all_category as $category_list){
                                        ?>
                                        <option value="<?php D($category_list->category_id);?>" <?php if($proposalData && $proposalData['proposal_category']->category_id==$category_list->category_id){echo 'selected';}?>><?php D(ucfirst($category_list->category_name));?></option>
                                        <?php
                                    }
                                }
                                 ?>
                                </select>
                            
                            <span id="categoryError" class="rerror"></span>
                            </div>
                            
                            <?php
                            $all_sub_category=array();
                            if($proposalData && $proposalData['proposal_category']->category_id){
                                $all_sub_category=getAllSubCategory($proposalData['proposal_category']->category_id);
                            }
                            ?>
							<div class="sub_category_display" style="<?php if(!$proposalData){?>display: none<?php }?>">
							<div class="remove_arrow_select">
								<div id="load_sub_category" style="position:relative">
								<select name="sub_category" id="sub_category"  style="min-height:200px;" class="selectpicker browser-default" title="Sub category" data-live-search="true">
				            	<option value="">Select</option>
				            	
                                <?php
                                if($all_sub_category){
                                    foreach($all_sub_category as $sub_category_list){
                                        ?>
                                        <option value="<?php D($sub_category_list->category_subchild_id);?>" <?php if($proposalData && $proposalData['proposal_category']->category_subchild_id==$sub_category_list->category_subchild_id){echo 'selected';}?>><?php D(ucfirst($sub_category_list->category_subchild_name));?></option>
                                        <?php
                                    }
                                }
                                ?>
			            		</select>
			            		</div>
							</div>
							<span id="sub_categoryError" class="rerror"></span>
						</div>
                        	
						</div>
                       
						
					</div>
                    <div class="dashboard-box">
                    <div class="headline">
                        <h3><?php echo __('postproposal_tags','Tags');?>  </h3>
                    </div>
                    <div class="content with-padding">    
                        <div class="submit-field mb-0">
                            <label><?php echo __('postproposal_required_tags','Select tags');?></label>
                            <div class="keywords-list skillContaintag"></div>
                        <input  class="form-control tagsinput_skill" name="skills" id="skills" value="">
                            <span id="skillsError" class="rerror"></span>

                        </div>
                    </div>
                    <div class="dashboard-box-footer">
                            <button class="btn btn-secondary backbtnproposal" data-step="1"><?php echo __('postproposal_back','Back');?></button>
                            <button class="btn btn-site nextbtnproposal" data-step="1"><?php echo __('postproposal_next','Next');?></button>
                        </div>
                    </div>
</div>