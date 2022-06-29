<?php $lang = get_active_lang();
//get_print($proposal,false);
$url=get_link('myProposalDetailsURL').'/'.$proposal->proposal_url;
$proposal_rating_details=getProposalRating($proposal->proposal_id,array('stat'));
$proposal_rating=0;
$count_reviews=$proposal_rating_details->total_review;
$average_rating=$proposal_rating_details->avg_review;
$slider=$video=array();
if($proposal->proposal_files){
  foreach($proposal->proposal_files as $k=>$file){
    $slider[$k]['thumb']=UPLOAD_HTTP_PATH.'proposals-files/proposals-thumb/'.$file->image_thumb;
    $slider[$k]['image']=UPLOAD_HTTP_PATH.'proposals-files/proposals-images/'.$file->server_name;
  }
}
$videohtml='';
if($proposal->proposal_video){
  $video[0]['video']=UPLOAD_HTTP_PATH.'proposals-files/proposals-video/'.$proposal->proposal_video->server_name;
  $video[0]['thumb']=UPLOAD_HTTP_PATH.'proposals-files/proposals-images/'.$proposal->proposal_video->image_thumb;
  $videohtml='<video autoplay class="" poster="'.$video[0]['thumb'].'"  style="background-color:black;" controls><source class="embed-responsive-item" src="'.$video[0]['video'].'" type="video/mp4"><source src="'.$video[0]['video'].'" type="video/ogg"></video>';
}
/* $slider[]=VPATH.'assets/postgigs_upload/'.$proposal->proposal_image;

 */

?>

