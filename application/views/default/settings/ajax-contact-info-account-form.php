<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//dd($memberInfo,TRUE);
?>

<div class="row">
	<div class="col">
		 <form action="" method="post" accept-charset="utf-8" id="accountinfoform" class="form-horizontal" role="form" name="accountinfoform" onsubmit="updateAccountInfo();return false;">  
		<div class="row">
			<div class="col-sm-6">
				<div class="submit-field">
					<label>Name</label>
					<input type="text" class="form-control input-text with-border" value="<?php D($memberInfo->member_name)?>" name="name" id="name" placeholder="Enter Name">
					<span id="nameError" class="rerror"></span>
				</div>
			</div>			
			<div class="col-sm-6">
				<!-- Account Type -->
				<div class="submit-field">
					<label>Email</label>
					<input type="text" class="form-control input-text with-border" value="<?php D($memberInfo->member_email)?>" name="email" id="email" placeholder="Enter email address" readonly>
					<span id="emailError" class="rerror"></span>
				</div>
			</div>			
		</div>
        <button class="btn btn-site mr-2 accountUpdateBTN">Update</button>
		<a href="javascript:void(0)" class="btn btn-secondary" id="cancel_account_info">Cancel </a>
		</form>
	</div>
</div>