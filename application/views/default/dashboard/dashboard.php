<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Dashboard Container -->
<div class="dashboard-container">
	<?php echo $left_panel;?>
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
            	<div class="fun-fact-text">
                	<span>Available Bids</span>
                    <h4>50</h4>
                </div>
            </div>
            <div class="fun-fact">
                <div class="fun-fact-text">
                	<span>Earned</span>
                    <h4>$ <strong>4099.00</strong></h4>
                </div>
            </div>
            <div class="fun-fact">
                <div class="fun-fact-text">
                	<span>Projects</span>
                    <h4>25</h4>
                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-md-6">
        	<!-- Dashboard Box -->
            <div class="dashboard-box main-box-in-row mb-4 mt-0">
                <div class="headline">
                    <h3>Your Profile Views</h3>
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
                        <canvas id="chart" width="100" height="45"></canvas>
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
                    <div class="chart m-auto" style="max-width:50%;">
                        <canvas id="chart-area" style="height:200px; width:200px;"></canvas>
                    </div>
                </div>
            </div>
			<!-- Dashboard Box / End -->
        </div>
        </div>
        
        <div class="dashboard-box margin-top-0">        
            <!-- Headline -->
            <div class="headline">
                <h3>Applied Jobs</h3>
            </div>
        
            <div class="content">
                <ul class="dashboard-box-list">
                    <li>
                        <!-- Job Listing -->
                        <div class="job-listing">
        
                            <!-- Job Listing Details -->
                            <div class="job-listing-details">
        
                                <!-- Logo -->
                                <a href="#" class="job-listing-company-logo">
                                    <img src="<?php echo IMAGE;?>job-4.png" alt="">
                                </a>
        
                                <!-- Details -->
                                <div class="job-listing-description">
                                    <h4 class="job-listing-title"><a href="#">Barista and Cashier</a></h4>
        
                                    <!-- Job Listing Footer -->
                                    <div class="job-listing-footer">
                                        <ul>
                                            <li><i class="icon-material-outline-business"></i> Coffee</li>
                                            <li><i class="icon-material-outline-location-on"></i> San Francisco</li>
                                            <li><i class="icon-material-outline-business-center"></i> Full Time</li>
                                            <li><i class="icon-material-outline-access-time"></i> 2 days ago</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Buttons -->
                        <div class="buttons-to-right single-right-button">
                            <a href="#" class="button red ripple-effect ico" data-tippy-placement="left" data-tippy="" data-original-title="Remove"><i class="icon-feather-trash"></i></a>
                        </div>
                    </li>
        
                    <li>
                        <!-- Job Listing -->
                        <div class="job-listing">
        
                            <!-- Job Listing Details -->
                            <div class="job-listing-details">
        
                                <!-- Logo -->
                                <a href="#" class="job-listing-company-logo">
                                    <img src="<?php echo IMAGE;?>job-5.png" alt="">
                                </a>
        
        
                                <!-- Details -->
                                <div class="job-listing-description">
                                    <h4 class="job-listing-title"><a href="#">Administrative Assistant</a></h4>
        
                                    <!-- Job Listing Footer -->
                                    <div class="job-listing-footer">
                                        <ul>
                                            <li><i class="icon-material-outline-business"></i> Mates</li>
                                            <li><i class="icon-material-outline-location-on"></i> San Francisco</li>
                                            <li><i class="icon-material-outline-business-center"></i> Full Time</li>
                                            <li><i class="icon-material-outline-access-time"></i> 2 days ago</li>
                                        </ul>
                                    </div>
                                </div>
        
                            </div>
                        </div>
        
                        <!-- Buttons -->
                        <div class="buttons-to-right single-right-button">
                            <a href="#" class="button red ripple-effect ico" data-tippy-placement="left" data-tippy="" data-original-title="Remove"><i class="icon-feather-trash"></i></a>
                        </div>
                    </li>
        
                    <li>
                        <!-- Job Listing -->
                        <div class="job-listing">
        
                            <!-- Job Listing Details -->
                            <div class="job-listing-details">
        
                                <!-- Logo -->
                                <a href="#" class="job-listing-company-logo">
                                    <img src="<?php echo IMAGE;?>job-6.png" alt="">
                                </a>
        
                                <!-- Details -->
                                <div class="job-listing-description">
                                    <h4 class="job-listing-title"><a href="#">Construction Labourers</a></h4>
        
                                    <!-- Job Listing Footer -->
                                    <div class="job-listing-footer">
                                        <ul>
                                            <li><i class="icon-material-outline-business"></i> Podous</li>
                                            <li><i class="icon-material-outline-location-on"></i> San Francisco</li>
                                            <li><i class="icon-material-outline-business-center"></i> Full Time</li>
                                            <li><i class="icon-material-outline-access-time"></i> 2 days ago</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <!-- Buttons -->
                        <div class="buttons-to-right single-right-button">
                            <a href="#" class="button red ripple-effect ico" data-tippy-placement="left" data-tippy="" data-original-title="Remove"><i class="icon-feather-trash"></i></a>
                        </div>
                    </li>
        
                </ul>
            </div>
        </div>
        
        <div class="dashboard-box">
        
            <!-- Headline -->
            <div class="headline">
                <h3>Shortlisted Jobs</h3>
            </div>
        
            <div class="content">
                <ul class="dashboard-box-list">
                    <li>
                        <!-- Job Listing -->
                        <div class="job-listing">
        
                            <!-- Job Listing Details -->
                            <div class="job-listing-details">
        
                                <!-- Logo -->
                                <a href="#" class="job-listing-company-logo">
                                    <img src="<?php echo IMAGE;?>job-1.png" alt="">
                                </a>
        
                                <!-- Details -->
                                <div class="job-listing-description">
                                    <h4 class="job-listing-title"><a href="#">Barista and Cashier</a></h4>
        
                                    <!-- Job Listing Footer -->
                                    <div class="job-listing-footer">
                                        <ul>
                                            <li><i class="icon-material-outline-business"></i> Coffee</li>
                                            <li><i class="icon-material-outline-location-on"></i> San Francisco</li>
                                            <li><i class="icon-material-outline-business-center"></i> Full Time</li>
                                            <li><i class="icon-material-outline-access-time"></i> 2 days ago</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Buttons -->
                        <div class="buttons-to-right single-right-button">
                            <a href="#" class="button red ripple-effect ico" data-tippy-placement="left" data-tippy="" data-original-title="Remove"><i class="icon-feather-trash"></i></a>
                        </div>
                    </li>
        
                    <li>
                        <!-- Job Listing -->
                        <div class="job-listing">
        
                            <!-- Job Listing Details -->
                            <div class="job-listing-details">
        
                                <!-- Logo -->
                                <a href="#" class="job-listing-company-logo">
                                    <img src="<?php echo IMAGE;?>job-2.png" alt="">
                                </a>
        
        
                                <!-- Details -->
                                <div class="job-listing-description">
                                    <h4 class="job-listing-title"><a href="#">Administrative Assistant</a></h4>
        
                                    <!-- Job Listing Footer -->
                                    <div class="job-listing-footer">
                                        <ul>
                                            <li><i class="icon-material-outline-business"></i> Mates</li>
                                            <li><i class="icon-material-outline-location-on"></i> San Francisco</li>
                                            <li><i class="icon-material-outline-business-center"></i> Full Time</li>
                                            <li><i class="icon-material-outline-access-time"></i> 2 days ago</li>
                                        </ul>
                                    </div>
                                </div>
        
                            </div>
                        </div>
        
                        <!-- Buttons -->
                        <div class="buttons-to-right single-right-button">
                            <a href="#" class="button red ripple-effect ico" data-tippy-placement="left" data-tippy="" data-original-title="Remove"><i class="icon-feather-trash"></i></a>
                        </div>
                    </li>
        
                    <li>
                        <!-- Job Listing -->
                        <div class="job-listing">
        
                            <!-- Job Listing Details -->
                            <div class="job-listing-details">
        
                                <!-- Logo -->
                                <a href="#" class="job-listing-company-logo">
                                    <img src="<?php echo IMAGE;?>job-3.png" alt="">
                                </a>
        
                                <!-- Details -->
                                <div class="job-listing-description">
                                    <h4 class="job-listing-title"><a href="#">Construction Labourers</a></h4>
        
                                    <!-- Job Listing Footer -->
                                    <div class="job-listing-footer">
                                        <ul>
                                            <li><i class="icon-material-outline-business"></i> Podous</li>
                                            <li><i class="icon-material-outline-location-on"></i> San Francisco</li>
                                            <li><i class="icon-material-outline-business-center"></i> Full Time</li>
                                            <li><i class="icon-material-outline-access-time"></i> 2 days ago</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <!-- Buttons -->
                        <div class="buttons-to-right single-right-button">
                            <a href="#" class="button red ripple-effect ico" data-tippy-placement="left" data-tippy="" data-original-title="Remove"><i class="icon-feather-trash"></i></a>
                        </div>
                    </li>
        
                </ul>
            </div>
        </div> 
        
        <div class="dashboard-box">
            <!-- Headline -->
            <div class="headline">
                <h3>Shortlisted  Professionals</h3>
            </div>
        
            <div class="content">
                <ul class="dashboard-box-list">
                    <li>
                        <!-- Overview -->
                        <div class="freelancer-overview">
                            <div class="freelancer-overview-inner">
        
                                <!-- Avatar -->
                                <div class="freelancer-avatar">
                                    <div class="verified-badge"></div>
                                    <a href="#"><img src="<?php echo IMAGE;?>professional01.jpg" alt=""></a>
                                </div>
        
                                <!-- Name -->
                                <div class="freelancer-name">
                                    <h4><a href="#">David Peterson <img class="flag" src="<?php echo IMAGE;?>flags/de.svg" alt="" data-tippy-placement="top" data-tippy="" data-original-title="Germany"></a></h4>
                                    <span>iOS Expert + Node Dev</span>
                                    <!-- Rating -->
                                    <div class="freelancer-rating">
                                        <div class="star-rating" data-rating="3.5"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <!-- Buttons -->
                        <div class="buttons-to-right single-right-button">
                            <a href="#" class="button red ripple-effect ico" data-tippy-placement="left" data-tippy="" data-original-title="Remove"><i class="icon-feather-trash"></i></a>
                        </div>
                    </li>
                    <li>
                        <!-- Overview -->
                        <div class="freelancer-overview">
                            <div class="freelancer-overview-inner">
                                
                                <!-- Avatar -->
                                <div class="freelancer-avatar">
                                    <a href="#"><img src="<?php echo IMAGE;?>professional02.jpg" alt=""></a>
                                </div>
        
                                <!-- Name -->
                                <div class="freelancer-name">
                                    <h4><a href="#">Marcin Kowalski <img class="flag" src="<?php echo IMAGE;?>flags/pl.svg" alt="" data-tippy-placement="top" data-tippy="" data-original-title="Poland"></a></h4>
                                    <span>Front-End Developer</span>
                                    <!-- Rating -->
                                    <div class="freelancer-rating">
                                        <div class="star-rating" data-rating="4.5"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <!-- Buttons -->
                        <div class="buttons-to-right single-right-button">
                            <a href="#" class="button red ripple-effect ico" data-tippy-placement="left" data-tippy="" data-original-title="Remove"><i class="icon-feather-trash"></i></a>
                        </div>
                    </li>
                    <li>
                        <!-- Overview -->
                        <div class="freelancer-overview">
                            <div class="freelancer-overview-inner">
        
                                <!-- Avatar -->
                                <div class="freelancer-avatar">
                                    <div class="verified-badge"></div>
                                    <a href="#"><img src="<?php echo IMAGE;?>professional03.jpg" alt=""></a>
                                </div>
        
                                <!-- Name -->
                                <div class="freelancer-name">
                                    <h4><a href="#">Marie Taylor <img class="flag" src="<?php echo IMAGE;?>flags/gb.svg" alt="" data-tippy-placement="top" data-tippy="" data-original-title="Germany"></a></h4>
                                    <span>Financial Analyst</span>
                                    <!-- Rating -->
                                    <div class="freelancer-rating">
                                        <div class="star-rating" data-rating="3.5"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <!-- Buttons -->
                        <div class="buttons-to-right single-right-button">
                            <a href="#" class="button red ripple-effect ico" data-tippy-placement="left" data-tippy="" data-original-title="Remove"><i class="icon-feather-trash"></i></a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>      
		</div>
	</div>
