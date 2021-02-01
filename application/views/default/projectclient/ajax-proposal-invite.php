<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="modal-header">
        <button type="button" class="btn btn-dark pull-left" data-dismiss="modal">Cancel</button>
        <h4 class="modal-title">Invite user</h4>
        <button type="button" class="btn btn-success pull-right" onclick="SaveInvite(this)">Invite</button>
      </div>
    <div class="modal-body">
	    <div class="row">
			<div class="col">
				<form action="" method="post" accept-charset="utf-8" id="inviteform" class="form-horizontal" role="form" name="inviteform" onsubmit="return false;">  
				<input  type="hidden" value="<?php echo $req_type;?>" id="formtype" name="formtype"/>
				<input  type="hidden" value="<?php echo $projects['project_id'];?>" id="project_id" name="project_id"/>
					<div class="row">
						<div class="col-xl-12">
							<div class="submit-field">
								<p>Put all email address by comma separated for invitation to your project</p>
								
								<div class="keywords-list inviteContaintag">
									
                                </div>
                                <div class="clearfix"></div>
								<input  class="form-control input-text with-border tagsinput_skill" name="emails" id="emails" data-role="tagsinput" >
								<span id="emailsError" class="rerror"></span>
								<span id="invalidemailError" class="rerror invalid-feedback"><span class=" icon-line-awesome-exclamation-circle" aria-hidden="true"></span>Invalid email address</span>
							</div>
						</div>
       				</div>
       			</form>
       		</div>
       	</div>
    </div>
<script>
var inviteemails=[];
function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}
function checkexistsemail(email){
	if(inviteemails.indexOf(email) !== -1){
		return false;
	}else{
		return true;
	}
}
function removeemail(ev){
	var keysec=$(ev).closest('.keyword').find('input').val();
	$(ev).closest('.keyword').remove();
	var a = inviteemails.indexOf(keysec);
	if(a!== -1){
		console.log(a);
		inviteemails.splice(a, 1);
	}
	//console.log(inviteemails);
}
function SaveInvite(ev){
		var buttonsection=$(ev);
		var buttonval = buttonsection.html();
		buttonsection.html(SPINNER).attr('disabled','disabled');
		var formID="inviteform";
		$.ajax({
	        type: "POST",
	        url: "<?php D(get_link('myProjectBidsClientStatusAjaxURL'))?>",
	        data:$('#'+formID).serialize(),
	        dataType: "json",
	        cache: false,
			success: function(msg) {
				buttonsection.html(buttonval).removeAttr('disabled');
				clearErrors();
				if (msg['status'] == 'OK') {
					load_count(<?php D($projects['project_id']);?>)
					$('#myModal').modal('hide');
				} else if (msg['status'] == 'FAIL') {
					registerFormPostResponse(formID,msg['errors']);
				}
			}
		})
}
var elt = $('input.tagsinput_skill');
elt.tagsinput({allowDuplicates: false,trimValue: true});
elt.on('beforeItemAdd', function(event) {
	$('#invalidemailError').hide();
	var itemdata=event.item;
	var name=itemdata;
	if (validateEmail(name) && checkexistsemail(name)) {
		var html='<span class=" keyword" ><span class="keyword-remove" onclick="removeemail(this)"></span><span class="keyword-text">'+name+'</span><input type="hidden" name="inviteemails[]" value="'+name+'"/></span>';
    	$(".inviteContaintag").append(html);
		inviteemails.push(name);
	}else{
		$('#invalidemailError').show();
	}
    //console.log(inviteemails);
	//console.log(event.item);
   // elt.tagsinput('add', itemdata);
	event.cancel = true;
})
</script>