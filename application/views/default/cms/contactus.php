<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//dd($filter);
?>

<section class="section">
  <div class="container"> 
  <div class="dashboard-headline">
	<h1><?php echo __('cms_contactus','Contact Us');?></h1>
  </div>    
  <div class="row">  
  <aside class="col-md-8 col-12">
  <div class="card"><div class="card-body">
	<form id="contact_form">
	<div id="server_status"></div>
	<div class="form-field">
        <label class="form-label"><?php echo __('cms_contactus_inquiry','What is your inquiry about?');?> <span class="req">*</span></label>
        <input type="text" class="form-control"  name="inquiry"/>
    </div>
    <div class="form-field">
    	<label class="form-label"><?php echo __('cms_contactus_email','Your email address');?> <span class="req">*</span></label>
    	<input type="email" class="form-control"  name="email"/>
    </div>
    <div class="form-field">
    	<label class="form-label"><?php echo __('cms_contactus_description','Description');?> <span class="req">*</span></label>
    	<textarea rows="3" class="form-control"  name="description"></textarea>
        <p class="help-text"><?php echo __('cms_contactus_respons','Please enter the details of your request. A member of our support staff will respond as soon as possible.');?></p>
    </div>
    <div class="form-field">
    	<label class="form-label"><?php echo __('cms_contactus_attachment','Attachments');?></label>
    	<div class="uploadButton">
            <input class="uploadButton-input" name="attachment" type="file" accept="image/*, application/pdf" id="upload1" />
            <label class="uploadButton-button ripple-effect" for="upload1"><?php echo __('cms_contactus_upload','Upload Files');?></label>
            <span class="uploadButton-file-name"><?php echo __('cms_contactus_helpful','Images or pdf that might be helpful in describing your job');?></span>
        </div>
    </div>
    <button type="submit" class="btn btn-site"><?php echo __('cms_contactus_submit','Submit');?></button>
    </form>
  </div>
  </div>
  </aside>
  <aside class="col-md-4 col-12">
	<div class="media single_ctinfo">
        <div class="ctinfo_icon"><i class="icon-line-awesome-building"></i></div>
        <div class="media-body">
            <h4><?php echo __('cms_contactus_office','Our Office');?></h4>
            <span>425 Berry Street, CA 93584 <br>New York, USA</span>
        </div>								
    </div>
    <div class="media single_ctinfo">
        <div class="ctinfo_icon"><i class="icon-line-awesome-envelope"></i></div>
        <div class="media-body">
            <h4><?php echo __('cms_contactus_mail','Drop A Mail');?></h4>
            <a href="#">info@demo.com</a><br />
            <a href="#">user@sitename.com</a>
        </div>								
    </div>
    <div class="media single_ctinfo">
        <div class="ctinfo_icon"><i class="icon-line-awesome-phone-square"></i></div>
        <div class="media-body">
            <h4><?php echo __('cms_contactus_call','Call Us');?></h4>
            9876543210<br />
            (012) 3456-789
        </div>								
    </div>
    <div class="media single_ctinfo">        
        <div class="media-body">
        	<h4 class="mb-3"><?php echo __('cms_contactus_social','Social Links');?></h4>
            <div class="freelancer-socials">
                <ul class="social-links">
                    <li><a href="#" title="Facebook" data-tippy-placement="top"><i class="icon-brand-facebook-f"></i></a></li>
                    <li><a href="#" title="Twitter" data-tippy-placement="top"><i class="icon-brand-twitter"></i></a></li>
                    <li><a href="#" title="LinkedIn" data-tippy-placement="top"><i class="icon-brand-linkedin-in"></i></a></li>
                    <li><a href="#" title="Instagram" data-tippy-placement="top"><i class="icon-brand-instagram"></i></a></li>
                    <li><a href="#" title="Youtube" data-tippy-placement="top"><i class="icon-brand-youtube"></i></a></li>
                </ul>
            </div>
        </div>								
    </div>
  
 	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d471218.38560188503!2d88.04952746944409!3d22.676385755547646!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f882db4908f667%3A0x43e330e68f6c2cbc!2sKolkata%2C%20West%20Bengal!5e0!3m2!1sen!2sin!4v1578895327808!5m2!1sen!2sin" height="300" frameborder="0" style="border:0;width:100%" allowfullscreen=""></iframe>
  </aside>
  </div>
  </div>
</section>

<script>
var main=function(){
	$('#contact_form').submit(subContact);
}
function subContact(e){
	e.preventDefault();
	var submit_btn = $(this).find('[type="submit"]'),
		btn_text = submit_btn.html();
	submit_btn.attr('disabled', 'disabled');
	submit_btn.html('Checking');
	$('#server_status').html('');
	var _self = $(this);
	var _self_form = new FormData(_self[0]);
	//console.log(_self_form);
	$.ajax({
		url : '<?php echo get_link('conatctCheckAjaxURL')?>',
		data: _self_form,
		type: 'POST',
		contentType: false,
		processData: false,
		dataType: 'json',
		success: function(res){
			submit_btn.removeAttr('disabled');
			submit_btn.html(btn_text);
			if(res.status == 1){
				$('#server_status').html(res.success_html);
				setTimeout(function(){
					location.reload();
				}, 2000);
				
			}else{
				$('#server_status').html(res.error_html);
			}
		}
	});
	
}
</script>