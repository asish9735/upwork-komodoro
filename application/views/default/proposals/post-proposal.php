<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* echo '<pre>';
print_r($proposalData);
echo '</pre>'; */
?>
<style>

</style>
<div class="dashboard-container">

<!-- Dashboard Content
	================================================== -->
	<div class="dashboard-content-container" >
		<div class="container">
		<div class="dashboard-content-inner" >
			<div class="row justify-content-center">
            <div class="col-xl-9 col-lg-11 col-12">
			<!-- Dashboard Headline -->
            <div id="postJobStepItem" class="post-steps">
                <a class="active"><span class="count">1</span> <span><i class="icon-feather-tag"></i> <?php echo __('postproposal_overview','Overview');?></span></a>
                <a><span class="count">2</span> <span><i class="icon-feather-dollar-sign"></i> <?php echo __('postproposal_price','Price');?></span></a>
                <a><span class="count">3</span> <span><i class="icon-feather-file-text"></i> <?php echo __('postproposal_description','Description');?></span></a>
                <a><span class="count">4</span> <span><i class="icon-feather-award"></i> <?php echo __('postproposal_requirements','Requirements');?></span></a>
                <a><span class="count">5</span> <span><i class="icon-feather-image"></i> <?php echo __('postproposal_gallery','Gallery');?></span></a>
                <a><span class="count">6</span> <span><i class="icon-feather-eye"></i> <?php echo __('postproposal_publish','Publish');?></span></a>
            </div>
			
			<form action="" method="post" accept-charset="utf-8" id="postproposalform" class="form-horizontal" role="form" name="postproposalform" onsubmit="return false;">  
            <input type="hidden" name="dataid" value="<?php echo $itemid;?>"/>
			<?php
			$this->layout->view('post-step-1', array('step'=>1,'all_category'=>$all_category,'proposalData'=>$proposalData),TRUE);
			
			$this->layout->view('post-step-2', array('step'=>2,'proposalData'=>$proposalData),TRUE);
			$this->layout->view('post-step-3', array('step'=>3,'proposalData'=>$proposalData),TRUE);
			$this->layout->view('post-step-4', array('step'=>4,'proposalData'=>$proposalData),TRUE);
			$this->layout->view('post-step-5', array('step'=>5,'proposalData'=>$proposalData),TRUE);
			$this->layout->view('post-step-6', array('step'=>6,'proposalData'=>$proposalData),TRUE);
			
			?>
			</form>		
					
				</div>
			</div>
			<!-- Row -->
			
			<!-- Row / End -->

			<!-- Footer -->
			<div class="dashboard-footer-spacer"></div>
			
			<!-- Footer / End -->

		</div>
		</div>
	</div>
	<!-- Dashboard Content / End -->

</div>
<!--<style>
form>div {
	display:block !important
}
</style>-->
<div id="question_template" class="d-none">
	<div class="question_sec mb-3">
	<div class="submit-field">
		<div class="input-group ">
			<input type="text" class="form-control input-text with-border" name="question[]" placeholder="Add a Question">
			<div class="input-group-append">
				<a href="javascript:void(0)" class="btn text-danger" onclick="$(this).closest('.question_sec').remove()">
					<i class="icon-feather-x f20"></i>
				</a>
			</div>
		</div>
	</div>
	<div class="submit-field">
		<textarea rows="4" class="form-control" name="answer[]" placeholder="Answer"></textarea>
	</div>
	</div>	
</div>
<div id="myModal" class="modal fade" tabindex="-1" role="dialog"  style="z-index: 10000"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document"> 
    <!-- Modal content-->
    <div class="modal-content mycustom-modal">
      <div class="text-center padding-top-50 padding-bottom-50">
	  <?php load_view('inc/spinner',array('size'=>30));?>
      </div>
    </div>
  </div>
</div>
<script>
var SPINNER_CIRCLE='<?php load_view('inc/process-circle',array('size'=>30));?>';
var pre_skills=[];
</script>
<?php
if($proposalData && $proposalData['proposal_skills']){
    $myskills=$proposalData['proposal_skills'];
?>
<script>
var pre_skills=<?php D(json_encode($myskills));?>;
</script>
<?php
}
?>

