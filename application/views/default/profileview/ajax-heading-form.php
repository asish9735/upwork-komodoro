<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="modal-header">
        <button type="button" class="btn btn-dark pull-left" data-dismiss="modal">Cancel</button>
        <h4 class="modal-title">Edit your title</h4>
        <button type="button" class="btn btn-success pull-right" onclick="SaveHeading(this)">Save</button>
      </div>
    <div class="modal-body">
	    <div class="row">
			<div class="col">
				<form action="" method="post" accept-charset="utf-8" id="headingform" class="form-horizontal" role="form" name="headingform" onsubmit="return false;">  
				<input  type="hidden" value="<?php echo $formtype;?>" id="formtype" name="formtype"/>
					<div class="row">
						<div class="col-xl-12">
							<div class="submit-field">
								<h5>Your title</h5>
								<p>Enter a single sentence description of your professional skills/experience</p>
								<input type="text" class="form-control input-text with-border" value="<?php D($memberInfo->member_heading)?>" name="heading" id="heading" placeholder="EXAMPLE: Software Quality Assurance Analyst">
								<span id="headingError" class="rerror"></span>
							</div>
						</div>
       				</div>
       			</form>
       		</div>
       	</div>
    </div>