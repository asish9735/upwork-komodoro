<?php
$loggedUser=$this->session->userdata('loggedUser');
if($loggedUser){
	$profile_name='';
	$this->access_user_id=$loggedUser['LID'];	
	$this->access_member_type=$loggedUser['ACC_P_TYP'];
	$this->member_id=$loggedUser['MID'];
	$this->organization_id=$loggedUser['OID'];
	$member_name=getFieldData('member_name','member','member_id',$this->member_id);
	if($this->access_member_type=='C'){
		$logo=getCompanyLogo($this->organization_id);
		$organization_name=getFieldData('organization_name','organization','member_id',$this->member_id);
		$profile_name=($organization_name  ? $organization_name:$member_name);
	}else{
		$logo=getMemberLogo($this->member_id);
		$profile_name=$member_name;
	}
	$profile_type_name=($this->access_member_type =='C'  ? "Client":"Freelancer");
}
?>
<!-- Header Container
================================================== -->
<header id="header-container" class="fullwidth <?php if($this->router->fetch_class()=='dashboard'){?>dashboard-header not-sticky<?php }?>" >

	<!-- Header -->
	<div id="header">
		<div class="container">
			
			<!-- Left Side Content -->
			<div class="left-side">
				
				<!-- Logo -->
				<div id="logo">
					<a href="<?php echo SITE_URL;?>"><img src="<?php echo IMAGE;?>logo.png" data-sticky-logo="<?php echo IMAGE;?>logo.png" data-transparent-logo="<?php echo IMAGE;?>logo2.png" alt=""></a>
				</div>

				<!-- Main Navigation -->
				<nav id="navigation">
					<ul id="responsive">
					<?php if($loggedUser){
						if($this->access_member_type=='C'){
						?>
						<li><a href="<?php echo URL::get_link('search_freelancer'); ?>">Find a Freelancer</a></li>
						<li><a href="<?php D(get_link('postprojectURL'))?>">Post a Job</a></li>
						<?php }
						if($this->access_member_type=='F'){
						?>
						<li><a href="<?php echo URL::get_link('search_job'); ?>">Browse Jobs</a></li>
						<?php }?>
						<li><a href="<?php echo URL::get_link('dashboardURL'); ?>">Dashboard</a></li>
					<?php }else{?>
					<li><a href="<?php echo URL::get_link('search_job'); ?>">Browse Jobs</a></li>
					<li><a href="<?php echo URL::get_link('search_freelancer'); ?>">Find a Freelancer</a></li>
					<?php }?>
					<?php /*?>
						<li><a href="#">Find Work</a>
							<ul class="dropdown-nav">
								<li><a href="<?php echo URL::get_link('search_job'); ?>">Browse Jobs</a></li>
								<li><a href="#">Browse Tasks</a></li>
							</ul>
						</li>

						<li><a href="#">For Employers</a>
							<ul class="dropdown-nav">
								<li><a href="<?php echo URL::get_link('search_freelancer'); ?>">Find a Freelancer</a></li>								
								<li><a href="dashboard-post-a-job.html">Post a Job</a></li>
								<li><a href="dashboard-post-a-task.html">Post a Task</a></li>
							</ul>
						</li>

						<li><a href="#">Dashboard</a>
							<ul class="dropdown-nav">
								<li><a href="<?php echo URL::get_link('dashboardURL'); ?>">Dashboard</a></li>
								<li><a href="dashboard-messages.html">Messages</a></li>
								<li><a href="dashboard-bookmarks.html">Bookmarks</a></li>
								<li><a href="dashboard-reviews.html">Reviews</a></li>
								<li><a href="dashboard-manage-jobs.html">Jobs</a></li>																	
								<li><a href="dashboard-settings.html">Settings</a></li>
							</ul>
						</li>
						<?php */?>
					</ul>
				</nav>
				<div class="clearfix"></div>
				<!-- Main Navigation / End -->
				
			</div>
			<!-- Left Side Content / End -->


			<!-- Right Side Content / End -->
			<div class="right-side">

			<?php if(!is_login_user()){ ?>
				<div class="header-widget hide-on-mobile">
					<a href="<?php echo URL::get_link('loginURL'); ?>" class=" log-in-button"><span>Log In</span></a>
					<a href="<?php echo URL::get_link('registerURL'); ?>" class=" log-in-button"><span>Register</span></a>
				</div>
			<?php }else{ ?>

				<!--  User Notifications -->
				<div class="header-widget hide-on-mobile">
					
					<!-- Notifications -->
					<div class="header-notifications">

						<!-- Trigger -->
						<div class="header-notifications-trigger notification-trigger">
							<a href="#"><i class="icon-feather-bell"></i><span class="new-notification-counter" style="display:none"></span></a>
						</div>

						<!-- Dropdown -->
						<div class="header-notifications-dropdown">

							<div class="header-notifications-headline">
								<h4>Notifications</h4>
								<button class="mark-as-read" title="Mark all as read" data-tippy-placement="left" hidden>
									<i class="icon-feather-check-square"></i>
								</button>
							</div>

							<div class="header-notifications-content">
								<div class="header-notifications-scroll">
									<ul id="header-notification-list" style="max-height:200px; overflow: auto;">
										
									</ul>
									<a id="load_more_notification_btn" href="javascript:void(0)" style="display:none;">Load more</a>
								</div>
							</div>

						</div>

					</div>
					
					<!-- Messages -->
					<div class="header-notifications">
						<div class="header-notifications-trigger message-trigger">
							<a href="#"><i class="icon-feather-mail"></i><span class="new-message-counter" style="display:none"></span></a>
						</div>

						<!-- Dropdown -->
						<div class="header-notifications-dropdown">

							<div class="header-notifications-headline">
								<h4>Messages</h4>
								<button class="mark-as-read" title="Mark all as read" data-tippy-placement="left" hidden>
									<i class="icon-feather-check-square"></i>
								</button>
							</div>

							<div class="header-notifications-content">
								<div class="header-notifications-scroll" id="header-message-container">
									<ul id="header-message-list" style="max-height:200px; overflow: auto;">
										
									</ul>
									<a id="load_more_msg_btn" href="javascript:void(0)" style="display:none;">Load more</a>
								</div>
							</div>

							<a href="<?php echo base_url('message');?>" class="header-notifications-button40de00button-sliding-icon">View All Messages<i class="icon-material-outline-arrow-right-alt"></i></a>
						</div>
					</div>

				</div>
				<!--  User Notifications / End -->

				

				<!-- User Menu -->
				<div class="header-widget">

					<!-- Messages -->
					<div class="header-notifications user-menu">
						<div class="header-notifications-trigger">
							<a href="#"><div class="user-avatar status-online"><img src="<?php echo $logo;?>" alt=""></div></a>
						</div>

						<!-- Dropdown -->
						<div class="header-notifications-dropdown">

							<!-- User Status -->
							<div class="user-status">

								<!-- User Name / Avatar -->
								<div class="user-details">
									<div class="user-avatar status-online"><img src="<?php echo $logo;?>" alt=""></div>
									<div class="user-name">
										<?php echo $profile_name;?> <span><?php echo $profile_type_name;?></span>
									</div>
								</div>
								
								<!-- User Status Switcher -->
								<?php /*?><div class="status-switch" id="snackbar-user-status">
									<label class="user-online current-status">Online</label>
									<label class="user-invisible">Invisible</label>
									<!-- Status Indicator -->
									<span class="status-indicator" aria-hidden="true"></span>
								</div><?php */?>
						</div>
						
						<ul class="user-menu-small-nav">
							<li><a href="<?php echo URL::get_link('dashboardURL'); ?>"><i class="icon-material-outline-dashboard"></i> Dashboard</a></li>
							<li><a href="<?php echo URL::get_link('settingsURL'); ?>"><i class="icon-material-outline-settings"></i> Settings</a></li>
							<li><a href="<?php echo URL::get_link('logoutURL'); ?>"><i class="icon-material-outline-power-settings-new"></i> Logout</a></li>
						</ul>

						</div>
					</div>

				</div>
				<!-- User Menu / End -->
				<?php } ?>
				<!-- Mobile Navigation Button -->
				<span class="mmenu-trigger">
					<button class="hamburger hamburger--collapse" type="button">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</button>
				</span>

			</div>
			<!-- Right Side Content / End -->

		</div>
	</div>
	<!-- Header / End -->

</header>
<div class="clearfix"></div>
<!-- Header Container / End -->
