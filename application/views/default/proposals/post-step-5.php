<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//dd($memberInfo,TRUE);
?>

<div id="dataStep-5"  style="display: none">
  <div class="dashboard-box"> 
    <!-- Headline -->
    <div class="headline">
      <h4><?php echo __('postproposal_gallery','Gallery');?></h4>
    </div>
    <div class="content with-padding">
      <div class="submit-field">
        <label for="" class="form-label"><?php echo __('postproposal_proposal_Images','Proposal Images');?></label>
        <div class="drop btn-file mb-2">
          <p class="m-0"><?php echo __('postproposal_drag','Drag');?> &amp; <?php echo __('postproposal_drop_file','drop file here');?> <br />
            <?php echo __('postproposal_or','or');?> <br />
            <span class="text-site"><?php echo __('click','click');?></span> <?php echo __('postproposal_select_file','to select file');?> </p>
          <div id="filt_chooser">
            <input type="file"  id="userfile" name="userfile" onchange="uploadFiles(this)" multiple />
          </div>
        </div>
        <span id="proposalfileError" class="rerror"></span>
        <p class="text-muted"><small><i>Allowed files types: png, jpg, jpeg</i></small></p>
      </div>
      <div class="mb-3" id="uploaded_files"> 
        <!-- uploaded files -->
        <?php 
                  if($proposalData && $proposalData['proposal_files']){
                      $inc=0;
                      foreach($proposalData['proposal_files'] as $k => $files){
                        $inc++;
                      $filejson=array(
                      'file_id'=>$files->proposal_file_id,
                      'file_name'=>$files->server_name,
                      'org_file_name'=>$files->original_name,
                      );
                    $file_id=$inc;
                  ?>
        <div class="uploaded_wrapper" id="file_<?php echo $file_id;?>">
          <div class="row mb-2">
            <div class="col"> <span><?php echo $files->original_name;?></span>
              <p style="color:red" id="progress_error_<?php echo $file_id;?>"></p>
            </div>
            <div class="col-auto text-right" id="remove_<?php echo $file_id;?>"> <a href="javascript:void(0)" class="text-danger" onclick="removeFile('<?php echo $file_id;?>')"><i class="icon-feather-trash"></i></a> </div>
          </div>
          <input type="hidden" name="proposalfileprevious[]" value='<?php D(json_encode($filejson))?>'/>
        </div>
        <?php
                    }
                    }
                ?>
      </div>
      <div class="submit-field">
        <label for="" class="form-label"><?php echo __('postgigs_video','Proposal Video'); ?></label>
        <div class="drop btn-file mb-2">
          <p class="m-0"><?php echo __('postproposal_drag','Drag');?> &amp; <?php echo __('postproposal_drop_file','drop file here');?> <br />
            <?php echo __('postproposal_or','or');?> <br />
            <span class="text-site"><?php echo __('click','click');?></span> <?php echo __('postproposal_select_file','to select file');?> </p>
          <div id="filt_chooser">
            <input type="file"  id="fileinputvideo" name="fileinputvideo" />
          </div>
        </div>
        <p class="text-muted"><small><i>Supported video extentions include: 'mp4', 'mov', 'avi', 'flv', 'wmv'.</i></small></p>
        <div id="uploadfile_container_video">
          <?php
              if($proposalData && $proposalData['proposal_video']){
                $filejson=array(
                'file_id'=>$proposalData['proposal_video']->proposal_file_id,
                'file_name'=>$proposalData['proposal_video']->server_name,
                'original_name'=>$proposalData['proposal_video']->original_name,
                );
              ?>
          <div id="thumbnailv_1" class="thumbnail_sec_video  mt-3">
            <input type="hidden" id="proposalvideoprevious" name="proposalvideoprevious" value="1"/>
            <input type="hidden" id="proposalvideo" name="proposalfileprevious[]" value='<?php D(json_encode($filejson))?>'/>
            <?php echo $proposalData['proposal_video']->original_name;?> <a href="javascript:void(0)" class="text-danger" onclick="$(this).parent().remove();$('.setvideothumb').hide();$('#videothumb').val('');	"> <i class="icon-feather-trash"></i> </a> </div>
          <?php }?>
        </div>
      </div>
      <div class="submit-field setvideothumb" <?php  if($proposalData && $proposalData['proposal_video']){}else{?>style="display:none" <?php }?>>
        <label for="" class="form-label"><?php echo __('postgigs_video_thumb','Proposal Video Thumb'); ?></label>
        <?php  
              $videothumb='';
              if($proposalData && $proposalData['proposal_video']){
                if($proposalData['proposal_video']->image_thumb){
                   $videothumb=json_encode(array(
                      'is_previous'=>1,
                      'file_name'=>$proposalData['proposal_video']->image_thumb,
                      'original_name'=>$proposalData['proposal_video']->image_thumb,
                  ));
                }
              }
              ?>
        <div class="thumbnail_sec_video_capture" <?php if($videothumb){?>style="background-image: url('<?php echo UPLOAD_HTTP_PATH.'proposals-files/proposals-thumb/thumb_'.$proposalData['proposal_video']->image_thumb;?>')" <?php }?>>
          <input type="hidden" name="videothumb" id="videothumb" value='<?php echo $videothumb;?>'/>
          <a href="<?php echo VZ;?>" class="btn btn-site btn-circle addthumb" onclick="openmodalVideo()" <?php if($videothumb){?>style="display: none;"<?php }?>><i class="icon-feather-plus"></i></a> <a href="javascript:void(0)" <?php if($videothumb){}else{?>style="display: none;"<?php }?> class="removethumb ico btn btn-sm btn-circle btn-danger" onclick="removeVideoThumb(this)"> <i class="icon-feather-trash"></i> </a> </div>
        <div class="clearfix"></div>
        <span id="videothumbError" class="rerror"></span> </div>
    </div>
  </div>
  <button class="btn btn-outline-secondary backbtnproposal" data-step="5"><?php echo __('postproposal_back','Back');?></button>
  <button class="btn btn-site nextbtnproposal" data-step="5"><?php echo __('postproposal_next','Next');?></button>
</div>
