  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<div class="row">
			<div class="col-sm-6 col-12">
				<h1>
					<?php echo $main_title ? $main_title : '';?>
					<small><?php echo $second_title ? $second_title : '';?></small>
				</h1>
				</div>
      <div class="col-sm-6 col-12"><?php echo $breadcrumb ? $breadcrumb : '';?></div>
	</div>
    </section>

	<!-- Content Filter -->
	<?php $this->layout->load_filter(); ?>
	
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo $title ? $title : '';?></h3>

        </div>
       
		<div class="box-body table-responsive no-padding table_visible" id="main_table">
              <table class="table table-hover">
                <tbody>
				<tr>
				 <th style="width:5%">ID</th>
                  <th style="width:10%">Order Number</th>
                  <th style="width:10%">Buyer</th>
                  <th style="width:10%">Seller</th>
                  <th style="width:10%" class="text-center">Order Total</th>
                  <th style="width:10%" class="text-center">Order Qty</th>
                  <th style="width:20%" class="text-center">Date</th>
                  <th style="width:10%">Status</th>
                  <th align="right">Action</th>
                </tr>
				<?php $currency = get_setting('site_currency'); if(count($list) > 0){foreach($list as $k => $v){ 
					//get_print($v);
				$status = '-';
				$main_transaction=TRUE;
				if($v['order_status'] == ORDER_PENDING){
					$status = '<span class="badge badge-default">Pending</span>';
					$status_txt = 'Pending';
				}else if($v['order_status'] == ORDER_PROCESSING){
					$status = '<span class="badge badge-default">Processing</span>';
					$status_txt = 'Processing';
				}else if($v['order_status'] == ORDER_REVISION){
					$status = '<span class="badge badge-primary">Revision</span>';
					$status_txt = 'Revision';
				}else if($v['order_status'] == ORDER_CANCELLATION){
					$status = '<span class="badge badge-warning">Cancellation</span>';
					$status_txt = 'Cancellation';
				}else if($v['order_status'] == ORDER_CANCELLED){
					$status = '<span class="badge badge-danger">Cancelled</span>';
					$status_txt = 'Cancelled';
				}else if($v['order_status'] == ORDER_DELIVERED){
					$status = '<span class="badge badge-default">Delivered</span>';
					$status_txt = 'Delivered';
				}else if($v['order_status'] == ORDER_COMPLETED){
					$status = '<span class="badge badge-success">Completed</span>';
					$status_txt = 'Completed';
				}else{
					$status = '<span class="badge badge-danger">Not Paid</span>';
					$status_txt = 'Not Paid';
					$main_transaction=FALSE;
				}
				if($main_transaction){
					$transaction_type=array('order_payment_wallet','order_payment_paypal','order_payment_stripe','order_payment_payza','order_payment_bitcoin','order_payment_mobile_money','order_payment_refund','order_site_commission','referral_commission','order_revenue_to_seller');
					$transaction=$this->db->select('o_t.transaction_id, wt.title_tkey as name')->from('orders_transaction as o_t')->join('wallet_transaction as w_t','o_t.transaction_id=w_t.wallet_transaction_id','left')->join('wallet_transaction_type wt', 'wt.wallet_transaction_type_id = w_t.wallet_transaction_type_id', 'INNER')->where('o_t.order_id',$v['order_id'])->where_in('wt.title_tkey', $transaction_type)->order_by('o_t.transaction_id','asc')->get()->result();
				}
				$buyer_details=$this->db->select('m.member_name')->from('member as m')->where('m.member_id',$v['buyer_id'])->get()->row();
				$seller_details=$this->db->select('m.member_name')->from('member as m')->where('m.member_id',$v['seller_id'])->get()->row();
				 
				?>
				<tr>
					
                  <td><?php echo $v[$primary_key]; ?></td>
                  <td># <?php echo $v['order_number']; ?></td>
                  <td><a href="<?php echo base_url('member/list_record');?>?member_id=<?php echo $v['buyer_id']?>" targer="_blank"><?php if($buyer_details){echo $buyer_details->member_name;}?></a></td>
                  <td><a href="<?php echo base_url('member/list_record');?>?member_id=<?php echo $v['seller_id']?>" targer="_blank"><?php if($seller_details){echo $seller_details->member_name;}?></a></td>
                  <td class="text-center"><?php echo $currency.' '.$v['order_price']; ?></td>
                  <td class="text-center"><?php echo $v['order_qty']; ?></td>
                  <td class="text-center"><?php echo format_date_time($v['order_date']); ?></td>
                  <td><?php echo $status; ?></td>
                  <td align="right">
					<div class="dropdown">					  					 
					  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><?php echo $status_txt; ?></button>
					  <div class="dropdown-menu" role="menu">
					  	<!-- <a class="dropdown-item" href="<?php echo SITE_URL?>orders/invoice/<?php echo md5($v['order_id']); ?>/<?php echo md5('FVRR'.'-'.date("Y-m-d").'-'.$v['order_id']);?>"  target="_blank">View Invoice</a> -->
					  	<a class="dropdown-item" href="<?php echo base_url('orders/order_detail/'.$v['order_id']); ?>">Order details</a>
					  	
						<?php /* if($v['order_status'] == ORDER_PENDING || $v['order_status'] == ORDER_PROCESSING || $v['order_status'] == ORDER_REVISION || $v['order_status'] == ORDER_CANCELLATION || $v['order_status'] == ORDER_DELIVERED){ ?>
						<li><a href="<?php echo JS_VOID;?>" onclick="changeStatus('<?php echo ORDER_CANCELLED; ?>', '<?php echo $v[$primary_key]; ?>')"> <i class="fa fa-ban"></i> Cancel Order</a></li>
						<?php } */?>
						<?php if($main_transaction){
							if($transaction){
								foreach($transaction as $t=>$tran){
									if($tran->name=='order_revenue_to_seller'){
										$transaction_name="Release Payment Transaction";
									}elseif($tran->name=='order_site_commission'){	
										$transaction_name="Commission Transaction";
									}elseif($tran->name=='referral_commission'){	
										$transaction_name="Referral Trnsaction";
									}elseif($tran->name=='order_payment_refund'){	
										$transaction_name="Refund Trnsaction";
									}else{
										$transaction_name="Order Transaction";
									}
							?>
							<a class="dropdown-item" href="<?php echo JS_VOID;?>" onclick="view_txn_detail('<?php echo $tran->transaction_id; ?>')"><?php echo $transaction_name;?></a>
							<?php
								}
							}
							?>
						
						<?php }?>
					  </div>
					</div>
				  </td>
                </tr>
				<?php } }else{  ?>
				<tr>
                  <td colspan="10"><?php echo NO_RECORD; ?></td>
                 </tr>
				<?php } ?>
                
               </tbody>
			  </table>
        </div>
		 <!-- /.box-body -->
		<div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
               <?php echo $links;?>
              </ul>
            </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  
