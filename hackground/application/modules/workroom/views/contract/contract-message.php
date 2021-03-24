<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$currency=priceSymbol();
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
$contract_details_url=base_url('workroom/details/'.md5($contractDetails->contract_id));
$contract_worklog_url=base_url('workroom/worklog/'.md5($contractDetails->contract_id));
$contract_invoice_url=base_url('workroom/invoice/'.md5($contractDetails->contract_id));
$contract_message_url=base_url('workroom/message/'.md5($contractDetails->contract_id));
$contract_term_url=base_url('workroom/contract_term/'.md5($contractDetails->contract_id));
?>
<style>
.panel {
    background-color: #fff;
}
.panel-body {
    padding: 1.333rem;
}
ul.totalList {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
    /* align-items: center; */
    align-content: center;
    text-align: center;
    background-color: #fff;
    margin-bottom: 0;
    overflow: hidden;
}
ul.totalList > li {
    flex: 1;
    border-right: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
    margin-bottom: -1px;
    padding: 1rem;
}
ul.totalList > li > span {
    display: block;
    margin-top: 0.5rem;
}
.relative {
    position: relative;
}

.panel-header {
    border-bottom: 1px solid #ddd;
    padding: 1rem 1.333rem;
}
.toggleUD {
    font-size: 2rem;
    position: absolute;
    top: 10px;
    right: 15px;
    line-height: 0;
}
.number {
    position: absolute;
    left: 1.25rem;
    top: 0.75rem;
}
.milestone-item {
    padding-left: 1.25rem;
}
</style>
<div class="content-wrapper">
<section class="content-header">
      <h1>
         <?php echo $main_title ? $main_title : '';?>
        <small><?php echo $second_title ? $second_title : '';?></small>
      </h1>
     <?php echo $breadcrumb ? $breadcrumb : '';?>
    </section>
	
<section class="content">
<div class="">
        <h1><?php echo $contractDetails->contract_title;?></h1>
		<ul class="nav nav-tabs mb-3">
		<li class="nav-item"> <a class="nav-link " href="<?php echo $contract_details_url;?>">Overview</a> </li>
		<li class="nav-item"> <a class="nav-link " href="<?php echo $contract_worklog_url;?>">Work Logs</a> </li>
		<li class="nav-item"> <a class="nav-link " href="<?php echo $contract_invoice_url;?>">Invoices</a> </li>
		<li class="nav-item"> <a class="nav-link active" href="<?php echo $contract_message_url;?>">Messages & Files</a> </li>
		<li class="nav-item"> <a class="nav-link" href="<?php echo $contract_term_url;?>">Terms & Settings</a> </li>
		</ul>
        <div class="row">
          <div class="col-lg-12">
			 <div class="card mb-4">
              <div class="card-header">
                <h4>Message Group</h4>
				<?php 
			if($conversation_details->group) {
				foreach($conversation_details->group as $g=>$member){
					$logo = getMemberLogo($member->user_id);
					?>
					<p class="mb-0"><a href="<?php echo base_url('member/list_record'); ?>?member_id=<?php echo $member->user_id;?>" target="_blank"><img src="<?php echo $logo;?>" class="rounded-circle mr-2" alt="User Image" height="32" width="32" /><?php echo $member->member_name;?></a></p>
					<?php
				}
			}
			?>
              </div>
             
            </div>
            
         
		  <div class="row mt-4">
    <!--- 3 row Starts --->
    <div class="col-lg-12">
