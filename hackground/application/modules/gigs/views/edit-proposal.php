 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         <?php echo $main_title ? $main_title : '';?>
        <small><?php echo $second_title ? $second_title : '';?></small>
      </h1>
     <?php echo $breadcrumb ? $breadcrumb : '';?>
    </section>

    <!-- Main content -->
    <section class="content">

<?php
//print_r($details);
$currency=get_setting('site_currency');
?>

<?php
$succ_msg = get_flash('succ_msg');
$error_msg = get_flash('error_msg');
if(!empty($succ_msg)){ 
?>
<div class="alert alert-success alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
    </button>
    <strong>Success!</strong> <?php echo $succ_msg;?>
</div>
<?php } ?>

<?php if(!empty($error_msg)){ ?>
<div class="alert alert-danger alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
    </button>
    <strong>Error!</strong> <?php echo $error_msg;?>
</div>
<?php } ?>
      <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo $title ? $title : '';?></h3>
          <div class="box-tools pull-right">
			ID: #<?php echo $details['proposal_id']; ?>
          </div>
        </div>
        <div class="card">
            <div class="box-body">  
            <form role="form" id="edit_form" action="<?php echo $form_action;?>" onsubmit="submitForm(this, event)">
            <input type="hidden" name="ID" value="<?php echo $ID?>"/>

            <div class="form-group">
                <label for="proposal_title">Title (English)</label>
                <input type="text" class="form-control reset_field" id="proposal_title" name="proposal_title" autocomplete="off" value="<?php echo !empty($details['proposal_title']) ? $details['proposal_title'] : ''; ?>">
                <span id="proposal_titleError" class="rerror"></span>
            </div>
            <div class="form-group">
                <label for="proposal_title_ar">Title (Arabic)</label>
                <input type="text" class="form-control reset_field" id="proposal_title_ar" name="proposal_title_ar" autocomplete="off" value="<?php echo !empty($details['proposal_title_ar']) ? $details['proposal_title_ar'] : ''; ?>">
                <span id="proposal_titleError" class="rerror"></span>
            </div>

            <div class="form-group">
                <label for="member_country">Category </label>
                <select class="form-control" name="category_id" id="category_id" onchange="getSubcategory(this.value)">
                    <option value="">-select-</option>
                    <?php print_select_option($category, 'category_id', 'name', !empty($details['project_category']['category_id']) ? $details['project_category']['category_id'] : '');?>
                </select>   
                <span id="category_idError" class="rerror"></span>
            </div>
            <div class="form-group">
                <label for="member_country">Sub Category </label>
                <div id="subcategory_section">
                    <select class="form-control" name="category_subchild_id">
                        <option value="">-select-</option>
                        <?php print_select_option($sub_category, 'category_subchild_id', 'name', !empty($details['project_category']['category_subchild_id']) ? $details['project_category']['category_subchild_id'] : '');?>
                    </select>
                </div>
                <span id="sub_category_idError" class="rerror"></span>
            </div>

            <div class="form-group">
                <label for="proposal_description">Proposal's Description (English)</label>
                <textarea name="proposal_description" id="proposal_description" rows="7"  class="form-control proposal-desc"><?php if($details){echo $details['proposal_additional']['proposal_description'];}?></textarea>
                <span id="proposal_descriptionError" class="rerror"></span>
            </div>
            <div class="form-group">
                <label for="proposal_description_ar">Proposal's Description (Arabic)</label>
                <textarea name="proposal_description_ar" id="proposal_description_ar" rows="7"  class="form-control proposal-desc"><?php if($details){echo $details['proposal_additional']['proposal_description_ar'];}?></textarea>
                <span id="proposal_description_arError" class="rerror"></span>
            </div>

            <div class="form-group">
                <label for="buyer_instruction">Instructions to Buyer (English)</label>
                <textarea name="buyer_instruction" id="buyer_instruction" rows="7"  class="form-control"><?php if($details){echo $details['proposal_additional']['buyer_instruction'];}?></textarea>
                <span id="buyer_instructionError" class="rerror"></span>
            </div>
            <div class="form-group">
                <label for="buyer_instruction_ar">Instructions to Buyer (Arabic)</label>
                <textarea name="buyer_instruction_ar" id="buyer_instruction_ar" rows="7"  class="form-control"><?php if($details){echo $details['proposal_additional']['buyer_instruction_ar'];}?></textarea>
                <span id="buyer_instruction_arError" class="rerror"></span>
            </div>
