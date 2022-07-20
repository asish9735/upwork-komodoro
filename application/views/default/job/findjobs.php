<section class="short-banner">
<div class="container">
    <h1><?php echo __('job_findjobs_projects','Projects');?></h1>
</div>
</section>
<section class="section">
<div class="container">
<div class="row">
    <div class="col-lg-4 col-12">
    	<div class="d-none d-lg-block">
            <h4>Filters</h4>
        </div>
    	<div class="filterHeader d-lg-none">
            <h4>Filters</h4>
            <a href="javascript:void(0)" class="float-end" id="filter" title="Filter"><i class="icon-feather-filter f20"></i></a>
        </div>
        <div class="sidebar-filter">
        <div class="filterHeader d-lg-none">
            <div class="row d-flex">
            <div class="col"><a href="javascript:void(0)">Clear</a></div>
            <div class="col text-center"><h4>Filters</h4></div>
            <div class="col"><a href="javascript:void(0)" class="close_filter" title="Filter"><i class="icon-feather-x f20"></i></a></div>
            </div>
        </div>
        <div class="filter-body">
        <form id="filterForm">
            <div class="search-box input-group mb-3">
                <input type="text" value="<?php if($searchdata && array_key_exists('term',$searchdata)){echo $searchdata['term'];}?>" class="form-control" placeholder="Find jobs by title" form="filterForm" name="term"/>
                <button type="button" class="btn btn-site" onclick="filterForm()"><i class="icon-feather-search"></i><!--<?php // echo __('job_findjobs_search','Search');?>--> </button>
            </div>
        
        <?php /*?>
        	<div class="d-flex">
            	<a href="javascript:void(0)" class="btn btn-outline-site me-3" onclick="$('#filterAdvance').toggle();"><i class="icon-feather-filter"></i><?php echo __('job_findjobs_filter','Filter');?> </a>   
                <a href="javascript:void(0)" class="btn btn-outline-site me-3" hidden><i class="icon-feather-heart"></i><?php echo __('job_findjobs_save_search','Save Search');?> </a>                                 
                <div class="sort-by ms-auto">
                <div class="sort-by">
                    <span><?php echo __('job_findjobs_sort_by','Sort by:');?></span>
                    <select class="selectpicker hide-tick" name="order_by"  onchange="filterForm()">
                        <option value="default" <?php if($searchdata && array_key_exists('order_by',$searchdata) && $searchdata['order_by']=='default'){echo 'selected';}?>><?php echo __('job_findjobs_relevance','Relevance');?></option>
                        <option value="latest" <?php if($searchdata && array_key_exists('order_by',$searchdata) && $searchdata['order_by']=='latest'){echo 'selected';}?>><?php echo __('job_findjobs_newest','Newest');?></option>
                        <option value="old" <?php if($searchdata && array_key_exists('order_by',$searchdata) && $searchdata['order_by']=='old'){echo 'selected';}?>><?php echo __('job_findjobs_oldest','Oldest');?></option>
                        <!--<option value="random">Random</option>-->
                    </select>
                </div>
                <!--    
                <div class="sort-group">
                    <span>View by:</span>
                    <a href="#" class="btn btn-outline-site"><i class="icon-feather-grid"></i></a> &nbsp;
                    <a href="#" class="btn btn-outline-site active"><i class="icon-feather-list"></i></a>
                </div>-->
			</div>       
            </div>    
        <?php */?>           
    

    <div id="filterAdvance">
        <!-- Category -->        
        <div class="sidebar-widget">
            <h5><img src="<?php echo IMAGE;?>category-icon.png" alt="" height="20" width="20" class="me-1" /> <?php echo __('job_findjobs_category','Category');?></h5>
            <select name="category" class="selectpicker default"  title="All Categories"  data-live-search="true">
                <option value=""><?php echo __('job_findjobs_all','All');?></option>
                <?php print_select_option($category, 'category_id', 'category_name',(($searchdata && array_key_exists('category',$searchdata)) ? $searchdata['category']:'' )); ?>
            </select>
        </div>
        
        <!-- Category -->        
        <div class="sidebar-widget" id="sub_category_wrapper">
            <h5><?php echo __('job_findjobs_speciality','Speciality');?></h5>
            <select name="sub_category" id="sub_category" class="selectpicker default" title="Speciality"  data-live-search="true" onchange="filterForm()">
            	<option value=""><?php echo __('job_findjobs_all','All');?></option>
				<?php 
				if($searchdata && array_key_exists('category',$searchdata)){
				?>
				<?php print_select_option($sub_category, 'category_subchild_id', 'category_subchild_name',(($searchdata && array_key_exists('sub_category',$searchdata)) ? $searchdata['sub_category']:'' )); ?>
        		<?php }?>
			</select>
        </div>
        
        <div class="sidebar-widget">
            <h5><img src="<?php echo IMAGE;?>project-icon.png" alt="" height="20" width="20" class="me-1" /> <?php echo __('job_findjobs_project_type','Project Type');?></h5>
            <select name="is_hourly" class="selectpicker default"  title="<?php echo __('job_findjobs_project_type','Project Type');?>" onchange="filterForm()">
                <option value=""><?php echo __('job_findjobs_all','All');?></option>
                <option value="0" <?php if($searchdata && array_key_exists('is_hourly',$searchdata) && $searchdata['is_hourly']=='0'){echo 'selected';}?>><?php echo __('job_findjobs_fixed','Fixed');?></option>
                <option value="1" <?php if($searchdata && array_key_exists('is_hourly',$searchdata) && $searchdata['is_hourly']=='1'){echo 'selected';}?>><?php echo __('job_findjobs_hourly','Hourly');?></option>
            </select>
        </div>
        
        <div class="sidebar-widget">
            <h5><?php echo __('job_findjobs_experience_level','Experience Level');?></h5>
            <select name="experience_level" class="selectpicker default" title="Experience Level"  data-live-search="true" onchange="filterForm()">
                <option value=""><?php echo __('job_findjobs_all','All');?></option>
                <?php print_select_option($experience_level, 'experience_level_id', 'experience_level_name',(($searchdata && array_key_exists('experience_level',$searchdata)) ? $searchdata['experience_level']:'' )); ?>
            </select>
        </div>
        
        <div class="sidebar-widget">
            <h5><?php echo __('job_findjobs_job_type','Job Type');?></h5>
            <select name="job_type" class="selectpicker default"  title="Job Type" onchange="filterForm()">
                <option value=""><?php echo __('job_findjobs_all','All');?></option>
                <option value="OneTime" <?php if($searchdata && array_key_exists('job_type',$searchdata) && $searchdata['job_type']=='OneTime'){echo 'selected';}?>><?php echo __('job_findjobs_one_time_project','One Time Poject');?></option>
                <option value="Ongoing" <?php if($searchdata && array_key_exists('job_type',$searchdata) && $searchdata['job_type']=='Ongoing'){echo 'selected';}?>><?php echo __('job_findjobs_ongoing_project','Ongoing Project');?></option>
                <option value="NotSure" <?php if($searchdata && array_key_exists('job_type',$searchdata) && $searchdata['job_type']=='NotSure'){echo 'selected';}?>><?php echo __('job_findjobs_not_sure','Not Sure');?></option>
            </select>
        </div>
        
        <!-- Salary -->        
        <div class="sidebar-widget">        
            <h5><img src="<?php echo IMAGE;?>budget-icon.png" alt="" height="20" width="20" class="me-1" /> <?php echo __('job_findjobs_budget','Budget');?></h5>
            <div class="margin-top-60"></div>
            <!-- Range Slider -->
            <div class="ps-4 pe-4">
            <input class="range-slider" type="text" value="" data-slider-tooltip-split="true" data-slider-currency="$" data-slider-min="1500" data-slider-max="15000" data-slider-step="100" data-slider-value="[1500,15000]" />
            </div>
        	<div class="margin-top-20"></div>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Min" name="min" value="<?php if($searchdata && array_key_exists('min',$searchdata)){echo $searchdata['min'];}?>">
                <input type="text" class="form-control" placeholder="Max" name="max" value="<?php if($searchdata && array_key_exists('max',$searchdata)){echo $searchdata['max'];}?>">
                <button type="button" class="btn btn-site" onclick="filterForm()"><i class="icon-feather-search"></i></button> 
            </div> 
                       
        </div>
        
        <div class="sidebar-widget mb-0">
        <h5>Locations</h5>
        <select class="selectpicker default" name="country">
        	<option value=""><?php echo __('findtalents_page_','Select Country');?></option>
			<?php if($all_location){
                foreach($all_location as $l=>$location){
                    ?>
                <option value="<?php echo ($location->country_code);?>" ><?php echo $location->country_name;?></option>
                    <?php
                }
            }?>
        </select>
		</div>
	</div>
	</form>
    	</div>
        </div>
    </div>
    <div class="col-lg-8 col-12">
    	<h3 class="page-title"><ec class="total_count">0</ec> <?php echo __('job_findjobs_jobs_found','jobs found');?> </h3>
	<!-- Tasks Container -->
    <div class="listings-container" id="job_list">
    	<div class="text-center" style="margin: 100px"><?php load_view('inc/spinner',array('size'=>30));?></div>
        <!-- Pagination -->
        <div class="pagination-container margin-top-30 margin-bottom-60" hidden>
            <nav class="pagination">
                <ul>
                    <li class="pagination-arrow"><a href="#" class="ripple-effect"><i class="icon-material-outline-keyboard-arrow-left"></i></a></li>
                    <li><a href="#" class="ripple-effect">1</a></li>
                    <li><a href="#" class="current-page ripple-effect">2</a></li>
                    <li><a href="#" class="ripple-effect">3</a></li>
                    <li><a href="#" class="ripple-effect">4</a></li>
                    <li class="pagination-arrow"><a href="#" class="ripple-effect"><i class="icon-material-outline-keyboard-arrow-right"></i></a></li>
                </ul>
            </nav>
        </div>
        <!-- Pagination / End -->

    </div>
	<!-- Tasks Container / End -->
			
	<div class="text-center"><button class="btn btn-site" id="load_more_btn"><?php echo __('job_findjobs_load_more','Load More');?></button></div>
    </div>
