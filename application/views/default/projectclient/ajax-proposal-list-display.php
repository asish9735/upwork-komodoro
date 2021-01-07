<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//dd($all_data,TRUE);
?>

<!-- Dashboard Box -->
<div class="dashboard-box margin-top-0">
<div class="content">
<?php if($all_data){?>
    <ul class="dashboard-box-list if-button">
    <?php foreach($all_data as $k=>$bid){
    	//get_print($bid,true);
    $logo=getMemberLogo($bid->member_id);
    $profile_link=get_link('viewprofileURL')."/".$bid->member_id;
    $application_link=get_link('viewapplicationURLAJAX')."/".$projects['project_id'].'/'.$bid->bid_id;
    ?>
        <li class="application-list dfd-" id="application-id-<?php echo $bid->bid_id;?>" data-id="<?php echo $bid->bid_id;?>" data-pid="<?php echo md5($projects['project_id']);?>" data-mid="<?php echo md5($bid->member_id);?>">
            <!-- Overview -->
            <?php if($bid->is_hired==1){?>
            <div class="ribbon ribbon-top-right"><span class="bg-success">Hired</span></div>
            <?php }?>
            	<div class="freelancer-overview">
                <div class="freelancer-overview-inner">
					
                    <!-- Avatar -->
                    <div class="freelancer-avatar">
                        <div class="verified-badge"></div>
                        <a data-href="<?php echo $application_link;?>" href="<?php D(VZ);?>" data-btn="application-dtl" class="proposal-btn"><img src="<?php D($logo);?>" alt=""></a>
                    </div>
					
                    <!-- Name -->
                    <div class="freelancer-name">
                        <h4><a data-href="<?php echo $application_link;?>" href="<?php D(VZ);?>" data-btn="application-dtl" class="proposal-btn"><?php D($bid->member_name);?> </a> </h4>

                        <!-- Details -->
                        <span class="freelancer-detail-item"> <?php D($bid->member_heading);?></span>
                        <p class="margin-bottom-10">Rating: <?php D($bid->avg_review);?><?php if($projects['project_settings']->is_hourly){}else{?>  | Delivery Time: <?php D(getAllBidDuration($bid->bid_duration));?><?php }?></p>

                        <!-- Rating -->
                        <div class="freelancer-rating d-none">
                            <div class="star-rating" data-rating="<?php D(round($bid->avg_review,1));?>"></div>
                        </div>

                        <!-- Bid Details -->
                        <ul class="dashboard-task-info bid-info d-none">
                            <li><strong><?php D(priceSymbol().priceFormat($bid->bid_amount));?><?php if($projects['project_settings']->is_hourly){D('/Hr');}?></strong><span><?php if($projects['project_settings']->is_hourly){D('Hourly Price');}else{D('Fixed Price');}?></span></li>
                            <li><strong><?php D($bid->bid_duration);?> Days</strong><span>Delivery Time</span></li>
                            <li><strong><?php D(priceSymbol().priceFormat($bid->totalearn));?></strong><span>Total Earn</span></li>
                        </ul>
                    </div>
                    </div>
                </div>
                <div class="freelancer-details p-0">
                	<div class="freelancer-details-list">
                        <ul>
                            <li>Location <strong><img class="flag" src="<?php echo IMAGE;?>flags/<?php D(strtolower($bid->country_info->country_code_short));?>.svg" alt="" width="20" title="<?php D($bid->country_info->country_name);?>" data-tippy-placement="top"> <?php D($bid->country_info->country_name);?></strong> </li>
                            <li>
                            <?php if($projects['project_settings']->is_hourly){?>
                             Rate <strong><?php D(priceSymbol().priceFormat($bid->bid_amount));?> / hr</strong>
                            <?php }else{?>
                             Bid <strong><?php D(priceSymbol().priceFormat($bid->bid_amount));?></strong>
                            <?php }?>
                           </li>
                            <li>Earned <strong><?php D(priceSymbol().priceFormat($bid->totalearn));?></strong></li>
                            <li>
                            <p class="mb-2"><?php echo $bid->success_rate;?>% Job Success</p>
                            <div class="progress" style="max-width:200px; height:6px">
              <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: <?php echo $bid->success_rate;?>%" aria-valuenow="<?php echo $bid->success_rate;?>" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="freelancer-actions">
                    <!-- Buttons -->
                    <div class=" always-visible margin-bottom-0">
<a data-href="<?php echo $application_link;?>" data-btn="application-dtl" href="<?php D(VZ);?>" class="proposal-btn btn btn-outline-site btn-sm mr-1 mb-2"><i class="icon-feather-file"></i> Proposal</a>	
<?php if($req_type=='proposal'){?>	
<?php if($bid->is_shortlisted==1){?>
<a href="<?php D(VZ);?>" class="btn btn-outline-site btn-sm mr-1 mb-2 disabled"><i class="icon-feather-star"></i> Shortlisted</a>
<?php }else{?>
<a href="<?php D(VZ);?>" data-btn="shortlisted-btn" class="proposal-btn btn btn-outline-site btn-sm mr-1 mb-2"><i class="icon-feather-star"></i> Shortlist</a>
<?php }?>
<?php if($bid->is_interview==1){?>
<a href="<?php D(VZ);?>" class="btn btn-outline-site btn-sm mr-1 mb-2 disabled"><i class="icon-feather-phone"></i> Interview</a>
<?php }else{?>
<a href="<?php D(VZ);?>" data-btn="interview-btn" class="proposal-btn btn btn-outline-site btn-sm mr-1 mb-2"><i class="icon-feather-phone"></i> Interview</a>
<?php }?>
<a href="<?php D(VZ);?>" data-btn="archive-btn" class="proposal-btn btn btn-outline-danger btn-sm mr-1 mb-2" title="Remove Bid" data-tippy-placement="top"><i class="icon-feather-trash"></i> Archive</a>
<!--<a href="<?php D(VZ);?>" data-btn="message-btn" class="proposal-btn  button dark mr-1 mb-2"><i class="icon-feather-mail"></i> Message</a>
-->
<?php if($bid->is_hired==1){?>
<a href="<?php D(VZ);?>" data-btn="hire-btn"  class="proposal-btn btn btn-outline-site btn-sm mr-1 mb-2"><i class="icon-material-outline-check"></i> Send Offer</a>
<?php }else{?>
<a href="<?php D(VZ);?>" data-btn="hire-btn"  class="proposal-btn btn btn-outline-success btn-sm mr-1 mb-2"><i class="icon-material-outline-check"></i> Hire</a>
<?php }?>
<?php }elseif($req_type=='archive'){?>
<a href="<?php D(VZ);?>" data-btn="unarchive-btn" class="proposal-btn btn btn-outline-danger btn-sm mr-1 mb-2" title="Remove Bid" data-tippy-placement="top"><i class="icon-feather-trash"></i> Unarchive</a>
<?php }elseif($req_type=='interview'){?>
<a href="<?php D(VZ);?>" data-btn="archive-btn" class="proposal-btn btn btn-outline-danger btn-sm mr-1 mb-2" title="Remove Bid" data-tippy-placement="top"><i class="icon-feather-trash"></i> Archive</a>
<!--<a href="<?php D(VZ);?>" data-btn="message-btnn" class="proposal-btn popup-with-zoom-anim button dark mr-1 mb-2"><i class="icon-feather-mail"></i> Message</a>-->
<a href="<?php D(VZ);?>" data-btn="hire-btn" class="proposal-btn popup-with-zoom-anim btn btn-outline-site btn-sm mr-1 mb-2"><i class="icon-material-outline-check"></i> Hire</a>
<?php }elseif($req_type=='shortlisted'){?>
<!--<a href="<?php D(VZ);?>" class="button green mr-1 mb-2 disabled"><i class="icon-feather-star"></i> Shortlisted</a>-->
<?php if($bid->is_interview==1){?>
<a href="<?php D(VZ);?>" class="button btn btn-outline-success mr-1 mb-2 disabled"><i class="icon-feather-phone"></i> Interview</a>
<?php }else{?>
<a href="<?php D(VZ);?>" data-btn="interview-btn" class="proposal-btn btn btn-outline-site btn-sm mr-1 mb-2"><i class="icon-feather-phone"></i> Interview</a>
<?php }?>
<a href="<?php D(VZ);?>" data-btn="archive-btn" class="proposal-btn btn btn-outline-danger btn-sm mr-1 mb-2" title="Remove Bid" data-tippy-placement="top"><i class="icon-feather-trash"></i> Archive</a>
<!--<a href="<?php D(VZ);?>" data-btn="message-btnn" class="proposal-btn popup-with-zoom-anim button dark mr-1 mb-2"><i class="icon-feather-mail"></i> Message</a>-->
<a href="<?php D(VZ);?>" data-btn="hire-btn" class="proposal-btn popup-with-zoom-anim btn btn-outline-success btn-sm mr-1 mb-2"><i class="icon-material-outline-check"></i> Hire</a>
<?php }elseif($req_type=='hired'){?>
<!--<a href="<?php D(VZ);?>" data-btn="message-btnn" class="proposal-btn popup-with-zoom-anim button dark mr-1 mb-2"><i class="icon-feather-mail"></i> Message</a>-->
<a href="<?php D(VZ);?>" data-btn="hire-btn"  class="proposal-btn btn btn-outline-site btn-sm mr-1 mb-2"><i class="icon-material-outline-check"></i> Send Offer</a>
<?php }?>
<a href="<?php D(VZ);?>" data-btn="message-btn" class="proposal-btn btn btn-outline-site btn-sm mr-1 mb-2"><i class="icon-feather-mail"></i> Message</a>
                        
                    </div>
                	<p class="mb-0"><?php 
                	$cover_details=trim(strip_tags($bid->bid_details));
                	echo substr($cover_details,0,100);
                	?></p>
                </div>                                            
        </li>
    <?php }?>
    </ul>
<?php }else{?>
<div class="not-found">No record found</div>
<?php }?>
</div>
</div>
<script>
	$('.proposal-btn').click(function(){
		var section=$(this);
		var btn= section.attr('data-btn');
		var application_id=section.closest('.application-list').attr('data-id');
		var pid=section.closest('.application-list').attr('data-pid');
		var mid=section.closest('.application-list').attr('data-mid');
		if(btn=='application-dtl'){
			var application_url=section.attr('data-href');
			view_application(application_url);
		}else if(btn=='shortlisted-btn'){
			make_shortlist(application_id,section);
		}else if(btn=='unarchive-btn'){
			remove_archive(application_id,section);
		}else if(btn=='archive-btn'){
			make_archive(application_id,section);
		}else if(btn=='message-btn'){
			send_message(pid,mid);
		}else if(btn=='interview-btn'){
			make_interview(application_id,section);
		}else if(btn=='hire-btn'){
			make_hire(pid,mid);
		}
		//alert(btn);
	})
