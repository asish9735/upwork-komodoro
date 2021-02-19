<!-- Intro Banner -->
<section class="home-banner">
<div class="row align-items-center h-100">
  <div class="col-md-7 offset-md-5 col-12">
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
	<ol class="carousel-indicators">
        <li data-target="#carouselExampleFade" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleFade" data-slide-to="1"></li>
        <li data-target="#carouselExampleFade" data-slide-to="2"></li>
	</ol>
      <div class="carousel-inner">
        <div class="carousel-item active"> <img src="<?php echo IMAGE;?>banner01.jpg" class="d-block w-100" alt="..."> </div>
        <div class="carousel-item"> <img src="<?php echo IMAGE;?>banner02.jpg" class="d-block w-100" alt="..."> </div>
        <div class="carousel-item"> <img src="<?php echo IMAGE;?>banner03.jpg" class="d-block w-100" alt="..."> </div>
      </div>
      <?php /*?><a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a><?php */?>
    </div>
  </div>
</div>
<div class="banner-search">
  <div class="container h-100">
    <div class="row align-items-center h-100">
      <div class="col-md-7 col-12">
        <div class="banner-headline">
          <h2>Lorem ipsum dolor sit amet consectetur adipiscing elit</h2>
          <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. <!--Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.--></p>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search projects or professionals" />
            <div class="input-group-append">
              <button class="btn btn-white"><i class="icon-feather-search"></i></button>
            </div>
          </div>
          <a href="#" class="btn btn-outline-white mr-2">Get Started</a> <a href="#" class="btn btn-outline-black">Watch Tutorial</a> </div>
      </div>
    </div>
  </div>
</div>
</section>
<!-- Popular Job Categories -->
<section class="section">
  <div class="container">
    <div class="section-headline centered mb-4">
      <h2>Popular Category</h2>
      <p>Below are the lists of popular job categories. The freelancers can find a suitable job category and pick up an ideal job that matches their expertise as well as professional experience.</p>
    </div>
    <div class="row row-10">
 <?php
    if($popular_category){
      foreach($popular_category as $k=>$category){
       $icon=NO_IMAGE;
       if($category['category_icon'] && file_exists(UPLOAD_PATH.'category_icons/'.$category['category_icon'])){
        $icon=UPLOAD_HTTP_PATH.'category_icons/'.$category['category_icon'];
       }
?>
      <div class="col-lg-3 col-md-4 col-sm-6 col-12"> <a href="<?php echo URL::get_link('search_job'); ?>?category=<?php echo $category['category_id'];?>" class="photo-box small" data-background-image="images/cat_1.jpg">
        <div class="photo-box-content">
          <div class="photo-box-icon"> <img src="<?php echo $icon;?>" alt="<?php echo $category['category_name'];?>" /> </div>
          <h3><?php echo $category['category_name'];?></h3>
          <p><?php echo $category['description'];?></p>
        </div>
        </a> </div>
<?php
      }
    }
?>
      
    </div>
    <div class="text-center" hidden><a href="#" class="btn btn-site">View All Category</a></div>
  </div>
</section>
<!-- Popular Job Categories / End -->

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


<!-- Highest Rated Freelancers -->
<section class="section pt-0 full-width-carousel-fix">
  <div class="container">
    <div class="section-headline centered mb-3">
      <h2>Hire Professionals</h2>
      <p>Harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus.</p>
    </div>
    <div class="default-slick-carousel freelancers-container freelancers-grid-layout"> 
<?php
    if($popular_freelancer){
      foreach($popular_freelancer as $k=>$freelancer){
        $skills = array_map(function($item) { return $item['skill_name']; }, $freelancer['user_skill']); 
        $skills_name=implode(', ', $skills);
?>
      <div class="freelancer"> 
        <!-- Overview -->
        <div class="freelancer-overview">
          <div class="freelancer-overview-inner"> 
            <!-- Avatar -->
            <div class="freelancer-avatar">
              <div class="verified-badge"></div>
              <a href="<?php echo $freelancer['profile_link'];?>"><img src="<?php echo $freelancer['user_logo'];?>" alt="professional01"></a> </div>
            <!-- Name -->
            <div class="freelancer-name">
              <h4><a href="single-freelancer-profile.html"><?php echo $freelancer['member_name'];?> <?php if($freelancer['country_code_short']){?><img class="flag" src="<?php echo IMAGE;?>flags/<?php echo strtolower($freelancer['country_code_short']);?>.svg" alt="" title="<?php echo $freelancer['country_name'];?>" data-tippy-placement="top"></a><?php }?></h4>
              <span><?php echo $freelancer['member_heading'];?></span> </div>
            <!-- Rating -->
            <div class="freelancer-rating">
              <div class="star-rating" data-rating="<?php echo round($freelancer['avg_rating'],2);?>"></div>
            </div>
            <p><?php echo $skills_name; ?></p>
            <a href="<?php echo $freelancer['profile_link'];?>" class="btn btn-outline-site btn-block">View Profile</a> </div>
        </div>
      </div>
<?php 
    }
  }
?> 

    </div>
  </div>
</section>
<!-- Highest Rated Freelancers / End --> 

<!-- Membership Plans -->
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
<!-- Membership Plans / End--> 
<!-- Feedback -->
<section class="section bg-white">
<div class="container">
<!-- Section Headline -->
<div class="section-headline centered">
  <h2>Client's Feedback</h2>
  <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua enim ad minim veniam, quis nostrud exercitation ullamco.</p>-->
