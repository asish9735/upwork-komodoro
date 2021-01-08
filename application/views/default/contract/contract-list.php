<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$currency=priceSymbol();
?>
<!-- Dashboard Container -->

<div class="dashboard-container"> <?php echo $left_panel;?> 
  <!-- Dashboard Sidebar / End --> 
  
  <!-- Dashboard Content
	================================================== -->
  <div class="dashboard-content-container">
    <div class="dashboard-content-inner" > 
      <!--<div class="dashboard-headline">
				<h3>My Favourite</h3>				
			</div>-->
      
      <div class="dashboard-box margin-top-0"> 
        
        <!-- Headline -->
        <div class="headline">
          <h3>All Contracts</h3>
        </div>
        <div class="content">
          <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link active" href="#">All</a></li>
            <li class="nav-item"><a class="nav-link" href="#">In Progress</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Completed</a></li>
          </ul>
          <ul class="dashboard-box-list">
            <?php if($list){foreach($list as $k => $v){ 
				if($v['is_hourly']==1){
					$contract_details_url=get_link('ContractDetailsHourly').'/'.md5($v['contract_id']);
				}else{
					$contract_details_url=get_link('ContractDetails').'/'.md5($v['contract_id']);
				}
				
			?>
            <li> 
              <!-- Job Listing -->
              <div class="job-listing width-adjustment"> 
                
                <!-- Job Listing Details -->
                <div class="job-listing-details"> 
                  <!-- Details -->
                  <div class="job-listing-description">
                    <h3 class="job-listing-title"><a href="<?php echo $contract_details_url;?>"><?php echo $v['contract_title']; ?></a>
                      <?php if($v['contract_status']==1){?>
                      <span class="dashboard-status-button green">Approved</span>
                      <?php }elseif($v['contract_status']==2){?>
                      <span class="dashboard-status-button red">Rejected</span>
                      <?php }elseif($v['contract_status']==0){?>
                      <span class="dashboard-status-button yellow">Pending</span>
                      <?php }?>
                    </h3>
                    
                    <!-- Job Listing Footer -->
                    <div class="job-listing-footer">
                      <ul>
                        <li><b>Budget:</b>
                          <?php D($currency.$v['contract_amount']);?>
                          <?php if($v['is_hourly']==1){echo'/hr';}?>
                        </li>
                        <li><b>Date:</b>
                          <?php D($v['contract_date']);?>
                        </li>
                        <li><b>Status:</b>
                          <?php if($v['is_contract_ended']==1){?>
                          <span class="dashboard-status-button blue">Completed On:
                          <?php D($v['contract_end_date']);?>
                          </span>
                          <?php }else{?>
                          <span class="dashboard-status-button green">In Process</span>
                          <?php }?>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                </div>
                <!-- Buttons -->
                <div class="buttons-to-right single-right-button always-visible"> <a href="<?php echo $contract_details_url;?>" class="btn btn-sm btn-outline-site ico" data-tippy-placement="top" title="View"> <i class="icon-feather-eye"></i> </a> </div>
              
            </li>
            <?php } }else{ ?>
            <li>No record found</li>
            <?php }?>
          </ul>
        </div>
      </div>
      <?php echo $links; ?> </div>
  </div>
  <!-- Dashboard Content / End --> 
  
</div>
<!-- Dashboard Container / End --> 