</div>
<!-- Dashboard Container / End -->
<script src="<?php echo JS;?>chart.min.js"></script>
<script src="<?php echo JS;?>utils.js"></script>

<script>
	//Chart1.defaults.global.defaultFontFamily = "Nunito";
	//Chart1.defaults.global.defaultFontColor = '#888';
	//Chart1.defaults.global.defaultFontSize = '14';

	var ctx_987465 = document.getElementById('chart').getContext('2d');

	var chart1 = new Chart(ctx_987465, {
		type: 'line',

		// The data for our dataset
		data: {
			labels: ["January", "February", "March", "April", "May", "June"],
			// Information about the dataset
	   		datasets: [{
				label: "Views",
				backgroundColor: 'rgba(100,190,67,0.1)',
				borderColor: '#64be43',
				borderWidth: "3",
				data: [196,132,215,362,210,252],
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

		    layout: {
		      padding: 0,
		  	},

			legend: { display: false },
			title:  { display: false },

			scales: {
				yAxes: [{
					scaleLabel: {
						display: false
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
		      intersect: false
		    }
		},

});
</script>


<script>
var randomScalingFactor = function() {
	return Math.round(Math.random() * 100);
};

var config = {
	type: 'pie',
	data: {
		datasets: [{
			data: [
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				//randomScalingFactor(),
			],
			backgroundColor: [
				window.chartColors.red,
				window.chartColors.orange,
				window.chartColors.yellow,
				window.chartColors.green,
				//window.chartColors.blue,
			],
			label: 'Dataset 1',
		}],
		labels: [
			'Open Jobs',
			'Processing Jobs',
			'Pending Jobs',
			'Completed Jobs'
		]
		
	},
	options: {
		responsive: true,
		scaleBeginAtZero: true,
		legend: {
            display: true,
            position: 'bottom',	
			align: 'center',
            labels: {
                fontColor: '#333',
				usePointStyle: true,
     			boxWidth: 6
            }
			
        }
		
	}
};

window.onload = function() {
	var ctx_287894 = document.getElementById('chart-area').getContext('2d');
	window.myPie = new Chart(ctx_287894, config);
};

document.getElementById('randomizeData').addEventListener('click', function() {
	config.data.datasets.forEach(function(dataset) {
		dataset.data = dataset.data.map(function() {
			return randomScalingFactor();
		});
	});

	window.myPie.update();
});

var colorNames = Object.keys(window.chartColors);
document.getElementById('addDataset').addEventListener('click', function() {
	var newDataset = {
		backgroundColor: [],
		data: [],
		label: 'New dataset ' + config.data.datasets.length,
	};

	for (var index = 0; index < config.data.labels.length; ++index) {
		newDataset.data.push(randomScalingFactor());

		var colorName = colorNames[index % colorNames.length];
		var newColor = window.chartColors[colorName];
		newDataset.backgroundColor.push(newColor);
	}

	config.data.datasets.push(newDataset);
	window.myPie.update();
});

document.getElementById('removeDataset').addEventListener('click', function() {
	config.data.datasets.splice(0, 1);
	window.myPie.update();
});
</script>

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
</script>