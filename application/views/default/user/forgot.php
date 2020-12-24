<section class="sec">
<div class="container margin-top-65 margin-bottom-65">
<div class="row">
	<aside class=" offset-md-3  offset-sm-1  col-xs-12 col-sm-10 col-md-6 col-lg-6" data-effect="slide-top">
        <div class="general-form">
        <div class="general-body">
         <form action="" method="post" accept-charset="utf-8" id="forgotform" class="form-horizontal" role="form" name="forgotform" onsubmit="saveForgotpassword(this);return false;">              
       <h1 class="text-center m-0">Forgot Password</h1>
       <div class="m-lg-3 d-none d-sm-block"> </div>
       <div id="agree_termsError" class="error-msg5 error alert-error alert alert-danger" style="display:none"></div>
         <input type="hidden" name="refer" value="" readonly="readonly">
         <div class="input-with-icon-left">
            <i class="icon-feather-mail"></i>
            <input type="text" class="form-control" value="" name="forgot_email" id="forgot_email" placeholder="Email Address">
            <span id="forgot_emailError" class="rerror"></span> 
          </div>                                          
        <button class="btn btn-site btn-block mb-3 saveBTN" id="submit-btn">Submit</button>
        </form>
        <p class="text-center small mb-0">Don't have an account? <a href="<?php URL::getLink('signup'); ?>">Register Now</a></p>
        </div>        
       </div>
	</aside>
</div>
</div>  
</section>
<script>
var SPINNER='<?php load_view('inc/spinner',array('size'=>30));?>';
function saveForgotpassword(ev){
	var formID="forgotform";
	var buttonsection=$('#'+formID).find('.saveBTN');
	var buttonval = buttonsection.html();
	buttonsection.html(SPINNER).attr('disabled','disabled');
	
	$.ajax({
        type: "POST",
        url: "<?php D(get_link('FortgotURLAJAX'))?>/",
        data:$('#'+formID).serialize(),
        dataType: "json",
        cache: false,
		success: function(msg) {
			buttonsection.html(buttonval).removeAttr('disabled');
			clearErrors();
			if (msg['status'] == 'OK') {
					bootbox.alert({
						title:'Forgot Password',
						message: '<?php D(__('Forgot_password_success_message','An email has been sent to your email address with instructions on how to change your password.'));?>',
						buttons: {
						'ok': {
							label: 'Ok',
							className: 'btn-site pull-right'
							}
						},
						callback: function () {
							if(msg['redirect']){
									window.location.href=msg['redirect'];
								return false;
							}
					    }
					});

			} else if (msg['status'] == 'FAIL') {
				registerFormPostResponse(formID,msg['errors']);
			}
		}
	})	
}

var main =function(){
	
}

</script>