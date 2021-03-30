<?php if($page == 'add'){ ?>

<div class="modal-header">
  <h4 class="modal-title"><?php echo $title;?></h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
  <form role="form" id="add_form" action="<?php echo $form_action;?>" onsubmit="submitForm(this, event)">
    <div class="form-group">
      <label for="speciality">Speciality</label>
      <select class="form-control" name="speciality[]" id="speciality" data-placeholder="Select Speciality" multiple>
        <?php print_select_option($speciality, 'category_subchild_id', 'category_subchild_name'); ?>
      </select>
    </div>
    <div class="form-group">
      <label for="skill_key">Skill Key</label>
      <input type="text" class="form-control reset_field" id="skill_key" name="skill_key" autocomplete="off"/>
    </div>
    <?php
				$lang = get_lang();
				foreach($lang as $k => $v){ ?>
    <div class="form-group">
      <label for="name_<?php echo $v;?>">Name (<?php echo $v;?>)</label>
      <input type="text" class="form-control reset_field" id="name_<?php echo $v;?>" name="lang[skill_name][<?php echo $v; ?>]" autocomplete="off">
    </div>
    <?php } ?>
    <div class="form-group">
      <label for="skill_display_order">Display Order</label>
      <input type="text" class="form-control reset_field" id="display_order" name="skill_display_order" autocomplete="off" value="<?php echo !empty($detail['skill_display_order']) ? $detail['skill_display_order'] : '';?>">
    </div>
    <div class="form-group">
      <label class="form-label">Status</label>
      <div class="radio-inline">
        <input type="radio" name="status" value="1" class="magic-radio" id="status_1" checked>
        <label for="status_1">Active</label>
      </div>
      <div class="radio-inline">
        <input type="radio" name="status" value="0" class="magic-radio" id="status_0">
        <label for="status_0">Inactive</label>
      </div>
    </div>
    <div class="form-group">
      <div>
        <input type="checkbox" name="add_more" value="1" class="magic-checkbox" id="add_more">
        <label for="add_more">Add more record</label>
      </div>
    </div>
    <button type="submit" class="btn btn-site">Add</button>
  </form>
</div>
<script>

init_plugin();

function submitForm(form, evt){
	evt.preventDefault();
	ajaxSubmit($(form), onsuccess);
}

function onsuccess(res){
	if(res.cmd){
		if(res.cmd == 'reload'){
			location.reload();
		}else if(res.cmd == 'reset_form'){
			var form = $('#add_form');
			form.find('.reset_field').val('');
		}		
		
	}
}

$('#speciality').select2();

/* function append_val(){
	$('#speciality').html('<option>php</option><option>mysql</option>');
	$('#speciality').select2();
} */
</script>
<?php } ?>
<?php if($page == 'edit'){ ?>
<div class="modal-header">
  <h4 class="modal-title"><?php echo $title;?></h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
  <form role="form" id="add_form" action="<?php echo $form_action;?>" onsubmit="submitForm(this, event)">
    <input type="hidden" name="ID" value="<?php echo $ID?>"/>
    <div class="form-group">
      <label for="speciality">Speciality</label>
      <select class="form-control" name="speciality[]" id="speciality" data-placeholder="Select Speciality" multiple>
        <?php print_select_option($speciality, 'category_subchild_id', 'category_subchild_name', $detail['speciality']); ?>
      </select>
    </div>
    <div class="form-group">
      <label for="skill_key">Skill Key</label>
      <input type="text" class="form-control reset_field" id="skill_key" name="skill_key" autocomplete="off" value="<?php echo !empty($detail['skill_key']) ? $detail['skill_key'] : '';?>">
      <input type="hidden" name="skill_key_old" value="<?php echo !empty($detail['skill_key']) ? $detail['skill_key'] : '';?>"/>
    </div>
    <?php
				
				$lang = get_lang();
				foreach($lang as $k => $v){ ?>
    <div class="form-group">
      <label for="name_<?php echo $v;?>">Name (<?php echo $v;?>)</label>
      <input type="text" class="form-control reset_field" id="name_<?php echo $v;?>" name="lang[skill_name][<?php echo $v; ?>]" autocomplete="off" value="<?php echo !empty($detail['lang']['skill_name'][$v]) ? $detail['lang']['skill_name'][$v] : '';?>">
    </div>
    <?php } ?>
    <div class="form-group">
      <label for="skill_display_order">Display Order</label>
      <input type="text" class="form-control reset_field" id="skill_display_order" name="skill_display_order" autocomplete="off" value="<?php echo !empty($detail['skill_display_order']) ? $detail['skill_display_order'] : '';?>">
    </div>
    <div class="form-group">
      <label class="form-label">Status</label>
      <div class="radio-inline">
        <input type="radio" name="status" value="1" class="magic-radio" id="status_1" checked>
        <label for="status_1">Active</label>
      </div>
      <div class="radio-inline">
        <input type="radio" name="status" value="0" class="magic-radio" id="status_0" <?php echo $detail['skill_status'] == '0' ?  'checked' : ''; ?>>
        <label for="status_0">Inactive</label>
      </div>
    </div>
    <button type="submit" class="btn btn-site">Save</button>
  </form>
</div>
<script>

init_plugin();

function submitForm(form, evt){
	evt.preventDefault();
	ajaxSubmit($(form), onsuccess);
}

function onsuccess(res){
	if(res.cmd && res.cmd == 'reload'){
		location.reload();
	}
}

$('#speciality').select2();

</script>
<?php } ?>