<?php
$d_proposal_tags=$d_proposal_tags_ar=array();
if($details){
	if($details['proposal_tags']){
		foreach($details['proposal_tags'] as $tagname){
            if($tagname['lang']=='ar'){
                $d_proposal_tags_ar[]=$tagname['tag_name'];
            }else{
                $d_proposal_tags[]=$tagname['tag_name'];
            }
			
		}
	}
}
?>
            <div class="form-group">
                <label for="proposal_tags">Proposal's Tags (English)</label>
                <input type="text" name="proposal_tags" id="proposal_tags"  value="<?php echo(implode(',',$d_proposal_tags));?>" class="form-control">
                <span id="proposal_tagsError" class="rerror"></span>
            </div>
            <div class="form-group">
                <label for="proposal_tags_ar">Proposal's Tags (Arabic)</label>
                <input type="text" name="proposal_tags_ar" id="proposal_tags_ar"  value="<?php echo(implode(',',$d_proposal_tags_ar));?>" class="form-control">
                <span id="proposal_tags_arError" class="rerror"></span>
            </div>
            <div class="form-group">
                <label for="delivery_id">Proposal's Delivery Time </label>
                <select class="form-control" name="delivery_id">
                    <option value="">-select-</option>
                    <?php print_select_option($all_delivery_times, 'delivery_id', 'delivery_proposal_title', !empty($details['delivery_time']) ? $details['delivery_time'] : '');?>
                </select>
                <span id="delivery_idError" class="rerror"></span>
            </div>
            <div class="form-group">
                <label for="delivery_id">Add Proposal's Image </label>
                <div class="choosefile">
                    <input type="file" name="proposal_img1" id="proposal_img1" class="form-control" >
                    <span class="btn btn-success">Choose File</span>
                </div>
                <?php
            if($details['proposal_image']){
                $filejson=array(
                    'file_name'=>$details['proposal_image'],
                    'original_name'=>$details['proposal_image'],
                );
            ?>
                <div id="thumbnail_primary" class="thumbnail_sec mt-3" style="background-image: url('<?php echo (USER_UPLOAD.'proposal-files/'.$details['proposal_image']);?>');"><input type="hidden" name="mainimageprevious" value='<?php echo (json_encode($filejson))?>'><a href="javascript:void(0)" class=" ripple-effect ico btn btn-sm btn-circle  btn-danger" onclick="$(this).parent().remove()"><i class="fa fa-trash"></i></a></div>
            <?php }else{?>
                <div id="thumbnail_primary" class="thumbnail_sec"></div>
            <?php }?>

                <span id="mainimageError" class="rerror"></span>
            </div>
            <div class="form-group">
                <label for="delivery_id">Add Proposal More Images </label>
                <a href="javascript:void(0)" data-toggle="collapse" data-target="#more-images" class="btn btn-success btn-block">
                Add More Images
                </a>
                <div id="more-images" class="collapse">
                    <input type="file" name="fileinput" id="fileinput" multiple="true">
                    <div class="upload-area" id="uploadfile">
                        <h4>Drag and Drop file here<br>Or<br>Click to select file</h4>
                    </div>
                    <div id="uploadfile_container">
                    <?php 
                    if($details && $details['proposal_files']){
                    $inc=0;
                    foreach($details['proposal_files'] as $files){
                        $inc++;
                        $filejson=array(
                            'file_id'=>$files['file_id'],
                            'file_name'=>$files['server_name'],
                            'original_name'=>$files['original_name'],
                        );
                        ?>
                        <div id="thumbnail_<?php echo ($inc)?>" class="thumbnail_sec" style="background-image: url('<?php echo (USER_UPLOAD.'proposal-files/'.$files['server_name']);?>');"><input type="hidden" name="projectfileprevious[]" value='<?php echo (json_encode($filejson))?>'><a href="javascript:void(0)" class="  ripple-effect ico btn btn-sm btn-circle  btn-danger" onclick="$(this).parent().remove()"><i class="fa fa-trash"></i></a></div>
                        <?php
                    }
                    }
                    ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="fileinputvideo">Add Proposal Video (Optional) </label>
                <div class="choosefile">
                    <input type="file" name="proposal_video" id="fileinputvideo" class="form-control">
                    <span class="btn btn-success">Choose File</span>
                </div>
                <div id="uploadfile_container_video">

                </div>
                <?php
            if($details['proposal_additional']['proposal_video']){
                $filejson=array(
                    'file_name'=>$details['proposal_additional']['proposal_video'],
                    'original_name'=>$details['proposal_additional']['proposal_video'],
                );
            ?>
               <div id="thumbnailv_1" class="thumbnail_sec mt-3" style="width: 250px;height:200px">
               <video width="220" height="150" controls>
                <source src="<?php echo(USER_UPLOAD.'proposal-video/'.$details['proposal_additional']['proposal_video']);?>" >
                </video>
                <input type="hidden" name="videoprevious" value='<?php echo(json_encode($filejson))?>'><a href="javascript:void(0)" class=" ripple-effect ico btn btn-sm btn-circle  btn-danger" onclick="$(this).parent().remove()">
                <i class="fa fa-trash"></i></a>
                </div>

            <?php }?>
            </div>
            <div class="form-group">
                <label for="proposal_price_type">Price Type </label>
                <select class="pricing form-control" name="is_fixed" id="proposal_price_type">
                    <option value="0" <?php if($details['proposal_price']>0){}else{echo('selected');}?>> Packages </option>
                    <option value="1" <?php if($details['proposal_price']>0){echo('selected');}?>> Fixed Price </option>
                </select>
            </div>

            <div class="form-group proposal-price" <?php if($details['proposal_price']>0){}else{echo ('style="display:none"');}?>>
                <label for="proposal_price_type">Price</label>
                <div class="input-group form-curb">
	                <span class="input-group-addon font-weight-bold">
	                 <?php echo($currency); ?>
	                </span>
	                <input type="text" class="form-control" id="proposal_price" name="proposal_price" value="<?php echo($details['proposal_price']); ?>" onkeypress="return isNumberKey(event)">
	            </div>
	            <span id="proposal_priceError" class="rerror"></span>
            </div>

            <div class="packages" <?php if($details['proposal_price']>0){echo('style="display:none"');}?>>
                <div class="row">
            <?php
            if($details['proposal_packages']){
                $j=0;
            foreach($details['proposal_packages'] as $package){
                $j++;
		    ?>
                    <div class="col-md-4 package">
                        <input type="hidden" name="package_<?php echo($j); ?>" value="<?php echo($package->package_id); ?>"/>	
                        <table class="table table-bordered js-gig-packages">
                            <tr>
                                <td><h4><?php echo $package->package_name; ?></h4></td>
                            </tr>
                            <tr>
                                <td>
                                    <small><label for="package_desc_<?php echo ($j); ?>">Descpition (English)</label></small>
                                    <textarea name="package_desc_<?php echo ($j); ?>" id="package_desc_<?php echo ($j); ?>" class="form-control description-value-<?php echo ($package->package_id); ?>" ><?php echo ($package->description); ?></textarea>
                                    <span id="package_desc_<?php echo ($j); ?>Error" class="rerror"></span>
                                </td>
                            </tr>
                        <tr>
                            <td>
                                <small><label for="package_desc_<?php echo ($j); ?>_ar">Descpition (Arabic)</label></small>
                                <textarea name="package_desc_<?php echo ($j); ?>_ar" id="package_desc_<?php echo ($j); ?>_ar" class="form-control description-value-<?php echo ($package->package_id); ?>" ><?php echo ($package->description_ar); ?></textarea>
                                <span id="package_desc_<?php echo ($j); ?>_arError" class="rerror"></span>
                            </td>
                        </tr>

                        <?php
                        $this->db->select('p.attribute_id,p.attribute_name,p.attribute_value')
                        ->from('proposal_package_attributes p')
                        ->where('p.package_id', $package->package_id);
                        $attribute = $this->db->order_by('p.attribute_id','asc')->get()->result();
                        if($attribute){
                            foreach($attribute as $a=>$attributeData){
                                $a++;
                                ?>

                            <tr class="newattribute attribute_<?php echo ($a); ?>" data-attr-id="<?php echo ($a); ?>">
                                <td>
                                    <small><?php echo ($attributeData->attribute_name); ?>
                                        <input type="hidden" name="attribute_count[]" value="<?php echo ($a); ?>">
                                        <input type="hidden" name="attribute_name_<?php echo ($a); ?>[]" value="<?php echo ($attributeData->attribute_name); ?>">
                                    </small>
                                    <div class="input-group">
                                        <input class="form-control attribute-value-<?php echo ($j); ?>" value="<?php echo ($attributeData->attribute_value); ?>" data-attribute="<?php echo ($j); ?>" name="attribute_value_<?php echo ($j); ?>_<?php echo ($a);?>" id="attribute_value_<?php echo ($j); ?>_<?php echo ($a);?>">
                                        <div class="input-group-addon">
                                        <button class="" type="button" data-attribute="<?php echo ($attributeData->attribute_name); ?>" onclick="$('.attribute_<?php echo ($a); ?>').remove();">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>	
                                <?php
                            }
                        }
                        ?>
                            <tr class="time_row" data-row-id="<?php echo ($j); ?>">
                                <td>
                                    <small><label for="package_time_<?php echo ($j); ?>">Delivery Time</label></small>
                                    <div class="input-group-off">
                                        <input onkeypress="return isNumberKey(event)" name="package_time_<?php echo ($j); ?>" id="package_time_<?php echo ($j); ?>" class="form-control delivery-time-value-<?php echo ($package->package_id); ?>" value="<?php echo ($package->delivery_time); ?>" >
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <small><label for="package_price_<?php echo ($j); ?>">Price</label></small>
                                    <div class="input-group form-curb">
                                        <span class="input-group-addon font-weight-bold">
                                            <?php echo ($currency); ?>
                                        </span>
                                        <input onkeypress="return isNumberKey(event)" name="package_price_<?php echo ($j); ?>" id="package_price_<?php echo ($j); ?>"  class="form-control price-value-<?php echo ($package->package_id); ?>" value="<?php echo ($package->price); ?>" >
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <?php
	            }
            }
            ?>
                </div>
                <div class="space5"></div>
                <div class="form-group row add-attribute">
                    <label for="new_attribute_name" class="col-md-3 control-label">Add New Attribute</label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <input class="form-control attribute-name"  name="" id="new_attribute_name">
                            <div class="input-group-addon">
                                <button class=" insert-attribute" type="button">
                                <i class="fa fa-cloud-upload" aria-hidden="true"></i> &nbsp;Insert 
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" name="update" class="btn btn-success form-control saveBTN"> Update Proposal </button>


            </form>
            </div>
        </div>

    </div>
