<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<section class="section">
<div class="container">
<div class="general-form">
	<div class="general-body">
   <form action="" method="post" accept-charset="utf-8" id="Register_form" class="form-horizontal" role="form" name="regform" onsubmit="return false;"> 
   <input type="hidden" name="step" value="1" id="step"/>
  
     <input type="hidden" name="ref" value="<?php D(get('ref'));?>"/>
    <input type="hidden" name="refer" value="<?php D(get('refer'));?>" readonly/>
    
     <div id="agree_termsError" class="error-msg5 error alert-error alert alert-danger" style="display:none"></div>
    <div id="step_1">
    <h1><?php echo __('user_page_signup_header','Sign Up');?> </h1>   
    <div class="input-with-icon-left">
        <i class="ri-user-line"></i>	
        <input type="text" class="form-control" value="" name="name" id="name" placeholder="<?php echo __('user_page_signup_name_placeholder','Enter Name');?>">
        <span id="nameError" class="rerror"></span>
    </div>
    <div class="input-with-icon-left">
        <i class="ri-mail-open-line"></i>     	          	
        <input type="text" class="form-control" value="" name="email" id="email" placeholder="<?php echo __('user_page_signup_email_placeholder','Email Address');?>">
        <span id="emailError" class="rerror"></span>
    </div>    
    <div class="d-grid mb-3">
    	<button class="btn btn-site signUpBTN"><?php echo __('user_page_signup_button','Sign Up');?></button>
    </div>    
    <div class="social-login-separator"><span><?php echo __('user_page_login_separetor','OR');?></span></div>
        <div class="social-login-buttons mb-3">
            <button class="facebook-login ripple-effect fb_login_btn"><i class="icon-brand-facebook-f"></i> <?php echo __('user_page_login_facebook','Log In via Facebook');?></button>
            <button class="google-login ripple-effect google_login_btn"><i class="icon-brand-google"></i> <?php echo __('user_page_login_google','Log In via Google');?></button>
        </div>
   </div>
    <div id="step_2" style="display: none">
     <h3><?php echo __('user_page_signup_account','Complete your account');?></h3>     
     <p id="select_email" class="text-center"></p>
        <div class="account-type">
            <div>
                <input type="radio" name="user_type" id="freelancer-radio" class="account-type-radio" value="F" checked  onclick="$('.for_individual').show()">
                <label for="freelancer-radio"><i class="icon-material-outline-account-circle"></i> Freelancer</label>
            </div>

            <div>
                <input type="radio" name="user_type" id="employer-radio" class="account-type-radio" value="E" onclick="$('.for_individual').hide()">
                <label for="employer-radio"><i class="icon-material-outline-business-center"></i> Employer</label>
            </div>
        </div>
        <div class="input-with-icon-left">
        	<i class="ri-map-pin-2-line"></i>  	                  
            <select name="country" id="country" class="selectpicker" title="Select Country" data-live-search="true">
            
                <?php
                if($country){
                    foreach($country as $country_list){
                        ?>
                        <option value="<?php echo $country_list->country_code?>"><?php echo ucfirst($country_list->country_name);?></option>
                        <?php
                    }
                }
                 ?>
            </select>          	

            <span id="countryError" class="rerror"></span>
        </div>
        <div class="input-with-icon-left for_individual"> 
        	<i class="ri-user-line"></i>	    	    	
            <input type="text" class="form-control" value="" name="username" id="username" placeholder="Enter Username">
            <span id="usernameError" class="rerror"></span>
        </div>
        <div class="input-with-icon-left">  
        	<i class="ri-lock-2-line"></i>   	           	
            <input type="password" class="form-control" value="" name="password" id="password" placeholder="Enter Password">
            <span id="passwordError" class="rerror"></span>
        </div>
        <div class="d-grid mb-3">
         <button class="btn btn-site btn-block signUpBTN">Submit</button>
        </div>
    </div>
    </form>
    <p class="text-center small mb-0"><?php echo __('user_page_signup_have_account','Already have an account?');?> <a href="<?php URL::getLink('login'); ?>"><?php echo __('user_page_signup_login','Log In');?></a></p>
    </div>    
   </div>
       
<script type="text/javascript">
var main = function(){
	$('.signUpBTN').click(function(){
		FormPost(this,'Register_form');
	});	
}
function nextstep(res){
	var formD=$('#Register_form');
	//console.log(res);
	formD.find('.step_2 input').removeClass('is-valid');
	$('#select_email').html(res.email);
	formD.find('#step_1').hide();
	formD.find('#step_2').show();
	formD.find('#step').val(2);
}
</script>

</div>  
</section>
<?php $this->layout->view('inc/social-login','',true);?>
