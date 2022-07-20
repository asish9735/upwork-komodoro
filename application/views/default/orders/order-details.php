<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->currentlang=$this->config->config['language'];;
/*echo '<div style="display:none">';
dd($orderDetails,TRUE);
echo '</div>';*/
$orderStatus=array(
'1'=>__('global_Order_Status_Pending','Pending'),
'2'=>__('global_Order_Status_Progress','Progress'),
'3'=>__('global_Order_Status_Revision','Revision requested'),
'4'=>__('global_Order_Status_Cancellation','Cancellation requested'),
'5'=>__('global_Order_Status_Cancelled','Cancelled'),
'6'=>__('global_Order_Status_Delivered','Delivered'),
'7'=>__('global_Order_Status_Completed','Completed'),
);
//$comission_percentage=getComissionPercentage($orderDetails->seller_id);
//$comission_percentage=get_option_value('comission_percentage');
//$commission=($comission_percentage / 100 ) * $orderDetails->order_price;
$proposal_image=UPLOAD_HTTP_PATH.'proposals-files/proposals-thumb/'.$orderDetails->proposal_image;
?>
<section class="section">
<div class="container">	 	
<?php //require_once("orderIncludes/orderDetails.php"); ?>
<?php
if ($this->session->flashdata('succ_msg')) {
    ?>

<div class="success alert-success alert text-center"><i class="icon-material-outline-check-circle"></i>&nbsp;<?php echo $this->session->flashdata('succ_msg'); ?></div>
<?php 
}
?>
<?php
$contract_details_url=get_link('OrderDetailsURL').md5($orderDetails->order_id);
$contract_message_url=get_link('OrderMessageURL').md5($orderDetails->order_id);
$contract_resolution_url=get_link('OrderResolutionCenterURL').md5($orderDetails->order_id);
$contract_term_url=get_link('OrderTermURL').md5($orderDetails->order_id);
?>

