<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<form action="" method="post" accept-charset="utf-8" id="changepasswordform" class="form-horizontal" role="form" name="changepasswordform" onsubmit="updatePassword();return false;">
  <div class="submit-field">
    <label>Old Password</label>
    <input type="text" class="form-control input-text with-border" value="" name="old_password" id="old_password" placeholder="Enter Old Password">
    <span id="old_passwordError" class="rerror"></span> </div>
  <div class="submit-field">
    <label>New Password</label>
    <input type="text" class="form-control input-text with-border" value="" name="new_password" id="new_password" placeholder="Enter New Password">
    <span id="new_passwordError" class="rerror"></span> </div>
  <div class="submit-field">
    <label>Confirm Password</label>
    <input type="text" class="form-control input-text with-border" value="" name="confirm_password" id="confirm_password" placeholder="Enter Confirm Password">
    <span id="confirm_passwordError" class="rerror"></span> </div>
  <button class="btn btn-site mr-2 passwordUpdateBTN">Update</button>
  <a href="javascript:void(0)" class="btn btn-secondary" id="cancel_password">Cancel </a>
</form>