</div>		
</div>
</section>
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
function starRating(ratingElem) {

	$(ratingElem).each(function() {
		$(this).empty();
		var dataRating = $(this).attr('data-rating');

		// Rating Stars Output
		function starsOutput(firstStar, secondStar, thirdStar, fourthStar, fifthStar) {
			return(''+
				'<span class="'+firstStar+'"></span>'+
				'<span class="'+secondStar+'"></span>'+
				'<span class="'+thirdStar+'"></span>'+
				'<span class="'+fourthStar+'"></span>'+
				'<span class="'+fifthStar+'"></span>');
		}

		var fiveStars = starsOutput('star','star','star','star','star');

		var fourHalfStars = starsOutput('star','star','star','star','star half');
		var fourStars = starsOutput('star','star','star','star','star empty');

		var threeHalfStars = starsOutput('star','star','star','star half','star empty');
		var threeStars = starsOutput('star','star','star','star empty','star empty');

		var twoHalfStars = starsOutput('star','star','star half','star empty','star empty');
		var twoStars = starsOutput('star','star','star empty','star empty','star empty');

		var oneHalfStar = starsOutput('star','star half','star empty','star empty','star empty');
		var oneStar = starsOutput('star','star empty','star empty','star empty','star empty');
		var HalfStar = starsOutput('star half','star empty','star empty','star empty','star empty');
		var zeroStar = starsOutput('star empty','star empty','star empty','star empty','star empty');

		// Rules
		if (dataRating >= 4.75) {
			$(this).append(fiveStars);
		} else if (dataRating >= 4.25) {
			$(this).append(fourHalfStars);
		} else if (dataRating >= 3.75) {
			$(this).append(fourStars);
		} else if (dataRating >= 3.25) {
			$(this).append(threeHalfStars);
		} else if (dataRating >= 2.75) {
			$(this).append(threeStars);
		} else if (dataRating >= 2.25) {
			$(this).append(twoHalfStars);
		} else if (dataRating >= 1.75) {
			$(this).append(twoStars);
		} else if (dataRating >= 1.25) {
			$(this).append(oneHalfStar);
		} else if (dataRating > .75) {
			$(this).append(oneStar);
		} else if (dataRating > .25) {
			$(this).append(HalfStar);
		}else{
			$(this).append(zeroStar);
		}

	});

} 
var main = function(){	
	$('#filter').click(function(){
    $('.sidebar-filter').slideToggle('slow');
	$('body').addClass('overflow-none');
  });
  $('.close_filter').click(function(){
    $('.sidebar-filter').slideToggle('slow');
	$('body').removeClass('overflow-none');
  });
	var findJobLoadMore = LoadMore.getInstance();	
	/* findJobLoadMore.config({
		url : '<?php echo base_url('job/job_list_ajax');?>',
		target : '#job_list',
		load_more : '#load_more_btn',
		autoload: {
			autoload: false,
			target: 'window'
		},
		onResult: function(res){
		
		}
	});
	findJobLoadMore.start(); */
	
	function filterForm(){
		
		$('#job_list').html('');
		var form = $('#filterForm').serialize();
		
		findJobLoadMore.config({
			url : '<?php echo base_url('job/job_list_ajax');?>?'+form,
			target : '#job_list',
			load_more : '#load_more_btn',
			autoload: {
				autoload: false,
				target: 'window'
			},
			onResult: function(res){
				starRating('.star-rating');
				history.pushState({}, null,  '<?php echo URL::get_link('search_job'); ?>?'+form);
			$('.total_count').html(res.job_list_count);
			}
		});
	
		findJobLoadMore.start();
		
	}
	
	window.filterForm = filterForm;
	
	filterForm();
	
	// get sub category
	$('[name="category"]').change(function(){
		
		var val = $('[name="category"] :selected').val();
		$.ajax({
			url : '<?php echo base_url('job/get_sub_category')?>',
			data: {category_id: val},
			dataType: 'JSON',
			success: function(res){
				if(res.error_length > 0){
					
				}else{
					var category = res.data.category;
					var category_html = category.map(function(item){
						return '<option value="'+item.category_subchild_id+'">'+item.category_subchild_name+'</option>';
					});
					$('#sub_category_wrapper').show();
					$('#sub_category').html('<option value="">All</option>' + category_html.join(''));
					$('#sub_category').selectpicker('refresh');
				}
				filterForm();
			}
		});
	});
	$('#job_list').on('click', '.action_favorite',function(e){
		e.preventDefault();
		var _self=$(this);
		var data = {
			pid: _self.data('pid'),
		};
		$.post('<?php echo get_link('actionfavorite_job'); ?>', data, function(res){
			if(res['status'] == 'OK'){
				if(res['cmd']== 'add'){
					_self.addClass('active');
					bootbox.alert({
						title:'Make Favorite',
						message: 'Successfully Saved',
						buttons: {
						'ok': {
							label: 'Ok',
							className: 'btn-site pull-right'
							}
						},
						callback: function () {
							
					    }
					});
				}else{
					_self.removeClass('active');
					bootbox.alert({
						title:'Remove Favorite',
						message: 'Successfully Removed',
						buttons: {
						'ok': {
							label: 'Ok',
							className: 'btn-site pull-right'
							}
						},
						callback: function () {
							
					    }
					});
					
				}
			}else if(res['popup'] == 'login'){
				bootbox.confirm({
					title:'Login Error!',
					message: 'You are not Logged In. Please login first.',
					buttons: {
					'confirm': {
						label: 'Login',
						className: 'btn-site pull-right'
						},
					'cancel': {
						label: 'Cancel',
						className: 'btn-dark pull-left'
						}
					},
					callback: function (result) {
						if(result){
							var base_url = '<?php echo base_url();?>';
							var refer = window.location.href.replace(base_url, '');
							location.href = '<?php echo base_url('login?refer='); ?>'+refer;
						}
					}
				});
			}
		},'JSON');
		
	});
	$('#job_list').on('click','.action_report',  function(e){
	e.preventDefault();
	var _self = $(this);
	var report_project = function(){
		
		var data = {
			project_id: _self.data('pid'),
			cmd: 'add',
		};
		
		if(data.cmd == 'add'){
			
			$( "#myModal .mycustom-modal").html( '<div class="text-center padding-top-50 padding-bottom-50">'+SPINNER+'<div>' );
			$('#myModal').modal('show');
			
			$.get("<?php echo get_link('reportJobFormAjaxURL'); ?>",data, function( data ) {
				setTimeout(function(){ $( "#myModal .mycustom-modal").html( data );},1000)
			});
			
		}else{
			
		}
	};
	
	
	var login_error = function(){
		
			bootbox.confirm({
				title:'<?php D(__('project_view_Save_Search_login_error','Login Error!'));?>',
				message: '<?php D(__('project_view_Save_Search_you_are_not_logged_in','You are not Logged In. Please login first.'));?>',
				buttons: {
				'confirm': {
					label: '<?php D(__('project_view_Save_Search_you_are_not_logged_in','You are not Logged In. Please login first.'));?>',
					className: 'btn-site pull-right'
					},
				'cancel': {
					label: '<?php D(__('project_view_save_search_button_cancel','Cancel'));?>',
					className: 'btn-dark pull-left'
					}
				},
				callback: function (result) {
					if(result){
					var base_url = '<?php echo base_url();?>';
					var refer = window.location.href.replace(base_url, '');
					location.href = '<?php echo base_url('login?refer='); ?>'+refer;
					}
				}
			});

		
	};
	
	
	check_login(report_project, login_error);
	
});
}
function check_login(succ, fail){
	$.get('<?php echo get_link('IsLoginURL'); ?>', function(res){
		if(res == 1){
			if(typeof succ == 'function'){
				succ();
			}
		}else{
			if(typeof fail == 'function'){
				fail();
			}
		}
	});
}


</script>