<div class="order-page">
        <h1><?php echo $orderDetails->proposal_title;?></h1>
        <ul class="nav nav-tabs mb-3">
          <li class="nav-item"> <a class="nav-link active" href="<?php echo $contract_details_url;?>"><?php echo (__('order_details_page_Order_Activity',"Order Activity"));?></a> </li>
          <li class="nav-item"> <a class="nav-link" href="<?php echo $contract_message_url;?>"><?php echo __('contract_details_mesage','Messages & Files');?></a> </li>
          <?php if($orderDetails->order_status == ORDER_PENDING or $orderDetails->order_status == ORDER_PROCESSING or $orderDetails->order_status == ORDER_DELIVERED or $orderDetails->order_status == ORDER_REVISION){ ?>
          <li class="nav-item"> <a class="nav-link" href="<?php echo $contract_resolution_url;?>"><?php echo (__('order_details_page_Resolution_Center',"Resolution Center"));?></a> </li>
          <?php }?>
          <li class="nav-item"> <a class="nav-link" href="<?php echo $contract_term_url;?>"><?php echo __('contract_details_term','Terms & Settings');?></a> </li>
        </ul>
         <!--  <ul class="nav nav-tabs mb-3">
            <li class="nav-item"> <a href="#order-activity" data-toggle="tab" class="nav-link active make-black "> <?php echo (__('order_details_page_Order_Activity',"Order Activity"));?> </a> </li>
            <li class="nav-item"> <a href="#order-buyer_instruction" data-toggle="tab" class="nav-link make-black "> <?php echo (__('order_details_page_Order_requirement',"Requirement"));?> </a> </li>
            <?php if($orderDetails->order_status == ORDER_PENDING or $orderDetails->order_status == ORDER_PROCESSING or $orderDetails->order_status == ORDER_DELIVERED or $orderDetails->order_status == ORDER_REVISION){ ?>
            <li class="nav-item"> <a href="#resolution-center" data-toggle="tab" class="nav-link make-black"> <?php echo (__('order_details_page_Resolution_Center',"Resolution Center"));?> </a> </li>
            <?php } ?>
          </ul> -->
        
    
    <div class="tab-content mt-2 mb-4">



    <div id="order-buyer_instruction" class="tab-pane fade">
   
            <?php if(!empty($orderDetails->buyer_instruction)){ ?>
            <div class="card mb-3 mt-3"><!--- card mb-3 mt-3 Starts --->
              <div class="card-header">
                <h4><?php echo (__('order_details_page_Getting_Started',"Getting Started"));?></h4>
              </div>
              <div class="card-body">

                <div class="user-details align-items-center">
                	 <?php
                    if($orderDetails->seller_id == $loggedInUserId){
                      $is_online=is_online($orderDetails->buyer_id);
                    }elseif($orderDetails->buyer_id == $loggedInUserId){
                      $is_online=is_online($orderDetails->seller_id);
                    }
                  ?>                    
                    <div class="user-avatar <?php if($is_online){ ?>status-online<?php }else{ ?>status-offline<?php } ?>"><img src="<?php echo IMAGE;?>user.png" alt=""></div>
                    <div class="user-name">
                        <p><b class="text-site"><?php /*ucfirst(echo ($orderDetails->seller['member']->member_name));*/ echo ($orderDetails->seller->member_name);?></b> <?php echo (__('order_details_page_requires_information',"requires the following information in order to get started:"));?></p>
                    </div>
                </div>
                <p><?php echo $orderDetails->buyer_instruction; ?></p>
                <?php if($orderDetails->buyer_id == $loggedInUserId){ ?>



                <?php }?>
                
              </div>
            </div>
            <!--- card mb-3 mt-3 Ends --->
            <?php } ?>
          
      </div>
      <div id="order-activity" class="tab-pane fade show active">

            <div class="card">
              <div class="card-body">
                <div class="media">
                  <img src="<?php echo $proposal_image; ?>" alt="" class="img-fluid rounded border me-3 d-md-block d-none" width="128" />
                  <div class="media-body">
                    <?php if($orderDetails->seller_id == $loggedInUserId){ ?>
                    <div class="d-flex align-items-end">
                    <h4><?php echo (__('order_details_page_orderID_number',"Order #"));?><?php echo make_order_number($orderDetails->order_number); ?></h4>
                    <a href="<?php echo get_link('myProposalDetailsURL')."/".$orderDetails->proposal_url; ?>" class="btn btn-site ms-auto" target="_blank"> <?php echo (__('order_details_page_View_Proposal',"View Proposal/Service"));?></a></div>
                    <ul class="item-list">
                        <li>Buyer: 
                      <?php /*ucfirst(echo ($orderDetails->buyer['member']->member_name));*/ echo ($orderDetails->buyer->member_name); ?>
                      </li>
                      <li><i class="icon-feather-calendar"></i> <?php echo (dateFormat($orderDetails->order_date,'F d, Y H:i:s')); ?></li>
                      <li><?php // echo (__('order_details_page_Status',"Status:"));?>  <span class="dashboard-status-button green"><?php echo ($orderStatus[$orderDetails->order_status]);?></span></li>                                               
                    </ul> 
                                         
                    <h3><?php echo (CURRENCY) ; ?><?php echo ($orderDetails->order_price); ?></h3>  
                    <?php }elseif($orderDetails->buyer_id == $loggedInUserId){ ?>
                    
                    <h4><?php  echo $orderDetails->proposal_title; ?></h4>
                    <ul class="item-list">
                        <li><?php echo (__('order_details_page_seller',"Seller:"));?> <a href="<?php echo get_link('viewprofileURL').'/'.$orderDetails->seller_id; ?>" target="_blank" class="seller-buyer-name">
                      <?php /* ucfirst(echo ($orderDetails->seller['member']->member_name));*/ echo ($orderDetails->seller->member_name);?>
                      </a></li>
                        <li><?php echo (__('order_details_page_Order',"Order:"));?> #<?php echo make_order_number($orderDetails->order_number); ?></li>
                        <li><i class="icon-feather-calendar"></i> <?php echo (dateFormat($orderDetails->order_date,'F d, Y H:i:s')); ?></li>
                    </ul>
                    <h3><?php echo (CURRENCY) ; ?><?php echo ($orderDetails->order_price); ?></h3>
                      <?php /* if($orderDetails->order_status == ORDER_COMPLETED){?>
              | 
              <a href="<?php echo (base_url('OrderInvoiceURL').md5($orderDetails->order_id).".pdf")?>" target="_blank" download="download.pdf"><?php echo (__('order_details_page_View_Invoice',"View Invoice"));?></a>
              <?php } */?>
                    <?php } ?>
                  </div>
                </div>
                <div class="d-lg-flex d-md-flex d-none">
                  
                    <table class="table table-bordered mt-3 mb-0">
                      <thead>
                        <tr>
                          <th><?php echo (__('order_details_page_Item',"Item"));?></th>
                          <th><?php echo (__('order_details_page_Quantity',"Quantity"));?></th>
                          <th><?php echo (__('order_details_page_Duration',"Duration"));?></th>
                          <th><?php echo (__('order_details_page_Amount',"Amount"));?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="font-weight-bold" width="600"><?php echo $orderDetails->proposal_title; ?><br>   <small>Package : <?php echo $orderDetails->package_name; ?> </small></td>
                          <td><?php echo ($orderDetails->order_qty); ?></td>
                          <td><?php echo ($orderDetails->delivery_time); ?> <?php echo (__('order_details_page_days',"days"));?></td>
                          <td><?php if($orderDetails->seller_id == $loggedInUserId){ ?>
                            <?php echo (CURRENCY); ?><?php echo ($orderDetails->order_price); ?>
                            <?php }elseif($orderDetails->buyer_id == $loggedInUserId){ ?>
                            <?php echo (CURRENCY); ?><?php echo ($orderDetails->order_price); ?>
                            <?php } ?>
                           
                           
                    
                            </td>
                        </tr>
                        <?php if($orderDetails->buyer_id == $loggedInUserId){  ?>
                        <?php if(!empty($orderDetails->order_fee)){ ?>
                        <tr>
                          <td><?php echo (__('order_details_page_Processing_Fee',"Processing Fee"));?></td>
                          <td></td>
                          <td></td>
                          <td><?php echo (CURRENCY); ?><?php echo ($orderDetails->order_fee) ?></td>
                        </tr>
                        <?php } ?>
                        <?php } ?>
                        <tr>
                          <td colspan="3" align="right"><strong><?php echo (__('order_details_page_Total',"Total :"));?> </strong></td>
                          <td>
                            <?php if($orderDetails->seller_id == $loggedInUserId){ ?>
                            <strong><?php echo (CURRENCY); ?><?php echo ($orderDetails->order_price); ?></strong>
                            <?php }elseif($orderDetails->buyer_id == $loggedInUserId){ ?>
                            <strong><?php echo (CURRENCY); ?><?php echo ($orderDetails->order_price+$orderDetails->order_fee); ?></strong>
                            <?php } ?>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <?php if(!empty($orderDetails->order_description)){ ?>
                    <table class="table">
                      <thead>
                        <tr>
                          <th><?php echo (__('order_details_page_Description',"Description"));?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td width="600"><?php echo ($orderDetails->order_description); ?></td>
                        </tr>
                      </tbody>
                    </table>
                    <?php } ?>
                  
                </div>
              </div>
            </div>
            
            
            <div id="order-conversations" class="mt-3">
              
            </div>
            <?php if($orderDetails->seller_id == $loggedInUserId){ ?>
            <?php if($orderDetails->order_status == ORDER_PROCESSING or $orderDetails->order_status == ORDER_REVISION){ ?>
            <center>
              <button class="btn btn-site mb-3" data-toggle="modal" data-target="#deliver-order-modal"><?php echo (__('order_details_page_Deliver_Order',"Deliver Order"));?> </button>
            </center>
            <?php } ?>
            <?php if($orderDetails->order_status == ORDER_DELIVERED){ ?>
            <center>
              <button class="btn btn-site mb-3" data-toggle="modal" data-target="#deliver-order-modal"><?php echo (__('order_details_page_Deliver_Order_Again',"Deliver Order Again"));?> </button>
            </center>
            <?php } ?>
            <?php } ?>
            
            <?php 
