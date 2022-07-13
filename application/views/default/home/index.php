<?php $currency=get_setting('site_currency');?>
<!-- Intro Banner -->
<div class="intro-banner home-banner dark-overlay">
	<div class="container h-100">
		<!-- Intro Headline -->
		
		<!-- Search Bar -->
		<div class="row align-items-center h-100">
			<div class="col-12">
            	<div class="banner-headline-alt">
                    <h1><?php echo __('home_page_banner_header', 'Hire Experts or Be Hired For Any Job, Any Time'); ?></h1>
            		<p><?php echo __('home_page_banner_p_tag', 'Your only job platform to find the best talents, flexible job opportunities and handsome payment.'); ?></p>
				</div>
                <form method="get" action="<?php echo URL::get_link('search_freelancer'); ?>" name="searchform">
				<div class="intro-banner-search-form mb-3">
                	<!-- Search Field -->
					<div class="intro-search-field">
						<div class="input-with-icon">
							<select class="form-control" name="country">
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
					
                    <!-- Search Field -->
					<div class="intro-search-field">
						<div class="input-with-icon">
							<select class="form-control">
                            	<option>Professionals</option>
                            </select>
						</div>
					</div>
					<!-- Search Field -->
					<div class="intro-search-field">
						<input type="text" name="term" class="form-control" id="intro-keywords" placeholder="Job Title or Keywords">
					</div>

					<!-- Button -->
					<div class="intro-search-button">
						<button class="button ripple-effect"><i class="icon-feather-search"></i></button>
					</div>
				</div>
                </form>
                <ul class="p-search">
                  <li>Popular Searches:</li>
                  <li><a href="#">Mobiles</a></li>
                  <li><a href="#">Digital Marketing</a></li>
                  <li><a href="#">Writing & Translation</a></li>
                  <li><a href="#">Music & Audio</a></li>
                  <li><a href="#">Education & Training</a></li>
                </ul>  
                <a href="<?php echo URL::get_link('search_job'); ?>" class="btn btn-outline-white mr-2"><?php echo __('', 'Find Professionals'); ?></a> <a href="#" class="btn btn-outline-white"><?php echo __('', 'Find Projects'); ?></a>                         
			</div>
		</div>

		<!-- Stats
		<div class="row">
			<div class="col-md-12">
				<ul class="intro-stats margin-top-45 hide-under-992px">
					<li>
						<strong class="counter">1,586</strong>
						<span>Jobs Posted</span>
					</li>
					<li>
						<strong class="counter">3,543</strong>
						<span>Tasks Posted</span>
					</li>
					<li>
						<strong class="counter">1,232</strong>
						<span>Freelancers</span>
					</li>
				</ul>
			</div>
		</div> 
        -->
	</div>
	<!--<div class="transparent-header-spacer"></div>-->
	<!-- Video Container -->
	<div class="video-container" data-background-image="<?php echo IMAGE; ?>home-video-background-poster.jpg?54156">
		<video loop autoplay muted>
			<source src="<?php echo IMAGE; ?>home-video-background.mp4?56464" type="video/mp4">
		</video>
	</div>

