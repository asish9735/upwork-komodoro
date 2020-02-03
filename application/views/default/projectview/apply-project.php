<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//get_print($projectData,FALSE);

$ProjectDetailsURL=get_link('myProjectDetailsURL')."/".$projectData['project']->project_url;
$ProjectApplicationURL=get_link('myProjectDetailsBidsClientURL')."/".$projectData['project']->project_id;
$ApplyProjecURL=get_link('ApplyProjectURL')."/".$projectData['project']->project_url;
$currency=priceSymbol();
?>
<!-- Titlebar -->
<div class="single-page-header">
	<div class="container">
		<div class="single-page-header-inner">
            <div class="left-side">
                <div class="header-details">
                    <h1><?php D(ucfirst($projectData['project']->project_title));?></h1>
                    <h5><?php D($projectData['project_category']->category_subchild_name);?> , <?php D($projectData['project_category']->category_name);?></h5>
                </div>
            </div>
            <?php if($projectData['project_settings']->is_fixed==1){?>
            <div class="right-side">
                <div class="salary-box">
                    <div class="salary-type">Fixed Budget</div>
                    <div class="salary-amount"><?php D($currency.priceFormat($projectData['project_settings']->budget));?></div>
                </div>
            </div>
            <?php }?>
        </div>
	</div>
</div>