if($orderDetails->order_status == ORDER_PENDING or $orderDetails->order_status == ORDER_PROCESSING or $orderDetails->order_status == ORDER_DELIVERED or $orderDetails->order_status == ORDER_REVISION){ ?>
    <div class="insert-message-box">
<?php if($orderDetails->buyer_id == $loggedInUserId AND $orderDetails->order_status == ORDER_PENDING ){ ?>
        <div class="float-left pt-2">
            <span class="font-weight-bold text-danger"> <?php echo (__('order_details_page_RESPOND_TO_SELLER',"RESPOND SO THAT SELLER CAN START YOUR ORDER."));?> </span>
        </div>
<?php } ?>
    <div class="float-right" hidden="">
 <?php
	if($orderDetails->seller_id == $loggedInUserId){
		$is_online=is_online($orderDetails->buyer_id);
    }elseif($orderDetails->buyer_id == $loggedInUserId){
		$is_online=is_online($orderDetails->seller_id);
	}
?>
                  <p class="text-muted mt-1">
                    <?php if($orderDetails->seller_id == $loggedInUserId){ 
                    	echo ($orderDetails->buyer->member_name);
                    	?> 
                 <span <?php if($is_online){ ?>class="text-success font-weight-bold"<?php }else{ ?>style="color:#868e96; font-weight:bold;"<?php } ?>> is <?php echo (($is_online==1 ? 'online':'offline')); ?> 
                 </span> <!-- | <?php echo (__('order_details_page_Local_Time',"Local Time"));?> -->
                <?php }elseif($orderDetails->buyer_id == $loggedInUserId){ 
                	 echo ($orderDetails->seller->member_name);
                	 ?> 
            		<span <?php if($is_online){ ?>class="text-success font-weight-bold"<?php }else{ ?>style="color:#868e96; font-weight:bold;"<?php } ?>> is <?php echo (($is_online==1 ? __('order_details_page_online','online'):__('order_details_page_offline','offline'))); ?> 
                    </span> 
                    <!-- | <?php echo (__('order_details_page_Local_Time',"Local Time"));?> -->
				 <?php } ?>
				<!-- 	<i class="fa fa-sun-o"></i>  -->
		         <?php 
					//echo (date("h:i A"));
				?>
    			 </p>
    </div>
   
</div>
<div id="message_data_div"></div>
<?php }
 ?>
          
      </div>
      
    </div>
  
