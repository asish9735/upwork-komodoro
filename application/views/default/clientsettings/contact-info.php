<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="dashboard-container">
<?php echo $left_panel;?>
<!-- Dashboard Content
	================================================== -->
	<div class="dashboard-content-container">
		<div class="dashboard-content-inner">
			
			<!-- Dashboard Headline -->
			<?php /*?><div class="dashboard-headline">
				<h3><?php echo __('contact_company_my_info','My Info');?></h3>				
			</div><?php */?>
	
				<!-- Dashboard Box -->
					<div class="dashboard-box margin-top-0">

						<!-- Headline -->
						<div class="headline">
							<h4><?php echo __('contact_company_account','Account');?></h4>  <a href="<?php echo VZ;?>" class="ico btn-circle btn-edit edit_account_info" data-tippy-placement="top" title="Edit"><i class="icon-feather-edit-3"></i></a>
							
						</div>

						<div class="content with-padding">
		                	<div class="row">
							<div class="col-sm-auto">
								<div class="avatar-wrapper rounded-circle" id="crop-avatar-dashboard">
									<input type="hidden" name="logo" id="logo" class="replceLogoVal">
									<img src="<?php D(getCompanyLogo($organization_id));?>" alt="">
									<a href="javascript:void(0)" class="ico edit_logo_btn btn-circle" data-popup="logo" data-tippy-placement="top" title="Change avatar" ><i class="icon-feather-edit-3"></i></a>
								</div>
							</div>
						
		                    <div class="col-sm" id="accountLoad">
		                        <div class="text-center" style="min-height: 100px">
		                        <?php load_view('inc/spinner',array('size'=>30));?>
		                        </div>
		                    </div>
		                     <div class="col-sm" id="accountLoadForm" style="display: none"></div>
		                    </div>
		                </div>
						
					</div>

					<div class="dashboard-box ">

						<!-- Headline -->
						<div class="headline">
							<h4><?php echo __('contact_company_details','Company Details');?></h4> <a href="<?php echo VZ;?>" class="ico btn-circle btn-edit edit_company" data-tippy-placement="top" title="Edit"><i class="icon-feather-edit-3"></i></a>
							
						</div>

											
						<div class="content with-padding" id="companyLoad">
							<div class="text-center" style="min-height: 100px">
							<?php load_view('inc/spinner',array('size'=>30));?>
							</div>
						</div>
							
					
						<div class="content with-padding" id="companyLoadForm" style="display: none"></div>
						
					</div>

					<div class="dashboard-box ">

						<!-- Headline -->
						<div class="headline">
							<h4><?php echo __('contact_company_contact','Company Contact');?></h4>  <a href="<?php echo VZ;?>" class="ico btn-circle btn-edit edit_location" data-tippy-placement="top"  title="Edit"><i class="icon-feather-edit-3"></i></a>							
						</div>

						<div class="content with-padding" id="locationLoad">
							<div class="text-center" style="min-height: 100px">
							<?php load_view('inc/spinner',array('size'=>30));?>
							</div>
						</div>
						<div class="content with-padding" id="locationLoadForm" style="display: none"></div>
					</div>
			<!-- Footer -->
			<div class="dashboard-footer-spacer"></div>
			
			<!-- Footer / End -->

		</div>
	</div>
	<!-- Dashboard Content / End -->

</div>


