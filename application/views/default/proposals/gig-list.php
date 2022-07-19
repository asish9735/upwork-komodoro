<?php 
$url=get_link('myProposalDetailsURL').'/'.$proposal['proposal_url'];
$proposal_rating_details=getProposalRating($proposal['proposal_id'],array('stat'));
$proposal_rating=0;
$count_reviews=$proposal_rating_details->total_review;
$average_rating=$proposal_rating_details->avg_review;
$logo=getMemberLogo($proposal['proposal_seller_id']);
$proposal_image=UPLOAD_HTTP_PATH.'proposals-files/proposals-thumb/'.$proposal['proposal_image'];
$is_featured=0;
if($proposal['proposal_featured']==1 && $proposal['featured_end_date']>date('Y-m-d H:i:s')){
	$is_featured=1;
}
//print_r($proposal);
$is_online=is_online($proposal['proposal_seller_id']);
$show_slider=0;
if($show_slider==1){
    $files=getGigDetails($proposal['proposal_id'],array('proposal_files','proposal_video'),true);
    $slider=$video=array();
    if($files->proposal_files){
        foreach($files->proposal_files as $k=>$file){
        $slider[]=UPLOAD_HTTP_PATH.'proposals-files/proposals-images/'.$file->server_name;
        }
    }
    $videohtml='';
    if($files->proposal_video){
        $video[0]['video']=UPLOAD_HTTP_PATH.'proposals-files/proposals-video/'.$files->proposal_video->server_name;
        $video[0]['thumb']=UPLOAD_HTTP_PATH.'proposals-files/proposals-images/'.$files->proposal_video->image_thumb;
        $videohtml='<video autoplay class="" poster="'.$video[0]['thumb'].'"  style="background-color:black;" controls><source class="embed-responsive-item" src="'.$video[0]['video'].'" type="video/mp4"><source src="'.$video[0]['video'].'" type="video/ogg"></video>';
    }

}
$proposal_order_queue=$this->db->where('proposal_id',$proposal['proposal_id'])->where_in('order_status',array(ORDER_PROCESSING,ORDER_REVISION,ORDER_CANCELLATION))->from('orders')->count_all_results();
        $proposal_order_completed=$this->db->where('proposal_id',$proposal['proposal_id'])->where_in('order_status',array(ORDER_COMPLETED,ORDER_DELIVERED))->from('orders')->count_all_results();
?>

<div class="card card-catalog card-gigs">
    <div class="card-image">
        <?php if($show_slider){?>
            <div id="carouselExampleIndicators" class="carousel slide gigs-carousel" data-ride="carousel">      
                <div class="carousel-inner">            
                    <div class="carousel-item active">
                        <img src="<?php echo $proposal_image;?>" alt="<?php echo $proposal['proposal_title'];?>" class="card-img-top">
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo IMAGE;?>catalog_1-400x270.jpg" alt="<?php echo $proposal['proposal_title'];?>" class="card-img-top">
                    </div>
                    <div class="carousel-item slide-video">
                        <video src="<?php echo IMAGE;?>video-gigs-1.mp4"></video>                
                        <button class="slide-play-button" style="width: 32px; height: 32px;">
                            <img src="<?php echo IMAGE;?>circled-play.png" alt="" />
                        </button>
                    </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                    </a>
            </div>
        <?php }else{?>
            <a href="<?php echo $url;?>">
                <img src="<?php echo $proposal_image;?>" alt="<?php echo $proposal['proposal_title'];?>" class="card-img-top">
            </a>
        <?php 
        }
        ?>
        
        <?php 
        /* $logged=$this->session->userdata('user');
        if($logged){

            $is_favorite=is_favorite_proposal($logged[0]->user_id,$proposal['proposal_id']);

        } */
        ?>
        <!-- <span class="bookmark-icon"></span> -->
        <?php
        if($is_featured){
            echo '<span class="featured-tag"></span>';
        }
        ?>
        <div class="card-avatar <?php if($is_online){echo 'status-online';}?>"><img src="<?php echo $logo;?>" alt="" height="40" width="40" class="rounded-circle"><span class="verified-badge"></span></div>
    </div>
    <div class="card-body">
        <?php /*?><div class="user-details mb-2">
            <div class="user-avatar <?php if($is_online){echo 'status-online';}?>"><img src="<?php echo $logo;?>" alt="" height="40" width="40" class="rounded-circle"></div>
            <div class="user-name">
                <h5 class="mb-0"><?php echo $proposal['member_name'];?></h5>
                <p><small><?php echo $proposal['member_heading'];?></small></p>
            </div>
        </div><?php */?>
        <h5 class="card-title"><a href="<?php echo $url;?>"><?php echo $proposal['proposal_title'];?></a></h5>
        <div class="freelancer-rating">
            <div class="star-rating" data-rating="<?php echo round($average_rating,1);?>"></div>
        </div>
        <p class="card-justify"><span>Order in Queue: <b><?php echo $proposal_order_queue;?></b></span> <span>Sell: <b><?php echo $proposal_order_completed;?></b></span></p>
        <div class="card-price"><h3><?php echo CURRENCY;?><?php echo $proposal['display_price'];?></h3> <span><i class="icon-feather-eye"></i> <?php echo $proposal['proposal_views'];?></span></div>
        <!-- <div class="star-rate"><i class="icon-material-outline-star"></i> <?php // echo round($average_rating,2);?></div>
        <div class="card-bottom">        
        	<a href="<?php // echo $url;?>" class="btn btn-outline-site btn-sm ml-auto">Buy Now</a>
        </div> -->
    </div>
</div>