</div>

</div>
</section>

<!---modal-->
<?php if($orderDetails->seller_id == $loggedInUserId){ ?>
<div id="deliver-order-modal" class="modal fade"><!--- deliver-order-modal Starts --->
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content mycustom-modal">
			<div class="modal-header">
				<h4 class="modal-title"> <?php echo (__('modal_deliver_order_heading',"Deliver Your Order Now"));?> </h4>
				<button class="close" data-dismiss="modal"> <span>&times;</span> </button>
			</div>
			<div class="modal-body">
				<form method="post" id="deliverorderForm" onsubmit="return performAction(this);return false;">
					<input type="hidden" name="action" value="submit_delivered"/>
					<div class="form-group">
						<label> <?php echo (__('modal_deliver_order_Message',"Message"));?> </label>
						<textarea rows="4" name="delivered_message" id="delivered_message" placeholder="<?php echo (__('modal_deliver_order_Message_input',"Type Your Message Here..."));?>" class="form-control mb-2"></textarea>
					</div>
                    <div class="uploadButton">
                        <input class="uploadButton-input" type="file" accept="image/*, application/pdf" name="delivered_file" id="delivered_file" >
                        <label class="uploadButton-button" for="delivered_file"><?php echo (__('global_Choose_File',"Choose File"));?></label> 
                        <span class="uploadButton-file-name"><i class="icon-feather-info"></i>&nbsp;<?php echo (__('modal_deliver_order_attachment_note',"NB: Maximum size 25MB"));?></span>                 <button type="submit" name="submit_delivered" class="btn btn-site ms-auto saveBTN"><?php echo (__('modal_deliver_Deliver_Order',"Deliver Order"));?></button>
                    </div>
                    
                    <div class="upload_file_div mt-3"></div>
					
				</form>
			</div>
		</div>
	</div>
</div> 
<?php }elseif($orderDetails->buyer_id == $loggedInUserId){ ?>
<div id="revision-request-modal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content mycustom-modal">
        <div class="modal-header">
          <h5 class="modal-title"> <?php echo (__('modal_revision_request_heading',"Submit Your Revision Request Here"));?> </h5>
          <button class="close" data-dismiss="modal"> <span>&times;</span> </button>
        </div>
        <div class="modal-body">
          <form method="post" id="revisionrequestForm" onsubmit="return performAction(this);return false;">
			<input type="hidden" name="action" value="submit_revison"/>
            <div class="form-group">
              <label class="font-weight-bold" > <?php echo (__('modal_revision_request_Message',"Request Message"));?> </label>
              <textarea name="revison_message" id="revison_message" placeholder="<?php echo (__('modal_revision_request_Message_input',"Type Your Message Here..."));?>" class="form-control mb-2"></textarea>
            </div>
            <div class="form-group clearfix">
            <div class="choosefile" style="max-width:125px;">
            <input type="file" name="revison_file" id="revison_file" class="form-control">
            <span class="btn btn-success"><?php echo (__('global_Choose_File',"Choose File"));?></span>
			</div>
            <small class="text-info"><i class="fa fa-info-circle"></i> <?php echo (__('modal_revision_request_attachment_note',"NB: Maximum size 25MB"));?></small>  
              <button type="submit" name="submit_revison" class="btn btn-success float-right saveBTN" style="margin-top: -35px"><?php echo (__('modal_revision_request_Submit_Request',"Submit Request"));?></button>
              <div  style="clear: both"></div>
            <div class="upload_file_div"></div>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>
<?php } ?>