</div>
<?php /*?>
<section class="home-banner">
  <?php if ($slider) { ?>
  <div class="row align-items-center h-100">
    <div class="col-12">
      <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
          <?php foreach ($slider as $k => $banner) { ?>
          <li data-target="#carouselExampleFade" data-slide-to="<?php echo $k; ?>" class="<?php if ($k == 0) {echo 'active';} ?>"></li>
          <?php } ?>
        </ol>
        <div class="carousel-inner">
          <?php foreach ($slider as $k => $banner) { ?>
          <div class="carousel-item <?php if ($k == 0) {echo 'active';} ?>"> <img src="<?php echo UPLOAD_HTTP_PATH . 'slider/' . $banner->slide_image; ?>" class="d-block w-100" alt="Banner-01"> </div>
          <?php } ?>
        </div>
        <!--<a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>-->
      </div>
    </div>
  </div>
  <?php } ?>
</section><?php */ ?>
<section class="intro-stats">
	<div class="container">
    	<div class="row row-10">
        	<article class="col-md-3">
            	<div class="card">
                	<div class="card-body">
                    	<img src="<?php echo IMAGE; ?>c1.png" alt="" height="84" width="84" />
                        <h2>7,413</h2>
                        <h5>Members</h5>
                    </div>
                </div>
            </article>
            <article class="col-md-3">
            	<div class="card">
                	<div class="card-body">
                    	<img src="<?php echo IMAGE; ?>c2.png" alt="" height="84" width="84" />
                        <h2>509</h2>
                        <h5>Projects</h5>
                    </div>
                </div>
            </article>
            <article class="col-md-3">
            	<div class="card">
                	<div class="card-body">
                    	<img src="<?php echo IMAGE; ?>c3.png" alt="" height="84" width="84" />
                        <h2>260</h2>
                        <h5>Gigs</h5>
                    </div>
                </div>
            </article>
            <article class="col-md-3">
            	<div class="card">
                	<div class="card-body">
                    	<img src="<?php echo IMAGE; ?>c4.png" alt="" height="84" width="84" />
                        <h2>100+</h2>
                        <h5>Professionals</h5>
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>

<!-- Popular Job Categories -->
<section class="section">
  <div class="container">
    <div class="section-headline centered mb-4">
      <h2><?php echo __('home_page_job_categories_h2_tag', 'Popular Category') ?></h2>
      <p><?php echo __('home_page_job_categories_p_tag', 'Find the most talented professionals from wherever you are. Hire easily and get your projects delivered in no time. Choose between the most trending categories and get them onboard.') ?></p>
    </div>
    <div class="row row-10">
      <?php
      if ($popular_category) {
        foreach ($popular_category as $k => $category) {
          $icon = NO_IMAGE;
		  $thumb = NO_IMAGE;
          if ($category['category_icon'] && file_exists(UPLOAD_PATH . 'category_icons/' . $category['category_icon'])) {
            $icon = UPLOAD_HTTP_PATH . 'category_icons/' . $category['category_icon'];
			$thumb = UPLOAD_HTTP_PATH . 'category_icons/thumb/' . $category['category_thumb'];
          }
      ?>
      <div class="col-lg-3 col-md-4 col-sm-6 col-12"> <a href="<?php echo URL::get_link('search_job'); ?>?category=<?php echo $category['category_id']; ?>" class="photo-box small" data-background-image="<?php echo $thumb; ?>"><!--images/cat_1.jpg-->
        <div class="photo-box-content">
          <div class="photo-box-icon"> <img src="<?php echo $icon; ?>" alt="<?php echo $category['category_name']; ?>" height="64" width="64" /> </div>
          <h4><?php echo $category['category_name']; ?></h4>
          <p><?php echo $category['description']; ?></p>
        </div>
        </a> </div>
      <?php
        }
      }
      ?>
    </div>
    <div class="text-center">
    	<a href="<?php D(get_link('postprojectURL'))?>" class="btn btn-site"><?php echo __('home_page_', 'Post Your Job'); ?></a>
    	<a href="<?php echo URL::get_link('search_job'); ?>" class="btn btn-site ms-2 me-2"><?php echo __('home_page_view_category', 'View All Category'); ?></a>
        <a href="<?php echo URL::get_link('search_job'); ?>" class="btn btn-site"><?php echo __('home_page_', 'Find Projects'); ?></a>
    </div>
  </div>
</section>
<!-- Popular Job Categories / End -->

