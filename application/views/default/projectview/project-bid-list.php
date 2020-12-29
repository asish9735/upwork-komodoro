<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//dd($projectData,TRUE);
$ProjectDetailsURL=get_link('myProjectDetailsURL')."/".$projectData['project']->project_url;
$ProjectApplicationURL=get_link('myProjectDetailsBidsClientURL')."/".$projectData['project']->project_id;
$ApplyProjecURL=get_link('ApplyProjectURL')."/".$projectData['project']->project_url;
?>
<div class="single-page-header">
	<div class="container">
		<div class="single-page-header-inner">
					<div class="left-side">
						
						<div class="header-details">
							<h1><?php D(ucfirst($projectData['project']->project_title));?></h1>
							<p><?php D($projectData['project_category']->category_subchild_name);?>, <?php D($projectData['project_category']->category_name);?></p>

						</div>
					</div>
					<?php if($projectData['project_settings']->is_fixed==1){?>
					<div class="right-side">
						<div class="salary-box">
							<div class="salary-type">Fixed Budget</div>
							<div class="salary-amount"><?php D(priceSymbol().priceFormat($projectData['project_settings']->budget));?></div>
						</div>
					</div>
					<?php }?>
				</div>
	</div>
</div>
<div class="container">
<ul class="nav nav-tabs mb-3">
  <li class="nav-item">
    <a class="nav-link" href="<?php echo $ProjectDetailsURL;?>">Details</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="<?php echo $ProjectApplicationURL;?>">Applications</a>
  </li>
</ul>

<!-- Dashboard Headline -->
<div class="dashboard-headline">
    <h3>Manage Proposals</h3>
</div>
    
					
					
<ul class="nav nav-tabs mb-3" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#proposal" role="tab">Proposal <span id="show_count_total_proposal"></span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#archive" role="tab">Archive <span id="show_count_archive_proposal"></span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#shortlisted" role="tab">Shortlisted <span id="show_count_shortlisted_proposal"></span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#interview" role="tab">Interview <span id="show_count_interview_proposal"></span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#invite" role="tab">Invite <span id="show_count_invite_proposal"></span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#hired" role="tab">Hire <span id="show_count_hired_proposal"></span></a>
    </li>
</ul>


<div class="sort-by mb-3 d-none">
	<div class="sort-group">
	<div class="input-group">
    	<input type="text" class="form-control" placeholder="Search for freelancers" />
        <div class="input-group-append"><button class="btn btn-site"><i class="icon-feather-search"></i></button></div>
    </div>
	</div>
    
    <div class="sort-by">
    <span>Sort by:</span>
    <select class="selectpicker hide-tick">
        <option>Relevance</option>
        <option>Newest</option>
        <option>Oldest</option>
        <option>Random</option>
    </select>
    </div>
    <div class="sort-group">
		<a href="javascript:void(0)" class="btn btn-outline-success"><i class="icon-feather-filter"></i> Filter</a>
	</div>
    <div class="sort-group text-right">
    <span>View by:</span>
    <a href="#" class="btn btn-outline-success"><i class="icon-feather-grid"></i></a> &nbsp;
    <a href="#" class="btn btn-outline-success active"><i class="icon-feather-list"></i></a>
	</div>
    
</div>


<div class="tab-content dashboard-box_ margin-top-0 margin-bottom-30">
    <div class="tab-pane active" id="proposal" role="tabpanel">proposal</div>
    <div class="tab-pane" id="archive" role="tabpanel">archive</div>
    <div class="tab-pane" id="shortlisted" role="tabpanel">shortlist</div>
    <div class="tab-pane" id="interview" role="tabpanel">interview</div>
    <div class="tab-pane" id="invite" role="tabpanel">invite</div>
    <div class="tab-pane" id="hired" role="tabpanel">hired</div>
</div>
				
			</div>
<div class="dashboard-footer-spacer"></div>
            
<div id="myModal" class="modal fade" tabindex="-1" role="dialog"  style="z-index: 10000"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <!-- Modal content-->
    <div class="modal-content mycustom-modal">
    <div class="text-center padding-top-50 padding-bottom-50"><?php load_view('inc/spinner',array('size'=>30));?></div>
    </div>

  </div>
</div>
<script>
	var SPINNER='<?php load_view('inc/spinner',array('size'=>30));?>';
	var baseURL = '<?php echo get_link('myProjectDetailsBidsClientloadAjaxURL');?>/<?php echo $projectData['project']->project_id;?>';
	function load_count(project_id){
		$.ajax({
	      type: "POST",
	      dataType:'json',
	      url: '<?php echo get_link('myProjectDetailsBidsClientloadCountAjaxURL');?>/'+project_id,
	      error: function(data){},
	      success: function(data){
	        if(data['status']=='OK'){
	        	var p=data['project'];
	        	for (var key in p){
				    //console.log(key, p[key]);
				    var cnt="";
				    if(p[key]>0){
						cnt="("+p[key]+")";
					}
				    $('#show_count_'+key).html(cnt);
			    }
			}
	      }
  		})
	}
	var main=function(){
	$('#proposal').html('<div class="text-center" style="min-height: 70px;width: 100%;line-height: 70px;">'+SPINNER+'</div>');
    

	 $('#proposal').load(baseURL,{type:'proposal'}, function() {
	    $('.mytabs').tab(); //initialize tabs
	});
   
	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		$('.tab-pane').empty();
	  var target = $(e.target).attr("href") // activated tab
	  var pattern=/#.+/gi //use regex to get anchor(==selector)
	  var contentID = e.target.toString().match(pattern)[0]; //get anchor 
	  $('#'+contentID.replace('#','')).html('<div class="text-center" style="min-height: 70px;width: 100%;line-height: 70px;">'+SPINNER+'</div>');
	    $.ajax({
	      type: "POST",
	      data:{type:contentID.replace('#','')},
	      url: '<?php echo get_link('myProjectDetailsBidsClientloadAjaxURL');?>/<?php echo $projectData['project']->project_id;?>',
	      error: function(data){

	      },
	      success: function(data){
	        $(target).html(data);
	        starRating('.star-rating');
	      }
  		})
	});
	load_count(<?php D($projectData['project']->project_id);?>);
}
</script>