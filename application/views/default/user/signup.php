<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<section class="sec">
<div class="container margin-top-65 margin-bottom-65">
<div class="general-form">
	<div class="general-body">
   <form action="" method="post" accept-charset="utf-8" id="Register_form" class="form-horizontal" role="form" name="regform" onsubmit="return false;"> 
   <input type="hidden" name="step" value="1" id="step"/>
  
     <input type="hidden" name="ref" value="<?php D(get('ref'));?>"/>
    <input type="hidden" name="refer" value="<?php D(get('refer'));?>" readonly/>
    
     <div id="agree_termsError" class="error-msg5 error alert-error alert alert-danger" style="display:none"></div>
    <div id="step_1">
   <h2 class="text-center m-0"><?php echo __('user_page_signup_header','Sign Up');?> </h2>
   <div class="m-lg-3 d-none d-sm-block"> </div>
    <div class="input-with-icon-left">
        <i class="icon-feather-user"></i>    	         	
        <input type="text" class="form-control" value="" name="name" id="name" placeholder="<?php echo __('user_page_signup_name_placeholder','Enter Name');?>">
        <span id="nameError" class="rerror"></span>
    </div>
    <div class="input-with-icon-left">
        <i class="icon-feather-mail"></i>      	          	
        <input type="text" class="form-control" value="" name="email" id="email" placeholder="<?php echo __('user_page_signup_email_placeholder','Email Address');?>">
        <span id="emailError" class="rerror"></span>
    </div>    
    <button class="btn btn-site btn-block mb-3 signUpBTN"><?php echo __('user_page_signup_button','Sign Up');?></button>    
   </div>
    <div id="step_2" style="display: none">
     <h2 class="text-center m-0"><?php echo __('user_page_signup_account','Complete your account');?></h2>
     <div class="m-lg-3 d-none d-sm-block"> </div>
     <p id="select_email" class="text-center"></p>
        <div class="account-type">
            <div>
                <input type="radio" name="user_type" id="freelancer-radio" class="account-type-radio" value="F" checked  onclick="$('.for_individual').show()">
                <label for="freelancer-radio" class="ripple-effect-dark"><i class="icon-material-outline-account-circle"></i> Freelancer</label>
            </div>

            <div>
                <input type="radio" name="user_type" id="employer-radio" class="account-type-radio" value="E" onclick="$('.for_individual').hide()">
                <label for="employer-radio" class="ripple-effect-dark"><i class="icon-material-outline-business-center"></i> Employer</label>
            </div>
        </div>
        <div class="input-with-icon-left">
        	<i class="icon-feather-map-pin"></i>       	                  
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
        	<i class="icon-feather-user"></i>       	    	
            <input type="text" class="form-control" value="" name="username" id="username" placeholder="Enter Username">
            <span id="usernameError" class="rerror"></span>
        </div>
        <div class="input-with-icon-left">  
        	<i class="icon-feather-lock"></i>      	           	
            <input type="password" class="form-control" value="" name="password" id="password" placeholder="Enter Password">
            <span id="passwordError" class="rerror"></span>
        </div>
        
         <button class="btn btn-site btn-block signUpBTN">Submit</button>
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
