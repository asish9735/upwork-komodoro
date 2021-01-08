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
          <div class="fun-fact-text"> <span>Available Bids</span>
            <h4>50</h4>
          </div>
        </div>
        <div class="fun-fact">
          <div class="fun-fact-text"> <span>Earned</span>
            <h4>$ <strong>4099.00</strong></h4>
          </div>
        </div>
        <div class="fun-fact">
          <div class="fun-fact-text"> <span>Projects</span>
            <h4>25</h4>
          </div>
        </div>
      </div>
      <div class="row">
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
      <div class="dashboard-box margin-top-0"> 
        
        <!-- Headline -->
        <div class="headline">
          <h3>Recent Projects</h3>
        </div>
        <div class="content">
          <ul class="dashboard-box-list">
            <li> 
              <!-- Job Listing -->
              <div class="job-listing width-adjustment"> 
                
                <!-- Job Listing Details -->
                <div class="job-listing-details"> 
                  <!-- Details -->
                  <div class="job-listing-description">
                    <h3 class="job-listing-title"><a href="#">Name of your project</a> </h3>
                    
                    <!-- Job Listing Footer -->
                    <div class="job-listing-footer">
                      <ul>
                        <li><b>Budget:</b> $70.00 </li>
                        <li><b>Date:</b> 2020-03-05 03:28:16 </li>
                        <li><b>Status:</b> <span class="dashboard-status-button green">In Process</span> </li>
                      </ul>
                    </div>
                  </div>
                </div>
                </div>
                <!-- Buttons -->
                <div class="buttons-to-right single-right-button"> <a href="#" class="btn btn-sm btn-outline-site ico" data-tippy-placement="left" title="View"> <i class="icon-feather-eye"></i> </a> 
              </div>
            </li>  
            <li> 
              <!-- Job Listing -->
              <div class="job-listing width-adjustment"> 
                
                <!-- Job Listing Details -->
                <div class="job-listing-details"> 
                  <!-- Details -->
                  <div class="job-listing-description">
                    <h3 class="job-listing-title"><a href="#">Name of your project</a> </h3>
                    
                    <!-- Job Listing Footer -->
                    <div class="job-listing-footer">
                      <ul>
                        <li><b>Budget:</b> $70.00 </li>
                        <li><b>Date:</b> 2020-03-05 03:28:16 </li>
                        <li><b>Status:</b> <span class="dashboard-status-button green">In Process</span> </li>
                      </ul>
                    </div>
                  </div>
                </div>
                </div>
                <!-- Buttons -->
                <div class="buttons-to-right single-right-button"> <a href="#" class="btn btn-sm btn-outline-site ico" data-tippy-placement="left" title="View"> <i class="icon-feather-eye"></i> </a> 
              </div>
            </li>
            <li> 
              <!-- Job Listing -->
              <div class="job-listing width-adjustment"> 
                
                <!-- Job Listing Details -->
                <div class="job-listing-details"> 
                  <!-- Details -->
                  <div class="job-listing-description">
                    <h3 class="job-listing-title"><a href="#">Name of your project</a> </h3>
                    
                    <!-- Job Listing Footer -->
                    <div class="job-listing-footer">
                      <ul>
                        <li><b>Budget:</b> $70.00 </li>
                        <li><b>Date:</b> 2020-03-05 03:28:16 </li>
                        <li><b>Status:</b> <span class="dashboard-status-button green">In Process</span> </li>
                      </ul>
                    </div>
                  </div>
                </div>
                </div>
                <!-- Buttons -->
                <div class="buttons-to-right single-right-button"> <a href="#" class="btn btn-sm btn-outline-site ico" data-tippy-placement="left" title="View"> <i class="icon-feather-eye"></i> </a> 
              </div>
            </li>
            <li> 
              <!-- Job Listing -->
              <div class="job-listing width-adjustment"> 
                
                <!-- Job Listing Details -->
                <div class="job-listing-details"> 
                  <!-- Details -->
                  <div class="job-listing-description">
                    <h3 class="job-listing-title"><a href="#">Name of your project</a> </h3>
                    
                    <!-- Job Listing Footer -->
                    <div class="job-listing-footer">
                      <ul>
                        <li><b>Budget:</b> $70.00 </li>
                        <li><b>Date:</b> 2020-03-05 03:28:16 </li>
                        <li><b>Status:</b> <span class="dashboard-status-button blue">Completed on: 2020-01-29 12:25:52</span> </li>
                      </ul>
                    </div>
                  </div>
                </div>
                </div>
                <!-- Buttons -->
                <div class="buttons-to-right single-right-button"> <a href="#" class="btn btn-sm btn-outline-site ico" data-tippy-placement="left" title="View"> <i class="icon-feather-eye"></i> </a> 
              </div>
            </li>            
            <li> 
              <!-- Job Listing -->
              <div class="job-listing width-adjustment"> 
                
                <!-- Job Listing Details -->
                <div class="job-listing-details"> 
                  <!-- Details -->
                  <div class="job-listing-description">
                    <h3 class="job-listing-title"><a href="#">Name of your project</a> </h3>
                    
                    <!-- Job Listing Footer -->
                    <div class="job-listing-footer">
                      <ul>
                        <li><b>Budget:</b> $70.00 </li>
                        <li><b>Date:</b> 2020-03-05 03:28:16 </li>
                        <li><b>Status:</b> <span class="dashboard-status-button yellow">Pending</span> </li>
                      </ul>
                    </div>
                  </div>
                </div>
                </div>
                <!-- Buttons -->
                <div class="buttons-to-right single-right-button"> <a href="#" class="btn btn-sm btn-outline-site ico" data-tippy-placement="left" title="View"> <i class="icon-feather-eye"></i> </a> 
              </div>
            </li>                                  
          </ul>
          <div class="text-center padding-bottom-20">
          	<a href="#" class="btn btn-site">View more..</a>
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
            <li>
              <div class="job-listing mb-2">                 
                <!-- Job Listing Details -->
                <div class="job-listing-details">                   
                  <!-- Logo --> 
                  <a href="#" class="job-listing-company-logo"> <img src="<?php echo IMAGE;?>user.png" alt=""> </a>                   
                  <!-- Details -->
                  <div class="job-listing-description">
                  	<span class="float-right text-muted"><i class="icon-material-outline-access-time"></i> 1 day ago</span>
                    <h4 class="job-listing-title"><a href="#">New milestone Initiate for the project Name of your project</a></h4>                    
                    <p>HTML, JavaScript, MySQL, PHP, WordPress, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>                    
                  </div>
                </div>
              </div> 
              <!-- Job Listing -->
              <div class="job-listing">                 
                <!-- Job Listing Details -->
                <div class="job-listing-details">                   
                  <!-- Logo --> 
                  <a href="#" class="job-listing-company-logo"> <img src="<?php echo IMAGE;?>logo.png" alt=""> </a>                   
                  <!-- Details -->
                  <div class="job-listing-description">
                  	<span class="float-right text-muted"><i class="icon-material-outline-access-time"></i> 2 days ago</span>
                    <h4 class="job-listing-title"><a href="#">Your submission has been accepted for the project Name of your project</a></h4>                    
                    <p>CSS, Graphic Design, HTML, User Interface / IA, Website Design, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat...<a href="#">view more</a></p>  
                                      
                  </div>
                </div>
              </div>  
                          
            </li>
            <li>
              <div class="job-listing mb-2">                 
                <!-- Job Listing Details -->
                <div class="job-listing-details">                   
                  <!-- Logo --> 
                  <a href="#" class="job-listing-company-logo"> <img src="<?php echo IMAGE;?>user.png" alt=""> </a>                   
                  <!-- Details -->
                  <div class="job-listing-description">
                  	<span class="float-right text-muted"><i class="icon-material-outline-access-time"></i> 1 day ago</span>
                    <h4 class="job-listing-title"><a href="#">New milestone Initiate for the project Name of your project</a></h4>                    
                    <p>HTML, JavaScript, MySQL, PHP, WordPress, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>                    
                  </div>
                </div>
              </div> 
              <!-- Job Listing -->
              <div class="job-listing">                 
                <!-- Job Listing Details -->
                <div class="job-listing-details">                   
                  <!-- Logo --> 
                  <a href="#" class="job-listing-company-logo"> <img src="<?php echo IMAGE;?>logo.png" alt=""> </a>                   
                  <!-- Details -->
                  <div class="job-listing-description">
                  	<span class="float-right text-muted"><i class="icon-material-outline-access-time"></i> 2 days ago</span>
                    <h4 class="job-listing-title"><a href="#">Your submission has been accepted for the project Name of your project</a></h4>                    
                    <p>CSS, Graphic Design, HTML, User Interface / IA, Website Design, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat...<a href="#">view more</a></p>  
                                      
                  </div>
                </div>
              </div>  
                          
            </li>
            <li>
              <div class="job-listing mb-2">                 
                <!-- Job Listing Details -->
                <div class="job-listing-details">                   
                  <!-- Logo --> 
                  <a href="#" class="job-listing-company-logo"> <img src="<?php echo IMAGE;?>user.png" alt=""> </a>                   
                  <!-- Details -->
                  <div class="job-listing-description">
                  	<span class="float-right text-muted"><i class="icon-material-outline-access-time"></i> 1 day ago</span>
                    <h4 class="job-listing-title"><a href="#">New milestone Initiate for the project Name of your project</a></h4>                    
                    <p>HTML, JavaScript, MySQL, PHP, WordPress, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>                    
                  </div>
                </div>
              </div> 
            </li>            
          </ul>
          <div class="text-center padding-bottom-20">
          	<a href="#" class="btn btn-site">View more..</a>
          </div>
        </div>
      </div>
      
      <div class="dashboard-box "> 
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
                  <a href="#" class="job-listing-company-logo"> <img src="<?php echo IMAGE;?>job-4.png" alt=""> </a> 
                  
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
              <div class="buttons-to-right single-right-button"> <a href="#" class="btn btn-sm btn-outline-danger ico" data-tippy-placement="left" title="Remove"><i class="icon-feather-trash"></i></a> </div>
            </li>
            <li> 
              <!-- Job Listing -->
              <div class="job-listing"> 
                
                <!-- Job Listing Details -->
                <div class="job-listing-details"> 
                  
                  <!-- Logo --> 
                  <a href="#" class="job-listing-company-logo"> <img src="<?php echo IMAGE;?>job-5.png" alt=""> </a> 
                  
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
              <div class="buttons-to-right single-right-button"> <a href="#" class="btn btn-sm btn-outline-danger ico" data-tippy-placement="left" title="Remove"><i class="icon-feather-trash"></i></a> </div>
            </li>
            <li> 
              <!-- Job Listing -->
              <div class="job-listing"> 
                
                <!-- Job Listing Details -->
                <div class="job-listing-details"> 
                  
                  <!-- Logo --> 
                  <a href="#" class="job-listing-company-logo"> <img src="<?php echo IMAGE;?>job-6.png" alt=""> </a> 
                  
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
              <div class="buttons-to-right single-right-button"> <a href="#" class="btn btn-sm btn-outline-danger ico" data-tippy-placement="left" title="Remove"><i class="icon-feather-trash"></i></a> </div>
            </li>
          </ul>
          <div class="text-center padding-bottom-20">
          	<a href="#" class="btn btn-site">View more..</a>
          </div>
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
                  <a href="#" class="job-listing-company-logo"> <img src="<?php echo IMAGE;?>job-1.png" alt=""> </a> 
                  
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
              <div class="buttons-to-right single-right-button"> <a href="#" class="btn btn-sm btn-outline-danger ico" data-tippy-placement="left" title="Remove"><i class="icon-feather-trash"></i></a> </div>
            </li>
            <li> 
              <!-- Job Listing -->
              <div class="job-listing"> 
                
                <!-- Job Listing Details -->
                <div class="job-listing-details"> 
                  
                  <!-- Logo --> 
                  <a href="#" class="job-listing-company-logo"> <img src="<?php echo IMAGE;?>job-2.png" alt=""> </a> 
                  
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
              <div class="buttons-to-right single-right-button"> <a href="#" class="btn btn-sm btn-outline-danger ico" data-tippy-placement="left" title="Remove"><i class="icon-feather-trash"></i></a> </div>
            </li>
            <li> 
              <!-- Job Listing -->
              <div class="job-listing"> 
                
                <!-- Job Listing Details -->
                <div class="job-listing-details"> 
                  
                  <!-- Logo --> 
                  <a href="#" class="job-listing-company-logo"> <img src="<?php echo IMAGE;?>job-3.png" alt=""> </a> 
                  
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
              <div class="buttons-to-right single-right-button"> <a href="#" class="btn btn-sm btn-outline-danger ico" data-tippy-placement="left" title="Remove"><i class="icon-feather-trash"></i></a> </div>
            </li>
          </ul>
          <div class="text-center padding-bottom-20">
          	<a href="#" class="btn btn-site">View more..</a>
          </div>
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
                    <a href="#"><img src="<?php echo IMAGE;?>professional01.jpg" alt=""></a> </div>
                  
                  <!-- Name -->
                  <div class="freelancer-name">
                    <h4><a href="#">David Peterson <img class="flag" src="<?php echo IMAGE;?>flags/de.svg" alt="" data-tippy-placement="top" title="Germany"></a></h4>
                    <span>iOS Expert + Node Dev</span> 
                    <!-- Rating -->
                    <div class="freelancer-rating">
                      <div class="star-rating" data-rating="3.5"></div>
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- Buttons -->
              <div class="buttons-to-right single-right-button"> <a href="#" class="btn btn-sm btn-outline-danger ico" data-tippy-placement="left" title="Remove"><i class="icon-feather-trash"></i></a> </div>
            </li>
            <li> 
              <!-- Overview -->
              <div class="freelancer-overview">
                <div class="freelancer-overview-inner"> 
                  
                  <!-- Avatar -->
                  <div class="freelancer-avatar"> <a href="#"><img src="<?php echo IMAGE;?>professional02.jpg" alt=""></a> </div>
                  
                  <!-- Name -->
                  <div class="freelancer-name">
                    <h4><a href="#">Marcin Kowalski <img class="flag" src="<?php echo IMAGE;?>flags/pl.svg" alt="" data-tippy-placement="top" title="Poland"></a></h4>
                    <span>Front-End Developer</span> 
                    <!-- Rating -->
                    <div class="freelancer-rating">
                      <div class="star-rating" data-rating="4.5"></div>
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- Buttons -->
              <div class="buttons-to-right single-right-button"> <a href="#" class="btn btn-sm btn-outline-danger ico" data-tippy-placement="left" title="Remove"><i class="icon-feather-trash"></i></a> </div>
            </li>
            <li> 
              <!-- Overview -->
              <div class="freelancer-overview">
                <div class="freelancer-overview-inner"> 
                  
                  <!-- Avatar -->
                  <div class="freelancer-avatar">
                    <div class="verified-badge"></div>
                    <a href="#"><img src="<?php echo IMAGE;?>professional03.jpg" alt=""></a> </div>
                  
                  <!-- Name -->
                  <div class="freelancer-name">
                    <h4><a href="#">Marie Taylor <img class="flag" src="<?php echo IMAGE;?>flags/gb.svg" alt="" data-tippy-placement="top" title="Germany"></a></h4>
                    <span>Financial Analyst</span> 
                    <!-- Rating -->
                    <div class="freelancer-rating">
                      <div class="star-rating" data-rating="3.5"></div>
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- Buttons -->
              <div class="buttons-to-right single-right-button"> <a href="#" class="btn btn-sm btn-outline-danger ico" data-tippy-placement="left" title="Remove"><i class="icon-feather-trash"></i></a> </div>
            </li>
          </ul>
          <div class="text-center padding-bottom-20">
          	<a href="#" class="btn btn-site">View more..</a>
          </div>
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