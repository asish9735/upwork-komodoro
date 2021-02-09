<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script src="<?php echo JS;?>jquery-3.3.1.min.js"></script>
<script src="<?php echo JS;?>canvasjs.min.js" type="text/javascript"></script>
<!-- Dashboard Container -->

<div class="dashboard-container"> <?php echo $left_panel;?> 
  <!-- Dashboard Content -->
  <div class="dashboard-content-container" >
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
       
        
        <div class="fun-fact">
          <div class="fun-fact-text"> <span>Open Contract</span>
            <h4><strong>25</strong></h4>
          </div>
        </div>
        <div class="fun-fact">
          <div class="fun-fact-text"> <span>Completed Contract</span>
            <h4><strong>25</strong></h4>
          </div>
        </div>
        <div class="fun-fact">
          <div class="fun-fact-text"> <span>Total Spent</span>
          <h4><?php D($currency);?> <strong><?php D(priceFormat($memberInfo->total_spent));?></strong></h4>
          </div>
        </div>
      </div>
      <div class="dashboard-box "> 
        <!-- Headline -->
        <div class="headline">
          <h3>News Feed</h3>
        </div>
        <div class="content">
          <ul class="dashboard-box-list">
          <?php if($notification_list){
            foreach($notification_list as $k=>$list){
             // echo '<pre>';
              //print_r($list);
             // echo '</pre>';
              $url=base_url('notification/seen?id='.$list->notification_id.'&link='.urlencode($list->link));
              $logo=getMemberLogo($list->notification_from);
              $read_class="";
              if($list->read_status){
                $read_class='<i class="icon-feather-check" style="margin-left:-8px"></i>';
              }
              $parse_data = !empty($list->template_data) ? (array) json_decode($list->template_data) : array();
              $sender_name='';
              if(array_key_exists('SENDER_NAME',$parse_data)){
                $sender_name=$parse_data['SENDER_NAME'];
              }
          ?>
            <li>
              <div class="job-listing mb-2">                 
                <!-- Job Listing Details -->
                <div class="job-listing-details">                   
                  <!-- Logo --> 
                  <a href="<?php echo $url;?>" class="job-listing-company-logo"> <img src="<?php echo $logo;?>" alt=""> </a>                   
                  <!-- Details -->
                  <div class="job-listing-description">
                  	<span class="float-right text-muted"><i class="icon-material-outline-access-time"></i> <?php echo $list->time_ago;?></span>
                    <h4 class="job-listing-title"><a href="<?php echo $url;?>"><?php echo $list->notification;?></a> </h4>                    
                    <div class="job-listing-footer">
                    <ul>
                      <li><i class="icon-material-outline-account-circle"></i> <?php echo $sender_name;?></li>
                      <li><i class="icon-feather-calendar"></i> <?php echo $list->sent_date;?> </li>
                      <li><i class="icon-feather-check"></i><?php echo $read_class;?></li>
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



      <div class="row margin-top-10">
        <div class="col-md-6"> 
          <!-- Dashboard Box -->
          <div class="dashboard-box main-box-in-row mb-4 mt-0">
            <div class="headline">
              <h3>My Project Report</h3>
              <div class="sort-by">
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
                <div id="splineChartContainer" style="height: 300px; max-width: 500px; margin: 0px auto;"></div>
              </div>
            </div>
          </div>
          <!-- Dashboard Box / End --> 
        </div>
        <div class="col-md-6"> 
          <!-- Dashboard Box -->
          <div class="dashboard-box main-box-in-row mb-4 mt-0">
            <div class="headline">
              <h3>My Works Statics</h3>
              <div class="sort-by">
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
                <div id="pieChartContainer" style="height: 300px; max-width: 500px; margin: 0px auto;"></div>
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

<script>
window.onload = function () {

var chart_9645123 = new CanvasJS.Chart("splineChartContainer", {
	animationEnabled: true,  
	/*title:{
		text: "Music Album Sales by Year"
	},*/
	axisX: {
		valueFormatString: "MMMM"
	},
	axisY: {
		//title: "Units Sold",
		//valueFormatString: "#0",
		//suffix: "mn",
		stripLines: [{
			value: 250,
			label: "Average"
		}]
	},
	data: [{
		yValueFormatString: "#,### Units",
		xValueFormatString: "YYYY",
		type: "splineArea",
		lineColor: '#64be43',
		color: "rgba(100,190,67,0.25)",
		markerSize: 10,		
		markerColor: "#64be43",
		dataPoints: [
			{x: new Date(2021, 0, 0), y: 103},
			{x: new Date(2021, 1, 0), y: 300},
			{x: new Date(2021, 2, 0), y: 254},
			{x: new Date(2021, 3, 0), y: 239},
			{x: new Date(2021, 4, 0), y: 201},
			{x: new Date(2021, 5, 0), y: 282},
			{x: new Date(2021, 6, 0), y: 450}
		]
	}]
});
chart_9645123.render();



var chart_47456512 = new CanvasJS.Chart("pieChartContainer", {
	//exportEnabled: true,
	animationEnabled: true,
	/*title:{
		text: "State Operating Funds"
	},*/
	legend:{
		cursor: "pointer",
		itemclick: explodePie
	},
	data: [{
		type: "pie",
		showInLegend: true,
		toolTipContent: "{name}: <strong>{y}%</strong>",
		//indexLabel: "{name} - {y}%",
		dataPoints: [
			{ y: 50, name: 'Open Jobs', exploded: true },
			{ y: 10, name: 'Pending Jobs' },
			{ y: 20, name: 'Completed Jobs' },
			{ y: 35, name: 'Available Bids' }
		]
	}]
});
chart_47456512.render();
}			
			
function explodePie (e) {
	if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
	} else {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
	}
	e.chart_47456512.render();

}
</script> 

<!--<script type="text/javascript">
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
</script>-->