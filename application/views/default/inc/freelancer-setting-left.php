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
<!-- Dashboard Sidebar -->
	<div class="dashboard-sidebar" data-simplebar>
		<div class="dashboard-sidebar-inner" >
			<div class="dashboard-nav-container">

				<!-- Responsive Navigation Trigger -->
				<a href="#" class="dashboard-responsive-nav-trigger">
					<span class="hamburger hamburger--collapse" >
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</span>
					<span class="trigger-title">Dashboard Navigation</span>
				</a>
				<div class="profile">
                	<img src="<?php echo $logo;?>" alt="user" class="rounded-circle" />
                    <!--<span class="verified-badge"></span>-->
                </div>
                <div class="profile-details">
                	<div class="text-center">
                    <h4><?php echo $profile_name;?> <img class="flag" src="<?php echo IMAGE;?>flags/gb.svg" alt="" title="United Kingdom" data-tippy-placement="top" height="15"></h4>
                    <div class="star-rating mb-2" data-rating="3.5"></div>
                    <div class="mb-2">
                    <img src="<?php echo IMAGE;?>badge-award.png" alt="Badge Award" height="26" width="26" data-tippy-placement="top" title="Badge Award"  /> &nbsp;
                    <img src="<?php echo IMAGE;?>badge-security.png" alt="Badge Security" height="26" width="26" data-tippy-placement="top" title="Badge Security"  /> &nbsp;
                    <img src="<?php echo IMAGE;?>badge-verified.png" alt="Badge Award" height="26" width="26" data-tippy-placement="top" title="Badge Award"  /> &nbsp;
                    <img src="<?php echo IMAGE;?>badge-winner.png" alt="Badge Award" height="26" width="26" data-tippy-placement="top" title="Badge Award"  />
                    </div>
                    </div>
                    <h5><i class="icon-feather-clock text-info"></i> <?php echo CURRENCY;?>20/hr &nbsp; <span class="text-muted">|</span> &nbsp; <i class="icon-feather-calendar text-primary"></i> <b>30hr/week</b> </h5>
                    <h5><i class="icon-material-outline-account-balance-wallet text-success"></i> <?php echo CURRENCY;?><b>1500</b></h5>
                    <a href="<?php echo URL::get_link('myprofileAJAXURL');?>" class="btn btn-site btn-block">My Profile</a>
                    
                </div>
				<!-- Navigation -->
				<div class="dashboard-nav">
					<div class="dashboard-nav-inner">

						<ul>
							<li class="active"><a href="<?php echo URL::get_link('dashboardURL'); ?>"><i class="icon-material-outline-dashboard"></i> Dashboard</a></li>
							<li><a href="<?php echo URL::get_link('MessageURL');?>"><i class="icon-material-outline-question-answer"></i> Messages <!--<span class="nav-tag">2</span>--></a></li>
							<li><a href="<?php echo URL::get_link('favoriteURL');?>"><i class="icon-material-outline-star-border"></i> Bookmarks</a></li>
							<li><a href="<?php echo URL::get_link('MyReviewURL');?>"><i class="icon-material-outline-rate-review"></i> Reviews</a></li>
						</ul>
						<ul data-submenu-title="Finance">
							<li><a href="#"><i class="icon-material-outline-account-balance-wallet"></i> Finance</a>
								<ul>
									<li><a href="<?php D(get_link('AddFundURL'))?>">Add Fund</a></li>
									<li><a href="<?php D(get_link('TransactionHistoryURL'))?>">Transaction</a></li>
									<li><a href="<?php D(get_link('WithdrawURL'))?>">Withdraw</a></li>
									<li><a href="<?php D(get_link('InvoiceURL'))?>">Invoice</a></li>
								</ul>	
							</li>
						</ul>
						<ul>
							<!--<li><a href="#"><i class="icon-material-outline-business-center"></i> Jobs</a>
								<ul>
									<li><a href="dashboard-manage-jobs.html">Manage Jobs <span class="nav-tag">3</span></a></li>
									<li><a href="dashboard-manage-candidates.html">Manage Candidates</a></li>
									<li><a href="dashboard-post-a-job.html">Post a Job</a></li>
								</ul>	
							</li>-->
							<li><a href="#"><i class="icon-material-outline-assignment"></i> Jobs</a>
								<ul>
									<li><a href="<?php D(get_link('myBidsURL'))?>">My Proposals</a></li>
									<li><a href="<?php D(get_link('OfferList'))?>">My Offers </a></li>
									<li><a href="<?php D(get_link('ContractList'))?>">My Contract </a></li>
									<!--<li><a href="dashboard-manage-tasks.html">Manage Tasks <span class="nav-tag">2</span></a></li>
									<li><a href="dashboard-manage-bidders.html">Manage Bidders</a></li>
									<li><a href="dashboard-my-active-bids.html">My Active Bids <span class="nav-tag">4</span></a></li>
									<li><a href="dashboard-post-a-task.html">Post a Task</a></li>-->
								</ul>	
							</li>
						</ul>

						<ul>
							<li><a href="<?php echo URL::get_link('settingaccountInfoURL')?>"><i class="icon-material-outline-settings"></i> Settings</a>
								<ul>
									<li><a href="<?php echo URL::get_link('settingaccountInfoURL');?>">Contact info</a></li>
									<li><a href="<?php echo URL::get_link('settingpasswordURL');?>">Password & security</a></li>
									<li><a href="<?php echo URL::get_link('myprofileAJAXURL');?>">My profile</a></li>
								</ul>
							
							</li>
							
							<li><a href="<?php echo URL::get_link('logoutURL');?>"><i class="icon-material-outline-power-settings-new"></i> Logout</a></li>
						</ul>
						
					</div>
				</div>
				<!-- Navigation / End -->

			</div>
		</div>
	</div>
	<!-- Dashboard Sidebar / End -->