<script type="text/javascript">
	var SPINNER='<?php load_view('inc/spinner',array('size'=>30));?>';
	function load_account_info(){
		$( "#accountLoadForm").hide();
		$( "#accountLoad").html('<div class="text-center" style="min-height: 100px">'+SPINNER+'<div>').show();
		$.get( "<?php D(get_link('settingclientaccountInfoDataAJAXURL'))?>", function( data ) {
			setTimeout(function(){ $( "#accountLoad").html( data );$('.edit_account_info').show();},2000)
		});
	}
	function load_account_info_form(){
		$( "#accountLoad").hide();
		$( "#accountLoadForm").html('<div class="text-center" style="min-height: 100px">'+SPINNER+'<div>').show();
		$.get( "<?php D(get_link('settingclientaccountInfoFormAJAXURL'))?>", function( data ) {
			setTimeout(function(){ $( "#accountLoadForm").html( data );},2000)
		});
	}
	function updateAccountInfo(){
		var buttonsection=$('.accountUpdateBTN');
		var buttonval = buttonsection.html();
		buttonsection.html(SPINNER).attr('disabled','disabled');
		var formID="accountinfoform";
		$.ajax({
	        type: "POST",
	        url: "<?php D(get_link('settingclientaccountInfoFormCheckAJAXURL'))?>",
	        data:$('#'+formID).serialize(),
	        dataType: "json",
	        cache: false,
			success: function(msg) {
				buttonsection.html(buttonval).removeAttr('disabled');
				clearErrors();
				if (msg['status'] == 'OK') {
					$( "#accountLoadForm").hide();
					$( "#accountLoad").html('<div class="text-center" style="min-height: 100px">'+SPINNER+'<div>');
					load_account_info();
				} else if (msg['status'] == 'FAIL') {
					registerFormPostResponse(formID,msg['errors']);
				}
			}
		})
	}
	
	
	/*company*/
	
	function load_company(){
		$( "#companyLoadForm").hide();
		$( "#companyLoad").html('<div class="text-center" style="min-height: 100px">'+SPINNER+'<div>').show();
		$.get( "<?php D(get_link('settingclientcompanyDataAJAXURL'))?>", function( data ) {
			setTimeout(function(){ $( "#companyLoad").html( data );$('.edit_company').show();},2000)
		});
	}
	function load_company_form(){
		$( "#companyLoad").hide();
		$( "#companyLoadForm").html('<div class="text-center" style="min-height: 100px">'+SPINNER+'<div>').show();
		$.get( "<?php D(get_link('settingclientcompanyFormAJAXURL'))?>", function( data ) {
			setTimeout(function(){ $( "#companyLoadForm").html( data );},2000)
		});
	}
	function updateCompany(){
		var buttonsection=$('.companyUpdateBTN');
		var buttonval = buttonsection.html();
		buttonsection.html(SPINNER).attr('disabled','disabled');
		var formID="companyform";
		$.ajax({
	        type: "POST",
	        url: "<?php D(get_link('settingclientcompanyFormCheckAJAXURL'))?>",
	        data:$('#'+formID).serialize(),
	        dataType: "json",
	        cache: false,
			success: function(msg) {
				buttonsection.html(buttonval).removeAttr('disabled');
				clearErrors();
				if (msg['status'] == 'OK') {
					$( "#companyLoadForm").hide();
					$( "#companyLoad").html('<div class="text-center" style="min-height: 100px">'+SPINNER+'<div>');
					load_company();
				} else if (msg['status'] == 'FAIL') {
					registerFormPostResponse(formID,msg['errors']);
				}
			}
		})
	}
	
	
	/*location*/
	
	function load_location(){
		$( "#locationLoadForm").hide();
		$( "#locationLoad").html('<div class="text-center" style="min-height: 100px">'+SPINNER+'<div>').show();
		$.get( "<?php D(get_link('settingclientlocationDataAJAXURL'))?>", function( data ) {
			setTimeout(function(){ $( "#locationLoad").html( data );$('.edit_location').show();},2000)
		});
	}
	function load_location_form(){
		$( "#locationLoad").hide();
		$( "#locationLoadForm").html('<div class="text-center" style="min-height: 100px">'+SPINNER+'<div>').show();
		$.get( "<?php D(get_link('settingclientlocationFormAJAXURL'))?>", function( data ) {
			setTimeout(function(){ $( "#locationLoadForm").html( data );
			$('.selectpicker').selectpicker('refresh');
			},2000);
		});
	}
	function updateLocation(){
		var buttonsection=$('.locationUpdateBTN');
		var buttonval = buttonsection.html();
		buttonsection.html(SPINNER).attr('disabled','disabled');
		var formID="locationform";
		$.ajax({
	        type: "POST",
	        url: "<?php D(get_link('settingclientlocationFormCheckAJAXURL'))?>",
	        data:$('#'+formID).serialize(),
	        dataType: "json",
	        cache: false,
			success: function(msg) {
				buttonsection.html(buttonval).removeAttr('disabled');
				clearErrors();
				if (msg['status'] == 'OK') {
					$( "#locationLoadForm").hide();
					$( "#locationLoad").html('<div class="text-center" style="min-height: 100px">'+SPINNER+'<div>');
					load_location();
				} else if (msg['status'] == 'FAIL') {
					registerFormPostResponse(formID,msg['errors']);
				}
			}
		})
	}
	
	