function view_application(application_url){
	var redirectWindow = window.open(application_url, '_blank');
    redirectWindow.location;
	/*$('#myModal').modal('show');
	$.get( application_url,{}, function( data ) {
			setTimeout(function(){ $( "#myModal .mycustom-modal").html( data );},1000)
	});*/
}
function make_shortlist(application_id,section){
	var formtype="shortlist";
	var buttonsection=section;
	var buttonval = buttonsection.html();
	buttonsection.html(SPINNER).attr('disabled','disabled');
	$.post( "<?php echo get_link('myProjectBidsClientStatusAjaxURL');?>",{'formtype':formtype,'project_id':"<?php D($projects['project_id']);?>",'application_id':application_id}, function( data ) {
		load_count(<?php D($projects['project_id']);?>)
		buttonsection.html(buttonval.replace('Shortlist','Shortlisted')).removeAttr('disabled');
		buttonsection.removeClass('dark').addClass('green disabled');	
	});
}
function make_interview(application_id,section){
	var formtype="interview";
	var buttonsection=section;
	var buttonval = buttonsection.html();
	buttonsection.html(SPINNER).attr('disabled','disabled');
	$.post( "<?php echo get_link('myProjectBidsClientStatusAjaxURL');?>",{'formtype':formtype,'project_id':"<?php D($projects['project_id']);?>",'application_id':application_id}, function( data ) {
		load_count(<?php D($projects['project_id']);?>)
		buttonsection.html(buttonval.replace('Interview','Interview')).removeAttr('disabled');
		buttonsection.removeClass('dark').addClass('green disabled');	
	});
}
function make_archive(application_id,section){
	var formtype="archive";
	var buttonsection=section;
	var buttonval = buttonsection.html();
	buttonsection.html(SPINNER).attr('disabled','disabled');
	$.post( "<?php echo get_link('myProjectBidsClientStatusAjaxURL');?>",{'formtype':formtype,'project_id':"<?php D($projects['project_id']);?>",'application_id':application_id}, function( data ) {
		load_count(<?php D($projects['project_id']);?>)
		buttonsection.html(buttonval.replace('Archive','Archived')).removeAttr('disabled');
		$('#application-id-'+application_id).slideUp('slow');	
	});
}
function remove_archive(application_id,section){
	var formtype="unarchive";
	var buttonsection=section;
	var buttonval = buttonsection.html();
	buttonsection.html(SPINNER).attr('disabled','disabled');
	$.post( "<?php echo get_link('myProjectBidsClientStatusAjaxURL');?>",{'formtype':formtype,'project_id':"<?php D($projects['project_id']);?>",'application_id':application_id}, function( data ) {
		load_count(<?php D($projects['project_id']);?>)
		buttonsection.html(buttonval.replace('Unarchive','Unarchived')).removeAttr('disabled');
		$('#application-id-'+application_id).slideUp('slow');	
	});
}
function send_message(pid,mid){
var redirectWindow = window.open("<?php echo get_link('CreateMessageRoomURL');?>/"+pid+"/"+mid, '_blank');
    redirectWindow.location;
}
function make_hire(pid,mid){
	var redirectWindow = window.open("<?php echo get_link('HireProjectURL');?>/"+pid+"/"+mid, '_blank');
    redirectWindow.location;
}
</script>