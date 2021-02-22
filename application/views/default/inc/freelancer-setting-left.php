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
	$badges =getData(array(
		'select'=>'b.icon_image,b_n.name,b_n.description',
		'table'=>'member_badges as m',
		'join'=>array(array('table'=>'badges as b','on'=>'m.badge_id=b.badge_id','position'=>'left'),array('table'=>'badges_names as b_n','on'=>"(b.badge_id=b_n.badge_id and b_n.lang='".get_active_lang()."')",'position'=>'left')),
		'where'=>array('m.member_id'=>$this->member_id,'b.status'=>1),
		'order'=>array(array('b.display_order','asc')),
	));
	$memberDataBasic=getData(array(
		'select'=>'m_b.member_hourly_rate,m_b.available_per_week,m_b.not_available_until,m_s.avg_rating,',
		'table'=>'member as m',
		'join'=>array(array('table'=>'member_basic as m_b','on'=>'m.member_id=m_b.member_id','position'=>'left'),array('table'=>'member_statistics m_s','on'=>'m.member_id=m_s.member_id','position'=>'left')),
		'where'=>array('m.member_id'=>$this->member_id),
		'single_row'=>true,
	));	
	$memberDataBasic->badges=$badges;
	$memberDataBasic->balance=getFieldData('balance','wallet','user_id',$this->member_id);
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
                            <?php if($memberDataBasic->badges){?>
                            <div class="mb-2">
                            <?php
                            foreach($memberDataBasic->badges as $b=>$badge){
                                $badge_icon=UPLOAD_HTTP_PATH.'badge-icons/'.$badge->icon_image;
                            ?>
                                <img src="<?php echo $badge_icon;?>" alt="<?php echo $badge->name;?>" height="26" width="26" data-tippy-placement="top" title="<?php echo $badge->name;?>"  /> &nbsp;
                            <?php
                            }
                            ?>
                           </div>
                            <?php }?>
                            </div>
                            
                            <h5>
                            <i class="icon-feather-clock text-info"></i> <?php if($memberDataBasic->member_hourly_rate && $memberDataBasic->member_hourly_rate>0){D(CURRENCY.priceFormat($memberDataBasic->member_hourly_rate).'/hr');}else{D('Not set');}?> &nbsp; <span class="text-muted">|</span> &nbsp; 
                            <i class="icon-material-outline-account-balance-wallet text-success"></i> <?php echo CURRENCY;?><b><?php D(priceFormat($memberDataBasic->balance));?></b>
                            <?php /*<i class="icon-feather-calendar text-primary"></i> 
                            <b>
                            <?php if($memberDataBasic->not_available_until){
                                    echo 'Offline till '.dateFormat($memberDataBasic->not_available_until);
                                }elseif($memberDataBasic->available_per_week){
                                    $duration=getAllProjectDurationTime($memberDataBasic->available_per_week);
                                    D($duration['freelanceName']);
                                }else{
                                    D('Not set');
                                }?>
                            
                            </b>  */?>
                            </h5>
                            <!-- <h5><i class="icon-material-outline-account-balance-wallet text-success"></i> <?php echo CURRENCY;?><b>1500</b></h5> -->
                            <a href="<?php echo URL::get_link('myprofileAJAXURL');?>" class="btn btn-site btn-block">My Profile</a>
                            
                        	</div>
                    	</div>

						<ul>
							<li class="active"><a href="<?php echo URL::get_link('dashboardURL'); ?>"><i class="icon-material-outline-dashboard"></i> Dashboard</a></li>
							<li><a href="<?php echo URL::get_link('MessageURL');?>"><i class="icon-material-outline-question-answer"></i> Messages <!--<span class="nav-tag">2</span>--></a></li>
							<li><a href="<?php echo URL::get_link('NotificationURL');?>"><i class="icon-material-outline-notifications-active"></i> Notification <!--<span class="nav-tag">2</span>--></a></li>
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
							<li><a href="#"><i class="icon-material-outline-assignment"></i> Projects</a>
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