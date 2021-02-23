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
	
	$memberDataBasic=getData(array(
		'select'=>'m_s.avg_rating,',
		'table'=>'member as m',
		'join'=>array(array('table'=>'member_basic as m_b','on'=>'m.member_id=m_b.member_id','position'=>'left'),array('table'=>'member_statistics m_s','on'=>'m.member_id=m_s.member_id','position'=>'left')),
		'where'=>array('m.member_id'=>$this->member_id),
		'single_row'=>true,
	));	
	$memberDataBasic->balance=getFieldData('balance','wallet','user_id',$this->member_id);
}
?>
<!-- Dashboard Sidebar
	================================================== -->
	<div class="dashboard-sidebar">
		<div class="dashboard-sidebar-inner" data-simplebar>
			<div class="dashboard-nav-container">

				<!-- Responsive Navigation Trigger -->
				<a href="#" class="dashboard-responsive-nav-trigger">
					<span class="hamburger hamburger--collapse" >
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</span>
					<span class="trigger-title">Navigation</span>
				</a>
				
				<!-- Navigation -->
				<div class="dashboard-nav">
					<div class="dashboard-nav-inner">
                    	<div class="profile">
                	<div class="profile_pic">
                    	<img src="<?php echo $logo;?>" alt="<?php echo $profile_name;?>" class="rounded-circle" />
                        <span class="verified-badge"></span>
                    </div>                    
                    <div class="profile-details text-center">
                        <div class="">
                        <h4><?php echo $profile_name;?></h4>
                        <div class="star-rating mb-2" data-rating="<?php echo round($memberDataBasic->avg_rating,1);?>"></div>
                        </div>
                        <h5> <i class="icon-material-outline-account-balance-wallet text-success"></i> <?php echo CURRENCY;?><b><?php D(priceFormat($memberDataBasic->balance));?></b> <a href="<?php D(get_link('AddFundURL'))?>" class="btn btn-circle btn-outline-site ml-2" style="width: 1.5rem;height: 1.5rem;padding: 0.2rem 0;"><i class="icon-feather-plus"></i></a></h5>
                        
                    </div>
                </div>
						<ul data-submenu-title="Start">
							<li class="active"><a href="<?php echo URL::get_link('dashboardURL'); ?>"><i class="icon-material-outline-dashboard"></i> Dashboard</a></li>
							<li><a href="<?php echo URL::get_link('MessageURL');?>"><i class="icon-material-outline-question-answer"></i> Messages <!--<span class="nav-tag">2</span>--></a></li>
							<li><a href="<?php echo URL::get_link('favoriteURL');?>"><i class="icon-material-outline-star-border"></i> Favourite</a></li>
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
						<ul data-submenu-title="Organize and Manage">
							<li><a href="#"><i class="icon-material-outline-business-center"></i> Projects</a>
								<ul>
									<!--<li><a href="<?php D(get_link('myprojectrecentClientURL'))?>">My Projects</a></li>-->
									<li><a href="<?php D(get_link('myProjectClientURL'))?>">All Posting</a></li>
									<li><a href="<?php D(get_link('OfferList'))?>">All Offers </a></li>
									<li><a href="<?php D(get_link('ContractList'))?>">All Contract </a></li>
									<!--<li><a href="<?php D(get_link('myContractClientURL'))?>">All Contracts</a></li>-->
									<li><a href="<?php D(get_link('postprojectURL'))?>">Post a Job</a></li>
								</ul>	
							</li>
							<!--<li><a href="#"><i class="icon-material-outline-assignment"></i> Tasks</a>
								<ul>
									<li><a href="dashboard-manage-tasks.html">Manage Tasks <span class="nav-tag">2</span></a></li>
									<li><a href="dashboard-manage-bidders.html">Manage Bidders</a></li>
									<li><a href="dashboard-my-active-bids.html">My Active Bids <span class="nav-tag">4</span></a></li>
									<li><a href="dashboard-post-a-task.html">Post a Task</a></li>
								</ul>	
							</li>-->
						</ul>

						<ul data-submenu-title="Account">
							<li><a href="<?php D(get_link('settingclientaccountInfoURL'))?>"><i class="icon-material-outline-settings"></i> Settings</a>
								<ul>
									<li><a href="<?php D(get_link('settingclientaccountInfoURL'))?>">Contact info</a></li>
									<li><a href="<?php D(get_link('settingpasswordURL'))?>">Password & security</a></li>
								</ul>
							
							</li>
							
							<li><a href="<?php D(get_link('logoutURL'))?>"><i class="icon-material-outline-power-settings-new"></i> Logout</a></li>
						</ul>
						
					</div>
				</div>
				<!-- Navigation / End -->

			</div>
		</div>
	</div>
	<!-- Dashboard Sidebar / End -->