<!-- Page Content
================================================== -->
<div class="container">
	<form action="" method="post" accept-charset="utf-8" id="applyprojectform" class="form-horizontal" role="form" name="applyprojectform" onsubmit="return false;">  
			<?php /*?><input type="hidden" name="pid" value="<?php echo $projectData['project']->project_id;?>"/>
			<input type="hidden" id="is_hourly" value="<?php if($projectData['project_settings']->is_hourly==1){echo 1;}else{echo 0;}?>"/>-->
			<?php */?>
			<?php if($projectData['project_settings']->is_hourly==1){?>
			<div class="panel mb-4">
            <div class="panel-header"><h3>Lorem ipsum dolar </h3></div>
            <div class="panel-body">
			<div class="payment_project_wrapper">
				<h4>What is the rate you'd like to bid for this job?</h4>
				<div class="padding-top-20" style="max-width:720px">
					<div class="row">
						<div class="col-sm-8"><h4>Hourly Rate</h4>
						<span>Total amount the client will see on your proposal</span></div>
						<div class="col-sm-4">
						<div class="input-with-icon both">
                        	<i><?php echo $currency;?></i>
                        	<input type="text" name="bid_amount" id="bid_amount" class="form-control text-right notick" value="<?php if($getBidDetails){echo $getBidDetails->bid_amount;}else{echo '0.00';}?>" onkeyup="updateTotal('bid_amount')">
							<span>/hr</span>							
						</div>						
						</div>
					</div>
                    <hr />
					<div class="row">
						<div class="col-sm-8"><h4><?php echo $bid_site_fee;?>% Service Fee</h4></div>
						<div class="col-sm-4 text-sm-right"><span class="f20"><?php echo $currency;?> <span class="total_fee">0.00</span></span></div>
					</div>
                    <hr />
					<div class="row">
						<div class="col-sm-8"><h4>You'll Receive</h4>
						<span>The estimated amount you'll receive after service fees</span></div>
						<div class="col-sm-4">
						<div class="input-with-icon both">
                            <i><?php echo $currency;?></i>
                            <input type="text" name="bid_amount_receive" id="bid_amount_receive" class="form-control text-right notick" value="0.00" onkeyup="updateTotal('bid_amount_receive')">
                            <span>/hr</span>
						</div>
						</div>
					</div>
				</div>
			</div>
            </div>
            </div>
            
			
			<?php }else{?>
            <div class="panel mb-4">
            <div class="panel-header"><h3>Lorem ipsum dolar </h3></div>
            <div class="panel-body">
			<div class="form-group">
				<h4>How do you want to be paid?</h4>
				<div class="radio">
					<input id="payment_at_milestone" name="bid_by_project" class="project_payment_type" value="0" type="radio" <?php if($getBidDetails && $getBidDetails->bid_by_project==1){}else{echo 'checked';}?> >
					<label for="payment_at_milestone"><span class="radio-label"></span> By milestone<br><span>Divide the project into smaller segments, called milestones. You'll be paid for milestones as they are completed and approved.</span></label>
				</div>
				<br>
				<div class="radio">
					<input id="payment_at_project" name="bid_by_project" class="project_payment_type" value="1" type="radio" <?php if($getBidDetails && $getBidDetails->bid_by_project==1){echo 'checked';}?>>
					<label for="payment_at_project"><span class="radio-label"></span> By project<br><span>Get your entire payment at the end, when all work has been delivered.</span></label>
				</div>
			</div>
            
			
			
			<div class="payment_milestone_wrapper" <?php if($getBidDetails && $getBidDetails->bid_by_project==1){?> style="display: none"<?php }?>>
					<h4>How many milestones do you want to include?</h4>
					<div id="milestone_wrapper">
						<?php if($getBidDetails && $getBidDetails->bid_by_project==0){
							foreach($getBidDetails->milestone as $k=>$milestone){
								$pmid=$k+1;
							?>
							<div class="row milestone_row_parent">
								<div class="col-sm-6 col-xs-12">
									<input type="hidden" name="milestone_id[]" class="milestone_row" value="<?php echo $pmid;?>"/>
					                <div class="form-group">
					                    <label for="title"><b>Description</b></label>
					                    <input type="text" name="milestone_title_<?php echo $pmid;?>" id="milestone_title_<?php echo $pmid;?>" class="form-control" value="<?php echo $milestone->bid_milestone_title;?>">
					                </div>
				                </div>
								<div class="col-sm-3 col-xs-12">
				                  <div class="form-group">
				                    <label for="title"><b>Due date</b></label>
				                    <input type="text" name="milestone_due_date_<?php echo $pmid;?>" id="milestone_due_date_<?php echo $pmid;?>" class="form-control datepicker" value="<?php echo $milestone->bid_milestone_due_date;?>">
				                  </div>
				                </div>
				                <div class="col-sm-3 col-xs-12">
				                  <div class="form-group">
				                    <label for="title"><b>Amount</b></label>
				                     <?php if($k>0){?>
				                     <div style="display: flex">
				                     <?php }?>
				                    <input type="text" name="milestone_amount_<?php echo $pmid;?>" id="milestone_amount_<?php echo $pmid;?>" class="milestone_amount form-control" value="<?php echo $milestone->bid_milestone_amount;?>" onKeyUp="updateTotal()">
				                    <?php if($k>0){?>
				                    <button class="btn btn-danger" onclick="removeRow(this)" style="position: absolute;right: 0px;">X</button>
				                    </div>
				                    <?php }?>
				                  </div>
				                </div>
							</div>
						<?php }
						 }else{?>
						<div class="row milestone_row_parent">
							<div class="col-sm-6 col-xs-12">
								<input type="hidden" name="milestone_id[]" class="milestone_row" value="1"/>
				                <div class="form-group">
				                    <label for="title"><b>Description</b></label>
				                    <input type="text" name="milestone_title_1" id="milestone_title_1" class="form-control">
				                </div>
			                </div>
							<div class="col-sm-3 col-xs-12">
			                  <div class="form-group">
			                    <label for="title"><b>Due date</b></label>
			                    <input type="text" name="milestone_due_date_1" id="milestone_due_date_1" class="datepicker form-control">
			                  </div>
			                </div>
			                <div class="col-sm-3 col-xs-12">
			                  <div class="form-group">
			                    <label for="title"><b>Amount</b></label>
			                    <input type="text" name="milestone_amount_1" id="milestone_amount_1" class="milestone_amount form-control" onKeyUp="updateTotal()">
			                  </div>
			                </div>
						</div>
						<?php }?>
					</div>
					<a href="javascript:" class="btn btn-sm btn-success addMilestone"><i class="icon-feather-plus"></i> Add Milestone</a>
					
					<div class="padding-top-20" style="max-width:720px">
						<div class="row">
							<div class="col-sm-8">
                            <h4>Total price of project</h4>
							<span>This includes all milestones, and is the amount your client will see</span></div>
							<div class="col-sm-4 text-sm-right"><span class="f20"><?php echo $currency;?> <span class="total_amount">0.00</span></span></div>
						</div>
                        <hr />
						<div class="row">
							<div class="col-sm-8"><h4><?php echo $bid_site_fee;?>% Service Fee</h4></div>
							<div class="col-sm-4 text-sm-right"><span class="f20"><?php echo $currency;?> <span class="total_fee">0.00</span></span></div>
						</div>
                        <hr />
						<div class="row">
							<div class="col-sm-8"><h4>You'll Receive</h4>
							<span>Your estimated payment, after service fees</span></div>
							<div class="col-sm-4 text-sm-right"><span class="f20"><?php echo $currency;?> <span class="total_recive">0.00</span></span></div>
						</div> 
					</div>
			</div>
			
			<div class="payment_project_wrapper" <?php if($getBidDetails && $getBidDetails->bid_by_project==1){}else{?> style="display: none"<?php }?>>
				<h4>What is the full amount you'd like to bid for this job?</h4>
				<div class="padding-top-20" style="max-width:720px">
					<div class="row">
						<div class="col-sm-8"><h4>Bid</h4>
							<p>Total amount the client will see on your proposal</p>
                        </div>
						<div class="col-sm-4">
                        <div class="input-with-icon-left">
                        <i><?php echo $currency;?></i>
						<input type="text" name="bid_amount" id="bid_amount" class="form-control text-right" value="<?php if($getBidDetails){echo $getBidDetails->bid_amount;}else{echo '0.00';}?>" onkeyup="updateTotal('bid_amount')">                        
                        </div>
						</div>
					</div>
                    <hr />
					<div class="row">
						<div class="col-sm-8"><h4><?php echo $bid_site_fee;?>% Service Fee</h4></div>
						<div class="col-sm-4 text-sm-right"><span class="f20"><?php echo $currency;?> <span class="total_fee">0.00</span></span></div>
					</div>
                    <hr />
					<div class="row">
						<div class="col-sm-8"><h4>You'll Receive</h4>
						<p>The estimated amount you'll receive after service fees</p></div>
						<div class="col-sm-4">
                        <div class="input-with-icon-left">
                        <i><?php echo $currency;?></i>
						<input type="text" name="bid_amount_receive" id="bid_amount_receive" class="form-control text-right" value="0.00" onkeyup="updateTotal('bid_amount_receive')">                        
                        </div>
						</div>
					</div>
				</div>
			</div>
            </div>
            </div>
			<div class="panel mb-4">
            <div class="panel-header"><h3>How long will this project take?</h3></div>
            <div class="panel-body">				
				<div class="row">
					<div class="col-md-4 col-sm-6">
						<select class="form-control" name="bid_duration" id="bid_duration">
						<option value="">Please Select</option>
						<?php if($bidduration){
							foreach($bidduration as $k=>$val){
							?>
							<option value="<?php echo $k;?>" <?php if($getBidDetails && $getBidDetails->bid_duration==$k){echo 'selected';}?>><?php echo $val['name'];?></option>
							<?php	
							}
							}
							?>
						</select>
					</div>
				</div>
			</div>
            </div>
            <?php }?>	
            
            
            
            <div class="panel">
            <div class="panel-header"><h3>Additional details</h3></div>
            <div class="panel-body">
            
				
					<?php
			if($project_question){
			?>
			<label><b>Question</b></label>
			<?php
				foreach($project_question as $k=>$val){
			?>
			<div class="form-group">
				<label><b><?php echo $k+1;?>. <?php echo $val->question_title;?></b></label>
				<input type="hidden" name="qid[]" value="<?php echo $val->question_id;?>"/>
				<input type="text" name="question[<?php echo $val->question_id;?>]" class="form-control" value="<?php echo $val->question_answer;?>">
			</div>
			<?php		
				}
			}
			?>
            
			<div class="form-group">
				<label><b>Cover Letter <?php if($projectData['project_additional'] && $projectData['project_additional']->project_is_cover_required){?>(this client require cover letter)<?php }?></b></label>
				<textarea class="form-control" id="bid_details" name="bid_details"><?php if($getBidDetails && $getBidDetails->bid_details){echo $getBidDetails->bid_details;}?></textarea>
			</div>
			<div class="form-group">
				<label><b>Attachments</b></label>
                <input type="file" name="fileinput" id="fileinput" multiple="true">
                <div class="upload-area" id="uploadfile">
                    <h4 class="mb-0">Drag &amp; drop file here or <span class="text-site">click</span> to select file</h4>
                </div>
                <div id="uploadfile_container">
                    <?php if($getBidDetails && $getBidDetails->bid_attachment){
                    $inc=0;
                    $attachment=json_decode($getBidDetails->bid_attachment);
                    foreach($attachment as $files){
                        $inc++;
                        $filejson=array(
                        'file_name'=>$files->file,
                        'original_name'=>$files->name,
                        );
                        ?>
                        <div id="thumbnail_<?php D($inc)?>" class="thumbnail_sec"><input type="hidden" name="projectfileprevious[]" value='<?php D(json_encode($filejson))?>'><?php D($filejson['original_name']);?><a href="javascript:void(0)" class=" text-danger ripple-effect ico float-right" onclick="$(this).parent().remove()"><i class="icon-feather-trash"></i></a></div>
                        <?php
                    }
                    
                   }?>
                </div>
			</div>
			
			</div>
            </div>
			<div class="padding-bottom-15 padding-top-15">	
				<button class="btn btn-site nextbtnapply">Submit Proposal</button> &nbsp;
				<button class="btn btn-secondary backbtnapply">Back</button>
			</div>
			
