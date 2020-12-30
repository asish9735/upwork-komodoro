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
                <p class="mb-0"> <i class="icon-material-outline-check-circle text-danger"></i> Your email is not verified. <a href="<?php D(VZ);?>" class="btn btn-site btn-sm resendEmail">Resend Email</a></p>            
            </div>
        	<?php }elseif(!$is_doc_verified){?>
            <div class="mx-auto alert alert-warning text-center">
                <p class="mb-0"> <i class="icon-material-outline-check-circle text-danger"></i> Please verify your profile. <a href="<?php echo URL::get_link('verifyDocumentURL');?>" class="btn btn-site btn-sm">Verify Now</a></p>
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