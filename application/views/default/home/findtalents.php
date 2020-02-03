<div class="margin-top-50"></div>
<div class="container">
	<div class="row">
		<div class="col-xl-3 col-lg-4 col-12">
			<div class="sidebar-container">
				
				<!-- Location -->
				<div class="sidebar-widget">
					<h3>Location</h3>
					<div class="input-with-icon">
						<div id="autocomplete-container">
							<input type="text" class="form-control" id="autocomplete-input" placeholder="Location">
						</div>
						<i class="icon-feather-map-pin"></i>
					</div>
				</div>

				<!-- Category -->
				<div class="sidebar-widget">
					<h3>Category</h3>
					<select class="form-control selectpicker default" multiple data-selected-text-format="count" data-size="7" title="All Categories" >
						<option>Admin Support</option>
						<option>Customer Service</option>
						<option>Data Analytics</option>
						<option>Design & Creative</option>
						<option>Legal</option>
						<option>Software Developing</option>
						<option>IT & Networking</option>
						<option>Writing</option>
						<option>Translation</option>
						<option>Sales & Marketing</option>
					</select>
				</div>

				<!-- Keywords -->
				<div class="sidebar-widget">
					<h3>Keywords</h3>
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
					<h3>Hourly Rate</h3>
					<div class="margin-top-55"></div>

					<!-- Range Slider -->
					<input class="range-slider" type="text" value="" data-slider-currency="$" data-slider-min="10" data-slider-max="250" data-slider-step="5" data-slider-value="[10,250]"/>
				</div>

				<!-- Tags -->
				<div class="sidebar-widget">
					<h3>Skills</h3>

					<div class="tags-container">
						<div class="tag">
							<input type="checkbox" id="tag1"/>
							<label for="tag1">front-end dev</label>
						</div>
						<div class="tag">
							<input type="checkbox" id="tag2"/>
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
							<input type="checkbox" id="tag6"/>
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

			</div>
		</div>
		<div class="col-xl-9 col-lg-8 col-12">

			<h3 class="page-title">Search Results</h3>
            <div class="sort-by mb-2">
					<span>Sort by:</span>
					<select class="selectpicker hide-tick">
						<option>Relevance</option>
						<option>Newest</option>
						<option>Oldest</option>
						<option>Random</option>
					</select>
				</div>

			<div class="search-box input-group margin-top-15">
				<input type="text" class="form-control" placeholder="Find talents by name" />
                <div class="input-group-append"><button type="button" class="btn btn-site">Search</button></div>
			</div>
            

			
			<!-- Freelancers List Container -->		
            <div class="listings-container margin-top-30">
				
				<!-- Freelancer -->
				<div class="job-listing">

					<!-- Job Listing Details -->
					<div class="job-listing-details">
						<!-- Logo -->
						<div class="job-listing-company-logo">
							<a href="#"><img src="<?php echo IMAGE;?>user-avatar-big-01.jpg" alt="">
                            <span class="verified-badge"></span></a>
						</div>

						<!-- Details -->
						<div class="job-listing-description">	
                        	<div class="freelancer-about">
                        	<div class="freelancer-intro">						
                                <h3 class="job-listing-title"><a href="#">David Peterson</a></h3>
                                <span class="text-muted">iOS Expert + Node Dev</span>
                                <div class="freelancer-rating">
                                    <div class="star-rating" data-rating="4.5"></div>
                                </div>
                            </div>
                            
                            <div class="freelancer-details-list">
                                <ul>
                                    <li>Location <strong><i class="icon-feather-map-pin"></i> London</strong></li>
                                    <li>Rate <strong>$60 / hr</strong></li>
                                    <li>Job Success <strong>95%</strong></li>
                                </ul>
                            </div>
                                
                            </div>
                            
							<p class="job-listing-text">Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value.</p>
                            <div class="task-tags">
                                <a href="#">Accounting</a>
                                <a href="#">Analytics</a>
                                <a href="#">Brand Licensing</a>
                                <a href="#">Business Development</a>
                                <a href="#">Financial Management</a>
                            </div>
						</div>
					</div>					
				</div>		

				<!-- Freelancer -->
				<div class="job-listing">

					<!-- Job Listing Details -->
					<div class="job-listing-details">
						<!-- Logo -->
						<div class="job-listing-company-logo">
							<a href="#"><img src="<?php echo IMAGE;?>user-avatar-big-01.jpg" alt="">
                            <span class="verified-badge"></span></a>
						</div>

						<!-- Details -->
						<div class="job-listing-description">	
                        	<div class="freelancer-about">
                        	<div class="freelancer-intro">						
                                <h3 class="job-listing-title"><a href="#">David Peterson</a></h3>
                                <span class="text-muted">iOS Expert + Node Dev</span>
                                <div class="freelancer-rating">
                                    <div class="star-rating" data-rating="4.5"></div>
                                </div>
                            </div>
                            
                            <div class="freelancer-details-list">
                                <ul>
                                    <li>Location <strong><i class="icon-feather-map-pin"></i> London</strong></li>
                                    <li>Rate <strong>$60 / hr</strong></li>
                                    <li>Job Success <strong>95%</strong></li>
                                </ul>
                            </div>
                                
                            </div>
                            
							<p class="job-listing-text">Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value.</p>
                            <div class="task-tags">
                                <a href="#">Accounting</a>
                                <a href="#">Analytics</a>
                                <a href="#">Brand Licensing</a>
                                <a href="#">Business Development</a>
                                <a href="#">Financial Management</a>
                            </div>
						</div>
					</div>					
				</div>
				
				<!-- Freelancer -->
				<div class="job-listing">

					<!-- Job Listing Details -->
					<div class="job-listing-details">
						<!-- Logo -->
						<div class="job-listing-company-logo">
							<a href="#"><img src="<?php echo IMAGE;?>user-avatar-big-01.jpg" alt="">
                            <span class="verified-badge"></span></a>
						</div>

						<!-- Details -->
						<div class="job-listing-description">	
                        	<div class="freelancer-about">
                        	<div class="freelancer-intro">						
                                <h3 class="job-listing-title"><a href="#">David Peterson</a></h3>
                                <span class="text-muted">iOS Expert + Node Dev</span>
                                <div class="freelancer-rating">
                                    <div class="star-rating" data-rating="4.5"></div>
                                </div>
                            </div>
                            
                            <div class="freelancer-details-list">
                                <ul>
                                    <li>Location <strong><i class="icon-feather-map-pin"></i> London</strong></li>
                                    <li>Rate <strong>$60 / hr</strong></li>
                                    <li>Job Success <strong>95%</strong></li>
                                </ul>
                            </div>
                                
                            </div>
                            
							<p class="job-listing-text">Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value.</p>
                            <div class="task-tags">
                                <a href="#">Accounting</a>
                                <a href="#">Analytics</a>
                                <a href="#">Brand Licensing</a>
                                <a href="#">Business Development</a>
                                <a href="#">Financial Management</a>
                            </div>
						</div>
					</div>					
				</div>

				<!-- Freelancer -->
				<div class="job-listing">

					<!-- Job Listing Details -->
					<div class="job-listing-details">
						<!-- Logo -->
						<div class="job-listing-company-logo">
							<a href="#"><img src="<?php echo IMAGE;?>user-avatar-big-01.jpg" alt="">
                            <span class="verified-badge"></span></a>
						</div>

						<!-- Details -->
						<div class="job-listing-description">	
                        	<div class="freelancer-about">
                        	<div class="freelancer-intro">						
                                <h3 class="job-listing-title"><a href="#">David Peterson</a></h3>
                                <span class="text-muted">iOS Expert + Node Dev</span>
                                <div class="freelancer-rating">
                                    <div class="star-rating" data-rating="4.5"></div>
                                </div>
                            </div>
                            
                            <div class="freelancer-details-list">
                                <ul>
                                    <li>Location <strong><i class="icon-feather-map-pin"></i> London</strong></li>
                                    <li>Rate <strong>$60 / hr</strong></li>
                                    <li>Job Success <strong>95%</strong></li>
                                </ul>
                            </div>
                                
                            </div>
                            
							<p class="job-listing-text">Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value.</p>
                            <div class="task-tags">
                                <a href="#">Accounting</a>
                                <a href="#">Analytics</a>
                                <a href="#">Brand Licensing</a>
                                <a href="#">Business Development</a>
                                <a href="#">Financial Management</a>
                            </div>
						</div>
					</div>					
				</div>


			</div>
			<!-- Freelancers List Container / End -->

			<!-- Pagination -->
			<div class="pagination-container margin-top-40 margin-bottom-60">
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