</div>
<div class="testimonial-style-5 testimonial-slider-2 poss--relative">     
    <!-- Start Testimonial Nav -->
    <div class="testimonal-nav">
      <div class="testimonal-img"> <img src="<?php echo IMAGE;?>sarah.jpg" alt="testimonal image"> </div>
      <div class="testimonal-img"> <img src="<?php echo IMAGE;?>user-avatar-big-02.jpg" alt="testimonal image"> </div>
      <div class="testimonal-img"> <img src="<?php echo IMAGE;?>user-avatar-big-03.jpg" alt="testimonal image"> </div>
      <div class="testimonal-img"> <img src="<?php echo IMAGE;?>user.png" alt="testimonal image"> </div>
      <div class="testimonal-img"> <img src="<?php echo IMAGE;?>user.png" alt="testimonal image"> </div>
    </div>
    <!-- End Testimonial Nav --> 
    
    <!-- Start Testimonial For -->
    <div class="testimonial-for">
      <div class="testimonial-desc">
        <div class="triangle"></div>
        <div class="client">
          <h3>Sarah George</h3>
          <p><i>CEO and co-founder</i></p>
          <div class="star-rating" data-rating="3.5"></div>
        </div>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>
      <div class="testimonial-desc">
        <div class="triangle"></div>
        <div class="client">
          <h3>Michelle Mitchell</h3>
          <p><i>Director</i></p>
          <div class="star-rating" data-rating="3.5"></div>
        </div>
        <p>Nipa ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
      </div>
      <div class="testimonial-desc">
        <div class="triangle"></div>
        <div class="client">
          <h3>Ryan Garcia</h3>
          <p><i>Social Activist</i></p>
          <div class="star-rating" data-rating="3.5"></div>
        </div>
        <p>Np ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
      </div>
      <div class="testimonial-desc">
        <div class="triangle"></div>
        <div class="client">
          <h3>Klaus Gruber</h3>
          <p><i>Marketing Head</i></p>
          <div class="star-rating" data-rating="3.5"></div>
        </div>
        <p>Supa ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
      </div>
      <div class="testimonial-desc">
        <div class="triangle"></div>
        <div class="client">
          <h3>Amanda Cook</h3>
          <p><i>XYZ Company</i></p>
          <div class="star-rating" data-rating="3.5"></div>
        </div>
        <p>Nerum vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi.</p>
      </div>
    </div>
    <!-- End Testimonial For --> 
  </div>
</div>
</section>
<!-- Feedback End --> 

<!-- Choose Account -->
<section class="section choose-acc">
    <div class="container">
    	<div class="row">
        	<aside class="col-sm-6 col-12">
            	<div class="card text-center">
                	<div class="card-body">
                    	<img src="<?php echo IMAGE;?>icon_hire.png" alt="icon hire" class="mb-3">
                    	<h3>I want to hire a</h3>
                        <h2>Professionals</h2>                        
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
                        <a href="<?php D(get_link('postprojectURL'))?>" class="btn btn-outline-site">Post A Job</a>
                    </div>
                </div>
            </aside>
            <aside class="col-sm-6 col-12">
            	<div class="card text-center">
                	<div class="card-body">
                    	<img src="<?php echo IMAGE;?>icon_job.png" alt="icon job" class="mb-3">
                    	<h3>I'm looking for</h3>
                        <h2>Projects</h2>                        
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        <a href="<?php echo URL::get_link('search_job'); ?>" class="btn btn-outline-site">Get Started</a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>
<!-- Choose Account End -->

<!-- Partner -->
<section class="section pt-0 partner">
<div class="container">
    <!-- Section Headline -->
    <div class="section-headline centered">
      <h2>Trusted Partners</h2>
      <p>Trusted by 10M+ businesses</p>
    </div>	
    <div class="logo-carousel">    	
        	<div class="card text-center">
            	<div class="card-body">
                	<img src="<?php echo IMAGE;?>partner01.png" alt="partner">
                </div>
            </div>
        
        	<div class="card text-center">
            	<div class="card-body">
                	<img src="<?php echo IMAGE;?>partner02.png" alt="partner">
                </div>
            </div>
        
        	<div class="card text-center">
            	<div class="card-body">
                	<img src="<?php echo IMAGE;?>partner03.png" alt="partner">
                </div>
            </div>
        
        	<div class="card text-center">
            	<div class="card-body">
                	<img src="<?php echo IMAGE;?>partner04.png" alt="partner">
                </div>
            </div>
        
        	<div class="card text-center">
            	<div class="card-body">
                	<img src="<?php echo IMAGE;?>partner05.png" alt="partner">
                </div>
            </div>   
            <div class="card text-center">
            	<div class="card-body">
                	<img src="<?php echo IMAGE;?>partner01.png" alt="partner">
                </div>
            </div>
        
        	<div class="card text-center">
            	<div class="card-body">
                	<img src="<?php echo IMAGE;?>partner02.png" alt="partner">
                </div>
            </div>     
	</div>
</div>
</section>
<!-- Partner End -->

<!-- Top Skills -->
<section class="section pt-0">
<div class="container">
    <!-- Section Headline -->
    <div class="section-headline centered mb-4">
      <h2>Top Skills</h2>
    </div>
    <ul class="list list-2 top-list">
    <?php if($popular_skills){
        foreach($popular_skills as $k=>$sk){

      ?>
        <li><a href="<?php echo get_link('search_freelancer').'?byskillsname[]='.$sk->skill_key;?>"><?php echo $sk->skill_name;?></a></li>
    <?php 
        }
      }?>
       
	</ul>
    <div class="text-center" hidden><a href="#" class="btn btn-outline-site">View All Skills</a></div>
</div>
</section>
<!-- Top Skills End -->