<div id="report-modal" class="modal fade"><!-- report-modal modal fade Starts -->
    <div class="modal-dialog modal-dialog-centered modal-lg"><!-- modal-dialog modal-dialog-centered modal-lg Starts -->
        <div class="modal-content mycustom-modal"><!-- modal-content mycustom-modal Starts -->
            <div class="modal-header p-2 pl-3 pr-3"><!-- modal-header Starts -->
                <?php echo (__('modal_report_heading',"Report This Message"));?>
                <button class="close" data-dismiss="modal">
                    <span> &times; </span>
                </button>
            </div><!-- modal-header Ends -->
            <div class="modal-body"><!-- modal-body p-0 Starts -->
                <h6><?php echo (__('modal_report_text',"Let us know why you would like to report this user?."));?></h6>
                 <form method="post" id="reportrequestForm" onsubmit="return performAction(this);return false;">
                 <input type="hidden" name="action" value="submit_report"/>
                    <div class="form-group mt-3"><!--- form-group Starts --->
                    <select class="form-control float-right" name="reason" id="reason">
                        <option value=""><?php echo (__('modal_report_Select_Reason',"Select Reason"));?></option>
                        <?php if($orderDetails->buyer_id == $loggedInUserId){ ?>
                        <option><?php echo (__('modal_report_Reason_buyer_option_1',"The Seller tried to abuse the rating system."));?></option>
                        <option><?php echo (__('modal_report_Reason_buyer_option_2',"The Seller was using inappropriate language."));?></option>
                        <option><?php echo (__('modal_report_Reason_buyer_option_3',"The Seller delivered something that infringes copyrights"));?></option>
                        <option><?php echo (__('modal_report_Reason_buyer_option_4',"The Seller delivered something partial or insufficient"));?></option>
                        <?php }else{ ?>
                        <option><?php echo (__('modal_report_Reason_seller_option_1',"The Buyer tried to abuse the rating system."));?></option>
                        <option><?php echo (__('modal_report_Reason_seller_option_2',"The Buyer was using inappropriate language."));?></option>
                        <?php } ?>
                    </select>
                    </div><!--- form-group Ends --->
                    <br>
                    <br>
                    <div class="form-group mt-1 mb-3"><!--- form-group Starts --->
                        <label> <?php echo (__('modal_report_Additional_Information',"Additional Information"));?> </label>
                        <textarea name="additional_information" id="additional_information" rows="3" class="form-control" ></textarea>
                    </div><!--- form-group Ends --->
                    <button type="submit" name="submit_report" class="float-right btn btn-sm btn-success saveBTN">
                        <?php echo (__('modal_report_Submit_Report',"Submit Report"));?>
                    </button>
                </form>
               
            </div><!-- modal-body p-0 Ends -->	
        </div><!-- modal-content mycustom-modal Ends -->
    </div><!-- modal-dialog modal-dialog-centered modal-lg Ends -->
</div>
<!-- report-modal modal fade Ends -->

    
<script>
var SPINNER='<span class="spinner-border spinner-border-sm"></span>';
var myVar;
function load_conversation(){
	var order_id = "<?php echo ($orderDetails->order_id)?>";
	$.ajax({
		method: "POST",
		url: "<?php echo (base_url('orders/load_conversation'))?>",
		data: {order_id: order_id},
		success: function(msg) {
			$("#order-conversations").empty();
			$("#order-conversations").append(msg);
			myVar=setTimeout(function(){load_conversation();},3000);
		}
	});
}

