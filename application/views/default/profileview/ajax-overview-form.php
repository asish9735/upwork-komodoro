<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="modal-header">
        <button type="button" class="btn btn-dark pull-left" data-dismiss="modal">Cancel</button>
        <h4 class="modal-title">Overview</h4>
        <button type="button" class="btn btn-success pull-right" onclick="SaveOverview(this)">Save</button>
      </div>
    <div class="modal-body">
	    <div class="row">
			<div class="col">
				<form action="" method="post" accept-charset="utf-8" id="overviewform" class="form-horizontal" role="form" name="overviewform" onsubmit="return false;">  
				<input  type="hidden" value="<?php echo $formtype;?>" id="formtype" name="formtype"/>
					<div class="row">
						<div class="col-xl-12">
							<div class="submit-field">
								<p>Use this space to show clients you have the skills and experience they're looking for.</p>
								<ul>
									<li>Describe your strengths and skills</li>
									<li>Highlight projects, accomplishments and education</li>
									<li>Keep it short and make sure it's error-free</li>
								</ul>
								<textarea  class="form-control input-text with-border" name="overview" id="overview" placeholder="I can ensure the quality of software while leveraging my coding abilities to build and utilize complex testing tools. I am proficient in all stages of the QA process from test planning to post-release verification. Throughout my QA career, I have worked in many different environments, following methodologies from Agile SCRUM to Waterfall."><?php D($memberInfo->member_overview)?></textarea>
								<span id="overviewError" class="rerror"></span>
							</div>
						</div>
       				</div>
       			</form>
       		</div>
       	</div>
    </div>