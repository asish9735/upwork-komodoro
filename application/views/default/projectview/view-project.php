<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//get_print($projectData,FALSE);

$ProjectDetailsURL=get_link('myProjectDetailsURL')."/".$projectData['project']->project_url;
$ProjectApplicationURL=get_link('myProjectDetailsBidsClientURL')."/".$projectData['project']->project_id;
$ApplyProjecURL=get_link('ApplyProjectURL')."/".$projectData['project']->project_url;
$is_fav_class="";
if($login_user_id){
	$is_fav = isFavouriteJob($login_user_id, $projectData['project']->project_id);
	if($is_fav){
		$is_fav_class="active";
	}	
}
?>
<!-- Titlebar
================================================== -->
<div class="single-page-header">
	<div class="container">
		<div class="single-page-header-inner">
					<div class="left-side">
						
						<div class="header-details">
                        
							<h1><?php D(ucfirst($projectData['project']->project_title));?></h1>
							<p><?php D($projectData['project_category']->category_subchild_name);?>, <?php D($projectData['project_category']->category_name);?></p>
							
						</div>
					</div>
					
					<div class="right-side">                    	
					<?php if($projectData['project_settings'] && $projectData['project_settings']->is_fixed==1){?>                    	
						<div class="salary-box">
							<div class="salary-type">Fixed Budget</div>
							<div class="salary-amount"><?php D(priceSymbol().priceFormat($projectData['project_settings']->budget));?></div>
						</div>					
					<?php }?>
                    </div>
				</div>
	</div>
</div>
<?php if($is_owner){?>
<div class="container">
<ul class="nav nav-tabs mb-3">
  <li class="nav-item">
    <a class="nav-link active" href="<?php echo $ProjectDetailsURL;?>">Details</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="<?php echo $ProjectApplicationURL;?>">Applications</a>
  </li>
</ul>
</div>
<?php }?>
<?php
//print_r($display_tabs);
?>
<!-- Page Content
================================================== -->
<div class="container">
	<div class="row">		
		<!-- Content -->
		<div class="col-xl-8 col-lg-8">
			<!-- Description -->
			<div class="panel mb-4">
            	<div class="panel-header"><h4>Project Description</h4></div>
                <div class="panel-body">
					<p><?php D(nl2br($projectData['project_additional']->project_description));?></p>
                
    <div class="details-budget">
    
    </div>
    
    <ul class="totalList">
    <li><b>Payment Type</b> <br> <?php if($projectData['project_settings']->is_hourly==1){D('<i class="icon-feather-tag"></i> <br>');D('Hourly');}else{D('<i class="icon-feather-clock"></i> <br>');D('Fixed');}?> </li>
    <li><b>Experience Level</b> <br><i class="icon-feather-<?php D($projectData['project_settings']->experience_level_key)?>"></i><br><?php D($projectData['project_settings']->experience_level_name)?> </li>
    <?php if($projectData['project_settings']->is_hourly==1){?>
    <li><b>Project Duration</b> <br><i class="icon-line-awesome-<?php D($projectData['project_settings']->hourly_duration)?>"></i><br><?php D(getAllProjectDuration($projectData['project_settings']->hourly_duration)['name']);?> </li>
    <li><b>Time Required</b> <br><i class="icon-feather-<?php D($projectData['project_settings']->hourly_time_required)?>"></i><br><?php D(getAllProjectDurationTime($projectData['project_settings']->hourly_time_required)['name']);?> </li>
    <?php }?>
    
    <li><b>Project Type</b>
    	<br><i class="icon-material-<?php D($projectData['project_settings']->project_type_code);?>"></i><br>
        <?php D(getAllProjectType($projectData['project_settings']->project_type_code)['name']);?>
    </li>
    <li><b>No of freelancer</b>
    	<br><i class="icon-feather-user"></i><br>
        <?php D($projectData['project']->project_member_required);?>
    </li>
</ul>
</div>
</div>



<?php if($projectData['project_files']){?>
			<!-- Atachments -->
			<div class="panel mb-4">
            	<div class="panel-header"><h4>Attachments</h4></div>
                <div class="panel-body">
				<div class="attachments-container">
				<?php foreach($projectData['project_files'] as $f=>$file){
					$row_name=basename($file->original_name,'.'.$file->file_ext);
					if($file->server_name && file_exists(UPLOAD_PATH.'projects-files/projects-requirement/'.$file->server_name)){
					?>
					<a href="<?php echo UPLOAD_HTTP_PATH.'projects-files/projects-requirement/'.$file->server_name;?>" target="_blank" class="attachment-box ripple-effect"><span><?php D($row_name);?></span><i><?php D(strtoupper($file->file_ext));?></i></a>
				<?php }}?>
                </div>
				</div>
			</div>
<?php }?>
<?php if($projectData['project_skills']){?>
			<!-- Skills -->
			<div class="panel mb-4">
            	<div class="panel-header"><h4>Skills Required</h4></div>
                <div class="panel-body">
				<div class="task-tags">
				<?php foreach($projectData['project_skills'] as $f=>$skill){?>
					<span><?php D($skill->skill_name);?></span>
				<?php }?>
				</div>
                </div>
			</div>
<?php }?>	




