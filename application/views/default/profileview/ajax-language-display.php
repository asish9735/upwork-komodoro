<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<ul class="langList">
<?php if($memberInfo){
	foreach($memberInfo as $language){
		
	?>
<li class="language-contain">
<b><?php D($language->language_name)?>:</b> <?php D($language->language_preference_name)?>
<?php if($is_editable){?>
	<div class="float-right">
		<a href="javascript:void(0)" class="edit_account_btn btn btn-secondary btn-circle" data-popup="language" data-popup-id="<?php D($language->member_language_id)?>" data-tippy-placement="top" title="Edit language"><i class="icon-feather-edit"></i></a> 
		<a href="javascript:void(0)" class="delete_account_btn btn btn-danger btn-circle" data-popup="language" data-popup-id="<?php D($language->member_language_id)?>" data-tippy-placement="top" title="Delete language"><i class="icon-feather-trash-2"></i></a>
	</div>
<?php }?>
</li>
<?php }
	}
?>
</ul>