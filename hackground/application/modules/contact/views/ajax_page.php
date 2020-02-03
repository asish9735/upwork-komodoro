<?php if($page == 'reply'){ ?>
<div class="modal-header">
<h5 class="modal-title"><?php echo $title;?></h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	  <span aria-hidden="true">&times;</span></button>
	
</div>
<div class="modal-body">
		<form role="form" id="add_form" action="<?php echo $form_action;?>" onsubmit="submitForm(this, event)">
			<input type="hidden" name="ID" value="<?php echo $ID;?>"/>
              <div class="box-body">
				
				<div class="form-group">
                  <label for="email">Reply To </label>
                  <input type="email" class="form-control reset_field" id="email" name="email" value="<?php echo $detail['email'];?>" readonly />
                </div>
				
				<div class="form-group">
                  <label for="reply_message">Reply Message </label>
                  <textarea class="form-control reset_field" id="reply_message" name="reply_message" rows="8"></textarea>
                </div>
				
              </div>
              <!-- /.box-body -->
			  <div class="box-footer">
                <button type="submit" class="btn-block btn btn-primary"><i class="fa fa-reply"></i> &nbsp; Reply </button>
              </div>
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


</script>
<?php } ?>