<?php if($projectData['project_question']){?>
			<!-- Atachments -->
			<div class="panel mb-4">
            	<div class="panel-header"><h4>Screening Question</h4></div>
                <div class="panel-body">				
				<div class="question-container">
				<?php foreach($projectData['project_question'] as $q=>$question){
					?>
					<p><?php D($q+1);?>. <?php D($question->question_title);?></p>
				<?php }?>
				</div>
                </div>
			</div>
<?php }?>

<ul class="totalList">
            <li><b>Proposal</b>
                <span><?php D($projectData['proposal']['total_proposal'])?></span>
            </li>
            <li><b>Invite</b>
                <span><?php D($projectData['proposal']['total_invite'])?></span>
            </li>
            <li><b>Interview</b>
            	<span><?php D($projectData['proposal']['total_interview'])?></span>
            </li>
            <li><b>Hires</b>
            	<span><?php D($projectData['proposal']['total_hires'])?></span>
            </li>
        </ul>

</div>
		

		<!-- Sidebar -->
		<div class="col-xl-4 col-lg-4">
			<div class="sidebar-container">
            <div class="countdown green mb-3">Posted <?php D(get_time_ago($projectData['project']->project_posted_date));?></div>
			<?php if(!$is_owner){
				if($is_already_bid && $is_already_bid->is_hired!=1){
				?>
				<a href="<?php echo $ApplyProjecURL;?>" class="apply-now-button btn btn-site mb-3">
				<?php
				if($is_already_bid){
					echo 'Revise Proposal';
				}else{
					echo 'Submit Proposal';
				}
				?>
				</a>
			<?php }elseif(!$is_already_bid){ ?>
				<a href="<?php echo $ApplyProjecURL;?>" class="apply-now-button btn btn-site mb-3">Submit Proposal</a>
			<?php	
				}
			}?>
				

				<div class="job-overview mb-4">
					<div class="job-overview-headline"><h4>Client Information</h4></div>
					<div class="job-overview-inner">
                        <ul>
                            <li>
                                <i class="icon-material-outline-business"></i>
                                <p><?php D($projectData['clientInfo']['client_name'])?></p>
                            </li>
                            <li>
                                <i class="icon-material-outline-location-on"></i>
                                <p><?php D($projectData['clientInfo']['client_address']['country'])?></p>
                                <span><?php D($projectData['clientInfo']['client_address']['location'])?></span>
                            </li>
                            <li>
                                <i class="icon-material-outline-check-circle <?php if($projectData['clientInfo']['client_payment_verify']=='1'){D('text-success');}else{D('text-danger');}?> "></i>
                                <span><?php if($projectData['clientInfo']['client_payment_verify']=='1'){D('Payment method verified');}else{D('Payment method not verified');}?></span>                                
                            </li>
                            <li>
                                <i class="icon-material-outline-star-border"></i>
                                <div class="star-rating w-100" data-rating="<?php D($projectData['clientInfo']['client_review_rating']['rating'])?>"></div>
                                <span><?php D($projectData['clientInfo']['client_review_rating']['rating'])?> of <?php D($projectData['clientInfo']['client_review_rating']['review'])?> reviews</span>
                            </li>
                            <li>
                                <i class="icon-material-outline-business-center"></i>
                                <p><?php D($projectData['clientInfo']['client_project_info']['total_project'])?> total project posted</p>
                                <span><?php D($projectData['clientInfo']['client_project_info']['total_hired'])?> hires<!--, <?php D($projectData['clientInfo']['client_project_info']['total_active'])?> active--></span>
                            </li>
                            <li>
                                <i class="icon-material-outline-local-atm"></i>
                                <p><?php D(priceSymbol().priceFormat($projectData['clientInfo']['client_total_payment']));?> total spent</p>
                            </li>
                            <li>
                                <i class="icon-material-outline-access-time"></i>                                
                                <p><strong>Member since:</strong> <span><?php D(dateFormat($projectData['clientInfo']['client_member_since'],'M d, Y'))?></span></p>
                            </li>
                        </ul>
					</div>
				</div>

				<!-- Sidebar Widget -->
                <div class="panel">
                <div class="panel-header"><h4>Share &amp; Bookmark</h4></div>
				<div class="panel-body">					
					<!-- Copy URL -->
					<div class="copy-url mb-3">
						<input type="text" class="form-control" id="copy-url" value="">
						<button class="copy-url-button ripple-effect" data-clipboard-target="#copy-url" title="Copy to Clipboard" data-tippy-placement="top"><i class="icon-material-outline-file-copy"></i></button>
					</div>

					<!-- Share Buttons -->
					<div class="freelancer-socials">
						<ul class="social-links">
							<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $ProjectDetailsURL;?>" target="_blank" title="Share on Facebook" data-tippy-placement="top"><i class="icon-brand-facebook-f"></i></a></li>
							<li><a href="https://twitter.com/home?status=<?php echo $ProjectDetailsURL;?>" target="_blank" title="Share on Twitter" data-tippy-placement="top"><i class="icon-brand-twitter"></i></a></li>
							<li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $ProjectDetailsURL;?>&title=&summary=&source=" target="_blank" title="Share on LinkedIn" data-tippy-placement="top"><i class="icon-brand-linkedin-in"></i></a></li>
						</ul>
                      <!-- Bookmark icon -->
					  <?php if(!$is_owner){?>
					  <span style=" position: absolute; right: 0; top: 0;">
						<a href="<?php echo VZ;?>" class="btn btn-circle btn-light mr-2 action_favorite <?php echo $is_fav_class;?>" data-pid="<?php echo md5($projectData['project']->project_id);?>"><i class="icon-feather-heart"></i></a>
					  </span>
					  <?php }?>
				    </div>
				</div>
                </div>

			</div>
		</div>

	</div>