</div>
<div id="insertimageModal" class="modal" role="dialog">
 	<div class="modal-dialog modal-lg">
  		<div class="modal-content">
     		 <div class="modal-header">
              Crop & Insert Image
       			<button type="button" class="close" data-dismiss="modal" onclick="$('#proposal_img1').val('');">&times;</button>
      		</div>
      		<div class="modal-body">
        		<div id="image_demo" style="width:100% !important;"></div>
      		</div>

      		<div class="modal-footer">
		      	<input type="hidden" name="img_type" value="">
		      	<button class="btn btn-success crop_image">Crop Image</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="$('#proposal_img1').val('');">Close</button>
	     	</div>
    	</div>
  	</div>
</div>
<div id="wait"></div>
<?php
$alljs=array('croppie.js','summernote.js','tagsinput.js','upload-drag-file.js');
$allcss=array('tagsinput.css','croppie.css');
if($alljs){
    foreach($alljs as $js){
?>
<script src="<?php echo ADMIN_EXTRA;?>proposal/<?php echo $js;?>"></script>
<?php
    }
}
if($allcss){
    foreach($allcss as $css){
 ?>
 <link rel="stylesheet" href="<?php echo ADMIN_EXTRA;?>proposal/<?php echo $css;?>">
 <?php       
    }
}

