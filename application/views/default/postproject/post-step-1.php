<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//dd($memberInfo,TRUE);
?>
<div id="dataStep-1" style="display: nones">
				<!-- Dashboard Box -->
                <div class="dashboard-box margin-top-0">
                    <!-- Headline -->
                    <div class="headline">
                        <h3> Title </h3>
                    </div>
                    <div class="content with-padding">
                        <h5>Name of your project</h5>
                        <input type="text"  class="form-control" name="title" id="title">
                        <span id="titleError" class="rerror"></span>
                    </div>
                </div>
				
					
                <div class="dashboard-box">
						<!-- Headline -->
						<div class="headline">
							<h3> Category </h3>
						</div>
						<div class="content with-padding">
								<div class="submit-field remove_arrow_select">
									<select name="category" id="category" data-size="4" class="selectpicker browser-default" title="Category" data-live-search="true">
					            	<?php
				            		if($all_category){
										foreach($all_category as $category_list){
											?>
											<option value="<?php D($category_list->category_id);?>" ><?php D(ucfirst($category_list->category_name));?></option>
											<?php
										}
									}
				            		 ?>
				            		</select>
								
								<span id="categoryError" class="rerror"></span>
                                </div>
							
							<div class="sub_category_display" style="display: none">
							<div class="remove_arrow_select">
								<div id="load_sub_category">
								<select name="sub_category" id="sub_category" data-size="4" class="selectpicker browser-default" title="Sub category" data-live-search="true">
				            	
			            		</select>
			            		</div>
							</div>
							<span id="sub_categoryError" class="rerror"></span>
						</div>
                        	
						</div>
                        <div class="dashboard-box-footer">
                            <button class="btn btn-secondary backbtnproject" data-step="1">Back</button>
                            <button class="btn btn-site nextbtnproject" data-step="1">Next</button>
                        </div>
						
					</div>
</div>