</div>
<div class="margin-top-30"></div>
<div id="myModal" class="modal fade" tabindex="-1" role="dialog"  style="z-index: 10000"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document"> 
    <!-- Modal content-->
    <div class="modal-content mycustom-modal">
      <div class="text-center padding-top-50 padding-bottom-50">
        <?php load_view('inc/spinner',array('size'=>30));?>
      </div>
    </div>
  </div>
</div>
<?php if($this->session->flashdata('not_verified')){?>
<script type="text/javascript">
var vtype="<?php echo $this->session->flashdata('not_verified');?>";
if(vtype=='email'){
	var message="Please verify your email. <a href='<?php echo VZ;?>' onclick='resendEmail()'>Click here</a> to resend email";
}else if(vtype=='doc'){
	var message="Please verify your document. <a href='<?php echo URL::get_link('verifyDocumentURL');?>'>Click here</a> to verify";
}
function resendEmail(){
	bootbox.hideAll();
	$.ajax({
        		type: "POST",
		        url: "<?php D(get_link('resendEmailURLAJAX'))?>",
		        dataType: "json",
		        cache: false,
				success: function(msg) {
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
}
var main=function(){
bootbox.alert({
	title:'Verification Required',
	message: message,
	buttons: {
	'ok': {
		label: 'Ok',
		className: 'btn-site pull-right'
		}
	},
});
}
</script>
<?php }?>
<script>
var mainpart=function(){
$('.action_favorite').on('click', function(e){
		e.preventDefault();
		var _self=$(this);
		var data = {
			pid: _self.data('pid'),
		};
		$.post('<?php echo get_link('actionfavorite_job'); ?>', data, function(res){
			if(res['status'] == 'OK'){
				if(res['cmd']== 'add'){
					_self.addClass('active');
					bootbox.alert({
						title:'Make Favorite',
						message: 'Successfully Saved',
						buttons: {
						'ok': {
							label: 'Ok',
							className: 'btn-site pull-right'
							}
						},
						callback: function () {
							
					    }
					});
				}else{
					_self.removeClass('active');
					bootbox.alert({
						title:'Remove Favorite',
						message: 'Successfully Removed',
						buttons: {
						'ok': {
							label: 'Ok',
							className: 'btn-site pull-right'
							}
						},
						callback: function () {
							
					    }
					});
					
				}
			}else if(res['popup'] == 'login'){
				bootbox.confirm({
					title:'Login Error!',
					message: 'You are not Logged In. Please login first.',
					buttons: {
					'confirm': {
						label: 'Login',
						className: 'btn-site pull-right'
						},
					'cancel': {
						label: 'Cancel',
						className: 'btn-dark pull-left'
						}
					},
					callback: function (result) {
						if(result){
							var base_url = '<?php echo base_url();?>';
							var refer = window.location.href.replace(base_url, '');
							location.href = '<?php echo base_url('login?refer='); ?>'+refer;
						}
					}
				});
			}
		},'JSON');
		
	})
}
</script>