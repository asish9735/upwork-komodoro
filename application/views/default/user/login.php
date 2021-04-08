<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<section class="sec">
<div class="container margin-top-65 margin-bottom-65">
    <div class="general-form">
    	<div class="general-body">
       <form action="" method="post" accept-charset="utf-8" id="logform" class="form-horizontal" role="form" name="logform" onsubmit="return false;">     
        <input type="hidden" name="ref" value="<?php D(get('ref'));?>"/>
        <input type="hidden" name="refer" value="<?php D(get('refer'));?>" readonly/>   
       <h1 class="text-center m-0"><?php echo __('user_page_login_header','Log In');?></h1>
       <div class="m-lg-3 d-none d-sm-block"> </div>
       <div id="agree_termsError" class="error-msg5 error alert-error alert alert-danger" style="display:none"></div>
         <div class="input-with-icon-left">
            <i class="icon-feather-mail"></i>
            <input type="text" class="form-control" name="email" id="email" placeholder="<?php echo __('user_page_login_email_placeholder','Email Address');?>" />
            <span id="emailError" class="rerror"></span>
        </div>              
        
        <div class="input-with-icon-left">   
        	<i class="icon-feather-lock"></i>     	         	
            <input type="password" class="form-control" value="" name="password" id="password" placeholder="<?php echo __('user_page_login_password_placeholder','Password');?>">
            <span id="passwordError" class="rerror"></span>
        </div>
        
        <div class="form-group">        	
            <label for="" class="control-label" style="display:none;">
            <input type="checkbox"> <?php echo __('user_page_login_password_remember','Remember Me');?> </label>
            <a href="<?php echo BASE_URL;?>user/forgot"><?php echo __('user_page_login_password_forget','Forgot Password');?>?</a>                
        </div>
        <button class="btn btn-site btn-block" id="signInBTN"><?php echo __('user_page_login_button','Log In');?></button>
        
        <div class="social-login-separator"><span><?php echo __('user_page_login_separetor','OR');?></span></div>
        <div class="social-login-buttons mb-3">
            <button class="facebook-login ripple-effect"><i class="icon-brand-facebook-f"></i> <?php echo __('user_page_login_facebook','Log In via Facebook');?></button>
            <button class="google-login ripple-effect"><i class="icon-brand-google"></i> <?php echo __('user_page_login_google','Log In via Google');?></button>
        </div>
        </form>
        <p class="text-center small mb-0"><?php echo __('user_page_login_no_account','');?> <a href="<?php URL::getLink('signup'); ?>"><?php echo __('user_page_login_register','Register Now');?></a></p>
        </div>        
       </div>
<script type="text/javascript">
var main = function(){
		$('#signInBTN').click(function(){
			console.log('ok');
			FormPost(this,'Login_form');
		});	
	}
</script>

</div>  
</section>