</form>
</div>
<div class="margin-top-15"></div>
<script type="text/javascript">
	var pid='<?php echo $projectData['project']->project_id;?>';
	var is_hourly='<?php if($projectData['project_settings']->is_hourly==1){echo 1;}else{echo 0;}?>';
	var SPINNER='<?php load_view('inc/spinner',array('size'=>30));?>';
	function uploadData(formdata){
	var len = $("#uploadfile_container div.thumbnail_sec").length;
   	var num = Number(len);
	num = num + 1;	
	$("#uploadfile_container").append('<div id="thumbnail_'+num+'" class="thumbnail_sec">'+SPINNER+'</div>');
    $.ajax({
        url: "<?php D(get_link('uploadFileFormCheckAJAXURL'))?>",
        type: 'post',
        data: formdata,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response){
           if(response.status=='OK'){
    			var name = response.upload_response.original_name;
    			$("#thumbnail_"+num).html('<input type="hidden" name="projectfile[]" value=\''+JSON.stringify(response.upload_response)+'\'/> '+name+'<a href="<?php D(VZ);?>" class=" text-danger ico float-right" onclick="$(this).parent().remove()"><i class="icon-feather-trash"></i></a>');
		   }else{
		   	bootbox.alert({
				title: 'Uplaod File',
				message: 'Error in upload file',
				size: 'small',
				buttons: {
					ok: {
						label: "Ok",
						className: 'btn-site pull-right'
					},
				},
				callback: function(result){
					$("#thumbnail_"+num).remove();
				}
			});	
		   }
		   $('#fileinput').val('');
        },
        
    }).fail(function(){
    	$("#thumbnail_"+num).html('<p class="text-danger">Error occurred</p>');
    });
	}
	function removeRow(ev){
		$(ev).closest('.milestone_row_parent').remove();
		updateTotal();
	}
	function updateTotal(type_from){
		var fee_percent=<?php echo $bid_site_fee;?>;
		var total_project_price=0;
		var total_fee=0;
		var total_receive=0;
		//var is_hourly=$("#is_hourly").val();
		if(is_hourly==1){
			if(type_from=='bid_amount_receive'){
				var amount=parseFloat($('#bid_amount_receive').val());
				if(isNaN(amount)){
					amount=0;
				}
				total_project_price=amount/(1-(fee_percent/100));
				total_fee=(total_project_price*fee_percent)/100;
				var total_project_price_new=parseFloat(amount)+parseFloat(total_fee);
				$('#bid_amount').val(parseFloat(total_project_price_new).toFixed(2));
			}else{
				var amount=parseFloat($('#bid_amount').val());
				if(isNaN(amount)){
					amount=0;
				}
				total_project_price=amount;
				total_fee=(total_project_price*fee_percent)/100;
				total_recive=parseFloat(total_project_price)-parseFloat(total_fee);
				$('#bid_amount_receive').val(parseFloat(total_recive).toFixed(2));
			}
			$('.total_fee').html(parseFloat(total_fee).toFixed(2));
		}else{
			var project_payment_type=$('.project_payment_type:checked').val();
			if(project_payment_type==1){
				if(type_from=='bid_amount_receive'){
					var amount=parseFloat($('#bid_amount_receive').val());
					if(isNaN(amount)){
						amount=0;
					}
					total_project_price=amount/(1-(fee_percent/100));
					
					total_fee=(total_project_price*fee_percent)/100;
					//console.log(amount+' '+total_fee);
					var total_project_price_new=parseFloat(amount)+parseFloat(total_fee);
					$('#bid_amount').val(parseFloat(total_project_price_new).toFixed(2));
				}else{
					var amount=parseFloat($('#bid_amount').val());
					if(isNaN(amount)){
						amount=0;
					}
					total_project_price=amount;
					total_fee=(total_project_price*fee_percent)/100;
					total_recive=parseFloat(total_project_price)-parseFloat(total_fee);
					$('#bid_amount_receive').val(parseFloat(total_recive).toFixed(2));
				}

				$('.total_fee').html(parseFloat(total_fee).toFixed(2));
				
			}else{
				$('.milestone_row_parent .milestone_amount').each(function(){
					var amount=parseFloat($(this).val());
					if(isNaN(amount)){
						amount=0;
					}
					total_project_price=total_project_price+amount;
				});
				total_fee=(total_project_price*fee_percent)/100
				total_recive=parseFloat(total_project_price)-parseFloat(total_fee);
				$('.total_amount').html(parseFloat(total_project_price).toFixed(2));
				$('.total_fee').html(parseFloat(total_fee).toFixed(2));
				$('.total_recive').html(parseFloat(total_recive).toFixed(2));
				$('#bid_amount').val(parseFloat(total_project_price).toFixed(2));
			}
		}
		//console.log(total_project_price+' '+total_fee+' '+total_receive);
	}
	
	var  main = function(){
		$('.datepicker').datetimepicker({
			format: 'YYYY-MM-DD',
			minDate: "<?php echo date('Y-m-d');?>",
		});
		$('.addMilestone').on('click',function(){
			var html='';
			var cnt=$(".milestone_row").last().val();
			var new_row=parseInt(cnt)+1;
			html+='<div class="row milestone_row_parent">';
			html+='<div class="col-sm-6 col-12">';
			html+='<input type="hidden" name="milestone_id[]" class="milestone_row" value="'+new_row+'"/>';
			html+='<div class="form-group">';
			html+='<label for="title"><b>Description</b></label>';
			html+='<input type="text" name="milestone_title_'+new_row+'" id="milestone_title_'+new_row+'" class="form-control">';
			html+='</div>';
			html+='</div>';
			html+='<div class="col-sm-3 col-12">';
			html+='<div class="form-group">';
			html+='<label for="title"><b>Due date</b></label>';
			html+='<input type="text" name="milestone_due_date_'+new_row+'" id="milestone_due_date_'+new_row+'" class="datepicker form-control">';
			html+='</div>';
			html+='</div>';
			html+='<div class="col-sm-3 col-12">';
			html+='<div class="form-group">';
			html+='<label for="title"><b>Amount</b></label>';
			html+='<div class="input-group">';
			html+='<input type="text" name="milestone_amount_'+new_row+'" id="milestone_amount_'+new_row+'" class="milestone_amount form-control" onKeyUp="updateTotal()">';
			html+='<div class="input-group-append ml-3">';
			html+='<button class="text-danger" onclick="removeRow(this)"><i class="icon-feather-x" style="font-size:20px"></i></button>';
			html+='</div>';
			html+='</div>';
			html+='</div>';
			html+='</div>';
			html+='</div>';
			$('#milestone_wrapper').append(html);
			$('.datepicker').datetimepicker({
				format: 'YYYY-MM-DD',
				minDate: "<?php echo date('Y-m-d');?>",
			});
			
		});
		$('.project_payment_type').on('change',function(){
			var project_payment_type=$('.project_payment_type:checked').val();
			if(project_payment_type==1){
				$('.payment_milestone_wrapper').hide();
				$('.payment_project_wrapper').show();
			}else{
				$('.payment_project_wrapper').hide();
				$('.payment_milestone_wrapper').show();
			}
			updateTotal();
		});
		$('.backbtnapply').on('click',function(){
			window.location.href="<?php echo $ProjectDetailsURL;?>";
		});
		$('.nextbtnapply').on('click',function(){
		var buttonsection=$(this);
		var buttonval = buttonsection.html();
		buttonsection.html(SPINNER).attr('disabled','disabled');
		var formID="applyprojectform";
		$.ajax({
	        type: "POST",
	        url: "<?php D(get_link('applyprojectFormCheckAJAXURL'))?>/",
	        data:$('#'+formID).serialize()+'&pid='+pid,
	        dataType: "json",
	        cache: false,
			success: function(msg) {
				buttonsection.html(buttonval).removeAttr('disabled');
				clearErrors();
				if (msg['status'] == 'OK') {
					bootbox.alert({
						title: 'Apply Project',
						message: 'Application successfully sent',
						size: 'small',
						buttons: {
							ok: {
								label: "Ok",
								className: 'btn-site pull-right'
							},
						},
						callback: function(result){
							window.location.href="<?php echo $ProjectDetailsURL;?>";
						}
					});
					
					
				} else if (msg['status'] == 'FAIL') {
					registerFormPostResponse(formID,msg['errors']);
				}
			}
		})		
	});
	}
	var mainload=function(){
		updateTotal();
	}
</script>