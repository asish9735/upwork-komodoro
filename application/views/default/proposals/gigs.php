<?php $lang = get_active_lang();?>
<section class="short-banner">
  <div class="container">
      <h1>Browse Gigs</h1>
  </div>
</section>
<section class="section">
	<div class="container">
    	<div class="row">
        <aside class="col-xl-3 col-lg-3 col-12">	
            	<div class="filterHeader d-lg-none">
                	<h4>Filters</h4>
                    <a href="javascript:void(0)" class="float-end" id="filter" title="Filter"><i class="icon-feather-filter f20"></i></a>
                </div>
                <div class="sidebar-filter p-0" style="background:none;">
                	<div class="filter-header filterHeader d-lg-none">
                        <div class="row d-flex">
                        <div class="col"><a href="javascript:void(0)">Clear</a></div>
                        <div class="col text-center"><h4>Filters</h4></div>
                        <div class="col"><a href="javascript:void(0)" class="close_filter" title="Filter"><i class="icon-feather-x f20"></i></a></div>
                        </div>
                    </div>
                    <div class="filter-body">			
                        <form action="" id="filter_form" name="filter_form" onsubmit="return post_form();">
                    	<div class="input-group mb-3">
                                <input type="text" name="term" class="form-control" placeholder="Search..." value="<?php echo !empty($srch_param['term']) ? $srch_param['term'] : ''; ?>">
                             <button type="submit" class="btn btn-site"><i class="icon-feather-search"></i></button>
                        </div>                      
					 
                    <?php /*?><div class="form-field">
                                <input type="text"  class="form-control form-control-lg tagsinput_skill" placeholder="<?php echo __('findtalents_page_skills_placeholder','Search skills');?>"/>
                            </div><?php */?> 
                             
                    <h5>Category</h5>
                    <div class="panel scroll-bar mb-3" data-simplebar> 
                    <div class="panel-body pe-0">                                                                   
                    <ul class="gig-list">
                            <li class="<?php echo (empty($srch_param['category_id'])) ? 'active' : ''; ?>">
                                    <input class="" type="radio"  onchange="post_form_check()" name="category_id" id="category_0" value="0" <?php echo (empty($srch_param['category_id'])) ? 'checked' : ''; ?>>
                                    <label for="category_0"> All </label>
                            </li>                        
                        <?php 
                        if($parent_category){
                            foreach($parent_category as $key =>$val){
                                $categoryName = $val->category_name;
                        ?>
                           
                                <li class="<?php echo (!empty($srch_param['category_id']) && $val->category_id==$srch_param['category_id']) ? 'active' : ''; ?>">
                                    <input class="" type="radio"  onchange="post_form_check()" name="category_id" id="category_<?php echo $val->category_id;?>" value="<?php echo $val->category_id; ?>" <?php echo (!empty($srch_param['category_id']) && $val->category_id==$srch_param['category_id']) ? 'checked' : ''; ?>>
                                    <label for="category_<?php echo $val->category_id;?>"> <?php echo $categoryName;?> </label>
                                </li>
                            
                        <?php
                            }  
                        }?>
                        </ul>
                    </div>
                    </div>  
                        <?php if($child_category){?>
                        	<h5><?php echo $category_name;?></h5> 
                        	<div class="panel scroll-bar mb-3" data-simplebar> 
                            <div class="panel-body">   
                            <ul class="gig-list subcategory">
                        <?php
                            foreach($child_category as $key =>$val){
                                $categoryName = $val->category_subchild_name;
                        ?>
                          
                              <li class="<?php echo (!empty($srch_param['sub_catgory_id']) && in_array($val->category_subchild_id, $srch_param['sub_catgory_id'])) ? 'active' : ''; ?>">
                                    <input class="" type="checkbox"  onchange="post_form()" name="sub_catgory_id[]" id="sub_catgory_<?php echo $val->category_subchild_id;?>" value="<?php echo $val->category_subchild_id; ?>" <?php echo (!empty($srch_param['sub_catgory_id']) && in_array($val->category_subchild_id, $srch_param['sub_catgory_id'])) ? 'checked' : ''; ?>>
                                    <label for="sub_catgory_<?php echo $val->category_subchild_id;?>"> <?php echo $categoryName;?> </label>
                              </li>
                            
                        	<?php
                            } 
                            ?>
                            </ul>
                            </div>
                            </div>
                        <?php 
                        }?>
                        <?php if($pre_skills){?>
                        <h3 class="text-center mb-3">Skills</h3> 
                        <div class="tags-container skillContaintag">
                            <?php
                                foreach($pre_skills as $k=>$preskills){
                            ?>
                            <div class="tag skill_set_<?php echo $preskills->skill_id;?>" onclick="post_form()">
                                <input type="checkbox" id="tag_<?php echo $preskills->skill_id;?>" name="byskillsid[]" value="<?php echo $preskills->skill_id;?>" checked>
                                <label for="tag_<?php echo $preskills->skill_id;?>"><?php echo $preskills->skill_name;?></label>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                        <div class="clearfix"></div>
                        <?php
                        }
                        ?>
                    </form>
            		</div>
            	</div>
            </aside>
            <aside class="col-xl-9 col-lg-9 col-12">
            <div class="d-flex mb-3 align-items-center">
                <h5 class="mb-0">10 Gigs Found</h5>
                <div class="sort-by ms-auto">
                    <div class="sort-by">
                    <span>Sort by:</span>
                    <select class="selectpicker" data-size="3" onchange="post_form()" name="sort_by">
                        <option value="latest" <?php echo (!empty($srch_param['sort_by']) && $srch_param['sort_by']=='latest') ? 'selected' : ''; ?>>Latest</option>
                        <option value="popular" <?php echo (!empty($srch_param['sort_by']) && $srch_param['sort_by']=='popular') ? 'selected' : ''; ?>>Popular</option>
                        <option value="price_low_to_high" <?php echo (!empty($srch_param['sort_by']) && $srch_param['sort_by']=='price_low_to_high') ? 'selected' : ''; ?>>Price - Low to High</option>
                        <option value="price_high_to_low" <?php echo (!empty($srch_param['sort_by']) && $srch_param['sort_by']=='price_high_to_low') ? 'selected' : ''; ?>>Price - High to Low</option>
                    </select>
                    </div>
                 </div>   
            </div>                 
            <div class="row row-10">
<?php
//get_print($proposals,false);
if($proposals){
foreach($proposals as $key=>$proposal){
    
?>
	<div class="col-xl-4 col-lg-4 col-sm-6 col-12">
    	<?php echo $this->layout->view('gig-list',array('proposal'=>$proposal),true);?>	
    </div>                	
 <?php } 
} else {?>
	<div class="col-12">
        <div class='not-found with-emoji'>
            <img src="<?php echo IMAGE;?>emoji-sad.png" alt="Emoji Sad" height="84" width="84" />
            <p>Sorrry! <i><?php echo __('findjob_no_gigs_found','No gig found');?></i></p>
        </div>
    </div>	
<?php } ?>

                
            </div>     
            <nav aria-label="Page navigation" id="nav_bar">  
        <?php  
        if(isset($links)){                     
        echo $links;   
        }
        ?> 
        </nav>
        	</aside>          
        </div>	
	</div>
</section>

<script>
var all_skills=<?php D(json_encode($all_skills));?>;
var  main = function(){
  $('#filter').click(function(){
    $('.sidebar-filter').slideToggle('slow');
	$('body').addClass('overflow-none');
  });
  $('.close_filter').click(function(){
    $('.sidebar-filter').slideToggle('slow');
	$('body').removeClass('overflow-none');
  });
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
	elts.on('beforeItemAdd', function(event) {
		var itemdata=event.item;
		console.log(itemdata);
		var key=itemdata.skill_id;
		var name=key;
		if($(".skill_set_"+key).length>0){
			var html='<input type="checkbox" id="tag_'+key+'"  name="byskillsid[]" value="'+itemdata.skill_id+'" checked/><label for="tag_'+key+'">'+itemdata.skill_name+'</label>';
			$(".skillContaintag skill_set_"+key).html(html);
		}else{
			var html='<div class="tag skill_set_'+key+'" onclick="post_form()"><input type="checkbox" id="tag_'+key+'"  name="byskillsid[]" value="'+itemdata.skill_id+'" checked/><label for="tag_'+key+'">'+itemdata.skill_name+'</label></div>';
			$(".skillContaintag").append(html);
		}
		post_form();
		//console.log(event.item);
		event.cancel = true;
	})
};
function post_form_check(){
    $('.subcategory').remove();
    post_form();
}
function post_form(){
	  var frm = $('#filter_form').serialize();
	 /*  var frm2 = $('#srchForm2').serialize();
	  if(frm2 != ''){
		  frm += '&'+frm2;
	  } */
	  location.href = '<?php echo get_link('search_gigs')?>?'+frm;
  }
</script>
<style>
.tags-container {
    display: flex;
    flex-wrap: wrap;
    /*justify-content: center;*/
}
.tags-container .tag {
    display: inline-block;
    overflow: hidden;
}
.tags-container input[type="checkbox"], .tags-container input[type="radio"] {
    display: none;
}
.tags-container input[type="checkbox"] + label, .tags-container input[type="radio"] + label {
    transition: 0.3s;
    font-size: 0.938rem;
    cursor: pointer;
    border-radius: 0.2rem;
    background-color: #fff;
    border: 1px solid #dfdfdf;
    color: #777;
    display: inline-block;
    padding: 0.15rem 0.6rem 0.25rem;
    margin: 0;
    line-height: 20px;
}
span.featured-icon {
    font-size: 20px;
    position: absolute;
    z-index: 101;
    right: 20px;
    top: 20px;
    cursor: pointer;
    background-color: rgba(0, 0, 0, .5);
    color: #fff;
    display: block;
    height: 36px;
    width: 36px;
    border-radius: 50%;
    transition: all 0.4s;
}
.featured-icon:before {
    transition: transform 0.4s cubic-bezier(.8, -.41, .19, 2.5);
    font-family: 'Line-Awesome';
    position: absolute;
    right: 0;
    left: 0;
    text-align: center;
    top: 6px;
    content: "\f318";
}
.tags-container input[type="checkbox"]:checked + label, .tags-container input[type="radio"]:checked + label {
    border-color: var(--siteColor);
    background-color: var(--siteColor);
    color: #fff;
}
</style>