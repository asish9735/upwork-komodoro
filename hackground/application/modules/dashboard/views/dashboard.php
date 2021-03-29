<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="row">
      <div class="col-sm-6 col-12">
      <h1>
         <?php echo $main_title ? $main_title : '';?>
      </h1>
	  </div>
      <div class="col-sm-6 col-12"><?php echo $breadcrumb ? $breadcrumb : '';?></div>
	</div>
    </section>

    <!-- Main content -->
    <section class="content">
      
		<!-- working area -->
		
		 <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-sm-6 col-12">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo $project_count; ?></h3>

              <p>Projects</p>
            </div>
            <div class="icon">
              <i class="ion icon-feather-pie-chart"></i>
            </div>
            <a href="<?php echo base_url('proposal/list_record'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-sm-6 col-12">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3><?php echo $withdrawn_request_count; ?></h3>

              <p>Withdrawn Request</p>
            </div>
            <div class="icon">
              <i class="ion icon-feather-dollar-sign"></i>
            </div>
            <a href="<?php echo base_url('wallet/withdrawn_list'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-sm-6 col-12">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $users_count; ?></h3>

              <p>Registered Users</p>
            </div>
            <div class="icon">
              <i class="ion icon-feather-user-check"></i>
            </div>
            <a href="<?php echo base_url('member/list_record');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-sm-6 col-12">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $contract_count; ?></h3>
              <p>Contract</p>
            </div>
            <div class="icon">
              <i class="ion icon-feather-check-square"></i>
            </div>
            <a href="<?php echo base_url('offers/contracts'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-sm-6 col-12">
          <!-- small box -->
          <div class="small-box bg-teal">
            <div class="inner">
              <h3><?php echo $unread_notification_count; ?></h3>
              <p>Unread notification</p>
            </div>
            <div class="icon">
              <i class="ion icon-feather-bell"></i>
            </div>
            <a href="<?php echo base_url('admin_notification/list_record'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-sm-6 col-12">
          <!-- small box -->
          <div class="small-box bg-cyan">
            <div class="inner">
              <h3><?php echo $users_freelancer_count; ?></h3>
              <p>Total Freelancer</p>
            </div>
            <div class="icon">
              <i class="ion icon-feather-users"></i>
            </div>
            <a href="<?php echo base_url('member/list_record?u_type=freelancer&panel_open=1'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-sm-6 col-12">
          <!-- small box -->
          <div class="small-box bg-pink">
            <div class="inner">
              <h3><?php echo $users_employer_count; ?></h3>
              <p>Total Employer</p>
            </div>
            <div class="icon">
              <i class="ion icon-material-outline-account-circle"></i>
            </div>
            <a href="<?php echo base_url('member/list_record?u_type=employer&panel_open=1'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-sm-6 col-12">
          <!-- small box -->
          <div class="small-box bg-gray">
            <div class="inner">
              <h3><?php echo $contact_request_count; ?></h3>
              <p>Contact Request</p>
            </div>
            <div class="icon">
              <i class="ion icon-feather-phone"></i>
            </div>
            <a href="<?php echo base_url('contact/list_record'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-sm-6 col-12">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $dispute_count; ?></h3>
              <p>Dispute</p>
            </div>
            <div class="icon">
              <i class="ion icon-feather-alert-circle"></i>
            </div>
            <a href="<?php echo base_url('dispute/list_record'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-sm-6 col-12">
          <!-- small box -->
          <div class="small-box bg-olive">
            <div class="inner">
              <h3><?php echo $milestone_count; ?></h3>
              <p>Milestones</p>
            </div>
            <div class="icon">
              <i class="ion icon-feather-bar-chart"></i>
            </div>
            <a href="<?php echo base_url('offers/milestone'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-sm-6 col-12">
          <!-- small box -->
          <div class="small-box bg-lime">
            <div class="inner">
              <h3><?php echo $bid_count; ?></h3>
              <p>Applications</p>
            </div>
            <div class="icon">
              <i class="ion icon-feather-file-text"></i>
            </div>
            <a href="<?php echo base_url('project_application/list_record'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-sm-6 col-12">
          <!-- small box -->
          <div class="small-box bg-indigo">
            <div class="inner">
              <h3><?php echo $review_count; ?></h3>
              <p>Reviews</p>
            </div>
            <div class="icon">
              <i class="ion icon-feather-star"></i>
            </div>
            <a href="<?php echo base_url('review/list_record'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-sm-6 col-12">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
              <h3><?php echo $message_count; ?></h3>
              <p>Message board</p>
            </div>
            <div class="icon">
              <i class="ion icon-line-awesome-comments-o"></i>
            </div>
            <a href="<?php echo base_url('message/list_record'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
                <!-- ./col -->
        <div class="col-lg-3 col-sm-6 col-12">
          <!-- small box -->
          <div class="small-box bg-cyan">
            <div class="inner">
              <h3><?php echo $invoice_count; ?></h3>
              <p>Invoice</p>
            </div>
            <div class="icon">
              <i class="ion icon-feather-file"></i>
            </div>
            <a href="<?php echo base_url('invoice/list_record'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-sm-6 col-12">
          <!-- small box -->
          <div class="small-box bg-gray">
            <div class="inner">
              <h3><?php echo $offer_count; ?></h3>
              <p>Total Offer</p>
            </div>
            <div class="icon">
              <i class="ion icon-feather-gift"></i>
            </div>
            <a href="<?php echo base_url('offers/list_record'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-sm-6 col-12">
          <!-- small box -->
          <div class="small-box bg-pink">
            <div class="inner">
              <h3><?php echo $escrow_count; ?></h3>
              <p>Escrow</p>
            </div>
            <div class="icon">
              <i class="ion icon-feather-shield"></i>
            </div>
            <a href="<?php echo base_url('project_escrow/list_record'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

      </div>
      <!-- /.row -->
	  
	  
		<div class="row">
		  <div class="col-sm-6 col-12">
			<!-- solid sales graph -->
			  <div class="box box-solid bg-teal-gradient">
				<div class="box-header">
				  <i class="fa fa-th"></i>

				  <h3 class="box-title">Project Graph</h3>

				</div>
				<div class="box-body border-radius-none">
				  <div class="chart" id="line-chart" style="height: 250px;"></div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->
		  </div>
		  
		  <div class="col-sm-6 col-12">
				<div class="box box-solid">
					<div class="box-header">
					  <i class="fa fa-th"></i>

					  <h3 class="box-title">Member Graph</h3>

					  
					</div>
					<div class="box-body border-radius-none">
					  <div class="chart" id="revenue-chart" style="height: 250px;"></div>
					</div>
					<!-- /.box-body -->
				</div>
		  </div>
		  
		</div>
	  


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script src="<?php echo ADMIN_PLUGINS;?>raphael/raphael.min.js"></script>
<script src="<?php echo ADMIN_PLUGINS;?>morris.js/morris.min.js"></script>
<script src="<?php echo ADMIN_PLUGINS;?>jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<script src="<?php echo ADMIN_PLUGINS;?>jquery-knob/dist/jquery.knob.min.js"></script>
<script src="<?php echo ADMIN_PLUGINS;?>moment/min/moment.min.js"></script>


