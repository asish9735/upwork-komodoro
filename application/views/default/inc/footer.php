<!-- Footer -->
<div id="footer">  
  <!-- Footer Middle Section -->
  <div class="footer-middle-section">
    <div class="container">
      <div class="row"> 
        <div class="col-xl-3 col-md-4 col-12">
          <div class="footer-links">
            <h3>Category</h3>
            <ul>
              <li><a href="#"><span>Business</span></a></li>
              <li><a href="#"><span>Digital Marketing</span></a></li>
              <li><a href="#"><span>Graphics &amp; Design</span></a></li>              
              <li><a href="#"><span>Lifestyle</span></a></li>
              <li><a href="#"><span>Music &amp; Audio</span></a></li>
              <li><a href="#"><span>Programming &amp; Tech</span></a></li>
              <li><a href="#"><span>Sitemap</span></a></li>
              <li><a href="#"><span>Video &amp; Animation</span></a></li>
              <li><a href="#"><span>Writing &amp; Translation</span></a></li>
            </ul>
          </div>
        </div>
        <!-- Links -->
        <div class="col-xl-3 col-md-4 col-12">
          <div class="footer-links">
            <h3>Browse</h3>
            <ul>
              <li><a href="#"><span>Freelancers by Skill</span></a></li>
              <li><a href="#"><span>Freelancers by Location</span></a></li>
              <li><a href="#"><span>Find Projects</span></a></li>
              <li><a href="#"><span>Find Professionals</span></a></li>
              <li><a href="#"><span>Freelancers in UK</span></a></li>
              <li><a href="#"><span>Freelancers in USA</span></a></li>
              <li><a href="#"><span>Freelancers in Canada</span></a></li>
              <li><a href="#"><span>Freelancers in Australia</span></a></li>
              <li><a href="#"><span>Jobs in USA</span></a></li>
            </ul>
          </div>
        </div>
        <!-- Links -->
        <div class="col-xl-3 col-md-4 col-12">
          <div class="footer-links">
            <h3>Company</h3>
            <ul>
              <li><a href="<?php D(get_link('CMSaboutus'))?>"><span>About Us</span></a></li>                                                        
              <li><a href="<?php D(get_link('conatctURL'))?>"><span>Contact Us</span></a></li>
              <li><a href="<?php D(get_link('enterpriseURL'))?>"><span>Enterprise</span></a></li>
              <li><a href="<?php D(get_link('CMShelp'))?>"><span>FAQs</span></a></li>              
              <li><a href="<?php D(get_link('CMShowitworks'))?>"><span>How it works</span></a></li>
              <li><a href="<?php D(get_link('membershipURL'))?>"><span>Membership</span></a></li>
              <li><a href="<?php D(get_link('CMSprivacypolicy'))?>"><span>Privacy Policy</span></a></li>
              <li><a href="<?php D(get_link('CMSrefundpolicy'))?>"><span>Refund Policy</span></a></li>
              <li><a href="<?php D(get_link('CMStermsandconditions'))?>"><span>Terms &amp; Conditions</span></a></li>              
            </ul>
          </div>
        </div>        
        <!-- Links -->
        <div class="col-xl-3 col-md-4 col-12">
          <div class="footer-links">
            <h3>Resources</h3>
            <ul>
              <li><a href="#"><span>Business Resources</span></a></li>
              <li><a href="#"><span>Customer Stories</span></a></li>
              <li><a href="#"><span>Customer Support</span></a></li>
              <li><a href="#"><span>Hiring Headquarters</span></a></li>              
              <li><a href="#"><span>Payroll Services</span></a></li>
              <li><a href="#"><span>Trust &amp; Safety</span></a></li>
            </ul>
          </div>
        </div>                
      </div>
    </div>
  </div>
  <!-- Footer Middle Section / End --> 
  
  <!-- Footer Copyrights -->
  <div class="footer-bottom-section">
    <div class="container">
    <div class="row footer-rows-container">       
      <!-- Left Side -->
      <div class="col-auto">
      	  <ul class="social-links footer-social-links">
            <li><a href="#" title="Facebook" data-tippy-placement="bottom" data-tippy-theme="light" target="_blank"><i class="icon-brand-facebook-f"></i></a></li>
            <li><a href="#" title="Twitter" data-tippy-placement="bottom" data-tippy-theme="light" target="_blank"><i class="icon-brand-twitter"></i></a></li>                
            <li><a href="#" title="LinkedIn" data-tippy-placement="bottom" data-tippy-theme="light" target="_blank"><i class="icon-brand-linkedin-in"></i></a></li>
            <li><a href="#" title="Instagram" data-tippy-placement="bottom" data-tippy-theme="light" target="_blank"><i class="icon-brand-instagram"></i></a></li>
            <li><a href="#" title="Youtube" data-tippy-placement="bottom" data-tippy-theme="light" target="_blank"><i class="icon-brand-youtube"></i></a></li>
          </ul>
	  </div>              
      <div class="col text-center">
        	<p>&copy; Copyright 2020 Demo.com. All Rights Reserved</p>
        </div>
      
      <!-- Right Side -->
      <div class="col-auto">                         
        <!-- Language Switcher -->
        <select class="selectpicker language-switcher" data-selected-text-format="count" data-size="5">
              <option selected>English</option>
              <option>Français</option>
              <option>Español</option>
              <option>Deutsch</option>
            </select>
      </div>
    </div>		
		
        
    </div>
  </div>
  <!-- Footer Copyrights / End --> 
  
