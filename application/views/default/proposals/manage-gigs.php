<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$currency=priceSymbol();
?>
<!-- Dashboard Container -->
<div class="dashboard-container">

	<?php echo $left_panel;?>
	<!-- Dashboard Sidebar / End -->


	<!-- Dashboard Content
	================================================== -->
	<div class="dashboard-content-container">
		<div class="dashboard-content-inner" >		
		<?php
        if ($this->session->flashdata('succ_msg')) {
            ?>

        <div class="success alert-success alert text-center"><i class="icon-material-outline-check-circle"></i>&nbsp;<?php echo $this->session->flashdata('succ_msg'); ?></div>
        <?php 
        }
        if ($this->session->flashdata('error_msg')) {
            ?>

        <div class="success alert-danger alert text-center"><i class="icon-material-outline-check-circle"></i>&nbsp;<?php echo $this->session->flashdata('error_msg'); ?></div>
        <?php 
        }
        ?>
        <div class="dashboard-box margin-top-0">
            <!-- Headline -->
            <div class="headline">
                <h3><?php echo __('proposals_Manage_Catalog','Manage Catalog');?></h3>
            </div>
            <div class="content">
                <ul class="dashboard-box-list">
                    <?php 
                    if($proposals){
                        foreach($proposals as $key => $proposal){ 
                            $edit_url=get_link('editproposalURL').'/'.md5($proposal['proposal_id']).'/'.md5('UPW'.'-'.date("Y-m-d").'-'.md5($proposal['proposal_id']));
			                $details_url=get_link('myProposalDetailsURL').'/'.$proposal['proposal_url'];
                    ?>
                     <li>
                    <!-- Job Listing -->
                    <div class="job-listing">
                        <!-- Job Listing Details -->
                        <div class="job-listing-details">
                            <!-- Details -->
                            <div class="job-listing-description">
                                <h4 class="job-listing-title"><a href="<?php echo $details_url; ?>"><?php echo $proposal['proposal_title']; ?></a></h4>
    
                                <!-- Job Listing Footer -->              
                                <div class="job-listing-footer">
                                    <ul>
                                        <li><i class="icon-feather-hash"></i> <?php echo $proposal['proposal_id']; ?></li>
                                        <li>Sale price: <?php echo CURRENCY. $proposal['display_price']; ?>

                                        </li>                                     
                                       
                                        <li><!--Status:-->                                       
                                            <?php
                                            switch($proposal['proposal_status']){
                                                case PROPOSAL_PENDING : 
                                                echo '<span class="dashboard-status-button yellow">Pending</span>';
                                                break;
                                                case PROPOSAL_PAUSED : 
                                                    echo '<span class="dashboard-status-button blue">Pause</span>';
                                                break;
                                                case PROPOSAL_DECLINED : 
                                                    echo '<span class="dashboard-status-button red">Pending</span>';
                                                break;
                                                case PROPOSAL_MODIFICATION :
                                                echo '<span class="dashboard-status-button red">Modification</span>';
                                                break;
                                                case PROPOSAL_ACTIVE:
                                                echo '<span class="dashboard-status-button green">Active</span>';
                                                break;
                                            }
                                            ?>					
                                        </li>   
                                        <?php if($proposal['proposal_featured'] == 1 && $proposal['featured_end_date']>=date('Y-m-d H:i:s')){ ?>
                                        <li><?php echo (__('manage_proposal_page_action_Already_Featured','Featured'));?> till <?php echo (dateFormat($proposal['featured_end_date'],'F d,Y').' '.date('H:i',strtotime($proposal['featured_end_date']))); ?></li>
                                        <?php }?>      
                                        <?php if($proposal['proposal_status'] == PROPOSAL_MODIFICATION || $proposal['proposal_status'] == PROPOSAL_DECLINED){ ?>
                                        <li><?php if($proposal['admin_reason']){?><a href="<?php echo VZ;?>" data-tippy-placement="top" data-html="true"  title="<?php echo (nl2br($proposal['admin_reason']));?>"><i class="icon-feather-info"></i></a><?php }?></li>
                                        <?php }?>                                 
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Buttons -->
                    <div class="buttons-to-right single-right-button always-visible">
                    <?php if($proposal['proposal_featured'] == 1 && $proposal['featured_end_date']>=date('Y-m-d H:i:s')){

                    }
                    elseif($proposal['proposal_status']==PROPOSAL_ACTIVE){ ?>
                    <a href="javascript:void(0)" onclick="doAction('makefeature','<?php echo $proposal['proposal_id']; ?>',this)" class="btn btn-sm btn-outline-success  ico" title="Make Featured" data-tippy-placement="left"><i class="icon-feather-star"></i></a>
                    <?php }?>
                    <?php if($proposal['proposal_status']==PROPOSAL_PAUSED){?> 
                    <a href="javascript:void(0)" onclick="doAction('active','<?php echo $proposal['proposal_id']; ?>',this)" class="btn btn-sm btn-outline-success  ico" title="pause" data-tippy-placement="left"><i class="icon-feather-play"></i></a>
                    <?php }?>  
                   <?php if($proposal['proposal_status']==PROPOSAL_ACTIVE){?>
                   <a href="javascript:void(0)" onclick="doAction('pause','<?php echo $proposal['proposal_id']; ?>',this)" class="btn btn-sm btn-outline-warning  ico" title="Active" data-tippy-placement="left"><i class="icon-feather-pause"></i></a>                  
                    <?php }?>  
                        <a href="<?php echo $edit_url;?>" class="btn btn-sm btn-outline-site ico" title="Edit" data-tippy-placement="left"><i class="icon-feather-edit-2"></i></a>
                        <a href="<?php echo $details_url;?>" class="btn btn-sm btn-outline-site ico" title="View" data-tippy-placement="left"><i class="icon-feather-eye"></i></a>
                        <a href="javascript:void(0)" onclick="doAction('delete','<?php echo $proposal['proposal_id']; ?>',this)" class="btn btn-sm btn-outline-danger  ico" title="Delete" data-tippy-placement="left"><i class="icon-feather-trash"></i></a>                    
                    </div>
                </li>
                    <?php 
                    } 
                }else{ 
                    ?>
                    <li><?php echo __('contract_list_no_recoard','No record found');?></li>
                    <?php }?>        
                </ul>                                
            </div>            
        </div>	
		<?php echo $links; ?>
		</div>
	</div>
	<!-- Dashboard Content / End -->

</div>
<!-- Dashboard Container / End -->
<div id="featured-proposal-modal"></div>
<script type="text/javascript">
var SPINNER='<span class="spinner-border spinner-border-sm"></span>';
function doAction(type,proposal_id,ev){
	if(type=='makefeature'){
		$.ajax({
		  	method: "POST",
		 	url: "<?php echo (get_link('actionproposalPayfeatureURLAJAX'))?>",
		 	data: {proposal_id: proposal_id }
		}).done(function(data){
			$("#featured-proposal-modal").html(data);		
		});
		return false;
	}else{
        $(ev).html(SPINNER);
        var url="<?php echo (get_link('actionproposalCheckAjax'))?>";
        $.ajax({
            type: "POST",
            url: url,
            data:{action:type,rid:proposal_id},
            dataType: "json",
            cache: false,
            success: function(msg) {
                setTimeout(function(){
                if (msg['status'] == 'OK') {
                    window.location.reload();
                }else{
                    window.location.reload();
                }
                },1000);
            }
        })
    }
}
</script>