<script type="text/javascript">
	var SPINNER='<?php load_view('inc/spinner',array('size'=>30));?>';
	var all_skills=<?php D(json_encode($all_skills));?>;
	function removeFile(index){
	$('#file_'+index).remove();
}
	function load_data(type){
		$( "#proposal-"+type+"-data").html('<div class="text-center" style="min-height: 70px;width: 100%;line-height: 50px;">'+SPINNER+'<div>').show();
		if(type=='title'){
			$('#preview_title').html($('#title').val());
			$('#preview_category').html($('#category option:selected').text()+', '+$('#sub_category option:selected').text());
			$('#preview_skills').empty();
			$('#dataStep-1 .bootstrap-tagsinput span.tag').each(function(){
				console.log($(this).text());
				$('#preview_skills').append('<span class="m-1">'+$(this).text()+'</div>');
			})
		}else if(type=='description'){
			$('#preview_description').html($('#description').val().replace(/\r?\n/g,'<br/>'));
			$('#preview_attachment_sec').hide();
			$('#preview_attachment').empty();
			$('#uploadfile_container .thumbnail_sec').each(function(){
				$('#preview_attachment').append('<div>'+$(this).text()+'</div>');
				$('#preview_attachment_sec').show();
			})
		}else if(type=='details'){
			var preview_proposalType=$('input[name="proposalType"]:checked').parent('label').text();
			$('#preview_proposalType').html(preview_proposalType);
			var is_cover_required="No";
			if($('#is_cover_required').is(':checked')){
				var is_cover_required="Yes";
			}
			$('#preview_is_cover_required').html(is_cover_required);
			$('#addQuestion_container .question_sec').each(function(){
				$('#preview_question_sec').append('<p class="margin-bottom-5">'+$(this).find('input').val()+'</p>');
			})
			$('#preview_question_sec').show();
			
			
		}else if(type=='expertise'){
			$('#preview_skills').empty();
			$('#dataStep-4 .bootstrap-tagsinput span.tag').each(function(){
				console.log($(this).text());
				$('#preview_skills').append('<span class="m-1">'+$(this).text()+'</div>');
			})
		}else if(type=='visibility'){
			var proposalVisibility=$('input[name="proposalVisibility"]:checked').parent('label').text();
			$('#preview_proposalVisibility').html(proposalVisibility);
			var member_required=$('input[name="member_required"]:checked').val();
			if(member_required=='S'){
				$('#preview_no_of_freelancer').html('1');
			}else{
				$('#preview_no_of_freelancer').html($('#no_of_freelancer').val());
			}
		}else if(type=='budget'){
			var proposalPaymentType=$('input[name="proposalPaymentType"]:checked').val();
			if(proposalPaymentType=='hourly'){
				$('#preview_proposalPaymentType').html('Pay by the hour');
			}else{
				$('#preview_proposalPaymentType').html('Pay by the fixed'+" <?php D(priceSymbol())?>"+$('#fixed_budget').val());
			}
			var preview_experience_level=$('input[name="experience_level"]:checked').parent('label').text();
			$('#preview_experience_level').html(preview_experience_level);
			var preview_hourly_duration=$('input[name="hourly_duration"]:checked').parent('label').text();
			$('#preview_hourly_duration').html(preview_hourly_duration);
			var preview_hourly_duration_time=$('input[name="hourly_duration_time"]:checked').parent('label').text();
			$('#preview_hourly_duration_time').html(preview_hourly_duration_time);		
		}

	}
	function uploadFiles(ele){
	var files = ele.files;
	if(files.length > 0){
		for(i=0; i < files.length; i++){
			uploadOne(files[i] , i);
		}
	}
 }
	function uploadOne(file , ind){
	var formdata = new FormData();
	formdata.append('file', file);
	var file_name = file.name;
	
	var u_key = new Date().getTime()+'_'+ind;
	var html = ' <div class="uploaded_wrapper" id="file_'+u_key+'"> <div class="row mb-2"><div class="col"><span>'+file_name+'</span><p style="color:red" id="progress_error_'+u_key+'"></p><div id="progress_'+u_key+'"><div class="progress"><div class="progress-bar" role="progressbar" id="progress_bar_'+u_key+'" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:0%;"> 0 % </div></div></div></div><div class="col-auto text-right" id="remove_'+u_key+'"></div></div></div>';
	
	$('#uploaded_files').append(html);

	$.ajax({
		xhr: function() {
		var xhr = new window.XMLHttpRequest();
		xhr.upload.addEventListener("progress", function(evt) {
		  if (evt.lengthComputable) {
			var percentComplete = evt.loaded / evt.total;
			percentComplete = parseInt(percentComplete * 100);
			
			
			$('#progress_bar_'+u_key).css("width" , percentComplete + '%');
			$('#progress_bar_'+u_key).html(percentComplete + '%');
			

		  }
		}, false);

		return xhr;
	  },
		url : '<?php D(get_link('proposaluploadFileFormCheckAJAXURL'))?>?type=image',
		type: 'POST',
		data : formdata,
		dataType: 'json',
		contentType: false,
		processData: false,
		success: function(res){
			if(res['status'] == 'OK'){
				var html = '<input type="hidden" name="proposalfile[]" value=\''+JSON.stringify(res.upload_response)+'\'/>';
				$('#file_'+u_key).append(html);
				$('#remove_'+u_key).html('<a href="javascript:void(0)" class="text-danger" onclick="removeFile(\''+u_key+'\')"><i class="icon-feather-trash"></i></a>');
			}else{
				$('#progress_error_'+u_key).html(res['error']);
				$('#remove_'+u_key).html(' <a href="javascript:void(0)" class="text-danger" onclick="removeFile(\''+u_key+'\')"><i class="icon-feather-trash"></i></a>');
			}
			$('#progress_'+u_key).remove();
			
		}
	});

}
function uploadDataVideo(formdata){
	var vnum =1;	
	$("#uploadfile_container_video").html('<div id="thumbnailv_'+vnum+'" class="thumbnail_sec_video  mt-3"><div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div></div></div>');
    $.ajax({
        url: '<?php D(get_link('proposaluploadFileFormCheckAJAXURL'))?>?type=video',
        type: 'post',
        data: formdata,
        contentType: false,
        processData: false,
        dataType: 'json',
		xhr: function(){
			//upload Progress
			var xhr = $.ajaxSettings.xhr();
			if (xhr.upload) {
				xhr.upload.addEventListener('progress', function(event) {
					var percent = 0;
					var position = event.loaded || event.position;
					var total = event.total;
					if (event.lengthComputable){
						percent = Math.ceil(position / total * 100);
					}
					if(percent==50){
						return false;
					}
					//update progressbar
					$("#thumbnailv_"+vnum).find(".progress-bar").css("width", + percent +"%").html(percent +"%");
				}, true);
			}
			return xhr;
		},
        success: function(response){
        	$('#fileinputvideo').val('');
           if(response.status=='OK'){
    			var name = response.upload_response.original_name;
    			$("#thumbnailv_"+vnum).html('<input type="hidden" id="proposalvideo" name="proposalvideo" value=\''+JSON.stringify(response.upload_response)+'\'/> '+name+'<a href="javascript:void(0)" class="float-right text-danger" onclick="$(this).parent().remove();$(\'.setvideothumb\').hide();$(\'#videothumb\').val(\'\');	"><i class="icon-feather-trash"></i></a>');
$('.setvideothumb').show();	removeVideoThumb();	   
		   }else{
		   		$("#thumbnailv_"+vnum).html('<p class="text-danger">Error in upload file</p>');
		   }
           
        },
        
    }).fail(function(){
    	$("#thumbnailv_"+vnum).html('<p class="text-danger">Error occurred</p>');
    });
}
function openmodalVideo(){
	$( "#myModal .mycustom-modal").html( '<div class="text-center padding-top-50 padding-bottom-50">'+SPINNER+'<div>' );
	$('#myModal').modal('show');
	var data = {
		video: $('#proposalvideo').val(),
	};
	$.post( "<?php echo get_link('VideoThumbCaptureURL')?>",data, function( data ) {
		 $( "#myModal .mycustom-modal").html( data );
	});	
}
function removeVideoThumb(ev){
$('.addthumb').show();
$('.removethumb').hide();
$('#videothumb').val('');
$('.thumbnail_sec_video_capture').css('background-image', 'none');
}	
var  main = function(){
	$("#fileinputvideo").change(function(){
    var fd = new FormData();
	var all_files= $('#fileinputvideo')[0].files;
	for(var i=0;i<all_files.length;i++){
		var files = $('#fileinputvideo')[0].files[i];
		fd.append('fileinput',files);
        uploadDataVideo(fd);
	}
});
	$('.selectpicker').selectpicker('refresh');
	$('#category').on('change',function(){
	$('.sub_category_display').show();
	$( "#load_sub_category").html('<div class="text-center" style="min-height: 70px;width: 100%;line-height: 50px;">'+SPINNER+'<div>').show();
		$.get( "<?php echo get_link('editprofileAJAXURL')?>",{'formtype':'getsubcat','Okey':$(this).val()}, function( data ) {
			setTimeout(function(){ $("#load_sub_category").html(data);$('.selectpicker').selectpicker('refresh');},1000)
		});
	});
	$('textarea#description').summernote({
			placeholder: '<?php D(__('post_proposal_page_textarea_input',"Write Your Description Here."));?>',
			height: 150,
			toolbar: [
			['style', ['style']],
			['font', ['bold', 'italic', 'underline', 'clear']],
			/* ['fontname', ['fontname']], */
			['fontsize', ['fontsize']],
			['height', ['height']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']],
			['table', ['table']],
			/* ['insert', ['link', 'picture']], */
		],
		callbacks: {
			onKeydown: function(e) {
				var t = $(e.currentTarget).text();
				$(".proposal_description_count").text(t.length);	
			},
			onKeyup: function(e) {
				var t = $(e.currentTarget).text();
				$(".proposal_description_count").text(t.length);	
			},
			onPaste: function(e) {
				var t = $(e.currentTarget).text();
				var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
				e.preventDefault();
				var all = t + bufferText;
				document.execCommand('insertText', false, all.trim().substring(0, 400));
				$(".proposal_description_count").text(t.length);	
			}
		}
	});
	$('#addQuestion').on('click',function(){
		$('#addQuestion_container').append($('#question_template').html());
		
	})
	$('.edit-proposal').on('click',function(){
		var secPopup=parseInt($(this).attr('data-popup'));
		for(var p=secPopup+1;p<=6;p++){
			$('#postJobStepItem a:nth-child('+p+')').removeClass('active');
		}
		$('#dataStep-6').hide();
		$('#dataStep-'+secPopup).show();
	})
	
	$('.backbtnproposal').on('click',function(){
		var step=$(this).attr('data-step');
		if(step==1){
			return false;
		}
		var prevStep=parseInt(step)-1;
		$('#postJobStepItem a:nth-child('+step+')').removeClass('active');
		$('#dataStep-'+step).hide();
		$('#dataStep-'+prevStep).show();
	});
	$('.nextbtnproposal').on('click',function(){
		var step=$(this).attr('data-step');
		var buttonsection=$(this);
		var buttonval = buttonsection.html();
		buttonsection.html(SPINNER).attr('disabled','disabled');
		var formID="postproposalform";
		$.ajax({
	        type: "POST",
	        url: "<?php D(get_link('postproposalFormCheckAJAXURL'))?>/"+step,
	        data:$('#'+formID).serialize(),
	        dataType: "json",
	        cache: false,
			success: function(msg) {
				buttonsection.html(buttonval).removeAttr('disabled');
				clearErrors();
				if (msg['status'] == 'OK') {
					load_data(msg['preview_data']);
					if(step==6){
						window.location.href="<?php D(get_link('postproposalSuccessURL'))?>/"+msg['proposal_id'];
					}
					var nextStep=parseInt(step)+1;
					$('#postJobStepItem a:nth-child('+nextStep+')').addClass('active');
					$('#dataStep-'+step).hide();
					$('#dataStep-'+nextStep).show();
					
				} else if (msg['status'] == 'FAIL') {
					registerFormPostResponse(formID,msg['errors']);
				}
			}
		})		
	});
	
	
	$('.no_of_freelancer_radio').on('change',function(){
		var no_of_freelancer_radio=$('.no_of_freelancer_radio:checked').val();
		if(no_of_freelancer_radio=='M'){
			$('.no_of_freelancer_display').show();
		}else{
			$('.no_of_freelancer_display').hide();
		}
	});
	$('.proposal_payment_type').on('change',function(){
		var proposal_payment_type=$('.proposal_payment_type:checked').val();
		$('.basic_package').show();
		if(proposal_payment_type=='fixed'){
			$('.standard_package').hide();
			$('.premium_package').hide();
		}else{
			$('.standard_package').show();
			$('.premium_package').show();
		}
	});
}
var mainload = function(){
	setTimeout(function(){
	var bhtn = new Bloodhound({
		local:all_skills,
	        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('skill_name'),
	  		queryTokenizer: Bloodhound.tokenizers.whitespace,
	});
	var elts = $('.tagsinput_skill');
	elts.tagsinput({
	  itemValue: 'skill_id',
	  itemText: 'skill_name',
	  typeaheadjs: {
	  	limit: 25,
	  	displayKey: 'skill_name',
	    hint: false,
	    highlight: true,
	    minLength: 1,
	    source: bhtn.ttAdapter(),
	    templates: {
	      notFound: [
	        "<div class=empty-message>",
	        "<?php D('No match found')?>",
	        "</div>"
	      ].join("\n"),
	      suggestion: function(e) {  var test_regexp = new RegExp('('+e._query+')' , "gi"); return ('<div>'+ e.skill_name.replace(test_regexp,'<b>$1</b>')  + '</div>'); }
	    }
	  }
	});
	/* elts.on('beforeItemAdd', function(event) {
		var itemdata=event.item;
		console.log(itemdata);
		var key=itemdata.skill_id;
		if($(".skill_set_"+key).length>0){	
		}else{
			var name=key;
			var html='<span class=" keyword skill_set_'+key+'" ><span class="keyword-remove"></span><span class="keyword-text">'+itemdata.skill_name+'</span><input type="hidden" name="byskills[]" value="'+name+'"/><input type="hidden" name="byskillsname[]" value="'+itemdata.skill_key+'"/></span>';
			$(".skillContaintag").append(html);
			

		}
		//console.log(event.item);
		event.cancel = true;
	}) */
	$.each(pre_skills, function(index, value) {
		elts.tagsinput('add', value);
		console.log(value);
	});
	},2000);
}

</script>