function updateprofilepercent(){}
var  main = function(){
	load_account_info();
	$('.edit_account_info').on('click',function(){
		$(this).hide();
		load_account_info_form();
	})
	$('body').on('click','#cancel_account_info',function(){
		$( "#accountLoadForm").hide();
		$( "#accountLoad").show();
		$('.edit_account_info').show();
	});
	load_company();
	$('.edit_company').on('click',function(){
		$(this).hide();
		load_company_form();
	})
	$('body').on('click','#cancel_company',function(){
		$( "#companyLoadForm").hide();
		$( "#companyLoad").show();
		$('.edit_company').show();
	});
	load_location();
	$('.edit_location').on('click',function(){
		$(this).hide();
		load_location_form();
	})
	$('body').on('click','#cancel_location',function(){
		$( "#locationLoadForm").hide();
		$( "#locationLoad").show();
		$('.edit_location').show();
	});

	$('#locationLoadForm').on('change','#country',function(){
	$( "#load_city").html('<div class="text-center" style="min-height: 70px;width: 100%;line-height: 50px;">'+SPINNER+'<div>').show();
		$.get( "<?php echo get_link('editprofileAJAXURL')?>",{'formtype':'getcity','Okey':$(this).val()}, function( data ) {
			setTimeout(function(){ $("#load_city").html(data);$('.selectpicker').selectpicker('refresh');},1000)
		});
	});
}
</script>
<div class="modal fade" id="avatar-modal-profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="z-index: 10000" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content mycustom-modal">
          <form class="avatar-form" action="<?php D(get_link('settingclientlogoFormCheckAJAXURL'))?>" enctype="multipart/form-data" method="post">
          <input type="hidden" value="logo" id="formtype" name="formtype"/>
            <div class="modal-header">
             <!-- <button type="submit" class="btn btn-success pull-right avatar-save">Done</button>-->
               <button type="button" class="btn btn-dark pull-left" data-bs-dismiss="modal">Cancel</button>
        		<h4 class="modal-title">Change Avatar</h4>
        		<button class="btn btn-success pull-right avatar-save" type="submit">Save</button>
            </div>
            <div class="modal-body">
              <div class="avatar-body">
                <!-- Upload image and data -->
                <div class="avatar-upload">
                  	<input type="hidden" class="avatar-src" name="avatar_src">
                  	<input type="hidden" class="avatar-data" name="avatar_data">
                  	<label for="avatarInput" class="form-label">Profile Picture</label>

                  			<div class="uploadButton margin-top-0">
								<input class="uploadButton-input avatar-input" type="file" id="avatarInput" name="avatar_file">
								<label class="uploadButton-button ripple-effect" for="avatarInput">Upload Files</label>
								<span class="uploadButton-file-name">Maximum file size: 2 MB</span>
							</div>
                  		
                  	</div>
	                
					
                  	<p class="text-help">File must be gif, jpg, png, jpeg.</p>               
                </div>

                <!-- Crop and preview -->
                <div class="row">
                  <div class="col-md-9">
                    <div class="avatar-crop-wrapper"></div>
                  </div>
                  <div class="col-md-3">
                    <div class="avatar-preview preview-lg"></div>
                    <div class="avatar-preview preview-md d-none"></div>
                    <div class="avatar-preview preview-sm d-none"></div>
                  </div>
                </div>                
              </div>
             </form>   
            </div>            
        </div>
      </div>