<?php if($conversation_details->conversations){?>
		<ul class="timeline">
		<?php
	foreach($conversation_details->conversations as $k=>$conversation){
		//print_r($conversation);
		/*$status=$conversation->status;*/
		$sender_user_name=$conversation->sender_name;
				  ?>
<!-- timeline time label -->
<!-- <li class="time-label">
	<span class="bg-red">
		<?php echo date('d M, Y',strtotime($conversation->sending_date)); ?>
	</span>
</li> -->
<!-- /.timeline-label -->
<?php 
if(!empty($conversation->attachment)){ 
$file=json_decode($conversation->attachment);
$is_image=false;
if($file->is_image){
	$is_image=true;
}
?>

<li>
	<!-- timeline icon -->
	<?php if($is_image){?>
	<i class="fa fa-camera bg-purple"></i>
	<?php }else{?>
		<i class="fa fa-file bg-purple"></i>
	<?php }?>
	<div class="timeline-item">
		<span class="time"><i class="fa fa-clock-o"></i> <?php echo date('d M, Y H:i:s',strtotime($conversation->sending_date)); ?></span>

		<h3 class="timeline-header"><a  href="<?php echo base_url('member/list_record'); ?>?member_id=<?php echo $conversation->sender_id;?>" target="_blank"><img height="32" src="<?php echo getMemberLogo($conversation->sender_id); ?>" class="img-responsive message-image"> <?php echo $sender_user_name; ?></a> <?php if($conversation->is_edited){?> edited the message<?php }?></h3>

		<div class="timeline-body">
		<a href="<?php echo UPLOAD_HTTP_PATH.'message-files/'.$file->file_name;?>" download>
		<?php 
		if($is_image){
		?>
		<img src="<?php echo UPLOAD_HTTP_PATH.'message-files/'.$file->file_name;?>" alt="<?php echo $file->org_file_name?>" class="margin">
		<?php }else{?>
             <i class="fa fa-download"></i> <?php echo $file->org_file_name; ?>
                           
		<?php }?>
		</a>
		</div>
	</div>
</li>
<?php }else{?>
<!-- timeline item -->
<li>
	<!-- timeline icon -->
	<i class="fa fa-comments bg-yellow"></i>
	<div class="timeline-item">
		<span class="time"><i class="fa fa-clock-o"></i> <?php echo date('d M,Y H:i:s',strtotime($conversation->sending_date)); ?></span>

		<h3 class="timeline-header"><a  href="<?php echo base_url('member/list_record'); ?>?member_id=<?php echo $conversation->sender_id;?>" target="_blank"><img height="32" src="<?php echo getMemberLogo($conversation->sender_id); ?>" class="img-responsive message-image"> <?php echo $sender_user_name; ?></a> <?php if($conversation->is_edited){?> edited the message<?php }?></h3>

		<div class="timeline-body">
		<?php echo html_entity_decode($conversation->message); ?>
		</div>
	</div>
</li>
<?php }?>
<?php if($conversation->is_edited){
	if($conversation->edited){
	foreach($conversation->edited as $edited){
	?>
<li style="padding-left:30px">
	<!-- timeline icon -->
	<div class="timeline-item">
		<span class="time"><i class="fa fa-clock-o"></i> <?php echo date('d M,Y H:i:s',strtotime($edited->edit_date)); ?></span>

		<h3 class="timeline-header"><a  href="<?php echo base_url('member/list_record'); ?>?member_id=<?php echo $conversation->sender_id;?>" target="_blank"><img height="32" src="<?php echo getMemberLogo($conversation->sender_id); ?>" class="img-responsive message-image"> <?php echo $sender_user_name; ?></a></h3>

		<div class="timeline-body">
		<?php echo html_entity_decode($edited->message_org); ?>
		</div>
	</div>
</li>
<?php } }}?>
<?php if($conversation->is_deleted){?>
	<li style="padding-left:30px">
	<i class="fa fa-trash bg-red"></i>

	<div class="timeline-item">
	<span class="time"><i class="fa fa-clock-o"></i> <?php echo date('d M, Y H:i:s',strtotime($conversation->is_deleted)); ?></span>
	<h3 class="timeline-header  no-border"><a  href="<?php echo base_url('member/list_record'); ?>?member_id=<?php echo $conversation->sender_id;?>" target="_blank"><img height="32" src="<?php echo getMemberLogo($conversation->sender_id); ?>" class="img-responsive message-image"> <?php echo $sender_user_name; ?></a> deleted this message</h3>
	</div>
    </li>
<?php }?>
<!-- END timeline item -->
<?php
	}
?>

</ul>
<?php }?>
</div>
</div>

</div>		
        </div>
      </div>
</section>      
 </div>
