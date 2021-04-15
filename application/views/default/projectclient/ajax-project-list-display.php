<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//dd($all_projects,TRUE);
if($all_projects){
	foreach($all_projects as $p=>$projectDetails){
		$edit_link=get_link('editprojectURL').'/'.md5($projectDetails->project_id).'/'.md5('UPW'.'-'.date("Y-m-d").'-'.md5($projectDetails->project_id));
		if($projectDetails->project_status==PROJECT_DRAFT){
			$link=get_link('editprojectURL');
		}else{
			$link=get_link('myProjectDetailsURL')."/".$projectDetails->project_url;
		}
		$link_bid=get_link('myProjectDetailsBidsClientURL')."/".$projectDetails->project_id;
		
		

?>
<li>
	<!-- Job Listing -->
	<div class="job-listing width-adjustment_">

		<!-- Job Listing Details -->
		<div class="job-listing-details">

			<!-- Details -->
			<div class="job-listing-description">
				<h3 class="job-listing-title"><a href="<?php D($link);?>"><?php D($projectDetails->project_title);?></a> 
				<?php if($projectDetails->is_hourly){?>
				<span class="dashboard-status-button yellow"><?php D('Hourly');?></span>
				<?php }else{?>
				<span class="dashboard-status-button green"><?php D('Fixed');?></span>
				<?php }?>
				</h3>
<?php
$status=getAllProjectStatus($projectDetails->project_status);
?>
				<!-- Job Listing Footer -->
				<div class="job-listing-footer">
					<ul>                    	
						<li><i class="icon-material-outline-access-time"></i> Posted <?php D(get_time_ago($projectDetails->project_posted_date));?></li>
						<li><i class="icon-material-outline-info"></i> <?php if($projectDetails->is_visible_anyone){?><?php D('Public');?>- <?php }?><?php D($status['name']);?></li>                    </ul>
				</div>
                </div>
                <ul class="job-task-info">
                	<li><strong><?php D($projectDetails->bids);?></strong><span>Bids</span></li>
                    <li><strong><?php D($projectDetails->message);?></strong><span>Messages</span></li>
                    <li><strong><?php D($projectDetails->hired);?></strong><span>Hired</span></li>
                </ul>
				<!-- Buttons -->
                <div class="buttons-to-right_ always-visible_">
                    <a href="<?php D($link_bid);?>" class="btn btn-sm btn-site <?php if($projectDetails->project_status==PROJECT_DRAFT){ D('disabled');}?>">Manage Proposal <span class="button-info"><?php D($projectDetails->bids);?></span></a>
                    <?php if(!$projectDetails->hired){?><a href="<?php echo $edit_link;?>" class="btn btn-sm btn-secondary ico" data-tippy-placement="top"title="Edit"><i class="icon-feather-edit"></i></a><?php }?>
                    <a hidden href="#" class="btn btn-sm btn-danger ico" data-tippy-placement="top" title="Remove"><i class="icon-feather-trash-2"></i></a>
                </div>
		</div>
	</div>
	
	

	
</li>
<?php 
	}
}
?>