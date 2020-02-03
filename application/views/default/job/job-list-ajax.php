<?php if($job_list){foreach($job_list as $k => $v){ 
//get_print($v,FALSE);
$budget = !empty($v['budget']) ? $v['budget'] : 0;
?>
<!-- Task -->
<div class="task-listing">
	<div class="task-listing-body">
	<!-- Job Listing Details -->
	<div class="task-listing-details">

		<!-- Details -->
		<div class="task-listing-description">
			<h3 class="task-listing-title"><a href="<?php echo $v['project_detail_url']; ?>"><?php echo $v['project_title']; ?></a></h3>
			<p><b><?php echo $budget > 0 ? ($v['is_fixed'] == '1' ? 'Fixed' : 'Hourly') . '' : 'Hourly'; ?></b> - <span><?php D($v['experience_level_name']);?> (<i class="icon-feather-<?php D($v['experience_level_key']);?>"></i>)</span> - 
			<?php if($v['is_hourly']){
				$duration=getAllProjectDuration($v['hourly_duration']);
				$durationtime=getAllProjectDurationTime($v['hourly_time_required']);
				?>
			<b>Est. Time:</b>  <span><?php D($duration['name']);?>, <?php D($durationtime['name']);?></span>
			<?php }else{?>
			<b>Est. Budget:</b> <span><?php echo $budget > 0 ? priceSymbol(). $budget : '';?></span>
			<?php }?>
			</p>
			
           <!-- <p><b><?php echo $budget > 0 ? ($v['is_fixed'] == '1' ? 'Fixed' : 'Hourly') . '' : 'Hourly'; ?></b> <b><?php echo $budget > 0 ? priceSymbol(). $budget : '';?></b> - <span>Intermediate ($$)</span> - <b>Est. Time:</b>  <span>Less than 1 month, 10-30 hrs/week</span></p>		-->		
			<p class="task-listing-text"><?php echo $v['project_short_info']; ?></p>
			<div class="task-tags">
				<?php if($v['skills']){foreach($v['skills'] as $skill){ ?>
				<a href="#"><?php echo $skill['skill_name'];?></a>
				<?php } } ?>
			</div>
		</div>

	</div>

	<div class="task-listing-bid">
		<div class="task-listing-bid-inner">
			<div class="task-offers text-right">
                <a href="#" class="btn btn-circle btn-light mr-2"><i class="icon-feather-heart"></i></a>
            <!--<a href="#" class="btn btn-circle btn-light active"><i class="icon-feather-heart"></i></a>-->
            	<a href="#" class="btn btn-circle btn-light"><i class="icon-material-outline-bug-report"></i></a>
            	<div class="clearfix"></div>
                
            </div>
			
		</div>
	</div>
	</div>
	<div class="task-listing-footer">
		<ul>
        	
        	<li><div class="verified-badge" title="Verified Employer" data-tippy-placement="top"></div> Payment Verified </li>
            <li><i class="icon-feather-heart"></i> Proposals: <b><?php echo $v['total_proposal'];?></b></li>
			<li><i class="icon-feather-map-pin"></i>
				<?php D($v['clientInfo']['client_address']['country'])?>
				<span><?php D($v['clientInfo']['client_address']['location'])?></span>
			</li>
			<li>
			<?php 
			if($v['project_type_code']){
			$project_type = getAllProjectType($v['project_type_code']);
			
				echo '<i class="icon-material-outline-business-center"></i> ';
				echo $project_type['name'];
			}
			
			?>
			
			</li>
			<li><i class="icon-material-outline-account-balance-wallet"></i> <?php echo $budget > 0 ? get_setting('site_currency'). $budget : 'Not Set';?></li>
			<li><i class="icon-material-outline-access-time"></i> <?php D(get_time_ago($v['project_posted_date']));?></li>
            <li class="ml-auto"><a href="<?php echo $v['project_detail_url']; ?>" class="btn btn-site btn-sm">Send Proposal</a></li>
		</ul>
	</div>
</div>

<?php } } ?>