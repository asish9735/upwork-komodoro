<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script src="<?php echo JS;?>jquery-3.3.1.min.js"></script>
<script src="<?php echo JS;?>canvasjs.min.js" type="text/javascript"></script>
<!-- Dashboard Container -->

<div class="dashboard-container"> <?php echo $left_panel;?> 
  <!-- Dashboard Content -->
  <div class="dashboard-content-container " >
    <div class="dashboard-content-inner">
      <?php if(!$is_email_verified){?>
      <div class="mx-auto alert alert-warning text-center">
        <p class="mb-0"> <i class="icon-material-outline-highlight-off text-danger"></i> Your email is not verified. <a href="<?php D(VZ);?>" class="btn btn-site btn-sm ml-2 resendEmail">Resend Email</a></p>
      </div>
      <?php }elseif(!$is_doc_verified){?>
      <div class="mx-auto alert alert-warning text-center">
        <p class="mb-0"> <i class="icon-material-outline-highlight-off text-danger"></i> Please verify your profile. <a href="<?php echo URL::get_link('verifyDocumentURL');?>" class="btn btn-site btn-sm ml-2">Verify Now</a></p>
      </div>
      <?php }?>
      <div class="fun-facts-container">
        <div class="fun-fact" hidden>
          <div class="fun-fact-text"> <span>Available Bids</span>
            <h4><strong>50</strong></h4>
          </div>
        </div>
        <div class="fun-fact" style="cursor:pointer;" onclick="window.location.href='<?php echo get_link('TransactionHistoryURL');?>'">
          <div class="fun-fact-icon"><img src="<?php echo IMAGE;?>money.png" alt="" /></div>
          <div class="fun-fact-text"> <span>Earned</span>
            <h4><?php D($currency);?><strong><?php D(priceFormat($memberInfo->total_earning));?></strong></h4>
          </div>    
        </div>
        <div class="fun-fact" style="cursor:pointer;" onclick="window.location.href='<?php echo get_link('ContractList');?>'">
          <div class="fun-fact-icon"><img src="<?php echo IMAGE;?>handshake.png" alt="" /></div>
          <div class="fun-fact-text"> <span>Total Contracts</span>
            <h4><strong><?php D($memberInfo->total_jobs);?></strong></h4>
          </div>
        </div>
        <div class="fun-fact" style="cursor:pointer;" onclick="window.location.href='<?php echo get_link('OfferList');?>'">
          <div class="fun-fact-icon"><img src="<?php echo IMAGE;?>discount.png" alt="" /></div>
          <div class="fun-fact-text"> <span>Total Offers</span>
            <h4><strong><?php D($memberInfo->total_offer);?></strong></h4>
          </div>
        </div>
        <div class="fun-fact">
          
          <div class="fun-fact-icon"><img src="<?php echo IMAGE;?>clock.png" alt="" /></div>
          <div class="fun-fact-text"> <span>Total Working Hour</span>
            <h4><strong><?php D(displayamount($memberInfo->total_working_hour,2));?></strong></h4>
          </div>
        </div>
      </div>
