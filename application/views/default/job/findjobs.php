<section class="section">
<div class="container">
<!--<div class="row">
    <div class="col-xl-3 col-lg-4 col-12">
        <div class="sidebar-container">
        </div>
    </div>
    <div class="col-xl-9 col-lg-8 col-12">
    </div>
</div>-->
    
	<h3 class="page-title">Search Results</h3>
    <form id="filterForm">
    <div class="row row-10">
    	<div class="col-md-8">
            <div class="search-box input-group">
                <input type="text" class="form-control" placeholder="Find jobs by title" form="filterForm" name="term"/>
                <div class="input-group-append"><button type="button" class="btn btn-site" onclick="filterForm()"><i class="icon-feather-search"></i> Search</button></div>
            </div>
        </div>
        <div class="col-md-4">
        	<div class="d-flex">
                <a href="javascript:void(0)" class="btn btn-outline-site" onclick="$('#filterAdvance').toggle();" style="min-width:47%"><i class="icon-feather-filter"></i> Filter</a>
                <span style="width:6%">&nbsp;</span>
                <a href="javascript:void(0)" class="btn btn-outline-site" style="min-width:47%"><i class="icon-feather-heart"></i> Save Search</a>        
            </div>    
        </div>
    </div>
    <div class="row">
    	<div class="col-md-9">
        	<p class="mt-2"><i class="icon-material-outline-business-center"></i> <ec class="total_count">0</ec> jobs found</p>
        </div>
        <div class="col-md-3  text-right">
        <div class="sort-by mb-3">
        <div class="sort-by">
            <span>Sort by:</span>
            <select class="selectpicker hide-tick" name="order_by"  onchange="filterForm()">
                <option value="default">Relevance</option>
                <option value="latest">Newest</option>
                <option value="old">Oldest</option>
                <!--<option value="random">Random</option>-->
            </select>
        </div>
    
        <!--<div class="sort-group">
            <span>View by:</span>
            <a href="#" class="btn btn-outline-site"><i class="icon-feather-grid"></i></a> &nbsp;
            <a href="#" class="btn btn-outline-site active"><i class="icon-feather-list"></i></a>
        </div>-->
		</div>
        </div>
    </div>
    

    <div id="filterAdvance" style="display:none">
    
    	<div class="row">
        <!-- Category -->
        <div class="col-md-4">
        <div class="sidebar-widget">
            <h5>Category</h5>
            <select name="category" class="selectpicker default"  title="All Categories"  data-live-search="true">
                <option value="">All</option>
                <?php print_select_option($category, 'category_id', 'category_name'); ?>
            </select>
        </div>
        </div>

        <!-- Category -->
        <div class="col-md-4">
        <div class="sidebar-widget" id="sub_category_wrapper">
            <h5>Speciality</h5>
            <select name="sub_category" id="sub_category" class="selectpicker default" title="Speciality"  data-live-search="true" onchange="filterForm()">
            
            </select>
        </div>
        </div>
        
        <div class="col-md-4">
        <div class="sidebar-widget">
            <h5>Experience Level</h5>
            <select name="experience_level" class="selectpicker default" title="Experience Level"  data-live-search="true" onchange="filterForm()">
                <option value="">All</option>
                <?php print_select_option($experience_level, 'experience_level_id', 'experience_level_name'); ?>
            </select>
        </div>
        </div>
        </div>
        
        <div class="row">
        <div class="col-md-4">
        <div class="sidebar-widget">
            <h5>Job Type</h5>
            <select name="job_type" class="selectpicker default"  title="Job Type" onchange="filterForm()">
                <option value="">All</option>
                <option value="OneTime">One Time Poject</option>
                <option value="Ongoing">Ongoing Project</option>
                <option value="NotSure">Not Sure</option>
            </select>
        </div>
        </div>
        <!-- Salary -->
        <div class="col-md-4">
        <div class="sidebar-widget">
            <h5>Budget</h5>
            <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder="Min" name="min">
                </div>
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder="Max" name="max">
                </div>
            </div>
            
        </div>
        </div>
        <!--<div class="col-md-4">
        <div class="sidebar-widget">
        <h5>Sort by</h5>
        <select class="selectpicker hide-tick" name="order_by" form="filterForm" onchange="filterForm()">
            <option value="default">Relevance</option>
            <option value="latest">Newest</option>
            <option value="old">Oldest</option>
        </select>
		</div>
        </div>-->
        </div>
	</div>
	</form>
    

	<!-- Tasks Container -->
    <div class="tasks-list-container" id="job_list">
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
			
	<div class="text-center"><button class="btn btn-site" id="load_more_btn">Load More</button></div>

		
</div>
</section>

<script>
var main = function(){	
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
		
	})
}


</script>