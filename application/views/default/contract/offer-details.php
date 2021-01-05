<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$currency=priceSymbol();
$ProjectDetailsURL=get_link('myProjectDetailsURL')."/".$contractDetails->project_url;
//get_print($contractDetails,FALSE);
if($is_owner){
	$logo=getMemberLogo($contractDetails->contractor->member_id);
	$name=$contractDetails->contractor->member_name;
}else{
	$logo=getCompanyLogo($contractDetails->owner->organization_id);
	if($contractDetails->owner->organization_name){
		$name=$contractDetails->owner->organization_name;
	}else{
		$name=$contractDetails->owner->member_name;
	}
	
}
?>
<section class="section">
	<?php //echo $left_panel;?>
    <div class="container">
        <h1 class="display-4"><?php echo $contractDetails->contract_title;?></h1>
        <div class="row">
        <div class="col-lg-9">				
        <?php 
        if($contractDetails->contract_status==0){
            if($current_member!=$contractDetails->offer_by){
            ?>
            <p>You have a new offer. 
            <button class="btn btn-success acceptbtn">Accept</button>
            <button class="btn btn-danger denybtn">Reject</button></p>
            <?php	
            }
        }elseif($contractDetails->contract_status==1){
        ?>
        <div class="mx-auto alert alert-success text-center">
        <p class="mb-0"> <i class="icon-material-outline-check-circle text-success"></i> Offer Accepted. </p>
        </div>
        <?php	
        }elseif($contractDetails->contract_status==2){
        ?>
        <div class="mx-auto alert alert-warning text-center">
        <p class="mb-0"> <i class="icon-material-outline-check-circle text-danger"></i> Offer Rejected</p>
        </div>
        <?php	
        }?>
        <div class="panel mb-4">
        <div class="panel-header"><h4>Details</h4></div>
        <div class="panel-body">
        <?php if($contractDetails->contract_details){?>
        <p><?php echo nl2br($contractDetails->contract_details);?></p>
        <?php }?>
        <p>Job: <a href="<?php echo $ProjectDetailsURL;?>" target="_blank"><?php echo $contractDetails->project_title;?></a></p>
        </div>
        </div>
        <?php if($contractDetails->is_hourly){?>
        <div class="panel mb-4">
        <div class="panel-header relative"><h4>Term </h4></div>	
        <div class="panel-body">
        <p><b>Hourly Rate:</b> <?php echo $currency.$contractDetails->contract_amount;?> /hr</p>
        <p><b>Max Limit:</b> <?php if($contractDetails->max_hour_limit){echo round($contractDetails->max_hour_limit).' hr/week';}else{echo 'No limit';}?></p>
        <p><b>Allow Manual Hour:</b> <?php if($contractDetails->allow_manual_hour){echo 'Yes';}else{echo 'No';}?></p>
        </div>
        
        </div>	
        <?php }else{?>
        <div class="panel mb-4">
        <div class="panel-header relative"><h4>Milestone (<?php echo count($contractDetails->milestone);?>)</h4> <a href="javascript:void(0)" onclick="showMilestone()" class="toggleUD milestoneToggle"><i class="icon-feather-chevron-down"></i></a></div>
        <div class="panel-body" id="milestone" style="display:none">
        <ul class="list-group ">
        <?php if($contractDetails->milestone){
            foreach($contractDetails->milestone as $m=>$milestone){
        ?>
        <li class="list-group-item">
        <span class="number"><?php echo $m+1;?>.</span>
        <div class="milestone-item">
            <b><?php echo ucfirst($milestone->milestone_title);?></b><br>
            <b>Budget:</b> <?php echo $milestone->milestone_amount;?> <br> 
            <b>Due Date:</b> <?php echo $milestone->milestone_due_date; ?>
        </div>				
        </li>
        <?php		
            }
            }
            ?>
        </ul>
        
        
        </div>
        </div>
        <?php }?>
        <?php if($contractDetails->contract_attachment){?>
        <div class="panel mb-4">
        <div class="panel-header relative"><h4>Attachment</h4><a href="javascript:void(0)" onclick="showAttach()" class="toggleUD attachmentToggle"><i class="icon-feather-chevron-down"></i></a></div>
        <div class="panel-body" id="attachment" style="display:none">
        <div class="attachments-container">
          <?php
            $attachments=json_decode($contractDetails->contract_attachment);
            foreach($attachments as $k=>$val){
                if($val->file && file_exists(UPLOAD_PATH.'projects-files/projects-contract/'.$val->file)){
                    $path_parts = pathinfo($val->name);
            ?>
          <a href="<?php echo UPLOAD_HTTP_PATH.'projects-files/projects-contract/'.$val->file;?>" target="_blank" class="attachment-box "><span><?php echo $path_parts['filename'];?></span><i><?php echo strtoupper($path_parts['extension']);?></i></a>
          <?php
                }	
            }
            ?>
        </div>
        </div>
        </div>	
        <?php }?>
        
        </div>
        <div class="col-lg-3">
        <div class="card text-center mx-auto">
            <div class="card-body">
            <img src="<?php echo $logo;?>" alt="<?php echo $name;?>" class="rounded-circle mb-3" height="96" width="96">                    
            <h5 class="card-title"><?php echo $name;?></h5>
            </div>                    
        </div>
        </div>
        </div>
    </div>