<?php  if($offer_invitation_list){?>
      <div class="dashboard-box "> 
        <!-- Headline -->
        <div class="headline">
          <h3>Invitation for offer</h3>
        </div>
        <div class="content">
          <ul class="dashboard-box-list">
          <?php foreach($offer_invitation_list as $k => $v){ 
			$contract_details_url=get_link('OfferDetails').'/'.md5($v['contract_id']);
			?>
            <li>
                <!-- Job Listing -->
                <div class="job-listing width-adjustment">
            
                    <!-- Job Listing Details -->
                    <div class="job-listing-details">
                        <!-- Details -->
                        <div class="job-listing-description">
                            <h4 class="job-listing-title"><a href="<?php echo $contract_details_url;?>"><?php echo $v['contract_title']; ?></a></h4>
            
                            <!-- Job Listing Footer -->
                            <div class="job-listing-footer if-button">
                                <ul>
                                    <li><b>Budget:</b> <?php D($currency.$v['contract_amount']);?><?php if($v['is_hourly']==1){echo'/hr';}?></li>
                                    <li><b>Date:</b> <?php D($v['contract_date']);?></li>
                                    <li>
                                    	<?php if($v['contract_status']==1){?>
                                        <span class="dashboard-status-button green">Approved</span>
                                        <?php }elseif($v['contract_status']==2){?>
                                        <span class="dashboard-status-button red">Rejected</span>
                                        <?php }elseif($v['contract_status']==0){?>
                                        <span class="dashboard-status-button yellow">Pending</span>
                                        <?php }?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Buttons -->
                <div class="buttons-to-right single-right-button always-visible">
                    <a href="<?php echo $contract_details_url;?>" class="btn btn-sm btn-outline-site ico" data-tippy-placement="left" title="View">
                        <i class="icon-feather-eye"></i>
                    </a>
                </div>									
            </li>
          <?php 
              }
          ?>
          </ul>
        </div>
      </div>
<?php
}
?>
<?php  if($bid_invitation_list){?>
      <div class="dashboard-box "> 
        <!-- Headline -->
        <div class="headline">
          <h3>Invitation for bids</h3>
        </div>
        <div class="content">
          <ul class="dashboard-box-list">
          <?php foreach($bid_invitation_list as $k => $v){ 
			 $url=get_link('myProjectDetailsURL')."/".$v['project_url'];
			?>
            <li>
                <!-- Job Listing -->
                <div class="job-listing width-adjustment">
            
                    <!-- Job Listing Details -->
                    <div class="job-listing-details">
                        <!-- Details -->
                        <div class="job-listing-description">
                            <h4 class="job-listing-title"><a href="<?php echo $url;?>"><?php echo $v['project_title']; ?></a></h4>
            
                            <!-- Job Listing Footer -->
                            <div class="job-listing-footer if-button">
                                <ul>
                                <li><i class="icon-material-outline-access-time"></i> Posted <?php D(get_time_ago($v['project_posted_date']));?></li>
                                <li><b>Date:</b> <?php D($v['invite_date']);?></li>
                                <li><?php if($v['is_hourly']){?>
                                <span class="dashboard-status-button yellow"><?php D('Hourly');?></span>
                                <?php }else{?>
                                <span class="dashboard-status-button green"><?php D('Fixed');?></span>
                                <?php }?>
                                <?php if($v['bid_id']){?>
                                  <span class="dashboard-status-button green">Already Bid</span>
                                <?php }else{?>
                                  <span class="dashboard-status-button yellow">Pending</span>
                                <?php }?>
                                </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Buttons -->
                <div class="buttons-to-right single-right-button always-visible">
                    <a href="<?php echo $url;?>" class="btn btn-sm btn-outline-site ico" data-tippy-placement="left" title="View">
                        <i class="icon-feather-eye"></i>
                    </a>
                </div>									
            </li>

          <?php 
             }   
          ?>
          </ul>
        </div>
      </div>
<?php }?>

      <div class="dashboard-box "> 
        <!-- Headline -->
        <div class="headline">
          <h3>Activity Feed</h3>
        </div>
        <div class="content">
          <ul class="dashboard-box-list activity-feed">
          <?php if($notification_list){
            foreach($notification_list as $k=>$list){
             // echo '<pre>';
              //print_r($list);
             // echo '</pre>';
              $url=base_url('notification/seen?id='.$list->notification_id.'&link='.urlencode($list->link));
              $logo=getMemberLogo($list->notification_from);
              $read_class='<i class="icon-feather-check"></i>';
              if($list->read_status){
                $read_class='<i class="icon-feather-check-all"></i>';
              }
              $parse_data = !empty($list->template_data) ? (array) json_decode($list->template_data) : array();
              $sender_name='';
              if(array_key_exists('SENDER_NAME',$parse_data)){
                $sender_name=$parse_data['SENDER_NAME'];
              }
          ?>
            <li>
              <div class="job-listing">                 
                <!-- Job Listing Details -->
                <div class="job-listing-details">                   
                  <!-- Logo --> 
                  <a href="<?php echo $url;?>" class="job-listing-company-logo"> <img src="<?php echo $logo;?>" alt=""> </a>                   
                  <!-- Details -->
                  <div class="job-listing-description">
                  	<span class="float-right text-muted d-none d-md-block"><i class="icon-material-outline-access-time"></i> <?php echo $list->time_ago;?></span>
                    <h4 class="job-listing-title mb-1 mw-100"><a href="<?php echo $url;?>"><?php echo $list->notification;?></a> </h4>                    
                    <div class="job-listing-footer">
                    <ul>
                      <li><i class="icon-material-outline-account-circle"></i> <?php echo $sender_name;?></li>
                      <li><i class="icon-feather-calendar"></i> <?php echo $list->sent_date;?> </li>                      
                      <li class="d-md-none"><span class="text-muted"><i class="icon-material-outline-access-time"></i> <?php echo $list->time_ago;?></span></li>
                      <li>
                      	<?php echo $read_class;?>                      	
                      </li>
                    </ul>
                    </div>
                  </div>
                </div>
              </div> 
            </li>
          <?php
            }
          }else{
           ?>
          <li>No record found</li>
           <?php 
          }
          ?>           
          </ul>
        </div>
      </div>
      <div class="dashboard-box "> 
        <!-- Headline -->
        <div class="headline">
          <h3>Recent contract</h3>
        </div>
        <div class="content">
          <ul class="dashboard-box-list">
          <?php
          if($contract_list){
            foreach($contract_list as $k => $v){ 
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
                    <h4 class="job-listing-title"><a href="<?php echo $contract_details_url;?>"><?php echo $v['contract_title']; ?></a>
                      <?php /* if($v['contract_status']==1){?>
                      <span class="dashboard-status-button green">Approved</span>
                      <?php }elseif($v['contract_status']==2){?>
                      <span class="dashboard-status-button red">Rejected</span>
                      <?php }elseif($v['contract_status']==0){?>
                      <span class="dashboard-status-button yellow">Pending</span>
                      <?php }*/ ?>
                    </h4>
                    
                    <!-- Job Listing Footer -->
                    <div class="job-listing-footer if-button">
                      <ul>
                        <li><b>Budget:</b>
                          <?php D($currency.$v['contract_amount']);?>
                          <?php if($v['is_hourly']==1){echo'/hr';}?>
                        </li>
                        <li><i class="icon-feather-calendar"></i>
                          <?php D($v['contract_date']);?>
                        </li>
                        <li>
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


      <div class="row margin-top-10">
        <div class="col-md-6"> 
          <!-- Dashboard Box -->
          <div class="dashboard-box main-box-in-row">
						<div class="headline">
							<h3><i class="icon-feather-bar-chart-2"></i> Earning Statics</h3>
							<div class="sort-by" hidden>
								<select class="selectpicker hide-tick">
									<option>Last 6 Months</option>
									<option>This Year</option>
									<option>This Month</option>
								</select>
							</div>
						</div>
						<div class="content">
							<!-- Chart -->
							<div class="chart">
								<canvas id="chart"></canvas>
							</div>
						</div>
					</div>
          <!-- Dashboard Box / End --> 
        </div>
        <div class="col-md-6"> 
          <!-- Dashboard Box -->
          <div class="dashboard-box main-box-in-row">
            <div class="headline">
              <h3><i class="icon-feather-pie-chart-2"></i> Project Statics</h3>
            </div>
            <div class="content"> 
              <!-- Chart -->
              <div class="chart">
              <canvas id="chartpie"></canvas>
              </div>
            </div>
          </div>
          <!-- Dashboard Box / End --> 
        </div>
      </div>
      
    
    </div>
  </div>
</div>
<!-- Dashboard Container / End --> 

<script type="text/javascript">
var SPINNER='<?php load_view('inc/spinner',array('size'=>30));?>';
	var main=function(){
		$('.resendEmail').click(function(){
			var buttonsection=$(this);
			var buttonval = buttonsection.html();
			buttonsection.html(SPINNER).attr('disabled','disabled');
			$.ajax({
        		type: "POST",
		        url: "<?php D(get_link('resendEmailURLAJAX'))?>",
		        dataType: "json",
		        cache: false,
				success: function(msg) {
					buttonsection.html(buttonval).removeAttr('disabled');
					clearErrors();
					if (msg['status'] == 'OK') {
						bootbox.alert({
							title:'Verify Email',
							message: '<?php D(__('resendemail_success_message','An email has been sent to your email address with instructions on how to veirfy your email.'));?>',
							buttons: {
							'ok': {
								label: 'Ok',
								className: 'btn-site pull-right'
								}
							},
							callback: function () {
								
						    }
						});

					} else if (msg['status'] == 'FAIL') {
					bootbox.alert({
							title:'Verify Email',
							message: '<?php D(__('resendemail_error_message',"Opps! . Please try again."));?>',
							buttons: {
							'ok': {
								label: 'Ok',
								className: 'btn-site pull-right'
								}
							}
						});
				}
		}
	})
		})
  }
  var mainload=function(){
/*   Chart.defaults.global.defaultFontFamily = "Nunito";
	Chart.defaults.global.defaultFontColor = '#888';
	Chart.defaults.global.defaultFontSize = '14'; */

	var ctx = document.getElementById('chart').getContext('2d');

  var chart = new Chart(ctx, {
		type: 'line',

		// The data for our dataset
		data: {
			labels: ["<?php echo implode('","',$line_chart_earning['label'])?>"],
			// Information about the dataset
	   		datasets: [{
				label: "Earn",
				backgroundColor: 'rgba(42,65,232,0.08)',
				borderColor: '#2a41e8',
				borderWidth: "3",
				data: [<?php echo implode(',',$line_chart_earning['data'])?>],
				pointRadius: 5,
				pointHoverRadius:5,
				pointHitRadius: 10,
				pointBackgroundColor: "#fff",
				pointHoverBackgroundColor: "#fff",
				pointBorderWidth: "2",
			}]
		},

		// Configuration options
		options: {
      responsive: true,
		    layout: {
		      padding: 10,
		  	},
			legend: { display: false },
			title:  { display: false },

			scales: {
				yAxes: [{
					scaleLabel: {
						display: false,
					},
          ticks: {
            beginAtZero: true,
            //stepSize: 20,
          },
					gridLines: {
						 borderDash: [6, 10],
						 color: "#d8d8d8",
						 lineWidth: 1,
	            	},
				}],
				xAxes: [{
					scaleLabel: { display: false },  
					gridLines:  { display: false },
				}],
			},

		    tooltips: {
		      backgroundColor: '#333',
		      titleFontSize: 13,
		      titleFontColor: '#fff',
		      bodyFontColor: '#fff',
		      bodyFontSize: 13,
		      displayColors: false,
		      xPadding: 10,
		      yPadding: 10,
		      intersect: false,
          callbacks: {
            label: function(tooltipItem, data) {
                var label = data.datasets[tooltipItem.datasetIndex].label || '';

                if (label) {
                    label += ': <?php echo $currency;?>';
                }
                label += Math.round(tooltipItem.yLabel * 100) / 100;
                return label;
            }
          }
		    }
		},


});

var ctx_pie = document.getElementById('chartpie').getContext('2d');
var chart_pie = new Chart(ctx_pie, {
  type: 'pie',
			data: {
				datasets: [{
					data: [ <?php echo implode(',',$pie_chart_project['data'])?>],
					backgroundColor: [ "<?php echo implode('","',$pie_chart_project['color'])?>" ],
					label: 'Dataset 1'
				}],
				labels: [ "<?php echo implode('","',$pie_chart_project['label'])?>"]
			},
			options: {
				responsive: true
			}
});



	}
</script>