<?php
if ($cms_temp) {
  foreach ($cms_temp as $k => $block) {
    if ($block->cms_class) {
      echo '<div class="' . $block->cms_class . ' pt-0">';
    }
    $child_block = array();
    if ($block->child_class) {
      $child_block = explode(',', $block->child_class);
    }
    if ($child_block) {
      foreach ($child_block as $c => $child) {
        echo '<div class="' . $child . '">';
      }
    }
    if ($block->part) {
      foreach ($block->part as $p => $part) {
        echo '<div class="' . $part->part_class . '">';
        echo html_entity_decode($part->part_content);
        echo '</div>';
      }
    }
    if ($child_block) {
      foreach ($child_block as $c => $child) {
        echo '</div>';
      }
    }
    if ($block->cms_class) {
      echo '</div>';
    }
  }
}
?>
<?php /*?>
<section class="section pt-0 how-home">
  <div class="container">
    <div class="section-headline centered mb-4">
      <h2>How It Works</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua enim ad minim veniam, quis nostrud exercitation ullamco.</p>
    </div>
    <div class="row">
      <div class="col-md-4 col-12">
        <div class="how-box">
          <div class="how-steps">
            <h2>01</h2>
          </div>
          <div class="how-box-icon"> <img src="<?php echo IMAGE;?>icon_job.png" alt="cat_2" /> </div>
          <h3>Post A Job</h3>
          <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet consectetur adipisci velit, sed quia non numquam eius.</p>
        </div>
      </div>
      <div class="col-md-4 col-12">
        <div class="how-box">
          <div class="how-steps">
            <h2>02</h2>
          </div>
          <div class="how-box-icon"> <img src="<?php echo IMAGE;?>icon_bid.png" alt="cat_2" /> </div>
          <h3>Bid Project</h3>
          <p>Duis aute irure dolor in reprehenderit voluptate velit esse cillum dolore eu fugiat nulla pariatur excepteur sint occaecat.</p>
        </div>
      </div>
      <div class="col-md-4 col-12">
        <div class="how-box">
          <div class="how-steps">
            <h2>03</h2>
          </div>
          <div class="how-box-icon"> <img src="<?php echo IMAGE;?>icon_pay.png" alt="cat_2" /> </div>
          <h3>Get Payment</h3>
          <p>Pay on an hourly basis or on a fixed price basis for the entire project through a secured payment gateway system.</p>
        </div>
      </div>
    </div>
  </div>
</section>
<?php */ ?>

<!-- Highest Rated Freelancers -->
<section class="section pt-0 full-width-carousel-fix">
  <div class="container">
    <div class="section-headline centered mb-3">
      <h2><?php echo __('home_page_freelancers_categories_h2_tag', 'Hire the Best Talents'); ?></h2>
      <p><?php echo __('home_page_freelancers_categories_p_tag', 'Collaborate with the top tier freelancers for your brands and turn your vision into reality. Have a look at the most experienced, talented and thoroughly-bred professionals.'); ?></p>
    </div>
    <div class="default-slick-carousel freelancers-container freelancers-grid-layout">
      <?php
      if ($popular_freelancer) {
        foreach ($popular_freelancer as $k => $freelancer) {
          $skills = array_map(function ($item) {
            return $item['skill_name'];
          }, $freelancer['user_skill']);
          $skills_name = implode(', ', $skills);
      ?>
      <div class="freelancer"> 
        <!-- Overview -->
        <div class="freelancer-overview">
          <div class="freelancer-overview-inner"> 
            <!-- Avatar -->
            <div class="freelancer-avatar">
              <div class="verified-badge"></div>
              <a href="<?php echo $freelancer['profile_link']; ?>"><img src="<?php echo $freelancer['user_logo']; ?>" alt="professional01"></a> </div>
            <!-- Name -->
            <div class="freelancer-name">
              <h4><a href="<?php echo $freelancer['profile_link']; ?>"><?php echo $freelancer['member_name']; ?></a>
                <?php if ($freelancer['country_code_short']) { ?>
                <img class="flag" src="<?php echo IMAGE; ?>flags/<?php echo strtolower($freelancer['country_code_short']); ?>.svg" alt="" title="<?php echo $freelancer['country_name']; ?>" data-tippy-placement="top">
                <?php } ?>
              </h4>
              <span><?php echo $freelancer['member_heading']; ?></span> </div>
            <!-- Rating -->
            <div class="freelancer-rating">
              <div class="star-rating" data-rating="<?php echo round($freelancer['avg_rating'], 2); ?>"></div>
            </div>
            <h3 class="hourly-rate"><small>$</small>10<small>/hr</small></h3>
            <p><?php echo $skills_name; ?></p>
            <div class="d-grid">
            <a href="<?php echo $freelancer['profile_link']; ?>" class="btn btn-outline-site"><?php echo __('home_page_categories_view_profile', 'View Profile'); ?></a> 
            </div>
            </div>
        </div>
      </div>
      <?php
        }
      }
      ?>
    </div>
    <div class="text-center">
    	<a href="<?php echo URL::get_link('search_freelancer'); ?>" class="btn btn-site ms-2 me-2">Find Professionals</a>
        <a href="<?php D(get_link('postprojectURL'))?>" class="btn btn-site">Post Your Service</a>
    </div>
  </div>