</section>

<script>
function showMilestone(){ 
    $('#milestone').toggle();
	$(".milestoneToggle").toggleClass('active');
}
function showAttach(){ 
	$('#attachment').toggle();
	$(".attachmentToggle").toggleClass('active');
}
</script>
<script>
	var SPINNER='<?php load_view('inc/spinner',array('size'=>30));?>';
	var offer_id="<?php echo md5($contractDetails->contract_id)?>";
	var main=function(){
		$('.acceptbtn').click(function(){
			var buttonsection=$(this);
			buttonsection.attr('disabled','disabled');
			var buttonval = buttonsection.html();
			buttonsection.html(SPINNER).attr('disabled','disabled');
			$.post( "<?php echo get_link('offerActionAjaxURL');?>",{'offer_id':offer_id,'action_type':'accept'}, function( msg ) {
				if (msg['status'] == 'OK') {
					bootbox.alert({
						title:'Offer Action',
						message: '<?php D(__('offer_success_message','Update Success'));?>',
						buttons: {
						'ok': {
							label: 'Ok',
							className: 'btn-site pull-right'
							}
						},
						callback: function () {
							window.location.href=msg['redirect'];
					    }
					});
				} else if (msg['status'] == 'FAIL') {
					bootbox.alert({
						title:'Offer Action',
						message: '<?php D(__('offer_error_message',"Opps! . Please try again."));?>',
						buttons: {
						'ok': {
							label: 'Ok',
							className: 'btn-site pull-right'
							}
						},
						callback: function () {
							location.reload();
					    }
					});
				}
				
			},'JSON');
	
		});
		$('.denybtn').click(function(){
			var buttonsection=$(this);
			buttonsection.attr('disabled','disabled');
			var buttonval = buttonsection.html();
			buttonsection.html(SPINNER).attr('disabled','disabled');
			$.post( "<?php echo get_link('offerActionAjaxURL');?>",{'offer_id':offer_id,'action_type':'deny'}, function( msg ) {
				if (msg['status'] == 'OK') {
					bootbox.alert({
						title:'Offer Action',
						message: '<?php D(__('offer_success_message','Update Success'));?>',
						buttons: {
						'ok': {
							label: 'Ok',
							className: 'btn-site pull-right'
							}
						},
						callback: function () {
							window.location.href=msg['redirect'];
					    }
					});
				} else if (msg['status'] == 'FAIL') {
					bootbox.alert({
						title:'Offer Action',
						message: '<?php D(__('offer_error_message',"Opps! . Please try again."));?>',
						buttons: {
						'ok': {
							label: 'Ok',
							className: 'btn-site pull-right'
							}
						},
						callback: function () {
							location.reload();
					    }
					});
				}
			},'JSON');
		});
	}
</script>