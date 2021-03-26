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
$new_contract_url='#';
$contract_details_url=base_url('dispute/details/'.$contractDetails->contract_milestone_id);
$contract_message_url=base_url('dispute/message/'.$contractDetails->contract_milestone_id);
$ProjectDetailsURL='#';
$offer_details_url='#';
$application_link='#';
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
        <h1>Contract: <?php echo $contractDetails->contract_title;?> <a href="<?php echo base_url('offers/contracts')?>?contract_id=<?php echo $contractDetails->contract_id;?>" target="_blank"><i class="icon-feather-external-link"></i></a></h1>
        <h2>Milestone: <?php echo $contractDetails->milestone_title;?></h2>
        <ul class="nav nav-tabs mb-3">
          <li class="nav-item"> <a class="nav-link active" href="<?php echo $contract_details_url;?>">Submission</a> </li>
          <li class="nav-item"> <a class="nav-link " href="<?php echo $contract_message_url;?>">Messages & Files</a> </li>
        </ul>
        <div class="row">
          <div class="col-lg-12">
			 <div class="card mb-4">
              <div class="card-header">
                <h4>Client details</h4>
                <?php 
                  $logo = getMemberLogo($contractDetails->owner->member_id);
                ?>
                <p class="mb-0"><a href="<?php echo base_url('member/list_record'); ?>?member_id=<?php echo $contractDetails->owner->member_id;?>" target="_blank"><img src="<?php echo $logo;?>" class="rounded-circle mr-2" alt="User Image" height="32" width="32" /><?php echo $contractDetails->owner->member_name;?></a></p>
                <h4>Freelancer details</h4>
                <?php 
                  $logo = getMemberLogo($contractDetails->contractor->member_id);
                ?>
                <p class="mb-0"><a href="<?php echo base_url('member/list_record'); ?>?member_id=<?php echo $contractDetails->owner->member_id;?>" target="_blank"><img src="<?php echo $logo;?>" class="rounded-circle mr-2" alt="User Image" height="32" width="32" /><?php echo $contractDetails->contractor->member_name;?></a></p>
              
              </div>
             
            </div>
            
         
		  <div class="row mt-4">
    <!--- 3 row Starts --->
    <div class="col-lg-12">
<?php if($contractDetails->submission){?>
		<ul class="timeline">
		<?php
	foreach($contractDetails->submission as $k=>$conversation){
		//print_r($conversation);
		/*$status=$conversation->status;*/
		$sender_user_name=$conversation->sender_name;
				  ?>
<!-- timeline time label -->
<!-- <li class="time-label">
	<span class="bg-red">
		<?php echo date('d M, Y',strtotime($conversation->submission_date)); ?>
	</span>
</li> -->
<!-- /.timeline-label -->

<!-- timeline item -->
<li>
	<!-- timeline icon -->
	<i class="fa fa-comments bg-yellow"></i>
	<div class="timeline-item">
		<span class="time"><i class="fa fa-clock-o"></i> <?php echo date('d M,Y H:i:s',strtotime($conversation->submission_date)); ?></span>

		<h3 class="timeline-header">
    <a  href="<?php echo base_url('member/list_record'); ?>?member_id=<?php echo $conversation->sender_id;?>" target="_blank"><img height="32" src="<?php echo getMemberLogo($conversation->sender_id); ?>" class="img-responsive message-image"> <?php echo $sender_user_name; ?></a> 
    
    <?php if($conversation->is_approved==1){?>
        <span class="badge badge-success">Approved</span>
        <?php } elseif($conversation->is_approved==2){?>
        <span class="badge badge-danger">Rejected</span>
        <?php 
        }else{?>
        <span class="badge badge-warning">Pending</span>
        <?php	 }?>
    </h3>

		<div class="timeline-body">
		<p><?php echo html_entity_decode($conversation->submission_description); ?></p>
    <?php 
if(!empty($conversation->submission_attachment)){ 
?>
    <?php
  $files=json_decode($conversation->submission_attachment);
  if($files){
    foreach($files as $f=>$file){
      
    
  ?>
		<a href="<?php echo UPLOAD_HTTP_PATH.'projects-files/dispute-submission/'.$file->file;?>" download>
	<i class="fa fa-download"></i> <?php echo $file->name; ?>
		</a>
    <?php
    }
  }
    ?>
    <?php }?>
    <ul class="totalList mb-3">
        <li><b>Total</b> <span ><?php echo $currency;?><?php echo $contractDetails->milestone_amount;?></span></li>
        <li><b>Commission</b> <span ><?php echo $currency;?><?php echo $conversation->commission_amount;?></span></li>
        <li><b>To Client</b> <span ><?php echo $currency;?><?php echo $conversation->owner_amount;?></span></li>
        <li><b>To Freelancer</b> <span ><?php echo $currency;?><?php echo $conversation->contractor_amount;?></span></li>
      </ul>
		</div>
	</div>
</li>



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
