<?php
if($template=='section_block'){
    $lang = get_lang();
	if($type=='list'){
     // get_print($cms_temp,false);  
	?>
<div class="box-group">
	<div class="section_block"> 
    <?php 
if($cms_temp){
	foreach($cms_temp as $k=>$block){
        $rowid=$k+1;
?>
<div class="row section_block_row">
  	<input type="hidden" name="cms_key[]" value="<?php echo $rowid;?>">
		<div class="col-sm-12">
            <span class="float-right">
                <button class="btn btn-danger ml-3" type="button" onclick="$(this).closest('.section_block_row').remove()">X</button>
            </span>
            <div class="form-group">
                <label class="form-label">Block Type</label>
                <div class="radio-inline">
                    <input type="radio" onclick="$('.block_type_section_<?php echo $rowid;?>').show();$('.block_type_custom_<?php echo $rowid;?>').hide();" name="block_type_<?php echo $rowid;?>" value="section" class="magic-radio" id="block_type_section_<?php echo $rowid;?>" <?php if($block->section_type=='SEC'){echo 'checked';}?>>
                    <label for="block_type_section_<?php echo $rowid;?>">Section</label> 
                </div>
                <div class="radio-inline">
                    <input type="radio" onclick="$('.block_type_section_<?php echo $rowid;?>').hide();$('.block_type_custom_<?php echo $rowid;?>').show();" name="block_type_<?php echo $rowid;?>" value="custom" class="magic-radio" id="block_type_custom_<?php echo $rowid;?>" <?php if($block->section_type=='CUS'){echo 'checked';}?>>
                    <label for="block_type_custom_<?php echo $rowid;?>">Custom</label> 
                </div>
            </div>
            <div class="text-red error" id="block_type_<?php echo $rowid;?>Error"></div>
        <div class="block_type_section_<?php echo $rowid;?>" <?php if($block->section_type=='CUS'){echo 'style="display:none"';}?>>
            <div class="form-group">
                <label for="block_type_section_area_class_<?php echo $rowid;?>">Class Name</label>
                <input class="form-control reset_field" type="text" id="block_type_section_area_class_<?php echo $rowid;?>" name="block_type_section_area_class_<?php echo $rowid;?>" autocomplete="off" value="<?php echo $block->cms_class;?>">
            </div> 
            <div class="form-group">
                <label for="block_type_section_area_sub_class_<?php echo $rowid;?>">Sub Class Name</label>
                <input class="form-control reset_field" type="text" id="block_type_section_area_sub_class_<?php echo $rowid;?>" name="block_type_section_area_sub_class_<?php echo $rowid;?>" autocomplete="off" value="<?php echo $block->child_class;?>">
            </div> 

            <div class="block_type_section_child col-sm-12">
            <?php if($block->part){
                    foreach($block->part as $p=>$part){
                        $partid=$p+1;   
            ?>
                <div class="block_type_section_child_row">
                <span class="float-right">
                    <button class="btn btn-danger ml-3" type="button" onclick="$(this).closest('.block_type_section_child_row').remove()">X</button>
                </span>
                    <input type="hidden" name="child_key_p_<?php echo $rowid;?>[c_<?php echo $partid;?>][id]" value="<?php echo $partid;?>">
                    <div class="form-group">
                        <label for="block_type_section_child_class_<?php echo $rowid;?>_<?php echo $partid;?>">Area Class Name</label>
                        <input class="form-control reset_field" type="text" id="block_type_section_child_class_<?php echo $rowid;?>_<?php echo $partid;?>" name="child_key_p_<?php echo $rowid;?>[c_<?php echo $partid;?>][block_type_section_child_class]" autocomplete="off" value="<?php echo $part['part_class'];?>">
                    </div> 
                    <?php foreach($lang as $k => $v){?>
                    <div class="form-group">
                        <label for="block_type_section_child_area_<?php echo $rowid;?>_<?php echo $partid;?>_<?php echo $v;?>">Area (<?php echo $v;?>)</label>
                        <textarea class="form-control reset_field" id="block_type_section_child_area_<?php echo $rowid;?>_<?php echo $partid;?>_<?php echo $v;?>" name="child_key_p_<?php echo $rowid;?>[c_<?php echo $partid;?>][block_type_section_child_area][<?php echo $v;?>]" autocomplete="off"><?php if(array_key_exists($v,$part['part_content'])){echo $part['part_content'][$v];}?></textarea>
                    </div>
                    <?php }?>
                </div>
                <hr>
            <?php
                    }
                ?>
            <?php }?>
            </div>
            
            <button class="btn btn-sm btn-primary" type="button" onclick="add_new_row_block_child(<?php echo $rowid;?>)">+ Add block</button>
        </div> 
        <div class="block_type_custom_<?php echo $rowid;?>" <?php if($block->section_type=='SEC'){echo 'style="display:none"';}?>>
        <?php if($block->part){
                    foreach($block->part as $p=>$part){
                        $partid=$p+1;   
            ?>
        <?php  foreach($lang as $k => $v){ ?>
                <div class="form-group">
                    <label for="block_type_custom_area_<?php echo $rowid;?>_<?php echo $v?>">Custom HTML (<?php echo $v?>)</label>
                    <div data-error-wrapper="block_type_custom_area_<?php echo $rowid;?>_<?php echo $v?>">
                        <textarea class="form-control reset_field" id="block_type_custom_area_<?php echo $rowid;?>_<?php echo $v?>" name="block_type_custom_area_<?php echo $rowid;?>[<?php echo $v?>]" autocomplete="off"><?php if(array_key_exists($v,$part['part_content'])){echo $part['part_content'][$v];}?></textarea>
                    </div>
                </div>
        <?php }?>
        <?php }
        }?>
            </div> 
        </div>
	</div>
    <hr>
<?php
    }
}   
?>  
    </div>
    <div class="clearfix"></div> 	
	<a href="javascript:void(0)" onclick="add_new_row_block()" class="btn btn-sm btn-primary">+ Add </a>
    <div class="text-red error" id="cms_keyError"></div>
	<div class="clearfix"></div> 					  
</div>
<?php }
	elseif($type=='template'){?>
<div class="template_block" style="display: none">
  	<div class="row section_block_row">
  	<input type="hidden" name="cms_key[]" value="{CNT}"/>
		<div class="col-sm-12">
            <span class="float-right">
                <button class="btn btn-danger ml-3" type="button" onclick="$(this).closest('.section_block_row').remove()">X</button>
            </span>
            <div class="form-group">
                <label class="form-label">Block Type</label>
                <div class="radio-inline">
                    <input type="radio" onclick="$('.block_type_section_{CNT}').show();$('.block_type_custom_{CNT}').hide();" name="block_type_{CNT}" value="section" class="magic-radio" id="block_type_section_{CNT}">
                    <label for="block_type_section_{CNT}">Section</label> 
                </div>
                <div class="radio-inline">
                    <input type="radio" onclick="$('.block_type_section_{CNT}').hide();$('.block_type_custom_{CNT}').show();" name="block_type_{CNT}" value="custom" class="magic-radio" id="block_type_custom_{CNT}">
                    <label for="block_type_custom_{CNT}">Custom</label> 
                </div>
            </div>
            <div class="text-red error" id="block_type_{CNT}Error"></div>
        <div class="block_type_section_{CNT}" style="display:none">
            <div class="form-group">
                <label for="block_type_section_area_class_{CNT}">Class Name</label>
                <input class="form-control reset_field" type="text" id="block_type_section_area_class_{CNT}" name="block_type_section_area_class_{CNT}" autocomplete="off">
            </div> 
            <div class="form-group">
                <label for="block_type_section_area_sub_class_{CNT}">Sub Class Name</label>
                <input class="form-control reset_field" type="text" id="block_type_section_area_sub_class_{CNT}" name="block_type_section_area_sub_class_{CNT}" autocomplete="off">
            </div> 

            <div class="block_type_section_child col-sm-12">
               
            </div>
            
            <button class="btn btn-sm btn-primary" type="button" onclick="add_new_row_block_child({CNT})">+ Add block</button>
        </div> 
        <div class="block_type_custom_{CNT}" style="display:none">
    <?php  foreach($lang as $k => $v){ ?>
            <div class="form-group">
                <label for="block_type_custom_area_{CNT}_<?php echo $v;?>">Custom HTML (<?php echo $v;?>)</label>
                <div data-error-wrapper="block_type_custom_area_{CNT}_<?php echo $v;?>">
                <textarea class="form-control reset_field" id="block_type_custom_area_{CNT}_<?php echo $v;?>" name="block_type_custom_area_{CNT}[<?php echo $v; ?>]" autocomplete="off"></textarea>
                </div>
            </div>
        <?php }?>
        </div> 
        </div>
	</div>
    <hr>
</div>
<div class="template_block_child" style="display: none">
    <div class="block_type_section_child_row">
        <span class="float-right">
            <button class="btn btn-danger ml-3 mb-2" type="button" onclick="$(this).closest('.block_type_section_child_row').remove()">X</button>
        </span>
        <input type="hidden" name="child_key_p_{CNT}[c_{CNTC}][id]" value="{CNTC}"/>
        <div class="form-group">
            <label for="block_type_section_child_class_{CNT}_{CNTC}">Area Class Name</label>
            <input class="form-control reset_field" type="text" id="block_type_section_child_class_{CNT}_{CNTC}" name="child_key_p_{CNT}[c_{CNTC}][block_type_section_child_class]" autocomplete="off">
        </div> 
        <?php  foreach($lang as $k => $v){ ?>
        <div class="form-group">
            <label for="block_type_section_child_area_{CNT}_{CNTC}_<?php echo $v;?>">Area (<?php echo $v;?>)</label>
            <textarea class="form-control reset_field" id="block_type_section_child_area_{CNT}_{CNTC}_<?php echo $v;?>" name="child_key_p_{CNT}[c_{CNTC}][block_type_section_child_area][<?php echo $v; ?>]" autocomplete="off"></textarea>
        </div>
        <?php }?>
    </div>
    <hr>
</div>
<script>
var sectionblockcnt=$('.section_block .section_block_row').length;
var sectionblockcntchild=$('.section_block .block_type_section_child_row').length;
function add_new_row_block(){	
	var html=$('.template_block').html();
	sectionblockcnt=sectionblockcnt+1;
  	cnt=sectionblockcnt;
  	html=html.replace(/{CNT}/g, cnt);
  	$('.section_block').append(html);	
}
function add_new_row_block_child(parentcnt){	
	var html=$('.template_block_child').html();
	sectionblockcntchild=sectionblockcntchild+1;
  	cnt=sectionblockcntchild;
  	html=html.replace(/{CNT}/g, parentcnt);
  	html=html.replace(/{CNTC}/g, cnt);
  	$('.block_type_section_'+parentcnt+' .block_type_section_child').append(html);	
}
</script>

<?php
}
 }?>