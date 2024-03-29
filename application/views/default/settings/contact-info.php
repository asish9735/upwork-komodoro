<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="dashboard-container">
<?php echo $left_panel;?>
<!-- Dashboard Content
	================================================== -->
	<div class="dashboard-content-container">
		<div class="dashboard-content-inner">
			
			<?php /*?><!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h4><?php echo __('setting_contact_info','Contact Info');?></h4>				
			</div><?php */?>
			<!-- Dashboard Box -->
            <div class="dashboard-box margin-top-0">
                    <!-- Headline -->
                    <div class="headline d-flex">
                        <h4><?php echo __('setting_contact_account','Account');?> </h4>  
                        <a href="<?php echo VZ;?>" class="ico btn-circle btn-edit edit_account_info" data-tippy-placement="top" title="Edit"><i class="icon-feather-edit-3"></i></a>                      
                    </div>

                    <div class="content with-padding">
	                	<div class="row">
						<div class="col-sm-auto">
							<div class="avatar-wrapper rounded-circle" id="crop-avatar-dashboard">
								<input type="hidden" name="logo" id="logo" class="replceLogoVal">
								<img src="<?php D(getMemberLogo($member_id));?>" alt="" />
								<a href="javascript:void(0)" class="ico btn-circle edit_logo_btn" data-popup="logo" data-tippy-placement="top" title="Change avatar" ><i class="icon-feather-edit-3"></i></a>
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
                    <div class="headline d-flex">
                        <h4><?php echo __('setting_contact_location','Location');?></h4>
                        <a href="<?php echo VZ;?>" class="ico btn-circle btn-edit edit_location" data-tippy-placement="top"  title="Edit"><i class="icon-feather-edit-3"></i></a>                        
                    </div>

                    <div class="content with-padding"  id="locationLoad">
                        <div class="text-center" style="min-height: 100px">
                        <?php load_view('inc/spinner',array('size'=>30));?>
                        </div>
                    </div>
                    <div class="content with-padding"  id="locationLoadForm" style="display: none"></div>
             </div>
		</div>
	</div>
	<!-- Dashboard Content / End -->

</div>

<script type="text/javascript">
	var SPINNER='<?php load_view('inc/spinner',array('size'=>30));?>';

	function load_account_info(){
		$( "#accountLoadForm").hide();
		$( "#accountLoad").html('<div class="text-center" style="min-height: 100px">'+SPINNER+'<div>').show();
		$.get( "<?php D(get_link('settingaccountInfoDataAJAXURL'))?>", function( data ) {
			setTimeout(function(){ $( "#accountLoad").html( data );$('.edit_account_info').show();},2000)
		});
	}
	function load_account_info_form(){
		$( "#accountLoad").hide();
		$( "#accountLoadForm").html('<div class="text-center" style="min-height: 100px">'+SPINNER+'<div>').show();
		$.get( "<?php D(get_link('settingaccountInfoFormAJAXURL'))?>", function( data ) {
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
	        url: "<?php D(get_link('settingaccountInfoFormCheckAJAXURL'))?>",
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

	/*location*/
	
	function load_location(){
		$( "#locationLoadForm").hide();
		$( "#locationLoad").html('<div class="text-center" style="min-height: 100px">'+SPINNER+'<div>').show();
		$.get( "<?php D(get_link('settinglocationDataAJAXURL'))?>", function( data ) {
			setTimeout(function(){ $( "#locationLoad").html( data );$('.edit_location').show();},2000)
		});
	}
	function load_location_form(){
		$( "#locationLoad").hide();
		$( "#locationLoadForm").html('<div class="text-center" style="min-height: 100px">'+SPINNER+'<div>').show();
		$.get( "<?php D(get_link('settinglocationFormAJAXURL'))?>", function( data ) {
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
	        url: "<?php D(get_link('settinglocationFormCheckAJAXURL'))?>",
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
          <form class="avatar-form" action="<?php D(get_link('editprofileFormCheckAJAXURL'))?>" enctype="multipart/form-data" method="post">
          <input  type="hidden" value="logo" id="formtype" name="formtype"/>
            <div class="modal-header">
             <!-- <button type="submit" class="btn btn-success pull-right avatar-save">Done</button>-->
               <button type="button" class="btn btn-dark pull-left" data-bs-dismiss="modal"><?php echo __('setting_contact_info_cancel','Cancel');?></button>
        		<h4 class="modal-title"><?php echo __('setting_contact_change_avatar','Change Avatar');?></h4>
        		<button  class="btn btn-success pull-right avatar-save" type="submit"><?php echo __('setting_contact_Save','Save');?></button>
            </div>
            <div class="modal-body">
              <div class="avatar-body">
                <!-- Upload image and data -->
                <div class="avatar-upload">
                  	<input type="hidden" class="avatar-src" name="avatar_src">
                  	<input type="hidden" class="avatar-data" name="avatar_data">
                  	<label for="avatarInput" class="form-label"><?php echo __('setting_contact_profile_picture','Profile Picture');?> </label>

                  			<div class="uploadButton margin-top-0">
								<input class="uploadButton-input avatar-input" type="file" id="avatarInput" name="avatar_file">
								<label class="uploadButton-button" for="avatarInput"><?php echo __('setting_contact_upload_file','Upload Files');?></label>
								<span class="uploadButton-file-name"<?php echo __('setting_contact_max_size','Maximum file size: 2 MB');?>></span>
							</div>
                  		
                  	</div>
	                
					
                  	<p class="text-help"><?php echo __('setting_contact_file_format','File must be gif, jpg, png, jpeg.');?></p>               
                </div>

                <!-- Crop and preview -->
                <div class="row">
                  <div class="col-md-9">
                    <div class="avatar-crop-wrapper"></div>
                  </div>
                  <div class="col-md-3">
                    <div class="avatar-preview preview-lg d-none"></div>
                    <div class="avatar-preview preview-md"></div>
                    <div class="avatar-preview preview-sm d-none"></div>
                  </div>
                </div>                
              </div>
             </form>   
            </div>            
        </div>
      </div>