function uploadData(id,formID){
	var form_data = new FormData();
	form_data.append("fileinput", document.getElementById(id).files[0]);
	$.ajax({
		url:"<?php echo (base_url('orders/uploadattachment'))?>",
		method:"POST",
		data:form_data,
		contentType:false,
		cache:false,
		dataType:'json',
		processData:false,
		beforeSend:function(){
			$("#"+formID+" .upload_file_div").html(SPINNER);
		},
	}).done(function(data){
		$('#'+id).val('');
		$("#"+formID+" .upload_file_div").empty();
           if(data.status=='OK'){
    			var name = data.upload_response.original_name;
    			$("#"+formID+" .upload_file_div").html('<input type="hidden" name="attachment" value=\''+JSON.stringify(data.upload_response)+'\'/> <p>'+name+'<a href="javascript:void(0)" class="ms-3 text-danger" onclick="$(this).parent().empty()"><i class="icon-feather-trash"></i></a></p>');
		}
	});
}

function performAction(ev){
	var formID=$(ev).attr('id');
	if(formID=='accept_request' || formID=='decline_request'){
		var forminput='action='+formID;
		var buttonsection=$('#'+formID);
	}else{
		var modal=$(ev).closest('.modal');
		var buttonsection=$('#'+formID).find('.saveBTN');
		var forminput=$('#'+formID).serialize();
	}
	var buttonval = buttonsection.html();
	buttonsection.html(SPINNER).attr('disabled','disabled');
	$.ajax({
        type: "POST",
        url: "<?php echo (get_link('OrdersaveActionURLAJAX'))?>/<?php echo ($orderDetails->order_id)?>",
        data:forminput,
        dataType: "json",
        cache: false,
        success: function(msg) {
          buttonsection.html(buttonval).removeAttr('disabled');
          clearErrors();
          if (msg['status'] == 'OK') {
            $(modal).modal('hide');
            var message='<?php echo (__('popup_order_details_action_success',"Your request has been submitted successfully!"));?>';
            if(msg['message']){
              message=msg['message'];
            }
            bootbox.alert({
              title: 'Operation Response',
              message: message,
              size: 'small',
              buttons: {
                ok: {
                  label: "Ok",
                  className: 'btn-site pull-right'
                },
              },
              callback: function () {
                  window.location.href=msg['redirect'];
                }
            })
          } else if (msg['status'] == 'FAIL') {
            registerFormPostResponse(formID,msg['errors']);
          }
        }
	})
	
	return false;
}

   /* $(document).ready(function(){
     $('.rating-select-update').barrating({
           theme: 'fontawesome-stars',
            initialRating: '<?php echo $seller_rating; ?>'
        });
    }); */