<script>
var project_statistics = <?php echo json_encode($statics['project']);?>;
var member_statistics = <?php echo json_encode($statics['member']);?>;
var line = new Morris.Line({
    element          : 'line-chart',
    resize           : true,
	  data			 : project_statistics,
    data_org             : [
      { y: '2011 Q1', item1: 2666 },
      { y: '2011 Q2', item1: 2778 },
      { y: '2011 Q3', item1: 4912 },
      { y: '2011 Q4', item1: 3767 },
      { y: '2012 Q1', item1: 6810 },
      { y: '2012 Q2', item1: 5670 },
      { y: '2012 Q3', item1: 4820 },
      { y: '2012 Q4', item1: 15073 },
      { y: '2013 Q1', item1: 10687 },
      { y: '2013 Q2', item1: 8432 }
    ],
    xkey             : 'y',
    ykeys            : ['item1'],
    labels           : ['Item 1'],
    lineColors       : ['#efefef'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#fff',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#efefef'],
    gridLineColor    : '#efefef',
    gridTextFamily   : 'Open Sans',
    gridTextSize     : 10
  });
  
   /* Morris.js Charts */
  // Sales chart
  var area = new Morris.Area({
    element   : 'revenue-chart',
    resize    : true,
	data	  : member_statistics,
    data_org      : [
      { y: '2011 Q1', item1: 2666, item2: 2666 },
      { y: '2011 Q2', item1: 2778, item2: 2294 },
      { y: '2011 Q3', item1: 4912, item2: 1969 },
      { y: '2011 Q4', item1: 3767, item2: 3597 },
      { y: '2012 Q1', item1: 6810, item2: 1914 },
      { y: '2012 Q2', item1: 5670, item2: 4293 },
      { y: '2012 Q3', item1: 4820, item2: 3795 },
      { y: '2012 Q4', item1: 15073, item2: 5967 },
      { y: '2013 Q1', item1: 10687, item2: 4460 },
      { y: '2013 Q2', item1: 8432, item2: 5713 }
    ],
    xkey      : 'y',
    ykeys     : ['item1', 'item2'],
    labels    : ['Item 1', 'Item 2'],
    lineColors: ['#a0d0e0', '#3c8dbc'],
    hideHover : 'auto'
  });

</script>