<div class="modal fade" id="ajaxModal">
	  <div class="modal-dialog">
		<div class="modal-content">
		 
		</div>
	  </div>
</div>

<script>

function view_txn_detail(txn_id){
	Modal.openURL({
		title : 'Transaction Detail of '+txn_id,
		url: '<?php echo base_url('wallet/load_ajax_page?page=single_txn_detail');?>&id='+txn_id
	});
}

function add(){
	var url = '<?php echo base_url($curr_controller.'load_ajax_page?page='.$add_command);?>';
	load_ajax_modal(url);
}

function edit(id){
	var url = '<?php echo base_url($curr_controller.'load_ajax_page?page='.$edit_command);?>&id='+id;
	load_ajax_modal(url);
}

function deleteRecord(id, permanent){
	permanent = permanent || false;
	var c = confirm('Are you sure to delete this record ?');
	if(c){
		console.log('ok');
		var url = '<?php echo base_url($curr_controller.'delete_record');?>/'+id;
		if(permanent){
			url += '?cmd=remove';
		}
		$.getJSON(url, function(res){
			if(res.cmd && res.cmd == 'reload'){
				location.reload();
			}
		});
	}else{
		return false;
	}
}

function changeStatus(sts, id, ele){
	var url = '<?php echo base_url($curr_controller.'change_status');?>';
	$.ajax({
		url : url,
		data: {ID: id, status: sts},
		type: 'POST',
		dataType: 'json',
		success: function(res){
			if(res.cmd){
				if(res.cmd == 'reload'){
					location.reload();
				}else if(res.cmd == 'replace'){
					if(typeof ele !== 'undefined'){
						$('[data-toggle="tooltip"]').tooltip("destroy");
						$(ele).replaceWith(res.data.html);
						init_plugin();
					}
				}
			}
			
		}
	});
	return false;
}

function changeStatusAll(sts){
	var data = $('#main_table').find('input').serialize();
	var status = [1, 0];
	if(status.indexOf(sts) !== -1){
		data += '&status=' + sts;
		data += '&action_type=multiple';
		var url = '<?php echo base_url($curr_controller.'change_status');?>';
		$.ajax({
			url : url,
			data: data,
			type: 'POST',
			dataType: 'json',
			success: function(res){
				if(res.cmd){
					if(res.cmd == 'reload'){
						location.reload();
					}else if(res.cmd == 'replace'){
						if(typeof ele !== 'undefined'){
							$('[data-toggle="tooltip"]').tooltip("destroy");
							$(ele).replaceWith(res.data.html);
							init_plugin();
						}
					}
				}
				
			}
		});
	}
	return false;
}

function deleteSelected(){
	var c = confirm('Are you sure to delete selected record ?');
	if(c){
		var data = $('#main_table').find('input').serialize();
		data += '&action_type=multiple';
		var url = '<?php echo base_url($curr_controller.'delete_record');?>';
		$.ajax({
			url : url,
			data: data,
			type: 'POST',
			dataType: 'json',
			success: function(res){
				if(res.cmd){
					if(res.cmd == 'reload'){
						location.reload();
					}
				}
				
			}
		});
	}
	
	return false;
}

function init_event(){
	
	var item  = $('.check_all_main').data('target');
	
	$(item).on('change', function(){
		checkSelected();
	});
	
	$('.check_all_main').on('change', function(){
		var is_checked = $(this).is(':checked');
		var target = $(this).data('target');
		if(is_checked){
			$(target).prop('checked', true);
		}else{
			$(target).prop('checked', false);
		}
		$(target).triggerHandler('change');
	});
	
	function checkSelected(){
		var target  = $('.check_all_main').data('target');
		var l = $(target + ':checked').length;
		if(l == 0){
			$('#global_action_btn').find('button').attr('disabled', 'disabled');
			$('#global_action_btn').hide();
		}else{
			$('#global_action_btn').find('button').removeAttr('disabled');
			$('#global_action_btn').show();
		}
	} 
}

$(function(){
	
	init_plugin(); /* global.js */
	init_event();
	
	
});
</script>
