<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section class="section">
<div class="container">            
    <div class="row">	
    <aside class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-sm-10 offset-sm-1 col-12">			
        <div class="card text-center d-flex align-items-center" style="min-height:250px; flex-direction: inherit;">
        <div class="card-body">
            <img src="<?php echo IMAGE;?>checkmark.png" alt="" class="mb-3" />
            <h1 class="h4 mb-4">Project posted successfully.</h1>                        
            <a href="<?php D(get_link('myProjectClientURL'))?>" class="btn btn-outline-site mb-2">Edit project</a> &nbsp; <a href="<?php D(get_link('myProjectClientURL'))?>" class="btn btn-site mb-2">Back to my projects</a> &nbsp; <a href="<?php D(get_link('myProjectClientURL'))?>" class="btn btn-outline-site mb-2">View project</a>
            <div class="freelancer-socials">
            <p class="mb-2">Share this project:</p>
            <ul class="social-links">            	
                <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php // echo $profile_url;?>" target="_blank" title="Share on Facebook" data-tippy-placement="top"><i class="icon-brand-facebook-f"></i></a></li>
                <li><a href="https://twitter.com/home?status=<?php // echo $profile_url;?>" target="_blank" title="Share on Twitter" data-tippy-placement="top"><i class="icon-brand-twitter"></i></a></li>
                <li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php // echo $profile_url;?>&title=&summary=&source=" target="_blank" title="Share on LinkedIn" data-tippy-placement="top"><i class="icon-brand-linkedin-in"></i></a></li>
             </ul>
             </div>
            </div>						
        </div>
    </aside>
    </div>
    </div>
</div>
</section>