<section class="section">
  <div class="container">
    <div class="categorySec"> 
      <div class="row">
        <aside class="col-lg-8 col-12">
          <div class="card mb-4">
          <div class="card-image">
            <div id='ninja-slider'>
                <div>
                    <div class="slider-inner">
                        <ul>
                            <?php 
                            if($video){
							                  foreach($video as $v=>$slide){
							              ?>
                            <li class="slide-video">
                              <div class="video">
                                  <?php echo $videohtml;?>
                              </div>
                            	<a class="ns-img" href="<?php echo $slide['thumb']?>"></a>
                              <div class="video-playbutton-layer"></div>
                            </li>                            
							              <?php 
                                }
                              }
                            ?>
                              
                          <?php if($slider){
                            foreach($slider as $s=>$slide){
                            ?>
                            <li class=" <?php if($s==0 && !$video){echo 'active';}?>">                                  
                              <a class="ns-img" href="<?php echo $slide['image'];?>"></a>
                            </li>
                            <?php 
                            }
                            }
                          ?>
                        </ul>
                        <div class="fs-icon" title="Expand/Close"></div>
                    </div>
                    <div id="thumbnail-slider">
                        <div class="inner">
                            <ul>
                                <?php 
                                if($video){
								                  foreach($video as $v=>$slide){
								                ?>
                                <li>
                                    <a class="thumb" href="<?php echo $slide['thumb']?>"></a>
                                </li>
                                <?php 
									                  }
                                  }
                                ?>
                                <?php 
                                if($slider){
                                  foreach($slider as $s=>$slide){
                                  ?>
                                  <li class="<?php if($s==0 && !$video){echo 'active';}?>">
                                    <a class="thumb" href="<?php echo $slide['thumb'];?>"></a>
                                  </li>
                                  <?php 
                                  }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php /*?><div id="carouselExampleIndicators" class="carousel slide gigs-carousel" data-ride="carousel">
              <ol class="carousel-indicators">
              <?php for($i=0;$i<(count($slider)+count($video));$i++){?>
                <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i;?>" class="<?php if($i==0){echo 'active';}?>"></li>
                <?php }?>
              </ol>
              <div class="carousel-inner">
              <?php if($video){
                foreach($video as $v=>$slide){
                ?>
                 <div class="carousel-item active slide-video">
                 <figure class="thumbnail mb-0">
                    <button class=" slide-play-button" style="width: 80px; height: 80px;">
                    <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8.00017 0.333374C6.48384 0.333374 5.00157 0.783016 3.74079 1.62544C2.48002 2.46786 1.49736 3.66523 0.91709 5.06613C0.336818 6.46703 0.184992 8.00855 0.480812 9.49573C0.776632 10.9829 1.50681 12.349 2.57901 13.4212C3.65122 14.4934 5.01729 15.2236 6.50447 15.5194C7.99166 15.8152 9.53317 15.6634 10.9341 15.0831C12.335 14.5028 13.5323 13.5202 14.3748 12.2594C15.2172 10.9986 15.6668 9.51636 15.6668 8.00004C15.6646 5.96739 14.8562 4.01863 13.4189 2.58132C11.9816 1.14402 10.0328 0.33558 8.00017 0.333374V0.333374ZM11.5025 8.28737L5.83583 11.6207C5.7852 11.6505 5.7276 11.6664 5.66885 11.6667C5.61011 11.6671 5.55232 11.6519 5.50133 11.6227C5.45034 11.5936 5.40796 11.5514 5.37849 11.5006C5.34902 11.4498 5.3335 11.3921 5.3335 11.3334V4.66671C5.3335 4.60796 5.34902 4.55026 5.37849 4.49945C5.40796 4.44864 5.45034 4.40651 5.50133 4.37735C5.55232 4.34818 5.61011 4.33301 5.66885 4.33336C5.7276 4.33372 5.7852 4.34959 5.83583 4.37937L11.5025 7.71271C11.5525 7.74214 11.594 7.78413 11.6229 7.83453C11.6517 7.88493 11.6669 7.94198 11.6669 8.00004C11.6669 8.0581 11.6517 8.11515 11.6229 8.16555C11.594 8.21595 11.5525 8.25794 11.5025 8.28737V8.28737Z">
                    </path>
                    </svg>
                  </button>
                  <img  src="<?php echo $slide['thumb']?>" class="image-loaded">
                </figure>
                </div>

              <?php 
                }
              }
              ?>
              
              <?php if($slider){
                foreach($slider as $s=>$slide){
                ?>
                <div class="carousel-item <?php if($s==0 && !$video){echo 'active';}?>">
                  <img src="<?php echo $slide;?>" class="d-block w-100" alt="" />
                </div>
                <?php 
                }
              }
              ?>
                           
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
			</div><?php */?>
          </div> 

          <div class="card-body">
              <h3><?php echo $proposal->proposal_title;?></h3>
              <p>
              <?php echo html_entity_decode($proposal->proposal_additional->proposal_description);?>
              </p>
              <?php if($proposal->proposal_skills){?>
                <div class="task-tags mb-3">
              <?php
                    foreach($proposal->proposal_skills as $t=>$tag){
                ?>
                    <span><?php echo $tag->skill_name;?></span>
                <?php
                    }
                ?>
                </div>
                <?php
                }
                ?>
                                          
              <ul class="d-list">
              	<li>
                <div class="freelancer-rating">
                    <div class="star-rating" data-rating="<?php echo round($average_rating,1);?>"></div>
                    <span class="badge badge-primary ml-1" style="    vertical-align: text-bottom;"><?php echo $count_reviews;?></span>
                </div>
                  <!-- <span class="text-warning"><i class="icon-line-awesome-star"></i> <?php echo $average_rating;?></span> <span class="text-muted ml-1">(<?php echo $count_reviews;?>)</span> -->
                </li>
              	<li><i class="icon-feather-calendar"></i> <?php echo date('d M, Y',strtotime($proposal->proposal_date));?></li>
              	<li><i class="icon-feather-eye"></i> <?php echo $proposal->proposal_views;?></li>
              </ul>
             
              <div class="col-auto" hidden> <a href="#" class="btn btn-outline-site btn-sm"><i class="icon-feather-flag"></i> Report</a> </div>
              
            </div>
          </div>
          <?php if($proposal->proposal_additional->buyer_instruction){?>
              <div class="card mb-4">
              	<div class="card-header"><h4>Buyer requirements</h4></div>
              	<div class="card-body">
              		<p><?php echo nl2br($proposal->proposal_additional->buyer_instruction);?></p>
                </div>
              </div>
          <?php }?>
                              
          <?php if($proposal->proposal_question){?>
			<h4>FAQs</h4>

            <!-- Accordion -->
            <div class="accordion js-accordion mb-4">                 
                <?php
                    foreach($proposal->proposal_question as $t=>$qa){
                ?>
                <!-- Accordion Item -->
      			<div class="accordion__item js-accordion-item <?php echo $k == 0 ? 'active' : ''; ?>">
                    <div class="accordion-header js-accordion-header"><h4>Q<?php echo $t+1;?>. <?php echo $qa->proposal_question;?></h4></div>        
                    <!-- Accordtion Body -->
                    <div class="accordion-body js-accordion-body">
                        <div class="accordion-body__contents">                              
                              <p><span class="text-success">Ans:</span> <i><?php echo $qa->proposal_answer;?></i></p>
                            
                        </div>
                    </div>
            	</div>
				<?php }?>
                <!-- Accordion Item / End -->
            </div>
		  <?php }?>
          <?php if(count($proposal->proposal_packages) > 1){?>
          <div class="card mb-4">
            <ul class="package">
              <li>
                <ul>
                  <li>
                    <h4>Packages</h4>
                  </li>
                  <li>
                    <h4>Basic</h4>
                  </li>
                  <li>
                    <h4>Standard</h4>
                  </li>
                  <li>
                    <h4>Premium</h4>
                  </li>
                </ul>
              </li>
             
              <li>
                <ul>
                  <li><strong>Price</strong></li>
              <?php
              if($proposal->proposal_packages){
                foreach($proposal->proposal_packages as $p=>$package){
              ?>
                  <li>
                    <h2><small><?php echo CURRENCY;?></small><?php echo $package->price; ?>
                    
        
                    </h2>
                  </li>
                <?php
                  }
                }
                ?>
                </ul>
              </li>
              <li>
                <ul>
                  <li><strong>Name</strong></li>
              <?php
              if($proposal->proposal_packages){
                foreach($proposal->proposal_packages as $p=>$package){
              ?>
                  <li>
                    <?php echo $package->package_name; ?>
                  </li>
                <?php
                  }
                }
                ?>
                </ul>
              </li>
              <li>
                <ul>
                  <li><strong>Description</strong></li>
                <?php
                if($proposal->proposal_packages){
                foreach($proposal->proposal_packages as $package){
                ?>
                <li><?php echo $package->description; ?></li>
                <?php
                }
                }
                ?>   
                 </ul>
              </li>
              <li>
                <ul>
                  <li><strong>Delivery Time</strong></li>
                  <?php
                  if($proposal->proposal_packages){
                  foreach($proposal->proposal_packages as $package){
                  ?>
                  <li><?php echo $package->delivery_time; ?> Days</li>
                  <?php
                  }
                  }
                  ?> 
                </ul>
              </li>
              <li>
                <ul>
                  <li>&nbsp;</li>
                  <?php
                  if($proposal->proposal_packages){
                    foreach($proposal->proposal_packages as $package){
                    ?>
                      <li><a href="javascript:void(0)" class="btn btn-site btn-sm" onclick="checkoutForm(this,'<?php echo ($package->package_id); ?>')">Select</a></li>
                  <?php
                    }
                  }
                 ?> 
                </ul>
              </li>
            </ul>
          </div>
          <?php }?>
        </aside>
        <aside class="col-lg-4 col-12">
          <div class="card mb-4 mt-4 mt-lg-0">
          <?php if(count($proposal->proposal_packages) > 1){?>
            <div class="card-header pt-0 pl-3">
              <ul class="nav nav-tabs card-header-tabs justify-content-center" id="myTab" role="tablist">
              <?php
               if($proposal->proposal_packages){
                  foreach($proposal->proposal_packages as $k=>$package){
              ?>
                <li class="nav-item" role="presentation"> <a class="nav-link <?php echo ($k==0 ? 'active':'');?>" id="<?php echo ($package->package_id); ?>-tab" data-toggle="tab" href="#tab_<?php echo ($package->package_id); ?>" role="tab" aria-controls="<?php echo ($package->package_name); ?>" aria-selected="true"><?php echo ($package->package_name); ?></a> </li>
              <?php
                  }
                }
              ?> 
              </ul>
            </div>
            <div class="tab-content" id="myTabContent">
            <?php
               if($proposal->proposal_packages){
                  foreach($proposal->proposal_packages as $k=>$package){
              ?>
              <div class="tab-pane fade <?php echo ($k==0 ? 'show active':'');?>" id="tab_<?php echo ($package->package_id); ?>" role="tabpanel" aria-labelledby="<?php echo ($package->package_id); ?>-tab">
                <div class="card-body">
                  <h3><small><?php echo CURRENCY;?></small><?php echo ($package->price); ?></h3>
                  <div class="row align-items-center mb-3">
                      <div class="col-xl col-12">
                        <label><i class="icon-feather-clock"></i> Delivery in <?php echo ($package->delivery_time); ?> days</label>
                      </div>
                      <div class="col-xl-auto col-12">
                      	<div class="d-flex align-items-center">
                        <label class="mr-2"><?php echo (__('proposal_details_page_Quantity',"Quantity"));?></label>
                        <select class="form-control" name="proposal_qty" id="proposal_qty" style="max-width:70px">
                          <?php
                          for($i=1;$i<=12;$i++){
                          ?>
                          <option><?php echo ($i);?></option>
                          <?php
                          }
                          ?>
                        </select>
                        </div>
                      </div>
                  </div>
                  <a href="javascript:void(0)" onclick="checkoutForm(this,'<?php echo ($package->package_id); ?>')" class="btn btn-site btn-block">Order Now</a> </div>
              </div>
              <?php
                  }
                }
              ?>
 
            </div>
            <?php }else{?>
              <div class="card-header pt-0 pl-3">
                <h4 class="mt-3">Order Details</h4>
              </div>
              <div class="tab-content" id="myTabContent">
              <?php
               if($proposal->proposal_packages){
                  foreach($proposal->proposal_packages as $k=>$package){
              ?>
              <div class="tab-pane fade  <?php echo ($k==0 ? 'show active':'');?>" id="tab_<?php echo ($package->package_id); ?>" role="tabpanel" aria-labelledby="<?php echo ($package->package_id); ?>-tab">
                <div class="card-body">
                  <h3><small><?php echo CURRENCY;?></small><?php echo ($package->price); ?></h3>
                  <div class="row align-items-center mb-3">
                      <div class="col-xl col-12">
                        <label><i class="icon-feather-clock"></i> Delivery in <?php echo ($package->delivery_time); ?> days</label>
                      </div>
                      <div class="col-xl-auto col-12">
                      	<div class="d-flex align-items-center">
                        <label class="mr-2"><?php echo (__('proposal_details_page_Quantity',"Quantity"));?></label>
                        <select class="form-control" name="proposal_qty" id="proposal_qty" style="max-width:70px">
                          <?php
                          for($i=1;$i<=12;$i++){
                          ?>
                          <option><?php echo ($i);?></option>
                          <?php
                          }
                          ?>
                        </select>
                        </div>
                      </div>
                  </div>
                  
                  <a href="javascript:void(0)" onclick="checkoutForm(this,'<?php echo ($package->package_id); ?>')" class="btn btn-site btn-block">Order Now</a> </div>
              </div>
              <?php
                  }
                }
              ?>
              </div>
            <?php }?>
            
          </div>
          <div class="card mb-4">
            <?php 
            $member=$proposal->member;
            $profile_link=get_link('viewprofileURL')."/".$proposal->proposal_seller_id;
            ?>
            <div class="card-body text-center">
              <div class="mb-3"><img src="<?php echo getMemberLogo($proposal->proposal_seller_id);?>" alt="" height="96" width="96" class="rounded-circle border"></div>
              <h4 class="mb-0"><a href="<?php echo $profile_link;?>"><?php echo $member->member_name;?></a></h4>
              <p class="text-muted text-ellipsis-1 mb-2"><?php echo $member->member_heading;?></p>
              <div class="star-rating mb-3" data-rating="<?php echo $member->avg_review; ?>"></div>
              <div class="freelancer-details-list">
                <ul class="d-flex mb-0">
                  <li><span><?php echo __('location','Location')?></span> <strong><img src="<?php echo IMAGE;?>flags/<?php D(strtolower($member->country_code_short));?>.svg" alt="" title="<?php D($member->country_name);?>" class="flag" data-tippy-placement="top" /> <?php echo $member->country_name; ?></strong></li>
                  <li><span>Rate</span> <strong><?php echo CURRENCY;?><?php echo $member->member_hourly_rate;?> / <?php echo __('hr','hr')?></strong>

        
                  </li>
                  <li><span><?php echo __('job_success','Job success')?></span> <strong><?php echo round($member->success_rate,2);?>%</strong></li>
                </ul>
              </div>
              <?php if(!$is_owner){?>
              <a href="javascript:void(0)" onclick="send_message('<?php echo md5($proposal->proposal_id);?>','<?php echo md5($logged_in_id);?>')" class="btn btn-site btn-block">Contact Now</a>
              <?php }?>
            </div>
          </div>
          <?php /*?><div class="card mb-4 text-center">
            <div class="card-body"> <i class="icon-feather-shield icon-lg text-site"></i>
              <h3> 100% Secured </h3>
              <p> The task will be completed, or money back guaranteed. </p>
            </div>
          </div><?php */?>
          
          <div class="card mb-4">
            <div class="card-header">
              <h4> How It Works </h4>
            </div>
            <div class="card-body">
              <ul class="list list-2">
                <li>Review the Project entry and confirmthe job you need will be fulfilled.</li>
                <li>Discuss and get in touch with the freelancer to finalize the submitted project.</li>
                <li>Once project is complete, make sure to provide ratings and feedback.</li>
              </ul>
              <div class="text-center" hidden> <a href="#" class="btn btn-site"> How It Works </a> </div>
            </div>
          </div>
          <div class="share-buttons">
                    <div class="share-buttons-trigger"><i class="icon-feather-share-2"></i></div>
                    <div class="share-buttons-content"> <span><strong>Share It!</strong></span>
                      <ul class="share-buttons-icons">
                        <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>" target="_blank" data-button-color="#3b5998" title="Share on Facebook" data-tippy-placement="top"><i class="icon-brand-facebook-f"></i></a></li>
                        <li><a href="https://twitter.com/home?status=<?php echo $url; ?>" target="_blank" data-button-color="#1da1f2" title="Share on Twitter" data-tippy-placement="top"><i class="icon-brand-twitter"></i></a></li>
                        <li hidden><a href="https://plus.google.com/share?url=<?php echo $url; ?>" target="_blank" data-button-color="#dd4b39" title="Share on Google Plus" data-tippy-placement="top"><i class="icon-brand-google-plus-g"></i></a></li>
                        <li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url; ?>&title=&summary=&source=" target="_blank" data-button-color="#0077b5" title="Share on LinkedIn" data-tippy-placement="top"><i class="icon-brand-linkedin-in"></i></a></li>
                      </ul>
                    </div>
                  </div>
        </aside>
      </div>
      <?php if($similar){?>
        <h4> Similar Catalog </h4>
      <div class="row row-10">
      <?php 
        foreach($similar as $key=>$proposal_row){
        ?>
        <article class="col-lg-3 col-md-4 col-sm-6 col-12">
                <?php echo $this->layout->view('proposals/gig-list',array('proposal'=>$proposal_row),true);?>	
        </article>
      <?php }?>
      </div>
      <?php }?>

      <?php if($my_other_gigs){?>
        <h4> More gigs by  <a href="<?php echo $profile_link;?>"><?php echo $member->member_name;?></a></h4>
      <div class="row row-10">
      <?php 
        foreach($my_other_gigs as $key=>$proposal_row){
        ?>
        <article class="col-lg-3 col-md-4 col-sm-6 col-12">
                <?php echo $this->layout->view('proposals/gig-list',array('proposal'=>$proposal_row),true);?>	
        </article>
      <?php }?>
      </div>
      <?php }?>
      <?php if($other_viewer_gigs){?>
        <h4>People Who Viewed This Service Also Viewed</h4>
      <div class="row row-10">
      <?php 
        foreach($other_viewer_gigs as $key=>$proposal_row){
        ?>
        <article class="col-lg-3 col-md-4 col-sm-6 col-12">
                <?php echo $this->layout->view('proposals/gig-list',array('proposal'=>$proposal_row),true);?>	
        </article>
      <?php }?>
      </div>
      <?php }?>


    </div>
  </div>
</section>
<script>
var SPINNER='<span class="spinner-border spinner-border-sm"></span>';

function checkoutForm(ev,package_id){

	var buttonsection=$(ev);
	var buttonval = buttonsection.html();
	buttonsection.html(SPINNER).attr('disabled','disabled');
	$.ajax({
			method: "POST",
			dataType: 'json',
			url: "<?php D(get_link('saveCheckoutFormCheckAJAXURL'))?>",
			data: {proposal_id:'<?php echo $proposal->proposal_id;?>',proposal_qty:$('#proposal_qty').val(),'package_id':package_id},
			success: function(msg) {
				buttonsection.html(buttonval).removeAttr('disabled');
				if (msg['status'] == 'OK') {
					 window.location.href=msg['redirect'];
				} else if (msg['status'] == 'FAIL') {

				}
			}
		})
	
	return false;
}
var main=function(){
  $('video').on('play', function (e) {
		$("#carouselExampleIndicators").carousel('pause');
	});
	$('video').on('stop pause ended', function (e) {
		$("#carouselExampleIndicators").carousel();
	}); 
  $('.slide-play-button').click(function(){
    var videohtml='<?php echo $videohtml;?>';
    $('.slide-video .thumbnail').after(videohtml);
  })
}
function send_message(pid,mid){
var redirectWindow = window.open("<?php echo get_link('CreateMessageRoomURL');?>/"+pid+"/"+mid+'/1', '_blank');
    redirectWindow.location;
}
</script>
<style>

</style>