</div>
<!-- Footer / End -->

</div>
<!-- Wrapper / End -->
<?php 
$load_js=$this->layout->load_js();
$load_js_default=array('jquery-3.3.1.min.js','popper.min.js','bootstrap.min.js','jquery-migrate-3.0.0.min.js','mmenu.min.js','tippy.all.min.js','simplebar.min.js','bootstrap-slider.min.js','bootstrap-select.min.js','snackbar.js','clipboard.min.js','counterup.min.js','magnific-popup.min.js','feedback-plugins.js','feedback.js','slick.min.js','custom.js','promise.min.js','loadMore.js', 'app-service.js');
$this->minify->js($load_js_default);
if(!empty($load_js)){
	foreach($load_js as $files){
		$this->minify->add_js($files);
	}
}
echo $this->minify->deploy_js(FALSE, 'footer.min.js');
 ?>

<!-- Main Script Loading --> 
<script>
$(document).ready(function(){
	
	if(typeof main == 'function'){
		main();
	}
  if(typeof mainpart == 'function'){
    mainpart();
	}
	
	if(typeof AppService !== 'undefined'){
		AppService.setUrl('<?php echo base_url('message/update_service'); ?>');
		AppService.init();
		
		AppService.on('new_message', function(data){
			if(data > 0){
				$('.new-message-counter').html(data);
				$('.new-message-counter').show();
			}else{
				$('.new-message-counter').hide();
			}
		});
		
		AppService.on('new_notification', function(data){
			if(data > 0){
				$('.new-notification-counter').html(data);
				$('.new-notification-counter').show();
			}else{
				$('.new-notification-counter').hide();
			}
		});
		
	}
	
	
	;(function(){
		/* Message loading */
		var message_open_state = false;
		/* var simpleBar = new SimpleBar(document.getElementById('header-message-container'));
		var scrollElement = simpleBar.getScrollElement(); */
		
		$('.header-notifications-trigger.message-trigger').click(function(){
			// load message 
			
			var $msg_list = $('#header-message-list');
			message_open_state = !message_open_state;
			$.getJSON('<?php echo base_url('message/chat_list_htm');?>', function(res){
				$msg_list.html(res.html);
			});
		});
	})();
	
	;(function(){
		/* Notification loading */
		var notification_open_state = false;	
		$('.header-notifications-trigger.notification-trigger').click(function(){
			// load message 
			var $noti_list = $('#header-notification-list');
			notification_open_state = !notification_open_state;
			$.getJSON('<?php echo base_url('notification/notification_list_htm');?>', function(res){
				$noti_list.html(res.html);
			});
			
		});
	})();
	
	
	
});
$(window).load(function(){
	if(typeof mainload == 'function'){
		mainload();
	}
	
});
</script>
</body>
</html>