?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">

<style>
.choosefile {
    position: relative;
    height: 38px;
}
.choosefile input[type="file"] {
    z-index: 99;
    width: 100%;
    height: 38px;
    opacity: 0;
    position: absolute;
}
.choosefile .btn {
    position: absolute;
    z-index: 1;
    top: 0;
}
.choosefile .btn, .proposal-reviews .reviews-list li .user-picture {
    left: 0;
}
.thumbnail_sec {
    word-break: break-all;
    width: 60px;
    height: 66px;
    display: inline-block;
    padding: 10px;
    border: 1px dotted #ccc;
    position: relative;
    background-size: cover;
}
.thumbnail_sec {
    margin-right: 13px;
}
.thumbnail_sec .btn {
    position: absolute;
    top: -10px;
}
.thumbnail_sec .btn {
    right: -10px;
}
.mt-3, .my-3 {
    margin-top: 1rem !important;
}
#fileinput {
    display: none;
}
.upload-area {
    width: 100%;
    height: 75px;
    border: 2px dashed lightgray;
    border-radius: 3px;
    margin: 0 auto;
    text-align: center;
    overflow: auto;
    margin-bottom: 20px;
    overflow: hidden;
}
.upload-area:hover {
    cursor: pointer;
}
.upload-area h4 {
    color: #777;
    font-size: 13px;
    padding: 12px;
}
.rerror {
    color: #dc3545;
}
</style>