</section>
<!-- Highest Rated Freelancers / End --> 
<?php if($featured_proposals){?>
<section class="pb-5">
<div class="container">
	<div class="section-headline centered mb-3">
      <h2><?php echo __('home_page_', 'Featured Gigs'); ?></h2>
      <p><?php echo __('home_page_', 'The most comprehensive search engine for gigs.'); ?></p>
    </div>
    <div class="default-slick-carousel freelancers-container freelancers-grid-layout">
      <?php 
      foreach($featured_proposals as $key=>$proposal){
        $url=get_link('myProposalDetailsURL').'/'.$proposal['proposal_url'];
        $proposal_rating_details=getProposalRating($proposal['proposal_id'],array('stat'));
        $proposal_rating=0;
        $count_reviews=$proposal_rating_details->total_review;
        $average_rating=$proposal_rating_details->avg_review;
        $logo=getMemberLogo($proposal['proposal_seller_id']);
        $proposal_image=UPLOAD_HTTP_PATH.'proposals-files/proposals-thumb/'.$proposal['proposal_image'];
        $is_featured=0;
        if($proposal['proposal_featured']==1 && $proposal['featured_end_date']>date('Y-m-d H:i:s')){
          $is_featured=1;
        }
        $proposal_order_queue=$this->db->where('proposal_id',$proposal['proposal_id'])->where_in('order_status',array(ORDER_PROCESSING,ORDER_REVISION,ORDER_CANCELLATION))->from('orders')->count_all_results();
        $proposal_order_completed=$this->db->where('proposal_id',$proposal['proposal_id'])->where_in('order_status',array(ORDER_COMPLETED,ORDER_DELIVERED))->from('orders')->count_all_results();
        //print_r($proposal);
        //$is_online=is_online($proposal['proposal_seller_id']);
        ?>
    	  <div class="card card-gigs">
        	<div class="card-image">
            	<!-- <span class="bookmark-icon"></span> -->
            	<a href="<?php echo $url;?>"><img src="<?php echo $proposal_image;?>" alt="<?php echo $proposal['proposal_title'];?>" class="card-img-top" /></a>
            </div>
        	  <div class="card-body">
            	<h5><a href="<?php echo $url;?>"><?php echo $proposal['proposal_title'];?></a></h5>
                <div class="star-rating" data-rating="<?php echo round($average_rating,1);?>"></div>
                <p class="card-justify"><span>Order in Queue: <b><?php echo $proposal_order_queue;?></b></span> <span>Sell: <b><?php echo $proposal_order_completed;?></b></span></p>
                <div class="card-price"><h3><?php echo CURRENCY;?><?php echo $proposal['display_price'];?></h3> <span><i class="icon-feather-eye"></i> <?php echo $proposal['proposal_views'];?></span></div>
            </div>
        </div>
      <?php }?>


    </div>
    <div class="text-center mt-3">
    	<a href="<?php echo URL::get_link('search_freelancer'); ?>" class="btn btn-site"><?php echo __('home_page_', 'Hire Now'); ?></a>
    	<a href="<?php echo URL::get_link('search_gigs'); ?>" class="btn btn-site ms-2 me-2"><?php echo __('home_page_view_gigs', 'View All Gigs'); ?></a>
        <a href="<?php D(get_link('postproposalURL'))?>" class="btn btn-site"><?php echo __('home_page_', 'Post Gigs'); ?></a>
    </div>
</div>
</section>
<?php }?>
<section class="pb-5">
<div class="container" id="job_list">
	<div class="section-headline centered mb-3">
      <h2><?php echo __('home_page_', 'Featured Projects'); ?></h2>
      <p><?php echo __('home_page_', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua enim ad minim veniam, quis nostrud exercitation ullamco.'); ?></p>
    </div>
    <div class="blog-carousel freelancers-container freelancers-grid-layout">
    <?php 
     //get_print($job_list,false);
    if($job_list){
      foreach($job_list as $k => $v){
        $budget = !empty($v['budget']) ? $v['budget'] : 0;
        $is_fav_class="";
        if($login_user_id){
          $is_fav = isFavouriteJob($login_user_id, $v['project_id']);
          if($is_fav){
            $is_fav_class="active";
          }	
        }
        $is_online=is_online($v['owner_id']);
      ?>
        <div class="card card-project">
        	<div class="card-body">
            	<a href="<?php echo VZ;?>" class="btn btn-circle action_favorite <?php echo $is_fav_class;?>" data-pid="<?php echo md5($v['project_id']);?>"><i class="icon-line-awesome-heart"></i></a>
            	<h4><a href="<?php echo $v['project_detail_url']; ?>"><?php echo $v['project_title']; ?></a></h4>
                <p class="short-info"><?php echo $v['project_short_info']; ?></p>
                <ul class="skills">
                <?php 
                if($v['skills']){foreach($v['skills'] as $sk=>$skill){ ?>
                <li><span><?php echo $skill['skill_name'];?></span></li>
                <?php 
                if($sk==2 && count($v['skills'])>3){
                  echo '+'.(count($v['skills'])-3);
                  break;
                }
              } } ?>
                </ul>
                <p class="card-justify">
                  <span><i class="icon-feather-calendar"></i> <?php echo dateFormat($v['project_posted_date'],'M d, Y');?></span> 
                  <?php if($v['is_fixed'] == '1'){?>
                  <span><i class="icon-feather-lock"></i> Fixed</span>
                  <?php }else{?>
                  <span><i class="icon-feather-clock"></i> Hourly</span>
                  <?php }?>
                 <!-- <span><i class="icon-feather-map-pin"></i> London</span> -->
                </p>
                <div class="user-details">
                	<div class="user-avatar <?php if($is_online){echo 'status-online';}?>"><img src="<?php echo $v['clientdata']->client_logo;?>" alt="" height="32" width="32" /></div>
                	<div class="user-name">
                    	<p><?php echo getConvertedNameClient($v['clientdata']->client_name);?>
                        <?php if($v['clientdata']->country_code_short){?>
                        <img src="<?php echo IMAGE;?>flags/<?php D(strtolower($v['clientdata']->country_code_short));?>.svg" alt="" height="18" width="18" class="flag" title="<?php echo $v['clientdata']->client_location;?>" data-tippy-placement="top" />
                      <?php }?>
                      </p>
                        <div class="star-rating" data-rating="<?php echo $v['clientdata']->avg_rating;?>"></div>
                    </div>
                </div>
                <div class="d-flex align-items-end justify-content-between">
                  <h3 class="budget mb-0"><?php echo $budget > 0 ? $currency. $budget : '';?></h3>
                  <!-- <span class="bookmark-icon ml-auto"></span> -->
                  <a href="<?php echo $v['project_detail_url']; ?>" class="btn btn-outline-site btn-sm">Apply Now</a> 
                </div>
            </div>
        </div>
        <?php }
        }
      ?>
    </div>   
    <div class="text-center">
    	<a href="<?php D(get_link('postprojectURL'))?>" class="btn btn-site"><?php echo __('home_page_', 'Post New Jobs'); ?></a>
    	<a href="<?php echo URL::get_link('search_job'); ?>" class="btn btn-site ms-2 me-2"><?php echo __('home_page_view_gigs', 'View All Jobs'); ?></a>
        <a href="<?php echo URL::get_link('search_job'); ?>" class="btn btn-site"><?php echo __('home_page_', 'Find Jobs'); ?></a>
    </div> 
</div>
</section>

<section class="section looking-for">
    <div class="container">
		<div class="section-headline centered">
			<h2><?php echo __('home_page_', 'Are You Looking For a Permanent Hire?'); ?></h2>
			<p><?php echo __('home_page_', 'Advertise your full-time and part-time positions on Kommodoro Job Portal'); ?></p>
            <a href="#" class="btn btn-outline-white">Learn More</a>
		</div>
    </div>
</section>
<!-- Membership Plans -->
<?php /*?>
<section class="section pt-0">
  <div class="container"> 
    <!-- Section Headline -->
    <div class="section-headline centered margin-top-0 mb-3">
      <h2>Membership Plans</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua enim ad minim veniam, quis nostrud exercitation ullamco.</p>
    </div>
    <!-- Billing Cycle  -->
      <div class="billing-cycle-radios mb-4">
        <div class="radio billed-monthly-radio">
          <input id="radio-5" name="radio-payment-type" type="radio" checked>
          <label for="radio-5"><span class="radio-label"></span> Billed Monthly</label>
        </div>
        <div class="radio billed-yearly-radio">
          <input id="radio-6" name="radio-payment-type" type="radio">
          <label for="radio-6"><span class="radio-label"></span> Billed Yearly <span class="small-label">Save 10%</span></label>
        </div>
      </div>
    <!-- Pricing Plans Container -->
    <div class="pricing-plans-container"> 
      <!-- Plan -->
      <div class="pricing-plan">
        <h3>Basic Plan</h3>
        <div class="pricing-plan-label billed-monthly-label"><strong>Free</strong></div>
        <div class="pricing-plan-label billed-yearly-label"><strong>$499</strong>/ yr</div>
        <img src="<?php echo IMAGE;?>badge_green.png" alt="badge" class="mb-2">
        <div class="pricing-plan-features"> <strong>Features</strong>
          <ul class="list list-2">
            <li>Verified freelancer work history and reviews on Upwork</li>
            <li>Safe, easy payments</li>
            <li>Built-in collaboration features</li>
            <li>Upwork Payment Protection Plan</li>
            <li>Customer Support</li>
            <li>Transaction details reporting</li>
            <li>3 freelancer invites per job post</li>
            <li><del>Team reporting</del></li>
            <li><del>Job post and talent sourcing assistance</del></li>
            <li><del>Featured Jobs upgrade</del></li>
          </ul>
        </div>
        <a href="#" class="btn btn-site btn-block">Select Plan</a> </div>
      
      <!-- Plan -->
      <div class="pricing-plan recommended">
        <h3>Standard Plan</h3>
        <div class="pricing-plan-label billed-monthly-label"><strong>$49.99/</strong><sup>mo*</sup></div>
        <div class="pricing-plan-label billed-yearly-label"><strong>$499.99/</strong><sup>yr</sup></div>
        <img src="<?php echo IMAGE;?>badge_white.png" alt="badge" class="mb-2">
        <div class="pricing-plan-features"> <strong>Features</strong>
          <ul class="list list-2">
            <li>Verified freelancer work history and reviews on Upwork</li>
            <li>Safe, easy payments</li>
            <li>Built-in collaboration features</li>
            <li>Upwork Payment Protection Plan</li>
            <li>Premium Customer Support</li>
            <li>Team reporting</li>
            <li>Job post and talent sourcing assistance</li>
            <li>Dedicated account management</li>
            <li>15 freelancer invites per job post</li>
            <li>Featured Jobs upgrade</li>
          </ul>
        </div>
        <a href="#" class="btn btn-white btn-block">Select Plan</a> </div>
      
      <!-- Plan -->
      <div class="pricing-plan">
        <h3>Premium Plan</h3>
        <div class="pricing-plan-label billed-monthly-label"><strong>$99.99/</strong><sup>mo</sup></div>
        <div class="pricing-plan-label billed-yearly-label"><strong>$999.99/</strong><sup>yr</sup></div>
        <img src="<?php echo IMAGE;?>badge_green.png" alt="badge" class="mb-2">
        <div class="pricing-plan-features"> <strong>Features</strong>
          <ul class="list list-2">
            <li>Verified freelancer work history and reviews on Upwork</li>
            <li>Safe, easy payments</li>
            <li>Built-in collaboration features</li>
            <li>Upwork Payment Protection Plan</li>
            <li>Premium Customer Support</li>
            <li>Team reporting</li>
            <li>Job post and talent sourcing assistance</li>
            <li>Dedicated account management</li>
            <li>15 freelancer invites per job post</li>
            <li>Featured Jobs upgrade</li>
          </ul>
        </div>
        <a href="#" class="btn btn-site btn-block">Select Plan</a> </div>
    </div>
  </div>
</section>
<?php */ ?>
<!-- Membership Plans / End-->
<?php if ($testimonial) { ?>
<!-- Feedback -->
<section class="section">
  <div class="container"> 
    <!-- Section Headline -->
    <div class="section-headline centered">
      <h2><?php echo __('home_page_feedback_header', 'Client Testimonials'); ?></h2>
      <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua enim ad minim veniam, quis nostrud exercitation ullamco.</p>--> 
    </div>
    <div class="testimonial-style-5 testimonial-slider-2 poss--relative"> 
      <!-- Start Testimonial Nav -->
      <div class="testimonal-nav">
        <?php foreach ($testimonial as $k => $row) {
            $logo = IMAGE . 'default/thumb/default-member-logo.svg';
            if ($row->logo) {
              $logo = UPLOAD_HTTP_PATH . 'testimonial-icon/' . $row->logo;
            }
          ?>
        <div class="testimonal-img"> <img src="<?php echo   $logo; ?>" alt="<?php echo $row->name; ?>"> </div>
        <?php } ?>
      </div>
      <!-- End Testimonial Nav --> 
      
      <!-- Start Testimonial For -->
      <div class="testimonial-for bg-white">
        <?php
          foreach ($testimonial as $k => $row) {
          ?>
        <div class="testimonial-desc">
          <div class="triangle"></div>
          <div class="client">
            <h3><?php echo $row->name; ?></h3>
            <p><i><?php echo $row->company_name; ?></i></p>
            <div class="star-rating" data-rating="3.5"></div>  
          </div>
          <p><?php echo nl2br($row->description); ?></p>
        </div>
        <?php
          }
          ?>
      </div>
      <!-- End Testimonial For --> 
    </div>
  </div>
</section>
<!-- Feedback End -->
<?php } ?>
<!-- Choose Account -->
<section class="section choose-acc">
  <div class="container">
    <div class="row">
      <aside class="col-sm-6 col-12">
        <div class="card" style="background-image:url('<?php echo IMAGE; ?>account-bg.jpg');">
          <div class="card-body">
          	<div class="card-icon"><img src="<?php echo IMAGE; ?>j1.png" alt="icon hire" class="mb-3" /></div>
            <h3 class="mb-0"><?php echo __('home_page_choose_acc_hire_h3_tag', 'I want to hire a'); ?></h3>
            <h3><?php echo __('home_page_choose_acc_hire_h2_tag', 'Professionals'); ?></h3>
            <p><?php echo __('home_page_choose_acc_hire_p_tag', 'Your perfect talent waits! Hire the most qualified applicants from thousands of freelancers and get the job done. Find out why Upwork Clone Script is trusted by hundreds of employers.'); ?></p>
            <a href="<?php D(get_link('postprojectURL')) ?>" class="btn btn-site"><?php echo __('home_page_choose_acc_hire_a_tag', 'Post A Job'); ?></a> </div>
        </div>
      </aside>
      <aside class="col-sm-6 col-12">
        <div class="card" style="background-image:url('<?php echo IMAGE; ?>account-bg.jpg');">
          <div class="card-body">
          	<div class="card-icon"><img src="<?php echo IMAGE; ?>h1.png" alt="icon job" class="mb-3" /></div>
            <h3 class="mb-0"><?php echo __('home_page_choose_acc_job_h3_tag', 'I’m Looking for'); ?></h3>
            <h3><?php echo __('home_page_choose_acc_job_h2_tag', 'Projects'); ?></h3>
            <p><?php echo __('home_page_choose_acc_job_p_tag', 'Browse through millions of job posts, view local and international projects, discover new companies, gain trust and build a promising freelancing career. Know about the job nature, use your skill and get hired.'); ?></p>
            <a href="<?php echo URL::get_link('search_job'); ?>" class="btn btn-site"><?php echo __('home_page_choose_acc_job_a_tag', 'Get Started'); ?></a> </div>
        </div>
      </aside>
    </div>
  </div>
</section>
<!-- Choose Account End -->
<?php if ($partner) { ?>
<!-- Partner -->
<section class="section pt-0 partner">
  <div class="container"> 
    <!-- Section Headline -->
    <div class="section-headline centered">
      <h2><?php echo __('home_page_partner_section_h2_tag', 'Trusted Partners'); ?></h2>
      <p><?php echo __('home_page_partner_section_p_tag', 'Trusted by 10M+ businesses') ?></p>
    </div>
    <div class="logo-carousel">
      <?php
        foreach ($partner as $k => $row) {
          $logo = IMAGE . 'default/thumb/default-member-logo.svg';
          if ($row->box_image) {
            $logo = UPLOAD_HTTP_PATH . 'box/' . $row->box_image;
          }
        ?>
      <div class="card text-center">
        <div class="card-body"> <img src="<?php echo $logo; ?>" alt="<?php echo $row->name; ?>"> </div>
      </div>
      <?php
        }
        ?>
    </div>
  </div>
</section>
<!-- Partner End -->
<?php } ?>
<!-- Top Skills -->
<section class="section pt-0">
  <div class="container"> 
    <!-- Section Headline -->
    <div class="section-headline centered mb-4">
      <h2><?php echo __('home_page_top_skill_h2_tag', 'Top Skills') ?></h2>
    </div>
    <ul class="list list-2 top-list">
      <?php if ($popular_skills) {
        foreach ($popular_skills as $k => $sk) {

      ?>
      <li><a href="<?php echo get_link('search_freelancer') . '?byskillsname[]=' . $sk->skill_key; ?>"><?php echo $sk->skill_name; ?></a></li>
      <?php
        }
      } ?>
    </ul>
    <div class="text-center"><a href="#" class="btn btn-outline-site"><?php echo __('home_page_view_all_skill','View All Skills');?></a></div>
  </div>
</section>
<!-- Top Skills End -->
<script>
  var SPINNER='<?php load_view('inc/spinner',array('size'=>30));?>';
var main = function(){	
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
};
  </script>