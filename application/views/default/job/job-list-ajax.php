<?php if($job_list){foreach($job_list as $k => $v){ 
//get_print($v,FALSE);
$budget = !empty($v['budget']) ? $v['budget'] : 0;
$is_fav_class="";
if($login_user_id){
	$is_fav = isFavouriteJob($login_user_id, $v['project_id']);
	if($is_fav){
		$is_fav_class="active";
	}	
}
$is_online=is_online($v['owner_id']);
?>
<!-- Task -->
<div class="job-listing card-project">
	<!-- Job Listing Details -->
	<div class="job-listing-details">

		<!-- Details -->
		<div class="job-listing-description">
        	<div class="d-sm-flex">
			<h3 class="job-listing-title"><a href="<?php echo $v['project_detail_url']; ?>"><?php echo $v['project_title']; ?></a></h3>
            <h3 class="budget ms-auto"><?php echo $budget > 0 ? priceSymbol(). $budget : '';?></h3>
			</div>
           <!-- <p><b><?php echo $budget > 0 ? ($v['is_fixed'] == '1' ? 'Fixed' : 'Hourly') . '' : 'Hourly'; ?></b> <b><?php echo $budget > 0 ? priceSymbol(). $budget : '';?></b> - <span>Intermediate ($$)</span> - <b>Est. Time:</b>  <span>Less than 1 month, 10-30 hrs/week</span></p>		
			<p class="short-info"><?php // echo $v['project_short_info']; ?></p>-->		
			<div class="task-tags">
				<?php if($v['skills']){foreach($v['skills'] as $skill){ ?>
				<span><?php echo $skill['skill_name'];?></span>
				<?php } } ?>
			</div>
            <div class="job-listing-footer">
                <ul>
                    <li><i class="icon-feather-heart"></i> <?php echo __('job_joblist_proposal','Proposals:');?>  <b><?php echo $v['total_proposal'];?></b></li>                    
                    <li>
                    <?php 
                    if($v['project_type_code']){
                    $project_type = getAllProjectType($v['project_type_code']);
                    
                        echo '<i class="icon-material-outline-business-center"></i> ';
                        echo $project_type['name'];
                    }
                    
                    ?>
                    </li>
                    <li><b><?php echo $budget > 0 ? ($v['is_fixed'] == '1' ? '<i class="icon-feather-lock"></i> Fixed' : 'Hourly') . '' : '<i class="icon-feather-clock"></i> Hourly'; ?></b> - <span><?php D($v['experience_level_name']);?> (<i class="icon-feather-<?php D($v['experience_level_key']);?>"></i>)</span> 
			<?php if($v['is_hourly']){
				$duration=getAllProjectDuration($v['hourly_duration']);
				$durationtime=getAllProjectDurationTime($v['hourly_time_required']);
				?>
			- <b><?php echo __('job_joblist_est_time','Est. Time:');?></b>  <span><?php D($duration['name']);?>, <?php D($durationtime['name']);?></span>
			<?php }else{?>
			<?php /*?><b><?php echo __('job_joblist_est_budget','Est. Budget:');?></b> <span><?php echo $budget > 0 ? priceSymbol(). $budget : '';?></span><?php */?>
			<?php }?>
			</li>
                    <li><i class="icon-material-outline-access-time"></i> <?php D(get_time_ago($v['project_posted_date']));?></li>      
                    <!--<li class="ms-md-auto">
                    <a href="#" class="btn btn-circle btn-light active"><i class="icon-feather-heart"></i></a>
                        <a href="<?php // echo VZ;?>" class="btn btn-circle btn-light action_report" data-pid="<?php echo md5($v['project_id']);?>"><i class="icon-material-outline-bug-report"></i></a>     
                    </li>--> 
                </ul>
			</div>
    		
            <div class="d-sm-flex justify-content-between">
        		<div class="user-details">
                	<div class="user-avatar <?php if($is_online){echo 'status-online';}?>"><img src="<?php echo $v['clientdata']->client_logo;?>" alt="" height="32" width="32" /></div>
                	<div class="user-name">
                    	<p><?php echo getConvertedNameClient($v['clientdata']->client_name);?>
                        <?php if($v['clientdata']->country_code_short){?>
                        <img src="<?php echo IMAGE;?>flags/<?php D(strtolower($v['clientdata']->country_code_short));?>.svg" alt="" height="18" width="18" class="flag" title="<?php echo $v['clientdata']->client_location;?>" data-tippy-placement="top" />
                      <?php }?>
                      </p>
                        <div class="star-rating" data-rating="<?php echo $v['clientdata']->avg_rating;?>"></div>
                    </div>
                </div>
			    <div>
                <a href="<?php echo VZ;?>" class="btn btn-circle btn-light me-3 action_favorite <?php echo $is_fav_class;?>" data-pid="<?php echo md5($v['project_id']);?>"><i class="icon-line-awesome-heart"></i></a>            
            	<a href="<?php echo $v['project_detail_url']; ?>" class="btn btn-outline-site"><?php echo __('job_joblist_apply_now','Apply Now');?></a>
                </div>
		</div>
		</div>
        
	</div>
</div>

<?php } } ?>