<script>
var SPINNER='Processing..';
$(document).ready(function(){
    $('#proposal_tags , #proposal_tags_ar').tagsinput({
    maxTags: 10
    });
    $(".pricing").change(function(){
        var value = $(this).val();
        if(value == "1"){
            $('.packages').hide();
            $('.add-attribute').hide();
            $('.proposal-price').show();
        }else if(value == "0"){
            $('.packages').show();
            $('.add-attribute').show();
            $('.proposal-price').hide();	
        }
    });
    $(".insert-attribute").on('click', function(){
        var attrcount=$('.newattribute').length;
        //$('#wait').addClass("loader");
        var attribute_name = $('.attribute-name').val();
        if(attribute_name){
            attrcount=attrcount+1;
            $('tr.time_row').each(function(){
                var id=$(this).data('row-id');
                var html='<tr class="newattribute attribute_'+attrcount+'" data-attr-id="'+attrcount+'"><td><small>'+attribute_name+'<input type="hidden" name="attribute_count[]" value="'+attrcount+'"><input type="hidden" name="attribute_name_'+attrcount+'[]" value="'+attribute_name+'"></small><div class="input-group"><input class="form-control attribute-value-'+id+'" value="" data-attribute="'+attrcount+'" name="attribute_value_'+id+'_'+attrcount+'" id="attribute_value_'+id+'_'+attrcount+'"><div class="input-group-addon"><button type="button" class=" delete-attribute" data-attribute="'+attrcount+'" onclick="$(\'.attribute_'+attrcount+'\').remove();"><i class="fa fa-trash"></i></button></div></td></tr>';
                
                $(this).before(html);
            })
            $(".attribute-name").val('');
        }
    });
    $('textarea#proposal_description').summernote({
        placeholder: 'Write Your Description Here.',
        height: 150,
        toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'italic', 'underline', 'clear']],
        ['fontname', ['fontname']],
        ['fontsize', ['fontsize']],
        ['height', ['height']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture']],
      ],
    });
    $('textarea#proposal_description_ar').summernote({
        placeholder: 'Write Your Description Here.',
        height: 150,
        toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'italic', 'underline', 'clear']],
        ['fontname', ['fontname']],
        ['fontsize', ['fontsize']],
        ['height', ['height']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture']],
      ],
});
$image_crop = $('#image_demo').croppie({
    enableExif: true,
    viewport: {
      width:700,
      height:390,
      type:'square' //circle
    },
    boundary:{
      width:100,
      height:400
    }    
});	
$('.crop_image').click(function(event){
	$('#wait').addClass("loader");
 	var name = $('input[type=hidden][name=img_type]').val();
    $image_crop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(response){
        if($("#thumbnail_primary").length==0){
            $('#mainimageError').before('<div id="thumbnail_primary" class="thumbnail_sec mt-3"></div>');     
        }
    	$("#thumbnail_primary").html('<div class="center">'+SPINNER+'</div>');
	    $.ajax({
	        url:"<?php echo(base_url('proposal/uploadfiles'))?>?type=main",
	        type: "POST",
	        data:{image: response, name: name },
	        dataType: 'json',
	        success:function(response){
	        	$('#proposal_img1').val('');
	        	$('#wait').removeClass("loader");
		        $('#insertimageModal').modal('hide');
	        	 if(response.status=='OK'){
		          	var name = response.upload_response.original_name;
	    			$("#thumbnail_primary").html('<input type="hidden" name="mainimage" value=\''+JSON.stringify(response.upload_response)+'\'/> <a href="javascript:void(0)" class="  ripple-effect ico btn btn-sm btn-circle  btn-danger" onclick="$(this).parent().remove()"><i class="fa fa-trash"></i></a>');
	    			var imageUrl="<?php echo(USER_UPLOAD.'tempfile/');?>"+name;
	    			$("#thumbnail_primary").css("background-image", "url(" + imageUrl + ")");
	    			
    			}
	          	//$('input[type=hidden][name='+ name +']').val(data);
	        }
	    });
    })
 });

