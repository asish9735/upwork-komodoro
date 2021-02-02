<section class="section">
<div class="container">
	<div class="dashboard-headline">
    	<h1>Professionals</h1>
    </div>
	<div class="row">
		<div class="col-xl-3 col-lg-4 col-12">
        	<a href="javascript:void(0)" class="d-lg-none" id="filter" title="Filter"><i class="icon-feather-filter f20"></i></a>
			<div class="sidebar-container">	
			<form id="filterForm">			
				<!-- Location -->
				<div class="sidebar-widget" hidden>
					<h5>Location</h5>
					<div class="input-with-icon">
						<div id="autocomplete-container">
							<input type="text" class="form-control" id="autocomplete-input" placeholder="Location">
						</div>
						<span class="icon-feather-map-pin"></span>
					</div>
				</div>

				<!-- Category -->
				<div class="sidebar-widget" hidden>
					<h5>Category</h5>
					<select name="category" class="selectpicker default" data-size="7" title="All Categories"  data-live-search="true">
		                <option value="">All</option>
		                <?php print_select_option($category, 'category_id', 'category_name'); ?>
		            </select>
				</div>

				<!-- Keywords -->
				<div class="sidebar-widget" hidden>
					<h5>Keywords</h5>
					<div class="keywords-container">
						<div class="keyword-input-container">
							<input type="text" class="form-control keyword-input" placeholder="e.g. task title"/>
							<button class="keyword-input-button ripple-effect"><i class="icon-material-outline-add"></i></button>
						</div>
						<div class="keywords-list"><!-- keywords go here --></div>
						<div class="clearfix"></div>
					</div>
				</div>

				<!-- Hourly Rate -->
				<div class="sidebar-widget">
					<h5>Hourly Rate</h5>
					<div class="margin-top-25"></div>

					<!-- Range Slider -->
					<input class="range-slider" type="text" value="" data-slider-currency="$" data-slider-min="10" data-slider-max="250" data-slider-step="5" data-slider-value="[10,250]"/>
				</div>

				<!-- Tags -->
				<div class="sidebar-widget">
					<h5>Skills</h5>

					<div class="tags-container">
						<div class="tag">
							<input type="checkbox" id="tag1"/>
							<label for="tag1">front-end dev</label>
						</div>
						<div class="tag">
							<input type="checkbox" id="tag2" checked="checked"/>
							<label for="tag2">angular</label>
						</div>
						<div class="tag">
							<input type="checkbox" id="tag3"/>
							<label for="tag3">react</label>
						</div>
						<div class="tag">
							<input type="checkbox" id="tag4"/>
							<label for="tag4">vue js</label>
						</div>
						<div class="tag">
							<input type="checkbox" id="tag5"/>
							<label for="tag5">web apps</label>
						</div>
						<div class="tag">
							<input type="checkbox" id="tag6" checked="checked"/>
							<label for="tag6">design</label>
						</div>
						<div class="tag">
							<input type="checkbox" id="tag7"/>
							<label for="tag7">wordpress</label>
						</div>
					</div>
					<div class="clearfix"></div>

					<!-- More Skills -->
					<div class="keywords-container margin-top-20">
						<div class="keyword-input-container">
							<input type="text" class="form-control keyword-input" placeholder="add more skills"/>
							<button class="keyword-input-button ripple-effect"><i class="icon-material-outline-add"></i></button>
						</div>
						<div class="keywords-list"><!-- keywords go here --></div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="clearfix"></div>
			</form>
			</div>
		</div>
		<div class="col-xl-9 col-lg-8 col-12">

		<h3 class="page-title">Search Results</h3>
        <div class="row">
    		<div class="col-md-8 col-12">
            <div class="search-box input-group">
				<input type="text" class="form-control" name="term" placeholder="Find talents by name" form="filterForm"/>
                <div class="input-group-append"><button type="button" class="btn btn-site" onclick="filterForm()">Search</button></div>
			</div>
		</div>
    	<div class="col-md-4 col-12">
            <div class="sort-by">
            	<div class="sort-by">
                <span>Sort by:</span>
                <select class="selectpicker hide-tick" name="order_by" form="filterForm" onchange="filterForm()">
		            <option value="default">Relevance</option>
		            <option value="latest">Newest</option>
		            <option value="old">Oldest</option>
		        </select>
                </div>
            </div>
		</div>
        </div>
			
            

			
			<!-- Freelancers List Container -->		
            <div class="listings-container mt-4" id="talent_list">
				
				
			</div>
			<!-- Freelancers List Container / End -->
			
			<div class="text-center"><button class="btn btn-site" id="load_more_btn">Load More</button></div>
			
			<!-- Pagination -->
					<div class="pagination-container margin-top-20" hidden>
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
function loadtooltip(){
	tippy('[data-tippy-placement]', {
		delay: 100,
		arrow: true,
		arrowType: 'sharp',
		size: 'regular',
		duration: 200,
		// 'shift-toward', 'fade', 'scale', 'perspective'
		animation: 'shift-away',
		animateFill: true,
		theme: 'dark',
		// How far the tooltip is from its reference element in pixels 
		distance: 10,
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
		
		$('#talent_list').html('');
		var form = $('#filterForm').serialize();
		
		findJobLoadMore.config({
			url : '<?php echo base_url('findtalents/talent_list_ajax');?>?'+form,
			target : '#talent_list',
			load_more : '#load_more_btn',
			autoload: {
				autoload: false,
				target: 'window'
			},
			onResult: function(res){
				starRating('.star-rating');
				loadtooltip();
				history.pushState({}, null,  '<?php echo URL::get_link('search_freelancer'); ?>?'+form);
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
	$('#talent_list').on('click', '.action_favorite',function(e){
		e.preventDefault();
		var _self=$(this);
		var data = {
			mid: _self.data('mid'),
		};
		$.post('<?php echo get_link('actionfavorite_freelancer'); ?>', data, function(res){
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
	$('#talent_list').on('click', '.hire-member',function(e){
		e.preventDefault();
		var _self=$(this);
		var data = {
			mid: _self.data('mid'),
			formtype:'hire'
		};
		var hiremember = function(){
				$( "#myModal .mycustom-modal").html( '<div class="text-center padding-top-50 padding-bottom-50">'+SPINNER+'<div>' );
				$('#myModal').modal('show');
				
				$.get("<?php echo get_link('HireInviteFreelanceFormURL'); ?>",data, function( data ) {
					setTimeout(function(){ $( "#myModal .mycustom-modal").html( data );$('.selectpicker').selectpicker('refresh');},1000)
				});
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

		check_login(hiremember, login_error);
		
	})
	$('#talent_list').on('click', '.invite-member',function(e){
		e.preventDefault();
		var _self=$(this);
		var data = {
			mid: _self.data('mid'),
			formtype:'invite'
		};
		var invitemember = function(){
				$( "#myModal .mycustom-modal").html( '<div class="text-center padding-top-50 padding-bottom-50">'+SPINNER+'<div>' );
				$('#myModal').modal('show');
				
				$.get("<?php echo get_link('HireInviteFreelanceFormURL'); ?>",data, function( data ) {
					setTimeout(function(){ $( "#myModal .mycustom-modal").html( data );$('.selectpicker').selectpicker('refresh');},1000)
				});
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

		check_login(invitemember, login_error);
		
	})
	
}


</script>
