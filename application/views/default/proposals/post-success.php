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
            <h1 class="h4 mb-4"><?php echo __('postproposal_posted_success','Service posted successfully!');?></h1>
            <p><?php echo __('postproposal_desc','Your service has been successfully posted. We’re sending you a confirmation email regarding the same. Feel free to share the proposal on:');?></p>                        
            <a href="<?php D($edit_url)?>" class="btn btn-outline-site mb-2"><?php echo __('postproposal_edit_proposal','Edit proposals');?></a> &nbsp; <a href="<?php D(get_link('myProposalsURL'))?>" class="btn btn-site mb-2"><?php echo __('postproposal_back_to_proposal','Back to my proposals');?></a> &nbsp; <a href="<?php D($details_url)?>" class="btn btn-outline-site mb-2"><?php echo __('postproposal_view_proposal','View proposal');?></a>
           
            </div>						
        </div>
    </aside>
    </div>
    </div>
</div>
</section>