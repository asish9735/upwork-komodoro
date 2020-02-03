<?php //get_print($talent_list, false); ?>

<?php 
if(!function_exists('print_skill')){
	function print_skill($v){
		echo '<li>'.$v['skill_name'].'</li>';
	}
}
if($talent_list){foreach($talent_list as $k => $freelancer){ ?>
<!-- Freelancer -->
<div class="job-listing">

	<!-- Job Listing Details -->
	<div class="job-listing-details">
		<!-- Logo -->
		<div class="job-listing-company-logo">
			<a href="<?php echo $freelancer['profile_link'];?>"><img src="<?php echo $freelancer['user_logo'];?>" alt="">
			<span class="verified-badge"></span></a>
		</div>

		<!-- Details -->
		<div class="job-listing-description">	
			<div class="freelancer-about">
			<div class="freelancer-intro">		
            	<h5><a href="<?php echo $freelancer['profile_link'];?>"><?php echo $freelancer['member_name'];?></a></h5>				
				<h4 class="job-listing-title"><?php echo $freelancer['member_heading'];?></h4>				
				<div class="freelancer-rating">
					<div class="star-rating" data-rating="<?php echo round($freelancer['avg_rating'],1);?>"></div>
				</div>
			</div>
			
			<div class="freelancer-details-list">
				<ul>	                	
                    <li><a href="#" class="btn btn-sm btn-success">Hire Freelancer</a></li>
                    <li><a href="#" class="btn btn-sm btn-outline-success">Invite to Job</a></li>				
					<li>
                        <p class="mb-0">Job Success <b>50%</b></p>
                        <div class="progress" style="height:6px; min-width: 100px;">
                          <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>                
                    </li>
				</ul>
			</div>
				
			</div>
			
			<p class="job-listing-text"><?php echo $freelancer['member_overview'];?></p>
			<ul class="skill-tags list-1">	
				<?php array_map("print_skill", $freelancer['user_skill']); ?>
			</ul>
		</div>
	</div>		
    <div class="job-listing-footer">
        <ul>
            <li><i class="icon-feather-map-pin"></i> <?php echo $freelancer['country_name'];?></li>
            <li>Rate <strong><?php echo $freelancer['member_hourly_rate'] > 0 ? priceSymbol().  priceFormat($freelancer['member_hourly_rate']) . ' / hr' : ' - ';?></strong></li>
			<li><i class="icon-material-outline-account-balance-wallet"></i> Earned <strong><?php D(priceSymbol().displayamount($freelancer['total_earning'],2));?></strong></li>
            <li class="ml-auto">
            <?php if($freelancer['badges']){
              	foreach($freelancer['badges'] as $b=>$badge){
              		$badge_icon=UPLOAD_HTTP_PATH.'badge-icons/'.$badge->icon_image;
				?>
				<img src="<?php echo $badge_icon;?>" alt="<?php echo $badge->name;?>" height="26" width="26" data-tippy-placement="top" title="<?php echo $badge->name;?>"  /> &nbsp;
				<?php	
				}
				}
              	?>
            <a href="#" class="btn btn-circle btn-light"><i class="icon-feather-heart"></i></a>
            <!--<a href="#" class="btn btn-circle btn-light active"><i class="icon-feather-heart"></i></a>-->
            </li>
        </ul>
    </div>			
</div>		
<?php } } ?>
<!-- Freelancer -->

<?php /* -- just for backup
<div class="job-listing">

	<!-- Job Listing Details -->
	<div class="job-listing-details">
		<!-- Logo -->
		<div class="job-listing-company-logo">
			<a href="#"><img src="<?php echo IMAGE;?>user-avatar-big-01.jpg" alt="">
			<span class="verified-badge"></span></a>
		</div>

		<!-- Details -->
		<div class="job-listing-description">	
			<div class="freelancer-about">
			<div class="freelancer-intro">						
				<h3 class="job-listing-title"><a href="#">David Peterson</a></h3>
				<span class="text-muted">iOS Expert + Node Dev</span>
				<div class="freelancer-rating">
					<div class="star-rating" data-rating="4.5"></div>
				</div>
			</div>
			
			<div class="freelancer-details-list">
				<ul>
					<li>Location <strong><i class="icon-feather-map-pin"></i> London</strong></li>
					<li>Rate <strong>$60 / hr</strong></li>
					<li>Job Success <strong>95%</strong></li>
				</ul>
			</div>
				
			</div>
			
			<p class="job-listing-text">Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value.</p>
			<div class="task-tags">
				<a href="#">Accounting</a>
				<a href="#">Analytics</a>
				<a href="#">Brand Licensing</a>
				<a href="#">Business Development</a>
				<a href="#">Financial Management</a>
			</div>
		</div>
	</div>					
</div>
*/?>