$('#proposal_img1').on('change', function(){
	var size = $(this)[0].files[0].size; 
	var ext = $(this).val().split('.').pop().toLowerCase();
	if($.inArray(ext,['jpeg','jpg','gif','png']) == -1){
		alert('Your File Extension Is Not Allowed.');
		$(this).val('');
	}else{
   	 	crop(this);
	}
});
$("#fileinputvideo").change(function(){
    var fd = new FormData();
	var all_files= $('#fileinputvideo')[0].files;
	for(var i=0;i<all_files.length;i++){
		var files = $('#fileinputvideo')[0].files[i];
		fd.append('fileinput',files);
        uploadDataVideo(fd);
	}
});
$(".insert-attribute").on('click', function(){
	var attrcount=$('.newattribute').length;
	//$('#wait').addClass("loader");
	var attribute_name = $('.attribute-name').val();
	if(attribute_name){
		attrcount=attrcount+1;
		$('tr.time_row').each(function(){
			var id=$(this).data('row-id');
			var html='<tr class="newattribute attribute_'+attrcount+'" data-attr-id="'+attrcount+'"><td><small>'+attribute_name+'<input type="hidden" name="attribute_count[]" value="'+attrcount+'"><input type="hidden" name="attribute_name_'+attrcount+'[]" value="'+attribute_name+'"></small><div class="input-group"><input class="form-control attribute-value-'+id+'" value="" data-attribute="'+attrcount+'" name="attribute_value_'+id+'_'+attrcount+'" id="attribute_value_'+id+'_'+attrcount+'"><div class="input-group-append"><button type="button" class="btn btn btn-success delete-attribute" data-attribute="'+attrcount+'" onclick="$(\'.attribute_'+attrcount+'\').remove();"><i class="fa fa-trash"></i></button></div></td></tr>';
			
			$(this).before(html);
		})
		$(".attribute-name").val('');
	}
});	
});
function getSubcategory(id){
	$.get('<?php echo base_url('proposal/load_ajax_page');?>?page=subcat&id='+id, function(res){
			$('#subcategory_section').html(res);
	});
}
function submitForm(form, evt){
    evt.preventDefault();
    ajaxSubmit($(form), onsuccess);
}
function onsuccess(res){
    if(res.cmd && res.cmd == 'reload'){
        location.reload();
    }
}
function crop(data){
    var reader = new FileReader();
    reader.onload = function (event) {
      $image_crop.croppie('bind',{
      url: event.target.result
      }).then(function(){
      	console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(data.files[0]);
    $('#insertimageModal').modal('show');
    $('input[type=hidden][name=img_type]').val(data.files[0].name);
}
function uploadDataVideo(formdata){
	var vnum =1;	
	$("#uploadfile_container_video").html('<div id="thumbnailv_'+vnum+'" class="thumbnail_sec  mt-3" style="width:250px;height:200px"><div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div></div></div>');
    $.ajax({
        url: "<?php echo(base_url('proposal/uploadfiles'))?>?type=video",
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
    			var name = response.upload_response.file_name;
    			$("#thumbnailv_"+vnum).html('<input type="hidden" name="projectvideo" value=\''+JSON.stringify(response.upload_response)+'\'/> <video width="220" height="150" controls><source src="<?php echo (USER_UPLOAD.'tempfile/');?>'+name+'"></video><a href="javascript:void(0)" class=" ripple-effect ico btn btn-sm btn-circle  btn-danger" onclick="$(this).parent().remove()"><i class="fa fa-trash"></i></a>');
    			 
		   }else{
		   		$("#thumbnailv_"+vnum).html('<p class="text-danger">Error in upload file</p>');
		   }
           
        },
        
    }).fail(function(){
    	$("#thumbnailv_"+vnum).html('<p class="text-danger">Error occurred</p>');
    });
	}
function uploadData(formdata){
	var len = $("#uploadfile_container div.thumbnail_sec").length;
   	var num = Number(len);
	num = num + 1;	
	if(num>4){
		swal({
          type: 'error',
           text: 'Max limit 4',
          timer: 2000,
          onOpen: function(){
            swal.showLoading()
          }
      });
		return false;
	}
	$("#uploadfile_container").append('<div id="thumbnail_'+num+'" class="thumbnail_sec">'+SPINNER+'</div>');
    $.ajax({
        url: "<?php echo(base_url('proposal/uploadfiles'));?>?type=image",
        type: 'post',
        data: formdata,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response){
           if(response.status=='OK'){
    			var name = response.upload_response.original_name;
    			$("#thumbnail_"+num).html('<input type="hidden" name="projectfile[]" value=\''+JSON.stringify(response.upload_response)+'\'/> <a href="javascript:void(0)" class=" ripple-effect ico btn btn-sm btn-circle  btn-danger" onclick="$(this).parent().remove()"><i class="fa fa-trash"></i></a>');
    			
    			var urlImg='<?php echo(USER_UPLOAD.'tempfile')?>/'+response.upload_response.file_name;
    			$("#thumbnail_"+num).css({"background-image": "url('"+urlImg+"')"})
		   }else{
		   		$("#thumbnail_"+num).html('<p class="text-danger">Error in upload file</p>');
		   }
           
        },
        
    }).fail(function(){
    	$("#thumbnail_"+num).html('<p class="text-danger">Error occurred</p>');
    });
}
</script>