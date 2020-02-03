<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row">
	<div class="col">
		 <form action="" method="post" accept-charset="utf-8" id="changepasswordform" class="form-horizontal" role="form" name="changepasswordform" onsubmit="updatePassword();return false;">  
         <div class="submit-field">
					<h5>Old Password</h5>
					<input type="text" class="form-control input-text with-border" value="" name="old_password" id="old_password" placeholder="Enter Old Password">
					<span id="old_passwordError" class="rerror"></span>
				</div>
        <div class="submit-field">
            <h5>New Password</h5>
            <input type="text" class="form-control input-text with-border" value="" name="new_password" id="new_password" placeholder="Enter New Password">
            <span id="new_passwordError" class="rerror"></span>
        </div>
        <div class="submit-field">
            <h5>Confirm Password</h5>
            <input type="text" class="form-control input-text with-border" value="" name="confirm_password" id="confirm_password" placeholder="Enter Confirm Password">
            <span id="confirm_passwordError" class="rerror"></span>
        </div>
        <button class="btn btn-site passwordUpdateBTN">Update</button>
        <a href="javascript:void(0)" class="popup-with-zoom-anim padding-left-20" id="cancel_password">Cancel </a>
			
		</form>
	</div>
</div>