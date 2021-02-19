<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//dd($memberInfo,TRUE);
?>
<div class="modal-header">
        <button type="button" class="btn btn-dark pull-left" data-dismiss="modal">Cancel</button>
        <?php if($dataid){?>
        <h4 class="modal-title">Change portfolio</h4>
        <?php }else{?>
        <h4 class="modal-title">Add portfolio</h4>
        <?php }?>
        <button type="button" class="btn btn-success pull-right" onclick="SavePortfolio(this)">Save</button>
      </div>
    <div class="modal-body">
	    <form action="" method="post" accept-charset="utf-8" id="portfolioform" class="form-horizontal" role="form" name="portfolioform" onsubmit="return false;">  
				<input  type="hidden" value="<?php echo $formtype;?>" id="formtype" name="formtype"/>
				<input  type="hidden" value="<?php echo $dataid;?>" id="dataid" name="dataid"/>
       			<div class="row">
       			<div class="col-lg-6 col-12">
                	<div class="submit-field">
                        <h5>Project Title</h5>
                        <input type="text" class="form-control" value="<?php if($memberInfo){D($memberInfo->portfolio_title);}?>" name="title" id="title">
                        <span id="titleError" class="rerror"></span>
                    </div>
                    <div class="submit-field">
                        <h5>Project URL (Optional)</h5>
                        <input type="text" class="form-control" value="<?php if($memberInfo){D($memberInfo->portfolio_url);}?>" name="url" id="url">
                        <span id="urlError" class="rerror"></span>
                    </div>
       				<div class="submit-field">
                        <h5>Project Overview</h5>
                        <textarea  class="form-control" name="description" id="description"><?php if($memberInfo){D($memberInfo->portfolio_description);}?></textarea>
                        <span id="descriptionError" class="rerror"></span>
                    </div>
       			</div>
       			<div class="col-lg-6 col-12">
                	<div class="submit-field remove_arrow_select">
                        <h5>Category</h5>
                        <select name="category" id="category" data-size="4" class="selectpicker browser-default" title="Category" data-live-search="true">
                        <?php
                        if($all_category){
                            foreach($all_category as $category_list){
                                ?>
                                <option value="<?php D($category_list->category_id);?>" <?php if($memberInfo && $category_list->category_id==$memberInfo->category_id){echo 'selected';}?>><?php D(ucfirst($category_list->category_name));?></option>
                                <?php
                            }
                        }
                         ?>
                        </select>
                        <span id="categoryError" class="rerror"></span>
                    </div>
                    <div class="sub_category_display" <?php if($memberInfo && $category_list->category_id){}else{D('style="display: none"');}?> >
                        <div class="submit-field remove_arrow_select">
                            <h5>Sub Category</h5>
                            <div id="load_sub_category">
                            <select name="sub_category" id="sub_category" data-size="4" class="selectpicker browser-default" title="Sub category" data-live-search="true">
                            <?php
                            if($all_category_subchild){
                                foreach($all_category_subchild as $category_subchild_list){
                                    ?>
                                    <option value="<?php D($category_subchild_list->category_subchild_id);?>" <?php if($memberInfo && $category_subchild_list->category_subchild_id==$memberInfo->category_subchild_id){echo 'selected';}?>><?php D(ucfirst($category_subchild_list->category_subchild_name));?></option>
                                    <?php
                                }
                            }
                             ?>
                            </select>
                            </div>
                        </div>
                        <span id="sub_categoryError" class="rerror"></span>
                    </div>
                    <div class="submit-field">
                        <h5>Completion Date (Optional)</h5>
                        <input type="date" class="form-control" value="<?php if($memberInfo && $memberInfo->portfolio_complete_date){D(date('Y-m-d',strtotime($memberInfo->portfolio_complete_date)));}?>" name="complete_date" id="complete_date" min="1990-12-31" max="<?php echo D(date('Y-m-d',strtotime('+5 year')));?>" placeholder="DD-MM-YYYY">
                        <span id="complete_dateError" class="rerror"></span>
                    </div>
       			</div>       			
       			</div>	       				       				       					
       			</form>
    </div>
<script type="text/javascript">
	$('#category').on('change',function(){
	$('.sub_category_display').show();
	$( "#load_sub_category").html('<div class="text-center" style="min-height: 70px;width: 100%;line-height: 50px;">'+SPINNER+'<div>').show();
		$.get( "<?php echo get_link('editprofileAJAXURL')?>",{'formtype':'getsubcat','Okey':$(this).val()}, function( data ) {
			setTimeout(function(){ $("#load_sub_category").html(data);$('.selectpicker').selectpicker('refresh');},1000)
		});
	})
</script>