var main=function(){
  $(document).on('change','#file', function(ev){
    var id='file';
    var formID='insert-message-form';
    uploadData(id,formID);
  });
  $(document).on('change','#delivered_file', function(ev){
    var id='delivered_file';
    var formID='deliverorderForm';
    uploadData(id,formID);
  });
  $(document).on('change','#revison_file', function(ev){
    var id='revison_file';
    var formID='revisionrequestForm';
    uploadData(id,formID);
  });
  $('#insert-message-form').submit(function(e){
    var formID="insert-message-form";
    var buttonsection=$('#'+formID).find('.saveBTN');
    var buttonval = buttonsection.html();
    buttonsection.html(SPINNER).attr('disabled','disabled');
    e.preventDefault();
    $.ajax({
      method: "POST",
      dataType:'json',
      url: "<?php echo (get_link('OrdersendMessageURL'))?>",
      data:$('#'+formID).serialize()+'&orderid=<?php echo ($orderDetails->order_id)?>',
      success: function(msg){
        buttonsection.html(buttonval).removeAttr('disabled');
        clearErrors();
        if (msg['status'] == 'OK') {
          if(msg['redirect']){
            window.location.href=msg['redirect'];
          }
          $('#messagebox').val("");
          $('#file').val(""); 
          $("#"+formID+" .upload_file_div").empty();
          clearTimeout(myVar);
          load_conversation();
        }else{
          registerFormPostResponse(formID,msg['errors']);
        }
        
      }
    });
  });
  load_conversation();
  $('.rating-select').barrating({
    theme: 'fontawesome-stars'
  });
}
</script>
<?php /*  if(($this->input->get('ref') && $this->input->get('ref')=='paymentsuccess') || ($this->input->get('ref_p') && $this->input->get('ref_p')=='paymentsuccess')){?>
<script>

	swal({
          type: 'success',
          text: '<?php echo (__('popup_order_details_payment_success',"Payment Success"));?>',
          padding: 40,
    }).then(function(){
			window.location.href="<?php echo (base_url('OrderDetailsURL'));?><?php echo ($orderDetails->order_id)?>";
    })
</script>
<?php } */?>
<style>
.choosefile {
    position: relative;
    height: 38px;
}
.choosefile input[type="file"] {
    z-index: 99;
    width: 100%;
    height: 38px;
    opacity: 0;
    position: absolute;
}
.choosefile .btn {
    left: 0;
}
.choosefile .btn {
    position: absolute;
    z-index: 1;
    top: 0;
}
.message-div, .message-div-hover {
    border:1px solid #dfdfdf;
	border-radius:0.25rem;
	background-color:#fff;
	padding:1rem;
}
.message-div .chat-date, .message-div-hover .chat-date{
	color:#777;
    font-weight:normal;
	float:right;
}
.message-div .message-image,
.message-div-hover .message-image {
    width:48px;
    height:48px;
    border-radius:50%;
	border:1px solid #dfdfdf;
}
.message-div .message-desc a,
.message-div-hover .message-desc a {
    white-space:nowrap;
    max-width:0px;
}
.order-page .order-status-message {
	background-color:#fff;
    box-shadow: 0 1px 3px rgb(0 0 0 / 10%);
	border-radius:0.25rem;
	margin-bottom:1.25rem;
	padding:1rem;
	text-align:center;
}
.order-status-message .icon-feather-x-circle,
.card-alert .icon-feather-x-circle{
	font-size:1.25rem;
	vertical-align:bottom;
}
.order-page .order-status-message .link {
    color:#037afe;
}
.order-page .order-review-box {
    background-color:#037afe;
}
/** Review Styles **/
.proposal-reviews .card-header .rating {
    margin-top:-7px;
}
.proposal-reviews .card-header ul li {
    cursor:pointer;
}
.proposal-reviews hr {
    margin-left:-20px !important;
    margin-right:-20px !important;
}
.proposal-reviews hr:last-child {
    display:none;
}
.proposal-reviews .reviews-list {
    list-style:none;
}
.proposal-reviews .reviews-list li {
    background:#fff;
    min-height:68px;
    position:relative;
}
.proposal-reviews .reviews-list li .user-picture {
    float:none;
    position:absolute;
    margin-top:-7px;
    top:20px;
    overflow:hidden;
    border-radius:50%;
}
.proposal-reviews .reviews-list li .msg-body {
    margin-top:-5px;
}
.proposal-reviews .reviews-list li h4,
.proposal-reviews .reviews-list li .msg-body {
    color:#0e0e0f;
    font-size:14px;
    line-height:20px;
}
.proposal-reviews .reviews-list li .rating-date {
    font-size:12px !important;
    color:#999999 !important;
}
.rating-date {
    font-size:12px !important;
    color:#999999 !important;
}
.proposal-reviews .reviews-list li.rating-seller {
    min-height:45px;
    padding-top:0px;
}
.proposal-reviews .reviews-list li.rating-seller h4 {
    color:#0e0e0f;
    font-size:12px;
    margin-top:2px;
    font-weight:500;
}
.proposal-reviews .reviews-list li.rating-seller .user-picture {
    float:none;
    position:absolute;
    top:0;
    overflow:hidden;
    border-radius:50%;
}
.proposal-reviews .active {
    background: #40B488 !important;
}
 .proposal-reviews .reviews-list li .user-picture {
    left: 0;
}
.proposal-reviews .reviews-list li {
    padding: 15px 58px 15px 72px;
}
.proposal-reviews .reviews-list li.rating-seller {
    padding-left: 142px;
}
.proposal-reviews .reviews-list li.rating-seller .user-picture {
    left: 93px;
}
ul.item-list {
	line-height: 22px;
	padding-bottom: 2px;
	color: #909090;
	list-style: none;
	padding: 0;
	margin: 0;
}
ul.item-list > li {
	display: inline-block;
	margin-bottom: 5px;
}
ul.item-list > li:after {
	content: "";
	display: inline-block;
	width: 1px;
	height: 11px;
	background-color: #e0e0e0;
	position: relative;
	margin: 0 10px;
}
ul.item-list > li:last-child:after {
	display: none;
}
</style>