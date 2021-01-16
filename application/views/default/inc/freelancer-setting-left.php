<!-- Dashboard Sidebar
	================================================== -->
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
				
				<!-- Navigation -->
				<div class="dashboard-nav">
					<div class="dashboard-nav-inner">

						<ul>
							<li class="active"><a href="<?php echo URL::get_link('dashboardURL'); ?>"><i class="icon-material-outline-dashboard"></i> Dashboard</a></li>
							<li><a href="<?php echo URL::get_link('MessageURL');?>"><i class="icon-material-outline-question-answer"></i> Messages <!--<span class="nav-tag">2</span>--></a></li>
							<li><a href="<?php echo URL::get_link('favoriteURL');?>"><i class="icon-material-outline-star-border"></i> Bookmarks</a></li>
							<li><a href="#"><i class="icon-material-outline-rate-review"></i> Reviews</a></li>
						</ul>
						<ul data-submenu-title="Finance">
							<li><a href="#"><i class="icon-material-outline-account-balance-wallet"></i> Finance</a>
								<ul>
									<li><a href="<?php D(get_link('AddFundURL'))?>">Add Fund</a></li>
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